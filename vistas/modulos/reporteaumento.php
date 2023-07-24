

<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

        padding: 0 !important;
    }
    .table {
        margin-bottom: 0 !important;
    }
</style>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <a href='ubicacionc' class="btn btn-danger">
        Volver
      </a>
      <a href='vistas/modulos/aumento.txt' download class="btn btn-primary">
        Descargar archivo traducido.
      </a>


      <div class="col-md-12" align="center">
        <h3>Reporte de Aumento y Disminución de Hombres Autorizados</h3>
      </div>
      <!-- *********************** -->

      <?php
      
        /* *******CUERPO***** */

        function obtener_aumento2($id) {
            $query = "SELECT id, sum(aumento_hombres) as aumento, sum(disminucion_hombre) as disminucion, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
            FROM `aumentos_hombres` 
            where idubicacion_aumento=$id
            group by supervisor_aumento
            union
            SELECT id, aumento_hombres, disminucion_hombre, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
            FROM `aumentos_hombres`
            where idubicacion_aumento=$id
            union
            SELECT id,sum(aumento_hombres) as aumentoglobal, sum(disminucion_hombre) as disminucionglobal, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
            FROM `aumentos_hombres`
            where idubicacion_aumento=$id
            group by idubicacion_aumento
            ORDER BY 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
        
          function obtener_ubicacion2() {
            $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`, tbl_patrullas_ubicaciones.id as idpatrullaubicacion, `id_patrullas_pu`, `id_ubicacion_pu`,  tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`
            FROM `tbl_patrullas`, tbl_patrullas_ubicaciones, tbl_empleados
            WHERE id_patrullas_pu=tbl_patrullas.id and tbl_empleados.id= tbl_patrullas.id_jefe_operaciones_patrulla";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
          };
        
          
        function totales_aumento2($id) {
            $query = "SELECT id, sum(aumento_hombres) as aumento, sum(disminucion_hombre) as disminucion, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
            FROM `aumentos_hombres` 
            where idubicacion_aumento=$id
            group by supervisor_aumento";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
          
        function totalglobal2($id) {
            $query = "SELECT id, sum(aumento_hombres) as aumento, sum(disminucion_hombre) as disminucion, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
            FROM `aumentos_hombres` 
            where idubicacion_aumento=$id
            group by idubicacion_aumento";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
        $data1 = obtener_ubicacion2();
        foreach($data1 as $row1) {
        echo "<div>";
             $id =$row1['id_ubicacion_pu'];
             $nombre =$row1['primer_nombre'].' '.$row1['primer_apellido'];
             echo "<h4>".$nombre."</h4><br>";

            echo "<table class='table' width='100%'>
                    <tr>
                        <td width='14.28%'>Fecha</td>
                        <td width='14.28%'>Hora</td>
                        <td width='14.28%'>Aumento</td>
                        <td width='14.28%'>Disminución</td>
                        <td width='14.28%'>Código Ubicación</td>
                        <td width='14.28%'>Facturar a</td>
                        <td width='14.28%'>Supervisor</td>

                    <tr>
                 </table>";
                
            $data0 = obtener_aumento2($id);
            foreach($data0 as $row0) {
                $fecha_aumento=trim($row0['fecha_aumento']);
                $hora_aumento=trim($row0['hora_aumento']);
                $newDate = trim(date("H:i:s", strtotime($hora_aumento)));
                $aumento_hombres=trim($row0['aumento_hombres']);
                $disminucion_hombre=trim($row0['disminucion_hombre']);
                $codigo_ubicacion=trim($row0['codigo_ubicacion_aumento']);
                $facturar_aumento=trim($row0['facturar_aumento']);
                $supervisor_aumento=trim($row0['supervisor_aumento']);
                $codigoBarra = str_pad($facturar_aumento, 50);

                echo "<table class='table' width='100%'>
                            <tbody>
                                <tr>
                                    <td width='14.28%'>$fecha_aumento</td>
                                    <td width='14.28%'>$newDate</td>
                                    <td width='14.28%'>$aumento_hombres</td>
                                    <td width='14.28%'>$disminucion_hombre</td>
                                    <td width='14.28%'>$codigo_ubicacion</td>
                                    <td width='14.28%'>$facturar_aumento</td>
                                    <td width='14.28%'>$supervisor_aumento</td>

                                <tr>
                            </tbody>
                 </table>";

                
            }
            
            
            echo "<div style='border-top: 1px solid #000;'>"; 
            $data2 = totales_aumento2($id);
            foreach($data2 as $row0) {
                $aumento=trim($row0['aumento']);
                $disminucion=trim($row0['disminucion']);
                $supervisor_aumento=trim($row0['supervisor_aumento']);

                echo "<table class='table' width='100%'>
                <tbody>
                    <tr>
                        <td width='14.28%'>Total Supervisor</td>
                        <td width='14.28%'></td>
                        <td width='14.28%'>$aumento</td>
                        <td width='14.28%'>$disminucion</td>
                        <td width='14.28%'></td>
                        <td width='14.28%'></td>
                        <td width='14.28%'>$supervisor_aumento</td>

                    <tr>
                </tbody>
                </table>";
         }
            
            
            
            $data3 = totalglobal2($id);
          
            foreach($data3 as $row0) {
                $aumento=trim($row0['aumento']);
                $disminucion=trim($row0['disminucion']);
                $supervisor_aumento=trim($row0['supervisor_aumento']);
            
                echo "<table class='table' width='100%'>
                <tbody>
                    <tr>
                        <td width='14.28%'>Total Jefe</td>
                        <td width='14.28%'></td>
                        <td width='14.28%'>$aumento</td>
                        <td width='14.28%'>$disminucion</td>
                        <td width='14.28%'></td>
                        <td width='14.28%'></td>
                        <td width='14.28%'>$supervisor_aumento</td>

                    <tr>
                </tbody>
                </table>";
            }
            echo "</div>";
        echo "</div>";
        }
      
      ?>
      <!-- ************************ -->

<?php

$handle = fopen("vistas/modulos/aumento.txt","w");

$texto="";
$fecha_actual = date("d/m/Y");

 /* ****CABEZA**** */
fwrite($handle,"                                                                     INVESTIGACIONES Y SEGURIDAD S.A. DE C.V. \n");
fwrite($handle,$fecha_actual."\n");
/* ************** */

/* *******CUERPO***** */


function obtener_aumento($id) {
    $query = "SELECT id, sum(aumento_hombres) as aumento, sum(disminucion_hombre) as disminucion, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
    FROM `aumentos_hombres` 
    where idubicacion_aumento=$id
    group by supervisor_aumento
    union
    SELECT id, aumento_hombres, disminucion_hombre, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
    FROM `aumentos_hombres`
    where idubicacion_aumento=$id
    union
    SELECT id,sum(aumento_hombres) as aumentoglobal, sum(disminucion_hombre) as disminucionglobal, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
    FROM `aumentos_hombres`
    where idubicacion_aumento=$id
    group by idubicacion_aumento
    ORDER BY 1";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
};


  function obtener_ubicacion() {
    $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`, tbl_patrullas_ubicaciones.id as idpatrullaubicacion, `id_patrullas_pu`, `id_ubicacion_pu`,  tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`
    FROM `tbl_patrullas`, tbl_patrullas_ubicaciones, tbl_empleados
    WHERE id_patrullas_pu=tbl_patrullas.id and tbl_empleados.id= tbl_patrullas.id_jefe_operaciones_patrulla";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };

  
function totales_aumento($id) {
    $query = "SELECT id, sum(aumento_hombres) as aumento, sum(disminucion_hombre) as disminucion, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
    FROM `aumentos_hombres` 
    where idubicacion_aumento=$id
    group by supervisor_aumento";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
};

  
function totalglobal($id) {
    $query = "SELECT id, sum(aumento_hombres) as aumento, sum(disminucion_hombre) as disminucion, idubicacion_aumento,supervisor_aumento,`id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`, `facturar_aumento`, `supervisor_aumento`, `codigo_ubicacion_aumento`
    FROM `aumentos_hombres` 
    where idubicacion_aumento=$id
    group by idubicacion_aumento";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
};

$data1 = obtener_ubicacion();
foreach($data1 as $row1) {

     $id =$row1['id_ubicacion_pu'];
     $nombre =$row1['primer_nombre'].' '.$row1['primer_apellido'];
     fwrite($handle,"$nombre \n");
     fwrite($handle,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- \n");

     $codigoBarra = str_pad("FACTURAR A", 50);
     fwrite($handle,"FECHA\t\t\tHORA\tAUMENTO\t\tDISMINUCION\tPRECIO\t\tVALORES\tUBICACION\t\t$codigoBarra\t\tSUPERVISOR \n");
     
     fwrite($handle,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- \n");

     
$data0 = obtener_aumento($id);
foreach($data0 as $row0) {
    $fecha_aumento=trim($row0['fecha_aumento']);
    $hora_aumento=trim($row0['hora_aumento']);
    $newDate = trim(date("H:i:s", strtotime($hora_aumento)));
    $aumento_hombres=trim($row0['aumento_hombres']);
    $disminucion_hombre=trim($row0['disminucion_hombre']);
    $codigo_ubicacion=trim($row0['codigo_ubicacion_aumento']);
    $facturar_aumento=trim($row0['facturar_aumento']);
    $supervisor_aumento=trim($row0['supervisor_aumento']);
    $codigoBarra = str_pad($facturar_aumento, 50);
    fwrite($handle,"$fecha_aumento\t\t$newDate\t$aumento_hombres\t\t$disminucion_hombre\t\t0.00\t\t0.00\t$codigo_ubicacion\t\t$codigoBarra\t\t$supervisor_aumento \n");
}

fwrite($handle,"_______________________________________________________________________________________________________________________________________________________________________________________________________________ \n");


$data2 = totales_aumento($id);
foreach($data2 as $row0) {
    $aumento=trim($row0['aumento']);
    $disminucion=trim($row0['disminucion']);
    $supervisor_aumento=trim($row0['supervisor_aumento']);

    fwrite($handle,"Total Supervisor\t\t\t$aumento\t\t$disminucion\t\t\t\t\t\t\t\t\t\t\t\t\t\t$supervisor_aumento \n");
    fwrite($handle,"_______________________________________________________________________________________________________________________________________________________________________________________________________________ \n");
}



$data3 = totalglobal($id);
foreach($data3 as $row0) {
    $aumento=trim($row0['aumento']);
    $disminucion=trim($row0['disminucion']);
    $supervisor_aumento=trim($row0['supervisor_aumento']);

    fwrite($handle,"Total Jefe\t\t\t$aumento\t\t$disminucion\t\t\t\t\t\t\t\t\t\t\t\t\t\t \n");
}





}
fclose($handle);

?>

        </div>
    </div>
  </section>
</div>