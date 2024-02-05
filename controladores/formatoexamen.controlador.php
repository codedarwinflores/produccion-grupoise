<?php
class ControladorFormatoExamen
{


    static public function getDataSelect($tabla, $id)
    {

        $respuesta = ModeloFormatoExamen::ObtenerDataSelect($tabla, $id);

        return $respuesta;
    }



    /* CREAR FORMATO EXAMEN */
    static public function ctrCrearFormatoExamen()
    {

        if (isset($_POST["formato_codigo"]) && isset($_POST["formato_concepto"])) {

            $tabla = "tbl_formato_examenes";
            $datos = array(
                "codigo" => strtoupper($_POST["formato_codigo"]),
                "id_tipo_examen" => $_POST["formato_id_tipo_examen"],
                "id_cliente_morse" => $_POST["formato_id_cliente_morse"],
                "id_usuario" => $_SESSION["id"],
                "concepto" => strtoupper($_POST["formato_concepto"]),
            );

            $respuesta = ModeloFormatoExamen::mdlIngresarFormatoExamen($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrCrearFormatoExamenPregunta()
    {

        if (isset($_POST["formato_pregunta_orden"]) && isset($_POST["id_pregunta_formato_examen"])  && isset($_POST["id_formato_examen_pregunta_id"])) {

            $tabla = "tbl_formato_examen_pregunta";

            $datos = array(
                "id_area" => $_POST["formato_pregunta_area"],
                "test" => $_POST["formato_pregunta_test"],
                "orden" => $_POST["formato_pregunta_orden"],
                "id_pregunta" => $_POST["id_pregunta_formato_examen"],
                "id_formato_examen" => $_POST["id_formato_examen_pregunta_id"],
            );

            $respuesta = ModeloFormatoExamen::mdlIngresarFormatoExamenPreguntas($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrEditarFormatoExamen()
    {

        if (isset($_POST["formato_codigo"]) && isset($_POST["formato_concepto"]) && isset($_POST["id_edit_formatoexamen"])) {

            $tabla = "tbl_formato_examenes";
            $datos = array(
                "codigo" => strtoupper($_POST["formato_codigo"]),
                "id_tipo_examen" => $_POST["formato_id_tipo_examen"],
                "id_cliente_morse" => $_POST["formato_id_cliente_morse"],
                "id_usuario" => $_SESSION["id"],
                "concepto" => strtoupper($_POST["formato_concepto"]),
                "id" => $_POST["id_edit_formatoexamen"],
            );


            $respuesta = ModeloFormatoExamen::mdlEditarFormatoExamen($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrEditarFormatoExamenPreguntas()
    {
        if (isset($_POST["formato_pregunta_orden"]) && isset($_POST["id_pregunta_formato_examen"])  && isset($_POST["id_formato_examen_pregunta_id"]) && isset($_POST["id_edit_formato_examen_pregunta"])) {

            $tabla = "tbl_formato_examen_pregunta";

            $datos = array(
                "id_area" => $_POST["formato_pregunta_area"],
                "test" => $_POST["formato_pregunta_test"],
                "orden" => $_POST["formato_pregunta_orden"],
                "id_pregunta" => $_POST["id_pregunta_formato_examen"],
                "id_formato_examen" => $_POST["id_formato_examen_pregunta_id"],
                "id" => $_POST["id_edit_formato_examen_pregunta"],
            );

            $respuesta = ModeloFormatoExamen::mdlEditarFormatoExamenPregunta($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }

    static public function ExisteRegistroFormatoExamen($condicion)
    {
        return ModeloFormatoExamen::ExisteRegistro("tbl_formato_examenes", $condicion);
    }

    static public function ExisteRegistroFormatoExamenPreguntas($condicion)
    {
        return ModeloFormatoExamen::ExisteRegistro("tbl_formato_examen_pregunta", $condicion);
    }

    static public function ctrMostrarFormatoExamen($item, $valor)
    {

        $tabla = "tbl_formato_examenes";

        $respuesta = ModeloFormatoExamen::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrMostrarFormatoExamenPregunta($item, $valor)
    {

        $tabla = "tbl_formato_examen_pregunta";

        $respuesta = ModeloFormatoExamen::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }


    /*=============================================
	BORRAR REGISTROS
	=============================================*/

    static public function ctrBorrarFormatoExamen()
    {

        if (isset($_POST["id_formatoexamen_delete"])) {

            $tabla = "tbl_formato_examenes";
            $datos = $_POST["id_formatoexamen_delete"];
            $respuesta = ModeloFormatoExamen::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {
                ModeloFormatoExamen::mdlBorrarIDFormarExamenPreguntas("tbl_formato_examen_pregunta", $datos);
                return true;
            }
            return false;
        }
    }



    static public function ctrBorrarFormatoExamenPreguntas()
    {

        if (isset($_POST["idFormatoExamenPregunta_delete"])) {

            $tabla = "tbl_formato_examen_pregunta";
            $datos = $_POST["idFormatoExamenPregunta_delete"];
            $respuesta = ModeloFormatoExamen::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }
}
