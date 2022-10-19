/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".tipoarma_input_id").removeAttr("required");;

	
	$(".icono_nombre_tipo").addClass("fa fa-server");
	$(".tipoarma_input_nombre_tipo").attr("placeholder", texto+"  Tipo de Arma");
	$(".tipoarma_input_codigo").attr("placeholder", texto+"  Código");




 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartipoarmas", function(){

	
	var idtipoarmas = $(this).attr("idtipoarmas");
	
	var datos = new FormData();
	datos.append("idtipoarmas", idtipoarmas);

	$.ajax({

		url:"ajax/tipoarmas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#tipoarma_editarid").val(respuesta["id"]);
			$("#tipoarma_editarcodigo").val(respuesta["codigo"]);
			$("#tipoarma_editarnombre_tipo").val(respuesta["nombre_tipo"]);



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
	    url:"ajax/tipoarmas.ajax.php",
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
$(".tablas").on("click", ".btnEliminartipoarmas", function(){

  var idtipoarmas = $(this).attr("idtipoarmas");
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

      window.location = "index.php?ruta=tipoarmas&idtipoarmas="+idtipoarmas+"&Codigo="+Codigo;

    }

  })

})




