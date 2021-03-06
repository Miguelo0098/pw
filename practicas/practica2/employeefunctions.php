<?php

class EmployeeQueries{
  //Nombre del host
  public $servername = "localhost";

  //Nombre del usuario de la base de datos
  public $username = "root";

  //Contraseña de la base de datos
  public $password = "";

  //Nombre de la base de datos
  public $dbname = "EmployeeDatabase";

  // Objeto para conectar con la base de datos

  public $dbc;

  // Constructor
  public function __construct(){
    $this->dbc = $this->dbconnect();
  }

  //Conexion con la base de datos y la tabla de empleados
  public function dbconnect() {
    $dbc = null;

    try {
      $dbc = new PDO('mysql:host=localhost; dbname=EmployeeDatabase', $this->username, $this->password, array(PDO::ATTR_PERSISTENT => true));
    } catch (PDOException $e) {
      return null;
    }
    return $dbc;
  }

  // Get an array with  all employees
  public function getAllEmployees(){
    $employees = array();
    $i = 0;
    $sentence = $this->dbc->prepare("SELECT * FROM EMPLOYEES");
    if ($sentence->execute()) {
      while ($row = $sentence->fetch()) {
        $employees[$i] = $row;
        $i++;
      }
    }
    return $employees;
  }

  public function getEmployee($id){
    $sentence = $this->dbc->prepare("SELECT * FROM EMPLOYEES WHERE ID=$id");
    if ($sentence->execute()) {
      $row = $sentence->fetch();
    }
    return $row;
  }

}
