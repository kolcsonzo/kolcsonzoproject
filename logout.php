<?php
    session_start();
    //Session lebontása
    if(session_destroy()) {
        // Vissza a loginhoz
        header("Location: login.php");
    }
?>
