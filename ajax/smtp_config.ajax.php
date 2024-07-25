<?php
session_start();
require_once "../controladores/smtp_config.controlador.php";
require_once "../modelos/smtp_config.modelo.php";


//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";


class AjaxConfiguracionSMTP
{

    /*=============================================
	EDITAR USUARIO
	=============================================*/

    public $idConfiguracion;

    public function ajaxEditarConfiguracionSMTP()
    {

        $campos = "*";
        $tabla = "server_mail_smtp " . $this->idConfiguracion . " LIMIT 1";
        $respuesta = ControladorSMTPConfiguracion::ctrMostrarConfiguracionSMTP($campos, $tabla);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR VENDEDOR
=============================================*/
if (isset($_POST["configuracionsmtp"])) {

    $editar = new AjaxConfiguracionSMTP();

    if (isset($_POST["idsmtp"]) && !empty($_POST["idsmtp"]) && $_POST["idsmtp"] > 0) {
        $editar->idConfiguracion = "WHERE id=" . $_POST["idsmtp"];
    } else {
        $editar->idConfiguracion = "";
    }
    $editar->ajaxEditarConfiguracionSMTP();
}


/*=============================================
EDITAR VENDEDOR
=============================================*/
if (isset($_POST["actualizardatos"])) {


    if (isset($_POST["idsmtp"]) && !empty($_POST["idsmtp"]) && $_POST["idsmtp"] > 0) {

        $datos = array(
            "idsmtp" => $_POST["idsmtp"],
            "server_smtp" => $_POST["smtp_server"],
            "server_puerto" => $_POST["puerto_smtp_server"],
            "titulo_remitente" => $_POST["tituloRemitente"],
            "correo_remitente" => $_POST["correoRemitente"],
            "clave_remitente" => $_POST["remitentePassword"],

        );
        $respuesta = ControladorSMTPConfiguracion::ctrCrearConfiguracionSMTP($datos);
        if ($respuesta) {
            echo "ok";
        } else {
            echo "error";
        }
        /* ACTUALIZAR */
    } else {
        $datos = array(
            "idsmtp" => $_POST["idsmtp"],
            "server_smtp" => $_POST["smtp_server"],
            "server_puerto" => $_POST["puerto_smtp_server"],
            "titulo_remitente" => $_POST["tituloRemitente"],
            "correo_remitente" => $_POST["correoRemitente"],
            "clave_remitente" => $_POST["remitentePassword"],
        );
        /* GUARDAR */
        $respuesta = ControladorSMTPConfiguracion::ctrCrearConfiguracionSMTP($datos);
        if ($respuesta) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}
