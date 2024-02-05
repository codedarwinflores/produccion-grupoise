  <!-- CARGO MODAL -->
  <div class="modal fade" tabindex="-1" data-backdrop="static" id="modalAgregarCargoCliente">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="#" method="POST" id="form_cargo_cliente">
                  <input type="hidden" name="save_process_cargocliente" value="ok" id="save_process_cargocliente">
                  <input type="hidden" name="id_edit_cargocliente" value="0" id="id_edit_cargocliente">
                  <input type="hidden" name="type_action_form" value="save" id="type_action_form">
                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span id="editartitlecargo">Registrar</span> Cargo</h4>

                  </div>
                  <div class="modal-body">

                      <!-- Alerta de Bootstrap para mostrar mensajes -->
                      <div class="alert" role="alert" id="mensajeFormCargoCliente" style="display: none;"></div>
                      <fieldset>
                          <legend>
                              <h5>Información requerida: </h5>
                          </legend>
                          <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                  <label for="nombre_cargo">Nombre Cargo:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                      <textarea name="nombre_cargo" id="nombre_cargo" placeholder="Ingresar Cargo" class="form-control input-lg" required></textarea>
                                  </div>
                              </div>
                          </div>
                      </fieldset>

                  </div>
                  <div class="modal-footer">
                      <div class="text-end">

                          <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveeditcargocliente"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- CARGO MODAL -->
  <div class="modal fade" tabindex="-1" data-backdrop="static" id="modalAgregarAreaExamen">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="#" method="POST" id="form_area_examen">
                  <input type="hidden" name="save_process_areaexamen" value="ok" id="save_process_areaexamen">
                  <input type="hidden" name="id_edit_areaexamen" value="0" id="id_edit_areaexamen">
                  <input type="hidden" name="type_action_form_areaexamen" value="save" id="type_action_form_areaexamen">
                  <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span id="editartitleareaexamen">Registrar</span> Area Examen</h4>

                  </div>
                  <div class="modal-body">

                      <!-- Alerta de Bootstrap para mostrar mensajes -->
                      <div class="alert" role="alert" id="mensajeFormAreaExamen" style="display: none;"></div>
                      <fieldset>
                          <legend>
                              <h5>Información requerida: </h5>
                          </legend>
                          <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                  <label for="motivo">Motivo:</label>
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                      <textarea name="motivo" id="motivo" placeholder="Motivo" class="form-control input-lg" required></textarea>
                                  </div>
                              </div>
                          </div>
                      </fieldset>

                  </div>
                  <div class="modal-footer">
                      <div class="text-end">

                          <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveeditareaexamen"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>