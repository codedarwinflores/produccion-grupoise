

<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

        padding: 0 !important;
    }
    .table {
        margin-bottom: 0 !important;
    }
</style>

<?php
$departamento1="";
$departamento2="";
$empleados="";
$fechadesde="";
$fechahasta="";
$contratadosopcion="";
$tipoagente="";
if ( isset($_POST["departamento1"]) ) {
    $departamento1 = $_POST["departamento1"];
}
if ( isset($_POST["departamento2"]) ) {
    $departamento2 = $_POST["departamento2"];
}
if ( isset($_POST["empleados"]) ) {
    $empleados = $_POST["empleados"];
}
if ( isset($_POST["fechadesde"]) ) {
    $fechadesde = $_POST["fechadesde"];
}

if ( isset($_POST["fechahasta"]) ) {
    $fechahasta = $_POST["fechahasta"];
}

if ( isset($_POST["contratadosopcion"]) ) {
    $contratadosopcion = $_POST["contratadosopcion"];
}
if ( isset($_POST["tipoagente"]) ) {
    $tipoagente = $_POST["tipoagente"];
}
?>
<div class="content-wrapper">

 <style>
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
    }
    table {
    border-spacing: 0;
    border-collapse: collapse;
    width: 800px;
    margin: 0px auto;
}
 
td, th {
    border: 1px solid #ccc;
    padding: 5px;
    text-align: left;   
}
 
tr:nth-child(even) {
    background-color: #eee;
}
 
td:nth-child(n + 3),
th:nth-child(n + 3) {
    text-align: center;
}
 
tbody tr:hover {
    background-color: aquamarine;
}
 
thead {
    background-color: #fff;
    color: #000;
}
 </style>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <a href='generarcontratados' class="btn btn-danger">
        Volver
      </a>
      <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary">
        Descargar archivo
      </a>


      <div class="col-md-12" align="center">
        <h3>Reporte de Empleados Contratados</h3>
      </div>
      <!-- *********************** -->

      <?php
      
        /* *******CUERPO***** */

        
        function empleados($departamento1s,$departamento2s) {
            $query = "SELECT * FROM `tbl_empleados`  where id_departamento_empresa in($departamento1s,$departamento2s)";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function ubicacion($codigoagente1) {
            $query = "SELECT  `idubicacion_agente`, `codigo_agente`, tbl_clientes_ubicaciones.*
                        FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones 
                        WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and codigo_agente='$codigoagente1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function transacciones_agente($codigoagente1,$codigoubicacion1) {
            $query = "SELECT * FROM `transacciones_agente` WHERE transacciones_agente.nueva_ubicacion_transacciones_agente LIKE '%$codigoubicacion1%' and idagente_transacciones_agente='$codigoagente1' group by idagente_transacciones_agente";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
        function cargos_desempenados($idcargo1) {
            $query = "SELECT * FROM `cargos_desempenados` WHERE id='$idcargo1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function bancos($idbanco1) {
            $query = "SELECT * FROM `bancos` WHERE id='$idbanco1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function departamento($departamento1s,$departamento2s) {
            $query = "SELECT * FROM `departamentos_empresa` where id in($departamento1s,$departamento2s)";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        $data_departamento = departamento($departamento1,$departamento2);
        foreach($data_departamento as $row_departamento) {
            
        ?>                                 
        <h4><?php echo $row_departamento["codigo"]?>-<?php echo $row_departamento["nombre"]?></h4>
         <div class="table-responsive">
            <table class="" width="100%">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th  >NOMBRE</th>
                    <th  >SUELDO</th>
                    <th width="200">TRANSP. U.</th>
                    <th  >ESP.</th>
                    <th  width="150">F.INGRESO</th>
                    <th  width="150">F.CONT.</th>
                    <th  width="150">F.RETIRO</th>
                    <th  width="200">UBICACION</th>
                    <th  >F. UBICACION</th>
                    <th  >D.U.I.</th>
                    <th  >NUP</th>
                    <th  >AFP</th>
                    <th  >TIPO DE EMPLEADO</th>
                    <th  >EDAD</th>
                    <th  >NACIMIENTO</th>
                    <th  >ISSS</th>
                    <th  >NIT</th>
                    <th  >BANCO</th>
                    <th  >CUENTA</th>
                    <th  >MOTIVO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_empleado = empleados($departamento1,$departamento2);
                    foreach($data_empleado as $row_empleado) {
                    ?>
                      
                    <?php
                        $data_ubicacion = ubicacion($row_empleado["codigo_empleado"]);
                        $nombre_ubicacion="";
                        $codigo_ubicacion="";
                        foreach($data_ubicacion as $row_ubicacion) {
                         $nombre_ubicacion.=$row_ubicacion["nombre_ubicacion"];
                         $codigo_ubicacion.=$row_ubicacion["codigo_cliente"];

                        }
                        if(empty($nombre_ubicacion)){
                            $nombre_ubicacion="******";
                        }
                        $data_transacciones_agente = transacciones_agente($row_empleado["codigo_empleado"],$codigo_ubicacion);
                        $fecha_ubicacion="";
                        foreach($data_transacciones_agente as $row_transacciones_agente) {
                         $fecha_ubicacion.=$row_transacciones_agente["fecha_transacciones_agente"];
                        }
                        if(empty($fecha_ubicacion)){
                            $fecha_ubicacion="******";
                        }

                        
                        $data_cargos_desempenados = cargos_desempenados($row_empleado["nivel_cargo"]);
                        $nivel_cargo="";
                        foreach($data_cargos_desempenados as $row_cargos_desempenados) {
                         $nivel_cargo.=$row_cargos_desempenados["descripcion"];
                        }
                        if(empty($nivel_cargo)){
                            $nivel_cargo="******";
                        }

                        $data_bancos = bancos($row_empleado["id_banco"]);
                        $banco="";
                        foreach($data_bancos as $row_banco) {
                         $banco.=$row_banco["nombre"];
                        }
                        if(empty($banco)){
                            $banco="******";
                        }
               
                        $nacimiento = new DateTime($row_empleado["fecha_nacimiento"]);
                        $ahora = new DateTime(date("Y-m-d"));
                        $diferencia = $ahora->diff($nacimiento);
                        $edad= $diferencia->format("%y");
                    ?> 
                        <tr>
                        <td  ><?php echo $row_empleado["codigo_empleado"]?></td>
                        <td  ><?php echo $row_empleado["primer_nombre"].' '.$row_empleado["segundo_nombre"].' '.$row_empleado["tercer_nombre"].' '.$row_empleado["primer_apellido"].' '.$row_empleado["segundo_apellido"].' '.$row_empleado["apellido_casada"]?></td>
                        <td  ><?php echo $row_empleado["sueldo_que_devenga"]?></td>
                        <td  >TRANSP. U.</td>
                        <td  >ESP.</td>
                        <td  ><?php echo $row_empleado["fecha_ingreso"]?></td>
                        <td  ><?php echo $row_empleado["fecha_contratacion"]?></td>
                        <td  >F.RETIRO</td>
                        <td><?php echo $nombre_ubicacion;?></td>
                        <td><?php echo $fecha_ubicacion;?></td>
                        <td  ><?php echo $row_empleado["numero_documento_identidad"]?></td>
                        <td  ><?php echo $row_empleado["nup"]?></td>
                        <td  ><?php echo $row_empleado["codigo_afp"]?></td>
                        <td  ><?php echo $nivel_cargo?></td>
                        <td  ><?php echo $edad?></td>
                        <td  ><?php echo $row_empleado["fecha_nacimiento"]?></td>
                        <td  ><?php echo $row_empleado["numero_isss"]?></td>
                        <td  ><?php echo $row_empleado["nit"]?></td>
                        <td  ><?php echo $banco?></td>
                        <td  ><?php echo $row_empleado["numero_cuenta"]?></td>
                        <td  >************</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div> 

        <?php
        }
      ?>
      <!-- ************************ -->

<?php

/* $handle = fopen("vistas/modulos/reportecontratados.txt","w"); */
$filename = "vistas/modulos/reportecontratados.txt";
$text = "";
$fecha_actual = date("d/m/Y");

 /* ****CABEZA**** */
 
 $text .= str_pad("", 200)."  ".str_pad("*** INGRESOS/EGRESOS ***", 10 )."\n";
 $text .= str_pad($fechadesde, 0)." ".str_pad($fechahasta, 198 )." ".str_pad("INGRESOS", 10 )."\n";


 /* fwrite($handle,"                                                                     *** INGRESOS/EGRESOS ***           $fecha_actual\n");
fwrite($handle,"                               INGRESOS"."\n"); */
/* ************** */

/* *******CUERPO***** */

  
$data_departamento = departamento($departamento1,$departamento2);
foreach($data_departamento as $row_departamento) {

     /* fwrite($handle,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- \n"); */

     $text .= str_pad("------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", 30)."\n";
     $text .= str_pad($row_departamento["codigo"], 0)."-".str_pad($row_departamento["nombre"], 10 )."\n";
     /* fwrite($handle," ".$row_departamento["codigo"]."-".$row_departamento["nombre"]." \n"); */

     $text .= str_pad("No.", 10)." ".
              str_pad("NOMBRE", 50 )." ".
              str_pad("SUELDO", 10 )." ".
              str_pad("TRANSP. U.", 10 )." ".
              str_pad("ESP", 10 )." ".
              str_pad("F.INGRESO", 20 )." ".
              str_pad("F.CONT.", 20 )." ".
              str_pad("F.RETIRO", 10 )." ".
              str_pad("UBICACION", 60 )." ".
              str_pad("F. UBICACION", 25 )." ".
              str_pad("D.U.I", 20 )." ".
              str_pad("NUP", 20 )." ".
              str_pad("AFP", 20 )." ".
              str_pad("TIPO DE EMPLEADO", 30 )." ".
              str_pad("EDAD", 10 )." ".
              str_pad("NACIMIENTO", 20 )." ".
              str_pad("ISSS", 20 )." ".
              str_pad("NIT", 20 )." ".
              str_pad("BANCO", 20 )." ".
              str_pad("CUENTA", 20 )." ".
              str_pad("MOTIVO", 20 )."\n";
     /* fwrite($handle,"No.\t\t\t\t NOMBRE\t\t\t\t\t\t\tSUELDO\t\tTRANSP. U.\tESP.\t\tF.INGRESO\tF.CONT.\t\tF.RETIRO\t\tUBICACION\t\tF. UBICACION\t\tD.U.I\t\tNUP\t\tAFP\t\tTIPO DE EMPLEADO\t\tEDAD\t\tNACIMIENTO\t\tISSS\t\tNIT\t\tBANCO\t\tCUENTA\t\tMOTIVO \n"); */
     /* fwrite($handle,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- \n"); */
     $text .= str_pad("------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", 30)."\n";

  
    $data_empleado = empleados($departamento1,$departamento2);
    foreach($data_empleado as $row_empleado) {

        $data_ubicacion = ubicacion($row_empleado["codigo_empleado"]);
        $nombre_ubicacion="";
        $codigo_ubicacion="";
        foreach($data_ubicacion as $row_ubicacion) {
         $nombre_ubicacion.=$row_ubicacion["nombre_ubicacion"];
         $codigo_ubicacion.=$row_ubicacion["codigo_cliente"];

        }
        if(empty($nombre_ubicacion)){
            $nombre_ubicacion="******";
        }
        $data_transacciones_agente = transacciones_agente($row_empleado["codigo_empleado"],$codigo_ubicacion);
        $fecha_ubicacion="";
        foreach($data_transacciones_agente as $row_transacciones_agente) {
         $fecha_ubicacion.=$row_transacciones_agente["fecha_transacciones_agente"];
        }
        if(empty($fecha_ubicacion)){
            $fecha_ubicacion="******";
        }

        
        $data_cargos_desempenados = cargos_desempenados($row_empleado["nivel_cargo"]);
        $nivel_cargo="";
        foreach($data_cargos_desempenados as $row_cargos_desempenados) {
         $nivel_cargo.=$row_cargos_desempenados["descripcion"];
        }
        if(empty($nivel_cargo)){
            $nivel_cargo="******";
        }

        $data_bancos = bancos($row_empleado["id_banco"]);
        $banco="";
        foreach($data_bancos as $row_banco) {
         $banco.=$row_banco["nombre"];
        }
        if(empty($banco)){
            $banco="******";
        }

        $nacimiento = new DateTime($row_empleado["fecha_nacimiento"]);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        $edad= $diferencia->format("%y");


        $nombreempleado=$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"]." ".$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"];

        $text .= str_pad($row_empleado["codigo_empleado"], 10)." ".
              str_pad($nombreempleado, 50 )." ".
              str_pad($row_empleado["sueldo_que_devenga"], 10 )." ".
              str_pad("TRANSP. U.", 10 )." ".
              str_pad("ESP", 10 )." ".
              str_pad($row_empleado["fecha_ingreso"], 20 )." ".
              str_pad($row_empleado["fecha_contratacion"], 20 )." ".
              str_pad("F.RETIRO", 10 )." ".
              str_pad($nombre_ubicacion, 60 )." ".
              str_pad($fecha_ubicacion, 25 )." ".
              str_pad($row_empleado["numero_documento_identidad"], 20 )." ".
              str_pad($row_empleado["nup"], 20 )." ".
              str_pad($row_empleado["codigo_afp"], 20 )." ".
              str_pad($nivel_cargo, 30 )." ".
              str_pad($edad, 10 )." ".
              str_pad($row_empleado["fecha_nacimiento"], 20 )." ".
              str_pad($row_empleado["numero_isss"], 20 )." ".
              str_pad($row_empleado["nit"], 20 )." ".
              str_pad($banco, 20 )." ".
              str_pad($row_empleado["numero_cuenta"], 20 )." ".
              str_pad("MOTIVO", 20 )."\n";


            /* fwrite($handle,"".$row_empleado["codigo_empleado"]."\t\t\t".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"]." ".$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]."\t\t\t\t\t".$row_empleado["sueldo_que_devenga"]."\t\t------\t----\t\t".$row_empleado["fecha_ingreso"]."\t".$row_empleado["fecha_contratacion"]."\t\t------\t\t".$nombre_ubicacion."\t\t".$fecha_ubicacion."\t\t".$row_empleado["numero_documento_identidad"]."\t\t".$row_empleado["nup"]."\t\t".$row_empleado["codigo_afp"]."\t\t".$nivel_cargo."\t\t".$edad."\t\t".$row_empleado["fecha_nacimiento"]."\t\t".$row_empleado["numero_isss"]."\t\t".$row_empleado["nit"]."\t\t".$banco."\t\t".$row_empleado["numero_cuenta"]."\t\t-------- \n"); */
  }
}
/* fclose($handle);
 */
$fh = fopen($filename, "w") or die("Could not open log file.");
fwrite($fh, $text) or die("Could not write file!");
fclose($fh);
?>

        </div>
    </div>
  </section>
</div>