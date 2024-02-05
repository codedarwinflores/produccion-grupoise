<?php
class ControladorPreguntaGeneral
{


    /* CREAR TIPO PREGUNTA */
    static public function ctrCrearTipoPregunta()
    {

        if (isset($_POST["tipo_p_codigo"]) && isset($_POST["tipo_p_descripcion"])) {

            $tabla = "tipos_preguntas";

            $datos = array(
                "codigo" => strtoupper($_POST["tipo_p_codigo"]),
                "descripcion" => strtoupper($_POST["tipo_p_descripcion"]),
            );

            $respuesta = ModeloPreguntaGeneral::mdlIngresarTipopregunta($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrCrearPregunta()
    {

        if (isset($_POST["id_tipo_pregunta_id"]) && isset($_POST["pregunta_pregunta"])) {

            $tabla = "preguntas";

            $datos = array(
                "id_tipo" => $_POST["id_tipo_pregunta_id"],
                "pregunta" => strtoupper($_POST["pregunta_pregunta"]),
            );

            $respuesta = ModeloPreguntaGeneral::mdlIngresarPreguntas($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrEditarTipoPregunta()
    {

        if (isset($_POST["tipo_p_codigo"]) && isset($_POST["tipo_p_descripcion"]) && isset($_POST["id_edit_tipopregunta"])) {

            $tabla = "tipos_preguntas";

            $datos = array(
                "codigo" => $_POST["tipo_p_codigo"],
                "descripcion" => $_POST["tipo_p_descripcion"],
                "id" => $_POST["id_edit_tipopregunta"],
            );

            $respuesta = ModeloPreguntaGeneral::mdlEditarTipoPregunta($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrEditarPreguntas()
    {

        if (isset($_POST["id_tipo_pregunta_id"]) && isset($_POST["pregunta_pregunta"]) && isset($_POST["id_edit_pregunta"])) {

            $tabla = "preguntas";

            $datos = array(
                "id_tipo" => strtoupper($_POST["id_tipo_pregunta_id"]),
                "pregunta" => strtoupper($_POST["pregunta_pregunta"]),
                "id" => $_POST["id_edit_pregunta"],
            );

            $respuesta = ModeloPreguntaGeneral::mdlEditarPregunta($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }

    static public function ExisteRegistroTipoPregunta($condicion)
    {
        return ModeloPreguntaGeneral::ExisteRegistro("tipos_preguntas", $condicion);
    }

    static public function ExisteRegistroPreguntas($condicion)
    {
        return ModeloPreguntaGeneral::ExisteRegistro("preguntas", $condicion);
    }



    static public function ctrMostrarTipopregunta($item, $valor)
    {

        $tabla = "tipos_preguntas";

        $respuesta = ModeloPreguntaGeneral::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrMostrarPregunta($item, $valor)
    {

        $tabla = "preguntas";

        $respuesta = ModeloPreguntaGeneral::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }


    /*=============================================
	BORRAR REGISTROS
	=============================================*/

    static public function ctrBorrarTipoPregunta()
    {

        if (isset($_POST["id_tipopregunta_delete"])) {

            $tabla = "tipos_preguntas";
            $datos = $_POST["id_tipopregunta_delete"];
            $respuesta = ModeloPreguntaGeneral::mdlBorrar($tabla, $datos);


            if ($respuesta == "ok") {
                ModeloPreguntaGeneral::mdlBorrarIDTipoPreguntas("preguntas", $datos);
                return true;
            }
            return false;
        }
    }



    static public function ctrBorrarPreguntas()
    {

        if (isset($_POST["id_pregunta_delete"])) {

            $tabla = "preguntas";
            $datos = $_POST["id_pregunta_delete"];
            $respuesta = ModeloPreguntaGeneral::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }
}
