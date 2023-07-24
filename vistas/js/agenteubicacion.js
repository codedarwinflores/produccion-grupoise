/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

/* 	$(".nuevonombre_agente").change(function(){
		alert($('option:selected').attr('codigo'));
		var valor =  $('option:selected').attr('codigo');
		$(".codigo_agente").val(valor);
	
	}); */

	$(document).on('change', '.nuevonombre_agente', function(event) {
		$('.codigo_agente').val($(".nuevonombre_agente option:selected").attr('codigo'));
   });


 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditaragenteubicacion", function(){

	
	var idagenteubicacion = $(this).attr("idagenteubicacion");
	
	var datos = new FormData();
	datos.append("idagenteubicacion", idagenteubicacion);

	$.ajax({

		url:"ajax/agenteubicacion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaridubicacion_agente").val(respuesta["idubicacion_agente"]);
			$("#editarcodigo_agente").val(respuesta["codigo_agente"]);
			/* $("#editarnombre_agente").append(respuesta["nombre_agente"]);*/
			/* $("#editarnombre_agente option:selected").val(respuesta["nombre_agente"]) */

			/* $("#editarnombre_agente option[value="+ respuesta["nombre_agente"] +"]").attr("selected",true); */
			$("#seleccion").attr("value",respuesta["nombre_agente"]).html(respuesta["nombre_agente"]);
			$("#select2-editarnombre_agente-container").text(respuesta["nombre_agente"]);

		
			

	/* 		$("#editarnombre_agente").prepend("<span codigo='"+respuesta["codigo_agente"]+"' value='"+respuesta["nombre_agente"]+"' >"+respuesta["nombre_agente"]+"</span>"); */




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
	    url:"ajax/agenteubicacion.ajax.php",
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
$(".tablas").on("click", ".btnEliminaragenteubicacion", function(){

  var idagenteubicacion = $(this).attr("idagenteubicacion");
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

      window.location = "index.php?ruta=agenteubicacion&idagenteubicacion="+idagenteubicacion+"&Codigo="+Codigo;

    }

  })

})




