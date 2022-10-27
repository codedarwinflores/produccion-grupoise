/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");
	$(".grupopedido_fecha_pedido").empty();
	$(".egrupopedido_fecha_pedido").empty();


	$(".grupopedido_id_proveedor").empty();
	$('.grupopedido_id_proveedor').append($('.proveedor_pedido_s'));

	$(".egrupopedido_id_proveedor").empty();
	$('.egrupopedido_id_proveedor').append($('.eproveedor_pedido_s'));




	
	$(".icono_monto").addClass("fa fa-money");
	$(".input_monto").attr("placeholder", texto+" Monto");
	$(".input_monto").get(0).type = 'number';
	$(".input_monto").attr("step", "0.01");

	




 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarpedido", function(){

	
	var idpedido = $(this).attr("idpedido");
	
	var datos = new FormData();
	datos.append("idpedido", idpedido);

	$.ajax({

		url:"ajax/pedido.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			
	var date0 = respuesta["fecha_pedido"];

	var formattedDate = new Date(date0); 
	var d = formattedDate.getDate()+1; 
	var m = formattedDate.getMonth(); m += 1;
	m += 1; // javascript months are 0-11 
	var y = formattedDate.getFullYear();

			$("#mascarafecha").val(d+'-'+m+'-'+y);
			$("#editarid").val(respuesta["idpedido"]);
			$("#editarfecha_pedido").val(respuesta["fecha_pedido"]);
			$("#editarid_proveedor").val(respuesta["id_proveedor"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarmonto").val(respuesta["monto"]);



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
	    url:"ajax/pedido.ajax.php",
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
$(".tablas").on("click", ".btnEliminarpedido", function(){

  var idpedido = $(this).attr("idpedido");
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

      window.location = "index.php?ruta=pedido&idpedido="+idpedido+"&Codigo="+Codigo;

    }

  })

})




