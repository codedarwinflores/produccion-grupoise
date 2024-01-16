<?php

class ControladorTipoPregunta
{

	/*=============================================
	INGRESO 
	=============================================*/


	/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

	static public function ctrCrearTipoPregunta()
	{

		if (isset($_POST["nuevoCodigoPregunta"])) {



			$tabla = "tipos_preguntas";


			$datos = array(
				"codigo" => $_POST["nuevoCodigoPregunta"],
				"descripcion" => $_POST["nuevaDescripcionPregunta"]
			);

			$respuesta = ModeloTipoPregunta::mdlIngresar($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({

						type: "success",
						title: "¡El Tipo de Pregunta ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tipoPregunta";

						}

					});
				

					</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrarTipoPregunta($item, $valor)
	{

		$tabla = "tipos_preguntas";

		$respuesta = ModeloTipoPregunta::mdlMostrar($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditarTipoPregunta()
	{

		if (isset($_POST["editarCodigoPregunta"])) {



			$tabla = "tipos_preguntas";



			$datos = array(
				"id" => $_POST["editarIdTipoPregunta"],
				"codigo" => $_POST["editarCodigoPregunta"],
				"descripcion" => $_POST["editarDescripcionPregunta"]
			);

			$respuesta = ModeloTipoPregunta::mdlEditar($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
						  type: "success",
						  title: "El Tipo de Pregunta ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "tipoPregunta";

									}
								})

					</script>';
			}
		}
	}

	/*=============================================
	BORRAR REGISTROS
	=============================================*/

	static public function ctrBorrarTipoPregunta()
	{

		if (isset($_GET["idTipoPregunta"])) {

			$tabla = "tipos_preguntas";
			$datos = $_GET["idTipoPregunta"];


			$respuesta = ModeloTipoPregunta::mdlBorrar($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El Tipo de Pregunta ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "tipoPregunta";

								}
							})

				</script>';
			}
		}
	}
}
