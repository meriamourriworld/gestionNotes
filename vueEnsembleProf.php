<?php 
    session_start();
    include_once("connectDb.php");



    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]==false || $_SESSION["role"] != "professeur")
    {
        header("location:connection.php");
    }

    
    $nbEtudiants = 0;
    $nbClasses = 0;


    //Récupérer les stats des différents indices du système
    //NOmbre d'étudiants par classe
    $sqlStat = "select count(*) as 'nb' from etudiant where classe in (select classe from classeprof where professeur='".$_SESSION["matricule"]."');";
    $sqlStatRes = $con->query($sqlStat);
    $nbEtudiants = $sqlStatRes->fetch(PDO::FETCH_ASSOC);
    $nbEtudiants = $nbEtudiants["nb"];

    //Nombre de classes du prof
    $sqlStat = "select count(*) as 'nb' from classeprof where professeur='". $_SESSION["matricule"]."';";
    $sqlStatRes = $con->query($sqlStat);
    $nbClasses = $sqlStatRes->fetch(PDO::FETCH_ASSOC);
    $nbClasses = $nbClasses["nb"];

    //Nombre de devoir en total
    $sqlStat = "select count(*) as 'nb' from devoir where matiere in (select matiere from professeur where idProf='".$_SESSION["matricule"]."');";
    $sqlStatRes = $con->query($sqlStat);
    $nbDevoirs = $sqlStatRes->fetch(PDO::FETCH_ASSOC);
    $nbDevoirs = $nbDevoirs["nb"];


    //Liste de tous les étudiants des différentes classes attribuées au professeur
    $sqlLstEtud = "select * from etudiant where classe in (select classe from classeprof where professeur='".$_SESSION["matricule"]."') order by classe;";
    $sqlLstEtudRes = $con->query($sqlLstEtud);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Tableau de bord - Admin!</title>
</head>
<body>
    <?php include_once("header.php");?>

    <main class="dashAdmin d-flex">
        <!----------------------------SIDE MENU-------------------------------->
        <section class="sideMenu d-flex justify-content-center align-items-start">
            <div class="sideMenuWrapper d-flex flex-column justify-content-around align-items-start mt-5">
            
                <div class="menu">
                    <span class="icone pe-3"><svg xmlns="http://www.w3.org/2000/svg" fill="#eec6ff" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M384 96V224H256V96H384zm0 192V416H256V288H384zM192 224H64V96H192V224zM64 288H192V416H64V288zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg></span>
                    <span class="menuText"><a class="text-decoration-none text-white" href="vueEnsembleProf.php">Vue Ensemble</a></span>
                </div>

                <div class="menu">
                    <span class="icone pe-3"><svg xmlns="http://www.w3.org/2000/svg" fill="#eec6ff" width="20" height="20" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM128 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM80 432c0-44.2 35.8-80 80-80h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16z"/></svg></span>
                    <span class="menuText text-white">Profil</span>
                </div>

                <div class="menu">
                    <span class="icone pe-3"><svg xmlns="http://www.w3.org/2000/svg" fill="#eec6ff" width="20" height="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M144 160A80 80 0 1 0 144 0a80 80 0 1 0 0 160zm368 0A80 80 0 1 0 512 0a80 80 0 1 0 0 160zM0 298.7C0 310.4 9.6 320 21.3 320H234.7c.2 0 .4 0 .7 0c-26.6-23.5-43.3-57.8-43.3-96c0-7.6 .7-15 1.9-22.3c-13.6-6.3-28.7-9.7-44.6-9.7H106.7C47.8 192 0 239.8 0 298.7zM320 320c24 0 45.9-8.8 62.7-23.3c2.5-3.7 5.2-7.3 8-10.7c2.7-3.3 5.7-6.1 9-8.3C410 262.3 416 243.9 416 224c0-53-43-96-96-96s-96 43-96 96s43 96 96 96zm65.4 60.2c-10.3-5.9-18.1-16.2-20.8-28.2H261.3C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7H455.2c-2.1-5.2-3.2-10.9-3.2-16.4v-3c-1.3-.7-2.7-1.5-4-2.3l-2.6 1.5c-16.8 9.7-40.5 8-54.7-9.7c-4.5-5.6-8.6-11.5-12.4-17.6l-.1-.2-.1-.2-2.4-4.1-.1-.2-.1-.2c-3.4-6.2-6.4-12.6-9-19.3c-8.2-21.2 2.2-42.6 19-52.3l2.7-1.5c0-.8 0-1.5 0-2.3s0-1.5 0-2.3l-2.7-1.5zM533.3 192H490.7c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 17.4-3.5 33.9-9.7 49c2.5 .9 4.9 2 7.1 3.3l2.6 1.5c1.3-.8 2.6-1.6 4-2.3v-3c0-19.4 13.3-39.1 35.8-42.6c7.9-1.2 16-1.9 24.2-1.9s16.3 .6 24.2 1.9c22.5 3.5 35.8 23.2 35.8 42.6v3c1.3 .7 2.7 1.5 4 2.3l2.6-1.5c16.8-9.7 40.5-8 54.7 9.7c2.3 2.8 4.5 5.8 6.6 8.7c-2.1-57.1-49-102.7-106.6-102.7zm91.3 163.9c6.3-3.6 9.5-11.1 6.8-18c-2.1-5.5-4.6-10.8-7.4-15.9l-2.3-4c-3.1-5.1-6.5-9.9-10.2-14.5c-4.6-5.7-12.7-6.7-19-3l-2.9 1.7c-9.2 5.3-20.4 4-29.6-1.3s-16.1-14.5-16.1-25.1v-3.4c0-7.3-4.9-13.8-12.1-14.9c-6.5-1-13.1-1.5-19.9-1.5s-13.4 .5-19.9 1.5c-7.2 1.1-12.1 7.6-12.1 14.9v3.4c0 10.6-6.9 19.8-16.1 25.1s-20.4 6.6-29.6 1.3l-2.9-1.7c-6.3-3.6-14.4-2.6-19 3c-3.7 4.6-7.1 9.5-10.2 14.6l-2.3 3.9c-2.8 5.1-5.3 10.4-7.4 15.9c-2.6 6.8 .5 14.3 6.8 17.9l2.9 1.7c9.2 5.3 13.7 15.8 13.7 26.4s-4.5 21.1-13.7 26.4l-3 1.7c-6.3 3.6-9.5 11.1-6.8 17.9c2.1 5.5 4.6 10.7 7.4 15.8l2.4 4.1c3 5.1 6.4 9.9 10.1 14.5c4.6 5.7 12.7 6.7 19 3l2.9-1.7c9.2-5.3 20.4-4 29.6 1.3s16.1 14.5 16.1 25.1v3.4c0 7.3 4.9 13.8 12.1 14.9c6.5 1 13.1 1.5 19.9 1.5s13.4-.5 19.9-1.5c7.2-1.1 12.1-7.6 12.1-14.9v-3.4c0-10.6 6.9-19.8 16.1-25.1s20.4-6.6 29.6-1.3l2.9 1.7c6.3 3.6 14.4 2.6 19-3c3.7-4.6 7.1-9.4 10.1-14.5l2.4-4.2c2.8-5.1 5.3-10.3 7.4-15.8c2.6-6.8-.5-14.3-6.8-17.9l-3-1.7c-9.2-5.3-13.7-15.8-13.7-26.4s4.5-21.1 13.7-26.4l3-1.7zM472 384a40 40 0 1 1 80 0 40 40 0 1 1 -80 0z"/></svg></span>
                    <span class="menuText text-white">Gestion Devoirs</span>
                </div>


                <div class="menu">
                    <span class="icone pe-3"><svg xmlns="http://www.w3.org/2000/svg" fill="#eec6ff" width="20" height="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg></span>
                    <span class="menuText text-white">Gestion Notes</span>
                </div>
            </div>
        </section>

        <!----------------------------DASHBOARD BODY-------------------------------->
        <section class="dashContent">
            <article class="stats d-flex justify-content-around  mt-3 text-white">
                <div class="boxPr p-3 col-3 bg-success">
                    <h6>Étudiants</h6>
                    <h3><?php echo $nbEtudiants ."<span class='fs-6 fw-lighter text-white-50 ps-2'>  en cours</span>";?></h3>
                </div>
                <div class="boxPr p-3 col-4 bg-success">
                    <h6>Devoirs</h6>
                    <h3><?php echo $nbDevoirs ."<span class='fs-6 fw-lighter text-white-50 ps-2'>  en cours</span>";?></h3>
                </div>
                <div class="boxPr p-3 col-3 bg-success">
                    <h6>Classes</h6>
                    <h3><?php echo $nbClasses ."<span class='fs-6 fw-lighter text-white-50 ps-2'>  en cours</span>";?></h3>
                </div>
            </article>


            <article class="lstEtudWrapper d-flex justify-content-center mt-5">

                <table class="text-center mt-5" id="lstEtudiants" >
                    <thead class="entete">
                        <tr class="text-light">
                            <td>Cne</td>
                            <td>Nom</td>
                            <td>Prénom</td>
                            <td>E-mail</td>
                            <td>Téléphone</td>
                            <td>Photo</td>
                            <td>Profil</td>
                            <td>Classe</td>
                        </tr>
                    </thead>

                    <tbody class="fs-6">
                        <?php
                            if($sqlLstEtudRes->rowcount() > 0)
                            {
                                while($etudiants = $sqlLstEtudRes->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo "<tr>";
                                        echo "<td>".$etudiants["cne"]."</td>";
                                        echo "<td>".$etudiants['nomEtud']."</td>";
                                        echo "<td>".$etudiants['prenomEtud']."</td>";
                                        echo "<td>".$etudiants['mailEtud']."</td>";
                                        echo "<td>".$etudiants['telEtud']."</td>";
                                        echo "<td>".$etudiants['photoEtud']."</td>";
                                        echo "<td>".$etudiants['profil']."</td>";
                                        echo "<td>".$etudiants['classe']."</td>";
                                    echo "</tr>";
                                }
                            }else
                            {
                                echo "<tr>";
                                echo "<td colspan=8>Vous n'avez pas encore reçu la liste des étudiants</td>";
                                echo "</tr>";

                            }

                        ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>
  
    <script src="./scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>