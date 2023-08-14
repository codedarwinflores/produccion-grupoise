$(document).ready(function () {
  cargarDatos(0);

  mensaje(
    "#mensajenuevo",
    "success",
    "check",
    "Bien Hecho",
    "Datos agregádos correctamente"
  );

  ocultarMensaje("#mensajenuevo");

  $("#tablavehiculo tbody").on("click", ".campoid", function () {
    $(".agregarbtnmovimiento").removeAttr("disabled");
    /* if ($(this).hasClass("selectedd")) {
      // Deseleccionar
      $(this).removeClass("selectedd");
    } else { */
    // Remover clase de TR seleccionada, si es que hay
    $("tr.selectedd").removeClass("selectedd");
    // Asignar clase seleccionada a TR actual
    $(this).addClass("selectedd");
    /* } */

    let datosvehiculo = $(this).attr("datosvehiculo");
    $(".nombre_vehiculo").html("<strong>Vehículo: </strong>" + datosvehiculo);
    $("#name_vehiculo").html(datosvehiculo);

    let idvehiculo = $(this).attr("idvehiculo");
    cargarDatos(idvehiculo);
  });

  function cargarDatos(idvehiculo) {
    let parametros = {
      valor: idvehiculo,
    };
    $.ajax({
      data: parametros,
      url: "ajax/mantovehiculo.ajax.php",
      type: "post",
      success: function (response) {
        $("#cargarDatos").html(response).fadeIn("slow");
      },
    });
  }
});

function mensaje(id, tipoalert, icono, titulo, mensaje) {
  $(id)
    .html(`<div class="alert alert-${tipoalert} alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-${icono}"></i>
					<strong>¡${titulo}!</strong> ${mensaje}
				</div>`);
}

function ocultarMensaje(id) {
  setTimeout(function () {
    $(id).fadeOut(3500);
  }, 3500);
}
