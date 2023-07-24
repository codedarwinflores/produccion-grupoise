<?php

require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");
/* require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php"); */
/* require($_SERVER['DOCUMENT_ROOT']."/armoni/git/modelos/conexion2.php"); */

$db=Conexion2();


//Eliminar Pariente
if(isset($_POST["bandera_eliminar"])){
	//capturar variables 
	$id_pariente= $_POST["id_pariente"];
	$queryMaestro=$db->query("DELETE FROM tbl_empleados_parentesco WHERE id = $id_pariente" );			 
	if(!$queryMaestro){
		//echo "DELETE * FROM tbl_empleados_parentesco WHERE id = $id_pariente";
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error al eliminar pariente.</div>';
		echo $db->last_error();
		exit();
	}
	echo "0";
}
else if(isset($_POST["bandera_editar"])){//Editar Pariente
	//capturar variables 
	$id_pariente= $_POST["id_pariente"];
	$parentesco=$_POST["parentesco"];
	$nombre=$_POST["nombre"];
	$edad=$_POST["edad"];
	$con_vida=$_POST["con_vida"];
	$direccion=$_POST["direccion"];
	$telefono=$_POST["telefono"];

	

	$queryEditar=$db->query("UPDATE tbl_empleados_parentesco SET 
	  parentesco = '$parentesco',
	  nombre = '$nombre',
	  edad = '$edad',
	  con_vida = '$con_vida',
	  direccion = '$direccion',
	  telefono = '$telefono'
	 
	 WHERE id = $id_pariente" );			 
	if(!$queryEditar){		
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error al editar pariente.</div>';
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
						<b style='width: 100%;font-size: large;text-align: center;color: #3c388b;float:left'>LISTA DE PARIENTES REGISTRADOS</b><br>
						";
	//TRAER LOS PARIENTES YA REGISTRADOS
	$queryDetalle=$db->query("SELECT * FROM tbl_empleados_parentesco WHERE id_empleado = $id_empleado" );			 
	if(!$queryDetalle){
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>error el ver el Detalle.</div>';
		echo $db->last_error();
		exit();
	}
	$cadenaDetalle="";
	while($rowDetalle=$queryDetalle->fetch_row()){	
		$cadenaDetalle = $cadenaDetalle.'
		
		<input type="hidden" id="idParentesco" name="idParentesco'.$rowDetalle[0].'" id="idParentesco'.$rowDetalle[0].'" value"'.$rowDetalle[0].'">
		<div class="form-group">
            <label for="">Parentesco:</label>             
            <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarParentesco'.$rowDetalle[0].'" id="editarParentesco'.$rowDetalle[0].'" required>                  
					<option value="" >Seleccione Parentesco</option>
					<option value="'.$rowDetalle[2].'" selected>'.$rowDetalle[2].'</option>  
					<option value="Esposo(a)">Esposo(a)</option>
					<option value="Hijo(a)">Hijo(a)</option>
					<option value="Padre">Padre</option>
					<option value="Madre">Madre</option>
					<option value="Hermano(a)">Hermano(a)</option>
					<option value="Tio(a)">Tio(a)</option>
					<option value="Primo(a)">Primo(a)</option>
					<option value="Sobrino(a)">Sobrino(a)</option>
					<option value="Abuelo(a)">Abuelo(a)</option>
					<option value="cunado(a)">cunado(a)</option>                 
                </select>
            </div>
        </div>
		<div class="form-group">
			<label for="">Nombre Completo:</label>            
            <div class="input-group">                
				<span class="input-group-addon"><i class="fa fa-users"></i></span>  
				<input type="text" class="form-control input-lg " value="'.$rowDetalle[3].'" name="editarNombreParentesco'.$rowDetalle[0].'"  id="editarNombreParentesco'.$rowDetalle[0].'" placeholder="Ingresar Nombre Completo" required >
			</div>            
        </div>
		<div class="form-group">
			<label for="">Fecha Nacimiento:</label>            
            <div class="input-group">                
				<span class="input-group-addon"><i class="fa fa-users"></i></span>  
				<input type="text" class="form-control input-lg editarEdadParentesco" value="'.$rowDetalle[4].'" name="editarEdadParentesco'.$rowDetalle[0].'" id="editarEdadParentesco'.$rowDetalle[0].'"  placeholder="Ingresar Fecha Nacimiento" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  required readonly>
			</div>            
        </div>
		<div class="form-group">
            <label for="">Con vida?</label>             
            <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarConVidaParentesco'.$rowDetalle[0].'" id="editarConVidaParentesco'.$rowDetalle[0].'" required>                  
					<option value="" >Seleccione </option>
					<option value="'.$rowDetalle[5].'" selected>'.$rowDetalle[5].'</option>  
					<option value="SI">SI</option>
					<option value="NO">NO</option>					               
                </select>
            </div>
        </div>
		<div class="form-group">
			<label for="">Direcci&oacute;n:</label>            
            <div class="input-group">                
				<span class="input-group-addon"><i class="fa fa-users"></i></span>  
				<input type="text" class="form-control input-lg " value="'.$rowDetalle[6].'" name="editarDireccionParentesco'.$rowDetalle[0].'" id="editarDireccionParentesco'.$rowDetalle[0].'" placeholder="Ingresar direcci&oacute;n" required >
			</div>            
        </div>
		<div class="form-group">
			<label for="">Tel&eacute;fono:</label>            
            <div class="input-group">                
				<span class="input-group-addon"><i class="fa fa-users"></i></span>  
				<input type="text" class="form-control input-lg input_telefono_1 telefono" value="'.$rowDetalle[7].'" name="editarTelefonoParentesco'.$rowDetalle[0].'"  id="editarTelefonoParentesco'.$rowDetalle[0].'" placeholder="Ingresar tel&eacute;fono" required >
			</div>            
        </div>
		<div class="form-group">
			<label for="">Acciones:</label>            
            <div class="input-group">                
				<button type="submit" class="btn btn-info btnEditarPariente" idPariente="'.$rowDetalle[0].'" onclick ="editarPariente('.$rowDetalle[0].')" >Guardar Cambios</button>
				<button class="btn btn-danger btnEliminarPariente" idPariente="'.$rowDetalle[0].'" onclick ="eliminarPariente('.$rowDetalle[0].')" >Eliminar</button>
			</div>            
        </div>
		<hr style="border-width: 1px;border-color: #8b8888;	"></hr>
		
		
		';

		
		

		

		
	}

	echo $cadenaMaestro.$cadenaDetalle;	

}




?>