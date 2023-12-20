

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
        function fun_clientes($condicional) {
            $query = "SELECT clientes.*,tbl_clientes_ubicaciones.*,tbl_clientes_ubicaciones.id as id_ubicacion 
            FROM clientes, tbl_clientes_ubicaciones
            WHERE tbl_clientes_ubicaciones.id_cliente=clientes.id $condicional";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_facturacion($idubicacion) {
            $query = "SELECT*FROM tbl_ubicaciones_detalle
            WHERE idubicacion=$idubicacion";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_auto($idubicacion) {
            $query = "SELECT septimo,turnos_comodin,(`24hr` + `12hde` + `12hd6` + `12hn6` + `12hd7` + `12hn7` + `extraordinario` + `septimo` ) AS total_auto
            FROM  tbl_ubicaciones_turnos
            WHERE idubicacion=$idubicacion";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_planilla($planilla_desde, $planilla_hasta,$codigo_empleado) {
            $query = "SELECT*FROM planilladevengo_admin
            WHERE numero_planilladevengo_admin>=$planilla_desde and numero_planilladevengo_admin<=$planilla_hasta and codigo_empleado_planilladevengo_admin	='$codigo_empleado'";
      
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_ubica_agente($codigo_ubicacion) {
            $query = "SELECT idagente_transacciones_agente FROM transacciones_agente
            WHERE nueva_ubicacion_transacciones_agente	like '%$codigo_ubicacion%'
            group by nueva_ubicacion_transacciones_agente
            order by id desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function fun_ubica_septimo($codigo_ubicacion) {
            $query = "SELECT count(*) as septimo FROM transacciones_agente
            WHERE nueva_ubicacion_transacciones_agente	like '%$codigo_ubicacion%' and turno_transacciones_agente='Septimo'
            group by nueva_ubicacion_transacciones_agente
            order by id desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        $fechaActual = date("d-m-Y"); 

        $planilla_desde = $_POST["planilla_desde"];
        $planilla_hasta = $_POST["planilla_hasta"];
        $clasificacion = $_POST["clisificacion"];
        $conempleado = $_POST["conempleado"];
        $cliente = $_POST["cliente"];

        
        
        $condicional="";
        if($clasificacion!="*" && $cliente=="*"){
            $condicional="and clientes.clasificacion='".$clasificacion."'";
        }
        else if($clasificacion=="*" && $cliente!="*"){
            $condicional="and clientes.id='".$cliente."'";
        }
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
                <table  class="table table-bordered table-striped dt-responsive" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th class="colspan">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</th>
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

                            $array_clientes=[];
                            $array_empleados_pla=[];
                            $nombre_repetido = false;

                            $data_clientes=fun_clientes($condicional);
                            foreach ($data_clientes as $val_cliente) {
                                $clasifi=$val_cliente["clasificacion"];
                                $nombre_cli=$val_cliente["nombre"];
                                $nombre_ubicacion=$val_cliente["nombre_ubicacion"];
                                $id_ubicacion=$val_cliente["id_ubicacion"];
                                $codigo_ubicacion=$val_cliente["codigo_ubicacion"];
                                $turnos_comodin=$val_cliente["turno_eventual"];
                                
                                $data_factura=fun_facturacion($id_ubicacion);
                                $asignado=0;
                                $total_factura=0;
                                foreach ($data_factura as $subvalor) {
                                    $asignado=$subvalor["numero_hombres"];
                                    $total_factura=bcdiv($subvalor["total"] ,'1', 2);
                                }

                                $data_auto=fun_auto($id_ubicacion);
                                $autoo=0;
                                foreach ($data_auto as $subvalor) {
                                    $autoo=$subvalor["total_auto"];
                                }

                                $septimo=0;
                                $data_septimo=fun_ubica_septimo($codigo_ubicacion);
                                foreach ($data_septimo as $subvalor) {
                                    $septimo=$subvalor["septimo"];
                                }

                                
                                $data_ubi=fun_ubica_agente($codigo_ubicacion);
                                $total_liquido=0;
                                $cuenta_empleados=0;
                                foreach ($data_ubi as $subvalor) {
                                    $codigo_empleado=$subvalor["idagente_transacciones_agente"];
                                    $data_planilla=fun_planilla($planilla_desde, $planilla_hasta,$codigo_empleado);
                                    foreach ($data_planilla as $sub_pla) {
                                        $cuenta_empleados++;
                                        $total_liquido+=bcdiv($sub_pla["total_liquidado_planilladevengo_admin"] ,'1', 2);
                                        $nombre_empleado=$sub_pla["nombre_empleado_planilladevengo_admin"];
                                        $codigo_empleado=$sub_pla["codigo_empleado_planilladevengo_admin"];

                                        
                                        // Verifica si el nombre ya existe en el array
                                        if (!in_array($codigo_empleado, $array_empleados_pla)) {
                                            $array_empleados_pla[] = array(
                                                "clasifi"=>$clasifi,
                                                "nombre_cli"=>$nombre_cli,
                                                "nombre_ubicacion"=>$nombre_ubicacion,
                                                "nombre_empleado" => $nombre_empleado,
                                                "codigo_empleado" => $codigo_empleado
                                            );
                                        }
                                      
                                    }
                                }

                                $diferencia_hombre=floatval($asignado)-$cuenta_empleados;
                                $diferencia_total=floatval($total_factura)-$total_liquido;
                                                
                                $array_clientes[]=array(
                                    "clasifi"=>$clasifi,
                                    "nombre_cli"=>$nombre_cli,
                                    "nombre_ubicacion"=>$nombre_ubicacion,
                                    "asignado"=>$asignado,
                                    "autorizado"=>$autoo,
                                    "septimo"=>$septimo,
                                    "turnos_comodin"=>$turnos_comodin,
                                    "hs"=>$asignado,
                                    "total"=>$total_factura,
                                    "cuenta_empleados"=>$cuenta_empleados,
                                    "total_liquido"=>$total_liquido,
                                    "info_empleado"=>$array_empleados_pla,
                                    "hsdiferencia"=>bcdiv($diferencia_hombre ,'1', 2),
                                    "totaldiferencia"=>bcdiv($diferencia_total ,'1', 2),
                                );
                                $cuenta_empleados=0;
                                $total_liquido=0;

                            }


                            $clasi_mostradas = array();
                            $nombre_cli_mostradas = array();
                            $empleados_cli_mostradas = array();
                            $cuenta=1;
                            $maximo=[];
                            $total_agente_global=0;
                            $cliente_actual = null;
                            foreach ($array_clientes as $value) {

                                $clasi= $value["clasifi"];
                                $nombre_cli= $value["nombre_cli"];

                                if (!in_array($clasi, $clasi_mostradas)) {
                                    $html.="<tr>";
                                    $html.="<td class='colspan'>CLASIFICACION : ".$clasi."</td>";
                                    $html.="</tr>";
                                    $clasi_mostradas[] = $clasi;
                                    
                                }

                                if (!in_array($nombre_cli, $nombre_cli_mostradas) && $clasi == $clasi_mostradas[count($clasi_mostradas) - 1]) {

                                    if($total_agente_global!=0){
                                        $html.="<tr>";
                                        $html.="<td class='colspan'>"." SON ".$total_agente_global." AGENTES"."</td>";
                                        $html.="</tr>";
                                        $total_agente_global=0;
                                    }

                           


                                    $html .= "<tr>";
                                    $html .= "<td class='colspan'>CLIENTE " . $nombre_cli . "</td>";
                                    $html .= "</tr>";
                                    $nombre_cli_mostradas[] = $nombre_cli;
                                    $cliente_actual = $nombre_cli;
                                    
                                    $html.="<tr>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td>"."</td>";
                                    $html.="<td colspan='2'>FACTURACION"."</td>";
                                    $html.="<td colspan='2'>PLANILLA"."</td>";
                                    $html.="<td colspan='2'>DIFERENCIA"."</td>";
                                    $html.="</tr>";

                                    $html.="<tr>";
                                    $html.="<td>UNIDAD DE SERVCIO"."</td>";
                                    $html.="<td>ASIG."."</td>";
                                    $html.="<td>AUT."."</td>";
                                    $html.="<td>VACANTE"."</td>";
                                    $html.="<td>SEPTIMO"."</td>";
                                    $html.="<td>COMODIN"."</td>";
                                    $html.="<td>HS."."</td>";
                                    $html.="<td>VALOR"."</td>";
                                    $html.="<td>HS."."</td>";
                                    $html.="<td>VALOR"."</td>";
                                    $html.="<td>HS."."</td>";
                                    $html.="<td>VALOR"."</td>";
                                    $html.="</tr>";

                                    $cuenta=1;
                                }


                                $total_agente=0;
                                if ($clasi == $clasi_mostradas[count($clasi_mostradas) - 1] || $nombre_cli == $nombre_cli_mostradas[count($nombre_cli_mostradas) - 1]) {
                                
                                    $total_agente=$value["autorizado"];
                                    $total_agente_global+=$total_agente;
                                    
                                    $numero_formateado = str_pad($cuenta++, 3, '0', STR_PAD_LEFT);

                                    $vacante=$value["autorizado"]-$value["cuenta_empleados"];

                                    $html.="<tr>";
                                    $html.="<td>".$numero_formateado." ".$value["nombre_ubicacion"]."</td>";
                                    $html.="<td>".$value["cuenta_empleados"]."</td>";
                                    $html.="<td>".$value["autorizado"]."</td>";
                                    $html.="<td>".$vacante."</td>";
                                    $html.="<td>".$value["septimo"]."</td>";
                                    $html.="<td>".$value["turnos_comodin"]."</td>";
                                    $html.="<td>".$value["hs"]."</td>";
                                    $html.="<td>".$value["total"]."</td>";
                                    $html.="<td>".$value["cuenta_empleados"]."</td>";
                                    $html.="<td>".$value["total_liquido"]."</td>";
                                    $html.="<td>".$value["hsdiferencia"]."</td>";
                                    $html.="<td>".$value["totaldiferencia"]."</td>";
                                    $html.="</tr>";

                                   if($conempleado=="Si"){
                                        foreach ($value["info_empleado"] as $val_plan){
                                            $codigo_empleado= $val_plan["codigo_empleado"];
                                            if (!in_array($codigo_empleado, $empleados_cli_mostradas)) {
                                            $html.="<tr>";
                                            $html.="<td>".$val_plan["codigo_empleado"]."</td>";
                                            $html.="<td>".$val_plan["nombre_empleado"]."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="<td>"."</td>";
                                            $html.="</tr>";
                                            $empleados_cli_mostradas[] = $codigo_empleado;
                                            }
                                        }
                                    }
                                    $html.="<tr>";
                                    $html.="<td class='colspan'>"." SON ".$total_agente." AGENTES"."</td>";
                                    $html.="</tr>";

                                    if ($value === end($array_clientes)) {
                                        if($cuenta>=1){
                                            $html.="<tr>";
                                            $html.="<td class='colspan'>"." SON ".$total_agente_global." AGENTES"."</td>";
                                            $html.="</tr>";
                                        }
                                      /*   echo "<script>".
                                        "alert(".$cuenta.")".
                                        "</script>"; */
                                    }
                                  
                                  

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
            guardarComoArchivoTexto(contenidoTexto, 'REPORTE DE PERSONAL POR MUNICIPIO.txt');

                
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
        doc.save('REPORTE DE PERSONAL POR MUNICIPIO.pdf');
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
        XLSX.writeFile(wb, "REPORTE DE PERSONAL POR MUNICIPIO.xlsx");
       

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
   
    var numColumnas = $('#tabladatos tr:nth-child('+maxLength+') td').length;
    console.log('Número de columnas en la cuarta fila: ' + numColumnas);
    $(".colspan").attr("colspan",maxLength);
  });
});
</script>