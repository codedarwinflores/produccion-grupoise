<?php
require_once "../modelos/horario.modelo.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";
session_start();
date_default_timezone_set('America/El_Salvador');
// Ahora puedes usar funciones de fecha y hora en El Salvador




class AjaxConsultarHorario
{

    public $id_poligrafista;
    public $fecha_inicio;
    public $fecha_fin;

    public function AjaxConsultarCalendar()
    {

        $valor = $this->id_poligrafista;
        $condicion = "";

        if (!empty($valor) && $valor !== null) {
            $condicion = "id_poligrafista=" . $valor;
        }

        $between = "";

        $fecha1 = $this->fecha_inicio;
        $fecha2 = $this->fecha_fin;

        if (!empty($fecha1) && !empty($fecha2)) {
            if ($fecha2 < $fecha1) {
                $temp = $fecha1; // Almacena temporalmente $fecha1 en una variable temporal
                $fecha1 = $fecha2; // Asigna $fecha2 a $fecha1
                $fecha2 = $temp; // Asigna el valor original de $fecha1 a $fecha2
            }
            $between = "DATE_FORMAT(fecha_programada, '%Y-%m-%d') BETWEEN '" . $fecha1 . "' AND '" . $fecha2 . "'";
        } elseif (!empty($fecha1) && empty($fecha2)) {
            $between = "DATE_FORMAT(fecha_programada, '%Y-%m-%d') BETWEEN '" . $fecha1 . "' AND '" . $fecha1 . "'";
        } elseif (empty($fecha1) && !empty($fecha2)) {
            $between = "DATE_FORMAT(fecha_programada, '%Y-%m-%d') BETWEEN '" . $fecha2 . "' AND '" . $fecha2 . "'";
        }

        $condicionFinal = "";
        if (!empty($condicion) && !empty($between)) {
            $condicionFinal = $between . " AND " . $condicion;
        } else  if (!empty($between)) {
            $condicionFinal = $between;
        } else {
            $condicionFinal = $condicion;
        }


        $condicionFinal = $condicionFinal;

        $campos = "pol.estado_exam,pol.id_registro,pol.fecha_programada,pol.hora_programada,pol.hora_ingreso,pol.hora_inicio,pol.hora_finalizo, concat(evas.codigo,' - ',evas.nombres,' ',evas.primer_apellido,' ',evas.segundo_apellido) as nombre_evaluado, concat(morse.codigo_cliente,' - ',morse.nombre) as nombre_cliente, CONCAT(emp.codigo_empleado,' - ',emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as nombre_pol, concat(tipoexam.codigo,' - ',tipoexam.descripcion,' $',tipoexam.valor) as examenes";
        $tabla = "`tbl_poligrafo` pol LEFT JOIN evaluados evas ON pol.id_evaluado = evas.id LEFT JOIN tbl_clientes_morse morse ON POL.id_cliente=morse.id LEFT JOIN tbl_empleados emp on pol.id_poligrafista = emp.id LEFT JOIN tipos_examenes tipoexam on pol.id_tipo_examen=tipoexam.id";

        $respuesta = ModeloHorario::MostrarDatos($campos, $tabla, $condicionFinal, " ORDER BY fecha_programada DESC, hora_programada DESC, estado_exam DESC;");
        return $respuesta;
    }



    public function mostrarTablaHorario()
    {

        $datos = self::AjaxConsultarCalendar();


        $data = array();

        $botones = "";
        $estado = "";
        $clase = "";
        $fechaActual = date('Y-m-d');
        for ($i = 0; $i < count($datos); $i++) {
            $clase = "default";
            if (strtoupper($datos[$i]["estado_exam"]) === "EN PROCESO") {
                $clase = "warning";
            } else if (strtoupper($datos[$i]["estado_exam"]) === "FINALIZADO") {
                $clase = "success";
            }

            $botones = "";
            $botones .= '<div class="btn-group pull-right" ><button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-th-list" aria-hidden="true"></i>&nbsp;<span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
            if ($_SESSION["perfil"] === "Administrador" || $datos[$i]["fecha_programada"] >= $fechaActual) {
                $botones .= "<li><a href='#' class='btn-procesar-reserva' id_registro='" . $datos[$i]["id_registro"] . "' data-toggle='modal' data-target='#procesarReservaProgramada'><i class='fa fa-building-o'></i> Procesar</a></li><li><a href='#' onclick='alert(\"En desarrollo... \")'><i class='fa fa-trash-o'></i> Eliminar</a></li>";
            }

            $botones .= "<li><a href='#'  onclick='alert(\"En desarrollo.. \")'><i class='fa fa-eye'></i>Ver</a></li></ul></div>";
            $estado = "<button class='btn btn-$clase btn-xs  btn-short-text' title='" . $datos[$i]["estado_exam"] . "'>" . $datos[$i]["estado_exam"] . "</button>";

            $row = array(
                $i + 1,
                $datos[$i]["id_registro"],
                !empty($datos[$i]["nombre_cliente"]) ? $datos[$i]["nombre_cliente"] : "---",
                !empty($datos[$i]["nombre_evaluado"]) ? $datos[$i]["nombre_evaluado"] : "---",
                !empty($datos[$i]["nombre_pol"]) ? $datos[$i]["nombre_pol"] : "---",
                !empty($datos[$i]["examenes"]) ? $datos[$i]["examenes"] : "---",
                $datos[$i]["fecha_programada"],
                $datos[$i]["hora_programada"],
                $datos[$i]["hora_ingreso"],
                $datos[$i]["hora_inicio"],
                $datos[$i]["hora_finalizo"],
                $estado,
                $botones,

            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {


    /* CONSULTAR POLIGRAFISTA */
    if (isset($_GET["action"]) && $_GET["action"] === "obtenerData") {

        $campos = "emp.id as id_select,emp.codigo_empleado, CONCAT(emp.codigo_empleado,' - ',emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as title,cargos.*";
        $tabla = "`tbl_empleados` emp INNER JOIN cargos_desempenados cargos on emp.nivel_cargo = cargos.id";
        $condicion = "cargos.descripcion='POLIGRAFIA' order by codigo_empleado desc";
        echo  ModeloHorario::obtenerDatosdeTabla($campos, $tabla, $condicion);
    } else if (isset($_GET["action"]) && $_GET["action"] === "obtenerDataEvaluados") {

        $campos = "id as id_select, concat(codigo,'- ',nombres,' ',primer_apellido,' ',segundo_apellido) as title";
        $tabla = "evaluados";
        $condicion = "1 order by id desc";
        echo  ModeloHorario::obtenerDatosdeTabla($campos, $tabla, $condicion);
    } else if (isset($_GET["action"]) && $_GET["action"] === "obtenerDataTipoExamen") {

        $campos = "id as id_select, concat(codigo,' - ',descripcion,' $',valor) as title";
        $tabla = "tipos_examenes";
        $condicion = "1 order by id desc";
        echo  ModeloHorario::obtenerDatosdeTabla($campos, $tabla, $condicion);
    } else if (isset($_GET["action"]) && $_GET["action"] === "obtenerClientes") {

        $campos = "id as id_select, concat(codigo_cliente,' - ',nombre) as title";
        $tabla = "tbl_clientes_morse";
        $condicion = "1 order by id desc";
        echo  ModeloHorario::obtenerDatosdeTabla($campos, $tabla, $condicion);
    }


    if (isset($_GET["id_poligrafista"]) && $_GET["actionsPol"]) {

        if (isset($_SESSION["perfil"])) {
            $consultHorario = new AjaxConsultarHorario();
            $consultHorario->id_poligrafista = is_numeric($_GET["id_poligrafista"]) ? $_GET["id_poligrafista"] : null;
            $consultHorario->fecha_inicio =  (DateTime::createFromFormat('Y-m-d', $_GET["fecha_inicio_programada"]) ? $_GET["fecha_inicio_programada"] : null);;
            $consultHorario->fecha_fin  =   (DateTime::createFromFormat('Y-m-d', $_GET["fecha_fin_programada"]) ? $_GET["fecha_fin_programada"] : null);
            $consultHorario->mostrarTablaHorario();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function generarHorario($horaInicial, $horaFinal, $intervaloMinutos)
    {
        try {

            /* VACIAR TABLA */
            ModeloHorario::vaciarTablaHora();

            logs_msg("Tabla de horarios", "Restablecer tabla horas");

            // Convertir las horas a objetos DateTime
            $horaInicio = DateTime::createFromFormat('H:i', $horaInicial);
            $horaFin = DateTime::createFromFormat('H:i', $horaFinal);

            // Inicializar un array para almacenar el horario
            $horario = array();

            // Crear un bucle para iterar a través de los intervalos de tiempo
            $intervalo = new DateInterval("PT{$intervaloMinutos}M");
            $horaActual = clone $horaInicio;

            while ($horaActual <= $horaFin) {
                // Obtener la hora actual en formato de cadena
                $horaActualStr = $horaActual->format('H:i');

                // Calcular la hora final del intervalo
                $horaFinalIntervalo = $horaActual->add($intervalo);

                // Verificar si la hora final del intervalo sobrepasa la hora final
                if ($horaFinalIntervalo > $horaFin) {
                    // Ajustar la hora final del intervalo para que sea igual a la hora final
                    $horaFinalIntervalo = $horaFin;
                }
                if ($horaActualStr !== $horaFinalIntervalo->format('H:i')) {
                    # code...

                    /* insertar datos a la tabla */
                    $datos = array(
                        "hora_inicial" => $horaActualStr,
                        "hora_final" => $horaFinalIntervalo->format('H:i')
                    );
                    ModeloHorario::insertarHorario($datos);

                    // Avanzar al siguiente intervalo
                    $horaActual = DateTime::createFromFormat('H:i', $horaActualStr)->add($intervalo);
                }
            }


            logs_msg("Tabla de horarios", "Horario generado exitosamente");
            return true; // Indicar éxito en la generación del horario
        } catch (Exception $e) {
            // Manejar la excepción y devolver un mensaje de error
            return 'Error al generar el horario: ' . $e->getMessage();
        }
    }
    /* ACTUALIZAR DATA */
    if (isset($_POST["procesar_data"]) && $_POST["procesar_data"] === "_update") {
        $campo = $_POST["name"];
        $valor = $_POST["value"];
        $pk = $_POST["pk"];

        if (ModeloHorario::UpdateTblPoligrafo($campo, $valor, $pk)) {
            echo json_encode(["status" => "ok"]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    }

    /* INSERTAR UNA SOLA VEZ EL REGISTRO */
    if (isset($_POST["accion"]) && $_POST["accion"] === "NewInsert") {

        if (ModeloHorario::InsertDataNew("")) {
            echo "ok";
        } else {
            echo "error";
        }
    }


    if (isset($_POST["_form_process"]) && isset($_POST["cantPoligrafos"]) && isset($_POST["start_datetime"]) && $_POST["_form_process"] === "procesar") {


        $fechaActual = date('Y-m-d');
        $fechaProgramar = $_POST["start_datetime"];
        $cantPol = $_POST["cantPoligrafos"];


        if ($fechaProgramar < $fechaActual) {
            echo "fechaMenor";
        } else {


            if (isset($_POST["horariopredeterminado"])) {
                for ($i = 0; $i < $cantPol; $i++) {
                    ModeloHorario::InsertDataNewHorario($fechaProgramar);
                }
                echo "ok";
            } else {
                for ($i = 0; $i < $cantPol; $i++) {
                    ModeloHorario::InsertDataNew($fechaProgramar);
                }
                echo "ok";
            }
        }
    }



    if (isset($_POST["id_hora"]) && is_numeric($_POST["id_hora"]) && isset($_POST["delete"]) && $_POST["delete"] === "ok") {
        try {
            // Output the JSON data
            logs_msg("Horario", "Intérvalo de hora eliminada");
            echo ModeloHorario::eliminarRegistro($_POST["id_hora"]);
        } catch (PDOException $e) {
            // Manejar errores de la base de datos de manera adecuada
            $jsonData = json_encode(["status" => "error", "message" => $e->getMessage()]);
            echo $jsonData;
        }
    } else if (isset($_POST["idhora"]) && is_numeric($_POST["idhora"])) {
        /* OBTENER HORARIO POR ID PARA EDITAR */
        echo ModeloHorario::ObtenerHorarioID($_POST["idhora"]);
    } else if (isset($_POST["id_registro_search"]) && is_numeric($_POST["id_registro_search"])) {
        /* OBTENER HORARIO POR ID PARA EDITAR */
        echo ModeloHorario::ObtenerrReservaPoligrafoID($_POST["id_registro_search"]);
    } else    if (isset($_POST["form-intervalo"]) && isset($_POST["id_intervalo"])) {

        /* GUARDAR Y EDITAR INTEÉRVALO DE HORA */
        // Conectar a la base de datos
        $conexion = Conexion::conectar();
        // Insertar en la base de datos
        // Supongamos que los valores de $_POST["hora_inicial"] y $_POST["hora_final"] son las fechas en formato 'Y-m-d H:i:s'
        $horaInicial = $_POST["hora_inicial"];
        $horaFinal = $_POST["hora_final"];
        $id = $_POST["id_intervalo"];

        if ($horaInicial >= $horaFinal) {
            echo "validar";
        } else {
            if ($_POST["form-intervalo"] === "add" && $_POST["id_intervalo"] == 0) {

                // Consulta para verificar si ya existe un registro con la misma fecha inicial y final
                $datos = array(
                    "hora_inicial" => $horaInicial,
                    "hora_final" => $horaFinal
                );

                $resulta = ModeloHorario::ComprobarExisteRegistro($datos);

                if ($resulta['total'] == 0) {
                    // No existe un registro con la misma fecha inicial y final, entonces puedes proceder con la inserción
                    ModeloHorario::insertarHorario($datos);
                    logs_msg("Tabla de horarios", "Insertar intérvalo de horario");

                    echo "save";
                } else {
                    // Ya existe un registro con la misma fecha inicial y final
                    echo "existe";
                }
            } else if ($_POST["form-intervalo"] === "edit" && $_POST["id_intervalo"] > 0) {
                // Consulta para verificar si ya existe un registro con la misma fecha inicial y final
                $datos = array(
                    "hora_inicial" => $horaInicial,
                    "hora_final" => $horaFinal,
                    "id" => $id,
                );

                ModeloHorario::UpdateHorario($datos);
                logs_msg("Tabla de horarios", "Editar intérvalo de horario");
                echo "update";
            } else {
                echo "error";
            }
        }
    } else if (isset($_POST["generarHorario"]) && $_POST["generarHorario"] === "crear") {

        // Ejemplo de uso
        $horaInicial = $_POST["hora_inicial"];
        $horaFinal = $_POST["hora_final"];

        $intervaloMinutos = $_POST["intervalo"];

        // Llamar a la función para generar y guardar el horario en la base de datos
        generarHorario($horaInicial, $horaFinal, $intervaloMinutos);

        echo "horarioGenerado";
    } else if (isset($_POST["gethoras"]) && $_POST["gethoras"] === "tblhoras") {
?>

        <table class="table table-bordered table-condensed table-striped table-hover tablaedit">
            <thead class="bg-blue-gradient">
                <tr>
                    <th width="6%">N°</th>
                    <th>Horario</th>
                    <th width="15%">Acciones</th>
                </tr>
            </thead>

            <body>
                <?php
                $resultado = ModeloHorario::ObtenerHorario();
                foreach ($resultado as $key => $row) {
                ?>
                    <tr>
                        <td><?php echo ($key + 1) ?></td>
                        <td><?php echo date("h:i A", strtotime($row["hora_inicial"])) . " - " . date("h:i A", strtotime($row["hora_final"])) ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm btn-editar-hora" onclick="editarHora(<?php echo $row['id_hora']; ?>);" data-toggle="modal" data-target="#saveedit"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteHour(<?php echo $row['id_hora']; ?>)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>

                <?php } ?>
            </body>
        </table>
    <?php
    } else if (isset($_POST["getPreguntas"]) && $_POST["getPreguntas"] === "preguntas") {
    ?>

        <table class="table table-bordered table-condensed table-striped table-hover tablaedit">
            <thead class="bg-blue-gradient">
                <tr>
                    <th width="4%">N°</th>
                    <th width="4%">COD</th>
                    <th>Pregunta</th>
                    <th width="6%">Resp.</th>
                    <th width="10%">Resultado</th>
                    <th width="20%">Observación</th>
                </tr>
            </thead>

            <body>
                <?php
                $resultado = ModeloHorario::ObtenerPreguntas();
                foreach ($resultado as $key => $row) {
                ?>
                    <tr>
                        <td><?php echo ($key + 1) ?></td>
                        <td><?php echo "0000" . $row["id"] ?></td>
                        <td><textarea class="form-control input-lg"><?php echo $row["pregunta"] ?></textarea></td>
                        <td><select class="form-control input-lg">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </td>

                        <td><select class="form-control input-lg">
                                <option value="Confiable">Confiable</option>
                                <option value="No Confiable">No confiable</option>
                            </select>
                        </td>

                        <td>
                            <textarea class="form-control input-lg" placeholder="Observación"></textarea>
                        </td>
                    </tr>

                <?php } ?>
            </body>
        </table>
<?php
    }
}