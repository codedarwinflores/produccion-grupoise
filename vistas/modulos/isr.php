<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

$Nombre_del_Modulo = "ISR";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
  global $nombretabla_isr;
  $query = "SHOW COLUMNS FROM $nombretabla_isr";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">



  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarisr">

          Agregar <?php echo $Nombre_del_Modulo; ?>

        </button>

      </div>

      <div class="box-body">


        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>

              <th>Código</th>
              <th>Nombre Rango</th>
              <th>Período Pago</th>
              <th>Salario Desde</th>
              <th>Salario Hasta</th>
              <th>Base 1</th>
              <th>Tasa sobre Excedente</th>
              <th>Base 2</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $datos_mostrar = Controladorisr::ctrMostrar($item, $valor);

            foreach ($datos_mostrar as $key => $value) {

              echo ' <tr>
                   <td>' . ($key + 1) . '</td>
                   <td>' . $value["codigo"] . '</td>
                   <td>' . $value["nombre_rango"] . '</td>
                   <td>' . $value["nombre_periodo"] . '</td>
                   <td>' . $value["salario_desde"] . '</td>
                   <td>' . $value["salario_hasta"] . '</td>
                   <td>' . $value["base_1"] . '</td>
                   <td>' . $value["tasa_sobre_excedente"] . '</td>
                   <td>' . $value["base_2"] . '</td>';



              echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarisr" idisr="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarisr"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarisr" idisr="' . $value["id"] . '"  Codigo="' . $value["nombre_periodo"] . '"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarisr" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar <?php echo $Nombre_del_Modulo; ?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body" style="position: relative;">

            <!-- ENTRADA PARA CAMPOS  -->

            <input type="text" name="nuevoperiodo_pago" id="campoperiodo_pago" class="input_id_periodo_pago" style="display: none;">

            <?php
            $data = getContent();
            foreach ($data as $row) {
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
            ?>
              <div class="form-group <?php echo $row['Field']; ?>">
                <label for="" class="label_<?php echo $row['Field']; ?>"></label>
                <div class="input-group">

                  <span class="input-group-addon"><i class="icono_<?php echo $row['Field']; ?>"></i></span>

                  <input type="text" class="form-control input-lg input_<?php echo $row['Field']; ?> isr_<?php echo $row['Field']; ?> " name="nuevo<?php echo $row['Field']; ?>" placeholder="" value="" required tabla_validar="isr" item_validar="codigo">

                </div>

              </div>

            <?php
            }
            ?>

            <!-- *** -->
            <div id="myDropdown" class="dropdown-content myDropdown">
              <?php
              $datos_mostrar_periodo = Controladorperiodos_pagos::ctrMostrar($item, $valor);
              foreach ($datos_mostrar_periodo as $key => $value) {
                echo ' <span class="select_pagos"  idpago="' . $value["id"] . '" nombrepago="' . $value["nombre_periodo"] . '">' . $value["nombre_periodo"] . '</span>';
              }
              ?>


            </div>
            <!-- *** -->



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo ?></button>

        </div>

        <?php

        $crear = new Controladorisr();
        $crear->ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarisr" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar <?php echo $Nombre_del_Modulo ?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- -- entrada id -- -->

            <!--           <input type="hidden" name="id" id="editarid">
 -->

            <input type="text" name="editarperiodo_pago" id="editar_campoperiodo_pago" class="input_id_periodo_pago" style="display: none;">


            <!-- ENTRADA PARA CAMPOS  -->

            <?php
            $data = getContent();
            foreach ($data as $row) {
            ?>
              <div class="form-group <?php echo $row['Field']; ?>">
                <label for="" class="label_<?php echo $row['Field']; ?>"></label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="icono_<?php echo $row['Field']; ?>"></i></span>

                  <input type="text" class="form-control input-lg input_<?php echo $row['Field']; ?> isr_<?php echo $row['Field']; ?>" name="editar<?php echo $row['Field']; ?>" id="editar<?php echo $row['Field']; ?>" placeholder="" value="" required>

                </div>

              </div>

            <?php
            }
            ?>



            <!-- *** -->
            <div id="myDropdown2" class="dropdown-content myDropdown">
              <?php
              $datos_mostrar_periodo = Controladorperiodos_pagos::ctrMostrar($item, $valor);
              foreach ($datos_mostrar_periodo as $key => $value) {
                echo ' <span class="select_pagos"  idpago="' . $value["id"] . '" nombrepago="' . $value["nombre_periodo"] . '">' . $value["nombre_periodo"] . '</span>';
              }
              ?>


            </div>
            <!-- *** -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar <?php echo $Nombre_del_Modulo ?></button>

        </div>

        <?php

        $editar = new Controladorisr();
        $editar->ctrEditar();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrar = new Controladorisr();
$borrar->ctrBorrar();

?>