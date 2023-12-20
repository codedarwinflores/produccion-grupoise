
<?php

use PhpOffice\PhpSpreadsheet\Shared\Date;

 ob_start();
require_once "../../modelos/conexion.php";        
 ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];

/* $radio_desde=$_POST["radio_desde"];
$radio_hasta=$_POST["radio_hasta"];
$fecha=$_POST["fecha"]; */
$fecha_desde=$_POST["fecha_desde"];
$fecha_hasta=$_POST["fecha_hasta"];

?>

<?php

function retiro($fechadesde1,$fechahasta2){
    $query = "SELECT  * FROM tbl_empleados where  estado=2 and fecha_contratacion  BETWEEN '$fechadesde1' AND '$fechahasta2'";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
}
$formatofecha_desde = date("Y-m-d", strtotime($fecha_desde));
$formatofecha_hasta = date("Y-m-d", strtotime($fecha_hasta));
$fechaActual = date("d-m-Y"); // Formato año-mes-día hora:minutos:segundos

function departamento($id){
    $query = "SELECT * FROM `cat_departamento` WHERE id=$id";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
}
function municipio($id){
    $query = "SELECT * FROM `cat_municipios` WHERE id=$id";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
}
function ubicacion_agente($codigo){
    $query = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones WHERE tbl_ubicaciones_agentes_asignados.codigo_agente='$codigo' and tbl_clientes_ubicaciones.id=tbl_ubicaciones_agentes_asignados.idubicacion_agente";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
}

?>

<html>
<head>
  <style>
    @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .content {
    /*   page-break-before: always; */
     /*  margin-top: 50px; */ /* Espacio entre el título y el contenido */
    }
    .texto_titulo{
        padding: 0px; margin:0px;
    }
    table {
        border-collapse: collapse;
        border-width: 0.3px; 
        border:0.1px;
         width: 100%;
    }
    
    th, td {
      border: 0.2px solid #D0D0D0;
      padding: 0px;
      padding-left: 1px;
      text-align: left;
    }
    
    th {
     /*  background-color: #f2f2f2; */
      font-size: 9px;
    }
    
    tr:nth-child(even) {
     /*  background-color: #f2f2f2; */
    }
    .textos{
        font-size: 9px;
        margin: 0px;
        padding: 0px;
    }
  </style>
</head>
<body>
<div style="height: 50px;"></div>
  <header align="center">
         <h4 align="center" class="texto_titulo">POLICIA NACIONAL CIVIL</h4>
         <h6 align="center" class="texto_titulo">DIVISION DE REGISTRO Y CONTROL DE SERVICIOS PRIVADOS DE SEGURIDAD</h6>
         <h6 align="center" class="texto_titulo">NOMINA DE AGENTES DE SEGURIDAD PRIVADA DISTRIBUIDO EN LOS DIFERENTES CONTRATOS CLIENTES A NIVEL NACIONAL</h6>
         <br>
        <span>NOMBRE EMPRESA INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</span>
        <br>
        <span>FECHA DE REPORTE  <?php echo $fechaActual; ?></span>
  </header>
  <!-- <footer>footer on each page</footer> -->
  <main class="content">
  <div >
   <table>
    <tr>
        <th>No</th>
        <th>NOMBRE AGENTE</th>
        <th>CONTRATO CLIENTE </th>
        <th width="130">DIRECCION</th>
        <th width="70">DEPARTAMENTO</th>
        <th width="50">MUNICIPIO</th>
        <th>CLASE TIPO DE COMUN</th>
        <th>TELEFAX</th>
    </tr>
        <?php
        $cuenta=0;
        $cuentatotal=0;
        $suma=0;
        $data=retiro($formatofecha_desde,$formatofecha_hasta);
        $cantidadRegistros = count($data);
        foreach($data as $value) {
            $cuenta++;
            $cuentatotal++;
            $nombreempleado=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
            $codigo_empleado=$value["codigo_empleado"];

        ?>
       
        <!-- **********INICIO DEL REPORTE************ -->
                <tr>
                <td>
                    <span class="textos"><?php echo $cuentatotal?></span>
                </td>
                <td>
                    <span style="font-size:11px"><?php echo $nombreempleado?></span>
                </td>
                <td>
                    <?php
                        $data_ubicacion=ubicacion_agente($codigo_empleado);
                        foreach($data_ubicacion as $value_ubicacion) {
                    ?>
                        <span class="textos"><?php echo $value_ubicacion["nombre_ubicacion"]?></span>
                    <?php
                        }
                    ?>
                </td>
                <td>
                        <?php
                            $data_ubicacion=ubicacion_agente($codigo_empleado);
                            foreach($data_ubicacion as $value_ubicacion) {
                        ?>
                            <span class="textos"><?php echo $value_ubicacion["direccion"]?></span>
                        <?php
                            }
                        ?>
                </td>
                <td>
                    <?php
                      $data_ubicacion=ubicacion_agente($codigo_empleado);
                      foreach($data_ubicacion as $value_ubicacion) {
                        $iddepa=$value_ubicacion["id_departamento"];
                        $data_depa=departamento($iddepa);
                        foreach($data_depa as $value_depa) {
                    ?>
                            <span class="textos"><?php echo $value_depa["Nombre"]?></span>
                    <?php
                            }
                        }
                    ?>
                </td>
                <td>
                <?php
                      $data_ubicacion=ubicacion_agente($codigo_empleado);
                      foreach($data_ubicacion as $value_ubicacion) {
                        $idmuni=$value_ubicacion["id_municipio"];
                        $data_muni=municipio($idmuni);
                        foreach($data_muni as $value_muni) {
                    ?>
                            <span class="textos"><?php echo $value_muni["Nombre_m"]?></span>
                    <?php
                            }
                        }
                    ?>
                </td>
                <td>
                    <span class="textos">**********</span>
                </td>
                <td>
                    <span class="textos">*************</span>
                </td>
            </tr>
        <!-- *************FIN REPORTE************* -->
        <?php 
                if($cuenta==13){
                    if($cuentatotal<$cantidadRegistros){
                        $cuenta=0;
                        echo '<div style=" page-break-before: always;"></div>';
                        echo '<div style="height: 50px;"></div>';
                    }
                 }
            
         }
         ?>
       <!--  <div style=" page-break-before: always;"></div> -->
       </table>
     </div>
   </main>
</body>
</html>

<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

$dompdf->setPaper(array(0, 0, 612, 936), 'landscape');
$dompdf->loadHtml(ob_get_clean());
 

$dompdf->render();

$pdf = $dompdf->output();
$filename = "Reporte Listado Radios.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */

$dompdf->stream($filename, array("Attachment" => false));
?>