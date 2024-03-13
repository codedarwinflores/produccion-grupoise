  <!-- CARGO MODAL -->
  <div class="modal fade" tabindex="-1" data-backdrop="static" id="modalAgregarTipoPregunta">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="#" method="POST" autocomplete="off" id="form_tipo_pregunta">
                  <input type="hidden" name="save_process_tipopregunta" value="ok" id="save_process_tipopregunta">
                  <input type="hidden" name="id_edit_tipopregunta" value="0" id="id_edit_tipopregunta">
                  <input type="hidden" name="type_action_form_tipopregunta" value="save" id="type_action_form_tipopregunta">
                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span id="editartitletipoPregunta">Registrar</span> Tipo Pregunta</h4>

                  </div>
                  <div class="modal-body">

                      <!-- Alerta de Bootstrap para mostrar mensajes -->
                      <div class="alert" role="alert" id="mensajeFormTipoPregunta" style="display: none;"></div>
                      <fieldset>
                          <legend>
                              <h5>Información requerida: </h5>
                          </legend>
                          <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                  <label for="tipo_p_codigo">CÓDIGO:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                      <input ype="text" name="tipo_p_codigo" id="tipo_p_codigo" placeholder="Código" class="form-control input-lg" required>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-12">
                                  <label for="tipo_p_descripcion">TIPO PREGUNTA:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                                      <textarea name="tipo_p_descripcion" id="tipo_p_descripcion" placeholder="Tipo Pregunta" class="form-control input-lg" required></textarea>
                                  </div>
                              </div>
                          </div>
                      </fieldset>
                  </div>
                  <div class="modal-footer">
                      <div class="text-end">

                          <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveedittipopregunta"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- CARGO MODAL -->
  <div class="modal fade" tabindex="-1" data-backdrop="static" id="modalAgregarPregunta">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="#" method="POST" id="form_pregunta">
                  <input type="hidden" name="save_process_pregunta" value="ok" id="save_process_pregunta">
                  <input type="hidden" name="id_edit_pregunta" value="0" id="id_edit_pregunta">
                  <input type="hidden" name="type_action_form_pregunta" value="save" id="type_action_form_pregunta">
                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span id="editartitlepreguntas">Registrar</span> Pregunta</h4>

                  </div>
                  <div class="modal-body">

                      <!-- Alerta de Bootstrap para mostrar mensajes -->
                      <div class="alert" role="alert" id="mensajeFormPregunta" style="display: none;"></div>
                      <fieldset>
                          <legend>
                              <h5>Información requerida: </h5>
                          </legend>
                          <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                  <label for="pregunta_pregunta">PREGUNTA:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-question"></i></span>
                                      <textarea name="pregunta_pregunta" id="pregunta_pregunta" placeholder="Pregunta" class="form-control input-lg" required></textarea>
                                  </div>
                              </div>
                          </div>
                      </fieldset>

                  </div>
                  <div class="modal-footer">
                      <div class="text-end">

                          <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveeditpregunta"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>