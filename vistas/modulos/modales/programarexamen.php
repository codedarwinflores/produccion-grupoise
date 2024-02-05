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
                  <input type="hidden" id="generarHorario" name="generarHorario" value="crear">
                  <input type="hidden" id="id_edit_id_registro" name="id_edit_id_registro" value="0">
                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">PROCESAR CITA RESERVADA</h4>

                  </div>
                  <div class="modal-body" style="max-height: calc(100vh - 120px); overflow-y: auto;">
                      <div class="alert" role="alert" id="mensajeAlertExamenProgramadoModal" style="display: none;"></div>
                      <fieldset class="well">
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
                                      <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                                      <input type="text" class="form-control input-lg" readonly required name="tipoexamen_programar" placeholder="Tipo Examen" id="tipoexamen_programar">
                                  </div>
                              </div>
                          </div>

                      </fieldset>

                      <fieldset class="well">
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
                                      <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                      <input type="text" class="form-control input-lg FormatoMoney" required name="precio_programar" placeholder="0.00" id="precio_programar">
                                  </div>
                                  <span id="precioUpdate" class="text-success"></span>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="codigo_programar">CÓDIGO DE REFERENCIA:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                      <input type="text" class="form-control input-lg" readonly required name="codigo_programar" placeholder="Ejemplo: 10212/2023" id="codigo_programar">
                                  </div>
                              </div>
                          </div>

                      </fieldset>


                      <fieldset class="well">
                          <legend>
                              <h5>SOLICITANTE: </h5>
                          </legend>
                          <div class="row">
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
                                      <input type=" date" readonly class="form-control input-lg" name="fecha_sol_programar" id="fecha_sol_programar" placeholder="Fecha solicitud" title="" required>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_hora_programar">HORA SOLICITUD: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                      <input type="time" readonly class="form-control input-lg" required name="sol_hora_programar" placeholder="0.00" id="sol_hora_programar">
                                  </div>
                              </div>

                              <!-- SEGUNDO ROW -->
                              <div class="col-xs-12 col-sm-3">
                                  <label for="sol_cargo_programar">CARGO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                      <input type="text" readonly class="form-control input-lg" required name="sol_cargo_programar" placeholder="Cargo Solicitante" id="sol_cargo_programar">
                                  </div>
                              </div>

                              <div class="col-xs-12 col-sm-6">
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


                              <div class="col-xs-12 col-sm-12">
                                  <label for="sol_entrega_programar">DIRECCIÓN DE ENTREGA:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                      <textarea name="sol_entrega_programar" readonly class="form-control input-lg" id="sol_entrega_programar" placeholder="Dirección de entrega"></textarea>
                                  </div>
                              </div>

                          </div>

                      </fieldset>

                      <fieldset class="well">
                          <legend>
                              <h5>Poligrafista: </h5>
                          </legend>
                          <div class="row">
                              <div class="col-xs-12 col-sm-2">
                                  <button type="button" class="btn btn-primary" id="comenzarExamenHoraInicio"><i class="fa fa-clock-o"></i> Iniciar</button>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                  <label for="hora_ingreso_programar">HORA INGRESÓ: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                      <input type="time" class="form-control input-lg" value="<?php echo date('H:i') ?>" placeholder="Hora Ingresó" name="hora_ingreso_programar" readonly id="hora_ingreso_programar" required>
                                  </div>
                              </div>


                              <div class="col-xs-12 col-sm-3">
                                  <label for="forma_pago">FORMA DE PAGO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                      <select class="form-control input-lg" name="forma_pago" id="forma_pago">
                                          <option value="">Seleccione...</option>
                                          <option value="Credito">1. Crédito</option>
                                          <option value="Contado">2. Contado</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="col-xs-12 col-sm-2">
                                  <label for="porcentaje_cliente">% CLIENTE: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                      <input type="text" class="form-control input-lg FormatoMoney" placeholder="% cliente" name="porcentaje_cliente" id="porcentaje_cliente" min="0" max="100" required>
                                  </div>
                              </div>

                              <div class="col-xs-12 col-sm-2">
                                  <label for="porcentaje_evaluado">% EVALUADO: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                      <input type="text" class="form-control input-lg FormatoMoney" placeholder="% evaluado" name="porcentaje_evaluado" id="porcentaje_evaluado" min="0" max="100" required>
                                  </div>

                              </div>

                              <div class="col-xs-12 col-sm-5">
                                  <label for="format_examenes_programar">FORMATO DE EXAMENES: <i class="fa fa-list-alt"></i></label>

                                  <select class="form-control input-lg mi-selector" name="format_examenes_programar" id="format_examenes_programar">
                                      <option value="0">Seleccione...</option>
                                  </select>


                              </div>

                              <div class="col-xs-12 col-sm-3">
                                  <label for="hora_inicio_programar">HORA INICIÓ: </label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                      <input type="time" class="form-control input-lg" value="<?php echo date('H:i') ?>" placeholder="Hora Inició" name="hora_inicio_programar" readonly id="hora_inicio_programar" required>
                                      <span class="input-group-btn">
                                          <button class="btn btn-success btn-lg" id="btn-generar-preguntas" disabled type="button">¡Gen. Preg.!</button>
                                      </span>
                                  </div>
                              </div>

                              <div class="col-xs-12 col-sm-4">
                                  <label for="resultado_examen">RESULTADO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                      <select class="form-control input-lg" name="resultado_examen" id="resultado_examen">
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
                              <div class="col-xs-12 col-sm-6">
                                  <label for="reserva_observaciones">OBSERVACIONES:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                      <textarea name="reserva_observaciones" class="form-control input-lg" id="reserva_observaciones" placeholder="Observaciones"></textarea>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                  <label for="reserva_objetivo_examen">OBJETIVO DE EXAMEN:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                      <textarea name=" reserva_objetivo_examen" class="form-control input-lg" id="reserva_objetivo_examen" placeholder="Objetivo Examen"></textarea>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-12">
                                  <label for="reserva_concepto_conclusion">CONCEPTO CONCLUSIÓN:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                      <textarea name=" reserva_concepto_conclusion" class="form-control input-lg" id="reserva_concepto_conclusion" placeholder="Concepto Conclusión"></textarea>
                                  </div>
                              </div>
                          </div>

                      </fieldset>

                  </div>
                  <div class="modal-footer">
                      <div class="text-end">
                          <button type="submit" class="btn btn-success bg-green-gradient btn-sm"><i class="fa fa-save"></i> Finalizar</button>
                          <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Registrar Preguntas</button>
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