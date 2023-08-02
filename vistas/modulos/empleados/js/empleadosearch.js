cargar();

function cargar() {
  let datos = {
    departamento1: $("#departamento1").val(),
    departamento2: $("#departamento2").val(),
    empleados: $("#empleados").val(),
    fechadesde: $("#fechadesde").val(),
    fechahasta: $("#fechahasta").val(),
    reportado_a_pnc: $("#reportado_a_pnc").val(),
    tipoagente: $("#tipoagente").val(),
  };
  let auxiliar = 0;
  if (datos.departamento1 > datos.departamento2) {
    auxiliar = datos.departamento1;
    datos.departamento1 = datos.departamento2;
    datos.departamento2 = auxiliar;
  }

  /*   alert(datos.departamento1); */

  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    data: datos,
    url: "./ajax/empleados.ajax.php?consult=true",
    beforeSend: function (objeto) {
      $("#loader").html(
        "<h3><strong>¡Espere un momento!</strong></h3><h5><strong> Filtrando información...  </strong></h5><img src='./vistas/modulos/empleados/js/gif.gif' width='12%'>"
      );
    },
    success: function (data) {
      $("#verTabla").html(data).fadeIn("slow");
      $("#loader").html("");
      mensaje("info", "check", "Bien Hecho", "Mostrando Datos");
      ocultarMensaje("#mensaje");
    },
  });
}

function limpiar() {
  $(".mi-selector").select2("val", "*");
}

function mensaje(tipoalert, icono, titulo, mensaje) {
  $("#mensaje")
    .html(`<div class="alert alert-${tipoalert} alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-${icono}"></i>
					<strong>¡${titulo}!</strong> ${mensaje}
				</div>`);
}

function ocultarMensaje(id) {
  setTimeout(function () {
    $(id).fadeOut(2500);
  }, 3000);
}

function imprimir(param) {
  window.open(
    "./vistas/modulos/reportesexcel/reporteempleado.php?typeReport=" + param,
    "_self"
  );
}

$("#departamento1")
  .select2()
  .change(function (e) {
    $("#empleados").select2("val", "*");
  });

$("#departamento2")
  .select2()
  .change(function (e) {
    $("#empleados").select2("val", "*");
  });
