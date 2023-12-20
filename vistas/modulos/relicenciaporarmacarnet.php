<?php ob_start(); ?>
<style>
            .tabla {
                width: 100%;
                border-collapse: collapse;
            }
            .tabla td {
                border: 1px solid #000;
                padding: 1px;
            }
            .tabla td:not(:last-child) {
                border-right: none; /* Elimina el borde derecho en la última celda de cada fila */
            }
            .titulo{
                font-size:20px;
                text-align: center;
                display: block;
            }
            .texto{
                text-align: left;
                font-size: 12px;
            }
            .texto_especial{
                text-align: left;
                font-size: 12px;
                font-weight: bold;

            }
            .texto-subrayado {
                text-decoration: underline;
                text-align: left;
                font-size: 12px;
            }
            .ancho{
                width: 50%; /* Establece un ancho de 150 píxeles para esta celda */
            }
            .texto_centrado{
                font-size:12px;
                text-align: center;
                display: block;
            }
            .cuadro{
                width: 50%;
                 background: #dcdcde;
                 height: 10%;
                display: block;
                margin-left:25%;
            }
</style>
<?php 
require_once "../../modelos/conexion.php";
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $idempleado= $_GET["id"];
 $fecha= $_GET["fecha"];

 $meses = array(
    1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO',
    7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'
);

 $numero_mes=date("m", strtotime($fecha));
 $cadena_sin_ceros = ltrim($numero_mes, '0');
 $name_mes=$meses[$cadena_sin_ceros];
 $dia=date("d", strtotime($fecha));
 $anio=date("Y", strtotime($fecha));
 $texto_fecha=$dia." de ".$name_mes." de ".$anio;
?>
<!-- **********INICIO DEL REPORTE************ -->
<?php 
        
function empleado($idempleado) {
    $query = "SELECT * FROM `tbl_empleados` where id = $idempleado";
    
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };

  function configuracion() {
    $query = "SELECT * FROM `configuracion`";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };

  function cargo($id) {
    $query = "SELECT * FROM `cargos_desempenados` where id=$id";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  }; 

  $repre_legal=""; 
  $data_conf=configuracion();
  foreach ($data_conf as $value) {
    # code...
    $repre_legal=$value["representante_legal"];
  }



$data = empleado($idempleado);
$html="";
foreach($data as $value) {

    $id=$value["nivel_cargo"];
    $dui=$value["numero_documento_identidad"];
    $carnet=$value["carnet_empleado"];

    $nacimiento = new DateTime($value["fecha_nacimiento"]);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    $edad= $diferencia->format("%y");


    $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
    $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);


    $data_cargo=cargo($id);
    $nombre_nivel="";
    foreach ($data_cargo as $subvalue) {
        $nombre_nivel=$subvalue["descripcion"];
    }

    


$html.="<table class='tabla'>";
    $html.="<tr>";
        $html.="<td  class='ancho'>".
                "<br>".
                "<span class='titulo'>AGENCIA DE SEGURIDAD</span>".
                "<span class='titulo'>''ISE'' S.A. DE C.V.</span>".
                "<span class='texto'>En cumplimiento al articulo 28 de la ley de tenecia y portacion de armas, yo ".$repre_legal." Representante Legal, autorizo a:</span>".
                "<br>".
                "<span class='texto_especial'>Nombre: </span>"."<span class='texto-subrayado'>".$nombre_cargo."</span>".
                "<br>".
                "<span class='texto_especial'>Cargo: </span>"."<span class='texto-subrayado'>".$nombre_nivel."</span>".
                "<br>".
                "<span class='texto_especial'>DUI No.: </span>"."<span class='texto-subrayado'>".$dui."</span>".
                "<br>".
                "<span class='texto_especial'>CARNET No.: </span>"."<span class='texto-subrayado'>".$carnet."</span>".
                "<br>".
                "<span class='texto_centrado'>Para que porte el arma con licencia No xxxxxxxxxx :adjunto fotocopia certificada de licencia para arma de fuego </span>".
                "<br>".
                "<span class='texto_centrado'>________________________</span>".
                "<br>"
                ."</td>";
        $html.="<td class='ancho'>".
                    "<span class='texto'>Yo, el suscrito notario DOY FE: Que la firma que calza el documento es
                    autentica por haber sido puesta en mi presencia de su pu±o y letra por el Sr. ".$repre_legal." quien es de ".numeroALetras($edad)." años de edad, estudiante de este domicilio,a quien conozco e identifico por su cedula de identidad personal numero xxxxxxxxxxxxxxxxx SAN SALVADOR, $texto_fecha</span><br><br>".
                    "<div class='cuadro'>"."<div>".    
                "</td>";
    $html.="</tr>";
$html.="</table>";
}   
echo $html;

function numeroALetras($numero) {
    $unidades = array('cero', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve');
    $decenas = array('', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa');
    $centenas = array('', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos');

    if ($numero < 10) {
        return $unidades[$numero];
    } elseif ($numero >= 10 && $numero < 20) {
        $unidad = $numero % 10;
        return 'dieci' . $unidades[$unidad];
    } elseif ($numero >= 20 && $numero < 100) {
        $unidad = $numero % 10;
        $decena = ($numero / 10) % 10;
        if ($unidad == 0) {
            return $decenas[$decena];
        } else {
            return $decenas[$decena] . ' y ' . $unidades[$unidad];
        }
    } elseif ($numero >= 100 && $numero < 1000) {
        $unidad = $numero % 10;
        $decena = ($numero / 10) % 10;
        $centena = floor($numero / 100);
        if ($decena == 0 && $unidad == 0) {
            return $centenas[$centena];
        } else {
            return $centenas[$centena] . ' ' . numeroALetras($numero - $centena * 100);
        }
    }
}

?>



<!-- *************FIN REPORTE************* -->
<?php require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "LICENCIA DE PORTACION DE ARMA.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
$dompdf->stream($filename, array("Attachment" => false));
?>