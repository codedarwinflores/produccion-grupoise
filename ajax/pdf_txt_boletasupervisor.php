<?php

require_once '../vistas/modulos/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$nombre_archivo="BOLETA OPCION SUPERVISOR";
$archivo = fopen($nombre_archivo.".txt", "w");
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
    $text .= str_pad(" ", 60)."  ".str_pad($titulo1, 10 )."\n";
    $text .= str_pad(" ", 70)."  ".str_pad($titulo2, 10 )."\n";
    $text .= str_pad(" ", 62)."  ".str_pad($titulo3, 10 )."\n";
    $text .= str_pad(" ", 68)."  ".str_pad($titulo4, 10 )."\n";
    /* $text .= str_pad(str_repeat("-", 300), 10 )."\n"; */


    /* los ceros son los titulos iniciales tamaño de las columnas*/
    $miArray = [0,0,0,0,5,40,20,20,20,20,20,20,20,20,20,20,20,20];
            $tamano2 = [50,10,20,60,20,20,20,20,20,20,20,20,20,20];

    /* TITULOS__________________ */
    $longitud = count($elementos);
    for ($i = 4; $i <= $longitud; $i++) {
         $text .= str_pad($elementos[$i],$miArray[$i]);
    }
    $text .="\n";
    // Procesar los datos
    $conteos=0;
    foreach ($tableData as $rowData) {
        $conteos++;
        $datos=implode(', ', $rowData);
        $elementos2 = explode(", ", $datos);
        $longitud2 = count($elementos2);
        for ($i = 0; $i <= $longitud2; $i++) {
            if($conteos==1){
                $text .= str_pad(" ", 42)."  ".str_pad(preg_replace('/\s+/', ' ', $elementos2[$i]),$tamano2[$i]); 
            }
            else{
                $text .= str_pad(preg_replace('/\s+/', ' ', $elementos2[$i]),$tamano2[$i]);
            }

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
               padding: 2px;
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
           .siguiente{
            page-break-after: always;
            
            }
        </style>";
        $tablaHtml_original .= $_POST["tabla"];


        $partes = preg_split("/<\/tbody>/i", $tablaHtml_original);

        $dompdf = new DOMPDF();
        /* $dompdf->setPaper(array(0, 0, 612, 936), 'landscape'); */
        $cuenta=1;
        foreach ($partes as $parte) {
                 $cuenta++;
                 $tablaHtml .= '<table class="table table-bordered table-striped dt-responsive tablas">';
                 $tablaHtml.= $parte;
                 $tablaHtml.="</table>";
                 if($cuenta==3){
                    $tablaHtml.="<div class='siguiente'></div>";
                    $cuenta=1;
                 }
        }        


        $dompdf->loadHtml($tablaHtml);
        /* $dompdf->loadHtml(ob_get_clean()); */

        $dompdf->render();
        $pdf = $dompdf->output();
        $filename = $nombre_archivo.".pdf";
        file_put_contents($filename, $pdf);
        /* $dompdf->stream($filename); */
        $dompdf->stream($filename, array("Attachment" => false));



}
?>
