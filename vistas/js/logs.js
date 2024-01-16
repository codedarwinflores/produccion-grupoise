// Variable para almacenar la instancia de DataTable
let miTabla;

function cargarDataLogsUsers() {
  // Verifica si la DataTable ya está inicializada
  if ($.fn.DataTable.isDataTable(".HistorialUser")) {
    // Si ya está inicializada, recarga los datos y aplica los nuevos filtros
    miTabla.ajax.reload();
  } else {
    // Si no está inicializada, inicializa la DataTable
    miTabla = $(".HistorialUser").DataTable({
      ajax: {
        url: "ajax/logs.ajax.php",
        type: "GET",
        data: function (d) {
          d.idUsuario = $("#seleccionarUsuario").val();
          d.actionsUser = "Consult";
          d.fecha_inicio_logs = $("#fecha_inicio_logs").val();
          d.fecha_fin_logs = $("#fecha_fin_logs").val();
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

// Llamada inicial a la función
cargarDataLogsUsers();

$(".btn-clear-search").on("click", function () {
  // Realizar la acción que desees aquí
  $("#seleccionarUsuario").val("").trigger("change");
  $("#fecha_inicio_logs").val("");
  $("#fecha_fin_logs").val("");
  cargarDataLogsUsers();
});

// Agregar un controlador de cambio al elemento #seleccionarUsuario
$("#seleccionarUsuario").on("change", function () {
  // Llamada inicial a la función
  cargarDataLogsUsers();
});

$(document).ready(function () {
  setTimeout(function () {
    let numero = parseInt($("#codigoPrueba").val());
    if (numero > 0) {
      numero = numero;
    } else {
      numero = "";
    }
    $("#seleccionarUsuario").val(numero).trigger("change");
  }, 200);
  /*=============================================
VIEW LOGIN LOGS
=============================================*/

  $(".tablas").on("click", ".btnHistorialUsuario", function () {
    let id = $(this).attr("idUsuario");
    window.location.href = "loginslogs?cod=" + id;
  });
});

$(document).on(
  "blur change keydown keyup",
  "#fecha_inicio_act, #fecha_fin_act",
  function () {
    cargarDataUserLogs();
  }
);

$(document).on(
  "blur change keydown keyup",
  "#fecha_inicio_logs, #fecha_fin_logs",
  function () {
    // Llamada inicial a la función
    cargarDataLogsUsers();
  }
);

function ViewLogs(id, nombre) {
  let idLoginLogs = id;
  let nombreUser = nombre;

  $("#nombreUsuario_").html(
    "<strong>Nombre de Usuario: </strong>" + nombreUser
  );

  $("#idUserLogs").val(idLoginLogs);

  $("#fecha_inicio_act").val("");
  $("#fecha_fin_act").val("");
  cargarDataUserLogs();
}

function cargarDataUser() {
  // Hacer una solicitud AJAX para obtener los datos JSON desde el archivo PHP
  $.ajax({
    url: "./ajax/logs.ajax.php", // Reemplaza con la URL de tu archivo PHP
    method: "POST",
    data: {
      idUsuario: $("#seleccionarUsuario").val(),
      actionsUser: "Consult",
      fecha_inicio_logs: $("#fecha_inicio_logs").val(),
      fecha_fin_logs: $("#fecha_fin_logs").val(),
    },

    success: function (data) {
      $("#resultadosUsers").html(data).fadeIn("slow");
    },
    error: function () {
      console.log("Error al cargar los datos JSON");
    },
  });
}

function cargarDataUserLogs() {
  // Hacer una solicitud AJAX para obtener los datos JSON desde el archivo PHP
  $.ajax({
    url: "./ajax/logs.ajax.php", // Reemplaza con la URL de tu archivo PHP
    method: "POST",
    data: {
      idUsuarioLogs: $("#idUserLogs").val(),
      fecha_inicio_act: $("#fecha_inicio_act").val(),
      fecha_fin_act: $("#fecha_fin_act").val(),
      actionsUserLogs: "ConsultLogs",
    },

    success: function (data) {
      $("#resultadoslogs").html(data).fadeIn("slow");
    },
    error: function () {
      console.log("Error al cargar los datos JSON");
    },
  });
}
