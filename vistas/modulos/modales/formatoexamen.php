<link rel="stylesheet" href="./vistas/modulos/modales/style.css">
<!-- CARGO MODAL -->
<div class="modal fade" data-backdrop="static" id="modalAgregarFormatoExamen">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST" autocomplete="off" id="form_formato_examen">
                <input type="hidden" name="save_process_formatoexamen" value="ok" id="save_process_formatoexamen">
                <input type="hidden" name="id_edit_formatoexamen" value="0" id="id_edit_formatoexamen">
                <input type="hidden" name="type_action_form_formatoexamen" value="save" id="type_action_form_formatoexamen">
                <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="editartitletipoformatoexamen">Registrar</span> Formato Examen</h4>

                </div>
                <div class="modal-body">

                    <!-- Alerta de Bootstrap para mostrar mensajes -->
                    <div class="alert" role="alert" id="mensajeFormFormatoExamen" style="display: none;"></div>
                    <fieldset>
                        <legend>
                            <h5>Información requerida: </h5>
                        </legend>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <label for="formato_codigo">CÓDIGO:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                    <input ype="text" name="formato_codigo" id="formato_codigo" placeholder="Código" class="form-control input-lg" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12">
                                <label for="formato_id_tipo_examen">TIPO EXAMEN: <i class="fa fa-list-alt"></i></label>
                                <select name="formato_id_tipo_examen" id="formato_id_tipo_examen" class="form-control mi-selector input-lg">
                                    <option value="0">Seleccione</option>
                                </select>

                            </div>

                            <div class="col-xs-12 col-sm-12">
                                <label for="formato_id_cliente_morse">CLIENTE: <i class="fa fa-user-md"></i></label>
                                <select name="formato_id_cliente_morse" id="formato_id_cliente_morse" class="form-control mi-selector input-lg">
                                    <option value="0">Seleccione</option>
                                </select>

                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <label for="formato_concepto">CONCEPTO:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                    <textarea name="formato_concepto" id="formato_concepto" placeholder="Concepto" class="form-control input-lg" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <div class="text-end">

                        <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveeditformatoexamen"><i class="fa fa-pencil-square-o"></i> Registrar</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CREAR Y EDITAR FORMATO DE EXAMEN PREGUNTAS -->
<div class="modal fade" data-backdrop="static" id="modalFormatoExamenPregunta">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST" id="form_formato_examen_pregunta">
                <input type="hidden" name="save_process_formato_examen_pregunta" value="ok" id="save_process_formato_examen_pregunta">
                <input type="hidden" name="id_edit_formato_examen_pregunta" value="0" id="id_edit_formato_examen_pregunta">
                <input type="hidden" name="type_action_formato_examen_pregunta" value="save" id="type_action_formato_examen_pregunta">
                <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="editartitleformato_examen_pregunta">Registrar</span> Pregunta al Formato</h4>
                </div>
                <div class="modal-body" style="width: auto;">

                    <!-- Alerta de Bootstrap para mostrar mensajes -->
                    <div class="alert" role="alert" id="mensajeFormformato_examen_pregunta" style="display: none;"></div>
                    <fieldset>
                        <legend>
                            <h5>Información requerida: </h5>
                        </legend>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <label for="formato_pregunta_area">AREA: <i class="fa fa-list-alt"></i></label>


                                <select name="formato_pregunta_area" id="formato_pregunta_area" class="form-control mi-selector input-lg">
                                    <option value="0">Seleccione</option>
                                </select>

                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <label for="formato_pregunta_test">TEST:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                    <select name="formato_pregunta_test" id="formato_pregunta_test" class="form-control mi-selector input-lg">
                                        <option value="">Seleccione</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <label for="formato_pregunta_orden">ORDEN:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                                    <input type="number" name="formato_pregunta_orden" onkeyup="roundNumber(this);" min="1" value="1" id="formato_pregunta_orden" class="form-control input-lg" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <label for="id_pregunta_formato_examen">PREGUNTAS: <i class="fa fa-question-circle"></i></label>
                                <select name="id_pregunta_formato_examen" id="id_pregunta_formato_examen" class="form-control mi-selector input-lg tamanio" required style="width: 100%">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>

                        </div>
                    </fieldset>

                </div>

                <div class="modal-footer">
                    <div class="text-end">

                        <button type="submit" class="btn btn-success bg-green-gradient btn-sm" id="btn-idsaveeditformatp_examen_pregunta"><i class="fa fa-pencil-square-o"></i> Agregar</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Salir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>