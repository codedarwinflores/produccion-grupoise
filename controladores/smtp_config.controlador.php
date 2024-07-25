<?php

class ControladorSMTPConfiguracion
{



    /*=============================================
	MOSTRAR CLIENTES
	=============================================*/

    static public function ctrMostrarConfiguracionSMTP($campos, $tabla)
    {

        $respuesta = ModeloConfigSMTP::mdlMostrarConfigSMTP($campos, $tabla);

        return $respuesta;
    }


    static public function ctrCrearConfiguracionSMTP($datos)
    {

        $tabla = "server_mail_smtp";

        $respuesta = ModeloConfigSMTP::mdlIngresarConfigSMTP($tabla, $datos);

        if ($respuesta) {
            return true;
        } else {
            return false;
        }
    }
}
