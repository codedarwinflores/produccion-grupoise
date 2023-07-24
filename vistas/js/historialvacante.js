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
	$("#hora_historialvacante").val(formatTime(hora) );
		  
});


$(".agregar").click(function(){
	$(".guardar_historial").attr("accion","insertar");
});
$(".guardar_historial").click(function(){
		var valor=$(this).attr("accion");
		guardarregistro(valor);
});


/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarhistorial", function(){

	var idhistorialvacante = $(this).attr("idhistorialvacante");
	var accion = "eliminar";
  
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

				/*  ******** */
				var parametros = {
					"id" : idhistorialvacante,
					"accion" : accion
					};
				$.ajax({
				url:"ajax/historialvacante.ajax.php",
				method: "POST",
				data: parametros,
				success: function(respuesta){
								/* window.location = "situacion"; */
								location.reload();
					
				}
				});
				/* ********** */
  
	  }
  
	})
  
  })


  $(".tablas").on("click", ".btnEditarhistorial", function(){
	var idhistorialvacante = $(this).attr("idhistorialvacante");
	var accion = "obtenerdata";
	/*  ******** */
	var parametros = {
		"id" : idhistorialvacante,
		"accion" : accion
		};
	$.ajax({
	url:"ajax/historialvacante.ajax.php",
	method: "POST",
	data: parametros,
	success: function(respuesta){
		var datos = JSON.parse(respuesta);

		/* datos[0].codigo_empleado_planilladevengo_vacacion */

		$("#id").val(datos[0].id);
		$("#id_vacante_historialvacante").val(datos[0].id_vacante_historialvacante);
		$("#fecha_historialvacante").val(datos[0].fecha_historialvacante);
		$("#hora_historialvacante").val(datos[0].hora_historialvacante);
		$("#accion_historialvacante").val(datos[0].accion_historialvacante);
		$("#personal_cubrir_vacante").val(datos[0].id_empleado_historialvacante);/* --este es el id pero por este nombre se resgitra */
		$("#select2-codigo_empleado_cubrir_vacante-container").text(datos[0].codigo_empleado_historialvacante+"-"+datos[0].nombre_empleado_historialvacante);
		$("#codigo_empleado_historialvacante").val(datos[0].codigo_empleado_historialvacante);
		$("#nombre_empleado_historialvacante").val(datos[0].nombre_empleado_historialvacante);

		$("#ubicacion_cubrir_vacante").val(datos[0].id_ubicacion_historialvacante);/* --este es el id pero por este nombre se resgitra */
		$("#select2-codigo_ubicacion_cubrir_vacante-container").text(datos[0].codigo_ubicacion_historialvacante+"-"+datos[0].nombre_ubicacion_historialvacante);
		$("#codigo_ubicacion_historialvacante").val(datos[0].codigo_ubicacion_historialvacante);
		$("#nombre_ubicacion_historialvacante").val(datos[0].nombre_ubicacion_historialvacante);
		$("#comentario_historialvacante").val(datos[0].comentario_historialvacante);
		$(".guardar_historial").attr("accion","modificar");
	
					
		
	}
	});
	/* ********** */

  })

function guardarregistro(accion){

	var id = $("#id").val();
	var id_vacante_historialvacante = $("#id_vacante_historialvacante").val();
	var fecha_historialvacante = $("#fecha_historialvacante").val();
	var hora_historialvacante = $("#hora_historialvacante").val();
	var accion_historialvacante = $("#accion_historialvacante").val();
	var id_empleado_historialvacante = $("#codigo_empleado_cubrir_vacante").val();/* --este es el id pero por este nombre se resgitra */
	var codigo_empleado_historialvacante = $("#codigo_empleado_historialvacante").val();
	var nombre_empleado_historialvacante = $("#nombre_empleado_historialvacante").val();
	var id_ubicacion_historialvacante = $("#codigo_ubicacion_cubrir_vacante").val();/* --este es el id pero por este nombre se resgitra */
	var codigo_ubicacion_historialvacante = $("#codigo_ubicacion_historialvacante").val();
	var nombre_ubicacion_historialvacante = $("#nombre_ubicacion_historialvacante").val();
	var comentario_historialvacante = $("#comentario_historialvacante").val();

	/*  ******** */
	var parametros = {
		"id" : id,
		"id_vacante_historialvacante" : id_vacante_historialvacante,
		"fecha_historialvacante" : fecha_historialvacante,
		"hora_historialvacante" : hora_historialvacante,
		"accion_historialvacante" : accion_historialvacante,
		"id_empleado_historialvacante" : id_empleado_historialvacante,
		"codigo_empleado_historialvacante" : codigo_empleado_historialvacante,
		"nombre_empleado_historialvacante" : nombre_empleado_historialvacante,
		"id_ubicacion_historialvacante" : id_ubicacion_historialvacante,
		"codigo_ubicacion_historialvacante" : codigo_ubicacion_historialvacante,
		"nombre_ubicacion_historialvacante" : nombre_ubicacion_historialvacante,
		"comentario_historialvacante" : comentario_historialvacante,
		"accion" : accion
	    };
	
	$.ajax({
	   url:"ajax/historialvacante.ajax.php",
	   method: "POST",
	   data: parametros,
	   success: function(respuesta){
		if($.trim(respuesta)=="ok"){
			swal({
				type: "success",
				title: "Guardado con Exito",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
	
			}).then(function (result) {
				if (result.value) {
					/* window.location = "situacion"; */
					location.reload();
					
				}
			});
		}

	   }
   });
	/* ********** */
}












