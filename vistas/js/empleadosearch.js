function cargar() {
  let datos = datosReporte();
  let auxiliar = 0;
  if (datos.departamento1 > datos.departamento2) {
    auxiliar = datos.departamento1;
    datos.departamento1 = datos.departamento2;
    datos.departamento2 = auxiliar;
  }

  $("#loader").fadeIn("slow");
  $("#mensajeview").html("");
  $("#mensajeview").fadeIn("slow");
  var inicio = performance.now(); // Tiempo de inicio de la petición
  $.ajax({
    type: "POST",
    data: datos,
    url: "./ajax/empleados.ajax.php?consult=true",
    beforeSend: function (objeto) {
      $("#loader").html(
        `<div class="alert alert-warning alert-dismissible" role="alert">
          <img src='./vistas/modulos/empleados/js/gif.gif' width='2%'><strong>&nbsp;¡Espere un momento, por favor!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>`
      );
    },
    success: function (data) {
      var fin = performance.now(); // Tiempo de finalización de la petición
      var tiempoTranscurrido = fin - inicio;

      $("#verTabla").html(data).fadeIn("slow");
      $("#loader").html("");

      mensajeview(
        "success",
        "check",
        "Bien Hecho",
        "Mostrando registros encontrados. " +
          convertirTiempo(tiempoTranscurrido)
      );
      ocultarmensajeview("#mensajeview");
    },
  });
}

function convertirTiempo(milisegundos) {
  var minutos = Math.floor(milisegundos / 60000);
  var segundos = ((milisegundos % 60000) / 1000).toFixed(0);
  return minutos + " minutos " + segundos + " segundos en completarse";
}

function mensajeview(tipoalert, icono, titulo, mensajeview) {
  $("#mensajeview")
    .html(`<div class="alert alert-${tipoalert} alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-${icono}"></i>
					<strong>¡${titulo}!</strong> ${mensajeview}
				</div>`);
}

function ocultarmensajeview(id) {
  setTimeout(function () {
    $(id).fadeOut(4500);
  }, 4500);
}

function imprimir(param) {
  $("#mensajeview").fadeIn("slow");
  let datos = datosReporte();
  if (datos.departamento1 > datos.departamento2) {
    auxiliar = datos.departamento1;
    datos.departamento1 = datos.departamento2;
    datos.departamento2 = auxiliar;
  }

  let url = "";
  mensajeview(
    "warning",
    "warning",
    "Exportando Resultados: ",
    "<img src='./vistas/modulos/empleados/js/gif.gif' width='2%'>&nbsp;¡Espere un momento, por favor! Por la cantidad de registros, es probable que tarde unos segundos"
  );

  url += "&departamento1=" + datos.departamento1;
  url += "&departamento2=" + datos.departamento2;
  url += "&empleados=" + datos.empleados;
  url += "&fechadesde=" + datos.fechadesde;
  url += "&fechahasta=" + datos.fechahasta;
  url += "&reportado_a_pnc=" + datos.reportado_a_pnc;
  url += "&tipoagente=" + datos.tipoagente;
  window.open(
    "./vistas/modulos/reportesexcel/reporteempleado.php?typeReport=" +
      param +
      url,
    "_self"
  );

  ocultarmensajeview("#mensajeview");
}

$("#departamento1").change(function (e) {
  $("#empleados").val("*").trigger("change");
});

$("#departamento2").change(function (e) {
  $("#empleados").val("*").trigger("change");
});

function datosReporte() {
  let datos = {
    departamento1: $("#departamento1").val(),
    departamento2: $("#departamento2").val(),
    empleados: $("#empleados").val(),
    fechadesde: $("#fechadesde").val(),
    fechahasta: $("#fechahasta").val(),
    reportado_a_pnc: $("#reportado_a_pnc").val(),
    tipoagente: $("#tipoagente").val(),
  };
  return datos;
}
$(".btn-cleanform").click(function () {
  $("#form_empleados")[0].reset();
  $("#empleados").val("*").trigger("change");
  $("#departamento1").val("*").trigger("change");
  $("#departamento2").val("*").trigger("change");
});

$(".btn-searchform").click(function () {
  cargar();
});
