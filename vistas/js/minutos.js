/* COLOCACION DE ICONOS */
$(document).ready(function(){

// Obtén la URL actual
var urlParams = new URLSearchParams(window.location.search);

// Captura el valor de 'id' si está presente en la URL
if (urlParams.has('id')) {
  var id = urlParams.get('id');

  console.log('El valor de "id" es: ' + id);
  $("#nuevoid_cliente_minutos").val(id);

  // Realiza acciones adicionales con la variable id si es necesario
} else {
  console.log('La variable "id" no está presente en la URL.');
}

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarminutos", function(){

	
	var idminutos = $(this).attr("idminutos");
	
	var datos = new FormData();
	datos.append("idminutos", idminutos);

	$.ajax({

		url:"ajax/minutos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarminutos_desde").val(respuesta["minutos_desde"]);
			$("#editarminutos_hasta").val(respuesta["minutos_hasta"]);
			$("#editarvalor_minutos").val(respuesta["valor_minutos"]);
			$("#editarid_cliente_minutos").val(respuesta["id_cliente_minutos"]);



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
	    url:"ajax/minutos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarminutos", function(){

  var idminutos = $(this).attr("idminutos");
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

      window.location = "index.php?ruta=minutos&idminutos="+idminutos+"&Codigo="+Codigo;

    }

  })

})




