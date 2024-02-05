<?php
class ControladorCargoCliente
{
    static public function ctrCrearCargoCliente()
    {

        if (isset($_POST["nombre_cargo"])) {

            $tabla = "tbl_cargo_cliente";

            $datos = array(
                "nombre_cargo" => $_POST["nombre_cargo"],
            );

            $respuesta = ModeloCargoCliente::mdlIngresarCargoCliente($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrCrearAreaExamen()
    {

        if (isset($_POST["motivo"])) {

            $tabla = "tbl_area_examen";

            $datos = array(
                "motivo" => $_POST["motivo"],
            );

            $respuesta = ModeloCargoCliente::mdlIngresarAreaExamen($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrEditarCargoCliente()
    {

        if (isset($_POST["nombre_cargo"]) && isset($_POST["id_edit_cargocliente"])) {

            $tabla = "tbl_cargo_cliente";

            $datos = array(
                "nombre_cargo" => $_POST["nombre_cargo"],
                "id" => $_POST["id_edit_cargocliente"],
            );

            $respuesta = ModeloCargoCliente::mdlEditarCargoCliente($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }


    static public function ctrEditarAreaExamen()
    {

        if (isset($_POST["motivo"]) && isset($_POST["id_edit_areaexamen"])) {

            $tabla = "tbl_area_examen";

            $datos = array(
                "motivo" => $_POST["motivo"],
                "id" => $_POST["id_edit_areaexamen"],
            );

            $respuesta = ModeloCargoCliente::mdlEditarAreaExamen($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }

    static public function ExisteRegistro($condicion)
    {
        return ModeloCargoCliente::ExisteRegistro("tbl_cargo_cliente", $condicion);
    }

    static public function ExisteRegistroArea($condicion)
    {
        return ModeloCargoCliente::ExisteRegistro("tbl_area_examen", $condicion);
    }



    static public function ctrMostrarCargoCliente($item, $valor)
    {

        $tabla = "tbl_cargo_cliente";

        $respuesta = ModeloCargoCliente::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrMostrarAreaExamen($item, $valor)
    {

        $tabla = "tbl_area_examen";

        $respuesta = ModeloCargoCliente::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }


    /*=============================================
	BORRAR REGISTROS
	=============================================*/

    static public function ctrBorrarCargoCliente()
    {

        if (isset($_POST["id_cargocliente_delete"])) {

            $tabla = "tbl_cargo_cliente";
            $datos = $_POST["id_cargocliente_delete"];
            $respuesta = ModeloCargoCliente::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }



    static public function ctrBorrarAreaExamen()
    {

        if (isset($_POST["id_area_examen_delete"])) {

            $tabla = "tbl_area_examen";
            $datos = $_POST["id_area_examen_delete"];
            $respuesta = ModeloCargoCliente::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {

                return true;
            }
            return false;
        }
    }
}
