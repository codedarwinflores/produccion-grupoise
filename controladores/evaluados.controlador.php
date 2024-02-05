<?php

class ControladorEvaluado
{

	/*=============================================
	INGRESO 
	=============================================*/


	/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

	static public function ctrCrearEvaluado()
	{
		if (isset($_POST["nuevoNombres"])) {

			$tabla = "evaluados";

			$directorio = "../vistas/img/evaluados";

			// Verificar si el directorio ya existe y crearlo si no existe
			if (!is_dir($directorio)) {
				if (!mkdir($directorio, 0755, true)) {
					die('Error al crear el directorio...');
				}
			}

			$url = "./vistas/img/plantilla/logo_original.png";

			if (isset($_FILES["nuevaFotografia"]) && $_FILES["nuevaFotografia"]["error"] == UPLOAD_ERR_OK) {
				// Generar un nombre único basado en la marca de tiempo y un número aleatorio
				$nombreArchivo = uniqid() . '-' . mt_rand(1000, 9999) . '.' . pathinfo($_FILES["nuevaFotografia"]["name"], PATHINFO_EXTENSION);

				$targetFile = $directorio . '/' . $nombreArchivo;
				$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

				$allowedTypes = array("jpg", "jpeg", "png", "gif");
				if (in_array($imageFileType, $allowedTypes)) {
					if (move_uploaded_file($_FILES["nuevaFotografia"]["tmp_name"], $targetFile)) {
						$url = $targetFile; // Actualizar $url con la nueva dirección después de la carga exitosa
					} else {
						// Manejar el error si hay un problema al subir la imagen
						die('Error al subir la imagen...');
					}
				} else {
					// Manejar el caso en el que el tipo de archivo no es válido
					die('Tipo de archivo no permitido...');
				}
			}


			/* NUEVOS CAMPOS AGREGADOS */
			$datos = array(
				"nombres" => $_POST["nuevoNombres"],
				"primer_apellido" => $_POST["nuevoPrimerApellido"],
				"segundo_apellido" => $_POST["nuevoSegundoApellido"],
				"documento" => $_POST["nuevodocumentoevaluado"],
				"estado_civil" => $_POST["estadocivilevaluado"],
				"telefono" => $_POST["nuevotelefonoevaluado"],
				"padre" => $_POST["nuevoPapaevaluado"],
				"madre" => $_POST["nuevoMamaevaluado"],
				"conyuge" => $_POST["nuevoConyugeevaluado"],
				"fecha_nac" => $_POST["nuevofechaNacevaluado"],
				"profesion" => $_POST["nuevoProfesionevaluado"],
				"lugar_nac" => $_POST["nuevoLugarNacevaluado"],
				"id_cliente_morse" => $_POST["nuevoidClienteevaluado"],
				"direccion" => $_POST["nuevodireccionevaluado"],
				"foto" => $url,
			);

			$respuesta = ModeloEvaluado::mdlIngresar($tabla, $datos);

			if ($respuesta == "ok") {

				return true;
			}

			return false;
		}
	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrarEvaluado($item, $valor)
	{

		$tabla = "evaluados";

		$respuesta = ModeloEvaluado::mdlMostrar($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditarEvaluado()
	{

		if (isset($_POST["nuevoNombres"])) {


			$tabla = "evaluados";


			$directorio = "../vistas/img/evaluados";

			// Verificar si el directorio ya existe y crearlo si no existe
			if (!is_dir($directorio)) {
				if (!mkdir($directorio, 0755, true)) {
					die('Error al crear el directorio...');
				}
			}

			$url = $_POST["foto_edit"];

			if (isset($_FILES["nuevaFotografia"]) && $_FILES["nuevaFotografia"]["error"] == UPLOAD_ERR_OK && !empty($_FILES["nuevaFotografia"]["tmp_name"])) {
				// Generar un nombre único basado en la marca de tiempo y un número aleatorio
				$nombreArchivo = uniqid() . '-' . mt_rand(1000, 9999) . '.' . pathinfo($_FILES["nuevaFotografia"]["name"], PATHINFO_EXTENSION);

				$targetFile = $directorio . '/' . $nombreArchivo;
				$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

				$allowedTypes = array("jpg", "jpeg", "png", "gif");
				if (in_array($imageFileType, $allowedTypes)) {
					if (move_uploaded_file($_FILES["nuevaFotografia"]["tmp_name"], $targetFile)) {
						$url = $targetFile; // Actualizar $url con la nueva dirección después de la carga exitosa
						if (!empty($_POST["foto_edit"]) && file_exists($_POST["foto_edit"])) {

							unlink($_POST["foto_edit"]);
						}
					} else {
						// Manejar el error si hay un problema al subir la imagen
						die('Error al subir la imagen...');
					}
				} else {
					// Manejar el caso en el que el tipo de archivo no es válido
					die('Tipo de archivo no permitido...');
				}
			}


			/* NUEVOS CAMPOS AGREGADOS */
			$datos = array(
				"nombres" => $_POST["nuevoNombres"],
				"primer_apellido" => $_POST["nuevoPrimerApellido"],
				"segundo_apellido" => $_POST["nuevoSegundoApellido"],
				"documento" => $_POST["nuevodocumentoevaluado"],
				"estado_civil" => $_POST["estadocivilevaluado"],
				"telefono" => $_POST["nuevotelefonoevaluado"],
				"padre" => $_POST["nuevoPapaevaluado"],
				"madre" => $_POST["nuevoMamaevaluado"],
				"conyuge" => $_POST["nuevoConyugeevaluado"],
				"fecha_nac" => $_POST["nuevofechaNacevaluado"],
				"profesion" => $_POST["nuevoProfesionevaluado"],
				"lugar_nac" => $_POST["nuevoLugarNacevaluado"],
				"id_cliente_morse" => $_POST["nuevoidClienteevaluado"],
				"direccion" => $_POST["nuevodireccionevaluado"],
				"foto" => $url,
				"id" => $_POST["id_edit_evaluado"],
			);

			$respuesta = ModeloEvaluado::mdlEditar($tabla, $datos);

			if ($respuesta == "ok") {

				return true;
			}

			return false;
		}
	}

	/*=============================================
	BORRAR REGISTROS
	=============================================*/

	static public function ctrBorrarEvaluado()
	{

		if (isset($_POST["id_evaluado_delete"])) {

			$tabla = "evaluados";
			$datos = $_POST["id_evaluado_delete"];
			$respuesta = ModeloEvaluado::mdlBorrar($tabla, $datos);

			if ($respuesta == "ok") {
				if ($_POST["foto_del"] != "") {

					unlink($_POST["foto_del"]);
				}

				return true;
			}
			return false;
		}
	}
}
