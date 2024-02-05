<?php
date_default_timezone_set('America/El_Salvador');
if ($_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>

<link rel="stylesheet" href="vistas/bower_components/select2-3.5.2/select2.css">
<script src="vistas/bower_components/select2-3.5.2/select2.min.js"></script>
<div class="content-wrapper">

    <style>
        .selectedd {
            background: #C3F3FF !important;
            color: #000;
            font-weight: 700;
            cursor: pointer;
        }

        /* Estilos para el contenedor flotante */
        .floating-button {
            position: fixed;
            bottom: 50%;
            right: 1px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        /* Estilos adicionales para el botón */
        .floating-button .btn {
            margin-bottom: 2px;
        }

        /* Estilo personalizado para limitar el texto y agregar puntos suspensivos */
        .btn-short-text {
            max-width: 7ch;
            /* Limitar a 3 caracteres */
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <section class="content-header">
        <h1>
            Programación de Examenes
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear Examen</li>

        </ol>

    </section>


    <section class="content">

        <div class="box">
            <div class="container-fluid" id="page-container">
                <div class="floating-button">
                    <!-- Botón flotante -->
                    <button type="button" class="btn btn-success btn-sm" title="Nuevo registro" id="AddPoliBtn"><i class="fa fa-plus"></i></button>

                    <!-- Single button -->
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#" data-toggle="modal" data-target="#modalAgregarEvaluado">Evaluados</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modalAgregarClienteMorse">Clientes</a></li>
                            <li><a href="#">Tipo Examen</a></li>
                            <!--    <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="box-header">

                    <div class="col-xs-12 col-sm-3">
                        <label for="selecionarpoligrafista" class="">Seleccione un poligrafista:</label>
                        <select class="form-control mi-selector" style="width: 100%;" id="selecionarpoligrafista" name="selecionarpoligrafista" required>
                            <option value="">Seleccionar un Poligrafista</option>
                            <?php
                            $item = "cargos.descripcion='POLIGRAFIA'";
                            $valor = " order by codigo_empleado desc";
                            $campos = "emp.id as id_empleado,emp.codigo_empleado, CONCAT(emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as nombre_completo,cargos.*";
                            $tabla = "`tbl_empleados` emp INNER JOIN cargos_desempenados cargos on emp.nivel_cargo = cargos.id";
                            $categorias = ModeloLogsUser::mostrarDatosLogs($campos, $tabla, $item, $valor);

                            foreach ($categorias as $key => $value) {
                                echo '<option   value="' . $value["id_empleado"] . '">' . $value["codigo_empleado"] . " - " . $value["nombre_completo"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-xs-12 col-sm-3">
                        <input type="hidden" name="idUserLogs" id="idUserLogs">
                        <label for="fecha_programada_filtro_inicio">Fecha programada inicio:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="date" class="form-control" name="fecha_programada_filtro_inicio" id="fecha_programada_filtro_inicio" placeholder="Fecha Programada" value="<?php echo date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3">
                        <label for="fecha_programada_filtro_fin">Fecha programada final:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="date" class="form-control" name="fecha_programada_filtro_fin" id="fecha_programada_filtro_fin" placeholder="Fecha Programada Fin" value="<?php echo date('Y-m-d') ?>" required>
                        </div>
                        <br>
                    </div>

                    <div class="col-xs-12 col-sm-3">
                        <div class="btn-group pull-right">
                            <div class="btn-group "> <strong>
                                    <i class="fa fa-filter">👈</i>&nbsp;&nbsp;
                                </strong></div>
                            <div class="btn-group">
                                <button class="btn btn-success btn-sm" type="button" title="Programación de Polígrafos" data-toggle="modal" data-target="#registrarPoligrafo">
                                    <i class="fa fa-clock-o"></i> Programar
                                </button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-info btn-clear-search_pol btn-sm" title="Limpiar Filtros" type="button">
                                    <i class="fa fa-eraser"></i> Búsqueda
                                </button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-soundcloud btn-sm" type="button" title="Horario predeterminado" data-toggle="modal" data-target="#detallehorariosprogramados">
                                    <i class="fa fa-clock-o"></i> Horarios
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="alert" role="alert" id="mensajeAlertPrincipal" style="display: none;"></div>

                <table class="table table-bordered table-striped dt-responsive Poligrafista_register" width="100%">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Evaluado</th>
                            <th>Poligrafista</th>
                            <th>Tipo Examen</th>
                            <th>F. Programada</th>
                            <th>H. Programada</th>
                            <th>H. Ingresó</th>
                            <th>H. Inició</th>
                            <th>H. Finalizó</th>
                            <th>EDO</th>
                            <th width="4%">✍</th>
                        </tr>
                    </thead>
                </table>



            </div>
        </div>

        <?php

        require_once "./vistas/modulos/modales/programarexamen.php";
        require_once "./vistas/modulos/modales/clientemorse.php";
        require_once "./vistas/modulos/modales/evaluados.php";

        ?>

</div>

</section>