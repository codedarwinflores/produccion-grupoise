/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".mostrarformulario").click(function(){
		$(".formmodificar").attr("style","display:none");
		$(".formagregar").attr("style","display:block");
	});

	$(".guardartodo").click(function(){

		var idaumento=$("#idaumento").val();
		var facturar=$("#select2-nuevofacturar-ij-container").text();
		var codigo_ubicacion_aumento=$("#codigo_ubicacion_aumento").val();
		var supervisor_aumento=$("#supervisor_aumento").val();

		

		/* ******** */
			
			var parametros = {
				"idaumento" : idaumento,
				"facturar" : facturar,
				"codigo_ubicacion_aumento" : codigo_ubicacion_aumento,
				"supervisor_aumento" : supervisor_aumento,

			};
			$.ajax({
					data:  parametros,
					url:"ajax/facturaraumento.ajax.php",
					type:  'post',
					success:  function (response) {
					
						/* console.log(response); */
					
					}
				});

	/*  ******** */

 	})


	 $(".guardarmodficar").click(function(){

		var idaumento=$("#idaumento").val();
		var facturar=$("#select2-editarfacturar-container").text();
		var codigo_ubicacion_aumento=$("#codigo_ubicacion_aumento").val();
		var supervisor_aumento=$("#supervisor_aumento").val();


		/* ******** */
			
			var parametros = {
				"idaumento" : idaumento,
				"facturar" : facturar,
				"codigo_ubicacion_aumento" : codigo_ubicacion_aumento,
				"supervisor_aumento" : supervisor_aumento,

			};
			$.ajax({
					data:  parametros,
					url:"ajax/facturaraumento.ajax.php",
					type:  'post',
					success:  function (response) {
					
						/* alert(response);
						console.log(response); */
					}
				});

	/*  ******** */

 	})

})

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartbl_ubicaciones_detalle", function(){


	
	
	$(".formmodificar").attr("style","display:block");
	$(".formagregar").attr("style","display:none");

	var idtbl_ubicaciones_detalle = $(this).attr("idtbl_ubicaciones_detalle");
	
	var datos = new FormData();
	datos.append("idtbl_ubicaciones_detalle", idtbl_ubicaciones_detalle);

	$.ajax({

		url:"ajax/detalleubicacion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			




			$("#editarid").val(respuesta["id"]);
			$("#editarnumero_hombres").val(respuesta["numero_hombres"]);
			$("#editarprecio").val(respuesta["precio"]);
			$("#editarvalor").val(respuesta["valor"]);
			$("#editartotal").val(respuesta["total"]);

			$("#seleccionfactura").val(respuesta["facturar"]);
			$("#select2-editarfacturar-container").text(respuesta["facturar"]);

			$("#editartipo_documento").val(respuesta["tipo_documento"]);
			$("#editarforma_pago").val(respuesta["forma_pago"]);
			$("#editarnosumahs").val(respuesta["nosumahs"]);
			$("#editarconcepto").val(respuesta["concepto"]);
			$("#editarporcentaje_detalle").val(respuesta["porcentaje_detalle"]);
			/* $("#editaridubicacion").val(respuesta["idubicacion"]);
 */
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
	    url:"ajax/tbl_ubicaciones_detalle.ajax.php",
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
$(".tablas").on("click", ".btnEliminartbl_ubicaciones_detalle", function(){

  var idtbl_ubicaciones_detalle = $(this).attr("idtbl_ubicaciones_detalle");
  var codigo = $(this).attr("codigo");

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

      window.location = "index.php?ruta=detalleubicacion&idtbl_ubicaciones_detalle="+idtbl_ubicaciones_detalle+"&codigo="+codigo;

    }

  })

})




