<?php
	require_once('session.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>TEAMOJA Enterprise</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

<?php

	$ID = $_GET["employee"];
	require_once('employeefunctions.php');

	/* Create queries object */
	$q = new EmployeeQueries();
	if(empty($q->dbc)){
	    echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
	    die();
	}

	if (time() >= $_SESSION['expire'])
		session_destroy();

	/* Check is the book is going to be modified */
	if (isset($_POST['editagent'])){

    	//Check if cancel button has been selected
        $check = true;

        //Get the new book values
        $agent[0] = $ID;
        $agent[1] = $_POST['username'];
        $agent[2] = $_POST['nick'];
        $agent[3] = $_POST['gender'];
        $agent[4] = $_POST['edad'];
        $agent[5] = $_POST['photo'];
        $agent[6] = $_POST['specialty'];
        $agent[7] = $_POST['contactInfo'];


        if($check){
            $status = $q->updateEmployee($agent);
			var_dump($status);
            //If correctly added, go to books page
            if($status)
                header('Location: /index.php');
            else
                echo "<h3 align='center' style='color: red'>An error ocurred. Please try again.</h3><br>";
        }else
            echo "<h3 align='center' style='color: red'>Please check the fields and try again.</h3><br>";
	}

	if (isset($employee))
		$employee = $q->getEmployee($ID);
	
	$employee = $q->getEmployee($ID);

echo <<<_END
	<body>
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>
		<h3>Editar miembro</h3>
		<form action="editarEmployee.php?employee=$employee[ID]" method="post">
		<table align="center" style="margin: 0 auto;">
		<tr align="left">
			<th id="addedit">Formulario</th>
			<th id="addedit"></th>
		</tr>
		<tr align="left">
			<td>Name</td>
			<td><input type="text" name="username" required value="$employee[NOMBRE]"></td>
		</tr>
		<tr align="left">
			<td>Nick</td>
			<td><input type="text" name="nick" required value="$employee[NICK]"></td>
		</tr>
		<tr align="left">
			<td>Sexo</td>
_END;
	if ($employee['SEXO'] = "Hombre")
		echo "<td><input type='radio' name='gender' value='Hombre' checked> Hombre<br>";
	else
		echo "<td><input type='radio' name='gender' value='Hombre'> Hombre<br>";
	

	if ($employee['SEXO'] = "Mujer")
		echo "<input type='radio' name='gender' value='Mujer' checked> Mujer<br>";
	else
		echo "<input type='radio' name='gender' value='Mujer'> Mujer<br>";
	

	if ($employee['SEXO'] = "Otro")
		echo "<input type='radio' name='gender' value='Otro' checked> Otro</td>";
	else
		echo "<input type='radio' name='gender' value='Otro'> Otro</td>";
	

echo <<<_END

		</tr>
		<tr align="left">
			<td>Edad</td><br>
			<td><select name="edad">
				<option selected="selected">$employee[EDAD]</option>
_END;
			for ($i=16; $i < 100; $i++)
				echo "<option value='$i'>$i</option>";

echo <<<_END
			</select></td>
		</tr>
		<tr align="left">
			<td>Especialidad</td>
			<td><input type="text" name="specialty" value="$employee[ESPECIALIDAD]" required></td>
		</tr>
		<tr align="left">
			<td>Foto</td>
			<td><input type="text" name="photo" value="$employee[PHOTO]"></td>
		</tr>
		<tr align="left">
			<td>Direccion de contacto</td>
			<td><input type="text" name="contactInfo" required value="$employee[CONTACTO]"></td>
		</tr>
		<tr align="left">
			<td><input type="submit" name="editagent" value="Confirmar"></td>
		</tr>
		</table>
		</form>
	<a id="back" href="./index.php">Atrás</a>
  	<p id="cookies">This site uses cookies to deliver our services. By using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.</p>
	</body>
_END;

?>

</body>
</html>
