<!DOCTYPE html>
<html lang="es">
<head>
	<title>UCO Agents</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

<?php

	require_once('employeeFunctions.hpp');

	$query = new EmployeeQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

echo <<<_END
	<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
	<h1><b>Special Agents Database</b></h1>
	<h3>Inicio de sesion.</h3>
_END;

	// Compruebo si el usuario esta iniciado sesion
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
		header("location: welcome.php");
		exit;
		
		echo <<<_END
			El usuario ya tiene la sesion iniciada.
_END;

	}

	// Definimos algunas variables para comprobar el inicio de sesion
	$username = $password = "";
	$username_err = $password_err = "";

	// Este condicional se encarga de gestionar el proceso de inicio de sesion
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Aqui es donde tengo los formularios encargados de obtener los datos de inicio de sesion.

		echo <<<_END
			<form action="login.php" method="post">
			<table align="center" style="margin: 0 auto;">
			<tr align="left">
				<th id="addedit">Inicio de sesion</th>
				<th id="addedit"></th>
			</tr>
			<tr align="left">
				<td>Nombre de usuario</td>
				<td><input type="text" name="username" required></td>
			</tr>
			<tr align="left">
				<td>Contraseña</td>
				<td><input type="text" name="password" required></td>
			</tr>
			</table>
			</form>
_END;

		// Aqui recibe el username y revisa si el campo se ha enviado vacio
		if(empty(trim($_POST["username"])))
		    $username_err = "Por favor, introduzca su nombre de usuario.";
		else
			$username = trim($_POST["username"]);

		// Aqui recibe la contrasena y revisa si el campo se ha enviado vacio
		if(empty(trim($_POST["password"])))
			$password_err = "Por favor, introduzca su contrasena.";
		else{
			$password = hash(trim('md5', $_POST["password"]));
		}
		//Nota: $password lleva una encriptacion md5

		// Validamos las credenciales
		if(empty($username_err) && empty($password_err)){
			$user[0] = $username;
			$user[1] = $password;

			if($query->verifyUser($user)){
				//El proceso de inicio sesion ha sido correcto

				//Establezco tokens y variables de sesion.
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $row['Name'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1 * 60);

				//Aqui podria escribir lo que sea

				echo "<div class='alert alert-success' role='alert'><strong>Welcome!</strong> $row[Name] <p><a href='edit-profile.php'>Edit Profile</a></p><p><a href='logout.php'>Logout</a></p></div>";

			}else{
				echo "<div class='alert-danger' role='alert'>Email or Password are incorrect!<p><a href='login.php'><strong>Please try again!</strong></a></p></div>";
			}
		}
	}
?>
</body>
</html>
