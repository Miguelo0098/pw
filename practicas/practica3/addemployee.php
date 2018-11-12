<!DOCTYPE html>
<html lang="es">
<head>
	<title>TEAMOJA Enterprise</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

<?php

require_once('employeefunctions.php');

/* Create queries object */
$q = new EmployeeQueries();
if(empty($q->dbc)){
    echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
    die();
}

/* Check is the book is going to be modified */
if (isset($_POST['addagent'])){

    //Check if cancel button has been selected

        $check = true;

        //Get the new book values
        $newid = $q->maxIdEmployee();
        $agent[0] = $newid[0] + 1;
        $agent[1] = $_POST['username'];
        $agent[2] = $_POST['nick'];
        $agent[3] = $_POST['gender'];
        $agent[4] = $_POST['edad'];
        $agent[5] = $_POST['photo'];
        $agent[6] = $_POST['specialty'];
        $agent[7] = $_POST['contactInfo'];


        if($check){
            $status = $q->addEmployee($agent);
            //If correctly added, go to books page
            if($status){
                header('Location: /index.php');
            }
            else{
                echo "<h3 align='center' style='color: red'>An error ocurred. Please try again.</h3><br>";
            }
        }else{
            echo "<h3 align='center' style='color: red'>Please check the fields and try again.</h3><br>";
        }



}

echo <<<_END
	<body>
		<img id="uco" src="./pics/índice.jpeg" alt="UCO LOGO">
		<h1><b>Special Agents Database</b></h1>
		<h3>Creacion de un nuevo miembro</h3>
		<form action="addemployee.php" method="post">
			Name (encrypted):<br>
			<input type="text" name="username" required><br>

			<br>Nick:<br>
			<input type="text" name="nick" required><br>

			<br>Sexo:<br>
			<input type="radio" name="gender" value="Hombre" checked> Hombre<br>
			<input type="radio" name="gender" value="Mujer"> Mujer<br>
			<input type="radio" name="gender" value="Otro"> Otro<br>
			<br>Edad:<br>
			<select name="edad">
_END;
			for ($i=16; $i < 100; $i++) {
				echo "<option value='$i'>$i</option>";
			}
echo <<<_END
			</select>
			<br>Especialidad:<br>
			<input type="text" name="specialty" value="" required><br>
			<br>Foto<br>
			<input type="text" name="photo"><br>
			<br>Direccion de contacto:<br>
			<input type="text" name="contactInfo" required><br>
			<br>
            <input type="checkbox" name="terms" required>Acepto los términos y condiciones<br>
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
