/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");
/* 
	$(".grupojefeoperacion_operador").empty();
	$('.grupojefeoperacion_operador').append($('#nuevooperador'));

	$(".egrupojefeoperacion_operador").empty();
	$('.egrupojefeoperacion_operador').append($('#editaroperadordiv'));

 */
	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");

	$(".input_fecharegistro").attr("readonly","readonly");
	$("#editarfecha_registro2").attr("readonly","readonly");



	

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarjefeoperacion", function(){

	
	var idjefeoperacion = $(this).attr("idjefeoperacion");
	
	var datos = new FormData();
	datos.append("idjefeoperacion", idjefeoperacion);

	$.ajax({

		url:"ajax/jefeoperacion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idjefe"]);


					
			var dateNEW2 = respuesta["fecha_registro"];
			var date2 = new Date(dateNEW2);
			var year2 = date2.toLocaleString("default", { year: "numeric" });
			var month2 = date2.toLocaleString("default", { month: "2-digit" });
			var day2 = date2.toLocaleString("default", { day: "2-digit" });
			var formattedDate2 = day2 + "-" + month2 + "-" + year2;

			$("#editarfecha_registro2").val(formattedDate2);
			$("#editarfecha_registro").val(respuesta["fecha_registro"]);
			$("#editarid_empleado").val(respuesta["id_empleado"]);
			$("#editarcodigo_cliente").val(respuesta["codigo_cliente"]);
			$("#editarpersona_contacto").val(respuesta["persona_contacto"]);
			$("#editarid_patrulla").val(respuesta["id_patrulla"]);
			$("#editarconoce_coordinador_zona").val(respuesta["conoce_coordinador_zona"]);
			$("#editarfrecuencia_visitas_por_mes").val(respuesta["frecuencia_visitas_por_mes"]);
			$("#editarcapacidad_respuesta").val(respuesta["capacidad_respuesta"]);
			$("#editarsolucion_de_problemas").val(respuesta["solucion_de_problemas"]);
			$("#editarhay_supervisor_perimetro").val(respuesta["hay_supervisor_perimetro"]);
			$("#editaractitud_del_superior").val(respuesta["actitud_del_superior"]);
			$("#editarexigencia_cumplimiento_pom").val(respuesta["exigencia_cumplimiento_pom"]);
			$("#editarsolucion_problemas").val(respuesta["solucion_problemas"]);
			$("#editarinforma_oportunamente_novedades").val(respuesta["informa_oportunamente_novedades"]);
			$("#editarpuntualidad_horarios").val(respuesta["puntualidad_horarios"]);
			$("#editaractitud_hs").val(respuesta["actitud_hs"]);
			$("#editarpresentacion_personal").val(respuesta["presentacion_personal"]);
			$("#editarcumplimiento_pon").val(respuesta["cumplimiento_pon"]);
			$("#editaracata_indicaciones").val(respuesta["acata_indicaciones"]);
			$("#editarinforma_oportuna_novedades").val(respuesta["informa_oportuna_novedades"]);
			$("#editaratento_a_su_servicio").val(respuesta["atento_a_su_servicio"]);
			$("#editaratencion_hacia_cliente").val(respuesta["atencion_hacia_cliente"]);
			$("#editarobservaciones").val(respuesta["observacionesjefe"]);
			
		



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
	    url:"ajax/jefeoperacion.ajax.php",
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
$(".tablas").on("click", ".btnEliminarjefeoperacion", function(){

  var idjefeoperacion = $(this).attr("idjefeoperacion");
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

      window.location = "index.php?ruta=jefeoperacion&idjefeoperacion="+idjefeoperacion+"&Codigo="+Codigo;

    }

  })

})




