<?php

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

require_once "../modelos/conexion.php";
require_once "../modelos/mante_radio.modelo.php";

if (isset($_POST['equipos'])) {
    if (is_numeric($_POST["equipos"])) {

        $stmt = Conexion::conectar()->prepare("SELECT otro_eq.codigo_equipo,otro_eq.descripcion as descripcionradio,otro_eq.costo_equipo,tipo_otro_eq.codigo FROM tbl_otros_equipos otro_eq INNER JOIN tipo_otros_equipos tipo_otro_eq ON otro_eq.tipo_equipos = tipo_otro_eq.id where otro_eq.id=" . $_POST["equipos"]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $codigo = $row["codigo"];
        $costo_equipo = $row["costo_equipo"];
        $response = array(
            "codigo" => $codigo,
            "costo_equipo" => number_format(floatval($costo_equipo), 2)
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

if (isset($_POST['generar'])) {
    if ($_POST['generar'] == "correlativo") {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT MAX(correlativo_mradio) as maximo FROM `mante_radio`");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastValue = $row['maximo'];
        } else {
            $lastValue = 0;
        }

        // Generar el próximo correlativo
        $newValue = $lastValue + 1;
        $correlativo = str_pad($newValue, 6, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros
        echo $correlativo;
    }
}


if (isset($_GET['editar'])) {

    if (isset($_GET['id'])) {

        $item = "id";
        $valor = $_GET['id'];

        $respuesta = ModeloManteRadio::mdlMostrar("mante_radio", $item, $valor);

        echo json_encode($respuesta);
    }
}

if (isset($_POST["valor"])) {
    # code...


    $valor = $_POST["valor"];


    function tblarmas($valor1)
    {
        $query01 = "SELECT mante_r.*, otro_eq.codigo_equipo,otro_eq.descripcion as descripcionradio,tipo_otro_eq.codigo FROM `mante_radio` mante_r inner JOIN tbl_otros_equipos otro_eq ON mante_r.id_equipo = otro_eq.id INNER JOIN tipo_otros_equipos tipo_otro_eq ON otro_eq.tipo_equipos = tipo_otro_eq.id WHERE mante_r.idradio_mante='$valor1' ORDER BY mante_r.fecha_mradio DESC";
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
                <th>N° Correlativo</th>
                <th>Fecha</th>
                <th>Diagnóstico</th>
                <th>Repuesto / Mano de Obra</th>
                <th>Costo Obra</th>
                <th>Costo Repuesto</th>
                <th>Valor</th>
                <th>Total</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

        </thead>
        <tbody>
            <?php

            $data01 = tblarmas($valor);

            $acumTotal = 0;
            $acumValor = 0;

            $acumCostoObra = 0;
            $acumCostoRepuesto = 0;
            foreach ($data01 as $value) {
                $acumTotal += $value["total_mradio"];
                $acumValor += $value["valor_mradio"];
                $acumCostoObra += $value["costo_obra_mradio"];
                $acumCostoRepuesto += $value["costo_repuesto_mradio"];
                echo ' <tr>

			<td>' . $value["correlativo_mradio"] . '</td>
			<td>' . date_format(date_create($value["fecha_mradio"]), "d-m-Y")  . '</td>
			<td>' . $value["diagnostico_mradio"] . '</td>
            <td>' . $value["codigo"] . " - " . $value["codigo_equipo"] . " - " . $value["descripcionradio"] . '</td>
            <td> $ ' . $value["costo_obra_mradio"] . '</td>
			<td> $ ' . $value["costo_repuesto_mradio"] . '</td>
			<td> $ ' . $value["valor_mradio"] . '</td>
			<td> $ ' . $value["total_mradio"] . '</td>
			<td>' . $value["descripcion"] . '</td>';
                echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditarMantenimiento" onclick="editarMantenimientoRadio(' . $value["id"] . ')" data-toggle="modal" data-target="#modalEditarMantenimiento"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger" onclick="eliminarMantenimientoRadio(' . $value["id"] . ',' . $value["idradio_mante"] . ')"><i class="fa fa-times"></i></button>

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
                        <span class="badge">$ <?php echo number_format($acumCostoObra, 2); ?></span>
                    </button></td>
                <td><button class="btn" type="button">
                        <span class="badge">$ <?php echo number_format($acumCostoRepuesto, 2); ?></span>
                    </button></td>
                <td><button class="btn" type="button">
                        <span class="badge">$ <?php echo number_format($acumValor, 2); ?></span>
                    </button></td>
                <td><button class="btn" type="button">
                        <span class="badge">$ <?php echo number_format($acumTotal, 2); ?></span>
                    </button></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>

    </table>

<?php
}
?>