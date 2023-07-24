/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".personalinput_id").removeAttr("required");

	$(".personalinput_codigo").attr("placeholder", texto+" Código");
	$(".epersonalinput_codigo").attr("placeholder", texto+" Código");


	
	$(".icono_operador").addClass("fa fa-server");
	$(".personalinput_nombre").attr("placeholder", texto+" Nombre");
/* 	$(".personalinput_nombre").get(0).type = 'number';
	$(".epersonalinput_nombre").get(0).type = 'number';
 */

	$(".tipo_movimiento_personal").empty();
	$(".devolucion").empty();
	$(".numero_transaccion_personal").empty();
	$(".cubrir_vacante").empty();



              /* *********LABEL*********** */
			  var personalinput_codigo = $(".personalinput_codigo").attr("placeholder");
			  $(".personallabel_codigo").text(personalinput_codigo);

		  
              /* *********LABEL*********** */
			  var personalinput_nombre = $(".personalinput_nombre").attr("placeholder");
			  $(".personallabel_nombre").text(personalinput_nombre);

		  

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartransaccionespersonal", function(){

	
	var idtransaccionespersonal = $(this).attr("idtransaccionespersonal");
	
	var datos = new FormData();
	datos.append("idtransaccionespersonal", idtransaccionespersonal);

	$.ajax({

		url:"ajax/transaccionespersonal.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo").val(respuesta["codigo"]);
			$("#editarnombre").val(respuesta["nombre"]);
			$("#editartipo_movimiento_personal").val(respuesta["tipo_movimiento_personal"]);
			$("#editardevolucion").val(respuesta["devolucion"]);
			$("#editarnumero_transacción_personal").val(respuesta["numero_transacción_personal"]);
			$("#editarcubrir_vacante").val(respuesta["cubrir_vacante"]);


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
	    url:"ajax/transaccionespersonal.ajax.php",
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
$(".tablas").on("click", ".btnEliminartransaccionespersonal", function(){

  var idtransaccionespersonal = $(this).attr("idtransaccionespersonal");
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

      window.location = "index.php?ruta=transaccionespersonal&idtransaccionespersonal="+idtransaccionespersonal+"&Codigo="+Codigo;

    }

  })

})




