/* COLOCACION DE ICONOS */
$(document).ready(function(){

	$(".agregar_situacion").attr("disabled","disabled");
		  

	$( ".inputtable" ).blur(function() {
		var valor=$(this).val();
		var idinput_seleccionado=$(this).attr("id");

		if(valor>0){

			$(".tabla_situacion tr td input").each(function() {
				var id_inputs = $(this).attr("id");
				if(idinput_seleccionado != id_inputs){
					$(this).attr("readonly","readonly");
				}

			  });
		}else{

		}

	  });


 })







 
$( ".nombreempleado_situacion" ).click(function() {
	
	$(".agregar_situacion").removeAttr("disabled");

	var valor = $(this).attr("nombre");
	var consultar = "consultar";


	$("#idempleado_situacion").val(valor);
    var id = "";
	var idempleado_situacion = $("#idempleado_situacion").val();
	var dias_ausencia_situacion = "";
	var horas_ausencia_situacion = "";
	var consulta_isss_situacion = "";
	var incapacidad_situacion = "";
	var ansp_situacion = "";
	var vacaciones_situacion = "";
	var permiso_situacion = "";
	var hora_normales_situacion = "";
	var tiempo_compensatorio_situacion = "";
	var recuperar_tiempo_situacion = "";
	var comodin_situacion = "";
	var cubierto_situacion = "";
	var nuevo_servicio_situacion = "";
	var fin_servicio_situacion = "";
	var ubicacion_situacion = "";
	var servicio_eventual_situacion = "";
	var inactivos_situacion = "";
	var activo_situacion = "";
	var liquidado_situacion = "";
	var inicial_situacion = "";
	var hora_extra_situacion = "";
	var vacante_situacion = "";
	var posicion_situacion = "";
	var fecha_situacion = "";
	var accion = consultar;

	 /*  ******** */
	 var parametros = {
		"id" : id,
		"idempleado_situacion" : idempleado_situacion,
		"dias_ausencia_situacion" : dias_ausencia_situacion,
		"horas_ausencia_situacion" : horas_ausencia_situacion,
		"consulta_isss_situacion" : consulta_isss_situacion,
		"incapacidad_situacion" : incapacidad_situacion,
		"ansp_situacion" : ansp_situacion,
		"vacaciones_situacion" : vacaciones_situacion,
		"permiso_situacion" : permiso_situacion,
		"hora_normales_situacion" : hora_normales_situacion,
		"tiempo_compensatorio_situacion" : tiempo_compensatorio_situacion,
		"recuperar_tiempo_situacion" : recuperar_tiempo_situacion,
		"comodin_situacion" : comodin_situacion,
		"cubierto_situacion" : cubierto_situacion,
		"nuevo_servicio_situacion" : nuevo_servicio_situacion,
		"fin_servicio_situacion" : fin_servicio_situacion,
		"ubicacion_situacion" : ubicacion_situacion,
		"servicio_eventual_situacion" : servicio_eventual_situacion,
		"inactivos_situacion" : inactivos_situacion,
		"activo_situacion" : activo_situacion,
		"liquidado_situacion" : liquidado_situacion,
		"inicial_situacion" : inicial_situacion,
		"hora_extra_situacion" : hora_extra_situacion,
		"vacante_situacion" : vacante_situacion,
		"posicion_situacion" : posicion_situacion,
		"fecha_situacion" : fecha_situacion,
		"accion" : accion
	};

	var dataString = 'id='+id+'&idempleado_situacion='+idempleado_situacion+'&dias_ausencia_situacion='+dias_ausencia_situacion+'&horas_ausencia_situacion='+horas_ausencia_situacion+'&consulta_isss_situacion='+consulta_isss_situacion+'&incapacidad_situacion='+incapacidad_situacion+'&ansp_situacion='+ansp_situacion+'&vacaciones_situacion='+vacaciones_situacion+'&permiso_situacion='+permiso_situacion+'&hora_normales_situacion='+hora_normales_situacion+'&tiempo_compensatorio_situacion='+tiempo_compensatorio_situacion+'&recuperar_tiempo_situacion='+recuperar_tiempo_situacion+'&comodin_situacion='+comodin_situacion+'&cubierto_situacion='+cubierto_situacion+'&nuevo_servicio_situacion='+nuevo_servicio_situacion+'&fin_servicio_situacion='+fin_servicio_situacion+'&ubicacion_situacion='+ubicacion_situacion+'&servicio_eventual_situacion='+servicio_eventual_situacion+'&inactivos_situacion='+inactivos_situacion+'&activo_situacion='+activo_situacion+'&liquidado_situacion='+liquidado_situacion+'&inicial_situacion='+inicial_situacion+'&hora_extra_situacion='+hora_extra_situacion+'&vacante_situacion='+vacante_situacion+'&posicion_situacion='+posicion_situacion+'&fecha_situacion='+fecha_situacion+'&accion='+accion;


	$.ajax({
			data:  dataString,
			url:"ajax/situacion.ajax.php",
			type:  'post',
			success:  function (response) {
				$("#cargar_data_situacion").empty();
				$("#cargar_data_situacion").append(response);
				$('.tablas').DataTable();

			}
	});
	/* ********* */


	

  });


  /* ********************* */

  $( ".agregar_situacion" ).click(function() {
	$("#accion").val("insertar");
  });

 /* ********************* */

 $( ".guardar_movimiento" ).click(function() {
	
    var id = $("#id").val();
	var idempleado_situacion = $("#idempleado_situacion").val();
	var dias_ausencia_situacion = $("#dias_ausencia_situacion").val();
	var horas_ausencia_situacion = $("#horas_ausencia_situacion").val();
	var consulta_isss_situacion = $("#consulta_isss_situacion").val();
	var incapacidad_situacion = $("#incapacidad_situacion").val();
	var ansp_situacion = $("#ansp_situacion").val();
	var vacaciones_situacion = $("#vacaciones_situacion").val();
	var permiso_situacion = $("#permiso_situacion").val();
	var hora_normales_situacion = $("#hora_normales_situacion").val();
	var tiempo_compensatorio_situacion = $("#tiempo_compensatorio_situacion").val();
	var recuperar_tiempo_situacion = $("#recuperar_tiempo_situacion").val();
	var comodin_situacion = $("#comodin_situacion").val();
	var cubierto_situacion = $("#cubierto_situacion").val();
	var nuevo_servicio_situacion = $("#nuevo_servicio_situacion").val();
	var fin_servicio_situacion = $("#fin_servicio_situacion").val();
	var ubicacion_situacion = $("#ubicacion_situacion").val();
	var servicio_eventual_situacion = $("#idservicio_eventual_situacion").val();
	var inactivos_situacion = $("#inactivos_situacion").val();
	var activo_situacion = $("#activo_situacion").val();
	var liquidado_situacion = $("#liquidado_situacion").val();
	var inicial_situacion = $("#inicial_situacion").val();
	var hora_extra_situacion = $("#hora_extra_situacion").val();
	var vacante_situacion = $("#vacante_situacion").val();
	var posicion_situacion = $("#posicion_situacion").val();
	var fecha_situacion = $("#fecha_situacion").val();
	var accion = $("#accion").val();

	 /*  ******** */
	
	var dataString = 'id='+id+'&idempleado_situacion='+idempleado_situacion+'&dias_ausencia_situacion='+dias_ausencia_situacion+'&horas_ausencia_situacion='+horas_ausencia_situacion+'&consulta_isss_situacion='+consulta_isss_situacion+'&incapacidad_situacion='+incapacidad_situacion+'&ansp_situacion='+ansp_situacion+'&vacaciones_situacion='+vacaciones_situacion+'&permiso_situacion='+permiso_situacion+'&hora_normales_situacion='+hora_normales_situacion+'&tiempo_compensatorio_situacion='+tiempo_compensatorio_situacion+'&recuperar_tiempo_situacion='+recuperar_tiempo_situacion+'&comodin_situacion='+comodin_situacion+'&cubierto_situacion='+cubierto_situacion+'&nuevo_servicio_situacion='+nuevo_servicio_situacion+'&fin_servicio_situacion='+fin_servicio_situacion+'&ubicacion_situacion='+ubicacion_situacion+'&servicio_eventual_situacion='+servicio_eventual_situacion+'&inactivos_situacion='+inactivos_situacion+'&activo_situacion='+activo_situacion+'&liquidado_situacion='+liquidado_situacion+'&inicial_situacion='+inicial_situacion+'&hora_extra_situacion='+hora_extra_situacion+'&vacante_situacion='+vacante_situacion+'&posicion_situacion='+posicion_situacion+'&fecha_situacion='+fecha_situacion+'&accion='+accion;


	$.ajax({
			data:  dataString,
			url:"ajax/situacion.ajax.php",
			type:  'post',
			success:  function (response) {
				
	
					swal({

						type: "success",
						title: "¡La situacion ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "situacion";

						}

					});
				
				
			}
	});
	/* ********* */


	

  });



/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarsim", function(){



})



/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarsim", function(){

})




