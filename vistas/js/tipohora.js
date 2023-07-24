/* COLOCACION DE ICONOS */
$(document).ready(function(){



		  
 })


 $( ".validarcodigo" ).blur(function() {
	var dato = $(this).val();
	var tabla = $(this).attr("tablaname");
	var columna = $(this).attr("columna");
	
	

	/*  ******;** */
	 var parametros = {
		"codigo" : dato,
		"tabla" : tabla,
		"columna" : columna
	
	
	};
	$.ajax({
			data:  parametros,
			url:"ajax/validarcodigoduplicado.ajax.php",
			type:  'post',
			success:  function (response) {
				
				if(response == 1){
					$(".mostrarmensajevalidar").append("<p style='color:red;'>El código ya existe</p>");
					$(".validarcodigo").val("");
				}
				
			}
	});
	/* ********* */


  });


 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartipohora", function(){

	
	var idtipohora = $(this).attr("idtipohora");
	
	var datos = new FormData();
	datos.append("idtipohora", idtipohora);

	$.ajax({

		url:"ajax/tipohora.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo_tipohora").val(respuesta["codigo_tipohora"]);
			$("#editarmotivo_tipohora").val(respuesta["motivo_tipohora"]);
			$("#editarrequiere_agente_tipohora").val(respuesta["requiere_agente_tipohora"]);
			$("#editardescontar_tipohora").val(respuesta["descontar_tipohora"]);
			$("#editarcobrar_cliente_tipohora").val(respuesta["cobrar_cliente_tipohora"]);
			$("#editarsolicitado_tipohora").val(respuesta["solicitado_tipohora"]);
			$("#editaringreso_hora_tipohora").val(respuesta["ingreso_hora_tipohora"]);
			$("#editarreporte_tipohora").val(respuesta["reporte_tipohora"]);



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
	    url:"ajax/tipohora.ajax.php",
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
$(".tablas").on("click", ".btnEliminartipohora", function(){

  var idtipohora = $(this).attr("idtipohora");
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

      window.location = "index.php?ruta=tipohora&idtipohora="+idtipohora+"&Codigo="+Codigo;

    }

  })

})




