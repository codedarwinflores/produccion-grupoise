<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>

<style>
    .selectedd {
        background: #C3F3FF !important;
        color: #000;
        font-weight: 700;
        cursor: pointer;
    }

    .no-padding-right {
        padding-right: 0 !important;

    }

    .no-padding-left {
        padding-left: 0 !important;

    }
</style>

<div class="content-wrapper">
    <section class="content">
        <?php include_once "inicio/menumorse.php"; ?>
        <div class="box">
            <div class="row">
                <div class="col-md-6 no-padding-right">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarFormatoExamen">

                                <i class="fa fa-plus"></i> Agregar Formato Examen

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertFormatoExamenDelete" style="display: none;"></div>
                            <table class="table table-bordered table-striped dt-responsive tbl_formato_examen" width="100%">
                                <caption>Formato Examen</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th width="10%">CÓD</th>
                                        <th>TIPO EXAMEN</th>
                                        <th>CLIENTE</th>
                                        <th>CONCEPTO</th>
                                        <th>FECHA</th>
                                        <th>USUARIO</th>
                                        <th width="11%"></th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-padding-left">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary btn-add-FormatoExamen" data-toggle="modal" disabled data-target="#modalFormatoExamenPregunta">

                                <i class="fa fa-plus"></i> Agregar Preguntas al Formato

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertFormatoExamenPreguntaDelete" style="display: none;"></div>
                            <input type="hidden" name="id_formato_examen_pregunta_id" id="id_formato_examen_pregunta_id" value="0">
                            <table class="table table-bordered table-striped dt-responsive tbl_formato_examen_preguntas" width="100%">
                                <caption id="titleformaexamenpreguntas">CONCEPTO</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th width="12%">AREA</th>
                                        <th width="8%">TEST</th>
                                        <th width="8%">ORDEN</th>
                                        <th>PREGUNTA</th>
                                        <th width="8%"></th>
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
    require_once "./vistas/modulos/modales/formatoexamen.php";
    ?>
</div>