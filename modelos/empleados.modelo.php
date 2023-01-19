<?php

require_once "conexion.php";

class ModeloEmpleados{

	/*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE EMPLEADOS
	=============================================*/

	
	function getContent() {

		$query = "SHOW COLUMNS FROM tbl_empleados";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();			
		return $stmt->fetchAll();
		
		$stmt->close();
		
		$stmt = null;
	}

	static public function mdlIngresarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (primer_nombre, segundo_nombre, tercer_nombre, primer_apellido, segundo_apellido, apellido_casada, estado_civil, sexo, direccion, id_departamento, id_municipio, documento_identidad, numero_documento_identidad, telefono, numero_isss, nombre_segun_isss, lugar_expedicion_documento, fecha_expedicion_documento, fecha_vencimiento_documento, licencia_conducir, tipo_licencia_conducir, imagen_licencia_conducir, nit, imagen_nit, codigo_afp, nup, profesion_oficio, nacionalidad, lugar_nacimiento, fecha_nacimiento, religion, grado_estudio, plantel, peso, estatura, piel, ojos, cabello, cara, tipo_sangre, senales_especiales, licencia_tenencia_armas, numero_licencia_tenencia_armas, imagen_licencia_tenencia_armas, servicio_militar, fecha_servicio_inicio, fecha_servicio_fin, lugar_servicio, grado_militar, motivo_baja, ex_pnc, curso_ansp, imagen_diploma_ansp, trabajo_anterior, sueldo_que_devengo, trabajo_actual, sueldo_que_devenga, suspendido_trabajo_anterior, empresa_suspendio, motivo_suspension, fecha_suspension, experiencia_laboral, razon_trabajar_en_ise, numero_personas_dependientes, observaciones, telefono_trabajo_anterior, telefono_trabajo_actual, referencia_anterior, evaluacion_anterior, referencia_actual, evaluacion_actual, info_verificada, imagen_solicitud, imagen_partida_nacimiento, imagen_antecedentes_penales, fecha_vencimiento_antecedentes_penales, imagen_solvencia_pnc, fecha_vencimiento_solvencia_pnc, imagen_constancia_psicologica, imagen_examen_poligrafico, imagen_huellas, confiable, estado, nivel_cargo, fotografia, imagen_documento_identidad, pantalon_empleado, camisa_empleado, zapatos_empleado, recomendado_empleado, contacto_empleado, documentacion_empleado, ansp_empleado, uniformeregalado_empleado, fecha_vencimiento_lpa ) VALUES ( :primer_nombre, :segundo_nombre, :tercer_nombre, :primer_apellido, :segundo_apellido, :apellido_casada, :estado_civil, :sexo, :direccion, :id_departamento, :id_municipio, :documento_identidad, :numero_documento_identidad, :telefono, :numero_isss, :nombre_segun_isss, :lugar_expedicion_documento, :fecha_expedicion_documento, :fecha_vencimiento_documento, :licencia_conducir, :tipo_licencia_conducir, :imagen_licencia_conducir, :nit, :imagen_nit, :codigo_afp, :nup, :profesion_oficio, :nacionalidad, :lugar_nacimiento, :fecha_nacimiento, :religion, :grado_estudio, :plantel, :peso, :estatura, :piel, :ojos, :cabello, :cara, :tipo_sangre, :senales_especiales, :licencia_tenencia_armas, :numero_licencia_tenencia_armas, :imagen_licencia_tenencia_armas, :servicio_militar, :fecha_servicio_inicio, :fecha_servicio_fin, :lugar_servicio, :grado_militar, :motivo_baja, :ex_pnc, :curso_ansp, :imagen_diploma_ansp, :trabajo_anterior, :sueldo_que_devengo, :trabajo_actual, :sueldo_que_devenga, :suspendido_trabajo_anterior, :empresa_suspendio, :motivo_suspension, :fecha_suspension, :experiencia_laboral, :razon_trabajar_en_ise, :numero_personas_dependientes, :observaciones, :telefono_trabajo_anterior, :telefono_trabajo_actual, :referencia_anterior, :evaluacion_anterior, :referencia_actual, :evaluacion_actual, :info_verificada, :imagen_solicitud, :imagen_partida_nacimiento, :imagen_antecedentes_penales, :fecha_vencimiento_antecedentes_penales, :imagen_solvencia_pnc, :fecha_vencimiento_solvencia_pnc, :imagen_constancia_psicologica, :imagen_examen_poligrafico, :imagen_huellas, :confiable, :estado, :nivel_cargo, :fotografia, :imagen_documento_identidad, :pantalon_empleado, :camisa_empleado, :zapatos_empleado, :recomendado_empleado, :contacto_empleado, :documentacion_empleado, :ansp_empleado, :uniformeregalado_empleado, :fecha_vencimiento_lpa)");

		$stmt->bindParam(":primer_nombre", $datos["primer_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":segundo_nombre", $datos["segundo_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tercer_nombre", $datos["tercer_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":primer_apellido", $datos["primer_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":segundo_apellido", $datos["segundo_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido_casada", $datos["apellido_casada"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_municipio", $datos["id_municipio"], PDO::PARAM_INT);
		$stmt->bindParam(":documento_identidad", $datos["documento_identidad"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_documento_identidad", $datos["numero_documento_identidad"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_isss", $datos["numero_isss"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_segun_isss", $datos["nombre_segun_isss"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_expedicion_documento", $datos["lugar_expedicion_documento"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_expedicion_documento", $datos["fecha_expedicion_documento"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_vencimiento_documento", $datos["fecha_vencimiento_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":licencia_conducir", $datos["licencia_conducir"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_licencia_conducir", $datos["tipo_licencia_conducir"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_licencia_conducir", $datos["imagen_licencia_conducir"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_nit", $datos["imagen_nit"], PDO::PARAM_STR);		
		$stmt->bindParam(":codigo_afp", $datos["codigo_afp"], PDO::PARAM_STR);
		$stmt->bindParam(":nup", $datos["nup"], PDO::PARAM_STR);
		$stmt->bindParam(":profesion_oficio", $datos["profesion_oficio"], PDO::PARAM_STR);
		$stmt->bindParam(":nacionalidad", $datos["nacionalidad"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_nacimiento", $datos["lugar_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":religion", $datos["religion"], PDO::PARAM_STR);
		$stmt->bindParam(":grado_estudio", $datos["grado_estudio"], PDO::PARAM_STR);
		$stmt->bindParam(":plantel", $datos["plantel"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":estatura", $datos["estatura"], PDO::PARAM_STR);
		$stmt->bindParam(":piel", $datos["piel"], PDO::PARAM_STR);
		$stmt->bindParam(":ojos", $datos["ojos"], PDO::PARAM_STR);
		$stmt->bindParam(":cabello", $datos["cabello"], PDO::PARAM_STR);
		$stmt->bindParam(":cara", $datos["cara"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_sangre", $datos["tipo_sangre"], PDO::PARAM_STR);
		$stmt->bindParam(":senales_especiales", $datos["senales_especiales"], PDO::PARAM_STR);
		$stmt->bindParam(":licencia_tenencia_armas", $datos["licencia_tenencia_armas"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_licencia_tenencia_armas", $datos["numero_licencia_tenencia_armas"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_licencia_tenencia_armas", $datos["imagen_licencia_tenencia_armas"], PDO::PARAM_STR);
		$stmt->bindParam(":servicio_militar", $datos["servicio_militar"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_servicio_inicio", $datos["fecha_servicio_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_servicio_fin", $datos["fecha_servicio_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_servicio", $datos["lugar_servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":grado_militar", $datos["grado_militar"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_baja", $datos["motivo_baja"], PDO::PARAM_STR);
		$stmt->bindParam(":ex_pnc", $datos["ex_pnc"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_diploma_ansp", $datos["imagen_diploma_ansp"], PDO::PARAM_STR);
		$stmt->bindParam(":curso_ansp", $datos["curso_ansp"], PDO::PARAM_STR);
		$stmt->bindParam(":trabajo_anterior", $datos["trabajo_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":sueldo_que_devengo", $datos["sueldo_que_devengo"], PDO::PARAM_STR);
		$stmt->bindParam(":trabajo_actual", $datos["trabajo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":sueldo_que_devenga", $datos["sueldo_que_devenga"], PDO::PARAM_STR);
		$stmt->bindParam(":suspendido_trabajo_anterior", $datos["suspendido_trabajo_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":empresa_suspendio", $datos["empresa_suspendio"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_suspension", $datos["motivo_suspension"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_suspension", $datos["fecha_suspension"], PDO::PARAM_STR);
		$stmt->bindParam(":experiencia_laboral", $datos["experiencia_laboral"], PDO::PARAM_STR);
		$stmt->bindParam(":razon_trabajar_en_ise", $datos["razon_trabajar_en_ise"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_personas_dependientes", $datos["numero_personas_dependientes"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_trabajo_anterior", $datos["telefono_trabajo_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_trabajo_actual", $datos["telefono_trabajo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia_anterior", $datos["referencia_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":evaluacion_anterior", $datos["evaluacion_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia_actual", $datos["referencia_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":evaluacion_actual", $datos["evaluacion_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":info_verificada", $datos["info_verificada"], PDO::PARAM_STR); 
		$stmt->bindParam(":imagen_solicitud", $datos["imagen_solicitud"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_partida_nacimiento", $datos["imagen_partida_nacimiento"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_antecedentes_penales", $datos["imagen_antecedentes_penales"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_vencimiento_antecedentes_penales", $datos["fecha_vencimiento_antecedentes_penales"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_solvencia_pnc", $datos["imagen_solvencia_pnc"], PDO::PARAM_STR);				
		$stmt->bindParam(":fecha_vencimiento_solvencia_pnc", $datos["fecha_vencimiento_solvencia_pnc"], PDO::PARAM_STR);	
		$stmt->bindParam(":imagen_constancia_psicologica", $datos["imagen_constancia_psicologica"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_examen_poligrafico", $datos["imagen_examen_poligrafico"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_huellas", $datos["imagen_huellas"], PDO::PARAM_STR);
		$stmt->bindParam(":confiable", $datos["confiable"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":nivel_cargo", $datos["nivel_cargo"], PDO::PARAM_STR);
		$stmt->bindParam(":fotografia", $datos["fotografia"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen_documento_identidad", $datos["imagen_documento_identidad"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_empleado", $datos["pantalon_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":camisa_empleado", $datos["camisa_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":zapatos_empleado", $datos["zapatos_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":recomendado_empleado", $datos["recomendado_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto_empleado", $datos["contacto_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":documentacion_empleado", $datos["documentacion_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":ansp_empleado", $datos["ansp_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":uniformeregalado_empleado", $datos["uniformeregalado_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento_lpa", $datos["fecha_vencimiento_lpa"], PDO::PARAM_STR);

		if($stmt->execute()){
			

			print_r($datos);


			return "ok";	

		}else{
			print_r($stmt->errorInfo());
			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	static public function mdlEditarEmpleado($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
        primer_nombre = :primer_nombre,
		segundo_nombre = :segundo_nombre,
		tercer_nombre = :tercer_nombre,
		primer_apellido = :primer_apellido,
		segundo_apellido = :segundo_apellido,
		apellido_casada = :apellido_casada,
		estado_civil = :estado_civil,
		sexo = :sexo,
		direccion = :direccion,
		id_departamento = :id_departamento,
		id_municipio = :id_municipio,
        documento_identidad = :documento_identidad,
        numero_documento_identidad = :numero_documento_identidad,
		telefono = :telefono,
		numero_isss = :numero_isss,
		nombre_segun_isss = :nombre_segun_isss,
		lugar_expedicion_documento = :lugar_expedicion_documento,
		fecha_expedicion_documento = :fecha_expedicion_documento,
		fecha_vencimiento_documento =:fecha_vencimiento_documento,
		licencia_conducir = :licencia_conducir,
		tipo_licencia_conducir = :tipo_licencia_conducir,
		imagen_licencia_conducir = :imagen_licencia_conducir,
		nit = :nit,
		imagen_nit = :imagen_nit,
		codigo_afp = :codigo_afp,
		nup = :nup,
		profesion_oficio = :profesion_oficio,
		nacionalidad = :nacionalidad,
		lugar_nacimiento = :lugar_nacimiento,
		fecha_nacimiento = :fecha_nacimiento,
		religion = :religion,
		grado_estudio = :grado_estudio,
		plantel = :plantel,
		peso = :peso,
		estatura = :estatura,
		piel = :piel,
		ojos = :ojos,
		cabello = :cabello,
		cara = :cara,
		tipo_sangre = :tipo_sangre,
		senales_especiales = :senales_especiales,
		licencia_tenencia_armas = :licencia_tenencia_armas,
		numero_licencia_tenencia_armas = :numero_licencia_tenencia_armas,
		imagen_licencia_tenencia_armas = :imagen_licencia_tenencia_armas,
		servicio_militar = :servicio_militar,
		fecha_servicio_inicio = :fecha_servicio_inicio,
		fecha_servicio_fin = :fecha_servicio_fin,
		lugar_servicio = :lugar_servicio,
		grado_militar = :grado_militar,
		motivo_baja = :motivo_baja,
		ex_pnc = :ex_pnc,
		curso_ansp = :curso_ansp,
		imagen_diploma_ansp = :imagen_diploma_ansp,
		trabajo_anterior = :trabajo_anterior,
		sueldo_que_devengo = :sueldo_que_devengo,
		trabajo_actual = :trabajo_actual,
		sueldo_que_devenga = :sueldo_que_devenga,
		suspendido_trabajo_anterior = :suspendido_trabajo_anterior,
		empresa_suspendio = :empresa_suspendio,
		motivo_suspension = :motivo_suspension,
		fecha_suspension = :fecha_suspension,
		experiencia_laboral = :experiencia_laboral,
		razon_trabajar_en_ise = :razon_trabajar_en_ise,
		numero_personas_dependientes = :numero_personas_dependientes,
		observaciones = :observaciones,
		telefono_trabajo_anterior = :telefono_trabajo_anterior,
		telefono_trabajo_actual = :telefono_trabajo_actual,
		referencia_anterior = :referencia_anterior,
		evaluacion_anterior = :evaluacion_anterior,
		referencia_actual = :referencia_actual,
		evaluacion_actual = :evaluacion_actual,
		info_verificada = :info_verificada,
		imagen_solicitud = :imagen_solicitud,
		imagen_partida_nacimiento = :imagen_partida_nacimiento,
		imagen_antecedentes_penales = :imagen_antecedentes_penales,
		fecha_vencimiento_antecedentes_penales =:fecha_vencimiento_antecedentes_penales,
		imagen_solvencia_pnc = :imagen_solvencia_pnc,
		fecha_vencimiento_solvencia_pnc = :fecha_vencimiento_solvencia_pnc,
		imagen_constancia_psicologica = :imagen_constancia_psicologica,
		imagen_examen_poligrafico = :imagen_examen_poligrafico,
		imagen_huellas = :imagen_huellas,
		confiable = :confiable,
        estado = :estado,
		nivel_cargo = :nivel_cargo, 
        fotografia = :fotografia,
		imagen_documento_identidad = :imagen_documento_identidad,
		pantalon_empleado=:pantalon_empleado,
		camisa_empleado=:camisa_empleado,
		zapatos_empleado=:zapatos_empleado,
		recomendado_empleado=:recomendado_empleado,
		contacto_empleado=:contacto_empleado,
		documentacion_empleado=:documentacion_empleado,
		ansp_empleado=:ansp_empleado,
		uniformeregalado_empleado=:uniformeregalado_empleado,
		fecha_ingreso=:fecha_ingreso,
		fecha_contratacion=:fecha_contratacion,
		id_departamento_empresa=:id_departamento_empresa,
		periodo_pago=:periodo_pago,
		horas_normales_trabajo=:horas_normales_trabajo,
		sueldo=:sueldo,
		sueldo_diario=:sueldo_diario,
		salario_por_hora=:salario_por_hora,
		hora_extra_diurna=:hora_extra_diurna,
		hora_extra_nocturna=:hora_extra_nocturna,
		hora_extra_domingo=:hora_extra_domingo,
		hora_extra_nocturna_domingo=:hora_extra_nocturna_domingo,
		id_tipo_portacion=:id_tipo_portacion,
		descontar_isss=:descontar_isss,
		descontar_afp=:descontar_afp,
		id_tipo_planilla=:id_tipo_planilla,
		id_banco=:id_banco,
		numero_cuenta=:numero_cuenta,
		anticipo=:anticipo,
		reportado_a_pnc=:reportado_a_pnc,
		tipo_empleado=:tipo_empleado,
		id_jefe_operaciones=:id_jefe_operaciones,
		imagen_contrato=:imagen_contrato,
		fecha_vencimiento_lpa=:fecha_vencimiento_lpa,
		constancia_psicologica=:constancia_psicologica,
		nombre_psicologo=:nombre_psicologo
        WHERE id = :id"
        );

		$stmt -> bindParam(":primer_nombre", $datos["primer_nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":segundo_nombre", $datos["segundo_nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":tercer_nombre", $datos["tercer_nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":primer_apellido", $datos["primer_apellido"], PDO::PARAM_STR);
		$stmt -> bindParam(":segundo_apellido", $datos["segundo_apellido"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellido_casada", $datos["apellido_casada"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
		$stmt -> bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_municipio", $datos["id_municipio"], PDO::PARAM_INT);
		$stmt -> bindParam(":documento_identidad", $datos["documento_identidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_documento_identidad", $datos["numero_documento_identidad"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_isss", $datos["numero_isss"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_segun_isss", $datos["nombre_segun_isss"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_expedicion_documento", $datos["lugar_expedicion_documento"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_expedicion_documento", $datos["fecha_expedicion_documento"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_vencimiento_documento", $datos["fecha_vencimiento_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":licencia_conducir", $datos["licencia_conducir"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_licencia_conducir", $datos["tipo_licencia_conducir"], PDO::PARAM_STR); 
		$stmt->bindParam(":imagen_licencia_conducir", $datos["imagen_licencia_conducir"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_nit", $datos["imagen_nit"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_afp", $datos["codigo_afp"], PDO::PARAM_STR);
		$stmt->bindParam(":nup", $datos["nup"], PDO::PARAM_STR);
		$stmt->bindParam(":profesion_oficio", $datos["profesion_oficio"], PDO::PARAM_STR);
		$stmt->bindParam(":nacionalidad", $datos["nacionalidad"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_nacimiento", $datos["lugar_nacimiento"], PDO::PARAM_STR);		
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":religion", $datos["religion"], PDO::PARAM_STR);
		$stmt->bindParam(":grado_estudio", $datos["grado_estudio"], PDO::PARAM_STR);
		$stmt->bindParam(":plantel", $datos["plantel"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":estatura", $datos["estatura"], PDO::PARAM_STR);
		$stmt->bindParam(":piel", $datos["piel"], PDO::PARAM_STR);
		$stmt->bindParam(":ojos", $datos["ojos"], PDO::PARAM_STR);
		$stmt->bindParam(":cabello", $datos["cabello"], PDO::PARAM_STR);
		$stmt->bindParam(":cara", $datos["cara"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_sangre", $datos["tipo_sangre"], PDO::PARAM_STR);
		$stmt->bindParam(":senales_especiales", $datos["senales_especiales"], PDO::PARAM_STR);
		$stmt->bindParam(":licencia_tenencia_armas", $datos["licencia_tenencia_armas"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_licencia_tenencia_armas", $datos["numero_licencia_tenencia_armas"], PDO::PARAM_STR); 
		$stmt->bindParam(":imagen_licencia_tenencia_armas", $datos["imagen_licencia_tenencia_armas"], PDO::PARAM_STR);
		$stmt->bindParam(":servicio_militar", $datos["servicio_militar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_servicio_inicio", $datos["fecha_servicio_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_servicio_fin", $datos["fecha_servicio_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_servicio", $datos["lugar_servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":grado_militar", $datos["grado_militar"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_baja", $datos["motivo_baja"], PDO::PARAM_STR);
		$stmt->bindParam(":ex_pnc", $datos["ex_pnc"], PDO::PARAM_STR);
		$stmt->bindParam(":curso_ansp", $datos["curso_ansp"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen_diploma_ansp", $datos["imagen_diploma_ansp"], PDO::PARAM_STR);
		$stmt->bindParam(":trabajo_anterior", $datos["trabajo_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":sueldo_que_devengo", $datos["sueldo_que_devengo"], PDO::PARAM_STR);
		$stmt->bindParam(":trabajo_actual", $datos["trabajo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":sueldo_que_devenga", $datos["sueldo_que_devenga"], PDO::PARAM_STR);
		$stmt->bindParam(":suspendido_trabajo_anterior", $datos["suspendido_trabajo_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":empresa_suspendio", $datos["empresa_suspendio"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo_suspension", $datos["motivo_suspension"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_suspension", $datos["fecha_suspension"], PDO::PARAM_STR);
		$stmt->bindParam(":experiencia_laboral", $datos["experiencia_laboral"], PDO::PARAM_STR);
		$stmt->bindParam(":razon_trabajar_en_ise", $datos["razon_trabajar_en_ise"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_personas_dependientes", $datos["numero_personas_dependientes"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_trabajo_anterior", $datos["telefono_trabajo_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_trabajo_actual", $datos["telefono_trabajo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia_anterior", $datos["referencia_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":evaluacion_anterior", $datos["evaluacion_anterior"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia_actual", $datos["referencia_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":evaluacion_actual", $datos["evaluacion_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":info_verificada", $datos["info_verificada"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_solicitud", $datos["imagen_solicitud"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_partida_nacimiento", $datos["imagen_partida_nacimiento"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_antecedentes_penales", $datos["imagen_antecedentes_penales"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento_antecedentes_penales", $datos["fecha_vencimiento_antecedentes_penales"], PDO::PARAM_STR);				
		$stmt->bindParam(":imagen_solvencia_pnc", $datos["imagen_solvencia_pnc"], PDO::PARAM_STR);	
		$stmt->bindParam(":fecha_vencimiento_solvencia_pnc", $datos["fecha_vencimiento_solvencia_pnc"], PDO::PARAM_STR);	
		$stmt->bindParam(":imagen_constancia_psicologica", $datos["imagen_constancia_psicologica"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_examen_poligrafico", $datos["imagen_examen_poligrafico"], PDO::PARAM_STR);		
		$stmt->bindParam(":imagen_huellas", $datos["imagen_huellas"], PDO::PARAM_STR);
		$stmt->bindParam(":confiable", $datos["confiable"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":nivel_cargo", $datos["nivel_cargo"], PDO::PARAM_STR);
        $stmt -> bindParam(":fotografia", $datos["fotografia"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen_documento_identidad", $datos["imagen_documento_identidad"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_empleado", $datos["pantalon_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":camisa_empleado", $datos["camisa_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":zapatos_empleado", $datos["zapatos_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":recomendado_empleado", $datos["recomendado_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto_empleado", $datos["contacto_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":documentacion_empleado", $datos["documentacion_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":ansp_empleado", $datos["ansp_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":uniformeregalado_empleado", $datos["uniformeregalado_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_contratacion", $datos["fecha_contratacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_departamento_empresa", $datos["id_departamento_empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":periodo_pago", $datos["periodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":horas_normales_trabajo", $datos["horas_normales_trabajo"], PDO::PARAM_STR);
		$stmt->bindParam(":sueldo", $datos["sueldo"], PDO::PARAM_STR);
		$stmt->bindParam(":sueldo_diario", $datos["sueldo_diario"], PDO::PARAM_STR);
		$stmt->bindParam(":salario_por_hora", $datos["salario_por_hora"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_extra_diurna", $datos["hora_extra_diurna"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_extra_nocturna", $datos["hora_extra_nocturna"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_extra_domingo", $datos["hora_extra_domingo"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_extra_nocturna_domingo", $datos["hora_extra_nocturna_domingo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tipo_portacion", $datos["id_tipo_portacion"], PDO::PARAM_INT);
		$stmt->bindParam(":descontar_isss", $datos["descontar_isss"], PDO::PARAM_STR);
		$stmt->bindParam(":descontar_afp", $datos["descontar_afp"], PDO::PARAM_STR); 
		$stmt->bindParam(":id_tipo_planilla", $datos["id_tipo_planilla"], PDO::PARAM_INT);
		$stmt->bindParam(":id_banco", $datos["id_banco"], PDO::PARAM_INT);  
		$stmt->bindParam(":numero_cuenta", $datos["numero_cuenta"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		$stmt->bindParam(":reportado_a_pnc", $datos["reportado_a_pnc"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_empleado", $datos["tipo_empleado"], PDO::PARAM_STR);  
		$stmt->bindParam(":id_jefe_operaciones", $datos["id_jefe_operaciones"], PDO::PARAM_INT);
		$stmt -> bindParam(":imagen_contrato", $datos["imagen_contrato"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_vencimiento_lpa", $datos["fecha_vencimiento_lpa"], PDO::PARAM_STR);
		$stmt -> bindParam(":constancia_psicologica", $datos["constancia_psicologica"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre_psicologo", $datos["nombre_psicologo"], PDO::PARAM_STR);



		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);


	
		if($stmt -> execute()){
			//print_r($stmt->errorInfo());
			return "ok";
		
		}else{
			print_r($stmt->errorInfo());
			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR EMPLEADO
	=============================================*/

	static public function mdlActualizarEmpleado($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR EMPLEADO
	=============================================*/

	static public function mdlBorrarEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}