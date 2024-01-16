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

        /* Agrega estilos personalizados para el botón flotante */
        .floating-button {
            position: fixed;
            bottom: 50%;
            right: 1px;
            z-index: 1000;
            /* Asegura que esté por encima de otros elementos */
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
                <!-- Botón flotante -->
                <button type="button" class="btn btn-success btn-sm floating-button" title="Nuevo registro" id="AddPoliBtn"><i class="fa fa-plus"></i></button>
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
                            <th width="4%"></th>
                        </tr>
                    </thead>
                </table>



            </div>
        </div>


        <!-- Detalle de horarios Modal -->
        <div class="modal fade" tabindex="-1" data-backdrop="static" id="procesarReservaProgramada">
            <div class=" modal-dialog" style="width: 90% !important;">
                <div class="modal-content">
                    <form action="#" method="POST" id="RegistrarProcedimiento">
                        <input type="hidden" id="generarHorario" name="generarHorario" value="crear">
                        <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">PROCESAR CITA RESERVADA</h4>

                        </div>
                        <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                            <div class="alert" role="alert" id="mensajeAlertExamenProgramado" style="display: none;"></div>
                            <fieldset class="breadcrumb">
                                <legend>
                                    <h5>Información Principal: </h5>
                                </legend>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="cliente_programar">CLIENTE:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" autofocus name="cliente_programar" id="cliente_programar" placeholder="Nombre del Cliente" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="evaluado_programar">EVALUADO:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" readonly required name="evaluado_programar" placeholder="Evaluado" id="evaluado_programar">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="poligrafo_programar">POLÍGRAFO:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" readonly required name="poligrafo_programar" placeholder="Polígrafo" id="poligrafo_programar">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="tipoexamen_programar">TIPO EXAMEN:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" readonly required name="tipoexamen_programar" placeholder="Tipo Examen" id="tipoexamen_programar">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <fieldset class="breadcrumb">
                                <legend>
                                    <h5>Datos secundarios: </h5>
                                </legend>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="cargo_programar">CARGO:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" autofocus name="cargo_programar" id="cargo_programar" placeholder="Cargo" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="precio_programar">PRECIO: $</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg FormatoMoney" required name="precio_programar" placeholder="0.00" id="precio_programar">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="codigo_programar">CÓDIGO DE REFERENCIA:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" readonly required name="codigo_programar" placeholder="Ejemplo: 10212/2023" id="codigo_programar">
                                        </div>
                                    </div>
                                </div>

                            </fieldset>


                            <fieldset class="breadcrumb">
                                <legend>
                                    <h5>SOLICITANTE: </h5>
                                </legend>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="sol_nombre_programar">NOMBRE SOLICITANTE:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" required name="sol_nombre_programar" placeholder="Nombre Solicitante" id="sol_nombre_programar">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="sol_apellido_programar">APELLIDO SOLICITANTE:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" required name="sol_apellido_programar" placeholder="Nombre Solicitante" id="sol_apellido_programar">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="fecha_sol_programar">FECHA:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="date" class="form-control input-lg" autofocus name="fecha_sol_programar" id="fecha_sol_programar" placeholder="Fecha solicitud" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="sol_hora_programar">HORA: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="time" class="form-control input-lg" required name="sol_hora_programar" placeholder="0.00" id="sol_hora_programar">
                                        </div>
                                    </div>

                                    <!-- SEGUNDO ROW -->
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="sol_cargo_programar">CARGO:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="text" class="form-control input-lg" required name="sol_cargo_programar" placeholder="Cargo Solicitante" id="sol_cargo_programar">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <label for="sol_correo_programar">CORREO:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="email" class="form-control input-lg" required name="sol_correo_programar" placeholder="Correo Solicitante" id="sol_correo_programar">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-3">
                                        <label for="sol_telefono_programar">TELÉFONO:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="tel" class="form-control input-lg telefono" required name="sol_telefono_programar" placeholder="Teléfono Solicitante" id="sol_telefono_programar">
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12">
                                        <label for="sol_entrega_programar">DIRECCIÓN DE ENTREGA:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <textarea name="sol_entrega_programar" class="form-control input-lg" id="sol_entrega_programar" placeholder="Dirección de entrega"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </fieldset>

                            <fieldset class="breadcrumb">
                                <legend>
                                    <h5>Poligrafista: </h5>
                                </legend>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-2">
                                        <button type="button" class="btn btn-primary" id="comenzarExamen"><i class="fa fa-clock-o"></i> Comenzar</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="hora_ingreso_programar">HORA INGRESÓ: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="time" class="form-control input-lg" value="<?php echo date('H:i') ?>" placeholder="Hora Ingresó" name="hora_ingreso_programar" readonly id="hora_ingreso_programar" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <label for="hora_inicio_programar">HORA INICIÓ:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <input type="time" class="form-control input-lg" readonly value="<?php echo date('H:i') ?>" placeholder="Hora Inició" name="hora_inicio_programar" id="hora_inicio_programar" required>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <label for="format_examenes_programar">FORMATO DE EXAMENES:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                            <select class="form-control input-lg" name="format_examenes_programar" id="format_examenes_programar">
                                                <option value="">Seleccione...</option>
                                                <option value="PREEMP">PRE-Empleo</option>
                                                <option value="Confiabilidad">Confiabilidad</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>


                            <div id="listadoPreguntas"></div>
                            <!-- Loading spinner -->
                            <div id="loadingSpinnerPreguntas" class="text-center" style="display: none;">
                                <i class="fa fa-spinner fa-spin fa-3x"></i>
                                <p>Loading...</p>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Actualizar</button>
                                <button type="button" class="btn btn-success bg-green-gradient btn-sm"><i class="fa fa-plus"></i> Finalizar</button>
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Event RESERVA PROGRAMADA Modal -->

        <!-- Detalle de horarios Modal -->
        <div class="modal fade" tabindex="-1" data-backdrop="static" id="detallehorariosprogramados">
            <div class=" modal-dialog">
                <div class="modal-content">
                    <form action="#" method="POST" id="form-horario">
                        <input type="hidden" id="generarHorario" name="generarHorario" value="crear">
                        <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Horas Programadas</h4>

                        </div>
                        <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hora_inicial" class="control-label">Hora Inicial: </label>
                                        <input type="time" class="form-control" value="07:00" placeholder="Hora Inicial" name="hora_inicial" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hora_final" class="control-label">Hora Final:</label>
                                        <input type="time" class="form-control" value="16:00" placeholder="Hora Final" name="hora_final" required>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_datetime" class="control-label">Intérvalo del tiempo:</label>
                                        <select name="intervalo" id="" class="form-control" required>
                                            <option value="">Seleccione un intervalo</option>
                                            <option value="15">15 Minutos</option>
                                            <option value="20">20 Minutos</option>
                                            <option value="30">30 Minutos</option>
                                            <option value="40">40 Minutos</option>
                                            <option value="45">45 Minutos</option>
                                            <option value="60">1 Hora</option>
                                            <option value="120">2 Horas</option>
                                        </select>
                                    </div>

                                </div>

                            </div><!-- Alerta de Bootstrap para mostrar mensajes -->
                            <div class="alert" role="alert" id="mensajeAlerta" style="display: none;"></div>

                            <div id="listadoHorario"></div>
                            <!-- Loading spinner -->
                            <div id="loadingSpinner" class="text-center" style="display: none;">
                                <i class="fa fa-spinner fa-spin fa-3x"></i>
                                <p>Loading...</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Auto-Generar Horarios</button>
                                <button type="button" class="btn btn-success bg-green-gradient btn-sm" data-toggle="modal" data-target="#saveedit"><i class="fa fa-plus"></i> Nuevo Intérvalo</button>
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Event Details Modal -->

        <!-- Detalle de horarios Modal -->
        <div class="modal fade" tabindex="-1" data-backdrop="static" id="saveedit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="#" method="POST" id="form-intervalo-horas">
                        <input type="hidden" id="form-intervalo" name="form-intervalo" value="add">
                        <input type="hidden" id="id_intervalo" name="id_intervalo" value="0">
                        <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Hora programada - <span id="title-intervalo">Registrar</span></h4>

                        </div>
                        <div class="modal-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hora_inicial" class="control-label">Hora inicial: </label>
                                        <input type="time" class="form-control" placeholder="Hora Inicial" name="hora_inicial" id="hora_inicial" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hora_final" class="control-label">Hora final:</label>
                                        <input type="time" class="form-control" placeholder="Hora Final" name="hora_final" id="hora_final" required>
                                    </div>

                                </div>

                            </div><!-- Alerta de Bootstrap para mostrar mensajes -->
                            <div class="alert" role="alert" id="mensajeAlertaform" style="display: none;"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-end">

                                <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveedit"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Detalle de horarios Modal -->
        <div class="modal fade" tabindex="-1" data-backdrop="static" id="registrarPoligrafo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="#" method="POST" id="form_poligrafo_register">
                        <input type="hidden" name="_form_process" required value="procesar">
                        <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Programación de Polígrafos</h4>

                        </div>
                        <div class="modal-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Cant. polígrafos: </label>
                                        <input type="number" onkeyup="roundNumber(this);" class="form-control" name="cantPoligrafos" id="cantPoligrafos" min="1" value="1" placeholder="Cantidad de Polígrafos" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_datetime" class="control-label">Fecha a programar:</label>
                                        <input type="date" class="form-control" name="start_datetime" id="start_datetime" required value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <label for="horariopredeterminado" class="control-label">Aplicar horario predeterminado: </label>
                                <input type="checkbox" name="horariopredeterminado" id="horariopredeterminado">
                            </div>
                            <!-- Alerta de Bootstrap para mostrar mensajes -->
                            <div class="alert" role="alert" id="mensajeFormPoligrafo" style="display: none;"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-end">

                                <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveedit"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>

</section>