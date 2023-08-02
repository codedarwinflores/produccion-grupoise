<table class="table table-bordered table-striped dt-responsive examples<?php echo $cont ?>" width="100%">

    <thead class="bg-info">
        <tr>
            <th>No.</th>
            <th>Estado</th>
            <th>Report Arma</th>
            <th>NOMBRE</th>
            <th>SUELDO</th>
            <th width="200">TRANSP.</th>
            <th>U. ESP.</th>
            <th width="150">F.INGRESO</th>
            <th width="150">F.CONT.</th>
            <th width="150">F.RETIRO</th>
            <th width="200">UBICACION</th>
            <th>F. UBICACION</th>
            <th>D.U.I.</th>
            <th>NUP</th>
            <th>AFP</th>
            <th>TIPO DE EMPLEADO</th>
            <th>EDAD</th>
            <th>NACIMIENTO</th>
            <th>ISSS</th>
            <th>NIT</th>
            <th>BANCO</th>
            <th>CUENTA</th>
            <th>MOTIVO</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $empleadoBuscar = new ModeloEmpleados();
        $empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);
        $contEmp = 0;
        $badge = "dark";
        foreach ($empleados as $key => $value) {
            $contEmp++;
            //REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
            if ($value["estado"] == 1) {
                $nombreEstado = "Solicitud";
                $badge = "dark";
            } else if ($value["estado"] == 2) {
                $nombreEstado = "Contratado";
                $badge = "success";
            } else if ($value["estado"] == 3) {
                $nombreEstado = "Inactivo";
                $badge = "danger";
            } else if ($value["estado"] == 4) {
                $nombreEstado = "Incapacitado";
                $badge = "warning";
            } else {
                $nombreEstado = "Error";
                $badge = "defaul";
            }

            $ubicacionEmpleado = ubicacion_empleado($value["codigo_empleado"]);

        ?>
            <tr>
                <th><?php echo $value["codigo_empleado"] ?></th>
                <td><label class="badge btn-<?php echo $badge ?>"><?php echo $nombreEstado ?></label></td>
                <td><?php echo $value["reportado_a_pnc"] ?></td>
                <td><?php echo $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"] . "Uniforme" ?></td>
                <td><?php echo $value["sueldo_que_devenga"] ?></td>
                <td><?php echo "Info_devengo"; ?></td>
                <td><?php echo "Bono Unidad" ?></td>
                <td><?php echo $value["fecha_ingreso"] ?></td>
                <td><?php echo $value["fecha_contratacion"] ?></td>
                <td>F.RETIRO</td>
                <td><?php echo $ubicacionEmpleado['ubicaciont']; ?></td>
                <td><?php echo $ubicacionEmpleado['fechat']; ?></td>
                <td><?php echo $value["numero_documento_identidad"] ?></td>
                <td><?php echo $value["nup"] ?></td>
                <td><?php echo $value["codigo_afp"] ?></td>
                <td><?php echo $value["descripcion"] ?></td>
                <td><?php echo edad($value["fecha_nacimiento"]) ?></td>
                <td><?php echo $value["fecha_nacimiento"] ?></td>
                <td><?php echo $value["numero_isss"] ?></td>
                <td><?php echo $value["nit"] ?></td>
                <td><?php echo $value["codigo_bank"] . "-" . $value["nombre_bank"] ?></td>
                <td><?php echo $value["numero_cuenta"] ?></td>
                <td>************</td>
            </tr>

        <?php




            /* ******* */
        }



        ?>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                <h5><strong>Cantidad de Empleados:</strong></h5>
            </td>
            <td><button class="btn btn-primary" type="button">
                    <span class="badge"><?php echo $contEmp ?></span>
                </button></td>
            <td colspan="19"></td>
        </tr>
    </tfoot>

</table>

<script>
    $(document).ready(function() {
        $('.examples<?php echo $cont ?>').DataTable({
            "order": [
                [2, "asc"]
            ],
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        });
    });
</script>