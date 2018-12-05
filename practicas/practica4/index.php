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
	/* Incluyo las funciones de consulta de la base de datos */
	require_once('employeefunctions.php');


	$query = new EmployeeQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	if (isset($_SESSION['expire']) && time() >= $_SESSION['expire']) {
		session_destroy();
		echo "<h3 align='center'>Su sesión ha caducado. Volviendo a la página principal.</h3><br/>";
	    header("refresh: 5; http://localhost:80/index.php");
		exit();
	}

	/* Obtengo el listado de empleados */
echo <<<_END
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
		<h3 allign='center'>Lista de agentes</h3>
_END;
	if (LOGGED && ADMIN) {
		echo "<h5 allign='center'><a href='addemployee.php'>Añadir agente</a></h5>";
	}
echo <<<_END
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
_END;
		if (LOGGED) {
			echo "<td><a href='employee.php?employee=$employee[ID]'><img id='icono' src='./pics/info.png' alt='Info'></a>";
			if (ADMIN) {
			echo <<<_END
				<a href="editarEmployee.php?employee=$employee[ID]"><img id="icono" src="./pics/edit.png" alt="Editar"></a>
				<a href="borrarEmployee.php?employee=$employee[ID]"><img id="icono" src="./pics/delete.png" alt="Borrar"></a>
_END;
			}
			echo "</td>";
		}else{
			echo <<<_END
			<td>Inicia sesión para ver las opciones</td>
_END;
		}
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
