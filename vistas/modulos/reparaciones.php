<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$Nombre_del_Modulo = "Reparaciones";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_reparaciones;
    $query = "SHOW COLUMNS FROM $nombretabla_reparaciones";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
};

?>
<div class="content-wrapper">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarReparaciones">

                    Agregar <?php echo $Nombre_del_Modulo; ?>

                </button>

            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>

                        <tr>

                            <th width="8">#</th>

                            <th>Código</th>
                            <th>Nombres</th>
                            <th width="10">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $bancos = ControladorReparaciones::ctrMostrar($item, $valor);

                        foreach ($bancos as $key => $value) {

                            echo ' <tr>
                   <td>' . ($key + 1) . '</td>
                   <td>' . $value["codigo_reparacion"] . '</td>
                   <td>' . $value["nombre_reparacion"] . '</td>';

                            echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarReparaciones" idreparaciones="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarReparaciones"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarreparaciones" idreparaciones="' . $value["id"] . '"  Codigo="' . $value["codigo_reparacion"] . '"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarReparaciones" class="modal fade" role="dialog">

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

                    <div class="box-body">

                        <!-- ENTRADA PARA CAMPOS  -->

                        <?php
                        $data = getContent();
                        foreach ($data as $row) {

                            /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
                        ?>
                            <div class="form-group <?php echo $row['Field']; ?>">
                                <label for="" class="label_<?php echo $row['Field']; ?>"></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icono_<?php echo $row['Field']; ?>"></i></span>
                                    <input type="text" class="form-control input-lg reparaciones_input_<?php echo $row['Field']; ?>" name="nuevo<?php echo $row['Field']; ?>" placeholder="" value="" autocomplete="off" required tabla_validar="reparaciones" item_validar="codigo_reparacion">

                                </div>

                            </div>

                        <?php
                        }
                        ?>

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

                $crear = new ControladorReparaciones();
                $crear->ctrCrear();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarReparaciones" class="modal fade" role="dialog">

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
                        <!-- ENTRADA PARA CAMPOS  -->

                        <?php
                        $data = getContent();
                        foreach ($data as $row) {
                        ?>
                            <div class="form-group <?php echo $row['Field']; ?>">
                                <label for="" class="label_<?php echo $row['Field']; ?>"></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="icono_<?php echo $row['Field']; ?>"></i></span>

                                    <input type="text" class="form-control input-lg reparaciones_input_<?php echo $row['Field']; ?>" name="editar<?php echo $row['Field']; ?>" id="reparaciones_editar<?php echo $row['Field']; ?>" placeholder="" value="" autocomplete="off" required>

                                </div>

                            </div>

                        <?php
                        }
                        ?>




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

                $editar = new ControladorReparaciones();
                $editar->ctrEditar();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrar = new ControladorReparaciones();
$borrar->ctrBorrar();

?>