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
	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}


echo <<<_END
	<body>
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>
		<h3>Creacion de un nuevo miembro</h3>
		<form>
			Name (encrypted):<br>
			<input type="text" name="username"><br>
			Nick:<br>
			<input type="text" name="nick"><br>	
			Sexo:<br>
			<input type="radio" name="gender" value="male"><br>
			<input type="radio" name="gender" value="female"><br>
			<input type="radio" name="gender" value="other"><br>

			Edad:<br>

			<select name='Edad'>

_END;
	
	$value = 16;
	do{
    	echo "<option value='$value'>$value</option>";
    	$value += 1; 
	} while ($value < 99);

echo <<<_END

			</select>

			Especialidad:<br>
			<input type="checkbox" name="specialty1" value=""> Sigiloso<br>
			<input type="checkbox" name="specialty2" value=""> Suertudo<br>
			<input type="checkbox" name="specialty3" value=""> Rico<br>
			<input type="checkbox" name="specialty4" value=""> Persuasivo<br>
			<input type="checkbox" name="specialty5" value=""> Agil<br>
			<input type="checkbox" name="specialty6" value=""> Inteligente <br>
	
			Direccion de contacto:<br>
			<input type="text" name="contactInfo"><br>
		</form>
	<a id="back" href="./index.php">Atrás</a>
  	<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
	</body>
_END;

	$sql = "INSERT INTO employees (ID, NOMBRE, NICK, EDAD, SEXO, ESPECIALIDAD, CONTACTO) VALUES (, $name, $nick, $age, $gender, $specialty, $contactInfo)"

	if ($conn->query($sql) == TRUE) {
    	echo "Record updated successfully";
	} else {
    	echo "Error updating record: " . $conn->error;
	}

	$conn->close();
?>

</body>
</html>