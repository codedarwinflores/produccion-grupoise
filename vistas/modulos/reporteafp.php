

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

     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <a href='vistas/modulos/Reporte_hora_extra.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
      $numero=$_POST["numero"];
      /* $banco_value=""; */
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero) {
            $query = "SELECT * FROM `planilladevengo_admin` where  numero_planilladevengo_admin='$numero'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero) {
            $query = "SELECT * FROM `planilladevengo_admin` where numero_planilladevengo_admin='$numero' limit 1";
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
        function banco($id1) {
            $query = "SELECT* FROM bancos where  id='$id1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos($idempleado1) {
            $query = "SELECT SUM(valor) as sumavalor FROM tbl_empleados_devengos_descuentos where  id_empleado='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function afp() {
            $query = "SELECT*FROM afp";
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

          $fechaActual = date("d-m-Y"); 
        ?>
       

      <div class="col-md-12" align="center">
        <h4>PROVISION AFP</h4>
      </div>

             <?php
                 $data_afp = afp();
                 foreach($data_afp as $row_afp) {
            ?>
            <h4><?php echo "AFP ".$row_afp["codigo"]." ".$row_afp["nombre"]?></h4>
            
            <div class="table-responsive">
                        <table  class="table table-bordered table-striped dt-responsive tablas" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>NUP.</th>
                                        <th>1 Nombre</th>
                                        <th>2 Nombre</th>
                                        <th>3 Nombre</th>
                                        <th>1 Apellido</th>
                                        <th>2 Apellido</th>
                                        <th>De Casada</th>
                                        <th>SUELDO</th>
                                        <th>DIAS OBS.</th>
                                        <th>UBICACION</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                        $cuenta=0;
                        $correlativo=1;
                        $data_planilla_admin = planilla_admin($numero);
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin["id"];
                            $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                    ?>                
                    <?php
                        $data_empleado = empleado($idempleado);
                        $codigo_empleado="";
                        foreach($data_empleado as $row_empleado) {
                            $codigo_empleado=$row_empleado["codigo_empleado"]; 
                    ?>
                                <!-- ***************************** -->
                            <?php if($row_empleado["codigo_afp"]==$row_afp["codigo"])
                                    {
                            ?>
                                <tr>
                                    <td><?php echo $correlativo++?></td>
                                    <td><?php echo $row_empleado["nup"]?></td>
                                    <td><?php echo $row_empleado["primer_nombre"]?></td>
                                    <td><?php echo $row_empleado["segundo_nombre"]?></td>
                                    <td><?php echo $row_empleado["tercer_nombre"]?></td>
                                    <td><?php echo $row_empleado["primer_apellido"]?></td>
                                    <td><?php echo $row_empleado["segundo_apellido"]?></td>
                                    <td><?php echo $row_empleado["apellido_casada"]?></td>
                                    <td><?php echo $row_empleado["sueldo"]?></td>
                                    <td><?php echo "************"?></td>

                                    <?php
                                     $data_empleado_ubi = empleado_ubi($codigo_empleado);
                                     foreach($data_empleado_ubi as $row_empleado_ubi) {
                                    ?>
                                        <td><?php echo $row_empleado_ubi["nombre_ubicacion"]?></td>
                                    <?php
                                        }
                                    ?>


                                </tr>
                              
                                <?php
                                 }
                                ?>
                                <!-- ************************ -->

                                <?php
                                 }
                                ?>
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
                $header2['LISTADO DE HORAS EXTRAS']='string';
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
                        'UBICACION'=>'string',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);
                
                $data_planilla_admin =planilla_admin($numero);
                foreach($data_planilla_admin as $row_data_planilla_admin) {
                    $id=$row_data_planilla_admin["id"];
                    $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                    $hora_extra=$row_data_planilla_admin["hora_extra_diurna_planilladevengo_admin"];


                  
                        $nombre_empleado_planilladevengo_admin=$row_data_planilla_admin["nombre_empleado_planilladevengo_admin"];
                        $hora_extra_diurna_planilladevengo_admin =$row_data_planilla_admin["hora_extra_diurna_planilladevengo_admin"];
                       
                     
                        /* ********* */
                        $row_empleado = array();
                        $row_empleado[$nombre_empleado_planilladevengo_admin]='string';
                        $row_empleado[$hora_extra_diurna_planilladevengo_admin]='string';

                        $data_empleado = empleado($idempleado);
                        $codigo_empleado="";
                        foreach($data_empleado as $row_empleado_data) {
                           $valorhora=$row_empleado_data["hora_extra_diurna"];

                           $hora_extra_diurna=$row_empleado_data["hora_extra_diurna"];
                           $codigo_empleado=$row_empleado["codigo_empleado"];

                           $row_empleado[$hora_extra_diurna]='string';
                           $row_empleado[$cuenta." "]='string';
                        }
                        $data_empleado_ubi = empleado_ubi($codigo_empleado);
                        foreach($data_empleado_ubi as $row_empleado_ubi) {
                            $nombre_ubicacion=$row_empleado_ubi["nombre_ubicacion"];
                            $row_empleado[$nombre_ubicacion]='string';
                        }
                        $writer->writeSheetHeader('Sheet1', $row_empleado);

                    
                }

                $writer->writeToFile('vistas/modulos/Reporte_hora_extra.xlsx');
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