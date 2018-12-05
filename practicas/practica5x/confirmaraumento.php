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
	$ID = $_GET['employee'];
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

	$employee = $query->getEmployee($ID);

	if (isset($_POST['confirmar'])){

    	//Check if cancel button has been selected
        $check = true;

        //Get the new agent values
        $agent[0] = $ID;
        $agent[1] = 0;
        $agent[2] = $employee['DESEADO'];


        if($check){
            $status = $query->changeSalary($agent);

            //If correctly added, go to books page
            if($status)
                header('Location: /index.php');
            else
                echo "<h3 align='center' style='color: red'>An error ocurred. Please try again.</h3><br>";
        }else
            echo "<h3 align='center' style='color: red'>Please check the fields and try again.</h3><br>";

	}else if(isset($_POST['rechazar'])){
		//Check if cancel button has been selected
        $check = true;

        //Get the new agent values
        $agent[0] = $ID;
        $agent[1] = 0;
        $agent[2] = $employee['SUELDO'];


        if($check){
            $status = $query->changeSalary($agent);

            //If correctly added, go to books page
            if($status)
                header('Location: /index.php');
            else
                echo "<h3 align='center' style='color: red'>An error ocurred. Please try again.</h3><br>";
        }else
            echo "<h3 align='center' style='color: red'>Please check the fields and try again.</h3><br>";
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
		<h3>Solicitud de aumento</h3>
		<form action="confirmaraumento.php?employee=$ID" method="post">
		<table align="center" style="margin: 0 auto;">
		<tr align="left">
			<th id="addedit">Solicitud</th>
			<th id="addedit"></th>
		</tr>
		<tr align='left'>
			<td>Empleado</td>
			<td>$employee[NICK]</td>
		</tr>
		<tr align='left'>
			<td>Salario Solicitado</td>
			<td>$employee[DESEADO]</td>
		</tr>
		<tr align="left">
			<td><input type="submit" name="confirmar" value="Confirmar"></td>
			<td><input type="submit" name="rechazar" value="Rechazar"></td>
		</tr>
		</table>
		</form>
	<a id="back" href="./index.php">Atrás</a>
  	<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>

_END;

?>

</body>
</html>
