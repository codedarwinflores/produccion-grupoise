<?php
require_once 'dompdf/autoload.inc.php';
require_once '../../modelos/horario.modelo.php';
session_start();

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$id = 0;
$id_descriptado = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $id_descriptado = ModeloHorario::encryptor('decrypt', $id);
}

if (isset($_SESSION["perfil"]) && isset($_GET['id']) && !empty($_GET['id']) &&  is_numeric($id_descriptado) && $id_descriptado > 0) {

    function validarImagenRemota($urlImagen)
    {
        // Obtenemos los encabezados de la URL
        $headers = @get_headers($urlImagen);

        // Verificamos si se obtuvieron los encabezados correctamente y si el código de respuesta es 200 (OK)
        if ($headers !== false && strpos($headers[0], '200') !== false) {
            // Intentamos obtener el tipo de contenido si está presente en los encabezados
            foreach ($headers as $header) {
                if (strpos($header, 'Content-Type:') === 0) {
                    // Extraemos el tipo de contenido de la cabecera
                    $contentType = trim(substr($header, strpos($header, ':') + 1));
                    // Verificamos si el tipo de contenido es una imagen
                    return (bool) preg_match('/^image\/(jpeg|png|gif|bmp)$/i', $contentType);
                }
            }
            // Si no se encontró el tipo de contenido en los encabezados, no podemos determinar si es una imagen
            return false;
        }

        // Si no se obtuvieron los encabezados o el código de respuesta no es 200, devolvemos false
        return false;
    }


    $resultado = ModeloHorario::ObtenerReservaPoligrafoID($id_descriptado);

    // Verificamos si la función retornó algo
    if ($resultado !== false) {
        // Decodificamos el JSON a un array asociativo
        $datos = json_decode($resultado, true);

        // Verificamos si la decodificación fue exitosa
        if ($datos !== null) {

            $fotografia = $datos['fotografia'];
            // Accedemos a los datos individuales
            $codigo_programar_exam = $datos['codigo_programar_exam'];
            $fecha_programada = ($datos['fecha_programada'] != '0000-00-00') ? date('d/m/Y', strtotime($datos['fecha_programada'])) : '-';
            $hora_programada = ($datos['hora_programada'] != '00:00:00') ? date('H:i:s', strtotime($datos['hora_programada'])) : '-';
            $estado_exam = $datos['estado_exam'];
            $hora_ingreso = ($datos['hora_ingreso'] != '00:00:00') ? date('H:i:s', strtotime($datos['hora_ingreso'])) : '-';
            $hora_inicio = ($datos['hora_inicio'] != '00:00:00') ? date('H:i:s', strtotime($datos['hora_inicio'])) : '-';
            $hora_finalizo = ($datos['hora_finalizo'] != '00:00:00') ? date('H:i:s', strtotime($datos['hora_finalizo'])) : '-';
            $forma_pago = mb_strtoupper($datos['forma_pago'], 'UTF-8');
            $porcentaje_cliente = $datos['porcentaje_cliente'];
            $porcentaje_evaluado = $datos['porcentaje_evaluado'];
            $precio_examen = $datos['precio_examen'];
            $resultado_final_examen = mb_strtoupper($datos['resultado_final_examen'], 'UTF-8');

            $money_cliente = number_format(floatval(($precio_examen * ($porcentaje_cliente / 100))), 2);
            $money_evaluado = number_format(floatval(($precio_examen * ($porcentaje_evaluado / 100))), 2);

            /* CLIENTE */
            $codigo_cliente = $datos['codigo_cliente'];
            $nombre = mb_strtoupper($datos['nombre'], 'UTF-8');

            /* EVALAUDO */
            $codigo_eva = $datos['codigo_eva'];
            $nombres_evas = mb_strtoupper($datos['nombres_evas'], 'UTF-8');
            $a_paterno = mb_strtoupper($datos['a_paterno'], 'UTF-8');
            $a_materno = mb_strtoupper($datos['a_materno'], 'UTF-8');
            $telefono_evas = ($datos['telefono_evas']);
            $dui_evas = ($datos['dui_evas']);
            $estado_evas = mb_strtoupper($datos['estado_evas'], 'UTF-8');
            $fecha_nac_evas = ($datos['fecha_nac_evas']);

            /* EXAMENES */
            $codigo_examen_unico = ($datos['codigo_examen_unico']);
            $descripcion_exam = mb_strtoupper($datos['descripcion_exam'], 'UTF-8');


            /* SOLICITADO */
            $nombre_completo_solicitado =  preg_replace('/\b(\S+)\s+/', '$1 ', ($datos["solicitado_nivel_academico"] . " " . $datos["solicitado_nombre"] . " " . $datos["solicitado_apellido"]));
            $solicitado_correo = mb_strtoupper($datos['solicitado_correo'], 'UTF-8');
            $solicitado_telefono = ($datos['solicitado_telefono']);
            $solicitado_direccion_entrega = mb_strtoupper($datos['solicitado_direccion_entrega'], 'UTF-8');
            $solicitado_cargo = mb_strtoupper($datos['solicitado_cargo'], 'UTF-8');
            $fecha_solicitud_re = ($datos['fecha_solicitud_re'] != '0000-00-00') ? date('d/m/Y', strtotime($datos['fecha_solicitud_re'])) : '-';
            $hora_solicitud_re = ($datos['hora_solicitud_re'] != '00:00:00') ? date('H:i:s', strtotime($datos['hora_solicitud_re'])) : '-';


            /* POLIGRAFISTA */
            $nombre_poligrafista =  preg_replace('/\b(\S+)\s+/', '$1 ', ($datos["nombre_poligrafista"]));
            $codigo_poligrafista = mb_strtoupper($datos['codigo_poligrafista'], 'UTF-8');
            /* TEXTO */
            $observaciones_examen = mb_strtoupper($datos['observaciones_examen'], 'UTF-8');
            $objetivo_examen = mb_strtoupper($datos['objetivo_examen'], 'UTF-8');
            $conclusion_examen = mb_strtoupper($datos['conclusion_examen'], 'UTF-8');
            $concepto = mb_strtoupper($datos['concepto'], 'UTF-8');
            $codigo_formato_examen = ($datos['codigo_formato_examen']);

            // Crea una instancia de Dompdf con opciones
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $options->setIsPhpEnabled(true);
            $options->set('defaultFont', 'Arial');

            $dompdf = new Dompdf($options);

            ob_start();
            date_default_timezone_set('America/El_Salvador');
            $esquema = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $dominio = $_SERVER['HTTP_HOST'];
            $urlCompleta = "$esquema://$dominio";
            // Obtener la fecha y hora actuales
            $fecha = date("d/m/Y h:i:s A");
            $foto = "https://cdn.icon-icons.com/icons2/69/PNG/128/user_customer_person_13976.png";
            $urlfoto = str_replace('..', '', $urlCompleta . $fotografia);
            if (validarImagenRemota($urlfoto)) {
                $foto = $urlfoto;
            } else if (validarImagenRemota($urlCompleta . "/" . $fotografia)) {
                $foto = $urlCompleta . "/" . $fotografia;
            } else if (validarImagenRemota($fotografia)) {
                $foto = $fotografia;
            }
?>

            <!DOCTYPE html>
            <html lang="es">

            <head>
                <style>
                    /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
                    @page {
                        margin: 0cm 0cm;
                    }

                    /** Define now the real margins of every page in the PDF **/
                    body {
                        font-size: 12px;
                        margin-top: 0.5cm;
                        margin-left: 1cm;
                        margin-right: 1cm;
                        margin-bottom: 1cm;
                        font-family: monospace;
                    }

                    /** Define the header rules **/
                    header {

                        top: 0cm;
                        left: 1cm;
                        right: 1cm;
                        height: 1.5cm;
                    }



                    /** Define the footer rules **/
                    /*    footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        } */



                    .claseTable {
                        width: 100%;
                        border-collapse: collapse;

                    }

                    .claseTable td {
                        border: 1px solid black;
                        padding-top: 8px;
                        padding-bottom: 8px;
                        text-align: center;
                    }

                    /* Estilo de las columnas */
                    .claseTable td:nth-child(1) {
                        width: 25%;
                    }

                    .claseTable td:nth-child(2) {
                        width: 50%;
                        font-weight: bold;
                    }

                    .claseTable td:nth-child(3) {
                        width: 25%;
                    }

                    .fechaprint {
                        display: flex;
                        flex-direction: column;
                    }


                    .formulario {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .formulario td {
                        border: 1px solid black;
                        padding: 4px;
                        text-align: left;
                    }

                    .codigo {
                        font-weight: bold;
                        font-size: 14px;

                    }

                    .titulo {
                        text-align: center !important;
                        font-weight: bold;
                        font-size: 13px;
                        background-color: rgba(170, 191, 255, 0.5);
                    }

                    .alineacion {
                        text-align: right !important;
                    }

                    .tabla-preguntas {
                        width: 100%;
                        border-collapse: collapse;


                    }

                    .tabla-preguntas th,
                    .tabla-preguntas td {
                        padding: 5px 5px;
                        text-align: left;
                        border: none;
                    }

                    .tabla-preguntas th {
                        background-color: #f5f3c4;
                    }

                    .tabla-preguntas tbody tr:nth-child(even) {
                        background-color: rgba(170, 191, 255, 0.2);
                    }



                    .tabla-preguntas td:first-child,
                    .tabla-preguntas th:first-child {
                        border-left: 1px solid black;
                        /* Borde izquierdo en la primera columna */
                    }

                    .tabla-preguntas td:last-child,
                    .tabla-preguntas th:last-child {
                        border-right: 1px solid black;
                        /* Borde derecho en la última columna */
                    }

                    .tabla-preguntas tfoot {
                        background-color: #f5f3c4;
                        border-top: 1px solid black !important;
                    }
                </style>
                <link rel="shortcut icon" href="<?= $urlCompleta ?>/vistas/img/plantilla/icono-negro.png" type="image/x-png">
                <title>EXAMEN POLIGRÁFICO - REF: <?= $codigo_programar_exam ?></title>

            </head>

            <body>
                <!-- Define header and footer blocks before your content -->
                <header>
                    <table class="claseTable">
                        <tr>
                            <td><img src="<?= $urlCompleta ?>/vistas/img/plantilla/logo_original.png" width="50%"></td>
                            <td style="font-size: 15px;">EXAMEN POLIGRÁFICO - RESULTADO</td>
                            <td>
                                <div class="fechaprint">
                                    <div><?= $fecha ?></div>
                                    <div class="codigo">REF: <?= $codigo_programar_exam ?></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </header>
                <!--  <footer>
        <div>Hola</div>
    </footer> -->


                <!-- Wrap the content of your PDF inside a main tag -->
                <main>
                    <table class="formulario">
                        <tr>
                            <td colspan="9" class="titulo">EMPRESA</td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>CÓD.:</strong></td>
                            <td>
                                <?= $codigo_cliente ?>
                            </td>
                            <td class="alineacion"><strong>CLIENTE:</strong></td>
                            <td colspan="6">
                                <?= $nombre ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="titulo"><?= $foto ?></td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>CÓD.:</strong></td>
                            <td><?= $codigo_eva ?></td>
                            <td class="alineacion"><strong>NOMBRES:</strong></td>
                            <td colspan="4"><?= $nombres_evas ?></td>
                            <td colspan="2" rowspan="3" width="20" style="text-align: center !important;"><img src="<?= $foto ?>" width="35%"></td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>DUI:</strong></td>
                            <td><?= $dui_evas ?></td>
                            <td class="alineacion"><strong>APELLIDOS:</strong></td>
                            <td colspan="4"><?= $a_paterno . " " . $a_materno ?></td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>NAC.:</strong></td>
                            <td><?= ($fecha_nac_evas != '0000-00-00') ? date('d/m/Y', strtotime($fecha_nac_evas)) : '-'; ?></td>
                            <td class="alineacion"><strong>ESTADO CIVIL:</strong></td>
                            <td colspan="2"><?= $estado_evas ?></td>
                            <td><strong>TEL.</strong></td>
                            <td><?= $telefono_evas ?></td>
                        </tr>
                        <tr>
                            <td colspan="9" class="titulo">EXAMEN SOLICITADO</td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>CÓD.:</strong></td>
                            <td><?= $codigo_examen_unico ?></td>
                            <td class="alineacion"><strong>DESCRIPCIÓN:</strong></td>
                            <td><?= $descripcion_exam ?></td>
                            <td><strong>F. Y HORA PROGRAMADA:</strong></td>
                            <td colspan="2"><?= $fecha_programada . " " . $hora_programada ?></td>
                            <td><strong>ESTADO:</strong></td>
                            <td><?= $estado_exam ?></td>
                        </tr>

                        <tr>
                            <td colspan="9" class="titulo">SOLICITADO POR</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="alineacion"><strong>NOMBRE COMPLETO:</strong></td>
                            <td colspan="3"><?= $nombre_completo_solicitado ?></td>
                            <td colspan="2" class="alineacion"><strong>F. Y HORA SOLICITADO:</strong></td>
                            <td colspan="2"><?= $fecha_solicitud_re . " " . $hora_solicitud_re ?></td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>TEL.</strong></td>
                            <td><?= $solicitado_telefono ?></td>
                            <td class="alineacion"><strong>CARGO:</strong></td>
                            <td colspan="2"><?= $solicitado_cargo ?></td>
                            <td class="alineacion"><strong>CORREO:</strong></td>
                            <td colspan="3"><?= $solicitado_correo ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="alineacion"><strong>DIR. DE ENTREGA:</strong></td>
                            <td colspan="7"><?= $solicitado_direccion_entrega ?></td>
                        </tr>
                        <tr>
                            <td colspan="9" class="titulo">POLIGRAFISTA</td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>CÓD.:</strong></td>
                            <td>
                                <?= $codigo_poligrafista ?>
                            </td>
                            <td class="alineacion"><strong>NOMBRE:</strong></td>
                            <td colspan="6">
                                <?= $nombre_poligrafista ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9" class="titulo">DETALLE DE EXAMEN</td>
                        </tr>
                        <tr>
                            <td class="alineacion" colspan="2"><strong>HORA INGRESÓ:</strong></td>
                            <td><?= $hora_ingreso ?></td>
                            <td class="alineacion" colspan="2"><strong>HORA INICIÓ:</strong></td>
                            <td><?= $hora_inicio ?></td>
                            <td class="alineacion" colspan="2"><strong>HORA FINALIZÓ:</strong></td>
                            <td><?= $hora_finalizo ?></td>
                        </tr>
                        <tr>
                            <td class="alineacion" colspan="2"><strong>FORMATO EXAMEN:</strong></td>
                            <td colspan="3"><?= $codigo_formato_examen . " - " . $concepto ?></td>
                            <td class="alineacion" colspan="2"><strong>FORMA DE PAGO:</strong></td>
                            <td colspan="2"><?= $forma_pago ?></td>
                        </tr>
                        <tr>
                            <td class="alineacion" colspan="2"><strong><?= $porcentaje_cliente ?>% CLIENTE:</strong></td>
                            <td><?= $money_cliente ?></td>
                            <td class="alineacion" colspan="2"><strong><?= $porcentaje_evaluado ?>% EVALUADO:</strong></td>
                            <td><?= $money_evaluado ?></td>
                            <td class="alineacion" colspan="2"><strong>PRECIO EXAMEN: $</strong></td>
                            <td><?= $precio_examen ?></td>
                        </tr>
                    </table>

                    <table class="tabla-preguntas" width="100%">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th width="60%">PREGUNTA</th>
                                <th>RESP.</th>
                                <th>RESULT.</th>
                                <th width="15%">OBSERVACIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $result_preguntas = ModeloHorario::ObtenerPreguntas($id_descriptado);

                            if (count($result_preguntas) > 0) {
                                foreach ($result_preguntas as $key => $row) {
                                    echo "<tr>";
                                    echo "<td>" . ($key + 1) . "</td>";
                                    echo "<td>" . mb_strtoupper($row["pregunta_poligrafo"], 'UTF-8') . "</td>";
                                    echo "<td>" . mb_strtoupper($row["respuesta"], 'UTF-8') . "</td>";
                                    echo "<td>" . mb_strtoupper($row["resultado"], 'UTF-8') . "</td>";
                                    echo "<td>" . mb_strtoupper($row["observacion"], 'UTF-8') . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No se encontraron preguntas registradas. </td></tr>";
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="alineacion" colspan="3"><strong>RESULTADO FINAL DE EXAMEN:</strong></td>
                                <td colspan="2"><?= $resultado_final_examen ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="formulario">

                        <tr>
                            <td class="alineacion"><strong>OBSERVACIONES:</strong></td>
                            <td><?= htmlspecialchars($observaciones_examen) ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>OBJETIVO DEL EXAMEN:</strong></td>
                            <td><?= htmlspecialchars($objetivo_examen) ?></td>
                        </tr>
                        <tr>
                            <td class="alineacion"><strong>CONCLUSIÓN DEL EXAMEN:</strong></td>
                            <td><?= htmlspecialchars($conclusion_examen) ?></td>
                        </tr>
                    </table>
                </main>
            </body>


            </html>

<?php
            /* MORSE DE S.A DE C.V */
            $dompdf->loadHtml(ob_get_clean());
            $dompdf->setPaper('letter', 'portrait');
            // Renderizar PDF
            $dompdf->render();

            // Obtener el número total de páginas
            $totalPages = $dompdf->get_canvas()->get_page_count();

            // Agregar script para los números de página
            $dompdf->get_canvas()->page_script('
    if ($PAGE_COUNT > 0) {
        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $size = 10;
        $text = "MORSE DE S.A DE C.V";
        $pdf->text(30, 760, $text, $font, $size);
        $text = "Pág: " . $PAGE_NUM . "/" . $PAGE_COUNT;
        $y = 760;
        $x = 530;
        $pdf->text($x, $y, $text, $font, $size);
    }
');
            // Obtener el contenido del PDF como una cadena
            $pdf_content = $dompdf->output();

            // Mostrar el PDF en un visor de PDF en el navegador con el título en la barra de título
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="documento.pdf"');
            header('Content-Length: ' . strlen($pdf_content));
            header('Content-Disposition: inline; filename="titulo_que_quieras.pdf"');
            echo $pdf_content;
        }
    }
} else {
    header("location:../../inicio");
}
?>