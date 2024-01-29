<?php 
    session_start();
    include_once("connectDb.php");



    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]==false || $_SESSION["role"] != "etudiant")
    {
        header("location:connection.php");
    }

    //Récupérer les stats des différents indices du système
    //NOmbre d'étudiants par classe
    $sqlStat = "select count(*) as 'nb' from etudiant where classe in (select classe from classeprof where professeur='".$_SESSION["matricule"]."');";
    $sqlStatRes = $con->query($sqlStat);
    $nbEtudiants = $sqlStatRes->fetch(PDO::FETCH_ASSOC);
    $nbEtudiants = $nbEtudiants["nb"];

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
        <!----------------------------DASHBOARD BODY-------------------------------->
        <section class="dashContent dashContentStudent">
            <article class="dashContentWrapper">
                <div class="setting">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="25" heigth="25" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                </div>
            </article>
        </section>
    </main>
  
    <script src="./scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>