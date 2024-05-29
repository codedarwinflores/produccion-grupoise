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

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClienteMorse">

                    <i class="fa fa-plus"></i> Agregar Clientes

                </button>

            </div>

            <div class="box-body">

                <div class="alert" role="alert" id="mensajeAlertclientemorsePrincipal" style="display: none;"></div>
                <table class="table table-bordered table-striped dt-responsive ClienteMorse_register" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>ID</th>
                            <th width="4%">✍</th>
                            <th width="4%">EDO</th>
                            <th>COD</th>
                            <th>F. Apertura</th>
                            <th>Nombre</th>
                            <th>Contribuyente</th>
                            <th>NIT</th>
                            <th>NRC</th>
                            <th>Nombre Registro</th>
                            <th>Giro</th>
                            <th>Dirección</th>
                            <th>Tel. 1</th>
                            <th>Tel. 2</th>
                            <th>Fax</th>
                            <th>Contacto</th>
                            <th>Correo</th>
                            <th>Pais</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Otro L. Crédito</th>
                            <th>Otro Plazo</th>
                            <th>Otro Cuenta Contable</th>
                            <th>Otro Categoria</th>
                            <th>Contable contacto</th>
                            <th>Contable Tel. 1</th>
                            <th>Contable Tel. 2</th>
                            <th>Contable Correo</th>
                            <th>Contable Direccion</th>
                            <th>Contratante Nombre representante</th>
                            <th>Contratante Profesión / Oficio</th>
                            <th>Contratante Identificación</th>
                            <th>Contratante Domicilio</th>
                            <th>Contratante Calidad</th>
                            <th>Solicitud Fecha</th>
                            <th>Solicitud Hora</th>
                            <th>Solicitud Nivel Académico</th>
                            <th>Solicitud Nombre </th>
                            <th>Solicitud Apellido</th>
                            <th>Solicitud Cargo</th>
                            <th>Solicitud Correo</th>
                            <th>Solicitud Dirección Entrega</th>
                            <th>Solicitud Tel.</th>
                            <th>Último Evaluado</th>
                            <th>Obsevaciones</th>
                            <th>DUI</th>
                            <th>COMISIÓN</th>
                            <th>NOMBRE VENDEDOR</th>

                        </tr>

                    </thead>
                </table>

            </div>

        </div>

    </section>


    <?php
    require_once "./vistas/modulos/modales/clientemorse.php";
    ?>

</div>