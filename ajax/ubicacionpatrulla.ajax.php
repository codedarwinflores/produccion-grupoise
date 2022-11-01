<?php

require_once "../controladores/administrarpatrulla.controlador.php";
require_once "../modelos/administrarpatrulla.modelo.php";


		$item = "id";
		$id = $_POST["idpatrulla"];

function getContent() {
	global $id;
	$query = "SELECT tbl_patrullas_ubicaciones.id as id_patrullas_ubicaciones, `id_patrullas_pu`, `id_ubicacion_pu` , tbl_clientes_ubicaciones.id as idubicaciones, `id_cliente`, `codigo_cliente`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, `direccion`, `persona_contacto`, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, `id_departamento`, `id_municipio`, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados` , tbl_patrullas.id as idpatrulla , `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla` 
	FROM `tbl_patrullas_ubicaciones`, tbl_clientes_ubicaciones, tbl_patrullas
	WHERE tbl_clientes_ubicaciones.id=tbl_patrullas_ubicaciones.id_ubicacion_pu and tbl_patrullas.id = tbl_patrullas_ubicaciones.id_patrullas_pu and id_patrullas_pu=$id";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$dato="";
		$data = getContent();



        foreach ($data as $value){
          
		/* echo json_encode($respuesta); */
		$dato.="<tr>";
		$dato.="<td>".$value["nombre_ubicacion"]."</td>";

		$dato .='<td><div class="btn-group">
                         
		<button class="btn btn-warning btnEditarubicacion" idadministrarpatrulla="'.$value["id_patrullas_ubicaciones"].'" data-toggle="modal" data-target="#modalEditaradministrarpatrulla"><i class="fa fa-pencil"></i></button>

		<button class="btn btn-danger btnEliminaradministrarpatrulla" id="'.$id.'" idadministrarpatrulla="'.$value["id_patrullas_ubicaciones"].'"  Codigo="'.$value["id_patrullas_pu"].'"><i class="fa fa-times"></i></button>

	  </div>  
		</td>';
		$dato.="</tr>";
		}
		echo json_encode($dato);
