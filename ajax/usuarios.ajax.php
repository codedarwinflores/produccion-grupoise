<?php
session_start();
require_once '../extensiones/mail/vendor/autoload.php';
require_once "../controladores/cryptoutils.controlador.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";

class AjaxUsuarios
{

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public $idUsuario;

	public function ajaxEditarUsuario()
	{

		$item = "id";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);
	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	public $activarUsuario;
	public $activarId;


	public function ajaxActivarUsuario()
	{

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/

	public $validarUsuario;

	public function ajaxValidarUsuario()
	{

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR USUARIO
=============================================*/
if (isset($_POST["idUsuario"])) {

	$editar = new AjaxUsuarios();
	$editar->idUsuario = $_POST["idUsuario"];
	$editar->ajaxEditarUsuario();
}

/*=============================================
ACTIVAR USUARIO
=============================================*/

if (isset($_POST["activarUsuario"])) {

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario->activarUsuario = $_POST["activarUsuario"];
	$activarUsuario->activarId = $_POST["activarId"];
	$activarUsuario->ajaxActivarUsuario();
}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST["validarUsuario"])) {

	$valUsuario = new AjaxUsuarios();
	$valUsuario->validarUsuario = $_POST["validarUsuario"];
	$valUsuario->ajaxValidarUsuario();
}


if (isset($_POST["comprobar_user_email"]) && $_POST["comprobar_user_email"] == "evaluar_datos" && $_SESSION['csrf_token'] == $_POST["csrf_token"]) {
	if (!empty($_POST["id_user_desbloquear"]) && !empty($_POST["confirm_usuario"]) && !empty($_POST["confirmar_correo"])) {
		$crypto = new CryptoUtils();
		$id_usuario_search = $crypto->decryptPassword($_POST["id_user_desbloquear"]);
		$usuario = $_POST["confirm_usuario"];
		$confirmar_correo = $_POST["confirmar_correo"];

		$criterios = [
			'id' => $id_usuario_search,
			'usuario' => $usuario,
			'user_correo' => $confirmar_correo
		];
		$resultado = ControladorUsuarios::ctrConsultarDatosUsuarios($criterios);
		if ($resultado) {
			$codigo_token = $crypto->encryptPassword($crypto->generateRandomCode());
			$criterioActualizar = [
				'id' => $id_usuario_search,
				'token_code' => $codigo_token
			];
			$result = ControladorUsuarios::editarToken($criterioActualizar);


			if ($result) {
				/* ENVIAR CORREO */

				// Crea una instancia de la clase Mailer
				$mailer = new Mailer_Send();

				// Define los parámetros del correo
				$to = $criterios["user_correo"];  // Correo del destinatario
				$subject = 'Código de restablecimiento de intentos.';  // Asunto del correo
				$message = 'Hemos recibido una solicitud para restablecer los intentos de tu usuario  ya que se encuentra bloquado.';  // Mensaje del correo
				$token = $crypto->decryptPassword($criterioActualizar["token_code"]);  // Genera un código/token aleatorio
				$user = $criterios["usuario"];

				// Envía el correo
				$sent = $mailer->sendEmail($to, $subject, $message, $token, $user);

				echo $result && $sent ? "success" : "error";
			} else {
				echo "error";
			}
		} else {
			echo "error";
		}
	} else {
		echo "error";
	}
} else if (isset($_POST["comprobar_user_codigo"]) && $_POST["comprobar_user_codigo"] == "evaluar_datos_codigo" && $_SESSION['csrf_token'] == $_POST["csrf_token_code"] && !empty($_POST["confirmar_codigo"])) {

	$crypto = new CryptoUtils();
	$id_usuario_search = $crypto->decryptPassword($_POST["id_user_desbloquear_code"]);
	$usuario = $_POST["user_user_code"];
	$confirmar_correo = $_POST["user_correo_code"];
	$codigo_enviado = $_POST["confirmar_codigo"];


	$criterios = [
		'id' => $id_usuario_search,
		'usuario' => $usuario,
		'user_correo' => $confirmar_correo,
		'token_code' => $codigo_enviado
	];
	$resultado = ControladorUsuarios::ctrConsultarDatosUsuariosCodigo($criterios);
	if (isset($resultado["token_code"]) && $crypto->decryptPassword($resultado["token_code"]) == $criterios["token_code"]) {
		/* Actualizar intentos */
		ControladorUsuarios::reiniciarIntentosToken($criterios);
		echo "success";
	} else {
		echo "error";
	}
} else
if (isset($_POST["comprobar_user_email2FA"]) && $_POST["comprobar_user_email2FA"] == "evaluar_datos2FA" && $_SESSION['csrf_token'] == $_POST["csrf_token2FA"]) {
	if (!empty($_POST["id_user_desbloquear2FA"]) && !empty($_POST["confirm_usuario2FA"]) && !empty($_POST["confirmar_correo2FA"])) {
		$crypto = new CryptoUtils();
		$id_usuario_search = $crypto->decryptPassword($_POST["id_user_desbloquear2FA"]);
		$usuario = $_POST["confirm_usuario2FA"];
		$confirmar_correo = $_POST["confirmar_correo2FA"];

		$criterios = [
			'id' => $id_usuario_search,
			'usuario' => $usuario,
			'user_correo' => $confirmar_correo
		];
		$resultado = ControladorUsuarios::ctrConsultarDatosUsuarios($criterios);
		if ($resultado) {
			$codigo_token = $crypto->encryptPassword($crypto->generateRandomCode());
			$criterioActualizar = [
				'id' => $id_usuario_search,
				'token_code_2fa' => $codigo_token
			];
			$result = ControladorUsuarios::editarToken2FA($criterioActualizar);


			if ($result) {
				/* ENVIAR CORREO */
				// Crea una instancia de la clase Mailer
				$mailer = new Mailer_Send();

				// Define los parámetros del correo
				$to = $criterios["user_correo"];  // Correo del destinatario
				$subject = 'Código para iniciar sesión.';  // Asunto del correo
				$message = 'Hemos recibido una solicitud para iniciar sesión.';  // Mensaje del correo
				$token = $crypto->decryptPassword($criterioActualizar["token_code_2fa"]);  // Genera un código/token aleatorio
				$user = $criterios["usuario"];

				// Envía el correo
				$sent = $mailer->sendEmail($to, $subject, $message, $token, $user);

				echo $result && $sent ? "success" : "error";
			} else {
				echo "error";
			}
		} else {
			echo "error";
		}
	} else {
		echo "error";
	}
} else if (isset($_POST["comprobar_user_codigo2FA"]) && $_POST["comprobar_user_codigo2FA"] == "evaluar_datos_codigo2FA" && $_SESSION['csrf_token'] == $_POST["csrf_token_code2FA"] && !empty($_POST["confirmar_codigo2FA"])) {

	$crypto = new CryptoUtils();
	$id_usuario_search = $crypto->decryptPassword($_POST["id_user_desbloquear_code2FA"]);
	$usuario = $_POST["user_user_code2FA"];
	$confirmar_correo = $_POST["user_correo_code2FA"];
	$codigo_enviado = $_POST["confirmar_codigo2FA"];


	$criterios = [
		'id' => $id_usuario_search,
		'usuario' => $usuario,
		'user_correo' => $confirmar_correo,
		'token_code_2fa' => $codigo_enviado
	];
	$resultado = ControladorUsuarios::ctrConsultarDatosUsuariosCodigo($criterios);
	if (isset($resultado["token_code_2fa"]) && $crypto->decryptPassword($resultado["token_code_2fa"]) == $criterios["token_code_2fa"]) {
		/* Actualizar intentos */
		ControladorUsuarios::reiniciarIntentosToken($criterios);
		$_SESSION["2fa"] = "2fa";

		echo "success";
	} else {
		echo "error";
	}
}
