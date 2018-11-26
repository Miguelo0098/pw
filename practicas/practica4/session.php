<?php

    session_start();

    if (isset($_SESSION['name'])) {
        define("LOGGED", true);
        define("USERNAME", $_SESSION['name']);
        define("ADMIN", $_SESSION['admin']);

    }else{
        define("LOGGED", false);
    }


?>
