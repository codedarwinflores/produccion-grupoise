$(document).ready(function () {
  cerrarModalEvaluados();
  cargarDataEvaluados();
  var brand = document.getElementById("logo-id");
  brand.className = "attachment_upload";
  brand.onchange = function () {
    document.getElementById("fakeUploadLogo").value = this.value.substring(12);
  };

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      // Validate image type
      var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
      if (!allowedExtensions.exec(input.value)) {
        mostrarAlerta(
          "#mensajeAlertEvaluado",
          "danger",
          "¡Tipo de imagen no permitido!"
        );
        // You can also clear the input value to prevent further processing
        input.value = "";
        return;
      }

      reader.onload = function (e) {
        $(".img-preview").attr("src", e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#logo-id").change(function () {
    readURL(this);
  });

  /* REGISTRAR POLIGRAFOS */
  $("#form_evaluado_save").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios("#form_evaluado_save");

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/evaluados.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeAlertEvaluado",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeAlertEvaluado",
              "success",
              "¡Evaluado registrado correctamente!"
            );
            $("#form_evaluado_save")[0].reset();
            cargarDataEvaluados();
            $(".img-preview").attr(
              "src",
              "./vistas/img/plantilla/logo_original.png"
            );
            /*   setTimeout(function () {
              $("#modalAgregarEvaluado").modal("hide");
            }, 200); */
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeAlertEvaluado",
              "success",
              "¡Evaluado editado correctamente!"
            );
            cargarDataEvaluados();
          } else {
            mostrarAlerta(
              "#mensajeAlertEvaluado",
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
            "#mensajeAlertEvaluado",
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
      mostrarAlerta("#mensajeAlertEvaluado", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });
});

function cerrarModalEvaluados() {
  $("#modalAgregarEvaluado").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btnevaluados").html('<i class="fa fa-pencil-square-o"></i> Guardar');
    $("#id_edit_evaluado").val(0);
    $("#type_action_form").val("save");
    $("#editarTitle").html("Registrar");
    $("#form_evaluado_save")[0].reset();
    $("#modalAgregarEvaluado").modal("hide");

    return false;
  });
}

/*=============================================
EDITAR 
=============================================*/
$(".tbl_evaluados").on("click", ".btnEditarEvaluado", function () {
  var idEvaluado = $(this).attr("idEvaluado");

  var datos = new FormData();
  datos.append("idEvaluado", idEvaluado);

  $.ajax({
    url: "ajax/evaluados.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      /* CAMBIAR DATOS DEL TITULO Y BUTTON */
      $("#btnevaluados").html('<i class="fa fa-pencil-square-o"></i> Editar');
      $("#editarTitle").html("Editar");
      $("#type_action_form").val("update");

      $("#id_edit_evaluado").val(respuesta["id"]);
      $("#nuevoNombres").val(respuesta["nombres"]);
      $("#nuevoPrimerApellido").val(respuesta["primer_apellido"]);
      $("#nuevoSegundoApellido").val(respuesta["segundo_apellido"]);
      $("#nuevodocumentoevaluado").val(respuesta["documento"]);
      $("#estadocivilevaluado").val(respuesta["estado_civil"]);
      $("#nuevotelefonoevaluado").val(respuesta["telefono"]);
      $("#nuevoPapaevaluado").val(respuesta["padre"]);
      $("#nuevoMamaevaluado").val(respuesta["madre"]);
      $("#nuevoConyugeevaluado").val(respuesta["conyuge"]);
      $("#nuevofechaNacevaluado").val(respuesta["fecha_nac"]);
      $("#nuevoProfesionevaluado").val(respuesta["profesion"]);
      $("#nuevoLugarNacevaluado").val(respuesta["lugar_nac"]);
      $(".img-preview").attr("src", respuesta["foto"]);
      $("#nuevodireccionevaluado").val(respuesta["direccion"]);
      $("#foto_edit").val(respuesta["foto"]);
      $("#nuevoidClienteevaluado")
        .val(respuesta["id_cliente_morse"])
        .trigger("change");
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tbl_evaluados").on("click", ".btnEliminarEvaluado", function () {
  var idEvaluado = $(this).attr("idEvaluado");
  var foto_del = $(this).attr("foto_del");

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
        url: "ajax/evaluados.ajax.php", // Replace with your server endpoint
        type: "POST", // Change the HTTP method as needed
        data: { id_evaluado_delete: idEvaluado, foto_del: foto_del }, // Pass the data to the server
        success: function (response) {
          if (response === "delete") {
            mostrarAlerta(
              "#mensajeAlertEvaluadoDelete",
              "success",
              "¡Evaluado eliminado correctamente!"
            );

            cargarDataEvaluados();
          } else {
            mostrarAlerta(
              "#mensajeAlertEvaluadoDelete",
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

// Store date and time values in an object to track unique combinations

// Variable para almacenar la instancia de DataTable
let miTablaEvaluados;

function cargarDataEvaluados() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".tbl_evaluados")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablaEvaluados.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablaEvaluados = $(".tbl_evaluados").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "ajax/evaluados.ajax.php",
        type: "GET",
        data: function (d) {
          d.actionsEvaluados = "Consult";
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
