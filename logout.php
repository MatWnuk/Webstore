<?php
    session_start();

    $_SESSION["email"] = "";
    $_SESSION["name"] = "";
    $_SESSION["loggedin"] = false;

    session_destroy();

    header("Location: index.php");
    exit;
?>
