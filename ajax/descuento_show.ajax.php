<?php

require_once "../modelos/conexion.php";

$idempleadoretiro=$_POST["id"];
function getContent() {
	global $idempleadoretiro;
	$query = "SELECT uniformedescuento.id as iddescuento, `fecha_descuento`, `codigo_empleado_descuento`, `codigo_uni_descuento`, `numero_recibo_descuento`, `valor_descuento`, `observacion_descuento` ,tbl_devengo_descuento.id as iddevengo, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`,tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `imagen_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, `observaciones`, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_partida_nacimiento`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `imagen_constancia_psicologica`, `imagen_examen_poligrafico`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo`
		FROM `uniformedescuento` ,tbl_devengo_descuento, tbl_empleados
		WHERE tbl_devengo_descuento.codigo=uniformedescuento.codigo_uni_descuento and tbl_empleados.id=uniformedescuento.codigo_empleado_descuento and codigo_empleado_descuento=$idempleadoretiro";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent();
		foreach($data as $value) {


			echo ' <tr>
                   <td>'.$value["fecha_descuento"].'</td>
                   <td>'.$value["codigo_empleado_descuento"].'</td>
                   <td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"].'</td>
                   <td>'.$value["codigo_uni_descuento"].'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["numero_recibo_descuento"].'</td>
                   <td>'.$value["valor_descuento"].'</td>
                   <td>'.$value["observacion_descuento"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditaruniformedescuento" iduniformedescuento="'.$value["iddescuento"].'" data-toggle="modal" data-target="#modalEditaruniformedescuento"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminaruniformedescuento" iduniformedescuento="'.$value["iddescuento"].'"  Codigo="'.$value["codigo_empleado_descuento"].'"><i class="fa fa-times"></i></button>
 
                     </div>  
 
                   </td>
 
                 </tr>';


				}


?>