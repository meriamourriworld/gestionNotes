<?php
    session_start();

    session_unset();
    setcookie('currentUser', "", time() - 3600);
    setcookie('idMat', "", time() + (86400 * 30), "/");
    session_destroy();
    header("location:connection.php");

?>