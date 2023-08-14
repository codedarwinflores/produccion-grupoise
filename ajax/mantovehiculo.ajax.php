<?php

require_once "../modelos/conexion.php";

$valor = $_POST["valor"];


function tblvehiculos($valor1)
{
    $query01 = "SELECT
    vehimante.*,
    tblemp.codigo_empleado,
    tblemp.primer_nombre,
    tblemp.segundo_nombre,
    tblemp.tercer_nombre,
    tblemp.primer_apellido,
    tblemp.segundo_apellido,
    tblemp.apellido_casada,
    repa.codigo_reparacion,
    repa.nombre_reparacion
FROM
    `mante_vehiculo` vehimante
INNER JOIN tbl_empleados tblemp
ON vehimante.idempleado_mvehi=tblemp.id
INNER JOIN reparaciones repa
ON vehimante.idreparacion_mvehi=repa.id
WHERE vehimante.idvehiculo_mante='$valor1' ORDER BY vehimante.fecha DESC";
    $sql = Conexion::conectar()->prepare($query01);
    $sql->execute();
    return $sql->fetchAll();
}



?>

<script>
    $(document).ready(function() {
        $("#examples").DataTable({});
    });
</script>

<table class="table table-bordered table-striped dt-responsive tablas" id="examples" width="100%">
    <thead class="bg-primary">
        <tr>
            <th>Fecha</th>
            <th>Encargado</th>
            <th>Reparación</th>
            <th>Diagnóstico</th>
            <th>Kilometraje</th>
            <th>Valor</th>
            <th>Total</th>
            <th>Fecha Pago</th>
            <th>Fecha Ingreso</th>
            <th>Fecha Salida</th>
            <th>Comentario</th>
            <th>Acciones</th>
        </tr>

    </thead>
    <tbody>
        <?php

        $data01 = tblvehiculos($valor);

        $acumTotal = 0;
        $acumValor = 0;
        foreach ($data01 as $value) {
            $acumTotal += $value["total_mvehi"];
            $acumValor += $value["valor_mvehi"];
            echo ' <tr>
			<td>' . $value["fecha"] . '</td>
			<td>' . $value["codigo_empleado"] . " - " . $value["primer_nombre"] . " " . $value["segundo_nombre"] . " " . $value["tercer_nombre"] . " " . $value["primer_apellido"] . " " . $value["segundo_apellido"] . " " . $value["apellido_casada"] . '</td>
			<td>' . $value["codigo_reparacion"] . " - " . $value["nombre_reparacion"] . '</td>
			<td>' . $value["diagnostico_mvehi"] . '</td>
			<td>' . $value["kilometraje_mvehi"] . '</td>' . '</td>
			<td> $ ' . $value["valor_mvehi"] . '</td>
			<td> $ ' . $value["total_mvehi"] . '</td>
			<td>' . $value["fecha_pago_mvehi"] . '</td>
			<td>' . $value["fecha_ingreso_mvehi"] . '</td>
			<td>' . $value["fecha_salida_mvehi"] . '</td>
			<td>' . $value["comentario_mvehi"] . '</td>';



            echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditartransacciones_agente" idtransacciones_agente="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditartransacciones_agente"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger btnEliminartransacciones_agente" idtransacciones_agente="' . $value["id"] . '"  Codigo="' . $value["id"] . '"><i class="fa fa-times"></i></button>

			  </div>  

			</td>

		  </tr>';
        }


        ?>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                <h5><strong>Totales:</strong></h5>
            </td>
            <td><button class="btn" type="button">
                    <span class="badge">$ <?php echo number_format($acumValor, 2); ?></span>
                </button></td>
            <td><button class="btn" type="button">
                    <span class="badge">$ <?php echo number_format($acumTotal, 2); ?></span>
                </button></td>
            <td colspan="5"></td>
        </tr>
    </tfoot>

</table>