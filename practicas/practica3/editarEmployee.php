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
	$ID = $_GET["employee"];

	require_once('employeefunctions.php');
	$query = new EmployeeQueries();

	// Comprueba que se ha realizado bien la conexion a la base de datos

	if(empty($query->dbc)){
		echo "<h3 align='center'>Ha habido un problema al conectar con la base de datos. Por favor, vuelva mas tarde. </h3></br>";
		die();
	}

	// Crea un nuevo objeto para llamar a las consultas
	$databaseUser = $query->getEmployee($ID);

	//**A TENER EN CUENTA** -> Hay que ver como poner en opciones que no sean bloques de texto, la previsualizacion del valor anterior al cambio
echo <<<_END
	<body>
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>
		<h3>Creacion de un nuevo miembro</h3>
		<form>
			Name (encrypted):<br>
			<input type="text" name="username"><br>

			<br>Nick:<br>
			<input type="text" name="nick"><br>	

			<br>Sexo:<br>
			<input type="radio" name="gender" value="male"> Hombre<br>
			<input type="radio" name="gender" value="female"> Mujer<br>
			<input type="radio" name="gender" value="other"> Otro<br>

			<br>Especialidad:<br>
			<input type="checkbox" name="specialty1" value=""> Sigiloso<br>
			<input type="checkbox" name="specialty2" value=""> Suertudo<br>
			<input type="checkbox" name="specialty3" value=""> Rico<br>
			<input type="checkbox" name="specialty4" value=""> Persuasivo<br>
			<input type="checkbox" name="specialty5" value=""> Agil<br>
			<input type="checkbox" name="specialty6" value=""> Inteligente <br>
	
			<br>Direccion de contacto:<br>
			<input type="text" name="contactInfo"><br>
		</form>
	<a id="back" href="./index.php">Atrás</a>
  	<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
	</body>
_END;

	//Compruebo que se ha introducido todo
	if(!isset($_POST('username')) || 
		!isset($_POST('nick')) || 
		!isset($_POST('gender')) || 
		!isset($_POST('contactInfo')) ){
		//Hasta aqui compruebo todos los apartados salvo los de especialidad
		
		if(isset($_POST('specialty1')) ||
			isset($_POST('specialty2')) ||
			isset($_POST('specialty3')) ||
			isset($_POST('specialty4')) ||
			isset($_POST('specialty5')) ||
			isset($_POST('specialty6'))){
			
			//Con que se introduzca uno de ellos valdra.
			//**A TENER EN CUENTA** -> Hay que ver como metemos las especialidades! (deberia de ser alguna clase de vector o array)
			$sql = "INSERT INTO EMPLOYEE (ID, NOMBRE, NICK, EDAD, SEXO, ESPECIALIDAD, CONTACTO) VALUES ($newID, $name, $nick, $age, $gender, $specialty, $contactInfo)"
	
			if ($conn->query($sql) == TRUE) {
		    	echo "Se ha introducido correctamente al agente,";
			} else {
	    	echo "Ha habido un error introduciendo al agente: " . $conn->error;
			}

		}else{
				//No se ha introducido ningun apartado de especialidad
				echo "Hay que rellenar todos los apartados!"
		}
	}else{
			//No se ha introducido alguno de los apartados
			echo "Hay que rellenar todos los apartados!"
	}

?>

</body>
</html>