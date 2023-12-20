

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
        function otroquipos($operador) {
            $query = "SELECT * FROM tbl_radios $operador";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function tipo_equipos($tipoarma) {
            $query = "SELECT * FROM tbl_tipos_de_radios $tipoarma";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function movimientosequipos($equipo) {
            $query = "SELECT * FROM movimientosequipos where  codigo_equipo='$equipo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function ubicacion($idubi) {
            $query = "SELECT * FROM tbl_clientes_ubicaciones where  id='$idubi'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
       


        $fechaActual = date("Y-m-d"); 

        $equipos = $_POST["radio"];
        $armatipo="";
        $equipostipo="";
        if($equipos!="*"){

            $equipostipo="WHERE id=".$equipos."";
        }
        else{
            $equipos="";
        }
    

        ?>     
      
       <div class="col-md-12" align="center">
        
      </div>

      <div class="col-md-12" align="center">

      
      </div>

        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th colspan="9">ISE, S.A. DE C.V.</th>
                        </tr>
                        <tr>
                            <th colspan="9">REPORTE DE INVENTARIO EQUIPO </th>
                        </tr>
                        <tr>
                            <th colspan="9">RADIOS</th>
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
                            $html.="<td>MARCA"."</td>";
                            $html.="<td>SERIE"."</td>";
                            $html.="<td>CALIBRE"."</td>";
                            $html.="<td>MODELO"."</td>";
                            $html.="<td>VENCIMIENTO  "."</td>";
                            $html.="<td>ESTATUS"."</td>";
                            $html.="<td>UBICACION"."</td>";
                            $html.="<td>TRANSACCION"."</td>";
                            $html.="<td>FECHA"."</td>";
                            $html.="</tr>";

                            $data_maestra=tipo_equipos($equipostipo);
                            $correlativo=1;
                            foreach ($data_maestra as $val_maestra) { 

                                $id_tipo="WHERE id_tipo_de_radio='".$val_maestra["id"]."'";
                                
                                $html.="<tr>";
                                $html.="<td colspan='9'>TIPO DE RADIO : ".$val_maestra["nombre"]."</td>";
                                $html.="</tr>";  

                                $html.="<tr>";
                                $html.="<td>MARCA"."</td>";
                                $html.="<td>SERIE"."</td>";
                                $html.="<td>CALIBRE"."</td>";
                                $html.="<td>MODELO"."</td>";
                                $html.="<td>VENCIMIENTO "."</td>";
                                $html.="<td>ESTATUS"."</td>";
                                $html.="<td>UBICACION"."</td>";
                                $html.="<td>TRANSACCION"."</td>";
                                $html.="<td>FECHA"."</td>";
                                $html.="</tr>";

                                
                                
                                $data_arma=otroquipos($id_tipo);
                                foreach ($data_arma as $val_arma) { 
                                    $equipo=$val_arma["codigo_radio"];                       
                                    $data_movimiento=movimientosequipos($equipo);
                                    $nombre_ubi="";
                                    $correlativo_movmiento="";
                                    $fecha_movimiento="";
                                    foreach ($data_movimiento as $val_equipo) {
                                        # code...
                                        $idubi=$val_equipo["id_ubicacion_movimiento"];
                                        $correlativo_movmiento=$val_equipo["correlativo_movimiento"];
                                        $fecha_movimiento=$val_equipo["fecha_movimiento"];
                                        $data_ubi= ubicacion($idubi);
                                        foreach ($data_ubi as $val_ubi) {
                                            # code...
                                            $nombre_ubi=$val_ubi["nombre_ubicacion"];

                                        }
                                }

                                /* $fechaNueva = date("d-m-Y", strtotime($val_arma["fecha_vencimiento"])); */

                                

                                    $html.="<tr>";
                                    $html.="<td>".$correlativo++." ".$val_arma["marca"]."</td>";
                                    $html.="<td>".$val_arma["numero_serie"]."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>".$val_arma["modelo_radio"]."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>".$val_arma["estado_radio"]."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>".$correlativo_movmiento."</td>";
                                    $html.="<td>".$fecha_movimiento."</td>";
                                    $html.="</tr>";           
                                
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
                    var col13 = (fila.cells[13] !== undefined) ? fila.cells[13].textContent : ' ';
                    
                    textoTabla += strPad(col0, 25, ' ', 'right');
                    textoTabla += strPad(col1, 25, ' ', 'right');
                    textoTabla += strPad(col2, 60, ' ', 'right');
                    textoTabla += strPad(col3, 40, ' ', 'right');
                    textoTabla += strPad(col4, 60, ' ', 'right');
                    textoTabla += strPad(col5, 25, ' ', 'right');
                    textoTabla += strPad(col6, 25, ' ', 'right');
                    textoTabla += strPad(col7, 40, ' ', 'right');
                    textoTabla += strPad(col8, 40, ' ', 'right');
                    textoTabla += strPad(col9, 40, ' ', 'right');
                    textoTabla += strPad(col10, 35, ' ', 'right');
                    textoTabla += strPad(col11, 25, ' ', 'right');
                    textoTabla += strPad(col12, 25, ' ', 'right');
                    textoTabla += strPad(col13, 25, ' ', 'right');
                    

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
            guardarComoArchivoTexto(contenidoTexto, 'REPORTE DE INVENTARIO EQUIPO.txt');

                
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
        doc.save('REPORTE DE INVENTARIO EQUIPO.pdf');
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
        
        ws['!cols'][0] = { wch: 20, };
        ws['!cols'][1] = { wch: 20, };
        ws['!cols'][2] = { wch: 20, };
        ws['!cols'][3] = { wch: 20, };
        ws['!cols'][4] = { wch: 20, };
        ws['!cols'][5] = { wch: 20, };
        ws['!cols'][6] = { wch: 20, };
        ws['!cols'][7] = { wch: 20, };
        ws['!cols'][8] = { wch: 40, };
        ws['!cols'][9] = { wch: 40, };
        ws['!cols'][10] = { wch: 35, };
        ws['!cols'][11] = { wch: 25, };
        ws['!cols'][12] = { wch: 25, };
        ws['!cols'][13] = { wch: 25, };


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
        XLSX.writeFile(wb, "REPORTE DE INVENTARIO EQUIPO.xlsx");
       

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