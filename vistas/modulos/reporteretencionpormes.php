<
<?php
setlocale(LC_TIME, 'es_ES.UTF-8');

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
        function fun_depa_empresa() {
            $query = "SELECT departamentos_empresa.* FROM departamentos_empresa,tbl_empleados where tbl_empleados.id_departamento_empresa=departamentos_empresa.id group by departamentos_empresa.id ORDER BY departamentos_empresa.id ASC";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();	
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
        };

        function fun_planilla_admin($fecha_desde,$fecha_hasta,$mes) {
            /* $query = "SELECT sum(total_devengo_admin_planilladevengo_admin) as totaldevengado,
                             sum(total_liquidado_planilladevengo_admin) as totalliquidoanio, 
                             sum(descuento_renta_planilladevengo_admin) as totalrenta, id_empleado_planilladevengo_admin 
                             FROM planilladevengo_admin where STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y')  group by id_empleado_planilladevengo_admin"; */
                             $query = "SELECT sum(total_devengo_admin_planilladevengo_admin) as totaldevengado,
                             sum(total_liquidado_planilladevengo_admin) as totalliquidoanio, 
                             sum(descuento_renta_planilladevengo_admin) as totalrenta, id_empleado_planilladevengo_admin,`primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`,id_departamento_empresa,codigo_afp,codigo_empleado,nit,tbl_empleados.id as id,numero_documento_identidad
                             FROM planilladevengo_admin,tbl_empleados
                             where MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))='$mes' and tbl_empleados.id=planilladevengo_admin.id_empleado_planilladevengo_admin and STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y') >= STR_TO_DATE('$fecha_desde', '%d-%m-%Y') and STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y') <= STR_TO_DATE('$fecha_hasta', '%d-%m-%Y')  
                             group by id_empleado_planilladevengo_admin"; 
                           
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            
        };

        function fun_planilla_admin_afp($idempleado,$codigo_afp) {
            $query = "SELECT sum(descuento_isss_planilladevengo_admin) as totalisss,
                             sum(descuento_afp_planilladevengo_admin) as totalafp,
                             planilladevengo_admin.* FROM planilladevengo_admin, tbl_empleados 
                             where tbl_empleados.id=planilladevengo_admin.id_empleado_planilladevengo_admin and
                             tbl_empleados.id=$idempleado and 
                             tbl_empleados.codigo_afp='$codigo_afp'
                               group by id_empleado_planilladevengo_admin";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            /* return $sql->fetchAll(); */
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
        };
        function funplanillaadminafpnoemple($mes) {
            $query = "SELECT sum(descuento_isss_planilladevengo_admin) as totalisss,
                             sum(descuento_afp_planilladevengo_admin) as totalafp,
                             planilladevengo_admin.*, planilladevengo_admin.id_empleado_planilladevengo_admin as idempleado FROM planilladevengo_admin, tbl_empleados 
                             where MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))='$mes'and tbl_empleados.id=planilladevengo_admin.id_empleado_planilladevengo_admin
                            group by id_empleado_planilladevengo_admin";
                              
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();		
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
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
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
        };
        function funadminissssinemple() {
            $query = "SELECT sum(descuento_isss_planilladevengo_admin) as totalisss,
                             sum(descuento_afp_planilladevengo_admin) as totalafp,
                             planilladevengo_admin.* FROM planilladevengo_admin, tbl_empleados 
                             where tbl_empleados.id=planilladevengo_admin.id_empleado_planilladevengo_admin
                             group by id_empleado_planilladevengo_admin ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();		
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
        };

        function fun_empleados($idempleado, $iddepa) {
            $query = "SELECT * FROM tbl_empleados where id=$idempleado and id_departamento_empresa=$iddepa";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
        };

        function fun_empleados_sindepa($idempleado) {
            $query = "SELECT * FROM tbl_empleados where id=$idempleado";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
        };

        function devengos_contodo($idempleado1,$mes) {
          
            $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo,valor_devengo_planilla
            FROM tbl_devengo_descuento_planilla_admin,planilladevengo_admin
            WHERE planilladevengo_admin.id_empleado_planilladevengo_admin='$idempleado1' and  MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))='$mes' and  tipo_valor like '%suma%'
            and planilladevengo_admin.numero_planilladevengo_admin=tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo 
            and id_empleado_planilladevengo_admin=idempleado_devengo
            AND (isss_devengo_devengo_descuento_planilla = 'Si' OR afp_devengo_devengo_descuento_planilla = 'Si' OR renta_devengo_devengo_descuento_planilla = 'Si')";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
            
        };


        function planillaadminmes($idempleado1) {
            $query = "SELECT sum(sueldo_planilladevengo_admin) as sueldo, SUM(descuento_renta_planilladevengo_admin) as renta, sum(descuento_afp_planilladevengo_admin) as afp, MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) as mes
            FROM planilladevengo_admin 
            where id_empleado_planilladevengo_admin='$idempleado1'  
            group by MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))
            order by MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
        };

        function planillaadminmessinempleado() {
            $query = "SELECT sum(sueldo_planilladevengo_admin) as sueldo, SUM(descuento_renta_planilladevengo_admin) as renta, sum(descuento_afp_planilladevengo_admin) as afp, MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) as mes
            FROM planilladevengo_admin 
               
            group by MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))
            order by MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll(); */
        };

        function planillaadminemple($idempleado1,$mes) {
            $query = "SELECT sum(total_devengo_admin_planilladevengo_admin) as devengado,sum(total_liquidado_planilladevengo_admin) as totaliquido,sum(descuento_renta_planilladevengo_admin) as totalrenta
            FROM planilladevengo_admin 
            where  MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y'))='$mes' and id_empleado_planilladevengo_admin='$idempleado1' ";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll();
            $sql=null; */
        };

        function planillaaguinaldo($idempleado1,$numero){
            $query = "SELECT*FROM planilladevengo_aguinaldo 
            where id_empleado_planilladevengo_aguinaldo='$idempleado1' and numero_planilladevengo_aguinaldo	='$numero'";
            /* echo $query; */
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll();
            $sql=null; */
        }
       
        function configuracion(){
            $query = "SELECT*FROM configuracion";
            /* echo $query; */
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            $resultados=$sql->fetchAll();	
            $sql=null;
            return $resultados;
            /* return $sql->fetchAll();
            $sql=null; */
        }
        $dataconfiguracion=configuracion();
        $topeaguinaldo="";
        foreach ($dataconfiguracion as $valconfi) {
            # code...
            $topeaguinaldo=$valconfi["tope_excento_aguinaldo"];
        }
       

        
       


        $fechaActual = date("Y-m-d"); 
        $anioActual = date("Y"); 

        $fecha_desde = $_POST["fecha_desde"];
        $fecha_hasta = $_POST["fecha_hasta"];
        $planillaaguinaldo = $_POST["planillaaguinaldo"];
        $messeleccionado = $_POST["messeleccionado"];

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
                            $html="";                        
                            $html.="<tr>";
                            $html.="<td>DOMICILIADO "."</td>";
                            $html.="<td>CODIGO DE PAIS "."</td>";
                            $html.="<td class='nombre_emple'>NOMBRES"."</td>";
                            $html.="<td class='nit_emple'>NIT"."</td>";
                            $html.="<td class='nit_emple'>DUI"."</td>";
                            $html.="<td class=''>CODIGO DE INGRESO"."</td>";
                            $html.="<td>DEVENGADO"."</td>";
                            $html.="<td>BONIFICACION"."</td>";
                            $html.="<td>RENTA  "."</td>";
                            $html.="<td>AGUINALDO EXENTO"."</td>";
                            $html.="<td>AGUINALDO GRAVADO"."</td>";
                            $html.="<td>AFP"."</td>";
                            $html.="<td>ISSS"."</td>";
                            $html.="<td>INPEP"."</td>";
                            $html.="<td>IPSFA"."</td>";
                            $html.="<td>CEFAFA"."</td>";
                            $html.="<td> BIENESTAR MAGISTERIAL"."</td>";
                            $html.="<td>ISSS IVM"."</td>";
                            $html.="<td>PERIODO"."</td>";
                            $html.="</tr>";

                            $array_depa_maestra=[];
                            $array_planilla_admin=[];
                            $array_empleados_admin=[];

                            /*  db */
                            $data_maestra=fun_depa_empresa();
                            foreach ($data_maestra as $val_maestra) {
                                $array_depa_maestra[]=$val_maestra;
                            }
                            /*  db */
                            $data_planilla_admin=fun_planilla_admin($fecha_desde,$fecha_hasta,$messeleccionado);
                            foreach ($data_planilla_admin as $val_pla_admin) {
                                $array_planilla_admin[]=$val_pla_admin;
                            }
                            /*  array */
                            foreach ($array_planilla_admin as $val_pla_admin) {

                                $idempleado_admin=$val_pla_admin["id_empleado_planilladevengo_admin"];
                                $totalliquidoanio=floatval($val_pla_admin["totalliquidoanio"]);
                                $totaldevengado=floatval($val_pla_admin["totaldevengado"]);
                                $totalrenta=floatval($val_pla_admin["totalrenta"]);

                                $data_empleados=fun_empleados_sindepa($idempleado_admin);
                                foreach ($data_empleados as $val_empleado) {
                                    $empleado = $val_empleado["id"];
                                    /* $array_empleados_admin[]=$val_empleado;  */  

                                    if (!isset($array_empleados_admin[$empleado])) {
                                        $array_empleados_admin[$empleado] = array(
                                            "totalliquidoanio" => 0, // Inicializamos el valor total en cero
                                            "totaldevengado" => 0, // Inicializamos el valor total en cero
                                            "totalrenta" => 0, // Inicializamos el valor total en cero
                                            "detalle" => array() // Inicializamos un array para almacenar el detalle

                                        );
                                    }
                                    $array_empleados_admin[$empleado]["totalliquidoanio"]=$totalliquidoanio;
                                    $array_empleados_admin[$empleado]["totaldevengado"]=$totaldevengado;
                                    $array_empleados_admin[$empleado]["totalrenta"]=$totalrenta;
                                    $array_empleados_admin[$empleado]["detalle"][] = $val_empleado;
                                }
                            }
                            /*  array */

                            /* array */
                            $data_isss=funadminissssinemple();
                            $array_isss=[];
                            foreach ($data_isss as $val_isss) {
                                $array_isss[]=$val_isss;
                            }
                            /* array */
                            $data_afp=funplanillaadminafpnoemple($messeleccionado);
                            $array_afp=[];
                            foreach ($data_afp as $val_afp) {
                                $array_afp[]=$val_afp;
                            }
                            
                            /* array maestra */
                            $cuenta=0;
                            

                            $devengo_global=0;
                            $renta_global=0;
                            $aguinaldoexento_global=0;
                            $aguinaldograbado_global=0;
                            $isss_global=0;
                            $afp_global=0;
                            $ipsfa_global=0;
                            foreach ($array_depa_maestra as $val_maestra) {

                                $id_depa=$val_maestra["id"];

                                $html.="<tr>";
                                    $html.="<td colspan='".$colspan."'>DEPARTAMENTO :".$val_maestra["nombre"]."</td>";
                                $html.="</tr>";

                                foreach ($array_planilla_admin as $val_empleado) {
                                        if ($val_empleado["id_departamento_empresa"] == $id_depa) {
                                            $idempleado_admin=$val_empleado["id"];

                                            $nombre_cargo=trim(trim($val_empleado["primer_nombre"])." ".trim($val_empleado["segundo_nombre"]).' '.trim($val_empleado["tercer_nombre"]));
                                            $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                            $apellidos=trim(trim($val_empleado["primer_apellido"]).' '.trim($val_empleado["segundo_apellido"]).' '.trim($val_empleado["apellido_casada"]));
                                            $apellidos = preg_replace('/\s+/', ' ', $apellidos);

                                            $codigo_afp=$val_empleado["codigo_afp"];

                                            $valor_isss=0;
                                            foreach ($array_isss as $val_isss) {
                                                if($val_isss["id_empleado_planilladevengo_admin"]==$idempleado_admin){
                                                    $valor_isss=floatval($val_isss["totalisss"]);
                                                }
                                            }
                                
                                            $valor_afp=0;
                                            $valor_crecer_confia=0;
                                            $valor_ipsa=0;
                                            foreach ($array_afp as $val_afp) {
                                                if($val_afp["idempleado"]==$idempleado_admin){
                                                    $valor_afp=floatval($val_afp["totalafp"]);
                                                }
                                            }
                                            if($codigo_afp=="0001" || $codigo_afp=="0002"){
                                                $valor_crecer_confia=$valor_afp;
                                            }
                                            else if($codigo_afp=="0003"){
                                                $valor_ipsa=$valor_afp;
                                            }

                                            $data_totalemple=planillaadminemple($idempleado_admin,$messeleccionado);
                                            $capture_devengado=0;
                                            $capture_liquido=0;
                                            $capture_renta=0;
                                            foreach ($data_totalemple as $val_emple) {
                                                # code...
                                                $capture_devengado=bcdiv(floatval($val_emple["devengado"]),'1', 2);
                                                $capture_liquido=bcdiv(floatval($val_emple["totaliquido"]),'1', 2);
                                                $capture_renta=bcdiv(floatval($val_emple["totalrenta"]),'1', 2);
                                            }

                                            $data_aguinaldo=planillaaguinaldo($idempleado_admin,$planillaaguinaldo);
                                            $aguinaldo=0;
                                            $liquidoaguinaldo=0;
                                            foreach ($data_aguinaldo as $val_aguinaldo) {
                                                # code...
                                                if($val_aguinaldo["total_liquidado_planilladevengo_aguinaldo"]>=$topeaguinaldo){
                                                    $aguinaldo=floatval($topeaguinaldo);
                                                }
                                                else{
                                                    $aguinaldo=floatval($val_aguinaldo["total_liquidado_planilladevengo_aguinaldo"]);
                                                }
                                                $liquidoaguinaldo=floatval($val_aguinaldo["total_liquidado_planilladevengo_aguinaldo"]);

                                            }

                                            $aguinaldo_grabado=$liquidoaguinaldo-$aguinaldo;
                                            
                                            $devengo_global+=$capture_devengado;
                                            $renta_global+=$capture_renta;
                                            $aguinaldoexento_global+=floatval($aguinaldo);
                                            $aguinaldograbado_global+=floatval($aguinaldo_grabado);
                                            $isss_global+=floatval($valor_isss);
                                            $afp_global+=floatval($valor_crecer_confia);
                                            $ipsfa_global+=floatval($valor_ipsa);
                                            
                                            $tienerenta=1;
                                            if($capture_renta>0){
                                                $tienerenta=1;
                                            }
                                            else{
                                                $tienerenta=60;
                                            }

                                            $timestamp = strtotime($fecha_hasta);
                                            // Formatea la fecha a un nuevo formato (por ejemplo, '10 de octubre de 2023')
                                            $fecha_formateada = date('Y', $timestamp);
                                            $mesactual="";
                                            if($messeleccionado<10){
                                                $mesactual="0".$messeleccionado;
                                            }


                                            $html.="<tr>";
                                            $html.="<td>1"."</td>";
                                            $html.="<td>9300"."</td>";
                                            $html.="<td>".$apellidos." ".$nombre_cargo."</td>";
                                            $html.="<td>".$val_empleado["nit"]."</td>";
                                            $html.="<td>".$val_empleado["numero_documento_identidad"]."</td>";
                                            $html.="<td>".$tienerenta."</td>";/* codigo de ingreso */
                                            $html.="<td>".$capture_devengado."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>".$capture_renta."</td>";
                                            $html.="<td>".$aguinaldo."</td>";
                                            $html.="<td>".$aguinaldo_grabado."</td>";
                                            $html.="<td>".$valor_crecer_confia."</td>";/* afp */
                                            $html.="<td>".$valor_isss."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>".$valor_ipsa."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>0.00"."</td>";
                                            $html.="<td>".$mesactual."/".$fecha_formateada."</td>";

                                            $html.="</tr>";


                                        }
                                    

                                  }

                            }
                       

                            /* $html.="<tr>";
                            $html.="<td colspan='4'>TOTALES"."</td>";
                            $html.="<td>".bcdiv($devengo_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($renta_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($aguinaldoexento_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($aguinaldograbado_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($isss_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($afp_global,'1', 2)."</td>";
                            $html.="<td>".bcdiv($ipsfa_global,'1', 2)."</td>";
                            $html.="<td>0.00"."</td>";
                            $html.="<td colspan='36'>"."</td>";
                            $html.="</tr>"; */
                           
                           echo $html;
                        ?>


                    </tbody>
                    
                </table>
       </div> 

      <!-- ************************ -->

<div class="carga_datos">

</div>
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
        
        ws['!cols'][0] = { wch: 15, };
        ws['!cols'][1] = { wch: 60, };
        ws['!cols'][2] = { wch: 30, };
        ws['!cols'][3] = { wch: 20, };
        ws['!cols'][4] = { wch: 20, };
        ws['!cols'][5] = { wch: 20, };
        ws['!cols'][6] = { wch: 20, };
        ws['!cols'][7] = { wch: 20, };
        ws['!cols'][8] = { wch: 20, };
        ws['!cols'][9] = { wch: 20, };
        ws['!cols'][10] = { wch: 20, };
        ws['!cols'][11] = { wch: 20, };
        ws['!cols'][12] = { wch: 20, };
        ws['!cols'][13] = { wch: 20, };


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

$(document).ready(function() {

/* CORRELATIVO PLANILLA */
			/* *********** */
		/* 	var dataString = 'accion01=action';
			$.ajax({
				data: dataString,
				url: "ajax/reporteretencion.ajax.php",
				type: 'post',
                dataType: "json",
				success: function (response) {
                 
					$(".carga_datos").append(response);
				}
			});
 */
			/* *********** */
        });
            
</script>