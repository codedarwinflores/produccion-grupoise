/* COLOCACION DE ICONOS */
$(document).ready(function(){


	

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarposicionubicacion", function(){

	
	var idposicionubicacion = $(this).attr("idposicionubicacion");
	
	var datos = new FormData();
	datos.append("idposicionubicacion", idposicionubicacion);

	$.ajax({

		url:"ajax/posicionubicacion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarnombre_posicion").val(respuesta["nombre_posicion"]);
			$("#editarnumero").val(respuesta["numero"]);
			$("#editaridubicacion_posicion").val(respuesta["idubicacion_posicion"]);


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
	    url:"ajax/posicionubicacion.ajax.php",
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
$(".tablas").on("click", ".btnEliminarposicionubicacion", function(){

  var idposicionubicacion = $(this).attr("idposicionubicacion");
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

      window.location = "index.php?ruta=posicionubicacion&idposicionubicacion="+idposicionubicacion+"&Codigo="+Codigo;

    }

  })

})




