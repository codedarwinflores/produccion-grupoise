cargarConfiguracionSMTP();

function cargarConfiguracionSMTP() {
  let idsmtp = $("#idsmtp").val();
  $.ajax({
    url: "./ajax/smtp_config.ajax.php",
    method: "POST",
    data: {
      configuracionsmtp: "configuracionsmtp",
      idsmtp: idsmtp,
    },
    dataType: "json",
    success: function (respuesta) {
      $("#idsmtp").val(respuesta["id"]);
      $("#smtp_server").val(respuesta["server_smtp"]);
      $("#puerto_smtp_server").val(respuesta["server_puerto"]);
      $("#tituloRemitente").val(respuesta["titulo_remitente"]);
      $("#correoRemitente").val(respuesta["correo_remitente"]);
    },
  });
}

$("#form_config_server").submit(function (event) {
  event.preventDefault(); // Prevenir el envío del formulario
  // Obtener los datos del formulario
  var datosSerializados = $(this).serialize();
  var datos = datosSerializados + "&actualizardatos=configuracion";
  // Enviar una solicitud AJAX
  $.ajax({
    type: "POST",
    url: "./ajax/smtp_config.ajax.php", // Cambia esto a la URL del archivo PHP que manejará el guardado
    data: datos,
    success: function (response) {
      console.log(response);
      if (response == "ok") {
        swal({
          title: "Configuración SMTP",
          text: "Se guardaron los cambios",
          type: "success",
          timer: 2000,
        });

        cargarConfiguracionSMTP();
      } else {
        swal({
          title: "Configuración SMTP",
          text: "error al guardar los cambios",
          type: "error",
          timer: 2000,
        });
      }
    },
    error: function (xhr, status, error) {
      console.log("Error en la solicitud:", xhr);
    },
  });
});
