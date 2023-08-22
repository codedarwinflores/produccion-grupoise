<?php
/* cambiar _devengoubicacion por el nombre de la table correspondiente */
$Nombremodulo_mensaje_devengoubicacion="Ubicación Devengo";
$nombremodelo_devengoubicacion="devengoubicacion";
$namecolumnas_devengoubicacion="";
$namecampos_devengoubicacion="";
$nombretabla_devengoubicacion_devengoubicacion="tbl_devengo_ubicacion";
$tabla_devengoubicacion = "tbl_devengo_ubicacion";
class Controladordevengoubicacion{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_devengoubicacion_devengoubicacion;
		$query = "SHOW COLUMNS FROM $nombretabla_devengoubicacion_devengoubicacion";
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

				$tabla_devengoubicacion = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_devengoubicacion, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_devengoubicacion, $item1, $valor1, $item2, $valor2);

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



				global $tabla_devengoubicacion;
				global $namecolumnas_devengoubicacion;
				global $namecampos_devengoubicacion;
				global $Nombremodulo_mensaje_devengoubicacion;
				global $nombremodelo_devengoubicacion;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_devengoubicacion .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modelodevengoubicacion::mdlIngresar($tabla_devengoubicacion, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_devengoubicacion.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_devengoubicacion.'?id='.$_POST["nuevoiddescuentodevengo"].'";

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

		global $tabla_devengoubicacion;

		$respuesta = Modelodevengoubicacion::mdlMostrar($tabla_devengoubicacion, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarid"])){


			$iddevengo=$_POST["editariddescuentodevengo"];

			global $tabla_devengoubicacion;
			global $namecolumnas_devengoubicacion;
			global $namecampos_devengoubicacion;
			global $Nombremodulo_mensaje_devengoubicacion;
			global $nombremodelo_devengoubicacion;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_devengoubicacion .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modelodevengoubicacion::mdlEditar($tabla_devengoubicacion, $datos);

				if($respuesta == "ok"){
					echo'<script>
					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_devengoubicacion.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

										window.location = "'.$nombremodelo_devengoubicacion.'?id='.$_POST["editariddescuentodevengo"].'";

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

		if(isset($_GET["iddevengoubicacion"])){

			global $tabla_devengoubicacion;
				global $namecolumnas_devengoubicacion;
				global $namecampos_devengoubicacion;
				global $Nombremodulo_mensaje_devengoubicacion;
				global $nombremodelo_devengoubicacion;
			$datos = $_GET["iddevengoubicacion"];


			$respuesta = Modelodevengoubicacion::mdlBorrar($tabla_devengoubicacion, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_devengoubicacion.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$nombremodelo_devengoubicacion.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


