<?php
/* cambiar _vehiculo por el nombre de la table correspondiente */
$Nombremodulo_mensaje_vehiculo="Vehiculo";
$nombremodelo_vehiculo="vehiculo";
$namecolumnas_vehiculo="";
$namecampos_vehiculo="";
$nombretabla_vehiculo_vehiculo="tarjetas_vehiculo";
$tabla_vehiculo = "tbl_vehiculos";
class Controladorvehiculo{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_vehiculo_vehiculo;
		$query = "SHOW COLUMNS FROM $nombretabla_vehiculo_vehiculo";
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

				$tabla_vehiculo = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_vehiculo, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_vehiculo, $item1, $valor1, $item2, $valor2);

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

		if(isset($_POST["nuevoid_familia"])){



				global $tabla_vehiculo;
				global $namecolumnas_vehiculo;
				global $namecampos_vehiculo;
				global $Nombremodulo_mensaje_vehiculo;
				global $nombremodelo_vehiculo;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_vehiculo .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modelovehiculo::mdlIngresar($tabla_vehiculo, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_vehiculo.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_vehiculo.'";

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

		global $tabla_vehiculo;

		$respuesta = Modelovehiculo::mdlMostrar($tabla_vehiculo, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarid_familia"])){



			global $tabla_vehiculo;
			global $namecolumnas_vehiculo;
			global $namecampos_vehiculo;
			global $Nombremodulo_mensaje_vehiculo;
			global $nombremodelo_vehiculo;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_vehiculo .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modelovehiculo::mdlEditar($tabla_vehiculo, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_vehiculo.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$nombremodelo_vehiculo.'";

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

		if(isset($_GET["idvehiculo"])){

			global $tabla_vehiculo;
				global $namecolumnas_vehiculo;
				global $namecampos_vehiculo;
				global $Nombremodulo_mensaje_vehiculo;
				global $nombremodelo_vehiculo;
			$datos = $_GET["idvehiculo"];


			$respuesta = Modelovehiculo::mdlBorrar($tabla_vehiculo, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_vehiculo.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$nombremodelo_vehiculo.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


