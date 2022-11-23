/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$(".grupoajustes_operador").empty();
	$('.grupoajustes_operador').append($('#nuevooperador'));

	$(".egrupoajustes_operador").empty();
	$('.egrupoajustes_operador').append($('#editaroperadordiv'));



		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarajustes", function(){

	
	var idajustes = $(this).attr("idajustes");
	
	var datos = new FormData();
	datos.append("idajustes", idajustes);

	$.ajax({

		url:"ajax/ajustes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcode").val(respuesta["code"]);
			$("#editarname_table").val(respuesta["name_table"]);
			$("#editarelemento").val(respuesta["elemento"]);
			$("#editaraccion").val(respuesta["accion"]);



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
	    url:"ajax/ajustes.ajax.php",
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
$(".tablas").on("click", ".btnEliminarajustes", function(){

  var idajustes = $(this).attr("idajustes");
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

      window.location = "index.php?ruta=ajustes&idajustes="+idajustes+"&Codigo="+Codigo;

    }

  })

})




