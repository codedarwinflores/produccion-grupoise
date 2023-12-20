

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
        text-align: center;   
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
      <!-- <a href='vistas/modulos/Reporte deposito.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <br>
      <br>
      <div class="btnreporte" style="display:none">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccionar Opción a imprimir
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <button id="exportExcel" class="dropdown-item btn btn-success btnreporte" style="display:none">Exportar a Excel</button>
            </div>
        </div>
       </div>
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
      $numero=$_POST["numero"];
      $banco_value=$_POST["banco"];
      /* nuevos */
      $ubicacion=$_POST["ubicacion"];
      $tipo_empleado=$_POST["tipo_empleado"];
      $tipoplanilla=$_POST["tipo_planilla"];

      function nombre_columnas($tipoplanilla)
        {
            $query = "SHOW COLUMNS FROM $tipoplanilla";
            $stmt = Conexion::conectar()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt = null;
        }
        
		$datamodificar=nombre_columnas($tipoplanilla);
		$columna_nombre = array();
		$indice = 1; // Comenzar desde 1
		foreach ($datamodificar as $row) {
		    $columna_nombre[$indice] = $row['Field'];
			$indice++;
		}
		$numero_planilla=$columna_nombre[2];
		$fecha_desde=$columna_nombre[4];
		$fecha_hasta=$columna_nombre[5];
      

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
        function empleado($id,$idbando1) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id and id_banco=$idbando1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        /* solo tipo empleado */
        function empleado_tipo($id,$idbando1,$tipo) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id and id_banco=$idbando1 and tipo_empleado='$tipo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo ubicacion */
        function empleado_ubi($codigo,$idubicacion,$idbando1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* , clientes.*
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_empleados.id_banco=$idbando1 and
                              clientes.id='$idubicacion'";
                              
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /*  ubicacion y tipo empleado */
        function empleado_ubi_tipo($codigo,$idubicacion,$tipo_empleado1,$idbando1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.*, clientes.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados,clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                              codigo_agente='$codigo' and 
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and 
                              tbl_empleados.id_banco=$idbando1 and
                              clientes.id='$idubicacion'";
                              
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo toma el nombre de la ubicacion */
        function empleado_ubi_only($idubicacion) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* ,clientes.*
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                             clientes.id='$idubicacion' limit 1";
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
        function devengos($idempleado1,$numero) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM tbl_devengo_descuento_planilla_admin where  idempleado_devengo='$idempleado1' and codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='No' and afp_devengo_devengo_descuento_planilla='No' and renta_devengo_devengo_descuento_planilla='No' and tipo_valor like'%suma%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_contodo($idempleado1,$numero) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM tbl_devengo_descuento_planilla_admin where  idempleado_devengo='$idempleado1' and (codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and afp_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and renta_devengo_devengo_descuento_planilla='Si') and tipo_valor like'%suma%'";
            
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
         <?php
          $data_banco = banco($banco_value);
          $nombre_banco="";
          foreach($data_banco as $row_banco) {
              $nombre_banco.=$row_banco["nombre"];
          }

        ?>

      <div class="col-md-12" align="center">
        <?php
        if($ubicacion!="*"){
            $dataubicacion = empleado_ubi_only($ubicacion);
            $nombre_ubicacion="";
              foreach($dataubicacion as $row) {
                $nombre_ubicacion=$row["nombre"];
              }
        }?>
        <h4><?php echo $nombre_ubicacion?> </h4>
      </div>

      <!--  -->
        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th colspan="9">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</th>
                        </tr>
                        <tr>
                            <th colspan="9">FECHA    <?php  echo $fechaActual ?></th>
                        </tr>
                        <tr>
                            <th colspan="9">PLANILLA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta?></th>
                        </tr>
                        <tr>
                            <th colspan="9">PLANILLA No.   <?php echo $numero?></th>
                        </tr>
                        <tr>
                            <th colspan="9"> <?php echo $nombre_banco?></th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>NOMBRE COMPLETO</th>
                            <th>CUENTA</th>
                            <th> A DEPOSITAR</th>
                            <th>EFECTIVO</th>
                            <th>ADMINISTRATIVA</th>
                            <th>DEVENGOS</th>
                            <th>TOTAL</th>
                            <th>DIFERENCIA</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cuenta=0;
                        $data_planilla_admin = planilla_admin($numero);
                        $depositar_global=0;
                        $efectivo_global=0;
                        $administrativa_global=0;
                        $devengos_global=0;
                        $total_global=0;
                        $referencia_global=0;
                        $correlativo=0;
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin["id"];
                            $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                            $codigo=$row_data_planilla_admin["codigo_empleado_planilladevengo_admin"];
                    ?>                
                                <?php
                                 $data_empleado = empleado($idempleado,$banco_value);
                                 if($ubicacion!="*" && $tipo_empleado=="*"){
                                    $data_empleado=empleado_ubi($codigo,$ubicacion,$banco_value);
                                 }
                                 else if($tipo_empleado!="*" && $ubicacion=="*"){
                                    $data_empleado = empleado_tipo($idempleado,$banco_value,$tipo_empleado);
                                }
                                 else if($ubicacion!="*" && $tipo_empleado!="*"){
                                    $data_empleado=empleado_ubi_tipo($codigo,$ubicacion,$tipo_empleado,$banco_value);
                                 }
                                 else if($ubicacion=="*" && $tipo_empleado=="*"){
                                     $data_empleado = empleado($idempleado,$banco_value);
                                 }

                                 $codigo_empleado="";
                                 foreach($data_empleado as $row_empleado) {
                                     $correlativo++;

                                ?>
                                
                                <tr>
                                        <td><?php echo $row_empleado["codigo_empleado"]?></td>
                                        <td><?php echo $row_data_planilla_admin["nombre_empleado_planilladevengo_admin"]?></td>
                                         <!-- cuenta -->
                                        <td><?php echo $row_empleado["numero_cuenta"]?></td>
                                         <!-- a depositar -->
                                        <?php 
                                        $numero_cuenta="";
                                        if($row_empleado["numero_cuenta"]=="")
                                        {
                                            $numero_cuenta="".str_repeat(" ",3);
                                        }
                                        else{  
                                            $numero_cuenta=$row_data_planilla_admin["total_liquidado_planilladevengo_admin"].str_repeat(" ",3);
                                        }
                                        $depositar_global+=floatval($numero_cuenta);
                                        echo "<td>".bcdiv(floatval($numero_cuenta),'1', 2)."</td>";
                                       ?>
                                        <!-- efectivo -->
                                      <?php 
                                        $efectivo=0;
                                        if($row_empleado["numero_cuenta"]=="")
                                        {
                                            $efectivo_global+=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);
                                            $efectivo=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);
                                            echo "<td>".bcdiv($row_data_planilla_admin["total_liquidado_planilladevengo_admin"],'1', 2)."</td>";
                                        }
                                        else{    
                                            $efectivo_global+=0.00;
                                        $efectivo=0;  
                                           echo"<td></td>";
                                        }
                                       ?>
                                       <!-- administratica -->
                                       <?php
                                       $administrativa=0;
                                        if($row_data_planilla_admin["descuento_isss_planilladevengo_admin"]=="0"){
                                            echo "<td>0.00</td>";
                                            $administrativa=0;
                                            $administrativa_global+=0.00;

                                        }
                                        else{

                                            $data_devengos = devengos($idempleado,$numero);
                                            $devengos_nograbados=0;
                                            foreach($data_devengos as $row_devengo) {
                                                $devengos_nograbados=bcdiv($row_devengo["sumadevengo"],'1', 2);
                                            }


                                            $data_devengos = devengos_contodo($idempleado,$numero);
                                            $sumadevengo01="";
                                            foreach($data_devengos as $row_devengo) {
                                                $sumadevengo01=$row_devengo["sumadevengo"];
                                            }
                                            if($sumadevengo01==""){
                                                $sumadevengo01="0.00";
                                            }
                                            $sumadevengo01=floatval($sumadevengo01)+floatval($numero_cuenta);
                                            $sumadevengo01=$sumadevengo01-$devengos_nograbados;
                                            $administrativa=$sumadevengo01;
                                            echo "<td>".bcdiv($sumadevengo01,'1', 2)."</td>";
                                            $administrativa_global+=floatval($sumadevengo01);
                                        }
                                        ?>
                                        <!-- devengos -->
                                       <?php
                                        
                                        $data_devengos = devengos($idempleado,$numero);
                                        foreach($data_devengos as $row_devengo) {
                                            echo"<td>".bcdiv($row_devengo["sumadevengo"],'1', 2)."</td>";
                                            $devengos_global+=floatval($row_devengo["sumadevengo"]);
                                        }
                                        
                                        ?>
                                        <!-- total -->
                                        <td>
                                            <?php 
                                                $suma=floatval($efectivo)+floatval($administrativa);
                                                $total=$row_data_planilla_admin["total_liquidado_planilladevengo_admin"];
                                                echo bcdiv($row_data_planilla_admin["total_liquidado_planilladevengo_admin"],'1', 2);
                                                $total_global+=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);

                                               /*  echo $suma; */
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $liquido_menos_total=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"])-floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);
                                            echo bcdiv($liquido_menos_total,'1', 2);
                                            $referencia_global+=floatval($liquido_menos_total);
                                            ?>
                                        </td>
                                </tr>

                                <?php
                                 }
                                ?>
                               
                    <?php
                        }
                    ?>
                    <tr>
                        <td>Son:</td>
                        <td><?php echo $correlativo;?></td>
                        <td></td>
                        <td><?php echo bcdiv($depositar_global,'1', 2);?></td>
                        <td><?php echo bcdiv($efectivo_global,'1', 2);?></td>
                        <td><?php echo bcdiv($administrativa_global,'1', 2);?></td>
                        <td><?php echo bcdiv($devengos_global,'1', 2);?></td>
                        <td><?php echo bcdiv($total_global,'1', 2);?></td>
                        <td><?php echo bcdiv($referencia_global,'1', 2);?></td>
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
                    '             '=>'string',//text
                    '            '=>'string',//text
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
                $header2['         ']='string';
                $header2['        ']='string';
                $header2['FECHA:'.$fecha_actual]='string';
                $header2['        ']='string';
                $header2['       ']='string';
                $header2['      ']='string';
                $header2['']='string';

                $header2_2 = array(
                );
                $des_numero='PLANILLA No. '.$numero_planilla;
                $header2_2['            ']='string';
                $header2_2['           ']='string';
                $header2_2['          ']='string';
                $header2_2['         ']='string';
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
                $header2_3['          ']='string';
                $header2_3['         ']='string';
                $header2_3[$des_rango]='string';
                $header2_3['        ']='string';
                $header2_3['       ']='string';


                
                $header2_4 = array(
                );
                $header2_4['            ']='string';
                $header2_4['           ']='string';
                $header2_4['          ']='string';
                $header2_4['         ']='string';
                $header2_4[$nombre_banco]='string';
                $header2_4['        ']='string';
                $header2_4['       ']='string';
                /* ************** */

                
                if($ubicacion!="*"){
                    $dataubicacion = empleado_ubi_only($ubicacion);
                    $nombre_ubicacion="";
                      foreach($dataubicacion as $row) {
                        $nombre_ubicacion=$row["nombre_ubicacion"];
                      }
                }
            
                $header2_5 = array(
                );
                $header2_5['            ']='string';
                $header2_5['           ']='string';
                $header2_5['          ']='string';
                $header2_5['         ']='string';
                $header2_5[$nombre_ubicacion]='string';
                /* ************** */

                /* *******CUERPO***** */
                $writer = new XLSXWriter();                                            /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
                $writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[10,50,20,20,20,20,20,20,20,20,20,20,10,50,10,20,10,30,50,50,50]]);
                $writer->writeSheetHeader('Sheet1', $header1,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_2,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_3,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_4,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_5,$styles8);
                
                    /* $subtitulo="TIPO DE ARMA : ".$row_tipo_arma["nombre_tipo"]; */
                    $header3 = array();
                    /* $header3[$subtitulo]='string'; */
                    $header4 = array(
                        'No.'=>'integer',//text
                        'NOMBRE COMPLETO'=>'string',//text
                        'CUENTA'=>'string',
                        'A DEPOSITAR'=>'integer',
                        'EFECTIVO'=>'integer',
                        'ADMINISTRATIVA'=>'integer',
                        'DEVENGOS'=>'integer',
                        'TOTAL'=>'integer',
                        'DIFERENCIA'=>'integer',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);
                
                $data_planilla_admin =planilla_admin($numero);
                $correlativo=1;
                foreach($data_planilla_admin as $row_data_planilla_admin) {
                    $id=$row_data_planilla_admin["id"];
                    $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                    $codigo=$row_data_planilla_admin["codigo_empleado_planilladevengo_admin"];

                     $row_empleado_excel = array();

                        /* ********* */
                        $data_empleado = empleado($idempleado,$banco_value);
                        if($ubicacion!="*"){
                            $data_empleado=empleado_ubi($codigo,$ubicacion,$banco_value);
                         }
                         else if($tipo_empleado!="*"){
                            $data_empleado=empleado_tipo($idempleado,$banco_value,$tipo_empleado);
                         }
                         else if($ubicacion!="*" || $tipo_empleado!="*"){
                            $data_empleado=empleado_ubi_tipo($codigo,$ubicacion,$tipo_empleado,$banco_value);
                         }
                         else if($ubicacion=="*" || $tipo_empleado=="*"){
                             $data_empleado = empleado($idempleado,$banco_value);
                         }


                        foreach($data_empleado as $row_empleado) {
                            $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];

                            $numero_cuenta="";
                            if($row_empleado["numero_cuenta"]=="")
                            {
                                $numero_cuenta="".str_repeat(" ",3);
                            }
                            else{  
                                $numero_cuenta=$row_data_planilla_admin["total_liquidado_planilladevengo_admin"].str_repeat(" ",3);
                            }
                            /*-------------  */
                            $efectivo=0;
                            if($row_empleado["numero_cuenta"]=="")
                            {
                                $efectivo=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);
                            }
                            else{    
                            $efectivo=0;  
                            }
                            /* ------------------ */
                            $administrativa=0;
                            if($row_data_planilla_admin["descuento_isss_planilladevengo_admin"]=="0"){
                                 $administrativa=0;
                            }
                            else{
                                $data_devengos = devengos_contodo($idempleado,$numero);
                                $sumadevengo01="";
                                foreach($data_devengos as $row_devengo) {
                                    $sumadevengo01=$row_devengo["sumadevengo"];
                                }
                                if($sumadevengo01==""){
                                    $sumadevengo01="0.00";
                                }
                                $administrativa=$sumadevengo01;
                            }
                        /* -------------- */
                        $devengos="";
                        if($row_data_planilla_admin["descuento_isss_planilladevengo_admin"]=="0"){
                            $devengos=$row_data_planilla_admin["total_liquidado_planilladevengo_admin"];
                        }
                        else{
                            $data_devengos = devengos($idempleado,$numero);
                            foreach($data_devengos as $row_devengo) {
                                $devengos=$row_devengo["sumadevengo"];
                            }
                        }
                        /* ---------------- */
                        $suma=floatval($efectivo)+floatval($administrativa);
                        $total=$row_data_planilla_admin["total_liquidado_planilladevengo_admin"];
                       
                        /* ------------ */
                        $liquido_menos_total=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"])-floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);
                        
                           $row_empleado_excel[]=$row_empleado["codigo_empleado"].str_repeat(" ",1);
                           $row_empleado_excel[]=$nombre_empleado.str_repeat(" ",2);
                           $row_empleado_excel[]=$row_empleado["numero_cuenta"].str_repeat(" ",3);
                           $row_empleado_excel[]=$numero_cuenta.str_repeat(" ",4);
                           $row_empleado_excel[]=$efectivo.str_repeat(" ",5);
                           $row_empleado_excel[]=$administrativa.str_repeat(" ",6);
                           $row_empleado_excel[]=$devengos.str_repeat(" ",8);
                           $row_empleado_excel[]=$total.str_repeat(" ",9);
                           $row_empleado_excel[]=$liquido_menos_total.str_repeat(" ",10);

                           $writer->writeSheetRow('Sheet1', $row_empleado_excel);    

                           
                        }
                      /*   $writer->writeSheetHeader('Sheet1', $row_empleado); */
                    /* $start_row=FILA_DESDE, $start_col=COLUMNA_DESDE, $end_row=FILA_DESDE, $end_col=COLUMNA_HASTA */
                    
                }

                
                $titulos_total = array(
                    'Son'=>'integer',//text
                    ' '.$correlativo.str_repeat(" ",2)=>'integer',//text
                    '  '=>'string',
                    '   '.$depositar_global=>'integer',
                    '    '.$efectivo_global=>'integer',
                    '     '.$administrativa_global=>'integer',
                    '      '.$devengos_global=>'integer',
                    '       '.$total_global=>'integer',
                    '        '.$referencia_global=>'integer',
                );
                
                $stylesfinal = array( ['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right']);
                $writer->writeSheetHeader('Sheet1', $titulos_total,$stylesfinal);



                $writer->markMergedCell('Sheet1', $start_row=1, $start_col=4, $end_row=1, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=2, $start_col=4, $end_row=2, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=3, $start_col=4, $end_row=3, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=4, $start_col=4, $end_row=4, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=5, $start_col=4, $end_row=5, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=6, $start_col=4, $end_row=6, $end_col=6);
                /* $writer->markMergedCell('Sheet1', $start_row=1, $start_col=4, $end_row=1, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=2, $start_col=4, $end_row=2, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=3, $start_col=4, $end_row=3, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=4, $start_col=4, $end_row=4, $end_col=6);
                $writer->markMergedCell('Sheet1', $start_row=5, $start_col=4, $end_row=4, $end_col=6); */
                $writer->writeToFile('vistas/modulos/Reporte deposito.xlsx');
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


    
    /* reporte Excel */
    $(document).ready(function () {



$("#exportExcel").click(function () {
    var tablaHtml = document.getElementById("tabladatos");
    var ws = XLSX.utils.table_to_sheet(tablaHtml);
    var wb = XLSX.utils.book_new();
    ws['!cols'][1] = { wch: 50, };
    ws['!cols'][2] = { wch: 30, };
    ws['!cols'][5] = { wch: 20, };
    ws['!cols'][6] = { wch: 20, };
    ws['!cols'][7] = { wch: 20, };
    /* for (var i in ws) {
        console.log(i+" aui");
            if (typeof ws[i] != 'object') continue;
            let cell = XLSX.utils.decode_cell(i);
            ws[i].s = {
                alignment: {
                vertical: 'center',
                horizontal: 'center',
                wrapText: '1',
                },
            };
        } */
        for (var i = 1; i < 6; i++) {
            var letra="A"+i;
            ws[letra].s = {
                    alignment: {
                    vertical: 'center',
                    horizontal: 'center',
                    wrapText: '1',
                    },
                };
        }
            
    XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
    /* XLSX.writeFile(wb, "tabla.xlsx"); */
    XLSX.writeFile(wb, "REPORTE BANCO.xlsx");
});


});
</script>