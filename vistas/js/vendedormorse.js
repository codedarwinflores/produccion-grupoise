/* COLOCACION DE ICONOS */
$(document).ready(function () {
  $(".grupotbl_vendedormorse_porcentaje1_vendedor").attr(
    "style",
    "visibility:hidden; height:0px; margin-bottom:0px;"
  );
  $(".grupotbl_vendedormorse_porcentaje2_vendedor").attr(
    "style",
    "visibility:hidden; height:0px; margin-bottom:0px;"
  );
  $(".grupotbl_vendedormorse_porcentaje3_vendedor").attr(
    "style",
    "visibility:hidden; height:0px; margin-bottom:0px;"
  );

  $(".grupotbl_vendedormorse_valor1_vendedor").attr(
    "style",
    "visibility:hidden; height:0px; margin-bottom:0px;"
  );
  $(".grupotbl_vendedormorse_valor2_vendedor").attr(
    "style",
    "visibility:hidden; height:0px; margin-bottom:0px;"
  );
  $(".grupotbl_vendedormorse_valor3_vendedor").attr(
    "style",
    "visibility:hidden; height:0px; margin-bottom:0px;"
  );

  $(".egrupotbl_vendedormorse_porcentaje1_vendedor").attr(
    "style",
    "visibility:hidden; height:0px;"
  );
  $(".egrupotbl_vendedormorse_porcentaje2_vendedor").attr(
    "style",
    "visibility:hidden; height:0px;"
  );
  $(".egrupotbl_vendedormorse_porcentaje3_vendedor").attr(
    "style",
    "visibility:hidden; height:0px;"
  );

  $(".egrupotbl_vendedormorse_valor1_vendedor").attr(
    "style",
    "visibility:hidden; height:0px;"
  );
  $(".egrupotbl_vendedormorse_valor2_vendedor").attr(
    "style",
    "visibility:hidden; height:0px;"
  );
  $(".egrupotbl_vendedormorse_valor3_vendedor").attr(
    "style",
    "visibility:hidden; height:0px;"
  );

  $(".grupotbl_vendedormorse_cargo_vendedor").empty();
  $(".grupotbl_vendedormorse_telefono_vendedor").empty();
  $(".grupotbl_vendedormorse_extension_vendedor").empty();
  $(".grupotbl_vendedormorse_email_vendedor").empty();
  $(".grupotbl_vendedormorse_meta_vendedor").empty();

  $(".egrupotbl_vendedormorse_cargo_vendedor").empty();
  $(".egrupotbl_vendedormorse_telefono_vendedor").empty();
  $(".egrupotbl_vendedormorse_extension_vendedor").empty();
  $(".egrupotbl_vendedormorse_email_vendedor").empty();
  $(".egrupotbl_vendedormorse_meta_vendedor").empty();

  var texto = "Ingresar";

  $(".vendedormorse_input_id").removeAttr("required");

  $(".vendedormorse_input_codigo").change(function () {
    var dato = $(this).val();

    /*  ******;** */
    var parametros = {
      codigo: dato,
    };
    $.ajax({
      data: parametros,
      url: "./ajax/vendedormorse.ajax.php",
      type: "post",
      success: function (response) {
        /*         console.log(response); */
        if (parseInt(response) > parseInt(0)) {
          $(".grupotbl_vendedormorse_codigo").append(
            "<p style='color:red;'>El código ya existe</p>"
          );
          $(".vendedormorse_input_codigo").val("");
        }
      },
    });
    /* ********* */
  });

  $(".vendedormorse_input_codigo").attr("maxlength", "2");

  $(".vendedormorse_icono_codigo").addClass("fa fa-file");
  $(".vendedormorse_input_codigo").attr("placeholder", texto + " Código");
  var vendedormorse_input_codigo = $(".vendedormorse_input_codigo").attr(
    "placeholder"
  );
  $(".vendedormorse_label__codigo").text(vendedormorse_input_codigo);

  /* ***** */
  $(".vendedormorse_icono_nombre_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_nombre_vendedor").attr(
    "placeholder",
    texto + " Nombre"
  );
  var input_nombre_vendedor = $(".vendedormorse_input_nombre_vendedor").attr(
    "placeholder"
  );
  $(".vendedormorse_label__nombre_vendedor").text(input_nombre_vendedor);

  $(".vendedormorse_input_porcentaje1_vendedor").attr("type", "number");
  $(".vendedormorse_input_porcentaje1_vendedor").attr("step", "0.01");

  $(".vendedormorse_input_porcentaje2_vendedor").attr("type", "number");
  $(".vendedormorse_input_porcentaje2_vendedor").attr("step", "0.01");

  $(".vendedormorse_input_porcentaje3_vendedor").attr("type", "number");
  $(".vendedormorse_input_porcentaje3_vendedor").attr("step", "0.01");

  /* ***** */
  $(".vendedormorse_icono_porcentaje1_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_porcentaje1_vendedor").attr(
    "placeholder",
    texto + " Porcentaje 1"
  );
  var vendedormorse_input_porcentaje1_vendedor = $(
    ".vendedormorse_input_porcentaje1_vendedor"
  ).attr("placeholder");
  $(".vendedormorse_label__porcentaje1_vendedor").text(
    vendedormorse_input_porcentaje1_vendedor
  );

  /* ***** */
  $(".vendedormorse_icono_porcentaje2_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_porcentaje2_vendedor").attr(
    "placeholder",
    texto + " Porcentaje 2"
  );
  var vendedormorse_input_porcentaje2_vendedor = $(
    ".vendedormorse_input_porcentaje2_vendedor"
  ).attr("placeholder");
  $(".vendedormorse_label__porcentaje2_vendedor").text(
    vendedormorse_input_porcentaje2_vendedor
  );

  /* ***** */
  $(".vendedormorse_icono_porcentaje3_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_porcentaje3_vendedor").attr(
    "placeholder",
    texto + " Porcentaje 3"
  );
  var vendedormorse_input_porcentaje3_vendedor = $(
    ".vendedormorse_input_porcentaje3_vendedor"
  ).attr("placeholder");
  $(".vendedormorse_label__porcentaje3_vendedor").text(
    vendedormorse_input_porcentaje3_vendedor
  );

  /* ***** */
  $(".vendedormorse_icono_valor1_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_valor1_vendedor").attr(
    "placeholder",
    texto + " Valor 1"
  );
  var vendedormorse_input_valor1_vendedor = $(
    ".vendedormorse_input_valor1_vendedor"
  ).attr("placeholder");
  $(".vendedormorse_label__valor1_vendedor").text(
    vendedormorse_input_valor1_vendedor
  );

  /* ***** */
  $(".vendedormorse_icono_valor2_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_valor2_vendedor").attr(
    "placeholder",
    texto + " Valor 2"
  );
  var vendedormorse_input_valor2_vendedor = $(
    ".vendedormorse_input_valor2_vendedor"
  ).attr("placeholder");
  $(".vendedormorse_label__valor2_vendedor").text(
    vendedormorse_input_valor2_vendedor
  );

  /* ***** */
  $(".vendedormorse_icono_valor3_vendedor").addClass("fa fa-file");
  $(".vendedormorse_input_valor3_vendedor").attr(
    "placeholder",
    texto + " Valor 3"
  );
  var vendedormorse_input_valor3_vendedor = $(
    ".vendedormorse_input_valor3_vendedor"
  ).attr("placeholder");
  $(".vendedormorse_label__valor3_vendedor").text(
    vendedormorse_input_valor3_vendedor
  );
});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditartbl_vendedormorse", function () {
  var idtbl_vendedormorse = $(this).attr("idtbl_vendedormorse");

  var datos = new FormData();
  datos.append("idtbl_vendedormorse", idtbl_vendedormorse);

  $.ajax({
    url: "./ajax/vendedormorse.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editar_id").val(respuesta["id"]);
      $("#editar_codigo").val(respuesta["codigo"]).attr("readonly", true);
      $("#editar_nombre_vendedor").val(respuesta["nombre_vendedor"]);
      $("#editar_porcentaje1_vendedor").val(respuesta["porcentaje1_vendedor"]);
      $("#editar_porcentaje2_vendedor").val(respuesta["porcentaje2_vendedor"]);
      $("#editar_porcentaje3_vendedor").val(respuesta["porcentaje3_vendedor"]);
      $("#editar_valor1_vendedor").val(respuesta["valor1_vendedor"]);
      $("#editar_valor2_vendedor").val(respuesta["valor2_vendedor"]);
      $("#editar_valor3_vendedor").val(respuesta["valor3_vendedor"]);

      $("#editar_cargo_vendedor").val(respuesta["cargo_vendedor"]);
      $("#editar_telefono_vendedor").val(respuesta["telefono_vendedor"]);
      $("#editar_extension_vendedor").val(respuesta["extension_vendedor"]);
      $("#editar_email_vendedor").val(respuesta["email_vendedor"]);
      $("#editar_meta_vendedor").val(respuesta["meta_vendedor"]);
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminartbl_vendedormorse", function () {
  var idtbl_vendedormorse = $(this).attr("idtbl_vendedormorse");
  var Codigo = $(this).attr("Codigo");

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
        "index.php?ruta=vendedormorse&idtbl_vendedormorse=" +
        idtbl_vendedormorse +
        "&Codigo=" +
        Codigo;
    }
  });
});
