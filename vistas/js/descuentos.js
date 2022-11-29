/* COLOCACION DE ICONOS */
$(document).ready(function(){

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




