

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
        function fun_empleado($condicional) {
            $query = "SELECT * FROM tbl_empleados $condicional";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


       
        function fun_departamento($id) {
            $query = "SELECT *FROM cat_departamento where id=$id";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function fun_municipio($id) {
            $query = "SELECT *FROM cat_municipios where id=$id";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
       
        function fun_transaccionagente($id) {
            $query = "SELECT *FROM transacciones_agente 
            where idagente_transacciones_agente='$id'
            group by idagente_transacciones_agente
            order by id desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

       
        function fun_seminarios($id) {
            $query = "SELECT tbl_empleados_seminario.* , seminarios.nombre as nombre_semi
            FROM `tbl_empleados_seminario`, seminarios 
            WHERE tbl_empleados_seminario.id_seminario=seminarios.id and tbl_empleados_seminario.id_empleado='$id'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
       

        
        function fun_ubicacion($id_coor) {
            $query = "SELECT *FROM tbl_clientes_ubicaciones 
            where id_coordinador_zona='$id_coor'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_tran_ubi($codigo_ubi) {
            $query = "SELECT *FROM transacciones_agente 
            where nueva_ubicacion_transacciones_agente like '%$codigo_ubi%'
            group by idagente_transacciones_agente 
            order by id desc";
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        
        function fun_empleado_codigo($codigo) {
            $query = "SELECT * FROM tbl_empleados where codigo_empleado='$codigo'";
          
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        $fechaActual = date("d-m-Y"); 

        $fecha_desde = $_POST["fecha_desde"];
        $fecha_hasta = $_POST["fecha_hasta"];
        $empleado = $_POST["empleado"];
        $departamento = $_POST["departamento"];
        $municipio = $_POST["municipio"];
        
        $condicional="";
        if($departamento!="*" && $municipio=="*"){
            $condicional="WHERE id_departamento=".$departamento;
        }
        else if($departamento=="*" && $municipio!="*"){
            $condicional="WHERE id_municipio=".$municipio;
        }
        else if($departamento!="*" && $municipio!="*"){
            $condicional="WHERE id_municipio=".$municipio." and id_departamento=".$departamento;
        }
        else if($departamento=="*" && $municipio=="*"){
            $condicional="";
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
                            <th class="colspan">REPORTE DE PERSONAL POR MUNICIPIO</th>
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
                            $html.="<td>CODIGO"."</td>";
                            $html.="<td>APELLIDOS"."</td>";
                            $html.="<td>NOMBRES"."</td>";
                            $html.="<td>FINGRESO"."</td>";
                            $html.="<td>FASIGNACION"."</td>";
                            $html.="<td>EDAD"."</td>";
                            $html.="<td>NIVEL ACADEMICO"."</td>";
                            $html.="<td>EPOLIGRAFICO"."</td>";
                            $html.="<td>CURSO ANSP"."</td>";
                            $html.="<td>No. APROBACION"."</td>";
                            $html.="</tr>";

                            $array_empleado=[];

                            if($empleado!="*"){

                                /* --------------- */
                                $data_supervisor=fun_ubicacion($empleado);
                                foreach ($data_supervisor as $val_coor) {
                                    $codigo_ubi=$val_coor["codigo_ubicacion"];

                                    $data_ubi_coor=fun_tran_ubi($codigo_ubi);
                                    foreach ($data_ubi_coor as $val_ubi_coor) {
                                        $cod_emple=$val_ubi_coor["idagente_transacciones_agente"];
                                                            /* ****************** */
                                            $data_maestra=fun_empleado_codigo($cod_emple);
                                            foreach ($data_maestra as $value) {
                                                $id_empleado=$value["id"];
                                                $id_departamento=$value["id_departamento"];
                                                $id_municipio=$value["id_municipio"];
                                                $codigo_empleado=$value["codigo_empleado"];
                                                $fecha_ingreso=date('d-m-Y', strtotime($value["fecha_ingreso"]));
                                                $fecha_nacimiento=$value["fecha_nacimiento"];
                                                $anio = date('Y', strtotime($fecha_nacimiento));
                                                $anio_actual = date('Y');
                                                $edad=$anio_actual-$anio;
                                                $grado_estudio=$value["grado_estudio"];
                                                $Fecha_poligrafico=date('d-m-Y', strtotime($value["Fecha_poligrafico"]));
                                                $fecha_curso_ansp=date('d-m-Y', strtotime($value["fecha_curso_ansp"]));
                                                $numero_aprobacion_ansp=$value["numero_aprobacion_ansp"];

                                                
                                                $nombre_empleado=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]));
                                                $nombre_empleado = preg_replace('/\s+/', ' ', $nombre_empleado);
                                                $apellido_empleado=trim(trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                                $apellido_empleado = preg_replace('/\s+/', ' ', $apellido_empleado);

                                                $nombre_depa="";
                                                $data_depa=fun_departamento($id_departamento);
                                                foreach ($data_depa as $val_depa) {
                                                    $nombre_depa=$val_depa["Nombre"];
                                                }

                                                $nombre_muni="";
                                                $data_muni=fun_municipio($id_municipio);
                                                foreach ($data_muni as $val) {
                                                    $nombre_muni = isset($val["Nombre_m"]) ? $val["Nombre_m"] : "";
                                                }

                                                $fecha_asignacion="";
                                                $data_transaccionagenter=fun_transaccionagente($codigo_empleado);
                                                foreach ($data_transaccionagenter as $val_tra) {
                                                    $fecha_asignacion=$val_tra["fecha_transacciones_agente"];
                                                }

                                                $fecha_seminario="";
                                                $nombre_seminario="";
                                                $lugar_seminario="";
                                                $data_semi=fun_seminarios($id_empleado);
                                                foreach ($data_semi as $val_semi) {
                                                    # code...
                                                    $fecha_seminario=date('d-m-Y', strtotime($val_semi["fecha_realizacion"]));
                                                    $nombre_seminario=$val_semi["nombre_semi"];
                                                    $lugar_seminario=$val_semi["lugar_recibido"];
                                                }

                
                                                    $array_empleado[]=array(
                                                        "departamento"=>$nombre_depa,
                                                        "municipio"=>$nombre_muni,
                                                        "codigo_empleado"=>$codigo_empleado,
                                                        "apellido_empleado"=>$apellido_empleado,
                                                        "nombre_empleado"=>$nombre_empleado,
                                                        "fecha_ingreso"=>$fecha_ingreso,
                                                        "fecha_asignacion"=>$fecha_asignacion,
                                                        "edad"=>$edad,
                                                        "grado_estudio"=>$grado_estudio,
                                                        "Fecha_poligrafico"=>$Fecha_poligrafico,
                                                        "fecha_curso_ansp"=>$fecha_curso_ansp,
                                                        "numero_aprobacion_ansp"=>$numero_aprobacion_ansp,
                                                        "fecha_seminario"=>$fecha_seminario,
                                                        "nombre_seminario"=>$nombre_seminario,
                                                        "lugar_seminario"=>$lugar_seminario,
                                                    );
                                            }
                                                            /* ****************** */
                                    }
                                }
                                /* --------------- */
                            }
                            else{
                                
                                $data_maestra=fun_empleado($condicional);
                                foreach ($data_maestra as $value) {
                                    $id_empleado=$value["id"];
                                    $id_departamento=$value["id_departamento"];
                                    $id_municipio=$value["id_municipio"];
                                    $codigo_empleado=$value["codigo_empleado"];
                                    $fecha_ingreso=date('d-m-Y', strtotime($value["fecha_ingreso"]));
                                    $fecha_nacimiento=$value["fecha_nacimiento"];
                                    $anio = date('Y', strtotime($fecha_nacimiento));
                                    $anio_actual = date('Y');
                                    $edad=$anio_actual-$anio;
                                    $grado_estudio=$value["grado_estudio"];
                                    $Fecha_poligrafico=date('d-m-Y', strtotime($value["Fecha_poligrafico"]));
                                    $fecha_curso_ansp=date('d-m-Y', strtotime($value["fecha_curso_ansp"]));
                                    $numero_aprobacion_ansp=$value["numero_aprobacion_ansp"];

                                    
                                    $nombre_empleado=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]));
                                    $nombre_empleado = preg_replace('/\s+/', ' ', $nombre_empleado);
                                    $apellido_empleado=trim(trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                    $apellido_empleado = preg_replace('/\s+/', ' ', $apellido_empleado);

                                    $nombre_depa="";
                                    $data_depa=fun_departamento($id_departamento);
                                    foreach ($data_depa as $val_depa) {
                                        $nombre_depa=$val_depa["Nombre"];
                                    }

                                    $nombre_muni="";
                                    $data_muni=fun_municipio($id_municipio);
                                    foreach ($data_muni as $val) {
                                        $nombre_muni = isset($val["Nombre_m"]) ? $val["Nombre_m"] : "";
                                    }
                                    $fecha_asignacion="";
                                    $data_transaccionagenter=fun_transaccionagente($codigo_empleado);
                                    foreach ($data_transaccionagenter as $val_tra) {
                                        # code...
                                        $fecha_asignacion=$val_tra["fecha_transacciones_agente"];
                                    }

                                    $fecha_seminario="";
                                    $nombre_seminario="";
                                    $lugar_seminario="";
                                    $data_semi=fun_seminarios($id_empleado);
                                    foreach ($data_semi as $val_semi) {
                                        # code...
                                        $fecha_seminario=date('d-m-Y', strtotime($val_semi["fecha_realizacion"]));
                                        $nombre_seminario=$val_semi["nombre_semi"];
                                        $lugar_seminario=$val_semi["lugar_recibido"];
                                    }

    
                                        $array_empleado[]=array(
                                            "departamento"=>$nombre_depa,
                                            "municipio"=>$nombre_muni,
                                            "codigo_empleado"=>$codigo_empleado,
                                            "apellido_empleado"=>$apellido_empleado,
                                            "nombre_empleado"=>$nombre_empleado,
                                            "fecha_ingreso"=>$fecha_ingreso,
                                            "fecha_asignacion"=>$fecha_asignacion,
                                            "edad"=>$edad,
                                            "grado_estudio"=>$grado_estudio,
                                            "Fecha_poligrafico"=>$Fecha_poligrafico,
                                            "fecha_curso_ansp"=>$fecha_curso_ansp,
                                            "numero_aprobacion_ansp"=>$numero_aprobacion_ansp,
                                            "fecha_seminario"=>$fecha_seminario,
                                            "nombre_seminario"=>$nombre_seminario,
                                            "lugar_seminario"=>$lugar_seminario,
                                        );
                                }
                            }


                            $depa_mostradas = array();
                            $muni_mostradas = array();
                            foreach ($array_empleado as $value) {

                                $depa = $value["departamento"];
                                $muni= $value["municipio"];
                                if (!in_array($depa, $depa_mostradas)) {
                                    $html.="<tr>";
                                    $html.="<td class='colspan'>DEPARTAMENTO ".$depa."</td>";
                                    $html.="</tr>";
                                    $depa_mostradas[] = $depa;
                                }

                                if (!in_array($muni, $muni_mostradas) && $depa == $depa_mostradas[count($depa_mostradas) - 1]) {
                                    $html .= "<tr>";
                                    $html .= "<td class='colspan'>MUNICIPIO " . $muni . "</td>";
                                    $html .= "</tr>";
                                    $muni_mostradas[] = $muni;
                                }

                                if ($depa == $depa_mostradas[count($depa_mostradas) - 1] || $muni == $muni_mostradas[count($muni_mostradas) - 1]) {
                                

                                
                                $html.="<tr>";
                                $html.="<td class=''> ".$value["codigo_empleado"]."</td>";
                                $html.="<td class=''> ".$value["apellido_empleado"]."</td>";
                                $html.="<td class=''> ".$value["nombre_empleado"]."</td>";
                                $html.="<td class=''> ".$value["fecha_ingreso"]."</td>";
                                $html.="<td class=''> ".$value["fecha_asignacion"]."</td>";
                                $html.="<td class=''> ".$value["edad"]."</td>";
                                $html.="<td class=''> ".$value["grado_estudio"]."</td>";
                                $html.="<td class=''> ".$value["Fecha_poligrafico"]."</td>";
                                $html.="<td class=''> ".$value["fecha_curso_ansp"]."</td>";
                                $html.="<td class=''> ".$value["numero_aprobacion_ansp"]."</td>";
                                $html.="</tr>";

                                if (!empty($value["fecha_seminario"])) {
                                    $html.="<tr>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="<td class=''> ".$value["fecha_seminario"]."</td>";
                                    $html.="<td class=''> ".$value["nombre_seminario"]."</td>";
                                    $html.="<td class=''> ".$value["lugar_seminario"]."</td>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="<td class=''> "."</td>";
                                    $html.="</tr>";
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