

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
      

        /* *******CUERPO***** */
        function empleado($codigo) {
            $query = "SELECT *
            FROM tbl_empleados  where codigo_empleado='$codigo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function empleado_cargo($cargo_maestro) {
            $query = "SELECT *
            FROM tbl_empleados
            WHERE nivel_cargo='$cargo_maestro'";
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
        
        function consultar_devengo_empleados($idempleados)
		{
			$query01 = "SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia` 
						FROM `tbl_empleados_devengos_descuentos` 
						WHERE id_empleado=$idempleados and id_tipo_devengo_descuento=2 
						group by id_empleado";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

        function cargos($nivel_cargo)
		{
			$query01 = "SELECT * FROM `cargos_desempenados` where id=$nivel_cargo";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

        /* solo ubicacion */
        function empleado_ubi($codigo) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* , clientes.*
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                             codigo_agente=tbl_empleados.codigo_empleado and
                              codigo_agente='$codigo' ";
                          
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function departamento_pais($iddepartamento)
		{
			$query01 = "SELECT * FROM `cat_departamento` where id=$iddepartamento";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
        function municipio_pais($idmunicipio)
		{
			$query01 = "SELECT * FROM `cat_municipios` where id=$idmunicipio";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

        function movimiento($fecha_desde, $fecha_hasta)
		{
			$query01 = "SELECT * FROM `transacciones_agente` where STR_TO_DATE(fecha_transacciones_agente, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and  STR_TO_DATE(fecha_transacciones_agente, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y') group by idagente_transacciones_agente order by id desc";
   
			$sql = Conexion::conectar()->prepare($query01);
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
                            <th colspan="8">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V. </th>
                        </tr>
                        <tr>
                            <th colspan="8">ROTACION DE PERSONAL</th>
                        </tr>
                        <tr>
                            <th colspan="8"><?php echo $fecha_desde."              ".$fecha_hasta?></th>
                        </tr>
                        <tr>
                            <th colspan="8"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */
                            $html="";
                            
                            $html.="<tr>";
                            $html.="<td>EMPRESA"."</td>";
                            $html.="<td>DUI"."</td>";
                            $html.="<td>NIT"."</td>";
                            $html.="<td>FECHA"."</td>";
                            $html.="<td>NOMBRE"."</td>";
                            $html.="<td>CARGO"."</td>";
                            $html.="<td>ACTUAL"."</td>";
                            $html.="<td>ANTERIOR"."</td>";
                            $html.="</tr>";

                            $data_movimiento=movimiento($fecha_desde,$fecha_hasta);

                            foreach ($data_movimiento as $value_movimiento) {
                                # code...
                                $codigo_movimiento_agente=$value_movimiento["idagente_transacciones_agente"];
                                $ubicacion_anterior=$value_movimiento["ubicacion_anterior_transacciones_agente"];
                                $ubicacion_nueva=$value_movimiento["nueva_ubicacion_transacciones_agente"];

                                $nombre_ubi_anterior = explode("-", empty($ubicacion_anterior) ? " - " : $ubicacion_anterior);
                                $nombre_ubi_actual = explode("-", empty($ubicacion_nueva) ? " - " : $ubicacion_nueva);

                            
                                $data_maestra=empleado($codigo_movimiento_agente);
                                $correlativo=0;
                                foreach ($data_maestra as $val_maestra) { 

                                    $iddepartamento=$val_maestra["id_departamento"];
                                    $idmunicipio=$val_maestra["id_municipio"];

                                    $nivel_cargo=$val_maestra["nivel_cargo"];
                                    $codigo=$val_maestra["codigo_empleado"];
                                    $sueldo=floatval($val_maestra["sueldo"])*2;

                                    $nombre_cargo=trim(trim($val_maestra["primer_nombre"])." ".trim($val_maestra["segundo_nombre"]).' '.trim($val_maestra["tercer_nombre"]));
                                    $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);

                                    
                                    $apellidos=trim(trim($val_maestra["primer_apellido"]).' '.trim($val_maestra["segundo_apellido"]).' '.trim($val_maestra["apellido_casada"]));
                                    $apellidos = preg_replace('/\s+/', ' ', $apellidos);


                                    
                                    $timestamp = strtotime($val_maestra["fecha_contratacion"]);
                                    $fecha_formateada = date("d-m-Y", $timestamp);
                                    $fecha_con=$fecha_formateada;



                                        $datacargo=cargos($nivel_cargo);
                                        $namecargo="";
                                        foreach ($datacargo as $value) {
                                            # code...
                                            $namecargo=$value["descripcion"];
                                        }

                                        $datacliente=empleado_ubi($codigo);
                                        $nombrecliente="";
                                        $nombreubicacion="";
                                        $telefono_contacto="";
                                        foreach ($datacliente as $val_datacliente) {
                                            # code...
                                            $nombrecliente=$val_datacliente["nombre"];
                                            $nombreubicacion=$val_datacliente["nombre_ubicacion"];
                                            $telefono_contacto=$val_datacliente["telefono_contacto"];
                                        }


                                        $datadepar=departamento_pais($iddepartamento);
                                        $nombre_departamento="";
                                        foreach ($datadepar as  $val_depa) {
                                            # code...
                                            $nombre_departamento=$val_depa["Nombre"];

                                        }
                                        $datamuni=municipio_pais($idmunicipio);
                                        $nombre_municipio="";
                                        foreach ($datamuni as  $val_muni) {
                                            # code...
                                            $nombre_municipio=$val_muni["Nombre_m"];

                                        }
                                        $depa_muni=$nombre_departamento."/".$nombre_municipio;
                                    /* *************************** */

                                    $html.="<tr>";
                                    $html.="<td>ISE, S.A. DE C.V."."</td>";
                                    $html.="<td>".trim($val_maestra["numero_documento_identidad"])."</td>";
                                    $html.="<td>".trim($val_maestra["nit"])."</td>";
                                    $html.="<td>".trim($value_movimiento["fecha_transacciones_agente"])."</td>";
                                    $html.="<td>".$codigo_movimiento_agente.$nombre_cargo." ".$apellidos."</td>";
                                    $html.="<td>".trim($namecargo)."</td>";
                                    $html.="<td>".trim($nombre_ubi_actual[1])."</td>";
                                    $html.="<td>".trim($nombre_ubi_anterior[1])."</td>";
                                                               
                                    $html.="</tr>";

                                }/*  maestros */
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
                    textoTabla += strPad(" ", 35, ' ', 'center');
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
                    
                    textoTabla += strPad(col0, 30, ' ', 'right');
                    textoTabla += strPad(col1, 30, ' ', 'right');
                    textoTabla += strPad(col2, 30, ' ', 'right');
                    textoTabla += strPad(col3, 55, ' ', 'right');
                    textoTabla += strPad(col4, 55, ' ', 'right');
                    textoTabla += strPad(col5, 55, ' ', 'right');
                    textoTabla += strPad(col6, 55, ' ', 'right');
                    textoTabla += strPad(col7, 55, ' ', 'right');
                    textoTabla += strPad(col8, 55, ' ', 'right');
                    textoTabla += strPad(col9, 55, ' ', 'right');
                    textoTabla += strPad(col10, 55, ' ', 'right');
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
            guardarComoArchivoTexto(contenidoTexto, 'PERSONAL ACTIVO.txt');

                
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
        doc.save('PERSONAL ACTIVO.pdf');
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
        
        ws['!cols'][0] = { wch: 40, };
        ws['!cols'][1] = { wch: 25, };
        ws['!cols'][2] = { wch: 30, };
        ws['!cols'][3] = { wch: 50, };
        ws['!cols'][4] = { wch: 50, };
        ws['!cols'][5] = { wch: 50, };
        ws['!cols'][6] = { wch: 60, };
        ws['!cols'][7] = { wch: 40, };
        ws['!cols'][8] = { wch: 50, };
        ws['!cols'][9] = { wch: 40, };
        ws['!cols'][10] = { wch: 20, };
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
        XLSX.writeFile(wb, "PERSONAL ACTIVO.xlsx");
       

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