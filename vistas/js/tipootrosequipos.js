/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupotipootrosequipos_operador").empty();
	$('.grupotipootrosequipos_operador').append($('#nuevooperador'));

	$(".egrupotipootrosequipos_operador").empty();
	$('.egrupotipootrosequipos_operador').append($('#editaroperadordiv'));


	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");



		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartipootrosequipos", function(){

	
	var idtipootrosequipos = $(this).attr("idtipootrosequipos");
	
	var datos = new FormData();
	datos.append("idtipootrosequipos", idtipootrosequipos);

	$.ajax({

		url:"ajax/tipootrosequipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaroperador").val(respuesta["operador"]);
			$("#editartipootrosequipos").val(respuesta["tipootrosequipos"]);
			$("#editarIMEI").val(respuesta["IMEI"]);
			$("#editartipootrosequipos_card").val(respuesta["tipootrosequipos_card"]);



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
	    url:"ajax/tipootrosequipos.ajax.php",
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
$(".tablas").on("click", ".btnEliminartipootrosequipos", function(){

  var idtipootrosequipos = $(this).attr("idtipootrosequipos");
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

      window.location = "index.php?ruta=tipootrosequipos&idtipootrosequipos="+idtipootrosequipos+"&Codigo="+Codigo;

    }

  })

})




