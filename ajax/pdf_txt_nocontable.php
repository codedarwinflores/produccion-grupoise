<?php

require_once '../vistas/modulos/dompdf/autoload.inc.php';
use Dompdf\Dompdf;


$archivo = fopen("No_contable.txt", "w");
$espa1=10;

/* reporte txt */
if (isset($_POST['tableHeaders']) && isset($_POST['tableData'])) {

    $tableHeaders = $_POST['tableHeaders'];
    $tableData = $_POST['tableData'];
    $text="";
    // Procesar los títulos
    $titulos_implode= implode(", ", $tableHeaders);
    $elementos = explode(", ", $titulos_implode);

    $titulo1 = isset($elementos[0]) ? $elementos[0] : null;
    $titulo2 = isset($elementos[1]) ? $elementos[1] : null;
    $titulo3 = isset($elementos[2]) ? $elementos[2] : null;
    $titulo4 = isset($elementos[3]) ? $elementos[3] : null;

    /* centrar */

    /* ******* */
    $text .= str_pad(" ", 100)."  ".str_pad($titulo1, 10 )."\n";
    $text .= str_pad(" ", 110)."  ".str_pad($titulo2, 10 )."\n";
    $text .= str_pad(" ", 102)."  ".str_pad($titulo3, 10 )."\n";
    $text .= str_pad(" ", 108)."  ".str_pad($titulo4, 10 )."\n";
    $text .= str_pad(str_repeat("-", 300), 10 )."\n";


    /* los ceros son los titulos iniciales tamaño de las columnas*/
    $miArray = [0,0,0,0,5,40,20,20,20,20,20,20,20,20,20,20,20,20];
            $tamano2 = [5,40,20,20,20,20,20,20,20,20,20,20,20,20];

    /* TITULOS__________________ */
    $longitud = count($elementos);
    for ($i = 4; $i <= $longitud; $i++) {
         $text .= str_pad($elementos[$i],$miArray[$i]);
    }
    $text .="\n";
    $text .= str_pad(str_repeat("-", 300), 10 )."\n";

    // Procesar los datos
    foreach ($tableData as $rowData) {
        $datos=implode(', ', $rowData);
        $elementos2 = explode(", ", $datos);

        $longitud2 = count($elementos2);
        for ($i = 0; $i <= $longitud; $i++) {
            $text .= str_pad(preg_replace('/\s+/', ' ', $elementos2[$i]),$tamano2[$i]);
        }
        $text.="\n";
    }
    // Escribe los datos en el archivo
    if (fwrite($archivo, $text) === false) {
        die("No se pudo escribir en el archivo.");
    }
    // Cierra el archivo después de escribir
    fclose($archivo);
    echo "Los datos se han escrito exitosamente en el archivo.";
}
else{
    /* reporte PDF */
        $tablaHtml="
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
           width: 100%;
           margin: 0px auto;
           }
        
           td, th {
               border: 1px solid #ccc;
               padding: 5px;
               text-align: center;   
               font-size:9px;
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
        </style>";
        $tablaHtml .= $_POST["tabla"];

        $dompdf = new DOMPDF();
        $dompdf->setPaper(array(0, 0, 612, 936), 'landscape');

        $dompdf->loadHtml($tablaHtml);
        /* $dompdf->loadHtml(ob_get_clean()); */

        $dompdf->render();
        $pdf = $dompdf->output();
        $filename = "Planilla no contable.pdf";
        file_put_contents($filename, $pdf);
        /* $dompdf->stream($filename); */
        $dompdf->stream($filename, array("Attachment" => false));

}
?>
