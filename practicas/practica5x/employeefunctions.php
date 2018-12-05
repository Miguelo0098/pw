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
    $row = [];
    $sqlcommand = "SELECT * FROM EMPLOYEES WHERE ID=".$id;
    $sentence = $this->dbc->prepare($sqlcommand);
    if ($sentence->execute()) {
      $row = $sentence->fetch();
    }
    return $row;
  }

  public function deleteEmployee($id){
    $sqlcommand = "DELETE FROM EMPLOYEES WHERE ID=".$id;
    $sentence = $this->dbc->prepare($sqlcommand);
    if ($sentence->execute()) {
      echo "<h3>Se ha borrado al agente</h3>";
    }
  }

  public function maxIdEmployee(){
    $sqlcommand = "SELECT MAX(`ID`) FROM `EMPLOYEES`";
    $sentence = $this->dbc->prepare($sqlcommand);
    if ($sentence->execute()) {
      $row = $sentence->fetch();
    }

    return $row;
  }

  public function addEmployee($agent){
    $sqlcommand = "INSERT INTO `EMPLOYEES`(`ID`, `NOMBRE`, `NICK`, `SEXO`, `EDAD`, `PHOTO`, `ESPECIALIDAD`, `SUELDO`, `CONTACTO`) VALUES ('$agent[0]','$agent[1]','$agent[2]','$agent[3]','$agent[4]','$agent[5]','$agent[6]','$agent[8]','$agent[7]')";
    $sentence = $this->dbc->prepare($sqlcommand);
    if ($sentence->execute()) {
        return true;
    }

  }

  public function updateEmployee($agent){
    $sqlcommand = "UPDATE `EMPLOYEES` SET `NOMBRE`='$agent[1]',`NICK`='$agent[2]',`SEXO`='$agent[3]',`EDAD`='$agent[4]',`PHOTO`='$agent[5]',`ESPECIALIDAD`='$agent[6]',`SUELDO`='$agent[8]',`CONTACTO`='$agent[7]' WHERE ID='$agent[0]'";
    $sentence = $this->dbc->prepare($sqlcommand);
    if ($sentence->execute()) {
        return true;
    }

  }

  public function addUser($user){
      $sqlcommand = "INSERT INTO `USERS`(`USERNAME`, `PASSWORD`, `ADMIN`) VALUES ('$user[0]','$user[1]', 0)";
      $sentence = $this->dbc->prepare($sqlcommand);
      if ($sentence->execute()) {
          return true;
      }
  }

  public function getUser($user){
      $row = [];
      $sqlcommand = "SELECT * FROM `USERS` WHERE `USERNAME`='$user[0]'";
      $sentence = $this->dbc->prepare($sqlcommand);
      if ($sentence->execute()) {
        $row = $sentence->fetch();
      }
      return $row;
  }

  public function verifyUser($user){
      $row = self::getUser($user);
      var_dump($row);
      if ($row != NULL) {
          if (strnatcasecmp($row[1], $user[1]) == 0) {
              return true;
          }
      }
      return false;
  }

}
