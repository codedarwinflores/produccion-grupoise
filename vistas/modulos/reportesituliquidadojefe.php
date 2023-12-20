

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
 $esconder="";
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
                 <!-- <button id="exportTXT" class="dropdown-item btn btn-info " <?php echo $esconder?> >Exportar a TXT</button> -->
                 <button id="exportPDF" class="dropdown-item btn btn-warning btnreporte" style="display:none">Exportar a PDF</button>
            </div>
        </div>
       </div>
      <!--  -->
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
        /* nuevos */
        /* todas las ubicaciones */
        function situacion($fecha_desde, $fecha_hasta) {
            $query = "SELECT * FROM situacion where STR_TO_DATE(fecha_situacion, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and STR_TO_DATE(fecha_situacion, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y') and situacion.cubrir_situacion is not null and cubrir_situacion!=''
            ORDER BY STR_TO_DATE(fecha_situacion, '%d-%m-%Y') DESC";
            echo $query;
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* todas las ubicaciones */
        function ubicacion_id($codigo_ubi) {
            $query = "SELECT * FROM tbl_clientes_ubicaciones where codigo_ubicacion='$codigo_ubi'";
         
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function ubicacion_detalles($idubicacion) {
            $query = "SELECT * FROM tbl_ubicaciones_detalle where idubicacion=$idubicacion";

            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
        function historial_detalle($fecha_desde,$fecha_hasta) {
            $query = "SELECT * FROM tbl_ubicaciones_detalle_historial where  fecha_modificacion >= '$fecha_desde' AND fecha_modificacion <= '$fecha_hasta' order by fecha_modificacion desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function clientes($codigo_cliente) {
            $query = "SELECT * FROM clientes where  codigo = '$codigo_cliente'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function empleados($codigo_empleado) {
            $query = "SELECT * FROM tbl_empleados where  codigo_empleado = '$codigo_empleado'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleados_id($id_empleado) {
            $query = "SELECT * FROM tbl_empleados where  codigo_empleado = '$id_empleado'";
     
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function motivo($id_motivo) {
            $query = "SELECT * FROM tipohora where  codigo_tipohora = $id_motivo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_ubica($fecha_desde,$fecha_hasta,$idcoordinador) {
            $query = "SELECT DISTINCT situacion.id, STR_TO_DATE(fecha_situacion, '%d-%m-%Y'), situacion.*,tbl_clientes_ubicaciones.*
                      FROM situacion,tbl_clientes_ubicaciones
                        where situacion.ubicacion_situacion like  CONCAT('%',tbl_clientes_ubicaciones.codigo_ubicacion, '%') and STR_TO_DATE(fecha_situacion, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and STR_TO_DATE(fecha_situacion, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y') and
                        tbl_clientes_ubicaciones.id_coordinador_zona='$idcoordinador' and  situacion.liquidado_situacion='Si'
                        order by STR_TO_DATE(fecha_situacion, '%d-%m-%Y')";
          
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function fun_coordinador($fecha_desde,$fecha_hasta,$idcoordinador) {
            $query = "SELECT STR_TO_DATE(fecha_situacion, '%d-%m-%Y'), situacion.*,tbl_clientes_ubicaciones.*,primer_nombre,segundo_nombre,tercer_nombre,primer_apellido,segundo_apellido,apellido_casada,codigo_empleado
                      FROM situacion,tbl_clientes_ubicaciones,tbl_empleados
                        where tbl_empleados.id=tbl_clientes_ubicaciones.id_coordinador_zona and 
                             situacion.ubicacion_situacion like  CONCAT('%',tbl_clientes_ubicaciones.codigo_ubicacion, '%') and 
                             STR_TO_DATE(fecha_situacion, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and 
                             STR_TO_DATE(fecha_situacion, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y') and 
                            
                             tbl_empleados.id_jefe_operaciones='$idcoordinador' and
                             situacion.liquidado_situacion='Si'
                             group by id_coordinador_zona";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };



        function empleado($id) {
            $query = "SELECT * FROM tbl_empleados where codigo_empleado='$id'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function jefeoperativo($fecha_desde,$fecha_hasta) {
            $query = "SELECT tbl_empleados.id_jefe_operaciones,primer_nombre,segundo_nombre,tercer_nombre,primer_apellido,segundo_apellido,apellido_casada,codigo_empleado 
                      FROM `tbl_empleados`,tbl_clientes_ubicaciones,situacion
                      WHERE tbl_empleados.id=tbl_clientes_ubicaciones.id_coordinador_zona and 
                      id_jefe_operaciones is not null and id_jefe_operaciones!='' and 
                      situacion.ubicacion_situacion like  CONCAT('%',tbl_clientes_ubicaciones.codigo_ubicacion, '%') and 
                      STR_TO_DATE(fecha_situacion, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and 
                      STR_TO_DATE(fecha_situacion, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y') and 
                      situacion.liquidado_situacion='Si'
                        group by id_jefe_operaciones
                        order by id_jefe_operaciones";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_tipohora($id_motivo) {
            $query = "SELECT * FROM tipohora where  id = $id_motivo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function ubicado_emple($codigo) {
            $query = "SELECT * FROM `transacciones_agente` WHERE idagente_transacciones_agente='$codigo'  
            group by idagente_transacciones_agente
            order by id desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        

        $fechaActual = date("d-m-Y"); 

        $fecha_desde = $_POST["fecha_desde"];
        $fecha_hasta = $_POST["fecha_hasta"];

        
        /* $fecha_desde = strtotime($fecha_desde);
        $fecha_desde = date("Y-m-d", $fecha_desde);
        $fecha_hasta = strtotime($fecha_hasta);
        $fecha_hasta = date("Y-m-d", $fecha_hasta); */
     

        ?>     
      
       <div class="col-md-12" align="center">
        
      </div>

      <div class="col-md-12" align="center">

      
      </div>

        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th class="colspan"></th>
                        </tr>
                        <tr>
                            <th class="colspan"></th>
                        </tr>
                        <tr>
                            <th class="colspan"></th>
                        </tr>
                        <tr>
                            <th class="colspan"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */
                            $html="";
                            $html.="<tr>";
                            $html.="<td>."."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="</tr>";

                            $data_jefe=jefeoperativo($fecha_desde,$fecha_hasta);
                            foreach ($data_jefe as $val_jefe) {

                                $idcoordinador=$val_jefe["id_jefe_operaciones"];
                                $codigo_empleado=$val_jefe["codigo_empleado"];
                                $nombre_jefe=trim(trim($val_jefe["primer_nombre"])." ".trim($val_jefe["segundo_nombre"]).' '.trim($val_jefe["tercer_nombre"]).' '.trim($val_jefe["primer_apellido"]).' '.trim($val_jefe["segundo_apellido"]).' '.trim($val_jefe["apellido_casada"]));
                                $nombre_jefe = $codigo_empleado." ".preg_replace('/\s+/', ' ', $nombre_jefe);
                        
                              
                                $nombre_cargo="";
                                $idcoordi="";

                                    $html.="<tr>";
                                    $html.="<td class='colspan'>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V."."</td>";
                                    $html.="</tr>";
                                    $html.="<tr>";
                                    $html.="<td class='colspan'>*** REPORTE DE HORAS EXTRAS ***"."</td>";
                                    $html.="</tr>";
                                    $html.="<tr>";
                                    $html.="<td class='colspan'>".$fecha_desde." ".$fecha_hasta."</td>";
                                    $html.="</tr>";

                                    $html.="<tr>";
                                    $html.="<td class='colspan'>JEFE OPERACIONES ".$nombre_jefe."</td>";
                                    $html.="</tr>";


                                $data_maestr=fun_coordinador($fecha_desde,$fecha_hasta,$idcoordinador);
                                foreach ($data_maestr as $val_cor) {
                                        $idcoordi=$val_cor["id_coordinador_zona"];
                                         $codigo_empleado=$val_cor["codigo_empleado"];

                                        $nombre_cargo=trim(trim($val_cor["primer_nombre"])." ".trim($val_cor["segundo_nombre"]).' '.trim($val_cor["tercer_nombre"]).' '.trim($val_cor["primer_apellido"]).' '.trim($val_cor["segundo_apellido"]).' '.trim($val_cor["apellido_casada"]));
                                        $nombre_cargo = $codigo_empleado." ".preg_replace('/\s+/', ' ', $nombre_cargo);

                                        $html.="<tr>";
                                        $html.="<td class='colspan'>SUPERVISOR ".$nombre_cargo."</td>";
                                        $html.="</tr>";

                                        $html.="<tr>";
                                        $html.="<td>FECHA."."</td>";
                                        $html.="<td>AGENTE"."</td>";
                                        $html.="<td>H.EXTRAS"."</td>";
                                        $html.="<td>VALOR"."</td>";
                                        $html.="<td>MOTIVO"."</td>";
                                        $html.="<td>LUGAR DONDE SE PRESTO SERVICIO"."</td>";
                                        $html.="<td>UBICADO EN"."</td>";
                                        $html.="<td>AGENTE QUE CUBRIO"."</td>";
                                        $html.="</tr>";
                                        
                                        $data_ubi=fun_ubica($fecha_desde,$fecha_hasta,$idcoordi);
                                    foreach ($data_ubi as $val_ubi) {
                                        $horas=0;
                                        $tipo_hora="";
                                        /* *********************** */
                                        if(floatval($val_ubi["hora_extra_situacion"])>0){
                                            $horas=floatval($val_ubi["hora_extra_situacion"]);
                                            $tipo_hora="Hora Extra";
                                        }
                                        else if(floatval($val_ubi["hora_normales_situacion"])>0){
                                            $horas=floatval($val_ubi["hora_normales_situacion"]);
                                            $tipo_hora="Hora Normal";
                                        }
                                        else if(floatval($val_ubi["tiempo_compensatorio_situacion"])>0){
                                            $horas=floatval($val_ubi["tiempo_compensatorio_situacion"]);
                                            $tipo_hora="Tiempo Compensatorio";
                                        }
                                        else if(floatval($val_ubi["dias_ausencia_situacion"])>0){
                                            $horas=floatval($val_ubi["dias_ausencia_situacion"]);
                                            $tipo_hora="Dias Ausencia";
                                        }
                                        else if(floatval($val_ubi["horas_ausencia_situacion"])>0){
                                            $horas=floatval($val_ubi["horas_ausencia_situacion"]);
                                            $tipo_hora="Horas Ausencia";
                                        }
                                        else if(floatval($val_ubi["consulta_isss_situacion"])>0){
                                            $horas=floatval($val_ubi["consulta_isss_situacion"]);
                                            $tipo_hora="Consulta ISSS";
                                        }
                                        else if(floatval($val_ubi["incapacidad_situacion"])>0){
                                            $horas=floatval($val_ubi["incapacidad_situacion"]);
                                            $tipo_hora="Incapacidad";
                                        }
                                        else if(floatval($val_ubi["ansp_situacion"])>0){
                                            $horas=floatval($val_ubi["ansp_situacion"]);
                                            $tipo_hora="ANSP";
                                        }
                                        else if(floatval($val_ubi["vacaciones_situacion"])>0){
                                            $horas=floatval($val_ubi["vacaciones_situacion"]);
                                            $tipo_hora="Vacacion";
                                        }
                                        else if(floatval($val_ubi["permiso_situacion"])>0){
                                            $horas=floatval($val_ubi["permiso_situacion"]);
                                            $tipo_hora="Permiso";
                                        }
                                        else if(floatval($val_ubi["recuperar_tiempo_situacion"])>0){
                                            $horas=floatval($val_ubi["recuperar_tiempo_situacion"]);
                                            $tipo_hora="Recuperar Tiempo";
                                        }
                                        /* ************************* */
                                        $cubrir_situacion=$val_ubi["cubrir_situacion"];
                                        $partes_cubrir_situacion = explode("-", empty($cubrir_situacion) ? " - " : $cubrir_situacion);


                                        $idempleado=$partes_cubrir_situacion[0];
                                        $dataempleado=empleado($idempleado);
                                        $nombre_cubrir="";
                                        foreach ($dataempleado as $val_empleado) {
                                            $nombre_cubrir=trim(trim($val_empleado["primer_nombre"])." ".trim($val_empleado["segundo_nombre"]).' '.trim($val_empleado["tercer_nombre"]).' '.trim($val_empleado["primer_apellido"]).' '.trim($val_empleado["segundo_apellido"]).' '.trim($val_empleado["apellido_casada"]));
                                             $nombre_cubrir = preg_replace('/\s+/', ' ', $nombre_cubrir);
                                        }

                                        $idempleado_situacion=$val_ubi["idempleado_situacion"];
                                        $data_empleado=empleado($idempleado_situacion);
                                        $nombre_cargo="";
                                        $apellidos="";
                                        $valor_hora_extra_empleado=0;
                                        foreach ($data_empleado as $val_empleado) {
                                            $nombre_cargo=trim(trim($val_empleado["primer_nombre"])." ".trim($val_empleado["segundo_nombre"]).' '.trim($val_empleado["tercer_nombre"]));
                                            $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                            $apellidos=trim(trim($val_empleado["primer_apellido"]).' '.trim($val_empleado["segundo_apellido"]).' '.trim($val_empleado["apellido_casada"]));
                                            $apellidos = preg_replace('/\s+/', ' ', $apellidos);
                                            $valor_hora_extra_empleado=bcdiv(floatval($val_empleado["hora_extra_diurna"]),'1', 2);
                                        }

                                        $valor_motivo="";
                                        if (preg_match('/^[0-9]+$/', $val_ubi["motivo_horas_extras"])) {
                                            /* solo numero */
                                            $data_tipohora=fun_tipohora($val_ubi["motivo_horas_extras"]);
                                            foreach ($data_tipohora as $val_tipohora) {
                                                $valor_motivo=$val_tipohora["motivo_tipohora"];
                                            }
                                            /* *******  */
                                        }else{
                                            $capture_motivo = explode("-", empty($val_ubi["motivo_tipohora"]) ? " - " : $val_ubi["motivo_tipohora"]);
                                            $valor_motivo=$capture_motivo[0];
                                        } 
                                      
                                        $nombre_completo=$apellidos." ".$nombre_cargo;


                                        $data_ubicacion=ubicado_emple($idempleado_situacion);
                                        $info_ubicacion="";
                                        
                                        foreach ($data_ubicacion as $val_ubi_agente) {
                                            # code...
                                            $info_ubicacion=$val_ubi_agente["nueva_ubicacion_transacciones_agente"];

                                        }
                                        $html.="<tr>";
                                        $html.="<td>".$val_ubi["fecha_situacion"]."</td>";
                                        $html.="<td>".$nombre_completo."</td>";
                                        $html.="<td>".$horas."</td>";
                                        $html.="<td>".$valor_hora_extra_empleado."</td>";
                                        $html.="<td>".$valor_motivo."</td>";
                                        $html.="<td>".$val_ubi["nombre_ubicacion"]."</td>";
                                        $html.="<td>".$info_ubicacion."</td>";
                                        $html.="<td>".$nombre_cubrir."</td>";
                                        $html.="</tr>";
                                    }


                                        /* ////////////////////// */
                                    }
                                    
                            }
                            


                            echo $html;
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
                    var col7 = (fila.cells[7] !== undefined) ? fila.cells[7].textContent : ' ';
                    var col8 = (fila.cells[8] !== undefined) ? fila.cells[8].textContent : ' ';
                    var col9 = (fila.cells[9] !== undefined) ? fila.cells[9].textContent : ' ';
                    var col10 = (fila.cells[10] !== undefined) ? fila.cells[10].textContent : ' ';
                    var col11 = (fila.cells[11] !== undefined) ? fila.cells[11].textContent : ' ';
                    var col12 = (fila.cells[12] !== undefined) ? fila.cells[12].textContent : ' ';
                    
                    textoTabla += strPad(col0, 20, ' ', 'right');
                    textoTabla += strPad(col1, 20, ' ', 'right');
                    textoTabla += strPad(col2, 20, ' ', 'right');
                    textoTabla += strPad(col3, 20, ' ', 'right');
                    textoTabla += strPad(col4, 60, ' ', 'right');
                    textoTabla += strPad(col5, 60, ' ', 'right');
                    textoTabla += strPad(col6, 60, ' ', 'right');
                    textoTabla += strPad(col7, 25, ' ', 'right');
                    textoTabla += strPad(col8, 25, ' ', 'right');
                    textoTabla += strPad(col9, 60, ' ', 'right');
                    textoTabla += strPad(col10, 60, ' ', 'right');
                    textoTabla += strPad(col11, 60, ' ', 'right');
                    textoTabla += strPad(col12, 25, ' ', 'right');
                    

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
            guardarComoArchivoTexto(contenidoTexto, 'REPORTE PARTES DE SITUACION SERVICIO EVENTUAL.txt');

                
    });



    /* reporte pdf */
    $("#exportPDF").click(function () {
        /* pdf */

        const doc = new jsPDF({
            orientation: 'landscape', // Puedes cambiar a 'landscape' si lo deseas
            unit: 'mm',
            format: 'a4' // Elige el formato de la página (por ejemplo, 'a4', 'letter', etc.)
            });
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
        doc.save('REPORTE HORAS EXTRAS.pdf');
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
        XLSX.writeFile(wb, "REPORTE DE HORAS EXTRAS.xlsx");
       

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


$(document).ready(function() {
  $('#tabladatos tr:nth-child(10)').ready(function() {

    var $tabla = $('#tabladatos');
    // Inicializa una variable para el máximo length
    var maxLength = 0;
    // Itera a través de todas las filas de la tabla
    $tabla.find('tr').each(function() {
        var currentLength = $(this).find('td').length;
        if (currentLength > maxLength) {
            maxLength = currentLength;
        }
    });
   


    var numColumnas = $('#tabladatos tr:nth-child(10) td').length;
    console.log('Número de columnas en la cuarta fila: ' + numColumnas);
    $(".colspan").attr("colspan",maxLength);
  });
});
</script>