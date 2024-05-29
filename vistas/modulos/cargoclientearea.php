<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>

<div class="content-wrapper">
    <section class="content">
        <?php include_once "inicio/menumorse.php"; ?>
        <div class="box">
            <div class="row">
                <div class="col-md-4">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCargoCliente">

                                <i class="fa fa-plus"></i> Agregar Cargo Cliente

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertCargoDelete" style="display: none;"></div>
                            <table class="table table-bordered table-striped dt-responsive tbl_cargo_cliente" width="100%">
                                <caption>CARGOS "MORSE"</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th>Nombre Cargo</th>
                                        <th style="width: 14% !important;">✍</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAreaExamen">

                                <i class="fa fa-plus"></i> Agregar Area Examen

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertAreaDelete" style="display: none;"></div>
                            <table class="table table-bordered table-striped dt-responsive tbl_area_examen" width="100%">
                                <caption>AREA DE EXAMENES</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th>COD</th>
                                        <th>Motivo</th>
                                        <th style="width: 14% !important;">✍</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCargoEvaluado">

                                <i class="fa fa-plus"></i> Agregar Cargo Evaluado

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertCargoEvaluadoDelete" style="display: none;"></div>
                            <table class="table table-bordered table-striped dt-responsive tbl_cargo_evaluado" width="100%">
                                <caption>CARGOS "EVALUADOS"</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th>Nombre Cargo</th>
                                        <th style="width: 14% !important;">✍</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
MODAL AGREGAR 
======================================-->
    <?php
    require_once "./vistas/modulos/modales/cargocliente.php";
    ?>
</div>