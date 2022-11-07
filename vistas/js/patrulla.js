/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");
/* 	$(".id_patrulla  ").attr("style","display:none");

 */

	
	$(".icono_codigo_patrulla").addClass("fa fa-qrcode");
	$(".input_codigo_patrulla").attr("placeholder", texto+" Código");

	
	$(".icono_descripcion_patrulla").addClass("fa fa-file");
	$(".input_descripcion_patrulla").attr("placeholder", texto+" Descripción");

	
	$(".icono_id_jefe_operaciones_patrulla").addClass("fa fa-users");
	$(".input_id_jefe_operaciones_patrulla").attr("placeholder", texto+" Jefe de Operaciones");


              /* *********LABEL*********** */
			  var input_codigo_patrulla = $(".input_codigo_patrulla").attr("placeholder");
			  $(".label_codigo_patrulla").text(input_codigo_patrulla);

		  
              /* *********LABEL*********** */
			  var input_descripcion_patrulla = $(".input_descripcion_patrulla").attr("placeholder");
			  $(".label_descripcion_patrulla").text(input_descripcion_patrulla);

		  
              /* *********LABEL*********** */
			  var input_id_jefe_operaciones_patrulla = $(".input_id_jefe_operaciones_patrulla").attr("placeholder");
			  $(".label_id_jefe_operaciones_patrulla").text(input_id_jefe_operaciones_patrulla);

		  

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarpatrulla", function(){

	
	var idpatrulla = $(this).attr("idpatrulla");
	
	var datos = new FormData();
	datos.append("idpatrulla", idpatrulla);

	$.ajax({

		
		url:"ajax/patrulla.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo_patrulla").val(respuesta["codigo_patrulla"]);
			$("#editardescripcion_patrulla").val(respuesta["descripcion_patrulla"]);
			$("#editarid_jefe_operaciones_patrulla").val(respuesta["id_jefe_operaciones_patrulla"]);



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
	    url:"ajax/patrulla.ajax.php",
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
$(".tablas").on("click", ".btnEliminarpatrulla", function(){

  var idpatrulla = $(this).attr("idpatrulla");
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

      window.location = "index.php?ruta=patrulla&idpatrulla="+idpatrulla+"&Codigo="+Codigo;

    }

  })

})




