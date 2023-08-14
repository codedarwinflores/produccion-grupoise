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
        background: khaki !important;
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
                        <div style="height: 35px;"></div>
                        <table class="table table-bordered table-striped dt-responsive tablas" id="tablavehiculo" width="100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php

                                $modeloVehiculo  = new Modelovehiculo();

                                $data0 = $modeloVehiculo::mostrarVehiculoDb("*", "tbl_vehiculos", "", "");
                                foreach ($data0 as $value) {

                                    echo ' <tr class="campoid" datosvehiculo="' . $value["codigo_vehiculo"] . " " . $value["descripcion_vehiculo"] . '" idvehiculo="' . $value["id"] . '">
                                    <td>' . $value["codigo_vehiculo"] . '</td>
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


                        <h4 class="nombre_vehiculo text-success"></h4>

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

                        <h4 class="text-primary"><strong>Vehículo: <span id="name_vehiculo"></span></strong></h4>


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
                                            <?php echo $value['codigo_empleado'] . ' - ' . $value['primer_nombre'] . ' ' . $value['primer_nombre'] . ' ' . $value['tercer_nombre'] . ' ' . $value['primer_apellido'] . ' ' . $value['segundo_apellido'] . ' ' . $value['apellido_casada']  ?>
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


                        <div class="form-group col-md-12">
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

                        <div class="form-group col-md-4">
                            <label for="nuevokilometraje_mvehi" class="">Kilometraje:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                <input type="text" class="form-control" name="nuevokilometraje_mvehi" id="nuevokilometraje_mvehi" placeholder="Kilometraje" required>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nuevovalor_mvehi" class="">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control" required name="nuevovalor_mvehi" id="nuevovalor_mvehi" placeholder="0.00">

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nuevototal_mvehi" class="">Total:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <input type="text" class="form-control" required name="nuevototal_mvehi" id="nuevototal_mvehi" placeholder="0.00">

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

                <?php

                $crear = new Controladortransacciones_agente();
                $crear->ctrCrear();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartransacciones_agente" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 900px !important;">

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

                        <!-- ENTRADA PARA CAMPOS  -->


                        <h4 class="nombre_empleado"></h4>

                        <!-- *************** -->

                        <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">

                        <!-- *************** -->

                        <input type="hidden" class="form-control input-lg input_idagente_transacciones_agente" name="editaridagente_transacciones_agente" id="editaridagente_transacciones_agente" placeholder="" value="">


                        <!-- ******************** -->

                        <div class="form-group   grupotransacciones_agente_fecha_transacciones_agente col-md-3">
                            <label for="" class="">Ingresar Fecha</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_fecha_transacciones_agente"></i></span>
                                <input type="text" class="form-control input-lg input_fecha_transacciones_agente calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="editarfecha_transacciones_agente" id="editarfecha_transacciones_agente" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly>
                            </div>
                        </div>
                        <!-- ********************* -->
                        <div class="form-group   grupotransacciones_agente_hora_transacciones_agente col-md-3">
                            <label for="" class="">Hora</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_hora_transacciones_agente"></i></span>
                                <input type="text" class="form-control input-lg input_hora_transacciones_agente" name="editarhora_transacciones_agente" id="editarhora_transacciones_agente" placeholder="Ingresar Hora" value="" autocomplete="off" required="" readonly>
                            </div>
                        </div>

                        <!-- ********************* -->


                        <div class="form-group   grupofecha_movimiento_transacciones_agente col-md-5">
                            <label for="" class="">Ingresar Fecha Movimiento</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input type="text" class="form-control input-lg input_fecha_movimiento_transacciones_agente calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="editarfecha_movimiento_transacciones_agente" id="editarfecha_movimiento_transacciones_agente" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly>
                            </div>
                        </div>
                        <!-- ********************* -->

                        <div class="form-group   grupotransacciones_agente_tipo_movimiento_transacciones_agente col-md-12">
                            <label for="" class="">Tipo de Movimiento</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_tipo_movimiento_transacciones_agente"></i></span>

                                <select class="form-control input-lg input_tipo_movimiento_transacciones_agente mi-selector" name="editartipo_movimiento_transacciones_agente" id="editartipo_movimiento_transacciones_agente">

                                    <option value="" id="tipomovimiento">Seleccione Tipo Movimiento</option>
                                    <?php
                                    $datos_mostrar = Controladortransaccionespersonal::ctrMostrar($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option codigomovimiento="<?php echo $value['codigo'] ?>" value="<?php echo $value['codigo'] . '-' . $value['nombre'] . '-' . $value['tipo_movimiento_personal'] ?>">
                                            <?php echo $value['codigo'] . '-' . $value['nombre'] . '-' . $value['tipo_movimiento_personal'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>


                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group   grupotransacciones_agente_nueva_ubicacion_transacciones_agente col-md-6">
                            <label for="" class="">Nueva Ubicación</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_nueva_ubicacion_transacciones_agente"></i></span>

                                <select class="form-control input-lg input_nueva_ubicacion_transacciones_agente mi-selector" name="editarnueva_ubicacion_transacciones_agente" id="editarnueva_ubicacion_transacciones_agente">
                                    <option value="" id="nuevaubicacion">Seleccione Nueva Ubicación</option>
                                    <?php
                                    $datos_mostrar = Controladorubicacionc::ctrMostrar($item, $valor);
                                    foreach ($datos_mostrar as $key => $value) {
                                    ?>
                                        <option idubicacion="<?php echo $value['idubicacionc'] ?>" codigo="<?php echo $value['codigo_ubicacion'] ?>" value="<?php echo $value['codigo_ubicacion'] . '-' . $value['nombre_ubicacion'] ?>">
                                            <?php echo $value['codigo_ubicacion'] . '-' . $value['nombre_ubicacion'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                        <!-- ********************* -->


                        <div class="form-group    col-md-6 grupoid_vacante_transacciones_agente" style="visibility:hidden;">
                            <label for="" class="">Vacante</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <select class="form-control vacante_a_cubrir" name="editarid_vacante_transacciones_agente" id="editarid_vacante_transacciones_agente">

                                </select>

                            </div>
                        </div>
                        <!-- ***************** -->

                        <div class="form-group   grupotransacciones_agente_ubicacion_anterior_transacciones_agente col-md-12">
                            <label for="" class="">Anterior Ubicación</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_ubicacion_anterior_transacciones_agente"></i></span>
                                <input type="text" class="form-control input-lg input_ubicacion_anterior_transacciones_agente" name="editarubicacion_anterior_transacciones_agente" id="editarubicacion_anterior_transacciones_agente" placeholder="Anterior Ubicación" value="" autocomplete="off" readonly>
                            </div>
                        </div>
                        <!-- ********************* -->

                        <div class="form-group   grupotransacciones_agente_presento_incapacidad_transacciones_agente col-md-6">
                            <label for="" class="">Presento Incapacidad?</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_presento_incapacidad_transacciones_agente"></i></span>
                                <select class="form-control input-lg input_presento_incapacidad_transacciones_agente" name="editarpresento_incapacidad_transacciones_agente" id="editarpresento_incapacidad_transacciones_agente">
                                    <option value="">Presento Incapacidad?</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>

                                </select>

                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group col-md-6">
                            <label for="" class="">Seleccione Incapacidad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_ubicacion_anterior_transacciones_agente"></i></span>
                                <select class="form-control input-lg incapacidad_select" name="editartipo_incapacidad_transacciones_agente" id="editartipo_incapacidad_transacciones_agente">
                                    <option value="">Seleccione Incapacidad</option>
                                    <option value="Inicial">Inicial</option>
                                    <option value="Prorroga">Prorroga</option>
                                </select>
                            </div>
                        </div>

                        <!-- ********************* -->






                        <div class="form-group ocultar  grupotransacciones_agente_fecha_desde_transacciones_agente col-md-4">
                            <label for="" class="">Ingresar Desde</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_fecha_desde_transacciones_agente"></i></span>
                                <input type="text" class="form-control input-lg einput_fecha_desde_transacciones_agente calendario" name="editarfecha_desde_transacciones_agente" id="editarfecha_desde_transacciones_agente" placeholder="Ingresar Desde" value="" autocomplete="off" readonly>
                            </div>
                        </div>
                        <!-- ********************* -->

                        <div class="form-group ocultar  grupotransacciones_agente_fecha_hasta_transacciones_agente col-md-4">
                            <label for="" class="">Ingresar Hasta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_fecha_hasta_transacciones_agente"></i></span>
                                <input type="text" class="form-control input-lg einput_fecha_hasta_transacciones_agente calendario" name="editarfecha_hasta_transacciones_agente" id="editarfecha_hasta_transacciones_agente" placeholder="Ingresar Hasta" value="" autocomplete="off" readonly>
                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group ocultar   col-md-4">
                            <label for="" class="">Número Dias</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span>
                                <input type="text" class="form-control input-lg einput_numero_dias_transacciones_agente" name="editarnumero_dias_transacciones_agente" id="editarnumero_dias_transacciones_agente" placeholder="Número de dias" value="" autocomplete="off" readonly>
                            </div>
                        </div>

                        <!-- ************************* -->




                        <div class="form-group   grupotransacciones_agente_comentarios_transacciones_agente col-md-8">
                            <label for="" class="">Comentario</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_comentarios_transacciones_agente"></i></span>
                                <input type="text" class="form-control input-lg input_comentarios_transacciones_agente" name="editarcomentarios_transacciones_agente" id="editarcomentarios_transacciones_agente" placeholder="" value="" autocomplete="off">
                            </div>
                        </div>
                        <!-- ********************* -->



                        <div class="form-group   grupotransacciones_agente_turno_transacciones_agente col-md-4">
                            <label for="" class="">Seleccione Turno</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_turno_transacciones_agente"></i></span>
                                <select class="form-control input-lg input_turno_transacciones_agente" name="editarturno_transacciones_agente" id="editarturno_transacciones_agente">
                                    <option value="">Seleccione Turno</option>
                                    <option value="24h/r">24h/r</option>
                                    <option value="24h/d5">24h/d5</option>
                                    <option value="24h/d6">24h/d6</option>
                                    <option value="24h/n6">24h/n6</option>
                                    <option value="24h/d7">24h/d7</option>
                                    <option value="24h/n7">24h/n7</option>
                                    <option value="Septimo">Septimo</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <label for="">HORARIO DE TRABAJO</label>
                        </div>

                        <!-- ********************* -->
                        <div class="form-group   grupotransacciones_agente_horario_desde_transacciones_agente col-md-3">
                            <label for="" class="">Dia Desde</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_horario_desde_transacciones_agente"></i></span>
                                <select class="form-control input-lg input_horario_desde_transacciones_agente" name="editarhorario_desde_transacciones_agente" id="editarhorario_desde_transacciones_agente">
                                    <option value="">Seleccionar Horario Desde</option>
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sábado">Sábado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>


                            </div>
                        </div>
                        <!-- ********************* -->


                        <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-3">
                            <label for="" class="">Dia Hasta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span>

                                <select class="form-control input-lg input_horario_hasta_transacciones_agente" name="editarhorario_hasta_transacciones_agente" id="editarhorario_hasta_transacciones_agente">
                                    <option value="">Seleccionar Horario Desde</option>
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sábado">Sábado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>
                            </div>
                        </div>

                        <!-- ************************ -->
                        <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-2">
                            <label for="" class="">Hora Desde</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span>
                                <input type="text" class="form-control tiempo input-lg" name="editarhora_desde_transacciones_agente" id="editarhora_desde_transacciones_agente">
                            </div>
                        </div>

                        <!-- ************************ -->

                        <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-2">
                            <label for="" class="">Hora Hasta</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span>
                                <input type="text" class="form-control tiempo input-lg" name="editarhora_hasta_transacciones_agente" id="editarhora_hasta_transacciones_agente">
                            </div>
                        </div>

                        <!-- ************************ -->




                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary guardarvacante">Modificar <?php echo $Nombre_del_Modulo ?></button>

                </div>

                <?php

                $editar = new Controladortransacciones_agente();
                $editar->ctrEditar();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrar = new Controladortransacciones_agente();
$borrar->ctrBorrar();

?>