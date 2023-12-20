

<?php

include_once("excel/xlsxwriter.class.php");
require_once 'dompdf/autoload.inc.php';

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

      $tipoplanilla=$_POST["tipo_planilla"];
      $devengos_table=$_POST["devengos_table"];
      if($devengos_table==""){
        $devengos_table="tbl_devengo_descuento_planilla";
      }
      else if($devengos_table=="_vacacion"){
        $devengos_table="tbl_devengo_descuento_planilla_vacacion";

      }
      else if($devengos_table=="_aguinaldo"){
        $devengos_table="tbl_devengo_descuento_planilla_aguinaldo";

      }
      else if($devengos_table=="_gratifivaca"){
        $devengos_table="tbl_devengo_descuento_planilla_gratifivaca";

      }
      else if($devengos_table=="_admin"){
        $devengos_table="tbl_devengo_descuento_planilla_admin";

      }

      
      /* **************************************** */
      $tipoplanilla=$_POST["tipo_planilla"];
      $devengos_table_maestra=$_POST["devengos_table"];

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
		$id_planilla=$columna_nombre[1];
		$numero_planilla_maestro=$columna_nombre[2];
		$fecha_planilla_maestro=$columna_nombre[3];
		$fecha_desde_maestro=$columna_nombre[4];
		$fecha_hasta_maestro=$columna_nombre[5];
		$descripcion_plantilla_maestro=$columna_nombre[6];
		$codigo_empleado_planilla_maestro=$columna_nombre[7];
		$nombre_empleado_planilla_maestro=$columna_nombre[8];
		$idempleado_planilla_maestro=$columna_nombre[9];
		$dias_planilla_maestro=$columna_nombre[10];
		$sueldo_planilla_maestro=$columna_nombre[11];
		$hora_extra_diurna_maestro=$columna_nombre[12];
		$hora_extra_nocturna_maestro=$columna_nombre[13];
		$hora_extra_domingo_maestro=$columna_nombre[14];
		$hora_extra_do_noc_maestro=$columna_nombre[15];
		$otro_devengo_maestro=$columna_nombre[16];
		$total_devengo_maestro=$columna_nombre[17];
		$descuento_isss_maestro=$columna_nombre[18];
		$descuento_afp_maestro=$columna_nombre[19];
		$descuento_renta_maestro=$columna_nombre[20];
		$otro_descuento_maestro=$columna_nombre[21];
		$total_descuento_maestro=$columna_nombre[22];
		$total_liquido_maestro=$columna_nombre[23];
		$sueldo_renta_maestro=$columna_nombre[24];
		$sueldo_isss_maestro=$columna_nombre[25];
		$sueldo_afp_maestro=$columna_nombre[26];
		$departamento_maestro=$columna_nombre[27];
		$codigo_ubicacion_maestro=$columna_nombre[28];
		$nombre_ubicacion_maestro=$columna_nombre[29];
		$idubicacion_maestro=$columna_nombre[30];
		$observacion_maestro=$columna_nombre[31];
		$periodo_maestro=$columna_nombre[32];
		$tipo_maestro=$columna_nombre[33];
		$diasincapacidad_maestro=$columna_nombre[34];
		$empleadorangodesde_maestro=$columna_nombre[35];
		$empleadorangohasta_maestro=$columna_nombre[36];

		$dias_ausencias_maestro=empty($columna_nombre[37]) ? "" : $columna_nombre[37];
		$septimo_maestro=empty($columna_nombre[38]) ? "" : $columna_nombre[38];
		$his_dias_trabajo_maestro=empty($columna_nombre[39]) ? "" : $columna_nombre[39];
		$fecha_gratificacion_maestro=empty($columna_nombre[40]) ? "" : $columna_nombre[40];
		$dias_trabajo_inca_maestro=empty($columna_nombre[41]) ? "" : $columna_nombre[41];
		$pago_dias_trabajo_inca_maestro=empty($columna_nombre[42]) ? "" : $columna_nombre[42];
		$dias_incapacidad_maestro=empty($columna_nombre[43]) ? "" : $columna_nombre[43];
		$pagos_dias_inca_maestro=empty($columna_nombre[44]) ? "" : $columna_nombre[44];
		$fecha_situacion_desde_maestro=empty($columna_nombre[45]) ? "" : $columna_nombre[45];
		$fecha_sitacion_hasta_maestro=empty($columna_nombre[46]) ? "" : $columna_nombre[46];
		$numero_plan_anticipo_maestro=empty($columna_nombre[47]) ? "" : $columna_nombre[47];
		$numero_plan_vacacion_maestro=empty($columna_nombre[48]) ? "" : $columna_nombre[48];


        function nombre_columnas_devengos($devengos_table)
        {
            $query = "SHOW COLUMNS FROM tbl_devengo_descuento_planilla$devengos_table";
            $stmt = Conexion::conectar()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt = null;
        }
        $data_nametable_devengos=nombre_columnas_devengos($devengos_table_maestra);
		$columna_nombre_devengos = array();
		$indice2 = 1; // Comenzar desde 1
		foreach ($data_nametable_devengos as $row) {
		    $columna_nombre_devengos[$indice2] = $row['Field'];
			$indice2++;
		}
		$id_devengo_maestro=$columna_nombre_devengos[1];
		$codigo_devengo_maestro=$columna_nombre_devengos[2];
		$descripcion_devengo_maestro=$columna_nombre_devengos[3];
		$tipo_devengo_maestro=$columna_nombre_devengos[4];
		$isss_devengo_maestro=$columna_nombre_devengos[5];
		$afp_devengo_maestro=$columna_nombre_devengos[6];
		$renta_devengo_maestro=$columna_nombre_devengos[7];
		$porcentajerenta_devengo_maestro=$columna_nombre_devengos[8];
		$porcentajeisss_devengo_maestro=$columna_nombre_devengos[9];
		$porcentajeafp_devengo_maestro=$columna_nombre_devengos[10];
		$idempleado_devengo_maestro=$columna_nombre_devengos[11];
		$valor_devengo_maestro=$columna_nombre_devengos[12];
		$tipovalor_devengo_maestro=$columna_nombre_devengos[13];
		$codigoplanilla_devengo_maestro=$columna_nombre_devengos[14];
		/* $diasferiados_devengo_maestro=$columna_nombre_devengos[15];
		$valordiasferiados_devengo_maestro=$columna_nombre_devengos[16];
		$diastrabajadosinca_devengo_maestro=$columna_nombre_devengos[17];
		$pagodiastrainca_devengo_maestro=$columna_nombre_devengos[18];
		$diasincapacidad_devengo_maestro=$columna_nombre_devengos[19];
		$pagodiasinca_devengo_maestro=$columna_nombre_devengos[20];
		$horatardes_devengo_maestro=$columna_nombre_devengos[21];
		$preciohoratarde_devengo_maestro=$columna_nombre_devengos[22]; */
      
        /* ********************************************* */



      /* $banco_value=""; */
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero,$tipoplanilla,$numero_planilla_maestro,$idempleado_planilla_maestro) {
            $query = "SELECT * FROM `$tipoplanilla` where  $numero_planilla_maestro='$numero'  order by $idempleado_planilla_maestro ASC";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero,$tipoplanilla,$numero_planilla_maestro) {
            $query = "SELECT * FROM `$tipoplanilla` where $numero_planilla_maestro='$numero' limit 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleado($id) {
            $query = "SELECT * FROM `tbl_empleados` where codigo_empleado='$id' order by id asc";
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
        function devengo_vacacion($idempleado1,$numero1,$devengos_table) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM $devengos_table where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengo_feriados($idempleado1,$numero1,$devengos_table) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM $devengos_table where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro) {
            $query = "SELECT SUM($sueldo_planilla_maestro) AS sumasueldo,
                            SUM($otro_devengo_maestro) AS sumaotrodevengo,
                            SUM($total_devengo_maestro) AS sumatotaldevengo,
                            SUM($descuento_isss_maestro) AS sumaisss, 
                            SUM($descuento_afp_maestro) AS sumaafp,
                            SUM($descuento_renta_maestro) AS sumarenta,
                            SUM($otro_descuento_maestro) AS sumaotrodescuento, 
                            SUM($total_descuento_maestro) AS totaldescuento,
                            SUM($total_liquido_maestro) AS totalliquido  
                            FROM `$tipoplanilla` where $numero_planilla_maestro='$numero' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_devengo_vacacion($numero1,$devengos_table) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM $devengos_table where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function suma_devengo_feriados($numero1,$devengos_table) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM $devengos_table where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        ?>     
        <?php
          $data_planilla_admin_data = planilla_admin_data($numero,$tipoplanilla,$numero_planilla_maestro);
          $numero_planilla="";
          $fecha_planilla_desde="";
          $fecha_planilla_hasta="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla.=$row_data_planilla_admin_data[$numero_planilla_maestro];
              $fecha_planilla_desde.=$row_data_planilla_admin_data[$fecha_desde_maestro];
              $fecha_planilla_hasta.=$row_data_planilla_admin_data[$fecha_hasta_maestro];
          }

          $fechaActual = date("d-m-Y"); 
        ?>
       

       
     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      <a href="ajax/No_contable.txt" download="No_contable.txt" id="descargar_txt" ></a>
      <a href="ajax/Planilla no contable.pdf" download="Planilla no contable.pdf" id="descargar_pdf" ></a>


      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <!-- <a href='vistas/modulos/Reporte planilla no contable.xlsx' download class="btn btn-primary btnreporte" style="display:none">
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
                 <button id="exportTXT" class="dropdown-item btn btn-info btnreporte" style="display:none">Exportar a TXT</button>
                 <button id="exportPDF" class="dropdown-item btn btn-warning btnreporte" style="display:none">Exportar a PDF</button>
            </div>
        </div>
       </div>
      <!--  -->
    <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      
      <?php
       if($ubicacion!="*"){
        $dataubicacion = empleado_ubi_only($ubicacion);
          foreach($dataubicacion as $row) {
            echo "<h4 align='center'>".$row["nombre"]."</h4>";
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
                            $data_planilla_admin = planilla_admin($numero,$tipoplanilla,$numero_planilla_maestro,$idempleado_planilla_maestro);

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
                                $idempleado=$row_data_planilla_admin[$idempleado_planilla_maestro];
                                $codigo=$row_data_planilla_admin[$codigo_empleado_planilla_maestro];
                                
                        ?>                
                                <?php
                                 $data_empleado = empleado($codigo);
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
                                     $data_empleado = empleado($codigo);
                                 }
                                 $codigo_empleado="";
                                 $nombre_empleado="";
                                 $hora_extra_diurna="";
                                 $hora_extra_nocturna="";
                                 $hora_extra_domingo="";
                                 $hora_extra_nocturna_domingo="";
                                 foreach($data_empleado as $row_empleado) {
                                    $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];     
                                    $hora_extra_diurna=$row_empleado["hora_extra_diurna"];
                                    $hora_extra_nocturna=$row_empleado["hora_extra_nocturna"];
                                    $hora_extra_domingo=$row_empleado["hora_extra_domingo"];
                                    $hora_extra_nocturna_domingo=$row_empleado["hora_extra_nocturna_domingo"];
                                 
                                ?>
                                <tr>
                                    <!-- no -->
                                    <td><?php echo $correlativo++?></td>
                                    <!-- nombre empleado -->
                                    <td><?php echo $nombre_empleado?></td>
                                    <!-- dias -->
                                    <td><?php echo $row_data_planilla_admin[$dias_planilla_maestro];?></td>
                                    <!-- sueldo -->
                                    <td><?php 
                                            $sueldo_global+=floatval($row_data_planilla_admin[$sueldo_planilla_maestro]);
                                            echo $row_data_planilla_admin[$sueldo_planilla_maestro];
                                            ?></td>
                                    <!-- vacacion -->
                                    <?php
                                     $data_devengos_vaca = devengo_vacacion($idempleado,$numero,$devengos_table);
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
                                     $data_devengos_feriados = devengo_feriados($idempleado,$numero,$devengos_table);
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
                                        $valor_horas_extras_diurna= floatval($row_data_planilla_admin[$hora_extra_diurna_maestro])*floatval($hora_extra_diurna);
                                        $valor_horas_extras_norturna= floatval($row_data_planilla_admin[$hora_extra_nocturna_maestro])*floatval($hora_extra_nocturna);
                                        $valor_horas_extras_domingo_diurna= floatval($row_data_planilla_admin[$hora_extra_domingo_maestro])*floatval($hora_extra_domingo);
                                        $valor_horas_extras_domingo_nocturna= floatval($row_data_planilla_admin[$hora_extra_do_noc_maestro])*floatval($hora_extra_nocturna_domingo);

                                        $otrosdevengos_total=floatval($row_data_planilla_admin[$otro_devengo_maestro])+$valor_horas_extras_diurna+$valor_horas_extras_norturna+$valor_horas_extras_domingo_diurna+$valor_horas_extras_domingo_nocturna;


                                        $capturar_otros_devengos=floatval($otrosdevengos_total)-floatval($vaca);

                                        /* echo number_format($capturar_otros_devengos, 2, '.', ''); */
                                        echo bcdiv($capturar_otros_devengos,'1', 2);

                                        $otrodevengo+=floatval($otrosdevengos_total)-floatval($vaca);
                                        ?>
                                    </td>
                                    <!-- total devengo -->
                                    <td><?php  $totaldevengo_global+=floatval($row_data_planilla_admin[$total_devengo_maestro]);
                                                echo bcdiv($row_data_planilla_admin[$total_devengo_maestro],'1', 2)?></td>
                                    <!-- descuento isss -->
                                    <td><?php $isss_global+=floatval($row_data_planilla_admin[$descuento_isss_maestro]);
                                    echo bcdiv($row_data_planilla_admin[$descuento_isss_maestro],'1', 2)?></td>
                                    <!-- descuento afp -->
                                    <td><?php  $afp_global+=floatval($row_data_planilla_admin[$descuento_afp_maestro]);
                                    echo bcdiv($row_data_planilla_admin[$descuento_afp_maestro],'1', 2)?></td>
                                    <!-- descuento renta -->
                                    <td>
                                        <?php $renta_global+=floatval($row_data_planilla_admin[$descuento_renta_maestro]);
                                                echo bcdiv($row_data_planilla_admin[$descuento_renta_maestro],'1', 2)
                                        ?>
                                    </td>
                                    <!-- otro descuento -->
                                    <td><?php $otrodesc_global+=floatval($row_data_planilla_admin[$otro_descuento_maestro]); 
                                            echo bcdiv($row_data_planilla_admin[$otro_descuento_maestro],'1', 2)?></td>
                                    <!-- total descuento -->
                                    <td><?php 
                                              $totaldescuento_global+=floatval($row_data_planilla_admin[$total_descuento_maestro]);
                                              echo bcdiv($row_data_planilla_admin[$total_descuento_maestro],'1', 2)?></td>
                                    <!-- total liquidi -->
                                    <td><?php 
                                            $totalliquido_global+=floatval($row_data_planilla_admin[$total_liquido_maestro]);
                                            echo bcdiv($row_data_planilla_admin[$total_liquido_maestro],'1', 2)?></td>
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
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                               /*  echo "<td>".number_format($row["sumasueldo"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($sueldo_global, 2, '.', '.') ."</td>";

                        ?>
                        <!-- vacacion -->
                         <?php
                            $data_suma_vaca = suma_devengo_vacacion($numero,$devengos_table);
                            foreach($data_suma_vaca as $row) {
                               /*  echo "<td>".number_format($row["sumavalor"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($vacaion_global, 2, '.', '.') ."</td>";

                        ?>
                        <!-- dias festivos -->
                         <?php
                            $data_suma_feriado = suma_devengo_feriados($numero,$devengos_table);
                            $sumaferiado=0;
                            foreach($data_suma_feriado as $row) {
                                $sumaferiado=floatval($row["sumavalor"]);
                                /* echo "<td>".number_format($row["sumavalor"], 2, ',', '.') ."</td>"; */
                            }  
                            echo "<td>".number_format($diasfesti_global, 2, '.', '.') ."</td>";   
                        ?>
                        <!-- otros devengos -->
                        <?php
                                /* $total=floatval($row["sumaotrodevengo"])-$sumaferiado; */
                                echo "<td>".number_format($otrodevengo, 2, '.', '.')."</td>";
                                 
                        ?>
                        <!-- total devengo -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumatotaldevengo"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totaldevengo_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- isss -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaisss"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($isss_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- afp -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaafp"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($afp_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- renta -->
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumarenta"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($renta_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- otro descuento -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaotrodescuento"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($otrodesc_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- total descuento -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["totaldescuento"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totaldescuento_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- total liquidado -->
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$tipoplanilla,$sueldo_planilla_maestro,$otro_devengo_maestro,$total_devengo_maestro,$descuento_isss_maestro,$descuento_afp_maestro,$descuento_renta_maestro,$otro_descuento_maestro,$total_descuento_maestro,$total_liquido_maestro,$numero_planilla_maestro);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["totalliquido"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totalliquido_global, 2, '.', '.') ."</td>";
                        ?>
                        
                    </tr>
            </tbody>
          </table>
        </div> 


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
</script>


<script>

$(document).ready(function () {

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
            url: "ajax/pdf_txt_nocontable.php", // Cambia esto por la URL del script PHP en tu servidor
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
            url: "ajax/pdf_txt_nocontable.php", // Cambia esto por la URL del script PHP en tu servidor
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

});


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
            XLSX.writeFile(wb, "Reporte planilla no contable.xlsx");
        });


    });
</script>
