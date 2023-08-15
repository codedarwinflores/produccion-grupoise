<?php

require_once "../modelos/conexion.php";
require_once "../modelos/mante_bicicleta.modelo.php";


if (isset($_GET['editar'])) {

    if (isset($_GET['id'])) {

        $item = "id";
        $valor = $_GET['id'];

        $respuesta = ModeloManteBicicleta::mdlMostrar("mante_bicicleta", $item, $valor);

        echo json_encode($respuesta);
    }
}

if (isset($_POST["valor"])) {
    # code...


    $valor = $_POST["valor"];


    function tblvehiculos($valor1)
    {
        $query01 = "SELECT
    bici.*,
    tblemp.codigo_empleado,
    tblemp.primer_nombre,
    tblemp.segundo_nombre,
    tblemp.tercer_nombre,
    tblemp.primer_apellido,
    tblemp.segundo_apellido,
    tblemp.apellido_casada,
    repa.codigo_reparacion,
    repa.nombre_reparacion,
    taller.codigo_talleres,
    taller.nombre_talleres
FROM
    `mante_bicicleta` bici
INNER JOIN tbl_empleados tblemp
ON bici.idempleado_mbici=tblemp.id
INNER JOIN reparaciones repa
ON bici.idreparacion_mbici=repa.id
INNER JOIN talleres taller
ON bici.id_taller=taller.id
WHERE bici.idbicicleta_mante='$valor1' ORDER BY bici.fecha DESC";
        $sql = Conexion::conectar()->prepare($query01);
        $sql->execute();
        return $sql->fetchAll();
    }

?>

    <script>
        $(document).ready(function() {
            $("#examples").DataTable({
                "order": [
                    [0, 'dec'],
                    [1, 'dec']
                ]
            });

        });
    </script>

    <table class="table table-bordered table-striped dt-responsive tablas" id="examples" width="100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Encargado</th>
                <th>Reparación</th>
                <th>Taller</th>
                <th>Diagnóstico</th>
                <th>Valor</th>
                <th>Total</th>
                <th>F. Pago</th>
                <th>F. Ingreso</th>
                <th>F. Salida</th>
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
                $acumTotal += $value["total_mbici"];
                $acumValor += $value["valor_mbici"];
                echo ' <tr>
			<td>' . date_format(date_create($value["fecha"]), "d-m-Y") . '</td>
			<td>' . $value["codigo_empleado"] . " - " . $value["primer_nombre"] . " " . $value["segundo_nombre"] . " " . $value["tercer_nombre"] . " " . $value["primer_apellido"] . " " . $value["segundo_apellido"] . " " . $value["apellido_casada"] . '</td>
			<td>' . $value["codigo_reparacion"] . " - " . $value["nombre_reparacion"] . '</td>
			<td>' . $value["codigo_talleres"] . " - " . $value["nombre_talleres"] . '</td>
			<td>' . $value["diagnostico_mbici"] . '</td>
			<td> $ ' . $value["valor_mbici"] . '</td>
			<td> $ ' . $value["total_mbici"] . '</td>
			<td>' . date_format(date_create($value["fecha_pago_mbici"]), "d-m-Y") . '</td>
			<td>' . date_format(date_create($value["fecha_ingreso_mbici"]), "d-m-Y") . '</td>
			<td>' . date_format(date_create($value["fecha_salida_mbici"]), "d-m-Y") . '</td>
			<td>' . $value["comentario_mbici"] . '</td>';
                echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditarMantenimiento" onclick="editarMantenimientoBici(' . $value["id"] . ')" data-toggle="modal" data-target="#modalEditarMantenimiento"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger" onclick="eliminarMantenimientoBici(' . $value["id"] . ',' . $value["idbicicleta_mante"] . ')"><i class="fa fa-times"></i></button>

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

<?php
}
?>