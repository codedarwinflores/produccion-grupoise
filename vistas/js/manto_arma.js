$(document).ready(function () {
  cargarDatosArma(0);

  $("#tablaarma tbody").on("click", ".campoid", function () {
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

    let datosarma = $(this).attr("datosarma");
    $(".nombre_arma").html("<strong>Arma: </strong>" + datosarma);
    $("#name_arma").html(datosarma);
    /* PARAMTETRO VEHÍCULO */
    let idarma = $(this).attr("idarma");
    $("#nuevoidarma_mante").val(idarma);
    cargarDatosArma(idarma);
  });

  $("#saveformarma").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevo").show();
    var errores = "";
    if ($("#nuevoidarma_mante").val() == "") {
      errores += "<strong><li>Selecciona un arma</li></strong>";
      $("#nuevoidarma_mante").focus();
    }
    if ($("#nuevofecha_marma").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#nuevofecha_marma").focus();
    }

    if ($("#nuevoidempleado_marma").val() == "") {
      errores += "<strong><li>Selecciona un empleado</li></strong>";
      $("#nuevoidempleado_marma").focus();
    }

    if ($("#nuevodiagnostico_marma").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#nuevodiagnostico_marma").focus();
    }

    if ($("#nuevoid_taller").val() == "") {
      errores += "<strong><li>Selecciona un taller</li></strong>";
      $("#nuevoid_taller").focus();
    }

    if ($("#nuevovalor_marma").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#nuevovalor_marma").focus();
    }
    if ($("#nuevofecha_pago_marma").val() == "") {
      errores += "<strong><li>Fecha Pago</li></strong>";
      $("#nuevofecha_pago_marma").focus();
    }
    if ($("#nuevofecha_ingreso_marma").val() == "") {
      errores += "<strong><li>Fecha Ingreso</li></strong>";
      $("#nuevofecha_ingreso_marma").focus();
    }
    if ($("#nuevofecha_salida_marma").val() == "") {
      errores += "<strong><li>Fecha Salida</li></strong>";
      $("#nuevofecha_salida_marma").focus();
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
        url: "./controladores/mante_arma.controlador.php?action=save",
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

            cargarDatosArma($("#nuevoidarma_mante").val());
            limpiararma();

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

  $("#editarformarma").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevoedit").show();
    var errores = "";
    if ($("#editaridarma_mante").val() == "") {
      errores += "<strong><li>Selecciona un Arma</li></strong>";
      $("#editaridarma_mante").focus();
    }
    if ($("#editarfecha_marma").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#editarfecha_marma").focus();
    }

    if ($("#editaridempleado_marma").val() == "") {
      errores += "<strong><li>Selecciona un empleado</li></strong>";
      $("#editaridempleado_marma").focus();
    }

    if ($("#editardiagnostico_marma").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#editardiagnostico_marma").focus();
    }

    if ($("#editarid_taller").val() == "") {
      errores += "<strong><li>Seleccione un taller</li></strong>";
      $("#editarid_taller").focus();
    }

    if ($("#editarvalor_marma").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#editarvalor_marma").focus();
    }
    if ($("#editarfecha_pago_marma").val() == "") {
      errores += "<strong><li>Fecha Pago</li></strong>";
      $("#editarfecha_pago_marma").focus();
    }
    if ($("#editarfecha_ingreso_marma").val() == "") {
      errores += "<strong><li>Fecha Ingreso</li></strong>";
      $("#editarfecha_ingreso_marma").focus();
    }
    if ($("#editarfecha_salida_marma").val() == "") {
      errores += "<strong><li>Fecha Salida</li></strong>";
      $("#editarfecha_salida_marma").focus();
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
        url: "./controladores/mante_arma.controlador.php?edit=save",
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

            cargarDatosArma($("#editaridarma_mante").val());

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
function cargarDatosArma(idarma) {
  let parametros = {
    valor: idarma,
  };
  $.ajax({
    data: parametros,
    url: "./ajax/mantoarma.ajax.php",
    type: "post",
    success: function (response) {
      $("#cargarDatosarma").html(response).fadeIn("slow");
    },
  });
}

function limpiararma() {
  $("#nuevoidempleado_marma").val("").trigger("change");
  $("#nuevoid_taller").val("").trigger("change");
  $("#nuevodiagnostico_marma").val("");
  $("#nuevovalor_marma").val("");
  $("#nuevototal_marma").val("");
  $("#nuevofecha_pago_marma").val("");
  $("#nuevofecha_ingreso_marma").val("");
  $("#nuevofecha_salida_marma").val("");
  $("#nuevocomentario_marma").val("");
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
            cargarDatosArma(idarma);
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

function editarMantenimientoArma(id) {
  $.ajax({
    url: "./ajax/mantoarma.ajax.php?editar=&id=" + id,
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#arma_mostrar").html($("#nombre_arma_mostrar").html());
      $("#editarid").val(respuesta["id"]);
      $("#editaridarma_mante").val(respuesta["idarma_mante"]);
      $("#editarfecha_marma").val(respuesta["fecha_marma"]);
      $("#editaridempleado_marma")
        .val(respuesta["idempleado_marma"])
        .trigger("change");
      $("#editardiagnostico_marma").val(respuesta["diagnostico_marma"]);
      $("#editarid_taller").val(respuesta["id_taller"]).trigger("change");
      $("#editarvalor_marma").val(respuesta["valor_marma"]);
      $("#editartotal_marma").val(respuesta["total_marma"]);

      $("#editarfecha_pago_marma").val(respuesta["fecha_pago_marma"]);
      $("#editarfecha_ingreso_marma").val(respuesta["fecha_ingreso_marma"]);
      $("#editarfecha_salida_marma").val(respuesta["fecha_salida_marma"]);
      $("#editarcomentario_marma").val(respuesta["comentario_marma"]);
    },
  });
}
