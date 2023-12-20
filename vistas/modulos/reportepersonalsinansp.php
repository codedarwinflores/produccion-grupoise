

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

<div class="content-wrapper">

 <style>
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        height: 100%;
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

      <a href='reportesgeneral' class="btn btn-danger">
        Volver
      </a>
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <a href='vistas/modulos/Reporte_personal_sin_ANSP.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>


      <div class="col-md-12" align="center">
        <h3>Reporte de Empleados sin ANSP</h3>
      </div>
      <!-- *********************** -->

      <?php
        /* *******CUERPO***** */
        function ubicacion_actual($codigo_egente) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones  where tbl_ubicaciones_agentes_asignados.codigo_agente='$codigo_egente' and tbl_clientes_ubicaciones.id=tbl_ubicaciones_agentes_asignados.idubicacion_agente";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleados() {
            $query = "SELECT * FROM `tbl_empleados`  where curso_ansp='No'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
   
        ?>                                 
         <div class="table-responsive">
            <table  class="table table-bordered table-striped dt-responsive tablas" width="100%">
                <thead>
                    <tr>
                        <th>AGENTE</th>
                        <th>INGRESO</th>
                        <th>No. APROBACION</th>
                        <th>FECHA APROBACION</th>
                        <th>UNIDAD DE SERVCIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_empleado = empleados();
                    foreach($data_empleado as $row_empleado) {
                        $codigo_empleado=$row_empleado["codigo_empleado"];
                        $nombreempleado=$row_empleado["primer_nombre"].' '.$row_empleado["segundo_nombre"].' '.$row_empleado["tercer_nombre"].' '.$row_empleado["primer_apellido"].' '.$row_empleado["segundo_apellido"].' '.$row_empleado["apellido_casada"];
                    ?>
                 
                        <tr>
                        <td  ><?php echo $row_empleado["codigo_empleado"]." ".$nombreempleado?></td>
                        <td  ><?php echo $row_empleado["fecha_ingreso"]?></td>
                        <td  ><?php echo $row_empleado["numero_aprobacion_ansp"]?></td>
                        <td  ><?php echo $row_empleado["fecha_curso_ansp"]?></td>

                        <?php
                            $data_ubicacion = ubicacion_actual($codigo_empleado);
                            foreach($data_ubicacion as $row_ubicacion) {
                        ?>
                        <td> <?php echo $row_ubicacion["nombre_ubicacion"];?> </td>
                        <?php
                            }
                        ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div> 

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
                    ' INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.'=>'string',
                    ' '=>'string',
                    ''=>'string',
                );
                $header2 = array(
                );
                $header2['            ']='string';
                $header2['           ']='string';
                $header2['SIN CURSO ANSP']='string';
                $header2['         ']='string';
                $header2[$fecha_actual]='string';
                /* ************** */

                /* *******CUERPO***** */
                $writer = new XLSXWriter();                                            /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
                $writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[60,20,50,20,40,20,20,20,80,20,30,20,10,50,10,20,10,30,50,50,50]]);
                $writer->writeSheetHeader('Sheet1', $header1,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2,$styles8);
                

                    $header3 = array();
                    $header4 = array(
                        'AGENTE'=>'string',//text
                        'INGRESO'=>'string',//text
                        'No. APROBACION'=>'string',
                        'FECHA APROBACION'=>'string',
                        'UNIDAD DE SERVCIO'=>'string',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);


                    $data_empleado = empleados();
                    foreach($data_empleado as $row_empleado) {
                        $codigo_empleado=$row_empleado["codigo_empleado"];

                        
                        $nombreempleado=$row_empleado["primer_nombre"].' '.$row_empleado["segundo_nombre"].' '.$row_empleado["tercer_nombre"].' '.$row_empleado["primer_apellido"].' '.$row_empleado["segundo_apellido"].' '.$row_empleado["apellido_casada"];
                        $codigo_empleado=$row_empleado["codigo_empleado"];
                        $codigo_nombre=$codigo_empleado." ".$nombreempleado;
                        $fecha_ingreso =$row_empleado["fecha_ingreso"];
                        $numero_aprobacion_ansp=$row_empleado["numero_aprobacion_ansp"];
                        $fecha_curso_ansp=$row_empleado["fecha_curso_ansp"];

                        /* ********* */
                        $row_empleado = array();
                        $row_empleado[$codigo_nombre]='string';
                        $row_empleado[$fecha_ingreso]='string';
                        $row_empleado[$numero_aprobacion_ansp.' ']='string';
                        $row_empleado[$fecha_curso_ansp]='string';

                        $data_ubicacion = ubicacion_actual($codigo_empleado);
                        foreach($data_ubicacion as $row_ubicacion) {
                            $nombre_ubicacion=$row_ubicacion["nombre_ubicacion"];
                            $row_empleado[$nombre_ubicacion]='string';
                        }

                        $writer->writeSheetHeader('Sheet1', $row_empleado);

                    }

                $writer->writeToFile('vistas/modulos/Reporte_personal_sin_ANSP.xlsx');
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