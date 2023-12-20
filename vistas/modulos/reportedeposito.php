

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

      /* **************************************** */
      $tipoplanilla=$_POST["tipo_planilla"];
      $devengos_table_maestra=$_POST["devengos_table"];

      if($devengos_table_maestra==""){
        $devengos_table_maestra="tbl_devengo_descuento_planilla";
      }
      else if($devengos_table_maestra=="_vacacion"){
        $devengos_table_maestra="tbl_devengo_descuento_planilla_vacacion";

      }
      else if($devengos_table_maestra=="_aguinaldo"){
        $devengos_table_maestra="tbl_devengo_descuento_planilla_aguinaldo";

      }
      else if($devengos_table_maestra=="_gratifivaca"){
        $devengos_table_maestra="tbl_devengo_descuento_planilla_gratifivaca";

      }
      else if($devengos_table_maestra=="_admin"){
        $devengos_table_maestra="tbl_devengo_descuento_planilla_admin";

      }

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


        function nombre_columnas_devengos($devengos_table_maestra)
        {
            $query = "SHOW COLUMNS FROM $devengos_table_maestra";
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

        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero,$tipoplanilla,$numeroplanillamaestro) {
            $query = "SELECT * FROM $tipoplanilla where  $numeroplanillamaestro='$numero'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero,$tipoplanilla,$numero_planilla_maestro) {
            $query = "SELECT * FROM $tipoplanilla where $numero_planilla_maestro='$numero' limit 1";
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
        function devengos($idempleado1,$numero,$devengos_table) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM $devengos_table where  idempleado_devengo='$idempleado1' and codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='No' and afp_devengo_devengo_descuento_planilla='No' and renta_devengo_devengo_descuento_planilla='No' and tipo_valor like'%suma%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_contodo($idempleado1,$numero,$devengos_table) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM $devengos_table where  idempleado_devengo='$idempleado1' and (codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and afp_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and renta_devengo_devengo_descuento_planilla='Si') and tipo_valor like'%suma%'";
            
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
         <?php
          $data_banco = banco($banco_value);
          $nombre_banco="";
          foreach($data_banco as $row_banco) {
              $nombre_banco.=$row_banco["nombre"];
          }

        ?>

      <div class="col-md-12" align="center">
        <?php
        $nombre_ubicacion="";

        if($ubicacion!="*"){
            $dataubicacion = empleado_ubi_only($ubicacion);
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
                        $data_planilla_admin = planilla_admin($numero,$tipoplanilla,$numero_planilla_maestro);
                        $depositar_global=0;
                        $efectivo_global=0;
                        $administrativa_global=0;
                        $devengos_global=0;
                        $total_global=0;
                        $referencia_global=0;
                        $correlativo=0;
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin[$id_planilla];
                            $idempleado=$row_data_planilla_admin[$idempleado_planilla_maestro];
                            $codigo=$row_data_planilla_admin[$codigo_empleado_planilla_maestro];
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
                                        <td><?php echo $row_data_planilla_admin[$nombre_empleado_planilla_maestro]?></td>
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
                                            $numero_cuenta=$row_data_planilla_admin[$total_liquido_maestro].str_repeat(" ",3);
                                        }
                                        $depositar_global+=floatval($numero_cuenta);
                                        echo "<td>".bcdiv(floatval($numero_cuenta),'1', 2)."</td>";
                                       ?>
                                        <!-- efectivo -->
                                      <?php 
                                        $efectivo=0;
                                        if($row_empleado["numero_cuenta"]=="")
                                        {
                                            $efectivo_global+=floatval($row_data_planilla_admin[$total_liquido_maestro]);
                                            $efectivo=floatval($row_data_planilla_admin[$total_liquido_maestro]);
                                            echo "<td>".bcdiv($row_data_planilla_admin[$total_liquido_maestro],'1', 2)."</td>";
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
                                        if($row_data_planilla_admin[$descuento_isss_maestro]=="0"){
                                            echo "<td>0.00</td>";
                                            $administrativa=0;
                                            $administrativa_global+=0.00;

                                        }
                                        else{

                                            $data_devengos = devengos($idempleado,$numero,$devengos_table_maestra);
                                            $devengos_nograbados=0;
                                            foreach($data_devengos as $row_devengo) {
                                                $devengos_nograbados=bcdiv($row_devengo["sumadevengo"],'1', 2);
                                            }


                                            $data_devengos = devengos_contodo($idempleado,$numero,$devengos_table_maestra);
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
                                        
                                        $data_devengos = devengos($idempleado,$numero,$devengos_table_maestra);
                                        foreach($data_devengos as $row_devengo) {
                                            echo"<td>".bcdiv($row_devengo["sumadevengo"],'1', 2)."</td>";
                                            $devengos_global+=floatval($row_devengo["sumadevengo"]);
                                        }
                                        
                                        ?>
                                        <!-- total -->
                                        <td>
                                            <?php 
                                                $suma=floatval($efectivo)+floatval($administrativa);
                                                $total=$row_data_planilla_admin[$total_liquido_maestro];
                                                echo bcdiv($row_data_planilla_admin[$total_liquido_maestro],'1', 2);
                                                $total_global+=floatval($row_data_planilla_admin[$total_liquido_maestro]);

                                               /*  echo $suma; */
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $liquido_menos_total=floatval($row_data_planilla_admin[$total_liquido_maestro])-floatval($row_data_planilla_admin[$total_liquido_maestro]);
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