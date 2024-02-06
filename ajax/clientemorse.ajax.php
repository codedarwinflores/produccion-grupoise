<?php
require_once "../modelos/clientemorse.modelo.php";
require_once "../controladores/clientemorse.controlador.php";
//Modelo de Logs
require_once "../extensiones/navegador/vendor/autoload.php";
require_once "../modelos/logs.modelo.php";
session_start();
date_default_timezone_set('America/El_Salvador');
// Ahora puedes usar funciones de fecha y hora en El Salvador




class AjaxConsultarClienteMorse
{


    public function AjaxConsultarCliente()
    {

        $condicionFinal = "";

        $campos = "morse.*,pais.nombre as nombrepais,depart.Nombre as nombredepart,municipio.Nombre_m as nombremunicipio, CONCAT(eval.codigo,' - ',eval.nombres,' ',eval.primer_apellido,' ',eval.segundo_apellido) as nombre_evaluado, CONCAT(vende.codigo,' - ',vende.nombre_vendedor) as nombre_vendedor_morse";
        $tabla = "`tbl_clientes_morse` morse LEFT JOIN paises pais on morse.general_id_pais = pais.id LEFT JOIN cat_departamento depart on morse.general_id_departamento=depart.id LEFT JOIN cat_municipios municipio on morse.general_id_municipio=municipio.id LEFT JOIN evaluados eval ON morse.id_ultimo_evaluado=eval.id LEFT JOIN tbl_vendedormorse vende ON morse.id_vendedor_morse=vende.id";

        $respuesta = ClienteMorseModelo::MostrarDatos($campos, $tabla, $condicionFinal, " ORDER BY otro_fecha_apertura DESC, id DESC, estado DESC;");
        return $respuesta;
    }



    public function mostrarTablaClienteMorse()
    {
        $datos = self::AjaxConsultarCliente();
        $data = array();

        $botones = "";
        $estado = "";
        $clase = "";
        $fechaActual = date('Y-m-d');
        for ($i = 0; $i < count($datos); $i++) {

            $clase = "default";
            if (strtoupper($datos[$i]["estado"]) === "ACTIVO") {
                $clase = "success";
            }

            $botones = "";
            $botones .= '<div class="btn-group pull-left" ><button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-th-list" aria-hidden="true"></i>&nbsp;<span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
            if ($_SESSION["perfil"] === "Administrador") {
                $botones .= "<li><a href='#' class='btnEditarClienteMorse' id_clientemorse='" . $datos[$i]["id"] . "' data-toggle='modal' data-target='#modalAgregarClienteMorse'><i class='fa fa-pencil'></i> Editar</a></li><li><a href='#' class='btnEliminarClienteMorse' id_clientemorse='" . $datos[$i]["id"] . "'><i class='fa fa-trash-o'></i> Eliminar</a></li>";
            }

            $botones .= "</ul></div>";
            $estado = "<button class='btn btn-$clase btn-xs  btn-short-text' title='" . $datos[$i]["estado"] . "'>" . $datos[$i]["estado"] . "</button>";

            $row = array(
                $i + 1,
                $datos[$i]["id"],
                $botones,
                $estado,
                $datos[$i]["codigo_cliente"],
                $datos[$i]["otro_fecha_apertura"] != null && $datos[$i]["otro_fecha_apertura"] != "0000-00-00" ? date("d/m/Y", strtotime($datos[$i]["otro_fecha_apertura"])) : "",
                $datos[$i]["nombre"],
                $datos[$i]["general_contribuyente"],
                $datos[$i]["general_nit"],
                $datos[$i]["general_nrc"],
                $datos[$i]["general_nombre_registro"],
                $datos[$i]["general_giro"],
                $datos[$i]["general_direccion_cliente"],
                $datos[$i]["general_telefono1"],
                $datos[$i]["general_telefono2"],
                $datos[$i]["general_fax"],
                $datos[$i]["general_contacto"],
                $datos[$i]["general_correo"],
                $datos[$i]["nombrepais"],
                $datos[$i]["nombredepart"],
                $datos[$i]["nombremunicipio"],
                $datos[$i]["otro_limite_credito"],
                $datos[$i]["otro_plazo"],
                $datos[$i]["otro_cuenta_contable"],
                $datos[$i]["otro_categoria"],
                $datos[$i]["conta_contacto"],
                $datos[$i]["conta_telefono1"],
                $datos[$i]["conta_telefono2"],
                $datos[$i]["conta_correo"],
                $datos[$i]["conta_direccion"],
                $datos[$i]["contra_nombre_representante"],
                $datos[$i]["contra_profesion_oficio"],
                $datos[$i]["contra_identifiacion"],
                $datos[$i]["contra_domicilio"],
                $datos[$i]["contra_calidad"],
                $datos[$i]["fecha_solicitud"],
                $datos[$i]["hora"],
                $datos[$i]["solicitado_nivel_academico"],
                $datos[$i]["solicitado_nombre"],
                $datos[$i]["solicitado_apellido"],
                $datos[$i]["solicitado_cargo"],
                $datos[$i]["solicitado_correo"],
                $datos[$i]["solicitado_direccion_entrega"],
                $datos[$i]["solicitado_telefono"],
                $datos[$i]["nombre_evaluado"],
                $datos[$i]["observaciones"],
                $datos[$i]["dui_morse"],
                $datos[$i]["comision_morse"],
                $datos[$i]["nombre_vendedor_morse"],

            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {

    /* CONSULTAR LOS CLIENTES REGISTRADOS */
    if (isset($_GET["ConsultarClientesMorse"]) && $_GET["ConsultarClientesMorse"] === "ok") {

        if (isset($_SESSION["perfil"])) {
            $ClienteMorse = new AjaxConsultarClienteMorse();
            $ClienteMorse->mostrarTablaClienteMorse();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Función para agregar un nuevo examen
    function agregarExamenes($id_tipo_examen, $cod_examen, $id_cliente_morse, $cod_cliente_morse, $nuevo_precio)
    {
        if (isset($_SESSION['array_examenes']) && count($_SESSION['array_examenes']) > 0) {
            // Verificar si ya existe un examen con la misma combinación
            foreach ($_SESSION['array_examenes'] as $examenes) {
                if ($examenes['id_cliente_morse'] == $id_cliente_morse && $examenes['id_tipo_examen'] == $id_tipo_examen) {
                    return false; // No agregar, ya existe
                }
            }
        }


        // Agregar el nuevo examen al arreglo de exámenes en la sesión
        $_SESSION['array_examenes'][] = array(
            'id_tipo_examen' => $id_tipo_examen,
            'cod_examen' => $cod_examen,
            'id_cliente_morse' => $id_cliente_morse,
            'cod_cliente_morse' => $cod_cliente_morse,
            'nuevo_precio' => $nuevo_precio
        );

        return true; // Examen agregado con éxito
    }

    // Función para eliminar un examen por posición
    function eliminarExamenPorPosicion($posicion)
    {
        // Verificar si la posición existe en el arreglo
        if (isset($_SESSION['array_examenes'][$posicion])) {
            // Eliminar el examen en la posición proporcionada
            unset($_SESSION['array_examenes'][$posicion]);
            // Reindexar el arreglo para evitar huecos en los índices
            $_SESSION['array_examenes'] = array_values($_SESSION['array_examenes']);
            return true; // Examen eliminado con éxito
        } else {
            return false; // Posición no válida, examen no encontrado
        }
    }

    // Función para limpiar el arreglo 'array_examenes' en la sesión
    function limpiarArrayExamenes()
    {
        if (isset($_SESSION['array_examenes'])) {
            unset($_SESSION['array_examenes']);
        } else {
            $_SESSION['array_examenes'] = array();
        }
        // Utilizar unset para eliminar la variable 'array_examenes'

    }

    if (isset($_POST["id_posicion_sesion"]) && isset($_POST["delete"]) && $_POST["delete"] === "ok" && isset($_POST["tipo"])) {
        try {
            $ClienteMorse = new ControladorClienteMorse();
            // Output the JSON data
            $posicionAEliminar = $_POST["id_posicion_sesion"];
            if ($_POST["tipo"] === "tbl") {
                $resultado = $ClienteMorse->ctrBorrarTipoExamenMorse($posicionAEliminar);
            } else {
                $resultado = eliminarExamenPorPosicion($posicionAEliminar);
            }

            if ($resultado) {
                $jsonData = json_encode(["status" => "ok"]);
            } else {
                $jsonData = json_encode(["status" => "error"]);
            }

            echo $jsonData;
        } catch (PDOException $e) {
            // Manejar errores de la base de datos de manera adecuada
            $jsonData = json_encode(["status" => "error", "message" => $e->getMessage()]);
            echo $jsonData;
        }
    }
    if (isset($_POST["deletesesionexamenes"]) && $_POST["deletesesionexamenes"] === "ok") {
        limpiarArrayExamenes();
    }


    /* CONSULTAS PARA LLENAR SELECT */

    if (isset($_POST["getPais"]) && $_POST["getPais"] === "ok") {
        $ClienteMorse = new ControladorClienteMorse();
        echo $ClienteMorse::getDataSelect("paises", "");
    } else if (isset($_POST["getDepartamento"]) && $_POST["getDepartamento"] === "ok") {
        $ClienteMorse = new ControladorClienteMorse();
        echo $ClienteMorse::getDataSelect("cat_departamento", "");
    } else if (isset($_POST["getVendedorMorse"]) && $_POST["getVendedorMorse"] === "ok") {
        $ClienteMorse = new ControladorClienteMorse();
        echo $ClienteMorse::getDataSelect("tbl_vendedormorse", "");
    } else if (isset($_POST["getMunicipio"]) && $_POST["getMunicipio"] === "ok" && isset($_POST["departamentoId"]) && is_numeric($_POST["departamentoId"])) {
        $ClienteMorse = new ControladorClienteMorse();
        echo $ClienteMorse::getDataSelect("cat_municipios", "idDpto=" . $_POST["departamentoId"]);
    } else if (isset($_POST["getTipoExamen"]) && $_POST["getTipoExamen"] === "ok") {
        $ClienteMorse = new ControladorClienteMorse();
        echo $ClienteMorse::getDataSelect("tipos_examenes", "1");
    } else if (isset($_POST["getEvaluados"]) && $_POST["getEvaluados"] === "ok" && isset($_POST["id_cliente_morse_ultimo"]) && is_numeric($_POST["id_cliente_morse_ultimo"])) {
        $ClienteMorse = new ControladorClienteMorse();
        echo $ClienteMorse::getDataSelect("evaluados", "id_cliente_morse =" . $_POST["id_cliente_morse_ultimo"] . " ORDER BY id DESC LIMIT 1");
    }



    /*=============================================
CREAR CLIENTE
=============================================*/
    if (isset($_POST["save_process_clientemorse"]) && $_POST["save_process_clientemorse"] === "ok" && isset($_POST["type_action_form"]) && isset($_POST["id_edit_clientemorse"])) {

        if ($_POST["id_edit_clientemorse"] === "0"  && $_POST["type_action_form"] === "save") {
            $crear = new ControladorClienteMorse();
            if ($crear->ctrCrearClienteMorse()) {
                $examenesEnSesion = isset($_SESSION['array_examenes']) ? $_SESSION['array_examenes'] : array();

                if (count($examenesEnSesion) > 0) {
                    $id_last  = $crear->getDataIDLastMorse();
                    $tabla = "tbl_examen_clientemorse";
                    foreach ($examenesEnSesion as $key => $examenes) {

                        $datos = array(
                            "id_tipo_examen" => $examenes["id_tipo_examen"],
                            "id_cliente_morse" => $id_last,
                            "nuevo_precio" => $examenes["nuevo_precio"]
                        );

                        ClienteMorseModelo::mdlIngresarClienteExamen($tabla, $datos);
                    }
                }
                logs_msg("Tabla Cliente Morse", "Crear Cliente Morse");
                echo "save";
            } else {
                echo "error";
            }
        } else if ($_POST["id_edit_clientemorse"] > "0"  && $_POST["type_action_form"] === "update") {

            $editar = new ControladorClienteMorse();
            if ($editar->ctrEditarClienteMorse()) {
                logs_msg("Tabla Cliente Morse", "Editar Cliente Morse: ID= " . $_POST["id_edit_clientemorse"]);
                echo "update";
            } else {
                echo "error";
            }
        }
    }

    /*=============================================
        CREAR CLIENTE EXAMEN
    =============================================*/
    if (isset($_POST["save_process_addtipoexamen"]) && $_POST["save_process_addtipoexamen"] === "ok" && isset($_POST["type_action_form"]) && isset($_POST["id_edit_tipoexam"]) && isset($_POST["id_cliente_idtipoexamen"])) {


        /* SI EL CLIENTE YA ESTA REGISTRADO: QUE SE GUARDE DIRECTAMENTE EN BASE DE DATOS */
        if ($_POST["id_cliente_idtipoexamen"] > 0) {

            if ($_POST["id_edit_tipoexam"] === "0"  && $_POST["type_action_form"] === "save") {
                $crear = new ControladorClienteMorse();
                if ($crear->ExisteRegistro("id_tipo_examen=" . $_POST["id_tipo_examen_morse"] . " and id_cliente_morse=" . $_POST["id_cliente_idtipoexamen"])) {
                    echo "existe";
                } else {
                    if ($crear->ctrCrearTipoExamenCliente()) {
                        logs_msg("Tabla Cliente Examen", "Crear Precio para examen");
                        echo "save";
                    } else {
                        echo "error";
                    }
                }
            } else if ($_POST["id_edit_tipoexam"] > "0"  && $_POST["type_action_form"] === "update") {

                $editar = new ControladorClienteMorse();
                if ($editar->ctrEditarClienteMorse()) {
                    logs_msg("Tabla Cliente Morse", "Editar Cliente Examen Morse: ID= " . $_POST["id_edit_clientemorse"]);
                    echo "update";
                } else {
                    echo "error";
                }
            }
        } else {
            if (agregarExamenes($_POST["id_tipo_examen_morse"], 'EXAM001', $_POST["id_cliente_idtipoexamen"], 'CLI001', $_POST["nuevo_precio"])) {
                echo "save";
            } else {
                echo "existe";
            }
        }
        /* CREAR CRUD DE SESIONES */
    }

    /*=============================================
        EDITAR 
        =============================================*/
    if (isset($_POST["id_cliente_morse"]) && is_numeric($_POST["id_cliente_morse"])) {
        $editar = new ControladorClienteMorse();
        echo  $editar::ctrMostrarClienteMorse($_POST["id_cliente_morse"]);
    }

    /* ELIMINAR */
    if (isset($_POST["id_clientemorse_delete"]) && $_POST["id_clientemorse_delete"] > 0) {
        $borrar = new ControladorClienteMorse();
        if ($borrar->ctrBorrarClienteMorse()) {
            logs_msg("Tabla evaluados", "Eliminar evaluado: ID= " . $_POST["id_clientemorse_delete"]);
            echo "delete";
        } else {
            echo "error";
        }
    } else if (
        isset($_POST["getexamenesclientemorse"]) && $_POST["getexamenesclientemorse"] === "tbl_examenes_cliente_morse" &&
        isset($_POST["getIdClienteMorse"])
    ) {


        // Verificar si la sesión de productos existe
        if (!isset($_SESSION['array_examenes'])) {
            // Si no existe, inicializarla como un arreglo vacío
            $_SESSION['array_examenes'] = array();
        }

?>
        <table class="table table-striped table-bordered table-hover table-condensed">
            <caption>AGREGAR PRECIO A EXAMENES <button type="button" data-toggle="modal" data-target="#asignacionDeprecioExamen" class="btn btn-success btn-xs"><i class="fa fa-plus"></icla></button></caption>
            <thead class="bg-light-blue-gradient">
                <tr>
                    <th>N°</th>
                    <th>CÓD EXAMEN</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PRECIO</th>
                    <th>NUEVO PRECIO</th>
                    <th width="8%">✍</th>
                </tr>
            </thead>
            <tbody>

                <?php

                if ($_POST["getIdClienteMorse"] > 0) {

                ?>

                    <?php
                    $campos = "examorse.id,exam.codigo,exam.descripcion,exam.valor,examorse.nuevo_precio,clientemorse.nombre";
                    $tabla  = "tbl_examen_clientemorse examorse INNER JOIN tipos_examenes exam on examorse.id_tipo_examen = exam.id INNER JOIN tbl_clientes_morse clientemorse on examorse.id_cliente_morse=clientemorse.id";
                    $condicionFinal = "id_cliente_morse=" . $_POST["getIdClienteMorse"];
                    $response = ClienteMorseModelo::MostrarDatos($campos, $tabla, $condicionFinal, " ORDER BY codigo DESC");

                    if (count($response) > 0) {
                        foreach ($response as $key => $row) {
                    ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $row["codigo"] ?></td>
                                <td><?php echo $row["descripcion"] ?></td>
                                <td>$ <?php echo $row["valor"] ?></td>
                                <td>$ <?php echo $row["nuevo_precio"] ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteSessionIDExamen(<?php echo $row['id']; ?>,'tbl')"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                        <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'><div class='alert alert-warning'><i class='fa fa-warning'></i> No se encontraron registros</div></td></tr>";
                    }
                } else {
                    /* ARRAY DE SESIONES */
                    // Obtener y mostrar la lista de productos en la sesión
                    $examenesEnSesion = $_SESSION['array_examenes'];

                    if (count($examenesEnSesion) > 0) {
                        foreach ($examenesEnSesion as $key => $examenes) {
                            $datos = ClienteMorseModelo::ObtenerDatosExamenes("tipos_examenes", "id=" . $examenes["id_tipo_examen"])
                        ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $datos["codigo"] ?></td>
                                <td><?php echo  $datos["descripcion"] ?></td>
                                <td>$ <?php echo $datos["valor"] . $examenes["id_cliente_morse"] ?></td>
                                <td>$ <?php echo number_format($examenes["nuevo_precio"], 2) ?></td>
                                <td>

                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteSessionIDExamen(<?php echo $key; ?>,'sesion')"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'><div class='alert alert-warning'><i class='fa fa-warning'></i> No se encontraron registros</div></td></tr>";
                    }
                }

                ?>
            </tbody>
        </table>

<?php
    }
}
?>