<?php ob_start(); ?>
<?php date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $idempleado =$_GET["id"];
?>
<!-- **********INICIO DEL REPORTE************ -->
<?php require_once "../../modelos/conexion.php";        
function empleado() {
    global $idempleado;
    $query = "SELECT * FROM `tbl_empleados` where id = $idempleado";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };
$data = empleado();
foreach($data as $value) {
?>
<?php
$nombreImagen = "../imgcarnet/carnetcabecera.jpeg";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<?php
$nombreImagenpie = "../imgcarnet/piecarnet.png";
$imagenBase64pie = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagenpie));
?>
<?php
$foto_empleado=$value["fotografia"];
if(isset($foto_empleado)){
    $foto_empleado="../imgcarnet/anonymous.png";
}
else{
    "../../".$foto_empleado;
}
$fotoempleado = $foto_empleado;
$imagenBase64empleado = "data:image/png;base64," . base64_encode(file_get_contents($fotoempleado));
?>
<style>
    .table_cabeza{
      position: fixed;
      top:-48px;
      left:-48px;
      max-width: 5px ;
    }
    .table_empleado{
        position: fixed;
        top:20px;
        left:-98px;
        max-width: 5px ;
    }
    .table_info{
        position: fixed;
        top:100px;
        left:-58px;
        max-width: 5px ;
    }
   
    .table_info2{
        position: fixed;
        top:120px;
        left:-109px;
        max-width: 5px ;
    }
    .table_emergencia{
        position: fixed;
        top:180px;
        left:-95px;
        max-width: 5px ;
    }
    .table_pie{
        position: fixed;
        top:220px;
        left:-95px;
        max-width: 5px ;
    }
    .imagen{
        width: 65%;
    }
    .imagen2{
        width: 75%;
    }
</style>
<table class="table_cabeza">
    <tr>
        <td>
	        <img src="<?php echo $imagenBase64 ?>"  class="imagen"/>
        </td>
    </tr>
</table>
<br>
<table class="table_empleado">
    <tr>
        <td style="width: 120px;"></td>
        <td style="" align="center">
        <img src="<?php echo $imagenBase64empleado ?>" width="100" />
        </td>
    </tr>
</table>
<table class="table_info">
    <tr>
        <td style="width: 30px;"></td>
        <td></td>
        <td><span style="font-size: 20px;"><?php echo $value["primer_apellido"].' '.$value["segundo_apellido"]?></span></td>
    </tr>
</table>
<table class="table_info2">
    <tr>
        <td style="width: 70px;"></td>
        <td></td>
        <td><span style="font-size: 15px;"><?php echo $value["primer_nombre"].' '.$value["primer_apellido"]?></span></td>
    </tr>
    <tr>
        <td style="width: 70px;"></td>
        <td><span style="font-size: 15px;">DUI:</span></td>
        <td><span style="font-size: 15px;"><?php echo $value["numero_documento_identidad"]?></span></td>
    </tr>
    <tr>
        <td style="width: 70px;"></td>
        <td><span style="font-size: 15px;">LUAF:</span></td>
        <td><span style="font-size: 15px;"><?php echo $value["luaf"]?></span></td>
    </tr>
</table>
<br>
<table class="table_emergencia">
    <tr>
        <td style="width: 50px;"></td>
        <td align="center">
            <span style="color:#000; font-size:15px">
                EN CASO DE EMERGENCIAS
                <br>
                AVISAR AL 2245-1900
            </span>
        </td>
    </tr>
    
</table>
<table class="table_pie">
    <tr>
        <td>
	        <img src="<?php echo $imagenBase64pie ?>" class="imagen2" />
        </td>
    </tr>
</table>


<?php
}   
?>

<!-- *************FIN REPORTE************* -->
<?php require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "carnet.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
$dompdf->stream($filename, array("Attachment" => false));
?>