<?php

class ControladorClienteMorse
{


    /*=============================================
	INGRESAR REGISTRO 
	=============================================*/

    static public function ctrCrearClienteMorse()
    {
        if (isset($_POST["nombre"])) {

            $tabla = "tbl_clientes_morse";
            $datos = [];

            foreach ($_POST as $campo => $valor) {
                // Excluir algunos campos específicos
                $camposExcluidos = ["save_process_clientemorse", "id_edit_clientemorse", "type_action_form"]; // Reemplaza con los campos que deseas excluir
                if (!in_array($campo, $camposExcluidos)) {
                    $datos[$campo] = $valor;
                }
            }

            $respuesta = ClienteMorseModelo::mdlIngresar($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }

            return false;
        }
    }


    static public function ctrEditarClienteMorse()
    {
        if (isset($_POST["nombre"])) {

            $tabla = "tbl_clientes_morse";
            $datos = [];

            foreach ($_POST as $campo => $valor) {
                // Excluir algunos campos específicos
                $camposExcluidos = ["save_process_clientemorse", "id_edit_clientemorse", "type_action_form"]; // Reemplaza con los campos que deseas excluir
                if (!in_array($campo, $camposExcluidos)) {
                    $datos[$campo] = $valor;
                }
            }

            $id = $_POST["id_edit_clientemorse"];

            $respuesta = ClienteMorseModelo::mdlActualizar($tabla, $datos, $id);

            if ($respuesta == "ok") {

                return true;
            }

            return false;
        }
    }

    static public function getDataSelect($tabla, $id)
    {

        $respuesta = ClienteMorseModelo::ObtenerDataSelect($tabla, $id);

        return $respuesta;
    }

    static public function getDataIDLastMorse()
    {

        $respuesta = ClienteMorseModelo::BuscarIDClienteMorseUltimo();

        return $respuesta;
    }


    static public function ctrMostrarClienteMorse($id)
    {

        return ClienteMorseModelo::ObtenerDataEditar($id);
    }

    static public function ExisteRegistro($condicion)
    {
        return ClienteMorseModelo::ExisteRegistro("tbl_examen_clientemorse", $condicion);
    }


    /*=============================================
	BORRAR REGISTROS
	=============================================*/

    static public function ctrBorrarClienteMorse()
    {

        if (isset($_POST["id_clientemorse_delete"])) {

            $tabla = "tbl_clientes_morse";
            $datos = $_POST["id_clientemorse_delete"];
            $respuesta = ClienteMorseModelo::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }

    static public function ctrBorrarTipoExamenMorse($id)
    {
        $tabla = "tbl_examen_clientemorse";
        $datos = $id;
        $respuesta = ClienteMorseModelo::mdlBorrar($tabla, $datos);

        if ($respuesta == "ok") {

            return true;
        }
        return false;
    }


    static public function ctrCrearTipoExamenCliente()
    {

        if (isset($_POST["id_tipo_examen_morse"])) {

            $tabla = "tbl_examen_clientemorse";


            $datos = array(
                "id_tipo_examen" => $_POST["id_tipo_examen_morse"],
                "id_cliente_morse" => $_POST["id_cliente_idtipoexamen"],
                "nuevo_precio" => $_POST["nuevo_precio"]
            );

            $respuesta = ClienteMorseModelo::mdlIngresarClienteExamen($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }
}
