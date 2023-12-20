


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarPermiso", function(){

	var idPermiso = $(this).attr("idPermiso");
	
	var datos = new FormData();
	datos.append("idPermiso", idPermiso);

	$.ajax({

		url:"ajax/permisos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editaridpermiso").val(respuesta["id"]);
			$("#editarControl").val(respuesta["nombre_control"]);
			$("#editarControl").html(respuesta["nombre_control"]);
			$("#editarPerfil").val(respuesta["nombre_perfil"]);
			$("#editarPerfil").html(respuesta["nombre_perfil"]);
			



		}

	});

})




/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarPermiso", function(){

  var idPermiso = $(this).attr("idPermiso");
 

  swal({
    title: '¿Está seguro de borrar el permiso?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=permisos&idPermiso="+idPermiso;

    }

  })

})




