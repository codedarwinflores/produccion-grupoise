<?php

require_once "../controladores/evaluados.controlador.php";
require_once "../modelos/evaluados.modelo.php";
require_once "../modelos/horario.modelo.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";
session_start();
date_default_timezone_set('America/El_Salvador');

class AjaxEvaluados
{
	private $cache = [];

	public function validarImagenRemota($urlImagen)
	{
		if (isset($this->cache[$urlImagen])) {
			return $this->cache[$urlImagen];
		}

		// Verificar si la URL es válida
		if (filter_var($urlImagen, FILTER_VALIDATE_URL) === false) {
			$this->cache[$urlImagen] = false;
			return false;
		}

		// Utilizar cURL para obtener los encabezados de la URL
		$ch = curl_init($urlImagen);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		// Verificar si el código de respuesta es 200 (OK)
		$valid = $statusCode === 200;

		// Almacenar el resultado en caché
		$this->cache[$urlImagen] = $valid;

		return $valid;
	}

	public function AjaxConsultarEvaluados()
	{
		$campos = "eva.*,concat(morse.codigo_cliente,' - ',morse.nombre) as cliente_morse";
		$tabla = "`evaluados` eva LEFT JOIN tbl_clientes_morse morse on eva.id_cliente_morse=morse.id";
		$condicion = "1 ";

		$respuesta = ModeloHorario::MostrarDatos($campos, $tabla, $condicion, "order by eva.id desc");
		return $respuesta;
	}


	public function mostrarTablaEvaluados()
	{

		$esquema = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
		$dominio = $_SERVER['HTTP_HOST'];
		$urlCompleta = "$esquema://$dominio";

		$datos = self::AjaxConsultarEvaluados();

		$data = array();

		$fechaActual = date('Y-m-d');
		for ($i = 0; $i < count($datos); $i++) {
			$otrosDatos = "";
			$img = '';
			$botones = '';
			$otrosDatos .= !empty($datos[$i]["documento"]) ? "<strong><i class='fa fa-id-card-o'></i> </strong>" . $datos[$i]["documento"] . " " : "";
			$otrosDatos .= !empty($datos[$i]["estado_civil"]) ? "<strong><i class='fa fa-diamond'></i> Estado Civil: </strong>" . $datos[$i]["estado_civil"] . " " : "";
			$otrosDatos .= !empty($datos[$i]["telefono"]) ? "<strong><i class='fa fa-phone'></i></strong> " . $datos[$i]["telefono"] . " " : "";
			$otrosDatos .= !empty($datos[$i]["fecha_nac"]) && $datos[$i]["fecha_nac"] !== "0000-00-00" ? "<strong><i class='fa fa-calendar'></i> F. Nac.: </strong>" . $datos[$i]["fecha_nac"] . " " : "";


			/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/
			$imagenExiste = "https://cdn.icon-icons.com/icons2/69/PNG/128/user_customer_person_13976.png"; // Imagen de respaldo por defecto
			$foto_del = "";

			if (file_exists($datos[$i]["foto"])) {
				$imagenExiste = $datos[$i]["foto"];
				$foto_del = $datos[$i]["foto"];
			}

			$imagenExiste = "https://cdn.icon-icons.com/icons2/69/PNG/128/user_customer_person_13976.png";
			$urlfoto = preg_replace("/\.\./", "", ($urlCompleta  . $datos[$i]["foto"]), 1);
			if (self::validarImagenRemota($urlfoto)) {
				$imagenExiste = $urlfoto;
				$foto_del = $datos[$i]["foto"];
			} else if (self::validarImagenRemota($urlCompleta . "/" . $datos[$i]["foto"])) {
				$imagenExiste = $urlCompleta . "/" . $datos[$i]["foto"];
				$foto_del = $datos[$i]["foto"];
			} else if (self::validarImagenRemota($datos[$i]["foto"])) {
				$imagenExiste = $datos[$i]["foto"];
				$foto_del = $datos[$i]["foto"];
			}

			$nombreImagen = basename($imagenExiste);

			$img = '	<div class="media">
						<a href="#" class="pull-left">
						<img src="' . $imagenExiste . '" class="img-thumbnail" width="50px" alt="Fotografía: ' . $nombreImagen . '" title="Fotografía: ' . $nombreImagen . '">
						</a>
						<h4 class="title">
						' .  $datos[$i]["nombres"] . " " . $datos[$i]["primer_apellido"] . " " . $datos[$i]["segundo_apellido"] . '
						</h4>
						<p class="summary">' . $otrosDatos . '</p>
					
						</div>';

			$botones = '<div class="btn-group">
					   <button class="btn btn-warning btnEditarEvaluado" idEvaluado="' . $datos[$i]["id"] . '" data-toggle="modal" data-target="#modalAgregarEvaluado"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarEvaluado" foto_del="' . $foto_del . '" idEvaluado="' . $datos[$i]["id"] . '"  ><i class="fa fa-times"></i></button>
                    </div>';


			$row = array(
				$i + 1,
				$datos[$i]["id"],
				$datos[$i]["codigo"],
				$img,
				$datos[$i]["profesion"],
				$datos[$i]["padre"],
				$datos[$i]["madre"],
				$datos[$i]["conyuge"],
				$datos[$i]["lugar_nac"],
				$datos[$i]["direccion"],
				(($datos[$i]["id_cliente_morse"] > 0) ? $datos[$i]["cliente_morse"] : "---"),
				$botones,
			);

			$data[] = $row;
		}

		$response = array("data" => $data);
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	public $idEvaluado;

	public function ajaxEditarEvaluado()
	{

		$item = "id";
		$valor = $this->idEvaluado;

		$respuesta = ControladorEvaluado::ctrMostrarEvaluado($item, $valor);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR 
=============================================*/
if (isset($_POST["idEvaluado"])) {

	$editar = new AjaxEvaluados();
	$editar->idEvaluado = $_POST["idEvaluado"];
	$editar->ajaxEditarEvaluado();
}
/*=============================================
CREAR 
=============================================*/
if (isset($_POST["save_process_evaluado"]) && $_POST["save_process_evaluado"] === "ok" && isset($_POST["type_action_form"]) && isset($_POST["id_edit_evaluado"])) {

	if ($_POST["id_edit_evaluado"] === "0"  && $_POST["type_action_form"] === "save") {
		$crear = new ControladorEvaluado();
		if ($crear->ctrCrearEvaluado()) {
			logs_msg("Tabla evaluados", "Crear evaluado");
			echo "save";
		} else {
			echo "error";
		}
	} else if ($_POST["id_edit_evaluado"] > "0"  && $_POST["type_action_form"] === "update") {

		$editar = new ControladorEvaluado();
		if ($editar->ctrEditarEvaluado()) {
			logs_msg("Tabla evaluados", "Editar evaluado: ID= " . $_POST["id_edit_evaluado"]);
			echo "update";
		} else {
			echo "error";
		}
	}
}

if (isset($_POST["id_evaluado_delete"]) && $_POST["id_evaluado_delete"] > 0) {


	$borrar = new ControladorEvaluado();
	if ($borrar->ctrBorrarEvaluado()) {
		logs_msg("Tabla evaluados", "Eliminar evaluado: ID= " . $_POST["id_evaluado_delete"]);
		echo "delete";
	} else {
		echo "error";
	}
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {
	if (isset($_GET["actionsEvaluados"]) && $_GET["actionsEvaluados"] === "Consult") {

		if (isset($_SESSION["perfil"])) {
			$consultEvaluados = new AjaxEvaluados();

			$consultEvaluados->mostrarTablaEvaluados();
		}
	}
}
