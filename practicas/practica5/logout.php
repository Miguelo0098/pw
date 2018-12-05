<?php
    require_once('session.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>UCO Agents</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<?php
    session_destroy();
    echo "<h3 align='center'>Cerrando sesión... Volviendo a la página principal.</h3><br/>";
    header("refresh: 5; http://localhost:80/index.php");
    exit();
 ?>
</body>
</html>
