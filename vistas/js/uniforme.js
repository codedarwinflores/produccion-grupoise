/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupo_tipo_uniforme").empty();
	$(".grupo_tipo_uniforme").append($('.tipo_uniforme_s'));
	$(".ugrupo_estado").empty();
	$(".ugrupo_estado").append($('.estado_uniforme'));

	/* **editar */

	
	$(".egrupo_tipo_uniforme").empty();
	$(".egrupo_tipo_uniforme").append($('.tipo_uniforme_s_editar'));
	$(".egrupo_estado").empty();
	$(".egrupo_estado").append($('.estado_uniforme_editar'));


	$(".icono_talla").addClass("fa fa-sort");
	$(".input_talla").attr("placeholder", texto+" Talla");

	
	$(".icono_precio").addClass("fa fa-money");
	$(".input_precio").attr("placeholder", texto+" Precio");
	jQuery(".input_precio").on('input', function (evt) {
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});

	jQuery("#editarprecio").on('input', function (evt) {
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});



	
	$(".icono_stock").addClass("fa fa-truck");
	$(".input_stock").attr("placeholder", texto+" Stock");
	

	



 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditaruniforme", function(){

	
	var iduniforme = $(this).attr("iduniforme");
	
	var datos = new FormData();
	datos.append("iduniforme", iduniforme);

	$.ajax({

		url:"ajax/uniforme.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

			$("#editarid").val(respuesta["id"]);
			$("#editartipo_uniforme").val(respuesta["tipo_uniforme"]);
			$("#editartalla").val(respuesta["talla"]);
			$("#editarestado").val(respuesta["estado"]);
			$("#editarprecio").val(respuesta["precio"]);
			$("#editarstock").val(respuesta["stock"]);


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
	    url:"ajax/uniforme.ajax.php",
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
$(".tablas").on("click", ".btnEliminaruniforme", function(){

  var iduniforme = $(this).attr("iduniforme");
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

      window.location = "index.php?ruta=uniforme&iduniforme="+iduniforme+"&Codigo="+Codigo;

    }

  })

})




