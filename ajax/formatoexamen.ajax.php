<?php
require_once "../modelos/formatoexamen.modelo.php";
require_once "../controladores/formatoexamen.controlador.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";
session_start();
date_default_timezone_set('America/El_Salvador');

class AjaxFormatoExamen
{

    public function AjaxConsultarFormatoExamen()
    {
        $campos = "format_exam.*, CONCAT(tipo_exam.codigo,' - ',tipo_exam.descripcion) as nombre_tipo_exam,CONCAT(client_morse.codigo_cliente,' - ',client_morse.nombre) as nombre_cliente,users.nombre as nombre_user";
        $tabla = "`tbl_formato_examenes` format_exam LEFT JOIN tipos_examenes tipo_exam ON format_exam.id_tipo_examen=tipo_exam.id LEFT JOIN tbl_clientes_morse client_morse ON format_exam.id_cliente_morse=client_morse.id LEFT JOIN usuarios users ON format_exam.id_usuario=users.id";
        $condicion = "1 ";

        $respuesta = ModeloFormatoExamen::MostrarDatos($campos, $tabla, $condicion, "order by id desc");
        return $respuesta;
    }


    public function AjaxConsultarFormatoExamenPregunta($id)
    {
        $campos = "CONCAT(area.codigo,' - ',area.motivo) as area,exam_preg.*, CONCAT(preg.codigo,' - ',preg.pregunta) as pregunta";
        $tabla = "`tbl_formato_examen_pregunta` exam_preg LEFT JOIN tbl_area_examen area ON exam_preg.id_area=area.id LEFT JOIN preguntas preg on exam_preg.id_pregunta=preg.id";
        $condicion = "exam_preg.id_formato_examen=" . $id;

        $respuesta = ModeloFormatoExamen::MostrarDatos($campos, $tabla, $condicion, " order by id desc");
        return $respuesta;
    }


    public function mostrarTablaFormatoExamen()
    {

        $datos = self::AjaxConsultarFormatoExamen();

        $data = array();


        for ($i = 0; $i < count($datos); $i++) {

            $botones = '<div class="btn-group pull-right">
					   <button class="btn btn-warning btn-xs btnEditarFormatoExamen" idFormatoExamen="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalAgregarFormatoExamen"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarFormatoExamen" idFormatoExamen="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $datos[$i]["codigo"],
                ($datos[$i]["nombre_tipo_exam"] != null || !empty($datos[$i]["nombre_tipo_exam"]) ? $datos[$i]["nombre_tipo_exam"] : "---"),
                ($datos[$i]["nombre_cliente"] != null || !empty($datos[$i]["nombre_cliente"]) ? $datos[$i]["nombre_cliente"] : "---"),
                $datos[$i]["concepto"],
                $datos[$i]["fecha_creacion"] != null && $datos[$i]["fecha_creacion"] != "0000-00-00" ? date("d/m/Y", strtotime($datos[$i]["fecha_creacion"])) : "",
                $datos[$i]["nombre_user"],
                $botones,
            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }



    public function mostrarTablaFormatoExamenPregunta($id)
    {

        $datos = self::AjaxConsultarFormatoExamenPregunta($id);

        $data = array();


        for ($i = 0; $i < count($datos); $i++) {

            $botones = '<div class="btn-group pull-right">
					   <button class="btn btn-warning btn-xs btnEditarFormatoExamenPregunta" idFormatoExamenPregunta="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalFormatoExamenPregunta"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarFormatoExamenPregunta" idFormatoExamenPregunta="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $datos[$i]["area"],
                $datos[$i]["test"],
                $datos[$i]["orden"],
                $datos[$i]["pregunta"],
                $botones,
            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    public $idFormatoExamen;

    public function ajaxEditarFormatoExamen()
    {

        $item = "id";
        $valor = $this->idFormatoExamen;

        $respuesta = ControladorFormatoExamen::ctrMostrarFormatoExamen($item, $valor);

        echo json_encode($respuesta);
    }


    public $idFormatoExamenPregunta;

    public function ajaxEditarFormatoExamenPregunta()
    {

        $item = "id";
        $valor = $this->idFormatoExamenPregunta;

        $respuesta = ControladorFormatoExamen::ctrMostrarFormatoExamenPregunta($item, $valor);

        echo json_encode($respuesta);
    }
}



if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["actionsFormatoExamen"]) && $_GET["actionsFormatoExamen"] === "Consult") {

        if (isset($_SESSION["perfil"])) {
            $consultFormatoExamen = new AjaxFormatoExamen();

            $consultFormatoExamen->mostrarTablaFormatoExamen();
        }
    }

    if (isset($_GET["actionsFormatoExamenPregunta"]) && $_GET["actionsFormatoExamenPregunta"] === "Consult" && isset($_GET["id_formato_examen_pregunta"])) {

        if (isset($_SESSION["perfil"])) {
            $consultFormatoExamenPregunta = new AjaxFormatoExamen();

            $id = $_GET["id_formato_examen_pregunta"];

            $consultFormatoExamenPregunta->mostrarTablaFormatoExamenPregunta($id);
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if (isset($_POST["getTipoExamenFormato"]) && $_POST["getTipoExamenFormato"] === "ok") {
        $FormatoExamen = new ControladorFormatoExamen();
        echo $FormatoExamen::getDataSelect("tipos_examenes", "");
    } else
    if (isset($_POST["getClienteMorseFormato"]) && $_POST["getClienteMorseFormato"] === "ok") {
        $FormatoExamen = new ControladorFormatoExamen();
        echo $FormatoExamen::getDataSelect("tbl_clientes_morse", "");
    } else
    if (isset($_POST["getAreaFormatoExamenFormato"]) && $_POST["getAreaFormatoExamenFormato"] === "ok") {
        $FormatoExamen = new ControladorFormatoExamen();
        echo $FormatoExamen::getDataSelect("tbl_area_examen", "");
    } else
    if (isset($_POST["getPreguntasFormatoExamenFormato"]) && $_POST["getPreguntasFormatoExamenFormato"] === "ok") {
        $FormatoExamen = new ControladorFormatoExamen();
        echo $FormatoExamen::getDataSelect("preguntas", "");
    }


    /* GENERAR NUMERO CORRELATIVO */
    if (isset($_POST['generarCodFormatoExamen'])) {
        if ($_POST['generarCodFormatoExamen'] == "correlativo") {
            $codigo = strtoupper($_POST["codigoNewFormatoExamen"]);
            $crear = new ControladorFormatoExamen();
            $result = $crear->ExisteRegistroFormatoExamen("UPPER(codigo)=UPPER('" . $_POST["codigoNewFormatoExamen"] . "')");
            if ($result > 0) {
                // El código existe en la base de datos
                echo "existe";
            } else {
                // El código no existe en la base de datos
                echo $codigo;
            }
        }
    }

    /*=============================================
        CREAR FORMATO EXAMEN
    =============================================*/
    if (isset($_POST["save_process_formatoexamen"]) && $_POST["save_process_formatoexamen"] === "ok" && isset($_POST["type_action_form_formatoexamen"]) && isset($_POST["id_edit_formatoexamen"])) {

        if ($_POST["id_edit_formatoexamen"] === "0"  && $_POST["type_action_form_formatoexamen"] === "save") {
            $crear = new ControladorFormatoExamen();

            if ($crear->ExisteRegistroFormatoExamen("UPPER(concepto)=UPPER('" . $_POST["formato_concepto"] . "') OR UPPER(codigo)=UPPER('" . $_POST["formato_codigo"] . "')") > 0) {
                echo "existe";
            } else {
                if ($crear->ctrCrearFormatoExamen()) {

                    logs_msg("Tabla Formato Examenes", "Crear Formato Examen");
                    echo "save";
                } else {
                    echo "error";
                }
            }
        } else if ($_POST["id_edit_formatoexamen"] > "0"  && $_POST["type_action_form_formatoexamen"] === "update") {

            $editar = new ControladorFormatoExamen();

            if ($editar->ExisteRegistroFormatoExamen("((UPPER(concepto)=UPPER('" . $_POST["formato_concepto"] . "') OR UPPER(codigo)='" . $_POST["formato_codigo"] . "')) and id!=" . $_POST["id_edit_formatoexamen"]) > 0) {
                echo "existe";
            } else {
                if ($editar->ctrEditarFormatoExamen()) {
                    logs_msg("Tabla Formato Examenes", "Editar Formato exameness: ID= " . $_POST["id_edit_formatoexamen"]);
                    echo "update";
                } else {
                    echo "error";
                }
            }
        }
    }


    /*=============================================
        CREAR FORMATO EXAMEN PREGUNTA
    =============================================*/
    if (
        isset($_POST["save_process_formato_examen_pregunta"]) && $_POST["save_process_formato_examen_pregunta"] === "ok" && isset($_POST["type_action_formato_examen_pregunta"]) && isset($_POST["id_edit_formato_examen_pregunta"]) && isset($_POST["id_formato_examen_pregunta_id"]) && $_POST["id_formato_examen_pregunta_id"] > 0
    ) {

        if ($_POST["id_edit_formato_examen_pregunta"] === "0"  && $_POST["type_action_formato_examen_pregunta"] === "save") {
            $crear = new ControladorFormatoExamen();

            if ($crear->ExisteRegistroFormatoExamenPreguntas("(orden='" . $_POST["formato_pregunta_orden"] . "' or id_pregunta='" . $_POST["id_pregunta_formato_examen"] . "') and id_formato_examen='" . $_POST["id_formato_examen_pregunta_id"] . "'")) {
                echo "existe";
            } else {
                if ($crear->ctrCrearFormatoExamenPregunta()) {

                    logs_msg("Tabla Formato Examen Preguntas", "Crear Pregunta en Formato examen");
                    echo "save";
                } else {
                    echo "error";
                }
            }
        } else if ($_POST["id_edit_formato_examen_pregunta"] > "0"  && $_POST["type_action_formato_examen_pregunta"] === "update") {

            $editar = new ControladorFormatoExamen();

            if ($editar->ExisteRegistroFormatoExamenPreguntas("(orden='" . $_POST["formato_pregunta_orden"] . "' or id_pregunta='" . $_POST["id_pregunta_formato_examen"] . "') and id_formato_examen='" . $_POST["id_formato_examen_pregunta_id"] . "' and id!=" . $_POST["id_edit_formato_examen_pregunta"]) > 0) {
                echo "existe";
            } else {
                if ($editar->ctrEditarFormatoExamenPreguntas()) {
                    logs_msg("Tabla Formato Examen Preguntas", "Editar Formato Examen Preguntas: ID= " . $_POST["id_edit_formato_examen_pregunta"]);
                    echo "update";
                } else {
                    echo "error";
                }
            }
        }
    }


    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_formato_examen"]) && is_numeric($_POST["id_formato_examen"])) {
        $editar = new AjaxFormatoExamen();
        $editar->idFormatoExamen = $_POST["id_formato_examen"];
        $editar->ajaxEditarFormatoExamen();
    }


    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_formato_examen_update_pregunta"]) && is_numeric($_POST["id_formato_examen_update_pregunta"])) {
        $editar = new AjaxFormatoExamen();
        $editar->idFormatoExamenPregunta = $_POST["id_formato_examen_update_pregunta"];
        $editar->ajaxEditarFormatoExamenPregunta();
    }


    /* ELIMINAR */
    if (isset($_POST["id_formatoexamen_delete"]) && $_POST["id_formatoexamen_delete"] > 0) {
        $borrar = new ControladorFormatoExamen();
        if ($borrar->ctrBorrarFormatoExamen()) {
            logs_msg("Tabla tbl_formato_examenes", "Eliminar Formato Examenes: ID= " . $_POST["id_formatoexamen_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    }


    if (isset($_POST["idFormatoExamenPregunta_delete"]) && $_POST["idFormatoExamenPregunta_delete"] > 0) {
        $borrar = new ControladorFormatoExamen();
        if ($borrar->ctrBorrarFormatoExamenPreguntas()) {
            logs_msg("Tabla preguntas", "Eliminar pregunta: ID= " . $_POST["idFormatoExamenPregunta_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    }
}
