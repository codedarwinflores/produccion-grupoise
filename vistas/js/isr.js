/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".icono_codigo").addClass("fa fa-qr");
	$(".input_codigo").attr("placeholder", texto+" Código");

	
	$(".icono_nombre_rango").addClass("fa fa-random");
	$(".input_nombre_rango").attr("placeholder", texto+" Nombre Rango");

	
	$(".icono_periodo_pago").addClass("fa fa-retweet");
	$(".input_periodo_pago").attr("placeholder", texto+" Período de Pago");
	$(".input_periodo_pago").attr("name","");
	$(".input_periodo_pago").attr("readonly","readonly");
	$('.input_periodo_pago').click(function(){
		$(".myDropdown").css("display", "block");
	});
	$('.select_pagos').click(function(){
		var id = $(this).attr("idpago");
		var nombrepago = $(this).attr("nombrepago");
		$(".input_id_periodo_pago").val(id);
		$(".input_periodo_pago").val(nombrepago);
		
		$(".myDropdown").css("display", "none");
		
	});
	

	
	$(".icono_salario_desde").addClass("fa fa-sort-amount-asc");
	$(".input_salario_desde").attr("placeholder", texto+" Salario Desde");

	
	$(".icono_salario_hasta").addClass("fa fa-sort-amount-desc");
	$(".input_salario_hasta").attr("placeholder", texto+" Salario Hasta");

	
	$(".icono_base_1").addClass("fa fa-database");
	$(".input_base_1").attr("placeholder", texto+" Base 1");

	
	$(".icono_tasa_sobre_excedente").addClass("fa fa-cubes");
	$(".input_tasa_sobre_excedente").attr("placeholder", texto+" Tasa sobre excedente");

	
	$(".icono_base_2").addClass("fa fa-database");
	$(".input_base_2").attr("placeholder", texto+" Base 2");


	


/* 	$(".icono_personal_asignado").addClass("fa fa-user");
	$(".input_personal_asignado").attr("placeholder", texto+" Personal Asignado");
	$(".input_personal_asignado").get(0).type = 'number';
 */

 })

 document.addEventListener("mouseup", function(event) {
    var obj = document.getElementById("myDropdown");
    if (!obj.contains(event.target)) {
		$(".myDropdown").css("display", "none");
    }
    else {
       
    }


	var obj2 = document.getElementById("myDropdown2");
    if (!obj2.contains(event.target)) {
		$(".myDropdown").css("display", "none");
    }
    else {
       
    }


});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarisr", function(){

	
	var idisr = $(this).attr("idisr");

	var datos = new FormData();
	datos.append("idisr", idisr);

	$.ajax({

		url:"ajax/isr.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo").val(respuesta["codigo"]);
			$("#editarnombre_rango").val(respuesta["nombre_rango"]);
			$("#editarperiodo_pago").val(respuesta["nombre_periodo"]);
			
			$("#editar_campoperiodo_pago").val(respuesta["idpago"]);
			
			$("#editarsalario_desde").val(respuesta["salario_desde"]);
			$("#editarsalario_hasta").val(respuesta["salario_hasta"]);
			$("#editarbase_1").val(respuesta["base_1"]);
			$("#editartasa_sobre_excedente").val(respuesta["tasa_sobre_excedente"]);
			$("#editarbase_2").val(respuesta["base_2"]);



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
	    url:"ajax/isr.ajax.php",
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
$(".tablas").on("click", ".btnEliminarisr", function(){

  var idisr = $(this).attr("idisr");
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

      window.location = "index.php?ruta=isr&idisr="+idisr+"&Codigo="+Codigo;

    }

  })

})




