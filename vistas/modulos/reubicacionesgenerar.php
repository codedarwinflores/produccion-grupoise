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

        
        function turnos_ubicacion_all() {
            $query = "SELECT*FROM tbl_ubicaciones_turnos";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function fun_aumentos($fecha_hasta) {
            $query = "SELECT*FROM aumentos_hombres
            WHERE fecha_aumentos<='$fecha_hasta' 
            group by fecha_aumentos
            order by id desc ";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_ubicacion($id) {
            $query = "SELECT*FROM tbl_clientes_ubicaciones
            WHERE id='$id' ";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_empleado($id) {
            $query = "SELECT*FROM tbl_empleados
            WHERE id='$id' ";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_empleado_contra() {
            $query = "SELECT count(*) as cuenta FROM tbl_empleados WHERE estado='2'";  
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function turnos_ubicacion($idubi) {
            $query = "SELECT*FROM tbl_ubicaciones_turnos where idubicacion=$idubi";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        
        function fun_asignados($fechahasta_formateada) {
            $query = "SELECT * FROM `transacciones_agente` where  STR_TO_DATE(fecha_transacciones_agente, '%d-%m-%Y') <= '$fechahasta_formateada' group by idagente_transacciones_agente order by id desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_autorizados($codigo_ubi,$fechahasta_formateada) {
            $query = "SELECT * FROM `aumentos_hombres` where codigo_ubicacion_aumento='$codigo_ubi' and STR_TO_DATE(fecha_aumento, '%d-%m-%Y') <='$fechahasta_formateada' group by codigo_ubicacion_aumento order by id desc";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_clientes($codigo_cliente) {
            $query = "SELECT * FROM `clientes` where codigo='$codigo_cliente' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        


        $fechaActual = date("d-m-Y"); 

        $fecha_hasta = $_POST["fecha_hasta"];
  
        $fechahasta = strtotime($fecha_hasta);
        $fechahasta_formateada = date("Y-m-d", $fechahasta); 

    /*     $fecha_desde = strtotime($fechadesde);
        $fecha_desde = date("Y-m-d", $fecha_desde);
        $fecha_hasta = strtotime($fechahasta);
        $fecha_hasta = date("Y-m-d", $fecha_hasta); */
     

        ?>     
      
       <div class="col-md-12" align="center">
        
      </div>

      <div class="col-md-12" align="center">

      
      </div>

      <input type="hidden" class="titulo_reportes" value="REPORTE UBICACIONES BOTON GENERAR">
        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th class="colspan"></th>
                        </tr>
                        <tr>
                            <th class="colspan">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V. </th>
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

                         /* 
                            */

                            $array_datos=[];
                            $data_maestra=turnos_ubicacion_all();
                            foreach ($data_maestra as $value) {
                              $idubicacion=$value["idubicacion"];

                              $data_ubi=fun_ubicacion($idubicacion);
                              foreach ($data_ubi as $subvalue) {
                               $idsupervisor=$subvalue["id_coordinador_zona"];
                               $codigo_ubicacion=$subvalue["codigo_ubicacion"];
                               $nombre_ubicacion=$subvalue["nombre_ubicacion"];
                               $codigo_cliente=$subvalue["codigo_cliente"];

                               $data_cliente=fun_clientes($codigo_cliente);
                               $nombre_cliente="";
                               foreach ($data_cliente as $val_cliente) {
                                $nombre_cliente=$val_cliente["nombre"];
                               }

                               $data_coordinador=fun_empleado($idsupervisor);
                               foreach ($data_coordinador as $val_coor) {
                                    $id_jefe=$val_coor["id_jefe_operaciones"];
                                    $nombre_coor=trim(trim($val_coor["primer_nombre"])." ".trim($val_coor["segundo_nombre"]).' '.trim($val_coor["tercer_nombre"]).' '.trim($val_coor["primer_apellido"]).' '.trim($val_coor["segundo_apellido"]).' '.trim($val_coor["apellido_casada"]));
                                    $nombre_coor = preg_replace('/\s+/', ' ', $nombre_coor);

                                    $data_jefe=fun_empleado($id_jefe);
                                    foreach ($data_jefe as $val_jefe) {
                                        $nombre_jefe=trim(trim($val_jefe["primer_nombre"])." ".trim($val_jefe["segundo_nombre"]).' '.trim($val_jefe["tercer_nombre"]).' '.trim($val_jefe["primer_apellido"]).' '.trim($val_jefe["segundo_apellido"]).' '.trim($val_jefe["apellido_casada"]));
                                        $nombre_jefe = preg_replace('/\s+/', ' ', $nombre_jefe);


                                        
                                        /* llenado array */
                                        $array_datos[]=array(
                                            "id_coor"=>$idsupervisor,
                                            "nombre_coor"=>$nombre_coor,
                                            "id_jefe"=>$id_jefe,
                                            "nombre_jefe"=>$nombre_jefe,
                                            "codigo_ubicacion"=>$codigo_ubicacion,
                                            "nombre_ubicacion"=>$nombre_ubicacion,
                                            "idubicacion"=>$idubicacion,
                                            "nombre_cliente"=>$nombre_cliente,
                                        );
                                    }/* fin jefe */
                               }/* fin coordinador */
                              }/* fin ubicacion */
                            }/* fin turnos */
                         

                            $agrupado = array();
                            foreach ($array_datos as $ubicacion) {
                                $jefe = $ubicacion["nombre_jefe"];
                                $nombre_coor = $ubicacion["nombre_coor"];

                                if (!isset($agrupado[$jefe])) {
                                    $agrupado[$jefe] = array();
                                }
                                if (!isset($agrupado[$jefe][$nombre_coor])) {
                                    $agrupado[$jefe][$nombre_coor] = array(
                                        'nombre_coor' => $nombre_coor,
                                        'detalle' => array(),
                                    );
                                }
                                $agrupado[$jefe][$nombre_coor]['detalle'][] = $ubicacion;

                            }
                       
                            $cuenta=1;
                            $vacante_global=0;
                            $personal_asignado_global=0;
                            $personal_contratado_global=0;

                            foreach ($agrupado as $jefe => $jefeData) {
                                $html .= "<tr>";
                                $html .= "<td class='colspan'>JEFE DE OPERACIONES :" . $jefe . "</td>";
                                $html .= "</tr>";

                                foreach ($jefeData as $nombre_coor => $coorData) {
                                    $html.="<tr>";
                                    $html.="<td class='colspan'>SUPERVISOR: ".$nombre_coor."</td>";
                                    $html.="</tr>";

                                    $html .= "<tr>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>UNIDAD DE SERVCIO"."</td>";
                                    $html .= "<td>ASIG."."</td>";
                                    $html .= "<td>AUT."."</td>";
                                    $html .= "<td>VACANTE"."</td>";
                                    $html .= "<td>24h/r"."</td>";
                                    $html .= "<td>12h/d5"."</td>";
                                    $html .= "<td>12h/d6"."</td>";
                                    $html .= "<td>12h/n6"."</td>";
                                    $html .= "<td>12h/d7"."</td>";
                                    $html .= "<td>12h/n7"."</td>";
                                    $html .= "<td>SEPTIMO"."</td>";
                                    $html .= "<td>T. PERIODICO"."</td>";
                                    $html .= "<td>COMODIN"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "</tr>";

                                    $total_asig=0;
                                    $total_auto=0;
                                    $total_vacante=0;
                                    $total_24hr=0;
                                    $total_12hde=0;
                                    $total_12hd6=0;
                                    $total_12hn6=0;
                                    $total_12hd7=0;
                                    $total_12hn7=0;
                                    $total_septimo=0;
                                    $total_extraordinario=0;
                                    $total_comodin=0;


                                    foreach ($coorData['detalle'] as $ubicacion) {

                                        
                                        $data_asigna=fun_asignados($fechahasta_formateada);
                                        $asig=0;
                                        foreach ($data_asigna as $val_asig) {
                                            $partes = explode("-", $val_asig["nueva_ubicacion_transacciones_agente"]);
                                            if($partes[0]==$ubicacion["codigo_ubicacion"]){
                                                $asig++;
                                            }
                                        }

                                        $data_auto=fun_autorizados($ubicacion["codigo_ubicacion"],$fechahasta_formateada);
                                        $auto=0;
                                        foreach ($data_auto as $val_auto) {
                                            $auto=$val_auto["actual_hombre"];
                                        }
                                       
                                        $vacante=$auto-$asig;
                                        
                                        $total_asig+=$asig;
                                        $total_auto+=$auto;
                                        $total_vacante+=$vacante;

                                        $html .= "<tr>";
                                        $html .= "<td>".$cuenta++."</td>";
                                        $html .= "<td>".$ubicacion["codigo_ubicacion"]." ".$ubicacion["nombre_ubicacion"]."</td>";
                                        $html .= "<td>".$asig."</td>";
                                        $html .= "<td>".$auto."</td>";
                                        $html .= "<td>".$vacante."</td>";
                                        $data_turnos=turnos_ubicacion($ubicacion["idubicacion"]);
                                        $comodin=0;
                                        foreach ($data_turnos as $val_turno_ubi) {
                                            $html .= "<td>".(!empty($val_turno_ubi["24hr"]) ? $val_turno_ubi["24hr"] : "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["12hde"]) ? $val_turno_ubi["12hde"]: "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["12hd6"]) ? $val_turno_ubi["12hd6"] : "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["12hn6"]) ? $val_turno_ubi["12hn6"] : "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["12hd7"]) ? $val_turno_ubi["12hd7"] : "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["12hn7"]) ? $val_turno_ubi["12hn7"] : "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["septimo"]) ? $val_turno_ubi["septimo"] : "0")."</td>";
                                            $html .= "<td>".(!empty($val_turno_ubi["extraordinario"]) ? $val_turno_ubi["extraordinario"] : "0")."</td>";
                                            $comodin=$val_turno_ubi["12hd7"]+$val_turno_ubi["12hd7"]-$val_turno_ubi["septimo"]+$val_turno_ubi["extraordinario"];

                                            $total_24hr+=(!empty($val_turno_ubi["24hr"]) ? $val_turno_ubi["24hr"] : "0");
                                            $total_12hde+=(!empty($val_turno_ubi["12hde"]) ? $val_turno_ubi["12hde"] : "0");
                                            $total_12hd6+=(!empty($val_turno_ubi["12hd6"]) ? $val_turno_ubi["12hd6"] : "0");
                                            $total_12hn6+=(!empty($val_turno_ubi["12hn6"]) ? $val_turno_ubi["12hn6"] : "0");
                                            $total_12hd7+=(!empty($val_turno_ubi["12hd7"]) ? $val_turno_ubi["12hd7"] : "0");
                                            $total_12hn7+=(!empty($val_turno_ubi["12hn7"]) ? $val_turno_ubi["12hn7"] : "0");
                                            $total_septimo+=(!empty($val_turno_ubi["septimo"]) ? $val_turno_ubi["septimo"] : "0");
                                            $total_extraordinario+=(!empty($val_turno_ubi["extraordinario"]) ? $val_turno_ubi["extraordinario"] : "0");
                                            $total_comodin+=$comodin;

                                        }
                                        $html .= "<td>".$comodin."</td>";
                                        $html .= "<td>".$ubicacion["nombre_cliente"]."</td>";
                                        $html .= "</tr>";
                                    }
                                    $cuenta=1;

                                    $vacante_global+=$total_vacante;
                                    $personal_asignado_global+=$total_asig;

                                    $html .= "<tr>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>AGENTES"."</td>";
                                    $html .= "<td>".$total_asig."</td>";
                                    $html .= "<td>".$total_auto."</td>";
                                    $html .= "<td>".$total_vacante."</td>";
                                    $html .= "<td>".$total_24hr."</td>";
                                    $html .= "<td>".$total_12hde."</td>";
                                    $html .= "<td>".$total_12hd6."</td>";
                                    $html .= "<td>".$total_12hn6."</td>";
                                    $html .= "<td>".$total_12hd7."</td>";
                                    $html .= "<td>".$total_12hn7."</td>";
                                    $html .= "<td>".$total_septimo."</td>";
                                    $html .= "<td>".$total_extraordinario."</td>";
                                    $html .= "<td>".$total_comodin."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "</tr>";

                                    $total_asig=0;
                                    $total_auto=0;
                                    $total_vacante=0;
                                    $total_24hr=0;
                                    $total_12hde=0;
                                    $total_12hd6=0;
                                    $total_12hn6=0;
                                    $total_12hd7=0;
                                    $total_12hn7=0;
                                    $total_septimo=0;
                                    $total_extraordinario=0;
                                    $total_comodin=0;

                                    
                                }
                            }
                            $data_contra=fun_empleado_contra();
                            $empleado_contra=0;
                            foreach ($data_contra as $value) {
                                $empleado_contra=$value["cuenta"];
                            }
                            $diferencia_global=$personal_asignado_global-$empleado_contra;
                                    $html .= "<tr>";
                                    $html .= "<td>COMODINES DE UNIDAD SUGERIDOS"."</td>";
                                    $html .= "<td>00"."</td>";
                                    $html .= "<td>VACANTES "."</td>";
                                    $html .= "<td>".$vacante_global."</td>";
                                    $html .= "<td>PERSONAL ASIGNADO "."</td>";
                                    $html .= "<td>".$personal_asignado_global."</td>";
                                    $html .= "<td>PERSONAL CONTRATADO "."</td>";
                                    $html .= "<td>".$empleado_contra."</td>";
                                    $html .= "<td>DIF."."</td>";
                                    $html .= "<td>".$diferencia_global."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "</tr>";

                                    $html .= "<tr>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td> "."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>COMODIN DE BASE"."</td>";
                                    $html .= "<td>0"."</td>";
                                    $html .= "<td>0 "."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "</tr>";

                                    $html .= "<tr>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td> "."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>COMODIN DE UNIDAD"."</td>";
                                    $html .= "<td>0"."</td>";
                                    $html .= "<td>0 "."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "<td>"."</td>";
                                    $html .= "</tr>";
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

        var titulo_reporte=$(".titulo_reportes").val();

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
                    /* aqui va el titulo si lo necesita solo descomente */
                    /*  textoTabla += strPad(" ", 15, ' ', 'center');
                    textoTabla += strPad(col0, 100, ' ', 'center')+"\n"; */

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
                    
                    textoTabla += strPad(col0, 1, ' ', 'right');
                    textoTabla += strPad(col1, 5, ' ', 'right');
                    textoTabla += strPad(col2, 20, ' ', 'right');
                    textoTabla += strPad(col3, 1, ' ', 'right');
                    textoTabla += strPad(col4, 20, ' ', 'right');
                    textoTabla += strPad(col5, 1, ' ', 'right');
                    textoTabla += strPad(col6, 20, ' ', 'right');
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
            guardarComoArchivoTexto(contenidoTexto, titulo_reporte+'.txt');

                
    });



    /* reporte pdf */
    $("#exportPDF").click(function () {
        /* pdf */
        var titulo_reporte=$(".titulo_reportes").val();

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
        doc.save(titulo_reporte+'.pdf');
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
    
        var titulo_reporte=$(".titulo_reportes").val();
        
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
        XLSX.writeFile(wb, titulo_reporte+".xlsx");
       

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