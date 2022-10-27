/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupopago_operador").empty();
	$('.grupopago_operador').append($('#nuevooperador'));

	$(".egrupopago_operador").empty();
	$('.egrupopago_operador').append($('#editaroperadordiv'));


	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarpago", function(){

	
	var idpago = $(this).attr("idpago");
	
	var datos = new FormData();
	datos.append("idpago", idpago);

	$.ajax({

		url:"ajax/pago.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			
	var date0 = respuesta["fechapago"];

	var formattedDate = new Date(date0); 
	var d = formattedDate.getDate()+1; 
	var m = formattedDate.getMonth(); m += 1;
	m += 1; // javascript months are 0-11 
	var y = formattedDate.getFullYear();

			$("#editarfecha2").val(d+'-'+m+'-'+y);

			
			$("#editarid").val(respuesta["idpago"]);
			$("#editarabono").val(respuesta["abono"]);
			$("#editarid_pedido").val(respuesta["idpedido"]);
			$("#editarsaldo_anterior").val(respuesta["saldo_anterior"]);
			$("#editarsaldo_actual").val(respuesta["saldo_actual"]);
			$("#editarfecha").val(respuesta["fechapago"]);




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
	    url:"ajax/pago.ajax.php",
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
$(".tablas").on("click", ".btnEliminarpago", function(){

  var id = $(this).attr("id");
  var idpago = $(this).attr("idpago");
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

      window.location = "index.php?ruta=pago&id="+id+"&idpago="+idpago+"&Codigo="+Codigo;

    }

  })

})




