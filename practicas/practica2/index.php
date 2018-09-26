<!DOCTYPE html>
<html lang="en">
<head>
  <title>Biblioteca-Autores</title>
</head>
<body>

<?php

	/* Incluye las funciones de consulta para la libreria */
	require_once('queryFunctionsLibrary.php');

	/* Crea un nuevo objeto para llamar a las consultas */
	$q = new LibraryQueries();

	/* Comprueba que se ha realizado bien la conexion a la base de datos */
	if(empty($q->dbc)){
		echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
		die();
	}

	/* Aqui van las cosicas */

?>

</body>
</html>
