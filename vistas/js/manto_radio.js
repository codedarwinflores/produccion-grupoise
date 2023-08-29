$(document).ready(function () {
  generarCorrelativoRadio();
  cargarDatosRadio(0);
  MostrarEquipos();

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
    let codigo_radio = $(this).attr("codigo_radio");
    $("#nuevoidradio_mante").val(idradio);
    cargarDatosRadio(idradio);
    /* buscar ubicacion del radio */
    buscarUbicacionRadio("nuevo", codigo_radio);
    vaciar_todo_mover();
  });

  /* SUMAR TOTAL RADIO  NUEVO*/
  $(".sumarTotalNuevo").on("keydown keyup", function () {
    let suma = 0;

    $(".sumarTotalNuevo").each(function () {
      if (!isNaN(this.value) && this.value.length != 0) {
        suma += parseFloat($(this).val());
      }
    });

    $("#nuevototal_mradio").val(suma.toFixed(2));
  });

  /* SUMAR TOTAL RADIO  EDITAR*/
  $(".sumarTotalEditar").on("keydown keyup", function () {
    let suma = 0;

    $(".sumarTotalEditar").each(function () {
      if (!isNaN(this.value) && this.value.length != 0) {
        suma += parseFloat($(this).val());
      }
    });

    $("#editartotal_mradio").val(suma.toFixed(2));
  });

  $("#saveformradio").submit(function (e) {
    e.preventDefault();
    $("#mensajenuevo").show();
    var errores = "";
    var to = $("#recorrer_t").val();
    if (to > 0) {
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

      if (errores != "") {
        mensajeAlert("Información importante", errores, "error");

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
            mensajeAlert("Espere...", "Procesando su petición.", "warning");
          },
          success: function (datos) {
            if (datos.trim() == "ok") {
              mensajeAlert(
                "Información importante",
                "Datos almacenados correctamente.",
                "success"
              );

              vaciar_todo_mover();
              cargarDatosRadio($("#nuevoidradio_mante").val());
              limpiarRadio();
              generarCorrelativoRadio();

              /*   document.getElementById("saveform").reset(); */
            } else {
              mensajeAlert(
                "Información importante",
                "Error al almacenar los datos.",
                "error"
              );
            }
            /* DESAPARECER DIV */

            $(":submit").attr("disabled", false);
          },
        });
      }
    } else {
      mensajeAlert(
        "Información importante",
        "No ha agregado repuestos / mano obra.",
        "info"
      );
    }
  });

  $("#editarformradio").submit(function (e) {
    e.preventDefault();
    var errores = "";
    if ($("#editaridradio_mante").val() == "") {
      errores += "<strong><li>Selecciona un Radio</li></strong>";
    }

    if ($("#editarid").val() == "") {
      errores += "<strong><li>Selecciona un Mantenimiento</li></strong>";
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
          mensajeAlert("Espere...", "Procesando su petición.", "warning");
        },
        success: function (datos) {
          if (datos.trim() == "ok") {
            mensajeAlert(
              "Información importante",
              "Datos almacenados correctamente." + datos,
              "success"
            );

            cargarDatosRadio($("#editaridradio_mante").val());
            MostrarEquiposDetalle($("#editarid").val());
            /*   document.getElementById("saveform").reset(); */
          } else {
            mensajeAlert(
              "Información importante",
              "Arror al almacenar los datos" + datos,
              "error"
            );
          }

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

/* MOSTRAR DATOS AL DETALLE */
function MostrarEquipos() {
  $.ajax({
    url: "./ajax/mantoradio.ajax.php", // Ruta al script PHP que realizará la consulta a MySQL
    type: "POST",
    data: { addDetail: true },
    success: function (response) {
      $("#addDetailEquipo").html(response).fadeIn("slow");
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

/* MOSTRAR DATOS AL DETALLE */
function MostrarEquiposDetalle(valor) {
  $.ajax({
    url: "./ajax/mantoradio.ajax.php", // Ruta al script PHP que realizará la consulta a MySQL
    type: "POST",
    data: { addDetailedit: "ello", id_historial: valor },
    success: function (response) {
      $("#editarDetailEquipo").html(response).fadeIn("slow");
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

/* AGREGAR EQUIPOS DETALLE */
function add_equipo() {
  var errores = "";
  let selectid = $("#nuevoid_equipo").val();
  if (selectid == "") {
    errores += "<strong><li>Selecciona un Equipo</li></strong>";
  }

  if (errores != "") {
    mensajeAlert("Información importante", errores, "error");
    errores = "";
    return;
  } else {
    $.ajax({
      url: "./ajax/mantoradio.ajax.php", // Ruta al script PHP que realizará la consulta a MySQL
      type: "POST",
      dataType: "json",
      data: { action: "add", idequipo: selectid },
      success: function (response) {
        if (response.estado == "add") {
          MostrarEquipos();
          mensajeAlert(
            "Información importante",
            "Equipo agregado correctamente.",
            "success"
          );

          $("#nuevoid_equipo").val("").trigger("change");
        }
      },
    });
  }
}

/* AGREGAR EQUIPOS TBL_DETALLE */
function add_equipo_detalle() {
  var errores = "";
  let selectid = $("#editarid_equipo").val();
  let id_manto = $("#editarid").val();
  let id_mante_radio = $("#editaridradio_mante").val();

  if (selectid == "") {
    errores += "<strong><li>Selecciona un Equipo</li></strong>";
  }

  if (errores != "") {
    mensajeAlert("Información importante", errores, "error");
    errores = "";
    return;
  } else {
    $.ajax({
      url: "./ajax/mantoradio.ajax.php", // Ruta al script PHP que realizará la consulta a MySQL
      type: "POST",
      dataType: "json",
      data: {
        action: "add_detail_team",
        idequipo: selectid,
        id_manto: id_manto,
      },
      success: function (response) {
        /*   alert(response.estado); */
        if (response.estado == "add") {
          MostrarEquiposDetalle(id_manto);
          cargarDatosRadio(id_mante_radio);
          mensajeAlert(
            "Información importante",
            "Equipo almacenado correctamente.",
            "success"
          );

          $("#editarid_equipo").val("").trigger("change");
        } else {
          mensajeAlert(
            "Información importante",
            "Error al agregar el equipo." + response.estado,
            "error"
          );
        }
      },
    });
  }
}

function limpiarRadio() {
  $("#nuevoid_equipo").val("").trigger("change");
  $("#nuevodiagnostico_mradio").val("");
  $("#nuevodescripcion").val("");
}

/* MENSAJE ALERT */
function mensajeAlert(title, mensaje, icono) {
  swal({
    title: "¡" + title + "!",
    html: mensaje,
    type: icono,
    timer: 2000,
  });
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

function eliminarMantenimientoRadio(id, idradio) {
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
          "./controladores/mante_radio.controlador.php?borrar=&id_mante=" + id,
        type: "GET",
        success: function (response) {
          if (response == "ok") {
            swal({
              title: "¡Excelente!",
              text: "Registro eliminado correctamente.",
              type: "success",
            });
            cargarDatosRadio(idradio);
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
    url: "./ajax/mantoradio.ajax.php",
    method: "POST",
    data: {
      editar: "editar",
      id: id,
    },
    dataType: "json",
    success: function (respuesta) {
      MostrarEquiposDetalle(respuesta["id"]);
      $("#editarname_radio").html($("#nombre_radio_mostrar").html());
      $("#editarid").val(respuesta["id"]);
      $("#editaridradio_mante").val(respuesta["idradio_mante"]);
      buscarUbicacionRadio("editar", respuesta["id_movimiento_his"]);
      $("#editarfecha_mradio").val(respuesta["fecha_mradio"]);
      $("#editarcorrelativo_mradio").val(respuesta["correlativo_mradio"]);
      $("#editardiagnostico_mradio").val(respuesta["diagnostico_mradio"]);
      $("#editardescripcion").val(respuesta["descripcion"]);
    },
  });
}

function viewMantenimientoRadio(id) {
  $.ajax({
    url: "./ajax/mantoradio.ajax.php",
    method: "POST",
    data: {
      action: "viewmantenimiento",
      id: id,
    },
    success: function (respuesta) {
      $("#viewname_radio").html($("#nombre_radio_mostrar").html());
      $("#viewMantenimiento").html(respuesta).fadeIn("slow");
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

function buscarUbicacionRadio(accion, codRadio) {
  $.ajax({
    data: {
      radiosearch: accion,
      codRadio: codRadio,
    },
    url: "./ajax/mantoradio.ajax.php",
    type: "post",
    dataType: "json",
    success: function (response) {
      if (accion == "nuevo") {
        $("#idmovimientoequipo").val(response.id_movimiento);
        $("#codubicacion").val(response.codigo_ubicacion);
        $("#ubicacionactual").val(response.nombre_ubicacion);
      } else {
        $("#editaridmovimientoequipo").val(response.id_movimiento);
        $("#editarcodubicacion").val(response.codigo_ubicacion);
        $("#editarubicacionactual").val(response.nombre_ubicacion);
      }
    },
  });
}

function roundNumber(num) {
  var result = Math.round(num.value);
  if (/^\d*$/.test(result)) {
    num.value = "";
    if (result <= 0) {
      result = 1;
    }
    num.value = result;
  } else {
    num.value = 1;
  }
}

function sumar_restar(signo, id) {
  var result = parseInt(document.getElementById("cantidad_" + id).value);
  var asign = 1;

  if (signo == "+") {
    asign = result + 1;
  } else {
    if (result > 1) {
      asign = result - 1;
    }
  }

  document.getElementById("cantidad_" + id).value = asign;
  modificar_equipo_detalle(id);
}

function editar_sumar_restar(signo, id, iddetail) {
  var result = parseInt(document.getElementById("editarcantidad_" + id).value);
  var asign = 1;

  if (signo == "+") {
    asign = result + 1;
  } else {
    if (result > 1) {
      asign = result - 1;
    }
  }

  document.getElementById("editarcantidad_" + id).value = asign;
  modificar_equipo_detalle_tabla(id, iddetail);
  let id_mante_radio = $("#editaridradio_mante").val();
  cargarDatosRadio(id_mante_radio);
}

$(document).on("change", ".operar_detalle", function () {
  var id = $(this).data("id");
  modificar_equipo_detalle(id);
});

/* ELIMINAR EQUIPO SESIÓN */

function eliminar_equipo_session(id) {
  swal({
    title: "¿Está seguro de quitar el registro?",
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
        type: "POST",
        data: {
          action: "eliminar",
          idequipo: id,
        },
        url: "./ajax/mantoradio.ajax.php",
        beforeSend: function (objeto) {
          $("#mensajenuevoequipo").show();
          mensaje(
            "#mensajenuevoequipo",
            "warning",
            "check",
            "¡Espere!",
            "Procesando..."
          );
        },
        success: function (datos) {
          $("#mensajenuevoequipo").show();
          if (datos == "vacio") {
            mensaje(
              "#mensajenuevoequipo",
              "success",
              "check",
              "Vacío",
              "Detalle Vacío"
            );
            MostrarEquipos();
          } else {
            mensaje(
              "#mensajenuevoequipo",
              "danger",
              "check",
              "Bien Hecho",
              "Equipo eliminado correctamente"
            );
            MostrarEquipos();
          }
          /* DESAPARECER DIV */
          ocultarMensaje("#mensajenuevoequipo");
        },
      });
    } else {
      return false;
    }
  });
}

/* ELIMINAR EQUIPO SESIÓN */

function eliminar_equipo_tabla(id) {
  let id_manto = $("#editarid").val();
  let id_mante_radio = $("#editaridradio_mante").val();
  swal({
    title: "¿Está seguro de quitar el registro?",
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
        type: "POST",
        data: {
          eliminar: "eliminar",
          id: id,
        },
        url: "./controladores/mante_radio.controlador.php",
        beforeSend: function (objeto) {
          $("#editarmensajenuevoequipo").show();
          mensaje(
            "#editarmensajenuevoequipo",
            "warning",
            "check",
            "¡Espere!",
            "Procesando..."
          );
        },
        success: function (datos) {
          $("#editarmensajenuevoequipo").show();
          if (datos == "ok") {
            mensaje(
              "#editarmensajenuevoequipo",
              "success",
              "check",
              "Elminado",
              "Equipo Detalle Eliminado"
            );
            MostrarEquiposDetalle(id_manto);
            cargarDatosRadio(id_mante_radio);
          } else {
            mensaje(
              "#editarmensajenuevoequipo",
              "danger",
              "check",
              "Lo siento",
              "Equipo no eliminado"
            );
          }
          /* DESAPARECER DIV */
          ocultarMensaje("#editarmensajenuevoequipo");
        },
      });
    } else {
      return false;
    }
  });
}

function vaciar_equipos() {
  var to = $("#recorrer_t").val();
  if (to > 0) {
    $("#mensajenuevoequipo").show();
    swal({
      title: "¿Está seguro de vaciar el detalle de equipos agregados?",
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
          type: "POST",
          data: {
            action: "vaciar",
          },
          url: "./ajax/mantoradio.ajax.php",
          beforeSend: function (objeto) {
            mensaje(
              "#mensajenuevoequipo",
              "warning",
              "check",
              "¡Espere!",
              "Procesando..."
            );
          },
          success: function (datos) {
            mensaje(
              "#mensajenuevoequipo",
              "success",
              "check",
              "Vacío",
              "Detalle Equipos Vacío"
            );
            MostrarEquipos();

            /* DESAPARECER DIV */
            ocultarMensaje("#mensajenuevoequipo");
          },
        });
      } else {
        return false;
      }
    });
  } else {
    mensajeAlert("Información importante", "No hay equipos agregados.", "info");
    return false;
  }
}

function vaciar_todo_mover() {
  $.ajax({
    type: "POST",
    data: {
      action: "vaciar",
    },
    url: "./ajax/mantoradio.ajax.php",
    success: function (datos) {
      MostrarEquipos();
    },
  });
}

function modificar_equipo_detalle(id) {
  var idequipo = $("#id_equipo_" + id).val();
  var descripcion = $("#descripcion_" + id).val();
  var costo_equipo = $("#costo_equipo_" + id).val();
  var cantidad = $("#cantidad_" + id).val();

  if (cantidad < 1 || cantidad == null) {
    cantidad = 1;
  }

  $.ajax({
    type: "POST",
    data: {
      action: "modif",
      idequipo: idequipo,
      descripcion: descripcion,
      cantidad: cantidad,
      costo_equipo: costo_equipo,
    },
    url: "./ajax/mantoradio.ajax.php",

    success: function (data) {
      document.getElementById("valor_" + id).innerHTML = parseFloat(
        cantidad * costo_equipo
      ).toFixed(2);
      var elemento = document.getElementById("valor_REPU" + id);
      var elemento2 = document.getElementById("valor_SERV" + id);

      if (elemento !== null) {
        elemento.value = parseFloat(cantidad * costo_equipo).toFixed(2);
      }

      if (elemento2 !== null) {
        elemento2.value = parseFloat(cantidad * costo_equipo).toFixed(2);
      }

      var total = parseInt(document.getElementById("recorrer_t").value);

      var suma_repuestos = 0.0;
      var suma_manoobra = 0.0;
      var repu;
      var mano_obra;
      for (var i = 0; i < total; i++) {
        repu = document.getElementById("valor_REPU" + i);
        mano_obra = document.getElementById("valor_SERV" + i);
        if (repu !== null) {
          suma_repuestos += parseFloat(repu.value);
        }

        if (mano_obra !== null) {
          suma_manoobra += parseFloat(mano_obra.value);
        }
      }

      document.getElementById("total_repuesto").innerHTML =
        parseFloat(suma_repuestos).toFixed(2);
      document.getElementById("total_mano_obra").innerHTML =
        parseFloat(suma_manoobra).toFixed(2);
      document.getElementById("total_pagar_todo").innerHTML = parseFloat(
        parseFloat(suma_repuestos) + parseFloat(suma_manoobra)
      ).toFixed(2);
    },
  });
}

function modificar_equipo_detalle_tabla(id, iddetail) {
  var descripcion = $("#editardescripcion_" + id).val();
  var costo_equipo = $("#editarcosto_equipo_" + id).val();
  var cantidad = $("#editarcantidad_" + id).val();

  if (cantidad < 1 || cantidad == null) {
    cantidad = 1;
  }

  $.ajax({
    type: "POST",
    data: {
      action: "modificar_detalle",
      descripcion: descripcion,
      cantidad: cantidad,
      costo_equipo: costo_equipo,
      id: iddetail,
    },
    url: "./ajax/mantoradio.ajax.php",

    success: function (data) {
      document.getElementById("editarvalor_" + id).innerHTML = parseFloat(
        cantidad * costo_equipo
      ).toFixed(2);
      var elemento = document.getElementById("editarvalor_REPU" + id);
      var elemento2 = document.getElementById("editarvalor_SERV" + id);

      if (elemento !== null) {
        elemento.value = parseFloat(cantidad * costo_equipo).toFixed(2);
      }

      if (elemento2 !== null) {
        elemento2.value = parseFloat(cantidad * costo_equipo).toFixed(2);
      }

      var total = parseInt(document.getElementById("editarrecorrer_t").value);

      var suma_repuestos = 0.0;
      var suma_manoobra = 0.0;
      var repu;
      var mano_obra;
      for (var i = 0; i < total; i++) {
        repu = document.getElementById("editarvalor_REPU" + i);
        mano_obra = document.getElementById("editarvalor_SERV" + i);
        if (repu !== null) {
          suma_repuestos += parseFloat(repu.value);
        }

        if (mano_obra !== null) {
          suma_manoobra += parseFloat(mano_obra.value);
        }
      }

      document.getElementById("editartotal_repuesto").innerHTML =
        parseFloat(suma_repuestos).toFixed(2);
      document.getElementById("editartotal_mano_obra").innerHTML =
        parseFloat(suma_manoobra).toFixed(2);
      document.getElementById("editartotal_pagar_todo").innerHTML = parseFloat(
        parseFloat(suma_repuestos) + parseFloat(suma_manoobra)
      ).toFixed(2);
    },
  });
}

$(document).on("keyup", ".operar_detallee", function () {
  var id = $(this).data("id");
  var idposicion = $(this).attr("idcont");
  modificar_equipo_detalle_tabla(idposicion, id);
});

$(document).on("blur", ".operar_detallee", function () {
  var id = $(this).data("id");
  var idposicion = $(this).attr("idcont");
  modificar_equipo_detalle_tabla(idposicion, id);
});

$(document).on("change", ".operar_detallee", function () {
  var id = $(this).data("id");
  var idposicion = $(this).attr("idcont");
  modificar_equipo_detalle_tabla(idposicion, id);
  let id_mante_radio = $("#editaridradio_mante").val();
  cargarDatosRadio(id_mante_radio);
});

/* $(document).on("keydown", ".operar_detalle", function () {
  var id = $(this).data("id");
  modificar_equipo_detalle_tabla(id);
}); */
