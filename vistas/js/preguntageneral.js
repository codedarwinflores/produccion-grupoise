$(document).ready(function () {
  cargarDataTipoPregunta();
  cargarDataPregunta();
  cerrarModalTipoPregunta();
  cerrarModalPregunta();
  /* REGISTRAR TIPO DE PREGUNTA */
  $("#form_tipo_pregunta").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_tipo_pregunta");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/preguntageneral.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormTipoPregunta",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          console.log(JSON.stringify(response));
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormTipoPregunta",
              "success",
              "Tipo de pregunta registrada correctamente!"
            );
            $("#form_tipo_pregunta")[0].reset();

            cargarDataTipoPregunta();
            cargarDataPregunta();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormTipoPregunta",
              "success",
              "Tipo de pregunta editada correctamente!"
            );
            cargarDataTipoPregunta();
            cargarDataPregunta();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormTipoPregunta",
              "danger",
              "¡Descripción / código de tipo pregunta, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormTipoPregunta",
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
            "#mensajeFormTipoPregunta",
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
      mostrarAlerta("#mensajeFormTipoPregunta", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  /* REGISTRAR PREGUNTA */
  $("#form_pregunta").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_pregunta");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);

      // Agregar el campo extra al formData
      formData.append("id_tipo_pregunta_id", $("#id_tipo_pregunta_id").val());
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/preguntageneral.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormPregunta",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormPregunta",
              "success",
              "Pregunta registrada correctamente!"
            );
            $("#form_pregunta")[0].reset();
            cargarDataPregunta();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormPregunta",
              "success",
              "Pregunta editada correctamente!"
            );
            cargarDataPregunta();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormPregunta",
              "danger",
              "¡Pregunta, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormPregunta",
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
            "#mensajeFormPregunta",
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
      mostrarAlerta("#mensajeFormPregunta", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  $(".tbl_tipo_pregunta tbody").on("click", ".camposelec", function () {
    $(".btn-add-Pregunta").removeAttr("disabled");

    $("tr.selectedd").removeClass("selectedd");
    // Asignar clase seleccionada a TR actual
    $(this).addClass("selectedd");

    let id = $(this).attr("id_tipopregunta");
    let tipo_pregunta = $(this).attr("tipopregunta");
    $("#id_tipo_pregunta_id").val(id);
    $("#titlepreguntas").text("TIPO DE PREGUNTAS: " + tipo_pregunta);
    cargarDataPregunta();
  });
});

// Variable para almacenar la instancia de DataTable
let miTablaTipoPregunta;

function cargarDataTipoPregunta() {
  $(".btn-add-Pregunta").attr("disabled", true);
  $("#id_tipo_pregunta_id").val(0);
  $("#titlepreguntas").text("TIPO DE PREGUNTAS: ");
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_tipo_pregunta")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaTipoPregunta.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaTipoPregunta = $(".tbl_tipo_pregunta").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "./ajax/preguntageneral.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsTipoPregunta = "Consult";
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
        $(row).addClass("camposelec");
        // Set the data-id attribute based on the data
        $(row).attr("id_tipopregunta", data[1]);
        $(row).attr("tipopregunta", data[3]);
      },

      // Resto de la configuración de DataTable...
    });
  }
}

// Variable para almacenar la instancia de DataTable
let miTablaPreguntass;

function cargarDataPregunta() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_preguntas")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaPreguntass.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaPreguntass = $(".tbl_preguntas").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "./ajax/preguntageneral.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsPregunta = "Consult";
          d.id_tipo_pregunta = $("#id_tipo_pregunta_id").val();
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

      // Resto de la configuración de DataTable...
    });
  }
}

// Asigna la función al evento onchange del input con ID "codigoInput"
$("#tipo_p_codigo").on("change", function () {
  if ($("#id_edit_tipopregunta").val() === "0") {
    generarCodigoTipoPregunta($(this).val());
  }
});

function generarCodigoTipoPregunta(codigo) {
  $.ajax({
    data: {
      generarCodTipoPregunta: "correlativo",
      codigoNewTipoPregunta: codigo,
    },
    url: "./ajax/preguntageneral.ajax.php",
    type: "POST",
    success: function (response) {
      if (response === "existe") {
        $("#tipo_p_codigo").val("");
        $("#tipo_p_codigo").focus();
        // Mostrar mensaje de error
        mostrarAlerta(
          "#mensajeFormTipoPregunta",
          "danger",
          "El código digitado ya existe en la base de datos"
        );
      }
    },
  });
}

function cerrarModalTipoPregunta() {
  $("#modalAgregarTipoPregunta").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveedittipopregunta").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_tipopregunta").val(0);
    $("#type_action_form_tipopregunta").val("save");
    $("#editartitletipoPregunta").html("Registrar");
    $("#form_tipo_pregunta")[0].reset();

    $("#modalAgregarTipoPregunta").modal("hide");
    return false;
  });
}

function cerrarModalPregunta() {
  $("#modalAgregarPregunta").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveeditpregunta").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_pregunta").val(0);
    $("#type_action_form_pregunta").val("save");
    $("#editartitlepreguntas").html("Registrar");
    $("#form_pregunta")[0].reset();

    $("#modalAgregarPregunta").modal("hide");
    return false;
  });
}

$(".tbl_tipo_pregunta").on("click", ".btnEditarTipoPregunta", function () {
  var idTipoPregunta = $(this).attr("idTipoPregunta");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btn-idsaveedittipopregunta").html(
    '<i class="fa fa-pencil-square-o"></i> Editar'
  );

  $("#editartitletipoPregunta").html("Editar");
  $("#type_action_form_tipopregunta").val("update");

  $.ajax({
    url: "./ajax/preguntageneral.ajax.php",
    method: "POST",
    data: { id_tipo_pregunta: idTipoPregunta },
    dataType: "json",
    success: function (respuesta) {
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_tipopregunta").val(respuesta.id);
      $("#tipo_p_codigo").val(respuesta.codigo);
      $("#tipo_p_descripcion").val(respuesta.descripcion);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

$(".tbl_preguntas").on("click", ".btnEditarPregunta", function () {
  var idPregunta = $(this).attr("idPregunta");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btn-idsaveeditpregunta").html(
    '<i class="fa fa-pencil-square-o"></i> Editar'
  );
  $("#editartitlepreguntas").html("Editar");
  $("#type_action_form_pregunta").val("update");

  $.ajax({
    url: "./ajax/preguntageneral.ajax.php",
    method: "POST",
    data: { id_pregunta_editar_form: idPregunta },
    dataType: "json",
    success: function (respuesta) {
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_pregunta").val(respuesta.id);
      $("#pregunta_pregunta").val(respuesta.pregunta);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tbl_tipo_pregunta").on("click", ".btnEliminarTipoPregunta", function () {
  var idTipoPregunta = $(this).attr("idTipoPregunta");

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
        url: "./ajax/preguntageneral.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_tipopregunta_delete: idTipoPregunta }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertTipoPreguntaDelete",
              "success",
              "¡Tipo Pregunta eliminado correctamente!"
            );
            cargarDataTipoPregunta();
            cargarDataPregunta();
          } else {
            mostrarAlerta(
              "#mensajeAlertTipoPreguntaDelete",
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

$(".tbl_preguntas").on("click", ".btnEliminarPregunta", function () {
  var idPregunta = $(this).attr("idPregunta");

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
        url: "./ajax/preguntageneral.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_pregunta_delete: idPregunta }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertPreguntaDelete",
              "success",
              "¡Pregunta eliminada correctamente!"
            );
            cargarDataPregunta();
          } else {
            mostrarAlerta(
              "#mensajeAlertPreguntaDelete",
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
