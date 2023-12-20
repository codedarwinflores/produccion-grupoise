

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
        function fun_ubicacion_detalle($condicional) {
            $query = "SELECT*FROM tbl_ubicaciones_detalle $condicional 
            /* group by idagente_transacciones_agente  */
            order by id desc";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_ubicacion($id,$condicional_rubro) {
            $query = "SELECT*FROM tbl_clientes_ubicaciones 
            WHERE id='$id' $condicional_rubro
            order by rubro desc";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_clientes($codigo) {
            $query = "SELECT*FROM clientes 
            WHERE codigo='$codigo'";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        
        function fun_ubicacion_cuenta($id,$condicional_rubro) {
            $query = "SELECT *FROM tbl_clientes_ubicaciones 
            WHERE id='$id' $condicional_rubro
            group by codigo_ubicacion";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_tran_empleado($codigo) {
            $query = "SELECT count(*) as cuenta FROM transacciones_agente 
            WHERE nueva_ubicacion_transacciones_agente like '%$codigo%'
            group by nueva_ubicacion_transacciones_agente
            order by id desc";  
            
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        
        function fun_sinfacturar() {
            $query = "SELECT*FROM tbl_clientes_ubicaciones 
            LEFT JOIN tbl_ubicaciones_detalle ON tbl_clientes_ubicaciones.id = tbl_ubicaciones_detalle.idubicacion 
            WHERE tbl_ubicaciones_detalle.idubicacion IS NULL";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        $fechaActual = date("d-m-Y"); 

        $forma_pago = $_POST["forma_pago"];
        $rubro_master = $_POST["rubro"];
        $cliente_master = $_POST["cliente"];
        /* $ubicacion = "*"; */
        $concepto_maestra=$_POST["concepto"];
        $sinfacturar=$_POST["sinfacturar"];

        
        
        $condicional="";
        $condicional_rubro="";
        if($forma_pago!="*" ){
            $condicional="WHERE  forma_pago ='".$forma_pago."'";
        }

        if($rubro_master !="*" ){
            $condicional_rubro="and rubro ='".$rubro_master."'";
        }

        
        if($cliente_master !="*" ){
            $condicional_rubro="and codigo_cliente ='".$cliente_master."'";
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
                            <th class="colspan">*** FACTURACION ***</th>
                        </tr>
                        <tr>
                            <th class="colspan"><?php echo $fechaActual?></th>
                        </tr>
                        <tr>
                            <th class="colspan"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */
                            $html="";

                            
                            $html .= "<tr>";
                            $html .= "<td> "."</td>";
                            $html .= "<td>UBICACION "."</td>";
                            $html .= "<td>CLIENTE "."</td>";
                            $html .= "<td>SECTOR. "."</td>";
                            $html .= "<td>TELEFONO"."</td>";
                            $html .= "<td>PRECIO."."</td>";
                            $html .= "<td>VALOR TOTAL "."</td>";
                            $html .= "<td>% "."</td>";
                            $html .= "</tr>";

                            $array_ubicacion=[];
                            $data_ubicacion=fun_ubicacion_detalle($condicional);
                            $cuenta_empleados=0;
                            $cuenta_empresas=0;
                            $nosuma_fact=0;
                            foreach ($data_ubicacion as $val_ubicacion) {
                                $forma_pago=$val_ubicacion["forma_pago"];
                                $tipo_documento=$val_ubicacion["tipo_documento"];
                                $id=$val_ubicacion["idubicacion"];

                                
                                $data_ubi_cuenta=fun_ubicacion_cuenta($id,$condicional_rubro);
                                foreach ($data_ubi_cuenta as $subvalue) {
                                    /* $cuenta_empresas=$subvalue["cuenta_empresas"]; */
                                    $cuenta_empresas++;
                                }

                                $data_ubicacion_cliente=fun_ubicacion($id,$condicional_rubro);
                                foreach ($data_ubicacion_cliente as $val_cliente) {
                                    
                                    $codigo=$val_cliente["codigo_ubicacion"];
                                    $codigo_cliente=$val_cliente["codigo_cliente"];
                                    $rubro=$val_cliente["rubro"];
                                    $numero_agente=0;
                                    $data_numero_agentes=fun_tran_empleado($codigo);
                                    foreach ($data_numero_agentes as $val_numero) {
                                        $numero_agente=$val_numero["cuenta"];
                                    }

                                    $cuenta_empleados+=floatval($val_ubicacion["numero_hombres"]);

                                    $data_completa_clientes=fun_clientes($codigo_cliente);
                                    $codigo_cliente_ori="";
                                    $nombre_cliente_ori="";
                                    $ubicacion_cliente_ori="";
                                    $telefono_cliente_ori="";
                                    foreach ($data_completa_clientes as $subvalue) {
                                        # code...
                                    $codigo_cliente_ori=$subvalue["codigo"];
                                    $nombre_cliente_ori=$subvalue["nombre"];
                                    $ubicacion_cliente_ori=$subvalue["direccion"];
                                    $telefono_cliente_ori=$subvalue["telefono_1"]." ".$subvalue["telefono_2"];

                                    }
                                   
                                    if($val_ubicacion["nosumahs"]=="No"){
                                        $nosuma_fact=0;
                                    }
                                    else{
                                        $nosuma_fact=$val_ubicacion["numero_hombres"];
                                    }
                                    $array_ubicacion[]=array(
                                        "forma_pago"=>$forma_pago,
                                        "tipo_documento"=>$tipo_documento,
                                        "codigo_ubicacion"=>$val_cliente["codigo_ubicacion"],
                                        "nombre_ubicacion"=>$val_cliente["nombre_ubicacion"],
                                        "aut"=>$numero_agente,
                                        "facturar"=>$val_ubicacion["numero_hombres"],
                                        "precio"=>$val_ubicacion["precio"],
                                        "total"=>$val_ubicacion["total"],
                                        "porcen"=>"100%",
                                        "rubro"=>$rubro,
                                        "cuenta"=>$cuenta_empresas,
                                        "cuenta_empleados"=>$cuenta_empleados,
                                        "concepto"=>$val_cliente["concepto"],
                                        "cliente_ori"=>$codigo_cliente_ori." ".$nombre_cliente_ori,
                                        "nosuma_fact"=>$nosuma_fact,
                                        "ubicacion_cliente_ori"=>$ubicacion_cliente_ori,
                                        "telefono_cliente_ori"=>$telefono_cliente_ori,
                                        "nombre_cliente_ori"=>$nombre_cliente_ori,
    
                                    );

                                }

                                
                            }

                            
                            /* ********* */
                            $agrupado = array();

                            foreach ($array_ubicacion as $ubicacion) {
                                $cliente_ori = $ubicacion["cliente_ori"];

                                $forma_pago = $ubicacion["forma_pago"];
                                $tipo_documento = $ubicacion["tipo_documento"];
                                $nombre_ubicacion = $ubicacion["nombre_ubicacion"];
                                $total = $ubicacion["total"];
                                $rubro = $ubicacion["rubro"];
                                // Creamos una estructura de datos anidada para organizar los datos.
                                if (!isset($agrupado[$rubro])) {
                                    $agrupado[$rubro] = array();
                                }
                                if (!isset($agrupado[$rubro][$cliente_ori])) {
                                    $agrupado[$rubro][$cliente_ori] = array();
                                }
                                /* if (!isset($agrupado[$rubro][$forma_pago])) {
                                    $agrupado[$rubro][$forma_pago] = array();
                                }
                                if (!isset($agrupado[$rubro][$forma_pago][$tipo_documento])) {
                                    $agrupado[$rubro][$forma_pago][$tipo_documento] = array();
                                } */

                                if (!isset($agrupado[$rubro][$cliente_ori][$nombre_ubicacion])) {
                                    $agrupado[$rubro][$cliente_ori][$nombre_ubicacion] = array(
                                        'codigo_ubicacion' => $ubicacion["codigo_ubicacion"],
                                        'total' => 0,
                                        'detalle' => array(),
                                    );
                                }


                                $agrupado[$rubro][$cliente_ori][$nombre_ubicacion]['detalle'][] = $ubicacion;
                                $agrupado[$rubro][$cliente_ori][$nombre_ubicacion]['total'] += $total;
                              
                            }
                            /* ********* */
                            $cuenta_empresas_global=0;
                            $cuenta_empleados_global=0;
                            $facturar_total_global=0;

                            $aut_empresa=0;
                            $fact_empresa=0;
                            $afact_empresa=0;
                            $total_empresa=0;

                            $conteo=0;
                            foreach ($agrupado as $rubro => $rubroData) {
                                /* ************************* clienteData */
                                
                                        $direccion="";
                                        $nombre="";
                                        $telefono="";
                                        $sector="";
                                        $precio=0;
                                foreach ($rubroData as $cliente_ori => $clienteData) {
                                    /* ************************* rubroData */
                                    $conteo++;

                                        /* este apartado se oculta porque no quieren ver las ubicaciones solo los clientes */
                                        foreach ($clienteData as $nombre_ubicacion => $ubicacionData) {
                                            /* ************************* ubicacionData */
                                            
                                            foreach ($ubicacionData['detalle'] as $ubicacion) {

                                                $direccion=$ubicacion["ubicacion_cliente_ori"];
                                                $telefono=$ubicacion["telefono_cliente_ori"];
                                                $sector=$ubicacion["rubro"];
                                                $precio+=floatval($ubicacion["precio"]);

                                                $html .= "<tr style='display:none'>";
                                                $html .= "<td >" . $ubicacion["codigo_ubicacion"] . "</td>";
                                                $html .= "<td >" . $ubicacion["nombre_ubicacion"] . "</td>";
                                                $html .= "<td >" . $ubicacion["aut"] . "</td>";
                                                $html .= "<td >" . $ubicacion["nosuma_fact"] . "</td>";
                                                $html .= "<td >" . $ubicacion["facturar"] . "</td>";
                                                $html .= "<td >?" . "</td>";
                                                $html .= "<td >" . $ubicacion["precio"] . "</td>";
                                                $html .= "<td >" . $ubicacion["total"] . "</td>";
                                                $html .= "</tr>";
                                                                    
                                                $aut_empresa+=$ubicacion["aut"];
                                                $fact_empresa+=$ubicacion["nosuma_fact"];
                                                $afact_empresa+=$ubicacion["facturar"];
                                                $total_empresa+=$ubicacion["total"];

                                                if($concepto_maestra=="Si"){
                                                    $html .= "<tr>";
                                                    $html .= "<td >" . "</td>";
                                                    $html .= "<td >" . $ubicacion["concepto"] . "</td>";
                                                    $html .= "<td >" . "</td>";
                                                    $html .= "<td >" . "</td>";
                                                    $html .= "<td >" . "</td>";
                                                    $html .= "<td >"  . "</td>";
                                                    $html .= "<td >" . "</td>";
                                                    $html .= "<td >" . "</td>";
                                                    $html .= "</tr>";
                                                }
                                                /* $cuenta_empresas_global=$ubicacion["cuenta"]; */
                                                $cuenta_empleados_global=$ubicacion["cuenta_empleados"];
                                            }
                                           
                                            $facturar_total_global+=bcdiv($ubicacion["total"],'1', 2);
                                            /* ************************* ubicacionData */
                                        }
                                        /* este apartado se oculta porque no quieren ver las ubicaciones solo los clientes */

                                        $cuenta_empresas_global++;
                                        $html .= "<tr>";
                                        $html .= "<td >" .$conteo. "</td>";
                                        $html .= "<td >" .$direccion. "</td>";
                                        $html .= "<td >" .$cliente_ori. "</td>";
                                        $html .= "<td >" .$sector. "</td>";
                                        $html .= "<td >" .$telefono. "</td>";
                                        $html .= "<td >"  .bcdiv($precio,'1', 2). "</td>";
                                        $html .= "<td >" .$total_empresa. "</td>";
                                        $html .= "<td >100%" . "</td>";
                                        $html .= "</tr>";

                                        $aut_empresa=0;
                                        $fact_empresa=0;
                                        $afact_empresa=0;
                                        $total_empresa=0;
                                        $precio=0;

                                    /* ************************* rubroData */
                                }
                                /* ************************* clienteData*/
                            }
                           
                            


                            $html .= "<tr>";
                            $html .= "<td >SON :  " . "</td>";
                            $html .= "<td >" . $cuenta_empresas_global . "</td>";
                            $html .= "<td >" ."</td>";
                            $html .= "<td >"  . "</td>";
                            $html .= "<td >"  . "</td>";
                            $html .= "<td >TOTAL GENERAL". "</td>";
                            $html .= "<td >" . $facturar_total_global."</td>";
                            $html .= "<td >" ."</td>";
                            $html .= "</tr>";
                            

                            if($sinfacturar=="Si"){
                                $cuenta_em_nofactu=0;
                                $data_sinfacturar=fun_sinfacturar();
                                foreach ($data_sinfacturar as $value) {
                                    $codigo_ubicacion=$value["codigo_ubicacion"];
                                    $nombre_ubicacion=$value["nombre_ubicacion"];

                                    $data_empleado=fun_tran_empleado($codigo_ubicacion);
                                    foreach ($data_empleado as $subvalue) {
                                        $cuenta_nofacturar=$subvalue["cuenta"];
                                        $cuenta_em_nofactu+=$cuenta_nofacturar;
                                            $html .= "<tr>";
                                            $html .= "<td >" . "</td>";
                                            $html .= "<td >" . $nombre_ubicacion . "</td>";
                                            $html .= "<td >" . $cuenta_nofacturar . "</td>";
                                            $html .= "<td >" . "</td>";
                                            $html .= "<td >" . "</td>";
                                            $html .= "<td >" . "</td>";
                                            $html .= "<td >" . "</td>";
                                            $html .= "<td >" ."</td>";
                                            $html .= "<td >" ."</td>";
                                            $html .= "</tr>";

                                    }
                                }
                                    $html .= "<tr>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >SIN FACTURAR" . "</td>";
                                    $html .= "<td >" . $cuenta_em_nofactu . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" ."</td>";
                                    $html .= "<td >" ."</td>";
                                    $html .= "</tr>";
                                    
                                    $html .= "<tr>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >TOTALES" . "</td>";
                                    $html .= "<td >" . $cuenta_em_nofactu . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" . "</td>";
                                    $html .= "<td >" ."</td>";
                                    $html .= "<td >" ."</td>";
                                    $html .= "</tr>";

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
            guardarComoArchivoTexto(contenidoTexto, 'REPORTE FACTURACION.txt');

                
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
        doc.save('REPORTE FACTURACION.pdf');
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
        XLSX.writeFile(wb, "REPORTE FACTURACION.xlsx");
       

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