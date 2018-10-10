<!DOCTYPE html>
<html lang="es">
<head>
	<title>TEAMOJA Enterprise</title>
	<meta charset="utf-8">
</head>
<body>

<?php
	//Declaro variables
	$employeeID = $_GET['employee'];
	$employeeName = $_GET['employee'];
	$employeeNick = $_GET['employee'];
	$employeeAge = $_GET['employee'];
	$employeeSpecialty = $_GET['employee'];
	$employeeContactInfo = $_GET['employee'];

	/* Incluyo las funciones de consulta de la base de datos */
	require_once('aquivaelarchivodephp.php');

	/* Crea un nuevo objeto para llamar a las consultas */
	$query = new databaseQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($q->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	/* Obtengo el listado de empleados */
echo <<<_END
	<body>
		<h1>$employeeID</h1>
		<h3>Información personal</h3>
			<ul>
				<li> Nombre (cifrado): $employeeName </li>
				<li> Nick: $employeeNick </li>
				<li> Edad: $employeeAge </li>
				<li> Especialidad: $employeeSpecialty </li>
				<li> Información de contacto: $employeeContactInfo </li>
			</ul>
  		<a id="back" href="./index.html">Atrás</a>
  		<p id="copyright">This site uses cookies to deliver our services and to show you relevant ads and job listings. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
	</body>
_END;

?>
</body>
</html>
