$(document).ready(function () {
  // Bloquear la inspección de elementos y ver código fuente en un modal específico
  function bloquearInspeccionYVerCodigoFuente() {
    // Bloquear la inspección de elementos en el modal
    $(document).on("keydown", bloquearInspeccionKey);
    $(document).on("contextmenu", bloquearInspeccionContext);

    // Bloquear la visualización del código fuente en el modal
    $(document).on("keydown", bloquearVerCodigoFuente);
  }

  // Función para desbloquear la inspección de elementos y ver código fuente en un modal específico
  function desbloquearInspeccionYVerCodigoFuente() {
    // Desbloquear la inspección de elementos en el modal
    $(document).off("keydown", bloquearInspeccionKey);
    $(document).off("contextmenu", bloquearInspeccionContext);

    // Desbloquear la visualización del código fuente en el modal
    $(document).off("keydown", bloquearVerCodigoFuente);
  }

  // Función de bloqueo de inspección para teclado
  function bloquearInspeccionKey(event) {
    if (
      event.keyCode === 123 ||
      (event.ctrlKey && event.shiftKey && event.keyCode === 73)
    ) {
      event.preventDefault();
    }
  }

  // Función de bloqueo de inspección para el menú contextual
  function bloquearInspeccionContext(event) {
    event.preventDefault();
  }

  // Función de bloqueo de visualización del código fuente
  function bloquearVerCodigoFuente(event) {
    if (event.keyCode === 85 && event.ctrlKey) {
      event.preventDefault();
    }
  }

  // Función de bloqueo de inspección para el menú contextual
  function bloquearInspeccionContext(event) {
    event.preventDefault();
  }

  // Función de bloqueo de inspección para el menú contextual
  function bloquearInspeccionContext(event) {
    event.preventDefault();
  }

  /* // Llamar a la función para bloquear la inspección cuando se abre el modal
  $("#procesarReservaProgramada").on("show.bs.modal", function () {
    bloquearInspeccionYVerCodigoFuente();
  });

  // Llamar a la función para desbloquear la inspección cuando se cierra el modal
  $("#procesarReservaProgramada").on("hidden.bs.modal", function () {
    desbloquearInspeccionYVerCodigoFuente();
  }); */

  // Captura el evento cuando se muestra el popup
  cerrarModal();
  cargarHoras();
  getFormatoExamenPlantillaSelect();
  cerrarModalReservaExamen();
  getTipoPreguntasCuestionario();
  getTipoPreguntasSelectMultiple();
  llenarCargoClienteSolicitado();
  $(document).ready(function () {
    /* REGISTRAR PREGUNTA DENTRO DEL CUESTIONARIO*/
    $("#addCuestionarioPregunta").submit(function (e) {
      e.preventDefault();

      // Validar campos obligatorios antes de enviar
      var camposNoCompletados = validarCamposObligatorios(
        "#addCuestionarioPregunta"
      );

      if (camposNoCompletados.length === 0) {
        // Obtener los datos del formulario
        var formData = new FormData(this);

        // Agregar el campo extra al formData
        formData.append("id_tbl_poligrafo", $("#id_edit_id_registro").val());
        $(":submit").attr("disabled", true);
        // Enviar la solicitud Ajax
        $.ajax({
          type: "POST",
          url: "./ajax/programarexamen.ajax.php", // Reemplaza con la URL de tu script de procesamiento
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
            // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
            mostrarAlerta(
              "#mensajeFormaddCuestionarioPregunta",
              "warning",
              "¡Espere un momento, por favor!"
            );
          },
          success: function (response) {
            /* console.log(JSON.stringify(response)); */
            // Mostrar mensaje de éxito
            if (response === "save") {
              mostrarAlerta(
                "#mensajeFormaddCuestionarioPregunta",
                "success",
                "¡Pregunta registrada correctamente en el cuestionario!"
              );
              $("#addCuestionarioPregunta")[0].reset();
              $("#id_tipo_preguntas_cuestionario").val(0).trigger("change");
              cargarPreguntas();
            } else if (response === "existe") {
              mostrarAlerta(
                "#mensajeFormaddCuestionarioPregunta",
                "danger",
                "¡Pregunta ya existe!"
              );
            } else {
              mostrarAlerta(
                "#mensajeFormaddCuestionarioPregunta",
                "danger",
                "Error al enviar el formulario. Inténtelo nuevamente." +
                  JSON.stringify(response)
              );
            }
          },
          error: function (error) {
            console.error("Error en la solicitud Ajax:", error);
            // Mostrar mensaje de error
            mostrarAlerta(
              "#mensajeFormaddCuestionarioPregunta",
              "danger",
              "Error al enviar el formulario. Inténtelo nuevamente." +
                JSON.stringify(response)
            );

            console.log(JSON.stringify(error));
          },
        });
      } else {
        // Mostrar mensaje de advertencia con detalles sobre los campos no completados
        var mensaje =
          "Por favor, complete los siguientes campos obligatorios:<ul>";
        camposNoCompletados.forEach(function (campo) {
          mensaje += "<li>" + campo + "</li>";
        });
        mensaje += "</ul>";
        mostrarAlerta("#mensajeFormaddCuestionarioPregunta", "danger", mensaje);
      }

      $(":submit").attr("disabled", false);
    });

    // Attach click event to the button
    $("#AddPoliBtn").on("click", function () {
      // Get post content from the textarea
      // Perform AJAX request
      $.ajax({
        type: "POST",
        url: "./ajax/programarexamen.ajax.php", // Specify the URL of your PHP script
        data: { accion: "NewInsert" }, // Send post content to the server
        success: function (response) {
          // Handle the response from the server
          /*   console.log(response); */
          if (response === "ok") {
            cargarDataReservaPoligrafista();
            mostrarAlerta(
              "#mensajeAlertPrincipal",
              "success",
              "¡Registro generado exitosamente!"
            );
          } else {
            mostrarAlerta(
              "#mensajeAlertPrincipal",
              "danger",
              "¡Error al generar registro!"
            );
          }
        },
        error: function (error) {
          // Handle errors
          console.error("Error:", error);
        },
      });
    });
  });

  /* REGISTRAR POLIGRAFOS */
  $("#form_poligrafo_register").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios(
      "#form_poligrafo_register"
    );

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = $(this).serialize();
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/programarexamen.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormPoligrafo",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "ok") {
            mostrarAlerta(
              "#mensajeFormPoligrafo",
              "success",
              "¡Reserva(s) registrada(s) correctamente!"
            );
            $("#form_poligrafo_register")[0].reset();
            cargarDataReservaPoligrafista();
            setTimeout(function () {
              $("#registrarPoligrafo").modal("hide");
            }, 200);
          } // Mostrar mensaje de éxito
          else if (response === "fechaMenor") {
            mostrarAlerta(
              "#mensajeFormPoligrafo",
              "info",
              "¡La fecha es menor a la actual, no puedes programar fechas pasadas!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormPoligrafo",
              "danger",
              "Error al enviar el formulario. Inténtelo nuevamente."
            );
          }
        },
        error: function (error) {
          console.error("Error en la solicitud Ajax:", error);
          // Mostrar mensaje de error
          mostrarAlerta(
            "#mensajeFormPoligrafo",
            "danger",
            "Error al enviar el formulario. Inténtelo nuevamente."
          );
        },
      });
    } else {
      // Mostrar mensaje de advertencia con detalles sobre los campos no completados
      var mensaje =
        "Por favor, complete los siguientes campos obligatorios:<ul>";
      camposNoCompletados.forEach(function (campo) {
        mensaje += "<li>" + campo + "</li>";
      });
      mensaje += "</ul>";
      mostrarAlerta("#mensajeFormPoligrafo", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  /* GENERAR HORARIO AUTOMÁTICO */
  $("#form-horario").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form-horario");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = $(this).serialize();
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/programarexamen.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeAlerta",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "horarioGenerado") {
            mostrarAlerta(
              "#mensajeAlerta",
              "success",
              "¡Horario generado correctamente!"
            );
            $("#form-horario")[0].reset();
            cargarHoras();
          } else {
            mostrarAlerta(
              "#mensajeAlerta",
              "danger",
              "Error al enviar el formulario. Inténtelo nuevamente."
            );
          }
        },
        error: function (error) {
          console.error("Error en la solicitud Ajax:", error);
          // Mostrar mensaje de error
          mostrarAlerta(
            "#mensajeAlerta",
            "danger",
            "Error al enviar el formulario. Inténtelo nuevamente."
          );
        },
      });
    } else {
      // Mostrar mensaje de advertencia con detalles sobre los campos no completados
      var mensaje =
        "Por favor, complete los siguientes campos obligatorios:<ul>";
      camposNoCompletados.forEach(function (campo) {
        mensaje += "<li>" + campo + "</li>";
      });
      mensaje += "</ul>";
      mostrarAlerta("#mensajeAlerta", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  /* EDITAR INTERVALO DE TIEMPO HORARIO */
  $("#form-intervalo-horas").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios(
      "#form-intervalo-horas"
    );

    if (camposNoCompletados.length === 0) {
      // Mostrar mensaje de espera

      // Obtener los datos del formulario
      var formData = $(this).serialize();
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/programarexamen.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeAlertaform",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          /*  console.error("Error en la solicitud Ajax:", JSON.stringify(response)); */
          // Mostrar mensaje de éxito

          if (response === "validar") {
            mostrarAlerta(
              "#mensajeAlertaform",
              "danger",
              "¡Hora inicial es mayor o igual a la final!"
            );
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeAlertaform",
              "danger",
              "¡Hora programada ya existe registrada!"
            );
          } else if (response === "save") {
            mostrarAlerta(
              "#mensajeAlertaform",
              "success",
              "¡Hora programada registrada correctamente!"
            );
            $("#form-intervalo-horas")[0].reset();
          } else if (response === "update") {
            setTimeout(function () {
              $("#saveedit").modal("hide");
            }, 100);
            mostrarAlerta(
              "#mensajeAlerta",
              "success",
              "¡Hora programada editada correctamente!"
            );
            mostrarAlerta(
              "#mensajeAlertaform",
              "success",
              "¡Hora programada editada correctamente!"
            );
          } else {
            mostrarAlerta(
              "#mensajeAlertaform",
              "danger",
              "Error al enviar el formulario. Inténtelo nuevamente."
            );
          }

          cargarHoras();
        },
        error: function (error) {
          console.error("Error en la solicitud Ajax:", error);
          // Mostrar mensaje de error
          mostrarAlerta(
            "#mensajeAlertaform",
            "danger",
            "Error al enviar el formulario. Inténtelo nuevamente."
          );
        },
      });
    } else {
      // Mostrar mensaje de advertencia con detalles sobre los campos no completados
      var mensaje =
        "Por favor, complete los siguientes campos obligatorios:<ul>";
      camposNoCompletados.forEach(function (campo) {
        mensaje += "<li>" + campo + "</li>";
      });
      mensaje += "</ul>";
      mostrarAlerta("danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });
});

function validarCamposObligatorios(id) {
  var camposNoCompletados = [];

  // Iterar sobre campos obligatorios y verificar si están llenos
  $(id + " [required]").each(function () {
    if ($(this).val().trim() === "") {
      camposNoCompletados.push($(this).attr("name"));
    }
  });

  return camposNoCompletados;
}

function mostrarAlerta(id, tipo, mensaje) {
  // Configurar la alerta de Bootstrap
  $(id)
    .removeClass()
    .addClass("alert alert-" + tipo)
    .html(mensaje)
    .show();

  // Ocultar la alerta después de unos segundos (opcional)
  setTimeout(function () {
    $(id).fadeOut(10000);
  }, 10000);
}

/* CARGAR DATOS */
function cargarHoras() {
  // Show the loading spinner
  $("#loadingSpinner").show();
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    gethoras: "tblhoras",
  };

  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "post",

    success: function (response) {
      // Actualiza el contenido del elemento sin el efecto fadeIn
      $("#listadoHorario").html(response);
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },

    complete: function () {
      $("#loadingSpinner").hide();
    },
  });
}

function cerrarModal() {
  $("#saveedit").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveedit").html(
      '<i class="fa fa-pencil-square-o"></i> Registrar'
    );
    $("#id_intervalo").val(0);
    $("#form-intervalo").val("add");
    $("#title-intervalo").html("Registrar");
    $("#form-intervalo-horas")[0].reset();
    $("#saveedit").modal("hide");

    return false;
  });
}

/* EDITAR INTÉRVALO DE HORA */

function editarHora(id) {
  var datos = new FormData();
  datos.append("idhora", id);

  $.ajax({
    url: "./ajax/programarexamen.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      /*  console.log(JSON.stringify(respuesta)); */

      $("#btn-idsaveedit").html('<i class="fa fa-pencil-square-o"></i> Editar');
      $("#form-intervalo").val("edit");
      $("#title-intervalo").html("Editar");
      $("#id_intervalo").val(respuesta["id_hora"]);
      $("#hora_inicial").val(respuesta["hora_inicial"]);
      $("#hora_final").val(respuesta["hora_final"]);
    },
  });
}

/* ELIMINAR INTERVALO  DE HORA */
function deleteHour(id) {
  swal({
    title: "¿Está seguro de eliminar el registro?",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "¡Si, borrar!",
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: "./ajax/programarexamen.ajax.php",
        method: "POST",
        data: {
          id_hora: id,
          delete: "ok",
        },

        dataType: "json",
        success: function (response) {
          /*     console.log(JSON.stringify(response)); */
          if (response.status === "ok") {
            mostrarAlerta(
              "#mensajeAlerta",
              "success",
              "¡Registro eliminado correctamente!"
            );
            cargarHoras();
          } else {
            mostrarAlerta(
              "#mensajeAlerta",
              "error",
              "¡Error al eliminar el registro!"
            );
          }
        },
        error: function (error) {
          console.error("Error en la solicitud AJAX:", error);
        },
      });
    }
  });
}

// Function to generate a random pastel color
function getRandomPastelColor() {
  var randomColor =
    "#" +
    Math.floor(Math.random() * 150)
      .toString(16)
      .padStart(2, "0") +
    Math.floor(Math.random() * 150)
      .toString(16)
      .padStart(2, "0") +
    Math.floor(Math.random() * 150)
      .toString(16)
      .padStart(2, "0");

  return randomColor;
}

$.fn.dataTable.ext.type.order["date-eu"] = function (data) {
  var dateParts = data.split("/");
  return new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
};
// Store date and time values in an object to track unique combinations

// Variable para almacenar la instancia de DataTable
let miTablas;

function cargarDataReservaPoligrafista() {
  var colorMap = [];
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".Poligrafista_register")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablas.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablas = $(".Poligrafista_register").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
        {
          targets: 6,
          render: function (data, type, row) {
            if (type === "sort") {
              var parts = data.split("/");
              return new Date(parts[2], parts[1] - 1, parts[0]).getTime(); // Convertir la fecha a un valor numérico para ordenar correctamente
            } else {
              var parts = data.split("/");
              return parts[0] + "/" + parts[1] + "/" + parts[2]; // Mostrar la fecha en formato DD/MM/YYYY
            }
          },
        },
      ],
      order: [
        [6, "desc"],
        [7, "asc"],
        [8, "desc"],
        [9, "desc"],
        [10, "desc"],
      ],
      ajax: {
        url: "ajax/programarexamen.ajax.php",
        type: "GET",
        data: function (d) {
          d.id_poligrafista = $("#selecionarpoligrafista").val();
          d.actionsPol = "Consult";
          d.fecha_inicio_programada = $(
            "#fecha_programada_filtro_inicio"
          ).val();
          d.fecha_fin_programada = $("#fecha_programada_filtro_fin").val();
        },
        dataSrc: "data",
      },
      dataType: "json",
      deferRender: true,
      retrieve: true,
      processing: true,
      pageLength: 25,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo:
          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
      createdRow: function (row, data, rowIndex) {
        // Add your desired class to the row
        $(row).addClass("campoid");
        // Set the data-id attribute based on the data
        $(row).attr("data-id", data[1]);

        $.each($("td", row), function (colIndex) {
          if (colIndex == 1) {
            $(this).attr("data-name", "id_cliente");
            $(this).attr("class", "id_cliente");
            $(this).attr("data-type", "select2");
            $(this).attr("data-pk", data[1]);
          }
          if (colIndex == 2) {
            $(this).attr("data-name", "id_evaluado");
            $(this).attr("class", "id_evaluado");
            $(this).attr("data-type", "select2");
            $(this).attr("data-pk", data[1]);
          }
          if (colIndex == 3) {
            $(this).attr("data-name", "id_poligrafista");
            $(this).attr("class", "id_poligrafista");
            $(this).attr("data-type", "select2");
            $(this).attr("data-pk", data[1]);
          }

          if (colIndex == 4) {
            $(this).attr("data-name", "id_tipo_examen");
            $(this).attr("class", "id_tipo_examen");
            $(this).attr("data-type", "select2");
            $(this).attr("data-pk", data[1]);
          }

          if (colIndex == 5) {
            // Add the fecha value as a data attribute
            $(this).addClass("fecha_programada");
          }

          if (colIndex == 6) {
            // Add the fecha value as a data attribute
            $(this).attr("data-name", "hora_programada");
            $(this).attr("class", "hora_programada");
            $(this).attr("data-type", "time");
            $(this).attr("data-pk", data[1]);
          }

          if (colIndex == 7) {
            // Add the fecha value as a data attribute
            $(this).attr("data-name", "hora_ingreso_curso");
            $(this).attr("class", "hora_ingreso_curso");
            $(this).attr("data-type", "time");
            $(this).attr("data-pk", data[1]);
          }
          // Obtener el texto del botón dentro de la fila actual
          var buttonText = $("button.btn-short-text", row).text().trim();

          // Add background color based on the text of the button
          if (buttonText.toUpperCase() === "FINALIZADO") {
            $(row).css({
              "background-color": "#d4edda",
              "font-weight": "501",
            });
          } else if (buttonText.toUpperCase() === "EN PROCESO") {
            $(row).css({
              "background-color": "#fde8d7 ",
              "font-weight": "501",
            });
          }
        });
      },

      // drawCallback function
      drawCallback: function () {
        // Loop through each row
        $(this.api().rows().nodes()).each(function (index, row) {
          // Get the fecha and horaProgramada values

          $("td.hora_programada").each(function () {
            var horaProgramada = $(this).text();
            var rowsWithSameHora = $(
              "td.hora_programada:contains('" + horaProgramada + "')"
            ).closest("tr");
            let colorHora = getRandomPastelColor();

            // Aplicar el color al texto de cada celda de la fila
            rowsWithSameHora.each(function () {
              $(this).find("td.hora_programada").css({
                color: colorHora,
                "font-weight": "900",
              });

              colorAplicado = colorHora;
            });
          });
          $("td.fecha_programada").each(function () {
            var fecha = $(this).text();
            var rowsWithSameFecha = $(
              "td.fecha_programada:contains('" + fecha + "')"
            ).closest("tr");
            let randomColor = getRandomPastelColor();
            if (rowsWithSameFecha.length > 1) {
              // Aplicar el color al borde superior y al texto de la fecha
              rowsWithSameFecha.first().css({
                "border-top": "3px solid" + randomColor,
                "font-weight": "bold",
              });

              /*  rowsWithSameFecha.last().css({
                "border-bottom": "3px solid" + randomColor,
                "font-weight": "bold",
              }); */
              // Aplicar el color al texto de cada celda de la fila
              rowsWithSameFecha.each(function () {
                $(this).find("td.fecha_programada").css({
                  color: randomColor,
                  "font-weight": "900",
                });
              });
            } else {
              rowsWithSameFecha.last().css({
                "border-top": "3px solid" + randomColor,
                "font-weight": "bold",
              });
            }
          });
        });
      },
      // Resto de la configuración de DataTable...
    });
  }

  cargarDataCada10Segundos();
}

function cargarDataCada10Segundos() {
  // Destruir la edición existente
  // Destruir la edición existente
  $(".Poligrafista_register").editable("destroy");

  cargarXeditableHora();

  // Obtener los datos de los selectores
  obtenerDatosJSON("obtenerDataEvaluados")
    .done(function (datos) {
      inicializarXEditable(
        ".Poligrafista_register",
        "td.id_evaluado",
        "Seleccionar Evaluado",
        datos,
        "El evaluado es requerido"
      );
    })
    .fail(function (xhr, status, error) {
      console.error("Error en la solicitud Ajax:", status, error);
    });

  obtenerDatosJSON("obtenerData")
    .done(function (datos) {
      inicializarXEditable(
        ".Poligrafista_register",
        "td.id_poligrafista",
        "Seleccionar Poligrafista",
        datos,
        "El poligrafista es requerido"
      );
    })
    .fail(function (xhr, status, error) {
      console.error("Error en la solicitud Ajax:", status, error);
    });

  obtenerDatosJSON("obtenerDataTipoExamen")
    .done(function (datos) {
      inicializarXEditable(
        ".Poligrafista_register",
        "td.id_tipo_examen",
        "Seleccionar Tipo de Examen",
        datos,
        "El tipo de examen es requerido"
      );
    })
    .fail(function (xhr, status, error) {
      console.error("Error en la solicitud Ajax:", status, error);
    });

  obtenerDatosJSON("obtenerClientes")
    .done(function (datos) {
      inicializarXEditable(
        ".Poligrafista_register",
        "td.id_cliente",
        "Seleccionar Cliente",
        datos,
        "El cliente es requerido"
      );
    })
    .fail(function (xhr, status, error) {
      console.error("Error en la solicitud Ajax:", status, error);
    });
}

/* EVALUADOS */
function obtenerDatosJSON(action) {
  return $.ajax({
    type: "GET",
    url: "./ajax/programarexamen.ajax.php",
    dataType: "json",
    data: {
      action: action,
    },
  });
}

function compararFechas(fecha) {
  // Obtener la fecha actual en el huso horario de El Salvador (GMT-6)
  var fechaActual = new Date();
  fechaActual.setUTCHours(fechaActual.getUTCHours() - 6);

  // Formatear la fecha actual en Y-m-d
  var yyyy = fechaActual.getFullYear();
  var mm = String(fechaActual.getMonth() + 1).padStart(2, "0"); // Los meses van de 0 a 11, sumamos 1 para obtener el mes correcto
  var dd = String(fechaActual.getDate()).padStart(2, "0");
  var fechaActualFormateada = yyyy + "-" + mm + "-" + dd;

  // Formatear la fecha dada en Y-m-d
  var partesFecha = fecha.split("/");
  var fechaFormateada =
    partesFecha[2] + "-" + partesFecha[1] + "-" + partesFecha[0];

  console.log(
    "Fecha Actual: " + fechaActualFormateada + " Fecha Dada: " + fechaFormateada
  );

  // Comparar las fechas
  if (fechaFormateada < fechaActualFormateada) {
    return true; // La fecha dada es anterior a la fecha actual
  }
  return false; // La fecha dada es igual o posterior a la fecha actual
}

function cargarXeditableHora() {
  $(".Poligrafista_register").editable({
    container: "body",
    selector: "td.hora_programada",
    url: "./ajax/programarexamen.ajax.php",
    title: "Escribe Hora Programada",
    type: "POST",
    validate: function (value) {
      // Obtener la fecha asociada al elemento (ajusta según tu estructura de datos)
      var fechaElemento = $(this)
        .closest("tr")
        .find(".fecha_programada")
        .text()
        .trim();
      var HoraElementoIngreso = $(this)
        .closest("tr")
        .find(".hora_ingreso_curso")
        .text()
        .trim();

      if (compararFechas(fechaElemento)) {
        return "No se puede editar elementos en fechas pasadas.";
      }
      if (HoraElementoIngreso !== "00:00:00") {
        return "¡El examen ya se encuentra en proceso o finalizado!";
      }

      // Validación adicional si es necesario
      if ($.trim(value) === "") {
        return "El Evaluado es requerido";
      }
    },
    success: function (response, newValue) {
      // Manejo de la respuesta exitosa
      console.log("Respuesta exitosa:", response, newValue);

      // Puedes hacer más cosas con la respuesta si es necesario
      // Por ejemplo, actualizar la interfaz de usuario, mostrar mensajes, etc.
    },
    ajaxOptions: {
      dataType: "json", // Asegúrate de especificar el tipo de datos esperado
      success: function (response) {
        // Manejo de la respuesta del servidor
        console.log("Respuesta del servidor:", response);

        // Puedes hacer más cosas con la respuesta si es necesario
        // Por ejemplo, actualizar la interfaz de usuario, mostrar mensajes, etc.
      },
      error: function (xhr, textStatus, errorThrown) {
        console.error("Error en la solicitud Ajax:", textStatus, errorThrown);
      },
    },
    params: function (params) {
      // Agrega el parámetro adicional para indicar la acción
      params.procesar_data = "_update";
      return params;
    },
  });
}

// También podrías realizar la inicialización directamente en la función de éxito (done)
// si eso tiene más sentido en tu aplicación
function inicializarXEditable(
  selector,
  columnSelector,
  title,
  datos,
  validateMessage
) {
  /*   alert("4"); */
  $(selector).editable({
    container: "body",
    selector: columnSelector,
    url: "./ajax/programarexamen.ajax.php",
    title: title,
    type: "POST",
    source: datos,
    select2: {
      placeholder: "Selecciona un elemento de la lista",
      width: 400,
    },
    validate: function (value) {
      var fechaElemento = $(this)
        .closest("tr")
        .find(".fecha_programada")
        .text()
        .trim();

      var HoraElementoIngreso = $(this)
        .closest("tr")
        .find(".hora_ingreso_curso")
        .text()
        .trim();

      if (compararFechas(fechaElemento)) {
        return "No se puede editar elementos en fechas pasadas.";
      }

      if (HoraElementoIngreso !== "00:00:00") {
        return "¡El examen ya se encuentra en proceso o finalizado!";
      }

      if ($.trim(value) === "") {
        return validateMessage;
      }
    },

    success: function (response, newValue) {
      // Manejo de la respuesta exitosa
      console.log("Respuesta exitosa web:", response, newValue);

      // Puedes hacer más cosas con la respuesta si es necesario
      // Por ejemplo, actualizar la interfaz de usuario, mostrar mensajes, etc.
    },
    ajaxOptions: {
      dataType: "json", // Asegúrate de especificar el tipo de datos esperado
      success: function (response) {
        // Manejo de la respuesta del servidor
        console.log("Respuesta del servidor web:", response);

        // Puedes hacer más cosas con la respuesta si es necesario
        // Por ejemplo, actualizar la interfaz de usuario, mostrar mensajes, etc.
      },
      error: function (xhr, textStatus, errorThrown) {
        console.error("Error en la solicitud Ajax:", textStatus, errorThrown);
      },
    },
    params: function (params) {
      // Agrega el parámetro adicional para indicar la acción
      params.procesar_data = "_update";
      return params;
    },
  });
}

// Llamada inicial a la función
cargarDataReservaPoligrafista();

$(".btn-clear-search_pol").on("click", function () {
  // Realizar la acción que desees aquí
  $("#selecionarpoligrafista").val("").trigger("change");
  $("#fecha_programada_filtro_inicio").val("");
  $("#fecha_programada_filtro_fin").val("");
  cargarDataReservaPoligrafista();
});

$(document).on(
  "change keydown keyup",
  "#fecha_programada_filtro_inicio, #fecha_programada_filtro_fin",
  function () {
    cargarDataReservaPoligrafista();
  }
);

// Agregar un controlador de cambio al elemento #seleccionarUsuario
$("#selecionarpoligrafista").on("change", function () {
  // Llamada inicial a la función
  cargarDataReservaPoligrafista();
});

$(".Poligrafista_register tbody").on("click", ".campoid", function () {
  /* if ($(this).hasClass("selectedd")) {
      // Deseleccionar
      $(this).removeClass("selectedd");
    } else { */
  // Remover clase de TR seleccionada, si es que hay
  $("tr.selectedd").removeClass("selectedd");
  // Asignar clase seleccionada a TR actual
  $(this).addClass("selectedd");
  /* } */

  // Show the modal using jQuery
  /* $("#myModaldetalle").modal("show"); */
});

/*=============================================
EDITAR 
=============================================*/
$(".Poligrafista_register").on("click", ".btn-procesar-reserva", function () {
  $("#listadoPreguntas").html("");
  var id_registro = $(this).attr("id_registro");
  var id_encriptado = $(this).attr("id_encriptado");

  var datos = new FormData();
  datos.append("id_registro_search", id_registro);

  $.ajax({
    url: "./ajax/programarexamen.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (
        respuesta["id"] &&
        respuesta["id_evaluado_id"] &&
        respuesta["id_poligrafista_id"] &&
        respuesta["id_tipoexam_id"] &&
        respuesta["id"] > 0 &&
        respuesta["id_evaluado_id"] > 0 &&
        respuesta["id_poligrafista_id"] > 0 &&
        respuesta["id_tipoexam_id"] > 0
      ) {
        $(".camposaveinput").attr("data-id", respuesta["id_registro"]);

        $("#id_edit_id_registro").val(respuesta["id_registro"]);
        $("#id_encriptado_value").val(id_encriptado);
        /*   console.log(JSON.stringify(respuesta)); */
        $("#cliente_programar")
          .html(
            "<strong>" +
              respuesta["codigo_cliente"] +
              "</strong> - " +
              respuesta["nombre"].replace(/\s+/g, " ")
          )
          .attr(
            "title",
            respuesta["codigo_cliente"] +
              " - " +
              respuesta["nombre"].replace(/\s+/g, " ")
          );
        $("#evaluado_programar")
          .html(
            "<strong>" +
              respuesta["codigo_eva"] +
              "</strong> - " +
              respuesta["nombre_evaluado"].replace(/\s+/g, " ")
          )
          .attr(
            "title",
            respuesta["codigo_eva"] +
              " - " +
              respuesta["nombre_evaluado"].replace(/\s+/g, " ")
          );
        $("#poligrafo_programar")
          .html(
            "<strong>" +
              respuesta["codigo_poligrafista"] +
              "</strong>" +
              " - " +
              respuesta["nombre_poligrafista"].replace(/\s+/g, " ")
          )
          .attr("title", respuesta["nombre_pol"].replace(/\s+/g, " "));

        $("#tipoexamen_programar")
          .html(
            "<strong>" +
              respuesta["codigo_examen_unico"] +
              "</strong>" +
              " - " +
              respuesta["descripcion_exam"].replace(/\s+/g, " ")
          )
          .attr(
            "title",
            respuesta["codigo_examen_unico"] +
              " - " +
              respuesta["descripcion_exam"].replace(/\s+/g, " ")
          );

        $("#cargo_programar")
          .html(respuesta["solicitado_cargo"])
          .attr("title", respuesta["solicitado_cargo"]);

        $("#codigo_programar").html(
          "<strong>" +
            respuesta["codigo_programar_exam"].toString() +
            "</strong>"
        );
        $("#sol_nombre_programar")
          .val(respuesta["solicitado_nombre"])
          .attr("title", respuesta["solicitado_nombre"]);

        $("#sol_apellido_programar")
          .val(respuesta["solicitado_apellido"])
          .attr("title", respuesta["solicitado_apellido"]);

        $("#fecha_sol_programar").val(
          respuesta["fecha_solicitud_re"] !== null
            ? respuesta["fecha_solicitud_re"]
            : obtenerFechaElSalvador()
        );
        $("#sol_hora_programar").val(
          respuesta["hora_solicitud_re"] !== null
            ? respuesta["hora_solicitud_re"]
            : obtenerHoraElSalvador()
        );
        $("#sol_cargo_programar").val(respuesta["cargo_solicitud_re"]);
        $("#sol_correo_programar").val(respuesta["solicitado_correo"]);
        $("#sol_telefono_programar").val(respuesta["solicitado_telefono"]);
        $("#sol_nivel_academico").val(respuesta["solicitado_nivel_academico"]);
        $("#sol_entrega_programar").val(
          respuesta["solicitado_direccion_entrega"]
        );

        /* fecha y hora programada */
        /* HORA */
        $("#fecha_y_hora_programada").html(
          formatearFecha(respuesta["fecha_programada"]) +
            " - " +
            respuesta["hora_programada"]
        );
        $("#hora_ingreso_programar").val(respuesta["hora_ingreso"]);
        $("#hora_inicio_programar").val(respuesta["hora_inicio"]);
        $("#fecha_programada").val(respuesta["fecha_programada"]);
        $("#titleFecha").html(
          " - FECHA: " +
            formatearFecha(respuesta["fecha_programada"]) +
            ", HORA PROGRAMADA: " +
            respuesta["hora_programada"] +
            ", ESTADO: " +
            respuesta["estado_exam"]
        );

        $("#estado_examen_actual").removeClass();
        let estado_class = "default";
        if (respuesta["estado_exam"] === "EN PROCESO") {
          estado_class = "warning";
        } else if (respuesta["estado_exam"] === "FINALIZADO") {
          estado_class = "success";
        }
        $("#estado_exam").val(respuesta["estado_exam"]);
        $("#forma_pago").val(respuesta["forma_pago"]);
        $("#porcentaje_cliente").val(respuesta["porcentaje_cliente"]);
        $("#porcentaje_evaluado").val(respuesta["porcentaje_evaluado"]);
        $("#resultado_examen").val(respuesta["resultado_final_examen"]);

        $("#reserva_observaciones").val(respuesta["observaciones_examen"]);
        $("#reserva_objetivo_examen").val(respuesta["objetivo_examen"]);
        $("#reserva_concepto_conclusion").val(respuesta["conclusion_examen"]);
        $("#estado_examen_actual")
          .html(respuesta["estado_exam"])
          .addClass("badge label-" + estado_class);
        verificarHoraInicio(respuesta["hora_ingreso"]);
        $("#format_examenes_programar")
          .val(respuesta["id_formato_examen"])
          .trigger("change");

        let imageUrl = respuesta["fotografia"];
        checkImageExists(
          imageUrl,
          function (url) {
            /*   console.log("La imagen existe"); */
            $("#myFoto")
              .attr("src", url)
              .attr("title", "Fotografía del evaluado");
          },
          function () {
            $("#myFoto")
              .attr(
                "src",
                "https://cdn.icon-icons.com/icons2/69/PNG/128/user_customer_person_13976.png"
              )
              .attr("title", "No subió fotografía para el evaluado");
            /*  console.log("La imagen no existe"); */
          }
        );

        consultarRowPreguntasExamen();

        /* ASIGNAR PRECIO */

        let precio1 = respuesta["precio_examen"];
        let precio2 = respuesta["valor"];

        actualizarPrecioExamen(
          respuesta["id"],
          respuesta["id_tipoexam_id"],
          precio1,
          precio2
        );

        setTimeout(() => {
          let _precio = $("#precio_programar");
          editarCampoPoligrafo(
            "precio_examen",
            _precio.val(),
            respuesta["id_registro"],
            _precio
          );
          _precio.focus();
          $("#sol_cargo_programar")
            .val(respuesta["cargo_solicitud_re"])
            .trigger("change");
        }, 600);

        inhabilitarInputs(respuesta["estado_exam"]);
      } else {
        /*  swal("Examen poligráfico", "Examen procesado correctamente", "success"); */
        swal(
          "Procesar reserva de examen",
          "<p style='text-align:left !important'> Selecciona lo siguiente:<ol style='text-align:left !important'><li>Cliente</li><li>Evaluado</li><li>Poligrafista</li><li>Tipo de examen</li></ol>  para poder continuar...👆</p>",
          "info"
        );

        // Configurar un tiempo de espera de 2000 milisegundos (2 segundos)
        setTimeout(function () {
          $("#procesarReservaProgramada").modal("hide");
        }, 50);
        // Suponiendo que el modal tiene el id "miModal"
      }
    },
  });
});

function checkImageExists(imageUrl, successCallback, errorCallback) {
  var img = new Image();
  img.onload = function () {
    successCallback(imageUrl);
  };
  img.onerror = function () {
    errorCallback();
  };
  img.src = imageUrl;
}

function editarCampoPoligrafo(campo, valor, id, elemento) {
  /*  alert("ID: " + id + ", Campo: " + campo + ", Valor: " + valor); */
  let parametros = {
    editarCampotbl_poligrafo: "editarCampotbl_poligrafo",
    campo: campo,
    valor: valor,
    id_registro: id,
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "POST",
    dataType: "json",
    success: function (response) {
      /*      console.log(JSON.stringify(response));
      alert("Hi"); */

      if (response.status === "ok") {
        elemento.css("border", "solid 2px lightgreen");
        setTimeout(() => {
          elemento.css("border", "solid 1px #d2d6de");
          elemento.css("background-color", "");
        }, 1000);
      } else {
        elemento.css("border", "solid 2px lightcoral");
      }
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
      elemento.css("border", "2px solid red");
    },
  });
}

function editarPreguntaSave(campo, valor, id, elemento) {
  /*  alert("ID: " + id + ", Campo: " + campo + ", Valor: " + valor); */
  let parametros = {
    editarCampoPreguntas: "editarCampoPreguntas",
    campo: campo,
    valor: valor,
    id_preg: id,
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "POST",
    dataType: "json",
    success: function (response) {
      /*  console.log(JSON.stringify(response)); */

      if (response.status === "ok") {
        elemento.css("border", "solid 2px lightgreen");
        setTimeout(() => {
          elemento.css("border", "solid 1px #d2d6de");
        }, 1000);
      } else {
        elemento.css("border", "solid 2px lightcoral");
      }
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
      elemento.css("border", "2px solid red");
    },
  });
}

/* EDITAR CAMPOS */
$(document).on("change", ".camposaveinput", function () {
  var id = $("#id_edit_id_registro").val();
  var campo = $(this).data("campo");
  var valor = $(this).val();

  let elemento = $(this);
  let per_cliente = $("#porcentaje_cliente");
  let per_evaluado = $("#porcentaje_evaluado");
  if (campo === "porcentaje_cliente" || campo === "porcentaje_evaluado") {
    /* CLIENTE */
    editarCampoPoligrafo(
      "porcentaje_cliente",
      per_cliente.val(),
      id,
      per_cliente
    );
    /* EVALUADO */
    editarCampoPoligrafo(
      "porcentaje_evaluado",
      per_evaluado.val(),
      id,
      per_evaluado
    );
  } else {
    /* HACER LA PETICIÓN AJAX PARA EDITAR CADA CAMPO */
    editarCampoPoligrafo(campo, valor, id, elemento);
  }
});

$(document).on("change", ".campospreguntas", function () {
  var id = $(this).data("id");
  var campo = $(this).data("campo");
  var valor = $(this).val();
  $(this).css("background-color", "");
  let elemento = $(this);

  /* HACER LA PETICIÓN AJAX PARA EDITAR CADA CAMPO */
  editarPreguntaSave(campo, valor, id, elemento);
  // Convertir el valor a mayúsculas
  var valorMayusculas = valor.toUpperCase();
  if (campo === "resultado") {
    // Obtener el campo de observación en el mismo tr
    var campoObservacion = $(this)
      .closest("tr")
      .find('textarea.campospreguntas[data-campo="observacion"]');

    // Aplicar clases de estilo a todos los inputs y selects en el mismo tr
    $(this)
      .closest("tr")
      .find("textarea.campospreguntas, select.campospreguntas")
      .each(function () {
        if (valorMayusculas === "CONFIABLE") {
          $(this).closest("tr").css("background-color", "lightgreen");
          $(this).css("color", "green"); // Cambiar a tu color de texto para "CONFIABLE"
        } else if (valorMayusculas === "NO CONFIABLE") {
          $(this).closest("tr").css("background-color", "lightcoral");
          $(this).css("color", "red"); // Cambiar a tu color de texto para "NO CONFIABLE"
        } else {
          $(this).closest("tr").css("background-color", "#f4f4f4");
          $(this).css("color", "#555"); // Cambiar a tu color de texto para "NO CONFIABLE"
          $(this).closest("tr td").css("border", "1px solid #f4f4f4");
        }
      });

    // Habilitar/deshabilitar el campo de observación según la opción seleccionada
    campoObservacion.prop("readonly", valorMayusculas !== "NO CONFIABLE");
    $(campoObservacion).css("background-color", "");

    // Si no es "No Confiable", deshabilitar el campo de observación nuevamente
    if (valorMayusculas !== "NO CONFIABLE") {
      /* HACER LA PETICIÓN AJAX PARA EDITAR CADA CAMPO */
      editarPreguntaSave("observacion", "", id, elemento);
      campoObservacion.val(""); // También puedes limpiar el valor si es necesario
      campoObservacion.prop("readonly", true);
    }
  }
});

// Cuando cambia el valor del primer input
$("#porcentaje_cliente").on("input", function () {
  // Obtener el valor del primer input como número flotante
  var valorInput1 = parseFloat($(this).val()) || 0;

  // Limitar el valor del primer input a un rango de 0 a 100
  valorInput1 = Math.min(Math.max(valorInput1, 0), 100);

  // Calcular el valor del segundo input
  var valorInput2 = 100 - valorInput1;

  // Asignar los valores a los inputs
  $("#porcentaje_cliente").val(valorInput1.toFixed(2));
  $("#porcentaje_evaluado").val(valorInput2.toFixed(2));
});

// Cuando cambia el valor del segundo input
$("#porcentaje_evaluado").on("input", function () {
  // Obtener el valor del segundo input como número flotante
  var valorInput2 = parseFloat($(this).val()) || 0;

  // Limitar el valor del segundo input a un rango de 0 a 100
  valorInput2 = Math.min(Math.max(valorInput2, 0), 100);

  // Calcular el valor del primer input
  var valorInput1 = 100 - valorInput2;

  // Asignar los valores a los inputs
  $("#porcentaje_cliente").val(valorInput1.toFixed(2));
  $("#porcentaje_evaluado").val(valorInput2.toFixed(2));
});

function cerrarModalReservaExamen() {
  $("#procesarReservaProgramada").on("hidden.bs.modal", function () {
    $("#id_edit_id_registro").val(0);
    $("#format_examenes_programar").val(0).trigger("change");
    $("#sol_cargo_programar").val(0).trigger("change");
    $("#format_examenes_programar")
      .prop("disabled", false)
      .select2("disabled", false);
    $("#mensajeAlertExamenProgramadoModal").fadeOut(0);
    $("#RegistrarProcedimientoReserva")[0].reset();
    $("#comenzarExamenHoraInicio").prop("disabled", false);
    $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
    $("#btn-generar-preguntas").prop("disabled", true);
    $(".btn-guardar-cambios-examen").prop("disabled", false);
    $("#procesarReservaProgramada").modal("hide");

    return false;
  });
}

$("#btn-generar-preguntas").on("click", function () {
  let formato = $("#format_examenes_programar").val();
  if (formato > 0) {
    // Mostrar SweetAlert con una pregunta
    swal({
      title:
        "¿Estás seguro de generar las preguntas con el formato seleccionado?",
      text: "Esta acción no se puede deshacer",
      type: "info",
      showCancelButton: true,
      confirmButtonText: "Sí, estoy seguro",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      // Resultado de la pregunta
      if (result.value) {
        if ($("#hora_inicio_programar").val() === "00:00:00") {
          let hora_actual = obtenerHoraElSalvador();
          $("#hora_inicio_programar").val(hora_actual);
        }
        generarPreguntasExamen();
        cargarDataReservaPoligrafista();
      } else {
        swal("Cancelado", "La acción ha sido cancelada", "info");
      }
    });
  } else {
    swal("Formato de examenes", "-Selecciona un formato", "error");
  }
});

$(document).on("click", ".btn-eliminar-pregunta-id", function () {
  let id = $(this).data("id");
  if (id > 0) {
    // Mostrar SweetAlert con una pregunta
    swal({
      title: "¿Estás seguro de eliminar el registro?",
      text: "Esta acción no se puede deshacer",
      type: "info",
      showCancelButton: true,
      confirmButtonText: "Sí, estoy seguro",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      // Resultado de la pregunta
      if (result.value) {
        let parametros = {
          eliminarPreguntaExamenFormato: "eliminarPreguntaExamenFormato",
          id: id,
        };
        $.ajax({
          data: parametros,
          url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
          type: "POST",
          dataType: "json",
          success: function (response) {
            /*  console.log(JSON.stringify(response)); */

            if (response.status === "ok") {
              cargarPreguntas();
              consultarRowPreguntasExamen();
            } else {
              swal("Error", "Error al eliminar la pregunta", "error");
            }
          },
          error: function (error) {
            console.error("Error en la solicitud AJAX:", error);
          },
        });
      }
    });
  } else {
    swal("Error ID", "-Selecciona ID Pregunta", "error");
  }
});

function consultarRowPreguntasExamen() {
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    obtenerRowPreguntas: "obtenerPreguntasRow",
    id_tbl_poligrafo: $("#id_edit_id_registro").val(),
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "POST",
    dataType: "json",
    success: function (response) {
      /*  console.log(JSON.stringify(response)); */
      if (response.status === "ok") {
        cargarPreguntas();
        $("#forma_pago").prop("disabled", true);
        $("#porcentaje_cliente").prop("disabled", true);
        $("#porcentaje_evaluado").prop("disabled", true);
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
        $(".btn-registrar-pregunta-poligrafo").prop("disabled", false);
        $(".btn-guardar-cambios-examen").prop("disabled", false);
        $("#resultado_examen").prop("disabled", false);
        $("#reserva_observaciones").prop("disabled", false);
        $("#reserva_objetivo_examen").prop("disabled", false);
        $("#reserva_concepto_conclusion").prop("disabled", false);
      } else {
        $("#forma_pago").prop("disabled", false);
        $("#porcentaje_cliente").prop("disabled", false);
        $("#porcentaje_evaluado").prop("disabled", false);
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
        $(".btn-guardar-cambios-examen").prop("disabled", true);
        $("#resultado_examen").prop("disabled", true);
        $("#reserva_observaciones").prop("disabled", true);
        $("#reserva_objetivo_examen").prop("disabled", true);
        $("#reserva_concepto_conclusion").prop("disabled", true);
        $(".btn-registrar-pregunta-poligrafo").prop("disabled", true);
      }

      if ($("#hora_inicio_programar").val() !== "00:00:00") {
        $("#forma_pago").prop("disabled", true);
        $("#porcentaje_cliente").prop("disabled", true);
        $("#porcentaje_evaluado").prop("disabled", true);
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
      } else {
        $("#forma_pago").prop("disabled", false);
        $("#porcentaje_cliente").prop("disabled", false);
        $("#porcentaje_evaluado").prop("disabled", false);
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", false);
      }

      if ($("#hora_ingreso_programar").val() === "00:00:00") {
        $("#comenzarExamenHoraInicio").prop("disabled", false);
        $("#forma_pago").prop("disabled", true);
        $("#porcentaje_cliente").prop("disabled", true);
        $("#porcentaje_evaluado").prop("disabled", true);
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
      } else {
        $("#comenzarExamenHoraInicio").prop("disabled", true);
      }

      if (
        response.status === "ok" ||
        $("#hora_inicio_programar").val() === "00:00:00"
      ) {
        $("#btn-generar-preguntas").prop("disabled", true).hide();
        $("#format_examenes_programar")
          .prop("disabled", true)
          .select2("disabled", true);
      } else {
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
        $("#btn-generar-preguntas").prop("disabled", false).show();
        $("#format_examenes_programar")
          .prop("disabled", false)
          .select2("disabled", false);
      }

      if (
        $("#hora_ingreso_programar").val() !== "00:00:00" &&
        $("#hora_inicio_programar").val() !== "00:00:00"
      ) {
        $("#forma_pago").prop("disabled", true);
        $("#porcentaje_cliente").prop("disabled", true);
        $("#porcentaje_evaluado").prop("disabled", true);
        $("#comenzarExamenHoraInicioEmpezar").prop("disabled", true);
        $(".btn-registrar-pregunta-poligrafo").prop("disabled", false);
      } else {
        $(".btn-registrar-pregunta-poligrafo").prop("disabled", true);
      }
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },
  });
}

function generarPreguntasExamen() {
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    generarPreguntasFormatoExamen: "generarPreguntasFormatoExamen",
    id_tbl_poligrafo: $("#id_edit_id_registro").val(),
    id_formato_examen: $("#format_examenes_programar").val(),
    hora_inicio_programar: $("#hora_inicio_programar").val(),
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "POST",
    dataType: "json",
    success: function (response) {
      if (response.status === "ok") {
        cargarPreguntas();
        consultarRowPreguntasExamen();
        swal("Éxito", "Preguntas generadas correctamente", "success");
      } else {
        swal("Error", "Error en generar las preguntas", "error");
      }
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },
  });
}

function inhabilitarInputs(estado) {
  let perfil = $("#perfil_usuario_id").val();

  if (
    perfil.toUpperCase() === "ADMINISTRADOR" ||
    perfil.toUpperCase() === "POLIGRAFIA"
  ) {
    $("#ocultarForm").show();
  } else {
    $("#ocultarForm").hide();
    $("#btn-generar-preguntas").prop("disabled", true).hide();
    $(".btn-guardar-cambios-examen").prop("disabled", true).hide();
    $(".btn-registrar-pregunta-poligrafo").prop("disabled", true).hide();
    $(
      "#RegistrarProcedimientoReserva :input, #RegistrarProcedimientoReserva select"
    ).prop("disabled", true);
    $(".CerrarModal").prop("disabled", false);
    $(".btnImprimir").prop("disabled", false);
  }

  $("#precio_programar").prop("disabled", false);
  $("#fecha_sol_programar").prop("disabled", false);
  $("#sol_hora_programar").prop("disabled", false);
  $("#sol_cargo_programar").prop("disabled", false);
  $("#forma_pago").prop("disabled", true);
  $("#porcentaje_cliente").prop("disabled", true);
  $("#porcentaje_evaluado").prop("disabled", true);
  $("#hora_inicio_programar").prop("disabled", true);
  $(".btnImprimir").prop("disabled", true);
  $("#comenzarExamenHoraInicio").prop("disabled", false);

  let fecha = $("#fecha_programada").val();
  if (fecha < obtenerFechaElSalvador()) {
    $("#comenzarExamenHoraInicio").prop("disabled", true);
  }
  /*   alert(fecha + " - Actual" + obtenerFechaElSalvador()); */
  if (
    estado.toUpperCase() === "EN PROCESO" &&
    fecha >= obtenerFechaElSalvador()
  ) {
    $("#comenzarExamenHoraInicioEmpezar").prop("disabled", false);
    $(".btnImprimir").prop("disabled", true);
    $("#precio_programar").prop("disabled", true);
    $("#fecha_sol_programar").prop("disabled", true);
    $("#sol_hora_programar").prop("disabled", true);
    $("#sol_cargo_programar").prop("disabled", true);

    $("#hora_inicio_programar").prop("disabled", true);
    $("#btn-generar-preguntas").prop("disabled", true).hide();
    $("#format_examenes_programar")
      .prop("disabled", true)
      .select2("disabled", true);
  } else if (estado.toUpperCase() === "FINALIZADO") {
    setTimeout(() => {
      $(
        "#RegistrarProcedimientoReserva :input, #RegistrarProcedimientoReserva select"
      ).prop("disabled", true);
      $(".CerrarModal").prop("disabled", false);
      $(".btnImprimir").prop("disabled", false);
    }, 1000);
  }
}

$("#comenzarExamenHoraInicio").on("click", function () {
  /*  $("#hora_ingreso_programar").val(obtenerHoraElSalvador()); */
  var camposVacios = validarTodosLosCampos(1);
  if (camposVacios.length === 0) {
    let hora_actual = obtenerHoraElSalvador();
    $("#hora_ingreso_programar").val(hora_actual);
    let id_registro = $("#id_edit_id_registro").val();
    let hora_solicitante = $("#sol_hora_programar").val();
    let fecha_solicitante = $("#fecha_sol_programar").val();
    let cargo = $("#sol_cargo_programar").val();
    let forma_pago = $("#forma_pago").val();
    let porcentaje_cliente = $("#porcentaje_cliente").val();
    let porcentaje_evaluado = $("#porcentaje_evaluado").val();
    let precio_programar = $("#precio_programar").val();

    $.ajax({
      url: "./ajax/programarexamen.ajax.php",
      type: "POST",
      dataType: "json",
      data: {
        UpdatedHourAndState: "ok",
        hora: hora_actual,
        hora_solicitante: hora_solicitante,
        fecha_solicitante: fecha_solicitante,
        cargo: cargo,
        /*    forma_pago: forma_pago,
        porcentaje_cliente: porcentaje_cliente,
        porcentaje_evaluado: porcentaje_evaluado, */
        precio_programar: precio_programar,
        id_registro: id_registro,
      },
      success: function (data) {
        if (data.status === "ok") {
          // La hora es mayor que 00:00:00
          $("#btn-generar-preguntas").prop("disabled", true);
          $("#comenzarExamenHoraInicio").prop("disabled", true);
          consultarRowPreguntasExamen();
          cargarDataReservaPoligrafista();
          $("#estado_examen_actual")
            .html("EN PROCESO")
            .addClass("badge label-warning");
          inhabilitarInputs("EN PROCESO");
        }
      },
      error: function (error) {
        console.log("Error al obtener formato:", error);
      },
    });
  } else {
    mostrarAlerta(
      "#mensajeAlertExamenProgramadoModal",
      "danger",
      "¡Completa los campos del <strong>solicitante</strong> para el módulo de <a href='clientemorse' target='_blank'><strong>CLIENTES</strong></a>!<br>" +
        mostrarAlertaCamposVacios(camposVacios)
    );
    scrollToTop();
  }
});

$("#comenzarExamenHoraInicioEmpezar").on("click", function () {
  /*  $("#hora_ingreso_programar").val(obtenerHoraElSalvador()); */
  var camposVacios = validarTodosLosCampos(2);
  if (camposVacios.length === 0) {
    let hora_actual = obtenerHoraElSalvador();
    $("#hora_inicio_programar").val(hora_actual);
    let id_registro = $("#id_edit_id_registro").val();
    let forma_pago = $("#forma_pago").val();
    let porcentaje_cliente = $("#porcentaje_cliente").val();
    let porcentaje_evaluado = $("#porcentaje_evaluado").val();

    $.ajax({
      url: "./ajax/programarexamen.ajax.php",
      type: "POST",
      dataType: "json",
      data: {
        UpdatedHourStart: "ok",
        hora_inicio: hora_actual,
        forma_pago: forma_pago,
        porcentaje_cliente: porcentaje_cliente,
        porcentaje_evaluado: porcentaje_evaluado,
        id_registro: id_registro,
      },
      success: function (data) {
        /* console.log(JSON.stringify(data)); */
        if (data.status === "ok") {
          consultarRowPreguntasExamen();
          cargarDataReservaPoligrafista();
        }
      },
      error: function (error, errors, er) {
        console.log(
          "Error encontrado:",
          JSON.stringify(error),
          JSON.stringify(errors),
          JSON.stringify(er)
        );
      },
    });
  } else {
    mostrarAlerta(
      "#mensajeAlertExamenProgramadoModal",
      "danger",

      mostrarAlertaCamposVacios(camposVacios)
    );
    scrollToTop();
  }
});

function validarTodosLosCampos(condicion) {
  if (condicion === 1) {
    var campos = [
      { id: "sol_nivel_academico", nombre: "Nivel Académico Solicitante" },
      { id: "sol_nombre_programar", nombre: "Nombre Solicitante" },
      { id: "sol_apellido_programar", nombre: "Apellido Solicitante" },
      { id: "fecha_sol_programar", nombre: "Fecha Solicitante" },
      { id: "sol_hora_programar", nombre: "Hora Solicitante" },
      { id: "sol_cargo_programar", nombre: "Cargo Solicitante" },
      { id: "sol_correo_programar", nombre: "Correo Solicitante" },
      { id: "sol_telefono_programar", nombre: "Teléfono Solicitante" },
      { id: "precio_programar", nombre: "Precio de Examen" },
      {
        id: "sol_entrega_programar",
        nombre: "Dirección de Entrega Solicitante",
      },
    ];
  } else {
    var campos = [
      { id: "sol_nivel_academico", nombre: "Nivel Académico Solicitante" },
      { id: "sol_nombre_programar", nombre: "Nombre Solicitante" },
      { id: "sol_apellido_programar", nombre: "Apellido Solicitante" },
      { id: "fecha_sol_programar", nombre: "Fecha Solicitante" },
      { id: "sol_hora_programar", nombre: "Hora Solicitante" },
      { id: "sol_cargo_programar", nombre: "Cargo Solicitante" },
      { id: "sol_correo_programar", nombre: "Correo Solicitante" },
      { id: "sol_telefono_programar", nombre: "Teléfono Solicitante" },
      { id: "precio_programar", nombre: "Precio de Examen" },
      {
        id: "sol_entrega_programar",
        nombre: "Dirección de Entrega Solicitante",
      },
      { id: "forma_pago", nombre: "Formato de Pago" },
      { id: "porcentaje_cliente", nombre: "Porcentaje del Cliente" },
      { id: "porcentaje_evaluado", nombre: "Porcentaje del Evaluado" },
    ];
  }

  var camposFaltantes = [];
  var primerCampoFaltante = null;
  var porcentajeCliente = parseFloat($("#porcentaje_cliente").val());
  var porcentajeEvaluado = parseFloat($("#porcentaje_evaluado").val());

  for (var i = 0; i < campos.length; i++) {
    var valorCampo = $("#" + campos[i].id).val();

    if (
      valorCampo.trim() === "" ||
      valorCampo.length === 0 ||
      parseFloat(valorCampo) <= 0
    ) {
      if (
        !(
          porcentajeCliente === 100 && campos[i].id === "porcentaje_evaluado"
        ) &&
        !(porcentajeEvaluado === 100 && campos[i].id === "porcentaje_cliente")
      ) {
        camposFaltantes.push(campos[i].nombre);
        $("#" + campos[i].id).css("background-color", "#ffc9c9");
        if (primerCampoFaltante === null) {
          primerCampoFaltante = campos[i].id;
        }
      }
    } else {
      $("#" + campos[i].id).css("background-color", "");
    }
  }

  if (primerCampoFaltante !== null) {
    $("#" + primerCampoFaltante).focus();
  }

  return camposFaltantes;
}

function mostrarAlertaCamposVacios(camposFaltantes) {
  var mensaje = "Por favor, completa los siguientes campos:\n";
  mensaje += "<ul>";

  for (var i = 0; i < camposFaltantes.length; i++) {
    mensaje += "<li>" + camposFaltantes[i] + "</li>";
  }

  mensaje += "</ul>";

  return mensaje;
}

function verificarHoraInicio(hora) {
  // Validar el formato de la hora usando una expresión regular
  var regex = /^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/;
  if (!regex.test(hora)) {
    console.error("Formato de hora inválido. Utilice el formato HH:mm:ss.");
    return;
  }

  // Convertir la hora a segundos para facilitar la comparación
  var [hours, minutes, seconds] = hora.split(":");
  var totalSeconds =
    parseInt(hours, 10) * 3600 +
    parseInt(minutes, 10) * 60 +
    parseInt(seconds, 10);

  // Comparar con la hora de referencia (00:00:00)
  if (totalSeconds > 0) {
    // La hora es mayor que 00:00:00
    $("#btn-generar-preguntas").prop("disabled", false);
    $("#comenzarExamenHoraInicio").prop("disabled", true);
  } else {
    // La hora es igual o anterior a 00:00:00
    $("#btn-generar-preguntas").prop("disabled", true);
    $("#comenzarExamenHoraInicio").prop("disabled", false);
  }
}

function getFormatoExamenPlantillaSelect() {
  $.ajax({
    url: "./ajax/programarexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getFormatoExamenPlantillaFormato: "ok" },
    success: function (data) {
      // Llenar el select de países
      var departSelect = $("#format_examenes_programar");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append(
        '<option value="0" selected>Seleccione un formato de examen</option>'
      );

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, formato) {
        departSelect.append(
          '<option value="' +
            formato.id +
            '">' +
            formato.codigo +
            " - " +
            formato.concepto +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener formato:", error);
    },
  });
}

function getTipoPreguntasCuestionario() {
  $.ajax({
    url: "./ajax/programarexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getTipoPreguntasCuestionario: "ok" },
    success: function (data) {
      /*       console.log(JSON.stringify(data)); */
      // Llenar el select de países
      var departSelect = $("#id_tipo_preguntas_cuestionario");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append('<option value="0" selected>Seleccione</option>');

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, tipopregunta) {
        departSelect.append(
          '<option value="' +
            tipopregunta.id +
            '">' +
            tipopregunta.codigo +
            " - " +
            tipopregunta.descripcion +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener el tipo de preguntas:", error);
    },
  });
}

function getTipoPreguntasSelectMultiple() {
  $.ajax({
    url: "./ajax/programarexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getTipoPreguntasCuestionario: "ok" },
    success: function (data) {
      /*       console.log(JSON.stringify(data)); */
      // Llenar el select de países
      var departSelect = $("#valores");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append('<option value="0" selected>Seleccione</option>');

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, tipopregunta) {
        departSelect.append(
          '<option value="' +
            tipopregunta.codigo +
            '">' +
            tipopregunta.codigo +
            " - " +
            tipopregunta.descripcion +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener el tipo de preguntas:", error);
    },
  });
}

function llenarCargoClienteSolicitado() {
  // Realizar solicitud AJAX para obtener municipios
  $.ajax({
    url: "./ajax/programarexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getCargoCliente: "ok" },
    success: function (data) {
      /*      console.log(JSON.stringify(data)); */
      // Llenar el select de municipios
      var cargosol = $("#sol_cargo_programar");
      cargosol.empty(); // Limpiar opciones anteriores
      // Agregar la opción por defecto
      cargosol.append(
        '<option value="0" selected>Selecciona un cargo</option>'
      );
      $.each(data, function (index, cargo) {
        cargosol.append(
          '<option value="' + cargo.id + '">' + cargo.nombre_cargo + "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener evaluados:", error);
    },
  });
}

function scrollToTop() {
  $(".modal-body").animate({ scrollTop: 0 }, 500);
}

/* CARGAR DATOS */
function cargarPreguntas() {
  // Show the loading spinner
  $("#loadingSpinnerPreguntas").show();
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    getPreguntasExamen: "preguntas",
    id_tbl_poligrafo: $("#id_edit_id_registro").val(),
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "POST",

    success: function (response) {
      // Actualiza el contenido del elemento sin el efecto fadeIn
      $("#listadoPreguntas").html(response);
      let estadoExam = $("#estado_exam").val().toUpperCase();
      let fechaProgramada = $("#fecha_programada").val();
      let fechaActualElSalvador = obtenerFechaElSalvador();
      // Formatear la fecha programada al formato 'DD/MM/YYYY'
      let fechaFormateadaProgramada = cambiarFormatoFecha(fechaProgramada);

      if (
        estadoExam === "FINALIZADO" ||
        fechaFormateadaProgramada < fechaActualElSalvador
      ) {
        $(".btn-guardar-cambios-examen").prop("disabled", true);
        $("#btn-generar-preguntas").prop("disabled", true);
        $("#comenzarExamenHoraInicio").prop("disabled", true);
        setTimeout(() => {
          $(".btn-eliminar-pregunta-id").prop("disabled", true);
          $(".campospreguntas").prop("disabled", true);
          $(".btn-registrar-pregunta-poligrafo").prop("disabled", true);
        }, 400);
      }
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },

    complete: function () {
      $("#loadingSpinnerPreguntas").hide();
    },
  });
}

function actualizarPrecioExamen(id_cliente, id_tipoexamen, precio1, precio2) {
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    getPrecioExamen: "precioExamen",
    id_clientemorse_precio: id_cliente,
    id_tipoexamen_precio: id_tipoexamen,
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "post",

    success: function (response) {
      // Actualiza el contenido del elemento sin el efecto fadeIn
      /* console.log(response); */
      let precio = 0;
      $("#precioUpdate").html("");

      /* if (
        parseFloat(precio1) > 0 ||
        (!isNaN(response) && parseFloat(response) > 0)
      ) {
        if (precio1 > 0) {
          precio = precio1;
        } else {
          precio = response;
        }
      } else {
        precio = precio2;
      } */

      precio = precio2;
      if (response > 0 && !isNaN(response)) {
        precio = response;
      }
      $("#precio_programar").val(precio);

      /*  $("#precioUpdate").html(
        "PRECIO ESPECIAL DE EXAMEN ASIGNADO PARA CLIENTE:<strong> $ " +
          parseFloat(response).toFixed(2) +
          "</strong>"
      ); */
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },
  });
}

function obtenerHoraElSalvador() {
  // Crear un objeto de fecha con la hora actual
  var fechaActual = new Date();

  // Obtener el timezone de El Salvador (UTC-6)
  var timeZoneElSalvador = "America/El_Salvador";

  // Configurar el formato de fecha y hora con el timezone
  var options = {
    hour: "2-digit",
    minute: "2-digit",
    /*     second: "2-digit", */
    timeZone: timeZoneElSalvador,
  };

  // Formatear la fecha y hora
  var horaElSalvador = fechaActual.toLocaleTimeString("es-SV", options);

  return horaElSalvador;
}
function cambiarFormatoFecha(fecha) {
  // Crear un objeto de fecha a partir de la cadena de fecha y ajustar la zona horaria
  let fechaObjeto = new Date(`${fecha}T00:00:00-06:00`);

  // Obtener el día, mes y año
  let dia = agregarCero(fechaObjeto.getDate());
  let mes = agregarCero(fechaObjeto.getMonth() + 1); // Los meses comienzan desde 0, así que sumamos 1
  let anio = fechaObjeto.getFullYear();

  // Función para agregar un cero si el número es menor a 10
  function agregarCero(numero) {
    return numero < 10 ? `0${numero}` : numero;
  }

  // Formatear la fecha en 'DD/MM/YYYY'
  let fechaFormateada = `${anio}-${mes}-${dia}`;

  return fechaFormateada;
}

// Obtener la fecha actual en El Salvador
function obtenerFechaElSalvador() {
  let fechaActual = new Date();
  fechaActual.setUTCHours(fechaActual.getUTCHours() - 6); // Ajustar la zona horaria
  return cambiarFormatoFecha(fechaActual.toISOString().split("T")[0]);
}

function formatearFecha(fecha) {
  // Separar la fecha en año, mes y día
  var partes = fecha.split("-");
  var anio = partes[0];
  var mes = partes[1];
  var dia = partes[2];

  // Formatear la fecha como DD/MM/YYYY
  var fechaFormateada = dia + "/" + mes + "/" + anio;

  return fechaFormateada;
}

$(".btnImprimirModalView").on("click", function () {
  // Obtener el valor del campo de entrada

  let id_registro = $("#id_encriptado_value").val();

  if (id_registro <= 0 || id_registro === "") {
    id_registro = $("#id_encriptado_input").val();
  }
  let valores = $("#valores").val();

  // Construir la URL con el parámetro GET
  let url =
    "./vistas/modulos/pdfresultadoexamen.php?id=" +
    id_registro +
    "&v=" +
    valores;

  // Abrir la URL en una nueva pestaña o ventana del navegador
  window.open(url, "_blank");
});

$(document).on("click", ".levantarModalImprimir", function () {
  // Obtener el valor de id_encriptado del atributo id
  var id_encriptado = $(this).attr("id_encriptado");
  // Asignar el valor de id_encriptado al input dentro del modal
  $("#id_encriptado_input").val(id_encriptado);

  /* alert(id_encriptado); */
});

$(".btn-guardar-cambios-examen").on("click", function () {
  var camposVacios = validarTodosLosCamposFormulario();
  if (camposVacios.length === 0) {
    let id_registro = $("#id_edit_id_registro").val();
    let resultado_exam = $("#resultado_examen").val();
    $.ajax({
      url: "./ajax/programarexamen.ajax.php",
      type: "POST",
      dataType: "json",
      data: {
        UpdatedTblPoligrafoFinal: "ok",
        resultado_exam: resultado_exam,
        id_registro: id_registro,
      },
      success: function (data) {
        if (data.status === "ok") {
          // La hora es mayor que 00:00:00
          $("#btn-generar-preguntas").prop("disabled", true);
          $("#comenzarExamenHoraInicio").prop("disabled", true);
          $("#estado_examen_actual")
            .html("FINALIZADO")
            .addClass("badge label-success");
          inhabilitarInputs("FINALIZADO");
          mostrarAlerta(
            "#mensajeAlertExamenProgramadoModal",
            "success",
            "✅ Examen poligráfico finalizado correctamente"
          );

          swal(
            "Examen poligráfico",
            "Examen procesado correctamente",
            "success"
          );
        } else {
          mostrarAlerta(
            "#mensajeAlertExamenProgramadoModal",
            "danger",
            "❌ Error al procesar examen poligráfico"
          );
        }
        scrollToTop();
        cargarDataReservaPoligrafista();
      },
      error: function (error) {
        console.log("Error al obtener formato:", error);
      },
    });
  } else {
    mostrarAlerta(
      "#mensajeAlertExamenProgramadoModal",
      "danger",
      "👮‍♀️👮‍♂️" + mostrarAlertaCamposVacios(camposVacios)
    );
    scrollToTop();
  }
});

function validarTodosLosCamposFormulario() {
  var campos = [
    { id: "resultado_examen", nombre: "Resultado de examen" },
    { id: "reserva_observaciones", nombre: "Observacion del examen" },
    { id: "reserva_objetivo_examen", nombre: "Objetivo del examen" },
    { id: "reserva_concepto_conclusion", nombre: "Conclusión del examen" },
    { id: "sol_nivel_academico", nombre: "Nivel Académico Solicitante" },
    { id: "sol_nombre_programar", nombre: "Nombre Solicitante" },
    { id: "sol_apellido_programar", nombre: "Apellido Solicitante" },
    { id: "fecha_sol_programar", nombre: "Fecha Solicitante" },
    { id: "sol_hora_programar", nombre: "Hora Solicitante" },
    { id: "sol_cargo_programar", nombre: "Cargo Solicitante" },
    { id: "sol_correo_programar", nombre: "Correo Solicitante" },
    { id: "sol_telefono_programar", nombre: "Teléfono Solicitante" },
    { id: "precio_programar", nombre: "Precio de Examen" },
    { id: "sol_entrega_programar", nombre: "Dirección de Entrega Solicitante" },
    { id: "forma_pago", nombre: "Formato de Pago" },
    { id: "porcentaje_cliente", nombre: "Porcentaje del Cliente" },
    { id: "porcentaje_evaluado", nombre: "Porcentaje del Evaluado" },
    { id: "hora_inicio_programar", nombre: "Hora Inicio" },
    { id: "hora_ingreso_programar", nombre: "Hora ingresó" },
    { id: "id_edit_id_registro", nombre: "ID de reserva no encontrado." },
  ];
  var camposFaltantes = [];
  let encontro = false;
  $(".campospreguntas").each(function () {
    if (!$(this).prop("readonly")) {
      var valorCampo = $(this).val();
      if (valorCampo.trim() === "") {
        encontro = true;
        $(this).css("background-color", "#fffa5a");
      } else {
        $(this).css("background-color", "");
      }
    }
  });

  if (encontro) {
    camposFaltantes.push("Completa los campos de fondo amarillo y rojo");
  }

  var primerCampoFaltante = null;
  var porcentajeCliente = parseFloat($("#porcentaje_cliente").val());
  var porcentajeEvaluado = parseFloat($("#porcentaje_evaluado").val());

  for (var i = 0; i < campos.length; i++) {
    var valorCampo = $("#" + campos[i].id).val();

    if (
      valorCampo.trim() === "" ||
      valorCampo.length === 0 ||
      parseFloat(valorCampo) <= 0
    ) {
      if (
        !(
          porcentajeCliente === 100 && campos[i].id === "porcentaje_evaluado"
        ) &&
        !(porcentajeEvaluado === 100 && campos[i].id === "porcentaje_cliente")
      ) {
        camposFaltantes.push(campos[i].nombre);
        $("#" + campos[i].id).css("background-color", "#ffc9c9");
        if (primerCampoFaltante === null) {
          primerCampoFaltante = campos[i].id;
        }
      }
    } else {
      $("#" + campos[i].id).css("background-color", "");
    }
  }

  if (primerCampoFaltante !== null) {
    $("#" + primerCampoFaltante).focus();
  }

  return camposFaltantes;
}

$(".Poligrafista_register").on(
  "click",
  ".btnEliminarProgramacionExamen",
  function () {
    var id_registro = $(this).attr("id_registro");
    var estado_examen_del = $(this).attr("estado_examen_del");

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
        // Perform AJAX request here
        $.ajax({
          url: "./ajax/programarexamen.ajax.php", // Replace with your server endpoint
          type: "POST", // Change the HTTP method as needed
          data: {
            id_registro_delete: id_registro,
            estado_examen_del: estado_examen_del,
          }, // Pass the data to the server
          dataType: "json",
          success: function (response) {
            if (response.status === "ok") {
              mostrarAlerta(
                "#mensajeAlertPrincipal",
                "success",
                "¡Programación de examen eliminado correctamente!"
              );
              cargarDataReservaPoligrafista();
            } else if (response.status === "errorEstado") {
              mostrarAlerta(
                "#mensajeAlertPrincipal",
                "danger",
                "¡Error al eliminar, ya que el estado es <strong>FINALIZADO</strong> o no tienes permiso para realizar la operación!"
              );
              cargarDataReservaPoligrafista();
            } else {
              mostrarAlerta(
                "#mensajeAlertPrincipal",
                "danger",
                "¡Hubo un error al procesar la acción!" +
                  JSON.stringify(response)
              );
            }
          },
          error: function (error) {
            // Handle error
            console.error("Error in AJAX request:", error);
          },
        });
      }
    });
  }
);
