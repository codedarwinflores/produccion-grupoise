<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$Nombre_del_Modulo = "Mantenimiento Bicicleta";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_transacciones_agente;
    $query = "SHOW COLUMNS FROM $nombretabla_transacciones_agente";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
};




?>

<style>
    .selectedd {
        background: #C3F3FF !important;
        color: #000;
        font-weight: 600;
        cursor: pointer;
    }
</style>
<div class="content-wrapper">

    <section class="content">

        <div class="box">

            <div class="box-header with-border">



            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="box-body">
                        <h4 class="text-info"><strong>Paso 1: Seleccione una Bicicleta</strong></h4>
                        <table class="table table-bordered table-striped dt-responsive tablas" id="tablabicicleta" width="100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>N° Serie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $modeloVehiculo  = new Modelovehiculo();
                                $data0 = $modeloVehiculo::mostrarVehiculoDb("*", "tbl_bicicleta", "", "");
                                foreach ($data0 as $value) {

                                    echo ' <tr class="campoid" datosbicicleta="' . $value["codigo_bicicleta"] . " " . $value["descripcion_bicicleta"] . '" idbicicleta="' . $value["id"] . '">
                                    <td>' . $value["codigo_bicicleta"] . '</td>
                                    <td>' . $value["descripcion_bicicleta"] . '</td>
                                     <td>' . $value["marca"] . '</td>
                                     <td>' . $value["numero_serie"] . '</td>';
                                    echo '</tr>';
                                }


                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-body">
                        <h4 class="text-info"><strong>Paso 2: Administrar Mantenimiento a Bicicleta</strong></h4>
                        <button class="btn btn-primary agregarbtnmovimiento" data-toggle="modal" data-target="#modalAgregarMantenimientoVehiculo">
                            Agregar <?php echo $Nombre_del_Modulo; ?>
                        </button>
                        <h4 class="nombre_bicicleta text-success" id="nombre_bicicleta_mostrar"></h4>

                        <div id="cargarDatosBicicleta">
                        </div>



                    </div>
                </div>
            </div>



        </div>

    </section>

</div>





<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarMantenimientoVehiculo" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 900px !important;">

        <div class="modal-content">

            <form role="form" method="POST" id="saveformbici" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary"><strong>Vehículo: <span id="name_bicicleta"></span></strong></h4>
                        <input type="hidden" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="nuevoidbicicleta_mante" name="nuevoidbicicleta_mante">
                        <div class="form-group col-md-4">
                            <label for="nuevofecha" class="">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="nuevofecha" id="nuevofecha" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->


                        <div class="form-group col-md-8">
                            <label for="nuevoidempleado_mbici">Empleado Encargado:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="nuevoidempleado_mbici" id="nuevoidempleado_mbici" required>

                                    <option value="">Seleccione...</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $datos_mostrar = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value['codigo_empleado'] . ' - ' . $value['primer_nombre'] . ' ' . $value['segundo_nombre'] . ' ' . $value['tercer_nombre'] . ' ' . $value['primer_apellido'] . ' ' . $value['segundo_apellido'] . ' ' . $value['apellido_casada']  ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>

                        <!-- ********************* -->

                        <div class="form-group col-md-12">
                            <label for="nuevodiagnostico_mbici" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="nuevodiagnostico_mbici" required id="nuevodiagnostico_mbici" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="nuevoidreparacion_mbici" class="">Reparación:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                <select class="form-control mi-selector" required name="nuevoidreparacion_mbici" id="nuevoidreparacion_mbici">

                                    <option value="">Seleccione...</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $datos_mostrar  = ControladorReparaciones::ctrMostrar($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value['codigo_reparacion'] . ' - ' . $value['nombre_reparacion'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nuevoid_taller" class="">Taller:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                <select class="form-control mi-selector" required name="nuevoid_taller" id="nuevoid_taller">

                                    <option value="">Seleccione...</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $datos_mostrar  = ControladorTalleres::ctrMostrar($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value['codigo_talleres'] . ' - ' . $value['nombre_talleres'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label for="nuevovalor_mbici" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required placeholder="0.00" name=" nuevovalor_mbici" id="nuevovalor_mbici">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nuevototal_mbici" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" required name="nuevototal_mbici" id="nuevototal_mbici" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevofecha_pago_mbici" class="">Fecha Pago:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_pago_mbici" id="nuevofecha_pago_mbici" placeholder="Fecha Pago" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevofecha_ingreso_mbici" class="">Fecha Ingreso:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_ingreso_mbici" id="nuevofecha_ingreso_mbici" placeholder="Fecha Ingreso" required>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nuevofecha_salida_mbici" class="">Fecha Salida:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_salida_mbici" id="nuevofecha_salida_mbici" placeholder="Fecha Salida" required>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nuevocomentario_mbici" class="">Comentario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <textarea class="form-control" name="nuevocomentario_mbici" id="nuevocomentario_mbici" placeholder="Comentario"></textarea>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div id="mensajenuevo"></div>
                        </div>
                    </div>
                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary guardarvacante">Guardar <?php echo $Nombre_del_Modulo ?></button>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarMantenimiento" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 900px !important;">

        <div class="modal-content">

            <form role="form" method="POST" id="editarformbici" enctype="multipart/form-data" autocomplete="off">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar <?php echo $Nombre_del_Modulo; ?></h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA CAMPOS  -->

                        <h4 class="text-primary" id="bicicleta_mostrar"></h4>
                        <input type="hidden" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="editaridbicicleta_mante" name="editaridbicicleta_mante">
                        <div class="form-group col-md-4">
                            <label for="editarfecha" class="">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="editarfecha" id="editarfecha" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group col-md-8">
                            <label for="editaridempleado_mbici">Empleado Encargado:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="editaridempleado_mbici" id="editaridempleado_mbici" required>

                                    <option value="">Seleccione...</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $datos_mostrar = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value['codigo_empleado'] . ' - ' . $value['primer_nombre'] . ' ' . $value['segundo_nombre'] . ' ' . $value['tercer_nombre'] . ' ' . $value['primer_apellido'] . ' ' . $value['segundo_apellido'] . ' ' . $value['apellido_casada']  ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>

                        <!-- ********************* -->

                        <div class="form-group col-md-12">
                            <label for="editardiagnostico_mbici" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="editardiagnostico_mbici" required id="editardiagnostico_mbici" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="editaridreparacion_mbici" class="">Reparación:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                <select class="form-control mi-selector" required name="editaridreparacion_mbici" id="editaridreparacion_mbici">

                                    <option value="">Seleccione...</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $datos_mostrar  = ControladorReparaciones::ctrMostrar($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value['codigo_reparacion'] . ' - ' . $value['nombre_reparacion'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="editarid_taller" class="">Taller:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                <select class="form-control mi-selector" required name="editarid_taller" id="editarid_taller">

                                    <option value="">Seleccione...</option>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $datos_mostrar  = ControladorTalleres::ctrMostrar($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value['codigo_talleres'] . ' - ' . $value['nombre_talleres'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="editarvalor_mbici" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required name="editarvalor_mbici" id="editarvalor_mbici" placeholder="0.00">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editartotal_mbici" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" required name="editartotal_mbici" id="editartotal_mbici" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarfecha_pago_mbici" class="">Fecha Pago:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_pago_mbici" id="editarfecha_pago_mbici" placeholder="Fecha Pago" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarfecha_ingreso_mbici" class="">Fecha Ingreso:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_ingreso_mbici" id="editarfecha_ingreso_mbici" placeholder="Fecha Ingreso" required>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editarfecha_salida_mbici" class="">Fecha Salida:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_salida_mbici" id="editarfecha_salida_mbici" placeholder="Fecha Salida" required>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="editarcomentario_mbici" class="">Comentario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <textarea class="form-control" name="editarcomentario_mbici" id="editarcomentario_mbici" placeholder="Comentario"></textarea>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div id="mensajenuevoedit"></div>
                        </div>
                    </div>
                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary modificar">Modificar <?php echo $Nombre_del_Modulo ?></button>

                </div>

            </form>

        </div>

    </div>

</div>