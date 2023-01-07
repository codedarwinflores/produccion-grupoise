/* COLOCACION DE ICONOS */
$(document).ready(function(){

	let params = new URLSearchParams(location.search);
	var id = params.get('id');
	$(".input_idempleado_extravio").val(id);

	 /*  ******** */
	 var parametros = {
		"id" : id
	};
	$.ajax({
			data:  parametros,
			url:"ajax/formretiro.ajax.php",
			type:  'post',
			success:  function (response) {
			
				$(".nombreempleado").text("Empleado: "+response);
			}
	});
	/* ********* */

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarextravios", function(){

	
	var idextravios = $(this).attr("idextravios");
	
	var datos = new FormData();
	datos.append("idextravios", idextravios);

	$.ajax({

		url:"ajax/extravio.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarfecha_extravio").val(respuesta["fecha_extravio"]);
			$("#editardescuento_extravio").val(respuesta["descuento_extravio"]);
			$("#editarvalor_extravio").val(respuesta["valor_extravio"]);
			$("#editaridempleado_extravio").val(respuesta["idempleado_extravio"]);




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
	    url:"ajax/extravios.ajax.php",
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
$(".tablas").on("click", ".btnEliminarextravios", function(){

  var idextravios = $(this).attr("idextravios");
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

      window.location = "index.php?ruta=extravios&idextravios="+idextravios+"&Codigo="+Codigo;

    }

  })

})




