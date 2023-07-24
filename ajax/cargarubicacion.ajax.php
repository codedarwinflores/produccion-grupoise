

<?php

require_once "../modelos/conexion.php";

$valor=$_POST["valor"];



function getContent($ids) {

	$query = "SELECT * FROM `tbl_clientes_ubicaciones` WHERE  id_coordinador_zona=".$ids."";

    echo $query;

	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent($valor);
        $dato="";
		$dato .="<option value='*' >Todas las Ubicaciones</option>";
		foreach($data as $row) {
            $dato .="<option value='".$row["id"]."' >".$row["nombre_ubicacion"]."</option>";

			
		}


		echo $dato;


?>