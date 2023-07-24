/* COLOCACION DE ICONOS */
$(document).ready(function(){


	$(".grupotbl_vendedor_porcentaje1_vendedor").attr("style","visibility:hidden; height:0px; margin-bottom:0px;");
	$(".grupotbl_vendedor_porcentaje2_vendedor").attr("style","visibility:hidden; height:0px; margin-bottom:0px;");
	$(".grupotbl_vendedor_porcentaje3_vendedor").attr("style","visibility:hidden; height:0px; margin-bottom:0px;");

	$(".grupotbl_vendedor_valor1_vendedor").attr("style","visibility:hidden; height:0px; margin-bottom:0px;");
	$(".grupotbl_vendedor_valor2_vendedor").attr("style","visibility:hidden; height:0px; margin-bottom:0px;");
	$(".grupotbl_vendedor_valor3_vendedor").attr("style","visibility:hidden; height:0px; margin-bottom:0px;");

	
	$(".egrupotbl_vendedor_porcentaje1_vendedor").attr("style","visibility:hidden; height:0px;");
	$(".egrupotbl_vendedor_porcentaje2_vendedor").attr("style","visibility:hidden; height:0px;");
	$(".egrupotbl_vendedor_porcentaje3_vendedor").attr("style","visibility:hidden; height:0px;");

	$(".egrupotbl_vendedor_valor1_vendedor").attr("style","visibility:hidden; height:0px;");
	$(".egrupotbl_vendedor_valor2_vendedor").attr("style","visibility:hidden; height:0px;");
	$(".egrupotbl_vendedor_valor3_vendedor").attr("style","visibility:hidden; height:0px;");


	$(".grupotbl_vendedor_cargo_vendedor").empty();
	$(".grupotbl_vendedor_telefono_vendedor").empty();
	$(".grupotbl_vendedor_extension_vendedor").empty();
	$(".grupotbl_vendedor_email_vendedor").empty();
	$(".grupotbl_vendedor_meta_vendedor").empty();
	
	$(".egrupotbl_vendedor_cargo_vendedor").empty();
	$(".egrupotbl_vendedor_telefono_vendedor").empty();
	$(".egrupotbl_vendedor_extension_vendedor").empty();
	$(".egrupotbl_vendedor_email_vendedor").empty();
	$(".egrupotbl_vendedor_meta_vendedor").empty();

	var  texto= "Ingresar";

	$(".vendedor_input_id").removeAttr("required");




	$( ".vendedor_input_codigo" ).blur(function() {
		
		var dato = $(this).val();

		/*  ******;** */
		 var parametros = {
			"codigo" : dato
		
		
		};
		$.ajax({
				data:  parametros,
				url:"ajax/validarcodigovendedor.ajax.php",
				type:  'post',
				success:  function (response) {
				
					if(response == 1){
						$(".grupotbl_vendedor_codigo").append("<p style='color:red;'>El código ya existe</p>");
						$(".vendedor_input_codigo").val("");
					}
					
				}
		});
		/* ********* */


	  });

	

	$('.vendedor_input_codigo').attr("maxlength","2");

	$(".vendedor_icono_codigo").addClass("fa fa-file");
	$(".vendedor_input_codigo").attr("placeholder", texto+" Código");
	var vendedor_input_codigo=$(".vendedor_input_codigo").attr("placeholder");
	$(".vendedor_label_codigo").text(vendedor_input_codigo);

	/* ***** */
	$(".vendedor_icono_nombre_vendedor").addClass("fa fa-file");
	$(".vendedor_input_nombre_vendedor").attr("placeholder", texto+" Nombre");
	var input_nombre_vendedor=$(".vendedor_input_nombre_vendedor").attr("placeholder");
	$(".vendedor_label_nombre_vendedor").text(input_nombre_vendedor);


	$(".vendedor_input_porcentaje1_vendedor").attr("type","number");
	$(".vendedor_input_porcentaje1_vendedor").attr("step","0.01");

	$(".vendedor_input_porcentaje2_vendedor").attr("type","number");
	$(".vendedor_input_porcentaje2_vendedor").attr("step","0.01");

	$(".vendedor_input_porcentaje3_vendedor").attr("type","number");
	$(".vendedor_input_porcentaje3_vendedor").attr("step","0.01");

	/* ***** */
	$(".vendedor_icono_porcentaje1_vendedor").addClass("fa fa-file");
	$(".vendedor_input_porcentaje1_vendedor").attr("placeholder", texto+" Porcentaje 1");
	var vendedor_input_porcentaje1_vendedor=$(".vendedor_input_porcentaje1_vendedor").attr("placeholder");
	$(".vendedor_label_porcentaje1_vendedor").text(vendedor_input_porcentaje1_vendedor);

	/* ***** */
	$(".vendedor_icono_porcentaje2_vendedor").addClass("fa fa-file");
	$(".vendedor_input_porcentaje2_vendedor").attr("placeholder", texto+" Porcentaje 2");
	var vendedor_input_porcentaje2_vendedor=$(".vendedor_input_porcentaje2_vendedor").attr("placeholder");
	$(".vendedor_label_porcentaje2_vendedor").text(vendedor_input_porcentaje2_vendedor);

	/* ***** */
	$(".vendedor_icono_porcentaje3_vendedor").addClass("fa fa-file");
	$(".vendedor_input_porcentaje3_vendedor").attr("placeholder", texto+" Porcentaje 3");
	var vendedor_input_porcentaje3_vendedor=$(".vendedor_input_porcentaje3_vendedor").attr("placeholder");
	$(".vendedor_label_porcentaje3_vendedor").text(vendedor_input_porcentaje3_vendedor);


	/* ***** */
	$(".vendedor_icono_valor1_vendedor").addClass("fa fa-file");
	$(".vendedor_input_valor1_vendedor").attr("placeholder", texto+" Valor 1");
	var vendedor_input_valor1_vendedor=$(".vendedor_input_valor1_vendedor").attr("placeholder");
	$(".vendedor_label_valor1_vendedor").text(vendedor_input_valor1_vendedor);

		/* ***** */
	$(".vendedor_icono_valor2_vendedor").addClass("fa fa-file");
	$(".vendedor_input_valor2_vendedor").attr("placeholder", texto+" Valor 2");
	var vendedor_input_valor2_vendedor=$(".vendedor_input_valor2_vendedor").attr("placeholder");
	$(".vendedor_label_valor2_vendedor").text(vendedor_input_valor2_vendedor);

	
		/* ***** */
	$(".vendedor_icono_valor3_vendedor").addClass("fa fa-file");
	$(".vendedor_input_valor3_vendedor").attr("placeholder", texto+" Valor 3");
	var vendedor_input_valor3_vendedor=$(".vendedor_input_valor3_vendedor").attr("placeholder");
	$(".vendedor_label_valor3_vendedor").text(vendedor_input_valor3_vendedor);



		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartbl_vendedor", function(){

	
	var idtbl_vendedor = $(this).attr("idtbl_vendedor");
	
	var datos = new FormData();
	datos.append("idtbl_vendedor", idtbl_vendedor);

	$.ajax({

		url:"ajax/vendedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo").val(respuesta["codigo"]);
			$("#editarnombre_vendedor").val(respuesta["nombre_vendedor"]);
			$("#editarporcentaje1_vendedor").val(respuesta["porcentaje1_vendedor"]);
			$("#editarporcentaje2_vendedor").val(respuesta["porcentaje2_vendedor"]);
			$("#editarporcentaje3_vendedor").val(respuesta["porcentaje3_vendedor"]);
			$("#editarvalor1_vendedor").val(respuesta["valor1_vendedor"]);
			$("#editarvalor2_vendedor").val(respuesta["valor2_vendedor"]);
			$("#editarvalor3_vendedor").val(respuesta["valor3_vendedor"]);

			$("#editarcargo_vendedor").val(respuesta["cargo_vendedor"]);
			$("#editartelefono_vendedor").val(respuesta["telefono_vendedor"]);
			$("#editarextension_vendedor").val(respuesta["extension_vendedor"]);
			$("#editaremail_vendedor").val(respuesta["email_vendedor"]);
			$("#editarmeta_vendedor").val(respuesta["meta_vendedor"]);




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
	    url:"ajax/tbl_vendedor.ajax.php",
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
$(".tablas").on("click", ".btnEliminartbl_vendedor", function(){

  var idtbl_vendedor = $(this).attr("idtbl_vendedor");
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

      window.location = "index.php?ruta=vendedor&idtbl_vendedor="+idtbl_vendedor+"&Codigo="+Codigo;

    }

  })

})




