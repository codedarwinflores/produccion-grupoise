/* COLOCACION DE ICONOS */

window.onload = function () {
	var  texto= "Ingresar";
	$(".icono_codigo").addClass("fa fa-qrcode");
	$(".input_codigo").attr("placeholder", texto+" Código");

	$(".icono_nombre").addClass("fa fa-tags");
	$(".input_nombre").attr("placeholder", texto+" Nombre");
 }

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarServicios", function(){

	
	var idServicios = $(this).attr("idServicios");
	
	var datos = new FormData();
	datos.append("idServicios", idServicios);

	$.ajax({

		url:"ajax/servicios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo").val(respuesta["codigo"]);
			$("#editarnombre").val(respuesta["nombre"]);



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
	    url:"ajax/servicios.ajax.php",
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
$(".tablas").on("click", ".btnEliminarServicios", function(){

  var idServicios = $(this).attr("idServicios");
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

      window.location = "index.php?ruta=servicios&idServicios="+idServicios+"&Codigo="+Codigo;

    }

  })

})




