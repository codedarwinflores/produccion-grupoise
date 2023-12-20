<?php

require_once "../controladores/recibo.controlador.php";
require_once "../modelos/recibo.modelo.php";

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
	$aleatorio = mt_rand(100,999);

	$targetDirectory = "../vistas/img/armas/";

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = $targetDirectory . $_FILES['file']['name']; // Ruta de destino

	// Verifica si la carpeta de destino existe, si no, la crea
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }
	
    move_uploaded_file($tempFile, $targetPath);
    echo "¡Archivo subido con éxito!";
} else {
    echo "Error al subir el archivo.";
}


?>