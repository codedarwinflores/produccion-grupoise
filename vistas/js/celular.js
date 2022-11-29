/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupocelular_operador").empty();
	$('.grupocelular_operador').append($('#nuevooperador'));

	$(".egrupocelular_operador").empty();
	$('.egrupocelular_operador').append($('#editaroperadordiv'));


	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");


	
	$(".icono_celular").addClass("fa fa-newspaper-o");
	$(".input_celular").attr("placeholder", texto+" Celular");


	$(".icono_costo").addClass("fa fa-money");
	$(".input_costo").attr("placeholder", texto+" Costo");
	

	$(".input_costo").get(0).type = 'number';
	$(".input_costo").attr("step", "0.01");
	$("#editarcosto").get(0).type = 'number';
	$("#editarcosto").attr("step", "0.01");

	$(".icono_numero").addClass("fa fa-phone");
	$(".input_numero").attr("placeholder", texto+" Numero");
	$(".input_numero").addClass("telefono");


	$(".grupocelular_tipocelular").empty();
	$(".grupocelular_tipocelular").append($("#stipocelular"));



	$(".grupocelular_sim").empty();
	$(".grupocelular_sim").append($("#seleccionar_sim"));
	$(".grupocelular_sim").append($(".operador_celular"));
	$(".operador_celular").append($(".imei_celular"));



	$(".egrupocelular_tipocelular").empty();
	$(".egrupocelular_tipocelular").append($("#estipocelular"));

	$(".egrupocelular_sim").empty();
	$(".egrupocelular_sim").append($("#editar_sim_celular"));
	$(".egrupocelular_sim").append($(".editar_operador"));
	$(".editar_operador").append($(".editar_imei"));



	
              /* *********LABEL*********** */
			  var input_descripcion = $(".input_descripcion").attr("placeholder");
			  $(".label_descripcion").text(input_descripcion);

		  
              /* *********LABEL*********** */
			  var input_costo = $(".input_costo").attr("placeholder");
			  $(".label_costo").text(input_costo);

			  
              /* *********LABEL*********** */
			  var input_numero = $(".input_numero").attr("placeholder");
			  $(".label_numero").text(input_numero);

		  
			  $(document).on('change', '#nuevoscelular_sim', function(event) {

				var operador=$("#nuevoscelular_sim option:selected").attr("operador");
				var imei=$("#nuevoscelular_sim option:selected").attr("imei");
				$('#noperador').val(operador);
				$('#nimei').val(imei);
		   });

		   
		   $(document).on('change', '#editarsim', function(event) {

			var operador=$("#editarsim option:selected").attr("operador");
			var imei=$("#editarsim option:selected").attr("imei");
			$('#eoperador').val(operador);
			$('#eimei').val(imei);
	   });
		  

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarcelular", function(){

	
	var idcelular = $(this).attr("idcelular");
	
	var datos = new FormData();
	datos.append("idcelular", idcelular);

	$.ajax({

		url:"ajax/celular.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idcelular"]);
			$("#editarcodigo").val(respuesta["codigocelular"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarcosto").val(respuesta["costo"]);
			$("#editarnumero").val(respuesta["numero"]);
			$("#editarsim").val(respuesta["idsim"]);
			$("#eimei").val(respuesta["IMEI"]);
			$("#eoperador").val(respuesta["operador"]);
			$("#editarmarca").val(respuesta["marca"]);
			$("#editarmodelo").val(respuesta["modelo"]);
			$("#editarcolor").val(respuesta["color"]);
			$("#editartipocelular").val(respuesta["idtipocelular"]);



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
	    url:"ajax/celular.ajax.php",
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
$(".tablas").on("click", ".btnEliminarcelular", function(){

  var idcelular = $(this).attr("idcelular");
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

      window.location = "index.php?ruta=celular&idcelular="+idcelular+"&Codigo="+Codigo;

    }

  })

})




