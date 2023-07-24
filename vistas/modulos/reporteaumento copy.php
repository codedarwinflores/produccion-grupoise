<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


      <a href='vistas/modulos/aumento.txt' download>
        Descargar archivo traducido.
      </a>



<?php
 //Esto para forzar la descarga de tu archivo.
 $rutaArchivo = __DIR__."/aumento.txt";
 echo $rutaArchivo;


 
?>


<?php
  $fh = fopen(__DIR__."/aumento.txt", 'w') or die("Se produjo un error al crear el archivo");
  $texto="";
  $fecha_actual = date("d/m/Y");

  /* ****CABEZA**** */
  $texto .= <<<_END
                                                                            INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.     
  $fecha_actual


_END;

/* *******CUERPO***** */

function obtener_aumento($id) {
    $query = "SELECT tbl_clientes_ubicaciones.*, aumentos_hombres.* 
                FROM `aumentos_hombres` 
                INNER JOIN tbl_clientes_ubicaciones 
                WHERE tbl_clientes_ubicaciones.id = aumentos_hombres.idubicacion_aumento and  aumentos_hombres.idubicacion_aumento=$id ";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };


  function obtener_ubicacion() {
    $query = "SELECT * FROM `tbl_clientes_ubicaciones` ";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };
$data1 = obtener_ubicacion();
foreach($data1 as $row1) {
     $id =$row1['id'];
$texto .= <<<_END

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

FECHA           HORA             AUMENTO            DISMINUCION                PRECIO       VALORES         UBICACION                   FACTURAR A                       SUPERVISOR
_END;


$data0 = obtener_aumento($id);
foreach($data0 as $row0) {

$fecha_aumento=trim($row0['fecha_aumento']);
$hora_aumento=trim($row0['hora_aumento']);

$newDate = trim(date("H:i:s", strtotime($hora_aumento)));

$aumento_hombres=trim($row0['aumento_hombres']);
$disminucion_hombre=trim($row0['disminucion_hombre']);
$codigo_ubicacion=trim($row0['codigo_ubicacion']);
$facturar_aumento=trim($row0['facturar_aumento']);

$texto .= <<<_END

$fecha_aumento     $newDate             $aumento_hombres                  $disminucion_hombre                        0.00            0.00        $codigo_ubicacion            $facturar_aumento                       
_END;

}

        

}




$archivo = ucfirst($texto); //Le damos un poco de formato
  fwrite($fh, $archivo) or die("No se pudo escribir en el archivo");
  
  fclose($fh);
  
  echo "Se ha escrito sin problemas";
?>





    </div>
  </div>
 </section>
</div>