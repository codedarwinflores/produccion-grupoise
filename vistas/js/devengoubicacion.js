/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";


	$(document).on('change', '.nuevonombre_devengo_ubicacion', function(event) {

		$('.nuevocodigo_devengo_ubicacion').val($(".nuevonombre_devengo_ubicacion option:selected").attr('codigo'));
		$('.nuevoidubicacion_devengo').val($(".nuevonombre_devengo_ubicacion option:selected").attr('idubicacion'));

   });
		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditardevengoubicacion", function(){

	var iddevengoubicacion = $(this).attr("iddevengoubicacion");
	var datos = new FormData();
	datos.append("iddevengoubicacion", iddevengoubicacion);

	$.ajax({

		url:"ajax/devengoubicacion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo_devengo_ubicacion").val(respuesta["codigo_devengo_ubicacion"]);

			$("#seleccionblanco").attr("value",respuesta["nombre_devengo_ubicacion"]);
			$("#select2-editarnombre_devengo_ubicacion-container").text(respuesta["nombre_devengo_ubicacion"]);

		
			$("#editarperiodo_devengo_ubicacion").val(respuesta["periodo_devengo_ubicacion"]);
			$("#editarvalor_devengo_ubicacion").val(respuesta["valor_devengo_ubicacion"]);
			$("#editaridubicacion_devengo").val(respuesta["idubicacion_devengo"]);



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
	    url:"ajax/devengoubicacion.ajax.php",
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
$(".tablas").on("click", ".btnEliminardevengoubicacion", function(){

  var iddevengoubicacion = $(this).attr("iddevengoubicacion");
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

      window.location = "index.php?ruta=devengoubicacion&iddevengoubicacion="+iddevengoubicacion+"&Codigo="+Codigo;

    }

  })

})




