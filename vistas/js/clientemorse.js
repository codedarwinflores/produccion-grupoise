// Variable para almacenar la instancia de DataTable
let miTablasClienteMorse;

function cargarDataClienteMorse() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".ClienteMorse_register")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTablasClienteMorse.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTablasClienteMorse = $(".ClienteMorse_register").DataTable({
      columnDefs: [
        {
          targets: [1], // Replace with the actual index of the 'cod_cliente' column
          visible: false,
        },
      ],
      ajax: {
        url: "./ajax/clientemorse.ajax.php",
        type: "GET",
        data: function (d) {
          d.ConsultarClientesMorse = "ok";
        },
        dataSrc: "data",
      },
      dataType: "json",
      deferRender: true,
      retrieve: true,
      processing: true,
      pageLength: 10,
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

/* llenar tabla */
cargarDataClienteMorse();

function getPaisesSelect() {
  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getPais: "ok" },
    success: function (data) {
      // Llenar el select de países
      var paisSelect = $("#general_id_pais");

      // Limpiar el select antes de agregar nuevas opciones
      paisSelect.empty();

      // Agregar la opción por defecto
      paisSelect.append(
        '<option value="0" selected>Selecciona un país</option>'
      );

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, pais) {
        paisSelect.append(
          '<option value="' +
            pais.id +
            '">' +
            pais.codigo +
            " - " +
            pais.nombre +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener países:", error);
    },
  });
}

function getDepartamentosSelect() {
  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getDepartamento: "ok" },
    success: function (data) {
      // Llenar el select de países
      var departSelect = $("#general_id_departamento");

      // Limpiar el select antes de agregar nuevas opciones
      departSelect.empty();

      // Agregar la opción por defecto
      departSelect.append(
        '<option value="0" selected>Selecciona un departamento</option>'
      );

      // Iterar sobre los países y agregar opciones al select
      $.each(data, function (index, departamento) {
        departSelect.append(
          '<option value="' +
            departamento.id +
            '">' +
            departamento.Nombre +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener países:", error);
    },
  });
}

$(document).ready(function () {
  cerrarModalClienteMorse();
  handleSelectChange();
  getPaisesSelect();
  getDepartamentosSelect();
  llenarSelectTipoExamen();
  cargarExamenesCliente();
  eliminarSesionExamenes();
  llenarVendedorMorse();
  $("#general_id_municipio").append(
    '<option value="0" selected>Selecciona un municipio</option>'
  );

  // Manejar el evento reset solo después de que el documento se haya cargado
  $("#form_clientemorse_save").on("reset", function () {
    // Llamar a la función handleSelectChange() u otras acciones aquí
    setTimeout(function () {
      handleSelectChange();
    }, 50);
  });

  // Manejar el cambio en el select
  $("#general_contribuyente").change(function () {
    handleSelectChange();
  });

  /* REGISTRAR CLIENTE MORSE */
  $("#form_clientemorse_save").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios(
      "#form_clientemorse_save"
    );

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/clientemorse.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeAlertclientemorse",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeAlertclientemorse",
              "success",
              "Cliente registrado correctamente!"
            );
            $("#form_clientemorse_save")[0].reset();
            $("#form_tipoexamen_precio")[0].reset();
            cargarDataClienteMorse();
            eliminarSesionExamenes();
            cargarExamenesCliente();
            scrollToTop();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeAlertclientemorse",
              "success",
              "¡Cliente editado correctamente!"
            );
            cargarDataClienteMorse();
            scrollToTop();
          } else {
            mostrarAlerta(
              "#mensajeAlertclientemorse",
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
            "#mensajeAlertclientemorse",
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
      mostrarAlerta("#mensajeAlertclientemorse", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });

  /* REGISTRAR CLIENTE MORSE */
  $("#form_tipoexamen_precio").submit(function (e) {
    e.preventDefault();

    // Validar campos obligatorios antes de enviar
    var camposNoCompletados = validarCamposObligatorios(
      "#form_tipoexamen_precio"
    );

    if (camposNoCompletados.length === 0) {
      // Obtener los datos del formulario
      var formData = new FormData(this);
      // Agregar el campo extra al formData
      formData.append(
        "id_cliente_idtipoexamen",
        $("#id_edit_clientemorse").val()
      );
      $(":submit").attr("disabled", true);
      // Enviar la solicitud Ajax
      $.ajax({
        type: "POST",
        url: "./ajax/clientemorse.ajax.php", // Reemplaza con la URL de tu script de procesamiento
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          // Puedes mostrar un mensaje de espera diferente antes de la solicitud Ajax
          mostrarAlerta(
            "#mensajeAlertAddTipoExam",
            "warning",
            "¡Espere un momento, por favor!"
          );
        },
        success: function (response) {
          // Mostrar mensaje de éxito
          if (response === "save") {
            mostrarAlerta(
              "#mensajeAlertAddTipoExam",
              "success",
              "Tipo de examen registrado correctamente!"
            );
            $("#form_tipoexamen_precio")[0].reset();
            $("#id_tipo_examen_morse").val("").trigger("change");
            cargarExamenesCliente();
          } else if (response === "update") {
            mostrarAlerta(
              "#mensajeAlertAddTipoExam",
              "success",
              "Tipo examen editado correctamente!"
            );
            cargarDataClienteMorse();
          } else if (response === "existe") {
            mostrarAlerta(
              "#mensajeAlertAddTipoExam",
              "danger",
              "¡El precio del examen ya se encuentra registrado!"
            );
            cargarDataClienteMorse();
          } else {
            mostrarAlerta(
              "#mensajeAlertAddTipoExam",
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
            "#mensajeAlertAddTipoExam",
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
      mostrarAlerta("#mensajeAlertclientemorse", "danger", mensaje);
    }

    $(":submit").attr("disabled", false);
  });
});

// Función para manejar el cambio en el select
function handleSelectChange() {
  var selectedValue = $("#general_contribuyente").val();

  // Define the list of input fields you want to manage
  var inputFields = $("#general_nrc, #general_nombre_registro,#general_giro");

  if (selectedValue === "NO" || selectedValue === "") {
    // If "SI" is selected, make all input fields readonly
    inputFields.prop("readonly", true);
    inputFields.val("");
  } else {
    // If "NO" is selected, make all input fields editable and clear their values
    inputFields.prop("readonly", false);
  }
}

$(".ClienteMorse_register").on("click", ".btnEditarClienteMorse", function () {
  var idClienteMorse = $(this).attr("id_clientemorse");

  // CAMBIAR DATOS DEL TITULO Y BUTTON
  $("#btneclientemoorse").html('<i class="fa fa-pencil-square-o"></i> Editar');
  $("#editarTitleMorse").html("Editar");
  $("#type_action_form").val("update");

  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    method: "POST",
    data: { id_cliente_morse: idClienteMorse },
    dataType: "json",
    success: function (respuesta) {
      // Actualizar los campos del formulario con la respuesta del servidor
      $("#id_edit_clientemorse").val(respuesta.id);
      // Asignar valores a todos los campos del formulario
      $("#nombre").val(respuesta.nombre);

      $("#general_contribuyente").val(respuesta.general_contribuyente);
      setTimeout(function () {
        handleSelectChange();
      }, 50);

      $("#general_nit").val(respuesta.general_nit);
      $("#general_nrc").val(respuesta.general_nrc);
      $("#general_nombre_registro").val(respuesta.general_nombre_registro);
      $("#general_giro").val(respuesta.general_giro);
      $("#general_direccion_cliente").val(respuesta.general_direccion_cliente);
      $("#general_telefono1").val(respuesta.general_telefono1);
      $("#general_telefono2").val(respuesta.general_telefono2);
      $("#general_fax").val(respuesta.general_fax);
      $("#general_contacto").val(respuesta.general_contacto);
      $("#general_correo").val(respuesta.general_correo);
      $("#general_id_pais").val(respuesta.general_id_pais);
      $("#general_id_departamento").val(respuesta.general_id_departamento);
      setTimeout(function () {
        // Activar el evento change para #id_departamento
        llenarSelectMunicipio();
      }, 10);
      setTimeout(function () {
        // Activar el evento change para #id_departamento
        $("#general_id_municipio").val(respuesta.general_id_municipio);
      }, 100);

      $("#otro_fecha_apertura").val(respuesta.otro_fecha_apertura);
      $("#otro_limite_credito").val(respuesta.otro_limite_credito);
      $("#otro_plazo").val(respuesta.otro_plazo);
      $("#otro_cuenta_contable").val(respuesta.otro_cuenta_contable);
      $("#otro_categoria").val(respuesta.otro_categoria);
      $("#conta_contacto").val(respuesta.conta_contacto);
      $("#conta_telefono1").val(respuesta.conta_telefono1);
      $("#conta_telefono2").val(respuesta.conta_telefono2);
      $("#conta_correo").val(respuesta.conta_correo);
      $("#conta_direccion").val(respuesta.conta_direccion);
      $("#contra_nombre_representante").val(
        respuesta.contra_nombre_representante
      );
      $("#contra_profesion_oficio").val(respuesta.contra_profesion_oficio);
      $("#contra_identifiacion").val(respuesta.contra_identifiacion);
      $("#contra_domicilio").val(respuesta.contra_domicilio);
      $("#contra_calidad").val(respuesta.contra_calidad);
      $("#solicitado_nivel_academico").val(
        respuesta.solicitado_nivel_academico
      );
      $("#solicitado_nombre").val(respuesta.solicitado_nombre);
      $("#solicitado_apellido").val(respuesta.solicitado_apellido);

      $("#solicitado_cargo").val(respuesta.solicitado_cargo);
      $("#solicitado_correo").val(respuesta.solicitado_correo);
      $("#solicitado_direccion_entrega").val(
        respuesta.solicitado_direccion_entrega
      );
      $("#solicitado_telefono").val(respuesta.solicitado_telefono);
      $("#observaciones").val(respuesta.observaciones);
      $("#id_ultimo_evaluado").val(respuesta.id_ultimo_evaluado);
      $("#estado").val(respuesta.estado);
      $("#dui_morse").val(respuesta.dui_morse);
      $("#comision_morse").val(respuesta.comision_morse);
      $("#id_vendedor_morse")
        .val(respuesta.id_vendedor_morse)
        .trigger("change");
      cargarExamenesCliente();

      llenarUltimoEvaluado();
    },
    error: function (xhr, status, error) {
      console.error(xhr, status, error);
    },
  });
});

function cerrarModalClienteMorse() {
  $("#modalAgregarClienteMorse").on("hidden.bs.modal", function () {
    // Realiza acciones al cerrar el modal
    $("#btneclientemoorse").html(
      '<i class="fa fa-pencil-square-o"></i> Guardar'
    );
    $("#id_edit_clientemorse").val(0);
    $("#type_action_form").val("save");
    $("#editarTitleMorse").html("Registrar");
    $("#solicitado_cargo").val("0").trigger("change");
    $("#id_vendedor_morse").val("0").trigger("change");
    $("#form_clientemorse_save")[0].reset();
    $("#form_tipoexamen_precio")[0].reset();
    eliminarSesionExamenes();
    cargarExamenesCliente();
    $("#modalAgregarClienteMorse").modal("hide");
    return false;
  });
}

// Manejar cambio en el select de departamento
$("#general_id_departamento").change(function () {
  setInterval(() => {
    llenarSelectMunicipio();
  }, 50);
});

function llenarSelectMunicipio() {
  var departamentoId = $("#general_id_departamento").val();

  // Realizar solicitud AJAX para obtener municipios
  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    type: "POST",
    dataType: "json",
    data: { departamentoId: departamentoId, getMunicipio: "ok" },
    success: function (data) {
      // Llenar el select de municipios
      var municipioSelect = $("#general_id_municipio");
      municipioSelect.empty(); // Limpiar opciones anteriores
      // Agregar la opción por defecto
      municipioSelect.append(
        '<option value="">Selecione uno de (' +
          data.length +
          ") Municipio(s) encontrado(s)</option>"
      );
      $.each(data, function (index, municipio) {
        municipioSelect.append(
          '<option value="' +
            municipio.id +
            '">' +
            municipio.Nombre_m +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener municipios:", error);
    },
  });
}

function llenarUltimoEvaluado() {
  var clienteidMorse = $("#id_edit_clientemorse").val();
  if (clienteidMorse > 0) {
    // Realizar solicitud AJAX para obtener municipios
    $.ajax({
      url: "./ajax/clientemorse.ajax.php",
      type: "POST",
      dataType: "json",
      data: { id_cliente_morse_ultimo: clienteidMorse, getEvaluados: "ok" },
      success: function (data) {
        // Llenar el select de municipios
        var municipioSelect = $("#id_ultimo_evaluado");
        municipioSelect.empty(); // Limpiar opciones anteriores
        // Agregar la opción por defecto
        municipioSelect.append(
          '<option value="0" selected>Selecciona un evaluado</option>'
        );
        $.each(data, function (index, evaluado) {
          municipioSelect.append(
            '<option selected value="' +
              evaluado.id +
              '">' +
              evaluado.codigo +
              " - " +
              evaluado.nombres +
              " " +
              evaluado.primer_apellido +
              " " +
              evaluado.segundo_apellido +
              "</option>"
          );
        });
      },
      error: function (error) {
        console.log("Error al obtener evaluados:", error);
      },
    });
  }
}

function llenarVendedorMorse() {
  // Realizar solicitud AJAX para obtener municipios
  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getVendedorMorse: "ok" },
    success: function (data) {
      // Llenar el select de municipios
      var id_vendedor = $("#id_vendedor_morse");
      id_vendedor.empty(); // Limpiar opciones anteriores
      // Agregar la opción por defecto
      id_vendedor.append(
        '<option value="0" selected>Selecciona un vendedor</option>'
      );
      $.each(data, function (index, vendedor) {
        id_vendedor.append(
          '<option value="' +
            vendedor.id +
            '">' +
            vendedor.codigo +
            " - " +
            vendedor.nombre_vendedor +
            "</option>"
        );
      });
    },
    error: function (error) {
      console.log("Error al obtener vendedores:", error);
    },
  });
}

function llenarSelectTipoExamen() {
  // Realizar solicitud AJAX para obtener municipios
  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    type: "POST",
    dataType: "json",
    data: { getTipoExamen: "ok" },
    success: function (data) {
      // Llenar el select de municipios
      var tipoExamen = $("#id_tipo_examen_morse");

      // Destroy existing Select2 instance (if any)
      tipoExamen.select2("destroy");

      tipoExamen.empty(); // Limpiar opciones anteriores
      // Agregar la opción por defecto
      tipoExamen.append(
        '<option value="" selected>Selecciona un tipo de examen</option>'
      );
      $.each(data, function (index, examen) {
        tipoExamen.append(
          '<option value="' +
            examen.id +
            '">' +
            examen.codigo +
            " - " +
            examen.descripcion +
            " $" +
            examen.valor +
            "</option>"
        );
      });

      // Initialize Select2
      tipoExamen.select2();
    },
    error: function (error) {
      console.log("Error al obtener municipios:", error);
    },
  });
}

/*=============================================
ELIMINAR 
=============================================*/
$(".ClienteMorse_register").on(
  "click",
  ".btnEliminarClienteMorse",
  function () {
    var idClienteMorse = $(this).attr("id_clientemorse");

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
          url: "./ajax/clientemorse.ajax.php", // Replace with your server endpoint
          type: "POST", // Change the HTTP method as needed
          data: { id_clientemorse_delete: idClienteMorse }, // Pass the data to the server
          success: function (response) {
            if (response === "delete") {
              mostrarAlerta(
                "#mensajeAlertclientemorsePrincipal",
                "success",
                "Cliente eliminado correctamente!"
              );
              cargarDataClienteMorse();
            } else {
              mostrarAlerta(
                "#mensajeAlertclientemorsePrincipal",
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
function cargarExamenesCliente() {
  // Show the loading spinner
  $("#loadingSpinnerexamenescliente").show();
  // Asegúrate de definir tblhoras si es necesario
  let parametros = {
    getexamenesclientemorse: "tbl_examenes_cliente_morse",
    getIdClienteMorse: $("#id_edit_clientemorse").val(),
  };

  $.ajax({
    data: parametros,
    url: "./ajax/clientemorse.ajax.php", // Verifica la ruta correcta
    type: "post",

    success: function (response) {
      // Actualiza el contenido del elemento sin el efecto fadeIn
      $("#listadoExamenesCliente").html(response);
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX:", error);
    },

    complete: function () {
      $("#loadingSpinnerexamenescliente").hide();
    },
  });
}

/* ELIMINAR EXAMENES SESIÓN */
function deleteSessionIDExamen(id, tipo) {
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
        url: "./ajax/clientemorse.ajax.php",
        method: "POST",
        data: {
          id_posicion_sesion: id,
          delete: "ok",
          tipo: tipo,
        },
        dataType: "json",
        success: function (response) {
          /*     console.log(JSON.stringify(response)); */
          if (response.status === "ok") {
            mostrarAlerta(
              "#mensajeAlertaExamenA",
              "success",
              "¡Registro eliminado correctamente!"
            );
            cargarExamenesCliente();
          } else {
            mostrarAlerta(
              "#mensajeAlertaExamenA",
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

function eliminarSesionExamenes() {
  // Realizar la solicitud AJAX
  $.ajax({
    url: "./ajax/clientemorse.ajax.php",
    method: "POST",
    data: {
      deletesesionexamenes: "ok",
    }, // Puedes enviar datos adicionales si es necesario
    success: function (response) {
      // Mostrar la respuesta del servidor (opcional)
      console.log(response);

      // Realizar acciones adicionales según la respuesta (opcional)
      // Por ejemplo, actualizar la interfaz de usuario
    },
    error: function (xhr, status, error) {
      // Manejar errores (opcional)
      console.error("Error en la solicitud AJAX: " + status + ", " + error);
    },
  });
}
