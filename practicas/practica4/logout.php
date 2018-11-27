<?php
    require_once('session.php');
    session_destroy();
    echo "CERRANDO SESIÓN... VOLVIENDO A LA PÁGINA PRINCIPAL";
    sleep(5);
    header("location: index.php");
    exit();
 ?>
