

<?php
include_once("excel/xlsxwriter.class.php");
?>

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
$reportado_a_pnc="";
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

if ( isset($_POST["reportado_a_pnc"]) ) {
    $reportado_a_pnc = $_POST["reportado_a_pnc"];
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
        height: 300px;
        overflow-y: auto;

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
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <a href='vistas/modulos/Reporte_Contratados.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>


      <div class="col-md-12" align="center">
        <h3>Reporte de Empleados Contratados</h3>
      </div>
      <!-- *********************** -->

      <?php
        $colum_reportado_a_pnc="";
        if($reportado_a_pnc=="todos"){
            $colum_reportado_a_pnc="";
        }
        else{
            $colum_reportado_a_pnc="and reportado_a_pnc=".$reportado_a_pnc;

        }

        $columna_tipoagente="";
        if($tipoagente=="todos"){
            $columna_tipoagente="and estado in(2,3)";
        }
        else{
            $columna_tipoagente="and estado=".$tipoagente;

        }

        /* *******CUERPO***** */
        function empleados($departamentos,$colum_reportado_a_pnc1,$columna_tipoagente1) {
            
            $query = "SELECT * FROM `tbl_empleados`  where id_departamento_empresa=$departamentos $columna_tipoagente1  $colum_reportado_a_pnc1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleados_fecha($departamentos,$fechadesde1,$fechahasta1,$colum_reportado_a_pnc1,$columna_tipoagente1) {
            $query = "SELECT * FROM `tbl_empleados`  where id_departamento_empresa = $departamentos $columna_tipoagente1 $colum_reportado_a_pnc1 and fecha_contratacion BETWEEN '$fechadesde1' AND '$fechahasta1'";
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
       

        function tbl_empleados_devengos_descuentos($idempleado1,$iddevengo) {
            $query = "SELECT * FROM `tbl_empleados_devengos_descuentos` where id_empleado='$idempleado1' and id_tipo_devengo_descuento='$iddevengo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos($idempleados1) {
            $query = "SELECT * FROM `tbl_empleados_devengos_descuentos` where id_empleado = $idempleados1 and id_tipo_devengo_descuento='22'";
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
                    <th width="200">TRANSP.</th>
                    <th  >U. ESP.</th>
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
                    $data_empleado;
                    $iddepartamento=$row_departamento["id"];
                    if($fechadesde=="" || $fechahasta=="")
                    {
                        $data_empleado = empleados($iddepartamento,$colum_reportado_a_pnc,$columna_tipoagente);
                    
                    }
                    else{
                        $data_empleado = empleados_fecha($iddepartamento,$fechadesde,$fechahasta,$colum_reportado_a_pnc,$columna_tipoagente);
                    }

                    foreach($data_empleado as $row_empleado) {
                    ?>
                      
                    <?php
                        $data_ubicacion = ubicacion($row_empleado["codigo_empleado"]);
                        $nombre_ubicacion="";
                        $codigo_ubicacion="";
                        $bono_unidad_esp="";
                        foreach($data_ubicacion as $row_ubicacion) {
                         $nombre_ubicacion.=$row_ubicacion["nombre_ubicacion"];
                         $codigo_ubicacion.=$row_ubicacion["codigo_cliente"];
                         $bono_unidad_esp.=$row_ubicacion["bonos"];
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

                        $data_devengo_descuentos = devengos($row_empleado["id"]);
                        $info_devengo="";
                        foreach($data_devengo_descuentos as $row_devengo) {
                         $info_devengo.=$row_devengo["valor"];
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
               

                        $data_devengo = tbl_empleados_devengos_descuentos($row_empleado["id"],'64');
                        $sinuniforme="";
                        foreach($data_devengo as $row_devengo) {
                         $sinuniforme.=$row_devengo["valor"];
                        }
                        if(empty($sinuniforme)){
                            $sinuniforme="/SIN UNIFORME";
                        }
                        else{
                            $sinuniforme="/CON UNIFORME";
                        }

                        

                        $nacimiento = new DateTime($row_empleado["fecha_nacimiento"]);
                        $ahora = new DateTime(date("Y-m-d"));
                        $diferencia = $ahora->diff($nacimiento);
                        $edad= $diferencia->format("%y");
                    ?> 
                        <tr>
                        <td  ><?php echo $row_empleado["codigo_empleado"]?></td>
                        <td  ><?php echo $row_empleado["primer_nombre"].' '.$row_empleado["segundo_nombre"].' '.$row_empleado["tercer_nombre"].' '.$row_empleado["primer_apellido"].' '.$row_empleado["segundo_apellido"].' '.$row_empleado["apellido_casada"].$sinuniforme?></td>
                        <td  ><?php echo $row_empleado["sueldo_que_devenga"]?></td>
                        <td  ><?php echo $info_devengo;?></td>
                        <td  ><?php echo $bono_unidad_esp?></td>
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

$filename = "vistas/modulos/reportecontratados.txt";
$text = "";
$fecha_actual = date("d/m/Y");


 /* ****CABEZA**** */
 $text .= str_pad("", 200)."  ".str_pad("*** INGRESOS/EGRESOS ***", 10 )."\n";
 $text .= str_pad($fechadesde, 0)." ".str_pad($fechahasta, 198 )." ".str_pad("INGRESOS", 10 )."\n";

 $styles8 = array(['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center'],['halign'=>'center']);

 $header0 = array(
    '               '=>'string',//text
    '              '=>'string',//text
    '             '=>'string',
    '            '=>'string',
    '           '=>'string',
    '          '=>'string',//custom
    '         '=>'string',
    '        '=>'string',
    '       '=>'string',
    '      '=>'string',
    '     '=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
);
 $header1 = array(
    '               '=>'string',//text
    '              '=>'string',//text
    '             '=>'string',
    '            '=>'string',
    '           '=>'string',
    '          '=>'string',//custom
    '         '=>'string',
    '        '=>'string',
    '       '=>'string',
    '      '=>'string',
    '*** INGRESOS/EGRESOS ***'=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
    ''=>'string',
);
$header2 = array(
);
$header2[$fechadesde]='string';
$header2[$fechahasta]='string';
$header2['                ']='string';
$header2['              ']='string';
$header2['            ']='string';
$header2['           ']='string';
$header2['          ']='string';
$header2['         ']='string';
$header2['        ']='string';
$header2['       ']='string';
$header2['INGRESOS']='string';

/* ************** */



/* *******CUERPO***** */
$writer = new XLSXWriter();
$writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[20,20,10,10,10,10,10,10,10,10,30]]);
$writer->writeSheetHeader('Sheet1', $header1,$styles8);
$writer->writeSheetHeader('Sheet1', $header2,$styles8);

  
$data_departamento = departamento($departamento1,$departamento2);
foreach($data_departamento as $row_departamento) {

    $header3 = array();
    $header3[$row_departamento["codigo"]]='string';
    $header3[$row_departamento["nombre"]]='string';

        
    $header4 = array(
        'No.'=>'string',//text
        'NOMBRE'=>'string',//text
        'SUELDO'=>'string',
        'TRANSP.'=>'string',
        'U. ESP'=>'string',
        'F.INGRESO'=>'string',//custom
        'F.CONT.'=>'string',
        'F.RETIRO'=>'string',
        'UBICACION'=>'string',
        'F. UBICACION'=>'string',
        'D.U.I'=>'string',
        'NUP'=>'string',
        'AFP'=>'string',
        'TIPO DE EMPLEADO'=>'string',
        'EDAD'=>'string',
        'NACIMIENTO'=>'string',
        'ISSS'=>'string',
        'NIT'=>'string',
        'BANCO'=>'string',
        'CUENTA'=>'string',
        'MOTIVO'=>'string',
    );

    $writer->writeSheetHeader('Sheet1', $header3, $col_options = ['widths'=>[10,20,30,40]]);
    $writer->writeSheetHeader('Sheet1', $header4, $col_options = ['widths'=>[10,20,30,40]]);



     $text .= str_pad("------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", 30)."\n";
     $text .= str_pad($row_departamento["codigo"], 0)."-".str_pad($row_departamento["nombre"], 10 )."\n";
     $text .= str_pad("No.", 10)." ".
              str_pad("NOMBRE", 50 )." ".
              str_pad("SUELDO", 10 )." ".
              str_pad("TRANSP. ", 10 )." ".
              str_pad("U. ESP", 10 )." ".
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

     $text .= str_pad("------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", 30)."\n";

  
    $data_empleado;
    $iddepartamento=$row_departamento["id"];
    if($fechadesde=="" || $fechahasta=="")
        {
            $data_empleado = empleados($iddepartamento,$colum_reportado_a_pnc,$columna_tipoagente);
                    
        }
    else{
             $data_empleado = empleados_fecha($iddepartamento,$fechadesde,$fechahasta,$colum_reportado_a_pnc,$columna_tipoagente);
        }


    foreach($data_empleado as $row_empleado) {

        $data_ubicacion = ubicacion($row_empleado["codigo_empleado"]);
        $nombre_ubicacion="";
        $codigo_ubicacion="";
        $bono_unidad_esp="";
        foreach($data_ubicacion as $row_ubicacion) {
         $nombre_ubicacion.=$row_ubicacion["nombre_ubicacion"];
         $codigo_ubicacion.=$row_ubicacion["codigo_cliente"];
         $bono_unidad_esp.=$row_ubicacion["bonos"];

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


                     $data_devengo_descuentos = devengos($row_empleado["id"]);
                        $info_devengo="";
                        foreach($data_devengo_descuentos as $row_devengo) {
                         $info_devengo.=$row_devengo["valor"];
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


        $data_devengo = tbl_empleados_devengos_descuentos($row_empleado["id"],'64');
        $sinuniforme="";
        foreach($data_devengo as $row_devengo) {
         $sinuniforme.=$row_devengo["valor"];
        }
        if(empty($sinuniforme)){
            $sinuniforme="/SIN UNIFORME";
        }else{
            $sinuniforme="/CON UNIFORME";
        }


        

        $nacimiento = new DateTime($row_empleado["fecha_nacimiento"]);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        $edad= $diferencia->format("%y");


        $nombreempleado=$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"]." ".$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"].$sinuniforme;

        $text .= str_pad($row_empleado["codigo_empleado"], 10)." ".
              str_pad($nombreempleado, 50 )." ".
              str_pad($row_empleado["sueldo_que_devenga"], 10 )." ".
              str_pad($info_devengo, 10 )." ".
              str_pad($bono_unidad_esp, 10 )." ".
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

  }


}


$writer->writeToFile('vistas/modulos/Reporte_Contratados.xlsx');

$fh = fopen($filename, "w") or die("Could not open log file.");
fwrite($fh, $text) or die("Could not write file!");
fclose($fh);
?>

        </div>
    </div>
  </section>
</div>

<script>
    $(document).ready(function(){
  //Código que se ejecutará al cargar la página
        $(".cargareporte").text("REPORTE GENERADO");
        $(".cargareporte").attr("style","color:green;");
        $(".btnreporte").removeAttr("style");
    });
</script>