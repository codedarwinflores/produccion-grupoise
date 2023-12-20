


/* variables globales */
var idactualempleado="";
var finalizar_total=1;/* finalizar_total inicio */
let intervaloID1;
var intervaloID2;
var intervaloID3;
var intervaloID4;
var suma=0;
var insertplanilla=[];

$(document).ready(function(){
	
	

	var bitacora=$(".bitacora").val();
	if(bitacora=='Cerrar'){
		$(".nuevo_empleado").attr("disabled","disabled");
	}


	var ocultar= "visibility:hidden; height:0";
	var mostrar= "visibility:show";

	$(".ocultar_div").attr("style",ocultar);


	var idplanilladevengo_admin=$(".idplanilladevengo_admin").val();

	if(idplanilladevengo_admin!=0){
		var tipo_planilladevengo_admin1=$(".tipo_planilladevengo_admin1").val();
		var periodo_planilladevengo_admin1=$(".periodo_planilladevengo_admin1").val();
		var fecha_desde_planilladevengo_admin1=$(".fecha_desde_planilladevengo_admin1").val();
		var fecha_hasta_planilladevengo_admin1=$(".fecha_hasta_planilladevengo_admin1").val();
		var numero_planilladevengo_admin1=$(".numero_planilladevengo_admin1").val();
		var fecha_planilladevengo_admin1=$(".fecha_planilladevengo_admin1").val();
		var descripcion_planilladevengo_admin1=$(".descripcion_planilladevengo_admin1").val();
		var empleado_rango_desde1=$(".empleado_rango_desde1").val();
		var empleado_rango_hasta1=$(".empleado_rango_hasta1").val();
		var fecha_gratificacion_admin_hidden=$(".fecha_gratificacion_admin_hidden").val();

		var fecha_situacion_desde_hiden=$(".fecha_situacion_desde_hiden").val();
		var fecha_situacion_hasta_hiden=$(".fecha_situacion_hasta_hiden").val();

		var numero_plan_anticipo_hiden=$(".numero_plan_anticipo_hiden").val();
		var numero_plan_vacacion_hiden=$(".numero_plan_vacacion_hiden").val();


		/* var desdeformato = moment(fecha_desde_planilladevengo_admin1,'YYYY-MM-DD').format('DD-MM-YYYY');
		var hastaformato = moment(fecha_hasta_planilladevengo_admin1,'YYYY-MM-DD').format('DD-MM-YYYY');
		var fecha = moment(fecha_planilladevengo_admin1,'YYYY-MM-DD').format('DD-MM-YYYY'); */
	
		$("#fecha_desde_planilladevengo_admin").val(fecha_desde_planilladevengo_admin1);
		$("#fecha_hasta_planilladevengo_admin").val(fecha_hasta_planilladevengo_admin1);
		$("#fecha_planilladevengo_admin").val(fecha_planilladevengo_admin1);

		$("#tipo_planilladevengo_admin").val(tipo_planilladevengo_admin1);
		$("#periodo_planilladevengo_admin").val(periodo_planilladevengo_admin1);
		$("#numero_planilladevengo_admin").val(numero_planilladevengo_admin1);
		$("#descripcion_planilladevengo_admin").val(descripcion_planilladevengo_admin1);
		$("#empleado_rango_desde").val(empleado_rango_desde1);
		$("#empleado_rango_hasta").val(empleado_rango_hasta1);
		$("#fecha_gratificacion_admin").val(fecha_gratificacion_admin_hidden);

		$("#fecha_situacion_desde").val(fecha_situacion_desde_hiden);
		$("#fecha_situacion_hasta").val(fecha_situacion_hasta_hiden);

		$("#numero_plan_anticipo").val(numero_plan_anticipo_hiden);
		$("#numero_plan_vacacion").val(numero_plan_vacacion_hiden);
		$("#numero_plan_anticipo").val(numero_plan_anticipo_hiden).trigger('change.select2');
		$("#numero_plan_vacacion").val(numero_plan_vacacion_hiden).trigger('change.select2');


		/* cargardataempleados(); */
		$(".filtrar_empleados").attr("disabled","disabled");
		var noprocesado=$(".noprocesado").val();
		if(noprocesado=="0"){
			empleadosnoprocesados();
		}
		else{
			cargardataempleados_admin();
		}
		calculos_globales();
	}
	else{

	}
	
	if(idplanilladevengo_admin==0){

			/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=correlativoplanilla';
			$.ajax({
				data: dataString,
				url: "ajax/planilladevengo_admin.ajax.php",
				type: 'post',
				success: function (response) {
					$("#numero_planilladevengo_admin").val(response);
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
				$("#periodo_planilladevengo_admin").val("1");
				$("#fecha_desde_planilladevengo_admin").val("01"+"-" +mes+"-"+ano);
				$("#fecha_hasta_planilladevengo_admin").val("15"+"-" +mes +"-"+ano);
				$("#fecha_planilladevengo_admin").val("15"+"-" +mes +"-"+ano);
				var valor= $("#fecha_desde_planilladevengo_admin").val();
				var valor2= $("#fecha_hasta_planilladevengo_admin").val();
				$("#descripcion_planilladevengo_admin").val("Planilla de Administrativa desde "+valor+" hasta "+valor2);


				$("#fecha_situacion_desde").val(valor);
				$("#fecha_situacion_hasta").val(valor2);

				$("#historial_fecha_desde").val(valor);
				$("#historial_fecha_hasta").val(valor2);
				$("#historial_periodo").val("1");
			}
			if(dia >= 16 && dia <= 31){
				$("#periodo_planilladevengo_admin").val("2");
				$("#fecha_desde_planilladevengo_admin").val("16"+"-" +mes+"-"+ano);
				$("#fecha_hasta_planilladevengo_admin").val(soloultimodia+"-" +mes +"-"+ano);
				$("#fecha_planilladevengo_admin").val(soloultimodia+"-" +mes +"-"+ano);
				var valor= $("#fecha_desde_planilladevengo_admin").val();
				var valor2= $("#fecha_hasta_planilladevengo_admin").val();
				$("#descripcion_planilladevengo_admin").val("Planilla de Administrativa desde "+valor+" hasta "+valor2);

				$("#fecha_situacion_desde").val(valor);
				$("#fecha_situacion_hasta").val(valor2);
				
				$("#historial_fecha_desde").val(valor);
				$("#historial_fecha_hasta").val(valor2);
				$("#historial_periodo").val("2");

			}
			/* ******* */
	}

 });




 /* SCRIPT PARA REPORTES */
 
 

 /*  */




 $( "#reportesimprimir" ).on( "change", function() {
   
    /* var descontar_tipohora = $('option:selected', this).attr("descontar_tipohora"); */
    var valor= $(this).val();
    $(".iraimprimir").attr("href",valor);

 })



 /* GLOBAL */

 $("body").bind('mousewheel', function(event){
	$("body").attr("style","overflow-y: auto;");
})

 		


 $( "#periodo_planilladevengo_admin" ).change(function(){ 


	var valor = $(this).val();


	var historial_desde=$("#historial_fecha_desde").val();
	var historial_hasta=$("#historial_fecha_hasta").val();

	
	var his_mes_desde = moment(historial_desde,'DD-MM-YYYY').format('MM');
	var his_anio_desde = moment(historial_desde,'DD-MM-YYYY').format('YYYY');

	var his_mes_hasta = moment(historial_hasta,'DD-MM-YYYY').format('MM');
	var his_anio_hasta = moment(historial_hasta,'DD-MM-YYYY').format('YYYY');


	
	var fecha = new Date();
	var ultimoDia = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 0);
	var soloultimodia=ultimoDia.getDate();


	desde="";
	hasta="";
	if(valor=="1"){
		desde="01"+"-"+his_mes_desde+"-"+his_anio_desde;
		hasta="15"+"-"+his_mes_hasta+"-"+his_anio_hasta;

	}
	if (valor=="2"){
		desde="16"+"-"+his_mes_desde+"-"+his_anio_desde;
		hasta=soloultimodia+"-"+his_mes_hasta+"-"+his_anio_hasta;
	}

	$("#historial_fecha_desde").val(desde);
	$("#fecha_desde_planilladevengo_admin").val(desde);

	$("#historial_fecha_hasta").val(hasta);
	$("#fecha_hasta_planilladevengo_admin").val(hasta);


	$("#descripcion_planilladevengo_admin").val("Planilla de Administrativa desde "+desde+" hasta "+hasta);
	$("#fecha_planilladevengo_admin").val(hasta);









	/* var historia_periodo=$("#historial_periodo").val();
	var valor=$(this).val();
	if(valor!=historia_periodo){
		swal({
			type: "warning",
			title: "Error: periodo incorrecto",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function (result) {
			if (result.value) {
				location.reload();
			}
		});
	} */



});




  /* CAPTURAR FECHA DESDE */
  $( "#fecha_desde_planilladevengo_admin" ).on( "click", function() {

	$("#ic__datepicker-3").on( "click", function() {


		/* ******************************************* */
			var desde=$("#fecha_desde_planilladevengo_admin").val();
			var hasta=$("#fecha_hasta_planilladevengo_admin").val();
			var historial_desde=$("#historial_fecha_desde").val();
			var periodo=$("#periodo_planilladevengo_admin").val();

			var dia_desde = moment(desde,'DD-MM-YYYY').format('DD');
			var mes_desde = moment(desde,'DD-MM-YYYY').format('MM');
			var anio_desde = moment(desde,'DD-MM-YYYY').format('YYYY');

			/* capturar ultimo dia fecha hasta */
			var capturardiafinal=anio_desde+"-"+mes_desde+"-"+dia_desde;
			var partesFecha = capturardiafinal.split('-');
			var año = parseInt(partesFecha[0]);
			var mes = parseInt(partesFecha[1]);
			var ultimoDia = new Date(año, mes, 0).getDate();
			var ultimoDiaDelMes = año + '-' + (mes < 10 ? '0' : '') + mes + '-' + (ultimoDia < 10 ? '0' : '') + ultimoDia;
			
			var fecha_hasta_final=ultimoDia+"-"+mes_desde+"-"+anio_desde;
			if(periodo==1){
				 fecha_hasta_final = 15+"-"+mes_desde+"-"+anio_desde;
			}
			/* *************** */

			
			var dia_hasta = moment(hasta,'DD-MM-YYYY').format('DD');
			var mes_hasta = moment(hasta,'DD-MM-YYYY').format('MM');
			var anio_hasta = moment(hasta,'DD-MM-YYYY').format('YYYY');
			$("#fecha_hasta_planilladevengo_admin").val(fecha_hasta_final);
			var hasta=$("#fecha_hasta_planilladevengo_admin").val();
			$("#fecha_planilladevengo_admin").val(hasta);


			var dia_his = moment(historial_desde,'DD-MM-YYYY').format('DD');
			$("#historial_fecha_desde").val(dia_his+"-"+mes_desde+"-"+anio_desde);
			$("#descripcion_planilladevengo_admin").val("Planilla de Administrativa desde "+desde+" hasta "+hasta);

			
			if(dia_desde != dia_his){
				/* ********************* */

				/* 	swal({
						type: "warning",
						title: "Error: periodo incorrecto",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
			
					}).then(function (result) {
						if (result.value) {
							location.reload();
						}
					}); */
				/* ******************** */
			}
		/* ******************************************* */

	  });
  });

 /* CAPTURAR FECHA HASTA */
 $( "#fecha_hasta_planilladevengo_admin" ).on( "click", function() {
	$( "#ic__datepicker-4" ).on( "click", function() {
		/* ******************************************* */
			var hasta=$("#fecha_hasta_planilladevengo_admin").val();
					
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
  
	var tipo_planilladevengo_admin=$("#tipo_planilladevengo_admin").val();
	var periodo_planilladevengo_admin=$("#periodo_planilladevengo_admin").val();
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var descripcion_planilladevengo_admin =$("#descripcion_planilladevengo_admin").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo_admin = $("#fecha_planilladevengo_admin").val();
	var fecha_desde_planilladevengo_admin = $("#fecha_desde_planilladevengo_admin").val();
	var fecha_hasta_planilladevengo_admin = $("#fecha_hasta_planilladevengo_admin").val();
	var fecha_gratificacion_admin = $("#fecha_gratificacion_admin").val();


	
	var fecha_situacion_desde = $("#fecha_situacion_desde").val();
	var fecha_situacion_hasta = $("#fecha_situacion_hasta").val();

	
	var numero_plan_anticipo = $("#numero_plan_anticipo").val();
	var numero_plan_vacacion = $("#numero_plan_vacacion").val();

	var id = $(this).attr('id');

    var dataString = 'empleado_rango_desde=' +empleado_rango_desde +
    '&empleado_rango_hasta=' +empleado_rango_hasta+
    '&fecha_planilladevengo_admin=' +fecha_planilladevengo_admin+
    '&fecha_gratificacion_admin=' +fecha_gratificacion_admin+
    '&fechaperiodo1=' +fecha_desde_planilladevengo_admin+
    '&fechaperiodo2=' +fecha_hasta_planilladevengo_admin+
    '&tipo_planilladevengo_admin=' +tipo_planilladevengo_admin+
    '&periodo_planilladevengo_admin=' +periodo_planilladevengo_admin+
    '&numero_planilladevengo_admin=' +numero_planilladevengo_admin+
    '&descripcion_planilladevengo_admin=' +descripcion_planilladevengo_admin+
    '&fecha_situacion_desde=' +fecha_situacion_desde+
    '&fecha_situacion_hasta=' +fecha_situacion_hasta+
    '&numero_plan_anticipo=' +numero_plan_anticipo+
    '&numero_plan_vacacion=' +numero_plan_vacacion+
	'&idempleado=' +id +
    '&accion01=addempleadonuevo2';
    $.ajax({
        data: dataString,
        url: "ajax/planilladevengo_admin.ajax.php",
        type: 'post',
        success: function (response) {
		/* console.log(response);*/
		
				/* ************ */
				swal({
					type: "success",
					title: "Guardado con Exito",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
		
				}).then(function (result) {
					if (result.value) {
						

						var dataFecha=id;
						var codigo_empleado="";
						var objeto={id:dataFecha, codigo:codigo_empleado};
						ids_empleados.push(objeto);
						delayedLog(id);
						/* idempleados_one(numero_planilladevengo_admin); */
						$('.modal_carga_empleados').modal({backdrop: 'static', keyboard: false});
						$('.modal_carga_empleados').modal('show');
						setTimeout(function(){
							/* location.reload(); */
						}, 3000);
					
	
					}
				});
				/* --------- */
			
			

		}
	});


});

  $( ".select_empleado000000000_baclup" ).on( "click", function() {
	var id = $(this).attr('id');
	var nombre =$(this).attr('nombre');
	var codigo=$(this).attr('codigo');
	$("#codigo_empleado_planilladevengo_admin").val(codigo);
	$("#nombre_empleado_planilladevengo_admin").val(nombre);
	$("#id_empleado_planilladevengo_admin").val(id);
	
	var numero_planilladevengo_admin = $("#numero_planilladevengo_admin").val();
	var tipo_planilladevengo_admin = $("#tipo_planilladevengo_admin").val();
	var periodo_planilladevengo_admin = $("#periodo_planilladevengo_admin").val();
	var descripcion_planilladevengo_admin = $("#descripcion_planilladevengo_admin").val();
	var fecha_desde_planilladevengo_admin=$("#fecha_desde_planilladevengo_admin").val();
	var fecha_hasta_planilladevengo_admin=$("#fecha_hasta_planilladevengo_admin").val();
	var fecha_gratificacion_admin=$("#fecha_gratificacion_admin").val();


	var dataString = 'id=' +$.trim(id) +
				'&numero_planilladevengo_admin=' +numero_planilladevengo_admin +
				'&tipo_planilladevengo_admin=' +tipo_planilladevengo_admin +
				'&periodo_planilladevengo_admin=' +periodo_planilladevengo_admin +
				'&descripcion_planilladevengo_admin=' +descripcion_planilladevengo_admin +
				'&idempleado=' +id +
				'&fechaperiodo1=' +fecha_desde_planilladevengo_admin+
				'&fechaperiodo2=' +fecha_hasta_planilladevengo_admin+
				'&fecha_gratificacion_admin=' +fecha_gratificacion_admin+
				'&accion01=addempleadonuevo2';
				$.ajax({
					data: dataString,
					url: "ajax/planilladevengo_admin.ajax.php",
					type: 'post',
					success: function (response) {

						
						swal({
							type: "success",
							title: "Guardado con Exito",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
				
						}).then(function (result) {
							if (result.value) {
			
								
							}
						});
					}
				});


	setTimeout(function(){
		location.reload();
	}, 2500);
	
  });

  
/* $(".guardarempleado").click(function(){
	
}); */

$(".guardarplanilla").click(function(){
	guardarplanilla();
});

function guardarplanilla(){
	
	/* variables */

	var id = $("#id").val();
	var numero_planilladevengo_admin = $("#numero_planilladevengo_admin").val();
	var fecha_planilladevengo_admin = $("#fecha_planilladevengo_admin").val();
	var fecha_desde_planilladevengo_admin = $("#fecha_desde_planilladevengo_admin").val();
	var fecha_hasta_planilladevengo_admin = $("#fecha_hasta_planilladevengo_admin").val();
	var descripcion_planilladevengo_admin = $("#descripcion_planilladevengo_admin").val();
	var codigo_empleado_planilladevengo_admin = $("#codigo_empleado_planilladevengo_admin").val();
	var nombre_empleado_planilladevengo_admin = $("#nombre_empleado_planilladevengo_admin").val();
	var id_empleado_planilladevengo_admin = $("#id_empleado_planilladevengo_admin").val();
	var dias_trabajo_planilladevengo_admin = $("#dias_trabajo_planilladevengo_admin").val();
	var sueldo_planilladevengo_admin = $("#sueldo_planilladevengo_admin").val();
	var hora_extra_diurna_planilladevengo_admin = $("#hora_extra_diurna_planilladevengo_admin").val();
	var hora_extra_nocturna_planilladevengo_admin = $("#hora_extra_nocturna_planilladevengo_admin").val();
	var hora_extra_domingo_planilladevengo_admin = $("#hora_extra_domingo_planilladevengo_admin").val();
	var hora_extra_domingo_nocturna_planilladevengo_admin = $("#hora_extra_domingo_nocturna_planilladevengo_admin").val();
	var otro_devengo_admin_planilladevengo_admin = $("#otro_devengo_admin_planilladevengo_admin").val();
	var total_devengo_admin_planilladevengo_admin = $("#total_devengo_admin_planilladevengo_admin").val();
	var descuento_isss_planilladevengo_admin = $("#descuento_isss_planilladevengo_admin").val();
	var descuento_afp_planilladevengo_admin = $("#descuento_afp_planilladevengo_admin").val();
	var descuento_renta_planilladevengo_admin = $("#descuento_renta_planilladevengo_admin").val();
	var otro_descuento_planilladevengo_admin = $("#otro_descuento_planilladevengo_admin").val();
	var total_descuento_planilladevengo_admin = $("#total_descuento_planilladevengo_admin").val();
	var total_liquidado_planilladevengo_admin = $("#total_liquidado_planilladevengo_admin").val();
	var sueldo_renta_planilladevengo_admin = $("#sueldo_renta_planilladevengo_admin").val();
	var sueldo_isss_planilladevengo_admin = $("#sueldo_isss_planilladevengo_admin").val();
	var sueldo_afp_planilladevengo_admin = $("#sueldo_afp_planilladevengo_admin").val();
	var departamento_planilladevengo_admin = $("#departamento_planilladevengo_admin").val();
	var codigo_ubicacion_planilladevengo_admin = $("#codigo_ubicacion_planilladevengo_admin").val();
	var nombre_ubicacion_planilladevengo_admin = $("#nombre_ubicacion_planilladevengo_admin").val();
	var id_ubicacion_planilladevengo_admin = $("#id_ubicacion_planilladevengo_admin").val();
	var observacion_planilladevengo_admin = $("#observacion_planilladevengo_admin").val();
	var periodo_planilladevengo_admin = $("#periodo_planilladevengo_admin").val();
	var tipo_planilladevengo_admin = $("#tipo_planilladevengo_admin").val();
	var dias_incapacidad = $("#dias_incapacidad").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();

	var accion_realizar = "";

	
	var septimo_admin = $("#septimo_admin").val();
	var dias_ausencia = $("#dias_ausencia").val();
	var his_dias_trabajo_admin=$("#his_dias_trabajo_admin").val();
	var fecha_gratificacion_admin = $("#fecha_gratificacion_admin").val();


	var fecha_situacion_desde = $("#fecha_situacion_desde").val();
	var fecha_situacion_hasta = $("#fecha_situacion_hasta").val();

	
	var numero_plan_anticipo = $("#numero_plan_anticipo").val();
	var numero_plan_vacacion = $("#numero_plan_vacacion").val();


/*  ******** */

				var dataString = 'id=' +$.trim(id) +
				'&numero_planilladevengo_admin=' +numero_planilladevengo_admin +
				'&fecha_planilladevengo_admin=' +fecha_planilladevengo_admin +
				'&fecha_desde_planilladevengo_admin=' +fecha_desde_planilladevengo_admin +
				'&fecha_hasta_planilladevengo_admin=' +fecha_hasta_planilladevengo_admin +
				'&descripcion_planilladevengo_admin=' +descripcion_planilladevengo_admin +
				'&codigo_empleado_planilladevengo_admin=' +codigo_empleado_planilladevengo_admin +
				'&nombre_empleado_planilladevengo_admin=' +nombre_empleado_planilladevengo_admin +
				'&id_empleado_planilladevengo_admin=' +id_empleado_planilladevengo_admin +
				'&dias_trabajo_planilladevengo_admin=' +dias_trabajo_planilladevengo_admin +
				'&sueldo_planilladevengo_admin=' +sueldo_planilladevengo_admin +
				'&hora_extra_diurna_planilladevengo_admin=' +hora_extra_diurna_planilladevengo_admin +
				'&hora_extra_nocturna_planilladevengo_admin=' +hora_extra_nocturna_planilladevengo_admin +
				'&hora_extra_domingo_planilladevengo_admin=' +hora_extra_domingo_planilladevengo_admin +
				'&hora_extra_domingo_nocturna_planilladevengo_admin=' +hora_extra_domingo_nocturna_planilladevengo_admin +
				'&otro_devengo_admin_planilladevengo_admin=' +otro_devengo_admin_planilladevengo_admin +
				 '&total_devengo_admin_planilladevengo_admin=' +total_devengo_admin_planilladevengo_admin +
				 '&descuento_isss_planilladevengo_admin=' +descuento_isss_planilladevengo_admin +
				 '&descuento_afp_planilladevengo_admin=' +descuento_afp_planilladevengo_admin +
				 '&descuento_renta_planilladevengo_admin=' +descuento_renta_planilladevengo_admin +
				 '&otro_descuento_planilladevengo_admin=' +otro_descuento_planilladevengo_admin +
				 '&total_descuento_planilladevengo_admin=' +total_descuento_planilladevengo_admin +
				 '&total_liquidado_planilladevengo_admin=' +total_liquidado_planilladevengo_admin +
				 '&sueldo_renta_planilladevengo_admin=' +sueldo_renta_planilladevengo_admin +
				 '&sueldo_isss_planilladevengo_admin=' +sueldo_isss_planilladevengo_admin +
				 '&sueldo_afp_planilladevengo_admin=' +sueldo_afp_planilladevengo_admin +
				 '&departamento_planilladevengo_admin=' +departamento_planilladevengo_admin +
				 '&codigo_ubicacion_planilladevengo_admin=' +codigo_ubicacion_planilladevengo_admin +
				 '&nombre_ubicacion_planilladevengo_admin=' +nombre_ubicacion_planilladevengo_admin +
				 '&id_ubicacion_planilladevengo_admin=' +id_ubicacion_planilladevengo_admin+
				 '&observacion_planilladevengo_admin=' +observacion_planilladevengo_admin+
				 '&periodo_planilladevengo_admin=' +periodo_planilladevengo_admin+
				 '&tipo_planilladevengo_admin=' +tipo_planilladevengo_admin+
				 '&dias_incapacidad=' +dias_incapacidad+
				 '&empleado_rango_desde=' +empleado_rango_desde+
				 '&empleado_rango_hasta=' +empleado_rango_hasta+
				 '&septimo_admin=' +septimo_admin+
				 '&dias_ausencia=' +dias_ausencia+
				 '&his_dias_trabajo_admin=' +his_dias_trabajo_admin+
				 '&fecha_gratificacion_admin=' +fecha_gratificacion_admin+
				 '&fecha_situacion_desde=' +fecha_situacion_desde+
				 '&fecha_situacion_hasta=' +fecha_situacion_hasta+
				 '&numero_plan_anticipo=' +numero_plan_anticipo+
				 '&numero_plan_vacacion=' +numero_plan_vacacion+
				 '&accion=' +accion_realizar;
				 
$.ajax({
	data: dataString,
	url: "ajax/planilladevengo_admin.ajax.php",
	type: 'post',
	success: function (response) {
		swal({
			type: "success",
			title: "Guardado con Exito",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function (result) {
			if (result.value) {
				/* window.location = "situacion"; */
				/* location.reload(); */
				
				var txt_codigo =$("#txt_codigo").val();
				var txt_idempleado=$("#txt_idempleado").val();
				var txt_nombre=$("#txt_nombre").val();
				var txt_sueldo=$("#txt_sueldo").val();
				var txt_salario_por_hora=$("#txt_salario_por_hora").val();

				actualizar_datos(txt_codigo,txt_idempleado,txt_nombre);
				
			}
		});
	}
});
/* ********* */

}

function guardarplanillaoculto(){
	/* variables */

	
		var valores={id:$("#id").val(),
		id_empleado_planilladevengo_admin:$("#id_empleado_planilladevengo_admin").val(),
		codigo_empleado_planilladevengo_admin:$("#codigo_empleado_planilladevengo_admin").val(),
		numero_planilladevengo_admin:$("#numero_planilladevengo_admin").val(),
		hora_extra_diurna_planilladevengo_admin:$("#hora_extra_diurna_planilladevengo_admin").val(),
		otro_devengo_admin_planilladevengo_admin:$("#otro_devengo_admin_planilladevengo_admin").val(),
		total_devengo_admin_planilladevengo_admin:$("#total_devengo_admin_planilladevengo_admin").val(),
		descuento_isss_planilladevengo_admin:$("#descuento_isss_planilladevengo_admin").val(),
		descuento_afp_planilladevengo_admin:$("#descuento_afp_planilladevengo_admin").val(),
		descuento_renta_planilladevengo_admin:$("#descuento_renta_planilladevengo_admin").val(),
		otro_descuento_planilladevengo_admin:$("#otro_descuento_planilladevengo_admin").val(),
		total_descuento_planilladevengo_admin:$("#total_descuento_planilladevengo_admin").val(),
		total_liquidado_planilladevengo_admin:$("#total_liquidado_planilladevengo_admin").val(),
		sueldo_renta_planilladevengo_admin:$("#sueldo_renta_planilladevengo_admin").val(),
		sueldo_isss_planilladevengo_admin:$("#sueldo_isss_planilladevengo_admin").val(),
		sueldo_afp_planilladevengo_admin:$("#sueldo_afp_planilladevengo_admin").val(),
		departamento_planilladevengo_admin:$("#departamento_planilladevengo_admin").val(),
		accion01:"modificarexpres"
		};
		insertplanilla.push(valores);
	/* var dataString = "";
	for (var key in valores) {
		if (valores.hasOwnProperty(key)) {
		  window[key] = valores[key];
		  dataString += key + "=" + encodeURIComponent(valores[key]) + "&";
		}
	  } */
/*  ******** */
/* dataString = dataString.slice(0, -1); */				 


/* $.ajax({
	data: dataString,
	url: "ajax/planilladevengo_admin.ajax.php",
	type: 'post',
	success: function (response) {
		
	}
}); */
/* ********* */

}


/* CAPTURAR FECHA DESDE */

$( "#fecha_desde_planilladevengo_admin" ).on( "click", function() {
	$( "#ic__datepicker-1 .ic__day" ).on( "click", function() {
		var valor= $("#fecha_desde_planilladevengo_admin").val();
		var valor2= $("#fecha_hasta_planilladevengo_admin").val();
		$("#descripcion_planilladevengo_admin").val("Planilla de Administrativa desde "+valor+" hasta "+valor2);

	  } );
  } );

  /* CAPTURAR FECHA HASTA */
  $( "#fecha_hasta_planilladevengo_admin" ).on( "click", function() {
	$( "#ic__datepicker-2 .ic__day" ).on( "click", function() {
		var valor= $("#fecha_desde_planilladevengo_admin").val();
		var valor2= $("#fecha_hasta_planilladevengo_admin").val();
		$("#descripcion_planilladevengo_admin").val("Planilla de Administrativa desde "+valor+" hasta "+valor2);

	  } );
  } );

$(".filtrar_empleados").on( "click", function() {
	var fecha_gratificacion_admin=$("#fecha_gratificacion_admin").val();
	var periodo=$("#periodo_planilladevengo_admin").val();

	if($.trim(periodo)=="2" && fecha_gratificacion_admin==""){

			swal({
				type: "warning",
				title: "Por favor ingrese Fecha de Gratificacion",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			});

	}
	else{
	$('.modal_carga').modal({backdrop: 'static', keyboard: false});
	$('.modal_carga').modal('show');	
	cargardataempleados();
	}
})

function cargardataempleados(){

	
	$('.modal_carga').modal({backdrop: 'static', keyboard: false});
	$('.modal_carga').modal('show');	
	var tipo_planilladevengo_admin=$("#tipo_planilladevengo_admin").val();
	var periodo_planilladevengo_admin=$("#periodo_planilladevengo_admin").val();
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var descripcion_planilladevengo_admin =$("#descripcion_planilladevengo_admin").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo_admin = $("#fecha_planilladevengo_admin").val();
	var fecha_desde_planilladevengo_admin = $("#fecha_desde_planilladevengo_admin").val();
	var fecha_hasta_planilladevengo_admin = $("#fecha_hasta_planilladevengo_admin").val();
	var fecha_gratificacion_admin = $("#fecha_gratificacion_admin").val();

	var fecha_situacion_desde = $("#fecha_situacion_desde").val();
	var fecha_situacion_hasta = $("#fecha_situacion_hasta").val();


	var numero_plan_anticipo=$("#numero_plan_anticipo").val();
	var numero_plan_vacacion=$("#numero_plan_vacacion").val();

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

	if(fecha_planilladevengo_admin==""){
		accion ="falta";
	}
	else if(empleado_rango_desde=="*" && empleado_rango_hasta=="*"){
		accion="consultar";
		accion_realizar="lista";

	}
	if(accion === "falta"){
		alert("Por favor ingrese Datos para la busqueda");
		location.reload();
	}
	if(accion==="consultar"){

		
		/* *********** */
		var dataString = 'empleado_rango_desde=' +empleado_rango_desde +
		'&empleado_rango_hasta=' +empleado_rango_hasta+
		'&fecha_planilladevengo_admin=' +fecha_planilladevengo_admin+
		'&fecha_gratificacion_admin=' +fecha_gratificacion_admin+
		'&fechaperiodo1=' +fecha_desde_planilladevengo_admin+
		'&fechaperiodo2=' +fecha_hasta_planilladevengo_admin+
		'&tipo_planilladevengo_admin=' +tipo_planilladevengo_admin+
		'&periodo_planilladevengo_admin=' +periodo_planilladevengo_admin+
		'&numero_planilladevengo_admin=' +numero_planilladevengo_admin+
		'&descripcion_planilladevengo_admin=' +descripcion_planilladevengo_admin+
		'&fecha_situacion_desde=' +fecha_situacion_desde+
		'&fecha_situacion_hasta=' +fecha_situacion_hasta+
		'&numero_plan_anticipo=' +numero_plan_anticipo+
		'&numero_plan_vacacion=' +numero_plan_vacacion+
		'&accion01=' +$.trim(accion_realizar);
		

		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_admin.ajax.php",
			type: 'post',
			success: function (response) {

				
				console.log(response);
				if(response.trim()!=""){
					/* 		generarcalculos_planilla(numero_planilladevengo_admin); */
					$.ajax({
						url:idempleados_one(numero_planilladevengo_admin),
						success:function(){
							/* window.location = "nuevaplanillaadmin?id="+response; */
						}
					});
				}
				console.log(response);
				$("#tabla_empleados").empty();
				$("#tabla_empleados").append(response);
				/* cargardataempleados_admin(); */

				

				/* $(".tablas1").on("click", ".btnEditarabase", function(){
					var codigo = $(this).attr("codigo");
					var id = $(this).attr("idempleado");
					var nombre = $(this).attr("nombre");
					var sueldo = $(this).attr("sueldo");
					var salario_por_hora = $(this).attr("salario_por_hora");
					$("#salario_por_hora").val(salario_por_hora);
					$("#nombreempleado").text(nombre);
					$(".mostrar_devengo_admin").attr("sueldo",sueldo);
					$(".valor_devengo_planilla").attr("idempleado",id);
					valor_devengo_admin();
					editar(codigo,id,nombre,sueldo);
					calculos(id,sueldo);

				}); */


				/* ****eliminar empleado */
				$(".tablas1").on("click", ".eliminarempleado", function(){
					var idempleado = $(this).attr("idempleado");
					var numero_planilla=$(this).attr("numero_planilla");
					eliminarempleado(idempleado,numero_planilla);
				});

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
};



/* GUARDA LOS CALCULOS EN LA PLANILLA POR CADA INDIVIDUO */
var idactualempleado=0;
var  ids_empleados=[];
var totalempleados="";
function idempleados_one(numero){

	/* -----INICIAR TIEMPO------- */
	var hoy = new Date();
	var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
	function formatTime(timeString) {
		const [hourString, minute] = timeString.split(":");
		const hour = +hourString % 24;
		return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
	}
	$(".tiempoiniciado").text("Iniciado: "+formatTime(hora));
	/* ------------ */
	$('.modal_carga').modal({backdrop: 'static', keyboard: true});
	$('.modal_carga').modal('hide');
	$('.modal_carga_empleados').modal({backdrop: 'static', keyboard: false});
	$('.modal_carga_empleados').modal('show');
	/* guardartodo */

	var dataString ='consultarempleado=1'+
					'&numeroplanilla=' +numero+
					'&accion01=guardartodo';				
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_admin.ajax.php",
		type: 'post',
		success: function (response) {

			console.log(response+"  respuesta de idempleados_one");
			if($.trim(response)=="exito"){
				/* --------------- */
				/* **********HORA ACTUAL */
					/* ------------ */
					var hoy = new Date();
					var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
					function formatTime(timeString) {
						const [hourString, minute] = timeString.split(":");
						const hour = +hourString % 24;
						return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
					}
					$(".tiempofinal").text("Finalizado: "+formatTime(hora));
					/* ------------ */
					var numero=$("#numero_planilladevengo_admin").val();
					$(".irplanilla").attr("href","nuevaplanillaadmin?id="+numero);
					$(".irplanilla").removeAttr("style");
					$(".cargando_gif").attr("src","vistas/modulos/completado.gif");
				/* -------------------- */
				/* ------------------ */
			}
		}
	});
}
function idempleados_one_backup(numero){
	var dataString = 'accion01=listadoempleados'+'&numero='+numero;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_admin.ajax.php",
		type: 'post',
		success: function (response) {
		
				datos = JSON.parse(response);
				for (i = 0; i < datos.length; i++) {
					var dataFecha=datos[i].id;
					var codigo_empleado=datos[i].codigo_empleado;
					var objeto={id:dataFecha, codigo:codigo_empleado};
					ids_empleados.push(objeto);
				}
				totalempleados=ids_empleados.length;
				processArray();
				$('.modal_carga').modal({backdrop: 'static', keyboard: true});
				$('.modal_carga').modal('hide');
				$('.modal_carga_empleados').modal({backdrop: 'static', keyboard: false});
				$('.modal_carga_empleados').modal('show');
				/* ------------ */
					var hoy = new Date();
					var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
					function formatTime(timeString) {
						const [hourString, minute] = timeString.split(":");
						const hour = +hourString % 24;
						return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
					}
					$(".tiempoiniciado").text("Iniciado: "+formatTime(hora));
				/* ------------ */
		}
	
	})
}
function delay() {
	return new Promise(resolve => setTimeout(resolve, 100));
}
var cuenta=0;
async function  delayedLog(idempleado){
		cuenta+=1;
		$(".cantidad_empleados_pro").text("Empleados Procesados: "+cuenta);
		$(".totalempleados").text("Total empleado: "+totalempleados);
		$(".conteo_actual").text("Cantidad de empleados faltantes: "+ids_empleados.length);
		$(".datos_informacion").text("Cargando datos de empleado: "+ids_empleados[0].codigo);
		/* console.log(idempleado+"nuevo inicial***********************************************"); */
		/* CAPTURAR EMPLEADOS */
			/* *********** */
			var dataString = 'accion01=listaidempleados'+'&idempleado='+idempleado;
			$.ajax({
				data: dataString,
				url: "ajax/planilladevengo_admin.ajax.php",
				type: 'post',
				success: function (response) {
					console.log(response+" holaaaaaa");

					var datos = JSON.parse(response);
					for (i = 0; i < datos.length; i++) {
					var dato_pensionado=datos[i].pensionado_empleado;
					if(dato_pensionado==""){
						dato_pensionado="No";
					}
					else{
						dato_pensionado=datos[i].pensionado_empleado;
					}
					/* --------------------------- */
					var codigo = datos[i].codigo_empleado;
					var id = datos[i].id;
					var nombre = datos[i].primer_nombre+" "+datos[i].segundo_nombre+" "+datos[i].tercer_nombre+" "+datos[i].primer_apellido+" "+datos[i].segundo_apellido+" "+datos[i].apellido_casada;
					var sueldo = datos[i].sueldo;
					var salario_por_hora = datos[i].salario_por_hora;
					var hora_extra_diurna = datos[i].hora_extra_diurna;
					var hora_extra_nocturna = datos[i].hora_extra_nocturna;
					var hora_extra_domingo = datos[i].hora_extra_domingo;
					var hora_extra_nocturna_domingo = datos[i].hora_extra_nocturna_domingo;
					var pensionado_empleado = datos[i].dato_pensionado;
					var fecha_contratacion = datos[i].fecha_contratacion;
					var hr1 = moment(fecha_contratacion,'YYYY/MM/DD HH:mm:ss a').format('DD-MM-YYYY');
					$("#fecha_contratacion").val(hr1);
					var sueldo_diario = datos[i].sueldo_diario;
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
					$(".mostrar_devengo_admin").attr("sueldo",sueldo);
					$(".valor_devengo_planilla").attr("idempleado",id);
					$("#pensionado_empleado").val(pensionado_empleado);
					
					valor_devengo_admin();
					editar(codigo,id,nombre,sueldo);
					setInterval(repetir(),200);
					/* --------------------- */
					/* intervaloID1 = setInterval(function() {
						repetir();
					 }, 200); */

					/* ---------------------- */

						
					/* setInterval(repetir(codigo,id,nombre,sueldo),200); */
					/* setInterval(repetir(codigo,id,nombre,sueldo),200); */
					/* calculos(id,sueldo); *//* aqui es al iniciar */
					/* cargarrecibos(id);
					departamentoempleado(id);
					ubicacionempleado(id); */
					/* --------------------------- */
					}
				}
			});
		/* *********** */
	
}
async function processArray() {
	/* for (const item of ids_empleados[1]) { */
	for (var i=0; i < 1; i++) {
			idactualempleado=ids_empleados[i].id;
			await delayedLog(ids_empleados[i].id);
	  }
	  /* -------------------- */
	/* await delay(); */
	/* verificarFuncionesTerminadas(); */
	
	  /* ----------------- */
}
let timeout;
function varificarliquido(){
	

	var numero=$("#numero_planilladevengo_admin").val();
	/* PLANILLA */
	if(idactualempleado==0){
		if(intervaloID2==0){
			recargararray();
			/* alert("va a recargar"); */
		}
	}else{
			/* *********** */
			var dataString = 'accion01=verificardatoingresado'+'&numero='+numero+'&idempleado='+idactualempleado;
			$.ajax({
				data: dataString,
				url: "ajax/planilladevengo_admin.ajax.php",
				type: 'post',
				success: function (response) {
				
			
					datos = JSON.parse(response);
					var liquido=datos[0].total_liquidado_planilladevengo_admin;
					var idempleado=datos[0].id_empleado_planilladevengo_admin;
					if(liquido==0){
						
					}
					else if(liquido==""){
						
					}
					else if(liquido=="NULL"){
						
					}
					else if(liquido=="NaN"){
						
					}
					else if(liquido=="0.00"){
						/* recargararray(); */
					}
					else if(liquido<=0){
						/* recargararray(); */
					}
					else if(!liquido){
						/* recargararray(); */
					}
					 if(intervaloID2==0){
						
						recargararray();
						/* alert("va a recargar"); */
					}
					timeout = setTimeout(function() {
						if(idempleado==idactualempleado){
							recargararray();
						}
					  }, 1000); // 3000 milisegundos (3 segundos)

				}
			});
			/* *********** */
		}
} 

/* ------------------------ */
function recargararray(){
	ids_empleados = ids_empleados.filter(function(empleado) {
		return empleado.id != idactualempleado; 
	});
	
	if(ids_empleados.length>0){
		/* processArray(); */
		delayedLog(ids_empleados[0].id);
		idactualempleado=ids_empleados[0].id;
		clearTimeout(timeout);
		/* alert("ya recargo y va por otro empleado") */
		/* timeout = setTimeout(function() {
			console.log('Temporizador reiniciado y finalizado.');
		}, 4000); */
	} 
	if(!ids_empleados.length){
		
		$.ajax({
			data: { 'registros': JSON.stringify(insertplanilla)},
			url: "ajax/guardardatos_admin.ajax.php",
			type: 'post',
			success: function (response) {
				console.log(response);
				
			/* **********HORA ACTUAL */
					/* ------------ */
					var hoy = new Date();
					var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
					function formatTime(timeString) {
						const [hourString, minute] = timeString.split(":");
						const hour = +hourString % 24;
						return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
					}
					$(".tiempofinal").text("Finalizado: "+formatTime(hora));
					/* ------------ */
					var numero=$("#numero_planilladevengo_admin").val();
					$(".irplanilla").attr("href","nuevaplanillaadmin?id="+numero);
					$(".irplanilla").removeAttr("style");
					$(".cargando_gif").attr("src","vistas/modulos/completado.gif");

				/* -------------------- */
			}
		});

		

		/* var numero=$("#numero_planilladevengo_admin").val();
		window.location = "nuevaplanillaadmin?id="+numero; */
	}
}
/* ------------------------------ */


function empleadosnoprocesados(){

	var tipo_planilladevengo_admin=$("#tipo_planilladevengo_admin").val();
	var periodo_planilladevengo_admin=$("#periodo_planilladevengo_admin").val();
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var descripcion_planilladevengo_admin =$("#descripcion_planilladevengo_admin").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo_admin = $("#fecha_planilladevengo_admin").val();
	var fecha_gratificacion_admin = $("#fecha_gratificacion_admin").val();
	var fecha_desde_planilladevengo_admin = $("#fecha_desde_planilladevengo_admin").val();
	var fecha_hasta_planilladevengo_admin = $("#fecha_hasta_planilladevengo_admin").val();
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

	if(fecha_planilladevengo_admin==""){
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
		'&fecha_planilladevengo_admin=' +fecha_planilladevengo_admin+
		'&fecha_gratificacion_admin=' +fecha_gratificacion_admin+
		'&fechaperiodo1=' +fecha_desde_planilladevengo_admin+
		'&fechaperiodo2=' +fecha_hasta_planilladevengo_admin+
		'&tipo_planilladevengo_admin=' +tipo_planilladevengo_admin+
		'&periodo_planilladevengo_admin=' +periodo_planilladevengo_admin+
		'&numero_planilladevengo_admin=' +numero_planilladevengo_admin+
		'&descripcion_planilladevengo_admin=' +descripcion_planilladevengo_admin+
		'&accion01=empleadosnoprocesados';

		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_admin.ajax.php",
			type: 'post',
			success: function (response) {

				if(response!=""){
					$('.modal_carga').modal({backdrop: 'static', keyboard: true});
					$('.modal_carga').modal('hide');	
				}

				console.log(response+"funcion empleadosnoprocesados");
				$("#tabla_empleados").empty();
				$("#tabla_empleados").append(response);

		
				/* ***********MOVER EN TABLA ***** */


				var $tbl = $('#tbl_byKeyboard');
				var $cur = $('.empleadoseleccionado', $tbl).first();
				var seconds = 0; //número de segundos a contar

				/* *************************** */
				function secondPassed() {
					var minutes = Math.trunc(seconds/60); //calcula el número de minutos
					var remainingSeconds = seconds % 60; //calcula los segundos restantes
					//si los segundos usan sólo un dígito, añadimos un cero a la izq
					if (remainingSeconds < 10) { 
						remainingSeconds = "0" + remainingSeconds; 
					} 
					/* document.getElementById('countdown').innerHTML = minutes + ":" +     remainingSeconds;  */
					console.log(remainingSeconds); 
					if (seconds == 0) { 
						clearInterval(countdownTimer); 
						/* rows[selectedRow].click(); */
					} else { 
						seconds--; 
					} 
				} 
				var countdownTimer;
				/* *************************** */
				var rows = document.getElementById("tbl_byKeyboard").children[1].children;
				var selectedRow = 0;


					/* document.body.onkeydown = function(e){ */
					document.addEventListener("keydown", event => {
						//Prevent page scrolling on keypress
						/* e.preventDefault(); */
						//Clear out old row's color
						rows[selectedRow].style.backgroundColor = "#FFFFFF";
						/* var $scrollable = $("#tabla_empleados"); */
				
						//Calculate new row
						if(event.keyCode == 38){
							selectedRow--;
						} else if(event.keyCode == 40){
							selectedRow++;
							$("body").attr("style","overflow-y: hidden;");
						}else if(event.keyCode == 13){
							rows[selectedRow].click();
						}
						
						if(selectedRow == rows.length){
							selectedRow = 0;
						
							
						} else if(selectedRow <= 0){
							selectedRow = rows.length-1;
						
						}
						/* rows[selectedRow].style.backgroundColor = "#FFFFAA"; */
						cambiotr(selectedRow);
						
					});



				/* ***************** */
				/* $(".tablas1").unbind("click", ".btnEditarabase").click(function(){ */

				$(".tablas1").on("click", ".btnEditarabase", function(){

					
					$('.modal_carga').modal({backdrop: 'static', keyboard: false});
					$('.modal_carga').modal('show');

					var codigohtml="<td></td><td></td><td></td>";
					$("#visiondelempleado").empty();
					$("#visiondelempleado").append(codigohtml);

					$(this).removeClass("empleadoseleccionado");
					
					$(this).addClass("empleadoseleccionado");
					var codigo = $(this).attr("codigo");
					var id = $(this).attr("idempleado");
					var nombre = $(this).attr("nombre");
					var sueldo = $(this).attr("sueldo");
					var salario_por_hora = $(this).attr("salario_por_hora");
					var hora_extra_diurna = $(this).attr("hora_extra_diurna");
					var hora_extra_nocturna = $(this).attr("hora_extra_nocturna");
					var hora_extra_domingo = $(this).attr("hora_extra_domingo");
					var hora_extra_nocturna_domingo = $(this).attr("hora_extra_nocturna_domingo");
					var pensionado_empleado = $(this).attr("pensionado_empleado");
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
					$(".mostrar_devengo_admin").attr("sueldo",sueldo);
					$(".valor_devengo_planilla").attr("idempleado",id);
					$("#pensionado_empleado").val(pensionado_empleado);

				
					valor_devengo_admin();
					editar(codigo,id,nombre,sueldo);
					calculos(id,sueldo);
					cargarrecibos(id);

				/* 	setInterval(valor_devengo_admin(),300);
					setInterval(editar(codigo,id,nombre,sueldo),300);
					setInterval(calculos(id,sueldo),300); */
					/* repetir(codigo,id,nombre,sueldo); */

					setInterval(repetir(),200);
					/* --------------------- */
					/* clearInterval(intervaloID1);
					intervaloID1 = setInterval(function() {
						repetir();
					}, 200); */
					/* ---------------------- */
					
					/* cargarporcentajes(id); */
					/* $('#total_devengo_admin_planilladevengo_admin').change();  */
					$(".btnEditarabase").removeAttr("style");
					$(this).attr("style","background: lightblue;");

					departamentoempleado(id);
					ubicacionempleado(id);

				});

			

				/* ****eliminar empleado */
				$(".tablas1").on("click", ".eliminarempleado", function(){
					var idempleado = $(this).attr("idempleado");
					var numero_planilla=$(this).attr("numero_planilla");
					eliminarempleado(idempleado,numero_planilla);
				});

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
						},
					"paging": false
				});
			
			}
		});

		/* *********** */


	}
}

function cargardataempleados_admin(){

	var tipo_planilladevengo_admin=$("#tipo_planilladevengo_admin").val();
	var periodo_planilladevengo_admin=$("#periodo_planilladevengo_admin").val();
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var descripcion_planilladevengo_admin =$("#descripcion_planilladevengo_admin").val();
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo_admin = $("#fecha_planilladevengo_admin").val();
	var fecha_gratificacion_admin = $("#fecha_gratificacion_admin").val();
	var fecha_desde_planilladevengo_admin = $("#fecha_desde_planilladevengo_admin").val();
	var fecha_hasta_planilladevengo_admin = $("#fecha_hasta_planilladevengo_admin").val();
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

	if(fecha_planilladevengo_admin==""){
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
		'&fecha_planilladevengo_admin=' +fecha_planilladevengo_admin+
		'&fecha_gratificacion_admin=' +fecha_gratificacion_admin+
		'&fechaperiodo1=' +fecha_desde_planilladevengo_admin+
		'&fechaperiodo2=' +fecha_hasta_planilladevengo_admin+
		'&tipo_planilladevengo_admin=' +tipo_planilladevengo_admin+
		'&periodo_planilladevengo_admin=' +periodo_planilladevengo_admin+
		'&numero_planilladevengo_admin=' +numero_planilladevengo_admin+
		'&descripcion_planilladevengo_admin=' +descripcion_planilladevengo_admin+
		'&accion01=empleadosguardados';

		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo_admin.ajax.php",
			type: 'post',
			success: function (response) {

				if(response!=""){
					$('.modal_carga').modal({backdrop: 'static', keyboard: true});
					$('.modal_carga').modal('hide');	
				}

				console.log(response+"funcion cargardataempleados_admin");

			
				$("#tabla_empleados").empty();
				$("#tabla_empleados").append(response);

				var bitacora=$(".bitacora").val();
				if(bitacora=='Cerrar'){
					$(".eliminarempleado").attr("disabled","disabled");
				}

		
				/* ***********MOVER EN TABLA ***** */


				var $tbl = $('#tbl_byKeyboard');
				var $cur = $('.empleadoseleccionado', $tbl).first();
				var seconds = 0; //número de segundos a contar

				/* *************************** */
				function secondPassed() {
					var minutes = Math.trunc(seconds/60); //calcula el número de minutos
					var remainingSeconds = seconds % 60; //calcula los segundos restantes
					//si los segundos usan sólo un dígito, añadimos un cero a la izq
					if (remainingSeconds < 10) { 
						remainingSeconds = "0" + remainingSeconds; 
					} 
					/* document.getElementById('countdown').innerHTML = minutes + ":" +     remainingSeconds;  */
					console.log(remainingSeconds); 
					if (seconds == 0) { 
						clearInterval(countdownTimer); 
						/* rows[selectedRow].click(); */
					} else { 
						seconds--; 
					} 
				} 
				var countdownTimer;
				/* *************************** */
				var rows = document.getElementById("tbl_byKeyboard").children[1].children;
				var selectedRow = 0;


					/* document.body.onkeydown = function(e){ */
					document.addEventListener("keydown", event => {
						//Prevent page scrolling on keypress
						/* e.preventDefault(); */
						//Clear out old row's color
						rows[selectedRow].style.backgroundColor = "#FFFFFF";
						/* var $scrollable = $("#tabla_empleados"); */
				
						//Calculate new row
						if(event.keyCode == 38){
							selectedRow--;
						} else if(event.keyCode == 40){
							selectedRow++;
							$("body").attr("style","overflow-y: hidden;");
						}else if(event.keyCode == 13){
							rows[selectedRow].click();
						}
						
						if(selectedRow == rows.length){
							selectedRow = 0;
						
							
						} else if(selectedRow <= 0){
							selectedRow = rows.length-1;
						
						}
						/* rows[selectedRow].style.backgroundColor = "#FFFFAA"; */
						cambiotr(selectedRow);
						
					});



				/* ***************** */
				/* $(".tablas1").unbind("click", ".btnEditarabase").click(function(){ */

				$(".tablas1").on("click", ".btnEditarabase", function(){
					
					var bitacora=$(".bitacora").val();
					if(bitacora=='Cerrar'){
						$(".guardarplanilla").attr("style","display:none");
						var numero_planilla=$("#numero_planilladevengo_admin").val();
						var id = $(this).attr("idempleado");
						$(".mostrar_devengo_admin").removeAttr("disabled");
						$(".nuevo_empleado").attr("disabled","disabled");
						$(".guardardevengo").attr("disabled","disabled");
					
						mostrardatostable(numero_planilla,id);
					}
					else{

							$('.modal_carga').modal({backdrop: 'static', keyboard: false});
							$('.modal_carga').modal('show');

							var codigohtml="<td></td><td></td><td></td>";
							$("#visiondelempleado").empty();
							$("#visiondelempleado").append(codigohtml);

							$(this).removeClass("empleadoseleccionado");
							
							$(this).addClass("empleadoseleccionado");
							var codigo = $(this).attr("codigo");
							var id = $(this).attr("idempleado");
							var nombre = $(this).attr("nombre");
							var sueldo = $(this).attr("sueldo");
							var salario_por_hora = $(this).attr("salario_por_hora");
							var hora_extra_diurna = $(this).attr("hora_extra_diurna");
							var hora_extra_nocturna = $(this).attr("hora_extra_nocturna");
							var hora_extra_domingo = $(this).attr("hora_extra_domingo");
							var hora_extra_nocturna_domingo = $(this).attr("hora_extra_nocturna_domingo");
							var pensionado_empleado = $(this).attr("pensionado_empleado");
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
							$(".mostrar_devengo_admin").attr("sueldo",sueldo);
							$(".valor_devengo_planilla").attr("idempleado",id);
							$("#pensionado_empleado").val(pensionado_empleado);

							valor_devengo_admin();
							editar(codigo,id,nombre,sueldo);
							calculos(id,sueldo);
							cargarrecibos(id);
						/* 	setInterval(valor_devengo_admin(),300);
							setInterval(editar(codigo,id,nombre,sueldo),300);
							setInterval(calculos(id,sueldo),300); */
							/* repetir(codigo,id,nombre,sueldo); */


							setInterval(repetir(),200);
							/* --------------------- */
							/* clearInterval(intervaloID1);
							intervaloID1 = setInterval(function() {
								repetir(codigo,id,nombre,sueldo);
							}, 200); */

							/* ---------------------- */


							/* cargarporcentajes(id); */
							/* $('#total_devengo_admin_planilladevengo_admin').change();  */
							$(".btnEditarabase").removeAttr("style");
							$(this).attr("style","background: lightblue;");

							departamentoempleado(id);
							ubicacionempleado(id);
							onlydiastrabajados(id);

					}

				});

				
				function mostrardatostable(numero_planilla,id){
					
						var dataString = 'accion01=tablaoriginal&numero='+numero_planilla+'&idempleado='+id+'';
						$.ajax({
							data: dataString,
							url: "ajax/planilladevengo_admin.ajax.php",
							type: 'post',
							success: function (response) {

								
								datos = JSON.parse(response);
								/* fecha_contratacion=datos[0].fecha_contratacion; */
								$("#dias_trabajo_planilladevengo_admin").val(datos[0].dias_trabajo_planilladevengo_admin);

								$("#sueldo_diario").val(datos[0].sueldo_diario);
								$("#sueldo_planilladevengo_admin").val(datos[0].sueldo_planilladevengo_admin);
								$("#dias_incapacidad").val(datos[0].dias_incapacidad);
								$("#septimo_admin").val(datos[0].septimo_admin);
								$("#dias_ausencia").val(datos[0].dias_ausencia);
								$("#hora_extra_diurna_planilladevengo_admin").val(datos[0].hora_extra_diurna_planilladevengo_admin);
								$("#hora_extra_nocturna_planilladevengo_admin").val(datos[0].hora_extra_nocturna_planilladevengo_admin);
								$("#hora_extra_domingo_planilladevengo_admin").val(datos[0].hora_extra_domingo_planilladevengo_admin);
								$("#hora_extra_domingo_nocturna_planilladevengo_admin").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_admin);
								$("#otro_devengo_admin_planilladevengo_admin").val(datos[0].otro_devengo_admin_planilladevengo_admin);
								$("#total_devengo_admin_planilladevengo_admin").val(datos[0].total_devengo_admin_planilladevengo_admin);
								$("#descuento_isss_planilladevengo_admin").val(datos[0].descuento_isss_planilladevengo_admin);
								$("#descuento_afp_planilladevengo_admin").val(datos[0].descuento_afp_planilladevengo_admin);
								$("#descuento_renta_planilladevengo_admin").val(datos[0].descuento_renta_planilladevengo_admin);
								$("#otro_descuento_planilladevengo_admin").val(datos[0].otro_descuento_planilladevengo_admin);
								$("#total_descuento_planilladevengo_admin").val(datos[0].total_descuento_planilladevengo_admin);
								$("#total_liquidado_planilladevengo_admin").val(datos[0].total_liquidado_planilladevengo_admin);
								$("#sueldo_renta_planilladevengo_admin").val(datos[0].sueldo_renta_planilladevengo_admin);
								$("#sueldo_isss_planilladevengo_admin").val(datos[0].sueldo_isss_planilladevengo_admin);
								$("#sueldo_afp_planilladevengo_admin").val(datos[0].sueldo_afp_planilladevengo_admin);
								$("#departamento_planilladevengo_admin").val(datos[0].departamento_planilladevengo_admin);
								$("#nombre_ubicacion_planilladevengo_admin").val(datos[0].nombre_ubicacion_planilladevengo_admin);
								$("#fecha_contratacion").val(datos[0].fecha_contratacion);
								$("#observacion_planilladevengo_admin").val(datos[0].observacion_planilladevengo_admin);
								$("#idempleado_devengo").val(datos[0].id_empleado_planilladevengo_admin);

								
							}
						});
				}
			

				/* ****eliminar empleado */
				$(".tablas1").on("click", ".eliminarempleado", function(){
					var idempleado = $(this).attr("idempleado");
					var numero_planilla=$(this).attr("numero_planilla");
					eliminarempleado(idempleado,numero_planilla);
				});

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
						},
					"paging": false
				});
			
			}
		});

		/* *********** */


	}
}


function onlydiastrabajados(id){

	
	/* dias trabajo */
			/* *********** */
			var dataString = 'accion01=onlydiastrabajados'+"&idempleado="+id;
			$.ajax({
				data: dataString,
				url: "ajax/planilladevengo_admin.ajax.php",
				type: 'post',
				success: function (response) {
				
                    datos = JSON.parse(response);
					fecha_contratacion=datos[0].fecha_contratacion;
					/* formato */
					var fechaInput=$("#fecha_planilladevengo_admin").val();
					var partesFecha = fechaInput.split("-");
					var nuevoFormato = partesFecha[2]+"-"+partesFecha[1]+"-"+partesFecha[0];
					/*--------------------  */
					
						var date1 = new Date(fecha_contratacion);
						var date2 = new Date(nuevoFormato);
						var diferenciaMilisegundos = Math.abs(date2 - date1);
						var diferenciaDias = Math.ceil(diferenciaMilisegundos / (1000 * 60 * 60 * 24));
						if(diferenciaDias>=15)
						{
							diferenciaDias=15;
						}
						if(diferenciaDias<15){
							diferenciaDias=diferenciaDias+1;
						}
						$("#onlydias_trabajo").val(diferenciaDias);
				}
			});

			/* *********** */

}
function departamentoempleado(id1){

	var dataString = 'id=' +id1 +
	'&accion01=departamentoempleado';

	$.ajax({
		url: "ajax/planilladevengo_admin.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {

			var datos = JSON.parse(response);
			$("#departamento_planilladevengo_admin").val(datos[0].nombre).trigger('change.select2');
				


		}
	});

}


function ubicacionempleado(id1){

	var dataString = 'id=' +id1 +
	'&accion01=ubicacionempleado1';
	

	$.ajax({
		url: "ajax/planilladevengo_admin.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			var datos = JSON.parse(response);
			$("#codigo_ubicacion_planilladevengo_admin").val(datos[0].codigo_ubicacion);
			$("#nombre_ubicacion_planilladevengo_admin").val(datos[0].nombre_ubicacion);
			$("#id_ubicacion_planilladevengo_admin").val(datos[0].idubicacion);

		}
	});

}
function cargarrecibos(idempleado){
	var dataString = 'idempleado=' +idempleado +
	'&accion01=cargarrecibos';

	$.ajax({
		url: "ajax/planilladevengo_admin.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			$("#recibospendientes").empty();
			$("#recibospendientes").append(response);

		}
	});
}
function cambiotr(selectedRow1){

	var rows = document.getElementById("tbl_byKeyboard").children[1].children;
	
	$(".btnEditarabase").removeClass("selecciontr");
	$("#visiondelempleado").removeClass("selecciontr");
	rows[selectedRow1].className += ' ' + "selecciontr";
	var resultado = $(".selecciontr").html();
	$("#visiondelempleado").empty();
	$("#visiondelempleado").append(resultado);
}

function repetir(){
	/* editar(codigo,id,nombre,sueldo); */
	/* $(".empleadoseleccionado").trigger("click"); */
	var codigo=$("#txt_codigo").val();
	var id=$("#txt_idempleado").val();
	var nombre=$("#txt_nombre").val();
	var sueldo=$("#txt_sueldo").val();
	setInterval(editar(codigo,id,nombre,sueldo),400);
	/* --------------------- */
	/* editar(codigo,id,nombre,sueldo); */
	/* intervaloID1 = setInterval(function() {
		editar(codigo,id,nombre,sueldo);
	 }, 200); */
	 /* editar(codigo,id,nombre,sueldo); */
	/* ---------------------- */
}
function actualizar_datos(codigo,id,nombre,sueldo){
	valor_devengo_admin();
	editar(codigo,id,nombre,sueldo);
	calculos(id,sueldo);
	setTimeout(function(){
		valor_devengo_admin();
		editar(codigo,id,nombre,sueldo);
		calculos(id,sueldo);
	}, 200);
}





/* ELIMINAR EMPLEADO******************************** */
function eliminarempleado(idempleados,numero_planillas){

	validarmodalcerrada(idempleados,numero_planillas);
	
}

function validarmodalcerrada(idempleados,numero_planillas){

	$('.modal_carga').on('hidden.bs.modal', function() {
		var dataString = 'numero_planilladevengo_admin=' +numero_planillas +
		'&id_empleado_planilladevengo_admin=' +idempleados+
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
					url: "ajax/planilladevengo_admin.ajax.php",
					method: 'post',
					data: dataString,
					success: function (response) {
						
						if($.trim(response)=="Ok"){
							
								location.reload();
							

						}
		
						/* alert(response); */
						/* console.log(response);
						$('#myModal').modal('toggle'); */
					}
				});
		
			}
		
		})
	})

}

/* ****eliminar plantilla */
$(".tablas").on("click", ".eliminarallplantilla", function(){
	var numero_planilladevengo_admin = $(this).attr("numero_planilladevengo_admin");
	eliminarplantilla(numero_planilladevengo_admin);
});


/* ELIMINAR PLANTILLA******************************** */
function eliminarplantilla(numero_planillas){


	var dataString = 'numero_planilladevengo_admin=' +numero_planillas +
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
				url: "ajax/planilladevengo_admin.ajax.php",
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

/*=============================================
EDITAR 
=============================================*/
 function editar(codigo1,id1,nombre1,sueldo){
	

	$("#dias_trabajo_planilladevengo_admin").val("");
	$("#sueldo_planilladevengo_admin").val("");
	$("#hora_extra_diurna_planilladevengo_admin").val("");
	$("#hora_extra_nocturna_planilladevengo_admin").val("");
	$("#hora_extra_domingo_planilladevengo_admin").val("");
	$("#hora_extra_domingo_nocturna_planilladevengo_admin").val("");
	$("#otro_devengo_admin_planilladevengo_admin").val("");
	$("#total_devengo_admin_planilladevengo_admin").val("");
	$("#descuento_isss_planilladevengo_admin").val("");
	$("#descuento_afp_planilladevengo_admin").val("");
	$("#descuento_renta_planilladevengo_admin").val("");
	$("#otro_descuento_planilladevengo_admin").val("");
	$("#total_descuento_planilladevengo_admin").val("");
	$("#total_liquidado_planilladevengo_admin").val("");
	$("#sueldo_renta_planilladevengo_admin").val("");
	$("#sueldo_isss_planilladevengo_admin").val("");
	$("#sueldo_afp_planilladevengo_admin").val("");
	$("#observacion_planilladevengo_admin").val("");
	$("#dias_incapacidad").val("");


	var accion_realizar = "obtenerdata";
	var idabase = codigo1;
	var dataString = 'consultarempleado=' +idabase+'&accion01=' +accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo_admin.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
				
				$(".mostrar_devengo_admin").removeAttr("disabled");
				var datos = JSON.parse(response);
				console.log(response+"funcion editar");
				console.log(datos[0].codigo_empleado_planilladevengo_admin);

			
				$(".idempleado_devengo").val(id1);/* --este campo es devengo */
				/* $(".id_devengo_admin").val(datos[0].id); */

				/* OBTENER DATOS DEL EMPLEADO*********** */
				$("#codigo_empleado_planilladevengo_admin").val(codigo1);
				$("#nombre_empleado_planilladevengo_admin").val(nombre1);
				$("#id_empleado_planilladevengo_admin").val(id1);

				/* $("#sueldo_planilladevengo_admin").val(sueldo); */
				/* $("#sueldo_planilladevengo_admin").val("0"); */

				$("#otro_devengo_admin_planilladevengo_admin").val(datos[0].valorempleado);

				/* $("#hora_extra_diurna_planilladevengo_admin").val(datos[0].hora_extra_diurna_planilladevengo_admin);
				$("#hora_extra_nocturna_planilladevengo_admin").val(datos[0].hora_extra_nocturna_planilladevengo_admin);
				$("#hora_extra_domingo_planilladevengo_admin").val(datos[0].hora_extra_domingo_planilladevengo_admin);
				$("#hora_extra_domingo_nocturna_planilladevengo_admin").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_admin); */


				/* $("#departamento_planilladevengo_admin").val(datos[0].nombredepartamento); */

				/* $("#total_devengo_admin_planilladevengo_admin").val(datos[0].valorempleado); */

			/* 	$("#total_devengo_admin_planilladevengo_admin").val(datos[0].valor); */

					var tipo = "suma";
					cargardatadevengo(tipo);
					var tipo2 = "resta";
					cargardatadescuento(tipo2);
					empleados_devengos();
					obtenerdata_total(codigo1,id1,nombre1);


	



				/* $("#numero_planilladevengo_admin").val(datos[0].numero_planilladevengo_admin);
				$("#fecha_planilladevengo_admin").val(datos[0].fecha_planilladevengo_admin);
				$("#fecha_desde_planilladevengo_admin").val(datos[0].fecha_desde_planilladevengo_admin);
				$("#fecha_hasta_planilladevengo_admin").val(datos[0].fecha_hasta_planilladevengo_admin);
				$("#descripcion_planilladevengo_admin").val(datos[0].descripcion_planilladevengo_admin); */
	
		/* 		$("#dias_trabajo_planilladevengo_admin").val(datos[0].dias_trabajo_planilladevengo_admin);
				$("#sueldo_planilladevengo_admin").val(datos[0].sueldo_planilladevengo_admin);
				$("#hora_extra_diurna_planilladevengo_admin").val(datos[0].hora_extra_diurna_planilladevengo_admin);
				$("#hora_extra_nocturna_planilladevengo_admin").val(datos[0].hora_extra_nocturna_planilladevengo_admin);
				$("#hora_extra_domingo_planilladevengo_admin").val(datos[0].hora_extra_domingo_planilladevengo_admin);
				$("#hora_extra_domingo_nocturna_planilladevengo_admin").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_admin);
				$("#otro_devengo_admin_planilladevengo_admin").val(datos[0].otro_devengo_admin_planilladevengo_admin);
				$("#total_devengo_admin_planilladevengo_admin").val(datos[0].total_devengo_admin_planilladevengo_admin);
				$("#descuento_isss_planilladevengo_admin").val(datos[0].descuento_isss_planilladevengo_admin);
				$("#descuento_afp_planilladevengo_admin").val(datos[0].descuento_afp_planilladevengo_admin);
				$("#descuento_renta_planilladevengo_admin").val(datos[0].descuento_renta_planilladevengo_admin);
				$("#otro_descuento_planilladevengo_admin").val(datos[0].otro_descuento_planilladevengo_admin);
				$("#total_descuento_planilladevengo_admin").val(datos[0].total_descuento_planilladevengo_admin); */

			/* 	$("#total_liquidado_planilladevengo_admin").val(datos[0].total_liquidado_planilladevengo_admin); */
		/* 		$("#sueldo_renta_planilladevengo_admin").val(datos[0].sueldo_renta_planilladevengo_admin);
				$("#sueldo_isss_planilladevengo_admin").val(datos[0].sueldo_isss_planilladevengo_admin);
				$("#sueldo_afp_planilladevengo_admin").val(datos[0].sueldo_afp_planilladevengo_admin); */
				/* $("#departamento_planilladevengo_admin").val(datos[0].departamento_planilladevengo_admin); */

			
				/* $("#observacion_planilladevengo_admin").val(datos[0].observacion_planilladevengo_admin); */
		/* 		$("#periodo_planilladevengo_admin").val(datos[0].periodo_planilladevengo_admin);
				$("#tipo_planilladevengo_admin").val(datos[0].tipo_planilladevengo_admin); */
				/* $("#dias_incapacidad").val(datos[0].dias_incapacidad); */
	
	
				
			/* 	var tipo = "suma";
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

	var accion_realizar = "obtenerdatatotal";
	var idabase = codigo1;
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var dataString = 'consultarempleado=' +id1+'&numero_planilladevengo_admin='+numero_planilladevengo_admin+'&accion01=' +accion_realizar;


		$.ajax({
			
			url: "ajax/planilladevengo_admin.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
				var datos = JSON.parse(response);
				console.log(response+"funcion obtenerdata_total");
				console.log(datos[0].id_empleado_planilladevengo_admin);
				$("#dias_trabajo_planilladevengo_admin").val(datos[0].dias_trabajo_planilladevengo_admin);
				$("#his_dias_trabajo_admin").val(datos[0].his_dias_trabajo_admin);

				$("#historial_dias_trabajo").val(datos[0].dias_trabajo_planilladevengo_admin);

				$("#dias_incapacidad").val(datos[0].dias_incapacidad);
				$("#dias_ausencia").val(datos[0].dias_ausencia);
				var valor_septimo="";
				if(datos[0].septimo_admin===null){
					valor_septimo="0";
				}
				else{
					valor_septimo=datos[0].septimo_admin;
				}
				$("#septimo_admin").val(valor_septimo);
				$("#sueldo_planilladevengo_admin").val(datos[0].sueldo_planilladevengo_admin);

				

				$("#hora_extra_diurna_planilladevengo_admin").val(datos[0].hora_extra_diurna_planilladevengo_admin);
				$("#hora_extra_nocturna_planilladevengo_admin").val(datos[0].hora_extra_nocturna_planilladevengo_admin);
				$("#hora_extra_domingo_planilladevengo_admin").val(datos[0].hora_extra_domingo_planilladevengo_admin);
				$("#hora_extra_domingo_nocturna_planilladevengo_admin").val(datos[0].hora_extra_domingo_nocturna_planilladevengo_admin);
				if(datos[0].otro_devengo_admin_planilladevengo_admin!=""){
					$("#otro_devengo_admin_planilladevengo_admin").val(datos[0].otro_devengo_admin_planilladevengo_admin);
				}
				if(datos[0].total_devengo_admin_planilladevengo_admin != ""){
					/* $("#total_devengo_admin_planilladevengo_admin").val(datos[0].total_devengo_admin_planilladevengo_admin); */
				}

	
				if(datos[0].otro_devengo_admin_planilladevengo_admin=="" || datos[0].otro_devengo_admin_planilladevengo_admin=="NaN"){
					$("#otro_devengo_admin_planilladevengo_admin").val("0");
				}
				else{
					$("#otro_devengo_admin_planilladevengo_admin").val(datos[0].otro_devengo_admin_planilladevengo_admin);
				}
				if(datos[0].total_devengo_admin_planilladevengo_admin=="" || datos[0].total_devengo_admin_planilladevengo_admin=="NaN"){
					$("#total_devengo_admin_planilladevengo_admin").val("0");
				}
				else{
					$("#total_devengo_admin_planilladevengo_admin").val(datos[0].total_devengo_admin_planilladevengo_admin);
				}
				if(datos[0].descuento_isss_planilladevengo_admin=="" || datos[0].descuento_isss_planilladevengo_admin=="NaN"){
					$("#descuento_isss_planilladevengo_admin").val("0");
				}
				else{
					$("#descuento_isss_planilladevengo_admin").val(datos[0].descuento_isss_planilladevengo_admin);
				}
				if(datos[0].descuento_afp_planilladevengo_admin=="" || datos[0].descuento_afp_planilladevengo_admin=="NaN"){
					$("#descuento_afp_planilladevengo_admin").val();
				}
				else{
					$("#descuento_afp_planilladevengo_admin").val(datos[0].descuento_afp_planilladevengo_admin);

				}
				if(datos[0].descuento_renta_planilladevengo_admin=="" || datos[0].descuento_renta_planilladevengo_admin=="NaN"){
					$("#descuento_renta_planilladevengo_admin").val("0");
				}
				else{
					$("#descuento_renta_planilladevengo_admin").val(datos[0].descuento_renta_planilladevengo_admin);

				}
				if(datos[0].otro_descuento_planilladevengo_admin=="" || datos[0].otro_descuento_planilladevengo_admin=="NaN"){
					$("#otro_descuento_planilladevengo_admin").val("0");

				}
				else{
					$("#otro_descuento_planilladevengo_admin").val(datos[0].otro_descuento_planilladevengo_admin);

				}
				if(datos[0].total_descuento_planilladevengo_admin=="" || datos[0].total_descuento_planilladevengo_admin=="NaN"){
					$("#total_descuento_planilladevengo_admin").val("0");

				}
				else{
					$("#total_descuento_planilladevengo_admin").val(datos[0].total_descuento_planilladevengo_admin);
				}

				if(datos[0].total_descuento_planilladevengo_admin != "")
				{
					$("#total_descuento_planilladevengo_admin").val(datos[0].total_descuento_planilladevengo_admin);
				}
				if(datos[0].total_liquidado_planilladevengo_admin != ""){
					$("#total_liquidado_planilladevengo_admin").val(datos[0].total_liquidado_planilladevengo_admin);
				}
				
				if(datos[0].sueldo_renta_planilladevengo_admin==""){
					$("#sueldo_renta_planilladevengo_admin").val("0");
				}
				else{
					$("#sueldo_renta_planilladevengo_admin").val(datos[0].sueldo_renta_planilladevengo_admin);
				}
				$("#sueldo_isss_planilladevengo_admin").val(datos[0].sueldo_isss_planilladevengo_admin);
				$("#sueldo_afp_planilladevengo_admin").val(datos[0].sueldo_afp_planilladevengo_admin);
				$("#observacion_planilladevengo_admin").val(datos[0].observacion_planilladevengo_admin);
			

				var idempleado=$("#id_empleado_planilladevengo_admin").val();
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


$( ".mostrar_devengo_admin" ).on( "click", function() {

	
	var sujeto_renta_original=$("#sueldo_renta_planilladevengo_admin").val();
	var sujeto_isss_original=$("#sueldo_isss_planilladevengo_admin").val();
	var sujeto_afp_original=$("#sueldo_afp_planilladevengo_admin").val();

	$("#totalsujetorenta").val(sujeto_renta_original);
	$("#totalsujetoisss").val(sujeto_isss_original);
	$("#totalsujetoafp").val(sujeto_afp_original);


	var tipo = $(this).attr("tipo");
	if(tipo=="Suma"){
		cargardatadevengo(tipo);
		$(".tipodescuento").removeClass("mi-selector");
		$(".tipodevengo").addClass("mi-selector");
        $('.mi-selector').select2();

	}
	else{
				
		var txt_idempleado=$("#txt_idempleado").val();
		cargarrecibos(txt_idempleado);
		cargardatadescuento(tipo);
		$(".tipodevengo").removeClass("mi-selector");
		$(".tipodescuento").addClass("mi-selector");
        $('.mi-selector').select2();
	}



  });

/* consultar datos de devengo y descuentos por empleado */
function cargardatadevengo(tipo){

	var numero_planilla=$("#numero_planilladevengo_admin").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	var tipo = tipo;
	var sueldo = $(".mostrar_devengo_admin").attr("sueldo");
	var accion="consultard"
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_admin.ajax.php",
		type: 'post',
		success: function (response) {
			console.log(response);
			 $(".devengodelempleado").empty();
			 $(".devengodelempleado").append(response);

					
			var bitacora=$(".bitacora").val();
			if(bitacora=='Cerrar'){
				$(".modificar").attr("style","display:none");
				$(".eliminar").attr("style","display:none");
			}


			 $(".tablas").on("click", ".modificar", function(){
				var id = $(this).attr("id");
				editardevengo(id);
			})
			$(".tablas").on("click", ".eliminar", function(){
				var id = $(this).attr("id");
				var idempleado_devengo=$(this).attr("idempleado_devengo");
				eliminardevengo_admin(id, idempleado_devengo);
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

	var numero_planilla=$("#numero_planilladevengo_admin").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	var tipo = tipo;
	var sueldo = $(".mostrar_devengo_admin").attr("sueldo");
	var accion="consultard"
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_admin.ajax.php",
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
				eliminardevengo_admin(id, idempleado_devengo);
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
	var idrecibo = $("#idrecibo").val();
	var valor_dias_Feriados = $("#valor_dias_Feriados").val();
	var dias_Feriados = $("#dias_Feriados").val();


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
					'&idrecibo='+idrecibo+
					'&valor_dias_Feriados='+valor_dias_Feriados+
					'&dias_Feriados='+dias_Feriados+
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
								
									var txt_codigo =$("#txt_codigo").val();
									var txt_idempleado=$("#txt_idempleado").val();
									var txt_nombre=$("#txt_nombre").val();
									var txt_sueldo=$("#txt_sueldo").val();
									var txt_salario_por_hora=$("#txt_salario_por_hora").val();

									actualizar_datos(txt_codigo,txt_idempleado,txt_nombre);
									cargarrecibos(txt_idempleado);
									vaciar();
									$('.modales').modal('hide');


							}
						});


					}
					else{
						/* *************** */
						$.ajax({
							data: dataString,
							url: "ajax/planilladevengo_admin.ajax.php",
							type: 'post',
							success: function (response) {


								var valorliquido=$(".originalliquido").val();
					/* 			if(tipo_valor=="+Suma"){
									$("#total_liquidado_planilladevengo_admin").val(parseFloat(valorliquido)+parseFloat(valor_devengo_planilla));
									$("#otro_devengo_admin_planilladevengo_admin").val();
								}

								if(tipo_valor=="-Resta"){
									$("#total_liquidado_planilladevengo_admin").val(parseFloat(valorliquido)-parseFloat(valor_devengo_planilla));
									$("#otro_devengo_admin_planilladevengo_admin").val();
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
										var txt_codigo =$("#txt_codigo").val();
										var txt_idempleado=$("#txt_idempleado").val();
										var txt_nombre=$("#txt_nombre").val();
										var txt_sueldo=$("#txt_sueldo").val();
										var txt_salario_por_hora=$("#txt_salario_por_hora").val();
	
										actualizar_datos(txt_codigo,txt_idempleado,txt_nombre);
										vaciar();

										/* vaciar();
										location.reload(); */
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

	/* $("#accion_devengo").val("modificardevengo_admin"); */
	var id = id1;
	var accion_realizar="obtenerdatadevengo";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;

		$.ajax({
			url: "ajax/planilladevengo_admin.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {

				var datos = JSON.parse(response);
				$(".id_devengo").val(id);
				$(".codigo_devengo_descuento_planilla").val(datos[0].codigo_devengo_descuento_planilla);
				$(".descripcion_devengo_descuento_planilla").val(datos[0].descripcion_devengo_descuento_planilla);
				$(".tipo_devengo_descuento_planilla").val(datos[0].tipo_devengo_descuento_planilla).trigger('change.select2');;
				/* $(".tipo_devengo_descuento_planilla option[value="+ datos[0].tipo_devengo_descuento_planilla +"]").attr("selected",true); */	 
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


				if(datos[0].codigo_devengo_descuento_planilla=="0023"){
					/* diasferiados(datos[0].idempleado_devengo); */
					$(".ocultarhorasllegas").removeAttr("style");
					$("#horas_tardes").val(datos[0].horas_tardes);
					$("#precio_horas_tardes").val(datos[0].precio_horas_tardes);
				}


				if(datos[0].codigo_devengo_descuento_planilla=="0021"){
					/* diasferiados(datos[0].idempleado_devengo); */
					$(".ocultardiasferiados").removeAttr("style");
					$("#dias_Feriados").val(datos[0].dias_Feriados);
					$("#valor_dias_Feriados").val(datos[0].valor_dias_Feriados);
				}

				if(datos[0].codigo_devengo_descuento_planilla=="0031"){
					/* diasferiados(datos[0].idempleado_devengo); */
					$(".dias_trabajados_inca").removeAttr("style");
					$("#dias_tra_inca_admin").val(datos[0].dias_tra_inca_admin);
					$("#pago_dias_tra_inca_admin").val(datos[0].pago_dias_tra_inca_admin);
				}
				else{
					$(".dias_trabajados_inca").attr("style","display:none;");
				}
				if(datos[0].codigo_devengo_descuento_planilla=="0033"){
					/* diasferiados(datos[0].idempleado_devengo); */
					$(".diasincapacidad").removeAttr("style");
					$("#dias_incapacidad_admin").val(datos[0].dias_incapacidad_admin);
					$("#pago_dias_incapacidad_admin").val(datos[0].pago_dias_incapacidad_admin);
				}
				else{
					$(".diasincapacidad").attr("style","display:none;");
				}

			}
		});
};

$("#dias_Feriados").blur(function(){
	var valor= $(this).val();
	var sueldo_feriado=$("#valor_dias_Feriados").val();

	var total=parseFloat(valor)*parseFloat(sueldo_feriado);
	$("#valor_devengo_planilla").val(total);
  });

  /* por el momento no esta funcionando este fuxtion */
function diasferiados(idempleado){

	var fecha_planilladevengo_admin=$("#fecha_planilladevengo_admin").val();
	var accion_realizar="diasferiado";
	var dataString = 'idempleado=' +idempleado+'&accion01='+accion_realizar+'&fecha_planilladevengo_admin='+fecha_planilladevengo_admin;

		$.ajax({
			url: "ajax/planilladevengo_admin.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
				alert(response);
			}
		});
};


function eliminardevengo_admin(id1, idempleado){
	var id = id1;
	var accion_realizar="eliminardevengo";
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar+'&idempleado='+idempleado+'&numero_planilladevengo_admin='+numero_planilladevengo_admin;

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
				url: "ajax/planilladevengo_admin.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					console.log(response);
					/* location.reload(); */
					var txt_codigo =$("#txt_codigo").val();
					var txt_idempleado=$("#txt_idempleado").val();
					var txt_nombre=$("#txt_nombre").val();
					var txt_sueldo=$("#txt_sueldo").val();
					var txt_salario_por_hora=$("#txt_salario_por_hora").val();

					actualizar_datos(txt_codigo,txt_idempleado,txt_nombre);
					cargarrecibos(txt_idempleado);
					setTimeout(function(){
						actualizar_datos(txt_codigo,txt_idempleado,txt_nombre);
					}, 1000);
					$('#descuento').modal('hide');

				}
			});
	
		}
	
	  })
		



};

/* consultar datos de devengo y descuentos de la tabla empleados_devengos_descuentos */
function empleados_devengos(){

	var numero_planilla=$("#numero_planilladevengo_admin").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	/* var tipo = $(".mostrar_devengo_admin").attr("tipo"); */
	var tipo = "suma";
	var sueldo = $(".mostrar_devengo_admin").attr("sueldo");

	var accion="consultardevengosexistentes";


	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_admin.ajax.php",
		type: 'post',
		success: function (response) {
			
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

	var numero_planilla=$("#numero_planilladevengo_admin").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	/* var tipo = "$(".mostrar_devengo_admin").attr("tipo")"; */
	var tipo = "resta";

	var sueldo = $(".mostrar_devengo_admin").attr("sueldo");

	var accion="consultardevengosexistentes";


	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo_admin.ajax.php",
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
			
			url: "ajax/planilladevengo_admin.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
				var datos = JSON.parse(response);
				console.log(response);
				console.log(datos[0].id_empleado_planilladevengo_admin);
				$(".id_devengo").val(id);
				$("#valor_devengo_planilla").val(datos[0].valor)
			}
		});



};


/* eliminar DEVENGO DE LA TABLA empleados_devengos_descuentos*/

function eliminarempleados_devengos_descuentos(id1){
	var id = id1;
	var accion_realizar="eliminarempleados_devengos_descuentos";
	var numero_planilladevengo_admin=$("#numero_planilladevengo_admin").val();
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar+'&numero_planilladevengo_admin='+numero_planilladevengo_admin;

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
				url: "ajax/planilladevengo_admin.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					/* console.log(response); */
					$('#myModal').modal('toggle');
					setTimeout(function(){
						var txt_codigo =$("#txt_codigo").val();
						var txt_idempleado=$("#txt_idempleado").val();
						var txt_nombre=$("#txt_nombre").val();
						var txt_sueldo=$("#txt_sueldo").val();
						var txt_salario_por_hora=$("#txt_salario_por_hora").val();
						actualizar_datos(txt_codigo,txt_idempleado,txt_nombre);
					}, 1500);
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
	$("#idrecibo").val("no");
	$(".ocultardiasferiados").attr("style","visibility:hidden; height:0px");

}

function calculos(id, sueldo){

	var id = id;
	var accion_realizar="calculos";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;
	

		$.ajax({
			
			url: "ajax/planilladevengo_admin.ajax.php",
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
				/* $("#sueldo_renta_planilladevengo_admin").val(descuento_renta); */
				/* RENTA**************** */


			/* 	alert(descuento_renta); */

				
			
				/* var isss_devengo_admin_devengo_admin_descuento_planilla = datos[0].isss_devengo_admin_devengo_admin_descuento_planilla;
				var afp_devengo_admin_devengo_admin_descuento_planilla = datos[0].afp_devengo_admin_devengo_admin_descuento_planilla;
				var renta_devengo_admin_devengo_admin_descuento_planilla = datos[0].renta_devengo_admin_devengo_admin_descuento_planilla;
				var porcentaje_renta_devengo_admin_descuento_planilla = datos[0].porcentaje_renta_devengo_admin_descuento_planilla;
				var porcentaje_isss_devengo_admin_descuento_planilla = datos[0].porcentaje_isss_devengo_admin_descuento_planilla;
				var porcentaje_afp_devengo_admin_descuento_planilla = datos[0].porcentaje_afp_devengo_admin_descuento_planilla;
				var total_devengo_admin_planilladevengo_admin= $("#total_devengo_admin_planilladevengo_admin").val(); */

				
			
			}
		});


}

/* SUJETOS A RENTA ISSS AFP */
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
	var sueldo_afp=$("#sueldo_afp_planilladevengo_admin").val();
	var valor_devengo_planilla=valor_devengo;
	var numero_plan_vacacion=$("#numero_plan_vacacion").val();


	
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla+'&numero_plan_vacacion='+numero_plan_vacacion;
	

	$.ajax({
			
		url: "ajax/planilladevengo_admin.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			var valorliquido=$(".originalliquido").val();

			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];
			var tasa_sobre_excedente = response.split(",")[4];

			$("#porcentaje_isss").val(porcentaje_isss);
			$("#porcentaje_afp").val(porcentaje_afp);
			$("#porcentaje_base1").val(porcentaje_base1);
			$("#porcentaje_base2").val(porcentaje_base2);
			$("#tasa_sobre_excedente").val(tasa_sobre_excedente);

			var calcularporcentaje=porcentaje_afp/100;/* --afp */
			var calcularporcentaje_isss=porcentaje_isss/100;
			var total_afp=0;

			var tope_isss=$("#tope_isss").val();



			if(afp_devengo=="Si"){
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuento_afp_final=valor_devengo_planilla-total_afp;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}

				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_admin").val(calculo_afp);
				/* $("#total_liquidado_planilladevengo_admin").val(descuento_afp_final+Number(valorliquido)); */
			}
			
			if(isss_devengo=="Si"){
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				descuento_iss_final=valor_devengo_planilla-total_isss;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}

				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);
			

				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_admin").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_admin").val(calculo_isss);
				}

				/* $("#total_liquidado_planilladevengo_admin").val(descuento_iss_final+Number(valorliquido)); */
			}
			
			if(renta_devengo=="Si"){
				var sueldo_menos_base= valor_devengo_planilla-porcentaje_base2;
				var tasa_por_exedente=sueldo_menos_base*0.10;
				var descuento_renta=tasa_por_exedente+porcentaje_base1;
				var descuento_renta_final=valor_devengo_planilla-descuento_renta;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_admin").val(descuento_renta_final+Number(valorliquido)); */

			
				/* $("#sueldo_renta_planilladevengo_admin").val(valor_devengo_planilla); */

				/* SUJETO DE RENTA NO SE MAJE AQUI PORQUE LA FORMULA: SUJETO_AFP-DESCUENTO ISSS- DESCUENTO AFP=RENTA */

			}
			

			if(afp_devengo=="Si"&&isss_devengo=="Si"){
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuentos_realizar=valor_devengo_planilla-total_isss-total_afp;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				/* $("#total_liquidado_planilladevengo_admin").val(descuentos_realizar+Number(valorliquido)); */
				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);

				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_admin").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_admin").val(calculo_isss);
				}
				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_admin").val(calculo_afp);
				
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
				/* $("#total_liquidado_planilladevengo_admin").val(descuento_afp_renta+Number(valorliquido)); */

				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_admin").val(calculo_afp);



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
				/* $("#total_liquidado_planilladevengo_admin").val(descuento_isss_renta+Number(valorliquido)); */
				
				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);
				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_admin").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_admin").val(calculo_isss);
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
				/* $("#total_liquidado_planilladevengo_admin").val(descuento_isss_afp_renta+Number(valorliquido)); */

				calculo_isss=parseFloat(sujeto_isss_calculos)+parseFloat(valor_devengo_planilla);
				if(calculo_isss >= tope_isss){
					$("#sueldo_isss_planilladevengo_admin").val(tope_isss);
				}
				else{
					$("#sueldo_isss_planilladevengo_admin").val(calculo_isss);
				}
				var calculo_afp=parseFloat(sujeto_afp_calculos)+parseFloat(valor_devengo_planilla);
				$("#sueldo_afp_planilladevengo_admin").val(calculo_afp);


				console.log("********************************");

				console.log(valor_devengo_planilla+"-valor devengo_admin");
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
				/* $("#total_liquidado_planilladevengo_admin").val(Number(valor_devengo_planilla)+Number(valorliquido)); */
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


	/* if(codigo=="0024")
	{
		var tipo = $(".mostrar_devengo_admin").attr("tipo");
		var sueldo = $(".mostrar_devengo_admin").attr("sueldo");
		consultarviaticos(tipo,sueldo);
		$(".valor_devengo_planilla").attr("readonly","readonly");

		
	}
	else {
		$(".valor_devengo_planilla").removeAttr("readonly");
		$(".valor_devengo_planilla").val("");


	} */


});


/* consulta de viatico por empleado y calculo para devengo_admin */
function consultarviaticos(tipo,sueldo){
	
	var numero_planilla=$("#numero_planilladevengo_admin").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();

	var accion="consultarviatico"
	/* ******************* */
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;

	$.ajax({
		url: "ajax/planilladevengo_admin.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {

				var datos = JSON.parse(response);
				var descripcion_devengo_descuento_planilla = datos[0].descripcion_devengo_descuento_planilla;
				var valor_devengo_planilla = datos[0].valor_devengo_planilla;
				var index = descripcion_devengo_descuento_planilla.indexOf("VIATICOS");
				if(index >= 0) {

				}
				else{
					valor_devengo_planilla=0;
				}
				var suma_sueldo_viatiaco=parseFloat(sueldo)+parseFloat(valor_devengo_planilla);/* --calcular devengo_admin */
				var total_devengo_admin=suma_sueldo_viatiaco*0.30;/* --devengo_admin */
				$(".valor_devengo_planilla").val(total_devengo_admin);
				$("#devengodevengo_admin").val(total_devengo_admin);
	
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
	var numero_plan_vacacion=$("#numero_plan_vacacion").val();

	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla+'&numero_plan_vacacion='+numero_plan_vacacion;
	$.ajax({
			
		url: "ajax/planilladevengo_admin.ajax.php",
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


function valor_devengo_admin(){
	
	var idempleado = $(".valor_devengo_planilla").attr("idempleado");
	var accion_realizar="valordevengo_admin";
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar;
	$.ajax({
			
		url: "ajax/planilladevengo_admin.ajax.php",
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
			$("#devengodevengo_admin").val(valor_devengo_planilla);
		}
	})
	
}


$( "#hora_extra_diurna_planilladevengo_admin").blur(function() {
var valor= $(this).val();
var clase_calculo=$(this).attr("calculo");
var precio_hora=$("#hora_extra_diurna").val();
var calculo=parseFloat(valor)*parseFloat(precio_hora);
$("."+clase_calculo).val(calculo.toFixed(2));
});
$( "#hora_extra_nocturna_planilladevengo_admin").blur(function() {
	var valor= $(this).val();
	var clase_calculo=$(this).attr("calculo");
	var precio_hora=$("#hora_extra_nocturna").val();
	var calculo=parseFloat(valor)*parseFloat(precio_hora);
	$("."+clase_calculo).val(calculo.toFixed(2));
});
$( "#hora_extra_domingo_planilladevengo_admin").blur(function() {
	var valor= $(this).val();
	var clase_calculo=$(this).attr("calculo");
	var precio_hora=$("#hora_extra_domingo").val();
	var calculo=parseFloat(valor)*parseFloat(precio_hora);
	$("."+clase_calculo).val(calculo.toFixed(2));
});
$( "#hora_extra_domingo_nocturna_planilladevengo_admin").blur(function() {
	var valor= $(this).val();
	var clase_calculo=$(this).attr("calculo");
	var precio_hora=$("#hora_extra_nocturna_domingo").val();
	var calculo=parseFloat(valor)*parseFloat(precio_hora);
	$("."+clase_calculo).val(calculo.toFixed(2));
});

 function calculo_horas(){

	if($("#hora_extra_diurna_planilladevengo_admin").val()==""){
		$("#hora_extra_diurna_planilladevengo_admin").val("0");
	}
	if($("#hora_extra_nocturna_planilladevengo_admin").val()==""){
		$("#hora_extra_nocturna_planilladevengo_admin").val("0")
	}
	if($("#hora_extra_domingo_planilladevengo_admin").val()==""){
		$("#hora_extra_domingo_planilladevengo_admin").val("0");
	}
	if($("#hora_extra_domingo_nocturna_planilladevengo_admin").val()==""){
		$("#hora_extra_domingo_nocturna_planilladevengo_admin").val("0")
	}
	var hora_extra=$("#hora_extra_diurna_planilladevengo_admin").val();
	var hora_extra_nocturna=$("#hora_extra_nocturna_planilladevengo_admin").val();
	var hora_extra_domingo=$("#hora_extra_domingo_planilladevengo_admin").val();
	var hora_extra_domingo_noc=$("#hora_extra_domingo_nocturna_planilladevengo_admin").val();

	var precio_hora=$("#salario_por_hora").val();
	var precio_hora_extra_diurna=$("#hora_extra_diurna").val();
	var precio_hora_extra_nocturna= $("#hora_extra_nocturna").val();
	var precio_hora_extra_domingo= $("#hora_extra_domingo").val();
	var precio_hora_extra_nocturna_domingo=$("#hora_extra_nocturna_domingo").val();

	var calculo_extra=parseFloat(hora_extra)*parseFloat(precio_hora_extra_diurna);
	var calculo_extra_nocturna=parseFloat(hora_extra_nocturna)*parseFloat(precio_hora_extra_nocturna);
	var calculo_extra_domingo=parseFloat(hora_extra_domingo)*parseFloat(precio_hora_extra_domingo);
	var calculo_extra_domingo_noc=parseFloat(hora_extra_domingo_noc)*parseFloat(precio_hora_extra_nocturna_domingo);

	$(".calculo_extra_diurna").val(calculo_extra);
	$(".calculo_extra_nocturna").val(calculo_extra_nocturna);
	$(".calculo_extra_domingo").val(calculo_extra_domingo);
	$(".calculo_extra_domingo_noctu").val(calculo_extra_domingo_noc);

}



$("#btnsumarhoras").click(function(){
	/* calcular_afp_iss(); */

	$.ajax({
		url:calcular_afp_iss(),
		success:function(){
			$('.modal_carga').modal('hide');
			guardarplanillaoculto();
		}
	})

});


$("#restardias").click(function(){

	var dias_trabajado=$("#his_dias_trabajo_admin").val();
	var dias_incapacidad=$("#dias_incapacidad").val();
	var septimo_admin=$("#septimo_admin").val();
	var dias_ausencia=$("#dias_ausencia").val();
	var historial_dias_trabajo=$("#historial_dias_trabajo").val();
	var sueldo_diario=$("#sueldo_diario").val();


	var calculo="";
	calculo=parseFloat(dias_trabajado)-parseFloat(dias_incapacidad)-parseFloat(septimo_admin)-parseFloat(dias_ausencia);

	var calculo_sueldo=parseFloat(calculo)*parseFloat(sueldo_diario);
	$("#dias_trabajo_planilladevengo_admin").val(calculo);
	$("#sueldo_planilladevengo_admin").val(calculo_sueldo);



	setTimeout(function(){
		/* calcular_afp_iss(); */
		$.ajax({
			url:calcular_afp_iss(),
			success:function(){
				$('.modal_carga').modal('hide');
				guardarplanillaoculto();
			}
		})
	}, 1000);	
});

function cargarporcentajes(idempleados){
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
	$("#otro_devengo_admin_planilladevengo_admin").val(solodecimales(totalglobaldevengo));

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
	$("#otro_descuento_planilladevengo_admin").val(totalglobaldescuento);
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

	var validar_empleado_pensi=$("#pensionado_empleado").val();
	var salario_empleado=$("#sueldo_planilladevengo_admin").val();


	if(validar_empleado_pensi=="Si"){
		sumaisss=0;
		sumaafp=0;
	}
	else{
		sumaisss=parseFloat(sumaisss)+parseFloat(salario_empleado);
		sumaafp=parseFloat(sumaafp)+parseFloat(salario_empleado);
	}

	sumarenta=parseFloat(sumarenta)+parseFloat(salario_empleado);
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
	var renta_devengo=$("#sueldo_renta_planilladevengo_admin").val(sumarenta);
	var afp_devengo=$("#sueldo_afp_planilladevengo_admin").val(sumaafp);
	var tope_isss=$("#tope_isss").val();
	if(sumaisss>=tope_isss){
		sumaisss=tope_isss;
	}

	var isss_devengo=$("#sueldo_isss_planilladevengo_admin").val(sumaisss);
	/* var valor_devengo=$(".valor_devengo_planilla").val(); */
	var sueldo_afp=$("#sueldo_afp_planilladevengo_admin").val();
	var sujeto_renta=$("#sueldo_renta_planilladevengo_admin").val();
	var valor_devengo_planilla=sujeto_renta;
	var numero_plan_vacacion=$("#numero_plan_vacacion").val();


	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla+'&numero_plan_vacacion='+numero_plan_vacacion;
	$.ajax({
			
		url: "ajax/planilladevengo_admin.ajax.php",
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
			$("#porcentaje_base1").val(porcentaje_base1);
			$("#porcentaje_base2").val(porcentaje_base2);
			$("#tasa_sobre_excedente").val(tasa_sobre_excedente);

			finalizar_total=1;
			intervaloID2=1;
			suma=suma+1;

					/* calcular_afp_iss(); */
					$.ajax({
						url:calcular_afp_iss(),
						success:function(){

							/* guardarplanillaoculto(); */
							/* setTimeout(function(){varificarliquido()},800); */
							/* varificarliquido(); */
							// Crea una instancia de PerformanceObserver y observa las solicitudes de red
							console.log("data totalmente terminada funcion calcular_afp_iss");
							finalizar_total=0;/* finalizar_total final */
							if(suma>1){
								suma=0;
								intervaloID2=0;
								$.ajax({
									url:guardarplanillaoculto(),
									success:function(){
										fredondear("false");
										calculos_globales();
										varificarliquido();
										$('.modal_carga').modal('hide');

									}
								})
							}
						


						}
					})
				
		   }
	})
}


function calcular_afp_iss(){

	var renta_devengo= $(".renta_devengo_devengo_descuento_planilla").val();
	var afp_devengo=$(".afp_devengo_devengo_descuento_planilla").val();
	var isss_devengo=$(".isss_devengo_devengo_descuento_planilla").val();
	var porcentaje_isss= $("#porcentaje_isss").val();
	var porcentaje_afp= $("#porcentaje_afp").val();

	if($.trim(porcentaje_isss)=="0"){
		$("#sueldo_isss_planilladevengo_admin").val("0");
	}
	if($.trim(porcentaje_afp)=="0"){
		$("#sueldo_afp_planilladevengo_admin").val("0");
	}

	/* ************************* */
	var sueldo_empleado_final=$("#sueldo_planilladevengo_admin").val();
	if($.trim(sueldo_empleado_final)==""){
		sueldo_empleado_final=0;
	}
	if($.trim(sueldo_empleado_final)=="NaN"){
		sueldo_empleado_final=0;
	}
	var valor_renta_original=$("#valor_renta_original").val();/* este es todos los devengos con renta + salario */
	var valor_isss_original=$("#valor_isss_original").val();
	var valor_afp_original=$("#valor_afp_original").val();


	/* var total_renta_salario=parseFloat(valor_renta_original)+parseFloat(sueldo_empleado_final);
	var total_isss_salario=parseFloat(valor_isss_original)+parseFloat(sueldo_empleado_final);
	var total_afp_salario=parseFloat(valor_afp_original)+parseFloat(sueldo_empleado_final); */
	var total_renta_salario=parseFloat(valor_renta_original);
	var total_isss_salario=parseFloat(valor_isss_original);
	var total_afp_salario=parseFloat(valor_afp_original);

	var tope_isss=$("#tope_isss").val();
	if(total_isss_salario>=tope_isss){
		total_isss_salario=tope_isss;
	}
	/* ************************* */
	var valor_devengo_planilla = $("#sueldo_afp_planilladevengo_admin").val();


	var sueldo_isss_planilladevengo_admin=total_isss_salario;

	if(sueldo_isss_planilladevengo_admin==""){
		sueldo_isss_planilladevengo_admin=0;
	}
	if(sueldo_isss_planilladevengo_admin=="NaN"){
		sueldo_isss_planilladevengo_admin=0;
	}
	


	var calcularporcentaje=porcentaje_afp/100;/* --afp */
	var calcularporcentaje_isss=porcentaje_isss/100;

	/* Descuento AFP: */
	total_afp=solodecimales(parseFloat(total_afp_salario)*calcularporcentaje);
	descuento_afp_final=total_afp_salario-total_afp;

	$("#descuento_afp_planilladevengo_admin").val(total_afp);


	/* Descuento ISSS: */
	total_isss= solodecimales(parseFloat(total_isss_salario)*calcularporcentaje_isss);
	descuento_iss_final=total_isss_salario-total_isss;
	$("#descuento_isss_planilladevengo_admin").val(total_isss);



	/* Descuento Renta: */
	total_descuento_renta=solodecimales(parseFloat(total_renta_salario)-parseFloat(total_afp)-parseFloat(total_isss));
	if(total_renta_salario==0){
		total_descuento_renta=0;
	}
	$("#sueldo_renta_planilladevengo_admin").val(total_descuento_renta);
	var sujeto_renta_final=$("#sueldo_renta_planilladevengo_admin").val();
	


	/* *******renta*********** */
	$.ajax({
		url:calcular_renta(parseFloat(sujeto_renta_final)),
		success:function(){
		
							/* ********************** */
						/* 	console.log("************************");
							console.log(sueldo_menos_base+"sueldo_menos_base");
							console.log(tasa_por_exedente+"tasa_por_exedente");
							console.log(descuento_renta+"descuento_renta"); */

							/* ****************CUENTAS GLOBALES**************** */
							
			calculo_horas();
			/* calculo de horas****************** */
			var calculo_extra_diurna = $(".calculo_extra_diurna").val();
			var calculo_extra_nocturna = $(".calculo_extra_nocturna").val();
			var calculo_extra_domingo = $(".calculo_extra_domingo").val();
			var calculo_extra_domingo_noctu = $(".calculo_extra_domingo_noctu").val();
			var total_suma_horas=parseFloat(calculo_extra_diurna)+parseFloat(calculo_extra_nocturna)+parseFloat(calculo_extra_domingo)+parseFloat(calculo_extra_domingo_noctu);/* --CALCULO HORAS */
			var sueldo=$("#sueldo_planilladevengo_admin").val();/* --SUELDO */
			var otrodevengo=$("#otro_devengo_admin_planilladevengo_admin").val();/* --Otro Devengo: */
			var totaldevengo_calculo=solodecimales(parseFloat(sueldo)+parseFloat(otrodevengo)+parseFloat(total_suma_horas));
			$("#total_devengo_admin_planilladevengo_admin").val(totaldevengo_calculo);
			var totaldevengo=$("#total_devengo_admin_planilladevengo_admin").val();/* --Total Devengado: */
			var descuento_isss_planilladevengo_admin=$("#descuento_isss_planilladevengo_admin").val();/* --Descuento ISSS: */
			var descuento_afp_planilladevengo_admin= $("#descuento_afp_planilladevengo_admin").val();/* --Descuento AFP: */
			var descuento_renta_planilladevengo_admin=$("#descuento_renta_planilladevengo_admin").val();/* --Descuento Renta: */
			var otro_descuento_planilladevengo_admin=$("#otro_descuento_planilladevengo_admin").val();/* --Otro Descuento: */
			calculototaldescuento=solodecimales(parseFloat(descuento_isss_planilladevengo_admin)+parseFloat(descuento_afp_planilladevengo_admin)+parseFloat(descuento_renta_planilladevengo_admin)+parseFloat(otro_descuento_planilladevengo_admin));
			$("#total_descuento_planilladevengo_admin").val(calculototaldescuento);
			var totaldescuento=$("#total_descuento_planilladevengo_admin").val();/* --Total Descuento: */
			var calculototalliquido=solodecimales(parseFloat(totaldevengo)-parseFloat(totaldescuento));
			$("#total_liquidado_planilladevengo_admin").val(calculototalliquido);
			var totalliquido=$("#total_liquidado_planilladevengo_admin").val();/* --Total Liquido: */
			/*---------------------  */
								
		}
	})
}

function calcular_renta(total_descuento_renta1){
	/* ********************PORCENTAJE PARA RENTA************************** */
	var idempleado=$("#txt_idempleado").val();
	var accion_realizar="calculosisss";
	var renta_devengo=total_descuento_renta1;
	var afp_devengo=$("#sueldo_afp_planilladevengo_admin").val();
	var isss_devengo=$("#sueldo_isss_planilladevengo_admin").val();
	var numero_plan_vacacion=$("#numero_plan_vacacion").val();


	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+total_descuento_renta1+'&numero_plan_vacacion='+numero_plan_vacacion;

	$.ajax({	
		url: "ajax/planilladevengo_admin.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			var valorliquido=$(".originalliquido").val();
			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];
			var tasa_sobre_excedente = response.split(",")[4];
			var vacacion = response.split(",")[5];

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
			$("#porcentaje_base1").val(porcentaje_base1);
			$("#porcentaje_base2").val(porcentaje_base2);
			$("#tasa_sobre_excedente").val(tasa_sobre_excedente);
			$("#tienevacacion").val(vacacion);
			var tienevacacion=$("#tienevacacion").val();
			if(tienevacacion=="si"){
				$("#sueldo_renta_planilladevengo_admin").val("0");
				$("#sueldo_isss_planilladevengo_admin").val("0");
				$("#sueldo_afp_planilladevengo_admin").val("0");
			}
			
		
			var porcentaje_base1= $("#porcentaje_base1").val();
			var porcentaje_base2= $("#porcentaje_base2").val();
			var tasa_sobre_excedente= $("#tasa_sobre_excedente").val();
			var calcularporcentaje_tasa_excente=tasa_sobre_excedente/100;
			/* *************************************************** */
			/* CALCULO RENTA */
			var sueldo_menos_base= parseFloat(total_descuento_renta)-parseFloat(porcentaje_base2);
			var tasa_por_exedente= parseFloat(sueldo_menos_base)*parseFloat(calcularporcentaje_tasa_excente);
			var descuento_renta=parseFloat(tasa_por_exedente)+parseFloat(porcentaje_base1);
			/* var descuento_renta_final=total_renta_salario-descuento_renta; */
			$("#descuento_renta_planilladevengo_admin").val(descuento_renta);
		

			

			}
	})



}

/*  */


/* ------------------- */
/* codigo mascara para toda la planilla */
function fredondear(valor_desbloqueo){
	var divOriginal = $("#formulario_original");
	/* var divDuplicado = divOriginal.clone(); */

	// Cambiar el ID del div duplicado (opcional)
   /*  divDuplicado.attr("id", "formulario_copia");
	divDuplicado.attr("style", ""); */

	// Agregar el div duplicado al contenedor deseado
   /*  $("#formulario_copia").empty();
	$("#formulario_copia").append(divDuplicado); */


		 if (valor_desbloqueo=="true") {

		   $("#formulario_copia").empty();
		   $("#formulario_original").attr("style","");
		   $(".desbloquear_mascara").attr("style","display:none;");
		   $(".bloqueo_mascara").attr("style","display:none;");
	   
		}
		else{
			   var divOriginal = $("#formulario_original");
			   var clone = divOriginal.clone();
				// Cambiar el ID (opcional)
				clone.attr("id", "nuevoDiv");
			   // Agregar el clon al contenedor de clones
			   $("#formulario_copia").empty();
			   $("#formulario_copia").append(clone);
			   clone.removeAttr("style");
			   $("#formulario_original").attr("style","visibility:hidden; height:0px");
			   
			   var ancho = $("#nuevoDiv").width();
			   var alto = $("#nuevoDiv").height();
			   var posicion = $("#nuevoDiv").position();
			   posicion.left;
			   posicion.top;

			   $(".desbloquear_mascara").attr("style","");
			   $(".bloqueo_mascara").attr("style","");
			   var nuevoDiv = $(".bloqueo_mascara");
			   nuevoDiv.css({
				   width: ancho,
				   height: alto,
				   background: " -webkit-linear-gradient(top, rgba(0,0,0,0.06) 0%,rgba(0,0,0,0) 100%)", // Color rojo semi-transparente
				   position: "absolute",
				   "z-index":9
			   });
			   $(".desbloquear_mascara").attr("style","margin-left:55%");

			   
			   $(".desbloquear_mascara").click(function() {
				   // Tu código a ejecutar cuando se hace clic
				   fredondear("true");
			   });

			   var inputs = $("#formulario_copia input");
			   /* -------------- */
			   inputs.each(function() {
				   var input = $(this);
				   var valor=input.val();
				   var idinput=input.attr("id");
				   /* 	input.attr("id","");
				   input.attr("name",""); */
				   var valorNumerico = parseFloat(valor);
						   if (!isNaN(valorNumerico) && valorNumerico % 1 !== 0) {
							   var valorRedondeado = parseFloat(valor);
							   /* num = valorRedondeado.toString();
							   num = num.slice(0, (num.indexOf("."))+3); */
							   /* var numerosDosDecimales = Math.floor(valorRedondeado * 100) / 100; */
							   input.val(valor);
						   }
				   
			   });
			   /* ------------- */
		   }

}

$("#myModal").on("hidden.bs.modal", function() {
   var inputs = $(".modal_devengos input");
   var select = $(".modal_devengos select");
   $(".accion_devengo").val("agregardevengo");
   inputs.each(function() {
	   var input = $(this);
	   input.val("");
   })
   select.each(function() {
	   var input = $(this);
	   input.val("");
   })
});


$("#descuento").on("hidden.bs.modal", function() {
   var inputs = $(".modal_devengos input");
   var select = $(".modal_devengos select");
   $(".accion_devengo").val("agregardevengo");
   inputs.each(function() {
	   var input = $(this);
	   input.val("");
   })
   select.each(function() {
	   var input = $(this);
	   input.val("");
   })
});
/* fin codigo mascara para toda la planilla */


function calculos_globales(){

	var numero=$("#numero_planilladevengo_admin").val();
	var dataString = 'accion01=calculosglobales'+'&numero='+numero;
			$.ajax({
				data: dataString,
				url: "ajax/planilladevengo_admin.ajax.php",
				type: 'post',
				success: function (response) {
					var datos = JSON.parse(response);
					var total_liquido = datos[0].total_liquido;
					var cantidad = parseFloat(total_liquido); // Obtener la cantidad como número
					// Formatear la cantidad como dinero
					var cantidadFormateada = cantidad.toLocaleString('es-ES', {
						style: 'currency',
						currency: 'USD' // Cambia 'EUR' por el código de moneda deseado (por ejemplo, 'USD' para dólares)
					});
					$(".total_liquido_global").text(cantidadFormateada);
				}
			});
			/* ------------------------- */
			var dataString2 = 'accion01=totalempleados'+'&numero='+numero;

			$.ajax({
				data: dataString2,
				url: "ajax/planilladevengo_admin.ajax.php",
				type: 'post',
				success: function (response) {
					var datos = JSON.parse(response);
					var total_empleados = datos[0].total_empleados;
					$(".total_empleado_global").text(total_empleados);
				}
			});

}


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
	$("#otro_devengo_admin_planilladevengo_admin").val(totalglobaldevengo);
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
	$("#otro_descuento_planilladevengo_admin").val(totalglobaldescuento);
	/* ******************* */
	

	var sueldo=$("#sueldo_planilladevengo_admin").val();/* --SUELDO */
	var otrodevengo=$("#otro_devengo_admin_planilladevengo_admin").val();/* --Otro Devengo: */

	$("#total_devengo_admin_planilladevengo_admin").val(parseFloat(sueldo)+parseFloat(otrodevengo)+parseFloat(total_suma_horas));
	var totaldevengo=$("#total_devengo_admin_planilladevengo_admin").val();/* --Total Devengado: */

	var devengodevengo_admin=$("#devengodevengo_admin").val();
	/* var sujetoiss_afp= parseFloat(sueldo)+parseFloat(devengodevengo_admin); */

	/* $("#sueldo_isss_planilladevengo_admin").val(sujetoiss_afp);
	$("#sueldo_afp_planilladevengo_admin").val(sujetoiss_afp); */

	var porcentajeafp=$("#porcentajeafp").val();
	var porcentajeisss=$("#porcentajeisss").val();

	descuento_isss=parseFloat(sujetoiss_afp)*porcentajeisss;
	descuento_afp=parseFloat(sujetoiss_afp)*porcentajeafp;

	$("#descuento_isss_planilladevengo_admin").val(descuento_isss);
	$("#descuento_afp_planilladevengo_admin").val(descuento_afp);

	var descuento_isss_planilladevengo_admin=$("#descuento_isss_planilladevengo_admin").val();/* --Descuento ISSS: */
	var descuento_afp_planilladevengo_admin= $("#descuento_afp_planilladevengo_admin").val();/* --Descuento AFP: */
	var descuento_renta_planilladevengo_admin=$("#descuento_renta_planilladevengo_admin").val();/* --Descuento Renta: */
	var otro_descuento_planilladevengo_admin=$("#otro_descuento_planilladevengo_admin").val();/* --Otro Descuento: */

	calculototaldescuento=parseFloat(descuento_isss_planilladevengo_admin)+parseFloat(descuento_afp_planilladevengo_admin)+parseFloat(descuento_renta_planilladevengo_admin)+parseFloat(otro_descuento_planilladevengo_admin);


	$("#total_descuento_planilladevengo_admin").val(calculototaldescuento);
	var totaldescuento=$("#total_descuento_planilladevengo_admin").val();/* --Total Descuento: */

	var calculototalliquido=parseFloat(totaldevengo)-parseFloat(totaldescuento);
	var totalliquido=$("#total_liquidado_planilladevengo_admin").val();
	/* $("#total_liquidado_planilladevengo_admin").val(calculototalliquido); */
	var totalliquido=$("#total_liquidado_planilladevengo_admin").val();/* --Total Liquido: */



	calculorenta= parseFloat(sujetoiss_afp)-parseFloat(descuento_isss)-parseFloat(descuento_afp);
	/* $("#sueldo_renta_planilladevengo_admin").val(calculorenta.toFixed(3)); */
	
	var sujeto_isss=$("#sueldo_isss_planilladevengo_admin").val();/* --Sujeto ISSS: */
	var sujeto_afp=$("#sueldo_afp_planilladevengo_admin").val();/* --Sujeto AFP: */
	var sujeto_renta=$("#sueldo_renta_planilladevengo_admin").val();/* --Sujeto Renta: */

	var orinialliquido=$("#total_liquidado_planilladevengo_admin").val();
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

$("#recibospendientes").change(function(){

	var iddevengo = $(this).val();
	var valorrecibo = $('option:selected', this).attr('valorrecibo');
	var renta_devengo = $('option:selected', this).attr('renta_devengo');
	var afp_devengo = $('option:selected', this).attr('afp_devengo');
	var isss_devengo = $('option:selected', this).attr('isss_devengo');
	var tipo_valor = $('option:selected', this).attr('tipo_valor');
	var idrecibo = $('option:selected', this).attr('idrecibo');
	var codigo = $('option:selected', this).attr('codigo');
	var descripcion = $('option:selected', this).attr('descripcion');

	$(".tipodescuento").val(iddevengo);
	$(".tipodescuento").val(iddevengo).trigger('change.select2');

	$(".codigo_devengo_descuento_planilla").val(codigo);
	$(".descripcion_devengo_descuento_planilla").val(descripcion);
	$("#idrecibo").val(idrecibo);
	$(".afp_devengo_devengo_descuento_planilla").val(afp_devengo);
	$(".isss_devengo_devengo_descuento_planilla").val(isss_devengo);
	$(".renta_devengo_devengo_descuento_planilla").val(renta_devengo);
	$(".valor_devengo_planilla1").val(valorrecibo);
	$(".tipo_valor").val(tipo_valor);

});


function redondear(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}

/* function solodecimales(num){
	numv = num.toString();
	numv = numv.slice(0, (numv.indexOf("."))+3);
	return Number(numv)
} */

/* function solodecimales(num) {
	const numStr = num.toString();
	const partes = numStr.split('.');
	const decimal = partes.length > 1 ? partes[1].substring(0, 2) : '00';
	const resultado = partes[0] + '.' + decimal;
	return resultado;
  } */
  
  function solodecimales(num) {
	const resultado=parseFloat(num).toFixed(2);
	return resultado;
	/* const numStr = num.toString();
	const partes = numStr.split('.');
	let decimal = '00';
	if (partes.length > 1) {
	  decimal = partes[1].substring(0, 2).padEnd(2, '0');
	}
	const resultado = partes[0] + '.' + decimal;
	return resultado; */
  }



