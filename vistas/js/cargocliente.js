$(document).ready(function () {
  cargarDataCargoCliente();
  cargarDataCargoEvaluado();
  cerrarModalCargoCliente();
  cerrarModalAreaExamen();
  cerrarModalCargoEvaluado();
  cargarDataAreaExamen();
  /* REGISTRAR CLIENTE CARGO */
  $("#form_cargo_cliente").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_cargo_cliente");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/cargocliente.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormCargoCliente",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormCargoCliente",
              "success",
              "Cargo registrado correctamente!"
            );
            $("#form_cargo_cliente")[0].reset();

            cargarDataCargoCliente();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormCargoCliente",
              "success",
              "Cargo  editado correctamente!"
            );
            cargarDataCargoCliente();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormCargoCliente",
              "danger",
              "¡Nombre cargo, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormCargoCliente",
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
            "#mensajeFormCargoCliente",
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
      mostrarAlerta("#mensajeFormCargoCliente", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  /* REGISTRAR EVALUADO CARGO */
  $("#form_cargo_evaluado").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_cargo_evaluado");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/cargocliente.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormCargoEvaluado",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormCargoEvaluado",
              "success",
              "Cargo registrado correctamente!"
            );
            $("#form_cargo_evaluado")[0].reset();

            cargarDataCargoEvaluado();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormCargoEvaluado",
              "success",
              "Cargo  editado correctamente!"
            );
            cargarDataCargoEvaluado();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormCargoEvaluado",
              "danger",
              "¡Nombre cargo, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormCargoEvaluado",
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
            "#mensajeFormCargoEvaluado",
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
      mostrarAlerta("#mensajeFormCargoEvaluado", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  $("#form_area_examen").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_area_examen");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/cargocliente.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeFormAreaExamen",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeFormAreaExamen",
              "success",
              "Areae examen registrado correctamente!"
            );
            $("#form_area_examen")[0].reset();

            cargarDataAreaExamen();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeFormAreaExamen",
              "success",
              "Area examen editado correctamente!"
            );
            cargarDataAreaExamen();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeFormAreaExamen",
              "danger",
              "¡Nombre Area, ya existe!"
            );
          } else {
            mostrarAlerta(
              "#mensajeFormAreaExamen",
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
            "#mensajeFormAreaExamen",
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
      mostrarAlerta("#mensajeFormAreaExamen", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });
});

// Variable para almacenar la instancia de DataTable
let miTablaCargoCliente;

function cargarDataCargoCliente() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_cargo_cliente")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaCargoCliente.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaCargoCliente = $(".tbl_cargo_cliente").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "ajax/cargocliente.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsCargoClientes = "Consult";
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

// Variable para almacenar la instancia de DataTable
let miTablaCargoEvaluado;

function cargarDataCargoEvaluado() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_cargo_evaluado")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaCargoCliente.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaCargoCliente = $(".tbl_cargo_evaluado").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "ajax/cargocliente.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsCargoEvaluados = "Consult";
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

// Variable para almacenar la instancia de DataTable
let miTablaAreaExamen;

function cargarDataAreaExamen() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_area_examen")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaAreaExamen.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaAreaExamen = $(".tbl_area_examen").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "ajax/cargocliente.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsAreaExamen = "Consult";
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

$(".tbl_cargo_cliente").on("click", ".btnEditarCargoCliente", function () {
  var idCargoCliente = $(this).attr("idCargoCliente");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btn-idsaveeditcargocliente").html(
    '<i class="fa fa-pencil-square-o"></i> Editar'
  );
  $("#editartitlecargo").html("Editar");
  $("#type_action_form").val("update");

  $.ajax({
    url: "./ajax/cargocliente.ajax.php",
    method: "POST",
    data: { id_cargo_cliente: idCargoCliente },
    dataType: "json",
    success: function (respuesta) {
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_cargocliente").val(respuesta.id);
      $("#nombre_cargo").val(respuesta.nombre_cargo);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

$(".tbl_cargo_evaluado").on("click", ".btnEditarCargoEvaluado", function () {
  var idCargoEvaluado = $(this).attr("idCargoEvaluado");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btn-idsaveeditcargoevaluado").html(
    '<i class="fa fa-pencil-square-o"></i> Editar'
  );
  $("#editartitlecargoevaluado").html("Editar");
  $("#type_action_form_cargo_evaluado").val("update");

  $.ajax({
    url: "./ajax/cargocliente.ajax.php",
    method: "POST",
    data: { id_cargo_evaluado: idCargoEvaluado },
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_cargoevaluado").val(respuesta.id);
      $("#nombre_cargo_evaluado").val(respuesta.nombre_cargo);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

$(".tbl_area_examen").on("click", ".btnEditarAreaExamen", function () {
  var id_area_examen = $(this).attr("idAreaExamen");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btn-idsaveeditareaexamen").html(
    '<i class="fa fa-pencil-square-o"></i> Editar'
  );
  $("#editartitleareaexamen").html("Editar");
  $("#type_action_form_areaexamen").val("update");

  $.ajax({
    url: "./ajax/cargocliente.ajax.php",
    method: "POST",
    data: { id_area_examen: id_area_examen },
    dataType: "json",
    success: function (respuesta) {
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_areaexamen").val(respuesta.id);
      $("#motivo").val(respuesta.motivo);
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

function cerrarModalCargoCliente() {
  $("#modalAgregarCargoCliente").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveeditcargocliente").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_cargocliente").val(0);
    $("#type_action_form").val("save");
    $("#editartitlecargo").html("Registrar");
    $("#form_cargo_cliente")[0].reset();

    $("#modalAgregarCargoCliente").modal("hide");
    return false;
  });
}

function cerrarModalCargoEvaluado() {
  $("#modalAgregarCargoEvaluado").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveeditcargoevaluado").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_cargoevaluado").val(0);
    $("#type_action_form").val("save");
    $("#editartitlecargoevaluado").html("Registrar");
    $("#form_cargo_evaluado")[0].reset();

    $("#modalAgregarCargoEvaluado").modal("hide");
    return false;
  });
}

function cerrarModalAreaExamen() {
  $("#modalAgregarAreaExamen").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btn-idsaveeditareaexamen").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_areaexamen").val(0);
    $("#type_action_form_areaexamen").val("save");
    $("#editartitleareaexamen").html("Registrar");
    $("#form_area_examen")[0].reset();

    $("#modalAgregarAreaExamen").modal("hide");
    return false;
  });
}

/*=============================================
ELIMINAR 
=============================================*/
$(".tbl_cargo_cliente").on("click", ".btnEliminarCargoCliente", function () {
  var idCargoCliente = $(this).attr("idCargoCliente");

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
        url: "./ajax/cargocliente.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_cargocliente_delete: idCargoCliente }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertCargoDelete",
              "success",
              "¡Cargo eliminado correctamente!"
            );
            cargarDataCargoCliente();
          } else {
            mostrarAlerta(
              "#mensajeAlertCargoDelete",
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

$(".tbl_cargo_evaluado").on("click", ".btnEliminarCargoEvaluado", function () {
  var idCargoEvaluado = $(this).attr("idCargoEvaluado");

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
        url: "./ajax/cargocliente.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_cargoevaluado_delete: idCargoEvaluado }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertCargoEvaluadoDelete",
              "success",
              "¡Cargo eliminado correctamente!"
            );
            cargarDataCargoCliente();
          } else {
            mostrarAlerta(
              "#mensajeAlertCargoEvaluadoDelete",
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

$(".tbl_area_examen").on("click", ".btnEliminarAreaExamen", function () {
  var idAreaExamen = $(this).attr("idAreaExamen");

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
        url: "./ajax/cargocliente.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_area_examen_delete: idAreaExamen }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertAreaDelete",
              "success",
              "¡Area examen eliminado correctamente!"
            );
            cargarDataAreaExamen();
          } else {
            mostrarAlerta(
              "#mensajeAlertAreaDelete",
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
