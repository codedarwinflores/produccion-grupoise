/* COLOCACION DE ICONOS */
$(document).ready(function(){


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
								elimindardetalle(id);
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

});

$(".cantidad_detalle").blur(function() {
	var valor = $(this).val();
	var cantidadmaxima=$(".comparar").val();

	if(parseFloat(valor) >= parseFloat(cantidadmaxima)){
		$(".advertencia").text("La cantidad supera a la del Kardex");
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



function elimindardetalle(id1, idkardex1){

	var fecha_kardexh=$(".input_fecha_hecho_recibo").val();
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