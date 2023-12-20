

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

      <a href='generarreportesituacion' class="btn btn-danger">
        Volver
      </a>
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <a href='vistas/modulos/Reporte_incapacidades.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
      $numero=$_POST["numero"];
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero) {
            $query = "SELECT * FROM `planilladevengo_admin` where dias_incapacidad!='' and numero_planilladevengo_admin='$numero'  and dias_incapacidad IS NOT NULL and dias_incapacidad != '0' and dias_incapacidad != '00'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero) {
            $query = "SELECT * FROM `planilladevengo_admin` where dias_incapacidad!='' and numero_planilladevengo_admin='$numero' limit 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleado($id) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleado_ubi($codigo) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.* FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados` where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and codigo_agente='$codigo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        ?>     
        <?php
          $data_planilla_admin_data = planilla_admin_data($numero);
          $numero_planilla="";
          $fecha_planilla_desde="";
          $fecha_planilla_hasta="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla.=$row_data_planilla_admin_data["numero_planilladevengo_admin"];
              $fecha_planilla_desde.=$row_data_planilla_admin_data["fecha_desde_planilladevengo_admin"];
              $fecha_planilla_hasta.=$row_data_planilla_admin_data["fecha_hasta_planilladevengo_admin"];
          }
        ?>

      <div class="col-md-12" align="center">
        <h4>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</h4>
        <h5> LISTADO DE INCAPACIDADES</h5>
        <h5> PLANILLA No. <?php echo $numero_planilla?></h5>
        <h5> PLANILLA ADMINISTRATIVA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta?></h5>
      </div>
        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <th>EMPLEADO</th>
                            <th>CANTIDAD</th>
                            <th>VALOR HORA</th>
                            <th>VALORES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cuenta=0;
                        $global_cantidad=0;
                        $global_valor=0;
                        $global_valores=0;

                        $data_planilla_admin = planilla_admin($numero);
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin["id"];
                            $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                            $hora_extra=$row_data_planilla_admin["dias_incapacidad"];
                            $global_cantidad+=floatval($hora_extra);
                    ?>                          
         
                            <tr>
                                <td><?php echo $row_data_planilla_admin["nombre_empleado_planilladevengo_admin"]?></td>
                                <td><?php echo $row_data_planilla_admin["dias_incapacidad"]?></td>
                                <?php
                                 $data_empleado = empleado($idempleado);
                                 $codigo_empleado="";
                                 foreach($data_empleado as $row_empleado) {
                                    $valorhora=$row_empleado["sueldo_diario"];
                                    $cuenta=floatval($hora_extra)*floatval($valorhora);
                                    $codigo_empleado=$row_empleado["codigo_empleado"];

                                    
                                    $global_valor+=floatval(bcdiv($row_empleado["sueldo_diario"],'1', 2));
                                    $global_valores+=floatval($cuenta);
                                ?>
                                    <td><?php echo bcdiv($row_empleado["sueldo_diario"],'1', 2)?></td>
                                <?php
                                 }
                                ?>
                                <td><?php echo $cuenta?></td>
                                
                            </tr>
                    <?php
                        }
                    ?>
                     <tr>
                        <td>TOTAL GENERAL</td>
                        <td><?php echo bcdiv($global_cantidad,'1', 2)?></td>
                        <td><?php echo bcdiv($global_valor,'1', 2)?></td>
                        <td><?php echo bcdiv($global_valores,'1', 2)?></td>
                    </tr>
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
                    'INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.'=>'string',
                    '             '=>'string',//text
                    '           '=>'string',//text
                    ' '=>'string',
                    ''=>'string',
                );
                $header2 = array(
                );
                $header2['            ']='string';
                $header2['           ']='string';
                $header2['LISTADO DE INCAPACIDADES']='string';
                $header2['        ']='string';
                $header2['       ']='string';
                $header2['      ']='string';
                $header2['']='string';

                $header2_2 = array(
                );
                $des_numero='PLANILLA No. '.$numero_planilla;
                $header2_2['            ']='string';
                $header2_2['           ']='string';
                $header2_2[$des_numero]='string';
                $header2_2['        ']='string';
                $header2_2['       ']='string';
                $header2_2['      ']='string';
                $header2_2['']='string';

                $header2_3 = array(
                );
                $des_rango='PLANILLA ADMINISTRATIVA DEL '.$fecha_planilla_desde.' AL '.$fecha_planilla_hasta.'';
                $header2_3['            ']='string';
                $header2_3['           ']='string';
                $header2_3[$des_rango]='string';
                $header2_3['        ']='string';
                $header2_3['       ']='string';
                /* ************** */

                /* *******CUERPO***** */
                $writer = new XLSXWriter();                                            /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
                $writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[50,20,55,20,20,20,40,20,80,20,30,20,10,50,10,20,10,30,50,50,50]]);
                $writer->writeSheetHeader('Sheet1', $header1,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_2,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_3,$styles8);
                
                    /* $subtitulo="TIPO DE ARMA : ".$row_tipo_arma["nombre_tipo"]; */
                    $header3 = array();
                    /* $header3[$subtitulo]='string'; */
                    $header4 = array(
                        'EMPLEADO'=>'string',//text
                        'CANTIDAD'=>'string',//text
                        'VALOR HORA'=>'string',
                        'VALORES'=>'string',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);
                
                $data_planilla_admin =planilla_admin($numero);
                foreach($data_planilla_admin as $row_data_planilla_admin) {
                    $id=$row_data_planilla_admin["id"];
                    $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                    $hora_extra=$row_data_planilla_admin["dias_incapacidad"];


                  
                        $nombre_empleado_planilladevengo_admin=$row_data_planilla_admin["nombre_empleado_planilladevengo_admin"];
                        $dias_incapacidad =$row_data_planilla_admin["dias_incapacidad"];
                       
                     
                        /* ********* */
                        $row_empleado = array();

                        $data_empleado = empleado($idempleado);
                        $codigo_empleado="";
                        foreach($data_empleado as $row_empleado_data) {


                            $nombre_empleado=trim($row_empleado_data["primer_apellido"])." ".trim($row_empleado_data["segundo_apellido"])." ".trim($row_empleado_data["apellido_casada"])." ".trim($row_empleado_data["primer_nombre"])." ".trim($row_empleado_data["segundo_nombre"])." ".trim($row_empleado_data["tercer_nombre"]);

                                
                            $row_empleado[$nombre_empleado]='string';
                            $row_empleado[$dias_incapacidad]='string';


                           $valorhora=$row_empleado_data["sueldo_diario"];
                           $hora_extra_diurna=$row_empleado_data["sueldo_diario"];
                    

                           $row_empleado[$hora_extra_diurna]='string';
                           $row_empleado[$cuenta."  "]='string';
                        }
                        
                        $writer->writeSheetHeader('Sheet1', $row_empleado);

                    
                }

                $writer->writeToFile('vistas/modulos/Reporte_incapacidades.xlsx');
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