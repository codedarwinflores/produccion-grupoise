/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");;

	
	$(".icono_id_familia").addClass("fa fa-server");
	$(".input_id_familia").attr("placeholder", texto+" Familia");
	$(".input_id_familia").attr("name","");


	$('.input_id_familia').click(function(){
		$(".s_familia").css("display", "block");
	});
	$('.select_familia').click(function(){
		var id = $(this).attr("idfamilia");
		var nombrefamilia = $(this).attr("nombrefamilia");
		$(".input_id_familia_1").val(id);
		$(".input_id_familia").val(nombrefamilia);
		
		$(".select_familia").css("display", "none");
		
	});

	$(".icono_descripcion").addClass("fa fa-server");
	$(".input_descripcion").attr("placeholder", texto+" Descripción");

	$(".icono_numero_serie").addClass("fa fa-server");
	$(".input_numero_serie").attr("placeholder", texto+" Número Serie");






 })

 
 document.addEventListener("mouseup", function(event) {
    var obj = document.getElementById("s_familia");
    if (!obj.contains(event.target)) {
		$(".s_familia").css("display", "none");
    }
    else {
       
    }
})
/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarequipos", function(){

	
	var idequipos = $(this).attr("idequipos");
	
	var datos = new FormData();
	datos.append("idequipos", idequipos);

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			$("#editarid").val(respuesta["idequipos"]);
			$("#editarid_familia_1").val(respuesta["idfamilia"]);
			$("#editarid_familia").val(respuesta["nombrefamilia"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarnumero_serie").val(respuesta["numero_serie"]);



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
	    url:"ajax/equipos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarequipos", function(){

  var idequipos = $(this).attr("idequipos");
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

      window.location = "index.php?ruta=equipos&idequipos="+idequipos+"&Codigo="+Codigo;

    }

  })

})




