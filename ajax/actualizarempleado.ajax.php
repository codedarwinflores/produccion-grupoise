<?php 
require_once "../modelos/conexion.php";

$fotos = $_FILES['fotos']["tmp_name"];
$nombre_columna= $_POST['nombre_columna']; 
$iddato= $_POST['iddato']; 



/*=============================================
				VALIDAR fotos
				=============================================*/

				$ruta="vacio";
				if(isset($_FILES['fotos']["tmp_name"]) && !empty($_FILES['fotos']["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["fotos"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL DOCUMENTO
					=============================================*/
					$directorio = "../vistas/img/empleados/".$_POST["iddato"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST['fotos'])){
						unlink($_POST['fotos']);
					}else{
						mkdir($directorio, 0755);
					}	
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES['fotos']["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,99999);
						$ruta = "../vistas/img/empleados/".$_POST["iddato"]."/".$nombre_columna.$aleatorio.".jpg";
						//$origen = imagecreatefromjpeg($_FILES["editarFotoDoc"]["tmp_name"]);	
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagejpeg($destino, $rutaDoc);
						if(move_uploaded_file($_FILES["fotos"]["tmp_name"], $ruta)) {							
						}
						else{								
						}
					}
					if($_FILES['fotos']["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,9999);
						$ruta= "../vistas/img/empleados/".$_POST["iddato"]."/".$nombre_columna.$aleatorio.".png";
						//$origen = imagecreatefrompng($_FILES["editarFotoDoc"]["tmp_name"]);
						//$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						//imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						//imagepng($destino, $ruta);
						if(move_uploaded_file($_FILES['fotos']["tmp_name"], $ruta)) {							
						}
						else{								
						}
					}
				}





$query = "UPDATE `tbl_empleados` SET $nombre_columna='$ruta' where numero_documento_identidad='$iddato'";
$stmt = Conexion::conectar()->prepare($query);
$stmt->execute();			
/* echo $query.'  '.$fotos; */


?>