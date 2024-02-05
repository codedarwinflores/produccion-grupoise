<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>


<div class="content-wrapper">
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEvaluado">

          <i class="fa fa-plus"></i> Agregar Evaluado

        </button><br>

      </div>
      <div class="box-body">
        <div class="alert" role="alert" id="mensajeAlertEvaluadoDelete" style="display: none;"></div>
        <table class="table table-bordered table-striped dt-responsive tbl_evaluados" width="100%">
          <thead>
            <tr>
              <th width="4%">#</th>
              <th>ID</th>
              <th width="5%">COD</th>
              <th>Nombre Completo</th>
              <th>Profesión</th>
              <th>Padre</th>
              <th>Madre</th>
              <th>Conyuge</th>
              <th>Lugar de Nac.</th>
              <th>Dirección</th>
              <th>Empresa</th>
              <th width="6%"></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
  <!--=====================================
MODAL AGREGAR 
======================================-->
  <?php
  require_once "./vistas/modulos/modales/evaluados.php";
  ?>
</div>