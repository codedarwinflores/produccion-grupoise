

<?php

require_once "../modelos/conexion.php";

$bono=$_POST["bono"];
$codigo=$_POST["codigo"];
$usuario=$_POST["usuario"];
$id=$_POST["id"];



function getContent($ids, $bonos) {

	$query = "SELECT count(*) as numero FROM `tbl_clientes_ubicaciones` WHERE id=".$ids." and bono_unidad='".$bonos."'";

    echo $query;

	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent($id,$bono);
        $dato="";
		foreach($data as $row) {
            $dato=$row["numero"];
			
		}



if($dato==1){

}
else{

	$query = "INSERT INTO `tbl_ubicaciones_bono`( `usuario_historial`, `accion_historial`, `codigoubicacion_historial`, `idubicacion_historial`) VALUES('".$usuario."','".$bono."','".$codigo."',".$id.")";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
}







?>