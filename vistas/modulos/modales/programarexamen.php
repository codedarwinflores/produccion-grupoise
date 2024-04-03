  <style>
      /* Estilo para el modal fullscreen en Bootstrap 3 */
      .modal-full {
          min-width: 100% !important;
          margin: 0;

      }

      .modal-full .modal-content {
          min-height: 100vh;
      }

      /* Estilos que se aplicarán al contenido del modal cuando se abra */
      body.modal-open #procesarReservaProgramada {
          padding-left: 0px !important;
      }
  </style>
  <!-- Detalle de horarios Modal -->
  <div class="modal fade" data-backdrop=" static" id="procesarReservaProgramada">
      <div class=" modal-dialog modal-full">
          <div class=" modal-content">
              <form action="#" method="POST" id="RegistrarProcedimientoReserva" autocomplete="off">
                  <input type="hidden" id="fecha_programada" name="fecha_programada">
                  <input type="hidden" id="perfil_usuario_id" name="perfil_usuario_id" value="<?= $_SESSION['perfil'] ?>">
                  <input type="hidden" id="estado_exam" name="estado_exam">
                  <input type="hidden" id="id_edit_id_registro" name="id_edit_id_registro" value="0">
                  <input type="hidden" id="id_encriptado_value" name=" id_encriptado_value" value="0">
                  <input type="hidden" class="form-control FormatoMoney input-lg" placeholder="0.00" id="precio_programar">

                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close CerrarModal" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">PROCESAR CITA RESERVADA <span id="titleFecha"></span></h4>

                  </div>
                  <div class="modal-body" style="max-height: calc(100vh - 120px); overflow-y: auto;">
                      <div class="alert" role="alert" id="mensajeAlertExamenProgramadoModal" style="display: none;position: fixed;z-index: 999;right: 1%;top:6%"></div>


                      <div class="row">
                          <div class="col-xs-12 col-sm-6">

                              <div class="table-responsive">
                                  <table class="table table-bordered table-condensed table-striped table-hover">
                                      <thead class="bg-maroon-gradient">
                                          <tr>
                                              <th colspan="2">Información Principal</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th style="width: 20%; text-align: right;">CLIENTE: </th>
                                              <td>
                                                  <p id="cliente_programar"></p>
                                              </td>
                                          </tr>
                                          <tr>
                                              <th style="text-align: right;">EVALUADO: </th>
                                              <td>
                                                  <table width="100%">
                                                      <tr>
                                                          <td style="width: 60%;">
                                                              <p id="evaluado_programar">Nombre</p>
                                                          </td>
                                                          <td><img src="https://cdn.icon-icons.com/icons2/69/PNG/128/user_customer_person_13976.png" id="myFoto" width="20%" class="img-thumbnail" alt="Fotografía" title="Fotografía"></td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>

                                          <tr>
                                              <th style="text-align: right;">POLÍGRAFO: </th>
                                              <td>
                                                  <p id="poligrafo_programar"></p>
                                              </td>
                                          </tr>
                                          <tr>
                                              <th style="text-align: right;">TIPO EXAMEN: </th>
                                              <td>
                                                  <p id="tipoexamen_programar"></p>
                                              </td>
                                          </tr>

                                          <!-- Agrega más filas según sea necesario -->
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-6">

                              <div class="table-responsive">
                                  <table class="table table-bordered table-condensed table-striped table-hover">
                                      <thead class="bg-maroon-gradient">
                                          <tr>
                                              <th colspan="2">Información Secundaria</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th style="width: 30%; text-align: right;">CODIGO DE REFERENCIA: </th>
                                              <td>
                                                  <p id="codigo_programar"></p>
                                              </td>
                                          </tr>
                                          <tr>
                                              <th style="text-align: right;">CARGO: </th>
                                              <td>
                                                  <p id="cargo_programar"></p>
                                              </td>
                                          </tr>

                                          <tr>
                                              <!-- <th style="text-align: right;">PRECIO A PAGAR: $</th> -->
                                              <!--    <td>
                                                  <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                      <input type="text" class="form-control FormatoMoney input-lg camposaveinput" data-campo="precio_examen" required name="precio_programar" placeholder="0.00" id="precio_programar">
                                                  </div>
                                                  <span id="precioUpdate" class="text-white"></span>
                                              </td> -->
                                          </tr>
                                          <tr>
                                              <th style="text-align: right;">FECHA Y HORA PROGRAMADA: </th>
                                              <td>
                                                  <p id="fecha_y_hora_programada"></p>
                                              </td>
                                          </tr>
                                          <tr>
                                              <th style="text-align: right;">ESTADO: </th>
                                              <td>
                                                  <p id="estado_examen_actual"></p>
                                              </td>
                                          </tr>
                                          <!-- Agrega más filas según sea necesario -->
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>

                      <fieldset class="well">
                          <legend>
                              <h5>SOLICITANTE: </h5>
                          </legend>
                          <div class="row">
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_nivel_academico">NIVEL ACADÉMICO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                      <input type="text" readonly class="form-control input-lg" required name="sol_nivel_academico" placeholder="Nivel Académico" id="sol_nivel_academico">
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_nombre_programar">NOMBRE SOLICITANTE:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                      <input type="text" readonly class="form-control input-lg" required name="sol_nombre_programar" placeholder="Nombre Solicitante" id="sol_nombre_programar">
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_apellido_programar">APELLIDO SOLICITANTE:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                      <input type="text" readonly class="form-control input-lg" required name="sol_apellido_programar" placeholder="Nombre Solicitante" id="sol_apellido_programar">
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="fecha_sol_programar">FECHA SOLICITUD:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                      <input type="date" class="form-control input-lg camposaveinput" data-campo="fecha_solicitud_re" name=" fecha_sol_programar" id="fecha_sol_programar" placeholder="Fecha solicitud" title="" required>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_hora_programar">HORA SOLICITUD: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                      <input type="time" class="form-control input-lg camposaveinput" data-campo="hora_solicitud_re" required name="sol_hora_programar" placeholder="0.00" id="sol_hora_programar">
                                  </div>
                              </div>

                              <!-- SEGUNDO ROW -->
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_cargo_programar">CARGO: <i class="fa fa-user-md"></i></label>
                                  <select name="sol_cargo_programar" id="sol_cargo_programar" class="form-control input-lg mi-selector" required>
                                      <option value="0">Seleccione Cargo</option>
                                  </select>

                              </div>

                              <div class=" col-xs-12 col-sm-3">
                                  <label for="sol_correo_programar">CORREO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                      <input type="email" readonly class="form-control input-lg" required name="sol_correo_programar" placeholder="Correo Solicitante" id="sol_correo_programar">
                                  </div>
                              </div>

                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_telefono_programar">TELÉFONO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                      <input type="tel" readonly class="form-control input-lg telefono" required name="sol_telefono_programar" placeholder="Teléfono Solicitante" id="sol_telefono_programar">
                                  </div>
                              </div>

                              <div class="col-xs-12 col-sm-3">
                                  <br>
                                  <button type="button" class="btn btn-primary bg-black-gradient" id="comenzarExamenHoraInicio"><i class="fa fa-clock-o"></i> Reg. Ingreso</button>
                              </div>

                              <div class="col-xs-12 col-sm-3">
                                  <label for="hora_ingreso_programar">HORA INGRESÓ: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                      <input type="time" class="form-control input-lg" value="<?php echo date('H:i') ?>" placeholder="Hora Ingresó" name="hora_ingreso_programar" readonly id="hora_ingreso_programar" required>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                  <label for="sol_entrega_programar">DIRECCIÓN DE ENTREGA:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                      <textarea name="sol_entrega_programar" readonly class="form-control input-lg" id="sol_entrega_programar" placeholder="Dirección de entrega"></textarea>
                                  </div>
                              </div>

                          </div>
                      </fieldset>
                      <div id="ocultarForm">
                          <fieldset class="well">
                              <legend>
                                  <h5>Poligrafista: </h5>
                              </legend>
                              <div class="row">
                                  <div class="col-xs-12 col-sm-2">

                                      <button type="button" class="btn btn-primary bg-blue-gradient" disabled id="comenzarExamenHoraInicioEmpezar"><i class="fa fa-clock-o"></i> Empezar</button>
                                  </div>

                                  <div class="col-xs-12 col-sm-3">
                                      <label for="forma_pago">FORMA DE PAGO:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                          <select class="form-control input-lg camposaveinput" disabled data-campo="forma_pago" name="forma_pago" id="forma_pago">
                                              <option value="">Seleccione...</option>
                                              <option value="Credito">1. Crédito</option>
                                              <option value="Contado">2. Contado</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-xs-12 col-sm-3">
                                      <label for="porcentaje_cliente">% CLIENTE: </label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                          <input type="text" class="form-control input-lg FormatoMoney camposaveinput" data-campo="porcentaje_cliente" placeholder="% cliente" name="porcentaje_cliente" id="porcentaje_cliente" min="0" max="100" disabled required>
                                      </div>
                                  </div>

                                  <div class="col-xs-12 col-sm-4">
                                      <label for="porcentaje_evaluado">% EVALUADO: </label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                          <input type="text" disabled class="form-control input-lg FormatoMoney camposaveinput" data-campo="porcentaje_evaluado" placeholder="% evaluado" name="porcentaje_evaluado" id="porcentaje_evaluado" min="0" max="100" required>
                                      </div>

                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12 col-sm-5">
                                      <label for="format_examenes_programar">FORMATO DE EXAMENES: <i class="fa fa-list-alt"></i></label>
                                      <div class="input-group">
                                          <span class="input-group-btn">
                                              <button class="btn btn-success btn-lg" id="btn-generar-preguntas" disabled type="button">¡Gen. Preg.!</button>
                                          </span>
                                          <select class="form-control input-lg mi-selector" name="format_examenes_programar" id="format_examenes_programar">
                                              <option value="0">Seleccione...</option>
                                          </select>

                                      </div>
                                  </div>

                                  <div class="col-xs-12 col-sm-3">
                                      <label for="hora_inicio_programar">HORA INICIÓ: </label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                          <input type="time" class="form-control input-lg" value="<?php echo date('H:i') ?>" placeholder="Hora Inició" name="hora_inicio_programar" disabled id="hora_inicio_programar" required>
                                      </div>
                                  </div>

                                  <div class="col-xs-12 col-sm-4">
                                      <label for="resultado_examen">RESULTADO:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                          <select class="form-control input-lg camposaveinput" disabled data-campo="resultado_final_examen" name="resultado_examen" id="resultado_examen">
                                              <option value="">Seleccione...</option>
                                              <option value="Confiable">Confiable</option>
                                              <option value="No Confiable">No Confiable</option>
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
                          <!-- DEMÁS CAMPOS -->
                          <fieldset class="well">
                              <legend>
                                  <h5>Observaciones: </h5>
                              </legend>
                              <div class="row">
                                  <div class="col-xs-12 col-sm-12">
                                      <label for="reserva_observaciones">OBSERVACIONES:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                          <textarea name="reserva_observaciones" class="form-control input-lg camposaveinput" disabled data-campo="observaciones_examen" id="reserva_observaciones" placeholder="Observaciones" rows="10"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6">
                                      <label for="reserva_objetivo_examen">OBJETIVO DE EXAMEN:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                          <textarea name=" reserva_objetivo_examen" class="form-control input-lg camposaveinput" disabled data-campo="objetivo_examen" id="reserva_objetivo_examen" placeholder="Objetivo Examen" rows="10"></textarea>
                                      </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6">
                                      <label for="reserva_concepto_conclusion">CONCEPTO CONCLUSIÓN:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                          <textarea name=" reserva_concepto_conclusion" class="form-control input-lg camposaveinput" disabled data-campo="conclusion_examen" id="reserva_concepto_conclusion" placeholder="Concepto Conclusión" rows="10"></textarea>
                                      </div>
                                  </div>
                              </div>

                          </fieldset>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <div class="text-end">
                          <button type="button" class="btn btn-info bg-info-gradient btn-sm btnImprimir" data-toggle="modal" data-target="#ModalImprimirView"><i class="fa fa-print"></i> Imprimir</button>
                          <button type="button" class="btn btn-success bg-green-gradient btn-sm btn-guardar-cambios-examen"><i class="fa fa-save"></i> Finalizar</button>
                          <button type="button" class="btn btn-primary btn-sm btn-registrar-pregunta-poligrafo" data-toggle="modal" data-target="#cuestionarioPreguntaAdd" disabled><i class="fa fa-plus"></i> Registrar Preguntas</button>
                          <button type="button" class="btn btn-default btn-sm CerrarModal" data-dismiss="modal">Salir <i class="fa fa-sign-out"></i>
                          </button>
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
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
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
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
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
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>



  <!-- CREAR Y EDITAR FORMATO DE EXAMEN PREGUNTAS -->
  <div class="modal fade" data-backdrop="static" id="cuestionarioPreguntaAdd">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="#" method="POST" id="addCuestionarioPregunta">
                  <input type="hidden" name="save_process_addPreguntaCuestionario" id="save_process_addPreguntaCuestionario" value="ok">
                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span id="editartitleformato_examen_pregunta">Agregar</span> Pregunta al Cuestionario</h4>
                  </div>
                  <div class="modal-body" style="width: auto;">

                      <!-- Alerta de Bootstrap para mostrar mensajes -->
                      <div class="alert" role="alert" id="mensajeFormaddCuestionarioPregunta" style="display: none;"></div>
                      <fieldset>
                          <legend>
                              <h5>Información requerida: </h5>
                          </legend>

                          <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                  <label for="id_tipo_preguntas_cuestionario">TIPO DE PREGUNTAS: <i class="fa fa-question-circle"></i></label>
                                  <select name="id_tipo_preguntas_cuestionario" id="id_tipo_preguntas_cuestionario" class="form-control mi-selector input-lg tamanio" required style="width: 100%">
                                      <option value="">Seleccione</option>
                                  </select>
                              </div>

                              <div class="col-xs-12 col-sm-12">
                                  <label for="nueva_pregunta_cuestionario">NUEVA PREGUNTA:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-question"></i></span>
                                      <textarea name="nueva_pregunta_cuestionario" id="nueva_pregunta_cuestionario" placeholder="Agregar Nueva Pregunta" class="form-control input-lg" required></textarea>
                                  </div>
                              </div>

                          </div>
                      </fieldset>

                  </div>

                  <div class="modal-footer">
                      <div class="text-end">
                          <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-addCuestionarioPregunta"><i class="fa fa-pencil-square-o"></i> Agregar</button>
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>



  <!-- CREAR Y EDITAR FORMATO DE EXAMEN PREGUNTAS -->
  <div class="modal fade" data-backdrop="static" id="ModalImprimirView">
      <div class="modal-dialog">
          <div class="modal-content">
              <input type="hidden" id="id_encriptado_input" name="id_encriptado_input">
              <div class="modal-header bg-navy" style=" color: #fff;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">IMPRIMIR</h4>
              </div>
              <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                  <fieldset>
                      <legend>
                          <h5>Selecciona el el tipo de pregunta que no quieres que aparezca en el reporte.</h5>
                      </legend>

                      <div class="row">
                          <div class="col-xs-12 col-sm-12">
                              <label for="id_tipo_preguntas_cuestionario">TIPO DE PREGUNTAS QUE NO DESEA IMPRIMIR: <i class="fa fa-question-circle"></i></label>
                              <select name="valores[]" multiple id="valores" class="form-control mi-selector input-lg tamanio" required style="width: 100%">

                              </select>
                          </div>
                      </div>
                  </fieldset>

              </div>

              <div class="modal-footer">
                  <div class="text-end">
                      <button type="button" class="btn btn-success bg-green-gradient btn-sm btnImprimirModalView" id="btn-Imprimir"><i class="fa fa-print"></i> Imprimir</button>
                      <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                  </div>
              </div>

          </div>
      </div>
  </div>