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


      <div class="btnreporte" style="display:none">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccionar Opción a imprimir
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <button id="exportExcel" class="dropdown-item btn btn-success "  >Exportar a Excel</button>
                 <!-- <button id="exportTXT" class="dropdown-item btn btn-info "  >Exportar a TXT</button> -->
                 <button id="exportPDF" class="dropdown-item btn btn-warning btnreporte" style="display:none">Exportar a PDF</button>
            </div>
        </div>
    </div>


      <!-- <a href='vistas/modulos/reportecontratados.txt' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <!-- <a href='vistas/modulos/Reporte_hora_extra.xlsx' download class="btn btn-primary btnreporte" style="display:none">
        Descargar archivo
      </a> -->
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
      $fecha_desde=$_POST["fecha_desde"];
      $fecha_hasta=$_POST["fecha_hasta"];
      /* $banco_value=""; */
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($fecha_desde,$fecha_hasta) {
            $query = "SELECT * FROM `planilladevengo_admin` where   STR_TO_DATE(fecha_hasta_planilladevengo_admin, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta' GROUP BY id_empleado_planilladevengo_admin limit 30";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_dos($fecha_desde,$fecha_hasta) {
            $query = "SELECT * FROM `planilladevengo_admin` where   STR_TO_DATE(fecha_hasta_planilladevengo_admin, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta' GROUP BY numero_planilladevengo_admin";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

    

        function planilla_vacacion($fecha_desde,$fecha_hasta,$idempleado) {
            $query = "SELECT SUM(dias_trabajo_planilladevengo_vacacion) AS sumadias FROM `planilladevengo_vacacion` where  id_empleado_planilladevengo_vacacion='$idempleado' and STR_TO_DATE(fecha_hasta_planilladevengo_vacacion, '%Y-%m-%d')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
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
        function devengo_vacacion($idempleado1,$numero1) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumavalor FROM tbl_devengo_descuento_planilla_vacacion where  codigo_devengo_descuento_planilla='0024' and codigo_planilla_devengo='$numero1' and idempleado_devengo='$idempleado1'";
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

        function suma_planilla_admin_data($fecha_desde,$fecha_hasta,$idempleado) {
            $query = "SELECT SUM(dias_trabajo_planilladevengo_admin) AS sumadias, SUM(sueldo_planilladevengo_admin) AS sumasueldo,SUM(otro_devengo_admin_planilladevengo_admin) AS sumaotrodevengo,SUM(total_devengo_admin_planilladevengo_admin) AS sumatotaldevengo,SUM(descuento_isss_planilladevengo_admin) AS sumaisss, SUM(descuento_afp_planilladevengo_admin) AS sumaafp,SUM(descuento_renta_planilladevengo_admin) AS sumarenta,SUM(otro_descuento_planilladevengo_admin) AS sumaotrodescuento, SUM(total_descuento_planilladevengo_admin) AS totaldescuento,SUM(total_liquidado_planilladevengo_admin) AS totalliquido  
            FROM `planilladevengo_admin` 
            where  id_empleado_planilladevengo_admin='$idempleado' and STR_TO_DATE(fecha_hasta_planilladevengo_admin, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
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

        function configuracion() {
            $query = "SELECT * FROM configuracion";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function afp($codigo) {
            $query = "SELECT * FROM afp WHERE codigo='$codigo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_contodo($idempleado1,$numero,$numero2) {
            $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo
            FROM tbl_devengo_descuento_planilla_admin
            WHERE
                idempleado_devengo = '$idempleado1'
                AND (
                    (codigo_planilla_devengo IN ('$numero', '$numero2') AND isss_devengo_devengo_descuento_planilla = 'Si')
                    OR
                    (codigo_planilla_devengo IN ('$numero', '$numero2') AND afp_devengo_devengo_descuento_planilla = 'Si')
                    OR
                    (codigo_planilla_devengo IN ('$numero', '$numero2') AND renta_devengo_devengo_descuento_planilla = 'Si')
                )
                AND tipo_valor LIKE '%suma%'
            GROUP BY idempleado_devengo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };



        /* validar codigos**************** */

        function situ_ausencia($fecha_desde,$fecha_hasta,$codigo_empleado) {
            $query = "SELECT * FROM `situacion` where  idempleado_situacion='$codigo_empleado' and incapacidad_situacion>0 and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function empleado_contra($fecha_desde,$fecha_hasta,$codigo_empleado) {
            $query = "SELECT * FROM `tbl_empleados` where  codigo_empleado='$codigo_empleado' and STR_TO_DATE(fecha_contratacion, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function empleado_pensi($codigo_empleado) {
            $query = "SELECT * FROM `tbl_empleados` where  codigo_empleado='$codigo_empleado' and pensionado_empleado='Si'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        
        function empleado_retiro($fecha_desde,$fecha_hasta,$codigo_empleado) {
            $query = "SELECT * FROM `retiro` where  idempleado_retiro='$codigo_empleado' and STR_TO_DATE(fecha_retiro, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        /* codigo dos */

        function situ_vaca($fecha_desde,$fecha_hasta,$codigo_empleado) {
            $query = "SELECT * FROM `situacion` where  idempleado_situacion='$codigo_empleado' and incapacidad_situacion='' or incapacidad_situacion='0' and vacaciones_situacion>0 and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function situ_vaca_inca($fecha_desde,$fecha_hasta,$codigo_empleado) {
            $query = "SELECT * FROM `situacion` where  idempleado_situacion='$codigo_empleado' and incapacidad_situacion>0  and vacaciones_situacion>0 and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fecha_desde' AND '$fecha_hasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        /* ******************************* */

        $formato_desde= date("Y-m-d", strtotime($fecha_desde));
        $formato_hasta= date("Y-m-d", strtotime($fecha_hasta));
        $fechaActual = date("Y-m-d");

        
        $data_planilla_admin = planilla_admin_dos($formato_desde,$formato_hasta);
        $numero="";
        foreach($data_planilla_admin as $row_data_planilla_admin) {
            $numero.=$row_data_planilla_admin["numero_planilladevengo_admin"].",";
        }
        $partes = explode(",", $numero);
      /*   echo "<h1>".$partes[0]."</h1>"; */

        ?>     
   

    
      <div class="col-md-12" align="center" >
        <h5>REPORTE SSF</h5>
        <h5>FECHA    <?php echo $fechaActual ?></h5>
      </div>

      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIT</th>
                            <th>No. PATRONAL</th>
                            <th>PERIODO</th>
                            <th>CORR.</th>
                            <th> DOC. AFILIADO</th>
                            <th>TIPO</th>
                            <th>No. PAT. AFILIADO</th>
                            <th>AFP</th>
                            <th>1er NOMBRE</th>
                            <th>2do NOMBRE</th>
                            <th>1er APELLIDO </th>
                            <th>2do APELLIDO </th>
                            <th> APELLIDO CASADA  </th>
                            <th>SALARIO</th>
                            <th>PAGO ADICIONAL</th>
                            <th>VACACION</th>
                            <th>DIAS</th>
                            <th>HORAS</th>
                            <th>DIAS VAC.</th>
                            <th>COD. OBS. 1</th>
                            <th>COD. OBS. 2</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cuenta=0;
                        $correlativo=1;
                        $data_planilla_admin = planilla_admin($formato_desde,$formato_hasta);
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin["id"];
                            $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo_admin"];
                            $numero=$row_data_planilla_admin["numero_planilladevengo_admin"];
                    ?>         
                     <?php
                        $data_empleado = empleado($idempleado);
                        $codigo_empleado="";
                        foreach($data_empleado as $row_empleado) {


                            /* validacion codigo 1 */
                            $id_empleados=$row_empleado["id"];
                            $codigo_emple_contra=$row_empleado["codigo_empleado"];
                            
                            $data_situ=situ_ausencia($formato_desde,$formato_hasta,$id_empleados);
                            $validar_incapacidad=0;
                            foreach ($data_situ as $val_situ) {
                              $validar_incapacidad++;
                            }

                            $data_contra=empleado_contra($formato_desde,$formato_hasta,$codigo_emple_contra);
                            $validar_contra=0;
                            foreach ($data_contra as $val_contra) {
                              $validar_contra++;
                            }

                            
                            $data_pensi=empleado_pensi($codigo_emple_contra);
                            $validar_pensi=0;
                            foreach ($data_pensi as $val_pensi) {
                              $validar_pensi++;
                            }

                            $data_retiro=empleado_retiro($formato_desde,$formato_hasta,$id_empleados);
                            $validar_retiro=0;
                            foreach ($data_retiro as $val) {
                              $validar_retiro++;
                            }




                            $valor_codigo_uno=1;
                            if($validar_incapacidad>0){
                                $valor_codigo_uno=6;
                            }
                            if($validar_contra>0){
                                $valor_codigo_uno=8;
                            }
                            if($validar_pensi>0){
                                $valor_codigo_uno=4;
                            }
                            if($validar_retiro>0){
                                $valor_codigo_uno=7;
                            }
                            /* fin validacion codigo uno */


                            /* validar codigo dos */

                            
                            
                            $data_vaca=situ_vaca($formato_desde,$formato_hasta,$id_empleados);
                            $validar_vaca=0;
                            foreach ($data_vaca as $val) {
                              $validar_vaca++;
                            }

                            $data_vaca_inca=situ_vaca_inca($formato_desde,$formato_hasta,$id_empleados);
                            $validar_vaca_inca=0;
                            foreach ($data_vaca_inca as $val) {
                              $validar_vaca_inca++;
                            }

                            $valor_codigo_dos=1;
                            if($validar_vaca>0){
                                $valor_codigo_dos=9;
                            }
                            if($validar_vaca_inca>0){
                                $valor_codigo_dos=10;
                            }


                            /* fin validar codigo dos */

                    ?>
                            <tr>
                                <!-- No -->
                                <td><?php echo $correlativo++." " ?></td>
                                <!-- NIT -->
                                <?php
                                    $data_config = configuracion();
                                    foreach($data_config as $row_config) {
                                        echo "<td>".$row_config["nit"]." "."</td>";
                                    }
                                ?>
                                <!-- No. PATRONAL	 -->
                                <?php
                                    $data_config = configuracion();
                                    foreach($data_config as $row_config) {
                                        echo "<td>".$row_config["num_patronal"].""."</td>";
                                    }
                                ?>
                                <!-- PERIODO -->
                                 <?php
                                        $mes= date("m", strtotime($fecha_hasta));
                                        $anio= date("Y", strtotime($fecha_hasta));
                                        $periodo=$mes.$anio;
                                        echo "<td>".$periodo."periodo"."</td>";
                                ?>
                                <!-- CORR -->
                                <?php
                                    $data_config = configuracion();
                                    foreach($data_config as $row_config) {
                                        echo "<td>00".$row_config["centro_trabajo"].""."</td>";
                                    }
                                ?>
                                <!-- DOC. AFILIADO	 -->
                                <td><?php echo  str_replace("-", "", $row_empleado["numero_documento_identidad"])." "?></td>
                                <!-- TIPO -->
                                <td>01</td>
                                <!-- No. PAT. AFILIADO	 -->
                                <td><?php echo  str_replace("-", "", $row_empleado["numero_isss"])." "?></td>
                                <!-- AFP	 -->
                                <?php
                                    $data_afp = afp($row_empleado["codigo_afp"]);
                                    $datoafp="";
                                    foreach($data_afp as $row) {
                                        $datoafp=$row["codigo_superintendencia"];
                                    }
                                    if(isset($datoafp)){
                                        $data_afp=" ";
                                    }
                                    echo "<td>".$data_afp ."</td>";

                                ?>
                                <!-- 1er NOMBRE	 -->
                                <td><?php echo $row_empleado["primer_nombre"]." " ?></td>
                                <!-- 2do NOMBRE	 -->
                                <td><?php echo $row_empleado["segundo_nombre"]." " ?></td>
                                <!-- 1er APELLIDO	 -->
                                <td><?php echo $row_empleado["primer_apellido"]." " ?></td>
                                <!-- 2do APELLIDO	 -->
                                <td><?php echo $row_empleado["segundo_apellido"]." " ?></td>
                                <!-- APELLIDO CASADA	 -->
                                <td><?php echo $row_empleado["apellido_casada"]." " ?></td>
                                <!-- SALARIO -->
                                <?php
                                    $data_salario = suma_planilla_admin_data($formato_desde,$formato_hasta,$idempleado);
                                    foreach($data_salario as $row) {
                                        echo "<td>".$row["sumasueldo"]."</td>";
                                    }
                                ?>
                                <!-- PAGO ADICIONAL -->
                                <?php
                                 $data_devengos= devengos_contodo($idempleado,$partes[0],$partes[1]);
                                 $sumadevengo_contodo=0;
                                 foreach($data_devengos as $row) {
                                     if($idempleado==$row["idempleado_devengo"]){
                                        $sumadevengo_contodo=floatval($row["sumadevengo"]);
                                     }
                                 }
                                 if($sumadevengo_contodo==""){
                                    $sumadevengo_contodo=0.00;
                                 }
                                 echo "<td>".$sumadevengo_contodo."</td>";
                                ?>
                                <!-- VACACION -->
                                <?php
                                 $data_vacacion= devengo_vacacion($idempleado,$numero);
                                 $valorvacacion=0;
                                 foreach($data_vacacion as $row) {
                                        $valorvacacion=floatval($row["sumavalor"]);
                                 }
                                 if($valorvacacion==""){
                                    $valorvacacion=0.00;
                                 }
                                 echo "<td>".$valorvacacion."</td>";
                                ?>
                                <!--  DIAS-->
                                <?php
                                    $data_salario = suma_planilla_admin_data($formato_desde,$formato_hasta,$idempleado);
                                    $diassumas="";
                                    foreach($data_salario as $row) {
                                        $diassumas=$row["sumadias"];
                                    }
                                    if(empty($diassumas)){
                                        $diassumas="0";
                                    }
                                    echo "<td>".$diassumas."</td>";

                                ?>
                                <!-- HORAS -->
                                <td><?php echo "0".$row_empleado["horas_normales_trabajo"] ?></td>

                                <!-- DIAS VAC.	 -->
                                <?php
                                    $data_salario = planilla_vacacion($formato_desde,$formato_hasta,$idempleado);
                                    $diasvacacion="";
                                    foreach($data_salario as $row) {
                                        $diasvacacion=$row["sumadias"];
                                    }
                                    if(empty($diasvacacion)){
                                        $diasvacacion="0";
                                    }
                                    echo "<td>".$diasvacacion."</td>";
                                ?>
                                <!-- COD. OBS. 1	 -->
                                <td><?php echo $valor_codigo_uno?></td>
                                <!-- COD. OBS. 2 -->
                                <td><?php echo $valor_codigo_dos?></td>
                            </tr>
                              
                    <?php
                        }
                    ?>
                    <?php
                        }
                    ?>
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
    
        var titulo_reporte=$(".titulo_reportes").val();
        
        var tablaHtml = document.getElementById("tabladatos");

        var ws = XLSX.utils.table_to_sheet(tablaHtml, { raw: true });
        /* var ws = XLSX.utils.table_to_sheet(tablaHtml); */
              /* **************************** */
                // 2. Crea un estilo para centrar el contenido
                var style = {
                    alignment: {
                        horizontal: "center",
                        vertical: "center" // Opcional: también puedes centrar verticalmente
                    }
                };
                // 3. Itera sobre todas las celdas de la hoja y aplica el estilo
                for (var cellRef in ws) {
                    if (ws.hasOwnProperty(cellRef)) {
                        if (!ws[cellRef].s) {
                            ws[cellRef].s = style;
                        } else {
                            // Combina el estilo existente con el estilo de centrado
                            ws[cellRef].s = Object.assign(ws[cellRef].s, style);
                        }
                    }
                }
            /* *************************** */

        var wb = XLSX.utils.book_new();
        
        /* ***************************** */

        var columnLengths = {};
        var columnFechaLengths = {};

        $('#tabladatos tr').each(function () {
            $(this).find('td').each(function (colIndex) {
                var cellText = $(this).text().trim();
                var cellLength = cellText.length;
                // Rastrear la longitud máxima de cada columna
                if (!columnLengths[colIndex] || cellLength > columnLengths[colIndex]) {
                    columnLengths[colIndex] = cellLength;
                }
                // Comprobar si la celda contiene la palabra "fecha" y rastrear su longitud
                if (cellText.toLowerCase().includes('fecha')) {
                    columnFechaLengths[colIndex] = cellLength;
                }
            });
        });

        // Mostrar la longitud máxima de cada columna
        for (var colIndex in columnLengths) {
            console.log('Longitud máxima de la columna ' + colIndex + ': ' + columnLengths[colIndex]);
            ws['!cols'][colIndex] = { wch: columnLengths[colIndex]+5, };

        }
        // Mostrar la longitud de la palabra "fecha" en cada columna
        for (var colIndex in columnFechaLengths) {
            console.log('Longitud de la palabra "fecha" en la columna ' + colIndex + ': ' + columnFechaLengths[colIndex]);
            ws['!cols'][colIndex] = { wch: columnFechaLengths[colIndex]+5, };
        }

        /* ************************** */
     

        /* ************************** */


       /*  ws['!cols'][0] = { wch: 10, };
        ws['!cols'][1] = { wch: 50, };
        ws['!cols'][2] = { wch: 20, };
        ws['!cols'][3] = { wch: 20, };
        ws['!cols'][4] = { wch: 50, };
        ws['!cols'][5] = { wch: 20, };
        ws['!cols'][6] = { wch: 60, };
        ws['!cols'][7] = { wch: 10, };
        ws['!cols'][8] = { wch: 10, };
        ws['!cols'][9] = { wch: 60, };
        ws['!cols'][10] = { wch: 60, };
        ws['!cols'][11] = { wch: 40, };
        ws['!cols'][12] = { wch: 20, }; */


        /*  */

        

        /*  */
            
           /*  for (var i = 5; i < 10; i++) {
                var letra="A"+i;
                ws[letra].s = {
                        alignment: {
                        vertical: 'center',
                        horizontal: 'center',
                        wrapText: '1',
                        },
                    };
            } */
      
            





        XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
        XLSX.writeFile(wb,"SSF.xlsx");
       

    });

});


</script>