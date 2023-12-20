

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
        /* todas las ubicaciones */
        function ubicacion() {
            $query = "SELECT * FROM tbl_clientes_ubicaciones where bonos>0";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* todas las ubicaciones */
        function ubicacion_id($ubicacion) {
            $query = "SELECT * FROM tbl_clientes_ubicaciones where id=$ubicacion and bonos>0";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function bono_no_faltar($idubicacion) {
            $query = "SELECT * FROM tbl_devengo_ubicacion where idubicacion_devengo=$idubicacion and iddescuentodevengo=20";
           
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
        

        $fechaActual = date("d-m-Y"); 

        $ubicacion_maestra = $_POST["ubicacion"];
     

        ?>     
      
       <div class="col-md-12" align="center">
        
      </div>

      <div class="col-md-12" align="center">

      
      </div>

        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th colspan="9">REPORTE DE BONOS UNIDADES ACTIVAS</th>
                        </tr>
                        <tr>
                            <th colspan="9"></th>
                        </tr>
                        <tr>
                            <th colspan="9"><?php echo $fechaActual?></th>
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
                            $html.="<td>UBICACION"."</td>";
                            $html.="<td>NOMBRE"."</td>";
                            $html.="<td>UNIDADES ESPECIAL BONO QUINCENAL"."</td>";
                            $html.="<td>UNIDADES ESPECIAL BONO MENSUAL"."</td>";
                            $html.="<td>BONO POR NO FALTAR"."</td>";
                            $html.="<td>BONO HORARIO 12 HORAS"."</td>";
                            $html.="<td>TOTAL BONO"."</td>";
                            $html.="<td>HOMBRES AUTORIZADOS"."</td>";
                            $html.="<td>VALOR MENSUAL"."</td>";
                            $html.="<td>TARIFA CLIENTE"."</td>";
                            $html.="<td>TOTAL PAGO BONO"."</td>";
                            $html.="</tr>";
                        
                            $data_maestra=ubicacion();
                            if($ubicacion_maestra!="*"){
                                $data_maestra=ubicacion_id($ubicacion_maestra);

                            }
                            else{
                                $data_maestra=ubicacion();

                            }
                            $correlativo=0;
                            
                            $total_detalle_global=0;
                            $total_pago_bonos_global=0;

                            foreach ($data_maestra as $val_maestra) { 

                                $idubicacion=$val_maestra["id"];

                                $bono_mensual=floatval($val_maestra["bonos"])*2;
                                
                         
                                $data_bono_no_faltar=bono_no_faltar($idubicacion);
                                $valor_bono_no_faltar=0;
                                foreach ($data_bono_no_faltar as $val_bo_falta) {
                                    # code...
                                    if($val_bo_falta["periodo_devengo_ubicacion"]=='Siempre'){
                                        $valor_bono_no_faltar=floatval($val_bo_falta["valor_devengo_ubicacion"])*2;
                                    }
                                    else{
                                        $valor_bono_no_faltar=floatval($val_bo_falta["valor_devengo_ubicacion"]);
                                    }
                                }
                                $total_bono=$bono_mensual+$valor_bono_no_faltar+floatval($val_maestra["bono_horas"]);

                                $data_ubicacion_detalles=ubicacion_detalles($idubicacion);
                                $hombre_autorizados=0;
                                $precio=0;
                                $total_detalle=0;
                                foreach ($data_ubicacion_detalles as $val_detalle) {
                                    # code...
                                    $hombre_autorizados=floatval($val_detalle["numero_hombres"]);
                                    $precio=floatval($val_detalle["precio"]);
                                    $total_detalle=floatval($val_detalle["total"]);
                                }
                                $total_pago_bonos= $total_bono*$hombre_autorizados;
                                /* *************************** */

                                $total_detalle_global+=bcdiv($total_detalle,'1', 2);
                                $total_pago_bonos_global+=bcdiv($total_pago_bonos,'1', 2);

                                $html.="<tr>";
                                $html.="<td>".trim($val_maestra["codigo_ubicacion"])."</td>";
                                $html.="<td>".trim($val_maestra["nombre_ubicacion"])."</td>";
                                $html.="<td>".trim($val_maestra["bonos"])."</td>";
                                $html.="<td>".bcdiv($bono_mensual,'1', 2)."</td>";
                                $html.="<td>".bcdiv($valor_bono_no_faltar,'1', 2)."</td>";
                                $html.="<td>".trim($val_maestra["bono_horas"])."</td>";
                                $html.="<td>".bcdiv($total_bono,'1', 2)."</td>";
                                $html.="<td>".bcdiv($hombre_autorizados,'1', 2)."</td>";
                                $html.="<td>".bcdiv($precio,'1', 2)."</td>";
                                $html.="<td>".bcdiv($total_detalle,'1', 2)."</td>";
                                $html.="<td>".bcdiv($total_pago_bonos,'1', 2)."</td>";
                                $html.="</tr>";

                            }/*  maestros */

                            $html.="<tr>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="<td>".bcdiv($total_detalle_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($total_pago_bonos_global,'1', 2)."</td>";
                            $html.="</tr>";
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
                    textoTabla += strPad(col2, 60, ' ', 'right');
                    textoTabla += strPad(col3, 60, ' ', 'right');
                    textoTabla += strPad(col4, 60, ' ', 'right');
                    textoTabla += strPad(col5, 60, ' ', 'right');
                    textoTabla += strPad(col6, 60, ' ', 'right');
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
            guardarComoArchivoTexto(contenidoTexto, 'REPORTE DE BONOS UNIDADES ACTIVAS.txt');

                
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
        doc.save('REPORTE DE BONOS UNIDADES ACTIVAS.pdf');
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
        ws['!cols'][3] = { wch: 50, };
        ws['!cols'][4] = { wch: 60, };
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
        XLSX.writeFile(wb, "REPORTE DE BONOS UNIDADES ACTIVAS.xlsx");
       

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