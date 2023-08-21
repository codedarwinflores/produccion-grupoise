<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$Nombre_del_Modulo = "Mantenimiento Arma";

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
        font-weight: 700;
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
                        <h4 class="text-info"><strong>Paso 1: Seleccione un Arma</strong></h4>
                        <table class="table table-bordered table-striped dt-responsive tablas" id="tablaarma" width="100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>N° Serie</th>
                                    <th>Descripción</th>
                                    <th>Tipo / Marca</th>
                                    <th>N° Matrícula</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Arma  = new ConsultasPersonalizadas();
                                $data0 = $Arma::mostrarDatosDb("arma.*,tipoarma.codigo as codigoarma,tipoarma.nombre_tipo", "tbl_armas arma INNER JOIN tbl_tipos_de_armas tipoarma ON arma.id_tipo_arma=tipoarma.id", "", "");
                                foreach ($data0 as $value) {

                                    echo ' <tr class="campoid" datosarma="' . $value["codigo"] . " - " . $value["numero_serie"] . " - " . $value["nombre_tipo"] . " / " . $value["marca"] . " - " . $value["modelo"] . " - " . $value["color"] . " - " . $value["numero_matricula"] . '" idarma="' . $value["id"] . '">
                                    <th>' . $value["codigo"] . '</th>
                                    <td>' . $value["numero_serie"] . '</td>
                                     <td>' . $value["descripcion_arma"] . '</td>
                                     <td>' . $value["nombre_tipo"] . " / " . $value["marca"] . '</td>
                                     <td>' . $value["numero_matricula"] . '</td>
                                     <td>' . $value["modelo"] . '</td>
                                     <td>' . $value["color"] . '</td>';
                                    echo '</tr>';
                                }


                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-body">
                        <h4 class="text-info"><strong>Paso 2: Administrar Mantenimiento Arma</strong></h4>
                        <button class="btn btn-primary agregarbtnmovimiento" data-toggle="modal" data-target="#modalAgregarMantenimientoArma">
                            Agregar <?php echo $Nombre_del_Modulo; ?>
                        </button>
                        <h4 class="nombre_arma text-success" id="nombre_arma_mostrar"></h4>

                        <div id="cargarDatosarma">
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

<div id="modalAgregarMantenimientoArma" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 900px !important;">

        <div class="modal-content">

            <form role="form" method="POST" id="saveformarma" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary"><strong>Arma: <span id="name_arma"></span></strong></h4>
                        <input type="hidden" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="nuevoidarma_mante" name="nuevoidarma_mante">
                        <div class="form-group col-md-4">
                            <label for="nuevofecha_marma">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="nuevofecha_marma" id="nuevofecha_marma" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->


                        <div class="form-group col-md-8">
                            <label for="nuevoidempleado_marma">Empleado Encargado:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="nuevoidempleado_marma" id="nuevoidempleado_marma" required>

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
                            <label for="nuevodiagnostico_marma" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="nuevodiagnostico_marma" required id="nuevodiagnostico_marma" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>


                        <div class="form-group col-md-12">
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
                            <label for="nuevovalor_marma" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required placeholder="0.00" name=" nuevovalor_marma" id="nuevovalor_marma">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nuevototal_marma" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" required name="nuevototal_marma" id="nuevototal_marma" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevofecha_pago_marma" class="">Fecha Pago:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_pago_marma" id="nuevofecha_pago_marma" placeholder="Fecha Pago" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevofecha_ingreso_marma" class="">Fecha Ingreso:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_ingreso_marma" id="nuevofecha_ingreso_marma" placeholder="Fecha Ingreso" required>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nuevofecha_salida_marma" class="">Fecha Salida:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="nuevofecha_salida_marma" id="nuevofecha_salida_marma" placeholder="Fecha Salida" required>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nuevocomentario_marma" class="">Comentario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <textarea class="form-control" name="nuevocomentario_marma" id="nuevocomentario_marma" placeholder="Comentario"></textarea>

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

            <form role="form" method="POST" id="editarformarma" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary" id="arma_mostrar"></h4>
                        <input type="hidden" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="editaridarma_mante" name="editaridarma_mante">
                        <div class="form-group col-md-4">
                            <label for="editarfecha_marma" class="">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="editarfecha_marma" id="editarfecha_marma" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group col-md-8">
                            <label for="editaridempleado_marma">Empleado Encargado:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="editaridempleado_marma" id="editaridempleado_marma" required>

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
                            <label for="editardiagnostico_marma" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="editardiagnostico_marma" required id="editardiagnostico_marma" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>




                        <div class="form-group col-md-12">
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
                            <label for="editarvalor_marma" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required name="editarvalor_marma" id="editarvalor_marma" placeholder="0.00">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editartotal_marma" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" required name="editartotal_marma" id="editartotal_marma" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarfecha_pago_marma" class="">Fecha Pago:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_pago_marma" id="editarfecha_pago_marma" placeholder="Fecha Pago" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="editarfecha_ingreso_marma" class="">Fecha Ingreso:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_ingreso_marma" id="editarfecha_ingreso_marma" placeholder="Fecha Ingreso" required>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editarfecha_salida_marma" class="">Fecha Salida:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control" name="editarfecha_salida_marma" id="editarfecha_salida_marma" placeholder="Fecha Salida" required>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="editarcomentario_marma" class="">Comentario:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                <textarea class="form-control" name="editarcomentario_marma" id="editarcomentario_marma" placeholder="Comentario"></textarea>

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