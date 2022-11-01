<?php

class ControladorEmpleados{

	

	/*=============================================
	REGISTRO DE EMPLEADO
	=============================================*/

	static public function ctrCrearEmpleado(){

		if(isset($_POST["nuevoNombre"])){
            
			if((preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])) &&
			   ($_POST["nuevoTipoDocumento"] != "" ) &&
               ($_POST["nuevoNumeroDocumento"] != "" ) &&
               ($_POST["nuevoEstado"] != "" ) ){

			   	/*=============================================
				VALIDAR IMAGEN EMPLEADO
				=============================================*/
				$ruta = "";
				if(isset($_FILES["nuevaFotoEmp"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoEmp"]["tmp_name"]);
					$nuevoAncho = 354;
					$nuevoAlto = 418;
					/*=============================================
					CREAMOS EL DIRECTORIO(DUI) DONDE VAMOS A GUARDAR LA FOTO DEL EMPLEADO 
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"];
					mkdir($directorio, 0755);
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFotoEmp"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFotoEmp"]["tmp_name"]);	
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if($_FILES["nuevaFotoEmp"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFotoEmp"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}


				/*=============================================
				VALIDAR IMAGEN DOCUMENTO IDENTIDAD
				=============================================*/
				$rutaDoc = "";
				if(isset($_FILES["nuevaFotoDoc"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoDoc"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO(DUI) DONDE VAMOS A GUARDAR LA FOTO DEL EMPLEADO 
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"];
					mkdir($directorio, 0755);
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFotoDoc"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaDoc = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/documento".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoDoc"]["tmp_name"], $rutaDoc)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoDoc"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaDoc = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/documento".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoDoc"]["tmp_name"], $rutaDoc)) {							
						}
						else{								
						}
					}
				}
				/*=============================================
				VALIDAR IMAGEN LICENCIA DE CONDUCIR
				=============================================*/
				$rutaLicCond = "";
				if(isset($_FILES["nuevaFotoLicCond"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoLicCond"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO(DUI) DONDE VAMOS A GUARDAR LA FOTO DEL EMPLEADO 
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"];
					mkdir($directorio, 0755);
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFotoLicCond"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaLicCond = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/licenciaconducir".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoLicCond"]["tmp_name"], $rutaLicCond)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoLicCond"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaLicCond = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/licenciaconducir".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoLicCond"]["tmp_name"], $rutaLicCond)) {							
						}
						else{								
						}
					}
				}
				/*=============================================
				VALIDAR IMAGEN LICENCIA TENENCIA ARMAS
				=============================================*/
				$rutaLicLTA = "";
				if(isset($_FILES["nuevaFotoLicLTA"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoLicLTA"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO(DUI) DONDE VAMOS A GUARDAR LA FOTO DEL EMPLEADO 
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"];
					mkdir($directorio, 0755);
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaFotoLicLTA"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaLicLTA = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/licenciatenenciaarmas".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoLicLTA"]["tmp_name"], $rutaLicLTA)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoLicLTA"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaLicLTA = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/licenciatenenciaarmas".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoLicLTA"]["tmp_name"], $rutaLicLTA)) {							
						}
						else{								
						}
					}
				}






				$tabla = "tbl_empleados";

				

				$datos = array("primer_nombre" => $_POST["nuevoNombre"],
								"segundo_nombre" => $_POST["nuevoSegundoNombre"],
								"tercer_nombre" => $_POST["nuevoTercerNombre"],
								"primer_apellido" => $_POST["nuevoPrimerApellido"],
								"segundo_apellido" => $_POST["nuevoSegundoApellido"],
								"apellido_casada" => $_POST["nuevoApellidoCasada"],
								"estado_civil" => $_POST["nuevoEstadoCivil"],
								"sexo" => $_POST["nuevoSexo"],
								"direccion" => $_POST["nuevoDireccion"],
					           "documento_identidad" => $_POST["nuevoTipoDocumento"],
                               "numero_documento_identidad" => $_POST["nuevoNumeroDocumento"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "numero_isss" => $_POST["nuevoNumeroIsss"],
							   "nombre_segun_isss" => $_POST["nuevoNombreIsss"],
							   "lugar_expedicion_documento" => $_POST["nuevoLugarExpedicionDoc"],
							   "licencia_conducir" => $_POST["nuevoLicenciaConducir"],
							   "tipo_licencia_conducir" => $_POST["nuevoTipoLicenciaConducir"],
							   "imagen_licencia_conducir" =>$rutaLicCond,
							   "nit" => $_POST["nuevoNumeroNIT"],
							   "nup" => $_POST["nuevoNumeroNUP"],
							   "profesion_oficio" => $_POST["nuevoProfesionOficio"],
							   "nacionalidad" => $_POST["nuevoNacionalidad"],
							   "lugar_nacimiento" => $_POST["nuevoLugarNacimiento"],
							   "religion" => $_POST["nuevoReligion"],
							   "grado_estudio" => $_POST["nuevoGradoEstudio"],
							   "plantel" => $_POST["nuevoPlantel"],
							   "peso" => $_POST["nuevoPeso"],
							   "estatura" => $_POST["nuevoEstatura"],
							   "piel" => $_POST["nuevoPiel"],
							   "ojos" => $_POST["nuevoOjos"],
							   "cabello" => $_POST["nuevoCabello"],
							   "cara" => $_POST["nuevoCara"],
							   "tipo_sangre" => $_POST["nuevoTipoSangre"],
							   "senales_especiales" => $_POST["nuevoSenalesEspeciales"],
							   "licencia_tenencia_armas" => $_POST["nuevoLicenciaTDA"],
							   "numero_licencia_tenencia_armas" => $_POST["nuevoNumeroLicenciaTDA"],
							   "imagen_licencia_tenencia_armas" =>$rutaLicLTA,
							   "servicio_militar" => $_POST["nuevoServicioMilitar"],
							   "lugar_servicio" => $_POST["nuevoLugarServicioMilitar"],
							   "grado_militar" => $_POST["nuevoGradoMilitar"],
							   "motivo_baja" => $_POST["nuevoMotivoBaja"],
							   "ex_pnc" => $_POST["nuevoExPnc"],
							   "curso_ansp" => $_POST["nuevoCursoANSP"],
							   "trabajo_anterior" => $_POST["nuevoTrabajoAnterior"],
							   "sueldo_que_devengo" => $_POST["nuevoSueldoDevengo"],
							   "trabajo_actual" => $_POST["nuevoTrabajoActual"],
							   "sueldo_que_devenga" => $_POST["nuevoSueldoDevenga"],
							   "suspendido_trabajo_anterior" => $_POST["nuevoSuspendidoAnterior"],
							   "empresa_suspendio" => $_POST["nuevoEmpresaSuspendio"],
							   "motivo_suspension" => $_POST["nuevoMotivoSuspension"],
							   "experiencia_laboral" => $_POST["nuevoExperienciaLaboral"],
							   "razon_trabajar_en_ise" => $_POST["nuevoRazonIse"],
							   "numero_personas_dependientes" => $_POST["nuevoNumeroPersonasDependientes"],
							   "observaciones" => $_POST["nuevoObservaciones"],
							   "telefono_trabajo_anterior" => $_POST["nuevoNumeroTelTrabajoAnterior"],
							   "telefono_trabajo_actual" => $_POST["nuevoTrabajoActual"],
							   "referencia_anterior" => $_POST["nuevoNombreRefTrabajoAnterior"],
							   "evaluacion_anterior" => $_POST["nuevoEvaluacionAnterior"],
							   "referencia_actual" => $_POST["nuevoNomRefTrabajoActual"],
							   "evaluacion_actual" => $_POST["nuevoEvaluacionActual"],
							   "info_verificada" => $_POST["nuevoInfoVerificada"],
							   "confiable" => $_POST["nuevoConfiable"],
                               "estado" => $_POST["nuevoEstado"],					           
					           "fotografia"=>$ruta,
							   "imagen_documento_identidad"=>$rutaDoc
                            );

				$respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El Empleado ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "empleados";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "empleados";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR EMPLEADO
	=============================================*/

	static public function ctrMostrarEmpleados($item, $valor){

		$tabla = "tbl_empleados";

		$respuesta = ModeloEmpleados::MdlMostrarEmpleados($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	static public function ctrEditarEmpleado(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN FOTOGRAFIA
				=============================================*/
				$ruta = $_POST["fotoActual"];
				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
					$nuevoAncho = 354;
					$nuevoAlto = 418;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActual"])){
						unlink($_POST["fotoActual"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFoto"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);	
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if($_FILES["editarFoto"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}

				/*=============================================
				VALIDAR IMAGEN DOCUMENTO IDENTIDAD
				=============================================*/
				$rutaDoc = $_POST["fotoActualDoc"];
				if(isset($_FILES["editarFotoDoc"]["tmp_name"]) && !empty($_FILES["editarFotoDoc"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoDoc"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualDoc"])){
						unlink($_POST["fotoActualDoc"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoDoc"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaDoc = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/d".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoDoc"]["tmp_name"], $rutaDoc)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoDoc"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaDoc = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/d".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoDoc"]["tmp_name"], $rutaDoc)) {							
						}
						else{								
						}
					}
				}
				/*=============================================
				VALIDAR IMAGEN LICENCIA DE CONDUCIR
				=============================================*/
				$rutaLicCond= $_POST["fotoActualLicCond"];
				if(isset($_FILES["editarFotoLicCond"]["tmp_name"]) && !empty($_FILES["editarFotoLicCond"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoLicCond"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualLicCond"])){
						unlink($_POST["fotoActualLicCond"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoLicCond"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaLicCond = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/licenciaconducir".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoLicCond"]["tmp_name"], $rutaLicCond)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoLicCond"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaLicCond = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/licenciaconducir".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoLicCond"]["tmp_name"], $rutaLicCond)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN LICENCIA LTA
				=============================================*/
				$rutaLicLTA= $_POST["fotoActualLicLTA"];
				if(isset($_FILES["editarFotoLicLTA"]["tmp_name"]) && !empty($_FILES["editarFotoLicLTA"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoLicLTA"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualLicLTA"])){
						unlink($_POST["fotoActualLicLTA"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoLicLTA"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaLicLTA = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/licenciatenenciaarmas".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoLicLTA"]["tmp_name"], $rutaLicLTA)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoLicLTA"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaLicLTA = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/licenciatenenciaarmas".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoLicLTA"]["tmp_name"], $rutaLicLTA)) {							
						}
						else{								
						}
					}
				}


				$tabla = "tbl_empleados";

				$datos = array("primer_nombre" => $_POST["editarNombre"],
								"segundo_nombre" => $_POST["editarSegundoNombre"],
								"tercer_nombre" => $_POST["editarTercerNombre"],
								"primer_apellido" => $_POST["editarPrimerApellido"],
								"segundo_apellido" => $_POST["editarSegundoApellido"],
								"apellido_casada" => $_POST["editarApellidoCasada"],
								"estado_civil" => $_POST["editarEstadoCivil"],
								"sexo" => $_POST["editarSexo"],
								"direccion" => $_POST["editarDireccion"],
					           "documento_identidad" => $_POST["editarTipoDocumento"],
                               "numero_documento_identidad" => $_POST["editarNumeroDocumento"],
							   "telefono" => $_POST["editarNumeroTelefono"],
								"numero_isss" => $_POST["editarNumeroIsss"],
								"nombre_segun_isss" => $_POST["editarNombreIsss"],
								"lugar_expedicion_documento" => $_POST["editarLugarExpedicionDoc"],
								"licencia_conducir" => $_POST["editarNumeroLicenciaConducir"],
								"tipo_licencia_conducir" => $_POST["editarTipoLicenciaConducir"],
								"imagen_licencia_conducir"=>$rutaLicCond,
								"nit" => $_POST["editarNumeroNit"],
								"nup" => $_POST["editarNumeroNup"],
								"profesion_oficio" => $_POST["editarProfesionOficio"],
								"nacionalidad" => $_POST["editarNacionalidad"],
								"lugar_nacimiento" => $_POST["editarLugarNac"],
								"religion" => $_POST["editarReligion"],
								"grado_estudio" => $_POST["editarGradoEstudios"],
								"plantel" => $_POST["editarPlantel"],
								"peso" => $_POST["editarPeso"],
								"estatura" => $_POST["editarEstatura"],
								"piel" => $_POST["editarPiel"],
								"ojos" => $_POST["editarOjos"],
								"cabello" => $_POST["editarCabello"],
								"cara" => $_POST["editarCara"],
								"tipo_sangre" => $_POST["editarTipoSangre"],
								"senales_especiales" => $_POST["editarSenalesEspeciales"],
								"licencia_tenencia_armas" => $_POST["editarLicenciaTDA"],
								"numero_licencia_tenencia_armas" => $_POST["editarNumeroLicenciaTDA"],
								"imagen_licencia_tenencia_armas"=>$rutaLicLTA,
								"servicio_militar" => $_POST["editarServicioMilitar"],
								"lugar_servicio" => $_POST["editarLugarServicioMilitar"],
								"grado_militar" => $_POST["editarGradoMilitar"],
								"motivo_baja" => $_POST["editarMotivoBaja"],
								"ex_pnc" => $_POST["editarExPNC"],
								"curso_ansp" => $_POST["editarCursoANSP"],
								"trabajo_anterior" => $_POST["editarTrabajoAnterior"],
								"sueldo_que_devengo" => $_POST["editarSueldoDevengo"],
								"trabajo_actual" => $_POST["editarTrabajoActual"],
								"sueldo_que_devenga" => $_POST["editarSueldoDevenga"],
								"suspendido_trabajo_anterior" => $_POST["editarSuspendidoAnterior"],
								"empresa_suspendio" => $_POST["editarEmpresaSuspendio"],
								"motivo_suspension" => $_POST["editarMotivoSuspension"],
								"experiencia_laboral" => $_POST["editarExperienciaLaboral"],
								"razon_trabajar_en_ise" => $_POST["editarRazonIse"],
								"numero_personas_dependientes" => $_POST["editarPersonasDependientes"],
								"observaciones" => $_POST["editarObservaciones"],
								"telefono_trabajo_anterior" => $_POST["editarNumTelTrabajoAnterior"],
								"telefono_trabajo_actual" => $_POST["editarTrabajoActual"],
								"referencia_anterior" => $_POST["editarNomRefTrabajoAnterior"],
								"evaluacion_anterior" => $_POST["editarEvaluacionAnterior"],
								"referencia_actual" => $_POST["editarNomRefTrabajoActual"],
								"evaluacion_actual" => $_POST["editarEvaluacionActual"],
								"info_verificada" => $_POST["editarInfoVerificada"],
								"confiable" => $_POST["editarConfiable"],
                               "estado" => $_POST["editarEstado"],					           
					           "fotografia"=>$ruta,
							   "imagen_documento_identidad"=>$rutaDoc,
                               "id"=>$_POST["idEmpleado"]);

				//print_r($datos);

				$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Empleado ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "empleados";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR EMPLEADO
	=============================================*/

	static public function ctrBorrarEmpleado(){

		if(isset($_GET["idEmpleado"])){

			$tabla ="tbl_empleados";
			$datos = $_GET["idEmpleado"];

			if($_GET["fotoEmpleado"] != ""){

				unlink($_GET["fotoEmpleado"]);
				rmdir('vistas/img/empleados/'.$_GET["empleado"]);

			}

			$respuesta = ModeloEmpleados::mdlBorrarEmpleado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Empleado ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "empleados";

								}
							})

				</script>';

			}		

		}

	}


}
	


