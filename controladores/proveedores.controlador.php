<?php

class ControladorProveedores{

	/*=============================================
	INGRESO DE PROVEEDORES
	=============================================*/

	static public function ctrIngresoProveedores(){

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
	REGISTRO DE PROVEEDORES
	=============================================*/

	static public function ctrCrearProveedores(){

		if(isset($_POST["nuevoNombre"])){


			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";


				$tabla = "proveedores";


				$datos = array("codigo" => $_POST["nuevoCodigo"],
					           "nombre" => $_POST["nuevoNombre"],
							   "direccion" => $_POST["nuevoDireccion"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "extension" => $_POST["nuevoExtension"],
							   "numero_de_registro" => $_POST["nuevoNumero_de_registro"],
							   "encargado" => $_POST["nuevoEncargado"],
							   "comentarios" => $_POST["nuevoComentario"],
							   "nacionalidad" => $_POST["nuevoNacionalidad"],
							   "codigo_contable" => $_POST["nuevoCodigo_contable"],
							   "contribuyente" => $_POST["nuevoContribuyente"],);

				$respuesta = ModeloProveedores::mdlIngresarProveedores($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El Proveedor ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

					</script>';


				}	


			

		}


	}

	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/

	static public function ctrMostrarProveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedores(){

		if(isset($_POST["editarNombre"])){




				$tabla = "proveedores";

				

				$datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"],
							   "direccion" => $_POST["editarDireccion"],
							   "telefono" => $_POST["editarTelefono"],
							   "extension" => $_POST["editarExtension"],
							   "numero_de_registro" => $_POST["editarNumero_de_registro"],
							   "encargado" => $_POST["editarEncargado"],
							   "comentarios" => $_POST["editarComentarios"],
							   "nacionalidad" => $_POST["editarNacionalidad"],
							   "codigo_contable" => $_POST["editarCodigo_contable"],
							   "contribuyente" => $_POST["editarContribuyente"]);

				$respuesta = ModeloProveedores::mdlEditarProveedores($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Proveedor ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function ctrBorrarProveedores(){

		if(isset($_GET["idProveedores"])){

			$tabla ="proveedores";
			$datos = $_GET["idProveedores"];


			$respuesta = ModeloProveedores::mdlBorrarProveedores($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';

			}		

		}

	}


}
	


