

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


      <!-- *********************** -->

      <?php
      $numero=$_POST["numero"];
      
      /* nuevos */
      $ubicacion=$_POST["ubicacion"];
      $tipo_empleado=$_POST["tipo_empleado"];

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


        /* solo tipo empleado */
        function empleado_tipo($id,$tipo) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id  and tipo_empleado='$tipo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo ubicacion */
        function empleado_ubi($codigo,$idubicacion) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /*  ubicacion y tipo empleado */
        function empleado_ubi_tipo($codigo,$idubicacion,$tipo_empleado1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and 
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo toma el nombre de la ubicacion */
        function empleado_ubi_only($idubicacion) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion' limit 1";
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
        function devengo_vacacion($idempleado1,$numero1) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla_admin where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengo_feriados($idempleado1,$numero1) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla_admin where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_planilla_admin_data($numero) {
            $query = "SELECT SUM(sueldo_planilladevengo_admin) AS sumasueldo,SUM(otro_devengo_admin_planilladevengo_admin) AS sumaotrodevengo,SUM(total_devengo_admin_planilladevengo_admin) AS sumatotaldevengo,SUM(descuento_isss_planilladevengo_admin) AS sumaisss, SUM(descuento_afp_planilladevengo_admin) AS sumaafp,SUM(descuento_renta_planilladevengo_admin) AS sumarenta,SUM(otro_descuento_planilladevengo_admin) AS sumaotrodescuento, SUM(total_descuento_planilladevengo_admin) AS totaldescuento,SUM(total_liquidado_planilladevengo_admin) AS totalliquido  FROM `planilladevengo_admin` where numero_planilladevengo_admin='$numero' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_devengo_vacacion($numero1) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla_admin where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function suma_devengo_feriados($numero1) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla_admin where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' ";
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
       

       
     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <!-- <a href='vistas/modulos/Reporte planilla no contable.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
        <button id="exportExcel" class="btn btn-primary btnreporte">Exportar a Excel</button>
        <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>


    
      <!-- <div class="col-md-12" align="center" >
        <h5>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</h5>
        <h5>FECHA    <?php echo $fechaActual ?></h5>
        <h5> PLANILLA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta?></h5>
        <h5> PLANILLA No.   <?php echo $numero?></h5>
      </div> -->

      
      <?php
       if($ubicacion!="*"){
        $dataubicacion = empleado_ubi_only($ubicacion);
          foreach($dataubicacion as $row) {
            echo "<h4>".$row["nombre_ubicacion"]."</h4>";
          }
        }
      ?>

      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive " id="tabladatos" width="100%">
                    <thead>
                        <tr>
                            <th colspan="14">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</th>
                        </tr>
                        <tr>
                            <th colspan="14">FECHA    <?php echo $fechaActual ?></th>
                        </tr>
                        <tr>
                            <th colspan="14">PLANILLA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta?></th>
                        </tr>
                        <tr>
                            <th colspan="14">PLANILLA No.   <?php echo $numero?></th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>NOMBRE COMPLETO</th>
                            <th>DIAS</th>
                            <th>SUELDO</th>
                            <th>VACACION</th>
                            <th>DIAS FESTIVOS</th>
                            <th>OTROS DEVENGOS</th>
                            <th>TOTAL DEVENGADO</th>
                            <th>ISSS</th>
                            <th>AFP</th>
                            <th>RENTA</th>
                            <th>O. DESC.</th>
                            <th>T. DESC.</th>
                            <th>T. LIQUIDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cuenta=0;
                            $correlativo=1;
                            $data_planilla_admin = planilla_admin($numero);

                            $sueldo_global=0;
                            $vacaion_global=0;
                            $diasfesti_global=0;
                            $otrodevengo=0;
                            $totaldevengo_global=0;
                            $isss_global=0;
                            $afp_global=0;
                            $renta_global=0;
                            $otrodesc_global=0;
                            $totaldescuento_global=0;
                            $totalliquido_global=0;

                            foreach($data_planilla_admin as $row_data_planilla_admin) {
                                $id=$row_data_planilla_admin["id"];
                                $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                                $codigo=$row_data_planilla_admin["codigo_empleado_planilladevengo_admin"];


                        ?>                
                                <?php
                                 $data_empleado = empleado($idempleado);
                                 if($ubicacion!="*"){
                                    $data_empleado=empleado_ubi($codigo,$ubicacion);
                                    
                                 }
                                 else if($tipo_empleado!="*"){
                                    $data_empleado = empleado_tipo($idempleado,$tipo_empleado);
                                   
        
                                }
                                 else if($ubicacion!="*" || $tipo_empleado!="*"){
                                    $data_empleado=empleado_ubi_tipo($codigo,$ubicacion,$tipo_empleado);
                                    
        
                                 }
                                 else if($ubicacion=="*" || $tipo_empleado=="*"){
                                     $data_empleado = empleado($idempleado);
                                 }


                                 $codigo_empleado="";
                                 foreach($data_empleado as $row_empleado) {

                                    $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];
                                ?>
                                <tr>
                                    <!-- no -->
                                    <td><?php echo $correlativo++?></td>
                                    <!-- nombre empleado -->
                                    <td><?php echo $nombre_empleado?></td>
                                    <!-- dias -->
                                    <td><?php echo $row_data_planilla_admin["dias_trabajo_planilladevengo_admin"];?></td>
                                    <!-- sueldo -->
                                    <td><?php 
                                            $sueldo_global+=floatval($row_data_planilla_admin["sueldo_planilladevengo_admin"]);
                                            echo $row_data_planilla_admin["sueldo_planilladevengo_admin"];
                                            ?></td>
                                    <!-- vacacion -->
                                    <?php
                                     $data_devengos_vaca = devengo_vacacion($idempleado,$numero);
                                     $vaca='';
                                     foreach($data_devengos_vaca as $row_devengo) {
                                        $vaca=$row_devengo["sumavalor"];
                                        }
                                        if($vaca!=''){

                                            $vacaion_global+=floatval($row_devengo["sumavalor"]);
                                            echo "<td>". $row_devengo["sumavalor"]."</td>";
                                        }
                                        else{
                                            $vacaion_global+=0.00;
                                            echo "<td>0.00</td>";
                                        }
                                    ?>
                                    <!-- dias festivos -->
                                    <?php
                                     $data_devengos_feriados = devengo_feriados($idempleado,$numero);
                                     $vaca='';
                                     foreach($data_devengos_feriados as $row_devengo) {
                                        $vaca=$row_devengo["sumavalor"];
                                        }
                                        if($vaca!=''){
                                            $diasfesti_global+=floatval($vaca);
                                            echo "<td>". $vaca."</td>";
                                        }
                                        else{
                                            $diasfesti_global+=floatval("0.00");
                                            echo "<td>0.00</td>";
                                        }
                                    ?>
                                    <!-- otros devengos -->
                                    <td>
                                        <?php 
                                        $valor_horas_extras_diurna= floatval($row_data_planilla_admin["hora_extra_diurna_planilladevengo_admin"])*floatval($row_empleado["hora_extra_diurna"]);
                                        $valor_horas_extras_norturna= floatval($row_data_planilla_admin["hora_extra_nocturna_planilladevengo_admin"])*floatval($row_empleado["hora_extra_nocturna"]);
                                        $valor_horas_extras_domingo_diurna= floatval($row_data_planilla_admin["hora_extra_domingo_planilladevengo_admin"])*floatval($row_empleado["hora_extra_domingo"]);
                                        $valor_horas_extras_domingo_nocturna= floatval($row_data_planilla_admin["hora_extra_domingo_nocturna_planilladevengo_admin"])*floatval($row_empleado["hora_extra_nocturna_domingo"]);

                                        $otrosdevengos_total=floatval($row_data_planilla_admin["otro_devengo_admin_planilladevengo_admin"])+$valor_horas_extras_diurna+$valor_horas_extras_norturna+$valor_horas_extras_domingo_diurna+$valor_horas_extras_domingo_nocturna;


                                        echo floatval($otrosdevengos_total)-floatval($vaca);
                                        $otrodevengo+=floatval($otrosdevengos_total)-floatval($vaca);
                                        ?>
                                    </td>
                                    <!-- total devengo -->
                                    <td><?php  $totaldevengo_global+=floatval($row_data_planilla_admin["total_devengo_admin_planilladevengo_admin"]);
                                                echo $row_data_planilla_admin["total_devengo_admin_planilladevengo_admin"]?></td>
                                    <!-- descuento isss -->
                                    <td><?php $isss_global+=floatval($row_data_planilla_admin["descuento_isss_planilladevengo_admin"]);
                                    echo $row_data_planilla_admin["descuento_isss_planilladevengo_admin"]?></td>
                                    <!-- descuento afp -->
                                    <td><?php  $afp_global+=floatval($row_data_planilla_admin["descuento_afp_planilladevengo_admin"]);
                                    echo $row_data_planilla_admin["descuento_afp_planilladevengo_admin"]?></td>
                                    <!-- descuento renta -->
                                    <td><?php $renta_global+=floatval($row_data_planilla_admin["descuento_renta_planilladevengo_admin"]);
                                                echo $row_data_planilla_admin["descuento_renta_planilladevengo_admin"]?></td>
                                    <!-- otro descuento -->
                                    <td><?php $otrodesc_global+=floatval($row_data_planilla_admin["otro_descuento_planilladevengo_admin"]); 
                                            echo $row_data_planilla_admin["otro_descuento_planilladevengo_admin"]?></td>
                                    <!-- total descuento -->
                                    <td><?php 
                                              $totaldescuento_global+=floatval($row_data_planilla_admin["total_descuento_planilladevengo_admin"]);
                                              echo $row_data_planilla_admin["total_descuento_planilladevengo_admin"]?></td>
                                    <!-- total liquidi -->
                                    <td><?php 
                                            $totalliquido_global+=floatval($row_data_planilla_admin["total_liquidado_planilladevengo_admin"]);
                                            echo $row_data_planilla_admin["total_liquidado_planilladevengo_admin"]?></td>
                                </tr>

                                <?php
                                 }
                                ?>
                               
                    <?php
                        }
                    ?>

                    <tr>
                        <!-- no -->
                        <td>Son:</td>
                        <!-- nombre -->
                        <td><?php echo $correlativo-1;?></td>
                        <!-- dias -->
                        <td>  </td>
                        <!-- salario -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                               /*  echo "<td>".number_format($row["sumasueldo"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($sueldo_global, 2, ',', '.') ."</td>";

                        ?>
                        <!-- vacacion -->
                         <?php
                            $data_suma_vaca = suma_devengo_vacacion($numero);
                            foreach($data_suma_vaca as $row) {
                               /*  echo "<td>".number_format($row["sumavalor"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($vacaion_global, 2, ',', '.') ."</td>";

                        ?>
                        <!-- dias festivos -->
                         <?php
                            $data_suma_feriado = suma_devengo_feriados($numero);
                            $sumaferiado=0;
                            foreach($data_suma_feriado as $row) {
                                $sumaferiado=floatval($row["sumavalor"]);
                                /* echo "<td>".number_format($row["sumavalor"], 2, ',', '.') ."</td>"; */
                            }  
                            echo "<td>".number_format($diasfesti_global, 2, ',', '.') ."</td>";   
                        ?>
                        <!-- otros devengos -->
                        <?php
                                /* $total=floatval($row["sumaotrodevengo"])-$sumaferiado; */
                                echo "<td>".number_format($otrodevengo, 2, ',', '.')."</td>";
                                 
                        ?>
                        <!-- total devengo -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumatotaldevengo"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totaldevengo_global, 2, ',', '.') ."</td>";
                        ?>
                        <!-- isss -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaisss"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($isss_global, 2, ',', '.') ."</td>";
                        ?>
                        <!-- afp -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaafp"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($afp_global, 2, ',', '.') ."</td>";
                        ?>
                        <!-- renta -->
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumarenta"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($renta_global, 2, ',', '.') ."</td>";
                        ?>
                        <!-- otro descuento -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaotrodescuento"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($otrodesc_global, 2, ',', '.') ."</td>";
                        ?>
                        <!-- total descuento -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["totaldescuento"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totaldescuento_global, 2, ',', '.') ."</td>";
                        ?>
                        <!-- total liquidado -->
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["totalliquido"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totalliquido_global, 2, ',', '.') ."</td>";
                        ?>
                        
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
                    '           '=>'string',//text
                    '          '=>'string',//text
                    'INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.'=>'string',
                    '              '=>'string',//text
                    '            '=>'string',//text
                    '           '=>'string',//text
                    '          '=>'string',//text
                    '         '=>'string',//text
                    ' '=>'string',
                    ''=>'string',
                );
                $header2 = array(
                );
                $header2['            ']='string';
                $header2['           ']='string';
                $header2['          ']='string';
                $header2['         ']='string';
                $header2['        ']='string';
                $header2['       ']='string';
                $header2['FECHA '.$fecha_actual]='string';
                $header2['           ']='string';
                $header2['          ']='string';
                $header2['         ']='string';
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
                $header2_2['        ']='string';
                $header2_2['       ']='string';
                $header2_2[$des_numero]='string';
                $header2_2['        ']='string';
                $header2_2['       ']='string';
                $header2_2['          ']='string';
                $header2_2['         ']='string';
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
                $header2_3['        ']='string';
                $header2_3['       ']='string';
                $header2_3[$des_rango]='string';
                $header2_3['          ']='string';
                $header2_3['         ']='string';
                $header2_3['        ']='string';
                $header2_3['       ']='string';
                $header2_3['      ']='string';
                $header2_3['        ']='string';
                $header2_3['       ']='string';
                /* ************** */

                
                
                $header2_4 = array(
                );
                $header2_4['            ']='string';
                $header2_4['           ']='string';
                $header2_4['          ']='string';
                $header2_4['         ']='string';
                $header2_4['        ']='string';
                $header2_4['       ']='string';
                $header2_4[$des_rango]='string';
                /* *******CUERPO***** */
                $writer = new XLSXWriter();       
                                                                                       /*1,2, 3,  4 ,5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21*/  
                $writer->writeSheetHeader('Sheet1', $header0,$col_options = ['widths'=>[10,40,15,10,10,20,20,20,15,20,15,20,10,20,10,20,10,30,50,50,50]]);
                $writer->writeSheetHeader('Sheet1', $header1,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_2,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_3,$styles8);
                $writer->writeSheetHeader('Sheet1', $header2_4,$styles8);

                /* $writer->markMergedCell('Sheet1', $start_row=2, $start_col=5, $end_row=2, $end_col=7); */


                
                
                    /* $subtitulo="TIPO DE ARMA : ".$row_tipo_arma["nombre_tipo"]; */
                    $header3 = array();
                    /* $header3[$subtitulo]='string'; */
                    $header4 = array(
                        'No.'=>'integer',//text
                        'NOMBRE COMPLETO'=>'string',//text
                        'DIAS'=>'integer',
                        'SUELDO'=>'integer',
                        'VACACION'=>'integer',
                        'DIAS FESTIVOS'=>'integer',
                        'OTROS DEVENGOS	'=>'integer',
                        'TOTAL DEVENGADO	'=>'integer',
                        'ISSS'=>'integer',
                        'AFP'=>'integer',
                        'RENTA'=>'integer',
                        'O. DESC.	'=>'integer',
                        'T. DESC.	'=>'integer',
                        'T. LIQUIDO'=>'integer',
                    );
                    $writer->writeSheetHeader('Sheet1', $header3,$styles1);
                    $writer->writeSheetHeader('Sheet1', $header4,$styles0);
                    
                    
                
                $data_planilla_admin =planilla_admin($numero);
                $correlativo=1;
                foreach($data_planilla_admin as $row_data_planilla_admin) {
                    $id=$row_data_planilla_admin["id"];
                    $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                    $codigo=$row_data_planilla_admin["codigo_empleado_planilladevengo_admin"];

                        /* ********* */
                        $row_empleado_excel = array();

                        $data_empleado = empleado($idempleado);

                        if($ubicacion!="*"){
                            $data_empleado=empleado_ubi($codigo,$ubicacion);
                            
                         }
                         else if($tipo_empleado!="*"){
                            $data_empleado = empleado_tipo($idempleado,$tipo_empleado);
                           

                        }
                         else if($ubicacion!="*" || $tipo_empleado!="*"){
                            $data_empleado=empleado_ubi_tipo($codigo,$ubicacion,$tipo_empleado);
                            

                         }
                         else if($ubicacion=="*" || $tipo_empleado=="*"){
                             $data_empleado = empleado($idempleado);
                         }


                        $codigo_empleado="";
                        foreach($data_empleado as $row_empleado) {
                            $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];

                            $dias_trabajo_planilladevengo_admin =$row_data_planilla_admin["dias_trabajo_planilladevengo_admin"];
                            $sueldo_planilladevengo_admin =$row_data_planilla_admin["sueldo_planilladevengo_admin"];
                            $data_devengos_vaca = devengo_vacacion($idempleado,$numero);
                            $sumavalor_vacacion='';
                            $vaca="";
                            foreach($data_devengos_vaca as $row_devengo) {
                               $vaca=$row_devengo["sumavalor"];
                            }
                            if($vaca!=''){
                                $sumavalor_vacacion=$row_devengo["sumavalor"];
                            }
                            else{
                                $sumavalor_vacacion="0.00";
                            }
                            $diasfestivos='';
                            $data_devengos_feriados = devengo_feriados($idempleado,$numero);
                            $dato_dias_festivos='';
                            foreach($data_devengos_feriados as $row_devengo) {
                               $dato_dias_festivos=$row_devengo["sumavalor"];
                            }
                            if($dato_dias_festivos!=''){
                                $diasfestivos=$dato_dias_festivos;
                            }
                            else{
                                $diasfestivos="0.00";
                            }

                            /* ---------------- */

                            $valor_horas_extras_diurna= floatval($row_data_planilla_admin["hora_extra_diurna_planilladevengo_admin"])*floatval($row_empleado["hora_extra_diurna"]);
                            $valor_horas_extras_norturna= floatval($row_data_planilla_admin["hora_extra_nocturna_planilladevengo_admin"])*floatval($row_empleado["hora_extra_nocturna"]);
                            $valor_horas_extras_domingo_diurna= floatval($row_data_planilla_admin["hora_extra_domingo_planilladevengo_admin"])*floatval($row_empleado["hora_extra_domingo"]);
                            $valor_horas_extras_domingo_nocturna= floatval($row_data_planilla_admin["hora_extra_domingo_nocturna_planilladevengo_admin"])*floatval($row_empleado["hora_extra_nocturna_domingo"]);

                            $otrosdevengos_total=floatval($row_data_planilla_admin["otro_devengo_admin_planilladevengo_admin"])+$valor_horas_extras_diurna+$valor_horas_extras_norturna+$valor_horas_extras_domingo_diurna+$valor_horas_extras_domingo_nocturna;

                            $otro_devengo_final=floatval($otrosdevengos_total)-floatval($diasfestivos);

                            /* -------------------- */
                               
                            $total_devengo=$row_data_planilla_admin["total_devengo_admin_planilladevengo_admin"];
                            $descuento_isss_planilladevengo_admin=$row_data_planilla_admin["descuento_isss_planilladevengo_admin"];
                            $descuento_afp_planilladevengo_admin=$row_data_planilla_admin["descuento_afp_planilladevengo_admin"];
                            $descuento_renta_planilladevengo_admin=$row_data_planilla_admin["descuento_renta_planilladevengo_admin"];
                            $otro_descuento_planilladevengo_admin=$row_data_planilla_admin["otro_descuento_planilladevengo_admin"];
                            $total_descuento_planilladevengo_admin=$row_data_planilla_admin["total_descuento_planilladevengo_admin"];
                            $total_liquidado_planilladevengo_admin=$row_data_planilla_admin["total_liquidado_planilladevengo_admin"];
                            
                            /* columnas excel */
                            $row_empleado_excel[]=$correlativo++;
                            $row_empleado_excel[]=$nombre_empleado;
                            $row_empleado_excel[]=$dias_trabajo_planilladevengo_admin.str_repeat(" ",3);
                            $row_empleado_excel[]=$sueldo_planilladevengo_admin.str_repeat(" ",4);
                            $row_empleado_excel[]=$sumavalor_vacacion.str_repeat(" ",5);
                            $row_empleado_excel[]=$diasfestivos.str_repeat(" ",6);
                            $row_empleado_excel[]=$otro_devengo_final.str_repeat(" ",7);
                            $row_empleado_excel[]=$total_devengo.str_repeat(" ",8);
                            $row_empleado_excel[]=$descuento_isss_planilladevengo_admin.str_repeat(" ",9);
                            $row_empleado_excel[]=$descuento_afp_planilladevengo_admin.str_repeat(" ",10);
                            $row_empleado_excel[]=$descuento_renta_planilladevengo_admin.str_repeat(" ",11);
                            $row_empleado_excel[]=$otro_descuento_planilladevengo_admin.str_repeat(" ",12);
                            $row_empleado_excel[]=$total_descuento_planilladevengo_admin.str_repeat(" ",13);
                            $row_empleado_excel[]=$total_liquidado_planilladevengo_admin.str_repeat(" ",14); 
                         
                            /* 
                            
                            
                             */
                            /* 
                          */
                        $writer->writeSheetRow('Sheet1', $row_empleado_excel);    
                         
                        }
                        /* $writer->writeSheetHeader('Sheet1', $row_empleado_excel);   */   
                                
                }

                
                $row_finempleado_excel = array();
                /* Columna final Excel */
                $total_correlativo=$correlativo-1;
                $row_finempleado_excel["Son:"]='string';
                $row_finempleado_excel[$total_correlativo.str_repeat(" ",2)]='string';
                $row_finempleado_excel[""]='string';
                $row_finempleado_excel[number_format($sueldo_global, 2, ',', '.').str_repeat(" ",4)]='string';
                $row_finempleado_excel[number_format($vacaion_global, 2, ',', '.').str_repeat(" ",5)]='string';
                $row_finempleado_excel[number_format($diasfesti_global, 2, ',', '.').str_repeat(" ",6)]='string';
                $row_finempleado_excel[number_format($otrodevengo, 4, ',', '.').str_repeat(" ",7)]='string';
                $row_finempleado_excel[number_format($totaldevengo_global, 4, ',', '.').str_repeat(" ",8)]='string';
                $row_finempleado_excel[number_format($isss_global, 2, ',', '.').str_repeat(" ",9)]='string';
                $row_finempleado_excel[number_format($afp_global, 2, ',', '.').str_repeat(" ",10)]='string';
                $row_finempleado_excel[number_format($renta_global, 2, ',', '.').str_repeat(" ",11)]='string';
                $row_finempleado_excel[number_format($otrodesc_global, 2, ',', '.').str_repeat(" ",12)]='string';
                $row_finempleado_excel[number_format($totaldescuento_global, 2, ',', '.').str_repeat(" ",13)]='string';
                $row_finempleado_excel[number_format($totalliquido_global, 2, ',', '.').str_repeat(" ",14)]='string';

                $stylesfinal = array( ['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right'],['halign'=>'right']);

                $writer->writeSheetHeader('Sheet1', $row_finempleado_excel,$stylesfinal);         
                           
                /* ---------------- */
                
                /* $start_row=FILA_DESDE, $start_col=COLUMNA_DESDE, $end_row=FILA_DESDE, $end_col=COLUMNA_HASTA */

                $writer->markMergedCell('Sheet1', $start_row=1, $start_col=6, $end_row=1, $end_col=8);
                $writer->markMergedCell('Sheet1', $start_row=2, $start_col=6, $end_row=2, $end_col=8);
                $writer->markMergedCell('Sheet1', $start_row=3, $start_col=6, $end_row=3, $end_col=8);
                $writer->markMergedCell('Sheet1', $start_row=4, $start_col=6, $end_row=4, $end_col=8);
                $writer->markMergedCell('Sheet1', $start_row=5, $start_col=6, $end_row=5, $end_col=8);
                $writer->writeToFile('vistas/modulos/Reporte planilla no contable.xlsx');
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


<script>
    $(document).ready(function () {
        $("#exportExcel").click(function () {
            var tablaHtml = document.getElementById("tabladatos");
            var ws = XLSX.utils.table_to_sheet(tablaHtml);
            var wb = XLSX.utils.book_new();
            ws['!cols'][2] = { wch: 60, };
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
                ws["A1"].s = {
                        alignment: {
                        vertical: 'center',
                        horizontal: 'center',
                        wrapText: '1',
                        },
                    };
            XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
            /* XLSX.writeFile(wb, "tabla.xlsx"); */
            XLSX.writeFile(wb, "Reporte planilla no contable.xlsx");
        });


    });
</script>