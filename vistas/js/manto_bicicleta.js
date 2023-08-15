$(document).ready(function () {
  cargarDatosVehiculo(0);

  $("#tablabicicleta tbody").on("click", ".campoid", function () {
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

    let datosbicicleta = $(this).attr("datosbicicleta");
    $(".nombre_bicicleta").html(
      "<strong>Bicicleta: </strong>" + datosbicicleta
    );
    $("#name_bicicleta").html(datosbicicleta);
    /* PARAMTETRO VEHÍCULO */
    let idbicicleta = $(this).attr("idbicicleta");
    $("#nuevoidbicicleta_mante").val(idbicicleta);
    cargarDatosVehiculo(idbicicleta);
  });

  $("#saveformbici").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevo").show();
    var errores = "";
    if ($("#nuevoidbicicleta_mante").val() == "") {
      errores += "<strong><li>Selecciona una Bicicleta</li></strong>";
      $("#nuevoidbicicleta_mante").focus();
    }
    if ($("#nuevofecha").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#nuevofecha").focus();
    }

    if ($("#nuevoidempleado_mbici").val() == "") {
      errores += "<strong><li>Selecciona un empleado</li></strong>";
      $("#nuevoidempleado_mbici").focus();
    }

    if ($("#nuevodiagnostico_mbici").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#nuevodiagnostico_mbici").focus();
    }

    if ($("#nuevoidreparacion_mbici").val() == "") {
      errores += "<strong><li>Reparación</li></strong>";
      $("#nuevoidreparacion_mbici").focus();
    }

    if ($("#nuevoid_taller").val() == "") {
      errores += "<strong><li>Selecciona un taller</li></strong>";
      $("#nuevoid_taller").focus();
    }

    if ($("#nuevovalor_mbici").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#nuevovalor_mbici").focus();
    }
    if ($("#nuevofecha_pago_mbici").val() == "") {
      errores += "<strong><li>Fecha Pago</li></strong>";
      $("#nuevofecha_pago_mbici").focus();
    }
    if ($("#nuevofecha_ingreso_mbici").val() == "") {
      errores += "<strong><li>Fecha Ingreso</li></strong>";
      $("#nuevofecha_ingreso_mbici").focus();
    }
    if ($("#nuevofecha_salida_mbici").val() == "") {
      errores += "<strong><li>Fecha Salida</li></strong>";
      $("#nuevofecha_salida_mbici").focus();
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
        url: "./controladores/mante_bicicleta.controlador.php?action=save",
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

            cargarDatosVehiculo($("#nuevoidbicicleta_mante").val());
            limpiarbici();

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

  $("#editarformbici").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevoedit").show();
    var errores = "";
    if ($("#editaridbicicleta_mante").val() == "") {
      errores += "<strong><li>Selecciona una Bicicleta</li></strong>";
      $("#editaridbicicleta_mante").focus();
    }
    if ($("#editarfecha").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#editarfecha").focus();
    }

    if ($("#editaridempleado_mbici").val() == "") {
      errores += "<strong><li>Selecciona un empleado</li></strong>";
      $("#editaridempleado_mbici").focus();
    }

    if ($("#editardiagnostico_mbici").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#editardiagnostico_mbici").focus();
    }

    if ($("#editaridreparacion_mbici").val() == "") {
      errores += "<strong><li>Reparación</li></strong>";
      $("#editaridreparacion_mbici").focus();
    }

    if ($("#editarid_taller").val() == "") {
      errores += "<strong><li>Seleccione un taller</li></strong>";
      $("#editarid_taller").focus();
    }
    if ($("#editarkilometraje_mbici").val() == "") {
      errores += "<strong><li>Kilometraje</li></strong>";
      $("#editarkilometraje_mbici").focus();
    }

    if ($("#editarvalor_mbici").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#editarvalor_mbici").focus();
    }
    if ($("#editarfecha_pago_mbici").val() == "") {
      errores += "<strong><li>Fecha Pago</li></strong>";
      $("#editarfecha_pago_mbici").focus();
    }
    if ($("#editarfecha_ingreso_mbici").val() == "") {
      errores += "<strong><li>Fecha Ingreso</li></strong>";
      $("#editarfecha_ingreso_mbici").focus();
    }
    if ($("#editarfecha_salida_mbici").val() == "") {
      errores += "<strong><li>Fecha Salida</li></strong>";
      $("#editarfecha_salida_mbici").focus();
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
        url: "./controladores/mante_bicicleta.controlador.php?edit=save",
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

            cargarDatosVehiculo($("#editaridbicicleta_mante").val());

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
function cargarDatosVehiculo(idbicicleta) {
  let parametros = {
    valor: idbicicleta,
  };
  $.ajax({
    data: parametros,
    url: "./ajax/mantobicicleta.ajax.php",
    type: "post",
    success: function (response) {
      $("#cargarDatosBicicleta").html(response).fadeIn("slow");
    },
  });
}

function limpiarbici() {
  $("#nuevoidreparacion_mbici").val("").trigger("change");
  $("#nuevoidempleado_mbici").val("").trigger("change");
  $("#nuevoid_taller").val("").trigger("change");
  $("#nuevodiagnostico_mbici").val("");
  $("#nuevovalor_mbici").val("");
  $("#nuevototal_mbici").val("");
  $("#nuevofecha_pago_mbici").val("");
  $("#nuevofecha_ingreso_mbici").val("");
  $("#nuevofecha_salida_mbici").val("");
  $("#nuevocomentario_mbici").val("");
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

function eliminarMantenimientoBici(id, idbicicleta) {
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
          "./controladores/mante_bicicleta.controlador.php?borrar=&id_mante=" +
          id,
        type: "GET",
        success: function (response) {
          if (response == "ok") {
            swal({
              title: "¡Excelente!",
              text: "Registro eliminado correctamente.",
              type: "success",
            });
            cargarDatos(idbicicleta);
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

function editarMantenimientoBici(id) {
  $.ajax({
    url: "./ajax/mantobicicleta.ajax.php?editar=&id=" + id,
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#bicicleta_mostrar").html($("#nombre_bicicleta_mostrar").html());
      $("#editarid").val(respuesta["id"]);
      $("#editaridbicicleta_mante").val(respuesta["idbicicleta_mante"]);
      $("#editarfecha").val(respuesta["fecha"]);
      $("#editaridempleado_mbici")
        .val(respuesta["idempleado_mbici"])
        .trigger("change");
      $("#editardiagnostico_mbici").val(respuesta["diagnostico_mbici"]);
      $("#editaridreparacion_mbici")
        .val(respuesta["idreparacion_mbici"])
        .trigger("change");
      $("#editarid_taller").val(respuesta["id_taller"]).trigger("change");
      $("#editarvalor_mbici").val(respuesta["valor_mbici"]);
      $("#editartotal_mbici").val(respuesta["total_mbici"]);

      $("#editarfecha_pago_mbici").val(respuesta["fecha_pago_mbici"]);
      $("#editarfecha_ingreso_mbici").val(respuesta["fecha_ingreso_mbici"]);
      $("#editarfecha_salida_mbici").val(respuesta["fecha_salida_mbici"]);
      $("#editarcomentario_mbici").val(respuesta["comentario_mbici"]);
    },
  });
}
