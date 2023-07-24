/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarcomentario", function(){

	
	
	var idcomentario = $(this).attr("idcomentario");
	
	var datos = new FormData();
	datos.append("idcomentario", idcomentario);

	$.ajax({

		url:"ajax/comentario.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#editarid").val(respuesta["id"]);
			$("#editarfecha_comentario").val(respuesta["fecha_comentario"]);
			$("#editarcomentario").val(respuesta["comentario"]);
			$("#editaridubicacioncliente_comentario").val(respuesta["idubicacioncliente_comentario"]);


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
	    url:"ajax/comentario.ajax.php",
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
$(".tablas").on("click", ".btnEliminarcomentario", function(){

  var idcomentario = $(this).attr("idcomentario");
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

      window.location = "index.php?ruta=comentario&idcomentario="+idcomentario+"&Codigo="+Codigo;

    }

  })

})




