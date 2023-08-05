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
    require_once "../../../modelos/conexion.php";


    /* Consulta para empleados */
    function empleado()
    {
        $query = "SELECT * FROM `tbl_empleados` where estado=2 limit 10";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();
        return $sql->fetchAll();
    };
    //call the autoload

    date_default_timezone_set("America/El_Salvador");
    $fecha = date("d-m-Y");
    $hora = date("h:i:s A");


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
        ->mergeCells("C1:D1")
        ->getStyle('C1')->getFont()->setSize(12);

    // set cell alignment

    //set font style and background color IMAGE
    $spreadsheet->getActiveSheet()->getStyle('C1:D1')->applyFromArray($fuente1);
    $spreadsheet->getActiveSheet()->getStyle('A1:B1')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A2:B2')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A3:B3')->applyFromArray($encabezado);

    /* ENCABEZADO DE DATOS DE FECHA ESTILOS*/
    $spreadsheet->getActiveSheet()
        ->setCellValue('C2', "Fecha: ")
        ->setCellValue('C3', "Rango Fecha: ")
        ->setCellValue('C4', "Ingresos/Egresos: ")
        ->setCellValue('D2', $fecha . " " . $hora)
        ->setCellValue('D3', $fecha . " " . $hora)
        ->setCellValue('D4', "Ingresos/Egresos: ");
    $spreadsheet->getActiveSheet()->getStyle('C2')->applyFromArray($fuente2);
    $spreadsheet->getActiveSheet()->getStyle('C3')->applyFromArray($fuente2);
    $spreadsheet->getActiveSheet()->getStyle('C4')->applyFromArray($fuente2);






    /* ALINEACIÓN DE DATOS */
    $spreadsheet->getActiveSheet()->getStyle('C1:D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    $spreadsheet->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

    //setting column width
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(110);






    /* OBTENER DATOS */
    $ext = $_GET["typeReport"];
    $filename = "Reporte-empleados-" . $fecha . "-" . $hora;
    /*  echo $filename; */



    try {

        /* CUERPO DEL DOCUMENTO EXCEL*/
        $filaDep = 6;
        $colDep = "B";
        $colResDep = "C";
        $filaHeadeTable = 8;

        for ($i = 0; $i < 3; $i++) {
            # code...
            $spreadsheet->getActiveSheet()
                ->setCellValue("B" . $filaDep, "Departamento: ")
                ->setCellValue("C" . $filaDep, "0101 - Departamento de Ventas");
            $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $spreadsheet->getActiveSheet()->getStyle("B" . $filaDep)->applyFromArray($tableHead);
            $spreadsheet->getActiveSheet()->getStyle("C" . $filaDep)->applyFromArray($fuente2);
            //header text
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $filaHeadeTable, "ID")
                ->setCellValue('B' . $filaHeadeTable, "Nombres")
                ->setCellValue('C' . $filaHeadeTable, "Apellidos")
                ->setCellValue('D' . $filaHeadeTable, "Estado Civil")
                ->setCellValue('E' . $filaHeadeTable, "Sexo")
                ->setCellValue('F' . $filaHeadeTable, "Dirección");

            //set font style and background color
            $spreadsheet->getActiveSheet()->getStyle('A' . $filaHeadeTable . ':F' . $filaHeadeTable . '')->applyFromArray($tableHead);


            $datos = empleado();

            if (count($datos) > 0) {
                # code...
                $row = $filaHeadeTable + 1;
                foreach ($datos as $employee) {
                    $spreadsheet->getActiveSheet()
                        ->setCellValue('A' . $row, $employee['id'])
                        ->setCellValue('B' . $row, $employee['primer_nombre'] . " " . $employee['segundo_nombre'])
                        ->setCellValue('C' . $row, $employee['primer_apellido'] . " " . $employee['segundo_apellido'])
                        ->setCellValue('D' . $row, $employee['estado_civil'])
                        ->setCellValue('E' . $row, $employee['sexo'])
                        ->setCellValue('F' . $row, $employee['direccion']);

                    //set row style
                    if ($row % 2 == 0) {
                        //even row
                        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray($evenRow);
                    } else {
                        //odd row
                        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray($oddRow);
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
    } catch (PDOException $e) {
        echo "Hubo un problema en la conexión: " . $e->getMessage();
    }
}
