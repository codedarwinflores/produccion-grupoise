<?php

$condicion = null;

if ($_SESSION["perfil"] != "Administrador") {
    $condicion = "id=" . $_SESSION["id"];
}

$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
if (isset($components['query'])) {
    parse_str($components['query'], $results);
}

$code = "";
$codigo = "";
if (isset($results['cod'])) {

    $code = $results['cod'];
    $codigo = $code;
}


?>
<div class="content-wrapper">

    <section class="content-header">
        <input type="hidden" id="codigoPrueba" value="<?php echo $codigo ?>">
        <h1>

            Historial de Usuarios

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Historial de Usuarios</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-xs-4">
                    <label for="seleccionarUsuario" class="">Selecione un usuario: </label>
                    <select class="form-control mi-selector" id="seleccionarUsuario" name="seleccionarUsuario" required>

                        <option value="">Seleccionar Usuario</option>

                        <?php

                        $item = $condicion;
                        $valor = " order by id desc";
                        $campos = "*";
                        $tabla = "usuarios";
                        $categorias = ModeloLogsUser::mostrarDatosLogs($campos, $tabla, $item, $valor);
                        $codigo = trim($code);


                        foreach ($categorias as $key => $value) {


                            echo '<option selected   value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>

                    </select>

                </div>

                <div class="col-xs-3">
                    <input type="hidden" name="idUserLogs" id="idUserLogs">
                    <label for="fecha_inicio_logs">Fecha Inicio: </label>
                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="date" class="form-control" name="fecha_inicio_logs" id="fecha_inicio_logs" placeholder="Fecha Inicio" value="" required>

                    </div>

                </div>
                <div class="col-xs-3">
                    <label for="fecha_fin_logs">Fecha Fin: </label>
                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="date" class="form-control" name="fecha_fin_logs" id="fecha_fin_logs" placeholder="Fecha Fin" required>

                    </div>
                    <br>
                </div>


            </div>

            <div class="box-body">

                <div id="resultadosUsers">

                </div>

            </div>

        </div>

    </section>

</div>

<!-- Inicio del Modal -->
<div id="MyModalDetailLogs" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3><span>Historial de Actividad</span> <span class="fa fa-history"></span></h3>
            </div>
            <form class="" id="logins_logs_activity" name="logins_logs_activity" autocomplete="off" method="POST" action="#" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Formulario de ingreso de los datos -->


                    <div align="right">
                        <span style="color:red;">*</span> Datos Obligatorios
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#datosinfo">Historial del Usuario</a></li>

                    </ul><br>


                    <div class="tab-content">
                        <div id="datosinf" class="tab-pane fade in active">
                            <div class="col-xs-12">
                                <h4 id="nombreUsuario_" class="text-capitalize"></h4>
                                <hr class="bg-bg-aqua">
                            </div>
                            <div class="col-xs-6">
                                <input type="hidden" name="idUserLogs" id="idUserLogs">
                                <label for="fecha_inicio_act">Fecha Inicio: </label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                    <input type="date" class="form-control input-lg " name="fecha_inicio_act" id="fecha_inicio_act" placeholder="Fecha Inicio" value="" required>

                                </div>

                            </div>
                            <div class="col-xs-6">
                                <label for="fecha_fin_act">Fecha Fin: </label>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                    <input type="date" class="form-control input-lg " name="fecha_fin_act" id="fecha_fin_act" placeholder="Fecha Fin" required>

                                </div>
                                <br>
                            </div>
                            <div id="resultadoslogs">

                            </div>

                        </div>

                    </div>


                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>

                </div>
            </form> <!-- Fin form-->
        </div>
    </div>
</div><!-- Fin modal-->