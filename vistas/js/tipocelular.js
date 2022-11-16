/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupotipocelular_operador").empty();
	$('.grupotipocelular_operador').append($('#nuevooperador'));

	$(".egrupotipocelular_operador").empty();
	$('.egrupotipocelular_operador').append($('#editaroperadordiv'));


	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");


	
	$(".icono_tipocelular").addClass("fa fa-newspaper-o");
	$(".input_tipocelular").attr("placeholder", texto+" tipocelular");


	
	$(".icono_IMEI").addClass("fa fa-puzzle-piece");
	$(".input_IMEI").attr("placeholder", texto+" IMEI");

	
	$(".icono_tipocelular_card").addClass("fa fa-print");
	$(".input_tipocelular_card").attr("placeholder", texto+" tipocelular CARD");


              /* *********LABEL*********** */
			  var input_operador = $(".input_operador").attr("placeholder");
			  $(".label_operador").text(input_operador);

		  
              /* *********LABEL*********** */
			  var input_tipocelular = $(".input_tipocelular").attr("placeholder");
			  $(".label_tipocelular").text(input_tipocelular);

		  
              /* *********LABEL*********** */
			  var input_IMEI = $(".input_IMEI").attr("placeholder");
			  $(".label_IMEI").text(input_IMEI);

		  
              /* *********LABEL*********** */
			  var input_tipocelular_card = $(".input_tipocelular_card").attr("placeholder");
			  $(".label_tipocelular_card").text(input_tipocelular_card);

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartipocelular", function(){

	
	var idtipocelular = $(this).attr("idtipocelular");
	
	var datos = new FormData();
	datos.append("idtipocelular", idtipocelular);

	$.ajax({

		url:"ajax/tipocelular.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaroperador").val(respuesta["operador"]);
			$("#editartipocelular").val(respuesta["tipocelular"]);
			$("#editarIMEI").val(respuesta["IMEI"]);
			$("#editartipocelular_card").val(respuesta["tipocelular_card"]);



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
	    url:"ajax/tipocelular.ajax.php",
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
$(".tablas").on("click", ".btnEliminartipocelular", function(){

  var idtipocelular = $(this).attr("idtipocelular");
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

      window.location = "index.php?ruta=tipocelular&idtipocelular="+idtipocelular+"&Codigo="+Codigo;

    }

  })

})




