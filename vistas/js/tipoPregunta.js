generarCodigoTipoPregunta();
/*=============================================
EDITAR 
=============================================*/
$(".tablas").on("click", ".btnEditarTipoPregunta", function () {
  var idTipoPregunta = $(this).attr("idTipoPregunta");

  var datos = new FormData();
  datos.append("idTipoPregunta", idTipoPregunta);

  $.ajax({
    url: "ajax/tipoPregunta.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarIdTipoPregunta").val(respuesta["id"]);
      $("#editarCodigoPregunta").val(respuesta["codigo"]);
      $("#editarDescripcionPregunta").val(respuesta["descripcion"]);
    },
  });
});

/*=============================================
ELIMINAR 
=============================================*/
$(".tablas").on("click", ".btnEliminarTipoPregunta", function () {
  var idTipoPregunta = $(this).attr("idTipoPregunta");

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
        "index.php?ruta=tipoPregunta&idTipoPregunta=" + idTipoPregunta;
    }
  });
});

function generarCodigoTipoPregunta() {
  var dataString = "generarCodPregunta=correlativo";
  $.ajax({
    data: dataString,
    url: "./ajax/tipoPregunta.ajax.php",
    type: "post",
    success: function (response) {
      $("#nuevoCodigoPregunta").val(response);
    },
  });
}
