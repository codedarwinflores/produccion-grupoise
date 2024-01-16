$(".FormatoMoney").mask("###0.00", {
  reverse: true,
});

// Asigna la función al evento onchange del input con ID "codigoInput"
$("#nuevoCodigoTipoExamen").on("change", function () {
  generarCodigoTipoExamen($(this).val());
});

/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarTipoExamen", function () {
  var idTipoExamen = $(this).attr("idTipoExamen");

  var datos = new FormData();
  datos.append("idTipoExamen", idTipoExamen);

  $.ajax({
    url: "ajax/tipoExamen.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarIdTipoExamen").val(respuesta["id"]);
      $("#editarCodigoTipoExamen").val(respuesta["codigo"]);
      $("#editarDescripcionTipoExamen").val(respuesta["descripcion"]);
      $("#editarDuracion").val(respuesta["duracion"]);
      $("#editarValor").val(respuesta["valor"]);
      $("#editarComision").val(respuesta["comision"]);
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarTipoExamen", function () {
  var idTipoExamen = $(this).attr("idTipoExamen");

  swal({
    title: "¿Está seguro de borrar el Tipo?",
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
        "index.php?ruta=tipoExamen&idTipoExamen=" + idTipoExamen;
    }
  });
});

function generarCodigoTipoExamen(codigo) {
  $.ajax({
    data: {
      generarCodTipoExamen: "correlativo",
      codigoNew: codigo,
    },
    url: "./ajax/tipoExamen.ajax.php",
    type: "POST",
    success: function (response) {
      if (response === "existe") {
        $("#nuevoCodigoTipoExamen").val("");
        $("#nuevoCodigoTipoExamen").focus();
        // Mostrar mensaje de error
        mostrarAlerta(
          "#mensajeAlertaTipoExamen",
          "danger",
          "El código digitado ya existe en la base de datos"
        );
      }
    },
  });
}
