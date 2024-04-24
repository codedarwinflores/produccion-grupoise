$(document).ready(function () {
  getTipoExamenSelect();
  getClienteMorseSelect();
  getAreaFormatoExamenSelect();
  getPreguntasFormatoExamenSelect();
  cargarDataFormatoExamen();
  cargarDataFormatoExamenPregunta();
  cerrarModalFormatoExamen();
  cerrarModalFormatoExamenPregunta();

  /* REGISTRAR TIPO DE PREGUNTA */
  $("#form_formato_examen").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_formato_examen");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/formatoexamen.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormFormatoExamen",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          /*   console.log(JSON.stringify(response)); */
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormFormatoExamen",
              "success",
              "¡Formato examen registrado correctamente!"
            );
            $("#form_formato_examen")[0].reset();
            cargarDataFormatoExamen();
            cargarDataFormatoExamenPregunta();
            /*    cargarDataPregunta(); */
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormFormatoExamen",
              "success",
              "¡Formato examen editado correctamente!"
            );
            cargarDataFormatoExamen();
            cargarDataFormatoExamenPregunta();
            /*  cargarDataPregunta(); */
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormFormatoExamen",
              "danger",
              "¡Concepto / código de de formato, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormFormatoExamen",
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
            "#mensajeFormFormatoExamen",
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
      mostrarAlerta("#mensajeFormFormatoExamen", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  /* REGISTRAR PREGUNTA */
  $("#form_formato_examen_pregunta").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios(
      "#form_formato_examen_pregunta"
    );

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);

      // Agregar el campo extra al formData
      formData.append(
        "id_formato_examen_pregunta_id",
        $("#id_formato_examen_pregunta_id").val()
      );
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/formatoexamen.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormformato_examen_pregunta",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          console.log(JSON.stringify(response));
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormformato_examen_pregunta",
              "success",
              "Pregunta registrada correctamente!"
            );
            $("#form_formato_examen_pregunta")[0].reset();
            $("#formato_pregunta_area").val(0).trigger("change");
            $("#formato_pregunta_test").val("").trigger("change");
            $("#id_pregunta_formato_examen").val(0).trigger("change");
            cargarDataFormatoExamenPregunta();
            consultarOrdenPregunta($("#id_formato_examen_pregunta_id").val());
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormformato_examen_pregunta",
              "success",
              "Pregunta del formato examen editada correctamente!"
            );
            cargarDataFormatoExamenPregunta();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormformato_examen_pregunta",
              "danger",
              "¡Pregunta o N° de orden, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormformato_examen_pregunta",
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
            "#mensajeFormformato_examen_pregunta",
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
      mostrarAlerta("#mensajeFormformato_examen_pregunta", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  $(".tbl_formato_examen tbody").on("click", ".camposselecexamen", function () {
    $(".btn-add-FormatoExamen").removeAttr("disabled");

    $("tr.selectedd").removeClass("selectedd");
    // Asignar clase seleccionada a TR actual
    $(this).addClass("selectedd");

    let id = $(this).attr("id_formatoexamen");
    let concepto = $(this).attr("concepto");
    $("#id_formato_examen_pregunta_id").val(id);
    $("#titleformaexamenpreguntas").text(
      "CONCEPTO FORMATO EXAMEN: " + concepto
    );
    cargarDataFormatoExamenPregunta();

    consultarOrdenPregunta(id);
  });
});

function consultarOrdenPregunta(id) {
  $.ajax({
    data: {
      obtenerOrden: "orden",
      id_formato: id,
    },
    url: "./ajax/formatoexamen.ajax.php",
    type: "POST",
    success: function (response) {
      $("#formato_pregunta_orden").val(response);
    },
  });
}

// Variable para almacenar la instancia de DataTable
let miTablaFormatoExamen;

function cargarDataFormatoExamen() {
  $(".btn-add-FormatoExamen").attr("disabled", true);
  $("#id_formato_examen_pregunta_id").val(0);
  $("#titleformaexamenpreguntas").text("CONCEPTO DE FORMATO DE EXAMEN: ");
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_formato_examen")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaFormatoExamen.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaFormatoExamen = $(".tbl_formato_examen").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "./ajax/formatoexamen.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsFormatoExamen = "Consult";
        },
        dataSrc: "data",
      },
      dataType: "json",
      deferRender: true,
      retrieve: true,
      processing: true,
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
        $(row).addClass("camposselecexamen");
        // Set the data-id attribute based on the data
        $(row).attr("id_formatoexamen", data[1]);
        $(row).attr("concepto", data[3] + " - " + data[4] + " - " + data[5]);
      },
      // Resto de la configuración de DataTable...
    });
  }
}

// Variable para almacenar la instancia de DataTable
let miTablaFormatoExamenPregunta;

function cargarDataFormatoExamenPregunta() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_formato_examen_preguntas")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaFormatoExamenPregunta.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaFormatoExamenPregunta = $(".tbl_formato_examen_preguntas").DataTable(
      {
        columnDefs: [
          {
            targets: [1], // Replace with the actual index of the 'cod_cliente' column
            visible: false,
          },
        ],
        ajax: {
          url: "./ajax/formatoexamen.ajax.php",
          type: "GET",
          data: function (d) {
            d.actionsFormatoExamenPregunta = "Consult";
            d.id_formato_examen_pregunta = $(
              "#id_formato_examen_pregunta_id"
            ).val();
          },
          dataSrc: "data",
        },
        dataType: "json",
        deferRender: true,
        retrieve: true,
        processing: true,
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
      }
    );
  }
}

/* OBETENER SELECT TIPO DE EXAMEN */
function getTipoExamenSelect() {
  $.ajax({
    url: "./ajax/formatoexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getTipoExamenFormato: "ok" },
    success: function (data) {
      // Llenar el select de países
      var departSelect = $("#formato_id_tipo_examen");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append('<option value="0" selected>Seleccione</option>');

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, tipoexamen) {
        departSelect.append(
          '<option value="' +
            tipoexamen.id +
            '">' +
            tipoexamen.codigo +
            " - " +
            tipoexamen.descripcion +
            " $" +
            tipoexamen.valor +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener países:", error);
    },
  });
}

/* OBETENER SELECT TIPO DE EXAMEN */
function getClienteMorseSelect() {
  $.ajax({
    url: "./ajax/formatoexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getClienteMorseFormato: "ok" },
    success: function (data) {
      // Llenar el select de países
      var departSelect = $("#formato_id_cliente_morse");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append('<option value="0" selected>Seleccione</option>');

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, ClieteMorse) {
        departSelect.append(
          '<option value="' +
            ClieteMorse.id +
            '">' +
            ClieteMorse.codigo_cliente +
            " - " +
            ClieteMorse.nombre +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener países:", error);
    },
  });
}

/* OBETENER SELECT AREA EXAMEN */
function getAreaFormatoExamenSelect() {
  $.ajax({
    url: "./ajax/formatoexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getAreaFormatoExamenFormato: "ok" },
    success: function (data) {
      // Llenar el select de países
      var departSelect = $("#formato_pregunta_area");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append('<option value="0" selected>Seleccione</option>');

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, area) {
        departSelect.append(
          '<option value="' +
            area.id +
            '">' +
            area.codigo +
            " - " +
            area.motivo +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener países:", error);
    },
  });
}

/* OBETENER SELECT AREA EXAMEN */
function getPreguntasFormatoExamenSelect() {
  $.ajax({
    url: "./ajax/formatoexamen.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getPreguntasFormatoExamenFormato: "ok" },
    success: function (data) {
      // Llenar el select de países
      var departSelect = $("#id_pregunta_formato_examen");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append('<option value="0" selected>Seleccione</option>');

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, preguntas) {
        departSelect.append(
          '<option value="' +
            preguntas.id +
            '">' +
            preguntas.codigo +
            " - " +
            preguntas.pregunta +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener países:", error);
    },
  });
}

// Asigna la función al evento onchange del input con ID "codigoInput"
$("#formato_codigo").on("change", function () {
  generarCodigoFormatoExamen($(this).val());
});

/* GENERAR CODIGO DE FORMATO DE EXAMEN */
function generarCodigoFormatoExamen(codigo) {
  $.ajax({
    data: {
      generarCodFormatoExamen: "correlativo",
      codigoNewFormatoExamen: codigo,
    },
    url: "./ajax/formatoexamen.ajax.php",
    type: "POST",
    success: function (response) {
      /*       console.log(response); */
      if (response === "existe") {
        $("#formato_codigo").val("");
        $("#formato_codigo").focus();
        // Mostrar mensaje de error
        mostrarAlerta(
          "#mensajeFormFormatoExamen",
          "danger",
          "El código digitado ya existe en la base de datos"
        );
      }
    },
  });
}

function cerrarModalFormatoExamen() {
  $("#modalAgregarFormatoExamen").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveeditformatoexamen").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_formatoexamen").val(0);
    $("#type_action_form_formatoexamen").val("save");
    $("#editartitletipoformatoexamen").html("Registrar");
    $("#formato_id_tipo_examen").val(0).trigger("change");
    $("#formato_id_cliente_morse").val(0).trigger("change");
    $("#form_formato_examen")[0].reset();

    $("#modalAgregarFormatoExamen").modal("hide");
    return false;
  });
}

function cerrarModalFormatoExamenPregunta() {
  $("#modalFormatoExamenPregunta").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveeditformatp_examen_pregunta").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_formato_examen_pregunta").val(0);
    $("#type_action_formato_examen_pregunta").val("save");
    $("#editartitleformato_examen_pregunta").html("Registrar");
    $("#formato_pregunta_area").val(0).trigger("change");
    $("#formato_pregunta_test").val("").trigger("change");
    $("#id_pregunta_formato_examen").val(0).trigger("change");
    $("#form_formato_examen_pregunta")[0].reset();
    consultarOrdenPregunta($("#id_formato_examen_pregunta_id").val());
    $("#modalFormatoExamenPregunta").modal("hide");
    return false;
  });
}

$(".tbl_formato_examen").on("click", ".btnEditarFormatoExamen", function () {
  var idFormatoExamen = $(this).attr("idFormatoExamen");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btn-idsaveeditformatoexamen").html(
    '<i class="fa fa-pencil-square-o"></i> Editar'
  );
  $("#editartitletipoformatoexamen").html("Editar");
  $("#type_action_form_formatoexamen").val("update");

  $.ajax({
    url: "./ajax/formatoexamen.ajax.php",
    method: "POST",
    data: { id_formato_examen: idFormatoExamen },
    dataType: "json",
    success: function (respuesta) {
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_formatoexamen").val(respuesta.id);
      $("#formato_codigo").val(respuesta.codigo);
      $("#formato_id_tipo_examen")
        .val(respuesta.id_tipo_examen)
        .trigger("change");

      $("#formato_id_cliente_morse")
        .val(respuesta.id_cliente_morse)
        .trigger("change");

      $("#formato_concepto").val(respuesta.concepto);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

$(".tbl_formato_examen_preguntas").on(
  "click",
  ".btnEditarFormatoExamenPregunta",
  function () {
    var idFormatoExamenPregunta = $(this).attr("idFormatoExamenPregunta");

    // CAMBIAR DATOS DEL TITULO Y BUTTON
    $("#btn-idsaveeditformatp_examen_pregunta").html(
      '<i class="fa fa-pencil-square-o"></i> Editar'
    );
    $("#editartitleformato_examen_pregunta").html("Editar");
    $("#type_action_formato_examen_pregunta").val("update");

    $.ajax({
      url: "./ajax/formatoexamen.ajax.php",
      method: "POST",
      data: { id_formato_examen_update_pregunta: idFormatoExamenPregunta },
      dataType: "json",
      success: function (respuesta) {
        /*   console.log(JSON.stringify(respuesta)); */
        // Actualizar los campos del formulario con la respuesta del servidor
        $("#id_edit_formato_examen_pregunta").val(respuesta.id);
        $("#formato_pregunta_area").val(respuesta.id_area).trigger("change");
        $("#formato_pregunta_test").val(respuesta.test).trigger("change");
        $("#formato_pregunta_orden").val(respuesta.orden);
        $("#id_pregunta_formato_examen")
          .val(respuesta.id_pregunta)
          .trigger("change");
      },
      error: function (xhr, status, error) {
        console.error(xhr, status, error);
      },
    });
  }
);

/*=============================================
ELIMINAR 
=============================================*/
$(".tbl_formato_examen").on("click", ".btnEliminarFormatoExamen", function () {
  var idFormatoExamen = $(this).attr("idFormatoExamen");

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
        url: "./ajax/formatoexamen.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_formatoexamen_delete: idFormatoExamen }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertFormatoExamenDelete",
              "success",
              "¡Formato examen eliminado correctamente!"
            );
            cargarDataFormatoExamen();
            cargarDataFormatoExamenPregunta();
          } else {
            mostrarAlerta(
              "#mensajeAlertFormatoExamenDelete",
              "danger",
              "¡Hubo un error al procesar la acción!" + JSON.stringify(response)
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
});

$(".tbl_formato_examen_preguntas").on(
  "click",
  ".btnEliminarFormatoExamenPregunta",
  function () {
    var idFormatoExamenPregunta = $(this).attr("idFormatoExamenPregunta");

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
          url: "./ajax/formatoexamen.ajax.php", // Replace with your server endpoint
          type: "POST", // Change the HTTP method as needed
          data: { idFormatoExamenPregunta_delete: idFormatoExamenPregunta }, // Pass the data to the server
          success: function (response) {
            if (response === "delete") {
              mostrarAlerta(
                "#mensajeAlertFormatoExamenPreguntaDelete",
                "success",
                "¡Pregunta eliminada del formato de examen correctamente!"
              );
              cargarDataFormatoExamenPregunta();
            } else {
              mostrarAlerta(
                "#mensajeAlertFormatoExamenPreguntaDelete",
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
