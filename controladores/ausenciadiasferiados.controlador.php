<?php
/* cambiar _ausenciadiasferiados por el nombre de la table correspondiente */
$Nombremodulo_mensaje_ausenciadiasferiados="Ausencia";
$nombremodelo_ausenciadiasferiados="ausenciadiasferiados";
$namecolumnas_ausenciadiasferiados="";
$namecampos_ausenciadiasferiados="";
$nombretabla_ausenciadiasferiados_ausenciadiasferiados="ausenciadiasferiados";
$tabla_ausenciadiasferiados = "ausenciadiasferiados";
class Controladorausenciadiasferiados{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_ausenciadiasferiados_ausenciadiasferiados;
		$query = "SHOW COLUMNS FROM $nombretabla_ausenciadiasferiados_ausenciadiasferiados";
		$sql = Conexion::conectar()->prepare($query);
		$sql->execute();			
		return $sql->fetchAll();
	}

	/*=============================================
	INGRESO 
	=============================================*/

	static public function ctrIngreso(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla_ausenciadiasferiados = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_ausenciadiasferiados, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_ausenciadiasferiados, $item1, $valor1, $item2, $valor2);

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

	static public function ctrCrear(){

		if(isset($_POST["nuevoid"])){



				global $tabla_ausenciadiasferiados;
				global $namecolumnas_ausenciadiasferiados;
				global $namecampos_ausenciadiasferiados;
				global $Nombremodulo_mensaje_ausenciadiasferiados;
				global $nombremodelo_ausenciadiasferiados;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_ausenciadiasferiados .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modeloausenciadiasferiados::mdlIngresar($tabla_ausenciadiasferiados, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_ausenciadiasferiados.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_ausenciadiasferiados.'";

						}

					});
				

					</script>';


				}	


			

		}


	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrar($item, $valor){

		global $tabla_ausenciadiasferiados;

		$respuesta = Modeloausenciadiasferiados::mdlMostrar($tabla_ausenciadiasferiados, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarid"])){



			global $tabla_ausenciadiasferiados;
			global $namecolumnas_ausenciadiasferiados;
			global $namecampos_ausenciadiasferiados;
			global $Nombremodulo_mensaje_ausenciadiasferiados;
			global $nombremodelo_ausenciadiasferiados;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_ausenciadiasferiados .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modeloausenciadiasferiados::mdlEditar($tabla_ausenciadiasferiados, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_ausenciadiasferiados.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$nombremodelo_ausenciadiasferiados.'";

									}
								})

					</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR REGISTROS
	=============================================*/

	static public function ctrBorrar(){

		if(isset($_GET["idausenciadiasferiados"])){

			global $tabla_ausenciadiasferiados;
				global $namecolumnas_ausenciadiasferiados;
				global $namecampos_ausenciadiasferiados;
				global $Nombremodulo_mensaje_ausenciadiasferiados;
				global $nombremodelo_ausenciadiasferiados;
			$datos = $_GET["idausenciadiasferiados"];


			$respuesta = Modeloausenciadiasferiados::mdlBorrar($tabla_ausenciadiasferiados, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_ausenciadiasferiados.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$nombremodelo_ausenciadiasferiados.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


