


/*=============================================
EDITAR PROVEEDORES
=============================================*/
$(".tablas").on("click", ".btnEditarProveedores", function(){

	var idProveedores = $(this).attr("idProveedores");
	
	var datos = new FormData();
	datos.append("idProveedores", idProveedores);

	$.ajax({

		url:"ajax/proveedores.ajax.php",
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
			$("#editarDireccion").val(respuesta["direccion"]);
			$("#editarTelefono").val(respuesta["telefono"]);
			$("#editarExtension").val(respuesta["extension"]);
			$("#editarNumero_de_registro").val(respuesta["numero_de_resgistro"]);
			$("#editarEncargado").val(respuesta["encargado"]);
			$("#editarComentarios").val(respuesta["comentarios"]);
			$("#editarNacionalidad").val(respuesta["nacionalidad"]);
			$("#editarCodigo_contable").val(respuesta["codigo_contable"]);
			$("#editarContribuyente").val(respuesta["contribuyente"]);




		}

	});

})


/*=============================================
REVISAR SI EL PROVEEDOR YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNombre").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarNombre", usuario);

	 $.ajax({
	    url:"ajax/proveedores.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNombre").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoNombre").val("");

	    	}

	    }

	})
})

/*=============================================
ELIMINAR PROVEEDORES
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedores", function(){

  var idProveedores = $(this).attr("idProveedores");
  var Codigo = $(this).attr("Codigo");

  swal({
    title: '¿Está seguro de borrar la empresa?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=proveedores&idProveedores="+idProveedores+"&Codigo="+Codigo;

    }

  })

})




