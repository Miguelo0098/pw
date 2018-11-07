<!DOCTYPE html>
<html lang="es">
<head>
	<title>UCO Agents</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
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
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>

		<h3 allign='center'>Lista de agentes</h3>
		<a align='center' href="memberInfo.php">
		<table align='center'>
			<tr align='center'>
				<th>Id</th>
				<th>Nickname</th>
				<th>Opciones</th>
_END;

	$employees = $query->getAllEmployees();
	foreach($employees as $employee) {
		echo <<<_END
			<tr allign='center'>
				<td>$employee[ID]</td>
				<td>$employee[NICK]</td>
				<td><a href="employee.php?employee=$employee[ID]"><img id="icono" src="./pics/info.png" alt="Info"></a>
				<a href="editaremployee.php?employee=$employee[ID]"><img id="icono" src="./pics/edit.png" alt="Editar"></a>
					<a href="borrarEmployee.php?employee=$employee[ID]"><img id="icono" src="./pics/delete.png" alt="Borrar"></a>
				</td>
_END;
	}
	echo <<<_END
		</table>
_END;
	echo <<<_END
	<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
_END;

?>
</body>
</html>
