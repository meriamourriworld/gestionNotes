<?php
    session_start();

    session_unset();
    setcookie('currentUser', "", time() - 3600);
    session_destroy();
    header("location:connection.php");

?>