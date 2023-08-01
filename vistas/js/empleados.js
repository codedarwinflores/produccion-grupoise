$(function () {});

/* ****CAPTURO LA FECHA ACTUAL */
const today = new Date();
const yyyy = today.getFullYear();
let mm = today.getMonth() + 1; // Months start at 0!
let dd = today.getDate();

if (dd < 10) dd = "0" + dd;
if (mm < 10) mm = "0" + mm;

const formattedToday = dd + "-" + mm + "-" + yyyy;
const formatosql = yyyy + "-" + mm + "-" + dd;
/* **************** */

/* COLOCACION DE ICONOS */
$(document).ready(function () {
  $(".ocultarisss").attr("style", "visibility:hidden; height:0");

  $(".pensionado_empleado").on("change", function () {
    var valor = $(this).val();
    if (valor == "Si") {
      $(".ocultarisss").attr("style", "visibility:hidden; height:0");
    } else {
      $(".ocultarisss").attr("style", "visibility:visible; height:100");
    }
  });

  var valor_estado = $(".estadoempleado option:selected").text();

  if (valor_estado == "Contratado") {
    /* ***************************** */
    var nuevocodigo = $(".ultimoempleado").val();
    $("#editarcodigo_empleado").val(nuevocodigo);
    /* ***************************** */
  }

  $(".mostrarimagen").on("click", function () {
    var nombrecolumna = $(this).attr("columna");
    $(".nombre_columna").val(nombrecolumna);
    $("#modificarimagen").modal("show");
  });

  $(".subirimagen").on("click", function () {
    /* 			alert("h");
		var formData = new FormData($("#formudata"));
		$.ajax({
			 url: 'ajax/actualizarempleado.ajax.php',
			 type: "post",
			 data: formData,
			 success: function(response) {alert(response)}
		})
 */

    /* var data = new FormData(document.getElementById('formudata')); */

    /* alert('0.505089');
			$.ajax({
		
				type: 'POST',
				url: 'ajax/actualizarempleado.ajax.php',
				data: $('#formudata').serialize(),
				dataType: 'json',
				success: function(data){
					alert(data)
			
				}
			}); */

    /* 		var imagen= $(".fotos").val();
		var nombre_columna =$(".nombre_columna").val();
		var iddato=$(".iddato").val();
		alert(imagen);

		var parametros = {
			"fotos" : imagen,
			"nombre_columna" : nombre_columna,
			"iddato" : iddato
		
		}; */

    var data = new FormData($("#formudata")[0]);

    $.ajax({
      url: "ajax/actualizarempleado.ajax.php",
      type: "post",
      data: data,
      processData: false,
      contentType: false,
    }).done(function (respuesta) {
      location.reload();
    });
  });

  $(".mostrarerror").attr("style", "display:none;");
  /* CALCULO LA FECHA CUMPLEAÑOS */
  function calculateAge(birthday) {
    var birthday_arr = birthday.split("-");
    var birthday_date = new Date(
      birthday_arr[2],
      birthday_arr[1] - 1,
      birthday_arr[0]
    );
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }
  /* ****************** */

  $("#bancoempleado").on("change", function () {
    var valor1 = this.value;
    if (valor1 == "BANCO AGRICOLA") {
      $("#editar_numero_cuenta").mask("0000-00000-0", { reverse: true });
    }
    if ($.trim(valor1) == "BANCO CUSCATLAN") {
      /* alert($.trim(valor1)); */
      $("#editar_numero_cuenta").mask("000-000-00-000000-0", { reverse: true });
    }
  });

  $("#editarAFPselect").on("change", function () {
    var valor1 = this.value;

    if (valor1 == "") {
    } else {
      $("#editar_descontar_afp").val("SI");
      $("#editar_descontar_afp").text("SI");
    }
    /* 	var valor =  $('select[name="editarCARGO"] option:selected').text() */

    var valor2 = $("#editarAFPselect>option:selected").text();
    if (valor2 == "CONFIA") {
      $("#editarNumeroNup").val("");
      $("#editarNumeroNup").attr("maxlength", "12");
    }
    if (valor2 == "CRECER") {
      $("#editarNumeroNup").val("");
      $("#editarNumeroNup").attr("maxlength", "12");
    }
    if (valor2 == "IPSFA") {
      $("#editarNumeroNup").val("");
      $("#editarNumeroNup").attr("maxlength", "8");
    }
    if (valor2 == "ISSS") {
      $("#editarNumeroNup").val("");
      $("#editarNumeroNup").attr("maxlength", "12");
    }
  });

  $("#editar_sueldo").blur(function () {
    var valor_inicial = $(this).val();
    var periodo = $("#PeriodoPago").val();
    var horas_trabajo = $("#editar_horas_normales_trabajo").val();
    var salario_diario = valor_inicial / Number(periodo);
    /* 	var salario_hora= valor_inicial/240; */
    var salario_hora = salario_diario / horas_trabajo;

    /* $("#editar_sueldo_diario").val(salario_diario.toFixed(2));
			$("#editar_salario_por_hora").val(salario_hora.toFixed(2)); */
    $("#editar_sueldo_diario").val(salario_diario);
    $("#editar_salario_por_hora").val(salario_hora);

    // tu codigo ajax va dentro de esta function...
  });

  $("#PeriodoPago").on("change", function () {
    var valor_inicial = $("#editar_sueldo").val();
    var periodo = $(this).val();
    var salario_diario = valor_inicial / periodo;
    var salario_hora = valor_inicial / 240;

    $("#editar_sueldo_diario").val(salario_diario);
    $("#editar_salario_por_hora").val(salario_hora);
  });

  $("#editarCARGO0").on("change", function () {
    var valor = $('select[name="editarCARGO"] option:selected').text();

    if (valor == "Agente de seguridad") {
      $(".jefeoperacion_empleado").attr("style", "display:block");

      var salario_minimo = $(".salario_minimo").val();
      var salario_diario = $(".salario_diario").val();
      var salario_hora = $(".salario_hora").val();
      var hora_diurna = $(".hora_diurna").val();
      var hora_nocturna = $(".hora_nocturna").val();
      var hora_diurna_domingo = $(".hora_diurna_domingo").val();
      var hora_nocturna_domingo = $(".hora_nocturna_domingo").val();

      $("#editar_sueldo").val(salario_minimo);
      $("#editar_sueldo_diario").val(salario_diario);
      $("#editar_salario_por_hora").val(salario_hora);
      $("#editar_hora_extra_diurna").val(hora_diurna);
      $("#editar_hora_extra_nocturna").val(hora_nocturna);
      $("#editar_hora_extra_domingo").val(hora_diurna_domingo);
      $("#editar_hora_extra_nocturna_domingo").val(hora_nocturna_domingo);
    } else {
      $("#editar_sueldo").val("");
      $("#editar_sueldo_diario").val("");
      $("#editar_salario_por_hora").val("");

      $(".jefeoperacion_empleado").attr("style", "display:none");

      /* alert("hola"); */
      var hora_diurna = $(".hora_diurna").val();
      var hora_nocturna = $(".hora_nocturna").val();
      var hora_diurna_domingo = $(".hora_diurna_domingo").val();
      var hora_nocturna_domingo = $(".hora_nocturna_domingo").val();
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

  /* ************* */

  $(".capturarfechanac").blur(function () {
    $("#ic__datepicker-3").click(function () {
      var valor = $(".capturarfechanac").val();
      if (calculateAge(valor) >= 18) {
        $(".mostrarerror").attr("style", "display:none;");

        /* *********** */

        $(".editarfecha_ingreso").val(formattedToday);
        $(".oficial_editarfecha_ingreso").val(formatosql);

        var telefonoactual = $(".configtelefono").val();
        $("#editarnumero_telefono_trabajo_actual").val(telefonoactual);

        var codigoempleado = $("#editarcodigo_empleado").val();

        /* ****CAPTURO LA FECHA NACIMIENTO */

        var value = $("#editarfecha_nacimiento").val();
        var anio = new Date(value).getFullYear();
        var mes = new Date(value).getMonth() + 1;
        if (mes < 10) mes = "0" + mes;

        anio = anio.toString().substr(-2);

        $("#editarcarnet_empleado").val(codigoempleado + mes + anio);

        /* ***************** */
      } else {
        $(".mostrarerror").attr("style", "display:block; color:red;");
        $(".capturarfechanac").val("");
      }
    });
  });

  /* **************** */

  $(".estadoempleado").on("change", function () {
    var valor = this.value;
    if (valor == "2") {
      var nuevocodigo = $(".ultimoempleado").val();
      $("#editarcodigo_empleado").val(nuevocodigo);

      $(".editarfecha_ingreso").val(formattedToday);
      $(".oficial_editarfecha_ingreso").val(formatosql);

      var telefonoactual = $(".configtelefono").val();
      $("#editarnumero_telefono_trabajo_actual").val(telefonoactual);

      var codigoempleado = $("#editarcodigo_empleado").val();

      /* ****CAPTURO LA FECHA NACIMIENTO */

      var value = $("#editarfecha_nacimiento").val();
      var anio = new Date(value).getFullYear();
      var mes = new Date(value).getMonth() + 1;
      if (mes < 10) mes = "0" + mes;

      anio = anio.toString().substr(-2);

      $("#editarcarnet_empleado").val(codigoempleado + mes + anio);

      /* **************** */
    }
    if (valor == "1") {
      $("#editarcodigo_empleado").val("");
      $(".editarfecha_ingreso").val("");
      $(".oficial_editarfecha_ingreso").val("");

      $("#editarnumero_telefono_trabajo_actual").val("");
      $("#editarcarnet_empleado").val("");
    }
  });

  /* *************** */

  $(".editarexamen_poligrafico").on("change", function () {
    var valor = this.value;
    if (valor == "SI") {
      $(".esconfiable").attr("style", "display:block;");
    }
    if (valor == "NO") {
      $(".esconfiable").attr("style", "display:none;");
    }
  });

  /* ************* */

  $(".serviciomilitar").on("change", function () {
    var valor = this.value;
    if (valor == "SI") {
      $(".noservicio").attr("style", "display:block;");
    }
    if (valor == "NO") {
      $(".noservicio").attr("style", "display:none;");
    }
  });

  $(".editarconstancia_psicologica").on("change", function () {
    var valor = this.value;
    if (valor == "SI") {
      $(".editarnombre_psicologo").attr("style", "display:block;");
    }
    if (valor == "NO") {
      $(".editarnombre_psicologo").attr("style", "display:none;");
    }
  });

  /*   *************** */

  $(".camposexo").on("change", function () {
    var valor = this.value;
    if (valor == "Masculino") {
      $(".apellido_casada").val("");
      $(".apellido_casada").attr("readonly", "readonly");
    } else {
      $(".apellido_casada").removeAttr("readonly");
      $(".apellidocasada").attr("style", "display:block");
    }
  });

  /*   *************** */

  $(".suspendido").on("change", function () {
    var valor = this.value;
    if (valor == "SI") {
      $(".empresasuspencion").removeAttr("readonly");
      $(".fechasuspencion").addClass("calendario");
      $(".nosuspendido").attr("style", "display:block");
    }
    if (valor == "NO") {
      $(".empresasuspencion").attr("readonly", "readonly");
      $(".fechasuspencion").removeClass("calendario");
      $(".nosuspendido").attr("style", "display:none");
    }
  });

  /*   *************** */

  $(".editarCursoANSP").on("change", function () {
    var valor = this.value;
    if (valor == "SI") {
      $(".editarfecha_curso_ansp").attr("style", "display:block;");
      $(".editarfecha_curso_ansp").attr("required", "required");
      $(".editarnumero_aprobacion_ansp").attr("required", "required");
    }
    if (valor == "NO") {
      $(".editarfecha_curso_ansp").attr("style", "display:none;");
      $(".editarfecha_curso_ansp").removeAttr("required", "");
      $(".editarnumero_aprobacion_ansp").removeAttr("required", "");
    }
  });

  /* ****************** */

  $(".editarexamen_poligrafico").on("change", function () {
    var valor = this.value;
    if (valor == "SI") {
      $(".editarFecha_poligrafico").attr("style", "display:block;");
      $(".editarFecha_poligrafico").attr("required", "required");
    }
    if (valor == "NO") {
      $(".editarFecha_poligrafico").attr("style", "display:none;");
      $(".editarFecha_poligrafico").removeAttr("required", "");
    }
  });

  /* ****************** */

  $("#editarCARGO").on("change", function () {
    var valor = this.value;

    if (valor == "Agente de Seguridad") {
      /*  ******** */
      var parametros = {
        val: "",
      };
      /* 			$.ajax({
					data:  parametros,
					url:"ajax/llenardinero.ajax.php",
					type:  'post',
					dataType: "json",
					success:  function (response) {
					
					$("#editar_sueldo").val(response[4]);
					$("#editar_hora_extra_diurna").val(response[0]);
					$("#editar_hora_extra_nocturna").val(response[1]);

					$("#editar_hora_extra_domingo").val(response[2]);
					$("#editar_hora_extra_nocturna_domingo").val(response[3]);
		


					}
			}); */
      /* ********* */
    }
  });

  /* ***************** */

  /* 	  $('.editarBanco').on('change', function() {
		var valor = this.value;
	
		if(valor=="Banco Agricola"){
		
			$("#editar_numero_cuenta").attr("class","form-control input-lg agricola");
			$('.agricola').mask('0000-00000-0', {reverse: true});
		
		}
		if(valor=="Banco Cuscatlan"){

		
			$("#editar_numero_cuenta").attr("class","form-control input-lg cuscatlan");
			$('.cuscatlan').mask('000-000-00-000000-0', {reverse: true});

		}
	  }); */

  /* ***************** */

  $(".solonumero").on("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
});

/*=============================================
SUBIENDO LA FOTO Licencia de portación de arma (LPA)
=============================================*/
$(".imagenlpa").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".imagenlpa").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".imagenlpa").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarimagenlpa").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO b.	Carnet de AFP
=============================================*/
$(".carnetafp").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".carnetafp").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".carnetafp").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarcarnetafp").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO c.	ISSS
=============================================*/
$(".fotoisss").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".fotoisss").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".fotoisss").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarfotoisss").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO d.	Certificado del ANSP
=============================================*/
$(".fotoansp").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".fotoansp").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".fotoansp").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarfotoansp").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DEL EMPLEADO
=============================================*/
$(".nuevaFotoEmp").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoEmp").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoEmp").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DEL DOCUMENTO DE IDENTIDAD
=============================================*/
$(".nuevaFotoDoc").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoDoc").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoDoc").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarDoc").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DE NIT
=============================================*/
$(".nuevaFotoNIT").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoNIT").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoNIT").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarNIT").attr("src", rutaImagen);
    });
  }
});
/*=============================================
SUBIENDO LA FOTO DE LICENCIA TENENCIA ARMAS
=============================================*/
$(".nuevaFotoLicLTA").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoLicLTA").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoLicLTA").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarLicLTA").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DE DIPLOMA ANSP
=============================================*/
$(".nuevaFotoANSP").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoANSP").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoANSP").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarANSP").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DE LA SOLICITUD
=============================================*/
$(".nuevaFotoSOLICITUD").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoSOLICITUD").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoSOLICITUD").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarSOLICITUD").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DE ANTECEDENTES PENALES
=============================================*/
$(".nuevaFotoANTECEDENTES").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoANTECEDENTES").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoANTECEDENTES").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarANTECEDENTES").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DE SOLVENCIA PNC
=============================================*/
$(".nuevaFotoSOLVENCIAPNC").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoSOLVENCIAPNC").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoSOLVENCIAPNC").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarSOLVENCIAPNC").attr("src", rutaImagen);
    });
  }
});

/*=============================================
SUBIENDO LA FOTO DE HUELLAS DIGITALES
=============================================*/
$(".nuevaFotoHUELLAS").change(function () {
  var imagen = this.files[0];
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFotoHUELLAS").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFotoHUELLAS").val("");
    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);
    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;
      $(".previsualizarHUELLAS").attr("src", rutaImagen);
    });
  }
});

/*=============================================
EDITAR EMPLEADO
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleado", function () {
  var idEmpleado = $(this).attr("idEmpleado");

  var datos = new FormData();
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "ajax/empleados.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#idEmpleado").val(respuesta["id"]);
      if (respuesta["fotografia"] != "") {
        $(".previsualizarEditar").attr("src", respuesta["fotografia"]);
      } else {
        $(".previsualizarEditar").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActual").val(respuesta["fotografia"]);

      $("#editarNombre").val(respuesta["primer_nombre"]);
      $("#editarSegundoNombre").val(respuesta["segundo_nombre"]);
      $("#editarTercerNombre").val(respuesta["tercer_nombre"]);
      $("#editarPrimerApellido").val(respuesta["primer_apellido"]);
      $("#editarSegundoApellido").val(respuesta["segundo_apellido"]);
      $("#editarApellidoCasada").val(respuesta["apellido_casada"]);

      $("#editarEstadoCivil").html(respuesta["estado_civil"]);
      $("#editarEstadoCivil").val(respuesta["estado_civil"]);

      $("#editarSexo").html(respuesta["sexo"]);
      $("#editarSexo").val(respuesta["sexo"]);

      $("#editarDireccion").val(respuesta["direccion"]);

      $("#editarpantalon_empleado").val(respuesta["pantalon_empleado"]);
      $("#editarcamisa_empleado").val(respuesta["camisa_empleado"]);
      $("#editarzapatos_empleado").val(respuesta["zapatos_empleado"]);

      $("#recomendado_val").val(respuesta["recomendado_empleado"]);
      $("#select2-editarrecomendado_empleado-container").text(
        respuesta["recomendado_empleado"]
      );

      $("#editarcontacto_empleado").val(respuesta["contacto_empleado"]);
      $("#editardocumentacion_empleado").val(
        respuesta["documentacion_empleado"]
      );
      $("#editaransp_empleado").val(respuesta["ansp_empleado"]);
      $("#editaruniformeregalado_empleado").val(
        respuesta["uniformeregalado_empleado"]
      );

      //poblar editar Departamento
      iddepartamento = respuesta["id_departamento"];
      var datosDep = new FormData();
      datosDep.append("idDepartamento", iddepartamento);
      $.ajax({
        url: "ajax/departamentos3.ajax.php",
        method: "POST",
        data: datosDep,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDep) {
          myArray = respuestaDep.split(",");
          $("#editarDepartamento").html(myArray[1]);
          $("#editarDepartamento").val(myArray[0]);
        },
      });

      //poblar editar municipio
      idmunicipio = respuesta["id_municipio"];
      var datosMun = new FormData();
      datosMun.append("idMunicipio", idmunicipio);
      $.ajax({
        url: "ajax/municipio4.ajax.php",
        method: "POST",
        data: datosMun,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaMun) {
          //alert(respuestaMun);
          myArray = respuestaMun.split(",");
          $("#editarMunicipio").html(myArray[1]);
          $("#editarMunicipio").val(respuesta["id_municipio"]);
        },
      });

      $("#editarTipoDocumento").html(respuesta["documento_identidad"]);
      $("#editarTipoDocumento").val(respuesta["documento_identidad"]);

      $("#editarNumeroDocumento").val(respuesta["numero_documento_identidad"]);

      $("#editarNumeroTelefono").val(respuesta["telefono"]);
      $("#editarNumeroIsss").val(respuesta["numero_isss"]);
      $("#editarNombreIsss").val(respuesta["nombre_segun_isss"]);
      $("#editarLugarExpedicionDoc").val(
        respuesta["lugar_expedicion_documento"]
      );

      var date0 = respuesta["fecha_expedicion_documento"];
      var formattedDate = new Date(date0);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafecha").val(respuesta["fecha_expedicion_documento"]);
        $("#editarfecha_expedicion").val(
          respuesta["fecha_expedicion_documento"]
        );
      }

      var date1 = respuesta["fecha_vencimiento_documento"];
      var formattedDate = new Date(date1);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
        $("#mascarafechav").val("");
        $("#editarfecha_vencimiento").val("");
      } else {
        $("#mascarafechav").val(respuesta["fecha_vencimiento_documento"]);
        $("#editarfecha_vencimiento").val(
          respuesta["fecha_vencimiento_documento"]
        );
      }

      var date2 = respuesta["fecha_nacimiento"];
      var formattedDate = new Date(date2);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechanac").val(respuesta["fecha_nacimiento"]);
        $("#editarfecha_nacimiento").val(respuesta["fecha_nacimiento"]);
      }

      $("#editarNumeroLicenciaConducir").val(respuesta["licencia_conducir"]);

      $("#editarTipoLicenciaConducir").html(
        respuesta["tipo_licencia_conducir"]
      );
      $("#editarTipoLicenciaConducir").val(respuesta["tipo_licencia_conducir"]);

      $("#editarNumeroNit").val(respuesta["nit"]);

      if (respuesta["imagen_nit"] != "") {
        $(".previsualizarEditarNIT").attr("src", respuesta["imagen_nit"]);
      } else {
        $(".previsualizarEditarNIT").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualNIT").val(respuesta["imagen_nit"]);

      //BUSCAR EL NOMBRE DE LA AFP SEGUN EL CODIGO QUE TENEMOS
      var datosAFP = new FormData();
      datosAFP.append("codigo_afp", respuesta["codigo_afp"]);
      $.ajax({
        url: "ajax/afp.ajax.php",
        method: "POST",
        data: datosAFP,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaAFP) {
          $("#editarAFP").html(respuestaAFP[2]);
          $("#editarAFP").val(respuestaAFP[1]);
        },
      });

      $("#editarNumeroNup").val(respuesta["nup"]);
      $("#editarProfesionOficio").val(respuesta["profesion_oficio"]);
      $("#editarNacionalidad").val(respuesta["nacionalidad"]);
      $("#editarLugarNac").val(respuesta["lugar_nacimiento"]);
      $("#editarReligion").val(respuesta["religion"]);
      $("#editarGradoEstudios").val(respuesta["grado_estudio"]);
      $("#editarPlantel").val(respuesta["plantel"]);
      $("#editarPeso").val(respuesta["peso"]);
      $("#editarEstatura").val(respuesta["estatura"]);
      $("#editarPiel").val(respuesta["piel"]);
      $("#editarOjos").val(respuesta["ojos"]);
      $("#editarCabello").val(respuesta["cabello"]);
      $("#editarCara").val(respuesta["cara"]);

      $("#editarTipoSangre").val(respuesta["tipo_sangre"]);
      $("#editarTipoSangre").html(respuesta["tipo_sangre"]);

      $("#editarSenalesEspeciales").val(respuesta["senales_especiales"]);

      $("#editarLicenciaTDA").val(respuesta["licencia_tenencia_armas"]);
      $("#editarLicenciaTDA").html(respuesta["licencia_tenencia_armas"]);
      $("#editarNumeroLicenciaTDA").val(
        respuesta["numero_licencia_tenencia_armas"]
      );

      if (respuesta["imagen_licencia_tenencia_armas"] != "") {
        $(".previsualizarEditarLicLTA").attr(
          "src",
          respuesta["imagen_licencia_tenencia_armas"]
        );
      } else {
        $(".previsualizarEditarLicLTA").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualLicLTA").val(respuesta["imagen_licencia_tenencia_armas"]);

      $("#editarServicioMilitar").val(respuesta["servicio_militar"]);
      $("#editarServicioMilitar").html(respuesta["servicio_militar"]);

      var date3 = respuesta["fecha_servicio_inicio"];
      var formattedDate = new Date(date3);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechainism").val(respuesta["fecha_servicio_inicio"]);
        $("#editarfecha_inism").val(respuesta["fecha_servicio_inicio"]);
      }

      var date4 = respuesta["fecha_servicio_fin"];
      var formattedDate = new Date(date4);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechafinsm").val(respuesta["fecha_servicio_fin"]);
        $("#editarfecha_finsm").val(respuesta["fecha_servicio_fin"]);
      }

      $("#editarLugarServicioMilitar").val(respuesta["lugar_servicio"]);
      $("#editarGradoMilitar").val(respuesta["grado_militar"]);
      $("#editarMotivoBaja").val(respuesta["motivo_baja"]);

      $("#editarExPNC").val(respuesta["ex_pnc"]);
      $("#editarExPNC").html(respuesta["ex_pnc"]);

      if (respuesta["imagen_diploma_ansp"] != "") {
        $(".previsualizarEditarANSP").attr(
          "src",
          respuesta["imagen_diploma_ansp"]
        );
      } else {
        $(".previsualizarEditarANSP").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualANSP").val(respuesta["imagen_diploma_ansp"]);

      $("#editarCursoANSP").val(respuesta["curso_ansp"]);
      $("#editarCursoANSP").html(respuesta["curso_ansp"]);

      $("#editarTrabajoAnterior").val(respuesta["trabajo_anterior"]);
      $("#editarSueldoDevengo").val(respuesta["sueldo_que_devengo"]);
      $("#editarTrabajoActual").val(respuesta["trabajo_actual"]);
      $("#editarSueldoDevenga").val(respuesta["sueldo_que_devenga"]);

      $("#editarSuspendidoAnterior").val(
        respuesta["suspendido_trabajo_anterior"]
      );
      $("#editarSuspendidoAnterior").html(
        respuesta["suspendido_trabajo_anterior"]
      );

      $("#editarEmpresaSuspendio").val(respuesta["empresa_suspendio"]);
      $("#editarMotivoSuspension").val(respuesta["motivo_suspension"]);

      var date5 = respuesta["fecha_suspension"];
      var formattedDate = new Date(date5);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechasusp").val(respuesta["fecha_suspension"]);
        $("#editarfecha_susp").val(respuesta["fecha_suspension"]);
      }

      $("#editarExperienciaLaboral").val(respuesta["experiencia_laboral"]);
      $("#editarRazonIse").val(respuesta["razon_trabajar_en_ise"]);
      $("#editarPersonasDependientes").val(
        respuesta["numero_personas_dependientes"]
      );
      $("#editarObservaciones").val(respuesta["observaciones"]);
      $("#editarNumTelTrabajoAnterior").val(
        respuesta["telefono_trabajo_anterior"]
      );
      $("#editarTrabajoActual").val(respuesta["telefono_trabajo_actual"]);
      $("#editarNomRefTrabajoAnterior").val(respuesta["referencia_anterior"]);
      $("#editarEvaluacionAnterior").val(respuesta["evaluacion_anterior"]);
      $("#editarNomRefTrabajoActual").val(respuesta["referencia_actual"]);
      $("#editarEvaluacionActual").val(respuesta["evaluacion_actual"]);

      $("#editarInfoVerificada").val(respuesta["info_verificada"]);
      $("#editarInfoVerificada").html(respuesta["info_verificada"]);

      if (respuesta["imagen_solicitud"] != "") {
        $(".previsualizarEditarSOLICITUD").attr(
          "src",
          respuesta["imagen_solicitud"]
        );
      } else {
        $(".previsualizarEditarSOLICITUD").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualSOLICITUD").val(respuesta["imagen_solicitud"]);

      if (respuesta["imagen_antecedentes_penales"] != "") {
        $(".previsualizarEditarANTECEDENTES").attr(
          "src",
          respuesta["imagen_antecedentes_penales"]
        );
      } else {
        $(".previsualizarEditarANTECEDENTES").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualANTECEDENTES").val(
        respuesta["imagen_antecedentes_penales"]
      );

      var date6 = respuesta["fecha_vencimiento_antecedentes_penales"];
      var formattedDate = new Date(date6);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechavenceAP").val(
          respuesta["fecha_vencimiento_antecedentes_penales"]
        );
        $("#editarfecha_venceAP").val(
          respuesta["fecha_vencimiento_antecedentes_penales"]
        );
      }

      if (respuesta["imagen_solvencia_pnc"] != "") {
        $(".previsualizarEditarSOLVENCIAPNC").attr(
          "src",
          respuesta["imagen_solvencia_pnc"]
        );
      } else {
        $(".previsualizarEditarSOLVENCIAPNC").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualSOLVENCIAPNC").val(respuesta["imagen_solvencia_pnc"]);

      var date7 = respuesta["fecha_vencimiento_solvencia_pnc"];
      var formattedDate = new Date(date7);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechavenceSPNC").val(
          respuesta["fecha_vencimiento_solvencia_pnc"]
        );
        $("#editarfecha_venceSPNC").val(
          respuesta["fecha_vencimiento_solvencia_pnc"]
        );
      }

      if (respuesta["imagen_huellas"] != "") {
        $(".previsualizarEditarHUELLAS").attr(
          "src",
          respuesta["imagen_huellas"]
        );
      } else {
        $(".previsualizarEditarHUELLAS").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualHUELLAS").val(respuesta["imagen_huellas"]);

      $("#editarConfiable").val(respuesta["confiable"]);
      $("#editarConfiable").html(respuesta["confiable"]);

      //FOTO ACTUAL DEL DOCUMENTO DE IDENTIDAD
      if (respuesta["imagen_documento_identidad"] != "") {
        $(".previsualizarEditarDoc").attr(
          "src",
          respuesta["imagen_documento_identidad"]
        );
      } else {
        $(".previsualizarEditarDoc").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualDoc").val(respuesta["imagen_documento_identidad"]);

      //REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
      if (respuesta["estado"] == 1) {
        $("#editarEstado").html("Solicitud");
      } else if (respuesta["estado"] == 2) {
        $("#editarEstado").html("Contratado");
      } else if (respuesta["estado"] == 3) {
        $("#editarEstado").html("Inactivo");
      } else if (respuesta["estado"] == 4) {
        $("#editarEstado").html("Incapacitado");
      } else {
        $("#editarEstado").html("Error");
      }
      $("#editarEstado").val(respuesta["estado"]);

      //BUSCAR EL NOMBRE DEL CARGO SEGUN EL CODIGO QUE TENEMOS
      var datosCARGO = new FormData();
      datosCARGO.append("nivel", respuesta["nivel_cargo"]);
      $.ajax({
        url: "ajax/cargos.ajax.php",
        method: "POST",
        data: datosCARGO,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaCARGO) {
          $("#editarCARGO").html(respuestaCARGO[1]);
          $("#editarCARGO").val(respuestaCARGO[2]);
        },
      });
    },
  });
});

$(".departamento").on("change", function () {
  poblarMuni();
});

/*=============================================
CAMBIO DE DEPARTAMENTO POBLAR MUNICIPIO
=============================================*/
function poblarMuni() {
  iddepartamento = $(".departamento").val();
  /* LLENAR MUNICIPIO */
  var datos = new FormData();
  datos.append("idmunicipios", iddepartamento);
  $.ajax({
    url: "ajax/municipio3.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(".municipios").empty();
      myArray = respuesta.split(";");
      var arrayLength = myArray.length;
      for (var i = 0; i < arrayLength; i++) {
        idName = myArray[i].split(",");
        //alert(idName[1]);
        $(".municipios").append(
          $("<option>", {
            value: idName[0],
            text: idName[1],
          })
        );
      }
    },
  });
}

/*=============================================
CAMBIO DE DEPARTAMENTO POBLAR MUNICIPIO EDITAR
=============================================*/
function poblarMuniEditar() {
  iddepartamento = document.getElementById("editarDepartamento").value;
  /* LLENAR MUNICIPIO */
  //alert(iddepartamento);
  var datosm = new FormData();
  datosm.append("idmunicipios", iddepartamento);
  $.ajax({
    url: "ajax/municipio3.ajax.php",
    method: "POST",
    data: datosm,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuestam) {
      $("#editarMunicipio").empty();
      myArray = respuestam.split(";");
      var arrayLength = myArray.length;
      for (var i = 0; i < arrayLength; i++) {
        idName = myArray[i].split(",");

        $("#editarMunicipio").append(
          $("<option>", {
            value: idName[0],
            text: idName[1],
          })
        );
      }
    },
  });
}

/*=============================================
REVISAR SI EL EMPLEADO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNumeroDocumento").change(function () {
  $(".alert").remove();

  var empleado = $(this).val();

  var datos = new FormData();
  datos.append("validarEmpleado", empleado);

  $.ajax({
    url: "ajax/empleados.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoNumeroDocumento")
          .parent()
          .after(
            '<div class="alert alert-warning">Este Empleado ya existe en la base de datos</div>'
          );

        $("#nuevoNumeroDocumento").val("");
      }
    },
  });
});

/*=============================================
ELIMINAR EMPLEADO
=============================================*/
$(".tablas").on("click", ".btnEliminarEmpleado", function () {
  var idEmpleado = $(this).attr("idEmpleado");
  var fotoEmpleado = $(this).attr("fotoEmpleado");
  var empleado = $(this).attr("empleado");

  swal({
    title: "¿Está seguro de borrar el empleado?",
    text: "¡Si no lo está puede cancelar la accíón!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar empleado!",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?ruta=empleados&idEmpleado=" +
        idEmpleado +
        "&empleado=" +
        empleado +
        "&fotoEmpleado=" +
        fotoEmpleado;
    }
  });
});

/*=============================================
IMPRIMIR CCF
=============================================*/

$(".tablas").on("click", ".btnImprimirImagenes", function () {
  var documentoEmpleado = $(this).attr("empleado");

  //alert(documentoEmpleado);
  var form = $(
    '<form action="imprimirimagenes" method="post">' +
      '<input type="text" name="numDoc" value="' +
      documentoEmpleado +
      '" />' +
      "</form>"
  );
  $("body").append(form);
  form.submit();

  //var codigoVenta = $(this).attr("codigoVenta");

  //window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");
});

$(".fotoaImprimir").click(function () {
  var direccionFotoImprimir = $(this).attr("fotoaImprimir");
  //alert(direccionFotoImprimir);
  $(".previsualizarImagenaImprimir").attr("src", direccionFotoImprimir);
});

$("#btnGuardarEmpleado").click(function () {
  //document.getElementById("btnGuardarEmpleado").style.display = "none";
});

$(".btnParentesco").click(function () {
  //asignar el valor al hidden del form parentesco
  var idParentescoEmpleado = $(this).attr("idEmpleado");
  document.getElementById("idEmpleadoParentesco").value = idParentescoEmpleado;

  //mostrar los datos generales de empleado con ajax
  //tambien traer los parientes ya registrados en <html>
  var datosParentesco = new FormData();
  datosParentesco.append("id_empleado", idParentescoEmpleado);
  $.ajax({
    url: "ajax/empleados_parentesco.ajax.php",
    method: "POST",
    data: datosParentesco,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaParentesco) {
      document.getElementById("headerParentesco").innerHTML =
        respuestaParentesco;

      $(".editarEdadParentesco").addClass("calendario");

      $(".calendario").ionDatePicker({
        lang: "es",
      });
    },
  });
});
/*=============================================
EDITAR PARIENTE
=============================================*/

function editarPariente(idPariente) {
  var datosParentesco = new FormData();
  datosParentesco.append("bandera_editar", "editar");
  datosParentesco.append("id_pariente", idPariente);
  datosParentesco.append(
    "parentesco",
    document.getElementById("editarParentesco" + idPariente).value
  );
  datosParentesco.append(
    "nombre",
    document.getElementById("editarNombreParentesco" + idPariente).value
  );
  datosParentesco.append(
    "edad",
    document.getElementById("editarEdadParentesco" + idPariente).value
  );
  datosParentesco.append(
    "con_vida",
    document.getElementById("editarConVidaParentesco" + idPariente).value
  );
  datosParentesco.append(
    "direccion",
    document.getElementById("editarDireccionParentesco" + idPariente).value
  );
  datosParentesco.append(
    "telefono",
    document.getElementById("editarTelefonoParentesco" + idPariente).value
  );
  $.ajax({
    url: "ajax/empleados_parentesco.ajax.php",
    method: "POST",
    data: datosParentesco,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaParentesco) {
      //alert(respuestaParentesco);
      if (respuestaParentesco == "0") {
        //alert("Pariente eliminado correctamente");
        swal({
          type: "success",
          title: "Pariente ha sido editado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "empleados";
          }
        });
      } else {
        alert("Pariente no pudo editarse");
        location.reload();
      }
    },
  });
}

/*=============================================
ELIMINAR PARIENTE
=============================================*/

function eliminarPariente(idPariente) {
  var datosParentesco = new FormData();
  datosParentesco.append("id_pariente", idPariente);
  datosParentesco.append("bandera_eliminar", "eliminar");
  $.ajax({
    url: "ajax/empleados_parentesco.ajax.php",
    method: "POST",
    data: datosParentesco,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaParentesco) {
      if (respuestaParentesco == "0") {
        //alert("Pariente eliminado correctamente");
        swal({
          type: "success",
          title: "Pariente ha sido eliminado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "empleados";
          }
        });
      } else {
        alert("Pariente no pudo eliminarse");
        location.reload();
      }
    },
  });
}

/*=============================================
EDITAR DEVENGO O DESCUENTO
=============================================*/

function editarDD(idDD) {
  var datosDD = new FormData();
  datosDD.append("bandera_editar", "editar");
  datosDD.append("id_descuento", idDD);
  datosDD.append(
    "id_tipo_devengo_descuento",
    document.getElementById("editarTipoDD" + idDD).value
  );
  datosDD.append(
    "valor",
    document.getElementById("editarValorDD" + idDD).value
  );
  datosDD.append(
    "fecha_caducidad",
    document.getElementById("editarFechaCaducidadDD" + idDD).value
  );
  datosDD.append(
    "referencia",
    document.getElementById("editarReferenciaDD" + idDD).value
  );
  datosDD.append(
    "referencia",
    document.getElementById("editarReferenciaDD" + idDD).value
  );
  datosDD.append(
    "tipodescuento",
    document.getElementById("editartipodescuento" + idDD).value
  );

  $.ajax({
    url: "ajax/empleados_descuento.ajax.php",
    method: "POST",
    data: datosDD,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaDescuento) {
      if (respuestaDescuento == "0") {
        //alert("Pariente eliminado correctamente");
        swal({
          type: "success",
          title: "El Registro ha sido editado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "empleados";
          }
        });
      } else {
        alert("No pudo editarse el registro");
        location.reload();
      }
    },
  });
}
/*=============================================
ELIMINAR DESCUENTO O DEVENGO
=============================================*/

function eliminarEmpleadodescuento(idDescuentoEmpleado) {
  var datosEliminarDewscuento = new FormData();
  datosEliminarDewscuento.append("id_descuento", idDescuentoEmpleado);
  datosEliminarDewscuento.append("bandera_eliminar", "eliminar");
  $.ajax({
    url: "ajax/empleados_descuento.ajax.php",
    method: "POST",
    data: datosEliminarDewscuento,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaDescuento) {
      if (respuestaDescuento == "0") {
        //alert("Pariente eliminado correctamente");
        swal({
          type: "success",
          title: "El Descuento ha sido eliminado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "empleados";
          }
        });
      } else {
        alert("El Descuento no pudo eliminarse");
        location.reload();
      }
    },
  });
}

/*=============================================
CLICK BTN SEMINARIOS
=============================================*/
$(".btnSeminarios").click(function () {
  //asignar el valor al hidden del form parentesco
  var idEmpleadoSeminario = $(this).attr("idEmpleado");
  document.getElementById("idEmpleadoSeminario").value = idEmpleadoSeminario;

  //mostrar los datos generales de empleado con ajax
  //tambien traer los parientes ya registrados en <html>

  var datosEmpleadoSeminario = new FormData();
  datosEmpleadoSeminario.append("id_empleado", idEmpleadoSeminario);
  $.ajax({
    url: "ajax/empleados_seminarios.ajax.php",
    method: "POST",
    data: datosEmpleadoSeminario,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaEmpleadosSeminarios) {
      document.getElementById("headerEmpleadoSeminario").innerHTML =
        respuestaEmpleadosSeminarios;
    },
  });
});

/*=============================================
ELIMINAR SEMINARIO
=============================================*/

function eliminarEmpleadoseminario(idSeminarioEmpleado) {
  var datosEliminarSeminario = new FormData();
  datosEliminarSeminario.append("id_seminario", idSeminarioEmpleado);
  datosEliminarSeminario.append("bandera_eliminar", "eliminar");
  $.ajax({
    url: "ajax/empleados_seminarios.ajax.php",
    method: "POST",
    data: datosEliminarSeminario,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "text",
    success: function (respuestaSeminario) {
      if (respuestaSeminario == "0") {
        //alert("Pariente eliminado correctamente");
        swal({
          type: "success",
          title: "El Seminario ha sido eliminado correctamente!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "empleados";
          }
        });
      } else {
        alert("El Seminario no pudo eliminarse");
        location.reload();
      }
    },
  });
}

/*=============================================
deshabilitarOpcionesSuspension
=============================================*/
function deshabilitarOpcionesSuspension() {
  if (document.getElementById("nuevoSuspendidoAnterior").value == "SI") {
    document.getElementById("nuevoEmpresaSuspendio").disabled = false;
    document.getElementById("nuevoMotivoSuspension").disabled = false;
    document.getElementById("fechasuspnew").disabled = false;
  } else {
    document.getElementById("nuevoEmpresaSuspendio").disabled = true;
    document.getElementById("nuevoMotivoSuspension").disabled = true;
    document.getElementById("fechasuspnew").disabled = true;
  }
}

/*=============================================
deshabilitarOpcionesSuspensionEditar
=============================================*/
function deshabilitarOpcionesSuspensionEditar() {
  if (document.getElementById("editarSuspendidoAnterior").value == "SI") {
    document.getElementById("editarEmpresaSuspendio").disabled = false;
    document.getElementById("editarMotivoSuspension").disabled = false;
    document.getElementById("mascarafechasusp").disabled = false;
  } else {
    document.getElementById("editarEmpresaSuspendio").disabled = true;
    document.getElementById("editarMotivoSuspension").disabled = true;
    document.getElementById("mascarafechasusp").disabled = true;
  }
}

/*=============================================
CANDIDATO
=============================================*/

document
  .getElementById("btnAgregarCandidato")
  .addEventListener("click", function () {
    var form = $('<form action="candidatos" method="post">' + "</form>");
    $("body").append(form);
    form.submit();
  });

/*=============================================
CONTRATACION
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleado", function () {
  var idEmpleado = $(this).attr("idEmpleado");
  var form = $(
    '<form action="contratacion" method="post">' +
      '<input type="text" name="idEmpleado" value="' +
      idEmpleado +
      '" />' +
      "</form>"
  );
  $("body").append(form);
  form.submit();
});

function poblarFormulario(idEmpleado) {
  var datos = new FormData();
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "ajax/empleados.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta["constancia_psicologica"] == "SI") {
        $(".editarnombre_psicologo").attr("style", "display:block;");
      }
      if (respuesta["curso_ansp"] == "SI") {
        $(".fecha_ansp").attr("style", "display:block;");
      }
      if (respuesta["examen_poligrafico"] == "SI") {
        $(".editarFecha_poligrafico").attr("style", "display:block;");
      }
      if (respuesta["id_jefe_operaciones"] == "") {
      } else {
        $(".jefeoperacion_empleado").attr("style", "display:block;");
      }

      /* update */
      $("#editarconstancia_psicologica").val(
        respuesta["constancia_psicologica"]
      );
      $("#editarnombre_psicologo").val(respuesta["nombre_psicologo"]);
      $("#editarfecha_curso_ansp").val(respuesta["fecha_curso_ansp"]);
      $("#editarnumero_aprobacion_ansp").val(
        respuesta["numero_aprobacion_ansp"]
      );
      $("#editarexamen_poligrafico").val(respuesta["examen_poligrafico"]);
      $("#editarFecha_poligrafico").val(respuesta["Fecha_poligrafico"]);
      $("#editarantecedente_policial").val(respuesta["antecedente_policial"]);
      $("#editarCARGO0").val(respuesta["nivel_cargo"]);
      $("#editarcodigo_empleado").val(respuesta["codigo_empleado"]);
      $("#editarluaf").val(respuesta["luaf"]);
      $("#pensionado_empleado").val(respuesta["pensionado_empleado"]);

      if (respuesta["pensionado_empleado"] == "Si") {
        $(".ocultarisss").attr("style", "visibility:hidden; height:0");
      } else {
        $(".ocultarisss").attr("style", "visibility:visible; height:100");
      }

      if (respuesta["fotoansp"] != "") {
        $(".previsualizarfotoansp").attr("src", respuesta["fotoansp"]);
      } else {
        $(".previsualizarfotoansp").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }

      if (respuesta["fotoisss"] != "") {
        $(".previsualizarfotoisss").attr("src", respuesta["fotoisss"]);
      } else {
        $(".previsualizarfotoisss").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }

      if (respuesta["imagenlpa"] != "") {
        $(".previsualizarimagenlpa").attr("src", respuesta["imagenlpa"]);
      } else {
        $(".previsualizarimagenlpa").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }

      if (respuesta["carnetafp"] != "") {
        $(".previsualizarcarnetafp").attr("src", respuesta["carnetafp"]);
      } else {
        $(".previsualizarcarnetafp").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }

      /* $("#editarnumero_telefono_trabajo_actual").val(respuesta["numero_telefono_trabajo_actual"]); */
      $("#editarcarnet_empleado").val(respuesta["carnet_empleado"]);
      if (respuesta["sexo"] == "Masculino") {
        $(".apellidocasada").attr("style", "display:none");
      } else {
        $(".apellidocasada").attr("style", "display:block");
      }

      $("#editar_sueldo").val(respuesta["sueldo"]);
      $("#editar_sueldo_diario").val(respuesta["sueldo_diario"]);
      $("#editar_salario_por_hora").val(respuesta["salario_por_hora"]);
      $("#editar_hora_extra_diurna").val(respuesta["hora_extra_diurna"]);
      $("#editar_hora_extra_nocturna").val(respuesta["hora_extra_nocturna"]);
      $("#editar_hora_extra_domingo").val(respuesta["hora_extra_domingo"]);
      $("#editar_hora_extra_nocturna_domingo").val(
        respuesta["hora_extra_nocturna_domingo"]
      );

      if (respuesta["idconfiguracion"] == null) {
        /* var hora_diurna=$(".hora_diurna").val();
				var hora_nocturna=$(".hora_nocturna").val();
				var hora_diurna_domingo=$(".hora_diurna_domingo").val();
				var hora_nocturna_domingo=$(".hora_nocturna_domingo").val();
				$("#editar_hora_extra_diurna").val(hora_diurna);
				$("#editar_hora_extra_nocturna").val(hora_nocturna);
				$("#editar_hora_extra_domingo").val(hora_diurna_domingo);
				$("#editar_hora_extra_nocturna_domingo").val(hora_nocturna_domingo); */
      } else {
        /* 	var idcargo=$(".idcargo").val();
				if(respuesta["nivel_cargo"]==idcargo){


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
				else{ */
        /* 					$("#editar_hora_extra_diurna").val(respuesta["hora_extra_diurna"]);
					$("#editar_hora_extra_nocturna").val(respuesta["hora_extra_nocturna"]);
					$("#editar_hora_extra_domingo").val(respuesta["hora_extra_domingo"]);
					$("#editar_hora_extra_nocturna_domingo").val(respuesta["hora_extra_nocturna_domingo"]); */
        /* 		var hora_diurna=$(".hora_diurna").val();
					var hora_nocturna=$(".hora_nocturna").val();
					var hora_diurna_domingo=$(".hora_diurna_domingo").val();
					var hora_nocturna_domingo=$(".hora_nocturna_domingo").val(); */
        /* 	
				}
 */
      }

      var dato = respuesta["servicio_militar"];
      if (dato == "NO") {
        $(".noservicio").attr("style", "display:none;");
      }

      if (respuesta["estado"] == 2) {
        var telefonoactual = $(".configtelefono").val();
        $("#editarnumero_telefono_trabajo_actual").val(telefonoactual);
      }

      $("#idEmpleado").val(respuesta["id"]);
      if (respuesta["fotografia"] != "") {
        $(".previsualizarEditar").attr("src", respuesta["fotografia"]);
      } else {
        $(".previsualizarEditar").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActual").val(respuesta["fotografia"]);

      $("#editarNombre").val(respuesta["primer_nombre"]);
      $("#editarSegundoNombre").val(respuesta["segundo_nombre"]);
      $("#editarTercerNombre").val(respuesta["tercer_nombre"]);
      $("#editarPrimerApellido").val(respuesta["primer_apellido"]);
      $("#editarSegundoApellido").val(respuesta["segundo_apellido"]);
      $("#editarApellidoCasada").val(respuesta["apellido_casada"]);

      $("#editarEstadoCivil").html(respuesta["estado_civil"]);
      $("#editarEstadoCivil").val(respuesta["estado_civil"]);

      $("#editarSexo").html(respuesta["sexo"]);
      $("#editarSexo").val(respuesta["sexo"]);

      $("#editarDireccion").val(respuesta["direccion"]);

      $("#editarpantalon_empleado").val(respuesta["pantalon_empleado"]);
      $("#editarcamisa_empleado").val(respuesta["camisa_empleado"]);
      $("#editarzapatos_empleado").val(respuesta["zapatos_empleado"]);
      $("#editarrecomendado_empleado").val(respuesta["recomendado_empleado"]);
      $("#editarcontacto_empleado").val(respuesta["contacto_empleado"]);
      $("#editardocumentacion_empleado").val(
        respuesta["documentacion_empleado"]
      );
      $("#editaransp_empleado").val(respuesta["ansp_empleado"]);
      $("#editaruniformeregalado_empleado").val(
        respuesta["uniformeregalado_empleado"]
      );

      //poblar editar Departamento
      iddepartamento = respuesta["id_departamento"];
      var datosDep = new FormData();
      datosDep.append("idDepartamento", iddepartamento);
      $.ajax({
        url: "ajax/departamentos3.ajax.php",
        method: "POST",
        data: datosDep,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDep) {
          myArray = respuestaDep.split(",");
          $("#editarDepartamento").html(myArray[1]);
          $("#editarDepartamento").val(myArray[0]);

          var texto = $("#editarDepartamento").text();
          $("#showdepa").val(texto);
        },
      });

      //poblar editar municipio
      idmunicipio = respuesta["id_municipio"];
      var datosMun = new FormData();
      datosMun.append("idMunicipio", idmunicipio);
      $.ajax({
        url: "ajax/municipio4.ajax.php",
        method: "POST",
        data: datosMun,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaMun) {
          //alert(respuestaMun);
          myArray = respuestaMun.split(",");
          $("#editarMunicipio").html(myArray[1]);
          $("#editarMunicipio").val(respuesta["id_municipio"]);

          var texto = $("#editarMunicipio").text();
          $("#showmunicipio").val(texto);
        },
      });

      $("#editarTipoDocumento").html(respuesta["documento_identidad"]);
      $("#editarTipoDocumento").val(respuesta["documento_identidad"]);

      $("#editarNumeroDocumento").val(respuesta["numero_documento_identidad"]);

      $("#editarNumeroTelefono").val(respuesta["telefono"]);
      $("#editarNumeroIsss").val(respuesta["numero_isss"]);
      $("#editarNombreIsss").val(respuesta["nombre_segun_isss"]);
      $("#editarLugarExpedicionDoc").val(
        respuesta["lugar_expedicion_documento"]
      );

      var date0 = respuesta["fecha_expedicion_documento"];
      var formattedDate = new Date(date0);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafecha").val(respuesta["fecha_expedicion_documento"]);
        $("#editarfecha_expedicion").val(
          respuesta["fecha_expedicion_documento"]
        );
      }

      var date1 = respuesta["fecha_vencimiento_documento"];
      var formattedDate = new Date(date1);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
        $("#mascarafechav").val("");
        $("#editarfecha_vencimiento").val("");
      } else {
        $("#mascarafechav").val(respuesta["fecha_vencimiento_documento"]);
        $("#editarfecha_vencimiento").val(
          respuesta["fecha_vencimiento_documento"]
        );
      }

      var date2 = respuesta["fecha_nacimiento"];
      var formattedDate = new Date(date2);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechanac").val(respuesta["fecha_nacimiento"]);
        $("#editarfecha_nacimiento").val(respuesta["fecha_nacimiento"]);
      }

      $("#editarNumeroLicenciaConducir").val(respuesta["licencia_conducir"]);

      $("#editarTipoLicenciaConducir").html(
        respuesta["tipo_licencia_conducir"]
      );
      $("#editarTipoLicenciaConducir").val(respuesta["tipo_licencia_conducir"]);

      $("#editarNumeroNit").val(respuesta["nit"]);

      if (respuesta["imagen_nit"] != "") {
        $(".previsualizarEditarNIT").attr("src", respuesta["imagen_nit"]);
      } else {
        $(".previsualizarEditarNIT").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualNIT").val(respuesta["imagen_nit"]);

      //BUSCAR EL NOMBRE DE LA AFP SEGUN EL CODIGO QUE TENEMOS
      var datosAFP = new FormData();
      datosAFP.append("codigo_afp", respuesta["codigo_afp"]);
      $.ajax({
        url: "ajax/afp.ajax.php",
        method: "POST",
        data: datosAFP,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaAFP) {
          $("#editarAFP").html(respuestaAFP[2]);
          $("#editarAFP").val(respuestaAFP[1]);
        },
      });

      $("#editarNumeroNup").val(respuesta["nup"]);
      $("#editarProfesionOficio").val(respuesta["profesion_oficio"]);
      $("#editarNacionalidad").val(respuesta["nacionalidad"]);
      $("#editarLugarNac").val(respuesta["lugar_nacimiento"]);
      $("#editarReligion").val(respuesta["religion"]);
      $("#editarGradoEstudios").val(respuesta["grado_estudio"]);
      $("#editarPlantel").val(respuesta["plantel"]);
      $("#editarPeso").val(respuesta["peso"]);
      $("#editarEstatura").val(respuesta["estatura"]);
      $("#editarPiel").val(respuesta["piel"]);
      $("#editarOjos").val(respuesta["ojos"]);
      $("#editarCabello").val(respuesta["cabello"]);
      $("#editarCara").val(respuesta["cara"]);

      $("#editarTipoSangre").val(respuesta["tipo_sangre"]);
      $("#editarTipoSangre").html(respuesta["tipo_sangre"]);

      $("#editarSenalesEspeciales").val(respuesta["senales_especiales"]);

      $("#editarLicenciaTDA").val(respuesta["licencia_tenencia_armas"]);
      $("#editarLicenciaTDA").html(respuesta["licencia_tenencia_armas"]);
      $("#editarNumeroLicenciaTDA").val(
        respuesta["numero_licencia_tenencia_armas"]
      );

      if (respuesta["imagen_licencia_tenencia_armas"] != "") {
        $(".previsualizarEditarLicLTA").attr(
          "src",
          respuesta["imagen_licencia_tenencia_armas"]
        );
      } else {
        $(".previsualizarEditarLicLTA").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualLicLTA").val(respuesta["imagen_licencia_tenencia_armas"]);

      $("#editarServicioMilitar").val(respuesta["servicio_militar"]);
      $("#editarServicioMilitar").html(respuesta["servicio_militar"]);

      var date3 = respuesta["fecha_servicio_inicio"];
      var formattedDate = new Date(date3);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechainism").val(respuesta["fecha_servicio_inicio"]);
        $("#editarfecha_inism").val(respuesta["fecha_servicio_inicio"]);
      }

      var date4 = respuesta["fecha_servicio_fin"];
      var formattedDate = new Date(date4);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechafinsm").val(respuesta["fecha_servicio_fin"]);
        $("#editarfecha_finsm").val(respuesta["fecha_servicio_fin"]);
      }

      $("#editarLugarServicioMilitar").val(respuesta["lugar_servicio"]);
      $("#editarGradoMilitar").val(respuesta["grado_militar"]);
      $("#editarMotivoBaja").val(respuesta["motivo_baja"]);

      $("#editarExPNC").val(respuesta["ex_pnc"]);
      $("#editarExPNC").html(respuesta["ex_pnc"]);

      if (respuesta["imagen_diploma_ansp"] != "") {
        $(".previsualizarEditarANSP").attr(
          "src",
          respuesta["imagen_diploma_ansp"]
        );
      } else {
        $(".previsualizarEditarANSP").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualANSP").val(respuesta["imagen_diploma_ansp"]);

      $("#editarCursoANSP").val(respuesta["curso_ansp"]);
      $("#editarCursoANSP").html(respuesta["curso_ansp"]);

      $("#editarTrabajoAnterior").val(respuesta["trabajo_anterior"]);
      $("#editarSueldoDevengo").val(respuesta["sueldo_que_devengo"]);
      $("#editarTrabajoActual").val(respuesta["trabajo_actual"]);
      $("#editarSueldoDevenga").val(respuesta["sueldo_que_devenga"]);

      $("#editarSuspendidoAnterior").val(
        respuesta["suspendido_trabajo_anterior"]
      );
      $("#editarSuspendidoAnterior").html(
        respuesta["suspendido_trabajo_anterior"]
      );

      $("#editarEmpresaSuspendio").val(respuesta["empresa_suspendio"]);
      $("#editarMotivoSuspension").val(respuesta["motivo_suspension"]);

      var date5 = respuesta["fecha_suspension"];
      var formattedDate = new Date(date5);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechasusp").val(respuesta["fecha_suspension"]);
        $("#editarfecha_susp").val(respuesta["fecha_suspension"]);
      }

      $("#editarExperienciaLaboral").val(respuesta["experiencia_laboral"]);
      $("#editarRazonIse").val(respuesta["razon_trabajar_en_ise"]);
      $("#editarPersonasDependientes").val(
        respuesta["numero_personas_dependientes"]
      );
      $("#editarObservaciones").val(respuesta["observaciones"]);
      $("#editarNumTelTrabajoAnterior").val(
        respuesta["telefono_trabajo_anterior"]
      );
      $("#editarTrabajoActual").val(respuesta["telefono_trabajo_actual"]);
      $("#editarNomRefTrabajoAnterior").val(respuesta["referencia_anterior"]);
      $("#editarEvaluacionAnterior").val(respuesta["evaluacion_anterior"]);
      $("#editarNomRefTrabajoActual").val(respuesta["referencia_actual"]);
      $("#editarEvaluacionActual").val(respuesta["evaluacion_actual"]);

      $("#editarInfoVerificada").val(respuesta["info_verificada"]);
      $("#editarInfoVerificada").html(respuesta["info_verificada"]);

      if (respuesta["imagen_solicitud"] != "") {
        $(".previsualizarEditarSOLICITUD").attr(
          "src",
          respuesta["imagen_solicitud"]
        );
      } else {
        $(".previsualizarEditarSOLICITUD").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualSOLICITUD").val(respuesta["imagen_solicitud"]);

      if (respuesta["imagen_antecedentes_penales"] != "") {
        $(".previsualizarEditarANTECEDENTES").attr(
          "src",
          respuesta["imagen_antecedentes_penales"]
        );
      } else {
        $(".previsualizarEditarANTECEDENTES").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualANTECEDENTES").val(
        respuesta["imagen_antecedentes_penales"]
      );

      var date6 = respuesta["fecha_vencimiento_antecedentes_penales"];
      var formattedDate = new Date(date6);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechavenceAP").val(
          respuesta["fecha_vencimiento_antecedentes_penales"]
        );
        $("#editarfecha_venceAP").val(
          respuesta["fecha_vencimiento_antecedentes_penales"]
        );
      }

      if (respuesta["imagen_solvencia_pnc"] != "") {
        $(".previsualizarEditarSOLVENCIAPNC").attr(
          "src",
          respuesta["imagen_solvencia_pnc"]
        );
      } else {
        $(".previsualizarEditarSOLVENCIAPNC").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualSOLVENCIAPNC").val(respuesta["imagen_solvencia_pnc"]);

      var date7 = respuesta["fecha_vencimiento_solvencia_pnc"];
      var formattedDate = new Date(date7);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafechavenceSPNC").val(
          respuesta["fecha_vencimiento_solvencia_pnc"]
        );
        $("#editarfecha_venceSPNC").val(
          respuesta["fecha_vencimiento_solvencia_pnc"]
        );
      }

      if (respuesta["imagen_huellas"] != "") {
        $(".previsualizarEditarHUELLAS").attr(
          "src",
          respuesta["imagen_huellas"]
        );
      } else {
        $(".previsualizarEditarHUELLAS").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualHUELLAS").val(respuesta["imagen_huellas"]);

      $("#editarConfiable").val(respuesta["confiable"]);
      $("#editarConfiable").html(respuesta["confiable"]);

      //FOTO ACTUAL DEL DOCUMENTO DE IDENTIDAD
      if (respuesta["imagen_documento_identidad"] != "") {
        $(".previsualizarEditarDoc").attr(
          "src",
          respuesta["imagen_documento_identidad"]
        );
      } else {
        $(".previsualizarEditarDoc").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualDoc").val(respuesta["imagen_documento_identidad"]);

      //REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
      if (respuesta["estado"] == 1) {
        $("#editarEstado").html("Solicitud");
      } else if (respuesta["estado"] == 2) {
        $("#editarEstado").html("Contratado");
      } else if (respuesta["estado"] == 3) {
        $("#editarEstado").html("Inactivo");
      } else if (respuesta["estado"] == 4) {
        $("#editarEstado").html("Incapacitado");
      } else {
        $("#editarEstado").html("Error");
      }
      $("#editarEstado").val(respuesta["estado"]);

      //BUSCAR EL NOMBRE DEL CARGO SEGUN EL CODIGO QUE TENEMOS
      var datosCARGO = new FormData();
      datosCARGO.append("nivel", respuesta["nivel_cargo"]);
      $.ajax({
        url: "ajax/cargos.ajax.php",
        method: "POST",
        data: datosCARGO,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaCARGO) {
          $("#editarCARGO").html(respuestaCARGO[1]);
          $("#editarCARGO").val(respuestaCARGO[2]);
        },
      });

      //fecha ingreso
      var date8 = respuesta["fecha_ingreso"];
      var formattedDate = new Date(date8);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        //alert("2");
        $("#mascarafechaingreso").val(respuesta["fecha_ingreso"]);
        $("#editarfecha_ingreso").val(respuesta["fecha_ingreso"]);
      }

      //fecha contratacion
      var date9 = respuesta["fecha_contratacion"];
      var formattedDate = new Date(date9);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var output =
          (("" + day).length < 2 ? "0" : "") +
          day +
          "-" +
          (("" + month).length < 2 ? "0" : "") +
          month +
          "-" +
          d.getFullYear();

        var output02 =
          d.getFullYear() +
          "-" +
          (("" + month).length < 2 ? "0" : "") +
          month +
          "-" +
          (("" + day).length < 2 ? "0" : "") +
          day;

        $("#mascarafechacontratacion").val(output);
        $("#editarfecha_contratacion").val(output02);
      } else {
        $("#mascarafechacontratacion").val(respuesta["fecha_contratacion"]);
        $("#editarfecha_contratacion").val(respuesta["fecha_contratacion"]);
      }

      //BUSCAR EL NOMBRE DEL DEPARTAMENTO
      var datosDepartamento = new FormData();
      datosDepartamento.append(
        "idDepartamento",
        respuesta["id_departamento_empresa"]
      );
      $.ajax({
        url: "ajax/departamentos.ajax.php",
        method: "POST",
        data: datosDepartamento,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDEPARTAMENTO) {
          $("#editarDepartamentoEmpresa").html(respuestaDEPARTAMENTO[2]);
          $("#editarDepartamentoEmpresa").val(respuestaDEPARTAMENTO[0]);

          var texto = $("#editarDepartamentoEmpresa").text();
          $("#showdepartamento").val(texto);
        },
      });

      if (respuesta["periodo_pago"] == "") {
        $("#PeriodoPago").val("015");
        /* $("#PeriodoPago").html("015"); */
      } else {
        var convertir = respuesta["periodo_pago"];

        if (convertir == "15") {
          convertir = "015";
        }

        if (convertir == "30") {
          convertir = "030";
        }

        $("#PeriodoPago").val(convertir);

        /* 	$("#PeriodoPago").html(respuesta["periodo_pago"]); */
      }

      $("#editar_horas_normales_trabajo").val(
        respuesta["horas_normales_trabajo"]
      );

      //BUSCAR EL NOMBRE DEL TIPO PORTACIOND E ARMA SEGUN ID
      var datosTPA = new FormData();
      datosTPA.append("idportacionarma", respuesta["id_tipo_portacion"]);
      $.ajax({
        url: "ajax/portacionarma.ajax.php",
        method: "POST",
        data: datosTPA,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaTPA) {
          $("#editarTipoPortacionArmas").html(respuestaTPA[2]);
          $("#editarTipoPortacionArmas").val(respuestaTPA[0]);
        },
      });

      $("#editar_descontar_isss").html(respuesta["descontar_isss"]);
      $("#editar_descontar_isss").val(respuesta["descontar_isss"]);

      if (respuesta["nup"] == "") {
        $("#editar_descontar_afp").html("SI");
        $("#editar_descontar_afp").val("SI");
      } else {
        $("#editar_descontar_afp").html(respuesta["descontar_afp"]);
        $("#editar_descontar_afp").val(respuesta["descontar_afp"]);
      }

      //BUSCAR EL NOMBRE DEL TIPO PLANILLA SEGUN ID
      var datosTPLANI = new FormData();
      datosTPLANI.append("idplantillas", respuesta["id_tipo_planilla"]);
      $.ajax({
        url: "ajax/plantillas.ajax.php",
        method: "POST",
        data: datosTPLANI,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaTPLA) {
          $("#editarTipoPlanilla").html(respuestaTPLA[2]);
          $("#editarTipoPlanilla").val(respuestaTPLA[0]);
        },
      });

      //BUSCAR EL NOMBRE DEL BANCO SEGUN ID
      var datosCOBAN = new FormData();
      datosCOBAN.append("idBancos", respuesta["id_banco"]);
      $.ajax({
        url: "ajax/bancos.ajax.php",
        method: "POST",
        data: datosCOBAN,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaCOBAN) {
          $("#editarBanco").html(respuestaCOBAN[2]);
          $("#editarBanco").val(respuestaCOBAN[0]);
        },
      });

      $("#editar_numero_cuenta").val(respuesta["numero_cuenta"]);

      $("#editar_anticipo").html(respuesta["anticipo"]);
      $("#editar_anticipo").val(respuesta["anticipo"]);

      $("#editar_reportado_a_pnc").html(respuesta["reportado_a_pnc"]);
      $("#editar_reportado_a_pnc").val(respuesta["reportado_a_pnc"]);

      $("#editar_tipo_empleado").html(respuesta["tipo_empleado"]);
      $("#editar_tipo_empleado").val(respuesta["tipo_empleado"]);

      //cuando viene de la base de datos
      if (respuesta["nivel_cargo"] == "009") {
        //si es agente de seguridad
        if (respuesta["id_jefe_operaciones"] == "0") {
          //si aun no ha sido asignado un jefe op
          $("#editarjefe_empleado").html("Seleccione Jefe Operaciones");
          $("#editarjefe_empleado").val("0");
        } else {
          //si ya tiene jefe de operaciones
          //BUSCAR EL NOMBRE DEL JEFE DE OPERACIONES SEGUN ID
          var datosJOP = new FormData();
          datosJOP.append("idEmpleado", respuesta["id_jefe_operaciones"]);
          $.ajax({
            url: "ajax/empleados.ajax.php",
            method: "POST",
            data: datosJOP,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaJOP) {
              $("#editarjefe_empleado").html(
                respuestaJOP[2] + " " + respuestaJOP[3] + " " + respuestaJOP[5]
              );
              $("#editarjefe_empleado").val(respuestaJOP[0]);
            },
          });
        }
      } // si no es agente de seguridad
      else {
        $("#editarjefe_empleado").html("N/D");
        $("#editarjefe_empleado").val("0");
        document.getElementById("divJOP").style.display = "none";
      }

      if (respuesta["imagen_contrato"] != "") {
        $(".previsualizarEditarContra").attr(
          "src",
          respuesta["imagen_contrato"]
        );
      } else {
        $(".previsualizarEditarContra").attr(
          "src",
          "vistas/img/usuarios/default/anonymous.png"
        );
      }
      $("#fotoActualContra").val(respuesta["imagen_contrato"]);

      //fecha vencimiento LTA
      var date10 = respuesta["fecha_vencimiento_lpa"];
      var formattedDate = new Date(date10);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 1;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();
      if (isNaN(d)) {
      } else {
        $("#mascarafecha_venLTA").val(respuesta["fecha_vencimiento_lpa"]);
        $("#editarfecha_venLTA").val(respuesta["fecha_vencimiento_lpa"]);
      }

      $("#editarConstanciaPS").html(respuesta["constancia_psicologica"]);
      $("#editarConstanciaPS").val(respuesta["constancia_psicologica"]);

      $("#editar_nombre_psicologo").val(respuesta["nombre_psicologo"]);
    },
  });
}

/*=============================================
IMPRIMIR FICHA
=============================================*/

$(".tablas").on("click", ".btnImprimirFicha", function () {
  var documentoEmpleado = $(this).attr("empleado");
  var form = $(
    '<form action="imprimirficha" method="post">' +
      '<input type="text" name="numDoc" value="' +
      documentoEmpleado +
      '" />' +
      "</form>"
  );
  $("body").append(form);
  form.submit();
});
