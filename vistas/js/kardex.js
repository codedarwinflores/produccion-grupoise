/* COLOCACION DE ICONOS */
$(document).ready(function(){
	

	/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=correlativoplanilla';
			$.ajax({
				data: dataString,
				url: "ajax/kardex.ajax.php",
				type: 'post',
				success: function (response) {
					console.log(response);
					$("#correlativo_kardex").val(response);
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

	/* fecha actual */
	var formatDate = function(date) {
		var mes=date.getMonth()+1;
		var dia= date.getDate();
		return ('0' + dia).slice(-2)  + "-" + ('0' + mes).slice(-2)  + "-" + date.getFullYear();
	  }
	/* **************** */



		  
 })

 
/*  $("#equipo_kardex").change(function(){
	var valor = $('option:selected', this).attr('costos');
	$("#precio_kardex").val(valor);
}); */

/* VALIDAR CANTIDAD EN UBICACION */
$(".kardex_armas").change(function(){
	var valor = $(this).val();
	var cantidad_armas = $('option:selected', this).attr('cantidad_armas');
	var tabla = $('option:selected', this).attr('tabla');
	$("#cantidad_maximo").val(cantidad_armas);
	$("#idubicacion_select").val(valor);
	var columna="";
	if(tabla=="tbl_radios"){
		columna="codigo_radio";
	}
	else{
		columna="codigo";

	}
	/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=validararmasubicacion'+
							 '&idubicacion=' +$.trim(valor)+
							 '&columna=' +$.trim(columna)+
							 '&tabla=' +$.trim(tabla);
							 
			$.ajax({
				data: dataString,
				url: "ajax/kardex.ajax.php",
				type: 'post',
				success: function (response) {
					console.log(response);
					
					$("#cantidad_actual").val(response);

					if(response>=cantidad_armas){							
							swal({
								title: 'Alerta',
								text: "Ubicación esta al limite. Por favor cambiar ubicacion",
								type: 'warning'
							})
							$(".guardardata").attr("disabled","disabled");
							$("#equipo_kardex").attr("disabled","disabled");
					}
					else{
							$("#equipo_kardex").removeAttr("disabled");
							$(".guardardata").removeAttr("disabled","disabled");

					}
				}
			});

			/* *********** */

	
});


/* VALIDAR SI ARMA O RADIO YA ESTA EN UBICACION */
$("#equipo_kardex").change(function(){


	var tipo_equipo=$("#equipo_kardex").attr("equipo");

	var valorcostos = $('option:selected', this).attr('costos');
	$("#precio_kardex").val(valorcostos);

	var valor = $(this).val();
	var idubicacion_select = $("#idubicacion_select").val();
	$("#cantidad_kardex").val("1");

	var suma_inicial= valorcostos*1;
	$("#subtotal_kardex").val(suma_inicial);

	var texto_codigos=$("#global_code").val();

	/* --------------validar si el codigo ya esta en la tabla */

	var index = texto_codigos.indexOf(valor);

		if(index >= 0) {
			swal({
				title: 'Alerta',
				text: "Error no se aceptan duplicados",
				type: 'warning'
			})
			$("#equipo_kardex").val("").trigger('change.select2');
		} else {

		}
	/* -------------------------- */
	

	/* --------------VALIDAR SI NO EXEDE EL LIMITE DE CANTIDAD------------------- */
	var cantidad_actual=$("#cantidad_actual").val();
	var cantidad_total=$("#cantidad_total").val();
	var cantidad_maximo=$("#cantidad_maximo").val();
	var cantidad_global=parseFloat(cantidad_actual)+parseFloat(cantidad_total)+1;

	if(tipo_equipo!="equipo"){

		if(cantidad_global>cantidad_maximo){
			swal({
				title: 'Alerta',
				text: "Ubicación esta al limite",
				type: 'warning'
			})
			$(".guardarproducto").attr("style","display:none");
		}
		else{
			$(".guardarproducto").removeAttr("style");
		}
	}
	/* ----------VALIDAR SI UBICACION ESTA VACIA----------------------- */

	if(idubicacion_select==""){
		$(".guardardata").attr("style","display:none");
		swal({
			title: 'Alerta',
			text: "Porfavor seleccione ubicación",
			type: 'warning'
		})
	}
	else{
		$(".guardardata").removeAttr("style");

	}

	/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=equipoubicacion'+
							 '&idubicacion_select=' +$.trim(idubicacion_select)+
							 '&equipo=' +$.trim(valor);
							 
			$.ajax({
				data: dataString,
				url: "ajax/kardex.ajax.php",
				type: 'post',
				success: function (response) {	

					var palabraBuscada = $("#nombremodulo").val();
				
					if (palabraBuscada=="kardex") {
						/* alert(palabraBuscada); */
					} else {

							if(response>"0"){	
									swal({
										title: 'Alerta',
										text: "Ya se encuentra en esta ubicación",
										type: 'warning'
									})
									$(".guardardata").attr("disabled","disabled");
							}
							else{
								$(".guardardata").removeAttr("disabled","disabled");

							}					
					}

				}
			});

			/* *********** */
});

 
 $("#tipo_kardex").change(function(){
	var valor = $(this).val();
	if(valor=="armas"){
		window.location.href = 'kardexarmas';
	}
	if(valor=="equipos"){
		window.location.href = 'kardex';

	}
	if(valor=="radios"){
		window.location.href = 'kardexradios';
	}
});
/* transaccion kardex */
$("#tipo_kardex_t").change(function(){
	var valor = $(this).val();
	if(valor=="armas"){
		window.location.href = 'transancionkardexarmas';
	}
	if(valor=="equipos"){
		window.location.href = 'transancionkardex';

	}
	if(valor=="radios"){
		window.location.href = 'transancionkardexradios';
	}
});

 $('.guardarproducto').on('click',function(){


    var codigo_equipo=$("#equipo_kardex").val();
    var nombre_equipo=$('option:selected', "#equipo_kardex").attr('descripcion');
    var cantidad_equipo=$("#cantidad_kardex").val();
    var precio_equipo=$("#precio_kardex").val();
    var total_equipo=$("#subtotal_kardex").val();
	var global_code=$("#global_code").val();
	$("#global_code").val(global_code+'-'+codigo_equipo);

	var table="";
	 table="<tr>"+
				"<td>"+codigo_equipo+"</td>"+
				"<td>"+nombre_equipo+"</td>"+
				"<td>"+cantidad_equipo+"</td>"+
				"<td>"+precio_equipo+"</td>"+
				"<td>"+total_equipo+"</td>"+
				"<td>"+"<div class='btn btn-danger quitarlista'><i class='fa fa-times'></i></div>"+"</td>"+
				"</tr>";
	
	$("#añadirequipo").append(table);

	/* ****** */

	$(".productos").on("click", ".quitarlista", function(){
		$(this).closest('tr').remove();
		sumarproductos();
	})
	/* ******* */
	sumarproductos();

	$("#equipo_kardex").val("");
	$("#equipo_kardex").val("").trigger('change.select2');;
    $("#cantidad_kardex").val("");
    $("#precio_kardex").val("");
    $("#subtotal_kardex").val("");
});


function sumarproductos(){

	var suma_subtotal=0;
	var suma_cantidad=0;
	$('#añadirequipo').find('td:nth-child(5)').each(function(){
		suma_subtotal+=+($(this).text());
	});
	$("#total_kardex").val(suma_subtotal);

	$('#añadirequipo').find('td:nth-child(3)').each(function(){
		suma_cantidad+=+($(this).text());
	});
	$("#cantidad_total").val(suma_cantidad);
}

$("#cantidad_kardex").blur(function() {
	var valor = $(this).val();
	var precio_equipo=$("#precio_kardex").val();
	var total=parseFloat(valor)*parseFloat(precio_equipo);
	$("#subtotal_kardex").val(total.toFixed(2));
})

$("#precio_kardex").blur(function() {
	var valor = $(this).val();
	var precio_equipo=$("#cantidad_kardex").val();
	var total=parseFloat(valor)*parseFloat(precio_equipo);
	$("#subtotal_kardex").val(total.toFixed(2));
})

$("#transancion_kardex").change(function(){
	var tipo_transaccion_equipo = $('option:selected', this).attr('tipo_transaccion_equipo');
	$("#tipo_transaccion_equipo").val(tipo_transaccion_equipo);
});


$('.guardardata').on('click',function(){
	agregarkardex();

})


function agregarkardex(){

	$('#añadirequipo tr').each(function () {
		var id=$("#id").val();
		var correlativo_kardex=$("#correlativo_kardex").val();
		var fecha_kardex=$("#fecha_kardex").val();
		var transancion_kardex=$("#transancion_kardex").val();
		var empleado_kardex=$("#empleado_kardex").val();
		var ubicacion_kardex=$("#ubicacion_kardex").val();
		
		var equipo_kardex= $(this).find('td').eq(0).html();
		var cantidad_kardex	 = $(this).find('td').eq(2).html();
		var precio_kardex = $(this).find('td').eq(3).html();
		var subtotal_kardex = $(this).find('td').eq(4).html();
		var total_kardex=$("#total_kardex").val();
		var tipo_transaccion_equipo=$("#tipo_transaccion_equipo").val();
		var dataString = 'id=' +$.trim(id) +
						 '&correlativo_kardex=' +$.trim(correlativo_kardex) +
						 '&fecha_kardex=' +$.trim(fecha_kardex) +
						 '&transancion_kardex=' +$.trim(transancion_kardex) +
						 '&empleado_kardex=' +$.trim(empleado_kardex) +
						 '&ubicacion_kardex=' +$.trim(ubicacion_kardex) +
						 '&equipo_kardex=' +$.trim(equipo_kardex) +
						 '&cantidad_kardex=' +$.trim(cantidad_kardex) +
						 '&precio_kardex=' +$.trim(precio_kardex) +
						 '&subtotal_kardex=' +$.trim(subtotal_kardex) +
						 '&total_kardex=' +$.trim(total_kardex)+
						 '&tipo_transaccion_equipo=' +$.trim(tipo_transaccion_equipo);

		$.ajax({
			data: dataString,
			url: "ajax/kardex.ajax.php",
		 	type: "POST",
			success: function (response) {
				console.log(response);
			
				/* *************** */
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
				/* **************** */

			}
		});
	});

}


/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarkardex", function(){

  var idkardex = $(this).attr("idkardex");


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

				
			/* CORRELATIVO PLANILLA */
			/* *********** */
			var dataString = 'accion01=eliminar'+
							 '&idkardex=' +$.trim(idkardex);
			$.ajax({
				data: dataString,
				url: "ajax/kardex.ajax.php",
				type: 'post',
				success: function (response) {
					location.reload();
				}
			});

			/* *********** */
			
			}

		})
	
});


/*=============================================
ELIMINAR transaccion
=============================================*/
$(".tablas").on("click", ".eliminartranskardex", function(){

	var idkardex = $(this).attr("idkardex");
  
  
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
  
				  
			  /* CORRELATIVO PLANILLA */
			  /* *********** */
			  var dataString = 'accion01=eliminartransanccion'+
							   '&idkardex=' +$.trim(idkardex);
			  $.ajax({
				  data: dataString,
				  url: "ajax/kardex.ajax.php",
				  type: 'post',
				  success: function (response) {
					  location.reload();
				  }
			  });
  
			  /* *********** */
			  
			  }
  
		  })
	  
  });


  
/*=============================================
MODIFICAR PRODUCTO 
=============================================*/
$(".tablas").on("click", ".modificarproducto", function(){

	$(this).html("<span>Guardar</span>");
	$(this).removeClass("btn-warning");
	$(this).addClass("btn-primary");
	$(this).addClass("guardarmodificacion");

	var clase = $(this).attr("producto");/* --codigo producto */
	var idregistro = $(this).attr("idregistro");
	var cantidad = $(this).attr("cantidad");
	var precio = $(this).attr("precio");
	var total = $(this).attr("total");
	var correlativo_numero = $("#correlativo_numero").val();

	var cantidadtext=$("."+clase+"cantidad"+idregistro).val();
	var preciotext=$("."+clase+"precio"+idregistro).val();
	var totaltext=$("."+clase+"total"+idregistro).val();
	var totalglobal=$(".totalglobal").val();



	var valirdarguardar=$(this).attr("guardar");
	if(valirdarguardar=="si"){
		/* ***************** */
			  var dataString = 'accion01=modificarproducto'+
							   '&codigoproducto=' +$.trim(clase)+
							   '&idregistro=' +$.trim(idregistro)+
							   '&cantidadtext=' +$.trim(cantidadtext)+
							   '&preciotext=' +$.trim(preciotext)+
							   '&totalglobal=' +$.trim(totalglobal)+
							   '&correlativo_numero=' +$.trim(correlativo_numero)+
							   '&totaltext=' +$.trim(totaltext);
			
			  $.ajax({
				  data: dataString,
				  url: "ajax/kardex.ajax.php",
				  type: 'post',
				  success: function (response) {
					location.reload();
				  }
			  });
  
	 	/* *********** */
	}else{
		/* ***input cantidad */
		$("."+clase+"cantidad"+idregistro).attr("type","text");
		$("."+clase+"cantidad"+idregistro).val(cantidad);
		/* ***input precio */
		$("."+clase+"precio"+idregistro).attr("type","text");
		$("."+clase+"precio"+idregistro).val(precio);
		/* ***input total */
		$("."+clase+"total"+idregistro).val(total);
		/* clase de table */
		$("."+clase+"tabla"+idregistro).text("");
	}
	clasecantidad=clase+"cantidad"+idregistro;
	claseprecio=clase+"precio"+idregistro;
	clasetotal=clase+"total"+idregistro;
	clasecolumna=clase+"columna"+idregistro;

	cambiocantidad(clasecantidad,claseprecio,clasetotal,clasecolumna);


	$(this).attr("guardar","si");
  
			  
			  
  
		  
	  
  });

function cambiocantidad(cantidad, precio, total, columna){
	$("."+cantidad).blur(function() {
		var valorcantidad = $(this).val();
		var valorprecio=$("."+precio).val();
		var calculo=parseFloat(valorcantidad)*parseFloat(valorprecio);
		$("."+total).val(calculo);
		$("."+columna).text(calculo);
	

		var suma_cantidad=0;
		$('.añadirequipo').find('td:nth-child(9)').each(function(){
			suma_cantidad+=+($(this).text());
		});
	
		$(".totalglobal").val(suma_cantidad);

	});

	$("."+precio).blur(function() {
		var valorprecio = $(this).val();
		var valorcantidad=$("."+cantidad).val();
		var calculo=parseFloat(valorcantidad)*parseFloat(valorprecio);
		$("."+total).val(calculo);
		$("."+columna).text(calculo);

		var suma_cantidad=0;
		$('.añadirequipo').find('td:nth-child(9)').each(function(){
			
			suma_cantidad+=+($(this).text());
		});
		$(".totalglobal").val(suma_cantidad);


	});
};

/*=============================================
MODIFICAR PRODUCTO 
=============================================*/
$(".tablas").on("click", ".eliminarproducto", function(){



	var clase = $(this).attr("producto");/* --codigo producto */
	var idregistro = $(this).attr("idregistro");



	
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


		/* ***************** */
			  var dataString = 'accion01=eliminarproducto'+
							   '&codigoproducto=' +$.trim(clase)+
							   '&idregistro=' +$.trim(idregistro);
			
			  $.ajax({
				  data: dataString,
				  url: "ajax/kardex.ajax.php",
				  type: 'post',
				  success: function (response) {
					console.log(response);
					location.reload();
				  }
			  });
  
	 	/* *********** */
		}

	})

  });
