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

$(document).ready(function () {
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
