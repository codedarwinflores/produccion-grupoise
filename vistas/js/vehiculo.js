
$(document).ready(function(){

	
	$(".grupovehiculo_personal_asig_vehiculo").empty();
	$(".grupovehiculo_personal_asig_vehiculo").append($(".s_personal_asig_vehiculo"));
	$(".grupovehiculo_fecha_venctarjeta_circula").empty();
	$(".grupovehiculo_fecha_venctarjeta_circula").append($(".s_fecha_venctarjeta_circula"));
	$(".grupovehiculo_gasolina_asig_vehiculo").empty();
	$(".grupovehiculo_gasolina_asig_vehiculo").append($(".s_gasolina_asig_vehiculo"));

	
	$(".egrupovehiculo_personal_asig_vehiculo").empty();
	$(".egrupovehiculo_personal_asig_vehiculo").append($(".editars_personal_asig_vehiculo"));
	$(".egrupovehiculo_fecha_venctarjeta_circula").empty();
	$(".egrupovehiculo_fecha_venctarjeta_circula").append($(".editars_fecha_venctarjeta_circula"));
	$(".egrupovehiculo_gasolina_asig_vehiculo").empty();
	$(".egrupovehiculo_gasolina_asig_vehiculo").append($(".editars_gasolina_asig_vehiculo"));

	$("#nuevopersonal_asig_vehiculo").change(function() {
	    var fecha_ven_lic = $("#nuevopersonal_asig_vehiculo option:selected").attr("fecha_ven_lic");
	    var licensia = $("#nuevopersonal_asig_vehiculo option:selected").attr("licensia");
		$(".nuevolicensia").text("Licencia: "+licensia);
		$(".nuevofecha").text("Fecha Vencimiento: "+fecha_ven_lic);

	});
	$("#editarpersonal_asig_vehiculo").change(function() {
	    var fecha_ven_lic = $("#editarpersonal_asig_vehiculo option:selected").attr("fecha_ven_lic");
	    var licensia = $("#editarpersonal_asig_vehiculo option:selected").attr("licensia");
		$(".editarlicensia").text("Licensia: "+licensia);
		$(".editarfecha").text("Fecha Vencimiento: "+fecha_ven_lic);

	});


	$(".grupovehiculo_estado_vehiculo").empty();
	$(".grupovehiculo_estado_vehiculo").append($(".s_estado_vehiculo"));

	$(".egrupovehiculo_estado_vehiculo").empty();
	$(".egrupovehiculo_estado_vehiculo").append($(".editar_s_estado_vehiculo"));


	calendario();
	var texto="Ingresar";

	$(".icono_fecha_adquision").addClass("fa  fa-calendar");
    $(".input_fecha_adquision").attr("placeholder", texto+" Fecha de adquisición");

	$(".icono_observaciones").addClass("fa  fa-book");
    $(".input_observaciones").attr("placeholder", texto+" Observaciones");



	$(".icono_serie").addClass("fa  fa-bandcamp");
    $(".input_serie").attr("placeholder", texto+" Nombre de la Aseguradora");

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

			  $(".input_fecha_adquision").attr("readonly","readonly");


			    /* *********LABEL*********** */
				$(".icono_valor_asegurado").addClass("fa fa-file-excel-o")
				$(".input_valor_asegurado ").attr("placeholder","Ingresar Valor Asegurado");
				var input_valor_asegurado  = $(".input_valor_asegurado ").attr("placeholder");
				$(".label_valor_asegurado").text(input_valor_asegurado);

				/* *********LABEL*********** */
				$(".icono_prima_seguro").addClass("fa fa-file-excel-o")
				$(".input_prima_seguro").attr("placeholder","Ingresar  Prima Seguro");
				var input_prima_seguro  = $(".input_prima_seguro").attr("placeholder");
				$(".label_prima_seguro").text(input_prima_seguro);

				/* *********LABEL*********** */
				$(".icono_deducible").addClass("fa fa-file-excel-o")
				$(".input_deducible").attr("placeholder","Ingresar Deducible");
				var input_deducible  = $(".input_deducible").attr("placeholder");
				$(".label_deducible").text(input_deducible);
  
	


		  

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
			$("#editarestado_vehiculo").val(respuesta["estado_vehiculo"]);


				
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

			$("#editarvalor_asegurado").val(respuesta["valor_asegurado"]);
			$("#editarprima_seguro").val(respuesta["prima_seguro"]);
			$("#editardeducible").val(respuesta["deducible"]);

			$("#editargasolina_asig_vehiculo").val(respuesta["gasolina_asig_vehiculo"]);
			$("#editarfecha_venctarjeta_circula").val(respuesta["fecha_venctarjeta_circula"]);
			$("#editarpersonal_asig_vehiculo").val(respuesta["personal_asig_vehiculo"]).trigger('change.select2');

			$("#editarpersonal_asig_vehiculo option[value='"+respuesta["personal_asig_vehiculo"]+"']").attr("selected", true);
			var fecha_ven_lic = $('option:selected', "#editarpersonal_asig_vehiculo").attr("fecha_ven_lic");
			var licensia = $('option:selected', "#editarpersonal_asig_vehiculo").attr("licensia");

			$(".editarlicensia").text("Licensia: "+licensia);
			$(".editarfecha").text("Fecha Vencimiento: "+fecha_ven_lic);


			



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




