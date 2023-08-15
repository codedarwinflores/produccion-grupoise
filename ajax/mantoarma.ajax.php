<?php

require_once "../modelos/conexion.php";
require_once "../modelos/mante_arma.modelo.php";


if (isset($_GET['editar'])) {

    if (isset($_GET['id'])) {

        $item = "id";
        $valor = $_GET['id'];

        $respuesta = ModeloManteArma::mdlMostrar("mante_arma", $item, $valor);

        echo json_encode($respuesta);
    }
}

if (isset($_POST["valor"])) {
    # code...


    $valor = $_POST["valor"];


    function tblarmas($valor1)
    {
        $query01 = "SELECT
    arma.*,
    tblemp.codigo_empleado,
    tblemp.primer_nombre,
    tblemp.segundo_nombre,
    tblemp.tercer_nombre,
    tblemp.primer_apellido,
    tblemp.segundo_apellido,
    tblemp.apellido_casada,
    taller.codigo_talleres,
    taller.nombre_talleres
FROM
    `mante_arma` arma
INNER JOIN tbl_empleados tblemp
ON arma.idempleado_marma=tblemp.id
INNER JOIN talleres taller
ON arma.id_taller=taller.id
WHERE arma.idarma_mante='$valor1' ORDER BY arma.fecha_marma DESC";
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

            $data01 = tblarmas($valor);

            $acumTotal = 0;
            $acumValor = 0;
            foreach ($data01 as $value) {
                $acumTotal += $value["total_marma"];
                $acumValor += $value["valor_marma"];
                echo ' <tr>
			<td>' . date_format(date_create($value["fecha_marma"]), "d-m-Y") . '</td>
			<td>' . $value["codigo_empleado"] . " - " . $value["primer_nombre"] . " " . $value["segundo_nombre"] . " " . $value["tercer_nombre"] . " " . $value["primer_apellido"] . " " . $value["segundo_apellido"] . " " . $value["apellido_casada"] . '</td>
			<td>' . $value["codigo_talleres"] . " - " . $value["nombre_talleres"] . '</td>
			<td>' . $value["diagnostico_marma"] . '</td>
			<td> $ ' . $value["valor_marma"] . '</td>
			<td> $ ' . $value["total_marma"] . '</td>
			<td>' . date_format(date_create($value["fecha_pago_marma"]), "d-m-Y") . '</td>
			<td>' . date_format(date_create($value["fecha_ingreso_marma"]), "d-m-Y") . '</td>
			<td>' . date_format(date_create($value["fecha_salida_marma"]), "d-m-Y") . '</td>
			<td>' . $value["comentario_marma"] . '</td>';
                echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditarMantenimiento" onclick="editarMantenimientoArma(' . $value["id"] . ')" data-toggle="modal" data-target="#modalEditarMantenimiento"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger" onclick="eliminarMantenimientoArma(' . $value["id"] . ',' . $value["idarma_mante"] . ')"><i class="fa fa-times"></i></button>

			  </div>  

			</td>

		  </tr>';
            }


            ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
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