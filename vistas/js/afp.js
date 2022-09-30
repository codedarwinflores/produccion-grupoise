


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarAfp", function(){

	var idAfp = $(this).attr("idAfp");
	
	var datos = new FormData();
	datos.append("idAfp", idAfp);

	$.ajax({

		url:"ajax/afp.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarCodigo_superintendencia").val(respuesta["codigo_superintendencia"]);
			$("#editarPorcentaje").val(respuesta["porcentaje"]);
			$("#editarCuota_patronal").val(respuesta["cuota_patronal"]);



		}

	});

})


/*=============================================
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNombre").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarNombre", usuario);

	 $.ajax({
	    url:"ajax/afp.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNombre").parent().after('<div class="alert alert-warning">Este registro ya existe en la base de datos</div>');

	    		$("#nuevoNombre").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarAfp", function(){

  var idAfp = $(this).attr("idAfp");
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

      window.location = "index.php?ruta=afp&idAfp="+idAfp+"&Codigo="+Codigo;

    }

  })

})




