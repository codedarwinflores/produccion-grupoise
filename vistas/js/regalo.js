/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");

	$(".input_fecha").addClass("calendario");
	$(".input_fecha").attr("placeholder", texto+" Fecha");
	$(".label_fecha").text( $(".input_fecha").attr("placeholder"));
	$(".icono_fecha").addClass("fa fa-calendar")

	$(".icono_cantidad").addClass("fa fa-percent");
	$(".input_cantidad").attr("placeholder", texto+" Cantidad");
	$(".label_cantidad").text( $(".input_cantidad").attr("placeholder"));
	$(".regalo_input_cantidad").get(0).type = 'number';

	$(".regalo_input_idempleado").get(0).type = 'hidden';
	$(".eregalo_input_idempleado").get(0).type = 'hidden';
	
	let params = new URLSearchParams(location.search);
	var id = params.get('id');
	$(".regalo_input_idempleado").val(id);
	$(".regalo_input_precio").attr("step","0.01");



	$(".gruporegalo_regalo_prenda").empty();
	$(".gruporegalo_regalo_prenda").append($(".insert_equipo"));


	$(".egruporegalo_regalo_prenda").empty();
	$(".egruporegalo_regalo_prenda").append($(".update_equipo"));


              /* *********LABEL*********** */
			  var input_operador = $(".input_operador").attr("placeholder");
			  $(".label_operador").text(input_operador);

		  
			  $(".input_codigo_empleado_descuento").val(id);

			  /*  ******** */
			  var parametros = {
				 "id" : id
			 };

			 $.ajax({

				url:"ajax/regalo_show.ajax.php",
				method: "POST",
				data: parametros,
				success: function(respuesta){

					$("#tablaregalo").html(respuesta)
		
		
		
				}
		
			});

			
			 /* ********** */

		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarregalo", function(){

	
	var idregalo = $(this).attr("idregalo");
	
	var datos = new FormData();
	datos.append("idregalo", idregalo);

	$.ajax({

		url:"ajax/regalo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarfecha").val(respuesta["fecha"]);
			$("#editarregalo_prenda2").val(respuesta["regalo_prenda"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarprecio").val(respuesta["precio"]);
			$("#editaridempleado").val(respuesta["idempleado"]);
			$("#editarcantidad").val(respuesta["cantidad"]);




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
	    url:"ajax/regalo.ajax.php",
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
$(".tablas").on("click", ".btnEliminarregalo", function(){

  var idregalo = $(this).attr("idregalo");
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

      window.location = "index.php?ruta=regalo&idregalo="+idregalo+"&id="+Codigo;

    }

  })

})




