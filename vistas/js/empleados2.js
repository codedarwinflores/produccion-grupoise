$( document ).ready(function() {



$(".mostrarerror").attr("style","display:none;");

	/* ************* */
  
	$(".capturarfechanac").blur(function(){
	  
	  $( "#ic__datepicker-5" ).click(function() {
	  
		  var valor = $(".capturarfechanac").val();
		  if(calculateAge(valor)>=18)
		  {
			  $(".mostrarerror").attr("style","display:none;");
  
			  /* *********** */
  
				  $(".editarfecha_ingreso").val(formattedToday);
				  $(".oficial_editarfecha_ingreso").val(formatosql);
  
				  var telefonoactual=$(".configtelefono").val();
				  $("#editarnumero_telefono_trabajo_actual").val(telefonoactual);
  
				  var codigoempleado =$("#editarcodigo_empleado").val();
			  
  
				  /* ****CAPTURO LA FECHA NACIMIENTO */
  
				  var value = $("#editarfecha_nacimiento").val();
				  var anio = new Date(value).getFullYear();
				  var mes = new Date(value).getMonth()+ 1;
				  if (mes < 10) mes = '0' + mes;
  
				  anio = anio.toString().substr(-2);
  
				  $("#editarcarnet_empleado").val(codigoempleado+mes+anio);
  
			  /* ***************** */
		  }
		  else{
			  $(".mostrarerror").attr("style","display:block; color:red;");
			  $(".capturarfechanac").val("");
		  }
		});
	  });
	  
  /* ******************** */
  


  /* CALCULO LA FECHA CUMPLEAÑOS */
function calculateAge(birthday) {
    var birthday_arr = birthday.split("-");
    var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}
/* ****************** */



$('.editarconstancia_psicologica').on('change', function() {
	var valor = this.value ;
	if(valor=="SI"){

		$(".editarnombre_psicologo").attr("style","display:block;");
	}
	if(valor=="NO"){
		$(".editarnombre_psicologo").attr("style","display:none;");

	}
  });


  $('.editarexamen_poligrafico').on('change', function() {
	var valor = this.value ;
	if(valor=="SI"){

		$(".editarFecha_poligrafico").attr("style","display:block;");
		$(".editarFecha_poligrafico").attr("required","required");
	}
	if(valor=="NO"){
		$(".editarFecha_poligrafico").attr("style","display:none;");
		$(".editarFecha_poligrafico").removeAttr("required","");

	}
  });

  


  
/*=============================================
informacion
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleadoretiro", function(){
	var idEmpleado = $(this).attr("idEmpleado");

	var form = $('<form action="contratacion" method="post">' +
	'<input type="text" name="idEmpleado" value="' + idEmpleado + '" />' +
	'<input type="text" name="modulo" value="retiro" />' +
	  '</form>');
	$('body').append(form);
	form.submit();
});


var nombre_modulo=$("#nombre_modulo").val();

if(nombre_modulo=="retiro"){
	$(".botonmodificar").attr("style","display:none");
}




/* fotos */

/* vizualizar imagenes */
// Escucha el cambio en el elemento input type="file"
$(".nuevaFoto").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        // Cuando la imagen se carga, asigna la URL de la imagen al elemento img
        reader.onload = function(e) {
            $(".previsualizarEditar").attr("src", e.target.result);
        };
        // Lee el archivo de imagen como una URL de datos
        reader.readAsDataURL(inputFile.files[0]);
    }
});




/* ********************** */
$(".nuevaFotoDoc").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".previsualizarEditarDoc").attr("src", e.target.result);
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
});
/* ********************** */
$(".nuevaFotoNIT").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".previsualizarEditarNIT").attr("src", e.target.result);
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
});
/* ********************** */
$(".nuevaFotoANSP").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".previsualizarEditarANSP").attr("src", e.target.result);
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
});
/* ********************** */
$(".nuevaFotoANTECEDENTES").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".previsualizarEditarANTECEDENTES").attr("src", e.target.result);
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
});
/* ********************** */
$(".nuevaFotoSOLVENCIAPNC").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".previsualizarEditarSOLVENCIAPNC").attr("src", e.target.result);
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
});
/* ********************** */
$(".nuevaFotoHUELLAS").on("change", function() {
    var inputFile = this;
    if (inputFile.files && inputFile.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".previsualizarEditarHUELLAS").attr("src", e.target.result);
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
});
/* ********************** */



$('#editarCARGO0').on('change', function() {
	var valor =  $(this).find('option:selected').attr('cargo');/* $('select[name="editarCARGO"] option:selected').text(); */

	var jefeoperacioncargo =  $(this).find(":selected").attr("jefeoperacioncargo");

	if(jefeoperacioncargo=="Si"){
		$(".jefeoperacion_empleado").removeAttr("style");
	}
	else{
		$(".jefeoperacion_empleado").attr("style","display:none");
	}
	if(valor=="AGENTE DE SEGURIDAD"){

	
		/* $(".jefeoperacion_empleado").attr("style","display:block"); */


			var salario_minimo=$(".salario_minimo").val();
            var salario_diario=$(".salario_diario").val();
            var salario_hora=$(".salario_hora").val();
            var hora_diurna=$(".hora_diurna").val();
            var hora_nocturna=$(".hora_nocturna").val();
            var hora_diurna_domingo=$(".hora_diurna_domingo").val();
            var hora_nocturna_domingo=$(".hora_nocturna_domingo").val();


			$("#editar_sueldo").val(salario_minimo);
			$("#editar_sueldo_diario").val(salario_diario);
			$("#editar_salario_por_hora").val(salario_hora);
			$("#editar_hora_extra_diurna").val(hora_diurna);
			$("#editar_hora_extra_nocturna").val(hora_nocturna);
			$("#editar_hora_extra_domingo").val(hora_diurna_domingo);
			$("#editar_hora_extra_nocturna_domingo").val(hora_nocturna_domingo);



	}
	else{

			$("#editar_sueldo").val("");
			$("#editar_sueldo_diario").val("");
			$("#editar_salario_por_hora").val("");

		
		/* $(".jefeoperacion_empleado").attr("style","display:none"); */
	
		/* alert("hola"); */
		var hora_diurna=$(".hora_diurna").val();
		var hora_nocturna=$(".hora_nocturna").val();
		var hora_diurna_domingo=$(".hora_diurna_domingo").val();
		var hora_nocturna_domingo=$(".hora_nocturna_domingo").val();
		$("#editar_hora_extra_diurna").val(hora_diurna);
		$("#editar_hora_extra_nocturna").val(hora_nocturna);
		$("#editar_hora_extra_domingo").val(hora_diurna_domingo);
		$("#editar_hora_extra_nocturna_domingo").val(hora_nocturna_domingo);
			/* $("#editar_sueldo").val("");
			$("#editar_sueldo_diario").val("");
			$("#editar_salario_por_hora").val("");
			$("#editar_hora_extra_diurna").val("");
			$("#editar_hora_extra_nocturna").val("");
			$("#editar_hora_extra_domingo").val("");
			$("#editar_hora_extra_nocturna_domingo").val(""); */
	}
  });


  
$('#bancoempleado').on('change', function() {

	var valor1= this.value;
	if(valor1=="13")
	{
		$("#editar_numero_cuenta").mask('0000000000', {reverse: true});
	}
	if($.trim(valor1)=="14")
	{
		/* alert($.trim(valor1)); */
		$("#editar_numero_cuenta").mask('000-000-00-000000-0', {reverse: true});

	}

  });


  });