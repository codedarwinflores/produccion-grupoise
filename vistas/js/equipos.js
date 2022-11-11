/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	$('.input_id_familia').attr("onkeydown","return false");

	
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
		
		$(".s_familia").css("display", "none");
		
	});

	$(".icono_descripcion").addClass("fa fa-server");
	$(".input_descripcion").attr("placeholder", texto+" Descripción");

	$(".icono_numero_serie").addClass("fa fa-server");
	$(".input_numero_serie").attr("placeholder", texto+" Número Serie");



	$(".equipogrupo_tipo_equipos").empty();
	$(".eequipogrupo_tipo_equipos").empty();

	/* *******nuevos campos** */

	$(".icono_codigo_equipo").addClass("fa fa-qrcode");
	$(".input_codigo_equipo").attr("placeholder", texto+" Código");

	$(".icono_descripcion_equipo").addClass("fa fa-spinner");
	$(".input_descripcion_equipo").attr("placeholder", texto+" Descripción");

	$(".icono_costo_equipo").addClass("fa fa-money");
	$(".input_costo_equipo").attr("placeholder", texto+" Costo");
	
	$(".input_costo_equipo").get(0).type = 'number';
	$(".input_costo_equipo").attr("step", "0.01");
	$("#editarcosto_equipo").get(0).type = 'number';
	$("#editarcosto_equipo").attr("step", "0.01");

	$(".icono_modelo_equipo").addClass("fa fa-star");
	$(".input_modelo_equipo").attr("placeholder", texto+" Modelo");

	$(".icono_color_equipo").addClass("fa fa-spinner");
	$(".input_color_equipo").attr("placeholder", texto+" Color");



              /* *********LABEL*********** */
			  var input_id_familia = $(".input_id_familia").attr("placeholder");
			  $(".label_id_familia").text(input_id_familia);

		  
              /* *********LABEL*********** */
			  var input_descripcion = $(".input_descripcion").attr("placeholder");
			  $(".label_descripcion").text(input_descripcion);

		  
              /* *********LABEL*********** */
			  var input_codigo_equipo = $(".input_codigo_equipo").attr("placeholder");
			  $(".label_codigo_equipo").text(input_codigo_equipo);

		  
              /* *********LABEL*********** */
			  var input_descripcion_equipo = $(".input_descripcion_equipo").attr("placeholder");
			  $(".label_descripcion_equipo").text(input_descripcion_equipo);

		  
              /* *********LABEL*********** */
			  var input_costo_equipo = $(".input_costo_equipo").attr("placeholder");
			  $(".label_costo_equipo").text(input_costo_equipo);

		  
              /* *********LABEL*********** */
			  var input_modelo_equipo = $(".input_modelo_equipo").attr("placeholder");
			  $(".label_modelo_equipo").text(input_modelo_equipo);

		  
              /* *********LABEL*********** */
			  var input_color_equipo = $(".input_color_equipo").attr("placeholder");
			  $(".label_color_equipo").text(input_color_equipo);

		  


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
			$("#editartipo_equipos").val(respuesta["tipo_equipos"]);



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




