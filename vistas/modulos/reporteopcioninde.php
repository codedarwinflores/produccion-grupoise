

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

      <a href='empleados' class="btn btn-danger">
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
        function empleado($fecha) {
            $query = "SELECT *
            FROM tbl_empleados
            WHERE STR_TO_DATE(fecha_contratacion, '%Y-%m-%d') < STR_TO_DATE('$fecha', '%Y-%m-%d')";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function empleado_rango($fecha,$empleadodesde, $empleadohasta) {
            $query = "SELECT *
            FROM tbl_empleados
            WHERE id>=$empleadodesde and id<=$empleadohasta and  STR_TO_DATE(fecha_contratacion, '%Y-%m-%d') < STR_TO_DATE('$fecha', '%Y-%m-%d')";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function ubicacion($idempleado) {
            $query = "SELECT tbl_clientes_ubicaciones.* 
                      FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones
                      where idubicacion_agente=tbl_clientes_ubicaciones.id and
                      codigo_agente='$idempleado'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
       
        $fechaActual = date("d-m-Y"); 

        $empleado_rango_desde = $_POST["empleado_rango_desde"];
        $empleado_rango_hasta = $_POST["empleado_rango_hasta"];
        $fecha = $_POST["fecha"];

        ?>     
      
       <div class="col-md-12" align="center">
        
      </div>

      <div class="col-md-12" align="center">

      
      </div>

        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th colspan="9">CALCULO DE INDEMNIZACIONES</th>
                        </tr>
                        <tr>
                            <th colspan="9"></th>
                        </tr>
                        <tr>
                            <th colspan="9"><?php echo $fecha?></th>
                        </tr>
                        <tr>
                            <th colspan="9"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */
                            $html="";
                            
                            $html.="<tr>";
                            $html.="<td>Numero"."</td>";
                            $html.="<td>NOMBRES"."</td>";
                            $html.="<td>1er APELLIDO"."</td>";
                            $html.="<td>2do APELLIDO"."</td>";
                            $html.="<td>SUELDO"."</td>";
                            $html.="<td>INGRESO"."</td>";
                            $html.="<td>DIAS"."</td>";
                            $html.="<td>INDEMNIZACION"."</td>";
                            $html.="<td>50%"."</td>";
                            $html.="</tr>";
                        
                            $data_maestra=empleado($fecha);
                            if($empleado_rango_desde!="*"){
                                $data_maestra=empleado_rango($fecha,$empleado_rango_desde, $empleado_rango_hasta);
                            }
                            else{
                            $data_maestra=empleado($fecha);

                            }
                            $correlativo=0;
                            foreach ($data_maestra as $val_maestra) { 

                                
                                $codigo=$val_maestra["codigo_empleado"];
                                $sueldo=floatval($val_maestra["sueldo"])*2;

                                $nombre_cargo=trim(trim($val_maestra["primer_nombre"])." ".trim($val_maestra["segundo_nombre"]).' '.trim($val_maestra["tercer_nombre"]));
                                $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);

                                
                                $apellidos=trim(trim($val_maestra["primer_apellido"]).' '.trim($val_maestra["segundo_apellido"]).' '.trim($val_maestra["apellido_casada"]));
                                $apellidos = preg_replace('/\s+/', ' ', $apellidos);

                                $data_ubicacion=ubicacion($codigo);
                                $ubicacion="";
                                foreach ($data_ubicacion as $val_ubi) {
                                    $ubicacion=$val_ubi["nombre_ubicacion"];
                                }

                                
                                $timestamp = strtotime($val_maestra["fecha_contratacion"]);
                                $fecha_formateada = date("d-m-Y", $timestamp);
                                $fecha_con=$fecha_formateada;


                                /* calculo de dias entre fecha contratacion y fecha seleccionada */

                                
                                $fechainicio = strtotime($val_maestra["fecha_contratacion"]);
                                $fechainicio_for = date("Y-m-d", $fechainicio);

                                $fechafin = strtotime($fecha);
                                $fechafin_for = date("Y-m-d", $fechafin);

                                $timestamp1 = strtotime($fechainicio_for);
                                $timestamp2 = strtotime($fechafin_for);
                                
                                 // Calcula la diferencia en segundos
                                $diferenciaSegundos = $timestamp2 - $timestamp1;
                                // Convierte la diferencia en segundos a días (1 día = 86400 segundos)
                                $diferenciaDias = floor($diferenciaSegundos / (60 * 60 * 24));
                                $sumardiferenciaDias=$diferenciaDias+1;
                       
                                /* ************************** */

                                /* calculo de indemnizacion */

                                $indem=$sueldo/365*$sumardiferenciaDias;
                                $porcentaje50=$indem*0.50;
                                /*  */

                                $html.="<tr>";
                                $html.="<td>".$codigo."</td>";
                                $html.="<td>".$nombre_cargo."</td>";
                                $html.="<td>".trim($val_maestra["primer_apellido"])."</td>";
                                $html.="<td>".trim($val_maestra["segundo_apellido"])."</td>";
                                $html.="<td>".$sueldo."</td>";
                                $html.="<td>".$fecha_con."</td>";
                                $html.="<td>".$sumardiferenciaDias."</td>";
                                $html.="<td>".bcdiv($indem,'1', 2)."</td>";
                                $html.="<td>".bcdiv($porcentaje50,'1', 2)."</td>";                                
                                $html.="</tr>";

                            }/*  maestros */
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
                    textoTabla += strPad(col1, 60, ' ', 'right');
                    textoTabla += strPad(col2, 25, ' ', 'right');
                    textoTabla += strPad(col3, 25, ' ', 'right');
                    textoTabla += strPad(col4, 25, ' ', 'right');
                    textoTabla += strPad(col5, 25, ' ', 'right');
                    textoTabla += strPad(col6, 25, ' ', 'right');
                    textoTabla += strPad(col7, 25, ' ', 'right');
                    textoTabla += strPad(col8, 25, ' ', 'right');
                    textoTabla += strPad(col9, 25, ' ', 'right');
                    textoTabla += strPad(col10, 25, ' ', 'right');
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
            guardarComoArchivoTexto(contenidoTexto, 'REPORTE EMPLEADOS VACACION.txt');

                
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
        doc.save('REPORTE EMPLEADOS VACACION.pdf');
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
        
        ws['!cols'][0] = { wch: 15, };
        ws['!cols'][1] = { wch: 50, };
        ws['!cols'][2] = { wch: 50, };
        ws['!cols'][4] = { wch: 60, };
        ws['!cols'][3] = { wch: 25, };
    
        ws['!cols'][7] = { wch: 10, };
        ws['!cols'][11] = { wch: 40, };
        ws['!cols'][12] = { wch: 20, };


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
        XLSX.writeFile(wb, "REPORTE EMPLEADOS VACACION.xlsx");
       

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