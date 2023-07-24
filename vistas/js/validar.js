

$(document).ready(function(){

	$('.telefono').mask('0000-0000', {reverse: true});
	$('.nits').mask('0000-000000-000-0', {reverse: true});
	$('.nrcs').mask('0000000', {reverse: true});
	$('.duis').mask('00000000-0', {reverse: true});
	$('.horas').mask('0.0000', {reverse: true});
	$('.nrcs').mask('00000-0', {reverse: true});
	$('.tiempo').mask('00:00', {reverse: true});

	






})



/*=============================================
REVISAR SI EL EMPRESAS YA ESTÁ REGISTRADO
=============================================*/

$(".codigo_validar").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".codigo_validar").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".codigo_validar").val("");

			}

	    }

	})
})


$(".input_codigo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
/* 				alert(respuesta);
 */
	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".input_codigo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".input_codigo").val("");

			}

	    }

	})
})



$(".tipoarma_input_codigo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".tipoarma_input_codigo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".tipoarma_input_codigo").val("");

			}

	    }

	})
})



$(".tipovehiculo_input_codigo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".tipovehiculo_input_codigo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".tipovehiculo_input_codigo").val("");

			}

	    }

	})
})



$(".binput_codigo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".binput_codigo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".binput_codigo").val("");

			}

	    }

	})
})


$(".personalinput_codigo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".personalinput_codigo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".personalinput_codigo").val("");

			}

	    }

	})
})


$(".input_codigo_patrulla").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"' ){

	    	}
			else{
				$(".input_codigo_patrulla").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".input_codigo_patrulla").val("");

			}

	    }

	})
})



$(".input_codigo_vehiculo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"'){

	    	}
			else{
				$(".input_codigo_vehiculo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".input_codigo_vehiculo").val("");

			}

	    }

	})
})



$(".input_codigo_bicicleta").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"'){

	    	}
			else{
				$(".input_codigo_bicicleta").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".input_codigo_bicicleta").val("");

			}

	    }

	})
})



$(".input_codigo_radio").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"'){

	    	}
			else{
				$(".input_codigo_radio").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".input_codigo_radio").val("");

			}

	    }

	})
})



$(".input_codigo_equipo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"'){

	    	}
			else{
				$(".input_codigo_equipo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".input_codigo_equipo").val("");

			}

	    }

	})
})



$(".familiainput_codigo").change(function(){

	
	$(".alert").remove();

	var tabla_validar=$(this).attr("tabla_validar");
	var item_validar=$(this).attr("item_validar");
	var valor_validar = $(this).val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"'){

	    	}
			else{
				$(".familiainput_codigo").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');


	    		$(".familiainput_codigo").val("");

			}

	    }

	})
})



$(document).on('change', '#nuevoid_ubicacion_pu', function(event) {

	
	$(".alert").remove();

	var tabla_validar=$("#nuevoid_ubicacion_pu option:selected").attr("tabla_validar");
	var item_validar=$("#nuevoid_ubicacion_pu option:selected").attr("item_validar");
	var valor_validar = $("#nuevoid_ubicacion_pu option:selected").val();
	
	

	
	var datos = "tabla_validar="+tabla_validar+"&item_validar="+item_validar+ "&valor_validar="+valor_validar;

	 $.ajax({
	    url:"ajax/validar.ajax.php",
	    method:"POST",
	    data: datos,
	    success:function(respuesta){
	    	
				/* alert(respuesta); */

	    	if(respuesta=='"0"'){

	    	}
			else{
				$("#nuevoid_ubicacion_pu").parent().after('<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>');
				const $select = document.querySelector('#nuevoid_ubicacion_pu');
				$select.value = '';
			  


			}

	    }

	})
})