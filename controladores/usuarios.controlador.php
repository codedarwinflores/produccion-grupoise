<?php

class RequestTracker
{
	private $maxRequests;
	private $timeLimit;

	public function __construct($maxRequests = 9, $timeLimit = 300)
	{
		$this->maxRequests = $maxRequests;
		$this->timeLimit = $timeLimit;

		if (!isset($_SESSION['request_count'])) {
			$_SESSION['request_count'] = 0;
			$_SESSION['first_request_time'] = time();
		}
	}

	public function logRequest()
	{
		$current_time = time();
		$elapsed_time = $current_time - $_SESSION['first_request_time'];

		if ($elapsed_time > $this->timeLimit) {
			// Reiniciar el contador de peticiones y el tiempo de la primera petición
			$_SESSION['request_count'] = 1; // Contamos la petición actual
			$_SESSION['first_request_time'] = $current_time;
			return true;
		}

		$_SESSION['request_count']++;

		if ($_SESSION['request_count'] > $this->maxRequests) {
			return false;
		}

		return true;
	}

	public function getRequestCount()
	{
		$current_time = time();
		$elapsed_time = $current_time - $_SESSION['first_request_time'];

		if ($elapsed_time > $this->timeLimit) {
			// Reiniciar el contador de peticiones y el tiempo de la primera petición
			$_SESSION['request_count'] = 0;
			$_SESSION['first_request_time'] = $current_time;
		}

		return $_SESSION['request_count'];
	}

	public function getTimeUntilReset()
	{
		$current_time = time();
		$elapsed_time = $current_time - $_SESSION['first_request_time'];
		return max(0, $this->timeLimit - $elapsed_time);
	}
}






class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function alertMensaje($tipo, $icono, $titulo, $mensaje)
	{
		return  '<div class="alert alert-' . $tipo . '">
      <div class="row">
        <div class="col-xs-2 text-center">
          <span class="fa ' . $icono . '" style="font-size: 40px;" aria-hidden="true"></span>
        </div>
        <div class="col-xs-10">
          <strong>' . $titulo . '</strong><br>
          ' . $mensaje . '
        </div>
      </div>
    </div>';
	}

	static public function mostrarCorreoParcial($correo)
	{
		$posicionArroba = strpos($correo, '@');
		if ($posicionArroba === false) {
			// Manejo de error: no es un correo válido
			return 'Correo inválido';
		}

		$parteVisible = substr($correo, 0, 1); // Mostrar solo el primer carácter
		$oculto = str_repeat('*', $posicionArroba - 1); // Ocultar todo hasta el '@'
		$dominio = substr($correo, $posicionArroba); // Mantener el dominio visible

		return $parteVisible . $oculto . $dominio;
	}


	static public function mostrarUsuarioParcial($usuario)
	{
		$longitud = strlen($usuario);
		if ($longitud <= 4) {
			// Si el nombre de usuario es muy corto, mostrar solo el primer carácter
			$parteVisible = substr($usuario, 0, 1);
			$oculto = str_repeat('*', $longitud - 1);
		} else {
			// Mostrar solo el primer carácter y los dos últimos caracteres
			$parteVisibleInicio = substr($usuario, 0, 1);
			$parteVisibleFin = substr($usuario, -1);
			$oculto = str_repeat('*', $longitud - 2);
			$parteVisible = $parteVisibleInicio . $oculto . $parteVisibleFin;
		}

		return $parteVisible;
	}


	static public function ctrIngresoUsuario()
	{

		if (
			isset($_POST["ingUsuario"]) &&
			isset($_SESSION['csrf_token']) &&
			isset($_POST["captchaText"])
		) {


			$tracker = new RequestTracker();

			if (!$tracker->logRequest()) {
				$current_time = time();
				$_SESSION['first_request_time'] = $current_time;
				echo "<script>location.href = 'ingreso';</script>";
				exit();
			}

			/* CONSULTAR POR MEDIO DE DE USUARIO */
			$encriptar = crypt(htmlspecialchars($_POST["ingPassword"], ENT_QUOTES, 'UTF-8'), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			$tabla = "usuarios";
			$item = "usuario";
			$valor = htmlspecialchars($_POST["ingUsuario"], ENT_QUOTES, "UTF-8");
			$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
			$correo = (isset($respuesta["user_correo"]) ? $respuesta["user_correo"] : "");


			if (isset($respuesta["intento"]) && $respuesta["intento"] <= 3 && count($respuesta) > 0) {

				if (
					preg_match('/^[a-zA-Z0-9_]+$/', $_POST["ingUsuario"]) &&
					$_POST["ingPassword"]
					&& $_POST['csrf_token'] == $_SESSION['csrf_token'] && ($_POST["captchaText"] == $_SESSION['code_confirmation'])
				) {



					if ($respuesta["usuario"] == $valor && $respuesta["password"] == $encriptar) {

						if ($respuesta["estado"] == 1) {

							$_SESSION["iniciarSesion"] = "ok";
							$_SESSION["id"] = $respuesta["id"];
							$_SESSION["nombre"] = $respuesta["nombre"];
							$_SESSION["usuario"] = $respuesta["usuario"];
							$_SESSION["foto"] = $respuesta["foto"];
							$_SESSION["perfil"] = $respuesta["perfil"];

							/*=============================================
							REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
							=============================================*/

							date_default_timezone_set('America/El_Salvador');

							$fecha = date('Y-m-d');
							$hora = date('H:i:s');

							$fechaActual = $fecha . ' ' . $hora;

							$item1 = "ultimo_login";
							$valor1 = $fechaActual;

							$item2 = "id";
							$valor2 = $respuesta["id"];

							$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

							if ($ultimoLogin == "ok") {





								if (isset($respuesta["id"]) && isset($respuesta["usuario"])) {
									$criterios = [
										'id' => $respuesta["id"],
										'usuario' => $respuesta["usuario"],
										'condicion' => "decrementar",
									];

									self::incrementarIntentos($criterios);
								}
								if (isset($respuesta["2fa"]) && $respuesta["2fa"] == "1") {
									if (ModeloLogsUser::IngresarLogs(array("id_usuario" => $respuesta["id"]))) {
										$ultimoIDLogs = ModeloLogsUser::LogsObtenerUltimoRegistro();
										$_SESSION["id_logs"] = $ultimoIDLogs;
										ModeloLogsUser::IngresarActionsLogs(array("id_logs" => $ultimoIDLogs, "modulo" => "Usuario", "actividad" => "Inicio de Sesión Exitoso"));
									}
									$crypto = new CryptoUtils();
									$id_usuario_search = $crypto->encryptPassword($respuesta["id"]);
									echo self::alertMensaje("primary bg-black-gradient", "fa fa-shield", "Autenticación de 2FA activada:", "<ul>
				<li>Este usuario:  <strong>" . self::mostrarUsuarioParcial($valor) . "</strong>, tiene activo <strong>2FA</strong>.</li>
				<li>¿Desea envíar código de 8 dígitos a su correo <strong>" . self::mostrarCorreoParcial($correo) . "</strong> para hacer la verificación? <button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#emailModal2FA' title='Enviar o reenviar código'>
                        <i class='fa fa-send-o'></i>
                    </button>
					</li>
					
				<li>Comuniquese con el administrador o soporte técnico.</li>
		<li>
				 <!-- Modal -->
        <div id='emailModal2FA' class='modal fade bg-black-gradient' role='dialog'>
            <div class='modal-dialog'>

                <!-- Modal content-->
                <div class='modal-content' style='color: #000 !important'>
                    <div class='modal-header bg-navy'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4 class='modal-title'><i class='fa fa-qrcode'></i> Enviar código para iniciar sesión</h4>
                    </div>
                    <div class='modal-body'>
					  <div id='mensaje_enviar2FA'></div>
        <form id='emailForm2FA' method='post' autocomplete='off'>
		<input type='hidden' value='" . $_SESSION['csrf_token'] . "' name='csrf_token2FA' >
		<input type='hidden' value='" . $id_usuario_search . "' name='id_user_desbloquear2FA' >
            <div id='enviar_corrreo_codigo2FA'>
                <div class='form-group'>
                    <label for='confirm_usuario2FA'><i class='fa fa-user-circle-o'></i> Confirma tu usuario:</label>
                    <input type='text' class='form-control' id='confirm_usuario2FA' name='confirm_usuario2FA' required placeholder='Confirma tu usuario'>
                </div>
                <div class='form-group'>
                    <label for='confirmar_correo2FA'><i class='fa fa-envelope-o'></i> Confirma tu correo:</label>
                    <input type='email' class='form-control' id='confirmar_correo2FA' name='confirmar_correo2FA' placeholder='Confirma tu correo' required>
                </div>
                <button type='submit' class='btn btn-primary' id='btn_solicitar2FA'><i class='fa fa-send-o'></i> Solicitar código</button>
            </div>

		</form>
		     <form id='emailFormComprobarCodigo2FA' method='post' autocomplete='off'>
			 <input type='hidden' value='" . $_SESSION['csrf_token'] . "' name='csrf_token_code2FA'>
		<input type='hidden' value='" . $id_usuario_search . "' name='id_user_desbloquear_code2FA'>
		<input type='hidden'  name='user_correo_code2FA' id='user_correo_code2FA'>
		<input type='hidden'  name='user_user_code2FA' id='user_user_code2FA'>
            <div style='display:none' id='enviar_comprobar_codigo2FA'>
                <div class='form-group'>
                    <label for='confirmar_codigo2FA'>Confirma tu código:</label>
                    <input type='text' class='form-control' id='confirmar_codigo2FA' name='confirmar_codigo2FA' placeholder='Ejemplo: AS120A77' required>
                </div>
                <button type='submit' class='btn btn-primary' id='comprobar_codigo_btn2FA'><i class='fa fa-qrcode'></i> Comprobar código</button><button type='button'  id='btn_reenviar_comprobacion_de_datos2FA' class='btn btn-warning pull-right'>🙄 No recibí el correo, intentarlo nuevamente.</button>
            </div>
			</form>
    
                        
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
				</li>
				</ul>");
								} else {
									if (ModeloLogsUser::IngresarLogs(array("id_usuario" => $respuesta["id"]))) {
										$ultimoIDLogs = ModeloLogsUser::LogsObtenerUltimoRegistro();
										$_SESSION["id_logs"] = $ultimoIDLogs;
										ModeloLogsUser::IngresarActionsLogs(array("id_logs" => $ultimoIDLogs, "modulo" => "Usuario", "actividad" => "Registro de inicio de sesión"));
									}
									$_SESSION["2fa"] = "2fa";
									echo '<script>window.location = "inicio";</script>';
								}
							}
						} else {
							if (isset($respuesta["id"]) && isset($respuesta["usuario"])) {
								$criterios = [
									'id' => $respuesta["id"],
									'usuario' => $respuesta["usuario"],
									'condicion' => "incrementar",
								];

								self::incrementarIntentos($criterios);
							}
							echo self::alertMensaje("danger", "fa-exclamation-triangle", "Usuario Inactivo", "Este usuario:  <strong>" . self::mostrarUsuarioParcial($valor) . "</strong>, se encuentra <strong>Inactivo</strong>.");
						}
					} else {
						if (isset($respuesta["id"]) && isset($respuesta["usuario"])) {
							$criterios = [
								'id' => $respuesta["id"],
								'usuario' => $respuesta["usuario"],
								'condicion' => "incrementar",
							];

							self::incrementarIntentos($criterios);
						}
						echo self::alertMensaje("danger", "fa-exclamation-triangle", "Validando credenciales", "Usuario, contraseña o código captcha incorrecto.");
					}
				} else {
					echo self::alertMensaje("danger", "fa-exclamation-triangle", "Validando credenciales", "Usuario, contraseña o código captcha incorrecto.");
					if (isset($respuesta["id"]) && isset($respuesta["usuario"])) {
						$criterios = [
							'id' => $respuesta["id"],
							'usuario' => $respuesta["usuario"],
							'condicion' => "incrementar",
						];

						self::incrementarIntentos($criterios);
					}
				}
			} else 	if (isset($respuesta["intento"]) && $respuesta["intento"] > 3 && count($respuesta) > 0) {
				$crypto = new CryptoUtils();
				$id_usuario_search = $crypto->encryptPassword($respuesta["id"]);
				echo self::alertMensaje("primary bg-black-gradient", "fa-exclamation-triangle", "Bloqueo de Usuario:", "<ul>
				<li>Este usuario:  <strong>" . self::mostrarUsuarioParcial($valor) . "</strong>, se encuentra <strong>Bloqueado</strong>.</li>
				<li>¿Desea envíar código de 8 dígitos a su correo <strong>" . self::mostrarCorreoParcial($correo) . "</strong> para reiniciar intentos? <button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#emailModal' title='Enviar o reenviar código'>
                        <i class='fa fa-send-o'></i>
                    </button>
					</li>
				<li>Ha superado sus 3 intentos.</li>
				<li>Comuniquese con el administrador o soporte.</li>

				<li>
				 <!-- Modal -->
        <div id='emailModal' class='modal fade bg-black-gradient' role='dialog'>
            <div class='modal-dialog'>

                <!-- Modal content-->
                <div class='modal-content' style='color: #000 !important'>
                    <div class='modal-header bg-green-gradient'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4 class='modal-title'><i class='fa fa-qrcode'></i> Enviar código para desbloquear usuario</h4>
                    </div>
                    <div class='modal-body'>
					  <div id='mensaje_enviar'></div>
        <form id='emailForm' method='post' autocomplete='off'>
		<input type='hidden' value='" . $_SESSION['csrf_token'] . "' name='csrf_token' >
		<input type='hidden' value='" . $id_usuario_search . "' name='id_user_desbloquear' >
            <div id='enviar_corrreo_codigo'>
                <div class='form-group'>
                    <label for='confirm_usuario'><i class='fa fa-user-circle-o'></i> Confirma tu usuario:</label>
                    <input type='text' class='form-control' id='confirm_usuario' name='confirm_usuario' required placeholder='Confirma tu usuario'>
                </div>
                <div class='form-group'>
                    <label for='confirmar_correo'><i class='fa fa-envelope-o'></i> Confirma tu correo:</label>
                    <input type='email' class='form-control' id='confirmar_correo' name='confirmar_correo' placeholder='Confirma tu correo' required>
                </div>
                <button type='submit' class='btn btn-primary' id='btn_solicitar'><i class='fa fa-send-o'></i> Solicitar código</button>
            </div>

		</form>
		     <form id='emailFormComprobarCodigo' method='post' autocomplete='off'>
			 <input type='hidden' value='" . $_SESSION['csrf_token'] . "' name='csrf_token_code'>
		<input type='hidden' value='" . $id_usuario_search . "' name='id_user_desbloquear_code'>
		<input type='hidden'  name='user_correo_code' id='user_correo_code'>
		<input type='hidden'  name='user_user_code' id='user_user_code'>
            <div style='display:none' id='enviar_comprobar_codigo'>
                <div class='form-group'>
                    <label for='confirmar_codigo'>Confirma tu código:</label>
                    <input type='text' class='form-control' id='confirmar_codigo' name='confirmar_codigo' placeholder='Ejemplo: AS120A77' required>
                </div>
                <button type='submit' class='btn btn-primary' id='comprobar_codigo_btn'><i class='fa fa-qrcode'></i> Comprobar código</button><button type='button'  id='btn_reenviar_comprobacion_de_datos' class='btn btn-warning pull-right'>🙄 No recibí el correo, intentarlo nuevamente.</button>
            </div>
			</form>
    
                        
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
				</li>
			
				
				</ul>");
			} else {
				echo self::alertMensaje("danger", "fa-exclamation-triangle", "Validando credenciales", "Usuario, contraseña o código captcha incorrecto.");
			}
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{

		if (isset($_POST["nuevoUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9_]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!*?&\/+\-])[A-Za-z\d@$!*?&\/+\-]{9,16}$/', $_POST["nuevoPassword"]) && ($_POST["nuevoPassword"] === $_POST["password_confirm"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if (isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["nuevaFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";
				$_2fa = isset($_POST["auntenticacionactivada"]) ? 1 : 0;
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"nombre" => $_POST["nuevoNombre"],
					"user_correo" => $_POST["nuevoCorreo"],
					"usuario" => $_POST["nuevoUsuario"],
					"password" => $encriptar,
					"perfil" => $_POST["nuevoPerfil"],
					"foto" => $ruta,
					"_2fa" => $_2fa,
				);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡Existen validaciones que revisar al llenar el formulario!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrConsultarDatosUsuariosCodigo($criterios)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlConsultarDatosUsuarioCodigo($tabla, $criterios);

		return $respuesta;
	}

	static public function ctrConsultarDatosUsuarios($criterios)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlConsultarDatosUsuario($tabla, $criterios);

		return $respuesta;
	}

	static public function editarToken2FA($criterios)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlActualizarTokenUsuario2FA($tabla, $criterios);

		return $respuesta;
	}

	static public function editarToken($criterios)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlActualizarTokenUsuario($tabla, $criterios);

		return $respuesta;
	}

	static public function reiniciarIntentosToken($criterios)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlActualizarTokenIntentos($tabla, $criterios);

		return $respuesta;
	}

	static public function incrementarIntentos($criterios)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlIncrementarIntentos($tabla, $criterios);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
				preg_match('/^[a-zA-Z0-9_]+$/', $_POST["editarUsuario"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
    =============================================*/

					$directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];

					/*=============================================
    PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
    =============================================*/

					if (!empty($_POST["fotoActual"])) {
						unlink($_POST["fotoActual"]);
					}

					/*=============================================
    VERIFICAMOS SI EL DIRECTORIO EXISTE, SI NO, LO CREAMOS
    =============================================*/
					if (!is_dir($directorio)) {
						mkdir($directorio, 0755, true);
					}

					/*=============================================
    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
    =============================================*/

					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

						/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

						$aleatorio = mt_rand(100, 999);
						$ruta = $directorio . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);
						$ruta = $directorio . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}


				$tabla = "usuarios";
				$_2fa = isset($_POST["editarauntenticacionactivada"]) ? 1 : 0;
				if ($_POST["editarPassword"] != "" && $_POST["editarpassword_confirm"] != "") {

					if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!*?&\/+\-])[A-Za-z\d@$!*?&\/+\-]{9,16}$/', $_POST["editarPassword"]) && ($_POST["editarPassword"] == $_POST["editarpassword_confirm"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>

								swal({
									  type: "error",
									  title: "¡Validación de la contraseña, revise por favor!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					"nombre" => $_POST["editarNombre"],
					"usuario" => $_POST["editarUsuario"],
					"user_correo" => $_POST["editarCorreo"],
					"password" => $encriptar,
					"perfil" => $_POST["editarPerfil"],
					"_2fa" => $_2fa,
					"foto" => $ruta,
					"id" => $_POST["id_usuario_edit"]
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡Necesita verificar algunas validaciones del formulario!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario()
	{

		if (isset($_GET["idUsuario"])) {

			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $_GET["usuario"]);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';
			}
		}
	}
}
