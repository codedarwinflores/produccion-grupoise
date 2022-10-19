/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".tipovehiculo_input_id").removeAttr("required");;

	
	$(".icono_operador").addClass("fa fa-server");
	/* $("#editarnombre_tipo").get(0).type = 'number';
	$(".tipovehiculo_input_nombre_tipo").get(0).type = 'number'; */
	$(".tipovehiculo_input_codigo").attr("placeholder", texto+' Código');
	$(".tipovehiculo_input_nombre_tipo").attr("placeholder", texto+' Tipo de Vehiculo');




 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartipovehiculo", function(){

	
	var idtipovehiculo = $(this).attr("idtipovehiculo");
	
	var datos = new FormData();
	datos.append("idtipovehiculo", idtipovehiculo);

	$.ajax({

		url:"ajax/tipovehiculo.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo").val(respuesta["codigo"]);
			$("#editarnombre_tipo").val(respuesta["nombre_tipo"]);


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
	    url:"ajax/tipovehiculo.ajax.php",
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
$(".tablas").on("click", ".btnEliminartipovehiculo", function(){

  var idtipovehiculo = $(this).attr("idtipovehiculo");
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

      window.location = "index.php?ruta=tipovehiculo&idtipovehiculo="+idtipovehiculo+"&Codigo="+Codigo;

    }

  })

})




