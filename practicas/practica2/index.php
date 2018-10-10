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

	/* Crea un nuevo objeto para llamar a las consultas */
	$query = new databaseQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($q->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	/* Obtengo el listado de empleados */
echo <<<_END
	<h1><b>TeaMoja Enterprise Employee Database</b></h1>
	<p class="warning"><b>WARNING</b>: Esta página contiene información de<br><b>ALTO SECRETO</b> y su difusión está penada con<br><b>CADENA PERPÉTUA</b>.</p>

	<div>
		<h3>Lista de empleados</h3>
_END;
	$employees = $query->getEmployees();
	for each($employees as $employee){
		echo <<<_END
			<ul>
				<li><a href="./$employee.html">$employee</a></li>

			<li><a class="missing" href="./employee105.html"><del>Empleado 105</del></a></li>
		</ul>
	</div>

	<p id="copyright">This site uses cookies to deliver our services and to show you relevant ads and job listings. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
_END;

?>
</body>
</html>
