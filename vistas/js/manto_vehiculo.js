$(document).ready(function () {
  cargarDatos(0);

  $("#tablavehiculo tbody").on("click", ".campoid", function () {
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

    let datosvehiculo = $(this).attr("datosvehiculo");
    $(".nombre_vehiculo").html("<strong>Vehículo: </strong>" + datosvehiculo);
    $("#name_vehiculo").html(datosvehiculo);
    /* PARAMTETRO VEHÍCULO */
    let idvehiculo = $(this).attr("idvehiculo");
    $("#nuevoidvehiculo_mante").val(idvehiculo);
    cargarDatos(idvehiculo);
  });

  $("#saveform").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevo").show();
    var errores = "";
    if ($("#nuevoidvehiculo_mante").val() == "") {
      errores += "<strong><li>Selecciona un vehículo</li></strong>";
      $("#nuevoidvehiculo_mante").focus();
    }
    if ($("#nuevofecha").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#nuevofecha").focus();
    }

    if ($("#nuevoidempleado_mvehi").val() == "") {
      errores += "<strong><li>Selecciona un empleado</li></strong>";
      $("#nuevoidempleado_mvehi").focus();
    }

    if ($("#nuevodiagnostico_mvehi").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#nuevodiagnostico_mvehi").focus();
    }

    if ($("#nuevoidreparacion_mvehi").val() == "") {
      errores += "<strong><li>Reparación</li></strong>";
      $("#nuevoidreparacion_mvehi").focus();
    }
    if ($("#nuevokilometraje_mvehi").val() == "") {
      errores += "<strong><li>Kilometraje</li></strong>";
      $("#nuevokilometraje_mvehi").focus();
    }

    if ($("#nuevovalor_mvehi").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#nuevovalor_mvehi").focus();
    }
    if ($("#nuevofecha_pago_mvehi").val() == "") {
      errores += "<strong><li>Fecha Pago</li></strong>";
      $("#nuevofecha_pago_mvehi").focus();
    }
    if ($("#nuevofecha_ingreso_mvehi").val() == "") {
      errores += "<strong><li>Fecha Ingreso</li></strong>";
      $("#nuevofecha_ingreso_mvehi").focus();
    }
    if ($("#nuevofecha_salida_mvehi").val() == "") {
      errores += "<strong><li>Fecha Salida</li></strong>";
      $("#nuevofecha_salida_mvehi").focus();
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
        url: "./controladores/mante_vehiculo.controlador.php?action=save",
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
              "Datos agregados correctamente"
            );

            cargarDatos($("#nuevoidvehiculo_mante").val());
            limpiar();

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

  $("#editarform").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevoedit").show();
    var errores = "";
    if ($("#editaridvehiculo_mante").val() == "") {
      errores += "<strong><li>Selecciona un vehículo</li></strong>";
      $("#editaridvehiculo_mante").focus();
    }
    if ($("#editarfecha").val() == "") {
      errores += "<strong><li>Fecha</li></strong>";
      $("#editarfecha").focus();
    }

    if ($("#editaridempleado_mvehi").val() == "") {
      errores += "<strong><li>Selecciona un empleado</li></strong>";
      $("#editaridempleado_mvehi").focus();
    }

    if ($("#editardiagnostico_mvehi").val() == "") {
      errores += "<strong><li>Diagnóstico</li></strong>";
      $("#editardiagnostico_mvehi").focus();
    }

    if ($("#editaridreparacion_mvehi").val() == "") {
      errores += "<strong><li>Reparación</li></strong>";
      $("#editaridreparacion_mvehi").focus();
    }
    if ($("#editarkilometraje_mvehi").val() == "") {
      errores += "<strong><li>Kilometraje</li></strong>";
      $("#editarkilometraje_mvehi").focus();
    }

    if ($("#editarvalor_mvehi").val() == "") {
      errores += "<strong><li>Valor</li></strong>";
      $("#editarvalor_mvehi").focus();
    }
    if ($("#editarfecha_pago_mvehi").val() == "") {
      errores += "<strong><li>Fecha Pago</li></strong>";
      $("#editarfecha_pago_mvehi").focus();
    }
    if ($("#editarfecha_ingreso_mvehi").val() == "") {
      errores += "<strong><li>Fecha Ingreso</li></strong>";
      $("#editarfecha_ingreso_mvehi").focus();
    }
    if ($("#editarfecha_salida_mvehi").val() == "") {
      errores += "<strong><li>Fecha Salida</li></strong>";
      $("#editarfecha_salida_mvehi").focus();
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
        url: "./controladores/mante_vehiculo.controlador.php?edit=save",
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

            cargarDatos($("#editaridvehiculo_mante").val());

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

  $(".validarmoney").mask("#,##0.00", {
    reverse: true,
  });
});

/* CARGAR DATOS */
function cargarDatos(idvehiculo) {
  let parametros = {
    valor: idvehiculo,
  };
  $.ajax({
    data: parametros,
    url: "ajax/mantovehiculo.ajax.php",
    type: "post",
    success: function (response) {
      $("#cargarDatos").html(response).fadeIn("slow");
    },
  });
}

function limpiar() {
  $("#nuevoidreparacion_mvehi").val("").trigger("change");
  $("#nuevoidempleado_mvehi").val("").trigger("change");
  $("#nuevodiagnostico_mvehi").val("");
  $("#nuevokilometraje_mvehi").val("");
  $("#nuevovalor_mvehi").val("");
  $("#nuevototal_mvehi").val("");
  $("#nuevofecha_pago_mvehi").val("");
  $("#nuevofecha_ingreso_mvehi").val("");
  $("#nuevofecha_salida_mvehi").val("");
  $("#nuevocomentario_mvehi").val("");
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

function eliminarMantenimiento(id, idvehiculo) {
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
          "./controladores/mante_vehiculo.controlador.php?borrar=&id_mante=" +
          id,
        type: "GET",
        success: function (response) {
          if (response == "ok") {
            swal({
              title: "¡Excelente!",
              text: "Registro eliminado correctamente.",
              type: "success",
            });
            cargarDatos(idvehiculo);
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

function editarMantenimientoVehiculo(id) {
  $.ajax({
    url: "./ajax/mantovehiculo.ajax.php?editar=&id=" + id,
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#vehiculo_mostrar").html($("#nombre_vehiculo_mostrar").html());
      $("#editarid").val(respuesta["id"]);
      $("#editaridvehiculo_mante").val(respuesta["idvehiculo_mante"]);
      $("#editarfecha").val(respuesta["fecha"]);
      $("#editaridempleado_mvehi")
        .val(respuesta["idempleado_mvehi"])
        .trigger("change");
      $("#editardiagnostico_mvehi").val(respuesta["diagnostico_mvehi"]);
      $("#editaridreparacion_mvehi")
        .val(respuesta["idreparacion_mvehi"])
        .trigger("change");

      $("#editarkilometraje_mvehi").val(respuesta["kilometraje_mvehi"]);
      $("#editarvalor_mvehi").val(respuesta["valor_mvehi"]);
      $("#editartotal_mvehi").val(respuesta["total_mvehi"]);

      $("#editarfecha_pago_mvehi").val(respuesta["fecha_pago_mvehi"]);
      $("#editarfecha_ingreso_mvehi").val(respuesta["fecha_ingreso_mvehi"]);
      $("#editarfecha_salida_mvehi").val(respuesta["fecha_salida_mvehi"]);

      $("#editarcomentario_mvehi").val(respuesta["comentario_mvehi"]);
    },
  });
}
