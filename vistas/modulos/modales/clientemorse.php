<link rel="stylesheet" href="./vistas/modulos/modales/style.css">
<style>
    .nav-tabs>li>a {
        background: #3c8dbc;
        border-radius: 0;
        color: white;
        box-shadow: inset 0 -8px 7px -9px rgba(0, 0, 0, .4), -2px -2px 5px -2px rgba(0, 0, 0, .4);
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover {
        background: #f9f9f9;
        box-shadow: inset 0 0 0 0 rgba(0, 0, 0, .4), -2px -3px 5px -2px rgba(0, 0, 0, .4);
    }

    /* Tab Content */
    .tab-pane {
        background: white;
        box-shadow: 0 0 4px rgba(0, 0, 0, .4);
        border-radius: 0;
        padding: 10px;
    }
</style>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarClienteMorse" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" style="width: 98% !important;">

        <div class="modal-content">

            <form role="form" id="form_clientemorse_save" method="post" enctype="multipart/form-data" autocomplete="OFF">
                <input type="hidden" name="save_process_clientemorse" value="ok" id="save_process_clientemorse">
                <input type="hidden" name="id_edit_clientemorse" value="0" id="id_edit_clientemorse">
                <input type="hidden" name="type_action_form" value="save" id="type_action_form">
                <!--=====================================
                            CABEZA DEL MODAL
                        ======================================-->
                <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="editarTitleMorse">Registrar</span> Cliente "Morse"</h4>
                </div>
                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body" style="max-height: calc(100vh - 100px); overflow-y: auto;">

                    <div class="box-body">
                        <div class="alert" role="alert" id="mensajeAlertclientemorse" style="display: none;"></div>
                        <fieldset>
                            <legend>
                                <h5>Información Principal: </h5>
                            </legend>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                    <label for="nombre">Nombre Empresa:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                                        <input type="text" class="form-control input-lg" autofocus name="nombre" id="nombre" placeholder="Nombre Empresa" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <br>


                        <div> <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active">
                                    <a href="#infoGeneral" role="tab" data-toggle="tab">
                                        <icon class="fa fa-info-circle"></icon> DATOS GRALES
                                    </a>
                                </li>
                                <li><a href="#infoOtros" role="tab" data-toggle="tab">
                                        <i class="fa fa-briefcase"></i> OTROS
                                    </a>
                                </li>
                                <li>
                                    <a href="#infoContable" role="tab" data-toggle="tab">
                                        <i class="fa fa-money"></i> CONTABLE
                                    </a>
                                </li>
                                <li>
                                    <a href="#infoContratante" role="tab" data-toggle="tab">
                                        <i class="fa fa-user-plus"></i> CONTRATANTE
                                    </a>
                                </li>
                                <li>
                                    <a href="#infoSolicitud" role="tab" data-toggle="tab">
                                        <i class="fa fa-handshake-o"></i> SOLICITUD
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="infoGeneral">
                                <fieldset>
                                    <legend>
                                        <h5>Información General: </h5>
                                    </legend>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-2">
                                            <label for="general_contribuyente">¿ES CONTRIBUYENTE?:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                                                <select name="general_contribuyente" id="general_contribuyente" class="form-control input-lg">
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <label for="general_nrc">N° DE REGISTRO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-registered"></i></span>
                                                <input type=" text" class="form-control input-lg" name="general_nrc" placeholder="NRC" id="general_nrc">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_nombre_registro">NOMBRE DE REGISTRO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-registered"></i></span>
                                                <input type="text" class="form-control input-lg" name="general_nombre_registro" placeholder="Nombre de Registro" id="general_nombre_registro">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_giro">GIRO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-registered"></i></span>
                                                <input type="text" class="form-control input-lg" name="general_giro" id="general_giro" placeholder="GIRO">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <label for="general_telefono1">TELÉFONO 1:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input type="tel" class="form-control input-lg telefono" name="general_telefono1" id="general_telefono1" placeholder="Teléfono 1">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <label for="general_telefono2">TELÉFONO 2:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input type="tel" class="form-control input-lg telefono" name="general_telefono2" id="general_telefono2" placeholder="Teléfono 2">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-2">
                                            <label for="general_fax">FAX:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                                                <input type="text" class="form-control input-lg" name="general_fax" id="general_fax" placeholder="Fax">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <label for="general_nit">NIT:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                                                <input type="text" class="form-control input-lg nits" name="general_nit" id="general_nit" placeholder="NIT">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_contacto">CONTACTO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="general_contacto" id="general_contacto" placeholder="Contacto">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_correo">CORREO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="text" class="form-control input-lg" name="general_correo" id="general_correo" placeholder="Correo">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_id_pais">PAIS:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                <select class="form-control input-lg selectModal" name="general_id_pais" id="general_id_pais">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_id_departamento">DEPARTAMENTO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                <select class="form-control input-lg" name="general_id_departamento" id="general_id_departamento">


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_id_municipio">MUNICIPIO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                <select class="form-control input-lg" name="general_id_municipio" id="general_id_municipio">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="general_direccion_cliente">DIRECCIÓN:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                <textarea name="general_direccion_cliente" id="general_direccion_cliente" class="form-control input-lg" placeholder="Dirección"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="infoOtros">
                                <fieldset>
                                    <legend>
                                        <h5>Otra información: </h5>
                                    </legend>
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="otro_fecha_apertura">FECHA APERTURA:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="date" class="form-control input-lg" name="otro_fecha_apertura" placeholder="Fecha" id="otro_fecha_apertura">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="otro_limite_credito">LIMITE DE CRÉDITO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                <input type="text" class="form-control input-lg FormatoMoney" name="otro_limite_credito" placeholder="Límite de crédito" id="otro_limite_credito">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="otro_plazo">PLAZO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                <input type="text" class="form-control input-lg" name="otro_plazo" id="otro_plazo" placeholder="Plazo">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <label for="otro_cuenta_contable">CUENTA CONTABLE:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                <input type="text" class="form-control input-lg" name="otro_cuenta_contable" id="otro_cuenta_contable" placeholder="Cuenta contable">
                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <label for="otro_categoria">CATEGORÍA:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                                <select class="form-control input-lg" name="otro_categoria" id="otro_categoria">
                                                    <option value="">Seleccione Categoria</option>
                                                    <option value="Grande">Grande</option>
                                                    <option value="Mediano ">Mediano </option>
                                                    <option value="Pequeño">Pequeño</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="infoContable">
                                <fieldset>
                                    <legend>
                                        <h5>Información contable: </h5>
                                    </legend>
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-6">
                                            <label for="conta_contacto">CONTACTO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="conta_contacto" placeholder="Contacto" id="conta_contacto">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-3">
                                            <label for="conta_telefono1">TELEFONO 1:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input type="tel" class="form-control input-lg telefono" name="conta_telefono1" placeholder="Teléfono 1" id="conta_telefono1">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="conta_telefono2">TELEFONO 2:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input type="tel" class="form-control input-lg telefono" name="conta_telefono2" placeholder="Teléfono 2" id="conta_telefono2">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="conta_correo">CORREO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="email" class="form-control input-lg" name="conta_correo" id="conta_correo" placeholder="Correo">
                                            </div>
                                        </div>



                                        <div class="col-xs-12 col-sm-8">
                                            <label for="conta_direccion">DIRECCIÓN:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-commenting"></i></span>
                                                <textarea name="conta_direccion" class="form-control input-lg" id="conta_direccion" placeholder="Dirección"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="infoContratante">
                                <fieldset>
                                    <legend>
                                        <h5>Información contratante: </h5>
                                    </legend>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label for="contra_nombre_representante">NOMBRE REPRESENTANTE:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="contra_nombre_representante" placeholder="Nombre representante" id="contra_nombre_representante">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-3">
                                            <label for="contra_profesion_oficio">PROFESIÓN / OFICIO</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="contra_profesion_oficio" placeholder="Profesión / Oficio" id="contra_profesion_oficio">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <label for="contra_identifiacion">IDENTIFICACIÓN:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                                                <input type="text" class="form-control input-lg duis" name="contra_identifiacion" placeholder="Identificación" id="contra_identifiacion">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="contra_calidad">CALIDAD:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                                <input type="text" class="form-control input-lg" name="contra_calidad" id="contra_calidad" placeholder="Calidad">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-8">
                                            <label for="contra_domicilio">DOMICILIO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                                <textarea name="contra_domicilio" class="form-control input-lg" id="contra_domicilio" placeholder="Domicilio"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="tab-pane fade" id="infoSolicitud">
                                <fieldset>
                                    <legend>
                                        <h5>Información de solicitud: </h5>
                                    </legend>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-2">
                                            <label for="solicitado_nivel_academico">NIVEL ACADÉMICO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="solicitado_nivel_academico" placeholder="Nivel académico" id="solicitado_nivel_academico">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <label for="solicitado_nombre">NOMBRES:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="solicitado_nombre" placeholder="Nombres" id="solicitado_nombre">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <label for="solicitado_apellido">APELLIDOS:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control input-lg" name="solicitado_apellido" placeholder="Apellidos" id="solicitado_apellido">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <label for="solicitado_telefono">TELÉFONO:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                <input type="tel" class="form-control input-lg telefono" name="solicitado_telefono" id="solicitado_telefono" placeholder="Teléfono">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">
                                                    <label for="solicitado_cargo">CARGO: <i class="fa fa-user"></i></label>
                                                    <input type="text" class="form-control input-lg" name="solicitado_cargo" placeholder="Cargo" id="solicitado_cargo">

                                                </div>

                                                <div class="col-xs-12 col-sm-6">
                                                    <label for="solicitado_correo">CORREO:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input type="email" class="form-control input-lg" name="solicitado_correo" id="solicitado_correo" placeholder="Correo">
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12">
                                                    <label for="solicitado_direccion_entrega">DIRECCIÓN DE ENTREGA:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                                                        <textarea name="solicitado_direccion_entrega" class="form-control input-lg" id="solicitado_direccion_entrega" placeholder="Domicilio"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">


                                            <div class="alert" role="alert" id="mensajeAlertaExamenA" style="display: none;"></div>

                                            <div id="listadoExamenesCliente"></div>
                                            <!-- Loading spinner -->
                                            <div id="loadingSpinnerexamenescliente" class="text-center" style="display: none;">
                                                <i class="fa fa-spinner fa-spin fa-3x"></i>
                                                <p>Loading...</p>
                                            </div>


                                        </div>



                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-2">
                                <label for="estado">ESTADO:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-snowflake-o"></i></span>
                                    <select class="form-control input-lg" name="estado" id="estado">
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4">
                                <label for="id_ultimo_evaluado">ÚLTIMO EVALUADO:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <select class="form-control input-lg" name="id_ultimo_evaluado" readonly id="id_ultimo_evaluado">
                                        <option value="">Seleccione</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <label for="dui_morse">DUI:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                    <input type="text" class="form-control input-lg duis" name="dui_morse" id="dui_morse" placeholder="00000000-0">

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <label for="comision_morse">COMISIÓN:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control input-lg FormatoMoney" placeholder="0.00" name="comision_morse" id="comision_morse">

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <label for="id_vendedor_morse">VENDEDOR: <i class="fa fa-user-md"></i></label>
                                <select class="form-control input-lg mi-selector" name="id_vendedor_morse" id="id_vendedor_morse">
                                    <option value="0">Seleccione</option>
                                </select>

                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <label for="observaciones">OBSERVACIONES:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span>
                                    <textarea name="observaciones" id="observaciones" class="form-control input-lg" placeholder="Obeservaciones"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer bg-gray-light">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Salir</button>
                    <button type="reset" class="btn btn-info pull-left"> <i class="fa fa-eraser"></i>Limpiar </button>
                    <button type="submit" class="btn btn-primary" id="btneclientemoorse"><i class="fa fa-save"></i> Guardar </button>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- AGREGAR PRECIO EXAMEN -->
<div class="modal fade" data-backdrop="static" role="dialog" id="asignacionDeprecioExamen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="#" method="POST" id="form_tipoexamen_precio" autocomplete="off">
                <input type="hidden" name="save_process_addtipoexamen" value="ok" id="save_process_addtipoexamen">
                <input type="hidden" name="id_edit_tipoexam" value="0" id="id_edit_tipoexam">
                <input type="hidden" name="type_action_form" value="save" id="type_action_form">

                <div class="modal-header bg-blue-gradient" style=" color: #fff;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Asignar Precio Examen</h4>
                </div>
                <div class="modal-body">
                    <div class="alert" role="alert" id="mensajeAlertAddTipoExam" style="display: none;"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_tipo_examen_morse" class="control-label">TIPO DE EXAMEN: </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                                    <select name="id_tipo_examen_morse" id="id_tipo_examen_morse" required class="form-control input-lg mi-selector">
                                        <option value="">Seleccione un tipo de examen</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nuevo_precio" class="control-label">NUEVO PRECIO:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control input-lg FormatoMoney" placeholder="Nuevo Precio" name="nuevo_precio" id="nuevo_precio" required>
                                </div>

                            </div>

                        </div>

                    </div><!-- Alerta de Bootstrap para mostrar mensajes -->

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