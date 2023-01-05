
<?php ob_start(); ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $idempleado =$_GET["id"];
?>

<!-- **********INICIO DEL REPORTE************ -->



<table>
    <tr>
        <th  width="450px"></th>
        <th>San Salvador,  <?php echo date('d')." ".$mes." de ".date('Y');?></th>
    </tr>
</table>
<br>
<?php
require_once "../../modelos/conexion.php";        
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
            <span style="font-size: 14px; line-height: 2.5;">
            En las oficinas de la Sociedad, ubicadas en Avenida Las Buganvillas #7 "M", Colonia San Francisco, San Salvador; yo,
<?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]?> , con Documento Único de Identidad número <?php echo $value["numero_documento_identidad"] ?> actuando en mi calidad personal y como trabajador con el cargo de <?php echo $value["nivel_cargo"] ?>
de la Sociedad INVESTIGACIONES Y SEGURIDAD, SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE, que se abreviaISE, S.A. DE C.V., SOLICITO a la Sociedad que me conceda ANTICIPO DE SALARIO en cada uno de mis pagos quincenales;
 es decir que los días SIETE y VEINTIUNO de cada mes, me sean depositados en mi cuenta bancaria número <?php echo "___numero de cuenta pendiente__" ?> del BANCO <?php echo "__banco pendiente__" ?> la cantidad de <?php echo " ___cantidad pendiente DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA, ($ 10.00 )___" ?> en concepto de ANTICIPO DE SALARIO como una ayuda económica, mientras dure la relación laboral o hasta que yo indique que ya no quiero la prestación, y AUTORIZO a la Sociedad para que me descuente la cantidad recibida en la fecha de pago de mi salario, es decir la suma <?php echo " ___deCIENTO OCHENTA Y DOS 50/100 DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA, ($ 182.50 )___ PENDIENTE"?>
 del salario que corresponde a la quincena próxima a la que se me fue entregado el anticipo mencionado en
virtud de mi solicitud a la Sociedad.
</span>
<br>
<br>
<br>
<br>
<span>
    F.__________________
</span>
<br>
<span>
    Nombre del Trabajor: <?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]?>
    <br>
    DUI: <?php echo $value["numero_documento_identidad"] ?> 
</span>
<br>
<br>
<br>
<br>
<table>
    <tr>
        <td width="180"></td>
        <td>
            <span>
                ______________________________
            </span>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td width="240"></td>
        <td>
            <span>Aprobación</span>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td width="229"></td>
        <td>
            <span>ISE, S.A. DE C.V.</span>
        </td>
    </tr>
</table>

<?php
}   
?>

<!-- *************FIN REPORTE************* -->
<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>