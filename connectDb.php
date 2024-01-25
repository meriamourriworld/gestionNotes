<?php
    $servername = "localhost";
    $db = "gestionnotes";
    $username = "root";
    $pass = "";

    try
    {
        $con = new PDO("mysql:host=$servername; dbname=$db;", $username, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOEXCEPTION $e)
    {
        $error = "La connexion à la base de données a échoué <br>" . $e->getMessage();
        header("location:errorPage.php?msg=$error");
    }



?>