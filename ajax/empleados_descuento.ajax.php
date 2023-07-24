<?php

require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php"); /* SERVIDOR */
/* require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php"); */
/* require($_SERVER['DOCUMENT_ROOT']."/armoni/git/modelos/conexion2.php"); */

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
else if(isset($_POST["bandera_editar"])){
	//capturar variables 
	$id_descuento= $_POST["id_descuento"];
	$id_tipo_devengo_descuento=$_POST["id_tipo_devengo_descuento"];
	$valor=$_POST["valor"];
	/* $fecha_caducidad=$_POST["fecha_caducidad"]; */
	$fecha_caducidad = date("Y-m-d", strtotime($_POST["fecha_caducidad"]));
	$referencia=$_POST["referencia"];
	$tipodescuento=$_POST["tipodescuento"];

	

	

	$queryEditar=$db->query("UPDATE tbl_empleados_devengos_descuentos SET 
	  id_tipo_devengo_descuento = $id_tipo_devengo_descuento,	  
	  valor = '$valor',
	  fecha_caducidad = '$fecha_caducidad',
	  referencia = '$referencia',
	  tipodescuento = '$tipodescuento'

	 
	 WHERE id = $id_descuento" );			 
	if(!$queryEditar){		
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error al editar devengo o descuento.</div>';
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
						<b style='width: 100%;font-size: large;text-align: center;color: #3c388b;float:left'>LISTA DE DEVENGOS Y DESCUENTOS REGISTRADOS</b><br>
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
		//crear control select con todas las popciones de tipos de devengos descreuntos
		$queryDescripcion=$db->query("SELECT * FROM  tbl_devengo_descuento " );			 
		if(!$queryDescripcion){
			echo'<div class="error_ mensajes"><strong>Error</strong><br/>error el ver el Detalle.</div>';
			echo $db->last_error();
			exit();
		}
		$selectDD = '<div class="form-group">
						<label for="">Tipo devengo/descuento:</label>             
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-users"></i></span>
							<SELECT  class="form-control input-lg" name="editarTipoDD'.$rowDetalle[0].'" id="editarTipoDD'.$rowDetalle[0].'" >';
								while($rowDescripcion=$queryDescripcion->fetch_row()){
									if($rowDescripcion[0] == $rowDetalle[2]){
										$selectDD = $selectDD.'<option value="'.$rowDescripcion[0].'" selected>'.$rowDescripcion[2].'</option>';
									}
									else{
										$selectDD = $selectDD.'<option value="'.$rowDescripcion[0].'">'.$rowDescripcion[2].'</option>';
									}
									
								}
							$selectDD = $selectDD.'</SELECT>
						</div>
        			</div>
		';


		$cadenaDetalle = $cadenaDetalle.''.$selectDD.'

		<div class="form-group">
		<label for="">Seleccionar Tipo:</label>             
		<div class="input-group">              
		  <span class="input-group-addon"><i class="fa fa-users"></i></span> 
		  <select class="form-control input-lg" name="editartipodescuento'.$rowDetalle[0].'"  id="editartipodescuento'.$rowDetalle[0].'" required>                  
			<option value="'.$rowDetalle[6].'" >'.$rowDetalle[6].'</option>  
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="Siempre">Siempre</option>
		  </select>
		</div>
	  </div>

		<div class="form-group">
			<label for="">Valor:</label>            
            <div class="input-group">                
				<span class="input-group-addon"><i class="fa fa-users"></i></span>  
				<input type="text" class="form-control input-lg " value="'.$rowDetalle[3].'" name="editarValorDD'.$rowDetalle[0].'"  id="editarValorDD'.$rowDetalle[0].'" placeholder="Ingresar Valor" required >
			</div>            
        </div>
		<div class="form-group"> 
			<label for="">Fecha Caducidad:</label>
			<div class="input-group">                  
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" class="form-control input-lg calendario" value="'.$rowDetalle[4].'" name="editarFechaCaducidadDD'.$rowDetalle[0].'"  id="editarFechaCaducidadDD'.$rowDetalle[0].'" placeholder="Ingresar fecha" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" required readonly>
			</div>
		</div>
		<div class="form-group"> 
			<label for="">Referencia:</label>
			<div class="input-group">                  
				<span class="input-group-addon"><i class="fa fa-users"></i></span>
				<input type="text" class="form-control input-lg " value="'.$rowDetalle[5].'" name="editarReferenciaDD'.$rowDetalle[0].'"  id="editarReferenciaDD'.$rowDetalle[0].'" placeholder="Ingresar referencia" required >
			</div>
		</div>
		<div class="form-group">
			<label for="">Acciones:</label>            
            <div class="input-group">                
				<button type="submit" class="btn btn-info btnEditarDD" idDD="'.$rowDetalle[0].'" onclick ="editarDD('.$rowDetalle[0].')" >Guardar Cambios</button>
				<button class="btn btn-danger btnEliminarDD" idDD="'.$rowDetalle[0].'" onclick ="eliminarEmpleadodescuento('.$rowDetalle[0].')" >Eliminar</button>
			</div>            
        </div>
		<hr style="border-width: 1px;border-color: #8b8888;	"></hr>
		
		';
	}
	echo $cadenaMaestro.$cadenaDetalle;	

}




?>