/* COLOCACION DE ICONOS */
$(document).ready(function(){

	let params = new URLSearchParams(location.search);
	var id = params.get('id');

	$(".input_codigo_empleado_descuento").val(id);

	 /*  ******** */
	 var parametros = {
		"id" : id
	};
	$.ajax({
			data:  parametros,
			url:"ajax/formretiro.ajax.php",
			type:  'post',
			success:  function (response) {
				$(".input_empleado_descuento").val(response);
			}
	});

	
	$.ajax({
		data:  parametros,
		url:"ajax/generarcodigodescuento.ajax.php",
		type:  'post',
		success:  function (response) {
		
			$(".input_numero_recibo_descuento").val(response);
		}
	});
	/* ********* */

	
			

			$.ajax({

			   url:"ajax/descuento_show.ajax.php",
			   method: "POST",
			   data: parametros,
			   success: function(respuesta){

				   $("#uniformedescuento").html(respuesta)
	   
	   
	   
			   }
	   
		   });

		   
			/* ********** */


	$(".input_codigo_uni_descuento").change(function(){
		var t = $('option:selected', this).attr('des1');
	

		$(".input_descuento").val(t);
	});



 
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditaruniformedescuento", function(){

	
	var iduniformedescuento = $(this).attr("iduniformedescuento");
	
	var datos = new FormData();
	datos.append("iduniformedescuento", iduniformedescuento);

	$.ajax({

		url:"ajax/uniformedescuento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["iddescuento"]);
			$("#editarfecha_descuento").val(respuesta["fecha_descuento"]);
			$("#editarcodigo_empleado_descuento").val(respuesta["codigo_empleado_descuento"]);
			$("#nombreempleado").val(respuesta["primer_nombre"]+' '+respuesta["segundo_nombre"]+' '+respuesta["primer_apellido"]);
			$("#editarcodigo_uni_descuento").val(respuesta["codigo_uni_descuento"]);
			$("#descuento").val(respuesta["descripcion"]);
			$("#editarnumero_recibo_descuento").val(respuesta["numero_recibo_descuento"]);
			$("#editarvalor_descuento").val(respuesta["valor_descuento"]);
			$("#editarobservacion_descuento").val(respuesta["observacion_descuento"]);



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
	    url:"ajax/uniformedescuento.ajax.php",
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
$(".tablas").on("click", ".btnEliminaruniformedescuento", function(){

  var iduniformedescuento = $(this).attr("iduniformedescuento");
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

      window.location = "index.php?ruta=uniformedescuento&iduniformedescuento="+iduniformedescuento+"&id="+Codigo;

    }

  })

})




