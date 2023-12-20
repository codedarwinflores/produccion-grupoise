<?php

require_once '../vistas/modulos/dompdf/autoload.inc.php';
use Dompdf\Dompdf;


$archivo = fopen("BANCO DAVIVIENDA.txt", "w");
$espa1=10;

/* reporte txt */
if (isset($_POST['tableData'])) {

    $tableData = $_POST['tableData'];
    $text="";


    /* los ceros son los titulos iniciales tamaño de las columnas*/
    $miArray = [0,0,0,0,5,40,20,20,20,20,20,20,20,20,20,20,20,20];
            $tamano2 = [15,50,3,0,30,20,20,20,20,20,20,20,20,20];

    // Procesar los datos
    foreach ($tableData as $rowData) {
        $datos=implode(', ', $rowData);
        $elementos2 = explode(", ", $datos);
        $longitud2 = count($elementos2);
        for ($i = 0; $i <= $longitud2; $i++) {
            $text .= str_pad(preg_replace('/\s+/', ' ', trim($elementos2[$i])),$tamano2[$i]);
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
