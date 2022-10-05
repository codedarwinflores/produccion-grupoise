/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";
	$(".icono_descripcion").addClass("fa fa-sticky-note-o");
	$(".input_descripcion").attr("placeholder", texto+" Descripción");

	$(".icono_nivel").addClass("fa fa-tasks");
	$(".input_nivel").attr("placeholder", texto+" Nivel");

	
	$(".icono_codigo_contable").addClass("fa fa-money");
	$(".input_codigo_contable").attr("placeholder", texto+" Código Contable");

	$(".icono_personal_asignado").addClass("fa fa-user");
	$(".input_personal_asignado").attr("placeholder", texto+" Personal Asignado");
	$(".input_personal_asignado").get(0).type = 'number';

	$(".icono_pago_feriados").addClass("fa fa-calendar");
	$(".input_pago_feriados").attr("placeholder", texto+" Pago Feriado");
	$(".input_pago_feriados").get(0).type = 'number';

	
	$(".icono_calculo").addClass("fa fa-pie-chart");
	$(".input_calculo").attr("placeholder", texto+" Calculo");
	$(".input_calculo").get(0).type = 'number';

 })

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarCargos", function(){

	
	var idCargos = $(this).attr("idCargos");
	
	var datos = new FormData();
	datos.append("idCargos", idCargos);

	$.ajax({

		url:"ajax/cargos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editardescripcion").val(respuesta["descripcion"]);
			$("#editarnivel").val(respuesta["nivel"]);
			$("#editarcodigo_contable").val(respuesta["codigo_contable"]);
			$("#editarpersonal_asignado").val(respuesta["personal_asignado"]);
			$("#editarpago_feriados").val(respuesta["pago_feriados"]);
			$("#editarcalculo").val(respuesta["calculo"]);



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
	    url:"ajax/cargos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarCargos", function(){

  var idCargos = $(this).attr("idCargos");
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

      window.location = "index.php?ruta=cargos&idCargos="+idCargos+"&Codigo="+Codigo;

    }

  })

})




