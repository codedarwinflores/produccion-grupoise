

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

      
      /* **************************************** */
      $tipoplanilla=$_POST["tipo_planilla"];
      $devengos_table_maestra=$_POST["devengos_table"];

      $cambio_table="";
      if($tipoplanilla=="planilladevengo_anticipo"){
        $cambio_table="_anticipo";
      }
      else if($tipoplanilla=="planilladevengo_vacacion"){
        $cambio_table="_vacacion";
      }
      else if($tipoplanilla=="planilladevengo_aguinaldo"){
        $cambio_table="_aguinaldo";
      }
      else if($tipoplanilla=="planilladevengo_gratifivaca"){
        $cambio_table="_gratifivaca";
      }
      else if($tipoplanilla=="planilladevengo_admin"){
        $cambio_table="_admin";
      }

      /* EMPEZAR A REALIZAR CAMBIOS */


      /* $banco_value=""; */
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero,$cambio_table) {
            $query = "SELECT * FROM planilladevengo$cambio_table where  numero_planilladevengo$cambio_table='$numero'";
           
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_vacacion($numerov,$idempleado) {
            $query = "SELECT * FROM `planilladevengo_vacacion` where  numero_planilladevengo_vacacion='$numerov' and id_empleado_planilladevengo_vacacion='$idempleado'";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero,$cambio_table) {
            $query = "SELECT * FROM planilladevengo$cambio_table where numero_planilladevengo$cambio_table='$numero' limit 1";
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
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* , clientes.*
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              clientes.id='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /*  ubicacion y tipo empleado */
        function empleado_ubi_tipo($codigo,$idubicacion,$tipo_empleado1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.*, clientes.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados,clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                              codigo_agente='$codigo' and 
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and
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

        
        /* function empleado_ubi($codigo) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.* FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados` where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and codigo_agente='$codigo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        }; */
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
        function devengo_vacacion($idempleado1,$numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla$devengos_table_maestra where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengo_feriados($idempleado1,$numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla$devengos_table_maestra where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_planilla_admin_data($numero,$cambio_table) {
            $query = "SELECT SUM(sueldo_planilladevengo$cambio_table) AS sumasueldo,SUM(otro_devengo".$cambio_table."_planilladevengo$cambio_table) AS sumaotrodevengo,SUM(total_devengo".$cambio_table."_planilladevengo$cambio_table) AS sumatotaldevengo,SUM(descuento_isss_planilladevengo$cambio_table) AS sumaisss, SUM(descuento_afp_planilladevengo$cambio_table) AS sumaafp,SUM(descuento_renta_planilladevengo$cambio_table) AS sumarenta,SUM(otro_descuento_planilladevengo$cambio_table) AS sumaotrodescuento, SUM(total_descuento_planilladevengo$cambio_table) AS totaldescuento,SUM(total_liquidado_planilladevengo$cambio_table) AS totalliquido  FROM `planilladevengo$cambio_table` where numero_planilladevengo$cambio_table='$numero' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_devengo_vacacion($numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla$devengos_table_maestra where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function suma_devengo_feriados($numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla$devengos_table_maestra where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_contodo($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo
            FROM tbl_devengo_descuento_planilla$devengos_table_maestra
            WHERE
                idempleado_devengo = '$idempleado1'
                AND (
                    (codigo_planilla_devengo='$numero' AND isss_devengo_devengo_descuento_planilla = 'Si')
                    OR
                    (codigo_planilla_devengo='$numero' AND afp_devengo_devengo_descuento_planilla = 'Si')
                    OR
                    (codigo_planilla_devengo='$numero' AND renta_devengo_devengo_descuento_planilla = 'Si')
                )
                AND tipo_valor LIKE '%suma%'
            GROUP BY idempleado_devengo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos_sinrestricion($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo
            FROM tbl_devengo_descuento_planilla$devengos_table_maestra
            WHERE
                idempleado_devengo = '$idempleado1'
                AND tipo_valor LIKE '%suma%' AND codigo_planilla_devengo='$numero'
            GROUP BY idempleado_devengo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        ?>     
        <?php
          $data_planilla_admin_data = planilla_admin_data($numero,$cambio_table);
          $numero_planilla="";
          $fecha_planilla_desde="";
          $fecha_planilla_hasta="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla.=$row_data_planilla_admin_data["numero_planilladevengo$cambio_table"];
              $fecha_planilla_desde.=$row_data_planilla_admin_data["fecha_desde_planilladevengo$cambio_table"];
              $fecha_planilla_hasta.=$row_data_planilla_admin_data["fecha_hasta_planilladevengo$cambio_table"];
          }

          $fechaActual = date("d-m-Y"); 
        ?>
       
       
     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      <br>
      <br>
      <div class="btnreporte" style="display:none">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccionar Opción a imprimir
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <button id="exportExcel" class="dropdown-item btn btn-success btnreporte" style="display:none">Exportar a Excel</button>
                 <button id="exportTXT" class="dropdown-item btn btn-info btnreporte" style="display:none">Exportar a TXT</button>
                 <button id="exportPDF" class="dropdown-item btn btn-warning btnreporte" style="display:none">Exportar a PDF</button>
            </div>
        </div>
       </div>
       <a href="ajax/Reporte planilla contable.txt" download="Reporte planilla contable.txt" id="descargar_txt" ></a>
      <a href="ajax/Reporte planilla contable.pdf" download="Reporte planilla contable.pdf" id="descargar_pdf" ></a>
      <!--  -->
      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <!-- <a href='vistas/modulos/Reporte_hora_extra.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

    
      <div class="col-md-12" align="center" >
       
        <h2> Planilla Administrativa Contable</h2>
        <?php
       if($ubicacion!="*"){
        $dataubicacion = empleado_ubi_only($ubicacion);
          foreach($dataubicacion as $row) {
            echo "<h4 align='center'>".$row["nombre"]."</h4>";
          }
        }
      ?>
      </div>


      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive " width="100%" id="tabladatos">
                    <thead>
                        <!-- titulos -->
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

                        $sueldo=0;
                        $otrosdevengos=0;
                        $totaldevengo=0;
                        $isss=0;
                        $afp=0;
                        $renta=0;
                        $otrodescuento=0;
                        $totaldescuento=0;
                        $totalliquido=0;



                        $data_planilla_admin = planilla_admin($numero,$cambio_table);
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin["id"];
                            $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo$cambio_table"];
                            $codigo=$row_data_planilla_admin["codigo_empleado_planilladevengo$cambio_table"];

                            $numerovacacion="";
                              if($tipoplanilla=="planilladevengo_vacacion"){
                                $numerovacacion=$row_data_planilla_admin["numero_planilladevengo".$cambio_table.""];
                              }
                              else if($tipoplanilla=="planilladevengo_admin"){
                                $numerovacacion=$row_data_planilla_admin["numero_plan_vacacion"];
                              }


                    ?>                
                                <?php
                                 
                                 $data_empleado = empleado($idempleado);
                                 if($ubicacion!="*" && $tipo_empleado=="*"){
                                    $data_empleado=empleado_ubi($codigo,$ubicacion);
                                 }
                                 else if($tipo_empleado!="*" && $ubicacion=="*"){
                                    $data_empleado = empleado_tipo($idempleado,$tipo_empleado);
                                   
        
                                }
                                 else if($ubicacion!="*" && $tipo_empleado!="*"){
                                    $data_empleado=empleado_ubi_tipo($codigo,$ubicacion,$tipo_empleado);
                                    
        
                                 }
                                 else if($ubicacion=="*" && $tipo_empleado=="*"){
                                     $data_empleado = empleado($idempleado);
                                 }



                                 $codigo_empleado="";
                                 foreach($data_empleado as $row_empleado) {
                                    $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];
                                ?>
                                <tr>
                                    <td><?php echo $correlativo++?></td>
                                    <td><?php echo $nombre_empleado?></td>
                                    <td>
                                        <?php 
                                            $data_vacacion=planilla_vacacion($numerovacacion,$idempleado);
                                            $idempleado_vacacion="";
                                            foreach($data_vacacion as $row_vacacion) {
                                                $idempleado_vacacion=$row_vacacion["id_empleado_planilladevengo_vacacion"];
                                            }
                                            if($idempleado==$idempleado_vacacion){
                                               echo ""; 
                                            }
                                            else{
                                                echo $row_data_planilla_admin["dias_trabajo_planilladevengo$cambio_table"];
                                            }
                                        ?>
                                    </td>
                                    <!-- SUELDO -->
                                    <td>
                                        <?php
                                        $valorsueldo=0;
                                        /* if($row_data_planilla_admin["descuento_isss_planilladevengo_admin"]=="0"){ */
                                        if($idempleado==$idempleado_vacacion){
                                            echo "0.00";
                                            $valorsueldo=0.00;
                                        }
                                        else{
                                            echo $row_data_planilla_admin["sueldo_planilladevengo$cambio_table"];
                                            $sueldo += floatval($row_data_planilla_admin["sueldo_planilladevengo$cambio_table"]);
                                            $valorsueldo=$row_data_planilla_admin["sueldo_planilladevengo$cambio_table"];
                                        
                                        }
                                        ?>
                                     </td>
                                    <!-- vacacion -->
                                    <?php
                                     $data_devengos_vaca = devengo_vacacion($idempleado,$numero,$devengos_table_maestra);
                                     $vaca='';
                                     foreach($data_devengos_vaca as $row_devengo) {
                                        /* $vaca="$row_devengo["sumavalor"]"; */
                                        }
                                        if($vaca!=''){
                                            echo "<td>". $row_devengo["sumavalor"]."</td>";
                                        }
                                        else{
                                            echo "<td>0.00</td>";
                                        }
                                    ?>
                                    <!-- festivos -->
                                    <?php
                                     $data_devengos_feriados = devengo_feriados($idempleado,$numero,$devengos_table_maestra);
                                     $festivo='';
                                     foreach($data_devengos_feriados as $row_devengo) {
                                        /* $festivo=$row_devengo["sumavalor"]; */
                                        }
                                        if($festivo!=''){
                                            echo "<td>".$festivo."</td>";
                                        }
                                        else{
                                            echo "<td>0.00</td>";
                                        }
                                    ?>
                                    <!-- OTROS DEVENGOS	 -->
                                    <td><?php 
                                        $capturar_desvengos=0;
                                        /* if($row_data_planilla_admin["descuento_isss_planilladevengo_admin"]=="0"){ */
                                        if($idempleado==$idempleado_vacacion){
                                            $capturar_desvengos=$row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo$cambio_table"];
                                            echo bcdiv($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo$cambio_table"],'1', 2);
                                            $otrosdevengos+=floatval($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo$cambio_table"]);
                                        }
                                        else{
                                            $data_devengos = devengos_sinrestricion($idempleado,$numero,$devengos_table_maestra);
                                            $sumadevengo=0;
                                            foreach($data_devengos as $row) {
                                            $sumadevengo=$row["sumadevengo"];
                                            }
                                            if(isset($sumadevengo)){}else{$sumadevengo=0;}
                                                    
                                            $hora_extra_diurna=$row_empleado["hora_extra_diurna"];
                                            $hora_extra_nocturna=$row_empleado["hora_extra_nocturna"];
                                            $hora_extra_domingo=$row_empleado["hora_extra_domingo"];
                                            $hora_extra_nocturna_domingo=$row_empleado["hora_extra_nocturna_domingo"];

                                            $valor_horas_extras_diurna= floatval($row_data_planilla_admin["hora_extra_diurna_planilladevengo$cambio_table"])*floatval($hora_extra_diurna);
                                            $valor_horas_extras_norturna= floatval($row_data_planilla_admin["hora_extra_nocturna_planilladevengo$cambio_table"])*floatval($hora_extra_nocturna);
                                            $valor_horas_extras_domingo_diurna= floatval($row_data_planilla_admin["hora_extra_domingo_planilladevengo$cambio_table"])*floatval($hora_extra_domingo);
                                            $valor_horas_extras_domingo_nocturna= floatval($row_data_planilla_admin["hora_extra_domingo_nocturna_planilladevengo$cambio_table"])*floatval($hora_extra_nocturna_domingo);

                                            $sumadevengo=$sumadevengo+$valor_horas_extras_diurna+$valor_horas_extras_norturna+$valor_horas_extras_domingo_diurna+$valor_horas_extras_domingo_nocturna;
                                            $capturar_desvengos=$sumadevengo;
                                            echo bcdiv($sumadevengo,'1', 2);
                                            $otrosdevengos+=$sumadevengo;
                                        }
                                    ?>
                                    </td>
                                    <!-- Total devengos -->
                                    <td>
                                        <?php 
                                            /* echo $valorsueldo."-".floatval($vaca)."-".floatval($festivo)."+".floatval($capturar_desvengos)."<br>"; */
                                            $total_devengados=floatval($valorsueldo)+floatval($vaca)+floatval($festivo)+floatval($capturar_desvengos);
                                            $total_devengado_pla=floatval($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo$cambio_table"]);

                                            echo bcdiv($total_devengado_pla,'1', 2);
                                            $totaldevengo+=$total_devengado_pla;
                                            /* echo $row_data_planilla_admin["total_devengo_admin_planilladevengo$cambio_table"];
                                            $totaldevengo+=$row_data_planilla_admin["total_devengo_admin_planilladevengo$cambio_table"]; */
                                        ?>
                                    </td>
                                    <td><?php echo bcdiv($row_data_planilla_admin["descuento_isss_planilladevengo$cambio_table"],'1', 2)?></td>
                                    <td><?php echo bcdiv($row_data_planilla_admin["descuento_afp_planilladevengo$cambio_table"],'1', 2)?></td>
                                    <td><?php echo bcdiv($row_data_planilla_admin["descuento_renta_planilladevengo$cambio_table"],'1', 2)?></td>
                                    <td><?php echo bcdiv($row_data_planilla_admin["otro_descuento_planilladevengo$cambio_table"],'1', 2)?></td>
                                    <td><?php echo bcdiv($row_data_planilla_admin["total_descuento_planilladevengo$cambio_table"],'1', 2)?></td>
                                    <td><?php 
                                            $total_liquido_pla=floatval($total_devengados)-floatval($row_data_planilla_admin["total_descuento_planilladevengo$cambio_table"]);
                                            echo bcdiv($total_liquido_pla,'1', 2);
                                            $totalliquido+=$total_liquido_pla;
                                            /* echo $row_data_planilla_admin["total_liquidado_planilladevengo$cambio_table"] */
                                        ?></td>
                                </tr>

                                <?php
                                 }
                                ?>
                               
                    <?php
                        }
                    ?>

                    <tr>
                        <td>Son:</td>
                        <td><?php echo $correlativo-1;?></td>
                        <td>  </td>
                        <?php
                           echo "<td>".number_format($sueldo, 2, '.', '.')."</td>";
                        ?>
                         <?php
                            $data_suma_vaca = suma_devengo_vacacion($numero,$devengos_table_maestra);
                            foreach($data_suma_vaca as $row) {
                                echo "<td>".number_format($row["sumavalor"], 2, '.', '.') ."</td>";
                            }     
                        ?>
                         <?php
                            echo "<td>0.00</td>";
                                
                        ?>
                        <?php
                            echo "<td>".number_format($otrosdevengos, 2, '.', '.')."</td>";   
                        ?>
                        <?php
                           echo "<td>".number_format($totaldevengo, 2, '.', '.')."</td>";    
                        ?>
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                echo "<td>".number_format($row["sumaisss"], 2, '.', '.') ."</td>";
                            }     
                        ?>
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                echo "<td>".number_format($row["sumaafp"], 2, '.', '.') ."</td>";
                            }     
                        ?>
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                echo "<td>".number_format($row["sumarenta"], 2, '.', '.') ."</td>";
                            }     
                        ?>
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                echo "<td>".number_format($row["sumaotrodescuento"], 2, '.', '.') ."</td>";
                            }     
                        ?>
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                echo "<td>".number_format($row["totaldescuento"], 2, '.', '.') ."</td>";
                            }     
                        ?>
                         <?php
                                echo "<td>".number_format($totalliquido, 2, '.', '.') ."</td>";
                         
                            /* $data_sumaglobal = suma_planilla_admin_data($numero);
                            foreach($data_sumaglobal as $row) {
                                echo "<td>".number_format($row["totalliquido"], 2, ',', '.') ."</td>";
                            }   */   
                        ?>
                        
                    </tr>
            </tbody>
          </table>
        </div> 

      <!-- ************************ -->

            <!--  -->
      
            <div class="modal fade modal_carga" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-body" align="center">
                    <img src="vistas/modulos/carga.gif" alt="">
                    <h5 class="datos_informacion">GENERANDO PDF</h5>
                </div>
                </div>
            </div>
            </div>
        <!--  -->
 
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



    
    /* reporte txt */
    $("#exportTXT").click(function () {
        // Obtener los títulos de la tabla
        var headers = [];
        $("#tabladatos thead th").each(function () {
            headers.push($(this).text());
        });

        // Obtener los datos de la tabla
        var data = [];
        $("#tabladatos tbody tr").each(function () {
            var rowData = [];
            $(this).find("td").each(function () {
                rowData.push($(this).text());
            });
            data.push(rowData);
        });
        // Enviar los títulos y datos mediante AJAX TXT
        $.ajax({
            type: "POST",
            url: "ajax/pdf_txt_contable.php", // Cambia esto por la URL del script PHP en tu servidor
            data: { tableHeaders: headers, tableData: data },
            success: function (response) {
                /* window.open("ajax/No_contable.txt", "_blank"); */
                   // Trigger the download by simulating a click
                    var downloadUrl = $("#descargar_txt").attr("href");
                    var fileName = $("#descargar_txt").attr("download");
                    downloadFile(downloadUrl, fileName);

            }
        });
    });

    /* reporte pdf */
    $("#exportPDF").click(function () {
        /* pdf */
        var tablaHtml = $("#tabladatos").prop("outerHTML");
        
	 $('.modal_carga').modal({backdrop: 'static', keyboard: false});
     $(".modal_carga").modal("show");
    
        $.ajax({
            url: "ajax/pdf_txt_contable.php", // Cambia esto por la URL del script PHP en tu servidor
            type: "POST",
            data: { tabla: tablaHtml }, // Datos a enviar
            success: function (response) {
                
                   // Trigger the download by simulating a click
                    var downloadUrl = $("#descargar_pdf").attr("href");
                    var fileName = $("#descargar_pdf").attr("download");
                    downloadFile(downloadUrl, fileName);
                    
                    $('.modal_carga').modal({backdrop: 'static', keyboard: true});
                    $('.modal_carga').modal('hide');


            }
        });
        /* ************* */
    })

    /* descargar reporte txt y pdf */
    function downloadFile(url, fileName) {
        var link = document.createElement("a");
        link.href = url;
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    
    /* reporte Excel */
    $(document).ready(function () {
        $("#exportExcel").click(function () {
        var tablaHtml = document.getElementById("tabladatos");
        var ws = XLSX.utils.table_to_sheet(tablaHtml);
        var wb = XLSX.utils.book_new();
        ws['!cols'][1] = { wch: 50, };
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
            for (var i = 1; i < 5; i++) {
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
        XLSX.writeFile(wb, "Reporte planilla contable.xlsx");
    });


});
</script>