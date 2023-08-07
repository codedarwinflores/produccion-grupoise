<?php


require '../libexcel/vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;

//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

if (isset($_GET["typeReport"])  &&  !empty($_GET["typeReport"])) {


    date_default_timezone_set("America/El_Salvador");
    $fecha = date("d-m-Y");
    $hora = date("h:i:s A");


    //INCLUIR CONEXION
    require_once "../../../modelos/conexion.php";
    require_once "../../../controladores/empleados.controlador.php";
    require_once "../../../modelos/empleados.modelo.php";
    $fechasFiltrar = "";
    $rangoFecha = "";
    $estado_ingresos = "";

    if (isset($_GET['fechadesde']) || isset($_GET['fechahasta'])) {
        $fechadesde = $_GET['fechadesde'];
        $fechahasta = $_GET['fechahasta'];

        if (!empty($fechadesde) && !empty($fechahasta)) {
            $fechasFiltrar = " BETWEEN '" . $fechadesde . "' AND '" . $fechahasta . "'";
            $rangoFecha = $fechadesde . " - " . $fechahasta;
        }
    }

    if (isset($_GET['tipoagente'])) {
        if ($_GET['tipoagente'] == 2) {
            $estado_emp = "tbemp.estado IN (2)";
            $estado_ingresos = "Ingresos";
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and tbemp.fecha_contratacion" . $fechasFiltrar;
            }
        } else if ($_GET['tipoagente'] == 3) {
            $estado_emp = "tbemp.estado IN (3)";
            $estado_ingresos = "Egresos";
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and ret.fecha_retiro" . $fechasFiltrar;
            }
        } else {
            if (!empty($fechadesde) && !empty($fechahasta)) {
                $fechasFiltrar = " and tbemp.fecha_contratacion" . $fechasFiltrar . "or ret.fecha_retiro" . $fechasFiltrar;
            }
            $estado_emp = "tbemp.estado IN (2,3)";
            $estado_ingresos = "Ingresos/Egresos";
        }
    }
    if (isset($_GET['reportado_a_pnc'])) {
        $reporte = $_GET['reportado_a_pnc'];
        if ($reporte == "Si" || $reporte == "No" && !empty($reporte)) {
            $repotePnc = "tbemp.reportado_a_pnc='" . $reporte . "'";
        } else {
            $repotePnc = "tbemp.reportado_a_pnc IN('SI','NO','')";
        }
    }

    /* 	echo $fechasFiltrar; */



    /* FUNCION PARA UBICAR LA UBICACIÓN DEL EMPLEADO */
    function ubicacion_empleado($codigo)
    {

        if (!empty($codigo)) {

            $query = "SELECT tbemp.primer_nombre, tbemp.codigo_empleado, tbemp.primer_apellido, transacc.idagente_transacciones_agente, transacc.fecha_transacciones_agente, transacc.nueva_ubicacion_transacciones_agente FROM `tbl_empleados` tbemp INNER JOIN `transacciones_agente` transacc ON tbemp.codigo_empleado = transacc.idagente_transacciones_agente WHERE tbemp.codigo_empleado = " . $codigo . " and transacc.fecha_transacciones_agente = ( SELECT MAX(fecha_transacciones_agente) FROM transacciones_agente WHERE idagente_transacciones_agente = tbemp.codigo_empleado );";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $fecha = $data['fecha_transacciones_agente'];
                $ubicacion = $data['nueva_ubicacion_transacciones_agente'];
                $response = array('fechat' => $fecha, 'ubicaciont' => $ubicacion);
                return $response;
            }
        }

        return
            $response = array('fechat' => "- - -", 'ubicaciont' => "- - -");
    };


    /* SACAR EL BONO DE ACUERDO A LA UBICACIÓN DEL EMPLEADO */
    function bonoEmpleado($codUbicacion)
    {
        $bono = 0.00;
        if ($codUbicacion != "" && !empty($codUbicacion)) {
            $bono = 0.0;
            $separada = explode("-", $codUbicacion);
            $codigo_u = $separada[0];
            /* SELECT tbl_clientes_ubicaciones.id AS idubicacionc, `id_cliente`, `codigo_cliente`, clientes.id AS idcliente, clientes.nombre AS nombrecliente, bono_unidad, codigo_ubicacion, estado_cliente_ubicacion FROM `tbl_clientes_ubicaciones`, clientes WHERE clientes.id = tbl_clientes_ubicaciones.id_cliente and codigo_ubicacion='A0002003' */


            $query = "SELECT tbl_clientes_ubicaciones.id AS idubicacionc, `id_cliente`, `codigo_cliente`, clientes.id AS idcliente, clientes.nombre AS nombrecliente, bono_unidad, codigo_ubicacion, estado_cliente_ubicacion FROM `tbl_clientes_ubicaciones`, clientes WHERE clientes.id = tbl_clientes_ubicaciones.id_cliente and codigo_ubicacion='" . $codigo_u . "'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $bono_unidad = $data['bono_unidad'];
                return "$ " . number_format($bono_unidad, 2);
            }
        }


        return "$ " . number_format($bono, 2);
    }


    /* CONSULTAR UNIFORE */
    function ConsultarUniforme($idEmpleado)
    {

        if (!empty($idEmpleado) && $idEmpleado != null) {

            /* UNIFORME DESCUENTO */
            $query = "SELECT COUNT(codigo_empleado_descuento) as cant_empleados FROM `uniformedescuento` WHERE codigo_empleado_descuento=" . $idEmpleado;
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();
            $unidescuento = $sql->fetch(PDO::FETCH_ASSOC);

            /* UNIFORME REGALO */
            $queryy = "SELECT COUNT(idempleado) as cant_empleado FROM `regalo` WHERE idempleado =" . $idEmpleado;
            $sqll = Conexion::conectar()->prepare($queryy);
            $sqll->execute();
            $uniregalo = $sqll->fetch(PDO::FETCH_ASSOC);

            if ($unidescuento || $uniregalo) {
                if ($unidescuento['cant_empleados'] > 0 || $uniregalo['cant_empleado'] > 0) {
                    return "SI";
                }
            }
        }

        return "NO";
    }

    /* CAMPO TRANS.p */
    function transpDevengo($idEmpleado)
    {

        if (!empty($idEmpleado) && $idEmpleado != null) {

            $query = "SELECT * FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado = " . $idEmpleado . " and tipodescuento=2;";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();
            $datos = $sql->fetch(PDO::FETCH_ASSOC);

            if ($datos) {
                $tipoDescuento = $datos['tipodescuento'];
                $valor = $datos['valor'];

                return ("Tipo: " . $tipoDescuento . " $ " . $valor);
            }
        }

        return "- - -";
    }

    /* CALCULAR EDAD DEL EMPLEADO */
    function edad($fecha)
    {
        if (!empty($fecha)) {
            $nacimiento = new DateTime($fecha);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            $edad = $diferencia->format("%y");
            return $edad;
        }

        return 0;
    }

    /* CALCULAR EDAD DEL EMPLEADO */
    function diasContratado($fechaContrato, $fechaRetiro)
    {
        if (!empty($fechaContrato) && !empty($fechaRetiro)) {
            $fecha1 = new DateTime($fechaContrato); // Fecha inicial
            $fecha2 = new DateTime($fechaRetiro); // Fecha final

            $intervalo = $fecha1->diff($fecha2);
            $dias = $intervalo->days;
            return $dias;
        }

        return 0;
    }


    /* FUNCIÓN PARA IMPRIMIR LOS DEPARTAMENTOS DE LA EMPRESA */
    function departamentos($depa1, $depa2)
    {
        if (is_numeric($depa1) && $depa2 == "uno") {
            $stm = "SELECT tblemp.primer_nombre, d_emp.codigo,d_emp.nombre FROM tbl_empleados tblemp LEFT JOIN departamentos_empresa d_emp ON tblemp.id_departamento_empresa = d_emp.id WHERE tblemp.id = " . $depa1;
        } else if (is_numeric($depa1) && is_numeric($depa2)) {
            $stm = "SELECT * FROM `departamentos_empresa` where id between " . $depa1 . " and " . $depa2;
        } else {
            $stm = "SELECT d_emp.id,d_emp.codigo, d_emp.nombre, COUNT(tblemp.id) AS cantidad_empleados FROM departamentos_empresa d_emp INNER JOIN tbl_empleados tblemp ON d_emp.id = tblemp.id_departamento_empresa GROUP BY d_emp.codigo, d_emp.nombre HAVING COUNT(tblemp.id) > 0 ";
        }

        $sqlquery = Conexion::conectar()->prepare($stm);
        $sqlquery->execute();

        if (is_numeric($depa1) && $depa2 == "uno") {
            return $sqlquery->fetch(PDO::FETCH_ASSOC);
        } else {

            return $sqlquery->fetchAll();
        }
    }

    /* FiN FUNCIONES */
    /* __________________________________________________________________________ */



    //call the autoload
    //make a new spreadsheet object
    $spreadsheet = new Spreadsheet();
    //get current active sheet (first sheet)
    $sheet = $spreadsheet->getActiveSheet();


    //styling arrays
    //table head style
    $tableHead = [
        'font' => [
            'color' => [
                'rgb' => 'FFFFFF'
            ],
            'bold' => true,
            'size' => 12
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '31869B'
            ]
        ],
    ];
    //even row
    $evenRow = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'B8CCE4'
            ]
        ]
    ];
    //odd row
    $oddRow = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'FFFFFF'
            ]
        ]
    ];

    //odd row
    $encabezado = [
        'font' => [
            'color' => [
                'rgb' => 'FFFFFF'
            ],
            'bold' => true,
            'size' => 10
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '31869B'
            ]
        ],
    ];

    $fuente1 = [
        'font' => [
            'bold' => true,
            'size' => 12
        ]
    ];
    $fuente2 = [
        'font' => [
            'bold' => true,
            'size' => 11
        ]
    ];




    /* IMAGEN DE REPRESENTACIÓN */
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Grupo ISE');
    $drawing->setDescription('Grupo ISE');
    $drawing->setPath('grupoise.png'); // put your path and image here
    $drawing->setCoordinates('A1');
    /*  $drawing->setOffsetX(110);
    $drawing->setRotation(25); */
    $drawing->getShadow()->setVisible(true);
    $drawing->getShadow()->setDirection(60);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());

    //styling arrays end

    //set default font
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);

    /* OCULTAR LINEAS o cuadrícula de excel*/
    $spreadsheet->getActiveSheet()->setShowGridLines(false);

    /* HOJA - NOMBRE */
    $sheet->setTitle("ReporteEmpleados");

    //heading
    $spreadsheet->getActiveSheet()
        ->setCellValue('C1', "INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.")
        ->mergeCells("C1:G1")
        ->getStyle('C1:G1')->getFont()->setSize(12);

    // set cell alignment

    //set font style and background color IMAGE
    $spreadsheet->getActiveSheet()->getStyle('C1:G1')->applyFromArray($fuente1);
    $spreadsheet->getActiveSheet()->getStyle('A1:B1')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A2:B2')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A3:B3')->applyFromArray($encabezado);

    /* ENCABEZADO DE DATOS DE FECHA ESTILOS*/
    $spreadsheet->getActiveSheet()
        ->setCellValue('D2', "Fecha: ")
        ->setCellValue('D3', "Rango Fecha: ")
        ->setCellValue('D4', "Ingresos/Egresos: ")
        ->setCellValue('E2', $fecha . " " . $hora)
        ->setCellValue('E3', $rangoFecha)
        ->setCellValue('E4', $estado_ingresos);
    $spreadsheet->getActiveSheet()->getStyle('D2')->applyFromArray($fuente2);
    $spreadsheet->getActiveSheet()->getStyle('D3')->applyFromArray($fuente2);
    $spreadsheet->getActiveSheet()->getStyle('D4')->applyFromArray($fuente2);



    /* ALINEACIÓN DE DATOS */
    $spreadsheet->getActiveSheet()->getStyle('C1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

    //setting column width
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(6);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(12);


    /* OBTENER DATOS */
    $ext = $_GET["typeReport"];
    $filename = "Reporte-empleados-" . $fecha . "-" . $hora;
    /*  echo $filename; */

    /*------------------- INICIAR CONSULTAS --------------------------*/

    /* FILTRAR POR DEPARTAMENTOS */
    $departamento1 = "";
    $departamento2 = "";
    if (isset($_GET["empleados"]) && is_numeric($_GET["empleados"]) && !empty($_GET["empleados"])) {
        /* FILTRAR SOLO POR EL EMPLEADO */
        # code...
        $depa = departamentos($_GET['empleados'], "uno");
        /* CUERPO DEL DOCUMENTO EXCEL*/
        $filaDep = 6;
        $colDep = "B";
        $colResDep = "C";
        $filaHeadeTable = 8;
        $spreadsheet->getActiveSheet()
            ->setCellValue("B" . $filaDep, "Departamento: ")
            ->setCellValue("C" . $filaDep, $depa['codigo'] . " -" . $depa['nombre']);
        $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->applyFromArray($tableHead);
        $spreadsheet->getActiveSheet()->getStyle("C" . $filaDep)->applyFromArray($fuente2);
        //header text
        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $filaHeadeTable, "N°")
            ->setCellValue('B' . $filaHeadeTable, "Nombres")
            ->setCellValue('C' . $filaHeadeTable, "Sueldo")
            ->setCellValue('D' . $filaHeadeTable, "Transp")
            ->setCellValue('E' . $filaHeadeTable, "U. ESP")
            ->setCellValue('F' . $filaHeadeTable, "F. Ingreso")
            ->setCellValue('G' . $filaHeadeTable, "F. Cont")
            ->setCellValue('H' . $filaHeadeTable, "F. Retiro")
            ->setCellValue('I' . $filaHeadeTable, "Días")
            ->setCellValue('J' . $filaHeadeTable, "Ubicación")
            ->setCellValue('K' . $filaHeadeTable, "F. Ubicación")
            ->setCellValue('L' . $filaHeadeTable, "D.U.I")
            ->setCellValue('M' . $filaHeadeTable, "AFP")
            ->setCellValue('N' . $filaHeadeTable, "Tipo Empleado")
            ->setCellValue('O' . $filaHeadeTable, "Edad")
            ->setCellValue('P' . $filaHeadeTable, "F. Nacimiento")
            ->setCellValue('Q' . $filaHeadeTable, "ISS")
            ->setCellValue('R' . $filaHeadeTable, "NIT")
            ->setCellValue('S' . $filaHeadeTable, "Banco")
            ->setCellValue('T' . $filaHeadeTable, "Cuenta")
            ->setCellValue('U' . $filaHeadeTable, "M. Retiro")
            ->setCellValue('V' . $filaHeadeTable, "Estado");
        //set font style and background color
        $spreadsheet->getActiveSheet()->getStyle('A' . $filaHeadeTable . ':V' . $filaHeadeTable . '')->applyFromArray($tableHead);

        $campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa,ret.fecha_retiro, ret.motivo_inactivo";


        $tabla = " `tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco = bank.id LEFT JOIN retiro ret ON tbemp.id = ret.idempleado_retiro";

        $condicion = " tbemp.id=" . $_GET['empleados'] . " order by primer_nombre asc, primer_apellido asc";
        $array = [];


        /* CONSULTA A TABLA */
        $empleadoBuscar = new ModeloEmpleados();
        $datos = $empleadoBuscar->mostrarEmpleadoDb(
            $campos,
            $tabla,
            $condicion,
            $array
        );

        if (count($datos) > 0) {
            # code...
            $row = $filaHeadeTable + 1;
            foreach ($datos as $employee) {
                $ubicacionEmpleado = ubicacion_empleado($employee["codigo_empleado"]);
                $spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $row, $employee['codigo_empleado'])
                    ->setCellValue('B' . $row, $employee['primer_nombre'] . " " . $employee['segundo_nombre'] . " " . $employee['tercer_nombre'] . $employee['primer_apellido'] . " " . $employee['segundo_apellido'] . " " . $employee['apellido_casada'])
                    ->setCellValue('C' . $row, $employee['sueldo_que_devenga'])
                    ->setCellValue('D' . $row, transpDevengo($employee["id"]))
                    ->setCellValue('E' . $row, bonoEmpleado($ubicacionEmpleado['ubicaciont']))
                    ->setCellValue('F' . $row, $employee['fecha_ingreso'])
                    ->setCellValue('G' . $row, $employee['fecha_contratacion'])
                    ->setCellValue('H' . $row, !empty($employee['fecha_retiro']) ? $employee['fecha_retiro'] : "- - -")
                    ->setCellValue('I' . $row, diasContratado($employee['fecha_contratacion'], $employee['fecha_retiro']))
                    ->setCellValue('J' . $row, $ubicacionEmpleado['ubicaciont'])
                    ->setCellValue('K' . $row, $ubicacionEmpleado['fechat'])
                    ->setCellValue('L' . $row, $employee['numero_documento_identidad'])
                    ->setCellValue('M' . $row, $employee['nup'])
                    ->setCellValue('N' . $row, $employee['descripcion'])
                    ->setCellValue('O' . $row, edad($employee["fecha_nacimiento"]))
                    ->setCellValue('P' . $row, $employee['fecha_nacimiento'])
                    ->setCellValue('Q' . $row, $employee['numero_isss'])
                    ->setCellValue('R' . $row, $employee['nit'])
                    ->setCellValue('S' . $row, $employee["codigo_bank"] . "-" . $employee["nombre_bank"])
                    ->setCellValue('T' . $row, $employee["numero_cuenta"])
                    ->setCellValue('U' . $row, !empty($employee['motivo_inactivo']) ? $employee['motivo_inactivo'] : "- - -")
                    ->setCellValue('V' . $row, ($employee["estado"] == 1) ? "Solicitud" : (($employee["estado"] == 2) ? "Contratado" : (($employee["estado"] == 3) ? "Inactivo" : (($employee["estado"] == 4) ? "Incapacitado" : "Error"))));

                //set row style
                if ($row % 2 == 0) {
                    //even row
                    $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($evenRow);
                } else {
                    //odd row
                    $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($oddRow);
                }



                //increment row
                $row++;
            } //FinForEach

            //autofilter
            //define first row and last row
            $firstRow = $filaHeadeTable;
            $lastRow = $row - 1;
            /*   //set the autofilter
                $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":F" . $lastRow); */
        }

        $filaDep = $lastRow + 2;
        $filaHeadeTable = $lastRow + 4;
        if ($ext == "xlsx") {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename . ".xlsx";
        } else if ($ext == "xls") {
            $writer = new Xls($spreadsheet);
            $final_filename = $filename . ".xls";
        } else if ($ext == "csv") {
            $writer = new Csv($spreadsheet);
            $final_filename = $filename . ".csv";
        } else {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename . ".xlsx";
        }

        //set the header first, so the result will be treated as an xlsx file.
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //make it an attachment so we can define filename
        header('Content-Disposition: attachment;filename="' . urlencode($final_filename) . '"');

        //save into php output
        $writer->save('php://output');
    } else	if (
        isset($_GET["departamento1"]) && isset($_GET["departamento2"]) && !empty($_GET["departamento1"]) && !empty($_GET["departamento2"] && $_GET["departamento1"] != "*" && $_GET["departamento2"] != "*")
    ) {
        $depa1 = intval($_GET["departamento1"]);
        $depa2 = intval($_GET["departamento2"]);
        if ($depa1 > $depa2) {
            $depa1  = $depa2;
            $depa2  = $depa1;
        }

        $departamentos = departamentos($depa1, $depa2);

        $cont = 0;

        /* CUERPO DEL DOCUMENTO EXCEL*/
        $filaDep = 6;
        $colDep = "B";
        $colResDep = "C";
        $filaHeadeTable = 8;
        foreach ($departamentos as $depa) {
            # code...
            $spreadsheet->getActiveSheet()
                ->setCellValue("B" . $filaDep, "Departamento: ")
                ->setCellValue("C" . $filaDep, $depa['codigo'] . " - " . $depa['nombre']);
            $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->applyFromArray($tableHead);
            $spreadsheet->getActiveSheet()->getStyle("C" . $filaDep)->applyFromArray($fuente2);
            //header text
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $filaHeadeTable, "N°")
                ->setCellValue('B' . $filaHeadeTable, "Nombres")
                ->setCellValue('C' . $filaHeadeTable, "Sueldo")
                ->setCellValue('D' . $filaHeadeTable, "Transp")
                ->setCellValue('E' . $filaHeadeTable, "U. ESP")
                ->setCellValue('F' . $filaHeadeTable, "F. Ingreso")
                ->setCellValue('G' . $filaHeadeTable, "F. Cont")
                ->setCellValue('H' . $filaHeadeTable, "F. Retiro")
                ->setCellValue('I' . $filaHeadeTable, "Días")
                ->setCellValue('J' . $filaHeadeTable, "Ubicación")
                ->setCellValue('K' . $filaHeadeTable, "F. Ubicación")
                ->setCellValue('L' . $filaHeadeTable, "D.U.I")
                ->setCellValue('M' . $filaHeadeTable, "AFP")
                ->setCellValue('N' . $filaHeadeTable, "Tipo Empleado")
                ->setCellValue('O' . $filaHeadeTable, "Edad")
                ->setCellValue('P' . $filaHeadeTable, "F. Nacimiento")
                ->setCellValue('Q' . $filaHeadeTable, "ISS")
                ->setCellValue('R' . $filaHeadeTable, "NIT")
                ->setCellValue('S' . $filaHeadeTable, "Banco")
                ->setCellValue('T' . $filaHeadeTable, "Cuenta")
                ->setCellValue('U' . $filaHeadeTable, "M. Retiro")
                ->setCellValue('V' . $filaHeadeTable, "Estado");
            //set font style and background color
            $spreadsheet->getActiveSheet()->getStyle('A' . $filaHeadeTable . ':V' . $filaHeadeTable . '')->applyFromArray($tableHead);

            $campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa, ret.fecha_retiro, ret.motivo_inactivo";


            $tabla = " `tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco = bank.id LEFT JOIN retiro ret ON tbemp.id = ret.idempleado_retiro";

            $condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . " order by primer_nombre asc, primer_apellido asc";
            $array = [];


            /* CONSULTA A TABLA */
            $empleadoBuscar = new ModeloEmpleados();
            $datos = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);

            if (count($datos) > 0) {
                # code...
                $row = $filaHeadeTable + 1;
                foreach ($datos as $employee) {
                    $ubicacionEmpleado = ubicacion_empleado($employee["codigo_empleado"]);
                    $spreadsheet->getActiveSheet()
                        ->setCellValue('A' . $row, $employee['codigo_empleado'])
                        ->setCellValue('B' . $row, $employee['primer_nombre'] . " " . $employee['segundo_nombre'] . " " . $employee['tercer_nombre'] . $employee['primer_apellido'] . " " . $employee['segundo_apellido'] . " " . $employee['apellido_casada'])
                        ->setCellValue('C' . $row, $employee['sueldo_que_devenga'])
                        ->setCellValue('D' . $row, transpDevengo($employee["id"]))
                        ->setCellValue('E' . $row, bonoEmpleado($ubicacionEmpleado['ubicaciont']))
                        ->setCellValue('F' . $row, $employee['fecha_ingreso'])
                        ->setCellValue('G' . $row, $employee['fecha_contratacion'])
                        ->setCellValue('H' . $row, !empty($employee['fecha_retiro']) ? $employee['fecha_retiro'] : "- - -")
                        ->setCellValue('I' . $row, diasContratado($employee['fecha_contratacion'], $employee['fecha_retiro']))
                        ->setCellValue('J' . $row, $ubicacionEmpleado['ubicaciont'])
                        ->setCellValue('K' . $row, $ubicacionEmpleado['fechat'])
                        ->setCellValue('L' . $row, $employee['numero_documento_identidad'])
                        ->setCellValue('M' . $row, $employee['nup'])
                        ->setCellValue('N' . $row, $employee['descripcion'])
                        ->setCellValue('O' . $row, edad($employee["fecha_nacimiento"]))
                        ->setCellValue('P' . $row, $employee['fecha_nacimiento'])
                        ->setCellValue('Q' . $row, $employee['numero_isss'])
                        ->setCellValue('R' . $row, $employee['nit'])
                        ->setCellValue('S' . $row, $employee["codigo_bank"] . "-" . $employee["nombre_bank"])
                        ->setCellValue('T' . $row, $employee["numero_cuenta"])
                        ->setCellValue('U' . $row, !empty($employee['motivo_inactivo']) ? $employee['motivo_inactivo'] : "- - -")
                        ->setCellValue('V' . $row, ($employee["estado"] == 1) ? "Solicitud" : (($employee["estado"] == 2) ? "Contratado" : (($employee["estado"] == 3) ? "Inactivo" : (($employee["estado"] == 4) ? "Incapacitado" : "Error"))));

                    //set row style
                    if ($row % 2 == 0) {
                        //even row
                        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($evenRow);
                    } else {
                        //odd row
                        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($oddRow);
                    }



                    //increment row
                    $row++;
                } //FinForEach

                //autofilter
                //define first row and last row
                $firstRow = $filaHeadeTable;
                $lastRow = $row - 1;
                /*   //set the autofilter
                $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":F" . $lastRow); */
            } else {
                $row = $filaHeadeTable + 1;
                $firstRow = $filaHeadeTable;
                $lastRow = $row - 1;
                $row++;
            }

            $filaDep = $lastRow + 2;
            $filaHeadeTable = $lastRow + 4;
        }

        if ($ext == "xlsx") {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename . ".xlsx";
        } else if ($ext == "xls") {
            $writer = new Xls($spreadsheet);
            $final_filename = $filename . ".xls";
        } else if ($ext == "csv") {
            $writer = new Csv($spreadsheet);
            $final_filename = $filename . ".csv";
        } else {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename . ".xlsx";
        }

        //set the header first, so the result will be treated as an xlsx file.
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //make it an attachment so we can define filename
        header('Content-Disposition: attachment;filename="' . urlencode($final_filename) . '"');

        //save into php output
        $writer->save('php://output');
    } else if ($_GET["departamento1"] === "*" || $_GET["departamento2"] === "*") {

        $depa1 = $_GET["departamento1"];
        $depa2 = $_GET["departamento2"];
        if ($depa1 === "*" && $depa2 === "*") {

            $departamentos = departamentos("todos", "todos");

            $cont = 0;

            /* CUERPO DEL DOCUMENTO EXCEL*/
            $filaDep = 6;
            $colDep = "B";
            $colResDep = "C";
            $filaHeadeTable = 8;

            foreach ($departamentos as $depa) {

                # code...
                $spreadsheet->getActiveSheet()
                    ->setCellValue("B" . $filaDep, "Departamento: ")
                    ->setCellValue("C" . $filaDep, $depa['codigo'] . " - " . $depa['nombre']);
                $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->applyFromArray($tableHead);
                $spreadsheet->getActiveSheet()->getStyle("C" . $filaDep)->applyFromArray($fuente2);
                //header text
                $spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $filaHeadeTable, "N°")
                    ->setCellValue('B' . $filaHeadeTable, "Nombres")
                    ->setCellValue('C' . $filaHeadeTable, "Sueldo")
                    ->setCellValue('D' . $filaHeadeTable, "Transp")
                    ->setCellValue('E' . $filaHeadeTable, "U. ESP")
                    ->setCellValue('F' . $filaHeadeTable, "F. Ingreso")
                    ->setCellValue('G' . $filaHeadeTable, "F. Cont")
                    ->setCellValue('H' . $filaHeadeTable, "F. Retiro")
                    ->setCellValue('I' . $filaHeadeTable, "Días")
                    ->setCellValue('J' . $filaHeadeTable, "Ubicación")
                    ->setCellValue('K' . $filaHeadeTable, "F. Ubicación")
                    ->setCellValue('L' . $filaHeadeTable, "D.U.I")
                    ->setCellValue('M' . $filaHeadeTable, "AFP")
                    ->setCellValue('N' . $filaHeadeTable, "Tipo Empleado")
                    ->setCellValue('O' . $filaHeadeTable, "Edad")
                    ->setCellValue('P' . $filaHeadeTable, "F. Nacimiento")
                    ->setCellValue('Q' . $filaHeadeTable, "ISS")
                    ->setCellValue('R' . $filaHeadeTable, "NIT")
                    ->setCellValue('S' . $filaHeadeTable, "Banco")
                    ->setCellValue('T' . $filaHeadeTable, "Cuenta")
                    ->setCellValue('U' . $filaHeadeTable, "M. Retiro")
                    ->setCellValue('V' . $filaHeadeTable, "Estado");
                //set font style and background color
                $spreadsheet->getActiveSheet()->getStyle('A' . $filaHeadeTable . ':V' . $filaHeadeTable . '')->applyFromArray($tableHead);

                /* CONSULTA */
                $campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa, ret.fecha_retiro, ret.motivo_inactivo ";

                $tabla = " `tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco = bank.id LEFT JOIN retiro ret ON tbemp.id = ret.idempleado_retiro";

                $condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . " order by primer_nombre asc, primer_apellido asc";
                $array = [];


                /* CONSULTA A TABLA */
                $empleadoBuscar = new ModeloEmpleados();
                $datos = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);

                if (count($datos) > 0) {
                    # code...
                    $row = $filaHeadeTable + 1;
                    foreach ($datos as $employee) {
                        $ubicacionEmpleado = ubicacion_empleado($employee["codigo_empleado"]);
                        $spreadsheet->getActiveSheet()
                            ->setCellValue('A' . $row, $employee['codigo_empleado'])
                            ->setCellValue('B' . $row, $employee['primer_nombre'] . " " . $employee['segundo_nombre'] . " " . $employee['tercer_nombre'] . $employee['primer_apellido'] . " " . $employee['segundo_apellido'] . " " . $employee['apellido_casada'])
                            ->setCellValue('C' . $row, $employee['sueldo_que_devenga'])
                            ->setCellValue('D' . $row, transpDevengo($employee["id"]))
                            ->setCellValue('E' . $row, bonoEmpleado($ubicacionEmpleado['ubicaciont']))
                            ->setCellValue('F' . $row, $employee['fecha_ingreso'])
                            ->setCellValue('G' . $row, $employee['fecha_contratacion'])
                            ->setCellValue('H' . $row, !empty($employee['fecha_retiro']) ? $employee['fecha_retiro'] : "- - -")
                            ->setCellValue('I' . $row, diasContratado($employee['fecha_contratacion'], $employee['fecha_retiro']))
                            ->setCellValue('J' . $row, $ubicacionEmpleado['ubicaciont'])
                            ->setCellValue('K' . $row, $ubicacionEmpleado['fechat'])
                            ->setCellValue('L' . $row, $employee['numero_documento_identidad'])
                            ->setCellValue('M' . $row, $employee['nup'])
                            ->setCellValue('N' . $row, $employee['descripcion'])
                            ->setCellValue('O' . $row, edad($employee["fecha_nacimiento"]))
                            ->setCellValue('P' . $row, $employee['fecha_nacimiento'])
                            ->setCellValue('Q' . $row, $employee['numero_isss'])
                            ->setCellValue('R' . $row, $employee['nit'])
                            ->setCellValue('S' . $row, $employee["codigo_bank"] . "-" . $employee["nombre_bank"])
                            ->setCellValue('T' . $row, $employee["numero_cuenta"])
                            ->setCellValue('U' . $row, !empty($employee['motivo_inactivo']) ? $employee['motivo_inactivo'] : "- - -")
                            ->setCellValue('V' . $row, ($employee["estado"] == 1) ? "Solicitud" : (($employee["estado"] == 2) ? "Contratado" : (($employee["estado"] == 3) ? "Inactivo" : (($employee["estado"] == 4) ? "Incapacitado" : "Error"))));

                        //set row style
                        if ($row % 2 == 0) {
                            //even row
                            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($evenRow);
                        } else {
                            //odd row
                            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($oddRow);
                        }



                        //increment row
                        $row++;
                    } //FinForEach

                    //autofilter
                    //define first row and last row
                    $firstRow = $filaHeadeTable;
                    $lastRow = $row - 1;
                    /*   //set the autofilter
                $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":F" . $lastRow); */
                } else {
                    $row = $filaHeadeTable + 1;
                    $firstRow = $filaHeadeTable;
                    $lastRow = $row - 1;
                    $row++;
                }

                $filaDep = $lastRow + 2;
                $filaHeadeTable = $lastRow + 4;
            }/* FIN DEL CUERPO DE DOCUMENTO EXCEL */

            if ($ext == "xlsx") {
                $writer = new Xlsx($spreadsheet);
                $final_filename = $filename . ".xlsx";
            } else if ($ext == "xls") {
                $writer = new Xls($spreadsheet);
                $final_filename = $filename . ".xls";
            } else if ($ext == "csv") {
                $writer = new Csv($spreadsheet);
                $final_filename = $filename . ".csv";
            } else {
                $writer = new Xlsx($spreadsheet);
                $final_filename = $filename . ".xlsx";
            }

            //set the header first, so the result will be treated as an xlsx file.
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            //make it an attachment so we can define filename
            header('Content-Disposition: attachment;filename="' . urlencode($final_filename) . '"');

            //save into php output
            $writer->save('php://output');
        } else {

            /* CONDICIÓN SOLO POR UN DEPARTAMENTO */
            if ($depa1 != "*" && $depa2 === "*") {
                $depa2 = $depa1;
            } else if ($depa1 === "*" && $depa2 != "*") {
                $depa1 = $depa2;
            }

            $departamentos = departamentos($depa1, $depa2);
            $cont = 0;
            /* CUERPO DEL DOCUMENTO EXCEL*/
            $filaDep = 6;
            $colDep = "B";
            $colResDep = "C";
            $filaHeadeTable = 8;
            foreach ($departamentos as $depa) {
                # code...
                $spreadsheet->getActiveSheet()
                    ->setCellValue("B" . $filaDep, "Departamento: ")
                    ->setCellValue("C" . $filaDep, $depa['codigo'] . " - " . $depa['nombre']);
                $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->applyFromArray($tableHead);
                $spreadsheet->getActiveSheet()->getStyle("C" . $filaDep)->applyFromArray($fuente2);
                //header text
                $spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $filaHeadeTable, "N°")
                    ->setCellValue('B' . $filaHeadeTable, "Nombres")
                    ->setCellValue('C' . $filaHeadeTable, "Sueldo")
                    ->setCellValue('D' . $filaHeadeTable, "Transp")
                    ->setCellValue('E' . $filaHeadeTable, "U. ESP")
                    ->setCellValue('F' . $filaHeadeTable, "F. Ingreso")
                    ->setCellValue('G' . $filaHeadeTable, "F. Cont")
                    ->setCellValue('H' . $filaHeadeTable, "F. Retiro")
                    ->setCellValue('I' . $filaHeadeTable, "Días")
                    ->setCellValue('J' . $filaHeadeTable, "Ubicación")
                    ->setCellValue('K' . $filaHeadeTable, "F. Ubicación")
                    ->setCellValue('L' . $filaHeadeTable, "D.U.I")
                    ->setCellValue('M' . $filaHeadeTable, "AFP")
                    ->setCellValue('N' . $filaHeadeTable, "Tipo Empleado")
                    ->setCellValue('O' . $filaHeadeTable, "Edad")
                    ->setCellValue('P' . $filaHeadeTable, "F. Nacimiento")
                    ->setCellValue('Q' . $filaHeadeTable, "ISS")
                    ->setCellValue('R' . $filaHeadeTable, "NIT")
                    ->setCellValue('S' . $filaHeadeTable, "Banco")
                    ->setCellValue('T' . $filaHeadeTable, "Cuenta")
                    ->setCellValue('U' . $filaHeadeTable, "M. Retiro")
                    ->setCellValue('V' . $filaHeadeTable, "Estado");
                //set font style and background color
                $spreadsheet->getActiveSheet()->getStyle('A' . $filaHeadeTable . ':V' . $filaHeadeTable . '')->applyFromArray($tableHead);
                $campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa, ret.fecha_retiro, ret.motivo_inactivo";
                $tabla = " `tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco = bank.id LEFT JOIN retiro ret ON tbemp.id = ret.idempleado_retiro";
                $condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . " order by primer_nombre asc, primer_apellido asc";
                $array = [];



                /* CONSULTA A TABLA */
                $empleadoBuscar = new ModeloEmpleados();
                $datos = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);

                if (count($datos) > 0) {
                    # code...
                    $row = $filaHeadeTable + 1;
                    foreach ($datos as $employee) {
                        $ubicacionEmpleado = ubicacion_empleado($employee["codigo_empleado"]);
                        $spreadsheet->getActiveSheet()
                            ->setCellValue('A' . $row, $employee['codigo_empleado'])
                            ->setCellValue('B' . $row, $employee['primer_nombre'] . " " . $employee['segundo_nombre'] . " " . $employee['tercer_nombre'] . $employee['primer_apellido'] . " " . $employee['segundo_apellido'] . " " . $employee['apellido_casada'])
                            ->setCellValue('C' . $row, $employee['sueldo_que_devenga'])
                            ->setCellValue('D' . $row, transpDevengo($employee["id"]))
                            ->setCellValue('E' . $row, bonoEmpleado($ubicacionEmpleado['ubicaciont']))
                            ->setCellValue('F' . $row, $employee['fecha_ingreso'])
                            ->setCellValue('G' . $row, $employee['fecha_contratacion'])
                            ->setCellValue('H' . $row, !empty($employee['fecha_retiro']) ? $employee['fecha_retiro'] : "- - -")
                            ->setCellValue('I' . $row, diasContratado($employee['fecha_contratacion'], $employee['fecha_retiro']))
                            ->setCellValue('J' . $row, $ubicacionEmpleado['ubicaciont'])
                            ->setCellValue('K' . $row, $ubicacionEmpleado['fechat'])
                            ->setCellValue('L' . $row, $employee['numero_documento_identidad'])
                            ->setCellValue('M' . $row, $employee['nup'])
                            ->setCellValue('N' . $row, $employee['descripcion'])
                            ->setCellValue('O' . $row, edad($employee["fecha_nacimiento"]))
                            ->setCellValue('P' . $row, $employee['fecha_nacimiento'])
                            ->setCellValue('Q' . $row, $employee['numero_isss'])
                            ->setCellValue('R' . $row, $employee['nit'])
                            ->setCellValue('S' . $row, $employee["codigo_bank"] . "-" . $employee["nombre_bank"])
                            ->setCellValue('T' . $row, $employee["numero_cuenta"])
                            ->setCellValue('U' . $row, !empty($employee['motivo_inactivo']) ? $employee['motivo_inactivo'] : "- - -")
                            ->setCellValue('V' . $row, ($employee["estado"] == 1) ? "Solicitud" : (($employee["estado"] == 2) ? "Contratado" : (($employee["estado"] == 3) ? "Inactivo" : (($employee["estado"] == 4) ? "Incapacitado" : "Error"))));

                        //set row style
                        if ($row % 2 == 0) {
                            //even row
                            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($evenRow);
                        } else {
                            //odd row
                            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':V' . $row)->applyFromArray($oddRow);
                        }



                        //increment row
                        $row++;
                    } //FinForEach

                    //autofilter
                    //define first row and last row
                    $firstRow = $filaHeadeTable;
                    $lastRow = $row - 1;
                    /*   //set the autofilter
                $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":F" . $lastRow); */
                } else {
                    $row = $filaHeadeTable + 1;
                    $firstRow = $filaHeadeTable;
                    $lastRow = $row - 1;
                    $row++;
                }

                $filaDep = $lastRow + 2;
                $filaHeadeTable = $lastRow + 4;
                if ($ext == "xlsx") {
                    $writer = new Xlsx($spreadsheet);
                    $final_filename = $filename . ".xlsx";
                } else if ($ext == "xls") {
                    $writer = new Xls($spreadsheet);
                    $final_filename = $filename . ".xls";
                } else if ($ext == "csv") {
                    $writer = new Csv($spreadsheet);
                    $final_filename = $filename . ".csv";
                } else {
                    $writer = new Xlsx($spreadsheet);
                    $final_filename = $filename . ".xlsx";
                }

                //set the header first, so the result will be treated as an xlsx file.
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

                //make it an attachment so we can define filename
                header('Content-Disposition: attachment;filename="' . urlencode($final_filename) . '"');

                //save into php output
                $writer->save('php://output');
            }
        }
    }
}
