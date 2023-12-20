/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");;

	
	$(".icono_descripcion").addClass("fa fa-sticky-note-o");
	$(".input_descripcion").attr("placeholder", texto+" Descripción");

	$(".icono_nivel").addClass("fa fa-tasks");
	$(".input_nivel").attr("placeholder", texto+" Nivel");
	jQuery("#input_nivel").on('input', function (evt) {
		// Allow only numbers.
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});
	jQuery(".input_nivel").on('input', function (evt) {
		// Allow only numbers.
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	});


	$(".jefeoperacioncargo").empty();
	$(".jefeoperacioncargo").append($(".necesitajefe"));

	$(".editarjefeoperacioncargo").empty();
	$(".editarjefeoperacioncargo").append($(".editarnecesitajefe"));




	$(".icono_codigo_contable").addClass("fa fa-money");
	$(".input_codigo_contable").attr("placeholder", texto+" Código Contable");

	$(".icono_personal_asignado").addClass("fa fa-user");
	$(".input_personal_asignado").attr("placeholder", texto+" Personal Asignado");

	$(".input_personal_asignado").keydown(function(e){
        e.preventDefault();
    });

	$('.input_personal_asignado').click(function(){
		$(".myDropdown_personal").css("display", "block");
	});

	$('.select_personal').click(function(){
		var personal = $(this).attr("personal");
		$(".input_personal_asignado").val(personal);
		$(".myDropdown_personal").css("display", "none");
		
	});




	$(".icono_pago_feriados").addClass("fa fa-calendar");
	$(".input_pago_feriados").attr("placeholder", texto+" Pago Feriado");
	
	$(".input_pago_feriados").keydown(function(e){
        e.preventDefault();
    });

	$('.input_pago_feriados').click(function(){
		$(".myDropdown_pagoferiado").css("display", "block");
	});

	$('.select_pagoferiado').click(function(){
		var pagoferiado = $(this).attr("pagoferiado");
		$(".input_pago_feriados").val(pagoferiado);
		$(".myDropdown_pagoferiado").css("display", "none");
		
	});

	
	$(".icono_calculo").addClass("fa fa-pie-chart");
	$(".input_calculo").attr("placeholder", texto+" Cálculo");
	
	
	$(".input_calculo").keydown(function(e){
        e.preventDefault();
    });

	$('.input_calculo').click(function(){
		$(".myDropdown_sueldo").css("display", "block");
	});

	$('.select_sueldo').click(function(){
		var sueldo = $(this).attr("sueldo");
		$(".input_calculo").val(sueldo);
		$(".myDropdown_sueldo").css("display", "none");
		
	});




	
              /* *********LABEL*********** */
			  var input_descripcion = $(".input_descripcion").attr("placeholder");
			  $(".label_descripcion").text(input_descripcion);

	
              /* *********LABEL*********** */
			  var input_nivel = $(".input_nivel").attr("placeholder");
			  $(".label_nivel").text(input_nivel);

		  
              /* *********LABEL*********** */
			  var input_codigo_contable = $(".input_codigo_contable").attr("placeholder");
			  $(".label_codigo_contable").text(input_codigo_contable);

		  
              /* *********LABEL*********** */
			  var input_personal_asignado = $(".input_personal_asignado").attr("placeholder");
			  $(".label_personal_asignado").text(input_personal_asignado);

		  
              /* *********LABEL*********** */
			  var input_pago_feriados = $(".input_pago_feriados").attr("placeholder");
			  $(".label_pago_feriados").text(input_pago_feriados);

		  
              /* *********LABEL*********** */
			  var input_calculo = $(".input_calculo").attr("placeholder");
			  $(".label_calculo").text(input_calculo);

		  
 })

 
 document.addEventListener("mouseup", function(event) {

    var obj = document.getElementById("personal");
    if (!obj.contains(event.target)) {
		$(".myDropdown_personal").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("pagoferiado");
    if (!obj.contains(event.target)) {
		$(".myDropdown_pagoferiado").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("sueldo");
    if (!obj.contains(event.target)) {
		$(".myDropdown_sueldo").css("display", "none");
    }
    else {
       
    }

	/* ***********EDITAR */

	
    var obj = document.getElementById("personal2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_personal").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("pagoferiado2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_pagoferiado").css("display", "none");
    }
    else {
       
    }

	var obj = document.getElementById("sueldo2");
    if (!obj.contains(event.target)) {
		$(".myDropdown_sueldo").css("display", "none");
    }
    else {
       
    }
})

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarCargos", function(){

	
	var idCargos = $(this).attr("idCargos");
	
	var datos = new FormData();
	datos.append("idCargos", idCargos);

	$.ajax({

		url:"ajax/cargos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarnivel").val(respuesta["nivel"]);
			$("#editarcodigo_contable").val(respuesta["codigo_contable"]);
			$("#editarpersonal_asignado").val(respuesta["personal_asignado"]);
			$("#editarpago_feriados").val(respuesta["pago_feriados"]);
			$("#editarcalculo").val(respuesta["calculo"]);
			$("#editarjefeoperacioncargo").val(respuesta["jefeoperacioncargo"]);

			

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
	    url:"ajax/cargos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarCargos", function(){

  var idCargos = $(this).attr("idCargos");
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

      window.location = "index.php?ruta=cargos&idCargos="+idCargos+"&Codigo="+Codigo;

    }

  })

})




