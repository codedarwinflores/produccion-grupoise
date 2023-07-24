



$(document).ready(function(){	  


	
	var ocultar= "visibility:hidden; height:0";
	var mostrar= "visibility:show";

	$(".ocultar_div").attr("style",ocultar);


	var idplanilladevengo_vacacion=$(".idplanilladevengo_vacacion").val();

	if(idplanilladevengo_vacacion!=0){
		var tipo_planilladevengo_vacacion1=$(".tipo_planilladevengo_vacacion1").val();
		var periodo_planilladevengo_vacacion1=$(".periodo_planilladevengo_vacacion1").val();
		var fecha_desde_planilladevengo_vacacion1=$(".fecha_desde_planilladevengo_vacacion1").val();
		var fecha_hasta_planilladevengo_vacacion1=$(".fecha_hasta_planilladevengo_vacacion1").val();
		var numero_planilladevengo_vacacion1=$(".numero_planilladevengo_vacacion1").val();
		var fecha_planilladevengo_vacacion1=$(".fecha_planilladevengo_vacacion1").val();
		var descripcion_planilladevengo_vacacion1=$(".descripcion_planilladevengo_vacacion1").val();
		var empleado_rango_desde1=$(".empleado_rango_desde1").val();
		var empleado_rango_hasta1=$(".empleado_rango_hasta1").val();

		$("#tipo_planilladevengo_vacacion").val(tipo_planilladevengo_vacacion1);
		$("#periodo_planilladevengo_vacacion").val(periodo_planilladevengo_vacacion1);
		$("#fecha_desde_planilladevengo_vacacion").val(fecha_desde_planilladevengo_vacacion1);
		$("#fecha_hasta_planilladevengo_vacacion").val(fecha_hasta_planilladevengo_vacacion1);
		$("#numero_planilladevengo_vacacion").val(numero_planilladevengo_vacacion1);
		$("#fecha_planilladevengo_vacacion").val(fecha_planilladevengo_vacacion1);
		$("#descripcion_planilladevengo_vacacion").val(descripcion_planilladevengo_vacacion1);
		$("#empleado_rango_desde").val(empleado_rango_desde1);
		$("#empleado_rango_hasta").val(empleado_rango_hasta1);

		cargardataempleados();
		$(".filtrar_empleados").attr("disabled","disabled");

	}
	else{
	

	}

	/* ********************* */


	if(idplanilladevengo_vacacion==0){

		/* CORRELATIVO PLANILLA */
		/* *********** */
		var dataString = 'accion01=correlativoplanilla';
		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_vacacion.ajax.php",
			type: 'post',
			success: function (response) {
				$("#numero_planilladevengo_vacacion").val(response);
			}
		});

		/* *********** */


		/* PERIODO */
		var fecha = new Date();
		var ano = fecha.getFullYear();
		var month = fecha.getMonth()+1;
		var dia = fecha.getDate();

		var ultimoDia = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 0);
		var soloultimodia=ultimoDia.getDate();
		var mes=(month<10 ? '0' : '') + month;
		var day= (dia<10 ? '0' : '') + dia;

		if(dia >= 1 && dia <= 15){
			$("#periodo_planilladevengo_vacacion").val("1");
			$("#fecha_desde_planilladevengo_vacacion").val("01"+"-" +mes+"-"+ano);
			$("#fecha_hasta_planilladevengo_vacacion").val("15"+"-" +mes +"-"+ano);
			$("#fecha_planilladevengo_vacacion").val("15"+"-" +mes +"-"+ano);
			var valor= $("#fecha_desde_planilladevengo_vacacion").val();
			var valor2= $("#fecha_hasta_planilladevengo_vacacion").val();
			$("#descripcion_planilladevengo_vacacion").val("Planilla de Vacación desde "+valor+" hasta "+valor2);

			
			$("#historial_fecha_desde").val(valor);
			$("#historial_fecha_hasta").val(valor2);
			$("#historial_periodo").val("1");


		}
		if(dia >= 16 && dia <= 31){
			$("#periodo_planilladevengo_vacacion").val("2");
			$("#fecha_desde_planilladevengo_vacacion").val("16"+"-" +mes+"-"+ano);
			$("#fecha_hasta_planilladevengo_vacacion").val(soloultimodia+"-" +mes +"-"+ano);
			$("#fecha_planilladevengo_vacacion").val(soloultimodia+"-" +mes +"-"+ano);
			var valor= $("#fecha_desde_planilladevengo_vacacion").val();
			var valor2= $("#fecha_hasta_planilladevengo_vacacion").val();
			$("#descripcion_planilladevengo_vacacion").val("Planilla de Vacación desde "+valor+" hasta "+valor2);

			
			$("#historial_fecha_desde").val(valor);
			$("#historial_fecha_hasta").val(valor2);
			$("#historial_periodo").val("2");


		}
		/* ******* */
	}
	/* *********************** */
 });

 

 
$( "#periodo_planilladevengo_vacacion" ).on( "change", function() {
		
	var historial_periodo = $("#historial_periodo").val();
	var valor_actual= $(this).val();

	if(valor_actual!=historial_periodo){
						/* ********************* */

						swal({
							type: "warning",
							title: "Error: periodo incorrecto",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
				
						}).then(function (result) {
							if (result.value) {
								/* window.location = "situacion"; */
								location.reload();
							}
						});
					/* ******************** */
	}


  } );


  /* CAPTURAR FECHA DESDE */
  $( "#fecha_desde_planilladevengo_vacacion" ).on( "click", function() {
	$( "#ic__datepicker-1 .ic__day" ).on( "click", function() {
		/* ******************************************* */
			var desde=$("#fecha_desde_planilladevengo_vacacion").val();
			var historial_desde=$("#historial_fecha_desde").val();

			
			if(desde != historial_desde){
				/* ********************* */

					swal({
						type: "warning",
						title: "Error: periodo incorrecto",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
			
					}).then(function (result) {
						if (result.value) {
							/* window.location = "situacion"; */
							location.reload();
						}
					});
				/* ******************** */
			}
		/* ******************************************* */

	  });
  });

 /* CAPTURAR FECHA HASTA */
 $( "#fecha_hasta_planilladevengo_vacacion" ).on( "click", function() {
	$( "#ic__datepicker-2 .ic__day" ).on( "click", function() {
		/* ******************************************* */
			var hasta=$("#fecha_hasta_planilladevengo_vacacion").val();
					
			var historial_hasta=$("#historial_fecha_hasta").val();

			if(hasta != historial_hasta){
				/* ********************* */

					swal({
						type: "warning",
						title: "Error: periodo incorrecto",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
			
					}).then(function (result) {
						if (result.value) {
							/* window.location = "situacion"; */
							location.reload();
						}
					});
				/* ******************** */
			}
		/* ******************************************* */

	  });
  });


  
  $( ".select_empleado" ).on( "click", function() {
	var id = $(this).attr('id');
	var nombre =$(this).attr('nombre');
	var codigo=$(this).attr('codigo');
	var sueldo=$(this).attr('sueldo');
	$("#codigo_empleado_planilladevengo_vacacion").val(codigo);
	$("#nombre_empleado_planilladevengo_vacacion").val(nombre);
	$("#id_empleado_planilladevengo_vacacion").val(id);

	alert(codigo);
	setTimeout(function(){
		guardarplanilla();
	}, 300);
	setTimeout(function(){
		generarvacacion(id,sueldo);
	}, 400);
	setTimeout(function(){
		location.reload();
	}, 2500);
	
  });

  
/* consulta de viatico por empleado y calculo para devengo_vacacion */
function generarvacacion(id1,sueldo1){

	var numero_planilla=$("#numero_planilladevengo_vacacion").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = id1;
	var accion="agregarvacacion";
	var tipo="suma";
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla+'&sueldo='+sueldo1;

	
	$.ajax({
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
		
	
		}
	});
	/* ********* */
};
  
/* $(".guardarempleado").click(function(){
	guardarplanilla();
	setTimeout(function(){
		location.reload();
	}, 2000);

}); */


 $(".guardarplanilla").click(function(){
	guardarplanilla();
});

function guardarplanilla(){
	
	/* variables */

	var id = $("#id").val();
	var numero_planilladevengo_vacacion = $("#numero_planilladevengo_vacacion").val();
	var fecha_planilladevengo_vacacion = $("#fecha_planilladevengo_vacacion").val();
	var fecha_desde_planilladevengo_vacacion = $("#fecha_desde_planilladevengo_vacacion").val();
	var fecha_hasta_planilladevengo_vacacion = $("#fecha_hasta_planilladevengo_vacacion").val();
	var descripcion_planilladevengo_vacacion = $("#descripcion_planilladevengo_vacacion").val();
	var codigo_empleado_planilladevengo_vacacion = $("#codigo_empleado_planilladevengo_vacacion").val();
	var nombre_empleado_planilladevengo_vacacion = $("#nombre_empleado_planilladevengo_vacacion").val();
	var id_empleado_planilladevengo_vacacion = $("#id_empleado_planilladevengo_vacacion").val();
	var dias_trabajo_planilladevengo_vacacion = $("#dias_trabajo_planilladevengo_vacacion").val();
	var sueldo_planilladevengo_vacacion = $("#sueldo_planilladevengo_vacacion").val();
	var hora_extra_diurna_planilladevengo_vacacion = $("#hora_extra_diurna_planilladevengo_vacacion").val();
	var hora_extra_nocturna_planilladevengo_vacacion = $("#hora_extra_nocturna_planilladevengo_vacacion").val();
	var hora_extra_domingo_planilladevengo_vacacion = $("#hora_extra_domingo_planilladevengo_vacacion").val();
	var hora_extra_domingo_nocturna_planilladevengo_vacacion = $("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val();
	var otro_devengo_vacacion_planilladevengo_vacacion = $("#otro_devengo_vacacion_planilladevengo_vacacion").val();
	var total_devengo_vacacion_planilladevengo_vacacion = $("#total_devengo_vacacion_planilladevengo_vacacion").val();
	var descuento_isss_planilladevengo_vacacion = $("#descuento_isss_planilladevengo_vacacion").val();
	var descuento_afp_planilladevengo_vacacion = $("#descuento_afp_planilladevengo_vacacion").val();
	var descuento_renta_planilladevengo_vacacion = $("#descuento_renta_planilladevengo_vacacion").val();
	var otro_descuento_planilladevengo_vacacion = $("#otro_descuento_planilladevengo_vacacion").val();
	var total_descuento_planilladevengo_vacacion = $("#total_descuento_planilladevengo_vacacion").val();
	var total_liquidado_planilladevengo_vacacion = $("#total_liquidado_planilladevengo_vacacion").val();
	var sueldo_renta_planilladevengo_vacacion = $("#sueldo_renta_planilladevengo_vacacion").val();
	var sueldo_isss_planilladevengo_vacacion = $("#sueldo_isss_planilladevengo_vacacion").val();
	var sueldo_afp_planilladevengo_vacacion = $("#sueldo_afp_planilladevengo_vacacion").val();
	var departamento_planilladevengo_vacacion = $("#departamento_planilladevengo_vacacion").val();
	var codigo_ubicacion_planilladevengo_vacacion = $("#codigo_ubicacion_planilladevengo_vacacion").val();
	var nombre_ubicacion_planilladevengo_vacacion = $("#nombre_ubicacion_planilladevengo_vacacion").val();
	var id_ubicacion_planilladevengo_vacacion = $("#id_ubicacion_planilladevengo_vacacion").val();
	var observacion_planilladevengo_vacacion = $("#observacion_planilladevengo_vacacion").val();
	var periodo_planilladevengo_vacacion = $("#periodo_planilladevengo_vacacion").val();
	var tipo_planilladevengo_vacacion = $("#tipo_planilladevengo_vacacion").val();
	var dias_incapacidad = $("#dias_incapacidad").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var accion_realizar = "";

/*  ******** */

				var dataString = 'id=' +$.trim(id) +
				'&numero_planilladevengo_vacacion=' +numero_planilladevengo_vacacion +
				'&fecha_planilladevengo_vacacion=' +fecha_planilladevengo_vacacion +
				'&fecha_desde_planilladevengo_vacacion=' +fecha_desde_planilladevengo_vacacion +
				'&fecha_hasta_planilladevengo_vacacion=' +fecha_hasta_planilladevengo_vacacion +
				'&descripcion_planilladevengo_vacacion=' +descripcion_planilladevengo_vacacion +
				'&codigo_empleado_planilladevengo_vacacion=' +codigo_empleado_planilladevengo_vacacion +
				'&nombre_empleado_planilladevengo_vacacion=' +nombre_empleado_planilladevengo_vacacion +
				'&id_empleado_planilladevengo_vacacion=' +id_empleado_planilladevengo_vacacion +
				'&dias_trabajo_planilladevengo_vacacion=' +dias_trabajo_planilladevengo_vacacion +
				'&sueldo_planilladevengo_vacacion=' +sueldo_planilladevengo_vacacion +
				'&hora_extra_diurna_planilladevengo_vacacion=' +hora_extra_diurna_planilladevengo_vacacion +
				'&hora_extra_nocturna_planilladevengo_vacacion=' +hora_extra_nocturna_planilladevengo_vacacion +
				'&hora_extra_domingo_planilladevengo_vacacion=' +hora_extra_domingo_planilladevengo_vacacion +
				'&hora_extra_domingo_nocturna_planilladevengo_vacacion=' +hora_extra_domingo_nocturna_planilladevengo_vacacion +
				'&otro_devengo_vacacion_planilladevengo_vacacion=' +otro_devengo_vacacion_planilladevengo_vacacion +
				 '&total_devengo_vacacion_planilladevengo_vacacion=' +total_devengo_vacacion_planilladevengo_vacacion +
				 '&descuento_isss_planilladevengo_vacacion=' +descuento_isss_planilladevengo_vacacion +
				 '&descuento_afp_planilladevengo_vacacion=' +descuento_afp_planilladevengo_vacacion +
				 '&descuento_renta_planilladevengo_vacacion=' +descuento_renta_planilladevengo_vacacion +
				 '&otro_descuento_planilladevengo_vacacion=' +otro_descuento_planilladevengo_vacacion +
				 '&total_descuento_planilladevengo_vacacion=' +total_descuento_planilladevengo_vacacion +
				 '&total_liquidado_planilladevengo_vacacion=' +total_liquidado_planilladevengo_vacacion +
				 '&sueldo_renta_planilladevengo_vacacion=' +sueldo_renta_planilladevengo_vacacion +
				 '&sueldo_isss_planilladevengo_vacacion=' +sueldo_isss_planilladevengo_vacacion +
				 '&sueldo_afp_planilladevengo_vacacion=' +sueldo_afp_planilladevengo_vacacion +
				 '&departamento_planilladevengo_vacacion=' +departamento_planilladevengo_vacacion +
				 '&codigo_ubicacion_planilladevengo_vacacion=' +codigo_ubicacion_planilladevengo_vacacion +
				 '&nombre_ubicacion_planilladevengo_vacacion=' +nombre_ubicacion_planilladevengo_vacacion +
				 '&id_ubicacion_planilladevengo_vacacion=' +id_ubicacion_planilladevengo_vacacion+
				 '&observacion_planilladevengo_vacacion=' +observacion_planilladevengo_vacacion+
				 '&periodo_planilladevengo_vacacion=' +periodo_planilladevengo_vacacion+
				 '&tipo_planilladevengo_vacacion=' +tipo_planilladevengo_vacacion+
				 '&dias_incapacidad=' +dias_incapacidad+
				 '&empleado_rango_desde=' +empleado_rango_desde+
				 '&empleado_rango_hasta=' +empleado_rango_hasta+
				 '&accion=' +accion_realizar;
				 
$.ajax({
	data: dataString,
	url: "ajax/planilladevengo_vacacion.ajax.php",
	type: 'post',
	success: function (response) {
		/* alert(response); */
		swal({
			type: "success",
			title: "Guardado con Exito",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function (result) {
			if (result.value) {

				/* alert(result); */
				/* window.location = "situacion"; */
				/* location.reload(); */

				actualizar_datos();
				
			}
		});
	}
});
/* ********* */

}

function guardarplanillaoculto(){
	
	/* variables */

	var id = $("#id").val();
	var numero_planilladevengo_vacacion = $("#numero_planilladevengo_vacacion").val();
	var fecha_planilladevengo_vacacion = $("#fecha_planilladevengo_vacacion").val();
	var fecha_desde_planilladevengo_vacacion = $("#fecha_desde_planilladevengo_vacacion").val();
	var fecha_hasta_planilladevengo_vacacion = $("#fecha_hasta_planilladevengo_vacacion").val();
	var descripcion_planilladevengo_vacacion = $("#descripcion_planilladevengo_vacacion").val();
	var codigo_empleado_planilladevengo_vacacion = $("#codigo_empleado_planilladevengo_vacacion").val();
	var nombre_empleado_planilladevengo_vacacion = $("#nombre_empleado_planilladevengo_vacacion").val();
	var id_empleado_planilladevengo_vacacion = $("#id_empleado_planilladevengo_vacacion").val();
	var dias_trabajo_planilladevengo_vacacion = $("#dias_trabajo_planilladevengo_vacacion").val();
	var sueldo_planilladevengo_vacacion = $("#sueldo_planilladevengo_vacacion").val();
	var hora_extra_diurna_planilladevengo_vacacion = $("#hora_extra_diurna_planilladevengo_vacacion").val();
	var hora_extra_nocturna_planilladevengo_vacacion = $("#hora_extra_nocturna_planilladevengo_vacacion").val();
	var hora_extra_domingo_planilladevengo_vacacion = $("#hora_extra_domingo_planilladevengo_vacacion").val();
	var hora_extra_domingo_nocturna_planilladevengo_vacacion = $("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val();
	var otro_devengo_vacacion_planilladevengo_vacacion = $("#otro_devengo_vacacion_planilladevengo_vacacion").val();
	var total_devengo_vacacion_planilladevengo_vacacion = $("#total_devengo_vacacion_planilladevengo_vacacion").val();
	var descuento_isss_planilladevengo_vacacion = $("#descuento_isss_planilladevengo_vacacion").val();
	var descuento_afp_planilladevengo_vacacion = $("#descuento_afp_planilladevengo_vacacion").val();
	var descuento_renta_planilladevengo_vacacion = $("#descuento_renta_planilladevengo_vacacion").val();
	var otro_descuento_planilladevengo_vacacion = $("#otro_descuento_planilladevengo_vacacion").val();
	var total_descuento_planilladevengo_vacacion = $("#total_descuento_planilladevengo_vacacion").val();
	var total_liquidado_planilladevengo_vacacion = $("#total_liquidado_planilladevengo_vacacion").val();
	var sueldo_renta_planilladevengo_vacacion = $("#sueldo_renta_planilladevengo_vacacion").val();
	var sueldo_isss_planilladevengo_vacacion = $("#sueldo_isss_planilladevengo_vacacion").val();
	var sueldo_afp_planilladevengo_vacacion = $("#sueldo_afp_planilladevengo_vacacion").val();
	var departamento_planilladevengo_vacacion = $("#departamento_planilladevengo_vacacion").val();
	var codigo_ubicacion_planilladevengo_vacacion = $("#codigo_ubicacion_planilladevengo_vacacion").val();
	var nombre_ubicacion_planilladevengo_vacacion = $("#nombre_ubicacion_planilladevengo_vacacion").val();
	var id_ubicacion_planilladevengo_vacacion = $("#id_ubicacion_planilladevengo_vacacion").val();
	var observacion_planilladevengo_vacacion = $("#observacion_planilladevengo_vacacion").val();
	var periodo_planilladevengo_vacacion = $("#periodo_planilladevengo_vacacion").val();
	var tipo_planilladevengo_vacacion = $("#tipo_planilladevengo_vacacion").val();
	var dias_incapacidad = $("#dias_incapacidad").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var accion_realizar = "";

/*  ******** */

				var dataString = 'id=' +$.trim(id) +
				'&numero_planilladevengo_vacacion=' +numero_planilladevengo_vacacion +
				'&fecha_planilladevengo_vacacion=' +fecha_planilladevengo_vacacion +
				'&fecha_desde_planilladevengo_vacacion=' +fecha_desde_planilladevengo_vacacion +
				'&fecha_hasta_planilladevengo_vacacion=' +fecha_hasta_planilladevengo_vacacion +
				'&descripcion_planilladevengo_vacacion=' +descripcion_planilladevengo_vacacion +
				'&codigo_empleado_planilladevengo_vacacion=' +codigo_empleado_planilladevengo_vacacion +
				'&nombre_empleado_planilladevengo_vacacion=' +nombre_empleado_planilladevengo_vacacion +
				'&id_empleado_planilladevengo_vacacion=' +id_empleado_planilladevengo_vacacion +
				'&dias_trabajo_planilladevengo_vacacion=' +dias_trabajo_planilladevengo_vacacion +
				'&sueldo_planilladevengo_vacacion=' +sueldo_planilladevengo_vacacion +
				'&hora_extra_diurna_planilladevengo_vacacion=' +hora_extra_diurna_planilladevengo_vacacion +
				'&hora_extra_nocturna_planilladevengo_vacacion=' +hora_extra_nocturna_planilladevengo_vacacion +
				'&hora_extra_domingo_planilladevengo_vacacion=' +hora_extra_domingo_planilladevengo_vacacion +
				'&hora_extra_domingo_nocturna_planilladevengo_vacacion=' +hora_extra_domingo_nocturna_planilladevengo_vacacion +
				'&otro_devengo_vacacion_planilladevengo_vacacion=' +otro_devengo_vacacion_planilladevengo_vacacion +
				 '&total_devengo_vacacion_planilladevengo_vacacion=' +total_devengo_vacacion_planilladevengo_vacacion +
				 '&descuento_isss_planilladevengo_vacacion=' +descuento_isss_planilladevengo_vacacion +
				 '&descuento_afp_planilladevengo_vacacion=' +descuento_afp_planilladevengo_vacacion +
				 '&descuento_renta_planilladevengo_vacacion=' +descuento_renta_planilladevengo_vacacion +
				 '&otro_descuento_planilladevengo_vacacion=' +otro_descuento_planilladevengo_vacacion +
				 '&total_descuento_planilladevengo_vacacion=' +total_descuento_planilladevengo_vacacion +
				 '&total_liquidado_planilladevengo_vacacion=' +total_liquidado_planilladevengo_vacacion +
				 '&sueldo_renta_planilladevengo_vacacion=' +sueldo_renta_planilladevengo_vacacion +
				 '&sueldo_isss_planilladevengo_vacacion=' +sueldo_isss_planilladevengo_vacacion +
				 '&sueldo_afp_planilladevengo_vacacion=' +sueldo_afp_planilladevengo_vacacion +
				 '&departamento_planilladevengo_vacacion=' +departamento_planilladevengo_vacacion +
				 '&codigo_ubicacion_planilladevengo_vacacion=' +codigo_ubicacion_planilladevengo_vacacion +
				 '&nombre_ubicacion_planilladevengo_vacacion=' +nombre_ubicacion_planilladevengo_vacacion +
				 '&id_ubicacion_planilladevengo_vacacion=' +id_ubicacion_planilladevengo_vacacion+
				 '&observacion_planilladevengo_vacacion=' +observacion_planilladevengo_vacacion+
				 '&periodo_planilladevengo_vacacion=' +periodo_planilladevengo_vacacion+
				 '&tipo_planilladevengo_vacacion=' +tipo_planilladevengo_vacacion+
				 '&dias_incapacidad=' +dias_incapacidad+
				 '&empleado_rango_desde=' +empleado_rango_desde+
				 '&empleado_rango_hasta=' +empleado_rango_hasta+
				 '&accion=' +accion_realizar;
				 

$.ajax({
	data: dataString,
	url: "ajax/planilladevengo_vacacion.ajax.php",
	type: 'post',
	success: function (response) {
		obtener_horas();
	}
});
/* ********* */

}


/* CAPTURAR FECHA DESDE */

$( "#fecha_desde_planilladevengo_vacacion" ).on( "click", function() {
	$( "#ic__datepicker-1 .ic__day" ).on( "click", function() {
		var valor= $("#fecha_desde_planilladevengo_vacacion").val();
		var valor2= $("#fecha_hasta_planilladevengo_vacacion").val();
		$("#descripcion_planilladevengo_vacacion").val("Planilla de Vacación desde "+valor+" hasta "+valor2);

	  } );
  } );

  /* CAPTURAR FECHA HASTA */
  $( "#fecha_hasta_planilladevengo_vacacion" ).on( "click", function() {
	$( "#ic__datepicker-2 .ic__day" ).on( "click", function() {
		var valor= $("#fecha_desde_planilladevengo_vacacion").val();
		var valor2= $("#fecha_hasta_planilladevengo_vacacion").val();
		$("#descripcion_planilladevengo_vacacion").val("Planilla de Vacación desde "+valor+" hasta "+valor2);

	  } );
  } );

  $(".filtrar_empleados").click(function(){

	cargardataempleados();
});

function cargardataempleados(){

	var tipo_planilladevengo_vacacion=$("#tipo_planilladevengo_vacacion").val();
	var periodo_planilladevengo_vacacion=$("#periodo_planilladevengo_vacacion").val();
	var numero_planilladevengo_vacacion=$("#numero_planilladevengo_vacacion").val();
	var descripcion_planilladevengo_vacacion =$("#descripcion_planilladevengo_vacacion").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo_vacacion = $("#fecha_planilladevengo_vacacion").val();
	var fecha_desde_planilladevengo_vacacion = $("#fecha_desde_planilladevengo_vacacion").val();
	var fecha_hasta_planilladevengo_vacacion = $("#fecha_hasta_planilladevengo_vacacion").val();
	var accion_realizar = "";

	var accion ="";
	if(empleado_rango_desde != "*"){

		if (empleado_rango_hasta=="*"){
			accion ="falta";
		}
		else{
			accion="consultar";
			accion_realizar="listaconempleado";

		}
	}

	if(fecha_planilladevengo_vacacion==""){
		accion ="falta";
	}
	else if(empleado_rango_desde=="*" && empleado_rango_hasta=="*"){
		accion="consultar";
		accion_realizar="lista";

	}

	if(accion == "falta"){
		alert("Por favor ingrese Datos para la busqueda");
	}

	if(accion=="consultar"){

		/* *********** */
		var dataString = 'empleado_rango_desde=' +empleado_rango_desde +
		'&empleado_rango_hasta=' +empleado_rango_hasta+
		'&fecha_planilladevengo_vacacion=' +fecha_planilladevengo_vacacion+
		'&fechaperiodo1=' +fecha_desde_planilladevengo_vacacion+
		'&fechaperiodo2=' +fecha_hasta_planilladevengo_vacacion+
		'&tipo_planilladevengo_vacacion=' +tipo_planilladevengo_vacacion+
		'&periodo_planilladevengo_vacacion=' +periodo_planilladevengo_vacacion+
		'&numero_planilladevengo_vacacion=' +numero_planilladevengo_vacacion+
		'&descripcion_planilladevengo_vacacion=' +descripcion_planilladevengo_vacacion+
		'&accion01=' +$.trim(accion_realizar);
		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_vacacion.ajax.php",
			type: 'post',
			success: function (response) {

				console.log(response);
				if(response.trim()!=""){
					window.location = "nuevaplanillavacacion?id="+response;
				}
				cargardataempleados_vacacion();
				$("#tabla_empleados").empty();
				$("#tabla_empleados").append(response);

				/* $(".tablas1").on("click", ".btnEditarabase", function(){
					var codigo = $(this).attr("codigo");
					var id = $(this).attr("idempleado");
					var nombre = $(this).attr("nombre");
					var sueldo = $(this).attr("sueldo");
					var salario_por_hora = $(this).attr("salario_por_hora");
					$("#salario_por_hora").val(salario_por_hora);

					$("#nombreempleado").text(nombre);
					
					$(".mostrar_devengo_vacacion").attr("sueldo",sueldo);
					$(".valor_devengo_planilla").attr("idempleado",id);
					valor_devengo_vacacion();
					editar(codigo,id,nombre,sueldo);
					calculos(id,sueldo);
				}); */
				/* ****eliminar empleado */
				$(".tablas1").on("click", ".eliminarempleado", function(){
					var idempleado = $(this).attr("idempleado");
					var numero_planilla=$(this).attr("numero_planilla");
					eliminarempleado(idempleado,numero_planilla);
				})

				$('.tablas1').DataTable({
					language: {
						"decimal": "",
						"emptyTable": "No hay información",
						"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
						"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
						"infoFiltered": "(Filtrado de _MAX_ total entradas)",
						"infoPostFix": "",
						"thousands": ",",
						"lengthMenu": "Mostrar _MENU_ Entradas",
						"loadingRecords": "Cargando...",
						"processing": "Procesando...",
						"search": "Buscar:",
						"zeroRecords": "Sin resultados encontrados",
						"paginate": {
						"first": "Primero",
						"last": "Ultimo",
						"next": "Siguiente",
						"previous": "Anterior"
						}
						}
				});
			}
		});

		/* *********** */


	}

}


function cargardataempleados_vacacion(){

	var tipo_planilladevengo_vacacion=$("#tipo_planilladevengo_vacacion").val();
	var periodo_planilladevengo_vacacion=$("#periodo_planilladevengo_vacacion").val();
	var numero_planilladevengo_vacacion=$("#numero_planilladevengo_vacacion").val();
	var descripcion_planilladevengo_vacacion =$("#descripcion_planilladevengo_vacacion").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo_vacacion = $("#fecha_planilladevengo_vacacion").val();
	var fecha_desde_planilladevengo_vacacion = $("#fecha_desde_planilladevengo_vacacion").val();
	var fecha_hasta_planilladevengo_vacacion = $("#fecha_hasta_planilladevengo_vacacion").val();
	var accion_realizar = "";

	var accion ="";
	if(empleado_rango_desde != "*"){

		if (empleado_rango_hasta=="*"){
			accion ="falta";
		}
		else{
			accion="consultar";
			accion_realizar="listaconempleado";

		}
	}

	if(fecha_planilladevengo_vacacion==""){
		accion ="falta";
	}
	else if(empleado_rango_desde=="*" && empleado_rango_hasta=="*"){
		accion="consultar";
		accion_realizar="lista";

	}

	if(accion == "falta"){
		alert("Por favor ingrese Datos para la busqueda");
	}

	if(accion=="consultar"){

		/* *********** */
		var dataString = 'empleado_rango_desde=' +empleado_rango_desde +
		'&empleado_rango_hasta=' +empleado_rango_hasta+
		'&fecha_planilladevengo_vacacion=' +fecha_planilladevengo_vacacion+
		'&fechaperiodo1=' +fecha_desde_planilladevengo_vacacion+
		'&fechaperiodo2=' +fecha_hasta_planilladevengo_vacacion+
		'&tipo_planilladevengo_vacacion=' +tipo_planilladevengo_vacacion+
		'&periodo_planilladevengo_vacacion=' +periodo_planilladevengo_vacacion+
		'&numero_planilladevengo_vacacion=' +numero_planilladevengo_vacacion+
		'&descripcion_planilladevengo_vacacion=' +descripcion_planilladevengo_vacacion+
		'&accion01=empleadosguardados';
		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_vacacion.ajax.php",
			type: 'post',
			success: function (response) {
				
				console.log(response);
				$("#tabla_empleados").empty();
				$("#tabla_empleados").append(response);

				$(".tablas1").on("click", ".btnEditarabase", function(){


					var codigo = $(this).attr("codigo");
					var id = $(this).attr("idempleado");
					var nombre = $(this).attr("nombre");
					var sueldo = $(this).attr("sueldo");
					var salario_por_hora = $(this).attr("salario_por_hora");

					var hora_extra_diurna = $(this).attr("hora_extra_diurna");
					var hora_extra_nocturna = $(this).attr("hora_extra_nocturna");
					var hora_extra_domingo = $(this).attr("hora_extra_domingo");
					var hora_extra_nocturna_domingo = $(this).attr("hora_extra_nocturna_domingo");


					var fecha_contratacion = $(this).attr("fecha_contratacion");
					var hr1 = moment(fecha_contratacion,'YYYY/MM/DD HH:mm:ss a').format('DD-MM-YYYY');
					$("#fecha_contratacion").val(hr1);

					
					var sueldo_diario = $(this).attr("sueldo_diario");
					var votevalue = parseFloat(sueldo_diario);
					$("#sueldo_diario").val(votevalue);


					$("#txt_codigo").val(codigo);
					$("#txt_idempleado").val(id);
					$("#txt_nombre").val(nombre);
					$("#txt_sueldo").val(sueldo);
					$("#txt_salario_por_hora").val(salario_por_hora);
					

					$("#salario_por_hora").val(salario_por_hora);

					$("#hora_extra_diurna").val(hora_extra_diurna);
					$("#hora_extra_nocturna").val(hora_extra_nocturna);
					$("#hora_extra_domingo").val(hora_extra_domingo);
					$("#hora_extra_nocturna_domingo").val(hora_extra_nocturna_domingo);


					

					$("#nombreempleado").text(nombre);
					
					$(".mostrar_devengo_vacacion").attr("sueldo",sueldo);
					$(".valor_devengo_planilla").attr("idempleado",id);

					valor_devengo_vacacion();
					editar(codigo,id,nombre,sueldo);
					calculos(id,sueldo);
								
					setInterval(repetir(codigo,id,nombre,sueldo),600);


					$(".btnEditarabase").removeAttr("style");
					$(this).attr("style","background: lightblue;");

				});
				/* ****eliminar empleado */
				$(".tablas1").on("click", ".eliminarempleado", function(){
					var idempleado = $(this).attr("idempleado");
					var numero_planilla=$(this).attr("numero_planilla");
					eliminarempleado(idempleado,numero_planilla);
				})

				$('.tablas1').DataTable({
					language: {
						"decimal": "",
						"emptyTable": "No hay información",
						"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
						"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
						"infoFiltered": "(Filtrado de _MAX_ total entradas)",
						"infoPostFix": "",
						"thousands": ",",
						"lengthMenu": "Mostrar _MENU_ Entradas",
						"loadingRecords": "Cargando...",
						"processing": "Procesando...",
						"search": "Buscar:",
						"zeroRecords": "Sin resultados encontrados",
						"paginate": {
						"first": "Primero",
						"last": "Ultimo",
						"next": "Siguiente",
						"previous": "Anterior"
						}
						}
				});
			}
		});

		/* *********** */


	}

}


function repetir(codigo,id,nombre,sueldo){
	/* editar(codigo,id,nombre,sueldo); */
	/* $(".empleadoseleccionado").trigger("click"); */
	
	setInterval(editar(codigo,id,nombre,sueldo),700);
	setTimeout(function(){
		editar(codigo,id,nombre,sueldo);
	}, 1000);

}

function actualizar_datos(){
	

	$('.modal_carga').modal({backdrop: 'static', keyboard: false});


	var codigo =$("#txt_codigo").val();
	var id=$("#txt_idempleado").val();
	var nombre=$("#txt_nombre").val();
	var sueldo=$("#txt_sueldo").val();
	var txt_salario_por_hora=$("#txt_salario_por_hora").val();

	
	valor_devengo_vacacion();
	editar(codigo,id,nombre,sueldo);
	calculos(id,sueldo);


	setTimeout(function(){
		valor_devengo_vacacion();
		editar(codigo,id,nombre,sueldo);
		calculos(id,sueldo);
	}, 1000);

	
	setTimeout(function(){
		valor_devengo_vacacion();
		editar(codigo,id,nombre,sueldo);
		calculos(id,sueldo);
	}, 1500);

	
	setTimeout(function(){
		$('.modal_carga').modal('toggle');	
	}, 2000);

	
}

/* ELIMINAR EMPLEADO******************************** */
function eliminarempleado(idempleados,numero_planillas){


	var dataString = 'numero_planilladevengo_vacacion=' +numero_planillas +
	'&id_empleado_planilladevengo_vacacion=' +idempleados+
	'&accion01=eliminarempleado';
	

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
	
			$.ajax({
				url: "ajax/planilladevengo_vacacion.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					location.reload();
					/* alert(response); */
					/* console.log(response);
					$('#myModal').modal('toggle'); */
				}
			});
	
		}
	
	  })
		


}




/* ****eliminar plantilla */
$(".tablas").on("click", ".eliminarallplantilla", function(){
	var numero_planilladevengo_vacacion = $(this).attr("numero_planilladevengo_vacacion");
	eliminarplantilla(numero_planilladevengo_vacacion);
});


/* ELIMINAR PLANTILLA******************************** */
function eliminarplantilla(numero_planillas){


	var dataString = 'numero_planilladevengo_vacacion=' +numero_planillas +
	'&accion01=eliminarplanilla';
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
	
			$.ajax({
				url: "ajax/planilladevengo_vacacion.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					
					location.reload();
					/* alert(response); */
					/* console.log(response);
					$('#myModal').modal('toggle'); */
				}
			});
	
		}
	
	  })
		


}
/* ************************************************* */


function obtener_horas(){

	var codigo1 =$("#txt_codigo").val();
	var id1=$("#txt_idempleado").val();
	var nombre1=$("#txt_nombre").val();
	var sueldo1=$("#txt_sueldo").val();
	var txt_salario_por_hora1=$("#txt_salario_por_hora").val();
	var numero_planilladevengo_vacacion=$("#numero_planilladevengo_vacacion").val();


	var accion_realizar = "obtenerdatatotal";
	var idabase = codigo1;
	var dataString = 'consultarempleado=' +id1+'&numero_planilladevengo_vacacion=' +numero_planilladevengo_vacacion+'&accion01=' +accion_realizar;
		$.ajax({
			
			url: "ajax/planilladevengo_vacacion.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
				var datos = JSON.parse(response);

				
				/* console.log(response);
				console.log(datos[0].id_empleado_planilladevengo_vacacion); */

				
				if($.trim(datos[0].hora_extra_diurna_planilladevengo_vacacion)==""){
					$("#hora_extra_diurna_planilladevengo_vacacion").val("0");
				}
				else{
					$("#hora_extra_diurna_planilladevengo_vacacion").val(datos[0].hora_extra_diurna_planilladevengo_vacacion);
				}
				if($.trim(datos[0].hora_extra_nocturna_planilladevengo_vacacion) ==""){
					$("#hora_extra_nocturna_planilladevengo_vacacion").val("0")
				}
				else{
					$("#hora_extra_nocturna_planilladevengo_vacacion").val(datos[0].hora_extra_nocturna_planilladevengo_vacacion);

				}
				if($.trim(datos[0].hora_extra_domingo_planilladevengo_vacacion)==""){
					$("#hora_extra_domingo_planilladevengo_vacacion").val("0");
				}
				else{
				$("#hora_extra_domingo_planilladevengo_vacacion").val(datos[0].hora_extra_domingo_planilladevengo_vacacion);

				}
				if($.trim(datos[0].hora_extra_domingo_planilladevengo_vacacion)==""){
					$("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val("0")
				}
				else{
					$("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_vacacion);
				}

			}
		})
}
/*=============================================
EDITAR 
=============================================*/
 function editar(codigo1,id1,nombre1,sueldo){
	
	

	$("#dias_trabajo_planilladevengo_vacacion").val("");
	$("#sueldo_planilladevengo_vacacion").val("");
	$("#hora_extra_diurna_planilladevengo_vacacion").val("");
	$("#hora_extra_nocturna_planilladevengo_vacacion").val("");
	$("#hora_extra_domingo_planilladevengo_vacacion").val("");
	$("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val("");
	$("#otro_devengo_vacacion_planilladevengo_vacacion").val("");
	$("#total_devengo_vacacion_planilladevengo_vacacion").val("");
	$("#descuento_isss_planilladevengo_vacacion").val("");
	$("#descuento_afp_planilladevengo_vacacion").val("");
	$("#descuento_renta_planilladevengo_vacacion").val("");
	$("#otro_descuento_planilladevengo_vacacion").val("");
	$("#total_descuento_planilladevengo_vacacion").val("");
	$("#total_liquidado_planilladevengo_vacacion").val("");
	$("#sueldo_renta_planilladevengo_vacacion").val("");
	$("#sueldo_isss_planilladevengo_vacacion").val("");
	$("#sueldo_afp_planilladevengo_vacacion").val("");
	$("#observacion_planilladevengo_vacacion").val("");
	$("#dias_incapacidad").val("");


	var accion_realizar = "obtenerdata";
	var idabase = codigo1;
	var dataString = 'consultarempleado=' +idabase+'&accion01=' +accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo_vacacion.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
				
				$(".mostrar_devengo_vacacion").removeAttr("disabled");
				var datos = JSON.parse(response);
				console.log(response);
				console.log(datos[0].codigo_empleado_planilladevengo_vacacion);

				
			
				$(".idempleado_devengo").val(id1);/* --este campo es devengo */
				/* $(".id_devengo_vacacion").val(datos[0].id); */

				/* OBTENER DATOS DEL EMPLEADO*********** */
				$("#codigo_empleado_planilladevengo_vacacion").val(codigo1);
				$("#nombre_empleado_planilladevengo_vacacion").val(nombre1);
				$("#id_empleado_planilladevengo_vacacion").val(id1);
				$("#codigo_ubicacion_planilladevengo_vacacion").val(datos[0].codigo_ubicacion);
				$("#nombre_ubicacion_planilladevengo_vacacion").val(datos[0].nombre_ubicacion);
				$("#id_ubicacion_planilladevengo_vacacion").val(datos[0].idubicacion);

				$("#sueldo_planilladevengo_vacacion").val(sueldo);
				$("#otro_devengo_vacacion_planilladevengo_vacacion").val(datos[0].valorempleado);

				/* $("#hora_extra_diurna_planilladevengo_vacacion").val(datos[0].hora_extra_diurna_planilladevengo_vacacion);
				$("#hora_extra_nocturna_planilladevengo_vacacion").val(datos[0].hora_extra_nocturna_planilladevengo_vacacion);
				$("#hora_extra_domingo_planilladevengo_vacacion").val(datos[0].hora_extra_domingo_planilladevengo_vacacion);
				$("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_vacacion); */

				
				/* $("#total_devengo_vacacion_planilladevengo_vacacion").val(datos[0].valorempleado); */

			/* 	$("#total_devengo_vacacion_planilladevengo_vacacion").val(datos[0].valor); */

				/* $("#departamento_planilladevengo_vacacion").val(datos[0].nombredepartamento); */
				$("#departamento_planilladevengo_vacacion").val(datos[0].nombredepartamento).trigger('change.select2');

			
				obtenerdata_total(codigo1,id1,nombre1);

				var tipo = "suma";
				cargardatadevengo(tipo);

				var tipo2 = "resta";
				cargardatadescuento(tipo2);
				empleados_devengos();



	



				/* $("#numero_planilladevengo_vacacion").val(datos[0].numero_planilladevengo_vacacion);
				$("#fecha_planilladevengo_vacacion").val(datos[0].fecha_planilladevengo_vacacion);
				$("#fecha_desde_planilladevengo_vacacion").val(datos[0].fecha_desde_planilladevengo_vacacion);
				$("#fecha_hasta_planilladevengo_vacacion").val(datos[0].fecha_hasta_planilladevengo_vacacion);
				$("#descripcion_planilladevengo_vacacion").val(datos[0].descripcion_planilladevengo_vacacion); */
	
		/* 		$("#dias_trabajo_planilladevengo_vacacion").val(datos[0].dias_trabajo_planilladevengo_vacacion);
				$("#sueldo_planilladevengo_vacacion").val(datos[0].sueldo_planilladevengo_vacacion);
				$("#hora_extra_diurna_planilladevengo_vacacion").val(datos[0].hora_extra_diurna_planilladevengo_vacacion);
				$("#hora_extra_nocturna_planilladevengo_vacacion").val(datos[0].hora_extra_nocturna_planilladevengo_vacacion);
				$("#hora_extra_domingo_planilladevengo_vacacion").val(datos[0].hora_extra_domingo_planilladevengo_vacacion);
				$("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_vacacion);
				$("#otro_devengo_vacacion_planilladevengo_vacacion").val(datos[0].otro_devengo_vacacion_planilladevengo_vacacion);
				$("#total_devengo_vacacion_planilladevengo_vacacion").val(datos[0].total_devengo_vacacion_planilladevengo_vacacion);
				$("#descuento_isss_planilladevengo_vacacion").val(datos[0].descuento_isss_planilladevengo_vacacion);
				$("#descuento_afp_planilladevengo_vacacion").val(datos[0].descuento_afp_planilladevengo_vacacion);
				$("#descuento_renta_planilladevengo_vacacion").val(datos[0].descuento_renta_planilladevengo_vacacion);
				$("#otro_descuento_planilladevengo_vacacion").val(datos[0].otro_descuento_planilladevengo_vacacion);
				$("#total_descuento_planilladevengo_vacacion").val(datos[0].total_descuento_planilladevengo_vacacion); */

			/* 	$("#total_liquidado_planilladevengo_vacacion").val(datos[0].total_liquidado_planilladevengo_vacacion); */
		/* 		$("#sueldo_renta_planilladevengo_vacacion").val(datos[0].sueldo_renta_planilladevengo_vacacion);
				$("#sueldo_isss_planilladevengo_vacacion").val(datos[0].sueldo_isss_planilladevengo_vacacion);
				$("#sueldo_afp_planilladevengo_vacacion").val(datos[0].sueldo_afp_planilladevengo_vacacion); */
				/* $("#departamento_planilladevengo_vacacion").val(datos[0].departamento_planilladevengo_vacacion); */

			
				/* $("#observacion_planilladevengo_vacacion").val(datos[0].observacion_planilladevengo_vacacion); */
		/* 		$("#periodo_planilladevengo_vacacion").val(datos[0].periodo_planilladevengo_vacacion);
				$("#tipo_planilladevengo_vacacion").val(datos[0].tipo_planilladevengo_vacacion); */
				/* $("#dias_incapacidad").val(datos[0].dias_incapacidad); */
	
	
				
				/* var tipo = "suma";
				cargardatadevengo(tipo);

				var tipo2 = "resta";
				cargardatadescuento(tipo2);
				empleados_devengos(); */


				porcentajes_isss_afp();
	
			
			}
		});

};


/*=============================================
obtener data total 
=============================================*/
function obtenerdata_total(codigo1,id1,nombre1){

	obtener_horas();
	var numero_planilladevengo_vacacion=$("#numero_planilladevengo_vacacion").val();


	var accion_realizar = "obtenerdatatotal";
	var idabase = codigo1;
	var dataString = 'consultarempleado=' +id1+'&numero_planilladevengo_vacacion=' +numero_planilladevengo_vacacion+'&accion01=' +accion_realizar;


		$.ajax({
			
			url: "ajax/planilladevengo_vacacion.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
				var datos = JSON.parse(response);
				console.log(response);
				console.log(datos[0].id_empleado_planilladevengo_vacacion);

				var dias_trabajado="";
				if(datos[0].dias_trabajo_planilladevengo_vacacion==""){
					dias_trabajado="15"
				}
				else{
					dias_trabajado=datos[0].dias_trabajo_planilladevengo_vacacion;
				}
				$("#dias_trabajo_planilladevengo_vacacion").val(dias_trabajado);

				$("#dias_incapacidad").val(datos[0].dias_incapacidad);

				if(datos[0].sueldo_planilladevengo_vacacion!=""){
					$("#sueldo_planilladevengo_vacacion").val(datos[0].sueldo_planilladevengo_vacacion);
				}

				if(datos[0].otro_devengo_vacacion_planilladevengo_vacacion!=""){
					$("#otro_devengo_vacacion_planilladevengo_vacacion").val(datos[0].otro_devengo_vacacion_planilladevengo_vacacion);
				}
				if(datos[0].total_devengo_vacacion_planilladevengo_vacacion != ""){
					$("#total_devengo_vacacion_planilladevengo_vacacion").val(datos[0].total_devengo_vacacion_planilladevengo_vacacion);
				}

	
				if(datos[0].otro_devengo_vacacion_planilladevengo_vacacion=="" || datos[0].otro_devengo_vacacion_planilladevengo_vacacion=="NaN"){
					$("#otro_devengo_vacacion_planilladevengo_vacacion").val("0");
				}
				else{
					$("#otro_devengo_vacacion_planilladevengo_vacacion").val(datos[0].otro_devengo_vacacion_planilladevengo_vacacion);
				}
				if(datos[0].total_devengo_vacacion_planilladevengo_vacacion=="" || datos[0].total_devengo_vacacion_planilladevengo_vacacion=="NaN"){
					$("#total_devengo_vacacion_planilladevengo_vacacion").val("0");
				}
				else{
					$("#total_devengo_vacacion_planilladevengo_vacacion").val(datos[0].total_devengo_vacacion_planilladevengo_vacacion);
				}
				if(datos[0].descuento_isss_planilladevengo_vacacion=="" || datos[0].descuento_isss_planilladevengo_vacacion=="NaN"){
					$("#descuento_isss_planilladevengo_vacacion").val("0");
				}
				else{
					$("#descuento_isss_planilladevengo_vacacion").val(datos[0].descuento_isss_planilladevengo_vacacion);
				}
				if(datos[0].descuento_afp_planilladevengo_vacacion=="" || datos[0].descuento_afp_planilladevengo_vacacion=="NaN"){
					$("#descuento_afp_planilladevengo_vacacion").val();
				}
				else{
					$("#descuento_afp_planilladevengo_vacacion").val(datos[0].descuento_afp_planilladevengo_vacacion);

				}
				if(datos[0].descuento_renta_planilladevengo_vacacion=="" || datos[0].descuento_renta_planilladevengo_vacacion=="NaN"){
					$("#descuento_renta_planilladevengo_vacacion").val("0");
				}
				else{
					$("#descuento_renta_planilladevengo_vacacion").val(datos[0].descuento_renta_planilladevengo_vacacion);

				}
				if(datos[0].otro_descuento_planilladevengo_vacacion=="" || datos[0].otro_descuento_planilladevengo_vacacion=="NaN"){
					$("#otro_descuento_planilladevengo_vacacion").val("0");

				}
				else{
					$("#otro_descuento_planilladevengo_vacacion").val(datos[0].otro_descuento_planilladevengo_vacacion);

				}
				if(datos[0].total_descuento_planilladevengo_vacacion=="" || datos[0].total_descuento_planilladevengo_vacacion=="NaN"){
					$("#total_descuento_planilladevengo_vacacion").val("0");

				}
				else{
					$("#total_descuento_planilladevengo_vacacion").val(datos[0].total_descuento_planilladevengo_vacacion);
				}

				if(datos[0].total_descuento_planilladevengo_vacacion != "")
				{
					$("#total_descuento_planilladevengo_vacacion").val(datos[0].total_descuento_planilladevengo_vacacion);
				}
				if(datos[0].total_liquidado_planilladevengo_vacacion != ""){
					$("#total_liquidado_planilladevengo_vacacion").val(datos[0].total_liquidado_planilladevengo_vacacion);
				}
				
				if(datos[0].sueldo_renta_planilladevengo_vacacion==""){
					$("#sueldo_renta_planilladevengo_vacacion").val("0");
				}
				else{
					$("#sueldo_renta_planilladevengo_vacacion").val(datos[0].sueldo_renta_planilladevengo_vacacion);
				}
				$("#sueldo_isss_planilladevengo_vacacion").val(datos[0].sueldo_isss_planilladevengo_vacacion);
				$("#sueldo_afp_planilladevengo_vacacion").val(datos[0].sueldo_afp_planilladevengo_vacacion);
				$("#observacion_planilladevengo_vacacion").val(datos[0].observacion_planilladevengo_vacacion);
			
						
					var idempleado=$("#id_empleado_planilladevengo_vacacion").val();
					cargarporcentajes(idempleado);
				



			}
		})


		

}


	/* DEVENGO
******************************* */
$( ".tipo_devengo_descuento_planilla" ).change(function(){ 
	var codigo = $('option:selected', this).attr('codigo');
	var descripcion = $('option:selected', this).attr('descripcion');
	$(".codigo_devengo_descuento_planilla").val(codigo);
	$(".descripcion_devengo_descuento_planilla").val(descripcion);



});

$( ".isss_devengo_devengo_descuento_planilla" ).change(function(){ 
	var valor= $(this).val();
	if(valor=="Si"){
		$(".porcentaje_isss_devengo_descuento_planilla").val("0.10");
	}
	else{
		$(".porcentaje_isss_devengo_descuento_planilla").val("");
	}
});

$( ".afp_devengo_devengo_descuento_planilla" ).change(function(){ 
	var valor= $(this).val();
	if(valor=="Si"){
		$(".porcentaje_afp_devengo_descuento_planilla").val("0.10");
	}
	else{
		$(".porcentaje_afp_devengo_descuento_planilla").val("");
	}
});

$( ".renta_devengo_devengo_descuento_planilla" ).change(function(){ 
	var valor= $(this).val();
	if(valor=="Si"){
		$(".porcentaje_renta_devengo_descuento_planilla").val("0.10");
	}
	else{
		$(".porcentaje_renta_devengo_descuento_planilla").val("");

	}
});


$( ".mostrar_devengo_vacacion" ).on( "click", function() {
	var tipo = $(this).attr("tipo");
	if(tipo=="Suma"){
		cargardatadevengo(tipo);
		$(".tipodescuento").removeClass("mi-selector");
		$(".tipodevengo").addClass("mi-selector");
        $('.mi-selector').select2();
	}
	else{
		cargardatadescuento(tipo);
		
		$(".tipodevengo").removeClass("mi-selector");
		$(".tipodescuento").addClass("mi-selector");
        $('.mi-selector').select2();
	}
  });

/* consultar datos de devengo y descuentos por empleado */
function cargardatadevengo(tipo){

	var numero_planilla=$("#numero_planilladevengo_vacacion").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	var tipo = tipo;
	var sueldo = $(".mostrar_devengo_vacacion").attr("sueldo");
	var accion="consultard"
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_vacacion.ajax.php",
		type: 'post',
		success: function (response) {
			console.log(response);
			 $(".devengodelempleado").empty();
			 $(".devengodelempleado").append(response);


			 $(".tablas").on("click", ".modificar", function(){
				var id = $(this).attr("id");
				editardevengo(id);
			})
			$(".tablas").on("click", ".eliminar", function(){
				var id = $(this).attr("id");
				var idempleado_devengo=$(this).attr("idempleado_devengo");
				eliminardevengo_vacacion(id, idempleado_devengo);
			})
			$('.tablas').DataTable();

			empleados_descuentos();
			/* empleados_devengos(); */
			

		}
	});
	/* ********* */
};

/* consultar datos de devengo y descuentos por empleado */
function cargardatadescuento(tipo){

	var numero_planilla=$("#numero_planilladevengo_vacacion").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	var tipo = tipo;
	var sueldo = $(".mostrar_devengo_vacacion").attr("sueldo");
	var accion="consultard"
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_vacacion.ajax.php",
		type: 'post',
		success: function (response) {
			console.log(response);
			 $(".descuentos_empleado_nativa").empty();
			 $(".descuentos_empleado_nativa").append(response);


			 $(".tablas").on("click", ".modificar", function(){
				var id = $(this).attr("id");
				editardevengo(id);
			})
			$(".tablas").on("click", ".eliminar", function(){
				var id = $(this).attr("id");
				var idempleado_devengo=$(this).attr("idempleado_devengo");
				eliminardevengo_vacacion(id, idempleado_devengo);
			})
			$('.tablas').DataTable();

			empleados_descuentos();
			/* empleados_devengos(); */
			

		}
	});
	/* ********* */
};


$(".guardardevengo").click(function(){
	

	var id = $(".id_devengo").val();
	var codigo_devengo_descuento_planilla = $(".codigo_devengo_descuento_planilla").val();
	var descripcion_devengo_descuento_planilla = $(".descripcion_devengo_descuento_planilla").val();
	var tipo_devengo_descuento_planilla = $(".tipo_devengo_descuento_planilla").val();
	var isss_devengo_devengo_descuento_planilla = $(".isss_devengo_devengo_descuento_planilla").val();
	var afp_devengo_devengo_descuento_planilla = $(".afp_devengo_devengo_descuento_planilla").val();
	var renta_devengo_devengo_descuento_planilla = $(".renta_devengo_devengo_descuento_planilla").val();
	var porcentaje_isss_devengo_descuento_planilla = $(".porcentaje_isss_devengo_descuento_planilla").val();
	var porcentaje_afp_devengo_descuento_planilla = $(".porcentaje_afp_devengo_descuento_planilla").val();
	var porcentaje_renta_devengo_descuento_planilla = $(".porcentaje_renta_devengo_descuento_planilla").val();
	var idempleado_devengo = $(".idempleado_devengo").val();

	var valor_devengo_planilla = "";

	
	var accionaccion_devengo = $(".accion_devengo").val();
	var tipo_valor = $(".tipo_valor").val();
	var codigo_planilla_devengo = $(".codigo_planilla_devengo").val();

	if($.trim(tipo_valor)=="Suma"){
		tipo_valor="+Suma";
	}


	if(tipo_valor=="+Suma"){
		var valor_devengo_planilla = $(".valor_devengo_planilla").val();
	}
	else{
		var valor_devengo_planilla = $(".valor_devengo_planilla1").val();
	}

	if(tipo_devengo_descuento_planilla==""){
		tipo_devengo_descuento_planilla=$(".tipodescuento").val();
	}

	/* ******************* */

	var dataString = 'id='+id+
					'&codigo_devengo_descuento_planilla='+codigo_devengo_descuento_planilla+
					'&descripcion_devengo_descuento_planilla='+descripcion_devengo_descuento_planilla+
					'&tipo_devengo_descuento_planilla='+tipo_devengo_descuento_planilla+
					'&isss_devengo_devengo_descuento_planilla='+isss_devengo_devengo_descuento_planilla+
					'&afp_devengo_devengo_descuento_planilla='+afp_devengo_devengo_descuento_planilla+
					'&renta_devengo_devengo_descuento_planilla='+renta_devengo_devengo_descuento_planilla+
					'&porcentaje_isss_devengo_descuento_planilla='+porcentaje_isss_devengo_descuento_planilla+
					'&porcentaje_afp_devengo_descuento_planilla='+porcentaje_afp_devengo_descuento_planilla+
					'&porcentaje_renta_devengo_descuento_planilla='+porcentaje_renta_devengo_descuento_planilla+
					'&idempleado_devengo='+idempleado_devengo+
					'&valor_devengo_planilla='+valor_devengo_planilla+
					'&tipo_valor='+tipo_valor+
					'&codigo_planilla_devengo='+codigo_planilla_devengo+
					'&accion01='+accionaccion_devengo;

		
	if(valor_devengo_planilla==""){

		swal({
			type: "warning",
			title: "Los datos no puedes ir vacios",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function (result) {
			if (result.value) {
				/* window.location = "situacion"; */
				
				/* location.reload(); */

				actualizar_datos();
				$('.modales').modal('hide');


			}
		});


	}
	else{
		/* ********** */		
		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_vacacion.ajax.php",
			type: 'post',
			success: function (response) {
				var valorliquido=$(".originalliquido").val();
	/* 			if(tipo_valor=="+Suma"){
					$("#total_liquidado_planilladevengo_vacacion").val(parseFloat(valorliquido)+parseFloat(valor_devengo_planilla));
					$("#otro_devengo_vacacion_planilladevengo_vacacion").val();
				}

				if(tipo_valor=="-Resta"){
					$("#total_liquidado_planilladevengo_vacacion").val(parseFloat(valorliquido)-parseFloat(valor_devengo_planilla));
					$("#otro_devengo_vacacion_planilladevengo_vacacion").val();
				} */
			

				console.log(response);
				swal({
					type: "success",
					title: "Guardado con Exito",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function (result) {
					if (result.value) {
						/* window.location = "situacion"; */

						
						guardarplanillaoculto();

						
				
						actualizar_datos();

						vaciar();
						/* location.reload(); */
			
						$('.modales').modal('hide');


					}
				});


			}
		});
		/* ********* */
	}
});


/*=============================================
EDITAR 
=============================================*/
function editardevengo(id1){


	$("#accion_devengo").val("modificardevengo");
	var id = id1;
	var accion_realizar="obtenerdatadevengo";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo_vacacion.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
				var datos = JSON.parse(response);
				$(".id_devengo").val(id);
				$(".codigo_devengo_descuento_planilla").val(datos[0].codigo_devengo_descuento_planilla);
				$(".descripcion_devengo_descuento_planilla").val(datos[0].descripcion_devengo_descuento_planilla);
				/* $(".tipo_devengo_descuento_planilla").val(datos[0].tipo_devengo_descuento_planilla); */
				$(".tipo_devengo_descuento_planilla").val(datos[0].tipo_devengo_descuento_planilla).trigger('change.select2');;
				$(".isss_devengo_devengo_descuento_planilla").val(datos[0].isss_devengo_devengo_descuento_planilla);
				$(".afp_devengo_devengo_descuento_planilla").val(datos[0].afp_devengo_devengo_descuento_planilla);
				$(".renta_devengo_devengo_descuento_planilla").val(datos[0].renta_devengo_devengo_descuento_planilla);
				$(".porcentaje_isss_devengo_descuento_planilla").val(datos[0].porcentaje_isss_devengo_descuento_planilla);
				$(".porcentaje_afp_devengo_descuento_planilla").val(datos[0].porcentaje_afp_devengo_descuento_planilla);
				$(".porcentaje_renta_devengo_descuento_planilla").val(datos[0].porcentaje_renta_devengo_descuento_planilla);
				$(".idempleado_devengo").val(datos[0].idempleado_devengo);
				$(".valor_devengo_planilla").val(datos[0].valor_devengo_planilla);
				$(".valor_devengo_planilla1").val(datos[0].valor_devengo_planilla);
				$(".tipo_valor").val(datos[0].tipo_valor);
				$(".accion_devengo").val("modificardevengo");
			}
		});



};

function eliminardevengo_vacacion(id1, idempleado){
	var id = id1;
	var accion_realizar="eliminardevengo";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar+'&idempleado='+idempleado;

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
	
			$.ajax({
				url: "ajax/planilladevengo_vacacion.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					console.log(response);
					/* location.reload(); */
				
					actualizar_datos();

					$('.modales').modal('hide');
					

				}
			});
	
		}
	
	  })
		



};

/* consultar datos de devengo y descuentos de la tabla empleados_devengos_descuentos */
function empleados_devengos(){

	var numero_planilla=$("#numero_planilladevengo_vacacion").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	/* var tipo = $(".mostrar_devengo_vacacion").attr("tipo"); */
	var tipo = "suma";
	var sueldo = $(".mostrar_devengo_vacacion").attr("sueldo");

	var accion="consultardevengosexistentes";
	


	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_vacacion.ajax.php",
		type: 'post',
		success: function (response) {
			console.log(response);
			 $(".empleados_devengos_descuentos").empty();
			 $(".empleados_devengos_descuentos").append(response); 

			 $(".tablas").on("click", ".modificarempleadosdevengosdescuentos", function(){
				var id = $(this).attr("id");
				editardevengoempleadosdevengosdescuentos(id);
			})
			$(".tablas").on("click", ".eliminar_empleados_devengos_descuentos", function(){
				var id = $(this).attr("id");
				eliminarempleados_devengos_descuentos(id);
			})
			$('.tablas').DataTable();

			/* sumar(); */
		}
	});
	/* ********* */
};

/* consultar datos de devengo y descuentos de la tabla empleados_devengos_descuentos */
function empleados_descuentos(){

	var numero_planilla=$("#numero_planilladevengo_vacacion").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	/* var tipo = "$(".mostrar_devengo_vacacion").attr("tipo")"; */
	var tipo = "resta";

	var sueldo = $(".mostrar_devengo_vacacion").attr("sueldo");

	var accion="consultardevengosexistentes";


	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_vacacion.ajax.php",
		type: 'post',
		success: function (response) {
			console.log(response);
			 $(".descuentos_empleados_original").empty();
			 $(".descuentos_empleados_original").append(response); 

			 




			 $(".tablas").on("click", ".modificarempleadosdevengosdescuentos", function(){
				var id = $(this).attr("id");
				editardevengoempleadosdevengosdescuentos(id);
			})
			$(".tablas").on("click", ".eliminar_empleados_devengos_descuentos", function(){
				var id = $(this).attr("id");
				eliminarempleados_devengos_descuentos(id);
			})
			$('.tablas').DataTable();

			/* sumar(); */
		}
	});
	/* ********* */
};



/* EDITAR DEVENGO DE LA TABLA empleados_devengos_descuentos*/

function editardevengoempleadosdevengosdescuentos(id1){

	$("#accion_devengo").val("modificarempleados_devengos_descuentos");
	var id = id1;
	var accion_realizar="obtenerdataempleados_devengos_descuentos";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo_vacacion.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
				var datos = JSON.parse(response);
				console.log(response);
				console.log(datos[0].id_empleado_planilladevengo_vacacion);
				$(".id_devengo").val(id);
				$("#valor_devengo_planilla").val(datos[0].valor)
			}
		});



};


/* eliminar DEVENGO DE LA TABLA empleados_devengos_descuentos*/

function eliminarempleados_devengos_descuentos(id1){
	var id = id1;
	var accion_realizar="eliminarempleados_devengos_descuentos";
	var numero_planilladevengo_vacacion=$("#numero_planilladevengo_vacacion").val();
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar+'&numero_planilladevengo_vacacion='+numero_planilladevengo_vacacion;

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
	
			$.ajax({
				url: "ajax/planilladevengo_vacacion.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					console.log(response);
					$('#myModal').modal('hide');
					setTimeout(function(){
						actualizar_datos();
					}, 1500);
					/* actualizar_datos(); */
					/* console.log(response);
					$('#myModal').modal('toggle'); */
				}
			});
	
		}
	
	  })
		



};



function vaciar(){
	
	$(".codigo_devengo_descuento_planilla").val("");
	$(".descripcion_devengo_descuento_planilla").val("");
	$(".tipo_devengo_descuento_planilla").val("");
    $(".isss_devengo_devengo_descuento_planilla").val("");
	$(".afp_devengo_devengo_descuento_planilla").val("");
	$(".renta_devengo_devengo_descuento_planilla").val("");
	$(".porcentaje_isss_devengo_descuento_planilla").val("");
	$(".porcentaje_afp_devengo_descuento_planilla").val("");
	$(".porcentaje_renta_devengo_descuento_planilla").val("");
	$(".valor_devengo_planilla").val("");
	$(".valor_devengo_planilla1").val("");
}

function calculos(id, sueldo){

	var id = id;
	var accion_realizar="calculos";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;
	

		$.ajax({
			
			url: "ajax/planilladevengo_vacacion.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
			
				var datos = JSON.parse(response);
				/* $("#id").val(id); */
				/* RENTA**************** */
				var base_2 = datos[0].base_2;
				var base_1 = datos[0].base_1;
				var sueldo_menos_base= sueldo-base_2;
				var tasa_por_exedente=sueldo_menos_base*0.10;
				var descuento_renta=tasa_por_exedente+base_1;
				var descuenta_renta_final=sueldo-descuento_renta;
				/* $("#sueldo_renta_planilladevengo_vacacion").val(descuento_renta); */
				/* RENTA**************** */


			/* 	alert(descuento_renta); */

				
			
				/* var isss_devengo_vacacion_devengo_vacacion_descuento_planilla = datos[0].isss_devengo_vacacion_devengo_vacacion_descuento_planilla;
				var afp_devengo_vacacion_devengo_vacacion_descuento_planilla = datos[0].afp_devengo_vacacion_devengo_vacacion_descuento_planilla;
				var renta_devengo_vacacion_devengo_vacacion_descuento_planilla = datos[0].renta_devengo_vacacion_devengo_vacacion_descuento_planilla;
				var porcentaje_renta_devengo_vacacion_descuento_planilla = datos[0].porcentaje_renta_devengo_vacacion_descuento_planilla;
				var porcentaje_isss_devengo_vacacion_descuento_planilla = datos[0].porcentaje_isss_devengo_vacacion_descuento_planilla;
				var porcentaje_afp_devengo_vacacion_descuento_planilla = datos[0].porcentaje_afp_devengo_vacacion_descuento_planilla;
				var total_devengo_vacacion_planilladevengo_vacacion= $("#total_devengo_vacacion_planilladevengo_vacacion").val(); */
				
			}
		});


}


$( ".valor_devengo_planilla" ).blur(function() {


	
	/* ******* */
	var sujeto_renta_calculos=$("#totalsujetorenta").val();
	var sujeto_isss_calculos=$("#totalsujetoisss").val();
	var sujeto_afp_calculos=$("#totalsujetoafp").val();
	if(sujeto_afp_calculos=="NaN"){
		sujeto_afp_calculos=0;
	}
	/* ******** */

	var idempleado = $(this).attr("idempleado");
	var accion_realizar="calculosisss";
	var renta_devengo= $(".renta_devengo_devengo_descuento_planilla").val();
	var afp_devengo=$(".afp_devengo_devengo_descuento_planilla").val();
	var isss_devengo=$(".isss_devengo_devengo_descuento_planilla").val();
	var valor_devengo=$(".valor_devengo_planilla").val();
	var sueldo_afp=$("#sueldo_afp_planilladevengo_vacacion").val();
	var valor_devengo_planilla=valor_devengo;


	
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla;
	

	$.ajax({
			
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			var valorliquido=$(".originalliquido").val();

			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];

			
			$("#porcentaje_isss").val(porcentaje_isss);
			$("#porcentaje_afp").val(porcentaje_afp);
			$("#porcentaje_base1").val(porcentaje_base1);
			$("#porcentaje_base2").val(porcentaje_base2);
			$("#tasa_sobre_excedente").val(tasa_sobre_excedente);


			var calcularporcentaje=porcentaje_afp/100;/* --afp */
			var calcularporcentaje_isss=porcentaje_isss/100;

			var tope_isss=$("#tope_isss").val();

		
	
			var total_afp=0;
			if(afp_devengo=="Si"){
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuento_afp_final=valor_devengo_planilla-total_afp;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				
				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_vacacion").val(calculo_afp);

				/* $("#total_liquidado_planilladevengo_vacacion").val(descuento_afp_final+Number(valorliquido)); */
			}
			
			if(isss_devengo=="Si"){
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				descuento_iss_final=valor_devengo_planilla-total_isss;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}

				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);

				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_vacacion").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_vacacion").val(calculo_isss);
				}


				/* $("#total_liquidado_planilladevengo_vacacion").val(descuento_iss_final+Number(valorliquido)); */
			}
			
			if(renta_devengo=="Si"){
				var sueldo_menos_base= valor_devengo_planilla-porcentaje_base2;
				var tasa_por_exedente=sueldo_menos_base*0.10;
				var descuento_renta=tasa_por_exedente+porcentaje_base1;
				var descuento_renta_final=valor_devengo_planilla-descuento_renta;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_vacacion").val(descuento_renta_final+Number(valorliquido)); */


			}
			

			if(afp_devengo=="Si"&&isss_devengo=="Si"){
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuentos_realizar=valor_devengo_planilla-total_isss-total_afp;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_vacacion").val(descuentos_realizar+Number(valorliquido)); */
				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);
				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_vacacion").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_vacacion").val(calculo_isss);
				}
				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_vacacion").val(calculo_afp);
			}
			

			if(afp_devengo=="Si"&&renta_devengo=="Si"){
				
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuentos_realizar_afp=valor_devengo_planilla-total_afp;

				var sueldo_menos_base= valor_devengo_planilla-porcentaje_base2;
				var tasa_por_exedente=sueldo_menos_base*0.10;
				var descuento_renta=parseFloat(tasa_por_exedente)+parseFloat(porcentaje_base1);

				descuento_afp_renta=parseFloat(descuentos_realizar_afp)-parseFloat(descuento_renta);


				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_vacacion").val(descuento_afp_renta+Number(valorliquido)); */

				
				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_vacacion").val(calculo_afp);

				console.log(total_afp+"total_afp");
				console.log(descuentos_realizar_afp+"descuentos_realizar_afp");
				console.log(descuento_renta+"descuento_renta");
				console.log(descuento_afp_renta+"descuento_afp_renta");
				console.log(Number(valorliquido)+"valorliquido");


			}
			

			if(isss_devengo=="Si"&&renta_devengo=="Si"){


				
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				descuentos_realizar_isss=valor_devengo_planilla-total_isss;

				var sueldo_menos_base= parseFloat(valor_devengo_planilla)-porcentaje_base2;
				var tasa_por_exedente=parseFloat(sueldo_menos_base)*0.10;
				var descuento_renta=parseFloat(tasa_por_exedente)+parseFloat(porcentaje_base1);

				descuento_isss_renta=parseFloat(descuentos_realizar_isss)-parseFloat(descuento_renta);

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_vacacion").val(descuento_isss_renta+Number(valorliquido)); */
				
				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);
				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_vacacion").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_vacacion").val(calculo_isss);
				}


				console.log(valor_devengo_planilla+"total_isss");
				console.log(total_isss+"total_isss");
				console.log(descuentos_realizar_isss+"descuentos_realizar_isss");
				console.log(descuento_isss_renta+"descuento_isss_renta");
			}
		

			if(afp_devengo=="Si" && isss_devengo=="Si" && renta_devengo=="Si"){

		
				
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				total_afp=valor_devengo_planilla*calcularporcentaje;

				descuentos_realizar=valor_devengo_planilla-total_isss-total_afp;

				var sueldo_menos_base= valor_devengo_planilla-porcentaje_base2;
				var tasa_por_exedente=parseFloat(sueldo_menos_base)*0.10;
				var descuento_renta=parseFloat(tasa_por_exedente)+parseFloat(porcentaje_base1);

				descuento_isss_afp_renta=parseFloat(descuentos_realizar)-parseFloat(descuento_renta);

			
				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_vacacion").val(descuento_isss_afp_renta+Number(valorliquido)); */

				
				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);
				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_vacacion").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_vacacion").val(calculo_isss);
				}
				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_vacacion").val(calculo_afp);



				console.log("********************************");

				console.log(valor_devengo_planilla+"-valor devengo_vacacion");
				console.log(calcularporcentaje_isss+"-isss");
				console.log(calcularporcentaje+"-afp");
				console.log(porcentaje_base2+"-base2");
				console.log(porcentaje_base1+"-base1");
				console.log(descuento_renta+"renta");

				console.log(tasa_por_exedente+"tasa_por_exedente");
				console.log(total_isss+"total isss");
				console.log(total_afp+"total afp");
				console.log(descuentos_realizar+"descuentos isss afp");
				console.log(descuento_isss_afp_renta+"total iss afp renta");
				console.log(Number(valorliquido)+"valorliquido");
		


			}
			else{

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_vacacion").val(Number(valor_devengo_planilla)+Number(valorliquido)); */
			}
		

	
			

		}
	});


  });

$(".tipo_devengo_descuento_planilla").change(function(){

	var renta_devengo = $('option:selected', this).attr('renta_devengo');
	var afp_devengo = $('option:selected', this).attr('afp_devengo');
	var isss_devengo = $('option:selected', this).attr('isss_devengo');
	var tipo_valor = $('option:selected', this).attr('tipo_valor');

	var codigo = $('option:selected', this).attr('codigo');


	$(".renta_devengo_devengo_descuento_planilla").val(renta_devengo);
	$(".afp_devengo_devengo_descuento_planilla").val(afp_devengo);
	$(".isss_devengo_devengo_descuento_planilla").val(isss_devengo);
	$(".tipo_valor").val(tipo_valor);


	if(codigo=="0002"){
		/* $("#valor_devengo_planilla").attr("readonly","readonly"); */
		swal({
			type: "warning",
			title: "Los viaticos no pueden ser agregados",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function (result) {
			if (result.value) {
				/* window.location = "situacion"; */
				location.reload();
				$('.modales').modal('hide');


			}
		});

	}
	else{
		$("#valor_devengo_planilla").removeAttr("readonly");

	}

	if(codigo=="0024")
	{
		var tipo = $(".mostrar_devengo_vacacion").attr("tipo");

		var sueldo = $(".mostrar_devengo_vacacion").attr("sueldo");
		consultarviaticos(tipo,sueldo);
		/* $(".valor_devengo_planilla").attr("readonly","readonly"); */

		
	}
	else {
		$(".valor_devengo_planilla").removeAttr("readonly");
		$(".valor_devengo_planilla").val("");


	}


});


/* consulta de viatico por empleado y calculo para devengo_vacacion */
function consultarviaticos(tipo,sueldo){

	
	var numero_planilla=$("#numero_planilladevengo_vacacion").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();

	var accion="consultarviatico"
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;


	$.ajax({
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
				var datos = JSON.parse(response);
				/* var descripcion_devengo_descuento_planilla = datos[0].descripcion_devengo_descuento_planilla; */
				var valor_devengo_planilla = datos[0].valor;
				/* var index = descripcion_devengo_descuento_planilla.indexOf("VIATICOS");
				if(index >= 0) {
				}
				else{
					valor_devengo_planilla=0;
				} */

				

				/* var suma_valor=0;
				$('.empleados_devengos_descuentos').find('td:nth-child(3)').each(function(){
					suma_valor+=+($(this).text());
				});
				if(suma_valor==""){
					suma_valor=0;
				} */
				var suma_sueldo_viatiaco=parseFloat(sueldo)+parseFloat(valor_devengo_planilla);/* --calcular devengo_vacacion */
				var total_devengo_vacacion=suma_sueldo_viatiaco*0.30;/* --devengo_vacacion */
				$(".valor_devengo_planilla").val(total_devengo_vacacion.toFixed(2));
				$("#devengodevengo_vacacion").val(total_devengo_vacacion.toFixed(2));
	
		}
	});
	/* ********* */
};

function porcentajes_isss_afp(){

	var idempleado = $(".valor_devengo_planilla").attr("idempleado");
	var accion_realizar="calculosisss";
	var renta_devengo= $(".renta_devengo_devengo_descuento_planilla").val();
	var afp_devengo=$(".afp_devengo_devengo_descuento_planilla").val();
	var isss_devengo=$(".isss_devengo_devengo_descuento_planilla").val();
	var valor_devengo_planilla=$(".valor_devengo_planilla").val();
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla;
	$.ajax({
			
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			var valorliquido=$(".originalliquido").val();
			
			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];

			var calcularporcentaje=porcentaje_afp/100;/* --afp */
			var calcularporcentaje_isss=porcentaje_isss/100;

			$("#porcentajeafp").val(calcularporcentaje);
			$("#porcentajeisss").val(calcularporcentaje_isss);
		}
	})
}


function valor_devengo_vacacion(){
	var idempleado = $(".valor_devengo_planilla").attr("idempleado");
	var accion_realizar="valordevengo_vacacion";
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar;
	$.ajax({
			
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			console.log(response);
			var valor_devengo_planilla="";
			if(valor_devengo_planilla!=""){
				var valor_devengo_planilla = response.split(",")[0];
			}
			else{
				valor_devengo_planilla="0";
			}
			$("#devengodevengo_vacacion").val(valor_devengo_planilla);
		}
	})

}


$( "#hora_extra_diurna_planilladevengo_vacacion").blur(function() {
var valor= $(this).val();
var clase_calculo=$(this).attr("calculo");
var precio_hora=$("#hora_extra_diurna").val();
var calculo=parseFloat(valor)*parseFloat(precio_hora);
$("."+clase_calculo).val(calculo.toFixed(2));
});
$( "#hora_extra_nocturna_planilladevengo_vacacion").blur(function() {
	var valor= $(this).val();
	var clase_calculo=$(this).attr("calculo");
	var precio_hora=$("#hora_extra_nocturna").val();
	var calculo=parseFloat(valor)*parseFloat(precio_hora);
	$("."+clase_calculo).val(calculo.toFixed(2));
});
$( "#hora_extra_domingo_planilladevengo_vacacion").blur(function() {
	var valor= $(this).val();
	var clase_calculo=$(this).attr("calculo");
	var precio_hora=$("#hora_extra_domingo").val();
	var calculo=parseFloat(valor)*parseFloat(precio_hora);
	$("."+clase_calculo).val(calculo.toFixed(2));
});
$( "#hora_extra_domingo_nocturna_planilladevengo_vacacion").blur(function() {
	var valor= $(this).val();
	var clase_calculo=$(this).attr("calculo");
	var precio_hora=$("#hora_extra_nocturna_domingo").val();
	var calculo=parseFloat(valor)*parseFloat(precio_hora);
	$("."+clase_calculo).val(calculo.toFixed(2));
});



function calculo_horas(){

	var hora_extra=$("#hora_extra_diurna_planilladevengo_vacacion").val();
	var hora_extra_nocturna=$("#hora_extra_nocturna_planilladevengo_vacacion").val();
	var hora_extra_domingo=$("#hora_extra_domingo_planilladevengo_vacacion").val();
	var hora_extra_domingo_noc=$("#hora_extra_domingo_nocturna_planilladevengo_vacacion").val();

	var precio_hora=$("#salario_por_hora").val();

	var precio_hora_extra_diurna=$("#hora_extra_diurna").val();
	var precio_hora_extra_nocturna= $("#hora_extra_nocturna").val();
	var precio_hora_extra_domingo= $("#hora_extra_domingo").val();
	var precio_hora_extra_nocturna_domingo=$("#hora_extra_nocturna_domingo").val();

	var calculo_extra=parseFloat(hora_extra)*parseFloat(precio_hora_extra_diurna);
	var calculo_extra_nocturna=parseFloat(hora_extra_nocturna)*parseFloat(precio_hora_extra_nocturna);
	var calculo_extra_domingo=parseFloat(hora_extra_domingo)*parseFloat(precio_hora_extra_domingo);
	var calculo_extra_domingo_noc=parseFloat(hora_extra_domingo_noc)*parseFloat(precio_hora_extra_nocturna_domingo);


	$(".calculo_extra_diurna").val(calculo_extra.toFixed(2));
	$(".calculo_extra_nocturna").val(calculo_extra_nocturna.toFixed(2));
	$(".calculo_extra_domingo").val(calculo_extra_domingo.toFixed(2));
	$(".calculo_extra_domingo_noctu").val(calculo_extra_domingo_noc.toFixed(2));

}



$("#btnsumarhoras").click(function(){
	/* sumar(); */
	calcular_afp_iss();
})



function cargarporcentajes(idempleados){

	var sueldo_empleado=$("#sueldo_planilladevengo_vacacion").val();

	/* DEVENGOS */
	/* ********************* */
	var sum1 = 0;
	$('#devengodelempleado').find('td:nth-child(3)').each(function(){
		sum1 += +($(this).text());
	});
	$("#sumavalor2").val(sum1);
	/* DEVENGOS EMPLEADOS ORIGINAL */
	var sum = 0;
	$('#empleados_devengos_descuentos').find('td:nth-child(3)').each(function(){
		sum += +($(this).text());
	});
	$("#sumavalor").val(sum);
	$("#totalglobaldevengo").val(parseFloat(sum1)+parseFloat(sum));
	var totalglobaldevengo=$("#totalglobaldevengo").val();
	$("#otro_devengo_vacacion_planilladevengo_vacacion").val(totalglobaldevengo);
	/* ******************* */


	/* DESCUENTOS */
	/* ********************* */
	var sum_descuento_nativa = 0;
	$('.descuentos_empleado_nativa').find('td:nth-child(3)').each(function(){
		sum_descuento_nativa += +($(this).text());
	});
	$("#sum_descuento_nativa").val(sum_descuento_nativa);
	/* DESCUENTOS EMPLEADOS ORIGINAL */
	var sum_descuento_original = 0;
	$('.descuentos_empleados_original').find('td:nth-child(3)').each(function(){
		sum_descuento_original += +($(this).text());
	});
	$("#sum_descuento_original").val(sum_descuento_original);

	$("#totalglobaldescuento").val(parseFloat(sum_descuento_nativa)+parseFloat(sum_descuento_original));
	var totalglobaldescuento=$("#totalglobaldescuento").val();
	$("#otro_descuento_planilladevengo_vacacion").val(totalglobaldescuento);
	/* ******************* */
	



	/* ******************* */
		var sumaisss=0;
		var sumaafp=0;
		var sumarenta=0;

		$('#devengodelempleado').find('td:nth-child(3)').each(function(){
			var isss=$(this).attr("isss");
			var afp=$(this).attr("afp");
			var renta=$(this).attr("renta");

			if(isss=="Si"){
				sumaisss+=+($(this).text());
			}
			if(afp=="Si"){
				sumaafp+=+($(this).text());
			}
			if(renta=="Si"){
				sumarenta+=+($(this).text());
			}
		});
	/* ******************** */

	/* ******* */
	
	$("#valor_renta_original").val(sumarenta);
	$("#valor_isss_original").val(sumaisss);
	$("#valor_afp_original").val(sumaafp);

	var sujeto_renta_calculos=$("#totalsujetorenta").val();
	var sujeto_isss_calculos=$("#totalsujetoisss").val();
	var sujeto_afp_calculos=$("#totalsujetoafp").val();
	if(sujeto_afp_calculos=="NaN"){
		sujeto_afp_calculos=0;
	}
	/* ******** */
	var idempleado = idempleados;
	var accion_realizar="calculosisss";
	var suma_renta_sueldo=parseFloat(sumarenta)+parseFloat(sueldo_empleado);
	var suma_afp_sueldo=parseFloat(sumaafp)+parseFloat(sueldo_empleado);
	var suma_isss_sueldo=parseFloat(sumaisss)+parseFloat(sueldo_empleado);

	var tope_isss=$("#tope_isss").val();
	if(suma_isss_sueldo>=tope_isss){
		suma_isss_sueldo=tope_isss;
	}
	else{
		var suma_isss_sueldo=parseFloat(sumaisss)+parseFloat(sueldo_empleado);
	}



	var renta_devengo= $("#sueldo_renta_planilladevengo_vacacion").val(suma_renta_sueldo);
	var afp_devengo=$("#sueldo_afp_planilladevengo_vacacion").val(suma_afp_sueldo);
	
	if(suma_isss_sueldo>=tope_isss){
		suma_isss_sueldo=tope_isss;
	}
	
	var isss_devengo=$("#sueldo_isss_planilladevengo_vacacion").val(suma_isss_sueldo);
	/* var valor_devengo=$(".valor_devengo_planilla").val(); */
	var sueldo_afp=$("#sueldo_afp_planilladevengo_vacacion").val();
	var valor_devengo_planilla=sueldo_afp;

	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla;
	
	$.ajax({
			
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {

			var valorliquido=$(".originalliquido").val();

			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];
			var tasa_sobre_excedente = response.split(",")[4];

			if(porcentaje_isss==""){
				porcentaje_isss=0;
			}
			if(porcentaje_afp==""){
				porcentaje_afp=0;
			}
			if(porcentaje_base1==""){
				porcentaje_base1=0;
			}
			if(porcentaje_base2==""){
				porcentaje_base2=0;
			}
			if(tasa_sobre_excedente==""){
				tasa_sobre_excedente=0;
			}

			$("#porcentaje_isss").val(porcentaje_isss);
			$("#porcentaje_afp").val(porcentaje_afp);
			/* $("#porcentaje_base1").val(porcentaje_base1);
			$("#porcentaje_base2").val(porcentaje_base2);
			$("#tasa_sobre_excedente").val(tasa_sobre_excedente); */
			
			
			calcular_afp_iss();
			
			
			
			}
	})
}




function calcular_renta(){
	

	/* ********************PORCENTAJE PARA RENTA************************** */
	var idempleado=$("#txt_idempleado").val();
	var accion_realizar="calculosisss";
	var renta_devengo=total_descuento_renta.toFixed(2);
	var afp_devengo=$("#sueldo_afp_planilladevengo_vacacion").val();
	var isss_devengo=$("#sueldo_isss_planilladevengo_vacacion").val();


	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+total_descuento_renta;
	

	$.ajax({
			
		url: "ajax/planilladevengo_vacacion.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			

			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];
			var tasa_sobre_excedente = response.split(",")[4];

			if(porcentaje_isss==""){
				porcentaje_isss=0;
			}
			if(porcentaje_afp==""){
				porcentaje_afp=0;
			}
			if(porcentaje_base1==""){
				porcentaje_base1=0;
			}
			if(porcentaje_base2==""){
				porcentaje_base2=0;
			}
			if(tasa_sobre_excedente==""){
				tasa_sobre_excedente=0;
			}
			
			$("#porcentaje_base1").val(porcentaje_base1);
			$("#porcentaje_base2").val(porcentaje_base2);
			$("#tasa_sobre_excedente").val(tasa_sobre_excedente);
			/* alert(tasa_sobre_excedente); */

			}
	})


	/* *************************************************** */
}



function calcular_afp_iss(){

	var renta_devengo= $(".renta_devengo_devengo_descuento_planilla").val();
	var afp_devengo=$(".afp_devengo_devengo_descuento_planilla").val();
	var isss_devengo=$(".isss_devengo_devengo_descuento_planilla").val();



	
	var porcentaje_isss= $("#porcentaje_isss").val();
	var porcentaje_afp= $("#porcentaje_afp").val();

	var valor_devengo_planilla = $("#sueldo_afp_planilladevengo_vacacion").val();

	
	/* ************************* */
	var sueldo_empleado_final=$("#sueldo_planilladevengo_vacacion").val();
	if($.trim(sueldo_empleado_final)==""){
		sueldo_empleado_final=0;
	}
	if($.trim(sueldo_empleado_final)=="NaN"){
		sueldo_empleado_final=0;
	}
	var valor_renta_original=$("#valor_renta_original").val();
	var valor_isss_original=$("#valor_isss_original").val();
	var valor_afp_original=$("#valor_afp_original").val();

	var total_renta_salario=parseFloat(valor_renta_original)+parseFloat(sueldo_empleado_final);
	var total_isss_salario=parseFloat(valor_isss_original)+parseFloat(sueldo_empleado_final);
	var total_afp_salario=parseFloat(valor_afp_original)+parseFloat(sueldo_empleado_final);

	var tope_isss=$("#tope_isss").val();
	if(total_isss_salario>=tope_isss){
		total_isss_salario=tope_isss;
	}
	/* ************************* */

	/* var sueldo_isss_planilladevengo_vacacion=$("#sueldo_isss_planilladevengo_vacacion").val(); */

	var sueldo_isss_planilladevengo_vacacion=total_isss_salario;
	if(sueldo_isss_planilladevengo_vacacion>=tope_isss){
		sueldo_isss_planilladevengo_vacacion=tope_isss;
	}
	if(sueldo_isss_planilladevengo_vacacion==""){
		sueldo_isss_planilladevengo_vacacion=0;
	}
	if(sueldo_isss_planilladevengo_vacacion=="NaN"){
		sueldo_isss_planilladevengo_vacacion=0;
	}


	var calcularporcentaje=porcentaje_afp/100;/* --afp */
	var calcularporcentaje_isss=porcentaje_isss/100;



	/* Descuento AFP: */
	total_afp=parseFloat(total_afp_salario)*calcularporcentaje;
	descuento_afp_final=total_afp_salario-total_afp;
	$("#descuento_afp_planilladevengo_vacacion").val(total_afp.toFixed(2));



	/* Descuento ISSS: */
	total_isss= parseFloat(sueldo_isss_planilladevengo_vacacion)*calcularporcentaje_isss;
	descuento_iss_final=sueldo_isss_planilladevengo_vacacion-total_isss;
	$("#descuento_isss_planilladevengo_vacacion").val(total_isss.toFixed(2));


	/* Descuento Renta: */
	total_descuento_renta=parseFloat(total_renta_salario)-parseFloat(total_afp)-parseFloat(total_isss);
	if(total_renta_salario==0){
		total_descuento_renta=0;
	}
	$("#sueldo_renta_planilladevengo_vacacion").val(total_descuento_renta.toFixed(2));

	/* ****CALCULO RENTA**** */
	calcular_renta();
	
	var porcentaje_base1= $("#porcentaje_base1").val();
	var porcentaje_base2= $("#porcentaje_base2").val();
	var tasa_sobre_excedente= $("#tasa_sobre_excedente").val();
	var calcularporcentaje_tasa_excente=tasa_sobre_excedente/100;


	/* CALCULO RENTA */
	var sueldo_menos_base= parseFloat(total_descuento_renta)-parseFloat(porcentaje_base2);
	var tasa_por_exedente= parseFloat(sueldo_menos_base)*parseFloat(calcularporcentaje_tasa_excente);
	var descuento_renta=parseFloat(tasa_por_exedente)+parseFloat(porcentaje_base1);

	var descuento_renta_final=total_renta_salario-descuento_renta;

	$("#descuento_renta_planilladevengo_vacacion").val(descuento_renta.toFixed(2));


	console.log("************************");
	console.log(sueldo_menos_base+"sueldo_menos_base");
	console.log(tasa_por_exedente+"tasa_por_exedente");
	console.log(descuento_renta+"descuento_renta");

	/* ****************CUENTAS GLOBALES**************** */

	calculo_horas();
	/* calculo de horas****************** */
	var calculo_extra_diurna = $(".calculo_extra_diurna").val();
	var calculo_extra_nocturna = $(".calculo_extra_nocturna").val();
	var calculo_extra_domingo = $(".calculo_extra_domingo").val();
	var calculo_extra_domingo_noctu = $(".calculo_extra_domingo_noctu").val();
	var total_suma_horas=parseFloat(calculo_extra_diurna)+parseFloat(calculo_extra_nocturna)+parseFloat(calculo_extra_domingo)+parseFloat(calculo_extra_domingo_noctu);/* --CALCULO HORAS */



	var sueldo=$("#sueldo_planilladevengo_vacacion").val();/* --SUELDO */
	var otrodevengo=$("#otro_devengo_vacacion_planilladevengo_vacacion").val();/* --Otro Devengo: */

	$("#total_devengo_vacacion_planilladevengo_vacacion").val(parseFloat(sueldo)+parseFloat(otrodevengo)+parseFloat(total_suma_horas));
	var totaldevengo=$("#total_devengo_vacacion_planilladevengo_vacacion").val();/* --Total Devengado: */
	


	var descuento_isss_planilladevengo_vacacion=$("#descuento_isss_planilladevengo_vacacion").val();/* --Descuento ISSS: */
	var descuento_afp_planilladevengo_vacacion= $("#descuento_afp_planilladevengo_vacacion").val();/* --Descuento AFP: */
	var descuento_renta_planilladevengo_vacacion=$("#descuento_renta_planilladevengo_vacacion").val();/* --Descuento Renta: */
	var otro_descuento_planilladevengo_vacacion=$("#otro_descuento_planilladevengo_vacacion").val();/* --Otro Descuento: */

	calculototaldescuento=parseFloat(descuento_isss_planilladevengo_vacacion)+parseFloat(descuento_afp_planilladevengo_vacacion)+parseFloat(descuento_renta_planilladevengo_vacacion)+parseFloat(otro_descuento_planilladevengo_vacacion);


	$("#total_descuento_planilladevengo_vacacion").val(calculototaldescuento.toFixed(2));
	var totaldescuento=$("#total_descuento_planilladevengo_vacacion").val();/* --Total Descuento: */

	var calculototalliquido=parseFloat(totaldevengo)-parseFloat(totaldescuento);
	$("#total_liquidado_planilladevengo_vacacion").val(calculototalliquido.toFixed(2));
	var totalliquido=$("#total_liquidado_planilladevengo_vacacion").val();/* --Total Liquido: */



	guardarplanillaoculto();
}



$('.modales').on('hidden.bs.modal', function() {
/* 	setTimeout(function(){
		actualizar_datos();
	}, 1500);

	setTimeout(function(){
		$('.modal_carga').modal('toggle');	
	}, 2000); */
})


function sumar(){


	calculo_horas();
	/* calculo de horas****************** */
	var calculo_extra_diurna = $(".calculo_extra_diurna").val();
	var calculo_extra_nocturna = $(".calculo_extra_nocturna").val();
	var calculo_extra_domingo = $(".calculo_extra_domingo").val();
	var calculo_extra_domingo_noctu = $(".calculo_extra_domingo_noctu").val();
	var total_suma_horas=parseFloat(calculo_extra_diurna)+parseFloat(calculo_extra_nocturna)+parseFloat(calculo_extra_domingo)+parseFloat(calculo_extra_domingo_noctu);/* --CALCULO HORAS */



	/* DEVENGOS */
	/* ********************* */
	var sum1 = 0;
	$('#devengodelempleado').find('td:nth-child(3)').each(function(){
		sum1 += +($(this).text());
	});
	$("#sumavalor2").val(sum1);
	/* DEVENGOS EMPLEADOS ORIGINAL */
	var sum = 0;
	$('#empleados_devengos_descuentos').find('td:nth-child(3)').each(function(){
		sum += +($(this).text());
	});
	$("#sumavalor").val(sum);
	$("#totalglobaldevengo").val(parseFloat(sum1)+parseFloat(sum));
	var totalglobaldevengo=$("#totalglobaldevengo").val();
	$("#otro_devengo_vacacion_planilladevengo_vacacion").val(totalglobaldevengo);
	/* ******************* */

		/* DESCUENTOS */
	/* ********************* */
	var sum_descuento_nativa = 0;
	$('.descuentos_empleado_nativa').find('td:nth-child(3)').each(function(){
		sum_descuento_nativa += +($(this).text());
	});
	$("#sum_descuento_nativa").val(sum_descuento_nativa);
	/* DESCUENTOS EMPLEADOS ORIGINAL */
	var sum_descuento_original = 0;
	$('.descuentos_empleados_original').find('td:nth-child(3)').each(function(){
		sum_descuento_original += +($(this).text());
	});
	$("#sum_descuento_original").val(sum_descuento_original);

	$("#totalglobaldescuento").val(parseFloat(sum_descuento_nativa)+parseFloat(sum_descuento_original));
	var totalglobaldescuento=$("#totalglobaldescuento").val();
	$("#otro_descuento_planilladevengo_vacacion").val(totalglobaldescuento);
	/* ******************* */
	

	var sueldo=$("#sueldo_planilladevengo_vacacion").val();/* --SUELDO */
	var otrodevengo=$("#otro_devengo_vacacion_planilladevengo_vacacion").val();/* --Otro Devengo: */

	$("#total_devengo_vacacion_planilladevengo_vacacion").val(parseFloat(sueldo)+parseFloat(otrodevengo)+parseFloat(total_suma_horas));
	var totaldevengo=$("#total_devengo_vacacion_planilladevengo_vacacion").val();/* --Total Devengado: */

	var devengodevengo_vacacion=$("#devengodevengo_vacacion").val();
	var sujetoiss_afp= parseFloat(sueldo)+parseFloat(devengodevengo_vacacion);

	$("#sueldo_isss_planilladevengo_vacacion").val(sujetoiss_afp);
	$("#sueldo_afp_planilladevengo_vacacion").val(sujetoiss_afp);

	var porcentajeafp=$("#porcentajeafp").val();
	var porcentajeisss=$("#porcentajeisss").val();

	descuento_isss=parseFloat(sujetoiss_afp)*porcentajeisss;
	descuento_afp=parseFloat(sujetoiss_afp)*porcentajeafp;

	$("#descuento_isss_planilladevengo_vacacion").val(descuento_isss.toFixed(2));
	$("#descuento_afp_planilladevengo_vacacion").val(descuento_afp.toFixed(2));

	var descuento_isss_planilladevengo_vacacion=$("#descuento_isss_planilladevengo_vacacion").val();/* --Descuento ISSS: */
	var descuento_afp_planilladevengo_vacacion= $("#descuento_afp_planilladevengo_vacacion").val();/* --Descuento AFP: */
	var descuento_renta_planilladevengo_vacacion=$("#descuento_renta_planilladevengo_vacacion").val();/* --Descuento Renta: */
	var otro_descuento_planilladevengo_vacacion=$("#otro_descuento_planilladevengo_vacacion").val();/* --Otro Descuento: */

	calculototaldescuento=parseFloat(descuento_isss_planilladevengo_vacacion)+parseFloat(descuento_afp_planilladevengo_vacacion)+parseFloat(descuento_renta_planilladevengo_vacacion)+parseFloat(otro_descuento_planilladevengo_vacacion);

	$("#total_descuento_planilladevengo_vacacion").val(calculototaldescuento.toFixed(2));
	var totaldescuento=$("#total_descuento_planilladevengo_vacacion").val();/* --Total Descuento: */

	var calculototalliquido=parseFloat(totaldevengo)-parseFloat(totaldescuento);
	var totalliquido=$("#total_liquidado_planilladevengo_vacacion").val();


		$("#total_liquidado_planilladevengo_vacacion").val(calculototalliquido.toFixed(2));
		var totalliquido=$("#total_liquidado_planilladevengo_vacacion").val();/* --Total Liquido: */



	calculorenta= parseFloat(sujetoiss_afp)-parseFloat(descuento_isss)-parseFloat(descuento_afp);
	$("#sueldo_renta_planilladevengo_vacacion").val(calculorenta.toFixed(2));
	
	var sujeto_isss=$("#sueldo_isss_planilladevengo_vacacion").val();/* --Sujeto ISSS: */
	var sujeto_afp=$("#sueldo_afp_planilladevengo_vacacion").val();/* --Sujeto AFP: */
	var sujeto_renta=$("#sueldo_renta_planilladevengo_vacacion").val();/* --Sujeto Renta: */

	var orinialliquido=$("#total_liquidado_planilladevengo_vacacion").val();
	$(".originalliquido").val(orinialliquido);



	guardarplanillaoculto();

	console.log("***********************");
	console.log(calculototaldescuento +"calculototaldescuento");
	console.log( totaldescuento + "totaldescuento");
	console.log( calculototalliquido+"calculototalliquido");
	console.log( totalliquido+"totalliquido");
	console.log( descuento_isss+"descuento_isss");
	console.log( descuento_afp+"descuento_afp");
	console.log( sujetoiss_afp+"sujetoiss_afp");


	


}



