/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarpersonal_no_contratable", function(){

	
	var idpersonal_no_contratable = $(this).attr("idpersonal_no_contratable");
	
	var datos = new FormData();
	datos.append("idpersonal_no_contratable", idpersonal_no_contratable);

	$.ajax({

		url:"ajax/personalnocontratable.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcorrelativo").val(respuesta["correlativo"]);
			$("#editarnombres").val(respuesta["nombres"]);
			$("#editarprimer_apellido").val(respuesta["primer_apellido"]);
			$("#editarsegundo_apellido").val(respuesta["segundo_apellido"]);
			$("#editardui").val(respuesta["dui"]);
			$("#editarfecha").val(respuesta["fecha"]);





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
	    url:"ajax/personal_no_contratable.ajax.php",
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
$(".tablas").on("click", ".btnEliminarpersonal_no_contratable", function(){

  var idpersonal_no_contratable = $(this).attr("idpersonal_no_contratable");
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

      window.location = "index.php?ruta=personalnocontratable&idpersonal_no_contratable="+idpersonal_no_contratable+"&Codigo="+Codigo;

    }

  })

})




