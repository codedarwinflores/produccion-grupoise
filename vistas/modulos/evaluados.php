<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>

<style>
  /* File Upload */
  .fake-shadow {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  }

  .fileUpload {
    position: relative;
    overflow: hidden;
  }

  .fileUpload #logo-id {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 33px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
  }

  .img-preview {

    max-width: 100%;
  }
</style>
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

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarEvaluado" class="modal fade" data-backdrop="static" role="dialog">

  <div class="modal-dialog modal-lg" style="width: 80% !important;">

    <div class="modal-content">

      <form role="form" id="form_evaluado_save" method="post" enctype="multipart/form-data" autocomplete="OFF">
        <input type="hidden" name="save_process_evaluado" value="ok" id="save_process_evaluado">
        <input type="hidden" name="id_edit_evaluado" value="0" id="id_edit_evaluado">
        <input type="hidden" name="type_action_form" value="save" id="type_action_form">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-blue-gradient" style=" color: #fff;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span id="editarTitle">Registrar</span> Evaluado</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">

          <div class="box-body">
            <div class="alert" role="alert" id="mensajeAlertEvaluado" style="display: none;"></div>
            <fieldset>
              <legend>
                <h5>Información Principal: </h5>
              </legend>
              <div class="row">
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoNombres">Nombres:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input type="text" class="form-control input-lg" autofocus name="nuevoNombres" id="nuevoNombres" placeholder="Nombres" required>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoPrimerApellido">Primer Apellido:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input type="text" class="form-control input-lg" required name="nuevoPrimerApellido" placeholder="Primer Apellido" id="nuevoPrimerApellido">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoSegundoApellido">Segundo Apellido:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input type="text" class="form-control input-lg" required name="nuevoSegundoApellido" placeholder="Segundo Apellido" id="nuevoSegundoApellido">
                  </div>
                </div>
              </div>

            </fieldset>
            <fieldset>
              <legend>
                <h5>Información Secundaria: </h5>
              </legend>
              <div class="row">
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevodocumentoevaluado">DUI:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                    <input type="text" class="form-control input-lg duis" name="nuevodocumentoevaluado" placeholder="DUI" id="nuevodocumentoevaluado">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="estadocivilevaluado">Estado Civil:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-diamond"></i></span>
                    <select name="estadocivilevaluado" id="estadocivilevaluado" class="form-control input-lg">
                      <option value="">Seleccione...</option>
                      <option value="Soltero(a)">Soltero(a)</option>
                      <option value="Casado(a)">Casado(a)</option>
                      <option value="Acompañado(a)">Acompañado(a)</option>
                      <option value="Divorciado(a)">Divorciado(a)</option>
                      <option value="Viudo(a)">Viudo(a)</option>
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevotelefonoevaluado">Teléfono:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control input-lg telefono" name="nuevotelefonoevaluado" placeholder="Teléfono" id="nuevotelefonoevaluado">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoPapaevaluado">Papá:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input type="text" class="form-control input-lg" name="nuevoPapaevaluado" id="nuevoPapaevaluado" placeholder="Papá">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoMamaevaluado">Mamá:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input type="text" class="form-control input-lg" name="nuevoMamaevaluado" id="nuevoMamaevaluado" placeholder="Mamá">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoConyugeevaluado">Conyuge:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                    <input type="text" class="form-control input-lg" name="nuevoConyugeevaluado" placeholder="Conyuge" id="nuevoConyugeevaluado">
                  </div>
                </div>

                <div class="col-xs-12 col-sm-8">
                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                      <label for="nuevofechaNacevaluado">Fecha Nacimiento:</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="date" class="form-control input-lg" name="nuevofechaNacevaluado" id="nuevofechaNacevaluado" placeholder="Fecha de Nacimiento">
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <label for="nuevoProfesionevaluado">Profesión / Oficio:</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                        <input type="text" class="form-control input-lg" name="nuevoProfesionevaluado" placeholder="Profesión / Oficio" id="nuevoProfesionevaluado">
                      </div>
                    </div>
                  </div>
                  <label for="nuevoLugarNacevaluado">Lugar de Nacimiento:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                    <textarea name="nuevoLugarNacevaluado" id="nuevoLugarNacevaluado" class="form-control input-lg" placeholder="Lugar de Nacimiento"></textarea>
                  </div>
                  <label for="nuevoidClienteevaluado">Pertenece a Empresa:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                    <select name="nuevoidClienteevaluado" id="nuevoidClienteevaluado" class="form-control mi-selector input-lg">
                      <option value="0">Seleccione...</option>
                      <?php
                      $item = "";
                      $valor = " order by id desc";
                      $campos = "*";
                      $tabla = "`tbl_clientes_morse`";
                      $categorias = ModeloLogsUser::mostrarDatosLogs($campos, $tabla, $item, $valor);

                      foreach ($categorias as $key => $value) {
                        echo '<option value="' . $value["id"] . '">' . $value["codigo_cliente"] . " - " . $value["nombre"] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <label for="nuevodireccionevaluado">Dirección Evaluado:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                    <textarea name="nuevodireccionevaluado" placeholder="Dirección evaluado" class="form-control input-lg" id="nuevodireccionevaluado"></textarea>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <label for="nuevoidClienteevaluado">Foto:</label>
                  <div class="input-group">
                    <div class="main-img-preview">
                      <img class="thumbnail img-preview" src="./vistas/img/plantilla/logo_original.png" class="img-responsive img-thumbnail" title="Preview Foto">
                    </div>
                    <div class="input-group">
                      <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                      <div class="input-group-btn">
                        <div class="fileUpload btn btn-danger fake-shadow">
                          <span><i class="glyphicon glyphicon-upload"></i> Subir foto</span>
                          <input id="logo-id" name="nuevaFotografia" type="file" class="attachment_upload" accept=".jpg, .jpeg, .png, .gif">
                          <input id="foto_edit" name="foto_edit" type="hidden" value="./vistas/img/plantilla/logo_original.png">
                        </div>
                      </div>
                    </div>
                    <p class="help-block">* Subir fotografía.</p>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer bg-gray-light">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Salir</button>
          <button type="reset" class="btn btn-info pull-left"> <i class="fa fa-eraser"></i>Limpiar </button>
          <button type="submit" class="btn btn-primary" id="btnevaluados"><i class="fa fa-save"></i> Guardar </button>

        </div>

      </form>

    </div>

  </div>

</div>

</div>



</div>

</div>