<?php

    session_start();

    if (isset($_SESSION['username'])) {
        define("LOGGED", true);
        define("USERNAME", $_SESSION['username']);
        define("ADMIN", $_SESSION['admin']);

    }else{
        define("LOGGED", false);
    }

?>
