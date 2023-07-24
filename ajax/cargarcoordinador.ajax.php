

<?php

require_once "../modelos/conexion.php";

$valor=$_POST["valor"];



function getContent($ids) {

	$query = "SELECT `id`, `idpatrulla_coordinadorpatrulla`, `codigo_nombre_coordinador`, idcoordinador_patrulla FROM `coordinadorpatrulla` WHERE  idpatrulla_coordinadorpatrulla=".$ids."";
    echo $query;
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent($valor);
        $dato="";
		foreach($data as $row) {
            $dato .="<option value='".$row["idcoordinador_patrulla"]."' >".$row["codigo_nombre_coordinador"]."</option>";
		}


		echo $dato;


?>