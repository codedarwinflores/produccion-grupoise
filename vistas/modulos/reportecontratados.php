

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

$fecha_actual = date("d/m/Y");
 /* ****CABEZA**** */
 
 $styles0 = array( 'font-size'=>10,'font-style'=>'bold', 'widths'=>'100px');
 $styles1 = array( 'font-size'=>10,'font-style'=>'bold', 'halign'=>'center', 'halign'=>'center', 'border'=>'left,right,top,bottom', 'widths'=>'100');

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
$header2[$fechadesde.' ']='string';
$header2[$fechahasta.'  ']='string';
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
$writer = new XLSXWriter();                                            /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
$writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[20,80,10,10,10,20,20,20,80,20,30,20,10,50,10,20,10,30,50,50,50]]);
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
    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
    $writer->writeSheetHeader('Sheet1', $header4,$styles0);


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
        /* variables */
        $codigo_empleado =$row_empleado["codigo_empleado"];
        $nombreempleado=$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"]." ".$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"].$sinuniforme;
        $sueldo_que_devenga =$row_empleado["sueldo_que_devenga"];
        $fecha_ingreso=$row_empleado["fecha_ingreso"];
        $fecha_contratacion=$row_empleado["fecha_contratacion"];
        $numero_documento_identidad=$row_empleado["numero_documento_identidad"];
        $nup =$row_empleado["nup"];
        $codigo_afp =$row_empleado["codigo_afp"];
        $fecha_nacimiento =$row_empleado["fecha_nacimiento"];
        $numero_isss =$row_empleado["numero_isss"];
        $nit =$row_empleado["nit"];
        $numero_cuenta =$row_empleado["numero_cuenta"];
        /* ********* */

        $row_empleado = array();
        $row_empleado[$codigo_empleado]='string';
        $row_empleado[$nombreempleado]='string';
        $row_empleado[$sueldo_que_devenga.' ']='string';
        $row_empleado[$info_devengo]='string';
        $row_empleado[$bono_unidad_esp.'  ']='string';
        $row_empleado[$fecha_ingreso.' ']='string';
        $row_empleado[$fecha_contratacion.'  ']='string';
        $row_empleado["F.RETIRO"]='string';
        $row_empleado[$nombre_ubicacion]='string';
        $row_empleado[$fecha_ubicacion]='string';
        $row_empleado[$numero_documento_identidad]='string';
        $row_empleado[$nup]='string';
        $row_empleado[$codigo_afp]='string';
        $row_empleado[$nivel_cargo]='string';
        $row_empleado[$edad]='string';
        $row_empleado[$fecha_nacimiento]='string';
        $row_empleado[$numero_isss]='string';
        $row_empleado[$nit]='string';
        $row_empleado[$banco]='string';
        $row_empleado[$numero_cuenta]='string';
        $row_empleado["MOTIVO"]='string';
        $writer->writeSheetHeader('Sheet1', $row_empleado);
    

  }


}


$writer->writeToFile('vistas/modulos/Reporte_Contratados.xlsx');

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