<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$Nombre_del_Modulo = "Mantenimiento Radio";

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
                        <table class="table table-bordered table-striped dt-responsive tablas" id="tablaradio" width="100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>N° Serie</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Fecha Adquisición</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $modeloVehiculo  = new Modelovehiculo();
                                $data0 = $modeloVehiculo::mostrarVehiculoDb("*", "tbl_radios", "", "");
                                foreach ($data0 as $value) {

                                    echo ' <tr class="campoid" datosradio="' . $value["codigo_radio"] . " - " . $value["descripcion_radio"] . " - " . $value["numero_serie"] . " - " . $value["marca"] . " - " . $value["modelo_radio"] . " - " . $value["color_radio"] . '" idradio="' . $value["id"] . '">
                                    <th>' . $value["codigo_radio"] . '</th>
                                     <td>' . $value["descripcion_radio"] . '</td>
                                    <td>' . $value["marca"] . '</td>
                                     <td>' . $value["numero_serie"] . '</td>
                                     <td>' . $value["modelo_radio"] . '</td>
                                     <td>' . $value["color_radio"] . '</td>
                                     <td>' . $value["fecha_adquisicion"] . '</td>';
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
                        <button class="btn btn-primary agregarbtnmovimiento" data-toggle="modal" data-target="#modalAgregarMantenimientoRadio">
                            Agregar <?php echo $Nombre_del_Modulo; ?>
                        </button>
                        <h4 class="nombre_radio text-success" id="nombre_radio_mostrar"></h4>

                        <div id="cargarDatosRadio">
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

<div id="modalAgregarMantenimientoRadio" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 900px !important;">

        <div class="modal-content">

            <form role="form" method="POST" id="saveformradio" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary"><strong>Radio: <span id="name_radio"></span></strong></h4>
                        <input type="hidden" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="nuevoidradio_mante" name="nuevoidradio_mante">
                        <div class="form-group col-md-6">
                            <label for="nuevofecha_mradio">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="nuevofecha_mradio" id="nuevofecha_mradio" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->


                        <div class="form-group col-md-6">
                            <label for="nuevocorrelativo_mradio">N° Correlativo:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>

                                <input type="text" class="form-control" readonly name="nuevocorrelativo_mradio" id="nuevocorrelativo_mradio" required="" placeholder="000000">


                            </div>
                        </div>

                        <!-- ********************* -->

                        <div class="form-group col-md-12">
                            <label for="nuevodiagnostico_mradio" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="nuevodiagnostico_mradio" required id="nuevodiagnostico_mradio" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nuevoid_equipo">Equipos:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="nuevoid_equipo" id="nuevoid_equipo" required>

                                    <option value="">Seleccione...</option>
                                    <?php

                                    $datos_mostrar = $modeloVehiculo::mostrarVehiculoDb("eq.id,eq.codigo_equipo,eq.descripcion_equipo,eq.descripcion,otro_eq.codigo,otro_eq.nombre", "tbl_otros_equipos eq INNER JOIN tipo_otros_equipos otro_eq on eq.tipo_equipos=otro_eq.id WHERE otro_eq.codigo = 'REPU' OR otro_eq.codigo = 'SERV'", "", "");
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value["codigo"] . " - " . $value['nombre'] . " - " . $value['codigo_equipo'] . ' - ' . $value['descripcion'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="nuevocosto_obra_mradio" class="">Costo Obra:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney sumarTotalNuevo" min="0" required placeholder="0.00" name=" nuevocosto_obra_mradio" readonly id="nuevocosto_obra_mradio">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nuevocosto_repuesto_mradio" class="">Costo Repuesto:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney sumarTotalNuevo" required name="nuevocosto_repuesto_mradio" id="nuevocosto_repuesto_mradio" readonly placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nuevovalor_mradio" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required placeholder="0.00" name=" nuevovalor_mradio" id="nuevovalor_mradio">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nuevototal_mradio" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" readonly="" required name="nuevototal_mradio" id="nuevototal_mradio" placeholder="0.00">

                            </div>
                        </div>



                        <div class="form-group col-md-12">
                            <label for="nuevodescripcion" class="">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <textarea class=" form-control" name="nuevodescripcion" id="nuevodescripcion" placeholder="Descripción" required></textarea>

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

                    <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo ?></button>

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

            <form role="form" method="POST" id="editarformradio" enctype="multipart/form-data" autocomplete="off">

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

                        <h4 class="text-primary" id="radio_mostrar"></h4>
                        <input type="hidden" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="editaridradio_mante" name="editaridradio_mante">

                        <div class="form-group col-md-6">
                            <label for="editarfecha_mradio">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="editarfecha_mradio" id="editarfecha_mradio" placeholder="Ingresar Fecha" autocomplete="off" required="">
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="editarcorrelativo_mradio">N° Correlativo:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>

                                <input type="text" class="form-control" readonly name="editarcorrelativo_mradio" id="editarcorrelativo_mradio" required="" placeholder="000000">


                            </div>
                        </div>

                        <!-- ********************* -->

                        <div class="form-group col-md-12">
                            <label for="editardiagnostico_mradio" class="">Diagnóstico:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                                <textarea class="form-control" name="editardiagnostico_mradio" required id="editardiagnostico_mradio" placeholder="Diagnóstico"></textarea>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="editarid_equipo">Equipos:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>

                                <select class="form-control mi-selector" name="editarid_equipo" id="editarid_equipo" required>

                                    <option value="">Seleccione...</option>
                                    <?php

                                    $datos_mostrar = $modeloVehiculo::mostrarVehiculoDb("eq.id,eq.codigo_equipo,eq.descripcion_equipo,eq.descripcion,otro_eq.codigo,otro_eq.nombre", "tbl_otros_equipos eq INNER JOIN tipo_otros_equipos otro_eq on eq.tipo_equipos=otro_eq.id WHERE otro_eq.codigo = 'REPU' OR otro_eq.codigo = 'SERV'", "", "");
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['id']  ?>">
                                            <?php echo $value["codigo"] . " - " . $value['nombre'] . " - " . $value['codigo_equipo'] . ' - ' . $value['descripcion'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="editarcosto_obra_mradio" class="">Costo Obra:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney sumarTotalEditar" readonly min="0" required placeholder="0.00" name=" editarcosto_obra_mradio" id="editarcosto_obra_mradio">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarcosto_repuesto_mradio" class="">Costo Repuesto:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney sumarTotalEditar" readonly required name="editarcosto_repuesto_mradio" id="editarcosto_repuesto_mradio" placeholder="0.00">

                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="editarvalor_mradio" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" min="0" required placeholder="0.00" name=" editarvalor_mradio" id="editarvalor_mradio">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editartotal_mradio" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control validarmoney" readonly="" required name="editartotal_mradio" id="editartotal_mradio" placeholder="0.00">

                            </div>
                        </div>



                        <div class="form-group col-md-12">
                            <label for="editardescripcion" class="">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <textarea class=" form-control" name="editardescripcion" id="editardescripcion" placeholder="Descripción" required></textarea>

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