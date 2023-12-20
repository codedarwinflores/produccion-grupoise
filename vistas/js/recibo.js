/* COLOCACION DE ICONOS */
$(document).ready(function(){


	/* ********************************** */
		// Obtén la URL actual
		var url = window.location.href;
		// Utiliza el objeto URL para analizar la URL y obtener los parámetros
		var urlObj = new URL(url);
		// Obtén el valor de la variable "variable1" desde la URL
		var variable1 = urlObj.searchParams.get("id");
		var modulo = urlObj.searchParams.get("modulo");
		// Haz algo con las variables capturadas
		if (variable1 !== null) {
			console.log("Valor de variable1: " + variable1);
			$("#modalAgregarrecibo").modal('show');
			$(".input_empleado_recibo").val(variable1).trigger('change.select2');
			$(".input_descuento_recibo").val(17).trigger('change.select2');
			$(".divoculto").removeAttr("style");
			$(".precio_detalle").removeAttr("readonly");
			$(".precio_detalle").val("0");
			if(modulo=="regalo"){
				$(".titulo_modulo").text("UNIFORME REGALADO");
				$(".precio_detalle").attr("readonly","readonly");

				
			}
			else{
				$(".titulo_modulo").text("UNIFORME DESCUENTO");
			}
			$(".empleados_modulo").val(variable1);

			
		}
		
	/* ********************************* */
	/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=correlativoplanilla';
			$.ajax({
				data: dataString,
				url: "ajax/correlativo_recibo.ajax.php",
				type: 'post',
				success: function (response) {
					$("#nuevonumero_recibo").val(response);
				}
			});
			/* *********** */

	/* hora actual */

	var hoy = new Date();
	var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
	function formatTime(timeString) {
		const [hourString, minute] = timeString.split(":");
		const hour = +hourString % 24;
		return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
	}
	/* ************ */
	$("#nuevohora_hecho_recibo").val(formatTime(hora));

	/* fecha actual */
	var formatDate = function(date) {
		var mes=date.getMonth()+1;
		var dia= date.getDate();
		return ('0' + dia).slice(-2)  + "-" + ('0' + mes).slice(-2)  + "-" + date.getFullYear();
	  }
	/* **************** */
	$("#nuevofecha_hecho_recibo").val(formatDate(hoy));	  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarrecibo", function(){

	
	var idrecibo = $(this).attr("idrecibo");
	
	var datos = new FormData();
	datos.append("idrecibo", idrecibo);

	$.ajax({

		url:"ajax/recibo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#nuevonumero_recibo").removeClass("input_numero_recibo");
			$("#añadirequipo").removeClass("añadirequipo");

			if(respuesta["anular_recibo"]=="Si"){
				swal({
					title: 'No se puedo modificar porque esta Anulado',
					text: "",
					type: 'warning',
					showCancelButton: true
				  }).then(function(result){ 
					location.reload();
				  })
			}
			if(respuesta["liquidado_recibo"]=="Si"){
				swal({
					title: 'No se puedo modificar porque esta Liquidado',
					text: "",
					type: 'warning',
					showCancelButton: true
				  }).then(function(result){ 
					location.reload();
				  })
			}
			$("#editarid").val(respuesta["idrecibo"]);
			$("#editarfecha_descuento_recibo").val(respuesta["fecha_descuento_recibo"]);
			
			$("#editarempleado_recibo").val(respuesta["empleado_recibo"]).trigger('change.select2');
			$("#editardescuento_recibo").val(respuesta["descuento_recibo"]).trigger('change.select2');

			$("#editarnumero_recibo").val(respuesta["numero_recibo"]);
			$("#editarvalor_recibo").val(respuesta["valor_recibo"]);
			$("#editarobservacion_recibo").val(respuesta["observacion_recibo"]);
			$("#editarfecha_hecho_recibo").val(respuesta["fecha_hecho_recibo"]);
			$("#editarhora_hecho_recibo").val(respuesta["hora_hecho_recibo"]);
			$("#editarnumero_planilla_liquidado").val(respuesta["numero_planilla_liquidado"]);
			$("#editarliquidado_recibo").val(respuesta["liquidado_recibo"]);
			$("#editaranular_recibo").val(respuesta["anular_recibo"]);
			$("#editaruser_recibo").val(respuesta["user_recibo"]);

			if(respuesta["descuento_recibo"]=="17"){
				$(".input_valor_recibo").attr("readonly","readonly");
				$(".divoculto").attr("style","display: block;");
				var numero_planilla_liquidado =respuesta["numero_recibo"];

				/* *********** */
				var dataString = 'accion01=cargardetalle'+
								 '&numero_planilla_liquidado=' +numero_planilla_liquidado;
				$.ajax({
					data: dataString,
					url: "ajax/correlativo_recibo.ajax.php",
					type: 'post',
					success: function (response) {
						
						$(".añadirequipo").empty();
						$(".añadirequipo").append(response);

						/*=============================================
							ELIMINAR 
							=============================================*/
							$(".productos").on("click", ".eliminardetalle", function(){
								var id=$(this).attr("id");
								var idkardex=$(this).attr("idkardex");
								elimindardetalle(id,idkardex);
							});

					}
				});
				/* *********** */

			}
			else{
				$(".input_valor_recibo").removeAttr("readonly");
				$(".divoculto").attr("style","display: none;");
			}





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
	    url:"ajax/recibo.ajax.php",
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
$(".tablas").on("click", ".btnEliminarrecibo", function(){

  var idrecibo = $(this).attr("idrecibo");
  var liquidado = $(this).attr("liquidado");
  var numero_recibo = $(this).attr("numero_recibo");
  var Codigo = "";

  if(liquidado=="Si"){
	swal({
		title: 'No se puedo eliminar porque esta Liquidado',
		text: "",
		type: 'warning',
		showCancelButton: true
	  }).then(function(result){ 
		location.reload();
	  })
}
else{
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

				anulardetallekardex(numero_recibo);

			window.location = "index.php?ruta=recibo&idrecibo="+idrecibo+"&Codigo="+Codigo;



			}

		})
	}
})


$(".input_descuento_recibo").change(function(){
	var codigo = $('option:selected', this).attr('codigo');
	if(codigo=="0017"){
		$(".input_valor_recibo").attr("readonly","readonly");
		$(".divoculto").attr("style","display: block;");
	}
	else{
		$(".input_valor_recibo").removeAttr("readonly");
		$(".divoculto").attr("style","display: none;");
	}
});

$(".kardex_detalle").change(function(){
	var precio = $('option:selected', this).attr('precio');
	var cantidad = $('option:selected', this).attr('cantidad');



	$(".precio_detalle").val(precio);
	$(".comparar").val(cantidad);

	
	/* si es regalo */
	var url = window.location.href;
	var urlObj = new URL(url);
	var variable1 = urlObj.searchParams.get("id");
	var modulo = urlObj.searchParams.get("modulo");
	if (variable1 !== null) {
		if(modulo=="regalo"){
			$(".precio_detalle").val("0");
		}
	}
	/* *********** */
});

$(".cantidad_detalle").blur(function() {
	var valor = $(this).val();
	var cantidadmaxima=$(".comparar").val();

	if(parseFloat(valor) >= parseFloat(cantidadmaxima)){
		$(".advertencia").text("La cantidad que digito es superior se a modificado de acuerdo al Kardex");
		$(".cantidad_detalle").val(cantidadmaxima);
		valor=cantidadmaxima;
	}
	else{
		$(".advertencia").text("");
	}

	var precio_equipo=$(".precio_detalle").val();
	var total=parseFloat(valor)*parseFloat(precio_equipo);
	
	$(".total_detalle").val(total.toFixed(2));
})



$('.añadirtable').on('click',function(){
	var numero_recibo_detalle= $(".input_numero_recibo").val();
	var kardex_detalle= $(".kardex_detalle").val();
	if(kardex_detalle==""){
		var kardex_detalle= $(".kardex_detalle2").val();
		}
	var cantidad_detalle= $(".cantidad_detalle").val();
	if(cantidad_detalle=="0"){
	var cantidad_detalle= $(".cantidad_detalle2").val();
	}
	
	var precio_detalle= $(".precio_detalle").val();
	var total_detalle= $(".total_detalle").val();

	/* datos para modificar el kardex */

	var fecha_kardexh=$(".input_fecha_hecho_recibo").val();
	var transancion_kardexh=$(".input_descuento_recibo").val();
	var empleado_kardexh= $('option:selected', ".input_empleado_recibo").attr('codigo_empleado');

	/* *********** */
	var dataString = 'accion01=insertdetalle'+
					'&numero_recibo_detalle=' +numero_recibo_detalle+
					'&kardex_detalle=' +kardex_detalle+
					'&cantidad_detalle=' +cantidad_detalle+
					'&precio_detalle=' +precio_detalle+
					'&total_detalle=' +total_detalle+
					'&fecha_kardexh=' +fecha_kardexh+
					'&transancion_kardexh=' +transancion_kardexh+
					'&empleado_kardexh=' +empleado_kardexh;
					$.ajax({
						data: dataString,
						url: "ajax/correlativo_recibo.ajax.php",
						type: 'post',
						success: function (response) {
							
							console.log(response);
							$(".añadirequipo").empty();
							$(".añadirequipo").append(response);
							/*=============================================
							ELIMINAR 
							=============================================*/
							$(".productos").on("click", ".eliminardetalle", function(){
								var id=$(this).attr("id");
								var idkardex=$(this).attr("idkardex");
								elimindardetalle(id,idkardex);
							});
							
								sumardetalle();
							

					}
				});
				/* *********** */
});

$('.guardar_datos').on('click',function(){

	var  valor_des=$("#nuevodescuento_recibo").val();

	var verificar_datos=$(".validar_datos").val();
	if(valor_des=="17")
	{
			/* ********** */
			 // Selecciona la tabla por su ID
				var $miTabla = $('.productos');
				var tablaVacia = true;

				$miTabla.find('tbody td').each(function() {
				  if ($(this).text().trim() !== '') {
					tablaVacia = false;
					return false; // Detener el bucle each si se encuentra texto en alguna celda
				  }
				});
			  
				if (tablaVacia) {
				  console.log('La tabla está vacía o no contiene texto.');
				  verificar_datos=$(".validar_datos").val();

					swal({
						title: 'Añadir Uniforme',
						text: "Usted a seleccionado Descuento Uniforme pero no a añadido uniforme a la tabla. Por Favor seleccione uniforme y dar click al boton de añadir.",
						type: 'warning',
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						cancelButtonText: 'Aceptar'
					})

				} else {
				  console.log('La tabla tiene datos o texto en alguna celda.');
				  verificar_datos=$(".validar_datos").val("datos");

				  	/* si es regalo */
					var url = window.location.href;
					var urlObj = new URL(url);
					var variable1 = urlObj.searchParams.get("id");
					if (variable1 !== null) {
						window.location.href = 'empleados';
					}
					/* *********** */
				}
			/* ********* */
	}
})

$('.guardarmodificacion_recibo').on('click',function(){


	var  valor_des=$("#editardescuento_recibo").val();

	var verificar_datos=$(".validar_datos").val();
	if(valor_des=="17")
	{
			/* ********** */
			 // Selecciona la tabla por su ID
				var $miTabla = $('.productos');
				var tablaVacia = true;

				$miTabla.find('tbody td').each(function() {
				  if ($(this).text().trim() !== '') {
					tablaVacia = false;
					return false; // Detener el bucle each si se encuentra texto en alguna celda
				  }
				});
			  
				if (tablaVacia) {
				  console.log('La tabla está vacía o no contiene texto.');
				  verificar_datos=$(".validar_datos").val();

					swal({
						title: 'Añadir Uniforme',
						text: "Usted a seleccionado Descuento Uniforme pero no a añadido uniforme a la tabla. Por Favor seleccione uniforme y dar click al boton de añadir.",
						type: 'warning',
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						cancelButtonText: 'Aceptar'
					})

				} else {
				  console.log('La tabla tiene datos o texto en alguna celda.');
				  verificar_datos=$(".validar_datos").val("datos");

				}
			/* ********* */
	}

	if(verificar_datos!="")
	{
		var valorSeleccionado=$("#editaranular_recibo").val();
		if(valorSeleccionado=="Si"){
			var numero_recibo=$("#editarnumero_recibo").val();
			anulardetallekardex(numero_recibo);
		}
	}
})

function elimindardetalle(id1, idkardex1){

	var fecha_kardexh=$(".input_fecha_hecho_recibo").val();
	var numero_recibo=$(".input_numero_recibo").val();
	var transancion_kardexh=$(".input_descuento_recibo").val();
	var empleado_kardexh=$('option:selected', ".input_empleado_recibo").attr('codigo_empleado');

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
						/* *********** */
						var dataString = 'accion01=eliminardetalle'+
										 '&id=' +id1+
										 '&fecha_kardexh=' +fecha_kardexh+
										 '&transancion_kardexh=' +transancion_kardexh+
										 '&idkardex=' +idkardex1+
										 '&numero_recibo=' +numero_recibo+
										 '&empleado_kardexh=' +empleado_kardexh;
						$.ajax({
							data: dataString,
							url: "ajax/correlativo_recibo.ajax.php",
							type: 'post',
							success: function (response) {
								$(".añadirequipo").empty();
								$(".añadirequipo").append(response);

								sumardetalle();
							}
						});
						/* *********** */
			  }
		  })
	  
}


function sumardetalle(){

	var suma_cantidad=0;
		$('.añadirequipo').find('td:nth-child(5)').each(function(){
			suma_cantidad+=+($(this).text());
		});
		$(".input_valor_recibo").val(suma_cantidad);
}

function anulardetallekardex(numero_recibo){
				/* *********** */
						var dataString = 'accion01=anularrecibo'+
										 '&numero_recibo=' +numero_recibo;
						$.ajax({
							data: dataString,
							url: "ajax/correlativo_recibo.ajax.php",
							type: 'post',
							success: function (response) {
								
								
							}
						});
						/* *********** */
}


$('#modalEditarrecibo').on('hidden.bs.modal', function() {

	$("#nuevonumero_recibo").addClass("input_numero_recibo");
	$("#añadirequipo").addClass("añadirequipo");


	/* 	setTimeout(function(){
			actualizar_datos();
		}, 1500);
	
		setTimeout(function(){
			$('.modal_carga').modal('toggle');	
		}, 2000); */
	})
	
	$('#modalAgregarrecibo').on('show.bs.modal', function() {
		$("#añadirequipo2").removeClass("añadirequipo");
	})
	$('#modalAgregarrecibo').on('hidden.bs.modal', function() {
		$("#añadirequipo2").addClass("añadirequipo");
	})