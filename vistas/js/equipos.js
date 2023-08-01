/* COLOCACION DE ICONOS */
$(document).ready(function () {
  $(".equipogrupo_estado_otros_equipos").empty();
  $(".equipogrupo_estado_otros_equipos").append($(".s_estado_otros_equipos"));

  $(".eequipogrupo_estado_otros_equipos").empty();
  $(".eequipogrupo_estado_otros_equipos").append(
    $(".editar_s_estado_otros_equipos")
  );

  $(".equipogrupo_id_familia").attr("style", "visibility:hidden; height:0;");
  $(".equipo_input_id_familia").removeAttr("required");

  $(".equipogrupo_descripcion_equipo").attr(
    "style",
    "visibility:hidden; height:0"
  );
  $(".eequipogrupo_descripcion_equipo").attr(
    "style",
    "visibility:hidden; height:0"
  );

  var texto = "Ingresar";

  $(".input_id").removeAttr("required");

  $(".input_id_familia").attr("onkeydown", "return false");

  $(".icono_id_familia").addClass("fa fa-server");
  $(".input_id_familia").attr("placeholder", texto + " Familia");
  $(".input_id_familia").attr("name", "");

  $(".input_id_familia").click(function () {
    $(".s_familia").css("display", "block");
  });

  $(".select_familia").click(function () {
    var id = $(this).attr("idfamilia");
    var nombrefamilia = $(this).attr("nombrefamilia");
    $(".input_id_familia_1").val(id);
    $(".input_id_familia").val(nombrefamilia);

    $(".s_familia").css("display", "none");
  });

  $(".icono_descripcion").addClass("fa fa-server");
  $(".input_descripcion").attr("placeholder", texto + " Descripción");

  $(".icono_numero_serie").addClass("fa fa-server");
  $(".input_numero_serie").attr("placeholder", texto + " Número Serie");

  $(".equipogrupo_tipo_equipos").empty();
  $(".eequipogrupo_tipo_equipos").empty();

  $(".equipogrupo_tipo_equipos").append($(".stipo_equipos"));
  $(".eequipogrupo_tipo_equipos").append($(".stipo_equipose"));

  /* *******nuevos campos** */

  $(".icono_codigo_equipo").addClass("fa fa-qrcode");
  $(".input_codigo_equipo").attr("placeholder", texto + " Código");

  $(".icono_descripcion_equipo").addClass("fa fa-spinner");
  $(".input_descripcion_equipo").attr("placeholder", texto + " Descripción");

  $(".icono_costo_equipo").addClass("fa fa-money");
  $(".input_costo_equipo").attr("placeholder", texto + " Costo");

  $(".input_costo_equipo").get(0).type = "number";
  $(".input_costo_equipo").attr("step", "0.01");
  $("#editarcosto_equipo").get(0).type = "number";
  $("#editarcosto_equipo").attr("step", "0.01");

  $(".icono_modelo_equipo").addClass("fa fa-star");
  $(".input_modelo_equipo").attr("placeholder", texto + " Modelo");

  $(".icono_color_equipo").addClass("fa fa-spinner");
  $(".input_color_equipo").attr("placeholder", texto + " Color");

  /* *********LABEL*********** */
  var input_id_familia = $(".input_id_familia").attr("placeholder");
  $(".label_id_familia").text(input_id_familia);

  /* *********LABEL*********** */
  var input_descripcion = $(".input_descripcion").attr("placeholder");
  $(".label_descripcion").text(input_descripcion);

  /* *********LABEL*********** */
  var input_codigo_equipo = $(".input_codigo_equipo").attr("placeholder");
  $(".label_codigo_equipo").text(input_codigo_equipo);

  /* *********LABEL*********** */
  var input_descripcion_equipo = $(".input_descripcion_equipo").attr(
    "placeholder"
  );
  $(".label_descripcion_equipo").text(input_descripcion_equipo);

  /* *********LABEL*********** */
  var input_costo_equipo = $(".input_costo_equipo").attr("placeholder");
  $(".label_costo_equipo").text(input_costo_equipo);

  /* *********LABEL*********** */
  var input_modelo_equipo = $(".input_modelo_equipo").attr("placeholder");
  $(".label_modelo_equipo").text(input_modelo_equipo);

  /* *********LABEL*********** */
  var input_color_equipo = $(".input_color_equipo").attr("placeholder");
  $(".label_color_equipo").text(input_color_equipo);

  $(".input_fecha_adquisicion").attr(
    "placeholder",
    texto + " Fecha de adquisición"
  );

  /* *********LABEL*********** */
  var input_fecha_adquisicion = $(".input_fecha_adquisicion").attr(
    "placeholder"
  );
  $(".label_fecha_adquisicion").text(input_fecha_adquisicion);

  calendario04();
  $(".input_codigo_equipo").attr("readonly", "readonly");
  $(".input_fecha_adquisicion").attr("readonly", "readonly");
});

document.addEventListener("mouseup", function (event) {
  var obj = document.getElementById("s_familia");

  if (obj?.value) {
    if (!obj.contains(event.target)) {
      $(".s_familia").css("display", "none");
    }
  } else {
    console.log("element does not exist");
  }
});

function calendario04() {
  $(".input_fecha_adquisicion").addClass("calendario");
  $(".input_fecha_adquisicion").attr("fecha", "fecha_adquisionb");
  $(".input_fecha_adquisicion").attr("name", " ");
}

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarequipos", function () {
  $("#editarfecha_adquisicion").attr("fecha", "fecha_adquisionbe");

  $(".eequipogrupo_id_familia").attr("style", "visibility:hidden; height:0;");
  $(".editarequipo_input_id_familia").removeAttr("required");

  var idequipos = $(this).attr("idequipos");

  var datos = new FormData();
  datos.append("idequipos", idequipos);

  $.ajax({
    url: "ajax/equipos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarid").val(respuesta["idequipos"]);
      $("#editarid_familia_1").val(respuesta["idfamilia"]);
      $("#editarid_familia").val(respuesta["nombrefamilia"]);
      $("#editardescripcion").val(respuesta["descripcion"]);
      $("#editarnumero_serie").val(respuesta["numero_serie"]);
      $("#editartipo_equipos").val(respuesta["tipo_equipos"]);

      var dateNEW = respuesta["fecha_adquisicion"];
      var date = new Date(dateNEW);
      var year = date.toLocaleString("default", { year: "numeric" });
      var month = date.toLocaleString("default", { month: "2-digit" });
      var day = date.toLocaleString("default", { day: "2-digit" });
      var formattedDate = day + "-" + month + "-" + year;

      /* ******* */

      var date0 = respuesta["fecha_adquisicion"];

      var formattedDate = new Date(date0);
      var d = formattedDate.getDate() + 1;
      var m = formattedDate.getMonth();
      m += 0;
      m += 1; // javascript months are 0-11
      var y = formattedDate.getFullYear();

      /* ********** */
      $("#editarfecha_adquisicion").val(d + "-" + m + "-" + y);
      $("#editarfecha_adquisicion2").val(respuesta["fecha_adquisicion"]);

      $("#editarobservaciones").val(respuesta["observaciones"]);
      $("#editardescripcion_equipo").val(respuesta["descripcion_equipo"]);
      $("#editarcosto_equipo").val(respuesta["costo_equipo"]);
      $("#editarmodelo_equipo").val(respuesta["modelo_equipo"]);
      $("#editarcolor_equipo").val(respuesta["color_equipo"]);
      $("#editarcodigo_equipo").val(respuesta["codigo_equipo"]);
      $("#editarlugar_adquisicion").val(respuesta["lugar_adquisicion"]);

      $("#editarestado_otros_equipos").val(respuesta["estado_otros_equipos"]);
    },
  });
});

/*=============================================
REVISAR SI  YA ESTÁ REGISTRADO
=============================================*/

$("#nuevonombre").change(function () {
  var usuario = $(this).val();

  var datos = new FormData();
  datos.append("validarnombre", usuario);

  $.ajax({
    url: "ajax/equipos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevonombre")
          .parent()
          .after(
            '<div class="alert alert-warning">Este registro ya existe en la base de datos</div>'
          );

        $("#nuevonombre").val("");
      }
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarequipos", function () {
  var idequipos = $(this).attr("idequipos");
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
        "index.php?ruta=equipos&idequipos=" + idequipos + "&Codigo=" + Codigo;
    }
  });
});
