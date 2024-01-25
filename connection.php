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
        $error = "Une erreur est survenue " . $e->getMessage();
        header("location:errorPage.php?msg=$error");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Connectez-vous</title>
</head>
<body class="container-100">

    <main class="">
        <div class="mainConnection row mx-auto d-flex justify-content-around align-items-center">
            <div class="wallLogin col-md-7 d-md-block d-none"></div>
            <div class="formLogin col-md-5 col-sm-12 d-flex flex-column justify-content-center align-items-center text-white">
                <div class="logo text-center">
                    <h1 class="display-4">Madrasati</h1>
                    <h6>Votre succès est Notre affaire</h6>
                </div>
                <form class="mt-5 w-100" action="connection.php" method="post">
                    <label for="login" class="form-label mt-4">Identifiant :</label>
                    <input type="text" class="form-control p-3" name="login" id="login" required>

                    <label for="pass" class="form-label mt-4">Mot de passe :</label>
                    <input type="password" class="form-control p-3" name="pass" id="pass" required>

                    <input type="submit" value="Se connecter" class="btn btn-reg w-100 mt-4 p-3 text-white">
                </form>
            </div>
        </div>
    </main>
</body>
</html>