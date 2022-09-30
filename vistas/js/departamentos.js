


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarDepartamentos", function(){


	var idDepartamentos = $(this).attr("idDepartamentos");
	
	var datos = new FormData();
	datos.append("idDepartamentos", idDepartamentos);

	$.ajax({

		url:"ajax/departamentos.ajax.php",
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
	    url:"ajax/departamentos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarDepartamentos", function(){

  var idDepartamentos = $(this).attr("idDepartamentos");
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

      window.location = "index.php?ruta=departamentos&idDepartamentos="+idDepartamentos+"&Codigo="+Codigo;

    }

  })

})




