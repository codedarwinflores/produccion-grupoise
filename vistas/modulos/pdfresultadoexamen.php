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
        // Verificar si la URL es válida
        if (filter_var($urlImagen, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        // Obtener los encabezados de la URL
        $headers = @get_headers($urlImagen);

        // Verificar si se obtuvieron los encabezados correctamente y si el código de respuesta es 200 (OK)
        return $headers !== false && strpos($headers[0], '200') !== false;
    }


    function calcularEdad($fechaNacimiento)
    {
        // Crear un objeto DateTime con la fecha de nacimiento
        $fechaNacimiento = new DateTime($fechaNacimiento);

        // Obtener la fecha actual
        $fechaActual = new DateTime();

        // Calcular la diferencia entre la fecha actual y la fecha de nacimiento
        $diferencia = $fechaActual->diff($fechaNacimiento);

        // Obtener la edad en años
        return $diferencia->y;
    }


    // Configurar la zona horaria
    date_default_timezone_set('America/El_Salvador');

    // Crear un objeto DateTime con la fecha actual
    $fecha = new DateTime();

    // Obtener el día, mes y año
    $dia = $fecha->format('d');
    $mes = $fecha->format('n'); // Número del mes sin ceros iniciales
    $anio = $fecha->format('Y');

    // Arreglo de nombres de meses en español
    $nombres_meses = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    ];


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
            $cargo_evaluado_aplicar = $datos['nombre_cargo_final_eval'];
            $codigo_eva = $datos['codigo_eva'];
            $nombres_evas = mb_strtoupper($datos['nombres_evas'], 'UTF-8');
            $a_paterno = mb_strtoupper($datos['a_paterno'], 'UTF-8');
            $a_materno = mb_strtoupper($datos['a_materno'], 'UTF-8');
            $telefono_evas = ($datos['telefono_evas']);
            $dui_evas = ($datos['dui_evas']);
            $estado_evas = mb_strtoupper($datos['estado_evas'], 'UTF-8');
            $fecha_nac_evas = ($datos['fecha_nac_evas']);
            $direccion_evaluado = $datos['evas_direccion'];
            $lugar_nacimiento = $datos['evas_lugar_nacimiento'];
            $profesion = $datos['profesion'];
            $conyuge = $datos['conyuge'];

            /* EXAMENES */
            $codigo_examen_unico = ($datos['codigo_examen_unico']);
            $descripcion_exam = mb_strtoupper($datos['descripcion_exam'], 'UTF-8');


            /* SOLICITADO */
            $nombre_completo_solicitado =  preg_replace('/\b(\S+)\s+/', '$1 ', ($datos["solicitado_nivel_academico"] . " " . $datos["solicitado_nombre"] . " " . $datos["solicitado_apellido"]));
            $solicitado_apellido = $datos["solicitado_apellido"];
            $solicitado_correo = mb_strtoupper($datos['solicitado_correo'], 'UTF-8');
            $solicitado_telefono = ($datos['solicitado_telefono']);
            $solicitado_direccion_entrega = mb_strtoupper($datos['solicitado_direccion_entrega'], 'UTF-8');
            $solicitado_cargo = mb_strtoupper($datos['nombre_cargo'], 'UTF-8');
            $fecha_solicitud_re = ($datos['fecha_solicitud_re'] != '0000-00-00') ? date('d/m/Y', strtotime($datos['fecha_solicitud_re'])) : '-';
            // Convertir la fecha a un objeto DateTime
            $fecha = DateTime::createFromFormat('d/m/Y', $fecha_solicitud_re);

            // Obtener el día, mes y año
            $dias = $fecha->format('d');
            $meses = (int) $fecha->format('n'); // 'n' devuelve el número del mes sin ceros iniciales
            $anios = $fecha->format('Y');
            $hora_solicitud_re = ($datos['hora_solicitud_re'] != '00:00:00') ? date('H:i:s', strtotime($datos['hora_solicitud_re'])) : '-';


            /* POLIGRAFISTA */
            $nombre_poligrafista =  preg_replace('/\b(\S+)\s+/', '$1 ', ($datos["nombre_poligrafista"]));
            $codigo_poligrafista = mb_strtoupper($datos['codigo_poligrafista'], 'UTF-8');
            /* TEXTO */
            $observaciones_examen = ($datos['observaciones_examen']);
            $objetivo_examen = mb_strtoupper($datos['objetivo_examen'], 'UTF-8');
            $conclusion_examen = ($datos['conclusion_examen']);
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
            $urlfoto = preg_replace("/\.\./", "", ($urlCompleta  . $fotografia), 1);
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
                        font-size: 13.5px;
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
                        /*          border: 1px solid black; */
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

                    .fila {
                        display: flex;
                        flex-wrap: wrap;
                        margin-bottom: 10px;
                    }

                    .etiqueta {
                        flex: 0 0 30%;
                        font-weight: bold;
                        background-color: rgba(170, 191, 255, 0.5);
                        padding: 5px;
                    }

                    .valor {
                        flex: 0 0 70%;
                        word-wrap: break-word;
                    }

                    .contenedor {
                        border: 1px solid #000;
                        padding: 5px;
                        margin-bottom: 10px;
                    }

                    /* Centrar el texto del legend */
                    fieldset {
                        padding: 3px;
                    }

                    legend {
                        text-align: center;
                        display: table;
                        /* Convertir el legend en una tabla */
                        margin: 0 auto;
                        /* Centrar la tabla */
                    }

                    ul li,
                    ol li {
                        margin-bottom: 12px !important;
                    }

                    /* Estilo del contenedor de la firma */
                    .signature {
                        text-align: left;
                        /* Centra el texto */
                        margin-top: 30px;
                        /* Espacio superior */

                        /* Fuente para el texto */
                    }

                    /* Texto de "Atentamente," */
                    .signature-text {
                        margin-bottom: 20px;
                        /* Espacio inferior */

                    }

                    /* Línea para la firma */
                    .signature-line {
                        border-bottom: 1px solid #000;
                        /* Línea inferior */
                        width: 300px;
                        /* Ancho de la línea */
                        /* Centrar la línea */
                        margin-top: 60px;
                        /* Espacio superior de la línea */
                        position: relative;
                        /* Posición relativa para superponer la imagen */
                    }

                    /* Contenedor para la imagen de la firma */
                    .signature-image-container {
                        margin-top: -60px;
                        /* Ajusta la posición vertical */
                        position: relative;
                        /* Posición relativa */
                    }

                    /* Imagen de la firma */
                    .signature-image {
                        width: 200px;
                        /* Ancho de la imagen */
                        height: auto;
                        /* Mantiene la proporción de la imagen */
                        position: absolute;
                        /* Posición absoluta */
                        top: 20px;
                        /* Ajusta la posición vertical */
                        left: 20%;
                        /* Centra horizontalmente */
                        transform: translateX(-50%);
                        /* Centra la imagen */
                    }

                    /* Nombre y cargo debajo de la línea de firma */
                    .signature-name,
                    .signature-title {
                        margin-top: 10px;
                        /* Espacio superior para el texto */

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
                            <td style="font-size: 15px;">EXAMEN POLIGRÁFICO</td>
                            <td>
                                <div class="fechaprint">
                                    <!--         <div><?= $fecha ?></div> -->
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
                    <p>
                        SAN SALVADOR, <?= $dia . " DE " . $nombres_meses[$mes] . " DE " . $anio  ?>
                    </p>
                    <p>
                        SEÑOR(A)<br>
                        <?= $nombre_completo_solicitado ?><br>
                        <?= $nombre ?><br>
                        PRESENTE
                    </p>

                    <p>
                        Estimado (a) Señor (a) <?= $solicitado_apellido ?>
                    </p>

                    <p>Por este medio me estoy dirigiendo a usted, para informarle sobre el resultado obtenido en examen <?= $descripcion_exam ?> realizado con el polígrafo:
                    </p>

                    <fieldset>
                        <legend><strong>DATOS GENERALES</strong></legend>
                        <table>
                            <tr>
                                <td width="25%" rowspan="13"><img src="<?= $foto ?>" width="100%"></td>
                                <td width="25%" class=""><strong>EMPRESA</strong></td>
                                <td width="50%"><strong><?= $nombre ?></strong></td>
                            </tr>

                            <tr>
                                <td><strong>FECHA EXAMEN</strong></td>
                                <td><?= $dias . " DE " . $nombres_meses[$meses] . " DE " . $anios ?></td>
                            </tr>
                            <tr>
                                <td><strong>NOMBRE DEL EVALUADO</strong></td>
                                <td><?= $nombres_evas . " " . $a_paterno . " " . $a_materno ?></td>
                            </tr>
                            <tr>
                                <td><strong>PUESTO</strong></td>
                                <td><?= mb_strtoupper($cargo_evaluado_aplicar, 'UTF-8') ?></td>
                            </tr>
                            <tr>
                                <td><strong>DIRECCIÓN</strong></td>
                                <td><?= $direccion_evaluado ?></td>
                            </tr>
                            <tr>
                                <td><strong>TELEFONO</strong></td>
                                <td><?= $telefono_evas ?></td>
                            </tr>
                            <tr>
                                <td><strong>LUGAR DE NACIMIENTO</strong></td>
                                <td><?= $lugar_nacimiento ?></td>
                            </tr>
                            <tr>
                                <td><strong>FECHA DE NACIMIENTO</strong></td>
                                <td><?= ($fecha_nac_evas != '0000-00-00') ? date('d/m/Y', strtotime($fecha_nac_evas)) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>EDAD</strong></td>
                                <td><?= calcularEdad($fecha_nac_evas) ?> AÑOS</td>
                            </tr>
                            <tr>
                                <td><strong>DUI</strong></td>
                                <td><?= $dui_evas ?></td>
                            </tr>
                            <tr>
                                <td><strong>PROFESIÓN</strong></td>
                                <td><?= $profesion ?></td>
                            </tr>
                            <tr>
                                <td><strong>ESTADO CIVIL</strong></td>
                                <td><?= $estado_evas ?></td>
                            </tr>
                            <tr>
                                <td><strong>CONYUGE</strong></td>
                                <td><?= $conyuge ?></td>
                            </tr>
                        </table>
                    </fieldset>

                    <p>
                        El examen se realizó con el fin de verificar el grado de honestidad y confiabilidad para trabajar como <?= mb_strtoupper($cargo_evaluado_aplicar, 'UTF-8') ?> en <?= mb_strtoupper($nombre, 'UTF-8') ?>.
                    </p>
                    <p>Antes de la entrevista preliminar al examen, esta persona firmó una hoja de autorización donde manisfestó hacerlo en forma voluntaria.</p>

                    <p>
                        Durante el desarrollo del examen realizado el (la) evaluado (a) fue cuestionado (a) sobre las areas siguientes:
                    </p>

                    <ol>
                        <li>USO DE BEBIDAS ALCOHÓLICAS.</li>
                        <li>USO Y TRÁFICO DE DROGAS ILEGALES.</li>
                        <li>ANTECEDENTES DELINCUENCIALES.</li>
                        <li>PARTICIPACIÓN EN ACTIVIDADES DELINCUENCIALES. (Asaltos, secuestros, extorsiones, fraudes, violaciones,asesinatos, falsificación de documentos, robo de vehículos,tráfico de drogas, y todo delito que sea castigado por la ley.).
                        </li>
                        <li>
                            ASOCIACIÓN CON MARAS O BANDAS DELICUENCIALES.
                        </li>
                        <li>HISTORIA LABORAL.</li>
                        <li>DEUDAS.</li>
                    </ol>

                    <div style="page-break-before: always;"></div>
                    <fieldset>
                        <legend><strong>INFORMACIÓN EN CUANTO AL CASO INVESTIGADO</strong></legend>
                        <p>
                            <?= nl2br(htmlentities($observaciones_examen)) ?>
                        </p>
                    </fieldset>

                    <p>
                        Para comprobar toda la información anterior, mediante el sistema de Polígrafo se le formuló las preguntas siguientes:
                    </p>
                    <h4>
                        SE DETECTARON MUESTRAS DE MENTIRA:
                    </h4>
                    <ul type="circle">
                        <?php

                        $cont = 0;
                        $result_preguntas = ModeloHorario::ObtenerPreguntas($id_descriptado);

                        if (count($result_preguntas) > 0) {
                            $v_param = isset($_GET["v"]) ? $_GET["v"] : "";

                            // Convertir el parámetro 'v' en un array
                            $valores = explode(",", $v_param);

                            foreach ($result_preguntas as $key => $row) {
                                // Verificar si la variable 'v' no está definida o está vacía
                                if (!isset($_GET["v"]) || empty($_GET["v"]) || !in_array($row["cod_pregunta"], $valores)) {
                                    if (strtoupper($row["resultado"]) !== "CONFIABLE") {
                                        # code...
                                        $cont++;
                                        echo "<li>" . mb_strtoupper($row["pregunta_poligrafo"], 'UTF-8') . " Su respuesta fué: " . mb_strtoupper($row["respuesta"], 'UTF-8') . "</li>";
                                    }
                                }
                            }

                            echo ($cont <= 0 ? "<li>No se encontraron preguntas registradas de este tipo. </li>" : "");
                        } else {
                            echo "<p>No se encontraron preguntas registradas de este tipo. </p>";
                        }

                        ?>
                    </ul>
                    <h4>
                        SE DETECTARON MUESTRAS DE VERDAD:
                    </h4>
                    <ul type="circle">
                        <?php
                        $cont = 0;
                        if (count($result_preguntas) > 0) {
                            $v_param = isset($_GET["v"]) ? $_GET["v"] : "";

                            // Convertir el parámetro 'v' en un array
                            $valores = explode(",", $v_param);

                            foreach ($result_preguntas as $key => $row) {
                                // Verificar si la variable 'v' no está definida o está vacía
                                if (!isset($_GET["v"]) || empty($_GET["v"]) || !in_array($row["cod_pregunta"], $valores)) {
                                    if (strtoupper($row["resultado"]) !== "NO CONFIABLE") {
                                        # code...
                                        $cont++;
                                        echo "<li>" . mb_strtoupper($row["pregunta_poligrafo"], 'UTF-8') . " Su respuesta fué: " . mb_strtoupper($row["respuesta"], 'UTF-8') . "</li>";
                                    }
                                }
                            }

                            echo ($cont <= 0 ? "<li>No se encontraron preguntas registradas de este tipo. </li>" : "");
                        } else {
                            echo "<p>No se encontraron preguntas registradas. </p>";
                        }
                        ?>
                    </ul>


                    <fieldset>
                        <legend><strong>CONCLUSIONES</strong></legend>
                        <p>
                            <?= nl2br(htmlentities($conclusion_examen)) ?>
                        </p>
                    </fieldset>
                    <p>Sin más por el momento, me suscribo de usted agradeciendo su confianza depositada en INVESTIGACIONES Y SEGURIDAD S.A. DE C.V. , essperando servirle nuevamente.
                    </p>

                    <div class="signature">
                        <div class="signature-text">Atentamente,</div>
                        <div class="signature-image-container">
                            <img src="<?= $urlCompleta ?>/vistas/img/plantilla/firma.png" alt="Firma" class="signature-image">
                        </div>
                        <div class="signature-line"></div>
                        <div class="signature-name">JUAN FRANCISCO CONTRERAS AREVALO</div>
                        <div class="signature-title">TÉCNICO POLIGRAFISTA</div>
                    </div>


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
            header('Content-Disposition: inline; filename="' . "EXAMEN POLIGRÁFICO - REF:" .  $codigo_programar_exam . '.pdf"');
            echo $pdf_content;
        }
    }
} else {
    header("location:../../inicio");
}
?>