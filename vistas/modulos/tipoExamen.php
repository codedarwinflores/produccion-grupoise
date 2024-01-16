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

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoExamen">

          Agregar Tipo Examen

        </button><br>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>
              <th style="width:10px">#</th>
              <th>COD</th>
              <th>Descripci&oacute;n</th>
              <th>Duraci&oacute;n</th>
              <th>Valor</th>
              <th>Comisi&oacute;n</th>
              <th width="6%">Acciones</th>
            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $examenes = ControladorTipoExamen::ctrMostrarTipoExamen($item, $valor);

            foreach ($examenes as $key => $value) {

              echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["codigo"] . '</td>
                  <td>' . $value["descripcion"] . '</td>
                  <td>' . $value["duracion"] . '</td>
                  <td>$ ' . $value["valor"] . '</td>
                  <td>$ ' . $value["comision"] . '</td>
                 ';




              echo '<td>

                    <div class="btn-group">
                        
                      
					   <button class="btn btn-warning btnEditarTipoExamen" idTipoExamen="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarTipoExamen"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarTipoExamen" idTipoExamen="' . $value["id"] . '"  ><i class="fa fa-times"></i></button>
					  
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
MODAL AGREGAR 
======================================-->

<div id="modalAgregarTipoExamen" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tipo Examen</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA  -->
            <div class="alert" role="alert" id="mensajeAlertaTipoExamen" style="display: none;"></div>
            <div class="form-group">
              <label for="">C&oacute;digo:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-qrcode fa-qr"></i></span>
                <input type="text" placeholder="Ingresar Código" class="form-control input-lg" name="nuevoCodigoTipoExamen" id="nuevoCodigoTipoExamen" required>
              </div>
            </div>

            <div class="form-group">
              <label for="">Descripción:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                <textarea name="nuevaDescripcionTipoExamen" class="form-control input-lg" placeholder="Descripción Tipo Examen" required></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for=""> Duraci&oacute;n</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="time" placeholder="Duración" class="form-control input-lg" name="nuevaDuracion" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-6">
                <label for="">Valor:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input type="text" class="form-control input-lg FormatoMoney" required placeholder="00.00" name="nuevoValor">
                </div>
              </div>
              <div class="col-xs-6">
                <label for="">Comisi&oacute;n:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"></i></span>
                  <input type="text" class="form-control input-lg FormatoMoney" required placeholder="00.00" name="nuevoComision">
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

          <button type="submit" class="btn btn-primary">Guardar Tipo Examen</button>

        </div>

        <?php

        $crear = new ControladorTipoExamen();
        $crear->ctrCrearTipoExamen();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarTipoExamen" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tipo Examen</h4>

        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->


        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA  -->

            <input type="hidden" name="editarIdTipoExamen" id="editarIdTipoExamen">
            <div class="form-group">
              <label for="">C&oacute;digo:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-qrcode fa-qr"></i></span>
                <input type="text" readonly placeholder="Ingresar Código" class="form-control input-lg" name="editarCodigoTipoExamen" id="editarCodigoTipoExamen" required>
              </div>
            </div>

            <div class="form-group">
              <label for="">Descripción:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                <textarea name="editarDescripcionTipoExamen" id="editarDescripcionTipoExamen" class="form-control input-lg" placeholder="Descripción Tipo Examen" required></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for=""> Duraci&oacute;n</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="time" placeholder="Duración" class="form-control input-lg" id="editarDuracion" name="editarDuracion" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-6">
                <label for="">Valor:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input type="text" class="form-control input-lg FormatoMoney" required placeholder="00.00" name="editarValor" id="editarValor">
                </div>
              </div>
              <div class="col-xs-6">
                <label for="">Comisi&oacute;n:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"></i></span>
                  <input type="text" class="form-control input-lg FormatoMoney" required placeholder="00.00" name="editarComision" id="editarComision">
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

          <button type="submit" class="btn btn-primary">Modificar Tipo Examen</button>

        </div>

        <?php

        $editar = new ControladorTipoExamen();
        $editar->ctrEditarTipoExamen();

        ?>

      </form>





    </div>

  </div>
</div>
</div>



</div>

</div>



<?php

$borrar = new ControladorTipoExamen();
$borrar->ctrBorrarTipoExamen();

?>