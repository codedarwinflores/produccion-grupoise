<?php

class ControladorPregunta{

	/*=============================================
	INGRESO 
	=============================================*/


	/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

	static public function ctrCrearPregunta(){

		if(isset($_POST["nuevoTipo"])){



				$tabla = "preguntas";


				$datos = array("id_tipo" => $_POST["nuevoTipo"],
					           "pregunta" => $_POST["nuevoPregunta"]);

				$respuesta = ModeloPregunta::mdlIngresar($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La Pregunta ha sido guardada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "preguntas";

						}

					});
				

					</script>';


				}	


			

		}


	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrarPregunta($item, $valor){

		$tabla = "preguntas";

		$respuesta = ModeloPregunta::mdlMostrar($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditarPregunta(){

		if(isset($_POST["editarTipo"])){



				$tabla = "preguntas";

				

				$datos = array("id" => $_POST["editarIdPregunta"],
							   "id_tipo" => $_POST["editarTipo"],
							   "pregunta" => $_POST["editarPregunta"]);

				$respuesta = ModeloPregunta::mdlEditar($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Pregunta ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "preguntas";

									}
								})

					</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR REGISTROS
	=============================================*/

	static public function ctrBorrarPregunta(){

		if(isset($_GET["idPregunta"])){

			$tabla ="preguntas";
			$datos = $_GET["idPregunta"];


			$respuesta = ModeloPregunta::mdlBorrar($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Pregunta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "preguntas";

								}
							})

				</script>';

			}		

		}

	}


}
	


