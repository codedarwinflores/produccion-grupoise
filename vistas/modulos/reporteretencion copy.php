

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
    
        width: 100%;
        overflow-x: auto;
        height: 350px;
        overflow-y: auto;
    }
    table {
    border-spacing: 0;
    border-collapse: collapse;
    width: 100%;
    margin: 0px auto;
    }
 
    td, th {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: center;   
        min-width: 90px;
    }
    .nombre_emple{
        min-width: 500px;
    }
    .nit_emple{
        min-width: 200px;
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
        function fun_depa_empresa() {
            $query = "SELECT * FROM departamentos_empresa ORDER BY id ASC limit 1";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_planilla_admin($fecha_desde,$fecha_hasta) {
            $query = "SELECT sum(total_devengo_admin_planilladevengo_admin) as totaldevengado,
                             sum(total_liquidado_planilladevengo_admin) as totalliquidoanio, 
                             sum(descuento_renta_planilladevengo_admin) as totalrenta, 
                             planilladevengo_admin.* FROM planilladevengo_admin where STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y')  group by id_empleado_planilladevengo_admin";
           
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_planilla_admin_afp($idempleado,$codigo_afp) {
            $query = "SELECT sum(descuento_isss_planilladevengo_admin) as totalisss,
                             sum(descuento_afp_planilladevengo_admin) as totalafp,
                             planilladevengo_admin.* FROM planilladevengo_admin, tbl_empleados 
                             where tbl_empleados.id=planilladevengo_admin.id_empleado_planilladevengo_admin and
                             tbl_empleados.id=$idempleado and 
                             tbl_empleados.codigo_afp='$codigo_afp'
                               group by id_empleado_planilladevengo_admin ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        function fun_planilla_admin_isss($idempleado) {
            $query = "SELECT sum(descuento_isss_planilladevengo_admin) as totalisss,
                             sum(descuento_afp_planilladevengo_admin) as totalafp,
                             planilladevengo_admin.* FROM planilladevengo_admin, tbl_empleados 
                             where tbl_empleados.id=planilladevengo_admin.id_empleado_planilladevengo_admin and
                             tbl_empleados.id=$idempleado 
                               group by id_empleado_planilladevengo_admin ";
           
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        function fun_empleados($idempleado, $iddepa) {
            $query = "SELECT * FROM tbl_empleados where id=$idempleado and id_departamento_empresa=$iddepa";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };


        function fun_planilla_admin_devengos($fecha_desde,$fecha_hasta,$mes,$empleado) {
            $query = "SELECT MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) as mes, planilladevengo_admin.* FROM planilladevengo_admin where id_empleado_planilladevengo_admin='$empleado' and MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) = $mes order by id_empleado_planilladevengo_admin";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };
        $devengos_table_maestra="_admin";
        function devengos_contodo($idempleado1,$numero,$devengos_table_maestra) {
            $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo
            FROM tbl_devengo_descuento_planilla$devengos_table_maestra
            WHERE
                idempleado_devengo = '$idempleado1'
                AND (
                    (codigo_planilla_devengo='$numero' AND isss_devengo_devengo_descuento_planilla = 'Si')
                    OR
                    (codigo_planilla_devengo='$numero' AND afp_devengo_devengo_descuento_planilla = 'Si')
                    OR
                    (codigo_planilla_devengo='$numero' AND renta_devengo_devengo_descuento_planilla = 'Si')
                )
                AND tipo_valor LIKE '%suma%'
            GROUP BY idempleado_devengo";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        
       


        $fechaActual = date("Y-m-d"); 
        $anioActual = date("Y"); 

        $fecha_desde = $_POST["fecha_desde"];
        $fecha_hasta = $_POST["fecha_hasta"];

        $colspan="47";

        /* $armatipo="";
        if($equipos!="*"){

            $equipostipo="WHERE id=".$equipos."";
        }
        else{
            $equipos="";
        } */
    

        ?>     
      
       <div class="col-md-12" align="center">
        
      </div>

      <div class="col-md-12" align="center">

      
      </div>

      <?php
        function saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,$mes,$empleado){
            $datos_agrupados = array();
            $datos_empleado = [];
            $data_planilla_devengos=fun_planilla_admin_devengos($fecha_desde,$fecha_hasta,$mes,$empleado);
            $valor_gravado_mes=0;
            foreach ($data_planilla_devengos as  $val_pla) {
                /* datos del array */
                $idempleado1=$val_pla["id_empleado_planilladevengo_admin"];
                $mes=$val_pla["mes"];
                $valorrenta=$val_pla["descuento_renta_planilladevengo_admin"];
                $valorafp=$val_pla["descuento_afp_planilladevengo_admin"];
                $valor_devengo=0;
                /* -------------- */
                $numero=$val_pla["numero_planilladevengo_admin"];
                $data_devengo=devengos_contodo($idempleado1,$numero,$devengos_table_maestra);
                foreach ($data_devengo as $val_devengo) {
                    # code...
                    /* datos del array */
                    $valor_devengo=floatval($val_devengo["sumadevengo"]);
                    /* ***** */
                }
                $valor_devengo=$valor_devengo+floatval($val_pla["sueldo_planilladevengo_admin"]);
                $datos_empleado[] = ["empleado" => $idempleado1, "mes" => $mes, "valor" => $valor_devengo, "renta" => $valorrenta, "afp" => $valorafp];
              /*   echo "empleado" . $idempleado1. "mes" . $mes."valor" . $valor_devengo."renta". $valorrenta."afp".$valorafp."<br>"; */
            }
            foreach ($datos_empleado as $dato) {
                    $empleado = $dato["empleado"];
                    $valor = floatval($dato["valor"]);
                    $valorrenta = floatval($dato["renta"]);
                    $valorafp = floatval($dato["afp"]);
                    // Si el empleado no existe en el array de datos agrupados, lo inicializamos
                    if (!isset($datos_agrupados[$empleado])) {
                        $datos_agrupados[$empleado] = array(
                            "total_valor" => 0, // Inicializamos el valor total en cero
                            "total_renta" => 0, // Inicializamos el valor total en cero
                            "total_afp" => 0, // Inicializamos el valor total en cero
                            "detalle" => array() // Inicializamos un array para almacenar el detalle
                        );
                    }
                    // Agregamos el valor al total del empleado
                    $datos_agrupados[$empleado]["total_valor"] += $valor;
                    $datos_agrupados[$empleado]["total_renta"] += $valorrenta;
                    $datos_agrupados[$empleado]["total_afp"] += $valorafp;
                    // Agregamos el detalle al array del empleado correspondiente
                    $datos_agrupados[$empleado]["detalle"][] = array(
                        "mes" => $dato["mes"],
                        "valor" => $valor
                    );
            }
            return $datos_agrupados;
        }

        /* CODIGO EJEMPLO */
        /* $datos_saldo_mes=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,8,'7');
        foreach ($datos_saldo_mes as $empleado => $datos) {
            echo "Empleado: " . $empleado . "<br>";
            foreach ($datos["detalle"] as $detalle) {
                echo "Mes: " . $detalle["mes"] . ", Valor: " . $detalle["valor"] . "<br>";
            }
            
            echo "Valor Total: " . $datos["total_valor"] . "<br>";
            echo "Valor renta: " . $datos["total_renta"] . "<br>";
            echo "Valor afp: " . $datos["total_afp"] . "<br>";
            echo "<br>";
             
        } */
    

      ?>
        
      <div class="table-responsive">
                <table  class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tabladatos">
                    <thead>
                        <tr>
                            <th colspan="<?php echo $colspan;?>">INVESTIGACIONES Y SEGURIDAD, S.A. DE C.V.</th>
                        </tr>
                        <tr>
                            <th colspan="<?php echo $colspan;?>">CONSOLIDADO RETENCIONES </th>
                        </tr>
                        <tr>
                            <th colspan="<?php echo $colspan;?>"><?php echo $fecha_desde." / ".$fecha_hasta?></th>
                        </tr>
                        <tr>
                            <th colspan="<?php echo $colspan;?>"></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            /*  maestro */
                            $html="";
                            $html.="<tr>";
                            $html.="<td> "."</td>";
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
                            /* ******** */
                            $html.="<td>-----"."</td>";
                            $html.="<td>ENE "."</td>";
                            $html.="<td>-----"."</td>";
                             /* ******** */
                             $html.="<td>-----"."</td>";
                             $html.="<td>FEB "."</td>";
                             $html.="<td>-----"."</td>";
                              /* ******** */
                              $html.="<td>-----"."</td>";
                              $html.="<td>MAR "."</td>";
                              $html.="<td>-----"."</td>";

                             /* ******** */
                              $html.="<td>-----"."</td>";
                              $html.="<td>ABR "."</td>";
                              $html.="<td>-----"."</td>";

                               /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>MAY "."</td>";
                               $html.="<td>-----"."</td>";

                                /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>JUN "."</td>";
                               $html.="<td>-----"."</td>";

                               /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>JUL "."</td>";
                               $html.="<td>-----"."</td>";

                               /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>AGO "."</td>";
                               $html.="<td>-----"."</td>";

                               /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>SEP "."</td>";
                               $html.="<td>-----"."</td>";

                               /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>OCT "."</td>";
                               $html.="<td>-----"."</td>";

                               /* ******** */
                               $html.="<td>-----"."</td>";
                               $html.="<td>NOV "."</td>";
                               $html.="<td>-----"."</td>";

                                /* ******** */
                                $html.="<td>-----"."</td>";
                                $html.="<td>DIC "."</td>";
                                $html.="<td>-----"."</td>";
                                /* ****** */
                            $html.="<td>"."</td>";
                            $html.="<td>"."</td>";
                            $html.="</tr>";

                            $html.="<tr>";
                            $html.="<td>CODIGO "."</td>";
                            $html.="<td class='nombre_emple'>NOMBRES"."</td>";
                            $html.="<td class='nit_emple'>NIT"."</td>";
                            $html.="<td>DEVENGADO"."</td>";
                            $html.="<td>RENTA  "."</td>";
                            $html.="<td>AGUINALDO EXENTO"."</td>";
                            $html.="<td>AGUINALDO GRAVADO"."</td>";
                            $html.="<td>ISSS"."</td>";
                            $html.="<td>AFP"."</td>";
                            $html.="<td>IPSFA"."</td>";
                            $html.="<td> BIENESTAR MAGISTERIAL"."</td>";
                            /* enero */
                            $html.="<td>GRAVADO"."</td>";
                            $html.="<td>RENTA"."</td>";
                            $html.="<td>AFP"."</td>";
                             /* febrero */
                             $html.="<td>GRAVADO"."</td>";
                             $html.="<td>RENTA"."</td>";
                             $html.="<td>AFP"."</td>";
                              /* mar */
                              $html.="<td>GRAVADO"."</td>";
                              $html.="<td>RENTA"."</td>";
                              $html.="<td>AFP"."</td>";
                               /* abril */
                             $html.="<td>GRAVADO"."</td>";
                             $html.="<td>RENTA"."</td>";
                             $html.="<td>AFP"."</td>";
                              /* mayo */
                              $html.="<td>GRAVADO"."</td>";
                              $html.="<td>RENTA"."</td>";
                              $html.="<td>AFP"."</td>";
                               /* junio */
                             $html.="<td>GRAVADO"."</td>";
                             $html.="<td>RENTA"."</td>";
                             $html.="<td>AFP"."</td>";
                              /* julio */
                              $html.="<td>GRAVADO"."</td>";
                              $html.="<td>RENTA"."</td>";
                              $html.="<td>AFP"."</td>";
                               /* agosto */
                             $html.="<td>GRAVADO"."</td>";
                             $html.="<td>RENTA"."</td>";
                             $html.="<td>AFP"."</td>";
                              /* sep */
                              $html.="<td>GRAVADO"."</td>";
                              $html.="<td>RENTA"."</td>";
                              $html.="<td>AFP"."</td>";
                              /* octu */
                              $html.="<td>GRAVADO"."</td>";
                              $html.="<td>RENTA"."</td>";
                              $html.="<td>AFP"."</td>";
                               /* nov */
                             $html.="<td>GRAVADO"."</td>";
                             $html.="<td>RENTA"."</td>";
                             $html.="<td>AFP"."</td>";
                              /* dici */
                              $html.="<td>GRAVADO"."</td>";
                              $html.="<td>RENTA"."</td>";
                              $html.="<td>AFP"."</td>";
                              /* ***** */
                              $html.="<td>DUI"."</td>";
                              $html.="<td>A O"."</td>";

                            $html.="</tr>";

                            $data_maestra=fun_depa_empresa();
                            foreach ($data_maestra as $val_maestra) {

                                $id_depa=$val_maestra["id"];

                                $html.="<tr>";
                                    $html.="<td colspan='".$colspan."'>DEPARTAMENTO :".$val_maestra["nombre"]."</td>";
                                $html.="</tr>";

                                $data_planilla_admin=fun_planilla_admin($fecha_desde,$fecha_hasta);
                                foreach ($data_planilla_admin as $val_pla_admin) {
                                    $idempleado_admin=$val_pla_admin["id_empleado_planilladevengo_admin"];
                                    $totalliquidoanio=floatval($val_pla_admin["totalliquidoanio"]);
                                    $totaldevengado=floatval($val_pla_admin["totaldevengado"]);
                                    $totalrenta=floatval($val_pla_admin["totalrenta"]);
                                    

                                    $data_empleados=fun_empleados($idempleado_admin,$id_depa);
                                    foreach ($data_empleados as $val_empleado) {
                                                
                                                                
                                            $nombre_cargo=trim(trim($val_empleado["primer_nombre"])." ".trim($val_empleado["segundo_nombre"]).' '.trim($val_empleado["tercer_nombre"]));
                                            $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                            $apellidos=trim(trim($val_empleado["primer_apellido"]).' '.trim($val_empleado["segundo_apellido"]).' '.trim($val_empleado["apellido_casada"]));
                                            $apellidos = preg_replace('/\s+/', ' ', $apellidos);

                                            $codigo_afp=$val_empleado["codigo_afp"];
                                            $data_isss=fun_planilla_admin_isss($idempleado_admin);
                                            $valor_isss=0;
                                            foreach ($data_isss as $val_isss) {
                                                $valor_isss=floatval($val_isss["totalisss"]);
                                            }

                                            if($codigo_afp=="0002"){
                                                $codigo_afp="0002";
                                            }
                                            else if($codigo_afp=="0001"){
                                                $codigo_afp="0001";
                                            }
                                            else if($codigo_afp=="0003"){
                                                $codigo_afp="0003";
                                            }
                                            
                                            $data_afp=fun_planilla_admin_afp($idempleado_admin,$codigo_afp);
                                            $valor_afp=0;
                                            $valor_crecer_confia=0;
                                            $valor_ipsa=0;
                                            foreach ($data_afp as $val_afp) {
                                                $valor_afp=floatval($val_afp["totalafp"]);
                                            }
                                            if($codigo_afp=="0001" || $codigo_afp=="0002"){
                                                $valor_crecer_confia=$valor_afp;
                                            }
                                            else if($codigo_afp=="0003"){
                                                $valor_ipsa=$valor_afp;
                                            }


                                            /* ---------ENERO------------ */

                                            $datos_saldo_mes=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,1,$idempleado_admin);
                                            $total_gravado_enero=0;
                                            $total_renta_enero=0;
                                            $total_afp_enero=0;
                                            foreach ($datos_saldo_mes as $empleado => $datos) {
                                               
                                                $total_gravado_enero=$datos["total_valor"];
                                                $total_renta_enero=$datos["total_renta"];
                                                $total_afp_enero=$datos["total_afp"];
                                              
                                                
                                            }
                                            /* ----------------- */
                                            /* ---------fecbrero------------ */
                                            $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,2,$idempleado_admin);
                                            $total_gravado_febrero=0;
                                            $total_renta_febrero=0;
                                            $total_afp_febrero=0;
                                            foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                $total_gravado_febrero=$datos["total_valor"];
                                                $total_renta_febrero=$datos["total_renta"];
                                                $total_afp_febrero=$datos["total_afp"];
                                            }
                                            /* ----------------- */

                                             /* ---------marzo------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,3,$idempleado_admin);
                                             $total_gravado_mar=0;
                                             $total_renta_mar=0;
                                             $total_afp_mar=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_mar=$datos["total_valor"];
                                                 $total_renta_mar=$datos["total_renta"];
                                                 $total_afp_mar=$datos["total_afp"];
                                             }
                                             /* ----------------- */

                                             /* ---------abril------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,4,$idempleado_admin);
                                             $total_gravado_abril=0;
                                             $total_renta_abril=0;
                                             $total_afp_abril=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_abril=$datos["total_valor"];
                                                 $total_renta_abril=$datos["total_renta"];
                                                 $total_afp_abril=$datos["total_afp"];
                                             }
                                             /* ----------------- */

                                             /* ---------mayo------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,5,$idempleado_admin);
                                             $total_gravado_mayo=0;
                                             $total_renta_mayo=0;
                                             $total_afp_mayo=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_mayo=$datos["total_valor"];
                                                 $total_renta_mayo=$datos["total_renta"];
                                                 $total_afp_mayo=$datos["total_afp"];
                                             }
                                             /* ----------------- */

                                              /* ---------junio------------ */
                                              $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,6,$idempleado_admin);
                                              $total_gravado_junio=0;
                                              $total_renta_junio=0;
                                              $total_afp_junio=0;
                                              foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                  $total_gravado_junio=$datos["total_valor"];
                                                  $total_renta_junio=$datos["total_renta"];
                                                  $total_afp_junio=$datos["total_afp"];
                                              }
                                              /* ----------------- */

                                              /* ---------julio------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,7,$idempleado_admin);
                                             $total_gravado_julio=0;
                                             $total_renta_julio=0;
                                             $total_afp_julio=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_julio=$datos["total_valor"];
                                                 $total_renta_julio=$datos["total_renta"];
                                                 $total_afp_julio=$datos["total_afp"];
                                             }
                                             /* ----------------- */

                                             /* ---------agos------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,8,$idempleado_admin);
                                             $total_gravado_agos=0;
                                             $total_renta_agos=0;
                                             $total_afp_agos=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_agos=$datos["total_valor"];
                                                 $total_renta_agos=$datos["total_renta"];
                                                 $total_afp_agos=$datos["total_afp"];
                                             }
                                             /* ----------------- */
                                            /* ---------sep------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,9,$idempleado_admin);
                                             $total_gravado_sep=0;
                                             $total_renta_sep=0;
                                             $total_afp_sep=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_sep=$datos["total_valor"];
                                                 $total_renta_sep=$datos["total_renta"];
                                                 $total_afp_sep=$datos["total_afp"];
                                             }
                                             /* ----------------- */
                                            /* ---------octu------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,10,$idempleado_admin);
                                             $total_gravado_octu=0;
                                             $total_renta_octu=0;
                                             $total_afp_octu=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_octu=$datos["total_valor"];
                                                 $total_renta_octu=$datos["total_renta"];
                                                 $total_afp_octu=$datos["total_afp"];
                                             }
                                             /* ----------------- */
                                             
                                             /* ---------nov------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,11,$idempleado_admin);
                                             $total_gravado_nov=0;
                                             $total_renta_nov=0;
                                             $total_afp_nov=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_nov=$datos["total_valor"];
                                                 $total_renta_nov=$datos["total_renta"];
                                                 $total_afp_nov=$datos["total_afp"];
                                             }
                                             /* ----------------- */

                                             /* ---------dic------------ */
                                             $datos_saldo_mes2=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,12,$idempleado_admin);
                                             $total_gravado_dic=0;
                                             $total_renta_dic=0;
                                             $total_afp_dic=0;
                                             foreach ($datos_saldo_mes2 as $empleado => $datos) {
                                                 $total_gravado_dic=$datos["total_valor"];
                                                 $total_renta_dic=$datos["total_renta"];
                                                 $total_afp_dic=$datos["total_afp"];
                                             }
                                             /* ----------------- */

                                            $html.="<tr>";
                                            $html.="<td>".$val_empleado["codigo_empleado"]."</td>";
                                            $html.="<td>".$apellidos." ".$nombre_cargo."</td>";
                                            $html.="<td>".$val_empleado["nit"]."</td>";
                                            $html.="<td>".$totaldevengado."</td>";
                                            $html.="<td>".$totalrenta."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>".$valor_isss."</td>";
                                            $html.="<td>".$valor_crecer_confia."</td>";
                                            $html.="<td>".$valor_ipsa."</td>";
                                            $html.="<td>0.00"."</td>";
                                            /* 3 enero */
                                            $html.="<td>".$total_gravado_enero."</td>";
                                            $html.="<td>".$total_renta_enero."</td>";
                                            $html.="<td>".$total_afp_enero."</td>";
                                             /* 3 febrero */
                                             $html.="<td>".$total_gravado_febrero."</td>";
                                             $html.="<td>".$total_renta_mar."</td>";
                                             $html.="<td>".$total_afp_febrero."</td>";
                                             /* 3 marzo */
                                             $html.="<td>".$total_gravado_mar."</td>";
                                             $html.="<td>".$total_renta_febrero."</td>";
                                             $html.="<td>".$total_afp_mar."</td>";

                                             /* 3 abril */
                                             $html.="<td>".$total_gravado_abril."</td>";
                                             $html.="<td>".$total_renta_abril."</td>";
                                             $html.="<td>".$total_afp_abril."</td>";

                                              /* 3 mayo */
                                              $html.="<td>".$total_gravado_mayo."</td>";
                                              $html.="<td>".$total_renta_mayo."</td>";
                                              $html.="<td>".$total_afp_mayo."</td>";

                                              /* 3 junio */
                                              $html.="<td>".$total_gravado_junio."</td>";
                                              $html.="<td>".$total_renta_junio."</td>";
                                              $html.="<td>".$total_afp_junio."</td>";

                                              /* 3 julio */
                                              $html.="<td>".$total_gravado_julio."</td>";
                                              $html.="<td>".$total_renta_julio."</td>";
                                              $html.="<td>".$total_afp_julio."</td>";


                                              /* 3 agos */
                                              $html.="<td>".$total_gravado_agos."</td>";
                                              $html.="<td>".$total_renta_agos."</td>";
                                              $html.="<td>".$total_afp_agos."</td>";

                                               /* 3 sep */
                                               $html.="<td>".$total_gravado_sep."</td>";
                                               $html.="<td>".$total_renta_sep."</td>";
                                               $html.="<td>".$total_afp_sep."</td>";

                                               /* 3 octu */
                                               $html.="<td>".$total_gravado_octu."</td>";
                                               $html.="<td>".$total_renta_octu."</td>";
                                               $html.="<td>".$total_afp_octu."</td>";

                                               /* 3 nov */
                                               $html.="<td>".$total_gravado_nov."</td>";
                                               $html.="<td>".$total_renta_nov."</td>";
                                               $html.="<td>".$total_afp_nov."</td>";

                                               /* 3 dic */
                                               $html.="<td>".$total_gravado_dic."</td>";
                                               $html.="<td>".$total_renta_dic."</td>";
                                               $html.="<td>".$total_afp_dic."</td>";

                                               $html.="<td>".$val_empleado["numero_documento_identidad"]."</td>";
                                               $html.="<td>".$anioActual."</td>";


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
            guardarComoArchivoTexto(contenidoTexto, 'CONSOLIDADO RETENCIONES.txt');

                
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
        doc.save('CONSOLIDADO RETENCIONES.pdf');
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
        XLSX.writeFile(wb, "CONSOLIDADO RETENCIONES.xlsx");
       

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