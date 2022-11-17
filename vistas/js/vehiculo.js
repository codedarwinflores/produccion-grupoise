
$(document).ready(function(){


	calendario();
	var texto="Ingresar";

	$(".icono_fecha_adquision").addClass("fa  fa-calendar");
    $(".input_fecha_adquision").attr("placeholder", texto+" Fecha de adquisición");

	$(".icono_observaciones").addClass("fa  fa-book");
    $(".input_observaciones").attr("placeholder", texto+" Observaciones");



	$(".icono_serie").addClass("fa  fa-bandcamp");
    $(".input_serie").attr("placeholder", texto+" No Serie");

	$(".input_codigo_vehiculo").attr("readonly","readonly");


              /* *********LABEL*********** */
			  var input_fecha_adquision = $(".input_fecha_adquision").attr("placeholder");
			  $(".label_fecha_adquision").text(input_fecha_adquision);

		  
              /* *********LABEL*********** */
			  var input_observaciones = $(".input_observaciones").attr("placeholder");
			  $(".label_observaciones").text(input_observaciones);

			  
              /* *********LABEL*********** */
			  var input_serie = $(".input_serie").attr("placeholder");
			  $(".label_serie").text(input_serie);
		  

});
 
function calendario(){
	$(".input_fecha_adquision").addClass("calendario");
	$(".input_fecha_adquision").attr("fecha","fecha_adquision");
	$(".input_fecha_adquision").attr("name"," ");

}

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarvehiculo", function(){

	
	$(".input_fecha_adquision").attr("fecha","editarfecha_adquision");


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


				
			var dateNEW = respuesta["fecha_adquision"];
			var date = new Date(dateNEW);
			var year = date.toLocaleString("default", { year: "numeric" });
			var month = date.toLocaleString("default", { month: "2-digit" });
			var day = date.toLocaleString("default", { day: "2-digit" });
			var formattedDate = day + "-" + month + "-" + year;

			$("#editarfecha_adquision").val(formattedDate);
			
			$("#editarfecha_adquision2").val(respuesta["fecha_adquision"]);
			$("#editarobservaciones").val(respuesta["observaciones"]);
			$("#editarserie").val(respuesta["serie"]);

			



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




