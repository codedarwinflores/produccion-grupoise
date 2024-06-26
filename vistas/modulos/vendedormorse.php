<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$Nombre_del_Modulo = "Vendedor Morse";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_tbl_vendedormorse;
    $query = "SHOW COLUMNS FROM $nombretabla_tbl_vendedormorse";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
};

?>
<div class="content-wrapper">
    <section class="content">
        <?php include_once "inicio/menumorse.php"; ?>
        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregartbl_vendedormorse">

                    Agregar <?php echo $Nombre_del_Modulo; ?>

                </button>

            </div>

            <div class="box-body">


                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>

                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Teléfono</th>
                            <th>Extensión</th>
                            <th>Email</th>
                            <th>Meta</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $bancos = Controladortbl_vendedormorse::ctrMostrar($item, $valor);

                        foreach ($bancos as $key => $value) {

                            echo ' <tr>
                   <td>' . ($key + 1) . '</td>
                   <td>' . $value["codigo"] . '</td>
                   <td>' . $value["nombre_vendedor"] . '</td>
                   
                   <td>' . $value["cargo_vendedor"] . '</td>
                   <td>' . $value["telefono_vendedor"] . '</td>
                   <td>' . $value["extension_vendedor"] . '</td>
                   <td>' . $value["email_vendedor"] . '</td>
                   <td>' . $value["meta_vendedor"] . '</td>';



                            echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditartbl_vendedormorse" idtbl_vendedormorse="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditartbl_vendedormorse"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminartbl_vendedormorse" idtbl_vendedormorse="' . $value["id"] . '"  Codigo="' . $value["codigo"] . '"  "><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregartbl_vendedormorse" class="modal fade" role="dialog">

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
                            <div class="form-group <?php echo $row['Field']; ?>  grupotbl_vendedormorse_<?php echo $row['Field']; ?>">
                                <label for="" class="vendedormorse_label_<?php echo $row['Field']; ?>"></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="vendedor_icono_<?php echo $row['Field']; ?>"></i></span>

                                    <input type="text" class="form-control input-lg vendedormorse_input_<?php echo $row['Field']; ?>" name="nuevo<?php echo $row['Field']; ?>" placeholder="" value="" autocomplete="off">

                                </div>

                            </div>


                        <?php
                        }
                        ?>


                        <!-- ******************* -->

                        <div class="form-group ">
                            <label for="" class="vendedormorse_label_cargo_vendedor">Ingresar Cargo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_cargo_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_cargo_vendedor" name="nuevocargo_vendedor" placeholder="Ingresar Cargo" value="" autocomplete="off" required="" maxlength="40">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_telefono_vendedor">Ingresar Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_telefono_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_telefono_vendedor telefono" name="nuevotelefono_vendedor" placeholder="Ingresar Teléfono" value="" autocomplete="off" required="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_extension_vendedor">Ingresar Extensión</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_extension_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_extension_vendedor" name="nuevoextension_vendedor" placeholder="Ingresar Extensión" value="" autocomplete="off" required="" maxlength="11">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_email_vendedor">Ingresar Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_email_vendedor"></i></span>
                                <input type="email" class="form-control input-lg vendedormorse_input_email_vendedor" name="nuevoemail_vendedor" placeholder="Ingresar Email" value="" autocomplete="off" required="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_meta_vendedor">Ingresar Meta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_meta_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_meta_vendedor" name="nuevometa_vendedor" placeholder="Ingresar Meta" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                            </div>
                        </div>
                        <!-- ****************** -->
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

                $crear = new Controladortbl_vendedormorse();
                $crear->ctrCrear();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartbl_vendedormorse" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="#" method="post" enctype="multipart/form-data" id="form_vendedormorse">

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

                        <!--           <input type="hidden" name="id" id="editarid"> -->



                        <!-- ENTRADA PARA CAMPOS  -->

                        <?php
                        $data = getContent();
                        foreach ($data as $row) {
                        ?>
                            <div class="form-group <?php echo $row['Field']; ?> egrupotbl_vendedormorse_<?php echo $row['Field']; ?>">
                                <label for="" class="vendedormorse_label_<?php echo $row['Field']; ?>"></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="vendedormorse_icono_<?php echo $row['Field']; ?>"></i></span>

                                    <input type="text" class="form-control input-lg vendedormorse_input_<?php echo $row['Field']; ?>" name="editar_<?php echo $row['Field']; ?>" id="editar_<?php echo $row['Field']; ?>" placeholder="" value="" autocomplete="off">

                                </div>

                            </div>

                        <?php
                        }
                        ?>





                        <!-- ******************* -->

                        <div class="form-group ">
                            <label for="" class="vendedormorse_label_cargo_vendedor">Ingresar Cargo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_cargo_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_cargo_vendedor" id="editar_cargo_vendedor" name="editar_cargo_vendedor" placeholder="Ingresar Cargo" value="" autocomplete="off" required="" maxlength="40">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_telefono_vendedor">Ingresar Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_telefono_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_telefono_vendedor telefono" id="editar_telefono_vendedor" name="editar_telefono_vendedor" placeholder="Ingresar Teléfono" value="" autocomplete="off" required="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_extension_vendedor">Ingresar Extensión</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_extension_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_extension_vendedor" id="editar_extension_vendedor" name="editar_extension_vendedor" placeholder="Ingresar Extensión" value="" autocomplete="off" required="" maxlength="11">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_email_vendedor">Ingresar Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_email_vendedor"></i></span>
                                <input type="email" class="form-control input-lg vendedormorse_input_email_vendedor" id="editar_email_vendedor" name="editar_email_vendedor" placeholder="Ingresar Email" value="" autocomplete="off" required="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="vendedormorse_label_meta_vendedor">Ingresar Meta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="vendedor_icono_meta_vendedor"></i></span>
                                <input type="text" class="form-control input-lg vendedormorse_input_meta_vendedor" name="editar_meta_vendedor" id="editar_meta_vendedor" placeholder="Ingresar Meta" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                            </div>
                        </div>
                        <!-- ****************** -->

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

                $editar = new Controladortbl_vendedormorse();
                $editar->ctrEditar();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrar = new Controladortbl_vendedormorse();
$borrar->ctrBorrar();

?>