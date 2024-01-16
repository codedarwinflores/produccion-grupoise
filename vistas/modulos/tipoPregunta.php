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

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoPregunta">

          Agregar Tipo Pregunta

        </button><br>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>
              <th width="4%">#</th>
              <th width="10%">COD</th>
              <th>Descripci&oacute;n</th>
              <th width="6%">Acciones</th>
            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $preguntas = ControladorTipoPregunta::ctrMostrarTipoPregunta($item, $valor);

            foreach ($preguntas as $key => $value) {

              echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["codigo"] . '</td>
                  <td>' . $value["descripcion"] . '</td>
				  
                 ';

              echo '<td>

                    <div class="btn-group">
                        
                      
					   <button class="btn btn-warning btnEditarTipoPregunta" idTipoPregunta="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarTipoPregunta"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarTipoPregunta" idTipoPregunta="' . $value["id"] . '"  ><i class="fa fa-times"></i></button>
					  
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

<div id="modalAgregarTipoPregunta" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tipo Pregunta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA  -->

            <div class="form-group">
              <label for="">C&oacute;digo:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-qrcode fa-qr"></i></span>
                <input type="text" readonly placeholder="Ingresar Código" class="form-control input-lg" name="nuevoCodigoPregunta" id="nuevoCodigoPregunta" required>
              </div>
            </div>

            <div class="form-group">
              <label for="">Descripción del Tipo Pregunta:</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-commenting"></i></span>
                <textarea name="nuevaDescripcionPregunta" class="form-control input-lg" required placeholder="Descripción del Tipo Pregunta"></textarea>

              </div>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Tipo Pregunta</button>

        </div>

        <?php

        $crear = new ControladorTipoPregunta();
        $crear->ctrCrearTipoPregunta();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarTipoPregunta" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tipo Pregunta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- -- entrada id -- -->

            <input type="hidden" name="editarIdTipoPregunta" id="editarIdTipoPregunta">

            <!-- ENTRADA PARA EL Codigo  -->
            <div class="form-group">
              <label for="">C&oacute;digo:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-qrcode fa-qr"></i></span>
                <input type="text" readonly placeholder="Ingresar Código" class="form-control input-lg" name="editarCodigoPregunta" id="editarCodigoPregunta" required>
              </div>
            </div>

            <div class="form-group">
              <label for="">Descripción del Tipo Pregunta:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span>
                <textarea name="editarDescripcionPregunta" class="form-control input-lg" id="editarDescripcionPregunta" placeholder="Descripción del Tipo Pregunta" required></textarea>

              </div>

            </div>

          </div>


          <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Modificar Tipo Pregunta</button>

          </div>

          <?php

          $editar = new ControladorTipoPregunta();
          $editar->ctrEditarTipoPregunta();

          ?>

      </form>





    </div>

  </div>
</div>
</div>



</div>

</div>



<?php

$borrar = new ControladorTipoPregunta();
$borrar->ctrBorrarTipoPregunta();

?>