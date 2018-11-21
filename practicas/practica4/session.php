<?php

    session_start();

    if (isset($_SESSION['username'])) {
        $logged = true;
        $username = $_SESSION['username'];
        $admin = $_SESSION]['admin'];

    }else{
        $logged = false;
    }

?>
