$(document).ready(function () {
  generarCorrelativoRadio();
  cargarDatosRadio(0);

  $("#tablaradio tbody").on("click", ".campoid", function () {
    $(".agregarbtnmovimiento").removeAttr("disabled");
    /* if ($(this).hasClass("selectedd")) {
      // Deseleccionar
      $(this).removeClass("selectedd");
    } else { */
    // Remover clase de TR seleccionada, si es que hay
    $("tr.selectedd").removeClass("selectedd");
    // Asignar clase seleccionada a TR actual
    $(this).addClass("selectedd");
    /* } */

    let datosradio = $(this).attr("datosradio");
    $(".nombre_radio").html("<strong>Radio: </strong>" + datosradio);
    $("#name_radio").html(datosradio);
    /* PARAMTETRO VEHÍCULO */
    let idradio = $(this).attr("idradio");
    $("#nuevoidradio_mante").val(idradio);
    cargarDatosRadio(idradio);
  });

  /* SUMAR TOTAL RADIO */
  $(".sumarTotal").on("keydown keyup", function () {
    let suma = 0;

    $(".sumarTotal").each(function () {
      if (!isNaN(this.value) && this.value.length != 0) {
        suma += parseFloat($(this).val());
      }
    });

    $("#nuevototal_mradio").val(suma.toFixed(2));
    $("#editartotal_mradio").val(suma.toFixed(2));
  });

  $("#saveformradio").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevo").show();
    var errores = "";
    if ($("#nuevoidradio_mante").val() == "") {
      errores += "<strong><li>Selecciona un Radio</li></strong>";
      $("#nuevoidradio_mante").focus();
    }
    if ($("#nuevofecha_mradio").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#nuevofecha_mradio").focus();
    }

    if ($("#nuevocorrelativo_mradio").val() == "") {
      errores += "<strong><li>Número Correlativo</li></strong>";
      $("#nuevocorrelativo_mradio").focus();
    }

    if ($("#nuevodiagnostico_mradio").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#nuevodiagnostico_mradio").focus();
    }
    if ($("#nuevocosto_obra_mradio").val() == "") {
      errores += "<strong><li>Costo Obra</li></strong>";
      $("#nuevocosto_obra_mradio").focus();
    }

    if ($("#nuevocosto_repuesto_mradio").val() == "") {
      errores += "<strong><li>Costo Repuesto</li></strong>";
      $("#nuevocosto_repuesto_mradio").focus();
    }

    if ($("#nuevovalor_mradio").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#nuevovalor_mradio").focus();
    }

    if ($("#nuevototal_mradio").val() == "") {
      errores += "<strong><li>Total</li></strong>";
      $("#nuevototal_mradio").focus();
    }

    if (errores != "") {
      mensaje("#mensajenuevo", "danger", "check", "Campos requeridos", errores);

      errores = "";
      return;
    } else {
      var parametros = new FormData(this);

      $(":submit").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "./controladores/mante_radio.controlador.php?action=save",
        data: parametros,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (objeto) {
          mensaje(
            "#mensajenuevo",
            "warning",
            "warning",
            "Espere",
            "Procesando su petición..."
          );
        },
        success: function (datos) {
          if (datos.trim() == "ok") {
            mensaje(
              "#mensajenuevo",
              "success",
              "check",
              "Bien Hecho",
              "Datos almacenados correctamente"
            );

            cargarDatosRadio($("#nuevoidradio_mante").val());
            limpiarRadio();
            generarCorrelativoRadio();

            /*   document.getElementById("saveform").reset(); */
          } else {
            mensaje(
              "#mensajenuevo",
              "danger",
              "check",
              "Error",
              "Problema al almacenar los datos" + datos
            );
          }
          /* DESAPARECER DIV */
          ocultarMensaje("#mensajenuevo");

          $(":submit").attr("disabled", false);
        },
      });
    }
  });

  $("#editarformradio").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevoedit").show();
    var errores = "";
    if ($("#editaridradio_mante").val() == "") {
      errores += "<strong><li>Selecciona un Radio</li></strong>";
      $("#editaridradio_mante").focus();
    }
    if ($("#editarfecha_mradio").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#editarfecha_mradio").focus();
    }

    if ($("#editarcorrelativo_mradio").val() == "") {
      errores += "<strong><li>Número Correlativo</li></strong>";
      $("#editarcorrelativo_mradio").focus();
    }

    if ($("#editardiagnostico_mradio").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#editardiagnostico_mradio").focus();
    }
    if ($("#editarcosto_obra_mradio").val() == "") {
      errores += "<strong><li>Costo Obra</li></strong>";
      $("#editarcosto_obra_mradio").focus();
    }

    if ($("#editarcosto_repuesto_mradio").val() == "") {
      errores += "<strong><li>Costo Repuesto</li></strong>";
      $("#editarcosto_repuesto_mradio").focus();
    }

    if ($("#editarvalor_mradio").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#editarvalor_mradio").focus();
    }

    if ($("#editartotal_mradio").val() == "") {
      errores += "<strong><li>Total</li></strong>";
      $("#editartotal_mradio").focus();
    }

    if (errores != "") {
      mensaje(
        "#mensajenuevoedit",
        "danger",
        "check",
        "Campos requeridos",
        errores
      );

      errores = "";
      return;
    } else {
      var parametros = new FormData(this);

      $(":submit").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "./controladores/mante_radio.controlador.php?edit=save",
        data: parametros,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (objeto) {
          mensaje(
            "#mensajenuevoedit",
            "warning",
            "warning",
            "Espere",
            "Procesando su petición..."
          );
        },
        success: function (datos) {
          if (datos.trim() == "ok") {
            mensaje(
              "#mensajenuevoedit",
              "success",
              "check",
              "Bien Hecho",
              "Datos modificados correctamente"
            );

            cargarDatosRadio($("#editaridradio_mante").val());

            /*   document.getElementById("saveform").reset(); */
          } else {
            mensaje(
              "#mensajenuevoedit",
              "danger",
              "check",
              "Error",
              "Problema al modificados los datos" + datos
            );
          }
          /* DESAPARECER DIV */
          ocultarMensaje("#mensajenuevoedit");

          $(":submit").attr("disabled", false);
        },
      });
    }
  });
});

/* CARGAR DATOS */
function cargarDatosRadio(idarma) {
  let parametros = {
    valor: idarma,
  };
  $.ajax({
    data: parametros,
    url: "./ajax/mantoradio.ajax.php",
    type: "post",
    success: function (response) {
      $("#cargarDatosRadio").html(response).fadeIn("slow");
    },
  });
}

function limpiarRadio() {
  /* $("#nuevoid_taller").val("").trigger("change"); */
  $("#nuevodiagnostico_mradio").val("");
  $("#nuevocosto_obra_mradio").val("");
  $("#nuevocosto_repuesto_mradio").val("");
  $("#nuevovalor_mradio").val("");
  $("#nuevototal_mradio").val("");
  $("#nuevodescripcion").val("");
}

function mensaje(id, tipoalert, icono, titulo, mensaje) {
  $(id)
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

function eliminarMantenimientoArma(id, idarma) {
  swal({
    title: "¿Está seguro de borrar el registro?",
    text: "¡Si no lo está puede cancelar la accíón!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar!",
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url:
          "./controladores/mante_arma.controlador.php?borrar=&id_mante=" + id,
        type: "GET",
        success: function (response) {
          if (response == "ok") {
            swal({
              title: "¡Excelente!",
              text: "Registro eliminado correctamente.",
              type: "success",
            });
            cargarDatosRadio(idarma);
          } else {
            swal({
              title: "Error",
              text: "Error al eliminar un registro!",
              type: "error",
            });
          }
        },
      });
    }
  });
}

function editarMantenimientoRadio(id) {
  $.ajax({
    url: "./ajax/mantoradio.ajax.php?editar=&id=" + id,
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#radio_mostrar").html($("#nombre_radio_mostrar").html());
      $("#editarid").val(respuesta["id"]);
      $("#editaridradio_mante").val(respuesta["idradio_mante"]);

      $("#editarfecha_mradio").val(respuesta["fecha_mradio"]);
      $("#editarcorrelativo_mradio").val(respuesta["correlativo_mradio"]);
      /*   $("#editaridempleado_mradio")
        .val(respuesta["idempleado_mradio"])
        .trigger("change"); */

      $("#editardiagnostico_mradio").val(respuesta["diagnostico_mradio"]);
      $("#editarcosto_obra_mradio").val(respuesta["costo_obra_mradio"]);
      $("#editarcosto_repuesto_mradio").val(respuesta["costo_repuesto_mradio"]);
      $("#editarvalor_mradio").val(respuesta["valor_mradio"]);
      $("#editartotal_mradio").val(respuesta["total_mradio"]);

      $("#editardescripcion").val(respuesta["descripcion"]);
    },
  });
}

function generarCorrelativoRadio() {
  var dataString = "generar=correlativo";
  $.ajax({
    data: dataString,
    url: "./ajax/mantoradio.ajax.php",
    type: "post",
    success: function (response) {
      $("#nuevocorrelativo_mradio").val(response);
    },
  });
}
