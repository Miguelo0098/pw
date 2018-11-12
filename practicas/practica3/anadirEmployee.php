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
	require_once('employeefunctions.php');
	$query = new EmployeeQueries();
	// Comprueba que se ha realizado bien la conexion a la base de datos
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	if(isset($_POST['addagent'])){
		$newid = $query->maxIdEmployee();
		$agent[0] = $newid + 1;
		$agent[1] = isset($_POST['username']);
		$agent[2] = isset($_POST['nick']);
		$agent[3] = isset($_POST['gender']);
		$agent[7] = isset($_POST['contactInfo']);
		$agent[4] = isset($_POST['edad']);
		$agent[5] = isset($_POST['photo']);
		$agent[6] = isset($_POST['speciality']);
		$query->addEmployee($agent);
	}
	


echo <<<_END
	<body>
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>
		<h3>Creacion de un nuevo miembro</h3>
		<form action="index.php" method="POST">
			Name (encrypted):<br>
			<input type="text" name="username" required><br>

			<br>Nick:<br>
			<input type="text" name="nick" required><br>	

			<br>Sexo:<br>
			<input type="radio" name="gender" value="male"> Hombre<br>
			<input type="radio" name="gender" value="female"> Mujer<br>
			<input type="radio" name="gender" value="other"> Otro<br>
			<br>Edad:<br>
			<select name="edad">
_END;
			for ($i=16; $i < 100; $i++) { 
				echo "<option value='$i'>$i</option>";
			}
echo <<<_END
			</select>
			<br>Especialidad:<br>
			<input type="checkbox" name="specialty" value="Sigiloso" checked> Sigiloso<br>
			<input type="checkbox" name="specialty" value="Suertudo"> Suertudo<br>
			<input type="checkbox" name="specialty" value="Rico"> Rico<br>
			<input type="checkbox" name="specialty" value="Persuasivo"> Persuasivo<br>
			<input type="checkbox" name="specialty" value="Agil"> Agil<br>
			<input type="checkbox" name="specialty" value="Inteligente"> Inteligente <br>
			
			<br>Foto<br>
			<input type="text" name="photo"><br>
			<br>Direccion de contacto:<br>
			<input type="text" name="contactInfo" required><br>
			<br>
			<input type="submit" name="addagent" value="Añadir">
		</form>
	<a id="back" href="./index.php">Atrás</a>
  	<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
	</body>
_END;


	//Compruebo que se ha introducido todo
	

?>

</body>
</html>
