<?php ob_start(); ?>
<style>
            .tabla {
                width: 100%;
            }
            .tabla td {
             
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
            .texto_negrita{
                font-weight: bold;

            }
            .texto-subrayado {
                text-decoration: underline;
                text-align: left;
                font-size: 12px;
            }
            .ancho1{
                width: 5%; /* Establece un ancho de 150 píxeles para esta celda */
            }
            .ancho2{
                width: 1%; /* Establece un ancho de 150 píxeles para esta celda */
            }
            .ancho3{
                width: 20%; /* Establece un ancho de 150 píxeles para esta celda */
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
            .div_center{
                width: 100%;
                text-align: center;
            }
</style>
<?php 
require_once "../../modelos/conexion.php";
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $idempleado= $_GET["idemple"];
 $idbanco= $_GET["idbanco"];
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

  function banco($id) {
    $query = "SELECT * FROM `bancos` where id=$id";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  }; 

  function viaticos_tra($id) {
    $query = "SELECT * FROM `tbl_empleados_devengos_descuentos` where id_empleado=$id and id_tipo_devengo_descuento=2";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  }; 


  $repre_legal=""; 
  $data_conf=configuracion();
  foreach ($data_conf as $value) {
    $repre_legal=$value["representante_legal"];
  }
  $nom_banco=""; 
  $data_banco=banco($idbanco);
  foreach ($data_banco as $value) {
    $nom_banco=$value["nombre"];
  }

$data = empleado($idempleado);
$nombre_empleado="";
$fecha_contrata="";
$nombre_nivel="";
$salario=0;
$viatico_valor=0;
foreach($data as $value) {
    $id=$value["nivel_cargo"];
    $id_empleado=$value["id"];
    
    $nombre_empleado=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
    $nombre_empleado = preg_replace('/\s+/', ' ', $nombre_empleado);
    $fecha_contrata=$value["fecha_contratacion"];

    $salario=floatval($value["sueldo"])*2;


    $data_cargo=cargo($id);
    foreach ($data_cargo as $subvalue) {
        $nombre_nivel=$subvalue["descripcion"];
    }
    
    $data_viatico=viaticos_tra($id_empleado);
    foreach ($data_viatico as $subvalue) {
        $viatico_valor=floatval($subvalue["valor"]);
    }
}
$meses = array(
    1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO',
    7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'
);

$num_mes = date("m", strtotime($fecha_contrata));
$dia = date("d", strtotime($fecha_contrata));
$anio = date("Y", strtotime($fecha_contrata));
$cadena_sin_ceros = ltrim($num_mes, '0');
$name_mes=$meses[$cadena_sin_ceros];
$fecha_for=$dia." de ".$name_mes." de ".$anio;

$texto_viatico="";
if($viatico_valor>0){
    $texto_viatico=" mas ".numeroALetras($viatico_valor)." 00/100 en concepto de transporte";
}

  $html="";
  $html.="<h4>";
  $html.="SRES.<br>";
  $html.="$nom_banco";
  $html.="</h4>";
  $html.="<span>Presente"."</span><br><br>";
  $html.="<span>Por medio de la presente hago constar que el Sr.(a) <span class='texto_negrita'>$nombre_empleado</span> labora para
  <span class='texto_negrita'>INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</span> desde el $fecha_for hasta la fecha, ocupando el cargo de <span class='texto_negrita'>$nombre_nivel</span> devengando un salario mensual de  ".numeroALetras($salario)."  00/100 ".$texto_viatico."      detalla a continuacion :"."</span><br><br>";

  $html.="<table class='tabla'>";

  $total_global=$salario+$viatico_valor;
  $html.="<tr>";
      $html.="<td  class='ancho1'>Salario"."</td>";
      $html.="<td  class='ancho2'>$"."</td>";
      $html.="<td  class='ancho3'>".$salario.".00"."</td>";
  $html.="</tr>";

  $html.="<tr>";
      $html.="<td  class=''>Menos (-)"."</td>";
      $html.="<td  class=''>"."</td>";
      $html.="<td  class=''>"."</td>";
  $html.="</tr>";

  $html.="<tr>";
  $html.="<td  class=''>ISSS"."</td>";
  $html.="<td  class=''>"."</td>";
  $html.="<td  class=''>"."</td>";
  $html.="</tr>";

  if($viatico_valor>0){
  $html.="<tr>";
  $html.="<td  class=''>Más Transporte"."</td>";
  $html.="<td  class=''>"."</td>";
  $html.="<td  class=''>".$viatico_valor."</td>";
  $html.="</tr>";
  }

  $html.="<tr>";
  $html.="<td  class='ancho1'>A RECIBIR"."</td>";
  $html.="<td  class='ancho2'>$"."</td>";
  $html.="<td  class='ancho3'>".bcdiv($total_global,'1', 2)."</td>";
  $html.="</tr>";

  
  $html.="</table>";

  $fecha_actual = date("Y-m-d H:i:s");

$num_mes = date("m", strtotime($fecha_actual));
$dia = date("d", strtotime($fecha_actual));
$anio = date("Y", strtotime($fecha_actual));
$name_mes=$meses[$num_mes];
$fecha_for=$dia." dias del mes de ".$name_mes." de ".$anio;


$html.="<br><br><span>y para los usos que el interesado estime conveniente se extiende la
  presente en San Salvador a los $fecha_for"."</span><br><br><br><br>";

$html.="<div class='div_center'>";
$html.="<span class='texto_negrita'>F_______________________________________"."</span><br>";
$html.="<span class='texto_negrita'>GERENTE DE RECURSOS HUMANOS"."</span><br>";
$html.="<span class='texto_negrita'>GRUPO ISE, S.A. DE C.V"."</span><br>";
$html.="</div>";




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
$filename = "REPORTE.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
$dompdf->stream($filename, array("Attachment" => false));
?>