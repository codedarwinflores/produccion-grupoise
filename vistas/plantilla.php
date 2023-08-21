<?php

session_start();

?>


<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Grupo ISE</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

  <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>

  <style>
    .id {
      display: none;
    }

    .ocultartodo {
      display: none;
    }
  </style>



  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/mystyle.css">


  <link rel="stylesheet" href="vistas/calendario/css/ion.calendar.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>



  <script type="text/javascript">
    $(document).ready(function() {


      // 2
      $('.doscaracter').attr("maxlength", "2");
      $('.trescaracter').attr("maxlength", "3");
      $('.cuatrocaracter').attr("maxlength", "4");

      /* ******** */



      /* asignar */


      $(".doscaracter").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });

      /*  ****** */

      $(".trescaracter").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 3) {
          /* alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".cuatrocaracter").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".servicios_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          /*   alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
      });



      $(".seminarios_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /*   alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".planilla_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);


          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".familia_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".tipoarma_input_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /* alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });

      /* TALLER */
      $(".talleres_input_codigo_talleres").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /* alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });

      $(".tiporadio_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".tipovehiculo_input_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".binput_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /* alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /* alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);


          $(this).val("");
        }
      });


      $(".tipootrosequipos_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /* alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".celular_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*  alert("El campo contiene espacios y está vacío"); */
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 4) {
          /*  alert("Por favor complete el campo"); */
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);


          $(this).val("");
        }
      });


      $(".transequipo_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          /*   alert("El campo contiene espacios y está vacío"); */

          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          // alert("Por favor complete el campo");
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });


      $(".personalinput_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          //alert("El campo contiene espacios y está vacío");
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          //alert("Por favor complete el campo");

          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);


          $(this).val("");
        }
      });


      $(".portacion_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          //alert("El campo contiene espacios y está vacío");
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          //alert("Por favor complete el campo");
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
      });


      $(".input_codigo_patrulla").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          //alert("El campo contiene espacios y está vacío");
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
        if ($(this).val().trim().length < 2) {
          //alert("Por favor complete el campo");
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
      });



      $(".cargos_nivel").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          //alert("El campo contiene espacios y está vacío");
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
        if ($(this).val().trim().length < 3) {
          //alert("Por favor complete el campo");
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);

          $(this).val("");
        }
      });



      $(".isr_codigo").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          //alert("El campo contiene espacios y está vacío");
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
        if ($(this).val().trim().length < 3) {
          // alert("Por favor complete el campo");
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
      });

      $(".input_correlativo_lista").blur(function() {
        if ($(this).val().trim().length > 0) {} else {
          //alert("El campo contiene espacios y está vacío");
          var $myNewElement = $('<p class="showmensaje">El campo contiene espacios y está vacío</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
        if ($(this).val().trim().length < 5) {
          //alert("Por favor complete el campo");
          var $myNewElement = $('<p class="showmensaje">Por favor complete el campo</p>');
          $(".showmensaje").remove();
          $(this).after($myNewElement);
          $(this).val("");
        }
      });

      $(".input_correlativo_lista").attr("maxlength", "5");



      $(".cargos_nivel").attr("maxlength", "3");
      $(".isr_codigo").attr("maxlength", "4");
      $(".servicios_codigo").attr("maxlength", "2");
      $(".seminarios_codigo").attr("maxlength", "4");
      $(".planilla_codigo").attr("maxlength", "2");
      $(".familia_codigo").attr("maxlength", "4");
      $(".tipoarma_input_codigo").attr("maxlength", "4");
      $(".talleres_input_codigo_talleres").attr("maxlength", "4");
      $(".tiporadio_codigo").attr("maxlength", "4");
      $(".tipovehiculo_input_codigo").attr("maxlength", "4");
      $(".binput_codigo").attr("maxlength", "4");
      $(".tipootrosequipos_codigo").attr("maxlength", "4");
      $(".celular_codigo").attr("maxlength", "4");
      $(".transequipo_codigo").attr("maxlength", "2");
      $(".personalinput_codigo").attr("maxlength", "2");
      $(".portacion_codigo").attr("maxlength", "2");
      $(".input_codigo_patrulla").attr("maxlength", "2");

      /* $(".").addClass("");
      $(".").addClass("");
      $(".").addClass("");
      $(".").addClass(""); */
    });
  </script>


</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/

    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "empresas" ||
        $_GET["ruta"] == "proveedores" ||
        $_GET["ruta"] == "bancos" ||
        $_GET["ruta"] == "paises" ||
        $_GET["ruta"] == "afp" ||
        $_GET["ruta"] == "departamentos" ||
        $_GET["ruta"] == "servicios" ||
        $_GET["ruta"] == "cargos" ||
        $_GET["ruta"] == "periodos" ||
        $_GET["ruta"] == "isr" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "seminarios" ||
        $_GET["ruta"] == "planillas" ||
        $_GET["ruta"] == "sim" ||
        $_GET["ruta"] == "equipos" ||
        $_GET["ruta"] == "familia" ||
        $_GET["ruta"] == "tipoarmas" ||
        $_GET["ruta"] == "armas" ||
        $_GET["ruta"] == "tipovehiculo" ||
        $_GET["ruta"] == "tipobicicleta" ||
        $_GET["ruta"] == "bicicleta" ||
        $_GET["ruta"] == "tiporadio" ||
        $_GET["ruta"] == "radio" ||
        $_GET["ruta"] == "transaccionesequipo" ||
        $_GET["ruta"] == "uniforme" ||
        $_GET["ruta"] == "transaccionespersonal" ||
        $_GET["ruta"] == "ubicacionc" ||
        $_GET["ruta"] == "vehiculo" ||
        $_GET["ruta"] == "portacionarma" ||
        $_GET["ruta"] == "jefeoperacion" ||
        $_GET["ruta"] == "pedido" ||
        $_GET["ruta"] == "pago" ||
        $_GET["ruta"] == "ubicacionc" ||
        $_GET["ruta"] == "empleados" ||
        $_GET["ruta"] == "imprimirimagenes" ||
        $_GET["ruta"] == "patrulla" ||
        $_GET["ruta"] == "administrarpatrulla" ||
        $_GET["ruta"] == "tipootrosequipos" ||
        $_GET["ruta"] == "tipocelular" ||
        $_GET["ruta"] == "celular" ||
        $_GET["ruta"] == "ajustes" ||
        $_GET["ruta"] == "descuentos" ||
        $_GET["ruta"] == "configuracion" ||
        $_GET["ruta"] == "diasferiados" ||
        $_GET["ruta"] == "reporteanticipo" ||
        $_GET["ruta"] == "regalo" ||
        $_GET["ruta"] == "personalnocontratable" ||
        $_GET["ruta"] == "formretiro" ||
        $_GET["ruta"] == "retiro" ||
        $_GET["ruta"] == "extravios" ||
        $_GET["ruta"] == "uniformedescuento" ||
        $_GET["ruta"] == "imprimirficha" ||
        $_GET["ruta"] == "candidatos" ||
        $_GET["ruta"] == "contratacion" ||
        $_GET["ruta"] == "fichapolicia" ||
        $_GET["ruta"] == "pdffichapolicia" ||
        $_GET["ruta"] == "fichadactilar" ||
        $_GET["ruta"] == "vendedor" ||
        $_GET["ruta"] == "detalleubicacion" ||
        $_GET["ruta"] == "historialdetalle" ||
        $_GET["ruta"] == "turnosubicacion" ||
        $_GET["ruta"] == "consultabono" ||
        $_GET["ruta"] == "comentario" ||
        $_GET["ruta"] == "agenteubicacion" ||
        $_GET["ruta"] == "devengoubicacion" ||
        $_GET["ruta"] == "historialcelular" ||
        $_GET["ruta"] == "cambiarcoordinador" ||
        $_GET["ruta"] == "aumentarhombres" ||
        $_GET["ruta"] == "posicionubicacion" ||
        $_GET["ruta"] == "reporteaumento" ||
        $_GET["ruta"] == "transaccionagente" ||
        $_GET["ruta"] == "tipohora" ||
        $_GET["ruta"] == "situacion" ||
        $_GET["ruta"] == "coordinadorpatrulla" ||
        $_GET["ruta"] == "asignarcoordinador" ||
        $_GET["ruta"] == "vacante" ||
        $_GET["ruta"] == "planilladevengo" ||
        $_GET["ruta"] == "nuevaplanilladevengo" ||
        $_GET["ruta"] == "planillavacacion" ||
        $_GET["ruta"] == "nuevaplanillavacacion" ||
        $_GET["ruta"] == "historialvacante" ||
        $_GET["ruta"] == "turnos" ||
        $_GET["ruta"] == "planillaaguinaldo" ||
        $_GET["ruta"] == "nuevaplanillaaguinaldo" ||
        $_GET["ruta"] == "nuevaplanillagratifivaca" ||
        $_GET["ruta"] == "planillagratifivaca" ||
        $_GET["ruta"] == "recibo" ||
        $_GET["ruta"] == "kardex" ||
        $_GET["ruta"] == "transancionkardex" ||
        $_GET["ruta"] == "detalletransancionkardex" ||
        $_GET["ruta"] == "historialkardex" ||
        $_GET["ruta"] == "planillaadmin" ||
        $_GET["ruta"] == "nuevaplanillaadmin" ||
        $_GET["ruta"] == "fichapersonal" ||
        $_GET["ruta"] == "generarcontratados" ||
        $_GET["ruta"] == "reportecontratados" ||
        $_GET["ruta"] == "talleres" ||
        $_GET["ruta"] == "reparaciones" ||
        $_GET["ruta"] == "mantenimientovehiculo" ||
        $_GET["ruta"] == "mantenimientobicicleta" ||
        $_GET["ruta"] == "mantenimientoarma" ||
        $_GET["ruta"] == "mantenimientoradio" ||
        $_GET["ruta"] == "salir"
      ) {

        include "modulos/" . $_GET["ruta"] . ".php";
      } else {

        include "modulos/404.php";
      }
    } else {

      include "modulos/inicio.php";
    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';
  } else {

    include "modulos/login.php";
  }

  ?>



  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  <script src="vistas/js/empresas.js"></script>
  <script src="vistas/js/proveedores.js"></script>
  <script src="vistas/js/bancos.js"></script>
  <script src="vistas/js/paises.js"></script>
  <script src="vistas/js/afp.js"></script>
  <script src="vistas/js/departamentos.js"></script>
  <script src="vistas/js/servicios.js"></script>
  <script src="vistas/js/cargos.js"></script>
  <script src="vistas/js/periodos_pagos.js"></script>
  <script src="vistas/js/isr.js"></script>
  <script src="vistas/js/clientes.js"></script>

  <script src="vistas/calendario/js/moment-with-locales.min.js"></script>

  <script src="vistas/calendario/js/ion.calendar.js"></script>

  <script src="vistas/js/seminarios.js"></script>
  <script src="vistas/js/plantillas.js"></script>
  <script src="vistas/js/sim.js"></script>
  <script src="vistas/js/equipos.js"></script>
  <script src="vistas/js/familia.js"></script>
  <script src="vistas/js/tipoarmas.js"></script>
  <script src="vistas/js/armas.js"></script>
  <script src="vistas/js/talleres.js"></script>
  <script src="vistas/js/reparaciones.js"></script>
  <script src="vistas/js/manto_vehiculo.js"></script>
  <script src="vistas/js/manto_bicicleta.js"></script>
  <script src="vistas/js/manto_arma.js"></script>
  <script src="vistas/js/manto_radio.js"></script>
  <script src="vistas/js/tipovehiculo.js"></script>
  <script src="vistas/js/tipobicicleta.js"></script>
  <script src="vistas/js/bicicleta.js"></script>
  <script src="vistas/js/tiporadio.js"></script>
  <script src="vistas/js/radio.js"></script>
  <script src="vistas/js/transaccionesequipo.js"></script>
  <script src="vistas/js/uniforme.js"></script>
  <script src="vistas/js/transaccionespersonal.js"></script>
  <script src="vistas/js/ubicacionc.js"></script>
  <script src="vistas/js/vehiculo.js"></script>
  <script src="vistas/js/portacionarma.js"></script>
  <script src="vistas/js/jefeoperacion.js"></script>
  <script src="vistas/js/pedido.js"></script>
  <script src="vistas/js/pago.js"></script>
  <script src="vistas/js/empleados.js"></script>
  <script src="vistas/js/patrulla.js"></script>
  <script src="vistas/js/administrarpatrulla.js"></script>
  <script src="vistas/js/tipootrosequipos.js"></script>
  <script src="vistas/js/tipocelular.js"></script>
  <script src="vistas/js/celular.js"></script>
  <script src="vistas/js/ajustes.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  <script src="vistas/js/descuentos.js"></script>

  <script src="vistas/js/validar.js"></script>

  <script src="vistas/js/dias_feriados.js"></script>
  <script src="vistas/js/retiro.js"></script>
  <script src="vistas/js/vendedor.js"></script>
  <script src="vistas/js/detalleubicacion.js"></script>
  <script src="vistas/js/turnosubicacion.js"></script>
  <script src="vistas/js/comentario.js"></script>
  <script src="vistas/js/agenteubicacion.js"></script>
  <script src="vistas/js/devengoubicacion.js"></script>
  <script src="vistas/js/posicionubicacion.js"></script>
  <script src="vistas/js/transaccionagente.js"></script>
  <script src="vistas/js/tipohora.js"></script>
  <script src="vistas/js/coordinadorpatrulla.js"></script>
  <script src="vistas/js/vacante.js"></script>
  <script src="vistas/js/recibo.js"></script>


  <script>
    $(function() {



      $(".calendario").ionDatePicker({
        lang: "es"
      });


    });


    $(document).ready(function() {




    });
  </script>

  <script>
    jQuery(document).ready(function($) {
      $(document).ready(function() {
        $('.mi-selector').select2();
      });



      /* $(".calendario").attr("readonly","readonly"); */

      $(".calendario").keydown(function(e) {
        e.preventDefault();
      });


      $(".bloqueado").keydown(function(e) {
        e.preventDefault();
      });


    });


    /* **********validar decimmal******** */
    var validNumber = new RegExp(/^\d*\.?\d*$/);
    var lastValid = document.getElementById("test1").value;

    function validateNumber(elem) {
      if (validNumber.test(elem.value)) {
        lastValid = elem.value;
      } else {
        elem.value = lastValid;
      }
    }

    /* poner este en el input */
    /* oninput="validateNumber(this);" */
    /* ************************************ */
  </script>




</body>

</html>