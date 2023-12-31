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


    .fieldset {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    .legend {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
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
                        <h4 class="text-info"><strong>Paso 1: Seleccione un Radio</strong></h4>
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
                                $Radio  = new ConsultasPersonalizadas();
                                $data0 = $Radio::mostrarDatosDb("*", "tbl_radios", "", "");
                                foreach ($data0 as $value) {


                                    // Verificar si la fecha es válida y no está en 0000-00-00
                                    if ($value["fecha_adquisicion"] !== '0000-00-00') {
                                        // Convertir la fecha en un objeto DateTime
                                        $fechaDateTime = new DateTime($value["fecha_adquisicion"]);

                                        // Formatear la fecha en el formato deseado
                                        $fechaFormateada = $fechaDateTime->format("d/m/Y");
                                    } else {
                                        $fechaFormateada = $value["fecha_adquisicion"];
                                    }
                                    echo ' <tr class="campoid" datosradio="' . $value["codigo_radio"] . " - " . $value["descripcion_radio"] . " - " . $value["numero_serie"] . " - " . $value["marca"] . " - " . $value["modelo_radio"] . " - " . $value["color_radio"] . " - " . $fechaFormateada . '" idradio="' . $value["id"] . '" codigo_radio="' . $value["codigo_radio"] . '">
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
                        <h4 class="text-info"><strong>Paso 2: Administrar Mantenimiento Radio</strong></h4>
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

    <div class="modal-dialog" style="width: 1140px !important;">

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
                            <fieldset class="fieldset">
                                <legend class="legend">Agregar Mano de Obra / Repuestos</legend>
                                <div class="form-group col-md-8">
                                    <label for="nuevoid_equipo">Equipos:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>

                                        <select class="form-control mi-selector" name="nuevoid_equipo" id="nuevoid_equipo">

                                            <option value="">Seleccione...</option>
                                            <?php

                                            $datos_mostrar = $Radio::mostrarDatosDb("eq.id,eq.codigo_equipo,eq.descripcion_equipo,eq.descripcion,otro_eq.codigo,otro_eq.nombre", "tbl_otros_equipos eq INNER JOIN tipo_otros_equipos otro_eq on eq.tipo_equipos=otro_eq.id WHERE otro_eq.codigo = 'REPU' OR otro_eq.codigo = 'SERV'", "", "");
                                            foreach ($datos_mostrar as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['id']  ?>">
                                                    <?php echo $value['nombre'] . " - " . $value['codigo_equipo'] . ' - ' . $value['descripcion'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for=""></label>
                                    <div class="input-group">
                                        <button class="btn btn-success" type="button" onclick="add_equipo();"><span class="fa fa-plus"> </span> Agregar Repuesto o Mano de Obra</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-12" id="mensajenuevoequipo">

                                </div>
                                <!-- AGREGAR DETALLE -->
                                <div id="addDetailEquipo">

                                </div>

                            </fieldset>

                        </div>
                        <input type="hidden" id="idmovimientoequipo" name="idmovimientoequipo">
                        <div class="form-group col-md-4">
                            <label for="codubicacion" class="">CÓDIGO UBICACIÓN:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                <input type="text" class=" form-control" name="codubicacion" id="codubicacion" placeholder="Código Ubicación" readonly>

                            </div>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="ubicacionactual" class="">UBICACIÓN ACTUAL:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class=" form-control" name="ubicacionactual" id="ubicacionactual" placeholder="Ubicación Actual" readonly>

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nuevodescripcion" class="">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                                <textarea class=" form-control" name="nuevodescripcion" id="nuevodescripcion" placeholder="Descripción"></textarea>

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

    <div class="modal-dialog" style="width: 1140px !important;">

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
                        <!-- ENTRADA PARA CAMPOS  -->

                        <h4 class="text-primary"><strong><span id="editarname_radio"></span></strong></h4>
                        <input type="hidden" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
                        <input type="hidden" id="editaridradio_mante" name="editaridradio_mante">
                        <div class="form-group col-md-6">
                            <label for="editarfecha_mradio">Fecha:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" class="form-control " name="editarfecha_mradio" id="editarfecha_mradio" placeholder="Ingresar Fecha" autocomplete="off" required="" value="<?php echo date('Y-m-d') ?>">
                            </div>
                        </div>
                        <!-- ********************* -->


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
                            <fieldset class="fieldset">
                                <legend class="legend">Agregar Mano de Obra / Repuestos</legend>
                                <div class="form-group col-md-8">
                                    <label for="editarid_equipo">Equipos:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>

                                        <select class="form-control mi-selector" name="editarid_equipo" id="editarid_equipo">

                                            <option value="">Seleccione...</option>
                                            <?php

                                            $datos_mostrar = $Radio::mostrarDatosDb("eq.id,eq.codigo_equipo,eq.descripcion_equipo,eq.descripcion,otro_eq.codigo,otro_eq.nombre", "tbl_otros_equipos eq INNER JOIN tipo_otros_equipos otro_eq on eq.tipo_equipos=otro_eq.id WHERE otro_eq.codigo = 'REPU' OR otro_eq.codigo = 'SERV'", "", "");
                                            foreach ($datos_mostrar as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['id']  ?>">
                                                    <?php echo $value['nombre'] . " - " . $value['codigo_equipo'] . ' - ' . $value['descripcion'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for=""></label>
                                    <div class="input-group">
                                        <button class="btn btn-success" type="button" onclick="add_equipo_detalle();"><span class="fa fa-plus"> </span> Agregar Repuesto o Mano de Obra</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-12" id="editarmensajenuevoequipo">

                                </div>
                                <!-- AGREGAR DETALLE -->
                                <div id="editarDetailEquipo">

                                </div>

                            </fieldset>

                        </div>
                        <input type="hidden" id="editaridmovimientoequipo" name="editaridmovimientoequipo">
                        <div class="form-group col-md-4">
                            <label for="editarcodubicacion" class="">CÓDIGO UBICACIÓN:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                <input type="text" class=" form-control" name="editarcodubicacion" id="editarcodubicacion" placeholder="Código Ubicación" readonly>

                            </div>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="editarubicacionactual" class="">UBICACIÓN DONDE SE HIZO EL MANTENIMIENTO:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class=" form-control" name="editarubicacionactual" id="editarubicacionactual" placeholder="Ubicación Actual" readonly>

                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="editardescripcion" class="">Descripción:</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                                <textarea class=" form-control" name="editardescripcion" id="editardescripcion" placeholder="Descripción"></textarea>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div id="editarmensajenuevo"></div>
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

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalViewMantenimiento" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 1140px !important;">

        <div class="modal-content">

            <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Ver <?php echo $Nombre_del_Modulo; ?></h4>

            </div>

            <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

            <div class="modal-body">

                <div class="box-body">

                    <!-- ENTRADA PARA CAMPOS  -->


                    <h4 class="text-primary"><strong><span id="viewname_radio"></span></strong></h4>
                    <!-- AGREGAR DETALLE -->
                    <div id="viewMantenimiento">

                    </div>

                </div>
            </div>

            <!--=====================================
        PIE DEL MODAL
        ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



            </div>

        </div>
    </div>

</div>