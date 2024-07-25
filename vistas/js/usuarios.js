/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function () {
  var imagen = this.files[0];

  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaFoto").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaFoto").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;

      $(".previsualizar").attr("src", rutaImagen);
    });
  }
});

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");

  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#id_usuario_edit").val(respuesta["id"]);
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarCorreo").val(respuesta["user_correo"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#fotoActual").val(respuesta["foto"]);

      $("#passwordActual").val(respuesta["password"]);

      if (respuesta["foto"] != "") {
        $(".previsualizarEditar").attr("src", respuesta["foto"]);
      } else {
        $(".previsualizarEditar").attr(
          "src",
          "./vistas/img/usuarios/default/anonymous.png"
        );
      }

      const checkbox = $("#editarauntenticacionactivada");
      if (respuesta["2fa"] == "1") {
        checkbox.prop("checked", true);
      } else {
        checkbox.prop("checked", false);
      }
    },
  });
});

/*=============================================
ACTIVAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnActivar", function () {
  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (window.matchMedia("(max-width:767px)").matches) {
        swal({
          title: "El usuario ha sido actualizado",
          type: "success",
          confirmButtonText: "¡Cerrar!",
        }).then(function (result) {
          if (result.value) {
            window.location = "usuarios";
          }
        });
      }
    },
  });

  if (estadoUsuario == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html("Desactivado");
    $(this).attr("estadoUsuario", 1);
  } else {
    $(this).addClass("btn-success");
    $(this).removeClass("btn-danger");
    $(this).html("Activado");
    $(this).attr("estadoUsuario", 0);
  }
});

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoUsuario").change(function () {
  $(".alert").remove();

  var usuario = $(this).val();

  var datos = new FormData();
  datos.append("validarUsuario", usuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoUsuario")
          .parent()
          .after(
            '<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>'
          );

        $("#nuevoUsuario").val("");
      }
    },
  });
});

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var usuario = $(this).attr("usuario");

  swal({
    title: "¿Está seguro de borrar el usuario?",
    text: "¡Si no lo está puede cancelar la accíón!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar usuario!",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?ruta=usuarios&idUsuario=" +
        idUsuario +
        "&usuario=" +
        usuario +
        "&fotoUsuario=" +
        fotoUsuario;
    }
  });
});
function refreshing_Captcha() {
  var img = document.images["image_captcha"];
  img.src =
    img.src.substring(0, img.src.lastIndexOf("?")) +
    "?rand=" +
    Math.random() * 1000;
}

$(document).ready(function () {
  /* PARA CODIGO DE DESBLOQUEO */
  $("#emailForm").submit(function (e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del formulario

    $("#btn_solicitar").prop("disabled", true);

    var form = this; // Obtén una referencia al formulario
    var usuario = $("#confirm_usuario").val();
    var correo = $("#confirmar_correo").val();

    if (usuario != "" && correo != "") {
      $("#mensaje_enviar").html(
        '<div class="alert alert-warning alert-custom"><i class="fa fa-warning"></i> ¡Espere un momento por favor!</div>'
      );
      var formData = new FormData(form);
      // Añadir el parámetro adicional al objeto FormData
      formData.append("comprobar_user_email", "evaluar_datos");
      $.ajax({
        url: "ajax/usuarios.ajax.php",
        type: "POST",
        data: formData,
        processData: false, // Impide que jQuery procese los datos
        contentType: false, // Impide que jQuery establezca el tipo de contenido
        success: function (response) {
          console.log(response);
          if (response == "success") {
            $("#mensaje_enviar").html(
              '<div class="alert alert-success alert-custom"><i class="fa fa-check-circle"></i> Solicitud enviada exitosamente. Revisa tu correo electrónico</div>'
            );

            $("#user_user_code").val(usuario);
            $("#user_correo_code").val(correo);

            $("#enviar_corrreo_codigo").fadeOut(500, function () {
              $("#enviar_comprobar_codigo").fadeIn(500);
            });
          } else {
            $("#mensaje_enviar").html(
              '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Los datos no coiciden con los solicitados.</div>'
            );
          }
          $("#btn_solicitar").prop("disabled", false); // Rehabilitar el botón de envío
        },
        error: function () {
          $("#mensaje_enviar").html(
            '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Error al enviar la solicitud. Inténtalo de nuevo.</div>'
          );
          $("#btn_solicitar").prop("disabled", false); // Rehabilitar el botón de envío en caso de error
        },
      });

      $("#confirm_usuario").focus();
    } else {
      $("#mensaje_enviar").html(
        '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Usuario o correo vacío.</div>'
      );
      $("#btn_solicitar").prop("disabled", false); // Rehabilitar el botón de envío si hay campos vacíos
    }

    // Oculta el mensaje después de 5 segundos
    window.setTimeout(function () {
      $(".alert-custom")
        .fadeTo(500, 0) // Desvanece el mensaje a opacidad 0 en 500 milisegundos
        .slideUp(500, function () {
          // Desliza el mensaje hacia arriba en 500 milisegundos
          $(this).hide(); // Elimina el elemento del DOM
        });
    }, 5000); // 5000 milisegundos = 5 segundos
  });

  /* FIN SUBMIT
  INICIAR SUBMIT CÓDIGO COMPROBAR
  */

  $("#emailFormComprobarCodigo").submit(function (e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del formulario

    $("#mensaje_enviar").fadeIn();
    var form = this; // Obtén una referencia al formulario
    var codigo = $("#confirmar_codigo").val();
    var usuario = $("#user_user_code").val();
    var correo = $("#user_correo_code").val();
    var id = $("#id_user_desbloquear_code").val();

    if (codigo != "" && usuario != "" && correo != "" && id != "") {
      $("#mensaje_enviar").html(
        '<div class="alert alert-warning alert-custom"><i class="fa fa-warning"></i> ¡Espere un momento por favor!</div>'
      );
      var formData = new FormData(form);
      // Añadir el parámetro adicional al objeto FormData
      formData.append("comprobar_user_codigo", "evaluar_datos_codigo");
      $.ajax({
        url: "ajax/usuarios.ajax.php",
        type: "POST",
        data: formData,
        processData: false, // Impide que jQuery procese los datos
        contentType: false, // Impide que jQuery establezca el tipo de contenido
        success: function (response) {
          console.log(response);
          if (response == "success") {
            swal({
              title: "Se restauraron los intentos de tu usuario",
              type: "success",
              confirmButtonText: "Aceptar",
            }).then(function (result) {
              if (result.value) {
                window.location = "ingreso";
              }
            });
          } else {
            $("#mensaje_enviar").html(
              '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Código incorrecto o ha expirado.</div>'
            );
          }
        },
        error: function () {
          $("#mensaje_enviar").html(
            '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Error al enviar la solicitud. Inténtalo de nuevo.</div>'
          );
        },
      });

      $("#confirmar_codigo").focus();
    } else {
      $("#mensaje_enviar").html(
        '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Usuario, correo y código vacío.</div>'
      );
    }
    // Oculta el mensaje después de 5 segundos
    window.setTimeout(function () {
      $(".alert-custom")
        .fadeTo(500, 0) // Desvanece el mensaje a opacidad 0 en 500 milisegundos
        .slideUp(500, function () {
          // Desliza el mensaje hacia arriba en 500 milisegundos
          $(this).hide(); // Elimina el elemento del DOM
        });
    }, 5000); // 5000 milisegundos = 5 segundos
  });

  $("#btn_reenviar_comprobacion_de_datos").click(function () {
    $("#enviar_comprobar_codigo").fadeOut(500, function () {
      $("#enviar_corrreo_codigo").fadeIn(500);
    });
  });

  $("#btn_reenviar_comprobacion_de_datos2FA").click(function () {
    $("#enviar_comprobar_codigo2FA").fadeOut(500, function () {
      $("#enviar_corrreo_codigo2FA").fadeIn(500);
    });
  });

  /* CCODIGO PARA COMPROBAR 2FA */
  /* PARA CODIGO DE DESBLOQUEO */
  $("#emailForm2FA").submit(function (e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del formulario

    $("#btn_solicitar2FA").prop("disabled", true);

    var form = this; // Obtén una referencia al formulario
    var usuario = $("#confirm_usuario2FA").val();
    var correo = $("#confirmar_correo2FA").val();

    if (usuario != "" && correo != "") {
      $("#mensaje_enviar2FA").html(
        '<div class="alert alert-warning alert-custom"><i class="fa fa-warning"></i> ¡Espere un momento por favor!</div>'
      );
      var formData = new FormData(form);
      // Añadir el parámetro adicional al objeto FormData
      formData.append("comprobar_user_email2FA", "evaluar_datos2FA");
      $.ajax({
        url: "ajax/usuarios.ajax.php",
        type: "POST",
        data: formData,
        processData: false, // Impide que jQuery procese los datos
        contentType: false, // Impide que jQuery establezca el tipo de contenido
        success: function (response) {
          console.log(response);
          if (response == "success") {
            $("#mensaje_enviar2FA").html(
              '<div class="alert alert-success alert-custom"><i class="fa fa-check-circle"></i> Solicitud enviada exitosamente. Revisa tu correo electrónico</div>'
            );

            $("#user_user_code2FA").val(usuario);
            $("#user_correo_code2FA").val(correo);

            $("#enviar_corrreo_codigo2FA").fadeOut(500, function () {
              $("#enviar_comprobar_codigo2FA").fadeIn(500);
            });
          } else {
            $("#mensaje_enviar2FA").html(
              '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Los datos no coiciden con los solicitados.</div>'
            );
          }
          $("#btn_solicitar2FA").prop("disabled", false); // Rehabilitar el botón de envío
        },
        error: function () {
          $("#mensaje_enviar2FA").html(
            '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Error al enviar la solicitud. Inténtalo de nuevo.</div>'
          );
          $("#btn_solicitar2FA").prop("disabled", false); // Rehabilitar el botón de envío en caso de error
        },
      });

      $("#confirm_usuario2FA").focus();
    } else {
      $("#mensaje_enviar2FA").html(
        '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Usuario o correo vacío.</div>'
      );
      $("#btn_solicitar2FA").prop("disabled", false); // Rehabilitar el botón de envío si hay campos vacíos
    }

    // Oculta el mensaje después de 5 segundos
    window.setTimeout(function () {
      $(".alert-custom")
        .fadeTo(500, 0) // Desvanece el mensaje a opacidad 0 en 500 milisegundos
        .slideUp(500, function () {
          // Desliza el mensaje hacia arriba en 500 milisegundos
          $(this).hide(); // Elimina el elemento del DOM
        });
    }, 5000); // 5000 milisegundos = 5 segundos
  });

  /* FIN SUBMIT */

  /* FIN SUBMIT
  INICIAR SUBMIT CÓDIGO COMPROBAR
  */

  $("#emailFormComprobarCodigo2FA").submit(function (e) {
    e.preventDefault(); // Evita el comportamiento predeterminado del formulario

    $("#mensaje_enviar2FA").fadeIn();
    var form = this; // Obtén una referencia al formulario
    var codigo = $("#confirmar_codigo2FA").val();
    var usuario = $("#user_user_code2FA").val();
    var correo = $("#user_correo_code2FA").val();
    var id = $("#id_user_desbloquear_code2FA").val();

    if (codigo != "" && usuario != "" && correo != "" && id != "") {
      $("#mensaje_enviar2FA").html(
        '<div class="alert alert-warning alert-custom"><i class="fa fa-warning"></i> ¡Espere un momento por favor!</div>'
      );
      var formData = new FormData(form);
      // Añadir el parámetro adicional al objeto FormData
      formData.append("comprobar_user_codigo2FA", "evaluar_datos_codigo2FA");
      $.ajax({
        url: "ajax/usuarios.ajax.php",
        type: "POST",
        data: formData,
        processData: false, // Impide que jQuery procese los datos
        contentType: false, // Impide que jQuery establezca el tipo de contenido
        success: function (response) {
          console.log(response);
          if (response == "success") {
            swal({
              title: "¡Bienvenido estimado/a: " + usuario,
              type: "success",
              confirmButtonText: "Aceptar",
            }).then(function (result) {
              if (result.value) {
                window.location = "inicio";
              }
            });
          } else {
            $("#mensaje_enviar2FA").html(
              '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Código incorrecto o ha expirado.</div>'
            );
          }
        },
        error: function () {
          $("#mensaje_enviar2FA").html(
            '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Error al enviar la solicitud. Inténtalo de nuevo.</div>'
          );
        },
      });

      $("#confirmar_codigo2FA").focus();
    } else {
      $("#mensaje_enviar2FA").html(
        '<div class="alert alert-danger alert-custom"><i class="fa fa-exclamation-circle"></i> Usuario, correo y código vacío.</div>'
      );
    }
    // Oculta el mensaje después de 5 segundos
    window.setTimeout(function () {
      $(".alert-custom")
        .fadeTo(500, 0) // Desvanece el mensaje a opacidad 0 en 500 milisegundos
        .slideUp(500, function () {
          // Desliza el mensaje hacia arriba en 500 milisegundos
          $(this).hide(); // Elimina el elemento del DOM
        });
    }, 5000); // 5000 milisegundos = 5 segundos
  });

  // Generate a simple captcha
  function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
  }
  $("#captchaOperation").html(
    [randomNumber(1, 100), "+", randomNumber(1, 200), "="].join(" ")
  );

  $("#editarcaptchaOperation").html(
    [randomNumber(1, 100), "+", randomNumber(1, 200), "="].join(" ")
  );

  $("#formUser").bootstrapValidator({
    /*  live: "disabled", */
    message: "Este valor no es válido",
    feedbackIcons: {
      valid: "glyphicon glyphicon-ok",
      invalid: "glyphicon glyphicon-remove",
      validating: "glyphicon glyphicon-refresh",
    },

    fields: {
      nuevoNombre: {
        validators: {
          notEmpty: {
            message: "El nombre es obligatorio",
          },
        },
      },
      nuevoCorreo: {
        validators: {
          notEmpty: {
            message: "El email es obligatorio",
          },

          regexp: {
            regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
            message: "El email no es válido",
          },
        },
      },
      nuevoUsuario: {
        validators: {
          notEmpty: {
            message: "El usuario es obligatorio",
          },
          regexp: {
            regexp: /^[a-zA-Z0-9_]+$/,
            message:
              "El usuario debe contener solo letras, números y guiones bajos",
          },
        },
      },
      nuevoPassword: {
        validators: {
          notEmpty: {
            message: "La contraseña es obligatoria",
          },
          regexp: {
            regexp:
              /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!*?&/+\-])[A-Za-z\d@$!*?&/+\-]{9,16}$/,
            message:
              "La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!*?&/+-), y tener entre 9 y 16 caracteres.",
          },
        },
      },
      password_confirm: {
        validators: {
          notEmpty: {
            message: "Debes repetir la contraseña",
          },
          identical: {
            field: "nuevoPassword",
            message: "Las contraseñas deben coincidir",
          },
          regexp: {
            regexp:
              /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!*?&/+\-])[A-Za-z\d@$!*?&/+\-]{9,16}$/,
            message:
              "La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!*?&/+-), y tener entre 9 y 16 caracteres.",
          },
        },
      },

      captcha: {
        validators: {
          callback: {
            message: "Respuesta incorrecta",
            callback: function (value, validator) {
              var items = $("#captchaOperation").html().split(" "),
                sum = parseInt(items[0]) + parseInt(items[2]);
              return value == sum;
            },
          },
        },
      },
    },
  });
  // Initialize the validator
  $("#editarformUser").bootstrapValidator({
    /*  live: "disabled", */
    message: "Este valor no es válido",
    feedbackIcons: {
      valid: "glyphicon glyphicon-ok",
      invalid: "glyphicon glyphicon-remove",
      validating: "glyphicon glyphicon-refresh",
    },

    fields: {
      editarNombre: {
        validators: {
          notEmpty: {
            message: "El nombre es obligatorio",
          },
        },
      },
      editarCorreo: {
        validators: {
          notEmpty: {
            message: "El email es obligatorio",
          },

          regexp: {
            regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/,
            message: "El email no es válido",
          },
        },
      },
      editarUsuario: {
        validators: {
          notEmpty: {
            message: "El usuario es obligatorio",
          },
          regexp: {
            regexp: /^[a-zA-Z0-9_]+$/,
            message:
              "El usuario debe contener solo letras, números y guiones bajos",
          },
        },
      },
      editarPassword: {
        validators: {
          regexp: {
            regexp:
              /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!*?&/+\-])[A-Za-z\d@$!*?&/+\-]{9,16}$/,
            message:
              "La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!*?&/+-), y tener entre 9 y 16 caracteres.",
          },
        },
      },
      editarpassword_confirm: {
        validators: {
          identical: {
            field: "nuevoPassword",
            message: "Las contraseñas deben coincidir",
          },
          regexp: {
            regexp:
              /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!*?&/+\-])[A-Za-z\d@$!*?&/+\-]{9,16}$/,
            message:
              "La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!*?&/+-), y tener entre 9 y 16 caracteres.",
          },
        },
      },

      editarcaptcha: {
        validators: {
          callback: {
            message: "Respuesta incorrecta",
            callback: function (value, validator) {
              var items = $("#editarcaptchaOperation").html().split(" "),
                sum = parseInt(items[0]) + parseInt(items[2]);
              return value == sum;
            },
          },
        },
      },
    },
  });

  // Reset form when modal is hidden
  $("#modalEditarUsuario").on("hidden.bs.modal", function () {
    $("#editarformUser").data("bootstrapValidator").resetForm(true);
  });
});
