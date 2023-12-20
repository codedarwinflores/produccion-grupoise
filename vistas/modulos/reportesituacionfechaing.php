

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
            $query = "SELECT * FROM situacion where STR_TO_DATE(fecha_hora_ingreso, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and STR_TO_DATE(fecha_hora_ingreso, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y') 
            ORDER BY STR_TO_DATE(fecha_hora_ingreso, '%d-%m-%Y') DESC";
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
        

        $fechaActual = date("d-m-Y"); 

        $fecha_desde = $_POST["fecha_desde"];
        $fecha_hasta = $_POST["fecha_hasta"];
        $usuario = $_POST["usuario"];

        
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
                            <th colspan="15">PARTES DE SITUACION</th>
                        </tr>
                        <tr>
                            <th colspan="15"></th>
                        </tr>
                        <tr>
                            <th colspan="15"><?php echo $fecha_desde." ".$fecha_hasta?></th>
                        </tr>
                        <tr>
                            <th colspan="15"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */
                            $html="";
                            $html.="<tr>";
                            $html.="<td>No."."</td>";
                            $html.="<td>F.INGRESO"."</td>";
                            $html.="<td>MOVIMIENTO"."</td>";
                            $html.="<td>AGENTE"."</td>";
                            $html.="<td>D.AUS"."</td>";
                            $html.="<td>H.AUS"."</td>";
                            $html.="<td>C.ISSS"."</td>";
                            $html.="<td>INCAP"."</td>";
                            $html.="<td>ANSP"."</td>";
                            $html.="<td>VACAC"."</td>";
                            $html.="<td>PERM"."</td>";
                            $html.="<td>H.EXT"."</td>";
                            $html.="<td>H.N"."</td>";
                            $html.="<td>T.COM"."</td>";
                            $html.="<td>R.TPO"."</td>";
                            $html.="</tr>";

                            
                            $html.="<tr>";
                            $html.="<td colspan='15'>USUARIO "."</td>";
                            $html.="</tr>";

                            $dias_ause_global=0;
                            $horas_ause_global=0;
                            $cisss_global=0;
                            $incap_global=0;
                            $ansp_global=0;
                            $vaca_global=0;
                            $perm_global=0;
                            $horaext_global=0;
                            $horanormal_global=0;
                            $tcom_global=0;
                            $rtpo_global=0;
                        
                            $data_maestra=situacion($fecha_desde,$fecha_hasta);
                            $correlativo=0;
                            $array_datos=[];
                            foreach ($data_maestra as $val_maestra) { 
                                $correlativo++;
                                $fecha_situacion=$val_maestra["fecha_situacion"];
                                $fecha_ingreso=$val_maestra["fecha_hora_ingreso"];
                                $fecha_ingreso = strtotime($fecha_ingreso);
                                $fecha_ingreso = date('d-m-Y', $fecha_ingreso);


                                $codigo_empleado=$val_maestra["idempleado_situacion"];
                                $codigo_ubi=$val_maestra["ubicacion_situacion"];
                                $cubrir_situacion=$val_maestra["cubrir_situacion"];
                                $id_motivo=$val_maestra["motivo_horas_extras"];

                                $partes_cubrir_situacion = explode("-", empty($cubrir_situacion) ? " - " : $cubrir_situacion);
                                $partes_codigo_ubi = explode("-", empty($codigo_ubi) ? " - " : $codigo_ubi);
                                $partes_id_motivo = explode("-", empty($id_motivo) ? " - " : $id_motivo);

                                $nombre_cargo="";
                                $apellidos ="";
                                $data_empleado=empleados($codigo_empleado);
                                foreach ($data_empleado as $val_empleado) {
                                    # code...
                                    $nombre_cargo=trim(trim($val_empleado["primer_nombre"])." ".trim($val_empleado["segundo_nombre"]).' '.trim($val_empleado["tercer_nombre"]));
                                    $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                    $apellidos=trim(trim($val_empleado["primer_apellido"]).' '.trim($val_empleado["segundo_apellido"]).' '.trim($val_empleado["apellido_casada"]));
                                    $apellidos = preg_replace('/\s+/', ' ', $apellidos);
                                }


                                
                                $data_empleado_cubrir=empleados_id($partes_cubrir_situacion[0]);
                                $nombre_empleado_cubrir="";
                                foreach ($data_empleado_cubrir as $val_empleado_cubrir) {
                                    $nombre_empleado_cubrir=trim(trim($val_empleado_cubrir["primer_nombre"])." ".trim($val_empleado_cubrir["segundo_nombre"]).' '.trim($val_empleado_cubrir["tercer_nombre"]).trim($val_empleado_cubrir["primer_apellido"]).' '.trim($val_empleado_cubrir["segundo_apellido"]).' '.trim($val_empleado_cubrir["apellido_casada"]));
                                    $nombre_empleado_cubrir = preg_replace('/\s+/', ' ', $nombre_empleado_cubrir);
                                }

                                $codigo_motivo=empty($partes_id_motivo[0]) ? " - " : $partes_id_motivo[0];
                                $data_motivo=motivo($codigo_motivo);
                                $motivo_nombre="";
                                foreach ($data_motivo as $val_motivo) {
                                    # code...
                                    $motivo_nombre=$val_motivo["motivo_tipohora"];
                                }

                                $data_ubicacion=ubicacion_id($partes_codigo_ubi[0]);
                                $precio_factura=0;
                                $nombre_ubicacion="";
                                foreach ($data_ubicacion as $val_ubi) {
                                    # code...
                                    $idubicacion=$val_ubi["id"];
                                    $nombre_ubicacion=$val_ubi["nombre_ubicacion"];

                                    $data_detalle=ubicacion_detalles($idubicacion);
                                    foreach ($data_detalle as $val_detalle) {
                                        # code...
                                        $precio_factura=floatval($val_detalle["precio"]);
                                    }

                                }

                                    $new_corre="";
                                    if($correlativo<100){
                                        $new_corre="00".$correlativo;
                                    }
                                    else{
                                        $new_corre=$correlativo;
                                    }

                                            
                                    $dias_ause_global+=floatval($val_maestra["dias_ausencia_situacion"]);
                                    $horas_ause_global+=floatval($val_maestra["horas_ausencia_situacion"]);
                                    $cisss_global+=floatval($val_maestra["consulta_isss_situacion"]);
                                    $incap_global+=floatval($val_maestra["incapacidad_situacion"]);
                                    $ansp_global+=floatval($val_maestra["ansp_situacion"]);
                                    $vaca_global+=floatval($val_maestra["vacaciones_situacion"]);
                                    $perm_global+=floatval($val_maestra["permiso_situacion"]);
                                    $horaext_global+=floatval($val_maestra["hora_extra_situacion"]);
                                    $horanormal_global+=floatval($val_maestra["hora_normales_situacion"]);
                                    $tcom_global+=floatval($val_maestra["tiempo_compensatorio_situacion"]);
                                    $rtpo_global+=floatval($val_maestra["recuperar_tiempo_situacion"]);

                                    $html.="<tr>";
                                    $html.="<td>".$new_corre."</td>";
                                    $html.="<td>".trim($fecha_ingreso)."</td>";
                                    $html.="<td>".trim($fecha_situacion)."</td>";
                                    $html.="<td>".trim($val_maestra["idempleado_situacion"])." ".trim($apellidos)." ".trim($nombre_cargo)."</td>";
                                    $html.="<td>".trim(($val_maestra["dias_ausencia_situacion"] == 0) ? "" : $val_maestra["dias_ausencia_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["horas_ausencia_situacion"] == 0) ? "" : $val_maestra["horas_ausencia_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["consulta_isss_situacion"] == 0) ? "" : $val_maestra["consulta_isss_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["incapacidad_situacion"] == 0) ? "" : $val_maestra["incapacidad_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["ansp_situacion"] == 0) ? "" : $val_maestra["ansp_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["vacaciones_situacion"] == 0) ? "" : $val_maestra["vacaciones_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["permiso_situacion"] == 0) ? "" : $val_maestra["permiso_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["hora_extra_situacion"] == 0) ? "" : $val_maestra["hora_extra_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["hora_normales_situacion"] == 0) ? "" : $val_maestra["hora_normales_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["tiempo_compensatorio_situacion"] == 0) ? "" : $val_maestra["tiempo_compensatorio_situacion"])."</td>";
                                    $html.="<td>".trim(($val_maestra["recuperar_tiempo_situacion"] == 0) ? "" : $val_maestra["recuperar_tiempo_situacion"])."</td>";
                                    $html.="</tr>";

                                    
                                    
                                    $observacion_situacion=$val_maestra["observacion_situacion"];
                                    $array_datos[]=array("correlativo"=>$new_corre,"motivo"=>$motivo_nombre,"ubicacion"=>$nombre_ubicacion,"novedad"=>$observacion_situacion);
                                    
                                }

                            $html.="<tr>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>".bcdiv($dias_ause_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($horas_ause_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($cisss_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($incap_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($ansp_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($vaca_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($perm_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($horaext_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($horanormal_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($tcom_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($rtpo_global,'1', 2)."</td>";
                            $html.="</tr>";


                             $html.="<tr>";
                            $html.="<td colspan='15'>========================================================================================================================================================================"."</td>";
                            $html.="</tr>";


                            $html.="<tr>";
                            $html.="<td colspan='15'>NOVEDADES DIARIAS DE LAS UNIDADES DE SERVICIO"."</td>";
                            $html.="</tr>";
                            $html.="<tr>";
                                $html.="<td colspan=''>"."</td>";
                                $html.="<td colspan=''>UBICACION <br> MOTIVO HORAS EXTRAS"."</td>";
                                $html.="<td colspan='14'>NOVEDAD"."</td>";
                            $html.="</tr>";
                            foreach ($array_datos as $value) {
                                    
                                $html.="<tr>";
                                $html.="<td colspan=''>".$value["correlativo"]."</td>";
                                $html.="<td colspan=''>".$value["ubicacion"]."</br>".$value["motivo"]."</td>";
                                $html.="<td colspan='13'>".$value["novedad"]."</td>";
                                $html.="</tr>";
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
            guardarComoArchivoTexto(contenidoTexto, 'PARTES DE SITUACION.txt');

                
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
        doc.save('PARTES DE SITUACION.pdf');
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

        
        /*  */
        


        /*  */
        var wb = XLSX.utils.book_new();
        
        ws['!cols'][0] = { wch: 10, };
        ws['!cols'][1] = { wch: 20, };
        ws['!cols'][2] = { wch: 20, };
        ws['!cols'][3] = { wch: 50, };
        ws['!cols'][4] = { wch: 15, };
        ws['!cols'][5] = { wch: 15, };
        ws['!cols'][6] = { wch: 15, };
        ws['!cols'][7] = { wch: 15, };
        ws['!cols'][8] = { wch: 15, };
        ws['!cols'][9] = { wch: 15, };
        ws['!cols'][10] = { wch: 15, };
        ws['!cols'][11] = { wch: 15, };
        ws['!cols'][12] = { wch: 15, };
        ws['!cols'][13] = { wch: 15, };
        ws['!cols'][14] = { wch: 15, };


        /*  */

        

        /*  */
            
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
        XLSX.writeFile(wb, "PARTES DE SITUACION.xlsx");
       

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