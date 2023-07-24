<?php 
require_once "../modelos/conexion.php";

$nombres = $_POST['nombres'] ;
$apellido1 = $_POST['apellido1']; 
$apellido2 = $_POST['apellido2']; 
$duis = $_POST['duis']; 


             
    function empleado() {
        global $nombres;
        global $apellido1;
        global $apellido2;
        global $duis;
        $query = "SELECT COUNT(*) as numero FROM personal_no_contratable where nombres='".$nombres."' and primer_apellido='".$apellido1."' and segundo_apellido='".$apellido2."' and dui='".$duis."'";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();			
        return $sql->fetchAll();
      };
    $data = empleado();
    foreach($data as $value) {
    
    /*   $query = "SELECT COUNT(*) as numero FROM personal_no_contratable where nombres='".$nombres."' and primer_apellido='".$apellido1."' and segundo_apellido='".$apellido2."' and dui='".$duis."'";
      echo $query; */
      
      echo $value["numero"];

    }         






?>