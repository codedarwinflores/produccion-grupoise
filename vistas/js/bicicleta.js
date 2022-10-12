/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	
	$(".grupo_id_familia").empty();
	$('.grupo_id_familia').append($('.s_familia_b'));
	$(".grupo_id_tipo_bicicleta").empty();
	$('.grupo_id_tipo_bicicleta').append($('.s_tipo'));

	/* EDITAR */

	
	$(".grupoeditar_id_familia").empty();
	$('.grupoeditar_id_familia').append($('.s_familia_b_editar'));
	$(".grupoeditar_id_tipo_bicicleta").empty();
	$('.grupoeditar_id_tipo_bicicleta').append($('.s_tipo_editar'));
	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");



 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarbicicleta", function(){

	
	var idbicicleta = $(this).attr("idbicicleta");
	
	var datos = new FormData();
	datos.append("idbicicleta", idbicicleta);

	$.ajax({

		url:"ajax/bicicleta.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idbicicleta"]);
			$("#editarid_familia").val(respuesta["idfamilia"]);
			$("#editarid_tipo_bicicleta").val(respuesta["idtipobicicleta"]);
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
	    url:"ajax/bicicleta.ajax.php",
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
$(".tablas").on("click", ".btnEliminarbicicleta", function(){

  var idbicicleta = $(this).attr("idbicicleta");
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

      window.location = "index.php?ruta=bicicleta&idbicicleta="+idbicicleta+"&Codigo="+Codigo;

    }

  })

})




