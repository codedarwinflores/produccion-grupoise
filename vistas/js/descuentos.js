/* COLOCACION DE ICONOS */
$(document).ready(function(){


	/* $("#nuevoisss_devengo").attr("disabled","disabled");
	$("#nuevoafp_devengo").attr("disabled","disabled");
	$("#nuevorenta_devengo").attr("disabled","disabled");

	$("#editarisss_devengo").attr("disabled","disabled");
	$("#editarafp_devengo").attr("disabled","disabled");
	$("#editarrenta_devengo").attr("disabled","disabled"); */

	
	$("#nuevoisss_devengo").attr("style","visibility:hidden");
	$("#nuevoafp_devengo").attr("style","visibility:hidden");
	$("#nuevorenta_devengo").attr("style","visibility:hidden");

	$("#editarisss_devengo").attr("style","visibility:hidden");
	$("#editarafp_devengo").attr("style","visibility:hidden");
	$("#editarrenta_devengo").attr("style","visibility:hidden");


	$(".tipodescuento").change(function(){
		var valor=$(this).val();
		if(valor=="+Suma"){
			$("#nuevoisss_devengo").removeAttr("style");
			$("#nuevoafp_devengo").removeAttr("style");
			$("#nuevorenta_devengo").removeAttr("style");

			$("#editarisss_devengo").removeAttr("style");
			$("#editarafp_devengo").removeAttr("style");
			$("#editarrenta_devengo").removeAttr("style");
		
		}
		else{
			$("#nuevoisss_devengo").attr("style","visibility:hidden");
			$("#nuevoafp_devengo").attr("style","visibility:hidden");
			$("#nuevorenta_devengo").attr("style","visibility:hidden");
		
			$("#editarisss_devengo").attr("style","visibility:hidden");
			$("#editarafp_devengo").attr("style","visibility:hidden");
			$("#editarrenta_devengo").attr("style","visibility:hidden");

			$("#nuevoisss_devengo").val("No");
			$("#nuevoafp_devengo").val("No");
			$("#nuevorenta_devengo").val("No");
		
			
			$("#editarisss_devengo").val("No");
			$("#editarafp_devengo").val("No");
			$("#editarrenta_devengo").val("No");
		}
	});
	/* **************** */
	$(".descuentos_tipo").empty();
	$(".descuentos_tipo").append($("#tipo_insert"));
	$(".edescuentos_tipo").empty();
	$(".edescuentos_tipo").append($("#etipo_insert"));

	$(".descuentos_isss_devengo").empty();
	$(".descuentos_afp_devengo").empty();
	$(".descuentos_renta_devengo").empty();

	$(".edescuentos_isss_devengo").empty();
	$(".edescuentos_afp_devengo").empty();
	$(".edescuentos_renta_devengo").empty();

	/* ****************** */
	$(".edescuentos_cargo_abono").attr("style","visibility:hidden; height:0;");
	$(".descuentos_cargo_abono").attr("style","visibility:hidden; height:0;");

	var  texto= "Ingresar";
	$(".icono_codigo").addClass("fa fa-qrcode");
	$(".input_codigo").attr("placeholder", texto+" Código");

	

    $(".icono_descripcion").addClass("fa fa-tags");
	$(".input_descripcion").attr("placeholder", texto+" Decripción");

    $(".icono_porcentaje").addClass("fa fa-percent");
	$(".input_porcentaje").attr("placeholder", texto+" Porcentaje");

    $(".icono_tipo").addClass("fa fa-tags");
	$(".input_tipo").attr("placeholder", texto+" Tipo");

    $(".icono_cargo_abono").addClass("fa fa-tags");
	$(".input_cargo_abono").attr("placeholder", texto+" Cargo o Abono");

    $(".icono_cuenta_contable").addClass("fa fa-tags");
	$(".input_cuenta_contable").attr("placeholder", texto+" Cuenta contable");
	
/* *********LABEL*********** */
var input_codigo = $(".input_codigo").attr("placeholder");
var input_descripcion = $(".input_descripcion").attr("placeholder");
var input_porcentaje = $(".input_porcentaje").attr("placeholder");
var input_tipo = $(".input_tipo").attr("placeholder");
var input_cargo_abono = $(".input_cargo_abono").attr("placeholder");
var input_cuenta_contable= $(".input_cuenta_contable").attr("placeholder");


$(".label_codigo").text(input_codigo);
$(".label_descripcion").text(input_descripcion);
$(".label_porcentaje").text(input_porcentaje);
$(".label_tipo").text(input_tipo);
$(".label_cargo_abono").text(input_cargo_abono);
$(".label_cuenta_contable").text(input_cuenta_contable);

$('.descuentoinput_codigo').attr("maxlength","4");
$('.edescuentoinput_codigo').attr("maxlength","4");

 })

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarDescuentos", function(){
	
	
	var idDescuentos = $(this).attr("idDescuentos");
	
	var datos = new FormData();
	datos.append("idDescuentos", idDescuentos);
	//alert(idDescuentos);
	$.ajax({

		url:"ajax/descuentos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarcodigo").val(respuesta["codigo"]);			
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarporcentaje").val(respuesta["porcentaje"]);
			$("#editartipo").val(respuesta["tipo"]);
			$("#editarcargo_abono").val(respuesta["cargo_abono"]);
			$("#editarcuenta_contable").val(respuesta["cuenta_contable"]);

			$("#editarisss_devengo").val(respuesta["isss_devengo"]);
			$("#editarafp_devengo").val(respuesta["afp_devengo"]);
			$("#editarrenta_devengo").val(respuesta["renta_devengo"]);

			if(respuesta["tipo"]=="+Suma"){

				$("#editarisss_devengo").removeAttr("style");
				$("#editarafp_devengo").removeAttr("style");
				$("#editarrenta_devengo").removeAttr("style");
			}
			else{
				
			$("#nuevoisss_devengo").attr("style","visibility:hidden");
			$("#nuevoafp_devengo").attr("style","visibility:hidden");
			$("#nuevorenta_devengo").attr("style","visibility:hidden");
		
			$("#editarisss_devengo").attr("style","visibility:hidden");
			$("#editarafp_devengo").attr("style","visibility:hidden");
			$("#editarrenta_devengo").attr("style","visibility:hidden");
			}


		}

	});

})




/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarDescuentos", function(){

  var idDescuentos = $(this).attr("idDescuentos");
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

      window.location = "index.php?ruta=descuentos&idDescuentos="+idDescuentos+"&Codigo="+Codigo;

    }

  })

})




