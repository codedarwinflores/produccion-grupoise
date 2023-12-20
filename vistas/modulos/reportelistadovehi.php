<?php ob_start();
require_once "../../modelos/conexion.php";        
 ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];

$vehi_desde=$_POST["vehi_desde"];
$vehi_hasta=$_POST["vehi_hasta"];
$fecha=$_POST["fecha"];

?>

<?php

function vehi($desde,$hasta,$fecha){
    $query = "SELECT * FROM `tbl_vehiculos` WHERE id > $desde and id < $hasta and fecha_adquision <= '$fecha'";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
}

function tipo_vehi($id){
    $query = "SELECT * FROM `tbl_tipos_de_vehiculo` WHERE id = $id ";
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
    header { position: fixed; top: -90px; left: 0px; right: 0px; height: 50px; }
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
    <div style="height: 0px;"></div>
  <header>
         <h4 align="center" style="color: #0965BC;">REPORTE DE INVENTARIO VEHICULOS</h4>
        <span style="color: #021993;">Entidad:  </span><span>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</span>
        <br>
        <span style="color: #021993;">Fecha : </span><span><?php echo $fecha?></span>
  </header>
  <!-- <footer>footer on each page</footer> -->
        <?php
        $cuenta=0;
        $cuentatotal=0;
        $suma=0;
        $data=vehi($vehi_desde,$vehi_hasta,$formatofecha);
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
                        <span style="color: #021993; font-size:10px">No</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px ">
                            <span style="font-size:10px"><?php echo $value["codigo_vehiculo"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">PLACA No</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["placa"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">MARCA</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["marca"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">TIPO</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                             <?php $data_tipo=tipo_vehi($value["id_tipo_vehiculo"]);
                             foreach($data_tipo as $value_tipo) {
                             ?>
                                <span style="font-size:10px"><?php echo $value_tipo["nombre_tipo"]?></span>
                             <?php 
                                }
                             ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">CLASE</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["descripcion_vehiculo"]?> </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">COLOR</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["color"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">AÑO VEHICULO</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["anio"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">CHASIS</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["numero_chasis"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">MOTOR</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["numero_motor"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">CAPACIDAD</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["capacidad"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">FECHA DE ADQUISICION</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["fecha_adquision"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">ESTATUS</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["estado_vehiculo"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">TIENE LOGOTIPO ?</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["tiene_logotipo"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">TIENE NOMBRE ENTIDAD</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["tiene_nombre_entidad"]?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <span style="color: #021993; font-size:10px">OBSERVACIONES</span>
                    </td>
                    <td>
                        <div style="border: 1px solid #000; padding:0px; padding-left:1px">
                            <span style="font-size:10px"><?php echo $value["observaciones"]?></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        </main>
        
        <!-- *************FIN REPORTE************* -->
        <?php 
            
                if($cuenta==2){
                    
                    if($cuentatotal<$cantidadRegistros){
                        $cuenta=0;
                        echo '<div style=" page-break-before: always;"></div>';
                        echo '<div style="height: 5px;"></div>';
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
$filename = "Reporte Listado Vehiculos.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */

$dompdf->stream($filename, array("Attachment" => false));
?>