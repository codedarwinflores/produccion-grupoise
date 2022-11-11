

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarvehiculo", function(){

	
	var idvehiculo = $(this).attr("idvehiculo");
	
	var datos = new FormData();
	datos.append("idvehiculo", idvehiculo);

	$.ajax({

		url:"ajax/vehiculo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idvehiculos"]);
			$("#editarid_familia").val(respuesta["idfamiliaoriginal"]);
			$("#editarid_tipo_vehiculo").val(respuesta["idtipovehiculo"]);
			$("#editarnumero_chasis").val(respuesta["numero_chasis"]);
			$("#editarnumero_motor").val(respuesta["numero_motor"]);
			$("#editarcapacidad").val(respuesta["capacidad"]);
			$("#editartiene_logotipo").val(respuesta["tiene_logotipo"]);
			$("#editartiene_nombre_entidad").val(respuesta["tiene_nombre_entidad"]);
			$("#editarmarca").val(respuesta["marca"]);
			$("#editarmodelo").val(respuesta["modelo"]);
			$("#editaranio").val(respuesta["anio"]);
			$("#editarplaca").val(respuesta["placa"]);
			$("#editarcolor").val(respuesta["color"]);
			/* **** */
			$("#editarcodigo_vehiculo").val(respuesta["codigo_vehiculo"]);
			$("#editardescripcion_vehiculo").val(respuesta["descripcion_vehiculo"]);
			$("#editarcosto_vehiculo").val(respuesta["costo_vehiculo"]);
			



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
	    url:"ajax/vehiculo.ajax.php",
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
$(".tablas").on("click", ".btnEliminarvehiculo", function(){

  var idvehiculo = $(this).attr("idvehiculo");
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

      window.location = "index.php?ruta=vehiculo&idvehiculo="+idvehiculo+"&Codigo="+Codigo;

    }

  })

})




