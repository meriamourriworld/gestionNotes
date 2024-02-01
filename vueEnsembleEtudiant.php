<?php 
    session_start();
    include_once("connectDb.php");


    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]==false || $_SESSION["role"] != "etudiant")
    {
        header("location:connection.php");
    }

    //Récupérer les infos personnalisées pour l'étudiant

    //liste des matières enseignées à l'étudiant
    $sql = "select idMat, nomMat
                from matiere m, professeur p, classeprof cp, etudiant e
                WHERE m.idMat = p.matiere 
                and p.idProf = cp.professeur
                and cp.classe = e.classe
                and e.cne = '". $_SESSION["matricule"]."';";
    $sqlRes = $con->query($sql);
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $newPass = password_hash($_POST["mp"], PASSWORD_DEFAULT);
        $sql = "update utilisateur set motPasse='". $newPass . "' where identifiant='" . $_SESSION["username"] . "';";
        $con->exec($sql);
        header("location:connection.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Tableau de bord - <?php echo $_SESSION["username"]; ?>!</title>
</head>
<body class="dashStudent">
    <?php include_once("header.php");?>

    <main class="dashAdmin  d-flex">
        <div class="setting">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="25" heigth="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
        </div>
        <div class="settingWindow display">
            <!-- PROFILE SETTINGS -->
            <article class="profileWrapper  mx-auto mt-5 col-10">
                <form class="d-flex flex-column" action="profil.php" method="post">
                    <label class="pt-3 pb-2 px-2 text-white" for="identidiant">Identifiant: </label>
                    <input class="p-3" type="text" name="identifiant" id="identifiant"  value="<?php echo $_SESSION['username'];?>" disabled>
                    <label class="pt-3 pb-2 px-2 text-white" for="mp">Nouveau Mot de Passe: </label>
                    <input class="p-3" type="password" name="mp" id="mp" required>
                    <input class="btn btn-reg text-white p-3 mt-3" type="submit" value="Confirmer">
                </form>
           </article>
        </div>
        <!----------------------------DASHBOARD BODY-------------------------------->
        <section class="dashContent dashContentStudent mt5 d-flex justify-content-around align-items-top">

            <article class="dashContentWrapper mt-5 d-flex justify-content-around align-items-top row">
                <div class="matieres p-2 col-8">
                    <div class="msgTitleWrapper"><h4 class="matieresTitle py-3 ps-3 ">Matières</h4></div>
                    <!--Liste des matières -->
                   
                            <?php
                                if($sqlRes->rowcount() >0)
                                {
                                    while($matiere = $sqlRes->fetch(PDO::FETCH_ASSOC))
                                    {
                    
                                        echo "<div class='detailsMatiere mt-3 py-2 px-5 border-bottom-secondary d-flex justify-content-between align-items-center'>";
                                            echo "<div>";
                                                echo "<h5 class='title'>".$matiere['nomMat']."</h5>";
                                                echo "<h6>".$matiere['idMat']."</h6>";
                                                echo "<p>Vous suivez ce cours</p>";
                                            echo "</div>";
                                            echo "<div class='matiereHoraire'>";
                                                echo "<svg data-v-768d5266='' width='1.5em' height='1.5em' xmlns='http://www.w3.org/2000/svg' viewBox='-1 -1 26 26' data-svg-id='mpo-svg-calendrier' aria-hidden='true' class='m-svg mpo-bouton-icone__svg'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-miterlimit='2.0308'><line x1='16.8' y1='10.1' x2='19.7' y2='10.1'></line><line x1='10.5' y1='10.1' x2='13.5' y2='10.1'></line><line x1='4.3' y1='10.1' x2='7.2' y2='10.1'></line><line x1='16.8' y1='14.1' x2='19.7' y2='14.1'></line><line x1='10.5' y1='14.1' x2='13.5' y2='14.1'></line><line x1='4.3' y1='14.1' x2='7.2' y2='14.1'></line><line x1='16.8' y1='18.2' x2='19.7' y2='18.2'></line><line x1='10.5' y1='18.2' x2='13.5' y2='18.2'></line><line x1='4.3' y1='18.2' x2='7.2' y2='18.2'></line><line x1='0.5' y1='6.2' x2='23.5' y2='6.2'></line><path d='M1.5,1.9 c-0.6,0-1,0.4-1,1v18.2c0,0.6,0.4,1,1,1h21c0.6,0,1-0.4,1-1V2.9c0-0.6-0.4-1-1-1C22.5,1.9,1.5,1.9,1.5,1.9z'></path></g></svg>";
                                            echo "</div>";
                                            echo "<div class='matiereHoraireDetails display'>";
                                                echo "<h5>Plages Horaires</h5>";
                                                echo "<h6 class='courseCode'>".$matiere['nomMat'] ." - " . $matiere['idMat']."</h6>";
                                                echo "<p> - Tous les jeudis, de 16 h 30 à 18 h 20 </p>";
                                                echo "<p class='plagesHoraire'> - Tous les Lundis, de 09 h 00 à 12 h 00 </p>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                }else
                                {
                                    echo "<h5 class='title'>Vous n'êtes inscrit à aucune matière encore!</h5>";
                                }
                            ?>

                </div>

                <div class="messagesImportant col-3 text-center p-0">
                    <div class="msgTitleWrapper"><h4 class="messagesTitle py-3">Messages Important</h4></div>
                    <div class="lstMessages d-flex flex-column justify-content-center align-items-center">
                        <svg data-v-6021c074="" width="50px" height="50px" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 26 26" data-svg-id="streamline-archive-drawer" aria-hidden="true" class="m-svg m-empty-area__icon"><g fill="none" stroke="#868686" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5,14.5c-0.6,0-1,0.4-1,1c0,0.6-0.4,1-1,1h-7c-0.6,0-1-0.4-1-1c0-0.6-0.4-1-1-1h-5c-0.6,0-1,0.4-1,1v6c0,0.6,0.4,1,1,1h21c0.6,0,1-0.4,1-1v-6c0-0.6-0.4-1-1-1H17.5z"></path><path d="M7.5,13V2.5c0-0.6,0.4-1,1-1h11c0.6,0,1,0.4,1,1v12"></path><path d="M3.5,14.5v-10c0-0.6,0.4-1,1-1h1"></path><line x1="12.5" y1="5.5" x2="17.5" y2="5.5"></line><line x1="10.5" y1="8.5" x2="17.5" y2="8.5"></line><line x1="10.5" y1="11.5" x2="17.5" y2="11.5"></line></g></svg>
                        <p class="">Aucun nouveau message important</p>
                    </div>
                </div>
            </article>


        </section>
    </main>
  
    <script src="./scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>