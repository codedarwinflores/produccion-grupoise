/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	
	$(".grupo_id_familia").empty();
	$('.grupo_id_familia').append($('.s_familia_r'));
	$(".grupo_id_tipo_de_radio").empty();
	$('.grupo_id_tipo_de_radio').append($('.r_tipo'));

	/* EDITAR */

	
	$(".grupoeditar_id_familia").empty();
	$('.grupoeditar_id_familia').append($('.r_familia_editar'));
	$(".grupoeditar_id_tipo_de_radio").empty();
	$('.grupoeditar_id_tipo_de_radio').append($('.r_tipo_editar'));
	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");

	/* **** */

	
	$(".icono_codigo_radio").addClass("fa fa-server");
	$(".input_codigo_radio").attr("placeholder", texto+" Código");
	
	$(".icono_descripcion_radio").addClass("fa fa-server");
	$(".input_descripcion_radio").attr("placeholder", texto+" Descripción");
	
	$(".icono_costo_radio").addClass("fa fa-server");
	$(".input_costo_radio").attr("placeholder", texto+" Costo");
	
	$(".input_costo_radio").get(0).type = 'number';
	$(".input_costo_radio").attr("step", "0.01");

	
	$("#editarcosto_radio").get(0).type = 'number';
	$("#editarcosto_radio").attr("step", "0.01");
	
	$(".icono_modelo_radio").addClass("fa fa-server");
	$(".input_modelo_radio").attr("placeholder", texto+" Modelo");
	
	$(".icono_color_radio").addClass("fa fa-server");
	$(".input_color_radio").attr("placeholder", texto+" Color");


              /* *********LABEL*********** */
			  var input_codigo_radio = $(".input_codigo_radio").attr("placeholder");
			  $(".label_codigo_radio").text(input_codigo_radio);

		  
			  
              /* *********LABEL*********** */
			  var input_descripcion_radio = $(".input_descripcion_radio").attr("placeholder");
			  $(".label_descripcion_radio").text(input_descripcion_radio);

		  
              /* *********LABEL*********** */
			  var input_costo_radio = $(".input_costo_radio").attr("placeholder");
			  $(".label_costo_radio").text(input_costo_radio);

		  
              /* *********LABEL*********** */
			  var input_modelo_radio = $(".input_modelo_radio").attr("placeholder");
			  $(".label_modelo_radio").text(input_modelo_radio);

		  
              /* *********LABEL*********** */
			  var input_color_radio = $(".input_color_radio").attr("placeholder");
			  $(".label_color_radio").text(input_color_radio);

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarradio", function(){

	
	var idradio = $(this).attr("idradios");
	
	var datos = new FormData();
	datos.append("idradio", idradio);
	$.ajax({

		url:"ajax/radio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

			$("#editarid").val(respuesta["idradios"]);
			$("#editarid_familia").val(respuesta["idfamilia"]);
			$("#editarid_tipo_de_radio").val(respuesta["idtiporadio"]);
			$("#editarmarca").val(respuesta["marca"]);
			$("#editarnumero_serie").val(respuesta["numero_serie"]);



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
	    url:"ajax/radio.ajax.php",
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
$(".tablas").on("click", ".btnEliminarradio", function(){

  var idradio = $(this).attr("idradio");
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

      window.location = "index.php?ruta=radio&idradio="+idradio+"&Codigo="+Codigo;

    }

  })

})




