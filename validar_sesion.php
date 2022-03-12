<?php
    session_start();

    if (!($_SESSION["sesion"] == "si")) {
        header("Location: index.php");
        exit();
    }
?>