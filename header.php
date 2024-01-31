<?php
    //Récupérer le login et le role de l'utilisateur
    $username = strtoupper($_SESSION['username']);
    $role = $_SESSION['role'];


    //Notifications ADMIN
    if($role == "admin")
    {
        //Récupérer les rappels des affections non encore effectuées par l'administrateur du système
        $nbPrsansMat = "";
        $nbPrsansProfil = "";
        $nbEtsansClasse = "";
        $nbEtsansProfil = "";

        $sql = "select count(*) as 'nb' from professeur where matiere IS null;"; //Nombre de professeurs non affectés(es) aux matières
        $sqlRes = $con->query($sql);
        $nbPrsansMat = $sqlRes->fetch(PDO::FETCH_ASSOC);

        $sql = "select count(*) as 'nb' from professeur where profil IS null;"; //Nombre de professeurs sans profil
        $sqlRes = $con->query($sql);
        $nbPrsansProfil = $sqlRes->fetch(PDO::FETCH_ASSOC);

        $sql = "select count(*) as 'nb' from etudiant where classe IS null;"; //Nombre d'étudiants sans Classe
        $sqlRes = $con->query($sql);
        $nbEtsansClasse = $sqlRes->fetch(PDO::FETCH_ASSOC);

        $sql = "select count(*) as 'nb' from etudiant where profil IS null;"; //Nombre d'étudiants sans profil
        $sqlRes = $con->query($sql);
        $nbEtsansProfil = $sqlRes->fetch(PDO::FETCH_ASSOC);
    }
    //Notifications PROFESSEUR
    if($role == "professeur")
    {
        $sql = "select nomMat from matiere m, professeur p  where m.idMat = p.matiere and p.idProf='".$_SESSION["matricule"]."';";
        $sqlRes = $con->query($sql);
        if($sqlRes->rowcount() >0)
        {
            $matiere = $sqlRes->fetch(PDO::FETCH_ASSOC);
        }
        //Devoir dont il reste 1 jour pour la date limite
        $sql = "select idDev, titreDev from devoir where DATEDIFF(dateEcheance,CURDATE()) <=1 and matiere in (select matiere from professeur where idProf='".$_SESSION["matricule"]."');";
        $sqlRes = $con->query($sql);
    }
    //Notifications ETUDIANT
    if($role == "etudiant")
    {
        //liste des matières enseignées à l'étudiant
        $sqlDev = "select idDev, titreDev, dateEcheance
        from matiere m, professeur p, classeprof cp, etudiant e, devoir d
        WHERE m.idMat = p.matiere 
        and d.matiere = m.idMat
        and p.idProf = cp.professeur
        and cp.classe = e.classe
        and DATEDIFF(dateEcheance,CURDATE()) >0
        and e.cne = '". $_SESSION["matricule"]."';";
        $sqlDevRes = $con->query($sqlDev);
    }

   
?>
    <header class="header d-flex justify-content-between align-items-center px-4">
        <section class="logo text-center">
            <h1>Madrasati</h1>
            <h6>Votre succès est Notre affaire</h6>
        </section>


        <section class="userInfo  d-flex justify-content-around align-items-start">
            <div class="user d-flex justify-content-around align-items-center w-50">
                <img src="./images/profile.png" alt="Utilisateur">
                <div class="info d-flex flex-column justify-content-center">
                    <span class="username fw-bold"><?php echo $username; ?></span>
                    <span class="role text-white-50"><?php echo $role; ?></span>
                </div>

            </div>
            <div class="options w-25 d-flex justify-content-around">

                <div class="offcanvas offcanvas-end" id="notifSideBar">
                    <div class="offcanvas-header">
                        <h3 class="offcanvas-title notifSideBarTitle ps-3">Notifications</h3>
                        <button data-bs-dismiss="offcanvas" class="btn-close btn-close-white"></button>
                    </div>
                    <div class="offcanvas-body">
                        <?php
                            //Notifications Admin
                            if($role == "admin")
                            {
                                if($nbPrsansMat["nb"] > 0)
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Vous avez <span class='fw-bold px-1'>" . $nbPrsansMat["nb"] ."</span> Professeurs affectés(es) à aucune matière</h6>";
                                }else
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Aucune action n'est requise de votre part pour les professeurs sans matière</h6>";
                                }
                                if($nbPrsansProfil["nb"] > 0)
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Vous avez <span class='fw-bold px-1'>" . $nbPrsansProfil["nb"] ."</span> Professeurs sans profil</h6>";
                                }else
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Aucune action n'est requise de votre part pour les professeurs sans profil</h6>";
                                }
                                if($nbEtsansClasse["nb"] > 0)
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Vous avez <span class='fw-bold px-1'>" . $nbEtsansClasse["nb"] ."</span> Étudiants(es) non intégrés(es) aux classes</h6>";
                                }else
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Tous les étudiants sont affectés aux classes</h6>";
                                }
                                if($nbEtsansProfil["nb"] > 0)
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Vous avez <span class='fw-bold px-1'>" . $nbEtsansProfil["nb"] ."</span> Étudiants(es) sans profil</h6>";
                                }else
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Aucune action n'est requise (Tous les étudiants possèdent des profils)</h6>";
                                }
                            }
                            //Notifications Professeur
                            if($role == "professeur")
                            {
                                echo "<h6 class='text-white alert fw-light'>- Votre matière principale est : <span class='fw-bold px-1'>" . $matiere["nomMat"] ."</span>.</h6>";
                                while($devoirs = $sqlRes->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Ce devoir : <span class='fw-bold px-1'>" . $devoirs["idDev"]. " - ". $devoirs["titreDev"] ."</span> sera clôturé prochainement.</h6>";
                                }
                            }
                            //Notifications Admin
                            if($role == "etudiant")
                            {
                                while($devoirs = $sqlDevRes->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<h6 class='text-white alert fw-light'>- Vous devez remettre <span class='fw-bold px-1'>" . $devoirs["idDev"]. " - ". $devoirs["titreDev"] ."</span> avant le <span class='fw-bold text-danger px-1'>".$devoirs["dateEcheance"]."</span>.</h6>";
                                }  
                            }
                        ?>
                    </div>

                </div>

                <span id="notifications" class="notifications mt-2" data-bs-toggle="offcanvas" data-bs-target="#notifSideBar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#eec6ff" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg>
                </span>

                <span class="deconnexion mt-2">
                <a href="deconnexion.php"><svg xmlns="http://www.w3.org/2000/svg" fill="#eec6ff" width="20" height="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                </a></span>
            </div>

        </section>
    </header>