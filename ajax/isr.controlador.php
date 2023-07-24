<?php
/* cambiar _isr por el nombre de la table correspondiente */
$Nombremodulo_mensaje_isr="ISR";
$nombremodelo_isr="isr";
$namecolumnas_isr="";
$namecampos_isr="";
$nombretabla_isr_isr="isr";
$tabla_isr = "isr";
class Controladorisr{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_isr_isr;
		$query = "SHOW COLUMNS FROM $nombretabla_isr_isr";
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

				$tabla_isr = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_isr, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_isr, $item1, $valor1, $item2, $valor2);

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

		if(isset($_POST["nuevonombre_rango"])){



				global $tabla_isr;
				global $namecolumnas_isr;
				global $namecampos_isr;
				global $Nombremodulo_mensaje_isr;
				global $nombremodelo_isr;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_isr .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modeloisr::mdlIngresar($tabla_isr, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El '.$Nombremodulo_mensaje_isr.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$nombremodelo_isr.'";

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

		global $tabla_isr;

		$respuesta = Modeloisr::mdlMostrar($tabla_isr, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarnombre_rango"])){



			global $tabla_isr;
			global $namecolumnas_isr;
			global $namecampos_isr;
			global $Nombremodulo_mensaje_isr;
			global $nombremodelo_isr;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_isr .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modeloisr::mdlEditar($tabla_isr, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El '.$Nombremodulo_mensaje_isr.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$nombremodelo_isr.'";

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

		if(isset($_GET["idisr"])){

			global $tabla_isr;
				global $namecolumnas_isr;
				global $namecampos_isr;
				global $Nombremodulo_mensaje_isr;
				global $nombremodelo_isr;
			$datos = $_GET["idisr"];


			$respuesta = Modeloisr::mdlBorrar($tabla_isr, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El '.$Nombremodulo_mensaje_isr.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$nombremodelo_isr.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


