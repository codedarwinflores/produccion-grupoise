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
				VALIDAR IMAGEN LICENCIA DE CONDUCIR
				=============================================*/
				$rutaNIT = "";
				if(isset($_FILES["nuevaFotoNIT"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoNIT"]["tmp_name"]);
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
					if($_FILES["nuevaFotoNIT"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaNIT= "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/nit_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoNIT"]["tmp_name"], $rutaNIT)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoNIT"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaNIT = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/nit_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoNIT"]["tmp_name"], $rutaNIT)) {							
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

				/*=============================================
				VALIDAR IMAGEN DIPLOMA ANSP
				=============================================*/
				$rutaANSP = "";
				if(isset($_FILES["nuevaFotoANSP"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoANSP"]["tmp_name"]);
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
					if($_FILES["nuevaFotoANSP"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaANSP = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/diploma_ansp".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoANSP"]["tmp_name"], $rutaANSP)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoANSP"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaANSP = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/diploma_ansp".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoANSP"]["tmp_name"], $rutaANSP)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN SOLICITUD
				=============================================*/
				$rutaSOLICITUD = "";
				if(isset($_FILES["nuevaFotoSOLICITUD"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoSOLICITUD"]["tmp_name"]);
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
					if($_FILES["nuevaFotoSOLICITUD"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaSOLICITUD = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/solicitud_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoSOLICITUD"]["tmp_name"], $rutaSOLICITUD)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoSOLICITUD"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaSOLICITUD = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/solicitud_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoSOLICITUD"]["tmp_name"], $rutaSOLICITUD)) {							
						}
						else{								
						}
					}
				}


				/*=============================================
				VALIDAR PARTIDA DE NACIMIENTO
				=============================================*/
				$rutaPARTIDA = "";
				if(isset($_FILES["nuevaFotoPARTIDA"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoPARTIDA"]["tmp_name"]);
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
					if($_FILES["nuevaFotoPARTIDA"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPARTIDA = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/partidanacimiento_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoPARTIDA"]["tmp_name"], $rutaPARTIDA)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoPARTIDA"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPARTIDA = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/partidanacimiento_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoPARTIDA"]["tmp_name"], $rutaPARTIDA)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR ANTECEDENTES PENALES
				=============================================*/
				$rutaANTECEDENTES = "";
				if(isset($_FILES["nuevaFotoANTECEDENTES"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoANTECEDENTES"]["tmp_name"]);
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
					if($_FILES["nuevaFotoANTECEDENTES"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaANTECEDENTES = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/antecedentespenales_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoANTECEDENTES"]["tmp_name"], $rutaANTECEDENTES)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoANTECEDENTES"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaANTECEDENTES = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/antecedentespenales_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoANTECEDENTES"]["tmp_name"], $rutaANTECEDENTES)) {							
						}
						else{								
						}
					}
				}



				/*=============================================
				VALIDAR SOLVENCIA PNC
				=============================================*/
				$rutaSOLVENCIAPNC = "";
				if(isset($_FILES["nuevaFotoSOLVENCIAPNC"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoSOLVENCIAPNC"]["tmp_name"]);
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
					if($_FILES["nuevaFotoSOLVENCIAPNC"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaSOLVENCIAPNC = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/solvenciapnc_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoSOLVENCIAPNC"]["tmp_name"], $rutaSOLVENCIAPNC)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoSOLVENCIAPNC"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaSOLVENCIAPNC = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/solvenciapnc_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoSOLVENCIAPNC"]["tmp_name"], $rutaSOLVENCIAPNC)) {							
						}
						else{								
						}
					}
				}


				/*=============================================
				VALIDAR CONSTANCIA PSYCO
				=============================================*/
				$rutaPSYCO = "";
				if(isset($_FILES["nuevaFotoPSYCO"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoPSYCO"]["tmp_name"]);
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
					if($_FILES["nuevaFotoPSYCO"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPSYCO = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/constancia_psicologica_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoPSYCO"]["tmp_name"], $rutaPSYCO)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoPSYCO"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPSYCO = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/constancia_psicologica_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoPSYCO"]["tmp_name"], $rutaPSYCO)) {							
						}
						else{								
						}
					}
				}


				/*=============================================
				VALIDAR CONSTANCIA POLI
				=============================================*/
				$rutaPOLI = "";
				if(isset($_FILES["nuevaFotoPOLI"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoPOLI"]["tmp_name"]);
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
					if($_FILES["nuevaFotoPOLI"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPOLI = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/examen_poligrafico_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoPOLI"]["tmp_name"], $rutaPOLI)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoPOLI"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPOLI = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/examen_poligrafico_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoPOLI"]["tmp_name"], $rutaPOLI)) {							
						}
						else{								
						}
					}
				}


				/*=============================================
				VALIDAR CONSTANCIA HUELLAS
				=============================================*/
				$rutaHUELLAS = "";
				if(isset($_FILES["nuevaFotoHUELLAS"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaFotoHUELLAS"]["tmp_name"]);
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
					if($_FILES["nuevaFotoHUELLAS"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaHUELLAS = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/huellas_digitales_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["nuevaFotoLicCond"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);						
						if(move_uploaded_file($_FILES["nuevaFotoHUELLAS"]["tmp_name"], $rutaHUELLAS)) {							
						}
						else{								
						}
					}
					if($_FILES["nuevaFotoHUELLAS"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaHUELLAS = "vistas/img/empleados/".$_POST["nuevoNumeroDocumento"]."/huellas_digitales_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["nuevaFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["nuevaFotoHUELLAS"]["tmp_name"], $rutaHUELLAS)) {							
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
								"id_departamento" => $_POST["nuevoDepartamento"],
								"id_municipio" => $_POST["nuevoMunicipio"],
					           "documento_identidad" => $_POST["nuevoTipoDocumento"],
                               "numero_documento_identidad" => $_POST["nuevoNumeroDocumento"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "numero_isss" => $_POST["nuevoNumeroIsss"],
							   "nombre_segun_isss" => $_POST["nuevoNombreIsss"],
							   "lugar_expedicion_documento" => $_POST["nuevoLugarExpedicionDoc"],
							   "fecha_expedicion_documento" => $_POST["nuevofecha_expedicion"],
							   "fecha_vencimiento_documento" => $_POST["nuevofecha_vencimiento"],
							   "licencia_conducir" => $_POST["nuevoLicenciaConducir"],
							   "tipo_licencia_conducir" => $_POST["nuevoTipoLicenciaConducir"],
							   "imagen_licencia_conducir" =>$rutaLicCond,
							   "nit" => $_POST["nuevoNumeroNIT"],
							   "imagen_nit" =>$rutaNIT,
							   "codigo_afp" => $_POST["nuevoAFP"],
							   "nup" => $_POST["nuevoNumeroNUP"],
							   "profesion_oficio" => $_POST["nuevoProfesionOficio"],
							   "nacionalidad" => $_POST["nuevoNacionalidad"],
							   "lugar_nacimiento" => $_POST["nuevoLugarNacimiento"],
							   "fecha_nacimiento" => $_POST["nuevofecha_nacimiento"],
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
							   "fecha_servicio_inicio" => $_POST["nuevofecha_inism"],
							   "fecha_servicio_fin" => $_POST["nuevofecha_finsm"],
							   "lugar_servicio" => $_POST["nuevoLugarServicioMilitar"],
							   "grado_militar" => $_POST["nuevoGradoMilitar"],
							   "motivo_baja" => $_POST["nuevoMotivoBaja"],
							   "ex_pnc" => $_POST["nuevoExPnc"],
							   "curso_ansp" => $_POST["nuevoCursoANSP"],
							   "imagen_diploma_ansp" =>$rutaANSP,
							   "trabajo_anterior" => $_POST["nuevoTrabajoAnterior"],
							   "sueldo_que_devengo" => $_POST["nuevoSueldoDevengo"],
							   "trabajo_actual" => $_POST["nuevoTrabajoActual"],
							   "sueldo_que_devenga" => $_POST["nuevoSueldoDevenga"],
							   "suspendido_trabajo_anterior" => $_POST["nuevoSuspendidoAnterior"],
							   "empresa_suspendio" => $_POST["nuevoEmpresaSuspendio"],
							   "motivo_suspension" => $_POST["nuevoMotivoSuspension"],
							   "fecha_suspension" => $_POST["nuevofecha_susp"],
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
							   "imagen_solicitud" =>$rutaSOLICITUD,
							   "imagen_partida_nacimiento" =>$rutaPARTIDA,
							   "imagen_antecedentes_penales" =>$rutaANTECEDENTES,
							   "fecha_vencimiento_antecedentes_penales" => $_POST["nuevofecha_venceAP"],
							   "imagen_solvencia_pnc" =>$rutaSOLVENCIAPNC,
							   "fecha_vencimiento_solvencia_pnc" => $_POST["nuevofecha_venceSPNC"],
							   "imagen_constancia_psicologica" =>$rutaPSYCO,
							   "imagen_examen_poligrafico" =>$rutaPOLI,
							   "imagen_huellas" =>$rutaHUELLAS,							   
                               "estado" => $_POST["nuevoEstado"],
							   "nivel_cargo" => $_POST["nuevoCARGO"],					           
					           "fotografia"=>$ruta,
							   "imagen_documento_identidad"=>$rutaDoc,
							   "pantalon_empleado" => $_POST["nuevopantalon_empleado"],
							   "camisa_empleado" => $_POST["nuevocamisa_empleado"],
							   "zapatos_empleado" => $_POST["nuevozapatos_empleado"],
							   "recomendado_empleado" => $_POST["nuevorecomendado_empleado"],
							   "contacto_empleado" => $_POST["nuevocontacto_empleado"],
							   "documentacion_empleado" => $_POST["nuevodocumentacion_empleado"],
							   "ansp_empleado" => $_POST["nuevoansp_empleado"],
							   "uniformeregalado_empleado" => $_POST["nuevouniformeregalado_empleado"]

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
				else{
					echo'<script>

					swal({
						  type: "error",
						  title: "El Empleado NO ha sido guardado correctamente",
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
				VALIDAR IMAGEN NIT
				=============================================*/
				$rutaNIT= $_POST["fotoActualNIT"];
				if(isset($_FILES["editarFotoNIT"]["tmp_name"]) && !empty($_FILES["editarFotoNIT"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoNIT"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualNIT"])){
						unlink($_POST["fotoActualNIT"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoNIT"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaNIT = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/nit_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoNIT"]["tmp_name"], $rutaNIT)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoNIT"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaNIT = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/nit_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoNIT"]["tmp_name"], $rutaNIT)) {							
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


				/*=============================================
				VALIDAR IMAGEN DIPLOMA ANSP
				=============================================*/
				$rutaANSP= $_POST["fotoActualANSP"];
				if(isset($_FILES["editarFotoANSP"]["tmp_name"]) && !empty($_FILES["editarFotoANSP"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoANSP"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualANSP"])){
						unlink($_POST["fotoActualANSP"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoANSP"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaANSP = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/diploma_ansp".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoANSP"]["tmp_name"], $rutaANSP)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoANSP"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaANSP = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/diploma_ansp".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoANSP"]["tmp_name"], $rutaANSP)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN PARA LA SOLICITUD
				=============================================*/
				$rutaSOLICITUD= $_POST["fotoActualSOLICITUD"];
				if(isset($_FILES["editarFotoSOLICITUD"]["tmp_name"]) && !empty($_FILES["editarFotoSOLICITUD"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoSOLICITUD"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualSOLICITUD"])){
						unlink($_POST["fotoActualSOLICITUD"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoSOLICITUD"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaSOLICITUD = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/solicitud_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoSOLICITUD"]["tmp_name"], $rutaSOLICITUD)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoSOLICITUD"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaSOLICITUD = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/solicitud_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoSOLICITUD"]["tmp_name"], $rutaSOLICITUD)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN PARA LA PARTIDA NACIMIENTO
				=============================================*/
				$rutaPARTIDA= $_POST["fotoActualPARTIDA"];
				if(isset($_FILES["editarFotoPARTIDA"]["tmp_name"]) && !empty($_FILES["editarFotoPARTIDA"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoPARTIDA"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualPARTIDA"])){
						unlink($_POST["fotoActualPARTIDA"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoPARTIDA"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPARTIDA = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/partidanacimiento_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoPARTIDA"]["tmp_name"], $rutaPARTIDA)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoPARTIDA"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaPARTIDA = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/partidanacimiento_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoPARTIDA"]["tmp_name"], $rutaPARTIDA)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN PARA ANTECEDENTES PENALES
				=============================================*/
				$rutaANTECEDENTES= $_POST["fotoActualANTECEDENTES"];
				if(isset($_FILES["editarFotoANTECEDENTES"]["tmp_name"]) && !empty($_FILES["editarFotoANTECEDENTES"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoANTECEDENTES"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualANTECEDENTES"])){
						unlink($_POST["fotoActualANTECEDENTES"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoANTECEDENTES"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaANTECEDENTES = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/antecedentespenales_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoANTECEDENTES"]["tmp_name"], $rutaANTECEDENTES)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoANTECEDENTES"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaANTECEDENTES = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/antecedentespenales_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoANTECEDENTES"]["tmp_name"], $rutaANTECEDENTES)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN SOLVENCIA PNC
				=============================================*/
				$rutaSOLVENCIAPNC= $_POST["fotoActualSOLVENCIAPNC"];
				if(isset($_FILES["editarFotoSOLVENCIAPNC"]["tmp_name"]) && !empty($_FILES["editarFotoSOLVENCIAPNC"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoSOLVENCIAPNC"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualSOLVENCIAPNC"])){
						unlink($_POST["fotoActualSOLVENCIAPNC"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoSOLVENCIAPNC"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaSOLVENCIAPNC = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/solvenciapnc_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoSOLVENCIAPNC"]["tmp_name"], $rutaSOLVENCIAPNC)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoSOLVENCIAPNC"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaSOLVENCIAPNC = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/solvenciapnc_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoSOLVENCIAPNC"]["tmp_name"], $rutaSOLVENCIAPNC)) {							
						}
						else{								
						}
					}
				}

				/*=============================================
				VALIDAR IMAGEN CONSTANCIA PSYCO
				=============================================*/
				$rutaPSYCO= $_POST["fotoActualPSYCO"];
				if(isset($_FILES["editarFotoPSYCO"]["tmp_name"]) && !empty($_FILES["editarFotoPSYCO"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoPSYCO"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActuaPSYCO"])){
						unlink($_POST["fotoActuaPSYCO"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoPSYCO"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPSYCO = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/constancia_psicologica_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoPSYCO"]["tmp_name"], $rutaPSYCO)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoPSYCO"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaPSYCO = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/constancia_psicologica_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoPSYCO"]["tmp_name"], $rutaPSYCO)) {							
						}
						else{								
						}
					}
				}


				/*=============================================
				VALIDAR IMAGEN EXAMEN POLIGRAFICO
				=============================================*/
				$rutaPOLI= $_POST["fotoActualPOLI"];
				if(isset($_FILES["editarFotoPOLI"]["tmp_name"]) && !empty($_FILES["editarFotoPOLI"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoPOLI"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActuaPOLI"])){
						unlink($_POST["fotoActuaPOLI"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoPOLI"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaPOLI = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/examen_poligrafico_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoPOLI"]["tmp_name"], $rutaPOLI)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoPOLI"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaPOLI= "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/examen_poligrafico".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoPOLI"]["tmp_name"], $rutaPOLI)) {							
						}
						else{								
						}
					}
				}


				/*=============================================
				VALIDAR IMAGEN HUELLAS DIGITALES
				=============================================*/
				$rutaHUELLAS= $_POST["fotoActualHUELLAS"];
				if(isset($_FILES["editarFotoHUELLAS"]["tmp_name"]) && !empty($_FILES["editarFotoHUELLAS"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarFotoHUELLAS"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "vistas/img/empleados/".$_POST["editarNumeroDocumento"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["fotoActualHUELLAS"])){
						unlink($_POST["fotoActualHUELLAS"]);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarFotoHUELLAS"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$rutaHUELLAS = "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/huellas_digitales_".$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["editarFotoHUELLAS"]["tmp_name"], $rutaHUELLAS)) {							
						}
						else{								
						}
					}
					if($_FILES["editarFotoHUELLAS"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$rutaHUELLAS= "vistas/img/empleados/".$_POST["editarNumeroDocumento"]."/huellas_digitales_".$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES["editarFotoHUELLAS"]["tmp_name"], $rutaHUELLAS)) {							
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
								"id_departamento" => $_POST["editarDepartamento"],
								"id_municipio" => $_POST["editarMunicipio"],
					           "documento_identidad" => $_POST["editarTipoDocumento"],
                               "numero_documento_identidad" => $_POST["editarNumeroDocumento"],
							   "telefono" => $_POST["editarNumeroTelefono"],
								"numero_isss" => $_POST["editarNumeroIsss"],
								"nombre_segun_isss" => $_POST["editarNombreIsss"],
								"lugar_expedicion_documento" => $_POST["editarLugarExpedicionDoc"],
								"fecha_expedicion_documento" => $_POST["editarfecha_expedicion"],
								"fecha_vencimiento_documento" => $_POST["editarfecha_vencimiento"],
								"licencia_conducir" => $_POST["editarNumeroLicenciaConducir"],
								"tipo_licencia_conducir" => $_POST["editarTipoLicenciaConducir"],
								"imagen_licencia_conducir"=>$rutaLicCond,								
								"nit" => $_POST["editarNumeroNit"],
								"imagen_nit"=>$rutaNIT,
								"codigo_afp" => $_POST["editarAFP"],
								"nup" => $_POST["editarNumeroNup"],
								"profesion_oficio" => $_POST["editarProfesionOficio"],
								"nacionalidad" => $_POST["editarNacionalidad"],
								"lugar_nacimiento" => $_POST["editarLugarNac"],
								"fecha_nacimiento" => $_POST["editarfecha_nacimiento"],
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
								"fecha_servicio_inicio" => $_POST["editarfecha_inism"],
							   "fecha_servicio_fin" => $_POST["editarfecha_finsm"],
								"lugar_servicio" => $_POST["editarLugarServicioMilitar"],
								"grado_militar" => $_POST["editarGradoMilitar"],
								"motivo_baja" => $_POST["editarMotivoBaja"],
								"ex_pnc" => $_POST["editarExPNC"],
								"imagen_diploma_ansp"=>$rutaANSP,
								"curso_ansp" => $_POST["editarCursoANSP"],
								"trabajo_anterior" => $_POST["editarTrabajoAnterior"],
								"sueldo_que_devengo" => $_POST["editarSueldoDevengo"],
								"trabajo_actual" => $_POST["editarTrabajoActual"],
								"sueldo_que_devenga" => $_POST["editarSueldoDevenga"],
								"suspendido_trabajo_anterior" => $_POST["editarSuspendidoAnterior"],
								"empresa_suspendio" => $_POST["editarEmpresaSuspendio"],
								"motivo_suspension" => $_POST["editarMotivoSuspension"],
								"fecha_suspension" => $_POST["editarfecha_susp"],
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
								"imagen_solicitud"=>$rutaSOLICITUD,
								"imagen_partida_nacimiento"=>$rutaPARTIDA,
								"imagen_antecedentes_penales"=>$rutaANTECEDENTES,
								"fecha_vencimiento_antecedentes_penales" => $_POST["editarfecha_venceAP"],
								"imagen_solvencia_pnc"=>$rutaSOLVENCIAPNC,
								"fecha_vencimiento_solvencia_pnc" => $_POST["editarfecha_venceSPNC"],
								"imagen_constancia_psicologica"=>$rutaPSYCO,
								"imagen_examen_poligrafico"=>$rutaPOLI,
								"imagen_huellas"=>$rutaHUELLAS,
								"confiable" => $_POST["editarConfiable"],
                               "estado" => $_POST["editarEstado"],	
							   "nivel_cargo" => $_POST["editarCARGO"],					           
					           "fotografia"=>$ruta,
							   "imagen_documento_identidad"=>$rutaDoc,
							   "pantalon_empleado" => $_POST["editarpantalon_empleado"],
							   "camisa_empleado" => $_POST["editarcamisa_empleado"],
							   "zapatos_empleado" => $_POST["editarzapatos_empleado"],
							   "recomendado_empleado" => $_POST["editarrecomendado_empleado"],
							   "contacto_empleado" => $_POST["editarcontacto_empleado"],
							   "documentacion_empleado" => $_POST["editardocumentacion_empleado"],
							   "ansp_empleado" => $_POST["editaransp_empleado"],
							   "uniformeregalado_empleado" => $_POST["editaruniformeregalado_empleado"],
                               "id"=>$_POST["idEmpleado"]);

				

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
				else{
					echo'<script>

					swal({
						  type: "error",
						  title: "El Empleado NO ha sido editado correctamente",
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
	


