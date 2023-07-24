<?php
/* cambiar _personal_no_contratable por el nombre de la table correspondiente */
$Nombremodulo_mensaje_personal_no_contratable="Personal no contratable";
$nombremodelo_personal_no_contratable="personalnocontratable";
$namecolumnas_personal_no_contratable="";
$namecampos_personal_no_contratable="";
$nombretabla_personal_no_contratable_personal_no_contratable="personal_no_contratable";
$tabla_personal_no_contratable = "personal_no_contratable";
class Controladorpersonal_no_contratable{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_personal_no_contratable_personal_no_contratable;
		$query = "SHOW COLUMNS FROM $nombretabla_personal_no_contratable_personal_no_contratable";
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

				$tabla_personal_no_contratable = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_personal_no_contratable, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_personal_no_contratable, $item1, $valor1, $item2, $valor2);

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

		if(isset($_POST["nuevonombres"])){



				global $tabla_personal_no_contratable;
				global $namecolumnas_personal_no_contratable;
				global $namecampos_personal_no_contratable;
				global $Nombremodulo_mensaje_personal_no_contratable;
				global $nombremodelo_personal_no_contratable;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_personal_no_contratable .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modelopersonal_no_contratable::mdlIngresar($tabla_personal_no_contratable, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_personal_no_contratable.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_personal_no_contratable.'";

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

		global $tabla_personal_no_contratable;

		$respuesta = Modelopersonal_no_contratable::mdlMostrar($tabla_personal_no_contratable, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarnombres"])){



			global $tabla_personal_no_contratable;
			global $namecolumnas_personal_no_contratable;
			global $namecampos_personal_no_contratable;
			global $Nombremodulo_mensaje_personal_no_contratable;
			global $nombremodelo_personal_no_contratable;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_personal_no_contratable .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modelopersonal_no_contratable::mdlEditar($tabla_personal_no_contratable, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_personal_no_contratable.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$nombremodelo_personal_no_contratable.'";

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

		if(isset($_GET["idpersonal_no_contratable"])){

			global $tabla_personal_no_contratable;
				global $namecolumnas_personal_no_contratable;
				global $namecampos_personal_no_contratable;
				global $Nombremodulo_mensaje_personal_no_contratable;
				global $nombremodelo_personal_no_contratable;
			$datos = $_GET["idpersonal_no_contratable"];


			$respuesta = Modelopersonal_no_contratable::mdlBorrar($tabla_personal_no_contratable, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_personal_no_contratable.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$nombremodelo_personal_no_contratable.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


