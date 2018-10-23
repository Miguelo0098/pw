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

	/* Crea un nuevo objeto para llamar a las consultas */

	$databaseUser = $query->getEmployee($ID);
	echo <<<_END
		<body>
				<h1>Agente nº $databaseUser[ID]</h1>
					<ul>
   						<li> Nombre (cifrado): $databaseUser[NOMBRE_CIFRADO]</li>
   						<li> Nick: $databaseUser[NICK]</li>
						<li> Edad: $databaseUser[EDAD]</li>
						<li> Especialidad: $databaseUser[ESPECIALIDAD]</li>
						<li> Información de contacto: $databaseUser[CONTACTO]</li>
					</ul>
  		<a id="back" href="./index.php">Atrás</a>
  		<p id="cookies">This site uses cookies to deliver our services and to show you relevant ads and job listings. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
	</body>
_END;
echo <<<_END
		<body>
			<h1>Agente nº $databaseUser[ID]</h1>
			<table align='center'>
				<tr align='center'>
					<th>Foto</th>
					<th>Id</th>
					<th>Nickname</th>
					<th>Nombre cifrado</th>
					<th>Edad</th>
					<th>Contacto</th>
				<tr allign='center'>

_END;


	?>

</body>
</html>
