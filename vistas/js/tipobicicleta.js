/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".binput_id").removeAttr("required");

	/* 
	$("#beditarcodigo").get(0).type = 'number';
	$(".binput_codigo").get(0).type = 'number'; */

	$(".binput_codigo").attr("placeholder", texto+" Código");
	$(".binput_nombre").attr("placeholder", texto+" Nombre");


              /* *********LABEL*********** */
			  var binput_codigo = $(".binput_codigo").attr("placeholder");
			  $(".blabel_codigo").text(binput_codigo);

		  
              /* *********LABEL*********** */
			  var binput_nombre = $(".binput_nombre").attr("placeholder");
			  $(".blabel_nombre").text(binput_nombre);

		  


 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartipobicicleta", function(){

	
	var idtipobicicleta = $(this).attr("idtipobicicleta");
	
	var datos = new FormData();
	datos.append("idtipobicicleta", idtipobicicleta);

	$.ajax({

		url:"ajax/tipobicicleta.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			

			$("#beditarid").val(respuesta["id"]);
			$("#beditarcodigo").val(respuesta["codigo"]);
			$("#beditarnombre").val(respuesta["nombre"]);


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
	    url:"ajax/tipobicicleta.ajax.php",
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
$(".tablas").on("click", ".btnEliminartipobicicleta", function(){

  var idtipobicicleta = $(this).attr("idtipobicicleta");
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

      window.location = "index.php?ruta=tipobicicleta&idtipobicicleta="+idtipobicicleta+"&Codigo="+Codigo;

    }

  })

})




