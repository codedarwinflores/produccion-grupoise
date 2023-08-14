/* COLOCACION DE ICONOS */
$(document).ready(function () {
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
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevonombre_reparaciones").change(function () {
  var usuario = $(this).val();

  var datos = new FormData();
  datos.append("validarnombre", usuario);

  $.ajax({
    url: "./ajax/reparaciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevonombre_reparaciones")
          .parent()
          .after(
            '<div class="alert alert-warning">Este registro ya existe en la base de datos</div>'
          );

        $("#nuevonombre_reparaciones").val("");
      }
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
