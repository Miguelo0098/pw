<?php
	require_once('session.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>TEAMOJA Enterprise</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

<?php
	//Declaro variables
	$ID = $_GET["employee"];

	require_once('employeefunctions.php');

	$query = new EmployeeQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */

	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	if (isset($_SESSION['expire']) && time() >= $_SESSION['expire']){
		session_destroy();
		echo "<h3 align='center'>Su sesión ha caducado. Volviendo a la página principal.</h3><br/>";
	    header("refresh: 3; http://localhost:80/index.php");
		exit();
	}

	/* Crea un nuevo objeto para llamar a las consultas */

	$databaseUser = $query->getEmployee($ID);

echo <<<_END
		<body>
			<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
			<div id='login'>
			<h1><b>Special Agents Database</b></h1>
_END;
		if (LOGGED) {
			echo "<h5 align='right'>Bienvenido ".USERNAME." | <a href='logout.php'>Cerrar Sesión</a></h5>";
		}else{
			echo "<h5 align='right'><a href='login.php'>Iniciar Sesión | Registrarse</a></h5>";
		}

	echo <<<_END
			</div>
			<h3>Agente nº $databaseUser[ID]</h3>
			<table align='center'>
				<tr align='center'>
					<th>Foto</th>
					<th>Nickname</th>
					<th>Nombre</th>
					<th>Sexo</th>
					<th>Edad</th>
					<th>Especialidad</th>
					<th>Sueldo</th>
					<th>Contacto</th>
				</tr>
				<tr allign='center'>
					<td><img id="profilepic" src="./pics/$databaseUser[PHOTO]" alt="$databaseUser[PHOTO]"></td>
					<td>$databaseUser[NICK]</td>
					<td>$databaseUser[NOMBRE]</td>
					<td>$databaseUser[SEXO]</td>
					<td>$databaseUser[EDAD]</td>
					<td>$databaseUser[ESPECIALIDAD]</th>
					<td>$databaseUser[SUELDO]</th>
					<td><a href="https://webmail.uco.es/horde/imp/compose.php?to=$databaseUser[CONTACTO]&uniq=1540292184179" target="_blank">$databaseUser[CONTACTO]</td>
			</table>
			<a id="back" href="./index.php">Atrás</a>
  		<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
		</body>
_END;


	?>

</body>
</html>
