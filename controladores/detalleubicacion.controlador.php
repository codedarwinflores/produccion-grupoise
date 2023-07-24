<?php
/* cambiar _tbl_ubicaciones_detalle por el nombre de la table correspondiente */
$Nombremodulo_mensaje_tbl_ubicaciones_detalle="Detalle Ubicación";
$nombremodelo_tbl_ubicaciones_detalle="detalleubicacion";
$namecolumnas_tbl_ubicaciones_detalle="";
$namecampos_tbl_ubicaciones_detalle="";
$nombretabla_tbl_ubicaciones_detalle_tbl_ubicaciones_detalle="tbl_ubicaciones_detalle";
$tabla_tbl_ubicaciones_detalle = "tbl_ubicaciones_detalle";
class Controladortbl_ubicaciones_detalle{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_tbl_ubicaciones_detalle_tbl_ubicaciones_detalle;
		$query = "SHOW COLUMNS FROM $nombretabla_tbl_ubicaciones_detalle_tbl_ubicaciones_detalle";
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

				$tabla_tbl_ubicaciones_detalle = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_tbl_ubicaciones_detalle, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_tbl_ubicaciones_detalle, $item1, $valor1, $item2, $valor2);

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



				global $tabla_tbl_ubicaciones_detalle;
				global $namecolumnas_tbl_ubicaciones_detalle;
				global $namecampos_tbl_ubicaciones_detalle;
				global $Nombremodulo_mensaje_tbl_ubicaciones_detalle;
				global $nombremodelo_tbl_ubicaciones_detalle;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_tbl_ubicaciones_detalle .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modelotbl_ubicaciones_detalle::mdlIngresar($tabla_tbl_ubicaciones_detalle, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_tbl_ubicaciones_detalle.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_tbl_ubicaciones_detalle.'?id='. $_POST["nuevoidubicacion"] .'";

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

		global $tabla_tbl_ubicaciones_detalle;

		$respuesta = Modelotbl_ubicaciones_detalle::mdlMostrar($tabla_tbl_ubicaciones_detalle, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarid"])){



			global $tabla_tbl_ubicaciones_detalle;
			global $namecolumnas_tbl_ubicaciones_detalle;
			global $namecampos_tbl_ubicaciones_detalle;
			global $Nombremodulo_mensaje_tbl_ubicaciones_detalle;
			global $nombremodelo_tbl_ubicaciones_detalle;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_tbl_ubicaciones_detalle .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modelotbl_ubicaciones_detalle::mdlEditar($tabla_tbl_ubicaciones_detalle, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_tbl_ubicaciones_detalle.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

										window.location = "'.$nombremodelo_tbl_ubicaciones_detalle.'?id='. $_POST["editaridubicacion"] .'";

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

		if(isset($_GET["idtbl_ubicaciones_detalle"])){

			global $tabla_tbl_ubicaciones_detalle;
				global $namecolumnas_tbl_ubicaciones_detalle;
				global $namecampos_tbl_ubicaciones_detalle;
				global $Nombremodulo_mensaje_tbl_ubicaciones_detalle;
				global $nombremodelo_tbl_ubicaciones_detalle;
			$datos = $_GET["idtbl_ubicaciones_detalle"];
			$codigo = $_GET["codigo"];


			$respuesta = Modelotbl_ubicaciones_detalle::mdlBorrar($tabla_tbl_ubicaciones_detalle, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_tbl_ubicaciones_detalle.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "detalleubicacion?id='.$codigo.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


