/* COLOCACION DE ICONOS */
$(document).ready(function(){


    var fechaActual = moment().format('DD-MM-YYYY');

	  // Captura la hora actual
	  var fecha = new Date();
	  var horas = fecha.getHours();
	  var minutos = fecha.getMinutes();
	  var ampm = horas >= 12 ? 'PM' : 'AM';
  
	  // Convierte las horas al formato 12 horas
	  horas = horas % 12;
	  horas = horas ? horas : 12; // Si horas es 0, establece 12 en su lugar
  
	  // Formatea la hora y los minutos
	  var horaActual = horas + ':' + (minutos < 10 ? '0' : '') + minutos + ' ' + ampm;

	  
	  $("#nuevofecha").val(fechaActual);
	  $("#nuevohora").val(horaActual);
		  
 })

 

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarbitacora", function(){

	
	var idbitacora = $(this).attr("idbitacora");
	
	var datos = new FormData();
	datos.append("idbitacora", idbitacora);

	$.ajax({

		url:"ajax/bitacora.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarid").val(respuesta["id"]);
			$("#editarfecha").val(respuesta["fecha"]);
			$("#editarhora").val(respuesta["hora"]);
			$("#editaridusuario").val(respuesta["idusuario"]);
			$("#editarnum_planilla").val(respuesta["num_planilla"]).trigger('change.select2');;
			$("#editarestado_planilla").val(respuesta["estado_planilla"]);


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
	    url:"ajax/bitacora.ajax.php",
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
$(".tablas").on("click", ".btnEliminarbitacora", function(){

  var idbitacora = $(this).attr("idbitacora");
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

      window.location = "index.php?ruta=bitacora&idbitacora="+idbitacora+"&Codigo="+Codigo;

    }

  })

})




