<?php
// Generar un token CSRF aleatorio

if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrf_token = $_SESSION['csrf_token'];

function convertirSegundosAMinutos($segundos)
{
  $minutos = floor($segundos / 60);  // Obtiene los minutos completos
  $segundosRestantes = $segundos % 60;  // Obtiene los segundos restantes

  return "$minutos minutos y $segundosRestantes segundos";
}

$tracker = new RequestTracker();
$request_count = $tracker->getRequestCount();
$time_until_reset = $tracker->getTimeUntilReset();

?>

<div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="max-width: 101%;">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <?php


    // Verificar el estado y bloquear si es necesario
    if ($request_count >= 10) {
    ?>
      <p>Has realizado demasiadas peticiones <sup>(<?= $request_count ?>)</sup>. Por favor, espera <?= convertirSegundosAMinutos($time_until_reset) ?> antes de intentar nuevamente.</p>

    <?php  } else {

    ?>
      <form method="post" autocomplete="off">
        <!-- Agregar el campo oculto para el token CSRF -->
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <div class="form-group has-feedback">
          <img src="./extensiones/captcha/code.captcha.php?rand=<?php echo rand(); ?>" class="img-thumbnail img-responsive" width="100%" id='image_captcha'>
        </div>
        <div class="form-group has-feedback">

          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>

        </div>

        <div class="form-group has-feedback">

          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        </div>



        <div class="row">



        </div>

        <div class="row">
          <div class="col-xs-9">

            <div class="form-group has-feedback">
              <input type="text" name="captchaText" required id="captchaText" class="form-control" placeholder="Confirmar Código Captcha">
              <span class="fa fa-qrcode form-control-feedback"></span>
            </div>
          </div>

          <div class="col-xs-3">
            <div class="form-group">
              <button type="button" class="btn btn-warning" onclick="refreshing_Captcha()" title="Refresh Código Capcha"><i class="fa fa-refresh"></i></button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Ingresar</button>
          </div>
          <p class="login-box-msg" style=" margin-top: 65px;">Sistema Administrativo interno Grupo ISE de Centroam&eacute;rica, todos los &#174; Derechos Reservados <?= date("Y") ?> </p>
        </div>

      </form>

    <?php } ?>

  </div>
  <?php

  $login = new ControladorUsuarios();
  $login->ctrIngresoUsuario();

  ?>


</div>