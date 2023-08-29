<?php


require_once "../modelos/conexion.php";
require_once "../modelos/mante_radio.modelo.php";
session_start();


function updated_equipo($idequipo, $descripcion, $cantidad, $costo_equipo)
{



    $max = count($_SESSION['detalle_equipo']);
    $flag = 0;
    for ($i = 0; $i < $max; $i++) {
        if ($idequipo == $_SESSION['detalle_equipo'][$i]['idequipo']) {

            # code...
            $flag = 1;
            $_SESSION['detalle_equipo'][$i]['equipo_cantidad'] = $cantidad;
            $_SESSION['detalle_equipo'][$i]['equipo_costo_equipo'] = $costo_equipo;
            $_SESSION['detalle_equipo'][$i]['equipo_valor'] = $cantidad * $costo_equipo;
            $_SESSION['detalle_equipo'][$i]['equipo_descripcion_unica'] = $descripcion;
            break;
        }
    }
    return $flag;
}

function equipo_exists($pid, $q)
{
    // $pid=intval($pid); 
    $max = count($_SESSION['detalle_equipo']);
    $flag = 0;
    for ($i = 0; $i < $max; $i++) {
        if ($pid == $_SESSION['detalle_equipo'][$i]['idequipo']) {
            if ($q > 0) {
                $flag = 1;
                $_SESSION['detalle_equipo'][$i]['equipo_cantidad'] = $_SESSION['detalle_equipo'][$i]['equipo_cantidad'] + $q;
                $_SESSION['detalle_equipo'][$i]['equipo_valor'] = $_SESSION['detalle_equipo'][$i]['equipo_costo_equipo'] * $_SESSION['detalle_equipo'][$i]['equipo_cantidad'];

                break;
            }
            $flag = 1;

            break;
        }
    }
    return $flag;
}
/* function addtoEquipo($pid, $price_c, $price, $q, $subtotal, $sub_total_v, $descrip) */
function addtoEquipo($idequipo, $descripcion_equipo, $descripcion_unica, $cantidad, $costo_equipo, $valor, $codigo)
{
    if ($idequipo < 1 or $cantidad < 1) return;
    if ($cantidad < 1) return;
    if (!empty($_SESSION['detalle_equipo'])) {


        if (is_array($_SESSION['detalle_equipo'])) {

            if (equipo_exists($idequipo, $cantidad)) return;

            $max = count($_SESSION['detalle_equipo']);
            $_SESSION['detalle_equipo'][$max]['idequipo'] = $idequipo;
            $_SESSION['detalle_equipo'][$max]['equipo_cantidad'] = $cantidad;
            $_SESSION['detalle_equipo'][$max]['equipo_costo_equipo'] = $costo_equipo;
            $_SESSION['detalle_equipo'][$max]['equipo_valor'] = $valor;
            $_SESSION['detalle_equipo'][$max]['equipo_descripcion_equipo'] = $descripcion_equipo;
            $_SESSION['detalle_equipo'][$max]['equipo_descripcion_unica'] = $descripcion_unica;
            $_SESSION['detalle_equipo'][$max]['equipo_codigo_tipo'] = $codigo;
        } else {
            $_SESSION['detalle_equipo'] = array();
            $_SESSION['detalle_equipo'][0]['idequipo'] = $idequipo;
            $_SESSION['detalle_equipo'][0]['equipo_cantidad'] = $cantidad;
            $_SESSION['detalle_equipo'][0]['equipo_costo_equipo'] = $costo_equipo;
            $_SESSION['detalle_equipo'][0]['equipo_valor'] = $valor;
            $_SESSION['detalle_equipo'][0]['equipo_descripcion_equipo'] = $descripcion_equipo;
            $_SESSION['detalle_equipo'][0]['equipo_descripcion_unica'] = $descripcion_unica;
            $_SESSION['detalle_equipo'][0]['equipo_codigo_tipo'] = $codigo;
        }
    } else {
        $_SESSION['detalle_equipo'][0]['idequipo'] = $idequipo;
        $_SESSION['detalle_equipo'][0]['equipo_cantidad'] = $cantidad;
        $_SESSION['detalle_equipo'][0]['equipo_costo_equipo'] = $costo_equipo;
        $_SESSION['detalle_equipo'][0]['equipo_valor'] = $valor;
        $_SESSION['detalle_equipo'][0]['equipo_descripcion_equipo'] = $descripcion_equipo;
        $_SESSION['detalle_equipo'][0]['equipo_descripcion_unica'] = $descripcion_unica;
        $_SESSION['detalle_equipo'][0]['equipo_codigo_tipo'] = $codigo;
    }
}

function removetoEquipo($id)
{
    //Eliminar Producto del arreglo de sessiones
    unset($_SESSION['detalle_equipo'][$id]);
    $_SESSION['detalle_equipo'] = array_values($_SESSION['detalle_equipo']);
}


function removetoequipo_delete()
{
    unset($_SESSION['detalle_equipo']);
    @$_SESSION['detalle_equipo'] = array_values(@$_SESSION['detalle_equipo']);
    return true;
}

function buscarInfoUbicacion($code, $consult)
{
    if ($consult == "id") {
        $stmt = Conexion::conectar()->prepare("SELECT
    moveq.*,
    clientubi.codigo_ubicacion,
    clientubi.nombre_ubicacion
FROM
    `historialmovimientosequipos` moveq
INNER JOIN tbl_clientes_ubicaciones clientubi ON
    moveq.id_ubicacion_movimiento_his = clientubi.id
WHERE
    moveq.id = " . $code);
    } else {
        $stmt = Conexion::conectar()->prepare("SELECT
    moveq.*,
    clientubi.codigo_ubicacion,
    clientubi.nombre_ubicacion
FROM
    `historialmovimientosequipos` moveq
INNER JOIN tbl_clientes_ubicaciones clientubi ON
    moveq.id_ubicacion_movimiento_his = clientubi.id
WHERE
    moveq.codigo_equipo_his = '" . $code . "'
AND moveq.id = (
    SELECT
        MAX(id)
    FROM
        `historialmovimientosequipos`
    WHERE
        codigo_equipo_his = '" . $code . "'
);");
    }
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}


function buscarSubtotal($id, $tipo, $sms)
{
    if ($sms === "subtotal") {
        $sql = "SELECT SUM(valor) as subtotal FROM `mante_radio_detalle_equipo` WHERE id_manto = $id and tipo_equipo ='" . $tipo . "'";
    } else {
        $sql = "SELECT SUM(valor) as total FROM `mante_radio_detalle_equipo` WHERE id_manto = $id";
    }

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

if (isset($_POST['action']) && $_POST['action'] == "add") {
    if (is_numeric($_POST["idequipo"])) {
        $idequipo = $_POST['idequipo'];
        $stmt = Conexion::conectar()->prepare("SELECT otro_eq.codigo_equipo,otro_eq.descripcion as descripcion_equipo,otro_eq.costo_equipo,tipo_otro_eq.codigo FROM tbl_otros_equipos otro_eq INNER JOIN tipo_otros_equipos tipo_otro_eq ON otro_eq.tipo_equipos = tipo_otro_eq.id where otro_eq.id=" . $idequipo);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $codigo = $row["codigo"];
        $costo_equipo = $row["costo_equipo"];
        $cantidad = 1;
        $valor = $cantidad * $costo_equipo;
        $descripcion_equipo = $row["codigo_equipo"] . " - " . $row["descripcion_equipo"];
        $descripcion_unica = "";

        if ($codigo == "REPU") {
            $tipoEquipo = "repuestos";
            $mensaje = "REPUESTOS AGREGADOS";
        } else {
            $tipoEquipo = "manoobra";
            $mensaje = "Mano Obra AGREGADOS";
        }
        addtoEquipo($idequipo, $descripcion_equipo, $descripcion_unica, $cantidad, $costo_equipo, $valor, $codigo);

        $response = array(
            "mensaje" => $mensaje,
            "tipo" => $tipoEquipo,
            "estado" => "add"
        );



        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array(
            "mensaje" => "ERROR",
            "tipo" => "TIPO DESCONOCIDO",
            "estado" => "error"
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else if (isset($_POST['action']) && $_POST['action'] === "eliminar") {
    if (isset($_POST['idequipo'])) {
        removetoEquipo($_POST['idequipo']);
        $countcart = isset($_SESSION['detalle_equipo']) ? count($_SESSION['detalle_equipo']) : 0;
        if ($countcart == 0) {

            unset($_SESSION['detalle_equipo']);

            echo "vacio";
        } else {

            echo "eliminado";
        }
    }
} else if (isset($_POST['action']) && $_POST['action'] == "vaciar") {
    removetoequipo_delete();

    echo "vacio";
} else if (isset($_POST['action']) && $_POST['action'] == "modif") {
    $idequipo = $_POST['idequipo'];
    $descripcion = $_POST['descripcion'];
    $cantidad = intval($_POST['cantidad']);
    $costo_equipo = doubleval($_POST['costo_equipo']);
    /* MODIFICAR ARRAY */
    updated_equipo($idequipo, $descripcion, $cantidad, $costo_equipo);
} else if (isset($_POST['action']) && $_POST['action'] == "modificar_detalle") {
    $descripcion = $_POST['descripcion'];
    $cantidad = intval($_POST['cantidad']);
    $costo_equipo = doubleval($_POST['costo_equipo']);
    $id = intval($_POST['id']);
    $sentencia = Conexion::conectar()->prepare("UPDATE mante_radio_detalle_equipo SET descripcion=?, cantidad=?,valor=cantidad*? WHERE id=?;");
    $resultado = $sentencia->execute([$descripcion, $cantidad, $costo_equipo, $id]); # Pasar en el mismo orden de los ?
    if ($resultado) {
        echo "ok";
    } else {
        echo "error";
    }
    /* MODIFICAR ARRAY */
} elseif (isset($_POST['action']) && $_POST['action'] == "add_detail_team") {
    if (is_numeric($_POST["idequipo"]) && is_numeric($_POST["id_manto"])) {
        $idequipo = $_POST['idequipo'];
        $id_manto = $_POST['id_manto'];
        $stmt = Conexion::conectar()->prepare("SELECT otro_eq.codigo_equipo,otro_eq.descripcion as descripcion_equipo,otro_eq.costo_equipo,tipo_otro_eq.codigo FROM tbl_otros_equipos otro_eq INNER JOIN tipo_otros_equipos tipo_otro_eq ON otro_eq.tipo_equipos = tipo_otro_eq.id where otro_eq.id=" . $idequipo);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $codigo = $row["codigo"];
        $costo_equipo = $row["costo_equipo"];
        $cantidad = 1;
        $valor = $cantidad * $costo_equipo;
        $descripcion_equipo = $row["codigo_equipo"] . " - " . $row["descripcion_equipo"];
        $descripcion_unica = "";

        if ($codigo == "REPU") {
            $tipoEquipo = "repuestos";
            $mensaje = "REPUESTOS AGREGADOS";
        } else {
            $tipoEquipo = "manoobra";
            $mensaje = "Mano Obra AGREGADOS";
        }
        /*  addtoEquipo($idequipo, $descripcion_equipo, $descripcion_unica, $cantidad, $costo_equipo, $valor, $codigo); */

        $sql = Conexion::conectar()->prepare("SELECT id FROM mante_radio_detalle_equipo WHERE id_equipo = $idequipo and id_manto=$id_manto");
        $sql->execute();
        $rowsql = $sql->fetch(PDO::FETCH_ASSOC);

        if ($rowsql) {
            $id_detalle = $rowsql['id'];
            /* ACTUALIZAR SI EXISTE */
            $sentencia = Conexion::conectar()->prepare("UPDATE mante_radio_detalle_equipo SET cantidad=cantidad+1,valor=cantidad*costo_equipo WHERE id=?;");
            $resultado = $sentencia->execute([$id_detalle]); # Pasar en el mismo orden de los ?
        } else {
            /* INSERTAR SI NO EXISTE */
            $sentencia = Conexion::conectar()->prepare("INSERT INTO mante_radio_detalle_equipo(id_manto, id_equipo, descripcion,cantidad,costo_equipo,valor,tipo_equipo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $resultado = $sentencia->execute([$id_manto, $idequipo, $descripcion_unica, $cantidad, $costo_equipo, $valor, $codigo]); # Pasar en el mismo orden de los ?
        }
        if ($resultado) {
            $response = array(
                "mensaje" => $mensaje,
                "tipo" => $tipoEquipo,
                "estado" => "add"
            );
        } else {
            $response = array(
                "mensaje" => "ERROR",
                "tipo" => "TIPO DESCONOCIDO",
                "estado" => "error"
            );
        }



        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array(
            "mensaje" => "ERROR",
            "tipo" => "TIPO DESCONOCIDO",
            "estado" => "error"
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}



if (isset($_POST["addDetail"])) {
    /*   session_destroy(); */
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
                /*  prefix: '$ ' */
            }).mask('.validarMoney');
        });
    </script>


    <table class="table table-bordered table-striped dt-responsive" width="100%">
        <caption class="label-default text-center"><strong>REPUESTOS</strong></caption>
        <thead>
            <th width="4%">N°</th>
            <th width="40%">Nombre del Equipo</th>
            <th width="18%">Cantidad</th>
            <th width="20%">Costo Repuesto</th>
            <th>Valor</th>
            <th width="5%">Acciones</th>
        </thead>
        <tbody>

            <?php
            $acumTotal = 0;
            $acumTotalPagar = 0;
            $contN = 0;
            if (!empty($_SESSION['detalle_equipo'])) {
                $count_equipo = count($_SESSION['detalle_equipo']);


                for ($i = 0; $i < $count_equipo; $i++) {
                    if ($_SESSION['detalle_equipo'][$i]['equipo_codigo_tipo'] == "REPU") {
                        $acumTotal += $_SESSION['detalle_equipo'][$i]['equipo_valor'];


            ?>
                        <tr>
                            <td><?php echo $contN + 1; ?>
                                <input type="hidden" id="id_equipo_<?php echo $i; ?>" value="<?php echo $_SESSION['detalle_equipo'][$i]['idequipo'] ?>">
                                <input type="hidden" id="valor_<?php echo $_SESSION['detalle_equipo'][$i]['equipo_codigo_tipo'] . $i; ?>" value="<?php echo $_SESSION['detalle_equipo'][$i]['equipo_valor'] ?>">

                            </td>
                            <td>
                                <div class="form-group col-md-12">
                                    <label for="" class=""><strong><?php echo $_SESSION['detalle_equipo'][$i]['equipo_descripcion_equipo'] ?></strong></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                                        <textarea placeholder="Agrega una descripción" id="descripcion_<?php echo $i; ?>" data-id="<?php echo $i; ?>" class="operar_detalle form-control"><?php echo $_SESSION['detalle_equipo'][$i]['equipo_descripcion_unica'] ?></textarea>
                                    </div>
                                </div>
                            </td>
                            <td> <!-- Quantity -->
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button title="Retroceder" onclick="sumar_restar('-',<?php echo $i; ?>);" type="button" class=" btn btn-default">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>

                                        <input min="1" style="text-align:center;min-width:20px;" onkeyup="roundNumber(this);" placeholder="0" type="number" id="cantidad_<?php echo $i ?>" data-id="<?php echo $i; ?>" class="operar_detalle form-control" value="<?php echo $_SESSION['detalle_equipo'][$i]['equipo_cantidad'] ?>">

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
                                    <input type="text" class="form-control validarMoney" min="0" readonly placeholder="0.00" id="costo_equipo_<?php echo $i; ?>" value="<?php echo $_SESSION['detalle_equipo'][$i]['equipo_costo_equipo'] ?>">
                                </div>
                            </td>
                            <th>$ <span id="valor_<?php echo $i; ?>">
                                    <?php echo number_format($_SESSION['detalle_equipo'][$i]['equipo_valor'], 2) ?>
                                </span></th>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_equipo_session(<?php echo $i; ?>);"> <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>

            <?php
                        $contN++;
                    }
                }
            } else {
                echo '<tr><td colspan="6">
                <div class="alert bg-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-warning"></i>
					<strong>¡Datos Vacíos!</strong> No se encontraron registros...
				</div>
                </td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total en Repuestos: </strong></td>
                <th>

                    <?php
                    $acumTotalPagar += $acumTotal;
                    ?>$
                    <span id="total_repuesto">
                        <?php
                        echo number_format($acumTotal, 2)
                        ?>
                    </span>
                </th>
            </tr>
        </tfoot>
    </table>

    <table class="table table-bordered table-striped dt-responsive" width="100%">
        <caption class="label-default text-center"><strong>MANO DE OBRA</strong></caption>
        <thead>
            <th width="4%">N°</th>
            <th width="40%">Nombre del Equipo</th>
            <th width="18%">Cantidad</th>
            <th width="20%">Costo Mano Obra</th>
            <th>Valor</th>
            <th width="5%">Acciones</th>
        </thead>
        <tbody>

            <?php
            $contN = 0;
            $acumTotal = 0;
            if (!empty($_SESSION['detalle_equipo'])) {
                $count_equipo = count($_SESSION['detalle_equipo']);


                for ($i = 0; $i < $count_equipo; $i++) {
                    if ($_SESSION['detalle_equipo'][$i]['equipo_codigo_tipo'] == "SERV") {
                        $acumTotal += $_SESSION['detalle_equipo'][$i]['equipo_valor'];


            ?>
                        <tr>
                            <td><?php echo $contN + 1; ?>
                                <input type="hidden" id="id_equipo_<?php echo $i; ?>" value="<?php echo $_SESSION['detalle_equipo'][$i]['idequipo'] ?>">
                                <input type="hidden" id="valor_<?php echo $_SESSION['detalle_equipo'][$i]['equipo_codigo_tipo'] . $i; ?>" value="<?php echo $_SESSION['detalle_equipo'][$i]['equipo_valor'] ?>">

                            </td>
                            <td>
                                <div class="form-group col-md-12">
                                    <label for="" class=""><strong><?php echo $_SESSION['detalle_equipo'][$i]['equipo_descripcion_equipo'] ?></strong></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                                        <textarea placeholder="Agrega una descripción" id="descripcion_<?php echo $i; ?>" data-id="<?php echo $i; ?>" class="operar_detalle form-control"><?php echo $_SESSION['detalle_equipo'][$i]['equipo_descripcion_unica'] ?></textarea>
                                    </div>
                                </div>
                            </td>
                            <td> <!-- Quantity -->
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button title="Retroceder" onclick="sumar_restar('-',<?php echo $i; ?>);" type="button" class=" btn btn-default">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>

                                        <input min="1" style="text-align:center;min-width:20px;" onkeyup="roundNumber(this);" placeholder="0" type="number" id="cantidad_<?php echo $i ?>" data-id="<?php echo $i; ?>" class="operar_detalle form-control" value="<?php echo $_SESSION['detalle_equipo'][$i]['equipo_cantidad'] ?>">

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
                                    <input type="text" class="form-control validarMoney" min="0" readonly placeholder="0.00" id="costo_equipo_<?php echo $i; ?>" value="<?php echo $_SESSION['detalle_equipo'][$i]['equipo_costo_equipo'] ?>">
                                </div>
                            </td>
                            <th>$ <span id="valor_<?php echo $i; ?>">
                                    <?php echo number_format($_SESSION['detalle_equipo'][$i]['equipo_valor'], 2) ?>
                                </span></th>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_equipo_session(<?php echo $i; ?>);"> <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>

            <?php
                        $contN++;
                    }
                }
            } else {
                echo '<tr><td colspan="6">
                <div class="alert bg-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-warning"></i>
					<strong>¡Datos Vacíos!</strong> No se encontraron registros...
				</div>
                </td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total en Mano Obra: </strong></td>
                <th>

                    <?php
                    $acumTotalPagar += $acumTotal;
                    ?>
                    $
                    <span id="total_mano_obra">
                        <?php
                        echo number_format($acumTotal, 2)
                        ?>
                    </span>
                </th>
            </tr>

            <tr>
                <td colspan="3">
                    <a href="#" class="btn btn-danger" onclick="vaciar_equipos();" title="Vaciar Carrito"><i class="fa fa-eraser"></i> Vaciar Detalle Equipos</a>
                </td>
                <th class="text-right label-default">Total a Pagar: </th>
                <th colspan="2">$ <span id="total_pagar_todo"> <?php echo number_format($acumTotalPagar, 2)  ?></span></th>
            </tr>
        </tfoot>

    </table>

    <input type="hidden" value="<?php echo isset($_SESSION['detalle_equipo']) ? count($_SESSION['detalle_equipo']) : 0; ?>" id="recorrer_t">

<?php

    /* DETAIL EDIT */
} else
if (isset($_POST["addDetailedit"])) {
    function tbl_mante_radio_detalle($valor1)
    {
        $query01 = "SELECT detalle_e.*,otro_eq.codigo_equipo,otro_eq.descripcion as descripcion_equipo,otro_eq.costo_equipo as costo_equipo_actual,tipo_otro_eq.codigo FROM `mante_radio_detalle_equipo` detalle_e INNER JOIN tbl_otros_equipos otro_eq ON detalle_e.id_equipo = otro_eq.id INNER JOIN tipo_otros_equipos tipo_otro_eq ON otro_eq.tipo_equipos = tipo_otro_eq.id WHERE detalle_e.id_manto=$valor1";
        $sql = Conexion::conectar()->prepare($query01);
        $sql->execute();
        return $sql->fetchAll();
    }

    $valor = $_POST["id_historial"];

    $datos = tbl_mante_radio_detalle($valor);
?>



    <table class="table table-bordered table-striped dt-responsive" width="100%">
        <caption class="label-default text-center"><strong>REPUESTOS</strong></caption>
        <thead>
            <th width="4%">N°</th>
            <th width="40%">Nombre del Equipo</th>
            <th width="18%">Cantidad</th>
            <th width="20%">Costo Repuesto</th>
            <th>Valor</th>
            <th width="5%">Acciones</th>
        </thead>
        <tbody>

            <?php
            $acumTotal = 0;
            $acumTotalPagar = 0;
            $contN = 0;
            if (count($datos) > 0) {


                foreach ($datos as $value) {
                    if ($value['tipo_equipo'] == "REPU") {
                        $acumTotal += $value['valor'];


            ?>
                        <tr>
                            <td><?php echo $contN + 1; ?>
                                <input type="hidden" id="editarid_equipo_<?php echo $contN; ?>" value="<?php echo $value['id_equipo'] ?>">
                                <input type="hidden" id="editarvalor_<?php echo $value['tipo_equipo'] . $contN; ?>" value="<?php echo $value['valor'] ?>">


                            </td>
                            <td>
                                <div class="form-group col-md-12">
                                    <label for="" class=""><strong><?php echo $value['codigo_equipo'] . " - " . $value['descripcion_equipo'] ?></strong></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                                        <textarea placeholder="Agrega una descripción" id="editardescripcion_<?php echo $contN; ?>" data-id="<?php echo $value['id']; ?>" idcont="<?php echo $contN; ?>" class="operar_detallee form-control"><?php echo $value['descripcion'] ?></textarea>
                                    </div>
                                </div>
                            </td>
                            <td> <!-- Quantity -->
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button title="Retroceder" onclick="editar_sumar_restar('-',<?php echo $contN; ?>,<?php echo $value['id']; ?>);" type="button" class=" btn btn-default">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>

                                        <input min="1" style="text-align:center;min-width:20px;" onkeyup="roundNumber(this);" placeholder="0" type="number" id="editarcantidad_<?php echo $contN ?>" data-id="<?php echo $value['id']; ?>" class="operar_detallee form-control" idcont="<?php echo $contN; ?>" value="<?php echo $value['cantidad'] ?>">

                                        <span class="input-group-btn">
                                            <!-- ngIf: item.qtyStatus == false -->
                                            <button title="Avanzar" onclick="editar_sumar_restar('+',<?php echo $contN ?>,<?php echo $value['id']; ?>);" type="button" class="btn btn-default">
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
                                    <input type="text" class="form-control validarMoney" min="0" readonly placeholder="0.00" id="editarcosto_equipo_<?php echo $contN; ?>" value="<?php echo $value['costo_equipo'] ?>">
                                </div>
                            </td>
                            <th>$ <span id="editarvalor_<?php echo $contN; ?>">
                                    <?php echo number_format($value['valor'], 2) ?>
                                </span></th>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_equipo_tabla(<?php echo $value['id']; ?>);"> <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>

            <?php
                        $contN++;
                    }
                }
            } else {
                echo '<tr><td colspan="6">
                <div class="alert bg-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-warning"></i>
					<strong>¡Datos Vacíos!</strong> No se encontraron registros...
				</div>
                </td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total en Repuestos: </strong></td>
                <th>

                    <?php
                    $acumTotalPagar += $acumTotal;
                    ?>$
                    <span id="editartotal_repuesto">
                        <?php
                        echo number_format($acumTotal, 2)
                        ?>
                    </span>
                </th>
            </tr>
        </tfoot>
    </table>

    <table class="table table-bordered table-striped dt-responsive" width="100%">
        <caption class="label-default text-center"><strong>MANO DE OBRA</strong></caption>
        <thead>
            <th width="4%">N°</th>
            <th width="40%">Nombre del Equipo</th>
            <th width="18%">Cantidad</th>
            <th width="20%">Costo Mano Obra</th>
            <th>Valor</th>
            <th width="5%">Acciones</th>
        </thead>
        <tbody>

            <?php
            $contN = $contN;
            $acumTotal = 0;

            if (count($datos) > 0) {


                foreach ($datos as $value) {
                    if ($value['tipo_equipo'] == "SERV") {
                        $acumTotal += $value['valor'];


            ?>
                        <tr>
                            <td><?php echo $contN + 1; ?>
                                <input type="hidden" id="editarid_equipo_<?php echo $contN; ?>" value="<?php echo $value['id_equipo'] ?>">
                                <input type="hidden" id="editarvalor_<?php echo $value['tipo_equipo'] . $contN; ?>" value="<?php echo $value['valor'] ?>">

                            </td>
                            <td>
                                <div class="form-group col-md-12">
                                    <label for="" class=""><strong><?php echo $value['codigo_equipo'] . " - " . $value['descripcion_equipo'] ?></strong></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                                        <textarea placeholder="Agrega una descripción" id="editardescripcion_<?php echo $contN; ?>" data-id="<?php echo $value['id']; ?>" idcont="<?php echo $contN; ?>" class="operar_detallee form-control"><?php echo $value['descripcion'] ?></textarea>
                                    </div>
                                </div>
                            </td>
                            <td> <!-- Quantity -->
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button title="Retroceder" onclick="editar_sumar_restar('-',<?php echo $contN; ?>,<?php echo $value['id']; ?>);" type="button" class=" btn btn-default">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>

                                        <input min="1" style="text-align:center;min-width:20px;" onkeyup="roundNumber(this);" placeholder="0" type="number" id="editarcantidad_<?php echo $contN ?>" data-id="<?php echo $value['id']; ?>" class="operar_detallee form-control" idcont="<?php echo $contN; ?>" value="<?php echo $value['cantidad'] ?>">

                                        <span class="input-group-btn">
                                            <!-- ngIf: item.qtyStatus == false -->
                                            <button title="Avanzar" onclick="editar_sumar_restar('+',<?php echo $contN ?>,<?php echo $value['id']; ?>);" type="button" class="btn btn-default">
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
                                    <input type="text" class="form-control validarMoney" min="0" readonly placeholder="0.00" id="editarcosto_equipo_<?php echo $contN; ?>" value="<?php echo $value['costo_equipo'] ?>">
                                </div>
                            </td>
                            <th>$ <span id="editarvalor_<?php echo $contN; ?>">
                                    <?php echo number_format($value['valor'], 2) ?>
                                </span></th>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_equipo_tabla(<?php echo $value['id']; ?>);"> <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                        </tr>

            <?php
                        $contN++;
                    }
                }
            } else {
                echo '<tr><td colspan="6">
                <div class="alert bg-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<i class="fa fa-warning"></i>
					<strong>¡Datos Vacíos!</strong> No se encontraron registros...
				</div>
                </td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total en Mano Obra: </strong></td>
                <th>

                    <?php
                    $acumTotalPagar += $acumTotal;
                    ?>
                    $
                    <span id="editartotal_mano_obra">
                        <?php
                        echo number_format($acumTotal, 2)
                        ?>
                    </span>
                </th>
            </tr>

            <tr>
                <td colspan="3">

                </td>
                <th class="text-right label-default">Total a Pagar: </th>
                <th colspan="2">$ <span id="editartotal_pagar_todo"> <?php echo number_format($acumTotalPagar, 2)  ?></span></th>
            </tr>
        </tfoot>

    </table>

    <input type="hidden" value="<?php echo isset($datos) ? count($datos) : 0; ?>" id="editarrecorrer_t">
<?php
}



/* BUSCRA UBICACIÓN RADIO */
if (isset($_POST["radiosearch"])) {
    if ($_POST["radiosearch"] === "nuevo") {
        if (isset($_POST["codRadio"])) {
            $row = buscarInfoUbicacion($_POST["codRadio"], "");

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
                    "id_movimiento" => 0,
                    "codigo_ubicacion" => "Código No asignado",
                    "nombre_ubicacion" => "Nombre Ubicación no asignado"
                );
            }


            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else if ($_POST["radiosearch"] === "editar") {

        /* BUSCAR LA UBICACIÓN DEL RADIO POR ID HISTORIAL DE UBICACIÓN*/
        if (isset($_POST["codRadio"])) {
            $row = buscarInfoUbicacion($_POST["codRadio"], "id");

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
                    "id_movimiento" => 0,
                    "codigo_ubicacion" => "Código No asignado",
                    "nombre_ubicacion" => "Nombre Ubicación no asignado"
                );
            }


            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}

/* consultar equipos */
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


/* GENERAR NUMERO CORRELATIVO */
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

/* mostrar para editar en json */
if (isset($_POST['editar'])) {

    if (isset($_POST['id'])) {

        $item = "id";
        $valor = $_POST['id'];

        $respuesta = ModeloManteRadio::mdlMostrar("mante_radio", $item, $valor);

        echo json_encode($respuesta);
    }
}

/* MOSTRAR LOS EQUIPOS DE ACUERDO AL RADIO */
if (isset($_POST["valor"])) {
    # code...


    $valor = $_POST["valor"];


    function tbl_mante_radio($valor1)
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
                <th width="6%">N° Correlativo</th>
                <th>Fecha</th>
                <th>Ubicación Radio</th>
                <th>Diagnóstico</th>
                <th>Descripción</th>
                <th>Total en Repuestos</th>
                <th>Total en Mano Obra</th>
                <th>Total Pago</th>
                <th width="12%">Acciones</th>
            </tr>

        </thead>
        <tbody>
            <?php

            $data01 = tbl_mante_radio($valor);

            $acumTotal = 0;
            $acumValor = 0;

            $acumCostoObra = 0;
            $acumCostoRepuesto = 0;
            $row;
            foreach ($data01 as $value) {
                /* CONSULTAR UBICACIÓN */
                $row = buscarInfoUbicacion($value["id_movimiento_his"], "id");
                $ubicacion = "No Ubicación";
                if ($row) {
                    $ubicacion = $row['codigo_ubicacion'] . " - " . $row['nombre_ubicacion'];
                }

                /* REPUESTO */
                $totalRepuesto = 0.0;
                $Repuesto = buscarSubtotal($value['id'], "REPU", "subtotal");
                if ($Repuesto) {
                    $totalRepuesto = $Repuesto['subtotal'];
                }


                /* MANO DE OBRA */
                $totalManoObra = 0.0;
                $ManoObra = buscarSubtotal($value['id'], "SERV", "subtotal");
                if ($ManoObra) {
                    $totalManoObra = $ManoObra['subtotal'];
                }

                /* TOTAL A PAGAR */
                $totalPagar = 0;
                $TotalPagarMantto = buscarSubtotal($value['id'], "", "");
                if ($TotalPagarMantto) {
                    $totalPagar = $TotalPagarMantto['total'];
                }
                echo ' <tr>

			<td>' . $value["correlativo_mradio"] . '</td>
			<td>' . date_format(date_create($value["fecha_mradio"]), "d-m-Y")  . '</td>
			<td>' . $ubicacion . '</td>
			<td>' . $value["diagnostico_mradio"] . '</td>
			<td>' . $value["descripcion"] . '</td>
			<th>$ ' . ($totalRepuesto != "" ? $totalRepuesto : "0.00") . '</th>
			<th>$ ' . ($totalManoObra != "" ? $totalManoObra : "0.00") . '</th>
            <th>$ ' . ($totalPagar != "" ? $totalPagar : "0.00")  . '</th>';
                echo '<td>

			  <div class="btn-group">
				  <button type="button" data-toggle="modal"  data-target="#modalViewMantenimiento" class="btn btn-info" onclick="viewMantenimiento(' . $value["id"] . ')"><i class="fa fa-eye"></i></button>
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