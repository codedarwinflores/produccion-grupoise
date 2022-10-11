/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");;

	
	$(".icono_lugar").addClass("fa fa-globe");
	$(".input_lugar").attr("placeholder", texto+" Lugar");



 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarplantillas", function(){

	
	var idplantillas = $(this).attr("idplantillas");
	
	var datos = new FormData();
	datos.append("idplantillas", idplantillas);

	$.ajax({

		url:"ajax/plantillas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarnombre").val(respuesta["nombre"]);
			$("#editarlugar").val(respuesta["lugar"]);
			$("#editarcodigo").val(respuesta["codigo"]);



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
	    url:"ajax/plantillas.ajax.php",
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
$(".tablas").on("click", ".btnEliminarplantillas", function(){

  var idplantillas = $(this).attr("idplantillas");
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

      window.location = "index.php?ruta=planillas&idplantillas="+idplantillas+"&Codigo="+Codigo;

    }

  })

})




