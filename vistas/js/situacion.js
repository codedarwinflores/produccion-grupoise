/* COLOCACION DE ICONOS */
$(document).ready(function () {


	$(".agregar_situacion").attr("disabled", "disabled");


	/* CAMPOS INVISIBLES */
	$(".inicial_situacion").attr("style", "visibility:hidden");
	$(".motivo_situacion").attr("style", "visibility:hidden");
	$(".vacante_situacion").attr("style", "visibility:hidden");
	$(".pocision_situacion").attr("style", "visibility:hidden");
	$(".cubrir_situacion").attr("style", "visibility:hidden");
	$(".solicitado_situacion").attr("style", "visibility:hidden");
	$(".cobrar_cliente").attr("style", "visibility:hidden");
	$(".ingreso_hora").attr("style", "visibility:hidden");




	/* validar si fecha esta cerrada */
			$( "#fecha_situacion" ).on( "click", function() {
				$( "#ic__datepicker-4" ).on( "click", function() {
					/* ******************************************* */
						var valor=$("#fecha_situacion").val();
						var dataString = 'fecha='+valor+
										'&modulo=situacion'+
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
										$("#fecha_situacion").val("");
								
								}

							}
						});
					/* ******************************************* */
				});
			});
			
	/* ******************************* */
	


	$("#incapacidad_situacion").blur(function () {
		var valor = $(this).val();
		if (valor > 0) {
			$(".inicial_situacion").removeAttr("style");

		}
		else {
			$(".inicial_situacion").attr("style", "visibility:hidden");

		}
	});

	$( "#motivo_horas_extras" ).on( "change", function() {
		descontar_tipohora
		var requiere_agente = $('option:selected', this).attr("requiere_agente");
		var descontar_tipohora = $('option:selected', this).attr("descontar_tipohora");

		if(descontar_tipohora=="Si"){
			$(".descontar_tipohora").val("Si");
		}
		else{
			$(".descontar_tipohora").val("No");
		}


		if(requiere_agente=="Si"){
			$(".cubrir_situacion").removeAttr("style");
		}
		else{
			$(".cubrir_situacion").attr("style", "visibility:hidden");
		}

		/* **************** */

		var solicitado_tipohora = $('option:selected', this).attr("solicitado_tipohora");
		if(solicitado_tipohora=="Si"){
			$(".solicitado_situacion").removeAttr("style");
		}
		else{
			$(".solicitado_situacion").attr("style", "visibility:hidden");

		}

		/* **************** */
		var cobrar_cliente_tipohora = $('option:selected', this).attr("cobrar_cliente_tipohora");
		if(cobrar_cliente_tipohora=="Si"){
			$(".cobrar_cliente").removeAttr("style");
		}
		else{
			$(".cobrar_cliente").attr("style", "visibility:hidden");

		}
		/* **************** */
		var ingreso_hora_tipohora = $('option:selected', this).attr("ingreso_hora_tipohora");
		if(ingreso_hora_tipohora=="Si"){
			$(".ingreso_hora").removeAttr("style");
		}
		else{
			$(".ingreso_hora").attr("style", "visibility:hidden");
		}

 	 });


	$(".inputtable").change(function () {
		var valor = $(this).val();
		var idinput_seleccionado = $(this).attr("id");
		var clase = $(this).attr("class");

		if(idinput_seleccionado=="hora_extra_situacion"){
			if(valor>24){
				$(this).val(24);
				valor=24;
			}
		}
		if(idinput_seleccionado=="hora_normales_situacion"){
			if(valor>24){
				$(this).val(24);
				valor=24;
			}
		}
		if(idinput_seleccionado=="tiempo_compensatorio_situacion"){
			if(valor>24){
				$(this).val(24);
				valor=24;
			}
		}


		if (valor > 0) {
			$(".tabla_situacion tr td .inputtable").each(function () {
				var id_inputs = $(this).attr("id");
				if (idinput_seleccionado != id_inputs) {
					$(this).attr("readonly", "readonly");
					$(this).val("");
				}


				if (clase != "form-control inputtable activarmotivo") {
					$(".motivo_situacion").attr("style", "visibility:hidden");
					$(".vacante_situacion").attr("style", "visibility:hidden");
					$(".pocision_situacion").attr("style", "visibility:hidden");

				}
				else {
					$(".motivo_situacion").removeAttr("style");
					$(".vacante_situacion").removeAttr("style");
					$(".pocision_situacion").removeAttr("style");

				}

			});
		}
		else {
			$(".tabla_situacion tr td .inputtable").each(function () {
				var id_inputs = $(this).attr("id");
				if (idinput_seleccionado != id_inputs) {
					$(this).removeAttr("readonly");
				}



			});
			$("#fecha_situacion").attr("readonly", "readonly");
			$(".motivo_situacion").attr("style", "visibility:hidden");
			$(".vacante_situacion").attr("style", "visibility:hidden");
			$(".pocision_situacion").attr("style", "visibility:hidden");

		}




	});


})



/* vaciar */
$('#modalAgregarsituacion').on('hidden.bs.modal', function() {
	$('.todosinput input[type="text"]').each(function() {
		// Establece el valor de cada input en cadena vacía
		$(this).val('');
	  });

	  $('.todosinput select').each(function() {
		// Establece el valor de cada input en cadena vacía
		$(this).val('');
	  });
	
  })
/*  */


$( "#ubicacion_situacion" ).change(function()
{ 

   var codigo_ubicacion = $('option:selected', this).attr('codigo');
   var idcliente = $('option:selected', this).attr('idcliente');

   var horas_autorizada = $('option:selected', this).attr('horas_autorizada');
   if(horas_autorizada>0){

	var hora_extra=$("#hora_extra_situacion").val();
		if(hora_extra != ""){
				
				var partes = hora_extra.split(':');
				var minutos = parseInt(partes[1], 10);
				var convertir=minutos/60;
				// Quitar el '0.' y redondear a número entero
				var resultado = Math.round(parseFloat(convertir.toString().substring(2)));


				if(resultado<10){
					resultado=resultado+"0";
				}
				var nueva_hora=parseInt(partes[0], 10)+":"+resultado;
				$("#hora_extra_situacion").val(nueva_hora);



				var mensajeDiv = $('#mensaje_situacion');
				mensajeDiv.text('SE REALIZO UN CAMBIO EN HORA, YA QUE LA UBICACIÓN TIENE HORA EXTRA').show();
				setTimeout(function () {
					mensajeDiv.text("");
				}, 5000);

		}
   /*  ******** */
/* proceso para obtener el valor del minuto */	
   /* var parametros = {
		"idcliente" : idcliente,
		"minutos" : horas_autorizada,
		"accion" : "minutos"
		};
	$.ajax({
	url:"ajax/historialvacante.ajax.php",
	method: "POST",
	data: parametros,
		success: function(respuesta){
			
		}
	}); */
	/* ********** */

   }

  /* ************* */


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
				   $("#vacante_situacion").append("<option value=''>Seleccione Vancante</option>");
				   $(".vacante_a_cubrir").append(respuesta.split(",")[3]);/* --codigo ubicacion */
			/* 	   $("#cubrir").val(respuesta.split(",")[4]);
				   $("#select2-cubrir_situacion-container").text(respuesta.split(",")[4]); */
				  /*  $("#cubrir_situacion option[value='"+respuesta.split(",")[4]+"']").attr("selected", true); */
	   
	   
   }
   });
   /* ********** */
})



/* vacante select */
$( ".vacante_a_cubrir" ).on( "change", function() {
	
	var empleado = $('option:selected', this).attr('empleado');
	var posicion_vacante = $('option:selected', this).attr('posicion_vacante');
	
	$("#posicion_situacion").val(posicion_vacante);

	$("#cubrir").val(empleado);
	$("#select2-cubrir_situacion-container").text(empleado);

});


$( "#codigocliente_situacion").on( "change", function() {

	var nombrecliente_situacion = $('option:selected', this).attr('nombrecliente_situacion');
	var idcliente_situacion = $('option:selected', this).attr('idcliente_situacion');
	$(".idcliente_situacion").val(idcliente_situacion);
	$(".nombrecliente_situacion").val(nombrecliente_situacion);
})

/* OBTENER DATOS DE EMPLEADO */
/* $(".nombreempleado_situacion").click(function () { */
$( ".nombreempleado_situacion" ).on( "change", function() {

	var estado_empleado = $('option:selected', this).attr("estado_empleado");
	

	if($(this).val()=="" || estado_empleado != 2){
		$(".agregar_situacion").attr("disabled", "disabled");
		$(".guardar_movimiento").attr("disabled", "disabled");
		$(".estado_emple").text("El empleado seleccionado no esta con estado contratado");
	}
	else{
		$(".agregar_situacion").removeAttr("disabled");
		$(".guardar_movimiento").removeAttr("disabled");
		$(".estado_emple").text("");

	}
	var valor = $('option:selected', this).attr("nombre");
	var idempleado = $('option:selected', this).attr("idempleado");
	var codigo = $('option:selected', this).attr("codigo");
	var consultar = "consultar";
	var nombre_cargo = $('option:selected', this).text();


	
	$(".informacion_empleado").text(codigo+"-"+nombre_cargo);
	

	$("#idempleado").val(idempleado);
	$("#codigo_empleado").val(codigo);
	$("#nombre_empleado").val(valor);
	/* campos */
	$("#idempleado_situacion").val(codigo);
	var id = "";
	var idempleado_situacion = $("#idempleado_situacion").val();
	var dias_ausencia_situacion = "";
	var horas_ausencia_situacion = "";
	var consulta_isss_situacion = "";
	var incapacidad_situacion = "";
	var ansp_situacion = "";
	var vacaciones_situacion = "";
	var permiso_situacion = "";
	var hora_normales_situacion = "";
	var tiempo_compensatorio_situacion = "";
	var recuperar_tiempo_situacion = "";
	var comodin_situacion = "";
	var cubierto_situacion = "";
	var nuevo_servicio_situacion = "";
	var fin_servicio_situacion = "";
	var ubicacion_situacion = "";
	var servicio_eventual_situacion = "";
	var inactivos_situacion = "";
	var activo_situacion = "";
	var liquidado_situacion = "";
	var inicial_situacion = "";
	var hora_extra_situacion = "";
	var vacante_situacion = "";
	var posicion_situacion = "";
	var fecha_situacion = "";
	var accion = consultar;
	var motivo_horas_extras = "";
	var horas_no_cubiertas = $("#horas_no_cubiertas").val();
	var cubrir_situacion = $("#cubrir_situacion").val();
	var solicitado_situacion = $("#solicitado_situacion").val();

	/*  ******** */
	var parametros = {
		"id": id,
		"idempleado_situacion": idempleado_situacion,
		"dias_ausencia_situacion": dias_ausencia_situacion,
		"horas_ausencia_situacion": horas_ausencia_situacion,
		"consulta_isss_situacion": consulta_isss_situacion,
		"incapacidad_situacion": incapacidad_situacion,
		"ansp_situacion": ansp_situacion,
		"vacaciones_situacion": vacaciones_situacion,
		"permiso_situacion": permiso_situacion,
		"hora_normales_situacion": hora_normales_situacion,
		"tiempo_compensatorio_situacion": tiempo_compensatorio_situacion,
		"recuperar_tiempo_situacion": recuperar_tiempo_situacion,
		"comodin_situacion": comodin_situacion,
		"cubierto_situacion": cubierto_situacion,
		"nuevo_servicio_situacion": nuevo_servicio_situacion,
		"fin_servicio_situacion": fin_servicio_situacion,
		"ubicacion_situacion": ubicacion_situacion,
		"servicio_eventual_situacion": servicio_eventual_situacion,
		"inactivos_situacion": inactivos_situacion,
		"activo_situacion": activo_situacion,
		"liquidado_situacion": liquidado_situacion,
		"inicial_situacion": inicial_situacion,
		"hora_extra_situacion": hora_extra_situacion,
		"vacante_situacion": vacante_situacion,
		"posicion_situacion": posicion_situacion,
		"fecha_situacion": fecha_situacion,
		"accion": accion
	};

	var dataString = 'id=' + id + '&idempleado_situacion=' + idempleado_situacion + '&dias_ausencia_situacion=' + dias_ausencia_situacion + '&horas_ausencia_situacion=' + horas_ausencia_situacion + '&consulta_isss_situacion=' + consulta_isss_situacion + '&incapacidad_situacion=' + incapacidad_situacion + '&ansp_situacion=' + ansp_situacion + '&vacaciones_situacion=' + vacaciones_situacion + '&permiso_situacion=' + permiso_situacion + '&hora_normales_situacion=' + hora_normales_situacion + '&tiempo_compensatorio_situacion=' + tiempo_compensatorio_situacion + '&recuperar_tiempo_situacion=' + recuperar_tiempo_situacion + '&comodin_situacion=' + comodin_situacion + '&cubierto_situacion=' + cubierto_situacion + '&nuevo_servicio_situacion=' + nuevo_servicio_situacion + '&fin_servicio_situacion=' + fin_servicio_situacion + '&ubicacion_situacion=' + ubicacion_situacion + '&servicio_eventual_situacion=' + servicio_eventual_situacion + '&inactivos_situacion=' + inactivos_situacion + '&activo_situacion=' + activo_situacion + '&liquidado_situacion=' + liquidado_situacion + '&inicial_situacion=' + inicial_situacion + '&hora_extra_situacion=' + hora_extra_situacion + '&vacante_situacion=' + vacante_situacion + '&posicion_situacion=' + posicion_situacion + '&fecha_situacion=' + fecha_situacion + '&accion=' + accion + '&motivo_horas_extras=' + motivo_horas_extras + '&horas_no_cubiertas=' + horas_no_cubiertas+ '&cubrir_situacion=' + cubrir_situacion+ '&solicitado_situacion=' + solicitado_situacion;


	$.ajax({
		data: dataString,
		url: "ajax/situacion.ajax.php",
		type: 'post',
		success: function (response) {
			
			$("#cargar_data_situacion").empty();
			$("#cargar_data_situacion").append(response.split(",")[0]);

			if(estado_empleado != 2){
				$(".btnEliminarsituacion").attr("disabled", "disabled");
			}
			else{
				$(".btnEliminarsituacion").removeAttr("disabled");
			}

			
			
			$("#selec_ubicacion").val(response.split(",")[1]);
			$("#select2-ubicacion_situacion-container").text(response.split(",")[1]);

			$(".mostrar_ubicacion").text(response.split(",")[1]);

			var ubicacion=response.split(",")[1];
			var codigoubicacion = ubicacion.split('-');
			if(codigoubicacion[0]=="I0023048"){
				$("#comodin_situacion").val("Si");
			}


			var infoubicacion=response.split(",")[1];
			var codigo_ubicacion=infoubicacion.split("-")[0];
			var nombre_ubicacion=infoubicacion.split("-")[1];
			/*  ******** */
			var parametros = {
				"codigo_ubicacion" : codigo_ubicacion,
				"accion" : "infoubicacion"
				};
			$.ajax({
			url:"ajax/historialvacante.ajax.php",
			method: "POST",
			data: parametros,
			success: function(respuesta01){
							/* ********** */
						
							
							
							
							$("#idubicacion").val(respuesta01);
							$("#codigo_ubicacion").val(codigo_ubicacion);
							$("#nombre_ubicacion").val(nombre_ubicacion);
			}
			});
			/* ********** */




		
	
			var table =$('.tablas').DataTable({
				searching: true,
				"paging": false, 
				"ordering": false,
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

			$(".tablas").on("click", ".btnEditarsituacion", function () {
				var id = $(this).attr("id");
				editar(id);
			});

			$(".tablas").on("click", ".btnEliminarsituacion", function () {
				var id = $(this).attr("id");
				eliminar(id);
			});

			    // Escuchar cambios en los campos de fecha
				$('.filtrar_fecha').click(function() {
					filtrarPorRango();

				});
				$('.limpiar_table').click(function() {
					$("#fechaInicio").val("");
					$("#fechaFin").val("");
					filtrarPorRango();


				});



		}
	});
	/* ********* */

});


function filtrarPorRango() {
    var fechaInicio = document.getElementById("fechaInicio").value;
    var fechaFin = document.getElementById("fechaFin").value;
    
    var table = document.getElementById("tablas_filtro");
    var rows = table.getElementsByTagName("tr");
    
    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var cell = row.getElementsByTagName("td")[0]; // Suponemos que la fecha está en la primera columna
        
        if (cell) {
            var fecha = cell.textContent || cell.innerText;
            
            if (compararFechas(fecha, fechaInicio) >= 0 && compararFechas(fecha, fechaFin) <= 0) {
                row.style.display = ""; // Mostrar la fila si está dentro del rango
            } else {
                row.style.display = "none"; // Ocultar la fila si no está dentro del rango
            }
        }
    }
}

function compararFechas(fecha1, fecha2) {
    var date1 = new Date(fecha1.split('-').reverse().join('-'));
    var date2 = new Date(fecha2.split('-').reverse().join('-'));
    
    if (date1 < date2) return -1;
    if (date1 > date2) return 1;
    return 0;
}

/* ********************* */

$(".agregar_situacion").click(function () {

	var fecha_hora_ingreso_his=$("#fecha_hora_ingreso_his").val();
	$("#fecha_hora_ingreso").val(fecha_hora_ingreso_his);
	$("#accion").val("insertar");
	$(".inputtable").val("");

	/* ***************** */
		var valor = $(".inputtable").val();
		var idinput_seleccionado = $(".inputtable").attr("id");
		var clase = $(".inputtable").attr("class");


		$("#dias_ausencia_situacion").removeAttr("readonly");

			$(".tabla_situacion tr td .inputtable").each(function () {
				var id_inputs = $(this).attr("id");
				if (idinput_seleccionado != id_inputs) {
					$(this).removeAttr("readonly");
				}
			});
			$("#fecha_situacion").attr("readonly", "readonly");
			$(".motivo_situacion").attr("style", "visibility:hidden");
			$(".vacante_situacion").attr("style", "visibility:hidden");
			$(".pocision_situacion").attr("style", "visibility:hidden");

		


	
	/* ***************** */
});

/* ********************* */

$(".guardar_movimiento").click(function () {
	/* campos */
	var id = $("#id").val();
	var idempleado_situacion = $("#idempleado_situacion").val();
	var dias_ausencia_situacion = $("#dias_ausencia_situacion").val();
	var horas_ausencia_situacion = $("#horas_ausencia_situacion").val();
	var consulta_isss_situacion = $("#consulta_isss_situacion").val();
	var incapacidad_situacion = $("#incapacidad_situacion").val();
	var ansp_situacion = $("#ansp_situacion").val();
	var vacaciones_situacion = $("#vacaciones_situacion").val();
	var permiso_situacion = $("#permiso_situacion").val();
	var hora_normales_situacion = $("#hora_normales_situacion").val();
	var tiempo_compensatorio_situacion = $("#tiempo_compensatorio_situacion").val();
	var recuperar_tiempo_situacion = $("#recuperar_tiempo_situacion").val();
	var comodin_situacion = $("#comodin_situacion").val();
	var cubierto_situacion = $("#cubierto_situacion").val();
	var nuevo_servicio_situacion = $("#nuevo_servicio_situacion").val();
	var fin_servicio_situacion = $("#fin_servicio_situacion").val();
	var ubicacion_situacion = $("#ubicacion_situacion").val();
	var servicio_eventual_situacion = $("#idservicio_eventual_situacion").val();
	var inactivos_situacion = $("#inactivos_situacion").val();
	var activo_situacion = $("#activo_situacion").val();
	var liquidado_situacion = $("#liquidado_situacion").val();
	var inicial_situacion = $("#inicial_situacion").val();
	var hora_extra_situacion = $("#hora_extra_situacion").val();
	var vacante_situacion = $("#vacante_situacion").val();
	var posicion_situacion = $("#posicion_situacion").val();
	var fecha_situacion = $("#fecha_situacion").val();
	var accion = $("#accion").val();
	var motivo_horas_extras = $("#motivo_horas_extras").val();
	var horas_no_cubiertas = $("#horas_no_cubiertas").val();
	var cubrir_situacion = $("#cubrir_situacion").val();
	var solicitado_situacion = $("#solicitado_situacion").val();
	var codigocliente_situacion = $("#codigocliente_situacion").val();
	var idcliente_situacion = $(".idcliente_situacion").val();
	var nombrecliente_situacion = $(".nombrecliente_situacion").val();
	var hora_inicio_situacion = $("#hora_inicio_situacion").val();
	var hora_fin_situacion = $("#hora_fin_situacion").val();
	var numero_planilla_admin = $("#numero_planilla_admin").val();
	var descontar_tipohora = $(".descontar_tipohora").val();
	var dias_no_sueldo = $("#dias_no_sueldo").val();
	var dias_tra_incapacidad = $("#dias_tra_incapacidad").val();
	var fecha_hora_ingreso = $("#fecha_hora_ingreso").val();
	var observacion_situacion = $("#observacion_situacion").val();



	/*  ******** */

	var dataString = 'id=' + $.trim(id) + '&idempleado_situacion=' + idempleado_situacion + '&dias_ausencia_situacion=' + dias_ausencia_situacion + '&horas_ausencia_situacion=' + horas_ausencia_situacion + '&consulta_isss_situacion=' + consulta_isss_situacion + '&incapacidad_situacion=' + incapacidad_situacion + '&ansp_situacion=' + ansp_situacion + '&vacaciones_situacion=' + vacaciones_situacion + '&permiso_situacion=' + permiso_situacion + '&hora_normales_situacion=' + hora_normales_situacion + '&tiempo_compensatorio_situacion=' + tiempo_compensatorio_situacion + '&recuperar_tiempo_situacion=' + recuperar_tiempo_situacion + '&comodin_situacion=' + comodin_situacion + '&cubierto_situacion=' + cubierto_situacion + '&nuevo_servicio_situacion=' + nuevo_servicio_situacion + '&fin_servicio_situacion=' + fin_servicio_situacion + '&ubicacion_situacion=' + ubicacion_situacion + '&servicio_eventual_situacion=' + servicio_eventual_situacion + '&inactivos_situacion=' + inactivos_situacion + '&activo_situacion=' + activo_situacion + '&liquidado_situacion=' + liquidado_situacion + '&inicial_situacion=' + inicial_situacion + '&hora_extra_situacion=' + hora_extra_situacion + '&vacante_situacion=' + vacante_situacion + '&posicion_situacion=' + posicion_situacion + '&fecha_situacion=' + fecha_situacion + '&accion=' + accion + '&motivo_horas_extras=' + motivo_horas_extras + '&horas_no_cubiertas=' + horas_no_cubiertas + '&cubrir_situacion=' + cubrir_situacion+ '&solicitado_situacion=' + solicitado_situacion+ '&codigocliente_situacion=' + codigocliente_situacion+ '&idcliente_situacion=' + idcliente_situacion+ '&nombrecliente_situacion=' + nombrecliente_situacion+ '&hora_inicio_situacion=' + hora_inicio_situacion+ '&hora_fin_situacion=' + hora_fin_situacion+ '&numero_planilla_admin=' + numero_planilla_admin+ '&descontar_tipohora=' + descontar_tipohora+ '&dias_no_sueldo=' + dias_no_sueldo+ '&dias_tra_incapacidad=' + dias_tra_incapacidad+ '&fecha_hora_ingreso=' + fecha_hora_ingreso+ '&observacion_situacion=' + observacion_situacion;

	console.log(dataString);

	if(fecha_situacion!=""){

		$.ajax({
			data: dataString,
			url: "ajax/situacion.ajax.php",
			type: 'post',
			success: function (response) {
				console.log(response);
			
				if($.trim(response)=="ok"){
					guardarregistro3();
					swal({

						type: "success",
						title: "Guardado con Exito",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function (result) {
						if (result.value) {
							window.location = "situacion";
						}
					});
				}
			}
		});

	}
	else{

		swal({
			title: 'ERROR',
			text: "No a ingresado fecha",
			type: 'warning',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Aceptar'
		})
	}
	/* ********* */




});



/*=============================================
EDITAR 
=============================================*/
function editar(ids) {

	/* campos */
	var id = ids;
	var idempleado_situacion = "";
	var dias_ausencia_situacion = "";
	var horas_ausencia_situacion = "";
	var consulta_isss_situacion = "";
	var incapacidad_situacion = "";
	var ansp_situacion = "";
	var vacaciones_situacion = "";
	var permiso_situacion = "";
	var hora_normales_situacion = "";
	var tiempo_compensatorio_situacion = "";
	var recuperar_tiempo_situacion = "";
	var comodin_situacion = "";
	var cubierto_situacion = "";
	var nuevo_servicio_situacion = "";
	var fin_servicio_situacion = "";
	var ubicacion_situacion = "";
	var servicio_eventual_situacion = "";
	var inactivos_situacion = "";
	var activo_situacion = "";
	var liquidado_situacion = "";
	var inicial_situacion = "";
	var hora_extra_situacion = "";
	var vacante_situacion = "";
	var posicion_situacion = "";
	var fecha_situacion = "";
	var motivo_horas_extras = "";
	var accion = "obtenerdata";
	var horas_no_cubiertas = "horas_no_cubiertas";
	var cubrir_situacion = "cubrir_situacion";
	var solicitado_situacion = "solicitado_situacion";


	/*  ******** */

	var dataString = 'id=' + id + '&idempleado_situacion=' + idempleado_situacion + '&dias_ausencia_situacion=' + dias_ausencia_situacion + '&horas_ausencia_situacion=' + horas_ausencia_situacion + '&consulta_isss_situacion=' + consulta_isss_situacion + '&incapacidad_situacion=' + incapacidad_situacion + '&ansp_situacion=' + ansp_situacion + '&vacaciones_situacion=' + vacaciones_situacion + '&permiso_situacion=' + permiso_situacion + '&hora_normales_situacion=' + hora_normales_situacion + '&tiempo_compensatorio_situacion=' + tiempo_compensatorio_situacion + '&recuperar_tiempo_situacion=' + recuperar_tiempo_situacion + '&comodin_situacion=' + comodin_situacion + '&cubierto_situacion=' + cubierto_situacion + '&nuevo_servicio_situacion=' + nuevo_servicio_situacion + '&fin_servicio_situacion=' + fin_servicio_situacion + '&ubicacion_situacion=' + ubicacion_situacion + '&servicio_eventual_situacion=' + servicio_eventual_situacion + '&inactivos_situacion=' + inactivos_situacion + '&activo_situacion=' + activo_situacion + '&liquidado_situacion=' + liquidado_situacion + '&inicial_situacion=' + inicial_situacion + '&hora_extra_situacion=' + hora_extra_situacion + '&vacante_situacion=' + vacante_situacion + '&posicion_situacion=' + posicion_situacion + '&fecha_situacion=' + fecha_situacion + '&accion=' + accion + '&motivo_horas_extras=' + motivo_horas_extras + '&horas_no_cubiertas=' + horas_no_cubiertas + '&cubrir_situacion=' + cubrir_situacion+ '&solicitado_situacion=' + solicitado_situacion;

	$.ajax({
		data: dataString,
		url: "ajax/situacion.ajax.php",
		type: 'post',
		success: function (response) {

			
			console.log(response.split(","));

			$("#accion").val("modificar");

			$("#id").val(response.split(",")[0]);
			$("#idempleado_situacion").val(response.split(",")[1]);
			$("#dias_ausencia_situacion").val(response.split(",")[2]);
			$("#horas_ausencia_situacion").val(response.split(",")[3]);
			$("#consulta_isss_situacion").val(response.split(",")[4]);
			$("#incapacidad_situacion").val(response.split(",")[5]);
			$("#ansp_situacion").val(response.split(",")[6]);
			$("#vacaciones_situacion").val(response.split(",")[7]);
			$("#permiso_situacion").val(response.split(",")[8]);
			$("#hora_normales_situacion").val(response.split(",")[9]);
			$("#tiempo_compensatorio_situacion").val(response.split(",")[10]);
			$("#recuperar_tiempo_situacion").val(response.split(",")[11]);
			$("#comodin_situacion").val(response.split(",")[12]);
			$("#cubierto_situacion").val(response.split(",")[13]);
			$("#nuevo_servicio_situacion").val(response.split(",")[14]);
			$("#fin_servicio_situacion").val(response.split(",")[15]);
			/* el 16 esta hasta abajo  */
			$("#servicio_eventual_situacion").val(response.split(",")[17]);
			$("#inactivos_situacion").val(response.split(",")[18]);
			$("#activo_situacion").val(response.split(",")[19]);
			$("#liquidado_situacion").val(response.split(",")[20]);
			$("#inicial_situacion").val(response.split(",")[21]);
			$("#hora_extra_situacion").val(response.split(",")[22]);
			/* el 23 vacante*/
			$("#posicion_situacion").val(response.split(",")[24]);
			$("#fecha_situacion").val(response.split(",")[25]);
			$("#motivo_horas_extras").val(response.split(",")[26]).trigger('change.select2');

			/* $("#motivo_value").val(response.split(",")[26]);
			$("#select2-motivo_horas_extras-container").text(response.split(",")[26]); */
			$("#horas_no_cubiertas").val(response.split(",")[27]);


			/* $("#cubrir").val(response.split(",")[28]);
			$("#select2-cubrir_situacion-container").text(response.split(",")[28]);
 */
			$("#cubrir_situacion").val(response.split(",")[28]).trigger('change.select2');

	


			$("#motivo_horas_extras option[value='"+response.split(",")[26]+"']").attr("selected", true);
			var requiere_agente = $('option:selected', "#motivo_horas_extras").attr("requiere_agente");
			var descontar_tipohora = $('option:selected', "#motivo_horas_extras").attr("descontar_tipohora");

			if(descontar_tipohora=="Si"){
				$(".descontar_tipohora").val("Si");
			}
			else{
				$(".descontar_tipohora").val("No");
			}

			if(requiere_agente=="Si"){
				$(".cubrir_situacion").removeAttr("style");
			}
			else{
				$(".cubrir_situacion").attr("style", "visibility:hidden");
			}


		/* 	if(response.split(",")[28]==""){
				$(".cubrir_situacion").attr("style", "visibility:hidden");
			}
			else{
				$(".cubrir_situacion").removeAttr("style");
			} */
			$("#solicitado_situacion").val(response.split(",")[29]);
			if(response.split(",")[29]==""){
				$(".solicitado_situacion").attr("style", "visibility:hidden");
			}
			else{
				$(".solicitado_situacion").removeAttr("style");
			}
			$(".idcliente_situacion").val(response.split(",")[30]);
			$("#codigocliente").val(response.split(",")[31]);
			$("#select2-codigocliente_situacion-container").text(response.split(",")[31]+"-"+response.split(",")[32]);
			$(".nombrecliente_situacion").val(response.split(",")[32]);
			$("#hora_inicio_situacion").val(response.split(",")[33]);
			$("#hora_fin_situacion").val(response.split(",")[34]);
			$("#numero_planilla_admin").val(response.split(",")[35]);

			$("#dias_tra_incapacidad").val(response.split(",")[36]);
			$("#dias_no_sueldo").val(response.split(",")[37]);
			$("#fecha_hora_ingreso").val(response.split(",")[38]);
			$("#observacion_situacion").val(response.split(",")[39]);


			/* $("#ubicacion_situacion").val(response.split(",")[16]); */
			/* cambiar numero al maximo pues la ubicacion tiene que ser la ultima */
			if(response.split(",")[33]==""){
				$(".ingreso_hora").attr("style", "visibility:hidden");
			}
			else{
				$(".ingreso_hora").removeAttr("style");
			}


			/* alert(response.split(",")[16]); */
			/* alert(response.split(",")[36]+"/"+response.split(",")[40]+"/"+response.split(",")[16]); */
			if(response.split(",")[16]==""){
				
				$("#ubicacion_situacion").val(response.split(",")[40]).trigger('change.select2');/* ---ULTIMO CAMPO */
				/* $("#selec_ubicacion").val(response.split(",")[36]); */
				/* $("#select2-ubicacion_situacion-container").text(response.split(",")[40]); */
			}
			else{
				$("#ubicacion_situacion").val(response.split(",")[16]).trigger('change.select2');
				/* $("#selec_ubicacion").val(response.split(",")[16]);
				$("#select2-ubicacion_situacion-container").text(response.split(",")[16]); */
			}


			if(response.split(",")[31]==""){
				$(".cobrar_cliente").attr("style", "visibility:hidden");
			}
			else{
				$(".cobrar_cliente").removeAttr("style");
			}


			/* var valor = response.split(",")[22]; */
			var valor= response.split(",")[26];
			if (valor !="") {
				$(".motivo_situacion").removeAttr("style");
				$(".vacante_situacion").removeAttr("style");
				$(".pocision_situacion").removeAttr("style");
			}
			else {
				$(".motivo_situacion").attr("style", "visibility:hidden");
				$(".vacante_situacion").attr("style", "visibility:hidden");
				$(".pocision_situacion").attr("style", "visibility:hidden");


			}


			var ubicacion=response.split(",")[16];
			var codigo_ubicacion=ubicacion.split("-")[0];
			
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
			
							$("#vacante_situacion").empty();
							$("#vacante_situacion").append("<option>Seleccione Vancante</option>");
							$("#vacante_situacion").append(respuesta01.split(",")[3]);/* --llenamos todas las vacante */
							$("#vacante_situacion").val(response.split(",")[23]);/**buscamos la vancate luego de llenarla */
						/* 	$("#cubrir").val(respuesta.split(",")[4]);
							$("#select2-cubrir_situacion-container").text(respuesta.split(",")[4]); */
			}
			});



			/* ********** */
			/* var horasnocuebiertas = response.split(",")[27];
			if (horasnocuebiertas > 0) {
				$(".motivo_situacion").removeAttr("style");
				$(".vacante_situacion").removeAttr("style");
				$(".pocision_situacion").removeAttr("style");
			}
			else {
				$(".motivo_situacion").attr("style", "visibility:hidden");
				$(".vacante_situacion").attr("style", "visibility:hidden");
				$(".pocision_situacion").attr("style", "visibility:hidden");
			} */

			if(response.split(",")[5]>0){
				$(".inicial_situacion").removeAttr("style");
			}



		}
	});


}



/*=============================================
ELIMINAR 
=============================================*/
function eliminar(ids) {

	var id = ids;
	var accion = "eliminar";

	swal({
		title: '¿Está seguro de borrar el registro?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar!'
	}).then(function (result) {
		/* ***************** */
		if (result.value) {
			var parametros = {
				"id": id,
				"accion": accion
			};
			$.ajax({
				data: parametros,
				url: "ajax/situacion.ajax.php",
				type: 'post',
				success: function (response) {

					window.location = "situacion";

				}
			});
			/* ********* */




		}

	})

};





function guardarregistro3(){


	var hoy = new Date();
	var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
	function formatTime(timeString) {
		const [hourString, minute] = timeString.split(":");
		const hour = +hourString % 24;
		return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
	}


	var id = $("#id").val();
	var id_vacante_historialvacante = $("#vacante_situacion").val();
	var fecha_historialvacante = $("#fecha_situacion").val();
	var hora_historialvacante = formatTime(hora);
	var accion_historialvacante = "Traslado";/* --estamos aqui */

	var id_empleado_historialvacante = 	$("#idempleado").val();
	var codigo_empleado_historialvacante = $("#codigo_empleado").val();
	var nombre_empleado_historialvacante = $("#nombre_empleado").val();

	var id_ubicacion_historialvacante = $("#idubicacion").val();
	var codigo_ubicacion_historialvacante = $("#codigo_ubicacion").val();
	var nombre_ubicacion_historialvacante = $("#nombre_ubicacion").val();
	var comentario_historialvacante="";

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
					location.reload();
					
				}
			});
		}

	   }
   });
	/* ********** */
}
