/* COLOCACION DE ICONOS */
$(document).ready(function(){


	    
	/* validar si fecha esta cerrada */
	$( ".agregarbtnmovimiento" ).on( "click", function() {
			/* ******************************************* */
				var valor=$("#nuevofecha_transacciones_agente").val();
				var dataString = 'fecha='+valor+
								'&modulo=transaccionagente'+
								'&accion01=verificar';
				$.ajax({
					data: dataString,
					url: "ajax/cierres.ajax.php",
					type: 'post',
					success: function (response) {

						if(response>0){
									
								swal({

									type: "error",
									title: "Error, esta fecha esta cerrada",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								});
								$("#nuevofecha_transacciones_agente").val("");
						
						}

					}
				});
			/* ******************************************* */
		
	});
	
/* ******************************* */




	/* validar si fecha esta cerrada */
	$( "#editarfecha_transacciones_agente" ).on( "click", function() {
		$( "#ic__datepicker-6" ).on( "click", function() {
			/* ******************************************* */
				var valor=$("#editarfecha_transacciones_agente").val();
				var dataString = 'fecha='+valor+
								'&modulo=transaccionagente'+
								'&accion01=verificar';
				$.ajax({
					data: dataString,
					url: "ajax/cierres.ajax.php",
					type: 'post',
					success: function (response) {

						if(response>0){
									
								swal({

									type: "error",
									title: "Error, esta fecha esta cerrada",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								});
								$("#editarfecha_transacciones_agente").val("");
						
						}

					}
				});
			/* ******************************************* */
		});
	});
	
/* ******************************* */




	/* validar si fecha esta cerrada */
	$( "#nuevofecha_transacciones_agente" ).on( "click", function() {
		$( "#ic__datepicker-2" ).on( "click", function() {
			/* ******************************************* */
				var valor=$("#nuevofecha_transacciones_agente").val();
				var dataString = 'fecha='+valor+
								'&modulo=transaccionagente'+
								'&accion01=verificar';
				$.ajax({
					data: dataString,
					url: "ajax/cierres.ajax.php",
					type: 'post',
					success: function (response) {

						if(response>0){
									
								swal({

									type: "error",
									title: "Error, esta fecha esta cerrada",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								});
								$("#nuevofecha_transacciones_agente").val("");
						
						}

					}
				});
			/* ******************************************* */
		});
	});
	
/* ******************************* */




	$(".ocultar").attr("style","visibility:hidden; height:0");

	$('.incapacidad_select').on('change', function() {
		var valor = $(this).val();

		if(valor != ""){
			$(".ocultar").attr("style","visibility:visibility ; height:100%;");
		}
		else{
			$(".ocultar").attr("style","visibility:hidden; height:0");
		}

	  });

	var hoy = new Date();
	var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
	function formatTime(timeString) {
		const [hourString, minute] = timeString.split(":");
		const hour = +hourString % 24;
		return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "AM" : "PM");
	}
	$(".input_hora_transacciones_agente").val(formatTime(hora) );


	var formatDate = function(date) {
		var mes=date.getMonth()+1;
		return date.getDate() + "-" + ('0' + mes).slice(-2)  + "-" + date.getFullYear();
	  }
	$(".input_fecha_transacciones_agente").val(formatDate(hoy));
	$(".agregarbtnmovimiento").attr("disabled","disabled");




	  /* ******************* */

			restaFechas = function(f1,f2)
			{
			var aFecha1 = f1.split('-'); 
			var aFecha2 = f2.split('-'); 
			var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
			var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
			var dif = fFecha2 - fFecha1;
			var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
			return dias+1;
			}


		$(".input_fecha_desde_transacciones_agente").blur(function(){
			$( "#ic__datepicker-4" ).click(function() {
				var fechainicial = $(".input_fecha_desde_transacciones_agente").val();
				var fechahasta = $(".input_fecha_hasta_transacciones_agente").val();
				$(".input_numero_dias_transacciones_agente").val(restaFechas(fechainicial,fechahasta));
			});
		});

		$(".input_fecha_hasta_transacciones_agente").blur(function(){
			$( "#ic__datepicker-5" ).click(function() {
				var fechainicial = $(".input_fecha_desde_transacciones_agente").val();
				var fechahasta = $(".input_fecha_hasta_transacciones_agente").val();
				$(".input_numero_dias_transacciones_agente").val(restaFechas(fechainicial,fechahasta));
			});
		});

		/* ****EDITAR */

		$(".einput_fecha_desde_transacciones_agente").blur(function(){
			$( "#ic__datepicker-7" ).click(function() {
				var fechainicial = $(".einput_fecha_desde_transacciones_agente").val();
				var fechahasta = $(".einput_fecha_hasta_transacciones_agente").val();
				$(".einput_numero_dias_transacciones_agente").val(restaFechas(fechainicial,fechahasta));
			});
		});

		$(".einput_fecha_hasta_transacciones_agente").blur(function(){
			$( "#ic__datepicker-8" ).click(function() {
				var fechainicial = $(".einput_fecha_desde_transacciones_agente").val();
				var fechahasta = $(".einput_fecha_hasta_transacciones_agente").val();
				$(".einput_numero_dias_transacciones_agente").val(restaFechas(fechainicial,fechahasta));
			});
		});
		/* ***************** */
 })

 
 $(".tablas").on("click", ".nombreempleado", function(){

	var estado_empleado=$(this).attr("estado_empleado");


	if(estado_empleado!=2){
		$(".agregarbtnmovimiento").attr("disabled","disabled");
		$(".guardarvacante").attr("disabled","disabled");
		$(".btnEliminartransacciones_agente").attr("disabled","disabled");
		
	}
	else{
		$(".agregarbtnmovimiento").removeAttr("disabled");
		$(".guardarvacante").removeAttr("disabled");
		$(".btnEliminartransacciones_agente").removeAttr("disabled");
	}
	var valor=$(this).attr("nombre");
	var codigo=$(this).attr("codigoempleado");

	var codigoempleado=$(this).attr("codigoempleado");
	var idempleado=$(this).attr("idempleado");

	$("#txtcodigoempleado").val(codigoempleado);
	$("#txtidempleado").val(idempleado);

	$(".input_idagente_transacciones_agente").val(codigoempleado);
	$(".nombre_empleado").text("Empleado: "+codigo+"-"+valor);



	 /*  ******** */
	 var parametros = {
		"valor" : codigoempleado
	};
	$.ajax({
			data:  parametros,
			url:"ajax/cargarmovimiento.ajax.php",
			type:  'post',
			success:  function (response) {
				$('.tablacargadatos').DataTable().clear().destroy();
				$("#cargardata").empty();
				$("#cargardata").append(response);
				
				if(estado_empleado!=2){
					$(".btnEliminartransacciones_agente").attr("disabled","disabled");
				}
				else{
					$(".btnEliminartransacciones_agente").removeAttr("disabled");
				}

				$('.tablacargadatos').DataTable(
					{
						"ordering": false
						/* order: [[ 1, "desc" ]] */
					}
				); 
				
			}
	});

	$.ajax({
		data:  parametros,
		url:"ajax/ubicacionanterior.ajax.php",
		type:  'post',
		success:  function (response) {

			console.log(response);
		
			$("#txtidubicacion").val(response.split("-")[0]);
			$("#txtcodigoubicacion").val(response.split("-")[1]);
			$("#txtnombreubicacion").val(response.split("-")[2]);

			if(response.split("-")[1]+'-'+response.split("-")[2]=="undefined-undefined"){
					$("#ubicacionanterior").val("");
			    	$(".input_ubicacion_anterior_transacciones_agente").val("");
			}
			else{
				$(".input_ubicacion_anterior_transacciones_agente").val(response.split("-")[1]+'-'+response.split("-")[2]);
				$("#ubicacionanterior").val(response.split("-")[1]+'-'+response.split("-")[2]);

			}
			
		}
});
	/* ********* */
})


$( ".input_tipo_movimiento_transacciones_agente" ).change(function(){ 
	var cubrir = $('option:selected', this).attr('cubriragente');
	var codigomovimiento = $('option:selected', this).attr('codigomovimiento');

	$("#insertarnuevaubicacion").val(codigomovimiento);


	if(cubrir=="Si"){
		$(".grupoid_vacante_transacciones_agente").attr("style","visibility:show;");
		$("#insertarvacante").val(cubrir);
	}
	else{
		$(".grupoid_vacante_transacciones_agente").attr("style","visibility:hidden;");
		$("#insertarvacante").val("");
	}

})

$( ".input_nueva_ubicacion_transacciones_agente" ).change(function(){ 
	var codigo_ubicacion = $('option:selected', this).attr('codigo');
	var idubicacion = $('option:selected', this).attr('idubicacion');

	$("#idnuevaubicacion").val(idubicacion);

	/*  ******** */
	var parametros = {
		"codigoubicacion" : codigo_ubicacion,
		"accion" : "consultarvante"
		};
	$.ajax({
	url:"ajax/historialvacante.ajax.php",
	method: "POST",
	data: parametros,
	success: function(respuesta){
					/* window.location = "situacion"; */
					$(".vacante_a_cubrir").empty();
					$(".vacante_a_cubrir").prepend(respuesta.split(",")[0]);/* --codigo ubicacion */
		
	}
	});
	/* ********** */
})
/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartransacciones_agente", function(){

	
	var idtransacciones_agente = $(this).attr("idtransacciones_agente");
	
	var datos = new FormData();
	datos.append("idtransacciones_agente", idtransacciones_agente);

	$.ajax({

		url:"ajax/transaccionagente.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			$("#tipomovimiento").val(respuesta["tipo_movimiento_transacciones_agente"]);
			$("#select2-editartipo_movimiento_transacciones_agente-container").text(respuesta["tipo_movimiento_transacciones_agente"]);

			$("#nuevaubicacion").val(respuesta["nueva_ubicacion_transacciones_agente"]);
			$("#select2-editarnueva_ubicacion_transacciones_agente-container").text(respuesta["nueva_ubicacion_transacciones_agente"]);
			
			$("#editarid").val(respuesta["id"]);
			$("#editaridagente_transacciones_agente").val(respuesta["idagente_transacciones_agente"]);
			$("#editarfecha_transacciones_agente").val(respuesta["fecha_transacciones_agente"]);
			$("#editarhora_transacciones_agente").val(respuesta["hora_transacciones_agente"]);

			if(respuesta["ubicacion_anterior_transacciones_agente"]==""){
				var ubicacionanterior=$("#ubicacionanterior").val();
				$("#editarubicacion_anterior_transacciones_agente").val(ubicacionanterior);

			}
			else{
				$("#editarubicacion_anterior_transacciones_agente").val(respuesta["ubicacion_anterior_transacciones_agente"]);
			}

			$("#editarfecha_desde_transacciones_agente").val(respuesta["fecha_desde_transacciones_agente"]);
			$("#editarfecha_hasta_transacciones_agente").val(respuesta["fecha_hasta_transacciones_agente"]);
			$("#editarpresento_incapacidad_transacciones_agente").val(respuesta["presento_incapacidad_transacciones_agente"]);
			$("#editarcomentarios_transacciones_agente").val(respuesta["comentarios_transacciones_agente"]);
			$("#editarturno_transacciones_agente").val(respuesta["turno_transacciones_agente"]);
			$("#editarhorario_desde_transacciones_agente").val(respuesta["horario_desde_transacciones_agente"]);
			$("#editarhorario_hasta_transacciones_agente").val(respuesta["horario_hasta_transacciones_agente"]);
			$("#editarnumero_dias_transacciones_agente").val(respuesta["numero_dias_transacciones_agente"]);


			$("#editarhora_desde_transacciones_agente").val(respuesta["hora_desde_transacciones_agente"]);
			$("#editarhora_hasta_transacciones_agente").val(respuesta["hora_hasta_transacciones_agente"]);

			
			$("#editarfecha_movimiento_transacciones_agente").val(respuesta["fecha_movimiento_transacciones_agente"]);
			$("#editartipo_incapacidad_transacciones_agente").val(respuesta["tipo_incapacidad_transacciones_agente"]);
			if(respuesta["tipo_incapacidad_transacciones_agente"] != ""){
				$(".ocultar").attr("style","visibility:visibility ; height:100%;");
			}


			var codigo_movimiento=respuesta["tipo_movimiento_transacciones_agente"].split("-")[0];
			if(codigo_movimiento=="22"){
				$(".grupoid_vacante_transacciones_agente").attr("style","visibility:show;");
			}

			codigo_ubicacion=respuesta["nueva_ubicacion_transacciones_agente"].split("-")[0];
				/*  ******** */
					var parametros = {
						"codigoubicacion" : codigo_ubicacion,
						"accion" : "consultarvante"
						};
					$.ajax({
					url:"ajax/historialvacante.ajax.php",
					method: "POST",
					data: parametros,
					success: function(respuesta01){
									/* ********** */
									$(".vacante_a_cubrir").empty();
									$(".vacante_a_cubrir").prepend(respuesta01.split(",")[0]);/* --codigo ubicacion */
									$("#editarid_vacante_transacciones_agente").val(respuesta["id_vacante_transacciones_agente"]);

					}
					});
					/* ********** */


		

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
	    url:"ajax/transacciones_agente.ajax.php",
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
$(".tablas").on("click", ".btnEliminartransacciones_agente", function(){

  var idtransacciones_agente = $(this).attr("idtransacciones_agente");
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

      window.location = "index.php?ruta=transaccionagente&idtransacciones_agente="+idtransacciones_agente+"&Codigo="+Codigo;

    }

  })

})





$( ".guardarvacante" ).on( "click", function() {
	guardarregistro2();
	

});


function guardarregistro2(){

	var cuandoinsertar=$("#insertarvacante").val();
	var id = $("#id").val();
	var id_vacante_historialvacante = $(".vacante_a_cubrir").val();
	var fecha_historialvacante = $(".input_fecha_transacciones_agente").val();
	var hora_historialvacante = $(".input_hora_transacciones_agente").val();
	var accion_historialvacante = "Traslado";
	var id_empleado_historialvacante = 	$("#txtidempleado").val();
	var codigo_empleado_historialvacante = $("#txtcodigoempleado").val();
	var nombre_empleado_historialvacante = $(".input_idagente_transacciones_agente").val();
	var id_ubicacion_historialvacante = $("#txtidubicacion").val();
	var codigo_ubicacion_historialvacante = $("#txtcodigoubicacion").val();
	var nombre_ubicacion_historialvacante = $("#txtnombreubicacion").val();
	var comentario_historialvacante=$(".input_comentarios_transacciones_agente").val();

	/*  ******** */
	var parametros = {
		"id" : id,
		"id_vacante_historialvacante" : id_vacante_historialvacante,
		"fecha_historialvacante" : fecha_historialvacante,
		"hora_historialvacante" : hora_historialvacante,
		"accion_historialvacante" : accion_historialvacante,
		"id_empleado_historialvacante" : id_empleado_historialvacante,
		"codigo_empleado_historialvacante" : codigo_empleado_historialvacante,
		"nombre_empleado_historialvacante" : nombre_empleado_historialvacante,
		"id_ubicacion_historialvacante" : id_ubicacion_historialvacante,
		"codigo_ubicacion_historialvacante" : codigo_ubicacion_historialvacante,
		"nombre_ubicacion_historialvacante" : nombre_ubicacion_historialvacante,
		"comentario_historialvacante" : comentario_historialvacante,
		"accion" : "insertar"
	    };
		if(cuandoinsertar=="Si")
		{	
			$.ajax({
			url:"ajax/historialvacante.ajax.php",
			method: "POST",
			data: parametros,
			success: function(respuesta){

				if($.trim(respuesta)=="ok"){
					swal({
						type: "success",
						title: "Guardado con Exito",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
			
					}).then(function (result) {
						if (result.value) {
							

							/* window.location = "situacion"; */
							/* location.reload(); */

							
							}
						});
					}
				}

   			});
		}
	/* ********** */
	
	guardarubicacionagente();
};


function guardarubicacionagente(){

	var insertarnuevaubicacion= $("#insertarnuevaubicacion").val();
	/* var id_empleado_historialvacante = 	$("#txtidempleado").val(); */
	var idubicacion_agente = $("#idnuevaubicacion").val();
	var codigo_agente = $("#txtcodigoempleado").val();
	var nombre_agente = $(".input_idagente_transacciones_agente").val();


	/*  ******** */
	var parametros = {
		"id" : "",
		"idubicacion_agente" : idubicacion_agente,
		"codigo_agente" : codigo_agente,
		"nombre_agente" : nombre_agente,
		"accion" : "asignarubicacion"
	    };


		$.ajax({
		url:"ajax/historialvacante.ajax.php",
		method: "POST",
		data: parametros,
		success: function(respuesta){

		
			if($.trim(respuesta)=="ok"){
				swal({
					type: "success",
					title: "Guardado con Exito",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
		
				}).then(function (result) {
					if (result.value) {
						/* window.location = "situacion"; */
						/* location.reload(); */
						/* guardarubicacionagente(); */
						
					}
				});
			}

		}
		});
	
	/* ********** */

}