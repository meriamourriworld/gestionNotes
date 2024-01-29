<?php 
    $errMsg = "ERROR";

    if(isset($_GET["msg"]))
    {
        $errMsg = $_GET["msg"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Error</title>
</head>
<body>
    <main class="mainErrPage">
        <section class="errorContainer text-center">
            <h1 class="display-1">Désolé !</h1>
            <h3>Le problème sera résolu dans les plus brefs délais !</h3>
            <p class="pt-5 font-weight-bold"><?php echo $errMsg; ?></p>
        </section>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>