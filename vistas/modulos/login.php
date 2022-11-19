

<div class="login-box">
  
  <div class="login-logo">

    <img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="max-width: 101%;">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="row">       
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>        
        </div>
        <p class="login-box-msg" style=" margin-top: 65px;">Sistema Administrativo interno  Grupo ISE de Centroam&eacute;rica, todos los &#174; Derechos Reservados 2023 </p>
      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>
