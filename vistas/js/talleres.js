/* COLOCACION DE ICONOS */
$(document).ready(function () {
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
});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartalleres", function () {
  var idtalleres = $(this).attr("idtalleres");

  var datos = new FormData();
  datos.append("idtalleres", idtalleres);

  $.ajax({
    url: "ajax/talleres.ajax.php",
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
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevonombre_talleres").change(function () {
  var usuario = $(this).val();

  var datos = new FormData();
  datos.append("validarnombre", usuario);

  $.ajax({
    url: "ajax/talleres.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevonombre_talleres")
          .parent()
          .after(
            '<div class="alert alert-warning">Este registro ya existe en la base de datos</div>'
          );

        $("#nuevonombre_talleres").val("");
      }
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
