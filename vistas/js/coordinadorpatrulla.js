/* COLOCACION DE ICONOS */
$(document).ready(function(){



		  
 })

 

 $('.input_codigo_nombre_coordinador').on('change', function() {
	var valor = $('option:selected', this).attr('ids');
	$(".nuevoidcoordinador_patrulla").val(valor);
  });


/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarcoordinadorpatrulla", function(){

	
	var idcoordinadorpatrulla = $(this).attr("idcoordinadorpatrulla");
	
	var datos = new FormData();
	datos.append("idcoordinadorpatrulla", idcoordinadorpatrulla);

	$.ajax({

		url:"ajax/coordinadorpatrulla.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaridpatrulla_coordinadorpatrulla").val(respuesta["idpatrulla_coordinadorpatrulla"]);
			$("#idcoordinador").val(respuesta["codigo_nombre_coordinador"]);
			$("#select2-editarcodigo_nombre_coordinador-container").text(respuesta["codigo_nombre_coordinador"]);
			$("#editaridcoordinador_patrulla").val(respuesta["idcoordinador_patrulla"]);

			

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
	    url:"ajax/coordinadorpatrulla.ajax.php",
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
$(".tablas").on("click", ".btnEliminarcoordinadorpatrulla", function(){

  var idcoordinadorpatrulla = $(this).attr("idcoordinadorpatrulla");
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

      window.location = "index.php?ruta=coordinadorpatrulla&idcoordinadorpatrulla="+idcoordinadorpatrulla+"&Codigo="+Codigo;

    }

  })

})




