<?php

class ControladorPermiso{

	/*=============================================
	INGRESO 
	=============================================*/


	/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

	static public function ctrCrearPermiso(){

		if(isset($_POST["nuevoControl"])){



				$tabla = "permisos";


				$datos = array("nuevoControl" => $_POST["nuevoControl"],
					           "nuevoPerfil" => $_POST["nuevoPerfil"]);

				$respuesta = ModeloPermiso::mdlIngresar($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El permiso ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "permisos";

						}

					});
				

					</script>';


				}	


			

		}


	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrarPermiso($item, $valor){

		$tabla = "permisos";

		$respuesta = ModeloPermiso::mdlMostrar($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditarPermiso(){

		if(isset($_POST["editarControl"])){



				$tabla = "permisos";

				

				$datos = array("id" => $_POST["editaridpermiso"],
							   "editarControl" => $_POST["editarControl"],
							   "editarPerfil" => $_POST["editarPerfil"]);

				$respuesta = ModeloPermiso::mdlEditar($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Permiso ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "permisos";

									}
								})

					</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR REGISTROS
	=============================================*/

	static public function ctrBorrarPermiso(){

		if(isset($_GET["idPermiso"])){

			$tabla ="permisos";
			$datos = $_GET["idPermiso"];


			$respuesta = ModeloPermiso::mdlBorrar($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Permiso ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "permisos";

								}
							})

				</script>';

			}		

		}

	}


}
	


