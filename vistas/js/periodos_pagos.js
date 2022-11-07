/* COLOCACION DE ICONOS */
$(document).ready(function(){

	var  texto= "Ingresar";
	$(".icono_nombre_periodo").addClass("fa fa-sticky-note-o");
	$(".input_nombre_periodo").attr("placeholder", texto+" Periodo de Pago");

	/* *********LABEL*********** */
	var input_nombre_periodo = $(".input_nombre_periodo").attr("placeholder");
	$(".label_nombre_periodo").text(input_nombre_periodo);

/* 	$(".icono_personal_asignado").addClass("fa fa-user");
	$(".input_personal_asignado").attr("placeholder", texto+" Personal Asignado");
	$(".input_personal_asignado").get(0).type = 'number';
 */

 })

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarperiodos_pagos", function(){

	
	var idperiodos_pagos = $(this).attr("idperiodos_pagos");
	

	var datos = new FormData();
	datos.append("idperiodos_pagos", idperiodos_pagos);

	$.ajax({

		url:"ajax/periodos_pagos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarnombre_periodo").val(respuesta["nombre_periodo"]);



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
	    url:"ajax/periodos_pagos.ajax.php",
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
$(".tablas").on("click", ".btnEliminarperiodos_pagos", function(){

  var idperiodos_pagos = $(this).attr("idperiodos_pagos");
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

      window.location = "index.php?ruta=periodos&idperiodos_pagos="+idperiodos_pagos+"&Codigo="+Codigo;

    }

  })

})




