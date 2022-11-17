/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";

	$(".input_id").removeAttr("required");


	$(".armasinput_codigo").attr("readonly","readonly");

	$(".grupo_tipo_matricula").empty();
	$('.grupo_tipo_matricula').append($('.s_matricula_tipo'));

	
	$(".grupo_tipo_municion").empty();
	$('.grupo_tipo_municion').append($('.s_municion_tipo'));

	
	$(".grupo_estado").empty();
	$('.grupo_estado').append($('.s_estado'));

	/* editar */
	$(".grupo_editar_tipo_matricula").empty();
	$('.grupo_editar_tipo_matricula').append($('.editar_s_matricula_tipo'));

	
	$(".grupo_editar_tipo_municion").empty();
	$('.grupo_editar_tipo_municion').append($('.editar_s_municion_tipo'));
	
	$(".grupo_editar_estado").empty();
	$('.grupo_editar_estado').append($('.editar_s_estado'));



	


	$(".input_id_empresa").attr("name","");
	$(".input_id_familia").attr("name","");
	$(".input_id_tipo_arma").attr("name","");
	$(".input_fecha_ingreso").attr("name","");
	$(".input_fecha_vencimiento").attr("name", "");


	$(".icono_fecha_ingreso").addClass("fa fa-calendar");
	$(".input_fecha_ingreso").attr("placeholder", texto+" Fecha Ingreso");
	$(".input_fecha_ingreso").addClass("calendario");
	$(".input_fecha_ingreso").addClass("fechaingreso");
	$(".input_fecha_ingreso").attr("fecha", "fechaingreso");

	



	$(".input_id_empresa").attr("placeholder", texto+" Empresa");
	$(".armagrupo_id_empresa ").empty();
	$("#editarid_empresa").empty();
	$(".grupo_editar_id_empresa").empty();

	/* $(".grupo_id_empresa").empty();
	$('.grupo_id_empresa').append($('.s_idempresa'));
	$(".grupo_editar_id_empresa").empty();
	$('.grupo_editar_id_empresa').append($('.s_idempresa_editar')); */

	
	$(".farmagrupo_id_familia").empty();
	$('.farmagrupo_id_familia').append($(".s_familia_arma"));
/* 	$(".grupo_editar_id_familia").empty();
	$('.grupo_editar_id_familia').append($('.s_familia_editar')); */


	
	$(".input_id_tipo_arma").attr("placeholder", texto+" Tipo Arma");
	$(".grupo_id_tipo_arma").empty();
	$('.grupo_id_tipo_arma').append($('.s_idtipoarma'));
	$(".grupo_editar_id_tipo_arma").empty();
	$('.grupo_editar_id_tipo_arma').append($('.s_idtipoarma_editar'));

	


	
	$(".icono_codigo").addClass("fa fa-qrcode");
	$(".input_codigo").attr("placeholder", texto+" Código");

	
	$(".icono_numero_serie").addClass("fa fa-sort-numeric-asc");
	$(".input_numero_serie").attr("placeholder", texto+" Número Serie");

	
	$(".icono_marca").addClass("fa fa-tags");
	$(".input_marca").attr("placeholder", texto+" Marca");

	
	$(".icono_modelo").addClass("fa fa-star");
	$(".input_modelo").attr("placeholder", texto+" Modelo");

	
	$(".icono_color").addClass("fa fa-th-large");
	$(".input_color").attr("placeholder", texto+" Color");

	
	$(".icono_numero_matricula").addClass("fa fa-address-card-o");
	$(".input_numero_matricula").attr("placeholder", texto+" Número Matrícula");

	
	$(".icono_fecha_vencimiento").addClass("fa fa-calendar");
	$(".input_fecha_vencimiento").attr("placeholder", texto+" Fecha Vencimiento");
	$(".input_fecha_vencimiento").addClass("calendario");
	$(".input_fecha_vencimiento").addClass("fechavence");
	$(".input_fecha_vencimiento").attr("fecha", "fechavence");


	
	$(".icono_tipo_matricula").addClass("fa fa-sitemap");
	$(".input_tipo_matricula").attr("placeholder", texto+" Tipo Matrícula");

	
	$(".icono_tipo_municion").addClass("fa fa-sitemap");
	$(".input_tipo_municion").attr("placeholder", texto+" Tipo Munición");

	
	$(".icono_lugar_adquisicion").addClass("fa fa-map-marker");
	$(".input_lugar_adquisicion").attr("placeholder", texto+" Lugar Adquisición");

	
	$(".icono_precio_costo").addClass("fa fa-money");
	$(".input_precio_costo").attr("placeholder", texto+" Precio Costo");

	
	$(".icono_estado").addClass("fa fa-shield");
	$(".input_estado").attr("placeholder", texto+" Estado");

	
              /* *********LABEL*********** */
			  var input_fecha_ingreso = $(".input_fecha_ingreso").attr("placeholder");
			  $(".label_fecha_ingreso").text(input_fecha_ingreso);

		  
              /* *********LABEL*********** */
			  var input_numero_serie = $(".input_numero_serie").attr("placeholder");
			  $(".label_numero_serie").text(input_numero_serie);

		  
              /* *********LABEL*********** */
			  var input_marca = $(".input_marca").attr("placeholder");
			  $(".label_marca").text(input_marca);

		  
              /* *********LABEL*********** */
			  var input_modelo = $(".input_modelo").attr("placeholder");
			  $(".label_modelo").text(input_modelo);

		  
              /* *********LABEL*********** */
			  var input_color = $(".input_color").attr("placeholder");
			  $(".label_color").text(input_color);

		  
              /* *********LABEL*********** */
			  var input_numero_matricula = $(".input_numero_matricula").attr("placeholder");
			  $(".label_numero_matricula").text(input_numero_matricula);

		  
              /* *********LABEL*********** */
			  var input_lugar_adquisicion = $(".input_lugar_adquisicion").attr("placeholder");
			  $(".label_lugar_adquisicion").text(input_lugar_adquisicion);

		  
              /* *********LABEL*********** */
			  var input_precio_costo = $(".input_precio_costo").attr("placeholder");
			  $(".label_precio_costo").text(input_precio_costo);

		  
              /* *********LABEL*********** */
			  var input_fecha_vencimiento = $(".input_fecha_vencimiento").attr("placeholder");
			  $(".label_fecha_vencimiento").text(input_fecha_vencimiento);

		  

 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditararmas", function(){

	
	var idarmas = $(this).attr("idarmas");
	
	var datos = new FormData();
	datos.append("idarmas", idarmas);

	$.ajax({

		url:"ajax/armas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["idarmas"]);


			
			var dateNEW = respuesta["fecha_ingreso"];
			var date = new Date(dateNEW);
			// Get year, month, and day part from the date
			var year = date.toLocaleString("default", { year: "numeric" });
			var month = date.toLocaleString("default", { month: "2-digit" });
			var day = date.toLocaleString("default", { day: "2-digit" });
			// Generate yyyy-mm-dd date string
			var formattedDate = day + "-" + month + "-" + year;

			$("#editarfecha_ingreso").val(formattedDate);
			$("#fecha_ingreso_editar").val(respuesta["fecha_ingreso"]);




			$("#editarid_empresa").val(respuesta["id_empresa"]);
			$("#editarid_familia").val(respuesta["id_familia"]);
			$("#editarid_tipo_arma").val(respuesta["id_tipo_arma"]);
			$("#editarcodigo").val(respuesta["codigoarmas"]);
			$("#editarnumero_serie").val(respuesta["numero_serie"]);
			$("#editarmarca").val(respuesta["marca"]);
			$("#editarmodelo").val(respuesta["modelo"]);
			$("#editarcolor").val(respuesta["color"]);
			$("#editarnumero_matricula").val(respuesta["numero_matricula"]);



			var dateNEW2 = respuesta["fecha_vencimiento"];
			var date2 = new Date(dateNEW2);
			// Get year, month, and day part from the date
			var year2 = date2.toLocaleString("default", { year: "numeric" });
			var month2 = date2.toLocaleString("default", { month: "2-digit" });
			var day2 = date2.toLocaleString("default", { day: "2-digit" });
			// Generate yyyy-mm-dd date string
			var formattedDate2 = day2 + "-" + month2 + "-" + year2;

			$("#editarfecha_vencimiento").val(formattedDate2);
			$("#fecha_vencimiento_editar").val(respuesta["fecha_vencimiento"]);




			$("#editartipo_matricula").val(respuesta["tipo_matricula"]);
			$("#editartipo_municion").val(respuesta["tipo_municion"]);
			$("#editarlugar_adquisicion").val(respuesta["lugar_adquisicion"]);
			$("#editarprecio_costo").val(respuesta["precio_costo"]);
			$("#editarestado").val(respuesta["estado"]);
			

			if($("#editartipo_municion").val() == null)
			{

			$("#editartipo_municion option[value=otros]").attr("selected",true);
			$("#editartipo_municion option[value=otros]").attr("selected",true);

			
			$("#editartipo_municion02").attr("style","display:block");
			$("#editartipo_municion02").val(respuesta["tipo_municion"]);
			$("#editartipo_municion option[value=otros]").val(respuesta["tipo_municion"]);

			$("#editartipo_municion02").change(function(){
				$("#editartipo_municion option:selected").val($("#editartipo_municion02").val());

			  });


			}


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
	    url:"ajax/armas.ajax.php",
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
$(".tablas").on("click", ".btnEliminararmas", function(){

  var idarmas = $(this).attr("idarmas");
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

      window.location = "index.php?ruta=armas&idarmas="+idarmas+"&Codigo="+Codigo;

    }

  })

})




