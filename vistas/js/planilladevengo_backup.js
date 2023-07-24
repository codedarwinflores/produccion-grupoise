



$(document).ready(function(){	  



	var idplanilladevengo=$(".idplanilladevengo").val();

	if(idplanilladevengo!=0){
		var tipo_planilladevengo1=$(".tipo_planilladevengo1").val();
		var periodo_planilladevengo1=$(".periodo_planilladevengo1").val();
		var fecha_desde_planilladevengo1=$(".fecha_desde_planilladevengo1").val();
		var fecha_hasta_planilladevengo1=$(".fecha_hasta_planilladevengo1").val();
		var numero_planilladevengo1=$(".numero_planilladevengo1").val();
		var fecha_planilladevengo1=$(".fecha_planilladevengo1").val();
		var descripcion_planilladevengo1=$(".descripcion_planilladevengo1").val();
		var empleado_rango_desde1=$(".empleado_rango_desde1").val();
		var empleado_rango_hasta1=$(".empleado_rango_hasta1").val();

		$("#tipo_planilladevengo").val(tipo_planilladevengo1);
		$("#periodo_planilladevengo").val(periodo_planilladevengo1);
		$("#fecha_desde_planilladevengo").val(fecha_desde_planilladevengo1);
		$("#fecha_hasta_planilladevengo").val(fecha_hasta_planilladevengo1);
		$("#numero_planilladevengo").val(numero_planilladevengo1);
		$("#fecha_planilladevengo").val(fecha_planilladevengo1);
		$("#descripcion_planilladevengo").val(descripcion_planilladevengo1);
		$("#empleado_rango_desde").val(empleado_rango_desde1);
		$("#empleado_rango_hasta").val(empleado_rango_hasta1);

	}





 });

 $(".filtrar_empleados").click(function(){
 
	var empleado_rango_desde = $("#empleado_rango_desde").val();
	var empleado_rango_hasta = $("#empleado_rango_hasta").val();
	var fecha_planilladevengo = $("#fecha_planilladevengo").val();
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

	if(fecha_planilladevengo==""){
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
		'&fecha_planilladevengo=' +fecha_planilladevengo+
		'&accion01=' +$.trim(accion_realizar);
		$.ajax({
			data: dataString,
			url: "ajax/planilladevengo.ajax.php",
			type: 'post',
			success: function (response) {
				$("#tabla_empleados").empty();
				$("#tabla_empleados").append(response);

					$(".tablas1").on("click", ".btnEditarabase", function(){
					var codigo = $(this).attr("codigo");
					var id = $(this).attr("idempleado");
					var nombre = $(this).attr("nombre");
					var sueldo = $(this).attr("sueldo");
					editar(codigo,id,nombre);
					calculos(id,sueldo);
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

})

 $(".guardarplanilla").click(function(){
	

	/* variables */

		var id = $("#id").val();
		var numero_planilladevengo = $("#numero_planilladevengo").val();
		var fecha_planilladevengo = $("#fecha_planilladevengo").val();
		var fecha_desde_planilladevengo = $("#fecha_desde_planilladevengo").val();
		var fecha_hasta_planilladevengo = $("#fecha_hasta_planilladevengo").val();
		var descripcion_planilladevengo = $("#descripcion_planilladevengo").val();
		var codigo_empleado_planilladevengo = $("#codigo_empleado_planilladevengo").val();
		var nombre_empleado_planilladevengo = $("#nombre_empleado_planilladevengo").val();
		var id_empleado_planilladevengo = $("#id_empleado_planilladevengo").val();
		var dias_trabajo_planilladevengo = $("#dias_trabajo_planilladevengo").val();
		var sueldo_planilladevengo = $("#sueldo_planilladevengo").val();
		var hora_extra_diurna_planilladevengo = $("#hora_extra_diurna_planilladevengo").val();
		var hora_extra_nocturna_planilladevengo = $("#hora_extra_nocturna_planilladevengo").val();
		var hora_extra_domingo_planilladevengo = $("#hora_extra_domingo_planilladevengo").val();
		var hora_extra_domingo_nocturna_planilladevengo = $("#hora_extra_domingo_nocturna_planilladevengo").val();
		var otro_devengo_planilladevengo = $("#otro_devengo_planilladevengo").val();
		var total_devengo_planilladevengo = $("#total_devengo_planilladevengo").val();
		var descuento_isss_planilladevengo = $("#descuento_isss_planilladevengo").val();
		var descuento_afp_planilladevengo = $("#descuento_afp_planilladevengo").val();
		var descuento_renta_planilladevengo = $("#descuento_renta_planilladevengo").val();
		var otro_descuento_planilladevengo = $("#otro_descuento_planilladevengo").val();
		var total_descuento_planilladevengo = $("#total_descuento_planilladevengo").val();
		var total_liquidado_planilladevengo = $("#total_liquidado_planilladevengo").val();
		var sueldo_renta_planilladevengo = $("#sueldo_renta_planilladevengo").val();
		var sueldo_isss_planilladevengo = $("#sueldo_isss_planilladevengo").val();
		var sueldo_afp_planilladevengo = $("#sueldo_afp_planilladevengo").val();
		var departamento_planilladevengo = $("#departamento_planilladevengo").val();
		var codigo_ubicacion_planilladevengo = $("#codigo_ubicacion_planilladevengo").val();
		var nombre_ubicacion_planilladevengo = $("#nombre_ubicacion_planilladevengo").val();
		var id_ubicacion_planilladevengo = $("#id_ubicacion_planilladevengo").val();
		var observacion_planilladevengo = $("#observacion_planilladevengo").val();
		var periodo_planilladevengo = $("#periodo_planilladevengo").val();
		var tipo_planilladevengo = $("#tipo_planilladevengo").val();
		var dias_incapacidad = $("#dias_incapacidad").val();
		var empleado_rango_desde = $("#empleado_rango_desde").val();
		var empleado_rango_hasta = $("#empleado_rango_hasta").val();
		var accion_realizar = "";

	/*  ******** */

					var dataString = 'id=' +$.trim(id) +
					'&numero_planilladevengo=' +numero_planilladevengo +
					'&fecha_planilladevengo=' +fecha_planilladevengo +
					'&fecha_desde_planilladevengo=' +fecha_desde_planilladevengo +
					'&fecha_hasta_planilladevengo=' +fecha_hasta_planilladevengo +
					'&descripcion_planilladevengo=' +descripcion_planilladevengo +
					'&codigo_empleado_planilladevengo=' +codigo_empleado_planilladevengo +
					'&nombre_empleado_planilladevengo=' +nombre_empleado_planilladevengo +
					'&id_empleado_planilladevengo=' +id_empleado_planilladevengo +
					'&dias_trabajo_planilladevengo=' +dias_trabajo_planilladevengo +
					'&sueldo_planilladevengo=' +sueldo_planilladevengo +
					'&hora_extra_diurna_planilladevengo=' +hora_extra_diurna_planilladevengo +
					'&hora_extra_nocturna_planilladevengo=' +hora_extra_nocturna_planilladevengo +
					'&hora_extra_domingo_planilladevengo=' +hora_extra_domingo_planilladevengo +
					'&hora_extra_domingo_nocturna_planilladevengo=' +hora_extra_domingo_nocturna_planilladevengo +
					'&otro_devengo_planilladevengo=' +otro_devengo_planilladevengo +
					 '&total_devengo_planilladevengo=' +total_devengo_planilladevengo +
					 '&descuento_isss_planilladevengo=' +descuento_isss_planilladevengo +
					 '&descuento_afp_planilladevengo=' +descuento_afp_planilladevengo +
					 '&descuento_renta_planilladevengo=' +descuento_renta_planilladevengo +
					 '&otro_descuento_planilladevengo=' +otro_descuento_planilladevengo +
					 '&total_descuento_planilladevengo=' +total_descuento_planilladevengo +
					 '&total_liquidado_planilladevengo=' +total_liquidado_planilladevengo +
					 '&sueldo_renta_planilladevengo=' +sueldo_renta_planilladevengo +
					 '&sueldo_isss_planilladevengo=' +sueldo_isss_planilladevengo +
					 '&sueldo_afp_planilladevengo=' +sueldo_afp_planilladevengo +
					 '&departamento_planilladevengo=' +departamento_planilladevengo +
					 '&codigo_ubicacion_planilladevengo=' +codigo_ubicacion_planilladevengo +
					 '&nombre_ubicacion_planilladevengo=' +nombre_ubicacion_planilladevengo +
					 '&id_ubicacion_planilladevengo=' +id_ubicacion_planilladevengo+
					 '&observacion_planilladevengo=' +observacion_planilladevengo+
					 '&periodo_planilladevengo=' +periodo_planilladevengo+
					 '&tipo_planilladevengo=' +tipo_planilladevengo+
					 '&dias_incapacidad=' +dias_incapacidad+
					 '&empleado_rango_desde=' +empleado_rango_desde+
					 '&empleado_rango_hasta=' +empleado_rango_hasta+
					 '&accion=' +accion_realizar;
					 
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo.ajax.php",
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
				}
			});
		}
	});
	/* ********* */



});


/* CAPTURAR FECHA DESDE */

$( "#fecha_desde_planilladevengo" ).on( "click", function() {
	$( "#ic__datepicker-1 .ic__day" ).on( "click", function() {
		var valor= $("#fecha_desde_planilladevengo").val();
		var valor2= $("#fecha_hasta_planilladevengo").val();
		$("#descripcion_planilladevengo").val("Planilla de Anticipos desde "+valor+" hasta "+valor2);

	  } );
  } );

  /* CAPTURAR FECHA HASTA */
  $( "#fecha_hasta_planilladevengo" ).on( "click", function() {
	$( "#ic__datepicker-2 .ic__day" ).on( "click", function() {
		var valor= $("#fecha_desde_planilladevengo").val();
		var valor2= $("#fecha_hasta_planilladevengo").val();
		$("#descripcion_planilladevengo").val("Planilla de Anticipos desde "+valor+" hasta "+valor2);

	  } );
  } );

 

/*=============================================
EDITAR 
=============================================*/
 function editar(codigo1,id1,nombre1){

	$("#dias_trabajo_planilladevengo").val("");
	$("#sueldo_planilladevengo").val("");
	$("#hora_extra_diurna_planilladevengo").val("");
	$("#hora_extra_nocturna_planilladevengo").val("");
	$("#hora_extra_domingo_planilladevengo").val("");
	$("#hora_extra_domingo_nocturna_planilladevengo").val("");
	$("#otro_devengo_planilladevengo").val("");
	$("#total_devengo_planilladevengo").val("");
	$("#descuento_isss_planilladevengo").val("");
	$("#descuento_afp_planilladevengo").val("");
	$("#descuento_renta_planilladevengo").val("");
	$("#otro_descuento_planilladevengo").val("");
	$("#total_descuento_planilladevengo").val("");
	$("#total_liquidado_planilladevengo").val("");
	$("#sueldo_renta_planilladevengo").val("");
	$("#sueldo_isss_planilladevengo").val("");
	$("#sueldo_afp_planilladevengo").val("");
	$("#observacion_planilladevengo").val("");
	$("#dias_incapacidad").val("");


	var accion_realizar = "obtenerdata";
	var idabase = codigo1;
	var dataString = 'consultarempleado=' +idabase+'&accion01=' +accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {

				var datos = JSON.parse(response);
				console.log(response);
				/* console.log(datos[0].codigo_empleado_planilladevengo); */
			
				$("#total_devengo_planilladevengo").val(datos[0].valorempleado);
				$("#total_liquidado_planilladevengo").val(datos[0].valorempleado);
				

				
				$(".idempleado_devengo").val(datos[0].idempleado);
				$(".mostrar_devengo").removeAttr("disabled");
				/* $(".id_devengo").val(datos[0].id); */

				/* OBTENER DATOS DEL EMPLEADO*********** */
				$("#codigo_empleado_planilladevengo").val(codigo1);
				$("#nombre_empleado_planilladevengo").val(nombre1);
				$("#id_empleado_planilladevengo").val(datos[0].idempleado);
				$("#codigo_ubicacion_planilladevengo").val(datos[0].codigo_ubicacion);
				$("#nombre_ubicacion_planilladevengo").val(datos[0].nombre_ubicacion);
				$("#id_ubicacion_planilladevengo").val(datos[0].idubicacion);
			/* 	$("#total_devengo_planilladevengo").val(datos[0].valor); */

				obtenerdata_total(codigo1,id1,nombre1);



				/* $("#numero_planilladevengo").val(datos[0].numero_planilladevengo);
				$("#fecha_planilladevengo").val(datos[0].fecha_planilladevengo);
				$("#fecha_desde_planilladevengo").val(datos[0].fecha_desde_planilladevengo);
				$("#fecha_hasta_planilladevengo").val(datos[0].fecha_hasta_planilladevengo);
				$("#descripcion_planilladevengo").val(datos[0].descripcion_planilladevengo); */
	
		/* 		$("#dias_trabajo_planilladevengo").val(datos[0].dias_trabajo_planilladevengo);
				$("#sueldo_planilladevengo").val(datos[0].sueldo_planilladevengo);
				$("#hora_extra_diurna_planilladevengo").val(datos[0].hora_extra_diurna_planilladevengo);
				$("#hora_extra_nocturna_planilladevengo").val(datos[0].hora_extra_nocturna_planilladevengo);
				$("#hora_extra_domingo_planilladevengo").val(datos[0].hora_extra_domingo_planilladevengo);
				$("#hora_extra_domingo_nocturna_planilladevengo").val(datos[0].hora_extra_domingo_nocturna_planilladevengo);
				$("#otro_devengo_planilladevengo").val(datos[0].otro_devengo_planilladevengo);
				$("#total_devengo_planilladevengo").val(datos[0].total_devengo_planilladevengo);
				$("#descuento_isss_planilladevengo").val(datos[0].descuento_isss_planilladevengo);
				$("#descuento_afp_planilladevengo").val(datos[0].descuento_afp_planilladevengo);
				$("#descuento_renta_planilladevengo").val(datos[0].descuento_renta_planilladevengo);
				$("#otro_descuento_planilladevengo").val(datos[0].otro_descuento_planilladevengo);
				$("#total_descuento_planilladevengo").val(datos[0].total_descuento_planilladevengo); */

			/* 	$("#total_liquidado_planilladevengo").val(datos[0].total_liquidado_planilladevengo); */
		/* 		$("#sueldo_renta_planilladevengo").val(datos[0].sueldo_renta_planilladevengo);
				$("#sueldo_isss_planilladevengo").val(datos[0].sueldo_isss_planilladevengo);
				$("#sueldo_afp_planilladevengo").val(datos[0].sueldo_afp_planilladevengo); */
				/* $("#departamento_planilladevengo").val(datos[0].departamento_planilladevengo); */

			
				/* $("#observacion_planilladevengo").val(datos[0].observacion_planilladevengo); */
		/* 		$("#periodo_planilladevengo").val(datos[0].periodo_planilladevengo);
				$("#tipo_planilladevengo").val(datos[0].tipo_planilladevengo); */
				/* $("#dias_incapacidad").val(datos[0].dias_incapacidad); */

		
			
			}
		});



};

/*=============================================
obtener data total 
=============================================*/
function obtenerdata_total(codigo1,id1,nombre1){

	var accion_realizar = "obtenerdatatotal";
	var idabase = codigo1;
	var dataString = 'consultarempleado=' +id1+'&accion01=' +accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
			
				
				
				var datos = JSON.parse(response);
				console.log(response);
				console.log(datos[0].id_empleado_planilladevengo);
				$("#dias_trabajo_planilladevengo").val(datos[0].dias_trabajo_planilladevengo);
				$("#dias_incapacidad").val(datos[0].dias_incapacidad);
				$("#sueldo_planilladevengo").val(datos[0].sueldo_planilladevengo);
				$("#hora_extra_diurna_planilladevengo").val(datos[0].hora_extra_diurna_planilladevengo);
				$("#hora_extra_nocturna_planilladevengo").val(datos[0].hora_extra_nocturna_planilladevengo);
				$("#hora_extra_domingo_planilladevengo").val(datos[0].hora_extra_domingo_planilladevengo);
				$("#hora_extra_domingo_nocturna_planilladevengo").val(datos[0].hora_extra_domingo_nocturna_planilladevengo);
				$("#otro_devengo_planilladevengo").val(datos[0].otro_devengo_planilladevengo);

				if(datos[0].total_devengo_planilladevengo!=""){
					$("#total_devengo_planilladevengo").val(datos[0].total_devengo_planilladevengo);

				}
				if(datos[0].total_liquidado_planilladevengo!=""){
					$("#total_liquidado_planilladevengo").val(datos[0].total_liquidado_planilladevengo);

				}

				$("#descuento_isss_planilladevengo").val(datos[0].descuento_isss_planilladevengo);
				$("#descuento_afp_planilladevengo").val(datos[0].descuento_afp_planilladevengo);
				$("#descuento_renta_planilladevengo").val(datos[0].descuento_renta_planilladevengo);
				$("#otro_descuento_planilladevengo").val(datos[0].otro_descuento_planilladevengo);
				$("#total_descuento_planilladevengo").val(datos[0].total_descuento_planilladevengo);
			/* 	$("#total_liquidado_planilladevengo").val(datos[0].total_liquidado_planilladevengo); */
			/* 	$("#sueldo_renta_planilladevengo").val(datos[0].sueldo_renta_planilladevengo); */
				$("#sueldo_isss_planilladevengo").val(datos[0].sueldo_isss_planilladevengo);
				$("#sueldo_afp_planilladevengo").val(datos[0].sueldo_afp_planilladevengo);
				$("#observacion_planilladevengo").val(datos[0].observacion_planilladevengo);
			

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

$(".mostrar_devengo").click(function(){

	var orinialliquido=$("#total_liquidado_planilladevengo").val();
	$(".originalliquido").val(orinialliquido);



	
	var numero_planilla=$("#numero_planilladevengo").val();
	$(".codigo_planilla_devengo").val(numero_planilla);
	var idempleado = $("#idempleado_devengo").val();
	var tipo = $(this).attr("tipo");

	var accion="consultard"
	/* ******************* */

	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion+'&tipo='+tipo+'&codigo_planilla_devengo='+numero_planilla;
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo.ajax.php",
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
				eliminardevengo(id);
			})


			$('.tablas').DataTable();



		}
	});
	/* ********* */
});


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
	var valor_devengo_planilla = $(".valor_devengo_planilla").val();
	var accionaccion_devengo = $(".accion_devengo").val();
	var tipo_valor = $(".tipo_valor").val();
	var codigo_planilla_devengo = $(".codigo_planilla_devengo").val();
	
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

					
	$.ajax({
		data: dataString,
		url: "ajax/planilladevengo.ajax.php",
		type: 'post',
		success: function (response) {
			
			console.log(response);
			swal({
				type: "success",
				title: "Guardado con Exito",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function (result) {
				if (result.value) {
					/* window.location = "situacion"; */
					vaciar();
					$('.modales').modal('hide');
				}
			});


		}
	});
	/* ********* */
});


/*=============================================
EDITAR devengo
=============================================*/
function editardevengo(id1){


	$("#accion_devengo").val("modificardevengo");
	var id = id1;
	var accion_realizar="obtenerdatadevengo";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;

		$.ajax({
			
			url: "ajax/planilladevengo.ajax.php",
			method: 'post',
			data: dataString,
			success: function (response) {
				var datos = JSON.parse(response);
				$(".id_devengo").val(id);
				$(".codigo_devengo_descuento_planilla").val(datos[0].codigo_devengo_descuento_planilla);
				$(".descripcion_devengo_descuento_planilla").val(datos[0].descripcion_devengo_descuento_planilla);
				$(".tipo_devengo_descuento_planilla").val(datos[0].tipo_devengo_descuento_planilla);
				$(".isss_devengo_devengo_descuento_planilla").val(datos[0].isss_devengo_devengo_descuento_planilla);
				$(".afp_devengo_devengo_descuento_planilla").val(datos[0].afp_devengo_devengo_descuento_planilla);
				$(".renta_devengo_devengo_descuento_planilla").val(datos[0].renta_devengo_devengo_descuento_planilla);
				$(".porcentaje_isss_devengo_descuento_planilla").val(datos[0].porcentaje_isss_devengo_descuento_planilla);
				$(".porcentaje_afp_devengo_descuento_planilla").val(datos[0].porcentaje_afp_devengo_descuento_planilla);
				$(".porcentaje_renta_devengo_descuento_planilla").val(datos[0].porcentaje_renta_devengo_descuento_planilla);
				$(".idempleado_devengo").val(datos[0].idempleado_devengo);
				$(".valor_devengo_planilla").val(datos[0].valor_devengo_planilla);
				$(".tipo_valor").val(datos[0].tipo_valor);
				$(".accion_devengo").val("modificardevengo");
			}
		});



};

function eliminardevengo(id1){
	var id = id1;
	var accion_realizar="eliminardevengo";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;
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
				url: "ajax/planilladevengo.ajax.php",
				method: 'post',
				data: dataString,
				success: function (response) {
					$('#myModal').modal('toggle');
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
}

function calculos(id, sueldo){

	var id = id;
	var accion_realizar="calculos";
	var dataString = 'consultarempleado=' +id+'&accion01='+accion_realizar;
	$(".valor_devengo_planilla").attr("idempleado",id);

		$.ajax({
			
			url: "ajax/planilladevengo.ajax.php",
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
				$("#sueldo_renta_planilladevengo").val(descuento_renta);
				/* RENTA**************** */


			/* 	alert(descuento_renta); */

				
			
				/* var isss_devengo_devengo_descuento_planilla = datos[0].isss_devengo_devengo_descuento_planilla;
				var afp_devengo_devengo_descuento_planilla = datos[0].afp_devengo_devengo_descuento_planilla;
				var renta_devengo_devengo_descuento_planilla = datos[0].renta_devengo_devengo_descuento_planilla;
				var porcentaje_renta_devengo_descuento_planilla = datos[0].porcentaje_renta_devengo_descuento_planilla;
				var porcentaje_isss_devengo_descuento_planilla = datos[0].porcentaje_isss_devengo_descuento_planilla;
				var porcentaje_afp_devengo_descuento_planilla = datos[0].porcentaje_afp_devengo_descuento_planilla;
				var total_devengo_planilladevengo= $("#total_devengo_planilladevengo").val(); */
				
			}
		});


}


$( ".valor_devengo_planilla" ).blur(function() {

		
	

	var idempleado = $(this).attr("idempleado");
	var accion_realizar="calculosisss";

	var renta_devengo= $(".renta_devengo_devengo_descuento_planilla").val();
	var afp_devengo=$(".afp_devengo_devengo_descuento_planilla").val();
	var isss_devengo=$(".isss_devengo_devengo_descuento_planilla").val();
	var valor_devengo_planilla=$(".valor_devengo_planilla").val();

	
	var dataString = 'consultarempleado=' +idempleado+'&accion01='+accion_realizar+'&renta_devengo='+renta_devengo+'&afp_devengo='+afp_devengo+'&isss_devengo='+isss_devengo+'&valor_devengo_planilla='+valor_devengo_planilla;


	$.ajax({
			
		url: "ajax/planilladevengo.ajax.php",
		method: 'post',
		data: dataString,
		success: function (response) {
			

			var valorliquido=$(".originalliquido").val();
			

			var porcentaje_isss = response.split(",")[0];
			var porcentaje_afp = response.split(",")[1];
			var porcentaje_base1 = response.split(",")[2];
			var porcentaje_base2 = response.split(",")[3];

			var calcularporcentaje=porcentaje_afp/100;
			var calcularporcentaje_isss=porcentaje_isss/100;

			var total_afp=0;
			if(afp_devengo=="Si"){
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuento_afp_final=valor_devengo_planilla-total_afp;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				$("#total_liquidado_planilladevengo").val(descuento_afp_final+Number(valorliquido));
			}
			
			if(isss_devengo=="Si"){
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				descuento_iss_final=valor_devengo_planilla-total_isss;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				$("#total_liquidado_planilladevengo").val(descuento_iss_final+Number(valorliquido));
			}
			
			if(renta_devengo=="Si"){
				var sueldo_menos_base= valor_devengo_planilla-porcentaje_base2;
				var tasa_por_exedente=sueldo_menos_base*0.10;
				var descuento_renta=tasa_por_exedente+porcentaje_base1;
				var descuento_renta_final=valor_devengo_planilla-descuento_renta;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				$("#total_liquidado_planilladevengo").val(descuento_renta_final+Number(valorliquido));


			}
			

			if(afp_devengo=="Si"&&isss_devengo=="Si"){
				total_isss=valor_devengo_planilla*calcularporcentaje_isss;
				total_afp=valor_devengo_planilla*calcularporcentaje;
				descuentos_realizar=valor_devengo_planilla-total_isss-total_afp;

				if(valorliquido=="NaN"){
					valorliquido=0;
				}
				$("#total_liquidado_planilladevengo").val(descuentos_realizar+Number(valorliquido));
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
				$("#total_liquidado_planilladevengo").val(descuento_afp_renta+Number(valorliquido));

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
				$("#total_liquidado_planilladevengo").val(descuento_isss_renta+Number(valorliquido));
				
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
				$("#total_liquidado_planilladevengo").val(descuento_isss_afp_renta+Number(valorliquido));

				console.log(valor_devengo_planilla+"-valor devengo");
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
				$("#total_liquidado_planilladevengo").val(Number(valor_devengo_planilla)+Number(valorliquido));
			}
		

	
			

		}
	});


  });


  $(".tipo_devengo_descuento_planilla").change(function(){



	var renta_devengo = $('option:selected', this).attr('renta_devengo');
	var afp_devengo = $('option:selected', this).attr('afp_devengo');
	var isss_devengo = $('option:selected', this).attr('isss_devengo');
	var tipo_valor = $('option:selected', this).attr('tipo_valor');

	$(".renta_devengo_devengo_descuento_planilla").val(renta_devengo);
	$(".afp_devengo_devengo_descuento_planilla").val(afp_devengo);
	$(".isss_devengo_devengo_descuento_planilla").val(isss_devengo);
	$(".tipo_valor").val(tipo_valor);
});

