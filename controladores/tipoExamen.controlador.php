<?php

class ControladorTipoExamen
{

	/*=============================================
	INGRESO 
	=============================================*/


	/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

	static public function ctrCrearTipoExamen()
	{

		if (isset($_POST["nuevoCodigoTipoExamen"])) {



			$tabla = "tipos_examenes";


			$datos = array(
				"codigo" => strtoupper($_POST["nuevoCodigoTipoExamen"]),
				"descripcion" => $_POST["nuevaDescripcionTipoExamen"],
				"duracion" => $_POST["nuevaDuracion"],
				"valor" => $_POST["nuevoValor"],
				"comision" => $_POST["nuevoComision"]
			);

			$respuesta = ModeloTipoExamen::mdlIngresar($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({

						type: "success",
						title: "¡El Tipo de examen ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tipoExamen";

						}

					});
				

					</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrarTipoExamen($item, $valor)
	{

		$tabla = "tipos_examenes";

		$respuesta = ModeloTipoExamen::mdlMostrar($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditarTipoExamen()
	{

		if (isset($_POST["editarCodigoTipoExamen"])) {



			$tabla = "tipos_examenes";



			$datos = array(
				"id" => $_POST["editarIdTipoExamen"],
				"descripcion" => $_POST["editarDescripcionTipoExamen"],
				"duracion" => $_POST["editarDuracion"],
				"valor" => $_POST["editarValor"],
				"comision" => $_POST["editarComision"]
			);

			$respuesta = ModeloTipoExamen::mdlEditar($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
						  type: "success",
						  title: "El Tipo de examen ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "tipoExamen";

									}
								})

					</script>';
			}
		}
	}

	/*=============================================
	BORRAR REGISTROS
	=============================================*/

	static public function ctrBorrarTipoExamen()
	{

		if (isset($_GET["idTipoExamen"])) {

			$tabla = "tipos_examenes";
			$datos = $_GET["idTipoExamen"];


			$respuesta = ModeloTipoExamen::mdlBorrar($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El Tipo de examen ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "tipoExamen";

								}
							})

				</script>';
			}
		}
	}
}
