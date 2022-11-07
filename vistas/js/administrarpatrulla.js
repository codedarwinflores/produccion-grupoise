/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupoadministrarpatrulla_operador").empty();
	$('.grupoadministrarpatrulla_operador').append($('#nuevooperador'));

	$(".egrupoadministrarpatrulla_operador").empty();
	$('.egrupoadministrarpatrulla_operador').append($('#editaroperadordiv'));


	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");


 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarubicacion", function(){

	
	var idadministrarpatrulla = $(this).attr("idadministrarpatrulla");
	
	var datos = new FormData();
	datos.append("idadministrarpatrulla", idadministrarpatrulla);

	$.ajax({

		url:"ajax/administrarpatrulla.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid_patrullas_ubicaciones").val(respuesta["id_patrullas_ubicaciones"]);
			$("#editarid_patrullas_pu").val(respuesta["id_patrullas_pu"]);
			$("#editarid_ubicacion_pu").val(respuesta["id_ubicacion_pu"]);


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
	    url:"ajax/administrarpatrulla.ajax.php",
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
$(".tablas").on("click", ".btnEliminaradministrarpatrulla", function(){

  var idadministrarpatrulla = $(this).attr("idadministrarpatrulla");
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

      window.location = "index.php?ruta=administrarpatrulla&idadministrarpatrulla="+idadministrarpatrulla+"&Codigo="+Codigo;

    }

  })

})




