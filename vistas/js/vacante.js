/* COLOCACION DE ICONOS */
$(document).ready(function(){


	/* **********HORA ACTUAL */
	var hoy = new Date();
	var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
	function formatTime(timeString) {
		const [hourString, minute] = timeString.split(":");
		const hour = +hourString % 24;
		return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
	}
	$(".input_hora_vacante").val(formatTime(hora) );



	var formatDate = function(date) {
		var mes=date.getMonth()+1;
		return date.getDate() + "-" + ('0' + mes).slice(-2)  + "-" + date.getFullYear();
	  }
	$(".input_fecha_vacante").val(formatDate(hoy));
		  


	$( ".input_ubicacion_vacante" ).on( "change", function() {
		var nombre = $('option:selected', this).attr("nombre");
		$(".nombre_ubicacion_vacante").val(nombre);

	})


	$( ".input_codigo_agente_vacante" ).on( "change", function() {
		var nombre = $('option:selected', this).attr("nombre");
		$(".input_nombre_agente_vacante").val(nombre);

	})



		  
 })


 $(".input_ubicacion_vacante").change(function(){
	var idubicacion = $('option:selected', this).attr('idubicacion');
	  /*  ******** */
	  var parametros = {
		"idubicacion" : idubicacion,
		"accion" : "pocision"
	    };
	$.ajax({
	   url:"ajax/vacanteselect.ajax.php",
	   method: "POST",
	   data: parametros,
	   success: function(respuesta){
		$(".input_posicion_vacante").empty();
		$(".input_posicion_vacante").prepend(respuesta);
	   }
   });
	/* ********** */
});


$("#codigo_empleado_cubrir_vacante").change(function(){
	var idempleado = $('option:selected', this).attr('codigo');
	var nombreempleado = $('option:selected', this).attr('nombre');


    $("#codigo_empleado_historialvacante").val(idempleado);
    $("#nombre_empleado_historialvacante").val(nombreempleado);
    

	  /*  ******** */
	  var parametros = {
		"idempleado" : idempleado,
		"accion" : "empleado"
	};
	$.ajax({
	   url:"ajax/vacanteselect.ajax.php",
	   method: "POST",
	   data: parametros,
	   success: function(respuesta){

		$("#codigo_ubicacion_cubrir_vacante").empty();
		$("#codigo_ubicacion_cubrir_vacante").prepend(respuesta.split(",")[0]);/* --codigo ubicacion */
        $("#nombre_ubicacion_cubrir_vacante").val(respuesta.split(",")[1]);/* --nombre ubicacion */


        $("#nombre_ubicacion_historialvacante").val(respuesta.split(",")[1]);/* --nombre ubicacion */
        $("#codigo_ubicacion_historialvacante").val(respuesta.split(",")[2]);/* --codigo ubicacion */




	   }
   });
	/* ********** */
});



$( ".txt_posicion" ).blur(function() {
	var valor='<option value="'+$(this).val()+'" :selected >'+$(this).val()+'</option>';
	$(".input_posicion_vacante ").prepend(valor);
	$(".input_posicion_vacante ").val($(this).val());
	$(this).val("");
})
 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarvacante", function(){

	
	var idvacante = $(this).attr("idvacante");
	
	var datos = new FormData();
	datos.append("idvacante", idvacante);

	$.ajax({

		url:"ajax/vacante.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);

			$("#ubicacion_vacante").val(respuesta["ubicacion_vacante"]);
			$("#select2-editarubicacion_vacante-container").text(respuesta["ubicacion_vacante"]+'-'+respuesta["nombre_ubicacion_vacante"]);

			$("#editarcorrelativo_vacante").val(respuesta["correlativo_vacante"]);
			$("#editarfecha_vacante").val(respuesta["fecha_vacante"]);
			$("#editarhora_vacante").val(respuesta["hora_vacante"]);

			$("#personal_vacante").val(respuesta["codigo_agente_vacante"]);
			$("#select2-editarcodigo_agente_vacante-container").text(respuesta["codigo_agente_vacante"]+'-'+respuesta["nombre_agente_vacante"]);


			$("#editarnombre_agente_vacante").val(respuesta["nombre_agente_vacante"]);



			var valorselect="<option value='"+respuesta["posicion_vacante"]+"'>"+respuesta["posicion_vacante"]+"</option>";
			$("#editarposicion_vacante").empty();
			$("#editarposicion_vacante").append(valorselect);



			$("#editarestado_vacante").val(respuesta["estado_vacante"]);
			$("#editarfecha_cobertura_vacante").val(respuesta["fecha_cobertura_vacante"]);
			$("#editarhora_cobertura_vacante").val(respuesta["hora_cobertura_vacante"]);
			$("#editarnombre_ubicacion_vacante").val(respuesta["nombre_ubicacion_vacante"]);

			$("#editarfecha_cubrir_vacante").val(respuesta["fecha_cubrir_vacante"]);
			$("#editarhora_cubrir_vacante").val(respuesta["hora_cubrir_vacante"]);
			$("#editaraccion_cubrir_vacante").val(respuesta["accion_cubrir_vacante"]);
			$("#editarcodigo_empleado_cubrir_vacante").val(respuesta["codigo_empleado_cubrir_vacante"]);
			$("#editarnombre_empleado_cubrir_vacante").val(respuesta["nombre_empleado_cubrir_vacante"]);
			$("#editarcodigo_ubicacion_cubrir_vacante").val(respuesta["codigo_ubicacion_cubrir_vacante"]);
			$("#editarnombre_ubicacion_cubrir_vacante").val(respuesta["nombre_ubicacion_cubrir_vacante"]);
			$("#editarobserva_vacante").val(respuesta["observa_vacante"]);






		}

	});

})



/*=============================================
Administrar 
=============================================*/
$(".tablas").on("click", ".btnadministrarvacante", function(){

	
	var idvacante = $(this).attr("idvacante");
	
	var datos = new FormData();
	datos.append("idvacante", idvacante);

	$.ajax({

		url:"ajax/vacante.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#id").val(respuesta["id"]);
			$("#aubicacion_vacante").val(respuesta["ubicacion_vacante"]);
			$("#correlativo_vacante").val(respuesta["correlativo_vacante"]);
			$("#fecha_vacante").val(respuesta["fecha_vacante"]);
			$("#hora_vacante").val(respuesta["hora_vacante"]);
			$("#codigo_agente_vacante").val(respuesta["codigo_agente_vacante"]);
			$("#nombre_agente_vacante").val(respuesta["nombre_agente_vacante"]);
			$("#posicion_vacante").val(respuesta["posicion_vacante"]);

			$("#estado_vacante").val(respuesta["estado_vacante"]);
			
			$("#fecha_cobertura_vacante").val(respuesta["fecha_cobertura_vacante"]);
			$("#hora_cobertura_vacante").val(respuesta["hora_cobertura_vacante"]);
			$("#nombre_ubicacion_vacante").val(respuesta["nombre_ubicacion_vacante"]);

			/* *************************** */
			$("#fecha_cubrir_vacante").val(respuesta["fecha_cubrir_vacante"]);
			/* $("#hora_cubrir_vacante").val(respuesta["hora_cubrir_vacante"]); */
			var hoy = new Date();
			var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
			function formatTime(timeString) {
				const [hourString, minute] = timeString.split(":");
				const hour = +hourString % 24;
				return  ('0' + (hour % 12 || 12)).slice(-2) + ":" + ('0' + minute).slice(-2)  + (hour < 12 ? "" : "");
			}
			$("#hora_cubrir_vacante").val(formatTime(hora));



			$("#accion_cubrir_vacante").val(respuesta["accion_cubrir_vacante"]);
			$("#personal_cubrir_vacante").val(respuesta["codigo_empleado_cubrir_vacante"]);
			$("#select2-codigo_empleado_cubrir_vacante-container").text(respuesta["codigo_empleado_cubrir_vacante"]+'-'+respuesta["nombre_empleado_cubrir_vacante"]);
			$("#nombre_empleado_cubrir_vacante").val(respuesta["nombre_empleado_cubrir_vacante"]);

			$("#ubicacion_cubrir_vacante").val(respuesta["codigo_ubicacion_cubrir_vacante"]);
			$("#select2-codigo_ubicacion_cubrir_vacante-container").text(respuesta["codigo_ubicacion_cubrir_vacante"]+'-'+respuesta["nombre_ubicacion_cubrir_vacante"]);
			$("#nombre_ubicacion_cubrir_vacante").val(respuesta["nombre_ubicacion_cubrir_vacante"]);
		





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
	    url:"ajax/vacante.ajax.php",
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
$(".tablas").on("click", ".btnEliminarvacante", function(){

  var idvacante = $(this).attr("idvacante");
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

      window.location = "index.php?ruta=vacante&idvacante="+idvacante+"&Codigo="+Codigo;

    }

  })

})




