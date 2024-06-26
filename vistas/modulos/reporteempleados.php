<?php
session_start();
ini_set('max_execution_time', 12000); // Establece el límite de tiempo en 600 segundos (10 minutos)

/* EMPLEADOS AJAX VIEW */
if (isset($_POST['consultar']) && isset($_SESSION["perfil"])) {


    date_default_timezone_set("America/El_Salvador");
    $fecha = date("d_m_Y");
    $hora = date("h_i_s_A");

    $fecha1 = date("d/m/Y");
    $hora1 = date("h:i:s A");

    $fechasFiltrar = "";
    $rangoFecha = "";
    $estado_ingresos = "";
    //INCLUIR CONEXION
    include_once "../../modelos/conexion.php";

    include_once "../../modelos/empleados.modelo.php";
    /* FECHAS */
    if (isset($_POST['fechadesde']) || isset($_POST['fechahasta'])) {
        $fechadesde = $_POST['fechadesde'];
        $fechahasta = $_POST['fechahasta'];
        $rangoFechaFormato = "";
        if (!empty($fechadesde) && !empty($fechahasta)) {
            $fechasFiltrar = " BETWEEN '" . $fechadesde . "' AND '" . $fechahasta . "'";
            $rangoFecha = $fechadesde . " - " . $fechahasta;
            $rangoFechaFormato = date("d/m/Y", strtotime($fechadesde)) . " - " . date("d/m/Y", strtotime($fechahasta));
        } else if (!empty($fechadesde)) {
            $fechasFiltrar = " BETWEEN '" . $fechadesde . "' AND '" . $fechadesde . "'";
            $rangoFechaFormato = date("d/m/Y", strtotime($fechadesde)) . " - " . date("d/m/Y", strtotime($fechadesde));
        } else if (!empty($fechahasta)) {
            $fechasFiltrar = " BETWEEN '" . $fechahasta . "' AND '" . $fechahasta . "'";
            $rangoFechaFormato = date("d/m/Y", strtotime($fechahasta)) . " - " . date("d/m/Y", strtotime($fechahasta));
        } else {
            $fechasFiltrar = "";
        }
    }

    $rrhh = "";
    if (isset($_POST['rrhh'])) {
        if (!empty($_POST['rrhh'])) {
            $rrhh = $_POST['rrhh'];
        }
    }
    /* DATE(CAMPO_DE_FECHA, '%d-%m-%Y') */
    if (isset($_POST['tipoagente'])) {
        if ($_POST['tipoagente'] == 2) {
            $estado_emp = "tbemp.estado IN (2)";
            $estado_ingresos = "Ingresos";
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and (DATE(tbemp.fecha_contratacion)" . $fechasFiltrar . ")";
            }
        } else if ($_POST['tipoagente'] == 3) {
            $estado_emp = "tbemp.estado IN (3)";
            $estado_ingresos = "Egresos";
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and (STR_TO_DATE(`fecha_retiro`, '%d-%m-%Y')" . $fechasFiltrar . " or STR_TO_DATE(`fecha_retiro`, '%Y-%m-%d')" . $fechasFiltrar . ")";
            }
        } else {
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and  (DATE(tbemp.fecha_contratacion)" . $fechasFiltrar . " or STR_TO_DATE(`fecha_retiro`, '%d-%m-%Y')" . $fechasFiltrar . " or STR_TO_DATE(`fecha_retiro`, '%Y-%m-%d')" . $fechasFiltrar . ")";
            }
            $estado_emp = "tbemp.estado IN (1,2,3,4)";
            $estado_ingresos = "Ingresos/Egresos";
        }

        $_estado = $_POST['tipoagente'];
    }
    if (isset($_POST['reportado_a_pnc'])) {
        $reporte = $_POST['reportado_a_pnc'];
        if ($reporte == "Si" || $reporte == "No" && !empty($reporte)) {
            $repotePnc = "tbemp.reportado_a_pnc='" . $reporte . "'";
        } else {
            $repotePnc = "tbemp.reportado_a_pnc IN('SI','NO','')";
        }
    }
    /* echo $fechasFiltrar . "<br>";
    echo $estado_emp . "<br>"; */
    /* UBICACIÓN EMPLEADO */
    function ubicacion_empleado($codigo)
    {
        if (!empty($codigo) && $codigo != null) {
            $query = "SELECT t.id,STR_TO_DATE(t.fecha_transacciones_agente, '%d-%m-%Y') AS fecha_transacciones_agente,STR_TO_DATE(t.fecha_movimiento_transacciones_agente, '%d-%m-%Y') AS fecha_movimiento_transacciones_agente,t.nueva_ubicacion_transacciones_agente,t.ubicacion_anterior_transacciones_agente FROM transacciones_agente t WHERE t.idagente_transacciones_agente = :codigo ORDER BY fecha_movimiento_transacciones_agente DESC, t.id DESC LIMIT 1";

            $sql = Conexion::conectar()->prepare($query);
            $sql->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $fecha = $data['fecha_movimiento_transacciones_agente'];
                $ubicacion = $data['nueva_ubicacion_transacciones_agente'];
                $response = array('fechat' => formatearFecha($fecha), 'ubicaciont' => $ubicacion);
                return $response;
            }
        }
        return array('fechat' => "-", 'ubicaciont' => "-");
    }

    function sacar_ubicacion()
    {
        $query = "SELECT t.id,STR_TO_DATE(t.fecha_transacciones_agente, '%d-%m-%Y') AS fecha_transacciones_agente,
       STR_TO_DATE(t.fecha_movimiento_transacciones_agente, '%d-%m-%Y') AS fecha_movimiento_transacciones_agente,
       t.nueva_ubicacion_transacciones_agente,t.ubicacion_anterior_transacciones_agente,t.idagente_transacciones_agente FROM transacciones_agente t JOIN (SELECT idagente_transacciones_agente, MAX(STR_TO_DATE(fecha_movimiento_transacciones_agente, '%d-%m-%Y')) AS max_fecha FROM transacciones_agente GROUP BY idagente_transacciones_agente) max_dates ON t.idagente_transacciones_agente=max_dates.idagente_transacciones_agente AND STR_TO_DATE(t.fecha_movimiento_transacciones_agente, '%d-%m-%Y') = max_dates.max_fecha ORDER BY fecha_movimiento_transacciones_agente DESC;";

        $sql = Conexion::conectar()->prepare($query);

        $sql->execute();
        $result = $sql->fetchAll();

        return $result;
    }

    // Función para filtrar el JSON por idagente_transacciones_agente
    function filtrar_array_por_idagente($array, $idagente)
    {
        $filtrados = array_filter($array, function ($empleado) use ($idagente) {
            return $empleado['idagente_transacciones_agente'] === $idagente;
        });
        return $filtrados;
    }
    /* BONO EMPLEADO */
    function bonoEmpleado()
    {
        $query = "SELECT codigo_ubicacion,codigo_cliente,bono_unidad FROM `tbl_clientes_ubicaciones`";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll();
        return $data;
    }

    // Función para filtrar el JSON por codigo_cliente
    function filtrar_array_por_codigo_ubicacion($array, $codigo_ubicacion)
    {
        $filtrados = array_filter($array, function ($cliente) use ($codigo_ubicacion) {
            return $cliente['codigo_ubicacion'] == $codigo_ubicacion;
        });
        return $filtrados;
    }


    /* CONSULTAR UBICACIONES y BONOS*/

    $dataUbicacion = sacar_ubicacion();
    $dataBonoEmpleado = bonoEmpleado();


    function edad($fecha)
    {
        if (!empty($fecha)) {
            $nacimiento = new DateTime($fecha);
            $ahora = new DateTime(); // No es necesario pasar la fecha actual, se usa por defecto
            $diferencia = $ahora->diff($nacimiento);
            return $diferencia->y; // Puedes usar directamente la propiedad 'y' para obtener la edad
        }
        return 0;
    }


    /* CALCULAR EDAD DEL EMPLEADO */
    function diasContratado($fechaContrato, $fechaRetiro)
    {
        if (!empty($fechaContrato)) {
            $fecha1 = new DateTime($fechaContrato);
            $fecha2 = empty($fechaRetiro) ? new DateTime() : new DateTime($fechaRetiro);

            $diferencia = $fecha1->diff($fecha2);

            return "{$diferencia->y} Años(s), {$diferencia->m} Mes(es),  {$diferencia->d} Día(s) = {$diferencia->days} Días ";
        }

        return 0;
    }


    /* FUNCIÓN PARA IMPRIMIR LOS DEPARTAMENTOS DE LA EMPRESA */
    function departamentos($depa1, $depa2)
    {
        if (is_numeric($depa1) && $depa2 == "uno") {
            $stm = "SELECT tblemp.primer_nombre,d_emp.codigo,d_emp.nombre FROM tbl_empleados tblemp LEFT JOIN departamentos_empresa d_emp ON tblemp.id_departamento_empresa=d_emp.id WHERE tblemp.id=" . $depa1;
        } else if (is_numeric($depa1) && is_numeric($depa2)) {
            $stm = "SELECT * FROM `departamentos_empresa` where id between " . $depa1 . " and " . $depa2;
        } else {
            $stm = "SELECT d_emp.id,d_emp.codigo, d_emp.nombre, COUNT(tblemp.id) AS cantidad_empleados FROM departamentos_empresa d_emp INNER JOIN tbl_empleados tblemp ON d_emp.id=tblemp.id_departamento_empresa GROUP BY d_emp.codigo, d_emp.nombre HAVING COUNT(tblemp.id) > 0 ";
        }

        $sqlquery = Conexion::conectar()->prepare($stm);
        $sqlquery->execute();

        if (is_numeric($depa1) && $depa2 == "uno") {
            return $sqlquery->fetch(PDO::FETCH_ASSOC);
        } else {

            return $sqlquery->fetchAll();
        }
    }

    /* FORMATEAR FECHA */
    function formatearFecha($fecha)
    {
        if ($fecha !== '0000-00-00' && $fecha !== '0000-00-00 00:00:00') {
            $timestamp = strtotime($fecha);
            return date('d/m/Y', $timestamp);
        }
        return '-';
    }



?>

    <?php

    /* FILTRAR POR DEPARTAMENTOS */

    $departamento1 = "";
    $departamento2 = "";
    $campos = "tbemp.id,tbemp.primer_nombre,tbemp.primer_apellido,tbemp.segundo_nombre,tbemp.segundo_apellido,tbemp.tercer_nombre,tbemp.apellido_casada,tbemp.id_departamento,tbemp.numero_isss,tbemp.numero_documento_identidad,tbemp.nit,tbemp.codigo_afp,tbemp.nup,tbemp.fecha_nacimiento,tbemp.estado,tbemp.sueldo,tbemp.fecha_contratacion,tbemp.fecha_ingreso,tbemp.numero_cuenta,tbemp.codigo_empleado,cargo.id AS cargoid,cargo.descripcion,bank.codigo AS codigo_bank,bank.nombre AS nombre_bank, d_emp.id as d_empid, d_emp.nombre as nombre_empresa, ret.fecha_retiro,ret.motivo_inactivo,ret.observaciones_retiro,personal_transacc.nombre AS motivo_inactivo_transacc,dev_desc.tipodescuento, IF(EXISTS(SELECT 1 FROM `uniformedescuento` WHERE codigo_empleado_descuento = tbemp.id) OR EXISTS(SELECT 1 FROM `regalo` WHERE idempleado = tbemp.id), 'SI', 'NO') AS tiene_uniforme,afp.nombre as nombre_afp";

    $tabla = "`tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa=d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco = bank.id LEFT JOIN (SELECT idempleado_retiro, MAX(id) AS min_id_retiro FROM retiro GROUP BY idempleado_retiro) min_retiro ON tbemp.id = min_retiro.idempleado_retiro LEFT JOIN retiro ret ON min_retiro.idempleado_retiro = ret.idempleado_retiro AND min_retiro.min_id_retiro = ret.id LEFT JOIN tbl_transacciones_personal personal_transacc ON ret.motivo_inactivo = personal_transacc.id LEFT JOIN tbl_empleados_devengos_descuentos dev_desc ON tbemp.id = dev_desc.id_empleado AND dev_desc.tipodescuento = '2' LEFT JOIN afp ON tbemp.codigo_afp = afp.codigo";




    if (isset($_POST["empleados"]) && is_numeric($_POST["empleados"]) && !empty($_POST["empleados"])) {


        /* FILTRAR SOLO POR EL EMPLEADO */
        $cont = 0;
        $depa = departamentos($_POST['empleados'], "uno");

        /* AQUI VAN LAS CONSULTAS */

        $condicion = " tbemp.id=" . $_POST['empleados'] . "";
        $array = [];
        $cont++;
        $empleados_array = array();
        $empleadoBuscar = new ModeloEmpleados();
        $empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);
        $contEmp = 0;
        $badge = "dark";

        foreach ($empleados as $key => $value) {
            $contEmp++;

            $nombreEstado = "";
            switch ($value["estado"]) {
                case 1:
                    $nombreEstado = "Solicitud";
                    $badge = "dark";
                    break;
                case 2:
                    $nombreEstado = "Contratado";
                    $badge = "success";
                    break;
                case 3:
                    $nombreEstado = "Inactivo";
                    $badge = "danger";
                    break;
                case 4:
                    $nombreEstado = "Incapacitado";
                    $badge = "warning";
                    break;
                default:
                    $nombreEstado = "Error";
                    $badge = "default";
                    break;
            }

            $filteredJson = filtrar_array_por_idagente($dataUbicacion, $value["codigo_empleado"]);
            // Acceder a los campos del JSON filtrado

            $fecha_transacciones = '';
            $fecha_movimiento = '-';
            $nueva_ubicacion = '-';

            foreach ($filteredJson as $item) {

                $fecha_transacciones  = $item['fecha_transacciones_agente'];
                $fecha_movimiento  = $item['fecha_movimiento_transacciones_agente'];
                $nueva_ubicacion = $item['nueva_ubicacion_transacciones_agente'];
            }


            /* SACAR CODIGO */
            $separada = explode("-", $nueva_ubicacion);
            $codigo_u = $separada[0];

            $filtrarArrayBono = filtrar_array_por_codigo_ubicacion($dataBonoEmpleado, $codigo_u);

            $bonoUnidad = '';
            foreach ($filtrarArrayBono as $item) {
                $bonoUnidad  = $item['bono_unidad'];
            }


            $fechaIngreso = formatearFecha($value["fecha_ingreso"]);
            $fechaContratacion = formatearFecha($value["fecha_contratacion"]);
            $fechaRetiro = (!empty($value['fecha_retiro']) ? formatearFecha($value['fecha_retiro']) : "-");
            $diasContratados = diasContratado($value['fecha_contratacion'], $value['fecha_retiro']);
            $edadEmpleado = edad($value["fecha_nacimiento"]);

            $empleados_array[] = array(
                "codigo_empleado" => $value["codigo_empleado"],
                "nombre_completo" => mb_strtoupper(($value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"]), "UTF-8"),
                "sueldo" => ($value["sueldo"] != null && !empty($value["sueldo"]) ? number_format(($value["sueldo"] * 2), 2) : number_format(0, 2)),
                "transp" => (!empty($value["tipodescuento"]) && $value["tipodescuento"] != null ? $value["tipodescuento"] : ""),
                "u_esp" => "-",
                "fecha_ingreso" => $fechaIngreso,
                "fecha_contratacion" => $fechaContratacion,
                "fecha_retiro" => $fechaRetiro,
                "nueva_ubicacion_transacciones_agente" => $nueva_ubicacion,
                "fecha_transacciones_agente" => (!empty($fecha_movimiento) && $fecha_movimiento !== "00/00/0000" && $fecha_movimiento !== "-" ? formatearFecha($fecha_movimiento) : "-"),
                "numero_documento_identidad" => $value["numero_documento_identidad"],
                "dias_contratados" => $diasContratados,
                "nup" => $value["nup"],
                "codigo_afp" => $value["nombre_afp"],
                "motivo_inactivo_transacc" => (!empty($value['motivo_inactivo_transacc']) ? $value['motivo_inactivo_transacc'] : "-"),
                "descripcion" => $value["descripcion"],
                "edad" => $edadEmpleado,
                "fecha_nacimiento" => formatearFecha($value["fecha_nacimiento"]),
                "numero_isss" => $value["numero_isss"],
                "nit" => $value["nit"],
                "codigo_bank" => $value["codigo_bank"] . " - " . $value["nombre_bank"],
                "numero_cuenta" => $value["numero_cuenta"],
                "observaciones_retiro" => $value["observaciones_retiro"],
                "uniforme" => ($value["tiene_uniforme"]),
                "estado_actual" => '<label class="badge btn-' . $badge . '">' . $nombreEstado . '</label>',
                "estado_actual_text" =>  $value["estado"]
            );
        }

        $responses = array(
            "cantEmpleados" => $contEmp,
            "empleados" => $empleados_array,
        );

        $departamentosJSON[] = array(
            'codigo' => $depa['codigo'],
            'nombre' => $depa['nombre'],
            'empleados' => $responses["empleados"],
            'cantEmpleados' => $responses["cantEmpleados"],
        );


        // Crear el array de respuesta
        $response = array(
            'datos' => $departamentosJSON,
        );

        $datos =  $response;
    } else	if (
        isset($_POST["departamento1"]) && isset($_POST["departamento2"]) && !empty($_POST["departamento1"]) && !empty($_POST["departamento2"] && $_POST["departamento1"] != "*" && $_POST["departamento2"] != "*")
    ) {
        $depa1 = intval($_POST["departamento1"]);
        $depa2 = intval($_POST["departamento2"]);

        $auxiliar = "";
        if ($depa1 > $depa2) {
            $auxiliar = $depa1;
            $depa1 = $depa2;
            $depa2 = $auxiliar;
        }


        $departamentos = departamentos($depa1, $depa2);

        $cont = 0;
        $departamentosJSON = array();

        foreach ($departamentos as $depa) {
            $condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . ";";
            $array = [];
            $cont++;
            $empleados_array = array();
            $empleadoBuscar = new ModeloEmpleados();
            $empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);
            $contEmp = 0;
            $badge = "dark";

            foreach ($empleados as $key => $value) {
                $contEmp++;

                $nombreEstado = "";
                switch ($value["estado"]) {
                    case 1:
                        $nombreEstado = "Solicitud";
                        $badge = "dark";
                        break;
                    case 2:
                        $nombreEstado = "Contratado";
                        $badge = "success";
                        break;
                    case 3:
                        $nombreEstado = "Inactivo";
                        $badge = "danger";
                        break;
                    case 4:
                        $nombreEstado = "Incapacitado";
                        $badge = "warning";
                        break;
                    default:
                        $nombreEstado = "Error";
                        $badge = "default";
                        break;
                }

                $filteredJson = filtrar_array_por_idagente($dataUbicacion, $value["codigo_empleado"]);
                // Acceder a los campos del JSON filtrado

                $fecha_transacciones = '';
                $fecha_movimiento = '-';
                $nueva_ubicacion = '-';

                foreach ($filteredJson as $item) {

                    $fecha_transacciones  = $item['fecha_transacciones_agente'];
                    $fecha_movimiento  = $item['fecha_movimiento_transacciones_agente'];
                    $nueva_ubicacion = $item['nueva_ubicacion_transacciones_agente'];
                }


                /* SACAR CODIGO */
                $separada = explode("-", $nueva_ubicacion);
                $codigo_u = $separada[0];

                $filtrarArrayBono = filtrar_array_por_codigo_ubicacion($dataBonoEmpleado, $codigo_u);

                $bonoUnidad = '';
                foreach ($filtrarArrayBono as $item) {
                    $bonoUnidad  = $item['bono_unidad'];
                }


                $fechaIngreso = formatearFecha($value["fecha_ingreso"]);
                $fechaContratacion = formatearFecha($value["fecha_contratacion"]);
                $fechaRetiro = (!empty($value['fecha_retiro']) ? formatearFecha($value['fecha_retiro']) : "-");
                $diasContratados = diasContratado($value['fecha_contratacion'], $value['fecha_retiro']);
                $edadEmpleado = edad($value["fecha_nacimiento"]);

                $empleados_array[] = array(
                    "codigo_empleado" => $value["codigo_empleado"],
                    "nombre_completo" => mb_strtoupper(($value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"]), "UTF-8"),
                    "sueldo" => ($value["sueldo"] != null && !empty($value["sueldo"]) ? number_format(($value["sueldo"] * 2), 2) : number_format(0, 2)),
                    "transp" => (!empty($value["tipodescuento"]) && $value["tipodescuento"] != null ? $value["tipodescuento"] : ""),
                    "u_esp" => $bonoUnidad,
                    "fecha_ingreso" => $fechaIngreso,
                    "fecha_contratacion" => $fechaContratacion,
                    "fecha_retiro" => $fechaRetiro,
                    "nueva_ubicacion_transacciones_agente" => $nueva_ubicacion,
                    "fecha_transacciones_agente" => (!empty($fecha_movimiento) && $fecha_movimiento !== "00/00/0000" && $fecha_movimiento !== "-" ? formatearFecha($fecha_movimiento) : "-"),
                    "numero_documento_identidad" => $value["numero_documento_identidad"],
                    "dias_contratados" => $diasContratados,
                    "nup" => $value["nup"],
                    "codigo_afp" => $value["nombre_afp"],
                    "motivo_inactivo_transacc" => (!empty($value['motivo_inactivo_transacc']) ? $value['motivo_inactivo_transacc'] : "-"),
                    "descripcion" => $value["descripcion"],
                    "edad" => $edadEmpleado,
                    "fecha_nacimiento" => formatearFecha($value["fecha_nacimiento"]),
                    "numero_isss" => $value["numero_isss"],
                    "nit" => $value["nit"],
                    "codigo_bank" => $value["codigo_bank"] . " - " . $value["nombre_bank"],
                    "numero_cuenta" => $value["numero_cuenta"],
                    "observaciones_retiro" => $value["observaciones_retiro"],
                    "uniforme" => ($value["tiene_uniforme"]),
                    "estado_actual" => '<label class="badge btn-' . $badge . '">' . $nombreEstado . '</label>',
                    "estado_actual_text" =>  $value["estado"]
                );
            }

            $responses = array(
                "cantEmpleados" => $contEmp,
                "empleados" => $empleados_array,
            );

            $departamentosJSON[] = array(
                'codigo' => $depa['codigo'],
                'nombre' => $depa['nombre'],
                'empleados' => $responses["empleados"],
                'cantEmpleados' => $responses["cantEmpleados"],
            );
        }

        // Crear el array de respuesta
        $response = array(
            'datos' => $departamentosJSON,
        );

        // Retornar el JSON
        $datos =  $response;
    } else if ($_POST["departamento1"] === "*" || $_POST["departamento2"] === "*") {

        $depa1 = $_POST["departamento1"];
        $depa2 = $_POST["departamento2"];
        if ($depa1 === "*" && $depa2 === "*") {

            $departamentos = departamentos("todos", "todos");

            $cont = 0;

            foreach ($departamentos as $depa) {

                /* FILTRAR TODOS */
                $condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . ";";
                $array = [];
                $cont++;
                $empleados_array = array();
                $empleadoBuscar = new ModeloEmpleados();
                $empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);
                $contEmp = 0;
                $badge = "dark";

                foreach ($empleados as $key => $value) {
                    $contEmp++;

                    $nombreEstado = "";
                    switch ($value["estado"]) {
                        case 1:
                            $nombreEstado = "Solicitud";
                            $badge = "dark";
                            break;
                        case 2:
                            $nombreEstado = "Contratado";
                            $badge = "success";
                            break;
                        case 3:
                            $nombreEstado = "Inactivo";
                            $badge = "danger";
                            break;
                        case 4:
                            $nombreEstado = "Incapacitado";
                            $badge = "warning";
                            break;
                        default:
                            $nombreEstado = "Error";
                            $badge = "default";
                            break;
                    }

                    $filteredJson = filtrar_array_por_idagente($dataUbicacion, $value["codigo_empleado"]);
                    // Acceder a los campos del JSON filtrado

                    $fecha_transacciones = '';
                    $fecha_movimiento = '-';
                    $nueva_ubicacion = '-';

                    foreach ($filteredJson as $item) {

                        $fecha_transacciones  = $item['fecha_transacciones_agente'];
                        $fecha_movimiento  = $item['fecha_movimiento_transacciones_agente'];
                        $nueva_ubicacion = $item['nueva_ubicacion_transacciones_agente'];
                    }

                    /* SACAR CODIGO */
                    $separada = explode("-", $nueva_ubicacion);
                    $codigo_u = $separada[0];

                    $filtrarArrayBono = filtrar_array_por_codigo_ubicacion($dataBonoEmpleado, $codigo_u);

                    $bonoUnidad = '';
                    foreach ($filtrarArrayBono as $item) {
                        $bonoUnidad  = $item['bono_unidad'];
                    }

                    $fechaIngreso = formatearFecha($value["fecha_ingreso"]);
                    $fechaContratacion = formatearFecha($value["fecha_contratacion"]);
                    $fechaRetiro = (!empty($value['fecha_retiro']) ? formatearFecha($value['fecha_retiro']) : "-");
                    $diasContratados = diasContratado($value['fecha_contratacion'], $value['fecha_retiro']);
                    $edadEmpleado = edad($value["fecha_nacimiento"]);

                    $empleados_array[] = array(
                        "codigo_empleado" => $value["codigo_empleado"],
                        "nombre_completo" => mb_strtoupper(($value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"]), "UTF-8"),
                        "sueldo" => ($value["sueldo"] != null && !empty($value["sueldo"]) ? number_format(($value["sueldo"] * 2), 2) : number_format(0, 2)),
                        "transp" => (!empty($value["tipodescuento"]) && $value["tipodescuento"] != null ? $value["tipodescuento"] : ""),
                        "u_esp" => $bonoUnidad,
                        "fecha_ingreso" => $fechaIngreso,
                        "fecha_contratacion" => $fechaContratacion,
                        "fecha_retiro" => $fechaRetiro,
                        "nueva_ubicacion_transacciones_agente" => $nueva_ubicacion,
                        "fecha_transacciones_agente" => (!empty($fecha_movimiento) && $fecha_movimiento !== "00/00/0000" && $fecha_movimiento !== "-" ? formatearFecha($fecha_movimiento) : "-"),
                        "numero_documento_identidad" => $value["numero_documento_identidad"],
                        "dias_contratados" => $diasContratados,
                        "nup" => $value["nup"],
                        "codigo_afp" => $value["nombre_afp"],
                        "motivo_inactivo_transacc" => (!empty($value['motivo_inactivo_transacc']) ? $value['motivo_inactivo_transacc'] : "-"),
                        "descripcion" => $value["descripcion"],
                        "edad" => $edadEmpleado,
                        "fecha_nacimiento" => formatearFecha($value["fecha_nacimiento"]),
                        "numero_isss" => $value["numero_isss"],
                        "nit" => $value["nit"],
                        "codigo_bank" => $value["codigo_bank"] . " - " . $value["nombre_bank"],
                        "numero_cuenta" => $value["numero_cuenta"],
                        "observaciones_retiro" => $value["observaciones_retiro"],
                        "uniforme" => ($value["tiene_uniforme"]),
                        "estado_actual" => '<label class="badge btn-' . $badge . '">' . $nombreEstado . '</label>',
                        "estado_actual_text" =>  $value["estado"]
                    );
                }

                $responses = array(
                    "cantEmpleados" => $contEmp,
                    "empleados" => $empleados_array,
                );

                $departamentosJSON[] = array(
                    'codigo' => $depa['codigo'],
                    'nombre' => $depa['nombre'],
                    'empleados' => $responses["empleados"],
                    'cantEmpleados' => $responses["cantEmpleados"],
                );
            }

            // Crear el array de respuesta
            $response = array(
                'datos' => $departamentosJSON,
            );
            $datos =  $response;
        } else {

            /* CONDICIÓN SOLO POR UN DEPARTAMENTO */
            if ($depa1 != "*" && $depa2 === "*") {
                $depa2 = $depa1;
            } else if ($depa1 === "*" && $depa2 != "*") {
                $depa1 = $depa2;
            }

            $departamentos = departamentos($depa1, $depa2);
            $cont = 0;
            foreach ($departamentos as $depa) {

                /* FILTRAR TODOS */
                $condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . ";";
                $array = [];
                $cont++;
                $empleados_array = array();
                $empleadoBuscar = new ModeloEmpleados();
                $empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);
                $contEmp = 0;
                $badge = "dark";

                foreach ($empleados as $key => $value) {
                    $contEmp++;

                    $nombreEstado = "";
                    switch ($value["estado"]) {
                        case 1:
                            $nombreEstado = "Solicitud";
                            $badge = "dark";
                            break;
                        case 2:
                            $nombreEstado = "Contratado";
                            $badge = "success";
                            break;
                        case 3:
                            $nombreEstado = "Inactivo";
                            $badge = "danger";
                            break;
                        case 4:
                            $nombreEstado = "Incapacitado";
                            $badge = "warning";
                            break;
                        default:
                            $nombreEstado = "Error";
                            $badge = "default";
                            break;
                    }

                    $filteredJson = filtrar_array_por_idagente($dataUbicacion, $value["codigo_empleado"]);
                    // Acceder a los campos del JSON filtrado

                    $fecha_transacciones = '';
                    $fecha_movimiento = '-';
                    $nueva_ubicacion = '-';

                    foreach ($filteredJson as $item) {

                        $fecha_transacciones  = $item['fecha_transacciones_agente'];
                        $fecha_movimiento  = $item['fecha_movimiento_transacciones_agente'];
                        $nueva_ubicacion = $item['nueva_ubicacion_transacciones_agente'];
                    }


                    /* SACAR CODIGO */
                    $separada = explode("-", $nueva_ubicacion);
                    $codigo_u = $separada[0];

                    $filtrarArrayBono = filtrar_array_por_codigo_ubicacion($dataBonoEmpleado, $codigo_u);

                    $bonoUnidad = '';
                    foreach ($filtrarArrayBono as $item) {
                        $bonoUnidad  = $item['bono_unidad'];
                    }

                    $fechaIngreso = formatearFecha($value["fecha_ingreso"]);
                    $fechaContratacion = formatearFecha($value["fecha_contratacion"]);
                    $fechaRetiro = (!empty($value['fecha_retiro']) ? formatearFecha($value['fecha_retiro']) : "-");
                    $diasContratados = diasContratado($value['fecha_contratacion'], $value['fecha_retiro']);
                    $edadEmpleado = edad($value["fecha_nacimiento"]);

                    $empleados_array[] = array(
                        "codigo_empleado" => $value["codigo_empleado"],
                        "nombre_completo" => mb_strtoupper(($value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"]), "UTF-8"),
                        "sueldo" => ($value["sueldo"] != null && !empty($value["sueldo"]) ? number_format(($value["sueldo"] * 2), 2) : number_format(0, 2)),
                        "transp" => (!empty($value["tipodescuento"]) && $value["tipodescuento"] != null ? $value["tipodescuento"] : ""),
                        "u_esp" => $bonoUnidad,
                        "fecha_ingreso" => $fechaIngreso,
                        "fecha_contratacion" => $fechaContratacion,
                        "fecha_retiro" => $fechaRetiro,
                        "nueva_ubicacion_transacciones_agente" => $nueva_ubicacion,
                        "fecha_transacciones_agente" => (!empty($fecha_movimiento) && $fecha_movimiento !== "00/00/0000" && $fecha_movimiento !== "-" ? formatearFecha($fecha_movimiento) : "-"),
                        "numero_documento_identidad" => $value["numero_documento_identidad"],
                        "dias_contratados" => $diasContratados,
                        "nup" => $value["nup"],
                        "codigo_afp" => $value["nombre_afp"],
                        "motivo_inactivo_transacc" => (!empty($value['motivo_inactivo_transacc']) ? $value['motivo_inactivo_transacc'] : "-"),
                        "descripcion" => $value["descripcion"],
                        "edad" => $edadEmpleado,
                        "fecha_nacimiento" => formatearFecha($value["fecha_nacimiento"]),
                        "numero_isss" => $value["numero_isss"],
                        "nit" => $value["nit"],
                        "codigo_bank" => $value["codigo_bank"] . " - " . $value["nombre_bank"],
                        "numero_cuenta" => $value["numero_cuenta"],
                        "observaciones_retiro" => $value["observaciones_retiro"],
                        "uniforme" => ($value["tiene_uniforme"]),
                        "estado_actual" => '<label class="badge btn-' . $badge . '">' . $nombreEstado . '</label>',
                        "estado_actual_text" =>  $value["estado"]
                    );
                }

                $responses = array(
                    "cantEmpleados" => $contEmp,
                    "empleados" => $empleados_array,
                );

                $departamentosJSON[] = array(
                    'codigo' => $depa['codigo'],
                    'nombre' => $depa['nombre'],
                    'empleados' => $responses["empleados"],
                    'cantEmpleados' => $responses["cantEmpleados"],
                );
            }

            // Crear el array de respuesta
            $response = array(
                'datos' => $departamentosJSON,
            );

            $datos =  $response;
        }
    }




    ?>



    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../img/plantilla/icono-negro.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--=====================================
  PLUGINS DE CSS
  ======================================-->
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="..//bower_components/font-awesome/css/font-awesome.min.css">


        <!-- DataTables -->
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

        <style>
            body {

                font-size: 14px;
                font-family: monospace !important;
            }

            @import url('//fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,900&display=swap');

            body {
                font-family: 'Montserrat', sans-serif;
                font-weight: 900;
            }

            .contenedor-loader {
                height: 6em;
            }

            #contenedor {
                background-color: #F8B010;
                display: grid;
                place-content: center;
                height: 100vh;
                color: #000;
                z-index: 99;
            }

            .loader,
            .loader:before,
            .loader:after {
                background: #FFF;
                animation: cargando 1s infinite ease-in-out;
                width: 1em;
                height: 4em;
            }

            .loader:before,
            .loader:after {
                position: absolute;
                top: 0;
                content: '';
            }

            .loader:before {
                left: -1.5em;
            }

            .loader {
                text-indent: -9999em;
                margin: 40% auto;
                position: relative;
                font-size: 11px;
                animation-delay: 0.16s;
            }

            .loader:after {
                left: 1.5em;
                animation-delay: 0.32s;

            }

            .cargando h3 {
                color: white;
            }

            @keyframes cargando {

                0%,
                80%,
                100% {
                    box-shadow: 0 0 #FFF;
                    height: 4em;
                }

                40% {
                    box-shadow: 0 -2em #ffffff;
                    height: 5em;
                }
            }

            .tablass tbody tr:hover {
                background-color: #FCF8D9 !important;

            }
        </style>

        <title>Reporte de Empleados</title>
    </head>

    <body>
        <div id="contenedor">
            <div class="contenedor-loader">
                <div class="loader"></div>
            </div>
            <div class="cargando">
                <h3>Cargando...</h3>
            </div>
        </div>

        <!-- <?= "SELECT " . $campos . " FROM " . $tabla . " WHERE " . $condicion ?> -->
        <div style="width: 95%; margin: 0 auto;margin-top: 5px;" id="contenido" style="display:none;">
            <table width="100%">
                <tr>
                    <td width="33%" style=" text-align: left;" rowspan="4"><img src="../img/plantilla/logo_original.png" width="30%"></td>
                    <th width="33%" style=" text-align: center;font-size:20px" colspan="2">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.
                    </th>
                    <td width="33%" style="text-align: right;"><a href="./reporte-empleados.xlsx" target="_blank" class="btn btn-success" style="position:fixed;top: 5px;right:2.5%;z-index: 1;"><i class="fa fa-download"></i> XLSX <i class="fa fa-file-excel-o"></i></a></td>
                </tr>
                <tr style="font-size: 12px;">
                    <td style="text-align: right;">FECHA Y HORA:</td>
                    <td><?= $fecha1 . " " . $hora1 ?></td>
                    <td></td>
                </tr>
                <tr style="font-size: 12px;">
                    <td style="text-align: right;">RANGO DE FECHAS:</td>
                    <td><?= $rangoFechaFormato  ?></td>
                    <td></td>
                </tr>
                <tr style="font-size: 12px;">
                    <td style="text-align: right;">INGRESOS/EGRESOS:</td>
                    <td><?= $estado_ingresos  ?></td>
                    <td></td>
                </tr>
            </table>
            <?php
            // Convertir el JSON en un array asociativo
            $data = $datos;


            require_once('./reportesexcel/reporteempleado.php');

            // Verificar si hay datos en el array y si el departamento tiene empleados
            if (!empty($data['datos']) && is_array($data['datos'])) {
                foreach ($data['datos'] as $departamento) {
                    if (!empty($departamento['empleados']) && is_array($departamento['empleados'])) {
                        $html = "";
                        // Mostrar el nombre del departamento y la tabla de empleados
                        $html .= '<div class="panel " style="!important;font-weight: 900; border-bottom: solid 4px #f8b010" ><h4><strong>' . $departamento['codigo'] . " - " . $departamento['nombre'] . '</strong></h4></div>';
                        $html .= '<table class="table table-bordered table-condensed table-striped table-hover dt-responsive tablass" width="100%">';
                        $html .= '<thead class="bg-black-gradient">';
                        $html .= '<tr>';
                        $html .= '<th>N°</th>';
                        $html .= '<th>NOMBRES </th>';
                        $html .= '<th>SUELDO </th>';
                        $html .= '<th>TRANS P.</th>';
                        $html .= '<th>U. ESP</th>';
                        $html .= '<th>F. INGRESO</th>';
                        $html .= '<th>F. CONTRATO</th>';
                        $html .= '<th>F. RETIRO</th>';
                        $html .= '<th>UBICACIÓN</th>';
                        $html .= '<th>F. UBICACIÓN</th>';
                        $html .= '<th>DUI</th>';
                        if ($rrhh != "rrhh") {

                            if ($_estado === "3" || $_estado == "todos" || $_estado == "") {
                                $html .= '<th>DÍAS CONTRATADO</th>';
                            }
                            $html .= '<th>NUP</th>';
                            $html .= '<th>AFP</th>';
                            if ($_estado === "3" || $_estado == "todos" || $_estado == "") {
                                $html .= '<th>MOTIVO RETIRO</th>';
                            }
                            $html .= '<th>TIPO EMPLEADO</th>';
                            $html .= '<th>EDAD</th>';
                            $html .= '<th>F. NAC.</th>';
                            $html .= '<th>ISSS</th>';
                            $html .= '<th>NIT</th>';
                            $html .= '<th>BANCO</th>';
                            $html .= '<th>N° CUENTA</th>';
                            $html .= '<th>MOTIVO R.</th>';
                            $html .= '<th>UNIF.</th>';
                        } else {
                            $html .= '<th>EDO</th>';
                        }
                        $html .= '</tr>';
                        $html .= '</thead>';
                        $html .= '<tbody>';
                        foreach ($departamento['empleados'] as $empleado) {

                            $html .= '<tr>';
                            $html .= '<td>' . $empleado['codigo_empleado'] . '</td>';
                            $html .= '<td>' . $empleado['nombre_completo'] . '</td>';
                            $html .= '<td>' . $empleado['sueldo'] . '</td>';
                            $html .= '<td>' . $empleado['transp'] . '</td>';
                            $html .= '<td>' . $empleado['u_esp'] . '</td>';
                            $html .= '<td>' . $empleado['fecha_ingreso'] . '</td>';
                            $html .= '<td>' . $empleado['fecha_contratacion'] . '</td>';
                            $html .= '<td>' . $empleado['fecha_retiro'] . '</td>';
                            $html .= '<td>' . $empleado['nueva_ubicacion_transacciones_agente'] . '</td>';
                            $html .= '<td>' . $empleado['fecha_transacciones_agente'] . '</td>';
                            $html .= '<td>' . $empleado['numero_documento_identidad'] . '</td>';
                            if ($rrhh != "rrhh") {

                                if ($_estado === "3" || $_estado == "todos" || $_estado == "") {
                                    $html .= '<td>' . $empleado['dias_contratados'] . '</td>';
                                }
                                $html .= '<td>' . $empleado['nup'] . '</td>';
                                $html .= '<td>' . $empleado['codigo_afp'] . '</td>';
                                if ($_estado === "3" || $_estado == "todos" || $_estado == "") {
                                    $html .= '<td>' . $empleado['motivo_inactivo_transacc'] . '</td>';
                                }
                                $html .= '<td>' . $empleado['descripcion'] . '</td>';
                                $html .= '<td>' . $empleado['edad'] . '</td>';
                                $html .= '<td>' . $empleado['fecha_nacimiento'] . '</td>';
                                $html .= '<td>' . $empleado['numero_isss'] . '</td>';
                                $html .= '<td>' . $empleado['nit'] . '</td>';
                                $html .= '<td>' . $empleado['codigo_bank'] . '</td>';
                                $html .= '<td>' . $empleado['numero_cuenta'] . '</td>';
                                $html .= '<td>' . $empleado['observaciones_retiro'] . '</td>';
                                $html .= '<td>' . $empleado['uniforme'] . '</td>';
                            } else {
                                $html .= '<td>' . $empleado['estado_actual'] . '</td>';
                            }
                            $html .= '</tr>';
                        }
                        $html .= '</tbody></table>';

                        echo $html;
                    }
                }
            }

            ?>


        </div>


        <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

        <!-- jQuery 3 -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>

        <!-- DataTables -->
        <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
        <script src="../bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                $(".tablass").DataTable({
                    "order": [
                        [7, "desc"], // Luego ordenar por la segunda columna de fecha (índice 7) en orden descendente
                        [6, "desc"], // Ordenar por la primera columna de fecha (índice 6) en orden descendente
                        [1, "asc"], // Ordenar por la primera columna de fecha (índice 6) en orden descendente
                    ],
                    "columnDefs": [{
                            targets: 6, // Índice de la primera columna de fecha
                            render: function(data, type, row) {
                                if (type === "sort") {
                                    var parts = data.split("/");
                                    return new Date(parts[2], parts[1] - 1, parts[0]).getTime(); // Convertir la fecha a un valor numérico para ordenar correctamente
                                } else {
                                    return data; // Mostrar la fecha en formato DD/MM/YYYY
                                }
                            }
                        },
                        {
                            targets: 7, // Índice de la segunda columna de fecha
                            render: function(data, type, row) {
                                if (type === "sort") {
                                    var parts = data.split("/");
                                    return new Date(parts[2], parts[1] - 1, parts[0]).getTime(); // Convertir la fecha a un valor numérico para ordenar correctamente
                                } else {
                                    return data; // Mostrar la fecha en formato DD/MM/YYYY
                                }
                            }
                        }
                    ]
                });
            });


            $(window).on('load', function() {
                // Ocultar el preloader si se está recargando la página
                // Mostrar el preloader mientras la página se carga por primera vez
                $('#contenedor').fadeOut('slow', function() {
                    $('#contenido').fadeIn('slow');
                });

            });
        </script>
    </body>

    </html>


<?php
} else {
    echo "<script>window.close(); window.location.href = '../../generarcontratados';</script>";
}



?>