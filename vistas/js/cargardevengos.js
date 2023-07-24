


$( ".btnDescuentos" ).click(function() {

	//asignar el valor al hidden del form parentesco
	var idEmpleadoDescuento = $(this).attr("idEmpleado");	
	document.getElementById("idEmpleadoDescuento").value = idEmpleadoDescuento; 
	
	
	//mostrar los datos generales de empleado con ajax
	//tambien traer los parientes ya registrados en <html>
	
	var datosEmpleadoDescuento = new FormData();
	datosEmpleadoDescuento.append("id_empleado", idEmpleadoDescuento);
	$.ajax({
	    url:"ajax/empleados_descuento.ajax.php",
	    method:"POST",
	    data: datosEmpleadoDescuento,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "text",
	    success:function(respuestaEmpleadosDescuento){

          
	    	/* document.getElementById("headerEmpleadoDescuento").innerHTML = respuestaEmpleadosDescuento; */
            $("#headerEmpleadoDescuento").empty();
            $("#headerEmpleadoDescuento").append(respuestaEmpleadosDescuento);
			$(".calendario").ionDatePicker({
				lang: "es"
			   });

	    }

	})
	

});


