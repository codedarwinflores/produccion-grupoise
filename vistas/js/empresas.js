






/*=============================================
SUBIENDO LA FOTO DEL EMPRESA
=============================================*/
$(".nuevaLogo").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaLogo").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaLogo").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR EMPRESA
=============================================*/
$(".tablas").on("click", ".btnEditarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");
	
	var datos = new FormData();
	datos.append("idEmpresa", idEmpresa);

	$.ajax({

		url:"ajax/empresas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarCodigo_empresa").val(respuesta["codigo_empresa"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#logoActual").val(respuesta["logo"]);


			if(respuesta["logo"] != ""){

				$(".previsualizarEditar").attr("src", respuesta["logo"]);

			}else{

				$(".previsualizarEditar").attr("src", "vistas/img/empresas/default/anonymous.png");

			}

		}

	});

})


/*=============================================
REVISAR SI EL EMPRESAS YA ESTÁ REGISTRADO
=============================================*/

$(".codigo").change(function(){

	$(".alert").remove();

	var codigo = $(this).val();

	var datos = new FormData();
	datos.append("validarEmpresa", codigo);


	 $.ajax({
	    url:"ajax/empresas.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
				alert(respuesta);

	    	/* if(respuesta){
	    		$("body").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoNombre").val("");

	    	} */

	    }

	})
})

/*=============================================
ELIMINAR EMPRESAS
=============================================*/
$(".tablas").on("click", ".btnEliminarEmpresa", function(){

  var idEmpresa = $(this).attr("idEmpresa");
  var logoEmpresas = $(this).attr("logoEmpresas");
  var Codigo_empresa = $(this).attr("Codigo_empresa");

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

      window.location = "index.php?ruta=empresas&idEmpresa="+idEmpresa+"&Codigo_empresa="+Codigo_empresa+"&logoEmpresa="+logoEmpresas;

    }

  })

})




