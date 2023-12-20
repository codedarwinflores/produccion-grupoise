cargarDataUser();

// Agregar un controlador de cambio al elemento #seleccionarUsuario
$("#seleccionarUsuario").on("change", function () {
  // Llama a la función cargarDataUser cuando cambia el valor
  cargarDataUser();
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
    cargarDataUser();
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
