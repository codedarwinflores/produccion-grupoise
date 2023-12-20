<?php ob_start();
require_once "../../modelos/conexion.php";        
 ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];

$radio_desde=$_POST["radio_desde"];
$radio_hasta=$_POST["radio_hasta"];
$fecha=$_POST["fecha"];

?>

<?php

function radios($radio_desde,$radio_hasta,$fecha){
    $query = "SELECT * FROM `tbl_radios` WHERE id > $radio_desde and id < $radio_hasta and fecha_adquisicion <= '$fecha'";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
}

$formatofecha = date("Y-m-d", strtotime($fecha));
/* $mes = date("m", strtotime($_POST["fechaperiodo1"]));
$anio = date("Y", strtotime($_POST["fechaperiodo1"]));
$fecha_desde_format=$anio."-".$mes."-"."01"; */

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
  </style>
</head>
<body>
    <div style="height: 50px;"></div>
  <header>
         <h4 align="center" style="color: #0965BC;">REPORTE DE INVENTARIO EQ. DE COMUNICACION</h4>
        <span style="color: #021993;">Entidad:  </span><span>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</span>
        <br>
        <span style="color: #021993;">Fecha : </span><span><?php echo $fecha?></span>
  </header>
  <!-- <footer>footer on each page</footer> -->
        <?php
        $cuenta=0;
        $cuentatotal=0;
        $suma=0;
        $data=radios($radio_desde,$radio_hasta,$formatofecha);
        $cantidadRegistros = count($data);
        foreach($data as $value) {
            $cuenta++;
            $cuentatotal++;
            
        ?>
        <main class="content">
            <br>
        <!-- **********INICIO DEL REPORTE************ -->
        <div style="border: 1px solid #000;width:80%">
            <table>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">No</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["codigo_radio"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">MARCA</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["marca"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">NUMERO DE SERIE</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["numero_serie"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">MODELO</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["modelo_radio"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">PERMISO No.</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px">        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">ASIGNADO A</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px">        </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">FECHA DE ADQUISICION</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["fecha_adquisicion"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">ESTADO</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["estado_radio"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:11px">OBSERVACIONES</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:1px">
                            <span style="font-size:11px"><?php echo $value["observaciones"]?></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        </main>
        
        <!-- *************FIN REPORTE************* -->
        <?php 
            
                if($cuenta==3){
                    if($cuentatotal<$cantidadRegistros){
                        $cuenta=0;
                        echo '<div style=" page-break-before: always;"></div>';
                        echo '<div style="height: 50px;"></div>';
                    }
                 }
            
         }
         ?>
       <!--  <div style=" page-break-before: always;"></div> -->

</body>
</html>

<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();



$dompdf->loadHtml(ob_get_clean());
$dompdf->render();

$pdf = $dompdf->output();
$filename = "Reporte Listado Radios.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */

$dompdf->stream($filename, array("Attachment" => false));
?>