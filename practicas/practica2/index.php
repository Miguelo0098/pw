<!DOCTYPE html>
<html lang="es">
<head>
	<title>TEAMOJA Enterprise</title>
	<meta charset="utf-8">
</head>
<body>

<?php
	/* Incluyo las funciones de consulta de la base de datos */
	require_once('aquivaelarchivodephp.php');

	$servername = ;
	$username = ;
	$password = ;
	$dbname = ;

	$conn = new mysqli($servername, $username, $password);
	$conn->select_db($dbname);

	if ($conn->connect_error) {
	    die("Conexion fallida: " . $conn->connect_error);
	}

	$sql = "select * from Usuarios";
	$query = $conn->query($sql);

	/* Crea un nuevo objeto para llamar a las consultas */
	#$query = new databaseQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	/* Obtengo el listado de empleados */
echo <<<_END
	<h1><b>TeaMoja Enterprise Employee Database</b></h1>
	<p class="warning"><b>WARNING</b>: Esta página contiene información de<br><b>ALTO SECRETO</b> y su difusión está penada con<br><b>CADENA PERPÉTUA</b>.</p>

	<div>
		<h3>Lista de empleados</h3>
	<ul>
_END;

	while($employees = $query->getEmployees()) {
		echo' <li><a href="employee.php?q='. $employees["nombreCifrado"] .'">' . $employees["uwu"]. '</a></li>';
	}

	echo "</ul>
	</div> ";

	}
echo <<<_END
	<p id="copyright">This site uses cookies to deliver our services and to show you relevant ads and job listings. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
_END;

	$conn->close();

?>
</body>
</html>
