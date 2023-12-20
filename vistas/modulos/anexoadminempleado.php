

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
 <?php
 
 $planilladesde=$_POST["planilladesde"];
 $planillahasta=$_POST["planillahasta"];

 $banco_value=$_POST["banco"];
 $idempleadoinput=$_POST["empleado"];
 $ubicacion=$_POST["ubicacion"];
 $esconder="";
 if($ubicacion!="*"){
$esconder="style='display:none'";
 }

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
 ?>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      
      <a href="ajax/ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS TODOS.txt" download="ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS TODOS.txt" id="descargar_txt" ></a>
      <a href="ajax/ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS TODOS.pdf" download="ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS TODOS.pdf" id="descargar_pdf" ></a>
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
                 <button id="exportExcel" class="dropdown-item btn btn-success " <?php echo $esconder?> >Exportar a Excel</button>
                 <button id="exportTXT" class="dropdown-item btn btn-info " <?php echo $esconder?> >Exportar a TXT</button>
                 <button id="exportPDF" class="dropdown-item btn btn-warning btnreporte" style="display:none">Exportar a PDF</button>
            </div>
        </div>
       </div>
      <!--  -->
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
        /* nuevos */
      

        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero,$idempleado,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo".$cambio_table."` where id_empleado_planilladevengo".$cambio_table."='$idempleado' and  numero_planilladevengo".$cambio_table."='$numero'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_noempleado($planilladesde, $planillahasta,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo".$cambio_table."` where  numero_planilladevengo".$cambio_table.">='$planilladesde' and numero_planilladevengo".$cambio_table."<='$planillahasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_noemple_one($planilladesde, $planillahasta, $idempleado,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo".$cambio_table."` where  numero_planilladevengo".$cambio_table.">='$planilladesde' and numero_planilladevengo".$cambio_table."<='$planillahasta' and id_empleado_planilladevengo".$cambio_table."='$idempleado'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo".$cambio_table."` where numero_planilladevengo".$cambio_table."='$numero' limit 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleado($id) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id ";
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
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_ubicaciones_agentes_asignados.idubicacion_agente='$idubicacion'";
            /* echo $query; */
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo ubicacion */
        function ubicacion_empleado($codigo) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /*  ubicacion y tipo empleado */
        function empleado_ubi_tipo($codigo,$idubicacion,$tipo_empleado1,$idbando1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' and 
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and 
                              tbl_empleados.id_banco=$idbando1 and
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

        function devengos($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  idempleado_devengo='$idempleado1' and codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='No' and afp_devengo_devengo_descuento_planilla='No' and renta_devengo_devengo_descuento_planilla='No' and tipo_valor like'%suma%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_desde_hasta($planilladesde,$planillahasta,$devengos_table_maestra) {
            $query = "SELECT*FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where codigo_planilla_devengo>='$planilladesde' and codigo_planilla_devengo<='$planillahasta' group by codigo_devengo_descuento_planilla ORDER BY CASE WHEN tipo_valor LIKE '%suma%' THEN 1 ELSE 2 END";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos_empleados($codigo,$devengos_table_maestra) {
            $query = "SELECT sum(valor_devengo_planilla) as valor,COUNT(*) AS cantidad, tbl_devengo_descuento_planilla".$devengos_table_maestra.".* FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  codigo_devengo_descuento_planilla='$codigo' group by idempleado_devengo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos_fijos($iddevengo,$idempleado) {
            $query = "SELECT sum(valor) as valor FROM tbl_empleados_devengos_descuentos where  id_tipo_devengo_descuento='$iddevengo' and id_empleado='$idempleado' and tipodescuento='Siempre' group by id_empleado";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_contodo($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  idempleado_devengo='$idempleado1' and (codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and afp_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and renta_devengo_devengo_descuento_planilla='Si') and tipo_valor like'%suma%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos_norestrinccion($id,$tipo,$devengos_table_maestra) {
            $query = "SELECT * FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  id='$id' and tipo_valor like'%$tipo%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function descuentos_norestrinccion($id,$tipo,$devengos_table_maestra) {
            $query = "SELECT * FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  id='$id' and tipo_valor like'%$tipo%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos_table($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT * FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  (codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and afp_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and renta_devengo_devengo_descuento_planilla='Si') and idempleado_devengo='$idempleado1' and codigo_planilla_devengo='$numero'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_porempleado($idempleado1,$planilladesde,$planillahasta,$devengos_table_maestra) {
            $query = "SELECT * FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  idempleado_devengo='$idempleado1' and codigo_planilla_devengo>='$planilladesde' and codigo_planilla_devengo<='$planillahasta'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        $fechaActual = date("d-m-Y"); 

        ?>     
        <?php
        /* planilla desde */
          $data_planilla_admin_data = planilla_admin_data($planilladesde,$cambio_table);
          $numero_planilla="";
          $fecha_planilla_desde="";
          $fecha_planilla_hasta="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla.=$row_data_planilla_admin_data["numero_planilladevengo".$cambio_table.""];
              $fecha_planilla_desde.=$row_data_planilla_admin_data["fecha_desde_planilladevengo".$cambio_table.""];
              $fecha_planilla_hasta.=$row_data_planilla_admin_data["fecha_hasta_planilladevengo".$cambio_table.""];
          }
        /* planilla hasta */
          $data_planilla_admin_data = planilla_admin_data($planillahasta,$cambio_table);
          $numero_planilla2="";
          $fecha_planilla_desde2="";
          $fecha_planilla_hasta2="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla2.=$row_data_planilla_admin_data["numero_planilladevengo".$cambio_table.""];
              $fecha_planilla_desde2.=$row_data_planilla_admin_data["fecha_desde_planilladevengo".$cambio_table.""];
              $fecha_planilla_hasta2.=$row_data_planilla_admin_data["fecha_hasta_planilladevengo".$cambio_table.""];
          }
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
                $nombre_ubicacion=$row["nombre_ubicacion"];
              }
        }
        ?>
        <h4><?php echo $nombre_ubicacion?> </h4>
      </div>

      <div class="col-md-12" align="center">

      
      </div>

        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th colspan="5">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</th>
                        </tr>
                        <tr>
                            <th colspan="5">FECHA    <?php echo $fechaActual ?></th>
                        </tr>
                        <tr>
                            <th colspan="5">ANEXOS DE PLANILLA ADMINISTRATIVA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta. " A PLANILLA ADMINISTRATIVA DEL ".$fecha_planilla_desde2." AL ".$fecha_planilla_hasta2?></th>
                        </tr>
                        <tr>
                            <th colspan="5">PLANILLA No.   <?php echo $planilladesde."    ".$planillahasta?>   </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */

                            $data_admin=planilla_admin_noempleado($planilladesde,$planillahasta,$cambio_table);
                                                        
                            if($idempleadoinput=="todos"){
                                $data_admin=planilla_admin_noempleado($planilladesde,$planillahasta,$cambio_table);
                            }
                            else if($idempleadoinput!="todos"){
                                $data_admin=planilla_admin_noemple_one($planilladesde,$planillahasta,$idempleadoinput,$cambio_table);
                            }

                            $html="";
                            foreach ($data_admin as $val_admin) { 
                                $idempleado=$val_admin["id_empleado_planilladevengo".$cambio_table.""];

                                $data_empleado= empleado($idempleado);
                                $html="";
                                /* empleado */
                                foreach ($data_empleado as $row_empleado) { 
                                    $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];     
                                    $nombre_empleado = preg_replace('/\s+/', ' ', $nombre_empleado);
                                    $idempleado_ofi=$row_empleado["id"];

                                    $html.="<tr>";
                                    $html.="<th style='background: #D7F7F6;' colspan='5'> Empleado: ".$row_empleado["codigo_empleado"]." ".$nombre_empleado."</th>";
                                    $html.="</tr>";

                                    $html.="<tr>";
                                        $html.="<td>DEVENGO/DESCUENTO"."</td>";
                                        $html.="<td>PLANILLA"."</td>";
                                        $html.="<td>DEVENGO"."</td>";
                                        $html.="<td>DESCUENTO"."</td>";
                                        $html.="<td>REFERENCIA"."</td>";
                                    $html.="</tr>";

                                    $total_global_suma=0;
                                    $total_global_resta=0;
                                    $data_devengo=devengos_porempleado($idempleado_ofi,$planilladesde,$planillahasta,$devengos_table_maestra);
                                    foreach ($data_devengo as $row_devemgo) { 
                                        $tipo_valor=str_replace("+", "", trim($row_devemgo["tipo_valor"]));/* suma */
                                        $tipo_valor_resta=str_replace("-", "", trim($row_devemgo["tipo_valor"]));/* resta */
                                        
                                        $valor_resta=0;
                                        $valor_suma=0;
                                        if(trim($tipo_valor)=="Suma"){
                                            $valor_suma=$row_devemgo["valor_devengo_planilla"];
                                            $total_global_suma+=$valor_suma;
                                        }
                                        else if(trim($tipo_valor_resta)=="Resta"){
                                            $valor_resta=$row_devemgo["valor_devengo_planilla"];
                                            $total_global_resta+=$valor_resta;

                                        }
                                        
                                        $html.="<tr>";
                                        $html.="<td>".$row_devemgo["codigo_devengo_descuento_planilla"]." ".$row_devemgo["descripcion_devengo_descuento_planilla"]."</td>";
                                        $html.="<td>".$fecha_planilla_hasta2."</td>";
                                        $html.="<td>".bcdiv($valor_suma,'1', 2)."</td>";
                                        $html.="<td>".bcdiv($valor_resta,'1', 2)."</td>";
                                        $html.="<td>"."</td>";
                                        $html.="</tr>";
                                    }
                                        $html.="<tr>";
                                        $html.="<td>TOTAL: ".$nombre_empleado."</td>";
                                        $html.="<td>"."</td>";
                                        $html.="<td>".bcdiv($total_global_suma,'1', 2)."</td>";
                                        $html.="<td>".bcdiv($total_global_resta,'1', 2)."</td>";
                                        $html.="<td>"."</td>";
                                        $html.="</tr>";

                                    
                                    
                                }

                                echo $html;

                              
                            }/*  maestros */
                        
                        ?>


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



        /* reporte txt */
    $("#exportTXT").click(function () {
            // Obtener la tabla HTML por su ID
            var table = document.getElementById('tabladatos'); // Reemplaza 'miTabla' con el ID de tu tabla
            // Función para obtener el texto de una celda
            function obtenerTextoCelda(celda) {
                return celda.textContent || celda.innerText;
            }
            // Función para obtener el contenido de la tabla como texto
            function obtenerContenidoTablaComoTexto() {
                var textoTabla = '';
                
                /* OBTENEMOS EL TITULO INICIAL EL CONTEO EMPIEZA DE 0 */
                for (var i = 0; i < 4; i++) {
                    var fila = table.rows[i];
                    var col0 = (fila.cells[0] !== undefined) ? fila.cells[0].textContent : ' ';
                    textoTabla += strPad(" ", 15, ' ', 'center');
                    textoTabla += strPad(col0, 100, ' ', 'center')+"\n";

                }
                // Recorrer las filas de la tabla
                for (var i = 4; i < table.rows.length; i++) {
                    var fila = table.rows[i];
                    /* console.log(fila.cells[1]); */
                    // Recorrer las celdas de la fila
                 
                    var col0 = (fila.cells[0] !== undefined) ? fila.cells[0].textContent : ' ';
                    var col1 = (fila.cells[1] !== undefined) ? fila.cells[1].textContent : ' ';
                    var col2 = (fila.cells[2] !== undefined) ? fila.cells[2].textContent : ' ';
                    var col3 = (fila.cells[3] !== undefined) ? fila.cells[3].textContent : ' ';
                    var col4 = (fila.cells[4] !== undefined) ? fila.cells[4].textContent : ' ';
                    var col5 = (fila.cells[5] !== undefined) ? fila.cells[5].textContent : ' ';
                    var col6 = (fila.cells[6] !== undefined) ? fila.cells[6].textContent : ' ';
                    
                    textoTabla += strPad(col0, 60, ' ', 'right');
                    textoTabla += strPad(col1, 20, ' ', 'right');
                    textoTabla += strPad(col2, 15, ' ', 'right');
                    textoTabla += strPad(col3, 15, ' ', 'right');
                    textoTabla += strPad(col4, 15, ' ', 'right');
                    textoTabla += strPad(col5, 15, ' ', 'right');
                    textoTabla += strPad(col6, 60, ' ', 'right');
                    

                    for (var j = 0; j < fila.cells.length; j++) {
                        var celda = fila.cells[j];
                        var textoCelda = obtenerTextoCelda(celda);
                        var quitar_espacio=textoCelda.trim();
                    }
                    textoTabla += '\n';
                }
                return textoTabla;
            }
            // Llamar a la función para obtener el contenido de la tabla como texto
            var contenidoTexto = obtenerContenidoTablaComoTexto();
            // Imprimir el contenido de la tabla como texto en la consola (o puedes hacer lo que desees con él)
            guardarComoArchivoTexto(contenidoTexto, 'ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS EMPLEADOS.txt');

                
    });



    /* reporte pdf */
    $("#exportPDF").click(function () {
        /* pdf */

        const doc = new jsPDF();
        const element = document.getElementById('tabladatos'); // Reemplaza 'miTabla' con el ID de tu tabla

        const columnStyles = {
       /*  1: { cellWidth: 'auto', halign: 'center' },  */
       fontSize: 5,
        // Agrega más columnas según sea necesario
        };
        const headerStyles = {
            fillColor: [211, 211, 211], // Color de fondo del encabezado (gris claro en este ejemplo)
            textColor: [0, 0, 0], // Color de texto del encabezado (negro en este ejemplo)
            halign: 'center', // Centrar horizontalmente las celdas del encabezado
            valign: 'middle', // Centrar verticalmente las celdas del encabezado
        };

        const styles = {
            fontSize: 8,
            font: 'times', // Tipo de fuente, por ejemplo, 'helvetica', 'times', etc.
            fontStyle: 'normal', // Estilo de fuente ('normal', 'bold', 'italic', 'bolditalic')
        };

        doc.autoTable({ html: element, styles: styles, columnStyles: columnStyles,headerStyles: headerStyles });

        // Guardar o descargar el PDF
        doc.save('ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS EMPLEADOS.pdf');
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
        $(".lineasuperior").empty();

        var tablaHtml = document.getElementById("tabladatos");
        var ws = XLSX.utils.table_to_sheet(tablaHtml);
        var wb = XLSX.utils.book_new();
        ws['!cols'][0] = { wch: 60, };
        ws['!cols'][1] = { wch: 20, };
        ws['!cols'][3] = { wch: 10, };
        ws['!cols'][5] = { wch: 10, };
        ws['!cols'][6] = { wch: 80, };
        ws['!cols'][7] = { wch: 10, };
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
        XLSX.writeFile(wb, "ANEXO POR PLANILLA DEVENGOS Y DESCUENTOS EMPLEADOS.xlsx");
       

    });

});


function guardarComoArchivoTexto(texto, nombreArchivo) {
  var blob = new Blob([texto], { type: 'text/plain' });
  var url = window.URL.createObjectURL(blob);

  var a = document.createElement('a');
  a.href = url;
  a.download = nombreArchivo;

  // Simular un clic en el enlace para iniciar la descarga
  a.click();

  // Liberar el recurso del objeto URL
  window.URL.revokeObjectURL(url);
}


function strPad(inputString, padLength, padString, padType) {
  inputString = String(inputString); // Convertir inputString a una cadena

  if (typeof padLength === 'undefined') padLength = 0;
  if (typeof padString === 'undefined') padString = ' ';
  if (typeof padType === 'undefined') padType = 'right';

  if (padType !== 'left' && padType !== 'right' && padType !== 'both' && padType !== 'center') {
    console.error('El valor de padType debe ser "left", "right", "both" o "center"');
    return inputString;
  }

  if (padType === 'left') {
    while (inputString.length < padLength) {
      inputString = padString + inputString;
    }
  }

  if (padType === 'right') {
    while (inputString.length < padLength) {
      inputString += padString;
    }
  }

  if (padType === 'both') {
    var padLeft = Math.floor((padLength - inputString.length) / 2);
    var padRight = padLength - inputString.length - padLeft;

    while (padLeft > 0) {
      inputString = padString + inputString;
      padLeft--;
    }

    while (padRight > 0) {
      inputString += padString;
      padRight--;
    }
  }

  if (padType === 'center') {
    var padLeft = Math.floor((padLength - inputString.length) / 2);
    var padRight = padLength - inputString.length - padLeft;

    while (padLeft > 0) {
      inputString = padString + inputString;
      padLeft--;
    }

    while (padRight > 0) {
      inputString += padString;
      padRight--;
    }
  }

  return inputString;
}


</script>