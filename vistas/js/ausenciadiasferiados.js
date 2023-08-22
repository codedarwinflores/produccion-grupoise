/* COLOCACION DE ICONOS */
$(document).ready(function(){



		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarausenciadiasferiados", function(){

	
	var idausenciadiasferiados = $(this).attr("idausenciadiasferiados");
	
	var datos = new FormData();
	datos.append("idausenciadiasferiados", idausenciadiasferiados);

	$.ajax({

		url:"ajax/ausenciadiasferiados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarempleado_ausencia").val(respuesta["empleado_ausencia"]);
			$("#editarempleado_ausencia").val(respuesta["empleado_ausencia"]).trigger('change.select2');

			$("#editarfecha_feriado").val(respuesta["fecha_feriado"]);



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
	    url:"ajax/ausenciadiasferiados.ajax.php",
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
$(".tablas").on("click", ".btnEliminarausenciadiasferiados", function(){

  var idausenciadiasferiados = $(this).attr("idausenciadiasferiados");
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

      window.location = "index.php?ruta=ausenciadiasferiados&idausenciadiasferiados="+idausenciadiasferiados+"&Codigo="+Codigo;

    }

  })

})




