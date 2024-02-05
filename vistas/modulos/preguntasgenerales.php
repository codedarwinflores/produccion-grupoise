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

        <div class="box">
            <div class="row">
                <div class="col-md-4 no-padding-right">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoPregunta">

                                <i class="fa fa-plus"></i> Agregar Tipo Pregunta

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertTipoPreguntaDelete" style="display: none;"></div>
                            <table class="table table-bordered table-striped dt-responsive tbl_tipo_pregunta" width="100%">
                                <caption>TIPO DE PREGUNTAS</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th width="10%">CÓD</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 no-padding-left">
                    <div class="box-body">

                        <div class="box-header with-border">

                            <button class="btn btn-primary btn-add-Pregunta" data-toggle="modal" disabled data-target="#modalAgregarPregunta">

                                <i class="fa fa-plus"></i> Agregar Pregunta

                            </button><br>

                        </div>
                        <div class="box-body">
                            <div class="alert" role="alert" id="mensajeAlertPreguntaDelete" style="display: none;"></div>
                            <input type="hidden" name="id_tipo_pregunta_id" id="id_tipo_pregunta_id" value="0">
                            <table class="table table-bordered table-striped dt-responsive tbl_preguntas" width="100%">
                                <caption id="titlepreguntas">PREGUNTAS</caption>
                                <thead>
                                    <tr>
                                        <th width="4%">#</th>
                                        <th>ID</th>
                                        <th width="10%">CORRELATIVO</th>
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
    require_once "./vistas/modulos/modales/preguntageneral.php";
    ?>
</div>