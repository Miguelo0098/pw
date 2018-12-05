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

	require_once('employeefunctions.php');

	$query = new EmployeeQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	if (isset($_SESSION['expire']) && time() >= $_SESSION['expire']) {
		session_destroy();
	}

echo <<<_END
	<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
	<h1 id='login'><b>Special Agents Database</b></h1>
	<h3>Inicio de sesion | Registro</h3>
_END;

	// Compruebo si el usuario esta iniciado sesion
	if(isset($_POST['login'])) {

		// Definimos algunas variables para comprobar el inicio de sesion
		$username = $password = "";

		// Aqui recibe el username y revisa si el campo se ha enviado vacio
		if (isset($_POST['username']))
			$username = $_POST['username'];

		// Aqui recibe la contrasena y revisa si el campo se ha enviado vacio
		if (isset($_POST['password']))
			$password = hash('md5', $_POST['password']);

		//Nota: $password lleva una encriptacion md5

		// Validamos las credenciales
		$user[0] = $username;
		$user[1] = $password;

		if($query->verifyUser($user)) { //El proceso de inicio sesion ha sido correcto
			$row = $query->getUser($user);
			//Establezco tokens y variables de sesion.
			$_SESSION['loggedin'] = true;
			$_SESSION['name'] = $row[0];
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (1 * 5);
			if ($row[2] == 1) {
				$_SESSION['admin'] = true;
			}else{
				$_SESSION['admin'] = false;
			}

			//Aqui podria escribir lo que sea

			echo "<div class='alert alert-success' role='alert'><strong>Welcome!</strong> $row[Name] <p><a href='edit-profile.php'>Edit Profile</a></p><p><a href='logout.php'>Logout</a></p></div>";

		}else{
			echo "<div class='alert-danger' role='alert'>Usuario o Contraseña incorrectos<p><a href='login.php'><strong>Please try again!</strong></a></p></div>";
		}

		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
			header("location: index.php");
			exit;
		}

	}else if (isset($_POST['register'])){
		//Si no estamos iniciado sesion, estamos registrandonos

		// Definimos algunas variables para comprobar el inicio de sesion
		$username = $password = $passwordVerifier = "";


		if (isset($_POST['username']))
			$username = $_POST['username'];

		// Aqui recibe la contrasena y revisa si el campo se ha enviado vacio
		if (isset($_POST['password']))
			$password = hash('md5', $_POST['password']);

		if (isset($_POST['passwordVerifier'])) {
			$passwordVerifier = hash('md5', $_POST['passwordVerifier']);
		}

		if ($password != $passwordVerifier) {
			echo "<h3>Las contraseñas no coinciden. Inténtalo de nuevo.</h3>";
		}
		else{
			$user[0] = $username;
			$user[1] = $password;
			if ($query->addUser($user) == true) {
				echo "<h3>Registrado con éxito. Por favor inicia sesión.</h3>";
			}else{
				echo "<h3>El usuario ya existe. Inténtalo de nuevo.</h3>";
			}
		}
	}

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
			<td><input type="password" name="password" required></td>
		</tr>
		<tr align="left">
    		<td><input type="submit" name="login" value="Iniciar sesion"></td>
  		</tr>
		</table>
		</form>

		<br><br>

		<form action="login.php" method="post">
		<table align="center" style="margin: 0 auto;">
		<tr align="left">
			<th id="addedit">Registro de nuevos usuarios</th>
			<th id="addedit"></th>
		</tr>
		<tr align="left">
			<td>Nombre de usuario</td>
			<td><input type="text" name="username" required></td>
		</tr>
		<tr align="left">
			<td>Contraseña</td>
			<td><input type="password" name="password" required></td>
		</tr>
		<tr align="left">
			<td>Comprobar contraseña</td>
			<td><input type="password" name="passwordVerifier" required></td>
		</tr>
		<tr align="left">
    		<td><input type="submit" name="register" value="Registrar usuario"></td>
  		</tr>
		</table>
		</form>
		<a id="back" href="./index.php">Atrás</a>
		<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>

_END;

?>
</body>
</html>
