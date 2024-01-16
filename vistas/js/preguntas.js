


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarPregunta", function(){

	var idPregunta = $(this).attr("idPregunta");
	
	var datos = new FormData();
	datos.append("idPregunta", idPregunta);

	$.ajax({

		url:"ajax/preguntas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarIdPregunta").val(respuesta["id"]);
			
			$("#editarPregunta").val(respuesta["pregunta"]);
			
			var idTipoPregunta = respuesta["id_tipo"];	
			var datostp = new FormData();
			datostp.append("idTipoPregunta", idTipoPregunta);
			$.ajax({
				url:"ajax/tipoPregunta.ajax.php",
				method: "POST",
				data: datostp,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuestatp){			
					
					$("#editarTipo").val(respuestatp["id"]);
					$("#editarTipo").html(respuestatp["descripcion"]);
					
				}
			});	
			



		}

	});

})




/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarPregunta", function(){

  var idPregunta = $(this).attr("idPregunta");
 

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

      window.location = "index.php?ruta=preguntas&idPregunta="+idPregunta;

    }

  })

})




