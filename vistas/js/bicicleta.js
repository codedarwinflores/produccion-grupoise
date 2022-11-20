/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");

	
	$(".icono_fecha_adquisicion").addClass("fa  fa-calendar");
    $(".input_fecha_adquisicion").attr("placeholder", texto+" Fecha de adquisición");

	$(".input_codigo_bicicleta").attr("readonly","readonly");


	$(".bicicleta_grupo_id_familia").empty();
	$('.bicicleta_grupo_id_familia').append($('.s_familia_b'));
	$(".bicicleta_grupo_id_tipo_bicicleta").empty();
	$('.bicicleta_grupo_id_tipo_bicicleta').append($('.s_tipo'));

	/* EDITAR */

	
	$(".bicicleta_grupoeditar_id_familia").empty();
	$('.bicicleta_grupoeditar_id_familia').append($('.s_familia_b_editar'));
	$(".bicicleta_grupoeditar_id_tipo_bicicleta").empty();
	$('.bicicleta_grupoeditar_id_tipo_bicicleta').append($('.s_tipo_editar'));
	
	$(".icono_operador").addClass("fa fa-server");
	$(".input_operador").attr("placeholder", texto+" Operador");

	/* ****nuevo** */
	
	$(".icono_codigo_bicicleta").addClass("fa fa-server");
	$(".input_codigo_bicicleta").attr("placeholder", texto+" Código");
	
	$(".icono_descripcion_bicicleta").addClass("fa fa-server");
	$(".input_descripcion_bicicleta").attr("placeholder", texto+" Descripción");
	
	$(".icono_costo_bicicleta").addClass("fa fa-server");
	$(".input_costo_bicicleta").attr("placeholder", texto+" Costo");
	$(".input_costo_bicicleta").get(0).type = 'number';
    $(".input_costo_bicicleta").attr("step", "0.01");
	    /* **** */
		$("#editarcosto_bicicleta").get(0).type = 'number';
		$("#editarcosto_bicicleta").attr("step", "0.01");
	
	
	$(".icono_modelo_bicicleta").addClass("fa fa-server");
	$(".input_modelo_bicicleta").attr("placeholder", texto+" Modelo");
	
	$(".icono_color_bicicleta").addClass("fa fa-server");
	$(".input_color_bicicleta").attr("placeholder", texto+" Color");



	    /* *********LABEL*********** */
		var input_fecha_adquisicion = $(".input_fecha_adquisicion").attr("placeholder");
		$(".label_fecha_adquisicion").text(input_fecha_adquisicion);

	

	
              /* *********LABEL*********** */
			  var input_codigo_bicicleta = $(".input_codigo_bicicleta").attr("placeholder");
			  $(".label_codigo_bicicleta").text(input_codigo_bicicleta);

		  
			  
              /* *********LABEL*********** */
			  var input_descripcion_bicicleta = $(".input_descripcion_bicicleta").attr("placeholder");
			  $(".label_descripcion_bicicleta").text(input_descripcion_bicicleta);

		  
              /* *********LABEL*********** */
			  var input_costo_bicicleta = $(".input_costo_bicicleta").attr("placeholder");
			  $(".label_costo_bicicleta").text(input_costo_bicicleta);

		  
              /* *********LABEL*********** */
			  var input_modelo_bicicleta = $(".input_modelo_bicicleta").attr("placeholder");
			  $(".label_modelo_bicicleta").text(input_modelo_bicicleta);

		  
              /* *********LABEL*********** */
			  var input_color_bicicleta = $(".input_color_bicicleta").attr("placeholder");
			  $(".label_color_bicicleta").text(input_color_bicicleta);

			  calendario02();
		  
 })

 

 function calendario02(){
	$(".input_fecha_adquisicion").addClass("calendario");
	$(".input_fecha_adquisicion").attr("fecha","fecha_adquisionb");
	$(".input_fecha_adquisicion").attr("name"," ");

}
/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarbicicleta", function(){

	$("#editarfecha_adquisicion").attr("fecha","fecha_adquisionbe");
	
	
	var idbicicleta = $(this).attr("idbicicleta");
	
	var datos = new FormData();
	datos.append("idbicicleta", idbicicleta);

	$.ajax({

		url:"ajax/bicicleta.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idbicicleta"]);
			$("#editarid_familia").val(respuesta["idfamilia"]);
			$("#editarid_tipo_bicicleta").val(respuesta["idtipobicicleta"]);
			$("#editarmarca").val(respuesta["marca"]);
			$("#editarnumero_serie").val(respuesta["numero_serie"]);

			

				
			var dateNEW = respuesta["fecha_adquisicion"];
			var date = new Date(dateNEW);
			var year = date.toLocaleString("default", { year: "numeric" });
			var month = date.toLocaleString("default", { month: "2-digit" });
			var day = date.toLocaleString("default", { day: "2-digit" });
			var formattedDate = day + "-" + month + "-" + year;

			$("#editarfecha_adquisicion").val(formattedDate);
			
			$("#editarfecha_adquisicion2").val(respuesta["fecha_adquision"]);
			$("#editarobservaciones").val(respuesta["observaciones"]);
			$("#editarserie").val(respuesta["serie"]);

			$("#editardescripcion_bicicleta").val(respuesta["descripcion_bicicleta"]);
			$("#editarcosto_bicicleta").val(respuesta["costo_bicicleta"]);
			$("#editarmodelo_bicicleta").val(respuesta["modelo_bicicleta"]);
			$("#editarcolor_bicicleta").val(respuesta["color_bicicleta"]);




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
	    url:"ajax/bicicleta.ajax.php",
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
$(".tablas").on("click", ".btnEliminarbicicleta", function(){

  var idbicicleta = $(this).attr("idbicicleta");
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

      window.location = "index.php?ruta=bicicleta&idbicicleta="+idbicicleta+"&Codigo="+Codigo;

    }

  })

})




