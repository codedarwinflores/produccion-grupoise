

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
        height: 350px;
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
      <a href='vistas/modulos/Reporte_vencimiento_portacion_arma.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>


      <div class="col-md-12" align="center">
        <h3>VENCIMIENTO DE LICENCIAS DE PORTACION DE ARMAS</h3>
      </div>
      <!-- *********************** -->

      <?php
        /* *******CUERPO***** */
        function tipo_armas() {
            $query = "SELECT * FROM `tbl_tipos_de_armas`";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function armas($fecha) {
            $query = "SELECT * FROM `tbl_empleados`   
            INNER JOIN cargos_desempenados WHERE tbl_empleados.fecha_vencimiento_lpa<='$fecha' and tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='Agente de Seguridad'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function ubicacion($codigo_equipo1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados`, tbl_clientes_ubicaciones WHERE tbl_ubicaciones_agentes_asignados.codigo_agente='$codigo_equipo1' and tbl_clientes_ubicaciones.id=tbl_ubicaciones_agentes_asignados.idubicacion_agente";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        ?>       
                            
            <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>AGENTE</th>
                            <th>LICENCIA</th>
                            <th>UBICACION ACTUAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtener la fecha actual
                        $fechaActual = new DateTime();
                        $formatoDeseado = "Y-m-d"; // Cambia este formato según tus necesidades
                        $fechaFormateada = $fechaActual->format($formatoDeseado);
                        $data_armas = armas($fechaFormateada);
                        foreach($data_armas as $row_armas) {

                            $nombreempleado=$row_armas["primer_nombre"].' '.$row_armas["segundo_nombre"].' '.$row_armas["tercer_nombre"].' '.$row_armas["primer_apellido"].' '.$row_armas["segundo_apellido"].' '.$row_armas["apellido_casada"];
                            $codigo_empleado=$row_armas["codigo_empleado"];
                            $codigo_nombre=$codigo_empleado." ".$nombreempleado;

                        ?>
                            <tr>
                                <td><?php echo $row_armas["fecha_vencimiento_lpa"]?></td>
                                <td><?php echo $codigo_nombre?></td>
                                <td><?php echo $row_armas["licencia_tenencia_armas"]?></td>
                                <?php
                                    $data_movimiento = ubicacion($codigo_empleado);
                                    foreach($data_movimiento as $row_movimiento) {
                                        
                                ?>
                                <td><?php echo $row_movimiento["nombre_ubicacion"];?></td>
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
                    'VENCIMIENTO DE LICENCIAS DE PORTACION DE ARMAS'=>'string',
                    '           '=>'string',//text
                    ' '=>'string',
                    ''=>'string',
                );
                $header2 = array(
                );
                $header2['            ']='string';
                $header2['           ']='string';
                $header2['          ']='string';
                $header2[$fecha_actual]='string';
                $header2['       ']='string';
                $header2['      ']='string';
                $header2[' ']='string';
                /* ************** */

                /* *******CUERPO***** */
                $writer = new XLSXWriter();                                            /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
                $writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[25,50,55,50,20,20,40,20,80,20,30,20,10,50,10,20,10,30,50,50,50]]);
                $writer->writeSheetHeader('Sheet1', $header1,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2,$styles8);
                
                

                    $header3 = array();
                    /* $header3[$subtitulo]='string'; */
                    $header4 = array(
                        'FECHA'=>'string',//text
                        'AGENTE'=>'string',//text
                        'LICENCIA'=>'string',
                        'UBICACION ACTUAL'=>'string',
                        '   '=>'string',
                        '  '=>'string',
                        ' '=>'string',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);

                    $data_armas = armas($fechaFormateada);
                    foreach($data_armas as $row_armas) {

                        $nombreempleado=$row_armas["primer_nombre"].' '.$row_armas["segundo_nombre"].' '.$row_armas["tercer_nombre"].' '.$row_armas["primer_apellido"].' '.$row_armas["segundo_apellido"].' '.$row_armas["apellido_casada"];
                        $codigo_empleado=$row_armas["codigo_empleado"];
                        $codigo_nombre=$codigo_empleado." ".$nombreempleado;
                        $fecha_vencimiento_lpa=$row_armas["fecha_vencimiento_lpa"];
                        $licencia_tenencia_armas =$row_armas["licencia_tenencia_armas"];
                     

                        /* ********* */
                        $row_empleado = array();
                        $row_empleado[$fecha_vencimiento_lpa]='string';
                        $row_empleado[$codigo_nombre]='string';
                        $row_empleado[$licencia_tenencia_armas]='string';

                        $data_movimiento = ubicacion($codigo_empleado);
                        foreach($data_movimiento as $row_movimiento) {
                            $nombre_ubicacion=$row_movimiento["nombre_ubicacion"];
                            $row_empleado[$nombre_ubicacion]='string';
                        }
                      
                        $writer->writeSheetHeader('Sheet1', $row_empleado);

                    }
                

                $writer->writeToFile('vistas/modulos/Reporte_vencimiento_portacion_arma.xlsx');
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