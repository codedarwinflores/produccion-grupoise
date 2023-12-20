/* COLOCACION DE ICONOS */
$(document).ready(function(){


	
	$("#editarestado_retiro").change(function(){
		if($(this).val()=="Activar"){
			$("#editarfecha_contratacion_retiro").val("");
			$("#editarfecha_contratacion_retiro").removeAttr("disabled");
			$(".gruporetiro_fecha_contratacion_retiro").removeAttr("style");

			/* alert("Si desea Activar el empleado asigne Fecha de Contratación"); */

			/* swal({
				title: 'Alerta',
				text: "Si desea Activar el empleado asigne Fecha de Contratación",
				type: 'warning'
			  }) */
			// Captura la fecha actual
			var fechaActual = new Date();
      
			// Obtiene día, mes y año
			var dia = fechaActual.getDate();
			var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript son base 0
			var anio = fechaActual.getFullYear(); // Solo los últimos dos dígitos del año
	  
			// Formatea para asegurarse de que tengan dos dígitos
			if (dia < 10) {
			  dia = "0" + dia;
			}
			if (mes < 10) {
			  mes = "0" + mes;
			}
			if (anio < 10) {
			  anio = "0" + anio;
			}
	  
			// Crea la fecha en el formato "dd-mm-yy"
			var fechaFormateada = dia + "-" + mes + "-" + anio;
	  
			$("#editarfecha_contratacion_retiro").val(fechaFormateada);
		
		}
	});


 })

 $( ".modificar_retiro" ).click(function() {

	var fecha_contratacion=$(".input_fecha_contratacion_retiro").val();
	var estado_contratacion=$(".input_estado_retiro").val();
   /*  ******** */
   var parametros = {
	"nombres" : nombres,
	"apellido1" : apellido1,
	"apellido2" : apellido2,
	"duis" : duis

};
$.ajax({
		data:  parametros,
		url:"ajax/verificarempleado.ajax.php",
		type:  'post',
		success:  function (response) {
			if(response=="1"){
				alert("ERROR: POR FAVOR VERIFIQUE EN LISTA DE PERSONAL NO CONTRATABLE");
				$(".numerodui").val("");
			}
		}
});
/* ********* */


});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarretiro", function(){

	



	var idretiro = $(this).attr("idretiro");
	
	var datos = new FormData();
	datos.append("idretiro", idretiro);

	$.ajax({

		url:"ajax/retiro.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarnombre_retiro").val(respuesta["nombre_retiro"]);
			$("#editarubicacion_retiro").val(respuesta["ubicacion_retiro"]);
			$("#editarcausa_retiro").val(respuesta["causa_retiro"]);
			$("#editarfecha_contratacion_retiro").val(respuesta["fecha_contratacion_retiro"]);
			$("#editarfecha_retiro").val(respuesta["fecha_retiro"]);
			$("#editarhoras_extras_pentientes_retiro").val(respuesta["horas_extras_pentientes_retiro"]);
			$("#editarhoras_llegadas_tardes_retiro").val(respuesta["horas_llegadas_tardes_retiro"]);
			$("#editardescuento_tarde_retiro").val(respuesta["descuento_tarde_retiro"]);
			$("#editarobservaciones_retiro").val(respuesta["observaciones_retiro"]);
			$("#editaridempleado_retiro").val(respuesta["idempleado_retiro"]);
			$("#editarestado_retiro").val(respuesta["estado_retiro"]);
			
			$("#editarmotivo_inactivo").val(respuesta["motivo_inactivo"]);
			$("#editarmotivo_inactivo").val(respuesta["motivo_inactivo"]).trigger('change.select2');






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
	    url:"ajax/retiro.ajax.php",
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
$(".tablas").on("click", ".btnEliminarretiro", function(){

  var idretiro = $(this).attr("idretiro");
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

      window.location = "index.php?ruta=retiro&idretiro="+idretiro+"&Codigo="+Codigo;

    }

  })

})




