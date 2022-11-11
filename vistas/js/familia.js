/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");;

	
	$(".icono_correrlativo").addClass("fa fa-server");
	$(".input_correrlativo").attr("placeholder", texto+" Correlativo");

	$(".ocultarf_correrlativo").attr("style","visibility:hidden");
	$("#ocultarf_correrlativo").attr("style","visibility:hidden");

	
              /* *********LABEL*********** */
			  var input_correrlativo = $(".input_correrlativo").attr("placeholder");
			  $(".label_correrlativo").text(input_correrlativo);

		  
			  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarfamilia", function(){

	
	var idfamilia = $(this).attr("idfamilia");
	
	var datos = new FormData();
	datos.append("idfamilia", idfamilia);

	$.ajax({

		url:"ajax/familia.ajax.php",
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
			$("#editarcorrerlativo").val(respuesta["correrlativo"]);


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
	    url:"ajax/familia.ajax.php",
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
$(".tablas").on("click", ".btnEliminarfamilia", function(){

  var idfamilia = $(this).attr("idfamilia");
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

      window.location = "index.php?ruta=familia&idfamilia="+idfamilia+"&Codigo="+Codigo;

    }

  })

})




