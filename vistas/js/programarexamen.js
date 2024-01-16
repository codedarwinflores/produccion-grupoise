$(document).ready(function () {
  // Captura el evento cuando se muestra el popup

  cerrarModal();
  cargarHoras();

  $(document).ready(function () {
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
          console.log(response);
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
    $(id).fadeOut(3500);
  }, 3500);
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
  var hue = Math.floor(Math.random() * 360);
  var pastel = "hsl(" + hue + ", 90%, 98%)"; // Adjust saturation and lightness for pastel shades
  return pastel;
}

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
        });
      },

      // drawCallback function
      drawCallback: function () {
        // Loop through each row
        $(this.api().rows().nodes()).each(function (index, row) {
          // Your code for column 6
          var fecha = $(row).find("td:eq(5)").text(); // Date is in column 6 (index 5)
          var horaProgramada = $(row).find("td:eq(6)").text(); // Time is in column 7 (index 6)

          // Combine date and time to create a unique key
          var key = fecha + "_" + horaProgramada;

          // Check if this combination has been encountered before
          if (!(key in colorMap)) {
            // If no color is assigned for this combination, generate a new pastel color
            colorMap[key] = getRandomPastelColor();
          }

          // Apply the color directly to all cells in column 6 in the same row
          $(row).find("td.hora_programada").css({
            "background-color": colorMap[key],
            "font-weight": "bold",
          });
        });
      },
      // Resto de la configuración de DataTable...
    });
  }
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

function compararFechas(fechaElemento) {
  // Obtener la fecha actual en el huso horario de El Salvador (GMT-6)
  var fechaActual = new Date();
  fechaActual.setUTCHours(fechaActual.getUTCHours() - 6);

  // Formatear la fecha actual a YYYY-MM-DD
  var fechaFormateada = fechaActual.toISOString().slice(0, 10);
  /*   console.log(fechaElemento); */
  // Comparar las fechas
  if (new Date(fechaElemento) < new Date(fechaFormateada)) {
    return true; // No se puede editar elementos en fechas pasadas.
  } else {
    return false; // La fecha es igual o en el futuro.
  }
}

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
    if (compararFechas(fechaElemento)) {
      return "No se puede editar elementos en fechas pasadas.";
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

// También podrías realizar la inicialización directamente en la función de éxito (done)
// si eso tiene más sentido en tu aplicación
function inicializarXEditable(
  selector,
  columnSelector,
  title,
  urlAction,
  validateMessage
) {
  obtenerDatosJSON(urlAction)
    .done(function (datos) {
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
          if (compararFechas(fechaElemento)) {
            return "No se puede editar elementos en fechas pasadas.";
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
            console.error(
              "Error en la solicitud Ajax:",
              textStatus,
              errorThrown
            );
          },
        },
        params: function (params) {
          // Agrega el parámetro adicional para indicar la acción
          params.procesar_data = "_update";
          return params;
        },
      });
    })
    .fail(function (xhr, status, error) {
      console.error("Error en la solicitud Ajax:", status, error);
    });
}

// Inicializar xEditable para evaluados
inicializarXEditable(
  ".Poligrafista_register",
  "td.id_evaluado",
  "Seleccionar Evaluado",
  "obtenerDataEvaluados",
  "El evaluado es requerido"
);

// Inicializar xEditable para poligrafistas
inicializarXEditable(
  ".Poligrafista_register",
  "td.id_poligrafista",
  "Seleccionar Poligrafista",
  "obtenerData",
  "El poligrafista es requerido"
);
// Inicializar xEditable para tipo de examen
inicializarXEditable(
  ".Poligrafista_register",
  "td.id_tipo_examen",
  "Seleccionar Tipo de Examenes",
  "obtenerDataTipoExamen",
  "El tipo de examenes es requerido"
);

// Inicializar xEditable parA CLIENTES
inicializarXEditable(
  ".Poligrafista_register",
  "td.id_cliente",
  "Seleccionar el cliente",
  "obtenerClientes",
  "El cliente es requerido"
);

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
        /*   console.log(JSON.stringify(respuesta)); */
        $("#cliente_programar").val(respuesta["nombre"]);
        $("#evaluado_programar").val(respuesta["nombre_evaluado"]);
        $("#poligrafo_programar").val(respuesta["nombre_pol"]);
        $("#tipoexamen_programar").val(respuesta["examenes"]);
        $("#precio_programar").val(respuesta["valor"]);
        $("#codigo_programar").val(
          ("000" + respuesta["id_registro"] + "/2024").toString()
        );

        $("#sol_nombre_programar").val(respuesta["solicitado_nombre"]);
        $("#sol_apellido_programar").val(respuesta["solicitado_apellido"]);
        $("#fecha_sol_programar").val(respuesta["fecha_solicitud"]);
        $("#sol_hora_programar").val(respuesta["hora"]);
        $("#sol_cargo_programar").val(respuesta["solicitado_cargo"]);
        $("#sol_correo_programar").val(respuesta["solicitado_correo"]);
        $("#sol_telefono_programar").val(respuesta["solicitado_telefono"]);
        $("#sol_entrega_programar").val(
          respuesta["solicitado_direccion_entrega"]
        );

        /*  cargarPreguntas(); */
      } else {
        alert(
          "SELECIONA LO SIGUIENTE: \n 1. Cliente\n 2. Evaluado\n 3. Poligrafista\n y Tipo Examen\n para poder continuar...👆"
        );

        // Configurar un tiempo de espera de 2000 milisegundos (2 segundos)
        setTimeout(function () {
          $("#procesarReservaProgramada").modal("hide");
        }, 100);
        // Suponiendo que el modal tiene el id "miModal"
      }
    },
  });
});

$("#comenzarExamen").on("click", function () {
  alert("Comenzó");

  $("#hora_ingreso_programar").val(obtenerHoraElSalvador());
  $("#hora_inicio_programar").val(obtenerHoraElSalvador());

  cargarPreguntas();
});

/* CARGAR DATOS */
function cargarPreguntas() {
  // Show the loading spinner
  $("#loadingSpinnerPreguntas").show();
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    getPreguntas: "preguntas",
  };
  $.ajax({
    data: parametros,
    url: "./ajax/programarexamen.ajax.php", // Verifica la ruta correcta
    type: "post",

    success: function (response) {
      // Actualiza el contenido del elemento sin el efecto fadeIn
      $("#listadoPreguntas").html(response);
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },

    complete: function () {
      $("#loadingSpinnerPreguntas").hide();
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
