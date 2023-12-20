

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
    .ocultar_contenido{
        display: none;
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

      /* $banco_value=""; */
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($idempleado01,$numero,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo$cambio_table` where id_empleado_planilladevengo$cambio_table=$idempleado01 and  numero_planilladevengo$cambio_table='$numero'";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
            /* return $sql->fetchAll(); */
        };
        function planilla_admin_data($numero,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo$cambio_table` where numero_planilladevengo$cambio_table='$numero' limit 1";
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
        function empleado_tipo($idubicacion,$tipo) {
            /* $query = "SELECT * FROM `tbl_empleados` where  tipo_empleado='$tipo'"; */
            $query = "SELECT nombre_ubicacion,idubicacion_agente, tbl_empleados.* 
            FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
            where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                   codigo_agente=tbl_empleados.codigo_empleado and
                    tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion' and
                    tipo_empleado='$tipo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo ubicacion */
        function empleado_ubi($idubicacion) {
            /* $query = "SELECT nombre_ubicacion, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion' "; */
            $query = "SELECT nombre_ubicacion, tbl_empleados.* , idubicacion_agente
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();		
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;	
            /* return $sql->fetchAll(); */
        };

        /* solo ubicacion */
        function empleado_ubi_all($idubicacion) {
            $query = "SELECT nombre_ubicacion,idubicacion_agente, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion' ";
             /* $query = "SELECT nombre_ubicacion,idubicacion_agente, tbl_empleados.*, planilladevengo_admin.*
                        FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados,planilladevengo_admin
                        where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                               codigo_agente=tbl_empleados.codigo_empleado AND
                               planilladevengo_admin.codigo_empleado_planilladevengo_admin=tbl_empleados.codigo_empleado and 
                               tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion' "; */
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();		
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;	
            /* return $sql->fetchAll(); */
        };
        /*  ubicacion y tipo empleado */
        function empleado_ubi_tipo($idubicacion,$tipo_empleado1) {
            /* $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and 
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion'"; */
                $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and 
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo toma el nombre de la ubicacion */
        function empleado_ubi_only($idubicacion) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.*, clientes.*
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                             codigo_agente=tbl_empleados.codigo_empleado and
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
        function devengo_vacacion($idempleado1,$numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengo_feriados($idempleado1,$numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_planilla_admin_data($numero,$cambio_table) {
            $query = "SELECT SUM(sueldo_planilladevengo$cambio_table) AS sumasueldo,SUM(otro_devengo".$cambio_table."_planilladevengo$cambio_table) AS sumaotrodevengo,SUM(total_devengo".$cambio_table."_planilladevengo".$cambio_table.") AS sumatotaldevengo,SUM(descuento_isss_planilladevengo".$cambio_table.") AS sumaisss, SUM(descuento_afp_planilladevengo".$cambio_table.") AS sumaafp,SUM(descuento_renta_planilladevengo".$cambio_table.") AS sumarenta,SUM(otro_descuento_planilladevengo".$cambio_table.") AS sumaotrodescuento, SUM(total_descuento_planilladevengo".$cambio_table.") AS totaldescuento,SUM(total_liquidado_planilladevengo".$cambio_table.") AS totalliquido  FROM `planilladevengo".$cambio_table."` where numero_planilladevengo".$cambio_table."='$numero' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function suma_devengo_vacacion($numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function suma_devengo_feriados($numero1,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  codigo_devengo_descuento_planilla='0021' and codigo_planilla_devengo='$numero1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        /* todas las ubicaciones */
        function ubicaciones_all() {
            $query = "SELECT * FROM tbl_clientes_ubicaciones GROUP BY id order by id ASC ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        };
        /* solo la ubicacion seleccionada */
        function ubicaciones_all_one($idubicacion) {
            $query = "SELECT tbl_clientes_ubicaciones.id as id, tbl_clientes_ubicaciones.nombre_ubicacion as nombre_ubicacion  FROM tbl_clientes_ubicaciones,clientes where tbl_clientes_ubicaciones.id_cliente=clientes.id and clientes.id='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        };
        /* solo ubicacion con empleado que tenga tipo empleado */
        function ubicaciones_all_tipo($tipo) {
            /* $query = "SELECT * FROM `tbl_empleados` where  tipo_empleado='$tipo'"; */
            $query = "SELECT tbl_clientes_ubicaciones.* FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados where tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and codigo_agente=tbl_empleados.codigo_empleado and tipo_empleado='$tipo'";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function afp($codigo1) {
            $query = "SELECT * FROM afp WHERE codigo='$codigo1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        };
        function configuracion() {
            $query = "SELECT * FROM configuracion";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $datos = array();
             // Utiliza fetchAll() para obtener todos los datos en un array
            $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        };
        ?>     
        <?php
          $data_planilla_admin_data = planilla_admin_data($numero,$cambio_table);
          $numero_planilla="";
          $fecha_planilla_desde="";
          $fecha_planilla_hasta="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla.=$row_data_planilla_admin_data["numero_planilladevengo".$cambio_table.""];
              $fecha_planilla_desde.=$row_data_planilla_admin_data["fecha_desde_planilladevengo".$cambio_table.""];
              $fecha_planilla_hasta.=$row_data_planilla_admin_data["fecha_hasta_planilladevengo".$cambio_table.""];
          }

          $fechaActual = date("d-m-Y"); 
        ?>
       

       
     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      <a href="ajax/Reporte planilla opcion cuota patronal.txt" download="Reporte planilla opcion cuota patronal.txt" id="descargar_txt" ></a>
      <a href="ajax/Reporte planilla opcion cuota patronal.pdf" download="Reporte planilla opcion cuota patronal.pdf" id="descargar_pdf" ></a>


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
                            <th colspan="15">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</th>
                        </tr>
                        <tr>
                            <th colspan="15">FECHA    <?php echo $fechaActual ?></th>
                        </tr>
                        <tr>
                            <th colspan="15">PLANILLA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta?></th>
                        </tr>
                        <tr>
                            <th colspan="15">PLANILLA No.   <?php echo $numero?></th>
                        </tr>
                        <tr>
                            <th colspan="12"></th>
                            <th colspan="3">--- CUOTA PATRONAL -----</th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>NOMBRE COMPLETO  CARGO DESEMPEÑADO</th>
                            <th>DIAS</th>
                            <th>SUELDO</th>
                            <th>OTROS DEVENGOS</th>
                            <th>TOTAL DEVENGADO</th>
                            <th>ISSS</th>
                            <th>AFP</th>
                            <th>RENTA</th>
                            <th>O. DESC.</th>
                            <th>T. DESC.</th>
                            <th>T. LIQUIDO</th>
                            <th>ISSS</th>
                            <th>AFP</th>
                            <th>INSAFOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cuenta=0;
                            $correlativo=1;

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
                            $isss_patronal_global=0;
                            $afp_patronal_global=0;
                            $insafor_patronal_global=0;
                        /* OBTENER UBICACIONES */

                        /* VARIABLE POR UBICACION */
                        $correlativo_ubi=1;
                        $salario_ubi=0;
                        $otrosdevengos_ubi=0;
                        $totaldevengado_ubi=0;
                        $isss_ubi=0;
                        $afp_ubi=0;
                        $renta_ubi=0;
                        $otrodescuento_ubi=0;
                        $totaldescuento_ubi=0;
                        $totalliquido_ubi=0;
                        $isspatronal_ubi=0;
                        $afppatronal_ubi=0;
                        $insafor_ubi=0;
                        /* ************************ */

                        $style_personalizado="";
                        $data_ubicaciones_all = ubicaciones_all();
                        if($ubicacion!="*" && $tipo_empleado=="*"){
                            $data_ubicaciones_all=ubicaciones_all_one($ubicacion);
                            $style_personalizado="";

                         }
                         else if($tipo_empleado!="*" && $ubicacion=="*"){
                            $data_ubicaciones_all = ubicaciones_all_tipo($tipo_empleado);
                        }
                         else if($ubicacion!="*" && $tipo_empleado!="*"){
                            $data_ubicaciones_all=ubicaciones_all_one($ubicacion);
                            
                         }
                         else if($ubicacion=="*" && $tipo_empleado=="*"){
                            $data_ubicaciones_all = ubicaciones_all();
                         }

                        foreach($data_ubicaciones_all as $row_ubicaciones_all) {
                            /* echo "<h1> " . $row_ubicaciones_all["id"] . "</h1><br>"; */
                             $ubicaciones=$row_ubicaciones_all["id"];
                        ?>            
                                <tr>
                                    <td colspan="15" style="text-align: left; background: #9ed0ff;">DEPARTAMENTO: <?php echo $row_ubicaciones_all["nombre_ubicacion"]?></td>
                                </tr>
                                <?php
                                        $data_empleado = empleado_ubi_all($ubicaciones);
                                        if($ubicacion!="*" && $tipo_empleado=="*"){
                                            $data_empleado=empleado_ubi($ubicaciones);
                                         }
                                         else if($tipo_empleado!="*" && $ubicacion=="*"){
                                            $data_empleado = empleado_tipo($ubicaciones,$tipo_empleado);
                                        }
                                         else if($ubicacion!="*" && $tipo_empleado!="*"){
                                            $data_empleado=empleado_ubi_tipo($ubicaciones,$tipo_empleado);
                                            
                                         }
                                         else if($ubicacion=="*" && $tipo_empleado=="*"){
                                            $data_empleado = empleado_ubi_all($ubicaciones);
                                         }
                                    $codigo_empleado="";
                                    foreach($data_empleado as $row_empleado) {
                                        $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];
                                        $idempleado=$row_empleado["id"];
                                        $data_planilla_admin = planilla_admin($idempleado,$numero,$cambio_table);
                                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                                        $correlativo_ubi++;
                                        
                                ?>
                                <?php if($ubicaciones==$row_empleado["idubicacion_agente"]){?>

                                <tr>
                                    <!-- no -->
                                    <td><?php echo $correlativo++?></td>
                                    <!-- nombre empleado -->
                                    <td><?php echo $nombre_empleado?></td>
                                    <!-- dias -->
                                    <td><?php echo $row_data_planilla_admin["dias_trabajo_planilladevengo".$cambio_table.""];?></td>
                                     <!-- sueldo -->
                                    <td>
                                        <?php 
                                         
                                            $sueldo_global+=floatval($row_data_planilla_admin["sueldo_planilladevengo".$cambio_table.""]);
                                            $salario_ubi+=floatval($row_data_planilla_admin["sueldo_planilladevengo".$cambio_table.""]);
                                            echo $row_data_planilla_admin["sueldo_planilladevengo".$cambio_table.""];
                                        ?>
                                    </td>
                                     <!-- otros devengos -->
                                     <td>
                                        <?php 
                                        $valor_horas_extras_diurna= floatval($row_data_planilla_admin["hora_extra_diurna_planilladevengo".$cambio_table.""])*floatval($row_empleado["hora_extra_diurna"]);
                                        $valor_horas_extras_norturna= floatval($row_data_planilla_admin["hora_extra_nocturna_planilladevengo".$cambio_table.""])*floatval($row_empleado["hora_extra_nocturna"]);
                                        $valor_horas_extras_domingo_diurna= floatval($row_data_planilla_admin["hora_extra_domingo_planilladevengo".$cambio_table.""])*floatval($row_empleado["hora_extra_domingo"]);
                                        $valor_horas_extras_domingo_nocturna= floatval($row_data_planilla_admin["hora_extra_domingo_nocturna_planilladevengo".$cambio_table.""])*floatval($row_empleado["hora_extra_nocturna_domingo"]);

                                        $otrosdevengos_total=floatval($row_data_planilla_admin["otro_devengo".$cambio_table."_planilladevengo".$cambio_table.""])+$valor_horas_extras_diurna+$valor_horas_extras_norturna+$valor_horas_extras_domingo_diurna+$valor_horas_extras_domingo_nocturna;
                                        $capturar_otros_devengos=floatval($otrosdevengos_total)-0;
                                        echo number_format($capturar_otros_devengos, 2, '.', '');
                                        $otrodevengo+=floatval($otrosdevengos_total)-0;
                                        $otrosdevengos_ubi+=floatval($otrosdevengos_total)-0;

                                        ?>
                                    </td>
                                     <!-- total devengado -->
                                     <td>
                                        <?php  
                                            $totaldevengo_global+=floatval($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo".$cambio_table.""]);
                                            $totaldevengado_ubi+=floatval($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo".$cambio_table.""]);
                                            $capturar_total_deve=floatval($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo".$cambio_table.""]);
                                            echo bcdiv($row_data_planilla_admin["total_devengo".$cambio_table."_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- descuento isss -->
                                    <td>
                                        <?php 
                                        $isss_global+=floatval($row_data_planilla_admin["descuento_isss_planilladevengo".$cambio_table.""]);
                                        $isss_ubi+=floatval($row_data_planilla_admin["descuento_isss_planilladevengo".$cambio_table.""]);
                                        echo bcdiv($row_data_planilla_admin["descuento_isss_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- descuento afp -->
                                    <td>
                                        <?php  
                                        $afp_global+=floatval($row_data_planilla_admin["descuento_afp_planilladevengo".$cambio_table.""]);
                                        $afp_ubi+=floatval($row_data_planilla_admin["descuento_afp_planilladevengo".$cambio_table.""]);
                                        echo bcdiv($row_data_planilla_admin["descuento_afp_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- descuento renta -->
                                    <td>
                                        <?php 
                                            $renta_global+=floatval($row_data_planilla_admin["descuento_renta_planilladevengo".$cambio_table.""]);
                                            $renta_ubi+=floatval($row_data_planilla_admin["descuento_renta_planilladevengo".$cambio_table.""]);
                                            echo bcdiv($row_data_planilla_admin["descuento_renta_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- otro descuento -->
                                    <td>
                                        <?php 
                                            $otrodesc_global+=floatval($row_data_planilla_admin["otro_descuento_planilladevengo".$cambio_table.""]); 
                                            $otrodescuento_ubi+=floatval($row_data_planilla_admin["otro_descuento_planilladevengo".$cambio_table.""]); 
                                            echo bcdiv($row_data_planilla_admin["otro_descuento_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- total descuento -->
                                    <td><?php 
                                              $totaldescuento_global+=floatval($row_data_planilla_admin["total_descuento_planilladevengo".$cambio_table.""]);
                                              $totaldescuento_ubi+=floatval($row_data_planilla_admin["total_descuento_planilladevengo".$cambio_table.""]);
                                              echo bcdiv($row_data_planilla_admin["total_descuento_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- total liquidi -->
                                    <td>
                                        <?php 
                                            $totalliquido_global+=floatval($row_data_planilla_admin["total_liquidado_planilladevengo".$cambio_table.""]);
                                            $totalliquido_ubi+=floatval($row_data_planilla_admin["total_liquidado_planilladevengo".$cambio_table.""]);
                                            echo bcdiv($row_data_planilla_admin["total_liquidado_planilladevengo".$cambio_table.""],'1', 2)
                                        ?>
                                    </td>
                                    <!-- isss patronal -->
                                    <td>
                                        <?php 
                                            $cuota_patronal_isss=0;
                                            $data_config=configuracion();
                                            foreach($data_config as $row_config) {
                                            $cuota_patronal_isss=floatval($row_config["cuota_patronal_isss"]);
                                            }
                                           $isss_patronal=floatval($capturar_total_deve)*$cuota_patronal_isss/100;
                                           $isss_patronal_global+=$isss_patronal;
                                           $isspatronal_ubi+=$isss_patronal;

                                           echo bcdiv($isss_patronal,'1', 2);
                                        ?>
                                    </td>
                                    <!-- afp patronal -->
                                    <td>
                                        <?php 
                                           $codigo_afp=$row_empleado["codigo_afp"];
                                           $data_afp=afp($codigo_afp);
                                           $cuota_patronal=0;
                                           foreach($data_afp as $row_afp) {
                                            $cuota_patronal=floatval($row_afp["cuota_patronal"]);
                                            }

                                           $afp_patronal=floatval($capturar_total_deve)*$cuota_patronal/100;
                                           $afp_patronal_global+=$afp_patronal;
                                           $afppatronal_ubi+=$afp_patronal;
                                           echo bcdiv($afp_patronal,'1', 2);
                                        ?>
                                    </td>
                                    <!-- isafor patronal -->
                                    <td>
                                        <?php 
                                           $insafor=0;
                                           foreach($data_config as $row_config) {
                                            $insafor=floatval($row_config["insaforp"]);
                                            }

                                           $insafor_patronal=floatval($capturar_total_deve)*$insafor/100;
                                           $insafor_patronal_global+=$insafor_patronal;
                                           $insafor_ubi+=$insafor_patronal;
                                           echo bcdiv($insafor_patronal,'1', 2);
                                        ?>
                                    </td>
                           
                                    
                                </tr>

                                <?php
                                     }/* cierre if */
                                     
                                    }/* cierre  foreight planilla*/
                                    
                                 }/* cierre  foreight empleados*/
                                ?>
                                <tr  <?php echo $style_personalizado?>>
                                    <td class="borrar_contenido" colspan="15"><?php echo str_repeat("-", 320)?></td>
                                </tr>
                                <tr <?php echo $style_personalizado?>>
                                    <td>Son:</td>
                                    <td><?php echo $correlativo_ubi-1; $correlativo_ubi=1;?></td>
                                    <td></td>
                                    <td><?php echo number_format($salario_ubi, 2, '.', ''); $salario_ubi=0;?></td>
                                    <td><?php echo number_format($otrosdevengos_ubi, 2, '.', ''); $otrosdevengos_ubi=0;?></td>
                                    <td><?php echo number_format($totaldevengado_ubi, 2, '.', ''); $totaldevengado_ubi=0;?></td>
                                    <td><?php echo number_format($isss_ubi, 2, '.', ''); $isss_ubi=0;?></td>
                                    <td><?php echo number_format($afp_ubi, 2, '.', ''); $afp_ubi=0;?></td>
                                    <td><?php echo number_format($renta_ubi, 2, '.', ''); $renta_ubi=0;?></td>
                                    <td><?php echo number_format($otrodescuento_ubi, 2, '.', ''); $otrodescuento_ubi=0;?></td>
                                    <td><?php echo number_format($totaldescuento_ubi, 2, '.', ''); $totaldescuento_ubi=0;?></td>
                                    <td><?php echo number_format($totalliquido_ubi, 2, '.', ''); $totalliquido_ubi=0;?></td>
                                    <td><?php echo number_format($isspatronal_ubi, 2, '.', ''); $isspatronal_ubi=0;?></td>
                                    <td><?php echo number_format($afppatronal_ubi, 2, '.', ''); $afppatronal_ubi=0;?></td>
                                    <td><?php echo number_format($insafor_ubi, 2, '.', ''); $insafor_ubi=0;?></td>
                                </tr>
                                <tr  <?php echo $style_personalizado?>>
                                    <td class="borrar_contenido" colspan="15"><?php echo str_repeat("-", 320)?></td>
                                </tr>
                            <?php
                                }/* cierre  foreight ubicacionse*/
                            ?>
                               
                    <?php
                        
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
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                               /*  echo "<td>".number_format($row["sumasueldo"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($sueldo_global, 2, '.', '.') ."</td>";

                        ?>
                        
                        <!-- otros devengos -->
                        <?php
                                /* $total=floatval($row["sumaotrodevengo"])-$sumaferiado; */
                                echo "<td>".number_format($otrodevengo, 2, '.', '.')."</td>";
                                 
                        ?>
                        <!-- total devengo -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumatotaldevengo"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totaldevengo_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- isss -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaisss"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($isss_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- afp -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaafp"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($afp_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- renta -->
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumarenta"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($renta_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- otro descuento -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["sumaotrodescuento"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($otrodesc_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- total descuento -->
                        <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["totaldescuento"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totaldescuento_global, 2, '.', '.') ."</td>";
                        ?>
                        <!-- total liquidado -->
                         <?php
                            $data_sumaglobal = suma_planilla_admin_data($numero,$cambio_table);
                            foreach($data_sumaglobal as $row) {
                                /* echo "<td>".number_format($row["totalliquido"], 2, ',', '.') ."</td>"; */
                            }     
                            echo "<td>".number_format($totalliquido_global, 2, '.', '.') ."</td>";
                            echo "<td>".number_format($isss_patronal_global, 2, '.', '.') ."</td>";
                            echo "<td>".number_format($afp_patronal_global, 2, '.', '.') ."</td>";
                            echo "<td>".number_format($insafor_patronal_global, 2, '.', '.') ."</td>";

                        ?>
                        
                    </tr>

                    <tr>
                        <td  colspan="15" style="text-align: left;">
                            <?php 
                            $total_banco=floatval($sueldo_global)+floatval($otrodevengo)+floatval($totaldevengo_global)+floatval($isss_global)+floatval($afp_global)+floatval($renta_global)+floatval($otrodesc_global)+floatval($totaldescuento_global)+floatval($totalliquido_global)+floatval($isss_patronal_global)+floatval($afp_patronal_global)+floatval($insafor_patronal_global);

                            echo "TOTAL BANCO :  ".number_format($totalliquido_global, 2, '.', '.');
                            ?>
                        </td>
                    </tr>
            </tbody>
          </table>
          <input type="hidden" class="lineas" value="<?php echo str_repeat("-", 320)?>">
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
            url: "ajax/pdf_txt_cuotapatronal.php", // Cambia esto por la URL del script PHP en tu servidor
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
        
        var guardar_contenido=$(".lineas").val();
        $(".borrar_contenido").empty();
        /* pdf */
        var tablaHtml = $("#tabladatos").prop("outerHTML");
        
	 $('.modal_carga').modal({backdrop: 'static', keyboard: false});
     $(".modal_carga").modal("show");
    
     
        $.ajax({
            url: "ajax/pdf_txt_cuotapatronal.php", // Cambia esto por la URL del script PHP en tu servidor
            type: "POST",
            data: { tabla: tablaHtml }, // Datos a enviar
            success: function (response) {
                
                   // Trigger the download by simulating a click
                    var downloadUrl = $("#descargar_pdf").attr("href");
                    var fileName = $("#descargar_pdf").attr("download");
                    downloadFile(downloadUrl, fileName);
                    
                    $('.modal_carga').modal({backdrop: 'static', keyboard: true});
                    $('.modal_carga').modal('hide');
                     $(".borrar_contenido").text(guardar_contenido);



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
            
            var guardar_contenido=$(".lineas").val();
            $(".borrar_contenido").empty();

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
            XLSX.writeFile(wb, "Reporte planilla opcion cuota patronal.xlsx");
            $(".borrar_contenido").text(guardar_contenido);

        });


    });
</script>
