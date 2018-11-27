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

	// Comprueba que se ha realizado bien la conexion a la base de datos

	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	if (time() >= $_SESSION['expire']) {
		session_destroy();
	}

	// Crea un nuevo objeto para llamar a las consultas
	$databaseUser = $query->getEmployee($ID);

echo <<<_END
		<body>
			<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
			<h1 id='login'><b>Special Agents Database</b></h1>
			<h3>Agente nº $databaseUser[ID]</h3>
			<table align='center'>
				<tr align='center'>
					<th>Foto</th>
					<th>Nickname</th>
					<th>Nombre</th>
					<th>Sexo</th>
					<th>Edad</th>
					<th>Especialidad</th>
					<th>Contacto</th>
				</tr>
				<tr allign='center'>
					<td><img id="profilepic" src="$databaseUser[PHOTO]" alt="$databaseUser[PHOTO]"></td>
					<td>$databaseUser[NICK]</td>
					<td>$databaseUser[NOMBRE]</td>
					<td>$databaseUser[SEXO]</td>
					<td>$databaseUser[EDAD]</td>
					<td>$databaseUser[ESPECIALIDAD]</th>
					<td><a href="https://webmail.uco.es/horde/imp/compose.php?to=$databaseUser[CONTACTO]&uniq=1540292184179" target="_blank">$databaseUser[CONTACTO]</td>
			</table>

			<br>
			<h5>Esta seguro de que desea borrar este agente?</h5>
			<form action="" method="POST">
				<input type="submit" name="eraseSelection" value="Confirmar" />
			</form>
			<br>
			<h3><a id="back" href="./index.php">Atrás</a></h3>
  		<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
		</body>
_END;

	if(isset($_POST["eraseSelection"]))
		$query->deleteEmployee($ID);
<<<<<<< HEAD

	}
=======
	
>>>>>>> 20f81f153b92199cce309f9fcc7c2d2aac36d2e1
?>

</body>
</html>
