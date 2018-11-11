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

	//Obtengo el ultimo valor de ID de la base de datos
	$result = mysql_query("SELECT max(ID) FROM EMPLOYEE");
	//Compruebo si hubiera algun fallo en la obtencion
	if (!$result) {
    	die('No ha podido obtenerse el ID maximo:' . mysql_error());
	}

	//**A TENER EN CUENTA** -> Por si diera fallo, habria que descomentar esto (cosas de stackOverflow)
	//$newID = mysql_result($result, 0, 'ID');

echo <<<_END
	<body>
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>
		<h3>Creacion de un nuevo miembro</h3>
		<form>
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
_END
			for ($i=16; $i < 100; $i++) { 
				echo "<option value="$i">$i</option>";
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

	$agent['username'] = $_POST['username'];
	$agent['nick'] = $_POST['nick'];
	$agent['gender'] = $_POST['gender'];
	$agent['contactInfo'] = $_POST['contactInfo'];
	$agent['edad'] = $_POST['edad'];
	$agent['photo'] = $_POST['photo'];


	//Compruebo que se ha introducido todo
	if(isset($_POST['username']) &&
		isset($_POST['nick']) &&
		isset($_POST['gender']) &&
		isset($_POST['contactInfo']) &&
		isset($_POST['edad']) &&
		isset($_POST['speciality'])){
			
			//Con que se introduzca uno de ellos valdra.
			//**A TENER EN CUENTA** -> Hay que ver como metemos las especialidades! (deberia de ser alguna clase de vector o array)
			$sql = "INSERT INTO EMPLOYEE (ID, NOMBRE, NICK, EDAD, SEXO, ESPECIALIDAD, CONTACTO) VALUES ($newID, $name, $nick, $age, $gender, $specialty, $contactInfo)";
	
			if ($conn->query($sql) == TRUE) {
		    	echo "Se ha introducido correctamente al agente,";
			} else {
	    	echo "Ha habido un error introduciendo al agente: " . $conn->error;
			}

		}else{
				//No se ha introducido ningun apartado de especialidad
				echo "Hay que rellenar todos los apartados!";
		}
	}else{
			//No se ha introducido alguno de los apartados
			echo "Hay que rellenar todos los apartados!";
	}

?>

</body>
</html>
