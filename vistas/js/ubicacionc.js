/* COLOCACION DE ICONOS */
$(document).ready(function(){


	
	$(".nuevoubicacionlabel_valor_hora_extra").text("Ingresar Valor Hora");
	$(".ubicacioninput_valor_hora_extra").attr("placeholder","Ingresar Valor Hora");
	$(".ubicacioninput_valor_hora_extra").attr("oninput","validateNumber(this);");
	$(".ubicacioninput_valor_hora_extra").removeAttr("required","required");
	$(".eubicacioncgrupo_valor_hora_extra ").attr("style","visibility:hidden");
	$(".ubicacioncgrupo_valor_hora_extra ").attr("style","visibility:hidden");
	 

	/* ****************reaccion */
	$(".nuevoubicacionlabel_reaccion_ubicacion").text("Ingresar Reacción");/* label */
	$(".nuevoubicacionlabel_reaccion_ubicacion").attr("style","margin-top:40px");/* label */
	$(".ubicacioninput_reaccion_ubicacion").attr("placeholder","Ingresar Reaccion");/* input */
	$(".icono_reaccion_ubicacion").addClass("fa fa-user");/* icono */


	/* *****************telefono */
	$(".nuevoubicacionlabel_tele_reac_ubicacion").text("Ingresar Teléfono");/* label */
	$(".ubicacioninput_tele_reac_ubicacion").attr("placeholder","Ingresar Teléfono");/* input */
	$(".icono_tele_reac_ubicacion").addClass("fa fa-phone");/* icono */


	var anterior_aumentar=$("#anterior_aumentar").val();
	var actual_hombre=$("#actual_hombre").val();
	var hombres_autorizados=$("#hombres_autorizados").val();
	var numerohombresautorizados=$("#numerohombresautorizados").val();
	if(anterior_aumentar==""){
		$("#anterior_aumentar").val(hombres_autorizados);
	}
	if(actual_hombre==""){
		$("#actual_hombre").val(hombres_autorizados);

	}
	if(numerohombresautorizados==0){
		$("#numerohombresautorizados").val(hombres_autorizados);
	}

	$(".nuevoubicacioninput_hombres_autorizados").removeAttr("required");
	$(".ubicacioncgrupo_hombres_autorizados").attr("style","visibility:hidden; height:0;");

	$(".nuevoubicacioninput_zona").removeAttr("required");
	$(".ubicacioncgrupo_zona").attr("style","visibility:hidden; height:0;");

	


	$( ".numerohombres" ).blur(function() {
		var valor = $(this).val();
		var preciohombre = $(".preciohombre").val();
		var suma= parseFloat(valor)*parseFloat(preciohombre);
		$(".valorhombre").val(suma);

	  });

	  $( ".preciohombre" ).blur(function() {
		var valor = $(this).val();
		var preciohombre = $(".numerohombres").val();
		var suma= parseFloat(valor)*parseFloat(preciohombre);
		$(".valorhombre").val(suma);

		
	  });

	  /* ************** */
	  $( ".enumerohombres" ).blur(function() {
		var valor = $(this).val();
		var preciohombre = $(".epreciohombre").val();
		var suma= parseFloat(valor)*parseFloat(preciohombre);
		$(".evalorhombre").val(suma);

		var actualhombre= $("#numerodehombresactual").val();
		var numerodehombres= $("#numerodehombres").val();
		var sumarhombres=parseFloat(valor)+parseFloat(numerodehombres);
		



	  });

	  $( ".epreciohombre" ).blur(function() {
		var valor = $(this).val();
		var preciohombre = $(".enumerohombres").val();
		var suma= parseFloat(valor)*parseFloat(preciohombre);
		$(".evalorhombre").val(suma);

	
		
	  });




	var v24hrcache = $("#v24hrcache").val();
	var v12hdecache = $("#v12hdecache").val();
	var v12hd6cache = $("#v12hd6cache").val();
	var v12hn6cache = $("#v12hn6cache").val();
	var v12hd7cache = $("#v12hd7cache").val();
	var v12hn7cache = $("#v12hn7cache").val();
	var vextraordinariocache = $("#vextraordinariocache").val();
	var vseptimocache = $("#vseptimocache").val();
	var vturnos_comodincache = $("#vturnos_comodincache").val();
	var vnotascache = $("#vnotascache").val();
	var vidubicacioncache = $("#vidubicacioncache").val();

	/* ********** */
	if(v24hrcache==""){
		$("#nuevo24hr").val("0");
	}else{
		$("#nuevo24hr").val(v24hrcache);
	}
	
	/* ********** */
	if(v12hdecache==""){
		$("#nuevo12hde").val("0");
	}else{
		$("#nuevo12hde").val(v12hdecache);
	}
		/* ********** */
	if(v12hd6cache==""){
		$("#nuevo12hd6").val("0");
	}else{
		$("#nuevo12hd6").val(v12hd6cache);
	}
		/* ********** */
	if(v12hn6cache==""){
		$("#nuevo12hn6").val("0");
	}else{
		$("#nuevo12hn6").val(v12hn6cache);
	}
		/* ********** */
	if(v12hd7cache==""){
		$("#nuevo12hd7").val("0");
	}else{
		$("#nuevo12hd7").val(v12hd7cache);
	}
		/* ********** */
	if(v12hn7cache==""){
		$("#nuevo12hn7").val("0");
	}else{
		$("#nuevo12hn7").val(v12hn7cache);
	}
		/* ********** */
	if(vextraordinariocache==""){
		$("#nuevoextraordinario").val("0");
	}else{
		$("#nuevoextraordinario").val(vextraordinariocache);
	}
		/* ********** */
	if(vseptimocache==""){
		$("#nuevoseptimo").val("0");
	}else{
		$("#nuevoseptimo").val(vseptimocache);
	}
		/* ********** */
	if(vturnos_comodincache==""){
		$("#nuevoturnos_comodin").val("0");
	}else{
		$("#nuevoturnos_comodin").val(vturnos_comodincache);
	}
		/* ********** */
	if(vnotascache==""){
		$("#nuevonotas").val("0");
	}else{
		$("#nuevonotas").val(vnotascache);
	}
		/* ********** */

		

	var date = new Date();
    var fecha =  ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) +'-' +((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + date.getFullYear();
	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

	$("#fecha_aumentar").val(fecha);
	$("#hora_aumentar").val(time);

	$( "#aumentar_hombres" ).blur(function() {
		var valor = $(this).val();
		var valoranterior=$("#anterior_aumentar").val();
		if(valoranterior==""){
			valoranterior=0;
		}
		var calcular= parseFloat(valoranterior)+parseFloat(valor);
		$("#actual_hombre").val(calcular);
	  });

	  $( "#disminuye_hombres" ).blur(function() {
		var valor = $(this).val();
		var valoranterior=$("#anterior_aumentar").val();
		if(valoranterior==""){
			valoranterior=0;
		}
		var calcular= valoranterior-valor;
		$("#actual_hombre").val(calcular);
	  });

/* ************* */

$(".irpanel1").click(function () {    
	$(".panel1").attr("style","display:block");
	$(".panel2").attr("style","display:none");
});
$(".irpanel2").click(function () {  

	$(".panel1").attr("style","display:none");
	$(".panel2").attr("style","display:block");
});

/* ********************** */
$(".guardar_aumento").click(function () {    

	$("#nuevoturnos_comodin").val("0");
	var valornumerohombres= $("#actual_hombre").val();
	$("#numerohombresautorizados").val(valornumerohombres);

	if($("#anterior_aumentar").val()==""){
		$("#anterior_aumentar").val($("#aumentar_hombres").val());
	}
	else{
		$("#anterior_aumentar").val($("#actual_hombre").val());

	}
	var fecha_aumentar = $("#fecha_aumentar").val();
	var hora_aumentar = $("#hora_aumentar").val();
	var anterior_aumentar = $("#anterior_aumentar").val();
	var aumentar_hombres = $("#aumentar_hombres").val();
	var disminuye_hombres = $("#disminuye_hombres").val();
	var actual_hombre = $("#actual_hombre").val();
	var idubicacion_aumento = $("#idubicacion_aumento").val();
	var cuanta_registro = $("#cuanta_registro").val();
	var idubicacion_turno=$("#idubicacion_turno").val();

	/*  ******** */
	var parametros = {
	   "fecha_aumentar" : fecha_aumentar,
	   "hora_aumentar" : hora_aumentar,
	   "anterior_aumentar" : anterior_aumentar,
	   "aumentar_hombres" : aumentar_hombres,
	   "disminuye_hombres" : disminuye_hombres,
	   "actual_hombre" : actual_hombre,
	   "idubicacion_aumento" : idubicacion_aumento,
	   "cuanta_registro" : cuanta_registro,

   };
   $.ajax({
		   data:  parametros,
		   url:"ajax/aumentohombres.ajax.php",
		   type:  'post',
		   success:  function (response) {
			
			if(response="Si"){
				

				swal({
					type: "success",
					title: "Guardado Correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result) {
							  if (result.value) {

								/* $(".panel1").attr("style","display:none");
								$(".panel2").attr("style","display:block");
								$(".panel3").attr("style","display:none"); */
								window.location.href ="turnos?id="+idubicacion_turno;
							  }
						  })


			

			}
			else{

				swal({
					type: "warning",
					title: "ERROR. No se a Guardado",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result) {
							  if (result.value) {

								$(".panel1").attr("style","display:block");
								$(".panel2").attr("style","display:none");
								$(".panel3").attr("style","display:none");

							  }
						  })

			
			}
		   }
   });
   /* ********* */
})
/* ************* */

/* *****************TURNOS***** */
$(".guardar_turnos").click(function () {    

	var valornumerohombres= $("#numerohombresautorizados").val();
	


	var nuevo24hr = $("#nuevo24hr").val();
	var nuevo12hde = $("#nuevo12hde").val();
	var nuevo12hd6 = $("#nuevo12hd6").val();
	var nuevo12hn6 = $("#nuevo12hn6").val();
	var nuevo12hd7 = $("#nuevo12hd7").val();
	var nuevo12hn7 = $("#nuevo12hn7").val();
	var nuevoextraordinario = $("#nuevoextraordinario").val();
	var nuevoseptimo = $("#nuevoseptimo").val();
	var nuevoturnos_comodin = $("#nuevoturnos_comodin").val();
	var nuevonotas = $("#nuevonotas").val();
	var idubicacion_turno = $("#idubicacion_turno").val();
	var id = $("#idcache").val();

	
	if(nuevoturnos_comodin < valornumerohombres){

		swal({
			type: "warning",
			title: "El numero de comodin debe de ser igual al Numero de Hombres Autorizados",
			showConfirmButton: true,
			confirmButtonText: "Cerrar",
			closeOnConfirm: false
			}).then(function(result) {
					  if (result.value) {

						

					  }
				  })


	
	}
	else{

				/*  ******** */
				var parametros = {
				"nuevo24hr" : nuevo24hr,
				"nuevo12hde" : nuevo12hde,
				"nuevo12hd6" : nuevo12hd6,
				"nuevo12hn6" : nuevo12hn6,
				"nuevo12hd7" : nuevo12hd7,
				"nuevo12hn7" : nuevo12hn7,
				"nuevoextraordinario" : nuevoextraordinario,
				"nuevoseptimo" : nuevoseptimo,
				"nuevoturnos_comodin" : nuevoturnos_comodin,
				"nuevonotas" : nuevonotas,
				"idubicacion_turno" : idubicacion_turno,
				"id" : id,

			};
			$.ajax({
					data:  parametros,
					url:"ajax/administrarturnos.ajax.php",
					type:  'post',
					success:  function (response) {
						if(response="Si"){

							swal({
								type: "success",
								title: "Guardado Correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result) {
										  if (result.value) {
			
											window.location.href ="detalleubicacion?id="+idubicacion_turno;

			
										  }
									  })

									  

						

						}
						else{

							swal({
								type: "warning",
								title: "ERROR. No se a Guardado",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then(function(result) {
										  if (result.value) {
			
											$(".panel1").attr("style","display:none");
											$(".panel2").attr("style","display:block");
											$(".panel3").attr("style","display:none");
			
										  }
									  })

									  

							
							
						}
					}
			});
			/* ********* */
	}
})
/* ************* */

$('#patrulla').on('change', function() {
	var valor = $(this).val();

	 /*  ******** */
	 var parametros = {
		"valor" : valor
	};
	$.ajax({
			data:  parametros,
			url:"ajax/cargarcoordinador.ajax.php",
			type:  'post',
			success:  function (response) {
				$("#coordinador_selecion").empty();
				$("#coordinador_selecion").append(response);
			
			}
	});
	/* ********* */
  });



	$('#coordinadoractual').on('change', function() {
		var valor = $(this).val();

		 /*  ******** */
		 var parametros = {
			"valor" : valor
		};
		$.ajax({
				data:  parametros,
				url:"ajax/cargarubicacion.ajax.php",
				type:  'post',
				success:  function (response) {
					$("#ubicaciones").empty();
					$("#ubicaciones").append(response);
				
				}
		});
		/* ********* */
	  });
/* ********************** */
$(".guardarasignacion").click(function () {    

	var idpatrulla = $("#patrulla").val();
	var idubiacion = $("#idubicaciones_coordinador").val();
	var idcoordinador = $("#coordinador_selecion").val();



	/*  ******** */
	var parametros = {
	   "idpatrulla" : idpatrulla,
	   "idubiacion" : idubiacion,
	   "idcoordinador" : idcoordinador
   };
   $.ajax({
		   data:  parametros,
		   url:"ajax/asignarcoordinador.ajax.php",
		   type:  'post',
		   success:  function (response) {
			
			swal({

				type: "success",
				title: "Asignado con Exito",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){

				if(result.value){
				
					window.location="ubicacionc";
				}

			});
		
		   }
   });
   /* ********* */
})


$(".guardarcoordinador").click(function () {    

	var coordinadoractual = $("#coordinadoractual").val();
	var ubicacion = $("#ubicaciones").val();
	var coordinadornuevo = $("#coordinadornuevo").val();



	/*  ******** */
	var parametros = {
	   "coordinadoractual" : coordinadoractual,
	   "ubicacion" : ubicacion,
	   "coordinadornuevo" : coordinadornuevo
   };
   $.ajax({
		   data:  parametros,
		   url:"ajax/cambiarcoordinador.ajax.php",
		   type:  'post',
		   success:  function (response) {
			 location.reload();
		   }
   });
   /* ********* */
})
/* *********************** */
	$(".ubicacioncgrupo_turno_eventual").empty();
	$(".ubicacioncgrupo_criterio_ubicacionc").empty();
	$(".ubicacioncgrupo_calcula_comodin_ubicacionc").empty();
	$(".ubicacioncgrupo_comodin_unidad_ubicacionc").empty();
	$(".ubicacioncgrupo_comodin_base_ubicacionc").empty();
	$(".ubicacioncgrupo_reporte_equipo_ubicacionc").empty();

	
	$(".eubicacioncgrupo_turno_eventual").empty();
	$(".eubicacioncgrupo_criterio_ubicacionc").empty();
	$(".eubicacioncgrupo_calcula_comodin_ubicacionc").empty();
	$(".eubicacioncgrupo_comodin_unidad_ubicacionc").empty();
	$(".eubicacioncgrupo_comodin_base_ubicacionc").empty();
	$(".eubicacioncgrupo_reporte_equipo_ubicacionc").empty();


	var  texto= "Ingresar";

	$(".ubicacioninput_id").removeAttr("required");

	$(".nuevoubicacioninput_estado_cliente_ubicacion").attr("type","hidden");
	$(".nuevoubicacioninput_estado_cliente_ubicacion").val("Activo");
	$("#editarestado_cliente_ubicacion").val("Activo");
	$("#editarestado_cliente_ubicacion").attr("type","hidden");
	$(".ubicacioncgrupo_estado_cliente_ubicacion").attr("style","height:0");
	$(".eubicacioncgrupo_estado_cliente_ubicacion").attr("style","height:0");





	
	$(".modificarbono").click(function () {    

		var bono = $("#editarbono_unidad").val();
		var codigo = $("#editarcodigo_ubicacion").val();
		var usuario = $("#nombreuduario").val();
		var id = $("#editarid").val();
		 /*  ******** */
		 var parametros = {
			"bono" : bono,
			"codigo" : codigo,
			"usuario" : usuario,
			"id" : id
		};
		$.ajax({
				data:  parametros,
				url:"ajax/modificacionbono.ajax.php",
				type:  'post',
				success:  function (response) {
				
				}
		});
		/* ********* */


		});



	/* $(".eubicacioncgrupo_id_cliente").css("visibility","hidden"); */

	$(".ubicacioninput_codigo_cliente").attr("readonly","readonly");
	$(".ubicacioninput_fecha_inicio").attr("readonly","readonly");
	$(".ubicacioninput_fecha_fin").attr("readonly","readonly");
	$(".ubicacioninput_fecha_ultimo_inventario").attr("readonly","readonly");

	/* if($(".ubicacioninput_email_contacto").val().indexOf('@', 0) == -1 || $(".ubicacioninput_email_contacto").val().indexOf('.', 0) == -1) {
		alert('El correo electrónico introducido no es correcto.');
		return false;
	} */
	modificacioninicial();


	


	/* ******** */
	$("#tipodocumento_ubicacion").attr("style","visibility:hidden; height:0;");
	$("#nuevotipo_documento").removeAttr("required");
	$("#editartipodocumento_ubicacion").attr("style","visibility:hidden; height:0;");
	$("#editartipo_documento").removeAttr("required");
	/* ********** */

		/* ******** */
		$("#formpago_ubicacion").attr("style","visibility:hidden; height:0;");
		$("#nuevoforma_pago").removeAttr("required");
		$("#editar_formpago_ubicacion").attr("style","visibility:hidden; height:0;");
		$("#editarforma_pago").removeAttr("required");
		/* ********** */

/* ******** */
$("#nosuma_ubicacion").attr("style","visibility:hidden; height:0;");
$("#nuevosumahs").removeAttr("required");
$("#editar_nosuma_ubicacion").attr("style","visibility:hidden; height:0;");
$("#editarsumahs").removeAttr("required");
/* ********** */


/* ******** */
$("#concepto_ubicacion").attr("style","visibility:hidden; height:0;");
$("#editar_concepto_ubicacion").attr("style","visibility:hidden; height:0;");
/* ********** */

	/* ******** */
	$("#tipodocumento_ubicacion").attr("style","visibility:hidden;  height:0;");
	$("#nuevotipo_documento").removeAttr("required");
	$("#editartipodocumento_ubicacion").attr("style","visibility:hidden;  height:0;");
	$("#editartipo_documento").removeAttr("required");
	/* ********** */


	
	$(".icono_codigo_cliente").addClass("fa fa-qrcode");
   $(".ubicacioninput_codigo_cliente").attr("placeholder", texto+" Código Cliente");

   $(".icono_id_coordinador_zona").addClass("fa  fa-user-circle-o   ");
   $(".ubicacioninput_id_coordinador_zona").attr("placeholder", texto+" ID Coordinador Zona");

   $(".icono_nombre_ubicacion").addClass("fa fa-map-marker");
   $(".ubicacioninput_nombre_ubicacion").attr("placeholder", texto+" Nombre Ubicacion");

   $(".icono_latitude").addClass("fa fa-map");
   $(".ubicacioninput_latitude").attr("placeholder", texto+" Latitud ");

   $(".icono_longitude").addClass("fa fa-map-o");
   $(".ubicacioninput_longitude").attr("placeholder", texto+" Longitud");

   $(".icono_direccion").addClass("fa fa-map-marker");
   $(".ubicacioninput_direccion").attr("placeholder", texto+" Dirección");

   $(".icono_persona_contacto").addClass("fa fa-male");
   $(".ubicacioninput_persona_contacto").attr("placeholder", texto+" Persona Contacto");

   $(".icono_telefono_contacto").addClass("fa fa-mobile");
   $(".ubicacioninput_telefono_contacto").attr("placeholder", texto+" Teléfono Contacto");

   $(".icono_email_contacto").addClass("fa fa-envelope");
   $(".ubicacioninput_email_contacto").attr("placeholder", texto+" Email");

   $(".icono_cantidad_armas").addClass("fa fa-list-ol");
   $(".ubicacioninput_cantidad_armas").attr("placeholder", texto+" Cantidad de Armas");

   $(".icono_cantidad_radios").addClass("fa fa-list-ol");
   $(".ubicacioninput_cantidad_radios").attr("placeholder", texto+" Cantidad de Radios");

   $(".icono_cantidad_celulares").addClass("fa fa-list-ol");
   $(".ubicacioninput_cantidad_celulares").attr("placeholder", texto+" Cantidad de Celulares");

   $(".icono_bonos").addClass("fa fa-money");
   $(".ubicacioninput_bonos").attr("placeholder", texto+" Bonos");

   $(".icono_visitas").addClass("fa fa-plane");
   $(".ubicacioninput_visitas").attr("placeholder", texto+" Visitas");

   $(".icono_zona").addClass("fa fa-map-marker");
   $(".ubicacioninput_zona").attr("placeholder", texto+" Zona");

   $(".icono_rubro").addClass("fa fa-bars");
   $(".ubicacioninput_rubro").attr("placeholder", texto+" Rubro");

   $(".icono_fecha_inicio").addClass("fa fa-calendar");
   $(".ubicacioninput_fecha_inicio").attr("placeholder", texto+" Fecha de Inicio");

   $(".icono_fecha_fin").addClass("fa fa-calendar");
   $(".ubicacioninput_fecha_fin").attr("placeholder", texto+" Fecha de Fin");

   $(".icono_horas_permitidas").addClass("fa fa-clock-o");
   $(".ubicacioninput_horas_permitidas").attr("placeholder", texto+" Horas Permitidas");

   $(".icono_observaciones_generales").addClass("fa fa-eye");
   $(".ubicacioninput_observaciones_generales").attr("placeholder", texto+" Observaciones");

   $(".icono_fecha_ultimo_inventario").addClass("fa fa-calendar");
   $(".ubicacioninput_fecha_ultimo_inventario").attr("placeholder", texto+" Fecha de Ultimo Inventario");

   $(".icono_hombres_autorizados").addClass("fa fa-male");
   $(".ubicacioninput_hombres_autorizados").attr("placeholder", texto+" Hombres Autorizados");
	
   

              /* *********LABEL*********** */
			  var nuevoubicacioninput_codigo_cliente = $(".nuevoubicacioninput_codigo_cliente").attr("placeholder");
			  $(".nuevoubicacionlabel_codigo_cliente").text(nuevoubicacioninput_codigo_cliente);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_id_coordinador_zona = $(".nuevoubicacioninput_id_coordinador_zona").attr("placeholder");
			  $(".nuevoubicacionlabel_id_coordinador_zona").text(nuevoubicacioninput_id_coordinador_zona);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_nombre_ubicacion = $(".nuevoubicacioninput_nombre_ubicacion").attr("placeholder");
			  $(".nuevoubicacionlabel_nombre_ubicacion").text(nuevoubicacioninput_nombre_ubicacion);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_latitude = $(".nuevoubicacioninput_latitude").attr("placeholder");
			  $(".nuevoubicacionlabel_latitude").text(nuevoubicacioninput_latitude);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_longitude = $(".nuevoubicacioninput_longitude").attr("placeholder");
			  $(".nuevoubicacionlabel_longitude").text(nuevoubicacioninput_longitude);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_direccion = $(".nuevoubicacioninput_direccion").attr("placeholder");
			  $(".nuevoubicacionlabel_direccion").text(nuevoubicacioninput_direccion);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_persona_contacto = $(".nuevoubicacioninput_persona_contacto").attr("placeholder");
			  $(".nuevoubicacionlabel_persona_contacto").text(nuevoubicacioninput_persona_contacto);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_telefono_contacto = $(".nuevoubicacioninput_telefono_contacto").attr("placeholder");
			  $(".nuevoubicacionlabel_telefono_contacto").text(nuevoubicacioninput_telefono_contacto);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_email_contacto = $(".nuevoubicacioninput_email_contacto").attr("placeholder");
			  $(".nuevoubicacionlabel_email_contacto").text(nuevoubicacioninput_email_contacto);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_cantidad_armas = $(".nuevoubicacioninput_cantidad_armas").attr("placeholder");
			  $(".nuevoubicacionlabel_cantidad_armas").text(nuevoubicacioninput_cantidad_armas);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_cantidad_radios = $(".nuevoubicacioninput_cantidad_radios").attr("placeholder");
			  $(".nuevoubicacionlabel_cantidad_radios").text(nuevoubicacioninput_cantidad_radios);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_cantidad_celulares = $(".nuevoubicacioninput_cantidad_celulares").attr("placeholder");
			  $(".nuevoubicacionlabel_cantidad_celulares").text(nuevoubicacioninput_cantidad_celulares);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_bonos = $(".nuevoubicacioninput_bonos").attr("placeholder");
			  $(".nuevoubicacionlabel_bonos").text(nuevoubicacioninput_bonos);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_visitas = $(".nuevoubicacioninput_visitas").attr("placeholder");
			  $(".nuevoubicacionlabel_visitas").text(nuevoubicacioninput_visitas);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_zona = $(".nuevoubicacioninput_zona").attr("placeholder");
			  $(".nuevoubicacionlabel_zona").text(nuevoubicacioninput_zona);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_fecha_inicio = $(".nuevoubicacioninput_fecha_inicio").attr("placeholder");
			  $(".nuevoubicacionlabel_fecha_inicio").text(nuevoubicacioninput_fecha_inicio);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_fecha_fin = $(".nuevoubicacioninput_fecha_fin").attr("placeholder");
			  $(".nuevoubicacionlabel_fecha_fin").text(nuevoubicacioninput_fecha_fin);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_horas_permitidas = $(".nuevoubicacioninput_horas_permitidas").attr("placeholder");
			  $(".nuevoubicacionlabel_horas_permitidas").text(nuevoubicacioninput_horas_permitidas);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_observaciones_generales = $(".nuevoubicacioninput_observaciones_generales").attr("placeholder");
			  $(".nuevoubicacionlabel_observaciones_generales").text(nuevoubicacioninput_observaciones_generales);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_fecha_ultimo_inventario = $(".nuevoubicacioninput_fecha_ultimo_inventario").attr("placeholder");
			  $(".nuevoubicacionlabel_fecha_ultimo_inventario").text(nuevoubicacioninput_fecha_ultimo_inventario);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_hombres_autorizados = $(".nuevoubicacioninput_hombres_autorizados").attr("placeholder");
			  $(".nuevoubicacionlabel_hombres_autorizados").text(nuevoubicacioninput_hombres_autorizados);

		  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_rubro = $(".nuevoubicacioninput_rubro").attr("placeholder");
			  $(".nuevoubicacionlabel_rubro").text(nuevoubicacioninput_rubro);

			  
          
			  

		  		/* --------------NUEVOS */

				  $(".icono_facturar").addClass("fa fa-male");
				  $(".ubicacioninput_facturar").attr("placeholder", texto+" Facturar a");
				  $(".ubicacioninput_facturar").attr("readonly", "readonly");

				  $(".icono_codigo_ubicacion").addClass("fa fa-list");
				  $(".ubicacioninput_codigo_ubicacion").attr("placeholder", texto+" Codigo Ubicación");
				  $(".ubicacioninput_codigo_ubicacion").attr("readonly", "readonly");
				  
				      /* *********LABEL*********** */
			  var nuevoubicacioninput_codigo_ubicacion = $(".ubicacioninput_codigo_ubicacion").attr("placeholder");
			  $(".nuevoubicacionlabel_codigo_ubicacion").text(nuevoubicacioninput_codigo_ubicacion);

		  



				  $(".ubicacioncgrupo_tipo_documento").empty();
				  $(".ubicacioncgrupo_forma_pago").empty();
				  $(".ubicacioncgrupo_concepto").empty();
				  $(".ubicacioncgrupo_sumahs").empty();

				  $(".eubicacioncgrupo_tipo_documento").empty();
				  $(".eubicacioncgrupo_forma_pago").empty();
				  $(".eubicacioncgrupo_concepto").empty();
				  $(".eubicacioncgrupo_sumahs").empty();

				  $(document).on('change', '#infocliente', function(event) {
					$('.ubicacioninput_facturar').val($("#infocliente option:selected").text());
			  	 });

				   $(document).on('change', '#editarid_cliente', function(event) {
					$('#editarfacturar').val($("#editarid_cliente option:selected").text());
			  	 });
			   
				  
              /* *********LABEL*********** */
			  var nuevoubicacioninput_facturar = $(".nuevoubicacioninput_facturar").attr("placeholder");
			  $(".nuevoubicacionlabel_facturar").text(nuevoubicacioninput_facturar);

			   

			  $(".ubicacioncgrupo_bono_unidad").empty();
			  $( "#sibonounidad" ).click(function() {
				$("#nobonounidad").prop('checked', false); 
				var sibono = $(this).val();
				$("#nuevobono_unidad").val(sibono);
			  });
			  $( "#nobonounidad" ).click(function() {
				$("#sibonounidad").prop('checked', false); 
				var sibono = $(this).val();
				$("#nuevobono_unidad").val(sibono);
			  });


			  
			  $(".ubicacioncgrupo_bono_horas").empty();
			  $( "#sibonohoras" ).click(function() {
				$("#nobonohoras").prop('checked', false); 
				var sibono = $(this).val();
				$("#nuevobono_horas").val(sibono);
			  });
			  $( "#nobonohoras" ).click(function() {
				$("#sibonohoras").prop('checked', false); 
				var sibono = $(this).val();
				$("#nuevobono_horas").val(sibono);
			  });

			  $(".eubicacioncgrupo_bono_unidad").empty();
			  $(".eubicacioncgrupo_bono_horas").empty();
			  $(".ubicacioncgrupo_selefactura").empty();
			  $(".eubicacioncgrupo_selefactura").empty();
			  $(".ubicacioncgrupo_rubro").empty();
			  $(".ubicacioncgrupo_rubro").append($("#snuevorubro"));
			  $(".eubicacioncgrupo_rubro").empty();
			  $(".eubicacioncgrupo_rubro").append($("#esnuevorubro"));
			  $(".ubicacioncgrupo_zonaubicacion").empty();
			  $(".eubicacioncgrupo_zonaubicacion").empty();
/* 			  $(".ubicacioninput_codigo_ubicacion").attr("name"," ");
 */

			  $(".ubicacioncgrupo_facturar").empty();
			  $(".ubicacioncgrupo_facturar").append($(".facturar_cliente"));
			  $(".eubicacioncgrupo_facturar").empty();
			  $(".eubicacioncgrupo_facturar").append($(".efacturar_cliente"));
			  $(".ubicacioninput_telefono_contacto").addClass("telefono");

			  $(".ubicacioncgrupo_id_coordinador_zona").empty();
			  $(".ubicacioncgrupo_id_coordinador_zona").append($(".coordinador"));
			  
			  $(".eubicacioncgrupo_id_coordinador_zona").empty();
			  $(".eubicacioncgrupo_id_coordinador_zona").append($(".ecoordinador"));

 })






 function modificacioninicial(){
	
	$(".ubicacioninput_email_contacto").get(0).type = 'email';
	$(".ubicacioninput_id_coordinador_zona").get(0).type = 'number';
	$(".ubicacioninput_cantidad_armas").get(0).type = 'number';
	$(".ubicacioninput_cantidad_celulares").get(0).type = 'number';
	$(".ubicacioninput_hombres_autorizados").get(0).type = 'number';
	

	$("#editaremail_contacto").get(0).type = 'email';
	$("#editarid_coordinador_zona").get(0).type = 'number';
	$("#editarcantidad_armas").get(0).type = 'number';
	$("#editarcantidad_celulares").get(0).type = 'number';
	$("#editarhombres_autorizados").get(0).type = 'number';
	$(".ubicacioninput_cantidad_radios").get(0).type = 'number';
	$("#editarcantidad_radios").get(0).type = 'number';
	
	$(".ubicacioncgrupo_tienepon").empty();
	$(".eubicacioncgrupo_tienepon").empty();

	$(".ubicacioncgrupo_visitas").empty();
	$(".ubicacioncgrupo_visitas").append($('#svisitas'));
	$(".eubicacioncgrupo_visitas").empty();
	$(".eubicacioncgrupo_visitas").append($('#esvisitas'));


	$(".ubicacioncgrupo_bonos").empty();
	$(".ubicacioncgrupo_bonos").append($('#sbonos'));
	$(".eubicacioncgrupo_bonos").empty();
	$(".eubicacioncgrupo_bonos").append($('#esbonos'));



	$(".ubicacioncgrupo_id_cliente").empty();
	$('.ubicacioncgrupo_id_cliente').append($('.ubicacionc_s_cliente'));

	$(".ubicacioncgrupo_id_departamento").empty();
	$('.ubicacioncgrupo_id_departamento').append($('.ubicacionc_s_depa'));

	$(".ubicacioncgrupo_id_municipio").empty();
	$('.ubicacioncgrupo_id_municipio').append($('.ubicacionc_s_muni'));


	/* editar */
	$(".eubicacioncgrupo_id_cliente").empty();
	$('.eubicacioncgrupo_id_cliente').append($('.eubicacionc_s_cliente'));

	$(".eubicacioncgrupo_id_departamento").empty();
	$('.eubicacioncgrupo_id_departamento').append($('.eubicacionc_s_depa'));

	$(".eubicacioncgrupo_id_municipio").empty();
	$('.eubicacioncgrupo_id_municipio').append($('.eubicacionc_s_muni'));


	
	
	/* QUITAR NAME A INPUT */
	$(".nuevoubicacioninput_fecha_inicio").attr("name","");
	$(".nuevoubicacioninput_fecha_fin").attr("name", "");
	$(".nuevoubicacioninput_fecha_ultimo_inventario").attr("name", "");

	
	/* AÑADIR CALENDARIO INPUT */
	$(".nuevoubicacioninput_fecha_inicio").addClass("calendario");
	$(".nuevoubicacioninput_fecha_fin").addClass("calendario");
	$(".nuevoubicacioninput_fecha_ultimo_inventario").addClass("calendario");

	
	/* QUITAR NAME A INPUT */
	$(".ubicacioninput_fecha_inicio").attr("name","");
	$(".ubicacioninput_fecha_fin").attr("name", "");
	$(".ubicacioninput_fecha_ultimo_inventario").attr("name", "");

	
	/* AÑADIR CALENDARIO INPUT */
	$(".ubicacioninput_fecha_inicio").addClass("calendario");
	$(".ubicacioninput_fecha_fin").addClass("calendario");
	$(".ubicacioninput_fecha_ultimo_inventario").addClass("calendario");
	
	
	/* AÑADIR ATRIBUTO FECHA A INPUT */
	$(".nuevoubicacioninput_fecha_inicio").attr("fecha","nuevofechainicio");
	$(".nuevoubicacioninput_fecha_fin").attr("fecha", "nuevofechafin");
	$(".nuevoubicacioninput_fecha_ultimo_inventario").attr("fecha", "nuevofechaultimo");

	
	/* AÑADIR ATRIBUTO FECHA A INPUT EDITAR */
	$("#editarfecha_inicio").attr("fecha","fechainicio");
	$("#editarfecha_fin").attr("fecha", "fechafin");
	$("#editarfecha_ultimo_inventario").attr("fecha", "fechaultimo");

	
	$(document).on('change', '.ubicacioncid_cliente', function(event) {
	
		cliente=$(".ubicacioncid_cliente option:selected").attr("codigo");
		
		$(".ubicacioninput_codigo_cliente").val(cliente);
	})

	$(document).on('change', '#editarid_cliente', function(event) {
	
		cliente=$("#editarid_cliente option:selected").attr("codigo");
		
		$("#editarcodigo_cliente").val(cliente);
	})
	
	/* LLENAR MUNICIPIO DEPENDE DEL DEPARTAMENTO */

	$(document).on('change', '.opciondepartamento', function(event) {
		/* $('#servicioSelecionado').val($("#servicio option:selected").text()); */
		var iddepartamento = $(".opciondepartamento option:selected").val();

		/* LLENAR MUNICIPIO */
		var datos = new FormData();
		datos.append("idmunicipios", iddepartamento);

		$.ajax({

			url:"ajax/municipio2.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				
				$("#nuevoid_municipio").html(respuesta);
				$("#editarid_municipio").empty();
				$("#editarid_municipio").html(respuesta);
			
				



			}

		});

   });

   
	$(document).on('change', '.eopciondepartamento', function(event) {
		/* $('#servicioSelecionado').val($("#servicio option:selected").text()); */
		var iddepartamento = $(".eopciondepartamento option:selected").val();

		/* LLENAR MUNICIPIO */
		var datos = new FormData();
		datos.append("idmunicipios", iddepartamento);

		$.ajax({

			url:"ajax/municipio2.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				
				$("#nuevoid_municipio").html(respuesta);
				$("#editarid_municipio").empty();
				$("#editarid_municipio").html(respuesta);
			
				



			}

		});

   });


 }

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarubicacionc", function(){


		



	$(".ubicacioninput_zona").removeAttr("required");
	$(".eubicacioncgrupo_zona").attr("style","visibility:hidden; height:0;");

	$("#editarhombres_autorizados").removeAttr("required");
	$(".eubicacioncgrupo_hombres_autorizados").attr("style","visibility:hidden; height:0;");


	$(".ubicacioninput_estado_cliente_ubicacion").removeAttr("required");
	$("#editartipo_documento").removeAttr("required");
	$("#editarforma_pago").removeAttr("required");
	$("#editarzonaubicacion").removeAttr("required");

	
			  /* editar*************** */

			  
			  $( "#esibonounidad" ).click(function() {
				$("#enobonounidad").prop('checked', false); 
				var sibonoe = $(this).val();
				$(".editarbono_unidad").val(sibonoe);
			  });
			  
			  $( "#enobonounidad" ).click(function() {
				$("#esibonounidad").prop('checked', false); 
				var sibonoe = $(this).val();
				$(".editarbono_unidad").val(sibonoe);
			  });

			  $( "#esibonohoras" ).click(function() {
				$("#enobonohoras").prop('checked', false); 
				var sibonoe = $(this).val();
				$(".editarbono_horas").val(sibonoe);
			  });
			  $( "#enobonohoras" ).click(function() {
				$("#esibonohoras").prop('checked', false); 
				var sibonoe = $(this).val();
				$(".editarbono_horas").val(sibonoe);
			  });


		/* modificacioninicial(); */
	var idubicacionc = $(this).attr("idubicacionc");
	
	var datos = new FormData();
	datos.append("idubicacionc", idubicacionc);

	$.ajax({

		url:"ajax/ubicacionc.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){



			$("#editarreaccion_ubicacion").val(respuesta["reaccion_ubicacion"]);
			$("#editartele_reac_ubicacion").val(respuesta["tele_reac_ubicacion"]);

			$(".select2-selection__rendered").text(respuesta["idcliente"]+" - "+respuesta["nombrecliente"])
	/* ********** */
	$("#editarcodigo_ubicacion2").val(respuesta["codigo_ubicacion"]);
	$("#editarcodigo_ubicacion").val(respuesta["codigo_ubicacion"]);


	$("#editarbono_horas").val(respuesta["bono_horas"]);
	$("#editarselefactura").val(respuesta["selefactura"]);
	$("#editarzonaubicacion").val(respuesta["zonaubicacion"]);


	$("#editarturno_eventual").val(respuesta["turno_eventual"]);
	$("#editarcriterio_ubicacionc").val(respuesta["criterio_ubicacionc"]);
	$("#editarcalcula_comodin_ubicacionc").val(respuesta["calcula_comodin_ubicacionc"]);
	$("#editarcomodin_unidad_ubicacionc").val(respuesta["comodin_unidad_ubicacionc"]);
	$("#editarcomodin_base_ubicacionc").val(respuesta["comodin_base_ubicacionc"]);
	$("#editarreporte_equipo_ubicacionc").val(respuesta["reporte_equipo_ubicacionc"]);
	$("#editarvalor_hora_extra").val(respuesta["valor_hora_extra"]);



	if(respuesta["bono_horas"] == "SI"){
		$("#esibonohoras").prop('checked', true); 
	}
	else{
		$("#enobonohoras").prop('checked', true); 
		
	}

	$("#editarbono_unidad").val(respuesta["bono_unidad"]);
	if(respuesta["bono_unidad"]=="SI"){
		$("#esibonounidad").prop('checked', true); 
	}
	else{
		$("#enobonounidad").prop('checked', true); 

	}
	
	/* ********** */
	
	var dateNEW = respuesta["fecha_inicio"];
	var date = new Date(dateNEW);
	var year = date.toLocaleString("default", { year: "numeric" });
	var month = date.toLocaleString("default", { month: "2-digit" });
	var day = date.toLocaleString("default", { day: "2-digit" });
	var formattedDate = day + "-" + month + "-" + year;

	
	var dateNEW2 = respuesta["fecha_fin"];
	var date2 = new Date(dateNEW2);
	var year2 = date2.toLocaleString("default", { year: "numeric" });
	var month2 = date2.toLocaleString("default", { month: "2-digit" });
	var day2 = date2.toLocaleString("default", { day: "2-digit" });
	var formattedDate2 = day2 + "-" + month2 + "-" + year2;

	
	var dateNEW3 = respuesta["fecha_ultimo_inventario"];
	var date3 = new Date(dateNEW3);
	var year3 = date3.toLocaleString("default", { year: "numeric" });
	var month3 = date3.toLocaleString("default", { month: "2-digit" });
	var day3 = date3.toLocaleString("default", { day: "2-digit" });
	var formattedDate3 = day3 + "-" + month3 + "-" + year3;

	
	$("#editarfecha_inicio").val(formattedDate);
	$("#editarfecha_fin").val(formattedDate2);
	$("#editarfecha_ultimo_inventario").val(formattedDate3);

	$("#inputeditarfecha_inicio").val(respuesta["fecha_inicio"]);
	$("#inputeditarfecha_fin").val(respuesta["fecha_fin"]);
	$("#inputeditarfecha_ultimo_inventario").val(respuesta["fecha_ultimo_inventario"]);


			$("#editartienepon").val(respuesta["tienepon"]);



			$("#editarid").val(respuesta["idubicacionc"]);
			$("#editarid_cliente").val(respuesta["id_cliente"]);
			$("#editarcodigo_cliente").val(respuesta["codigo_cliente"]);
			$("#editarid_coordinador_zona").val(respuesta["id_coordinador_zona"]);
			$("#editarnombre_ubicacion").val(respuesta["nombre_ubicacion"]);
			$("#editarlatitude").val(respuesta["latitude"]);
			$("#editarlongitude").val(respuesta["longitude"]);
			$("#editardireccion").val(respuesta["direccionubicacionc"]);
			$("#editarpersona_contacto").val(respuesta["persona_contacto"]);
			$("#editartelefono_contacto").val(respuesta["telefono_contacto"]);
			$("#editaremail_contacto").val(respuesta["email_contacto"]);
			$("#editarcantidad_armas").val(respuesta["cantidad_armas"]);
			$("#editarcantidad_radios").val(respuesta["cantidad_radios"]);
			$("#editarcantidad_celulares").val(respuesta["cantidad_celulares"]);
			/* $("#editarbonos").val(respuesta["bonos"]); */
			$("#editarvisitas02").val(respuesta["visitas"]);
			$("#editarbonos02").val(respuesta["bonos"]);
			
			
			$("#editarzona").val(respuesta["zona"]);
			$("#editarrubro").val(respuesta["rubro"]);
			$("#editarhoras_permitidas").val(respuesta["horas_permitidas"]);
			$("#editarid_departamento").val(respuesta["iddepartamento"]);
			$("#editarid_municipio").val(respuesta["idmunicipioubicacionc"]);

			$("#editarobservaciones_generales").val(respuesta["observaciones_generales"]);
			$("#editarhombres_autorizados").val(respuesta["hombres_autorizados"]);
				/* nuevo */
			$("#editarfacturar").val(respuesta["facturar"]);
			$("#editartipo_documento").val(respuesta["tipo_documento"]);
			$("#editarforma_pago").val(respuesta["forma_pago"]);
			$("#editarconcepto").val(respuesta["concepto"]);
			$("#editarsumahs").val(respuesta["sumahs"]);




		}

	});

})


/*=============================================
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevonombre").change(function(){


	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarnombre", usuario);

	 $.ajax({
	    url:"ajax/ubicacionc.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevonombre").parent().after('<div class="alert alert-warning">Este registro ya existe en la base de datos</div>');

	    		$("#nuevonombre").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarubicacionc", function(){

  var idubicacionc = $(this).attr("idubicacionc");
  var Codigo = $(this).attr("Codigo");

  swal({
    title: '¿Está seguro de borrar el registro?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=ubicacionc&idubicacionc="+idubicacionc+"&Codigo="+Codigo;

    }

  })

})




