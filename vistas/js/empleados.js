
/*=============================================
SUBIENDO LA FOTO DEL EMPLEADO
=============================================*/
$(".nuevaFotoEmp").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoEmp").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoEmp").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizar").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
SUBIENDO LA FOTO DEL DOCUMENTO DE IDENTIDAD
=============================================*/
$(".nuevaFotoDoc").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoDoc").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoDoc").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarDoc").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
SUBIENDO LA FOTO DE LICENCIA DE CONDUCIR
=============================================*/
$(".nuevaFotoLicCond").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoLicCond").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoLicCond").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarLicCond").attr("src", rutaImagen);
  		})
  	}
})

/*=============================================
SUBIENDO LA FOTO DE NIT
=============================================*/
$(".nuevaFotoNIT").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoNIT").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoNIT").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarNIT").attr("src", rutaImagen);
  		})
  	}
})
/*=============================================
SUBIENDO LA FOTO DE LICENCIA TENENCIA ARMAS
=============================================*/
$(".nuevaFotoLicLTA").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoLicLTA").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoLicLTA").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarLicLTA").attr("src", rutaImagen);
  		})
  	}
})

/*=============================================
SUBIENDO LA FOTO DE DIPLOMA ANSP
=============================================*/
$(".nuevaFotoANSP").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoANSP").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoANSP").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarANSP").attr("src", rutaImagen);
  		})
  	}
})

/*=============================================
SUBIENDO LA FOTO DE LA SOLICITUD
=============================================*/
$(".nuevaFotoSOLICITUD").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoSOLICITUD").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoSOLICITUD").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarSOLICITUD").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
SUBIENDO LA FOTO DE LA PARTIDA DE NACIMIENTO
=============================================*/
$(".nuevaFotoPARTIDA").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoPARTIDA").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoPARTIDA").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarPARTIDA").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
SUBIENDO LA FOTO DE ANTECEDENTES PENALES
=============================================*/
$(".nuevaFotoANTECEDENTES").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoANTECEDENTES").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoANTECEDENTES").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarANTECEDENTES").attr("src", rutaImagen);
  		})
  	}
})

/*=============================================
SUBIENDO LA FOTO DE SOLVENCIA PNC
=============================================*/
$(".nuevaFotoSOLVENCIAPNC").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoSOLVENCIAPNC").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoSOLVENCIAPNC").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarSOLVENCIAPNC").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
SUBIENDO LA FOTO DE CONSTANCIA PSYCO
=============================================*/
$(".nuevaFotoPSYCO").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoPSYCO").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoPSYCO").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarPSYCO").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
SUBIENDO LA FOTO DE EXAMEN POLIGRAFICO
=============================================*/
$(".nuevaFotoPOLI").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoPOLI").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoPOLI").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarPOLI").attr("src", rutaImagen);
  		})
  	}
})

/*=============================================
SUBIENDO LA FOTO DE HUELLAS DIGITALES
=============================================*/
$(".nuevaFotoHUELLAS").change(function(){
	var imagen = this.files[0];	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  		$(".nuevaFotoHUELLAS").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else if(imagen["size"] > 2000000){
  		$(".nuevaFotoHUELLAS").val("");
  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
  	}else{
  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);
  		$(datosImagen).on("load", function(event){
  			var rutaImagen = event.target.result;
  			$(".previsualizarHUELLAS").attr("src", rutaImagen);
  		})
  	}
})


/*=============================================
EDITAR EMPLEADO
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleado", function(){

	var idEmpleado = $(this).attr("idEmpleado");
	
	var datos = new FormData();
	datos.append("idEmpleado", idEmpleado);

	$.ajax({

		url:"ajax/empleados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

            $("#idEmpleado").val(respuesta["id"]);
            if(respuesta["fotografia"] != ""){
				$(".previsualizarEditar").attr("src", respuesta["fotografia"]);
			}else{
				$(".previsualizarEditar").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActual").val(respuesta["fotografia"]);

			$("#editarNombre").val(respuesta["primer_nombre"]);
			$("#editarSegundoNombre").val(respuesta["segundo_nombre"]);
			$("#editarTercerNombre").val(respuesta["tercer_nombre"]);
			$("#editarPrimerApellido").val(respuesta["primer_apellido"]);
			$("#editarSegundoApellido").val(respuesta["segundo_apellido"]);
			$("#editarApellidoCasada").val(respuesta["apellido_casada"]);

			$("#editarEstadoCivil").html(respuesta["estado_civil"]);
			$("#editarEstadoCivil").val(respuesta["estado_civil"]);

			$("#editarSexo").html(respuesta["sexo"]);
			$("#editarSexo").val(respuesta["sexo"]);
			
			$("#editarDireccion").val(respuesta["direccion"]);
			

			//poblar editar Departamento			
			iddepartamento = respuesta["id_departamento"];			
			var datosDep = new FormData();
			datosDep.append("idDepartamento", iddepartamento);
			$.ajax({
				url:"ajax/departamentos3.ajax.php",
				method: "POST",
				data: datosDep,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuestaDep){	
					myArray = respuestaDep.split(",");		
					$("#editarDepartamento").html(myArray[1]);
					$("#editarDepartamento").val(myArray[0]);				
				}
			});

			

			//poblar editar municipio
			idmunicipio = respuesta["id_municipio"];			
			var datosMun = new FormData();
			datosMun.append("idMunicipio", idmunicipio);
			$.ajax({
				url:"ajax/municipio4.ajax.php",
				method: "POST",
				data: datosMun,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuestaMun){			
					//alert(respuestaMun);
					myArray = respuestaMun.split(",");
					$("#editarMunicipio").html(myArray[1]);
					$("#editarMunicipio").val(respuesta["id_municipio"]);
					
				}
			});



			$("#editarTipoDocumento").html(respuesta["documento_identidad"]);
			$("#editarTipoDocumento").val(respuesta["documento_identidad"]);

            $("#editarNumeroDocumento").val(respuesta["numero_documento_identidad"]);

			$("#editarNumeroTelefono").val(respuesta["telefono"]);
			$("#editarNumeroIsss").val(respuesta["numero_isss"]);		
			$("#editarNombreIsss").val(respuesta["nombre_segun_isss"]);
			$("#editarLugarExpedicionDoc").val(respuesta["lugar_expedicion_documento"]);

			var date0 = respuesta["fecha_expedicion_documento"];
			var formattedDate = new Date(date0); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){

			}
			else{
				$("#mascarafecha").val(respuesta["fecha_expedicion_documento"]);
				$("#editarfecha_expedicion").val(respuesta["fecha_expedicion_documento"]);
			}
			

			var date1 = respuesta["fecha_vencimiento_documento"];
			var formattedDate = new Date(date1); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){				
				$("#mascarafechav").val('');
				$("#editarfecha_vencimiento").val('');
			}
			else{
				$("#mascarafechav").val(respuesta["fecha_vencimiento_documento"]);
				$("#editarfecha_vencimiento").val(respuesta["fecha_vencimiento_documento"]);
			}
			

			var date2 = respuesta["fecha_nacimiento"];
			var formattedDate = new Date(date2); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){
				
			}
			else{
				$("#mascarafechanac").val(respuesta["fecha_nacimiento"]);
				$("#editarfecha_nacimiento").val(respuesta["fecha_nacimiento"]);
			}
			




			$("#editarNumeroLicenciaConducir").val(respuesta["licencia_conducir"]);
			
			$("#editarTipoLicenciaConducir").html(respuesta["tipo_licencia_conducir"]);
			$("#editarTipoLicenciaConducir").val(respuesta["tipo_licencia_conducir"]);

			if(respuesta["imagen_licencia_conducir"] != ""){
				$(".previsualizarEditarLicCond").attr("src", respuesta["imagen_licencia_conducir"]);
			}else{
				$(".previsualizarEditarLicCond").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualLicCond").val(respuesta["imagen_licencia_conducir"]);



			$("#editarNumeroNit").val(respuesta["nit"]);


			if(respuesta["imagen_nit"] != ""){
				$(".previsualizarEditarNIT").attr("src", respuesta["imagen_nit"]);
			}else{
				$(".previsualizarEditarNIT").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualNIT").val(respuesta["imagen_nit"]);

			//BUSCAR EL NOMBRE DE LA AFP SEGUN EL CODIGO QUE TENEMOS			
			var datosAFP = new FormData();
			datosAFP.append("codigo_afp", respuesta["codigo_afp"]);
			$.ajax({
				url:"ajax/afp.ajax.php",
				method: "POST",
				data: datosAFP,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuestaAFP){					
					$("#editarAFP").html(respuestaAFP[2]);
					$("#editarAFP").val(respuestaAFP[1]);								 
				}
			})

			



			$("#editarNumeroNup").val(respuesta["nup"]);
			$("#editarProfesionOficio").val(respuesta["profesion_oficio"]);
			$("#editarNacionalidad").val(respuesta["nacionalidad"]);
			$("#editarLugarNac").val(respuesta["lugar_nacimiento"]);
			$("#editarReligion").val(respuesta["religion"]);
			$("#editarGradoEstudios").val(respuesta["grado_estudio"]);
			$("#editarPlantel").val(respuesta["plantel"]);
			$("#editarPeso").val(respuesta["peso"]);
			$("#editarEstatura").val(respuesta["estatura"]);
			$("#editarPiel").val(respuesta["piel"]);
			$("#editarOjos").val(respuesta["ojos"]);
			$("#editarCabello").val(respuesta["cabello"]);
			$("#editarCara").val(respuesta["cara"]);

			$("#editarTipoSangre").val(respuesta["tipo_sangre"]);
			$("#editarTipoSangre").html(respuesta["tipo_sangre"]);

			$("#editarSenalesEspeciales").val(respuesta["senales_especiales"]);

			$("#editarLicenciaTDA").val(respuesta["licencia_tenencia_armas"]);
			$("#editarLicenciaTDA").html(respuesta["licencia_tenencia_armas"]);
			$("#editarNumeroLicenciaTDA").val(respuesta["numero_licencia_tenencia_armas"]);

			if(respuesta["imagen_licencia_tenencia_armas"] != ""){
				$(".previsualizarEditarLicLTA").attr("src", respuesta["imagen_licencia_tenencia_armas"]);
			}else{
				$(".previsualizarEditarLicLTA").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualLicLTA").val(respuesta["imagen_licencia_tenencia_armas"]);

			$("#editarServicioMilitar").val(respuesta["servicio_militar"]);
			$("#editarServicioMilitar").html(respuesta["servicio_militar"]);

			var date3 = respuesta["fecha_servicio_inicio"];
			var formattedDate = new Date(date3); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){
				
			}
			else{
				$("#mascarafechainism").val(respuesta["fecha_servicio_inicio"]);
				$("#editarfecha_inism").val(respuesta["fecha_servicio_inicio"]);
			}
			

			var date4 = respuesta["fecha_servicio_fin"];
			var formattedDate = new Date(date4); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){
				
			}
			else{
				$("#mascarafechafinsm").val(respuesta["fecha_servicio_fin"]);
				$("#editarfecha_finsm").val(respuesta["fecha_servicio_fin"]);
			}
			

			$("#editarLugarServicioMilitar").val(respuesta["lugar_servicio"]);
			$("#editarGradoMilitar").val(respuesta["grado_militar"]);
			$("#editarMotivoBaja").val(respuesta["motivo_baja"]);

			$("#editarExPNC").val(respuesta["ex_pnc"]);
			$("#editarExPNC").html(respuesta["ex_pnc"]);

			if(respuesta["imagen_diploma_ansp"] != ""){
				$(".previsualizarEditarANSP").attr("src", respuesta["imagen_diploma_ansp"]);
			}else{
				$(".previsualizarEditarANSP").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualANSP").val(respuesta["imagen_diploma_ansp"]);


			$("#editarCursoANSP").val(respuesta["curso_ansp"]);
			$("#editarCursoANSP").html(respuesta["curso_ansp"]);

			$("#editarTrabajoAnterior").val(respuesta["trabajo_anterior"]);
			$("#editarSueldoDevengo").val(respuesta["sueldo_que_devengo"]);
			$("#editarTrabajoActual").val(respuesta["trabajo_actual"]);
			$("#editarSueldoDevenga").val(respuesta["sueldo_que_devenga"]);

			$("#editarSuspendidoAnterior").val(respuesta["suspendido_trabajo_anterior"]);
			$("#editarSuspendidoAnterior").html(respuesta["suspendido_trabajo_anterior"]);

			$("#editarEmpresaSuspendio").val(respuesta["empresa_suspendio"]);
			$("#editarMotivoSuspension").val(respuesta["motivo_suspension"]);

			var date5 = respuesta["fecha_suspension"];
			var formattedDate = new Date(date5); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){
				
			}
			else{
				$("#mascarafechasusp").val(respuesta["fecha_suspension"]);
				$("#editarfecha_susp").val(respuesta["fecha_suspension"]);
			}
		



			$("#editarExperienciaLaboral").val(respuesta["experiencia_laboral"]);
			$("#editarRazonIse").val(respuesta["razon_trabajar_en_ise"]);
			$("#editarPersonasDependientes").val(respuesta["numero_personas_dependientes"]);
			$("#editarObservaciones").val(respuesta["observaciones"]);
			$("#editarNumTelTrabajoAnterior").val(respuesta["telefono_trabajo_anterior"]);
			$("#editarTrabajoActual").val(respuesta["telefono_trabajo_actual"]);
			$("#editarNomRefTrabajoAnterior").val(respuesta["referencia_anterior"]);
			$("#editarEvaluacionAnterior").val(respuesta["evaluacion_anterior"]);
			$("#editarNomRefTrabajoActual").val(respuesta["referencia_actual"]);
			$("#editarEvaluacionActual").val(respuesta["evaluacion_actual"]);

			$("#editarInfoVerificada").val(respuesta["info_verificada"]);
			$("#editarInfoVerificada").html(respuesta["info_verificada"]);

			if(respuesta["imagen_solicitud"] != ""){
				$(".previsualizarEditarSOLICITUD").attr("src", respuesta["imagen_solicitud"]);
			}else{
				$(".previsualizarEditarSOLICITUD").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualSOLICITUD").val(respuesta["imagen_solicitud"]);

			if(respuesta["imagen_partida_nacimiento"] != ""){
				$(".previsualizarEditarPARTIDA").attr("src", respuesta["imagen_partida_nacimiento"]);
			}else{
				$(".previsualizarEditarPARTIDA").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualPARTIDA").val(respuesta["imagen_partida_nacimiento"]);

			if(respuesta["imagen_antecedentes_penales"] != ""){
				$(".previsualizarEditarANTECEDENTES").attr("src", respuesta["imagen_antecedentes_penales"]);
			}else{
				$(".previsualizarEditarANTECEDENTES").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualANTECEDENTES").val(respuesta["imagen_antecedentes_penales"]);

			var date6 = respuesta["fecha_vencimiento_antecedentes_penales"];
			var formattedDate = new Date(date6); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){
				
			}
			else{
				$("#mascarafechavenceAP").val(respuesta["fecha_vencimiento_antecedentes_penales"]);
				$("#editarfecha_venceAP").val(respuesta["fecha_vencimiento_antecedentes_penales"]);
			}
			

			if(respuesta["imagen_solvencia_pnc"] != ""){
				$(".previsualizarEditarSOLVENCIAPNC").attr("src", respuesta["imagen_solvencia_pnc"]);
			}else{
				$(".previsualizarEditarSOLVENCIAPNC").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualSOLVENCIAPNC").val(respuesta["imagen_solvencia_pnc"]);

			var date7 = respuesta["fecha_vencimiento_solvencia_pnc"];
			var formattedDate = new Date(date7); 
			var d = formattedDate.getDate()+1; 
			var m = formattedDate.getMonth(); m += 1;
			m += 1; // javascript months are 0-11 
			var y = formattedDate.getFullYear();
			if(isNaN(d)){
				
			}
			else{
				$("#mascarafechavenceSPNC").val(respuesta["fecha_vencimiento_solvencia_pnc"]);
				$("#editarfecha_venceSPNC").val(respuesta["fecha_vencimiento_solvencia_pnc"]);
			}
			

			if(respuesta["imagen_constancia_psicologica"] != ""){
				$(".previsualizarEditarPSYCO").attr("src", respuesta["imagen_constancia_psicologica"]);
			}else{
				$(".previsualizarEditarPSYCO").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualPSYCO").val(respuesta["imagen_constancia_psicologica"]);



			if(respuesta["imagen_examen_poligrafico"] != ""){
				$(".previsualizarEditarPOLI").attr("src", respuesta["imagen_examen_poligrafico"]);
			}else{
				$(".previsualizarEditarPOLI").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualPOLI").val(respuesta["imagen_examen_poligrafico"]);

			if(respuesta["imagen_huellas"] != ""){
				$(".previsualizarEditarHUELLAS").attr("src", respuesta["imagen_huellas"]);
			}else{
				$(".previsualizarEditarHUELLAS").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}
            $("#fotoActualHUELLAS").val(respuesta["imagen_huellas"]);




			$("#editarConfiable").val(respuesta["confiable"]);
			$("#editarConfiable").html(respuesta["confiable"]);




			//FOTO ACTUAL DEL DOCUMENTO DE IDENTIDAD
			if(respuesta["imagen_documento_identidad"] != ""){

				$(".previsualizarEditarDoc").attr("src", respuesta["imagen_documento_identidad"]);

			}else{

				$(".previsualizarEditarDoc").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}
			$("#fotoActualDoc").val(respuesta["imagen_documento_identidad"]);


            //REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
            if(respuesta["estado"] == 1 ){
                $("#editarEstado").html("Solicitud");
            }
            else if(respuesta["estado"] == 2 ){
                $("#editarEstado").html("Contratado");
            }
            else if(respuesta["estado"] == 3 ){
                $("#editarEstado").html("Inactivo");
            }
            else if(respuesta["estado"] == 4 ){
                $("#editarEstado").html("Incapacitado");
            }
            else{
                $("#editarEstado").html("Error");
            }           
			$("#editarEstado").val(respuesta["estado"]);
			

			//BUSCAR EL NOMBRE DEL CARGO SEGUN EL CODIGO QUE TENEMOS			
			var datosCARGO = new FormData();
			datosCARGO.append("nivel", respuesta["nivel_cargo"]);
			$.ajax({
				url:"ajax/cargos.ajax.php",
				method: "POST",
				data: datosCARGO,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuestaCARGO){					
					$("#editarCARGO").html(respuestaCARGO[1]);
					$("#editarCARGO").val(respuestaCARGO[2]);								 
				}
			})

			

		}

	});

})


/*=============================================
CAMBIO DE DEPARTAMENTO POBLAR MUNICIPIO
=============================================*/
function poblarMuni(){
	iddepartamento = document.getElementById("nuevoDepartamento").value;
	/* LLENAR MUNICIPIO */
	var datos = new FormData();
	datos.append("idmunicipios", iddepartamento);
	$.ajax({
		url:"ajax/municipio3.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$('#nuevoMunicipio').empty();			
			myArray = respuesta.split(";");
			var arrayLength = myArray.length;
			for (var i = 0; i < arrayLength; i++) {
				idName = myArray[i].split(",");
				//alert(idName[1]);
				$('#nuevoMunicipio').append($('<option>', { 
					value: idName[0],
					text : idName[1]
				}));
				
			}
		}
	});
}


/*=============================================
CAMBIO DE DEPARTAMENTO POBLAR MUNICIPIO EDITAR
=============================================*/
function poblarMuniEditar(){
	iddepartamento = document.getElementById("editarDepartamento").value;
	/* LLENAR MUNICIPIO */
	//alert(iddepartamento);
	var datosm = new FormData();
	datosm.append("idmunicipios", iddepartamento);
	$.ajax({
		url:"ajax/municipio3.ajax.php",
		method: "POST",
		data: datosm,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuestam){
			
			$('#editarMunicipio').empty();			
			myArray = respuestam.split(";");
			var arrayLength = myArray.length;
			for (var i = 0; i < arrayLength; i++) {
				idName = myArray[i].split(",");
				
				$('#editarMunicipio').append($('<option>', { 
					value: idName[0],
					text : idName[1]
				}));
				
			}
		}
	});
}





/*=============================================
REVISAR SI EL EMPLEADO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNumeroDocumento").change(function(){

	$(".alert").remove();

	var empleado = $(this).val();

	var datos = new FormData();
	datos.append("validarEmpleado", empleado);

	 $.ajax({
	    url:"ajax/empleados.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNumeroDocumento").parent().after('<div class="alert alert-warning">Este Empleado ya existe en la base de datos</div>');

	    		$("#nuevoNumeroDocumento").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR EMPLEADO
=============================================*/
$(".tablas").on("click", ".btnEliminarEmpleado", function(){

  var idEmpleado = $(this).attr("idEmpleado");
  var fotoEmpleado = $(this).attr("fotoEmpleado");
  var empleado = $(this).attr("empleado");

  swal({
    title: '¿Está seguro de borrar el empleado?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar empleado!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=empleados&idEmpleado="+idEmpleado+"&empleado="+empleado+"&fotoEmpleado="+fotoEmpleado;

    }

  })

})


/*=============================================
IMPRIMIR CCF
=============================================*/

$(".tablas").on("click", ".btnImprimirImagenes", function(){

	var documentoEmpleado = $(this).attr("empleado");

//alert(documentoEmpleado);
	var form = $('<form action="imprimirimagenes" method="post">' +
	  '<input type="text" name="numDoc" value="' + documentoEmpleado + '" />' +
	  '</form>');
	$('body').append(form);
	form.submit();

	//var codigoVenta = $(this).attr("codigoVenta");

	//window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");

})


$( ".fotoaImprimir" ).click(function() {	
	var direccionFotoImprimir= $(this).attr("fotoaImprimir");
	//alert(direccionFotoImprimir);
	$(".previsualizarImagenaImprimir").attr("src", direccionFotoImprimir);

});