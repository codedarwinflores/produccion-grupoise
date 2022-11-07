<?php
/* cambiar _administrarpatrulla por el nombre de la table correspondiente */
$Nombremodulo_mensaje_administrarpatrulla="Dato";
$nombremodelo_administrarpatrulla="administrarpatrulla";
$namecolumnas_administrarpatrulla="";
$namecampos_administrarpatrulla="";
$nombretabla_administrarpatrulla_administrarpatrulla="tbl_patrullas_ubicaciones";
$tabla_administrarpatrulla = "tbl_patrullas_ubicaciones";
class Controladoradministrarpatrulla{

	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_administrarpatrulla_administrarpatrulla;
		$query = "SHOW COLUMNS FROM $nombretabla_administrarpatrulla_administrarpatrulla";
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

				$tabla_administrarpatrulla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_administrarpatrulla, $item, $valor);

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

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_administrarpatrulla, $item1, $valor1, $item2, $valor2);

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

		if(isset($_POST["nuevoid_ubicacion_pu"])){


			$id=$_POST["nuevoid_patrullas_pu"];

				global $tabla_administrarpatrulla;
				global $namecolumnas_administrarpatrulla;
				global $namecampos_administrarpatrulla;
				global $Nombremodulo_mensaje_administrarpatrulla;
				global $nombremodelo_administrarpatrulla;
				
				$data = getContent();
				$datos="";
				$array=[];
				foreach($data as $row) {
					$datos0 = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""],);
				/* $namecolumnas_administrarpatrulla .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
				$array+=["".$row['Field']."" => $_POST["nuevo".$row['Field'].""],];
				}
			
				$datos=$array;
				$respuesta = Modeloadministrarpatrulla::mdlIngresar($tabla_administrarpatrulla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡'.$Nombremodulo_mensaje_administrarpatrulla.' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						

							window.location = "'.$nombremodelo_administrarpatrulla.'?id='.$id.'";


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

		global $tabla_administrarpatrulla;

		$respuesta = Modeloadministrarpatrulla::mdlMostrar($tabla_administrarpatrulla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditar(){

		if(isset($_POST["editarid_ubicacion_pu"])){


			$id=$_POST["editarid_patrullas_pu"];

			global $tabla_administrarpatrulla;
			global $namecolumnas_administrarpatrulla;
			global $namecampos_administrarpatrulla;
			global $Nombremodulo_mensaje_administrarpatrulla;
			global $nombremodelo_administrarpatrulla;
			
			$data = getContent();
			$datos="";
			$array=[];
			foreach($data as $row) {
				$datos0 = array("".$row['Field']."" => $_POST["editar".$row['Field'].""],);
			/* $namecolumnas_administrarpatrulla .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
			$array+=["".$row['Field']."" => $_POST["editar".$row['Field'].""],];
			}
		
			$datos=$array;
				

				/* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

				$respuesta = Modeloadministrarpatrulla::mdlEditar($tabla_administrarpatrulla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "'.$Nombremodulo_mensaje_administrarpatrulla.' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {


									
							window.location = "'.$nombremodelo_administrarpatrulla.'?id='.$id.'";

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

		if(isset($_GET["idadministrarpatrulla"])){

			global $tabla_administrarpatrulla;
				global $namecolumnas_administrarpatrulla;
				global $namecampos_administrarpatrulla;
				global $Nombremodulo_mensaje_administrarpatrulla;
				global $nombremodelo_administrarpatrulla;
			$datos = $_GET["idadministrarpatrulla"];
			$id = $_GET["Codigo"];


			$respuesta = Modeloadministrarpatrulla::mdlBorrar($tabla_administrarpatrulla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "'.$Nombremodulo_mensaje_administrarpatrulla.' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

									
									window.location = "'.$nombremodelo_administrarpatrulla.'?id='.$id.'";

								}
							})

				</script>';

			}		

		}

	}


}
	


