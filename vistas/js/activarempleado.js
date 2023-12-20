
 $( ".modificar_retiro" ).click(function() {


	var fecha_contratacion=$(".input_fecha_contratacion_retiro").val();
	var estado_contratacion=$(".input_estado_retiro").val();
	var id_empleado=$(".input_idempleado_retiro").val();
	if(estado_contratacion == "Activar"){
		$(".input_estado_retiro").attr("activacion","0");
		var numero_estado_contratacion=$(".input_estado_retiro").attr("activacion");
		/* alert(numero_estado_contratacion); */
	

		 /*  ******** */
		 var parametros = {
			"fecha_contratacion" : fecha_contratacion,
			"estado_contratacion" : numero_estado_contratacion,
			"id_empleado" : id_empleado
		
		
		};
		$.ajax({
				data:  parametros,
				url:"ajax/activarempleado.ajax.php",
				type:  'post',
				success:  function (response) {
					/* alert(response); */
				}
		});
		/* ********* */


	}
  



});
