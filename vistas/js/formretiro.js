/* COLOCACION DE ICONOS */
$(document).ready(function(){

	let params = new URLSearchParams(location.search);
	var id = params.get('id');

	$(".input_idempleado_retiro").val(id);

	 /*  ******** */
	 var parametros = {
		"id" : id
	};
	$.ajax({
			data:  parametros,
			url:"ajax/formretiro.ajax.php",
			type:  'post',
			success:  function (response) {
				$(".input_nombre_retiro").val(response);
			}
	});
	/* ********* */

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarretiro", function(){

	
	var idretiro = $(this).attr("idretiro");
	
	var datos = new FormData();
	datos.append("idretiro", idretiro);

	$.ajax({

		url:"ajax/retiro.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaroperador").val(respuesta["operador"]);
			$("#editarretiro").val(respuesta["retiro"]);
			$("#editarIMEI").val(respuesta["IMEI"]);
			$("#editarretiro_card").val(respuesta["retiro_card"]);



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
	    url:"ajax/retiro.ajax.php",
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
$(".tablas").on("click", ".btnEliminarretiro", function(){

  var idretiro = $(this).attr("idretiro");
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

      window.location = "index.php?ruta=retiro&idretiro="+idretiro+"&Codigo="+Codigo;

    }

  })

})




