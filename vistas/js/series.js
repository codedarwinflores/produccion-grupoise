/* COLOCACION DE ICONOS */
$(document).ready(function(){


alert(series);
		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarseries_ventas", function(){

	
	var idseries_ventas = $(this).attr("idseries_ventas");

	
	var datos = new FormData();
	datos.append("idseries_ventas", idseries_ventas);

	$.ajax({

		url:"ajax/series.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
	
			$("#editarid").val(respuesta["id"]);
			$("#editartipo_serie").val(respuesta["tipo_serie"]);
			$("#editarnum_serie").val(respuesta["num_serie"]);
			$("#editarcuenta_contable").val(respuesta["cuenta_contable"]);



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
	    url:"ajax/series_ventas.ajax.php",
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
$(".tablas").on("click", ".btnEliminarseries_ventas", function(){

  var idseries_ventas = $(this).attr("idseries_ventas");
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

      window.location = "index.php?ruta=series&idseries_ventas="+idseries_ventas+"&Codigo="+Codigo;

    }

  })

})




