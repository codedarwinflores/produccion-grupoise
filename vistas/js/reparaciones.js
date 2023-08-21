/* COLOCACION DE ICONOS */
$(document).ready(function () {
  $(".reparaciones_input_codigo_reparacion").attr("maxlength", "4");
  var texto = "Ingresar";

  $(".reparaciones_input_id").removeAttr("required");

  $(".icono_nombre_reparacion").addClass("fa fa-server");
  $(".icono_codigo_reparacion").addClass("fa fa-qrcode fa-qr");
  $(".reparaciones_input_nombre_reparacion").attr(
    "placeholder",
    texto + "  Nombre Reparación"
  );
  $(".reparaciones_input_codigo_reparacion").attr(
    "placeholder",
    texto + "  Código"
  );

  /* *********LABEL*********** */
  var reparaciones_input_codigo = $(
    ".reparaciones_input_codigo_reparacion"
  ).attr("placeholder");
  $(".label_codigo_talleres").text(reparaciones_input_codigo);

  /* *********LABEL*********** */
  var reparaciones_input_nombre_reparacion = $(
    ".reparaciones_input_nombre_reparacion"
  ).attr("placeholder");
  $(".label_nombre_reparacion").text(reparaciones_input_nombre_reparacion);

  /* REPARACIONES */
  $(".reparaciones_input_codigo_reparacion").blur(function () {
    if ($(this).val().trim().length > 0) {
    } else {
      /*  alert("El campo contiene espacios y está vacío"); */
      var $myNewElement = $(
        '<p class="showmensaje">El campo contiene espacios y está vacío</p>'
      );
      $(".showmensaje").remove();
      $(this).after($myNewElement);

      $(this).val("");
    }
    if ($(this).val().trim().length < 4) {
      /* alert("Por favor complete el campo"); */
      var $myNewElement = $(
        '<p class="showmensaje">Por favor complete el campo</p>'
      );
      $(".showmensaje").remove();
      $(this).after($myNewElement);

      $(this).val("");
    }
  });

  /* REPARACIONES VALIDAR SI EXISTE EN BASE DE DATOS*/
  $(".reparaciones_input_codigo_reparacion").change(function () {
    $(".alert").remove();

    var tabla_validar = $(this).attr("tabla_validar");
    var item_validar = $(this).attr("item_validar");
    var valor_validar = $(this).val();

    var datos =
      "tabla_validar=" +
      tabla_validar +
      "&item_validar=" +
      item_validar +
      "&valor_validar=" +
      valor_validar;

    $.ajax({
      url: "./ajax/validar.ajax.php",
      method: "POST",
      data: datos,
      success: function (respuesta) {
        let numero = parseInt(respuesta);
        alert(numero);

        if (numero > 0) {
          $(".reparaciones_input_codigo_reparacion")
            .parent()
            .after(
              '<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>'
            );

          $(".reparaciones_input_codigo_reparacion").val("");
        }
      },
    });
  });
});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarReparaciones", function () {
  var idreparaciones = $(this).attr("idreparaciones");

  var datos = new FormData();
  datos.append("idreparaciones", idreparaciones);

  $.ajax({
    url: "./ajax/reparaciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#reparaciones_editarid").val(respuesta["id"]);
      $("#reparaciones_editarcodigo_reparacion").val(
        respuesta["codigo_reparacion"]
      );
      $("#reparaciones_editarnombre_reparacion").val(
        respuesta["nombre_reparacion"]
      );
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarreparaciones", function () {
  var idreparaciones = $(this).attr("idreparaciones");
  var codigo_reparaciones = $(this).attr("Codigo");

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
      window.location =
        "index.php?ruta=reparaciones&idreparaciones=" +
        idreparaciones +
        "&codigo_reparaciones=" +
        codigo_reparaciones;
    }
  });
});
