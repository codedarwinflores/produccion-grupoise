

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
        text-align: left;   
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

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

     <a href='todosreportes' class="btn btn-danger">
        Volver
      </a>
      
      <a href="ajax/BANCO DAVIVIENDA.txt" download="BANCO DAVIVIENDA.txt" id="descargar_txt" ></a>
      <a href="ajax/Planilla no contable.pdf" download="Planilla no contable.pdf" id="descargar_pdf" ></a>
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
                 <!-- <button id="exportExcel" class="dropdown-item btn btn-success btnreporte" style="display:none">Exportar a Excel</button> -->
                 <button id="exportTXT" class="dropdown-item btn btn-info btnreporte" style="display:none">Exportar a TXT</button>
                <!--  <button id="exportPDF" class="dropdown-item btn btn-warning btnreporte" style="display:none">Exportar a PDF</button> -->
            </div>
        </div>
       </div>
      <!--  -->
      <p class="cargareporte" style="color: red;">GENERANDO REPORTE</p>

      <!-- *********************** -->

      <?php
      $numero=$_POST["numero"];
      $banco_value=$_POST["banco"];
      /* nuevos */
      $ubicacion=$_POST["ubicacion"];
      $tipo_empleado=$_POST["tipo_empleado"];
      
 
      /* **************************************** */
      $tipoplanilla=$_POST["tipo_planilla"];
      $devengos_table_maestra=$_POST["devengos_table"];

      $cambio_table="";
      if($tipoplanilla=="planilladevengo_anticipo"){
        $cambio_table="_anticipo";
      }
      else if($tipoplanilla=="planilladevengo_vacacion"){
        $cambio_table="_vacacion";
      }
      else if($tipoplanilla=="planilladevengo_aguinaldo"){
        $cambio_table="_aguinaldo";
      }
      else if($tipoplanilla=="planilladevengo_gratifivaca"){
        $cambio_table="_gratifivaca";
      }
      else if($tipoplanilla=="planilladevengo_admin"){
        $cambio_table="_admin";
      }
        /* *******CUERPO***** */
        function situacion() {
            $query = "SELECT sum(hora_extra_situacion) as sumahoraextra FROM `situacion` where numero_planilla_admin!='' and hora_extra_situacion!=''";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin($numero,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo".$cambio_table."` where  numero_planilladevengo".$cambio_table."='$numero'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function planilla_admin_data($numero,$cambio_table) {
            $query = "SELECT * FROM `planilladevengo".$cambio_table."` where numero_planilladevengo".$cambio_table."='$numero' limit 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function empleado($id,$idbando1) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id and id_banco=$idbando1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        /* solo tipo empleado */
        function empleado_tipo($id,$idbando1,$tipo) {
            $query = "SELECT * FROM `tbl_empleados` where id=$id and id_banco=$idbando1 and tipo_empleado='$tipo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo ubicacion */
        function empleado_ubi($codigo,$idubicacion,$idbando1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                              codigo_agente='$codigo' and 
                              tbl_empleados.id_banco=$idbando1 and
                              clientes.id='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /*  ubicacion y tipo empleado */
        function empleado_ubi_tipo($codigo,$idubicacion,$tipo_empleado1,$idbando1) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* 
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados, clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                              codigo_agente='$codigo' and 
                              tbl_empleados.tipo_empleado='$tipo_empleado1' and 
                              tbl_empleados.id_banco=$idbando1 and
                              clientes.id='$idubicacion'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        /* solo toma el nombre de la ubicacion */
        function empleado_ubi_only($idubicacion) {
            $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.*, tbl_empleados.* ,clientes.*
                      FROM tbl_clientes_ubicaciones,`tbl_ubicaciones_agentes_asignados`,tbl_empleados,clientes
                      where  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and 
                             codigo_agente=tbl_empleados.codigo_empleado and
                             tbl_clientes_ubicaciones.id_cliente=clientes.id and
                            clientes.id='$idubicacion' limit 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function banco($id1) {
            $query = "SELECT* FROM bancos where  id='$id1'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function devengos($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  idempleado_devengo='$idempleado1' and codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='No' and afp_devengo_devengo_descuento_planilla='No' and renta_devengo_devengo_descuento_planilla='No' and tipo_valor like'%suma%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function devengos_contodo($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) as sumadevengo FROM tbl_devengo_descuento_planilla".$devengos_table_maestra." where  idempleado_devengo='$idempleado1' and (codigo_planilla_devengo='$numero' and isss_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and afp_devengo_devengo_descuento_planilla='Si') or (codigo_planilla_devengo='$numero' and renta_devengo_devengo_descuento_planilla='Si') and tipo_valor like'%suma%'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        ?>     
        <?php
          $data_planilla_admin_data = planilla_admin_data($numero,$cambio_table);
          $numero_planilla="";
          $fecha_planilla_desde="";
          $fecha_planilla_hasta="";
          foreach($data_planilla_admin_data as $row_data_planilla_admin_data) {
              $numero_planilla.=$row_data_planilla_admin_data["numero_planilladevengo".$cambio_table.""];
              $fecha_planilla_desde.=$row_data_planilla_admin_data["fecha_desde_planilladevengo".$cambio_table.""];
              $fecha_planilla_hasta.=$row_data_planilla_admin_data["fecha_hasta_planilladevengo".$cambio_table.""];
          }
        ?>
         <?php
          $data_banco = banco($banco_value);
          $nombre_banco="";
          foreach($data_banco as $row_banco) {
              $nombre_banco.=$row_banco["nombre"];
          }
        ?>

      <div class="col-md-12" align="center">
        <h4>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</h4>
        <h5> Fecha: <?php echo $fecha_planilla_hasta?></h5>
        <h5> PLANILLA No. <?php echo $numero_planilla?></h5>
        <h5> PLANILLA ADMINISTRATIVA DEL <?php echo $fecha_planilla_desde." AL ".$fecha_planilla_hasta?></h5>
        <h5> FORMATO  <?php echo $nombre_banco?></h5>

      </div>

      <?php
       if($ubicacion!="*"){
        $dataubicacion = empleado_ubi_only($ubicacion);
          foreach($dataubicacion as $row) {
            echo "<h4 align='center'>".$row["nombre"]."</h4>";
          }
        }
      ?>
        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <tbody>
                    <?php
                        $cuenta=0;
                        $data_planilla_admin = planilla_admin($numero,$cambio_table);
                        $depositar_global=0;
                        $efectivo_global=0;
                        $administrativa_global=0;
                        $devengos_global=0;
                        $total_global=0;
                        $referencia_global=0;
                        $correlativo=0;
                        foreach($data_planilla_admin as $row_data_planilla_admin) {
                            $id=$row_data_planilla_admin["id"];
                            $idempleado=$row_data_planilla_admin["id_empleado_planilladevengo".$cambio_table.""];
                            $codigo=$row_data_planilla_admin["codigo_empleado_planilladevengo".$cambio_table.""];
                    ?>                
                                <?php

                                 $data_empleado = empleado($idempleado,$banco_value);
                                 if($ubicacion!="*" && $tipo_empleado=='*'){
                                    $data_empleado=empleado_ubi($codigo,$ubicacion,$banco_value);
                                    
                                 }
                                 else if($tipo_empleado!="*" && $ubicacion=='*'){
                                    $data_empleado = empleado_tipo($idempleado,$banco_value,$tipo_empleado);
                                   

                                }
                                 else if($ubicacion!="*" && $tipo_empleado!="*"){
                                    $data_empleado=empleado_ubi_tipo($codigo,$ubicacion,$tipo_empleado,$banco_value);
                                    

                                 }
                                 else if($ubicacion=="*" && $tipo_empleado=="*"){
                                     $data_empleado = empleado($idempleado,$banco_value);
                                 }

                                 $codigo_empleado="";
                                 foreach($data_empleado as $row_empleado) {
                                     $correlativo++;
                                     $nombre_empleado=$row_empleado["primer_apellido"]." ".$row_empleado["segundo_apellido"]." ".$row_empleado["apellido_casada"]." ".$row_empleado["primer_nombre"]." ".$row_empleado["segundo_nombre"]." ".$row_empleado["tercer_nombre"];

                                ?>
                                <tr>
                                         <!-- cuenta -->
                                        <td><?php echo trim($row_empleado["numero_cuenta"]).""?></td>
                                        <!-- NOMBRE EMPLEADO -->
                                        <td><?php echo ",".trim($nombre_empleado).""?></td>
                                        <!-- coma -->
                                        <td>,</td>
                                         <!-- a depositar -->
                                        <td>
                                             <?php 
                                                $data_devengo=devengos_contodo($idempleado,$numero,$devengos_table_maestra);
                                                $valodevengo_grabado=0;
                                                foreach($data_devengo as $row_devengo) {
                                                    $valodevengo_grabado=floatval($row_devengo["sumadevengo"]);
                                                }
                                                $sumagrabado=floatval($row_data_planilla_admin["total_liquidado_planilladevengo".$cambio_table.""]);
                                                $total_global+=bcdiv($sumagrabado,'1', 2);
                                                echo  "".trim(bcdiv($sumagrabado,'1', 2))."";
                                             ?>
                                       </td>
                                        <!-- PLANILLA -->
                                        <td>
                                            <?php
                                            $nombre_mes = date("F", strtotime($fecha_planilla_hasta));
                                            // Traducir el nombre del mes al español
                                                $meses_ingles = array(
                                                    'January', 'February', 'March', 'April',
                                                    'May', 'June', 'July', 'August',
                                                    'September', 'October', 'November', 'December'
                                                );
                                                $meses_espanol = array(
                                                    'ENERO', 'FEBRERO', 'MARZO', 'ABRIL',
                                                    'MAYO', 'JUNIO', 'JULIO', 'AGOSTO',
                                                    'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
                                                );


                                            $nombre_mes = str_replace($meses_ingles, $meses_espanol, $nombre_mes);
                                            echo ","."PLANILLA ADMINISTRATIVA DEL ". $fecha_planilla_desde." AL ".$fecha_planilla_hasta

                                            ?>
                                        </td>
                                       <!-- administratica -->
                                    </tr>

                                <?php
                                 }
                                ?>
                               
                    <?php
                        }
                    ?>
                   <tr>
                        <td></td>
                        <td style="text-align:end"><?php echo trim(bcdiv($total_global,'1', 2))."  SON "." ".$correlativo." EMPLEADOS";?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            </tbody>
          </table>
        </div> 

      <!-- ************************ -->

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
        // Obtener los títulos de la tabla
        

        // Obtener los datos de la tabla
        var data = [];
        $("#tabladatos tbody tr").each(function () {
            var rowData = [];
            $(this).find("td").each(function () {
                rowData.push($(this).text());
            });
            data.push(rowData);
        });
        // Enviar los títulos y datos mediante AJAX TXT
        $.ajax({
            type: "POST",
            url: "ajax/pdf_txt_depodavi.php", // Cambia esto por la URL del script PHP en tu servidor
            data: { tableData: data },
            success: function (response) {
         
                /* window.open("ajax/No_contable.txt", "_blank"); */

                   // Trigger the download by simulating a click
                    var downloadUrl = $("#descargar_txt").attr("href");
                    var fileName = $("#descargar_txt").attr("download");
                    downloadFile(downloadUrl, fileName);

            }
        });
    });


    
    /* reporte pdf */
    $("#exportPDF").click(function () {
        /* pdf */
        var tablaHtml = $("#tabladatos").prop("outerHTML");
        
	 $('.modal_carga').modal({backdrop: 'static', keyboard: false});
     $(".modal_carga").modal("show");
    
        $.ajax({
            url: "ajax/pdf_txt_nocontable.php", // Cambia esto por la URL del script PHP en tu servidor
            type: "POST",
            data: { tabla: tablaHtml }, // Datos a enviar
            success: function (response) {
                
                   // Trigger the download by simulating a click
                    var downloadUrl = $("#descargar_pdf").attr("href");
                    var fileName = $("#descargar_pdf").attr("download");
                    downloadFile(downloadUrl, fileName);
                    
                    $('.modal_carga').modal({backdrop: 'static', keyboard: true});
                    $('.modal_carga').modal('hide');


            }
        });
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
</script>