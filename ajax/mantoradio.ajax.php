<?php


require_once "../modelos/conexion.php";
require_once "../modelos/mante_radio.modelo.php";

if (isset($_POST["addDetail"])) {
?>

    <script>
        $(document).ready(function() {
            // Aplica la máscara de entrada al campo de entrada numérica
            Inputmask({
                alias: 'numeric',
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                placeholder: '0',
                prefix: '$ '
            }).mask('.validarMoney');
        });
    </script>

    <?php
    $i = 0;
    ?>
    <table class="table table-bordered table-striped dt-responsive" width="100%">
        <caption class="label-default text-center"><strong>REPUESTOS</strong></caption>
        <thead>
            <th width="6">N°</th>
            <th>Nombre del Equipo</th>
            <th width="18%">Cantidad</th>
            <th width="20%">Costo Repuesto</th>
            <th>Valor</th>
            <th width="10">Acciones</th>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>Descripción
                    <textarea placeholder="Agrega una descripción" id="" class="form-control"></textarea>
                </td>
                <td> <!-- Quantity -->
                    <div>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button title="Retroceder" onclick="sumar_restar('-',<?php echo $i ?>);" type="button" class=" btn btn-default">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>

                            <input min="1" style="text-align:center;min-width:20px;" onkeyup="roundNumber(this);" placeholder="0" type="number" id="cantidad_<?php echo $i ?>" class="form-control" value="1">

                            <span class="input-group-btn">
                                <!-- ngIf: item.qtyStatus == false -->
                                <button title="Avanzar" onclick="sumar_restar('+',<?php echo $i ?>);" type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>

                        </div>
                    </div>
                    <!-- /Quantity -->
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="text" class="form-control validarMoney" readonly min="0" required placeholder="0.00" name="nuevovalor_mradio" id="nuevovalor_mradio">

                    </div>
                </td>
                <td>Subtotal</td>
                <td><button type="button" class="btn btn-danger"> <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>

            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>Total: </strong></td>
                <td>$ </td>
            </tr>
        </tbody>
    </table>
    <?php
    $i++;

    ?>
    <table class="table table-bordered table-striped dt-responsive" width="100%">
        <caption class="label-default text-center"><strong>MANO DE OBRA</strong></caption>
        <thead>
            <th width="6">N°</th>
            <th>Nombre del Equipo</th>
            <th width="18%">Cantidad</th>
            <th width="20%">Costo Mano Obra</th>
            <th>Valor</th>
            <th width="10">Acciones</th>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>Descripción
                    <textarea placeholder="Agrega una descripción" id="" class="form-control"></textarea>
                </td>
                <td> <!-- Quantity -->
                    <div>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button title="Retroceder" onclick="sumar_restar('-',<?php echo $i; ?>);" type="button" class=" btn btn-default">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>

                            <input min="1" style="text-align:center;min-width:20px;" onkeyup="roundNumber(this);" placeholder="0" type="number" id="cantidad_<?php echo $i ?>" data-id="<?php echo $i; ?>" class="operar_detalle form-control" value="1">

                            <span class="input-group-btn">
                                <!-- ngIf: item.qtyStatus == false -->
                                <button title="Avanzar" onclick="sumar_restar('+',<?php echo $i; ?>);" type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>

                        </div>
                    </div>
                    <!-- /Quantity -->
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <input type="text" class="form-control validarMoney" min="0" readonly placeholder="0.00" name="nuevovalor_mradio" id="nuevovalor_mradio">

                    </div>
                </td>
                <td>Subtotal</td>
                <td><button type="button" class="btn btn-danger"> <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>Total: </strong></td>
                <td>$ </td>
            </tr>
        </tbody>
    </table>


<?php
}

/* BUSCRA UBICACIÓN RADIO */
if (isset($_POST["radiosearch"])) {
    if ($_POST["radiosearch"] === "nuevo") {
        if (isset($_POST["codRadio"])) {
            $stmt = Conexion::conectar()->prepare("SELECT moveq.*, clientubi.codigo_ubicacion, clientubi.nombre_ubicacion FROM `movimientosequipos` moveq INNER JOIN tbl_clientes_ubicaciones clientubi on moveq.id_ubicacion_movimiento = clientubi.id where moveq.codigo_equipo ='" . $_POST["codRadio"] . "'");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $id = $row["id"];
                $codigo = $row["codigo_ubicacion"];
                $nombre_ubicacion = $row["nombre_ubicacion"];
                $response = array(
                    "id_movimiento" => $id,
                    "codigo_ubicacion" => $codigo,
                    "nombre_ubicacion" => $nombre_ubicacion
                );
            } else {
                $response = array(
                    "id_movimiento" => "",
                    "codigo_ubicacion" => "Código No asignado",
                    "nombre_ubicacion" => "Nombre Ubicación no asignado"
                );
            }


            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}

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
        $query01 = "SELECT mante_r.*  FROM `mante_radio` mante_r WHERE mante_r.idradio_mante='$valor1' ORDER BY mante_r.fecha_mradio DESC";
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

                echo ' <tr>

			<td>' . $value["correlativo_mradio"] . '</td>
			<td>' . date_format(date_create($value["fecha_mradio"]), "d-m-Y")  . '</td>
			<td>' . $value["diagnostico_mradio"] . '</td>
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
        <!--   <tfoot>
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
        </tfoot> -->

    </table>

<?php
}
?>