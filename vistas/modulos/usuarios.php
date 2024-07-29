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

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          <i class="fa fa-plus"></i> Agregar usuario
        </button>
        <?php if ($_SESSION["perfil"] === "Administrador") { ?>
          <div id="modal_config_server" class="pull-right">
            <button type="button" class="btn btn-info bg-blue-gradient" data-toggle="modal" data-target="#servidor_correo"><i class="fa fa-server"></i> Servidor de Correo</button>
          </div>
          <div id="servidor_correo" class="modal fade" role="dialog">

            <div class="modal-dialog modal-lg">

              <div class=" modal-content">
                <form role="form" id="form_config_server" method="post" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="idsmtp" name="idsmtp">
                  <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                  <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Configuración de servidor de correo</h4>

                  </div>

                  <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                  <div class="modal-body">

                    <div class="box-body">

                      <div class="row">

                        <div class="col-md-4">
                          <!-- ENTRADA PARA EL NOMBRE -->

                          <div class="form-group">
                            <label for="">SMTP server:</label>
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-server"></i></span>

                              <input type="text" class="form-control input-lg" name="smtp_server" id="smtp_server" placeholder="Ingresar SMTP SERVER" required>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <!-- ENTRADA PARA EL NOMBRE -->

                          <div class="form-group">
                            <label for="">Puerto SMTP:</label>
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-server"></i></span>

                              <input type="text" class="form-control input-lg" name="puerto_smtp_server" id="puerto_smtp_server" placeholder="Puerto SMTP SERVER" required>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <!-- ENTRADA PARA EL CORREO -->
                          <div class="form-group">
                            <label for="">Titulo del Remitente:</label>
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-address-book"></i></span>

                              <input type="text" class="form-control input-lg" value="" name="tituloRemitente" placeholder="Ingresar Titulo del Remitente" id="tituloRemitente" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <!-- ENTRADA PARA EL USUARIO -->
                          <div class="form-group">
                            <label for="">Correo</label>
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                              <input type="text" class="form-control input-lg" value="" name="correoRemitente" placeholder="Ingresar correo remitente" id="correoRemitente" required>

                            </div>

                          </div>
                        </div>

                        <div class="col-md-6">

                          <!-- ENTRADA PARA LA CONTRASEÑA -->

                          <div class="form-group">
                            <label for="">Ingresar contraseña</label>
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                              <input type="password" class="form-control input-lg" name="remitentePassword" placeholder="Ingresar contraseña" value="">

                            </div>

                          </div>
                        </div>
                      </div>

                    </div>

                  </div>

                  <!--=====================================
        PIE DEL MODAL
        ======================================-->

                  <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Configuración</button>

                  </div>



                </form>

              </div>

            </div>

          </div>


        <?php
        } ?>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último login</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value) {

              echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["nombre"] . '</td>
                  <td>' . $value["user_correo"] . "&nbsp;&nbsp;" . ($value["2fa"] == "1" ? '<sup><i class="fa fa-shield" style="color:green !important" aria-hidden="true"></i></sup>' : "") . '</td>
                  <td>' . $value["usuario"] . '</td>';

              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px"></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
              }

              echo '<td>' . $value["perfil"] . '</td>';

              if ($value["estado"] != 0) {

                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="0">Activado</button></td>';
              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="1">Desactivado</button></td>';
              }

              echo '<td>' . $value["ultimo_login"] . '</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["id"] . '" fotoUsuario="' . $value["foto"] . '" usuario="' . $value["usuario"] . '"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            }


            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg" style="width: 80% !important;">

    <div class="modal-content">

      <form role="form" id="formUser" method="post" autocomplete="off" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group">
                  <label for="">Ingresar nombre</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

                  </div>
                </div>
              </div>
              <div class="col-md-6">

                <!-- ENTRADA PARA EL CORREO -->

                <div class="form-group">
                  <label for="">Ingresar Correo</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                    <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar Correo" id="nuevoUserCorreo" required>

                  </div>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <!-- ENTRADA PARA EL USUARIO -->
                <div class="form-group">
                  <label for="">Ingresar usuario</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

                  </div>

                </div>
              </div>


              <div class="col-md-6">

                <!-- ENTRADA PARA LA CONTRASEÑA -->

                <div class="form-group">
                  <label for="">Ingresar contraseña</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                    <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

                  </div>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <!-- ENTRADA PARA LA CONTRASEÑA -->

                <div class="form-group">
                  <label for="">Repetir contraseña</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                    <input type="password" class="form-control input-lg" name="password_confirm" placeholder="Repetir contraseña" required>

                  </div>

                </div>
              </div>


              <div class="col-md-6">

                <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

                <div class="form-group">
                  <label for="">Selecionar perfil</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control input-lg" required name="nuevoPerfil">

                      <option value="">Selecionar perfil</option>

                      <option value="Administrador">Administrador</option>

                      <option value="Especial">Especial</option>

                      <option value="Vendedor">Vendedor</option>
                      <option value="Gerencia General">Gerencia General </option>
                      <option value="Sub-gerente">Sub-gerente</option>
                      <option value="Contador">Contador</option>
                      <option value="Asistente Contable">Asistente Contable</option>
                      <option value="Facturacion y Cobros">Facturacion y Cobros</option>
                      <option value="Departamento IT">Departamento IT</option>
                      <option value="Gerencia RHH">Gerencia RHH</option>
                      <option value="Asistente RHH">Asistente RHH</option>
                      <option value="Auxiliar RRHH">Auxiliar RRHH</option>
                      <option value="Pasante RRHH">Pasante RRHH</option>
                      <option value="Gerencia Operaciones">Gerencia Operaciones</option>
                      <option value="Logistico">Logistico</option>
                      <option value="Jefe Operaciones">Jefe Operaciones</option>
                      <option value="Asistente Operaciones">Asistente Operaciones</option>
                      <option value="Recepcionista">Recepcionista</option>
                      <option value="Poligrafia">Poligrafia</option>
                      <option value="Atencion Al cliente">Atencion Al cliente</option>
                      <option value="Gerente de Ventas">Gerente de Ventas </option>


                    </select>

                  </div>

                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Captcha</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-shield" aria-hidden="true"></i>&nbsp;
                      <span id="captchaOperation"></span>

                    </span>
                    <input type="text" class="form-control input-lg" name="captcha" placeholder="Captcha" required />
                  </div>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="myCheckbox">¿Desea activar autenticación de 2FA para este usuario?</label>
                  <div class="containercheck">
                    <ul>
                      <li>
                        <input type="checkbox" id="auntenticacionactivada" <?= $_SESSION["perfil"] !== "Administrador" ? "Disabled" : "" ?> checked name="auntenticacionactivada">
                        <label for="auntenticacionactivada" class="labelcheckbox">Activar autenticación de 2FA</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              <label for="">SUBIR FOTO</label>
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" disabled><i class="fa fa-save"></i> Guardar usuario</button>

        </div>

        <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>
<style>
  .containercheck ul {
    margin-top: 0;
    padding-left: 0em;
  }

  .containercheck ul li {
    list-style-type: none;
  }

  .containercheck ul+ul {
    margin-bottom: 0;
  }

  .containercheck ul+ul>li+li label {
    margin-bottom: 0;
  }

  /*** Styling Radio & Checkbox Input Fields (start here) ***/
  .containercheck .labelcheckbox {
    font-weight: 600;
    color: #777777;
    font-weight: bold;
    margin-bottom: 11px;
    width: 100%;
    float: left;
    cursor: pointer;
    padding: 0 0.6em;
    box-sizing: border-box;
    background: #e6e6e6;
    transition: all 0.5s ease 0s;
  }

  .containercheck input[type="radio"],
  .containercheck input[type="checkbox"] {
    display: none;
  }

  .containercheck input[type="radio"]+label,
  .containercheck input[type="checkbox"]+label {
    line-height: 3em;
  }

  .containercheck input[type="radio"]+label {
    border-radius: 50px;
  }

  .containercheck input[type="radio"]:disabled+label,
  .containercheck input[type="checkbox"]:disabled+label {
    color: #ccc !important;
    cursor: not-allowed;
  }

  .containercheck input[type="radio"]:checked:disabled+label:after,
  .containercheck input[type="checkbox"]:checked:disabled+label:after {
    border-color: #ccc;
  }

  .containercheck input[type="radio"]+label:before,
  .containercheck input[type="checkbox"]+label:before {
    content: "";
    width: 26px;
    height: 26px;
    float: left;
    margin-right: 0.5em;
    border: 2px solid #ccc;
    background: #fff;
    margin-top: 0.5em;
  }

  .containercheck input[type="radio"]+label:before {
    border-radius: 100%;
  }

  .containercheck input[type="radio"]:checked+label,
  .containercheck input[type="checkbox"]:checked+label {
    background: #c1eec2;
  }

  .containercheck input[type="radio"]:checked+label:after {
    content: "";
    width: 0;
    height: 0;
    border: 7px solid #0fbf12;
    float: left;
    margin-left: -1.85em;
    margin-top: 1em;
    border-radius: 100%;
  }

  .containercheck input[type="checkbox"]:checked+label:after {
    content: "";
    width: 12px;
    height: 6px;
    border: 4px solid #0fbf12;
    float: left;
    margin-left: -1.95em;
    border-right: 0;
    border-top: 0;
    margin-top: 1em;
    transform: rotate(-55deg);
  }

  .containercheck input[type="radio"]:checked+label:before,
  .containercheck input[type="checkbox"]:checked+label:before {
    border-color: #0fbf12;

  }

  .containercheck input[type="radio"]:checked:disabled+label,
  .containercheck input[type="checkbox"]:checked:disabled+label {
    background: #ccc;
    color: #fff !important;
  }

  .containercheck input[type="radio"]:checked:disabled+label:before,
  .containercheck input[type="checkbox"]:checked:disabled+label:before {
    border-color: #bdbdbd;
  }
</style>
<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg" style="width: 80% !important;">

    <div class="modal-content">

      <form role="form" method="post" id="editarformUser" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" id="id_usuario_edit" name="id_usuario_edit">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <!-- ENTRADA PARA EL NOMBRE -->

                <div class="form-group">
                  <label for="">Ingresar nombre</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Ingresar nombre" required>

                  </div>
                </div>
              </div>
              <div class="col-md-6">

                <!-- ENTRADA PARA EL CORREO -->

                <div class="form-group">
                  <label for="">Ingresar Correo</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                    <input type="email" class="form-control input-lg" name="editarCorreo" placeholder="Ingresar Correo" id="editarCorreo" required>

                  </div>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <!-- ENTRADA PARA EL USUARIO -->
                <div class="form-group">
                  <label for="">Ingresar usuario</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control input-lg" name="editarUsuario" placeholder="Ingresar usuario" id="editarUsuario" required>

                  </div>

                </div>
              </div>

              <div class="col-md-6">

                <!-- ENTRADA PARA LA CONTRASEÑA -->

                <div class="form-group">
                  <label for="">Ingresar contraseña</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                    <input type="password" class="form-control input-lg" name="editarPassword" id="editarPassword" placeholder="Ingresar contraseña">
                    <input type="hidden" id="passwordActual" name="passwordActual">
                  </div>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <!-- ENTRADA PARA LA CONTRASEÑA -->

                <div class="form-group">
                  <label for="">Repetir contraseña</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                    <input type="password" class="form-control input-lg" name="editarpassword_confirm" placeholder="Repetir contraseña">

                  </div>

                </div>
              </div>


              <div class="col-md-6">

                <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

                <div class="form-group">
                  <label for="">Selecionar perfil</label>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control input-lg" required name="editarPerfil" id="editarPerfil">

                      <option value="">Selecionar perfil</option>

                      <option value="Administrador">Administrador</option>
                      <option value="Especial">Especial</option>
                      <option value="Vendedor">Vendedor</option>
                      <option value="Gerencia General">Gerencia General </option>
                      <option value="Sub-gerente">Sub-gerente</option>
                      <option value="Contador">Contador</option>
                      <option value="Asistente Contable">Asistente Contable</option>
                      <option value="Facturacion y Cobros">Facturacion y Cobros</option>
                      <option value="Departamento IT">Departamento IT</option>
                      <option value="Gerencia RHH">Gerencia RHH</option>
                      <option value="Asistente RHH">Asistente RHH</option>
                      <option value="Auxiliar RRHH">Auxiliar RRHH</option>
                      <option value="Pasante RRHH">Pasante RRHH</option>
                      <option value="Gerencia Operaciones">Gerencia Operaciones</option>
                      <option value="Logistico">Logistico</option>
                      <option value="Jefe Operaciones">Jefe Operaciones</option>
                      <option value="Asistente Operaciones">Asistente Operaciones</option>
                      <option value="Recepcionista">Recepcionista</option>
                      <option value="Poligrafia">Poligrafia</option>
                      <option value="Atencion Al cliente">Atencion Al cliente</option>
                      <option value="Gerente de Ventas">Gerente de Ventas </option>


                    </select>

                  </div>

                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Captcha</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-shield" aria-hidden="true"></i>&nbsp;
                      <span id="editarcaptchaOperation"></span>

                    </span>
                    <input type="text" class="form-control input-lg" name="editarcaptcha" placeholder="Captcha" required />
                  </div>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="myCheckbox">¿Desea activar autenticación de 2FA para este usuario?</label>
                  <div class="containercheck">
                    <ul>
                      <li>
                        <input type="checkbox" id="editarauntenticacionactivada" <?= $_SESSION["perfil"] !== "Administrador" ? "Disabled" : "" ?> checked name="editarauntenticacionactivada">
                        <label for="editarauntenticacionactivada" class="labelcheckbox">Activar autenticación de 2FA</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              <label for="">SUBIR FOTO</label>

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="150px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" disabled><i class="fa fa-edit"></i> Modificar usuario</button>

        </div>

        <?php

        $editarUsuario = new ControladorUsuarios();
        $editarUsuario->ctrEditarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>