<!DOCTYPE html>
<html lang="es">
<head>
	<title>TEAMOJA Enterprise</title>
	<meta charset="utf-8">
</head>
<body>

<?php
	/* Incluyo las funciones de consulta de la base de datos */
	require_once('employeefunctions.php');

	$query = new EmployeeQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	/* Obtengo el listado de empleados */
echo <<<_END
		<h1><b>TeaMoja Enterprise Employee Database</b></h1>

		<h3 allign='center'>Lista de empleados</h3>
		<table align='center'>
			<tr align='center'>
				<th>ID</th>
				<th>NICK</th>
_END;

	$employees = $query->getAllEmployees();
	foreach($employees as $employee) {
		echo <<<_END
			<tr allign='center'>
				<td>$employee[ID]</td>
				<td>$employee[NICK]</td>
_END;
	}
	echo <<<_END
		</table>
_END;
	echo <<<_END
	<p id="copyright">This site uses cookies to deliver our services and to show you relevant ads and job listings. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
_END;

	$conn->close();

?>
</body>
</html>
