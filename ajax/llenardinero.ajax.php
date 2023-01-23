<?php 
require_once "../modelos/conexion.php";


             
    function configuracion() {
        
        $query = "SELECT * from configuracion";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();			
        return $sql->fetchAll();
      };
    $data = configuracion();
    foreach($data as $value) {
    
      $output = [];
      $output[] = $value["extra_diurna"];
      $output[] = $value["extra_nocturna"];
      $output[] = $value["extra_dominical_diurna"];
      $output[] = $value["extra_dominical_nocturna"];
      $output[] = $value["salario_minimo"];


      echo json_encode($output);


    }         






?>