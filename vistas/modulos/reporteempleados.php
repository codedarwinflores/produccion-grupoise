<?php

session_start();

require './libexcel/vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;

//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnIterator;


set_time_limit(0); // Esto desactiva el límite de tiempo de ejecución
ini_set('max_execution_time', 3000); // 3000 segundos = 50 minutos
ini_set('max_input_time', 3000);
ini_set('memory_limit', '512M');

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
                $fechasFiltrar = " and DATE(tbemp.fecha_contratacion)" . $fechasFiltrar;
            }
        } else if ($_POST['tipoagente'] == 3) {
            $estado_emp = "tbemp.estado IN (3)";
            $estado_ingresos = "Egresos";
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and DATE(ret.fecha_retiro)" . $fechasFiltrar;
            }
        } else {
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and DATE(tbemp.fecha_contratacion)" . $fechasFiltrar . " or DATE(ret.fecha_retiro)" . $fechasFiltrar;
            }
            $estado_emp = "tbemp.estado IN (2,3)";
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


    /* BONO EMPLEADO */
    function bonoEmpleado($codUbicacion)
    {
        if (empty($codUbicacion)) {
            return "$ 0.00";
        }

        $separada = explode("-", $codUbicacion);
        $codigo_u = $separada[0];

        $query = "SELECT bono_unidad FROM tbl_clientes_ubicaciones 
              INNER JOIN clientes ON clientes.id = tbl_clientes_ubicaciones.id_cliente 
              WHERE codigo_ubicacion=?";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute([$codigo_u]);
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        if ($data && isset($data['bono_unidad']) && !empty($data['bono_unidad'])) {
            return  $data['bono_unidad'];
        }

        return "-";
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


    /* IMPRIMI TABLA DE ACUERDO A LA CONSULTA ENVIADA */

    function crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array, $estado, $rrhh)
    {
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

            $ubicacion = ubicacion_empleado($value['codigo_empleado']);
            $fechaContratacion = formatearFecha($value["fecha_contratacion"]);
            $fechaRetiro = (!empty($value['fecha_retiro']) ? formatearFecha($value['fecha_retiro']) : "-");
            $diasContratados = diasContratado($value['fecha_contratacion'], $value['fecha_retiro']);
            $edadEmpleado = edad($value["fecha_nacimiento"]);

            $empleados_array[] = array(
                "codigo_empleado" => $value["codigo_empleado"],
                "nombre_completo" => mb_strtoupper(($value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"]), "UTF-8"),
                "sueldo" => ($value["sueldo"] != null && !empty($value["sueldo"]) ? number_format(($value["sueldo"] * 2), 2) : number_format(0, 2)),
                "transp" => (!empty($value["tipodescuento"]) && $value["tipodescuento"] != null ? $value["tipodescuento"] : ""),
                "u_esp" => bonoEmpleado($ubicacion["ubicaciont"]),
                "fecha_ingreso" => $fechaContratacion,
                "fecha_contratacion" => $fechaContratacion,
                "fecha_retiro" => $fechaRetiro,
                "nueva_ubicacion_transacciones_agente" => $ubicacion["ubicaciont"],
                "fecha_transacciones_agente" => $ubicacion["fechat"],
                "numero_documento_identidad" => $value["numero_documento_identidad"],
                "dias_contratados" => $diasContratados,
                "nup" => $value["nup"],
                "codigo_afp" => $value["codigo_afp"],
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

        $response = array(
            "cantEmpleados" => $contEmp,
            "empleados" => $empleados_array,
        );

        return $response;
    }

?>

    <?php

    /* FILTRAR POR DEPARTAMENTOS */

    $departamento1 = "";
    $departamento2 = "";
    $campos = "tbemp.id,tbemp.primer_nombre,tbemp.primer_apellido,tbemp.segundo_nombre,tbemp.segundo_apellido,tbemp.tercer_nombre,tbemp.apellido_casada,tbemp.id_departamento,tbemp.numero_isss,tbemp.numero_documento_identidad,tbemp.nit,tbemp.codigo_afp,tbemp.nup,tbemp.fecha_nacimiento,tbemp.estado,tbemp.sueldo,tbemp.fecha_contratacion,tbemp.fecha_ingreso,tbemp.numero_cuenta,tbemp.codigo_empleado,cargo.id AS cargoid,cargo.descripcion,bank.codigo AS codigo_bank,bank.nombre AS nombre_bank, d_emp.id as d_empid, d_emp.nombre as nombre_empresa, ret.fecha_retiro,ret.motivo_inactivo,ret.observaciones_retiro,personal_transacc.nombre AS motivo_inactivo_transacc,dev_desc.tipodescuento, IF(EXISTS(SELECT 1 FROM `uniformedescuento` WHERE codigo_empleado_descuento = tbemp.id) OR EXISTS(SELECT 1 FROM `regalo` WHERE idempleado = tbemp.id), 'SI', 'NO') AS tiene_uniforme";

    $tabla = "`tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa=d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco = bank.id LEFT JOIN (SELECT idempleado_retiro, MIN(id) AS min_id_retiro FROM retiro GROUP BY idempleado_retiro) min_retiro ON tbemp.id = min_retiro.idempleado_retiro LEFT JOIN retiro ret ON min_retiro.idempleado_retiro = ret.idempleado_retiro AND min_retiro.min_id_retiro = ret.id LEFT JOIN tbl_transacciones_personal personal_transacc ON ret.motivo_inactivo = personal_transacc.id LEFT JOIN tbl_empleados_devengos_descuentos dev_desc ON tbemp.id = dev_desc.id_empleado AND dev_desc.tipodescuento = '2'";


    if (isset($_POST["empleados"]) && is_numeric($_POST["empleados"]) && !empty($_POST["empleados"])) {


        /* FILTRAR SOLO POR EL EMPLEADO */
        $cont = 0;
        $departamento = departamentos($_POST['empleados'], "uno");

        /* AQUI VAN LAS CONSULTAS */
        $condicion = " tbemp.id=" . $_POST['empleados'] . "";
        $array = [];
        $cont++;
        $datosEmpleados = crearTablaEmpleados(
            $cont,
            $campos,
            $tabla,
            $condicion,
            $array,
            $_estado,
            $rrhh
        );

        $departamentosJSON[] = array(
            'codigo' => $departamento['codigo'],
            'nombre' => $departamento['nombre'],
            'empleados' => $datosEmpleados["empleados"],
            'cantEmpleados' => $datosEmpleados["cantEmpleados"],
        );


        // Crear el array de respuesta
        $response = array(
            'datos' => $departamentosJSON,
        );

        $datos =  json_encode($response, JSON_UNESCAPED_UNICODE);
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

            $datosEmpleados = crearTablaEmpleados(
                $cont,
                $campos,
                $tabla,
                $condicion,
                $array,
                $_estado,
                $rrhh
            );

            $departamentosJSON[] = array(
                'codigo' => $depa['codigo'],
                'nombre' => $depa['nombre'],
                'empleados' => $datosEmpleados["empleados"],
                'cantEmpleados' => $datosEmpleados["cantEmpleados"],
            );
        }

        // Crear el array de respuesta
        $response = array(
            'datos' => $departamentosJSON,
        );

        // Retornar el JSON
        $datos =  json_encode($response, JSON_UNESCAPED_UNICODE);
    } else if ($_POST["departamento1"] === "*" || $_POST["departamento2"] === "*") {

        $depa1 = $_POST["departamento1"];
        $depa2 = $_POST["departamento2"];
        if ($depa1 === "*" && $depa2 === "*") {

            $departamentos = departamentos("todos", "todos");

            $cont = 0;

            foreach ($departamentos as $depa) {

                /* FILTRAR TODOS */

                $condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . ";";
                $array = [];
                $cont++;
                $datosEmpleados = crearTablaEmpleados(
                    $cont,
                    $campos,
                    $tabla,
                    $condicion,
                    $array,
                    $_estado,
                    $rrhh
                );

                $departamentosJSON[] = array(
                    'codigo' => $depa['codigo'],
                    'nombre' => $depa['nombre'],
                    'empleados' => $datosEmpleados["empleados"],
                    'cantEmpleados' => $datosEmpleados["cantEmpleados"],
                );
            }

            // Crear el array de respuesta
            $response = array(
                'datos' => $departamentosJSON,
            );
            $datos =  json_encode($response, JSON_UNESCAPED_UNICODE);
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

                $condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . ";";
                $array = [];



                $cont++;
                $datosEmpleados = crearTablaEmpleados(
                    $cont,
                    $campos,
                    $tabla,
                    $condicion,
                    $array,
                    $_estado,
                    $rrhh
                );

                $departamentosJSON[] = array(
                    'codigo' => $depa['codigo'],
                    'nombre' => $depa['nombre'],
                    'empleados' => $datosEmpleados["empleados"],
                    'cantEmpleados' => $datosEmpleados["cantEmpleados"],
                );
            }

            // Crear el array de respuesta
            $response = array(
                'datos' => $departamentosJSON,
            );

            $datos =  json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }

    var_dump(json_decode($datos, true));
}
    ?>
