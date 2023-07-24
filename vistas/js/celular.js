/* COLOCACION DE ICONOS */
$(document).ready(function(){




	$(".empleadoseleccionar").change(function(){
		var valor=$(this).val();
		$(".codigo_nombre_empleado").val(valor);
	
});


$("#nimei").removeAttr("readonly");

	
              /* *********LABEL*********** */
			  var input_descripcion = $(".input_descripcion").attr("placeholder");
			  $(".label_descripcion").text(input_descripcion);

		  
              /* *********LABEL*********** */
			  var input_costo = $(".input_costo").attr("placeholder");
			  $(".label_costo").text(input_costo);

			  
              /* *********LABEL*********** */
			  var input_numero = $(".input_numero").attr("placeholder");
			  $(".label_numero").text(input_numero);

		  
			  $(document).on('change', '#nuevoscelular_sim', function(event) {

				var operador=$("#nuevoscelular_sim option:selected").attr("operador");
				var imei=$("#nuevoscelular_sim option:selected").attr("imei");
				$('#noperador').val(operador);
				$('#nimei').val(imei);
		   });

		   
		   $(document).on('change', '#editarsim', function(event) {

			var operador=$("#editarsim option:selected").attr("operador");
			var imei=$("#editarsim option:selected").attr("imei");
			$('#eoperador').val(operador);
			$('#eimei').val(imei);
	   });


	   	/* *********LABEL*********** */
		   $(".icono_fecha_asignacion_celular").addClass("fa fa-file-excel-o")
		   $(".input_fecha_asignacion_celular").attr("placeholder","Ingresar Fecha de Asignación Celular");
		   $(".input_fecha_asignacion_celular").attr("readonly","readonly");
		   $(".input_fecha_asignacion_celular").addClass("calendario");
		   var input_fecha_asignacion_celular  = $(".input_fecha_asignacion_celular").attr("placeholder");
		   $(".label_fecha_asignacion_celular").text(input_fecha_asignacion_celular);


		    	/* *********LABEL*********** */
				$(".grupocelular_codigo_nombre_empleado_celular").empty();
				$(".grupocelular_codigo_nombre_empleado_celular").append($("#grupocelular_codigo_nombre_empleado_celular"));


				/* *********LABEL*********** */
				$(".egrupocelular_codigo_nombre_empleado_celular").empty();
				$(".egrupocelular_codigo_nombre_empleado_celular").append($("#egrupocelular_codigo_nombre_empleado_celular"));

		
	   	/* *********LABEL*********** */
		   $(".icono_plan_datos_celular").addClass("fa fa-file-excel-o")
		   $(".input_plan_datos_celular").attr("placeholder","Ingresar Plan de datos Celular");
		   var input_plan_datos_celular  = $(".input_plan_datos_celular").attr("placeholder");
		   $(".label_plan_datos_celular").text(input_plan_datos_celular);

		  

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarcelular", function(){

	
	var idcelular = $(this).attr("idcelular");
	
	var datos = new FormData();
	datos.append("idcelular", idcelular);

	$.ajax({

		url:"ajax/celular.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idcelular"]);
			$("#editarcodigo").val(respuesta["codigocelular"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarcosto").val(respuesta["costo"]);
			$("#editarnumero").val(respuesta["numero"]);
			$("#editarsim").val(respuesta["idsim"]);
			$("#eimei").val(respuesta["IMEI"]);
			$("#eoperador").val(respuesta["operador"]);
			$("#editarmarca").val(respuesta["marca"]);
			$("#editarmodelo").val(respuesta["modelo"]);
			$("#editarcolor").val(respuesta["color"]);
			$("#editartipocelular").val(respuesta["idtipocelular"]);

			$("#editarfecha_asignacion_celular").val(respuesta["fecha_asignacion_celular"]);
			$(".codigo_nombre_empleado").val(respuesta["codigo_nombre_empleado_celular"]);
			
			$("#editarplan_datos_celular").val(respuesta["plan_datos_celular"]);
			$("#editarobservacion_celular").val(respuesta["observacion_celular"]);



			$("#seleccionar_empleado_celular").attr("value",respuesta["codigo_nombre_empleado_celular"]);
			$("#select2-editarcodigo_nombre_empleado_celular-container").text(respuesta["codigo_nombre_empleado_celular"]);


			$("#editaroperador_celular").val(respuesta["operador_celular"]);
			$("#editarimei_celular").val(respuesta["imei_celular"]);



		}

	});

})


/*=============================================
detalle 
=============================================*/
$(".tablas").on("click", ".btndetalles", function(){

	
	var idcelular = $(this).attr("idcelular");
	
	var datos = new FormData();
	datos.append("idcelular", idcelular);

	$.ajax({

		url:"ajax/celular.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

			$(".fecha_asignacion").text("Fecha de Asignación: "+respuesta["fecha_asignacion_celular"]);
			$(".codigo_nombre_empleado").text("Código y Nombre de Empleado: "+respuesta["codigo_nombre_empleado_celular"]);
			$(".plan_datos").text("Plan de Datos: "+respuesta["plan_datos_celular"]);



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
	    url:"ajax/celular.ajax.php",
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
$(".tablas").on("click", ".btnEliminarcelular", function(){

  var idcelular = $(this).attr("idcelular");
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

      window.location = "index.php?ruta=celular&idcelular="+idcelular+"&Codigo="+Codigo;

    }

  })

})




