/* COLOCACION DE ICONOS */
$(document).ready(function(){



	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");


	


	$(".icono_codigo").addClass("fa fa-qr");
	$(".input_codigo").attr("placeholder", texto+" Código");
	

	
	$(".icono_nombre_rango").addClass("fa fa-random");
	$(".input_nombre_rango").attr("placeholder", texto+" Nombre Rango");

	
	$(".icono_periodo_pago").addClass("fa fa-retweet");
	$(".input_periodo_pago").attr("placeholder", texto+" Período de Pago");
	$(".input_periodo_pago").attr("name","");
	/* $(".input_periodo_pago").attr("readonly","readonly"); */

	$(".input_periodo_pago").keydown(function(e){
        e.preventDefault();
    });
	
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
	$(".input_salario_desde").get(0).type = 'number';
	$(".input_salario_desde").attr("step", "0.01");



	
	$(".icono_salario_hasta").addClass("fa fa-sort-amount-desc");
	$(".input_salario_hasta").attr("placeholder", texto+" Salario Hasta");
	$(".input_salario_hasta").get(0).type = 'number';
	$(".input_salario_hasta").attr("step", "0.01");



	
	$(".icono_base_1").addClass("fa fa-database");
	$(".input_base_1").attr("placeholder", texto+" Base 1");
	$(".input_base_1").get(0).type = 'number';
	$(".input_base_1").attr("step", "0.01");



	
	$(".icono_tasa_sobre_excedente").addClass("fa fa-cubes");
	$(".input_tasa_sobre_excedente").attr("placeholder", texto+" Tasa sobre excedente");
	$(".input_tasa_sobre_excedente").get(0).type = 'number';
	$(".input_tasa_sobre_excedente").attr("step", "0.01");



	
	$(".icono_base_2").addClass("fa fa-database");
	$(".input_base_2").attr("placeholder", texto+" Base 2");
	$(".input_base_2").get(0).type = 'number';
	$(".input_base_2").attr("step", "0.01");




	
	
	/* **********LABEL***** */

	
	/* $(".input_codigo").attr("placeholder");
	$(".input_nombre_rango").attr("placeholder");
	$(".input_periodo_pago").attr("placeholder");
	$(".input_salario_desde").attr("placeholder");
	$(".input_salario_hasta").attr("placeholder");
	$(".input_base_1").attr("placeholder");
	$(".input_tasa_sobre_excedente").attr("placeholder");
	$(".input_base_2").attr("placeholder"); */
	var input_codigo = $(".input_codigo").attr("placeholder");
	var input_nombre_rango = $(".input_nombre_rango").attr("placeholder");
	var input_periodo_pago=$(".input_periodo_pago").attr("placeholder");
	var input_salario_desde= $(".input_salario_desde").attr("placeholder");
	var input_salario_hasta=$(".input_salario_hasta").attr("placeholder");
	var input_base_1=$(".input_base_1").attr("placeholder");
	var input_tasa_sobre_excedente=$(".input_tasa_sobre_excedente").attr("placeholder");
	var input_base_2 =$(".input_base_2").attr("placeholder");

	$(".label_codigo").text(input_codigo);
	$(".label_nombre_rango").text(input_nombre_rango);
	$(".label_periodo_pago").text(input_periodo_pago);
	$(".label_salario_desde").text(input_salario_desde);
	$(".label_salario_hasta").text(input_salario_hasta);
	$(".label_base_1").text(input_base_1);
	$(".label_tasa_sobre_excedente").text(input_tasa_sobre_excedente);
	$(".label_base_2").text(input_base_2);




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

			$("#editarsalario_desde").get(0).type = 'number';
			$("#editarsalario_hasta").get(0).type = 'number';
			$("#editarbase_1").get(0).type = 'number';
			$("#editartasa_sobre_excedente").get(0).type = 'number';
			$("#editarbase_2").get(0).type = 'number';
			


			
			$("#editarsalario_desde").attr("step", "0.01");
			$("#editarsalario_hasta").attr("step", "0.01");
			$("#editarbase_1").attr("step", "0.01");
			$("#editartasa_sobre_excedente").attr("step", "0.01");
			$("#editarbase_2").attr("step", "0.01");
			





		}

	});

})


/*=============================================
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/




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




