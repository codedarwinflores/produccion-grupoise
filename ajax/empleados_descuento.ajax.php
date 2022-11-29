<?php

//require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");
require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php");
$db=Conexion2();


//Eliminar Pariente
if(isset($_POST["bandera_eliminar"])){
	//capturar variables 
	$id_descuento= $_POST["id_descuento"];
	$queryMaestro=$db->query("DELETE FROM tbl_empleados_devengos_descuentos WHERE id = $id_descuento" );			 
	if(!$queryMaestro){
		//echo "DELETE * FROM tbl_empleados_parentesco WHERE id = $id_pariente";
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error al eliminar descuento.</div>';
		echo $db->last_error();
		exit();
	}
	echo "0";
}
else{//Mostrar Pariente
	//capturar variables 
	$id_empleado= $_POST["id_empleado"];
	//TRAER LOS DATOS GENERALES DEL EMPLEADO
	$queryMaestro=$db->query("SELECT * FROM tbl_empleados WHERE id = $id_empleado" );			 
	if(!$queryMaestro){
		echo "SELECT * FROM tbl_empleados WHERE id = $id_empleado";
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error al buscar datos en empleados.</div>';
		echo $db->last_error();
		exit();
	}
	$rowMaestro=$queryMaestro->fetch_row();
	$cadenaMaestro =   "<b>DATOS GENERALES DEL EMPLEADO</b>
						<br><b>Nombres:</b>&nbsp;&nbsp;".$rowMaestro[2]." ".$rowMaestro[3]." 
						<br><b>Apellidos:</b>&nbsp;&nbsp;".$rowMaestro[4]." ".$rowMaestro[5]." ".$rowMaestro[6]." ".$rowMaestro[7]."
						<br><b>No Documento:</b>&nbsp;&nbsp;".$rowMaestro[17]."
						<br><br>
						<b>LISTA DE DEVENGOS Y DESCUENTOS REGISTRADOS</b><br>
						";
	//TRAER LOS PARIENTES YA REGISTRADOS
	$queryDetalle=$db->query("SELECT * FROM tbl_empleados_devengos_descuentos WHERE id_empleado = $id_empleado" );			 
	if(!$queryDetalle){
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error el ver el Detalle.</div>';
		echo $db->last_error();
		exit();
	}
	$cadenaDetalle="";
	while($rowDetalle=$queryDetalle->fetch_row()){	
		$cadenaDetalle = $cadenaDetalle."
		<div>
			<b>Tipo:</b>&nbsp;&nbsp;&nbsp;".$rowDetalle[2]."<br>
			<b>Valor:</b>&nbsp;&nbsp;&nbsp;".$rowDetalle[3]."<br>
			<b>Fecha Caducidad:</b>&nbsp;&nbsp;&nbsp;".$rowDetalle[4]."<br>
			<b>Referencia:</b>&nbsp;&nbsp;&nbsp;".$rowDetalle[5]."<br>
			
			<button class='btn btn-danger btnEliminarEmpleadoDescuento' idDescuentoEmpleado='".$rowDetalle[0]."' onclick ='eliminarEmpleadodescuento(".$rowDetalle[0].")' >Eliminar Registro</button>
		</div><br><br>";
	}
	echo $cadenaMaestro.$cadenaDetalle;	

}




?>