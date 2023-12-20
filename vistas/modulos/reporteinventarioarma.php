

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

      <a href='generarreporteinventario' class="btn btn-danger">
        Volver
      </a>
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <a href='vistas/modulos/Reporte_inventario_armas.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>


      <div class="col-md-12" align="center">
        <h3>Reporte de inventario de armas</h3>
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
        function armas($id_tipo1) {
            $query = "SELECT * FROM `tbl_armas` WHERE id_tipo_arma=$id_tipo1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function movimiento_armas($codigo_equipo1) {
            $query = "SELECT movimientosequipos.*, tbl_clientes_ubicaciones.* FROM `movimientosequipos`, tbl_clientes_ubicaciones WHERE movimientosequipos.codigo_equipo='$codigo_equipo1' and tbl_clientes_ubicaciones.id=movimientosequipos.id_ubicacion_movimiento";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        ?>       
         <?php
            $data_tipo_armas = tipo_armas();
            foreach($data_tipo_armas as $row_tipo_arma) {
                $id_tipo_arma=$row_tipo_arma["id"];
        ?>                          
            <h4>TIPO DE ARMA:<?php echo $row_tipo_arma["nombre_tipo"]?></h4>
            <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <th>MARCA</th>
                            <th>SERIE</th>
                            <th>CALIBRE</th>
                            <th>MODELO</th>
                            <th>VENCIMIENTO</th>
                            <th>ESTATUS</th>

                            <th>UBICACION</th>
                            <th>TRANSACCION</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_armas = armas($id_tipo_arma);
                        foreach($data_armas as $row_armas) {
                            $codigo_equipo=$row_armas["codigo"];
                        ?>
                            <tr>
                                <td><?php echo $row_armas["marca"]?></td>
                                <td><?php echo $row_armas["numero_serie"]?></td>
                                <td><?php echo $row_armas["tipo_municion"]?></td>
                                <td><?php echo $row_armas["modelo"]?></td>
                                <td><?php echo $row_armas["fecha_vencimiento"]?></td>
                                <td><?php echo $row_armas["estado"]?></td>
                                <?php
                                    $data_movimiento = movimiento_armas($codigo_equipo);
                                    foreach($data_movimiento as $row_movimiento) {
                                        $codigo_movimitento=$row_movimiento["codigo_equipo"];
                                ?>
                                <td><?php echo $row_movimiento["nombre_ubicacion"];?></td>
                                <td><?php echo $row_movimiento["correlativo_movimiento"];?></td>
                                <td><?php echo $row_movimiento["fecha_movimiento"];?></td>
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
                    '             '=>'string',//text
                    'REPORTE DE ARMAS Y EQUIPOS'=>'string',
                    '           '=>'string',//text
                    ' '=>'string',
                    ''=>'string',
                );
                $header2 = array(
                );
                $header2['            ']='string';
                $header2['           ']='string';
                $header2['          ']='string';
                $header2['        ']='string';
                $header2['       ']='string';
                $header2['      ']='string';
                $header2[$fecha_actual]='string';
                /* ************** */

                /* *******CUERPO***** */
                $writer = new XLSXWriter();                                            /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
                $writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[25,20,20,50,20,20,40,20,80,20,30,20,10,50,10,20,10,30,50,50,50]]);
                $writer->writeSheetHeader('Sheet1', $header1,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2,$styles8);
                
                $data_tipo_armas = tipo_armas();
                foreach($data_tipo_armas as $row_tipo_arma) {
                    $id_tipo_arma=$row_tipo_arma["id"];


                    $subtitulo="TIPO DE ARMA : ".$row_tipo_arma["nombre_tipo"];
                    $header3 = array();
                    $header3[$subtitulo]='string';
                    $header4 = array(
                        'MARCA'=>'string',//text
                        'SERIE'=>'string',//text
                        'CALIBRE'=>'string',
                        'MODELO'=>'string',
                        'VENCIMIENTO'=>'string',
                        'ESTATUS'=>'string',
                        'UBICACION'=>'string',
                        'TRANSACCION'=>'string',
                        'FECHA'=>'string',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);

                    $data_armas = armas($id_tipo_arma);
                    foreach($data_armas as $row_armas) {
                        $codigo_equipo=$row_armas["codigo"];
                    
                  
                        $marca=$row_armas["marca"];
                        $numero_serie =$row_armas["numero_serie"];
                        $tipo_municion=$row_armas["tipo_municion"];
                        $modelo=$row_armas["modelo"];
                        $fecha_vencimiento=$row_armas["fecha_vencimiento"];
                        $estado=$row_armas["estado"];
                     

                        /* ********* */
                        $row_empleado = array();
                        $row_empleado[$marca]='string';
                        $row_empleado[$numero_serie]='string';
                        $row_empleado[$tipo_municion]='string';
                        $row_empleado[$modelo]='string';
                        $row_empleado[$fecha_vencimiento]='string';
                        $row_empleado[$estado]='string';

                        $data_movimiento = movimiento_armas($codigo_equipo);
                        foreach($data_movimiento as $row_movimiento) {
                            $nombre_ubicacion=$row_movimiento["nombre_ubicacion"];
                            $correlativo_movimiento=$row_movimiento["correlativo_movimiento"];
                            $fecha_movimiento=$row_movimiento["fecha_movimiento"];

                            $row_empleado[$nombre_ubicacion]='string';
                            $row_empleado[$correlativo_movimiento]='string';
                            $row_empleado[$fecha_movimiento]='string';
                        }
                      
                        $writer->writeSheetHeader('Sheet1', $row_empleado);

                    }
                }

                $writer->writeToFile('vistas/modulos/Reporte_inventario_armas.xlsx');
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