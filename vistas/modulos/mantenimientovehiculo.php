<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$Nombre_del_Modulo = "Mantenimiento Vehículo";

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
                        <h4 class="text-info"><strong>Paso 1: Seleccione un Vehículo</strong></h4>
                        <table class="table table-bordered table-striped dt-responsive tablas" id="tablavehiculo" width="100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php
                                $Vehiculo  = new ConsultasPersonalizadas();

                                $data0 = $Vehiculo::mostrarDatosDb("*", "tbl_vehiculos", "", "");
                                foreach ($data0 as $value) {

                                    echo ' <tr class="campoid" datosvehiculo="' . $value["codigo_vehiculo"] . " " . $value["descripcion_vehiculo"] . '" idvehiculo="' . $value["id"] . '">
                                    <th>' . $value["codigo_vehiculo"] . '</th>
                                    <td>' . $value["descripcion_vehiculo"] . '</td>
                                     <td>' . $value["marca"] . '</td>
                                     <td>' . $value["modelo"] . '</td>';
                                    echo '</tr>';
                                }


                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-body">
                        <h4 class="text-info"><strong>Paso 2: Administrar Mantenimiento a Vehículo</strong></h4>
                        <button class="btn btn-primary agregarbtnmovimiento" data-toggle="modal" data-target="#modalAgregarMantenimientoVehiculo">
                            Agregar <?php echo $Nombre_del_Modulo; ?>
                        </button>
                        <h4 class="nombre_vehiculo text-success" id="nombre_vehiculo_mostrar"></h4>

                        <div id="cargarDatos">
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

            <form role="form" method="POST" id="saveform" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary"><strong>Vehículo: <span id="name_vehiculo"></span></strong></h4>
                        <input type="hidden" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="nuevoidvehiculo_mante" name="nuevoidvehiculo_mante">
                        <div class="form-group col-md-4">
                            <label for="nuevofecha" class="">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="nuevofecha" id="nuevofecha" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group col-md-8">
                            <label for="nuevoidempleado_mvehi">Empleado Encargado:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="nuevoidempleado_mvehi" id="nuevoidempleado_mvehi" required>

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
                            <label for="nuevodiagnostico_mvehi" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="nuevodiagnostico_mvehi" required id="nuevodiagnostico_mvehi" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="nuevoidreparacion_mvehi" class="">Reparación:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                <select class="form-control mi-selector" required name="nuevoidreparacion_mvehi" id="nuevoidreparacion_mvehi">

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

                        <div class="form-group col-md-4">
                            <label for="nuevokilometraje_mvehi" class="">Kilometraje:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                <input type="text" class="form-control validarmoney" name="nuevokilometraje_mvehi" id="nuevokilometraje_mvehi" placeholder="0.0 km" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevovalor_mvehi" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required placeholder="0.00" name=" nuevovalor_mvehi" id="nuevovalor_mvehi">

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nuevototal_mvehi" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" required name="nuevototal_mvehi" id="nuevototal_mvehi" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevofecha_pago_mvehi" class="">Fecha Pago:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_pago_mvehi" id="nuevofecha_pago_mvehi" placeholder="Fecha Pago" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevofecha_ingreso_mvehi" class="">Fecha Ingreso:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_ingreso_mvehi" id="nuevofecha_ingreso_mvehi" placeholder="Fecha Ingreso" required>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nuevofecha_salida_mvehi" class="">Fecha Salida:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_salida_mvehi" id="nuevofecha_salida_mvehi" placeholder="Fecha Salida" required>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="" class="">Comentario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <textarea class="form-control" name="nuevocomentario_mvehi" id="nuevocomentario_mvehi" placeholder="Comentario"></textarea>

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

            <form role="form" method="POST" id="editarform" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary" id="vehiculo_mostrar"></h4>
                        <input type="hidden" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="editaridvehiculo_mante" name="editaridvehiculo_mante">
                        <div class="form-group col-md-4">
                            <label for="editarfecha" class="">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="editarfecha" id="editarfecha" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->

                        <div class="form-group col-md-8">
                            <label for="editaridempleado_mvehi">Empleado Encargado:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="editaridempleado_mvehi" id="editaridempleado_mvehi" required>

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
                            <label for="editardiagnostico_mvehi" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="editardiagnostico_mvehi" required id="editardiagnostico_mvehi" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="editaridreparacion_mvehi" class="">Reparación:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                <select class="form-control mi-selector" required name="editaridreparacion_mvehi" id="editaridreparacion_mvehi">

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

                        <div class="form-group col-md-4">
                            <label for="editarkilometraje_mvehi" class="">Kilometraje:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                <input type="text" class="form-control validarmoney" name="editarkilometraje_mvehi" id="editarkilometraje_mvehi" placeholder="0.0" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarvalor_mvehi" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required name="editarvalor_mvehi" id="editarvalor_mvehi" placeholder="0.00">

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editartotal_mvehi" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" required name="editartotal_mvehi" id="editartotal_mvehi" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarfecha_pago_mvehi" class="">Fecha Pago:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_pago_mvehi" id="editarfecha_pago_mvehi" placeholder="Fecha Pago" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarfecha_ingreso_mvehi" class="">Fecha Ingreso:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_ingreso_mvehi" id="editarfecha_ingreso_mvehi" placeholder="Fecha Ingreso" required>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editarfecha_salida_mvehi" class="">Fecha Salida:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_salida_mvehi" id="editarfecha_salida_mvehi" placeholder="Fecha Salida" required>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="editarcomentario_mvehi" class="">Comentario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <textarea class="form-control" name="editarcomentario_mvehi" id="editarcomentario_mvehi" placeholder="Comentario"></textarea>

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