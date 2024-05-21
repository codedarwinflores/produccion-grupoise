<?php


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


if (isset($_SESSION["perfil"])) {
    # code...


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
    $drawing->setPath('./reportesexcel/grupoise.png'); // put your path and image here
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
        ->setCellValue('E2', $fecha1 . " " . $hora1)
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
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(12);


    /* OBTENER DATOS */
    $ext = "xlsx";
    $filename = "reporte-empleados";
    /*  echo $filename; */

    /*------------------- INICIAR CONSULTAS --------------------------*/



    $cont = 0;

    /* CUERPO DEL DOCUMENTO EXCEL*/
    $filaDep = 6;
    $colDep = "B";
    $colResDep = "C";
    $filaHeadeTable = 8;

    if (!empty($data['datos']) && is_array($data['datos'])) {
        foreach ($data['datos'] as $departamento) {
            if (!empty($departamento['empleados']) && is_array($departamento['empleados'])) {
                # code...
                $spreadsheet->getActiveSheet()
                    ->setCellValue("B" . $filaDep, "Departamento: ")
                    ->setCellValue("C" . $filaDep, $departamento['codigo'] . " - " . $departamento['nombre']);
                $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->applyFromArray($tableHead);
                $spreadsheet->getActiveSheet()->getStyle("C" . $filaDep)->applyFromArray($fuente2);
                //header text
                $spreadsheet->getActiveSheet()
                    ->setCellValue('A' . $filaHeadeTable, "N°")
                    ->setCellValue('B' . $filaHeadeTable, "NOMBRES")
                    ->setCellValue('C' . $filaHeadeTable, "SUELDO")
                    ->setCellValue('D' . $filaHeadeTable, "TRANSP.")
                    ->setCellValue('E' . $filaHeadeTable, "U. ESP")
                    ->setCellValue('F' . $filaHeadeTable, "F. INGRESO")
                    ->setCellValue('G' . $filaHeadeTable, "F. CONTRATO")
                    ->setCellValue('H' . $filaHeadeTable, "F. RETIRO")
                    ->setCellValue('I' . $filaHeadeTable, "UBICACIÓN")
                    ->setCellValue('J' . $filaHeadeTable, "F. UBICACIÓN")
                    ->setCellValue('K' . $filaHeadeTable, "DUI")
                    ->setCellValue('L' . $filaHeadeTable, "DÍAS")
                    ->setCellValue('M' . $filaHeadeTable, "NUP")
                    ->setCellValue('N' . $filaHeadeTable, "AFP")
                    ->setCellValue('O' . $filaHeadeTable, "MOTIVO RETIRO")
                    ->setCellValue('P' . $filaHeadeTable, "TIPO DE EMPLEADO")
                    ->setCellValue('Q' . $filaHeadeTable, "EDAD")
                    ->setCellValue('R' . $filaHeadeTable, "NACIMIENTO")
                    ->setCellValue('S' . $filaHeadeTable, "ISSS")
                    ->setCellValue('T' . $filaHeadeTable, "NIT")
                    ->setCellValue('U' . $filaHeadeTable, "BANCO")
                    ->setCellValue('V' . $filaHeadeTable, "CUENTA")
                    ->setCellValue('W' . $filaHeadeTable, "MOTIVO")
                    ->setCellValue('X' . $filaHeadeTable, "CON UNIFORME")
                    ->setCellValue('Y' . $filaHeadeTable, "ESTADO ACTUAL");
                //set font style and background color
                $spreadsheet->getActiveSheet()->getStyle('A' . $filaHeadeTable . ':Y' . $filaHeadeTable . '')->applyFromArray($tableHead);


                # code...
                $row = $filaHeadeTable + 1;
                foreach ($departamento['empleados'] as $employee) {

                    $spreadsheet->getActiveSheet()
                        ->setCellValue('A' . $row, $employee['codigo_empleado'])
                        ->setCellValue('B' . $row, (preg_replace('/\s+/', ' ', $employee['nombre_completo'])))
                        ->setCellValue('C' . $row, $employee['sueldo'])
                        ->setCellValue('D' . $row, $employee["transp"])
                        ->setCellValue('E' . $row, $employee["u_esp"])
                        ->setCellValue('F' . $row, $employee['fecha_ingreso'])
                        ->setCellValue('G' . $row, $employee['fecha_contratacion'])
                        ->setCellValue('H' . $row, $employee['fecha_retiro'])
                        ->setCellValue('I' . $row, $employee['nueva_ubicacion_transacciones_agente'])
                        ->setCellValue('J' . $row, $employee['fecha_transacciones_agente'])
                        ->setCellValue('K' . $row, $employee['numero_documento_identidad'])
                        ->setCellValue('L' . $row, $employee["dias_contratados"])
                        ->setCellValue('M' . $row, $employee['nup'])
                        ->setCellValue('N' . $row, $employee['codigo_afp'])
                        ->setCellValue('O' . $row,  $employee['motivo_inactivo_transacc'])
                        ->setCellValue('P' . $row, $employee['descripcion'])
                        ->setCellValue('Q' . $row, $employee["edad"])
                        ->setCellValue('R' . $row, $employee['fecha_nacimiento'])
                        ->setCellValue('S' . $row, $employee['numero_isss'])
                        ->setCellValue('T' . $row, $employee['nit'])
                        ->setCellValue('U' . $row, $employee["codigo_bank"])
                        ->setCellValue('V' . $row, $employee["numero_cuenta"])
                        ->setCellValue('W' . $row, !empty($employee['observaciones_retiro']) ? $employee['observaciones_retiro'] : "- - -")
                        ->setCellValue('X' . $row, $employee["uniforme"])
                        ->setCellValue('Y' . $row, ($employee["estado_actual_text"] == 1) ? "Solicitud" : (($employee["estado_actual_text"] == 2) ? "Contratado" : (($employee["estado_actual_text"] == 3) ? "Inactivo" : (($employee["estado_actual_text"] == 4) ? "Incapacitado" : $employee["estado_actual_text"]))));

                    //set row style
                    if (
                        $row % 2 == 0
                    ) {
                        //even row
                        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->applyFromArray($evenRow);
                    } else {
                        //odd row
                        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':Y' . $row)->applyFromArray($oddRow);
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


                $filaDep = $lastRow + 2;
                $filaHeadeTable = $lastRow + 4;
            }
        }
    }/* FIN DEL CUERPO DE DOCUMENTO EXCEL */





    if ($rrhh == "rrhh") {

        // Definir el rango de columnas que deseas eliminar (por ejemplo, de L a X)
        $columnStart = 'M';
        $columnEnd = 'Y';

        // Obtener el índice numérico de la columna de inicio y fin
        $columnStartIndex = array_search($columnStart, range('A', 'Z'));
        $columnEndIndex = array_search($columnEnd, range('A', 'Z'));

        // Calcular la cantidad de columnas a eliminar
        $columnsToDelete = $columnEndIndex - $columnStartIndex + 1;

        // Obtener el rango de columnas a eliminar en formato A:B (por ejemplo)
        $columnRangeToDelete = $columnStart . ':' . $columnEnd;

        // Eliminar las columnas dentro del rango especificado
        $spreadsheet->getActiveSheet()->removeColumnByIndex($columnStartIndex, $columnsToDelete);
    } else {
        $spreadsheet->getActiveSheet()->removeColumnByIndex(25);
    }

    if ($_estado === "2" && $rrhh != "rrhh") {
        $spreadsheet->getActiveSheet()->removeColumnByIndex(12);
        $spreadsheet->getActiveSheet()->removeColumnByIndex(15 - 1);
    }
    if ($ext == "xlsx") {
        $writer = new Xlsx($spreadsheet);
        $final_filename = $filename . ".xlsx";
    }

    // Guardar el archivo XLSX en la ruta especificada
    $writer->save($final_filename);
} else {
    echo "<script>window.close(); window.location.href = '../../generarcontratados';</script>";
}
