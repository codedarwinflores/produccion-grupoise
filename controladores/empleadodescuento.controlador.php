<?php

class ControladorEmpleadoDescuento{

	/*=============================================
	INGRESO 
	=============================================*/

	static public function ctrIngresoBancos(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

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

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							echo '<script>

								window.location = "inicio";

							</script>';

						}				
						
					}else{

						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';

					}		

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}	

		}

	}

	/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

	static public function ctrCrearEmpleadoDescuento(){

		if(isset($_POST["nuevoIdDescuento"])){

				$tabla = " tbl_empleados_devengos_descuentos";
				$datos = array("id_empleado" => $_POST["idEmpleadoDescuento"],
							   "id_tipo_devengo_descuento" => $_POST["nuevoIdDescuento"],
					           "valor" => $_POST["nuevoValor"],
                               "fecha_caducidad" => $_POST["nuevofecha_caducidad"],
                               "referencia" => $_POST["nuevoReferencia"],
							   "tipodescuento" => $_POST["nuevotipodescuento"]
                              
                            );
				$respuesta = ModeloEmpleadoDescuentos::mdlIngresarEmpleadoDescuento($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El Dato ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "empleados";

						}

					});
				

					</script>';


				}	


			

		}


	}

	

	

	


}
	


