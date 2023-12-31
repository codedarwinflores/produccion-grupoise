/* cargar(); */
function cargar() {
  let datos = datosReporte();
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
        `<div style='background-color:#F4D03F; padding:20px; border-radius: 50px;'>
        <h4><strong>¡Espere un momento!</strong></h4><h6><strong> Filtrando los registros...  </strong></h6><img src='./vistas/modulos/empleados/js/gif.gif' width='50%'></div>`
      );
    },
    success: function (data) {
      $("#verTabla").html(data).fadeIn("slow");
      $("#loader").html("");
      mensaje("success", "check", "Bien Hecho", "Mostrando Datos");
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
    $(id).fadeOut(3500);
  }, 3500);
}

function imprimir(param) {
  $("#mensaje").fadeIn("slow");
  let datos = datosReporte();
  if (datos.departamento1 > datos.departamento2) {
    auxiliar = datos.departamento1;
    datos.departamento1 = datos.departamento2;
    datos.departamento2 = auxiliar;
  }

  let url = "";
  mensaje(
    "warning",
    "warning",
    "Exportando Resultados: ",
    "¡Espere un momento, por favor! Por la cantidad de registros, es probable que tarde unos segundos"
  );
  ocultarMensaje("#mensaje");
  url += "&departamento1=" + datos.departamento1;
  url += "&departamento2=" + datos.departamento2;
  url += "&empleados=" + datos.empleados;
  url += "&fechadesde=" + datos.fechadesde;
  url += "&fechahasta=" + datos.fechahasta;
  url += "&reportado_a_pnc=" + datos.reportado_a_pnc;
  url += "&tipoagente=" + datos.tipoagente;
  url += "&rrhh=" + datos.rrhh;
  window.open(
    "./vistas/modulos/reportesexcel/reporteempleado.php?typeReport=" +
      param +
      url,
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

function datosReporte() {
  let checkbox = $("#rrhh");
  let rrhumanos = checkbox.is(":checked") ? checkbox.val() : "";
  /*   alert(rrhumanos); */
  let datos = {
    departamento1: $("#departamento1").val(),
    departamento2: $("#departamento2").val(),
    empleados: $("#empleados").val(),
    fechadesde: $("#fechadesde").val(),
    fechahasta: $("#fechahasta").val(),
    reportado_a_pnc: $("#reportado_a_pnc").val(),
    tipoagente: $("#tipoagente").val(),
    rrhh: rrhumanos,
  };
  return datos;
}
