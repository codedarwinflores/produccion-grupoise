/* COLOCACION DE ICONOS */
$(document).ready(function () {
  $(".talleres_input_codigo_talleres").attr("maxlength", "4");

  var texto = "Ingresar";

  $(".talleres_input_id").removeAttr("required");

  $(".icono_nombre_talleres").addClass("fa fa-server");
  $(".icono_codigo_talleres").addClass("fa fa-qrcode fa-qr");
  $(".talleres_input_nombre_talleres").attr(
    "placeholder",
    texto + "  Nombre Taller"
  );
  $(".talleres_input_codigo_talleres").attr("placeholder", texto + "  Código");

  /* *********LABEL*********** */
  var talleres_input_codigo = $(".talleres_input_codigo_talleres").attr(
    "placeholder"
  );
  $(".label_codigo_talleres").text(talleres_input_codigo);

  /* *********LABEL*********** */
  var talleres_input_nombre_tipo = $(".talleres_input_nombre_talleres").attr(
    "placeholder"
  );
  $(".label_nombre_talleres").text(talleres_input_nombre_tipo);

  /* TALLER */
  $(".talleres_input_codigo_talleres").blur(function () {
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

  /* TALLERES */
  $(".talleres_input_codigo_talleres").change(function () {
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
      url: "ajax/validar.ajax.php",
      method: "POST",
      data: datos,
      success: function (respuesta) {
        var numero = JSON.parse(respuesta);
        /*     alert(numero); */

        if (numero > 0) {
          $(".talleres_input_codigo_talleres")
            .parent()
            .after(
              '<div class="alert alert-warning">Este Dato ya existe en la base de datos</div>'
            );

          $(".talleres_input_codigo_talleres").val("");
        }
      },
    });
  });
});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartalleres", function () {
  var idtalleres = $(this).attr("idtalleres");

  var datos = new FormData();
  datos.append("idtalleres", idtalleres);

  $.ajax({
    url: "./ajax/talleres.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#talleres_editarid").val(respuesta["id"]);
      $("#talleres_editarcodigo_talleres").val(respuesta["codigo_talleres"]);
      $("#talleres_editarnombre_talleres").val(respuesta["nombre_talleres"]);
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminartalleres", function () {
  var idtalleres = $(this).attr("idtalleres");
  var codigo_talleres = $(this).attr("Codigo");

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
        "index.php?ruta=talleres&idtalleres=" +
        idtalleres +
        "&codigo_talleres=" +
        codigo_talleres;
    }
  });
});
