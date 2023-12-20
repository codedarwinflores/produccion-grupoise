/* COLOCACION DE ICONOS */
$(document).ready(function(){



		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarsegurovida", function(){

	
	var idsegurovida = $(this).attr("idsegurovida");
	
	var datos = new FormData();
	datos.append("idsegurovida", idsegurovida);

	$.ajax({

		url:"ajax/segurovida.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editaridempleado").val(respuesta["idempleado"]);
			$("#editarnumero_centificado").val(respuesta["numero_centificado"]);
			$("#editarfecha_ingreso").val(respuesta["fecha_ingreso"]);
			$("#editarmonto_asegurado").val(respuesta["monto_asegurado"]);
			


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
	    url:"ajax/segurovida.ajax.php",
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
$(".tablas").on("click", ".btnEliminarsegurovida", function(){

  var idsegurovida = $(this).attr("idsegurovida");
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

      window.location = "index.php?ruta=segurovida&idsegurovida="+idsegurovida+"&Codigo="+Codigo;

    }

  })

})




