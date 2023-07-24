<?php
/* cambiar _uniforme por el nombre de la table correspondiente */
$Nombremodulo_mensaje_uniforme="Uniforme";
$nombremodelo_uniforme="uniforme";
$namecolumnas_uniforme="";
$namecampos_uniforme="";
$nombretabla_uniforme_uniforme="tbl_uniformes";
$tabla_uniforme = "tbl_uniformes";
class Controladoruniforme{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_uniforme_uniforme;
		$query = "SHOW COLUMNS FROM $nombretabla_uniforme_uniforme";
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

				$tabla_uniforme = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_uniforme, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_uniforme, $item1, $valor1, $item2, $valor2);

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

		if(isset($_POST["nuevotalla"])){



				global $tabla_uniforme;
				global $namecolumnas_uniforme;
				global $namecampos_uniforme;
				global $Nombremodulo_mensaje_uniforme;
				global $nombremodelo_uniforme;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_uniforme .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modelouniforme::mdlIngresar($tabla_uniforme, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_uniforme.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_uniforme.'";

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

		global $tabla_uniforme;

		$respuesta = Modelouniforme::mdlMostrar($tabla_uniforme, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editartalla"])){



			global $tabla_uniforme;
			global $namecolumnas_uniforme;
			global $namecampos_uniforme;
			global $Nombremodulo_mensaje_uniforme;
			global $nombremodelo_uniforme;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_uniforme .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "talla" => $_POST["editartalla"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modelouniforme::mdlEditar($tabla_uniforme, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_uniforme.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$nombremodelo_uniforme.'";

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

		if(isset($_GET["iduniforme"])){

			global $tabla_uniforme;
				global $namecolumnas_uniforme;
				global $namecampos_uniforme;
				global $Nombremodulo_mensaje_uniforme;
				global $nombremodelo_uniforme;
			$datos = $_GET["iduniforme"];


			$respuesta = Modelouniforme::mdlBorrar($tabla_uniforme, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_uniforme.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$nombremodelo_uniforme.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


