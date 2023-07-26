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
        $query = "SELECT * FROM `tbl_empleados` where estado=2";
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
                'rgb' => '538ED5'
            ]
        ],
    ];
    //even row
    $evenRow = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '00BDFF'
            ]
        ]
    ];
    //odd row
    $oddRow = [
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '00EAFF'
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
            'size' => 14
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '0F497D'
            ]
        ],
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
        ->setSize(11);

    /* OCULTAR LINEAS o cuadrícula de excel*/
    $spreadsheet->getActiveSheet()->setShowGridLines(false);

    /* HOJA - NOMBRE */

    $sheet->setTitle("ReporteEmpleados");

    //heading
    $spreadsheet->getActiveSheet()
        ->setCellValue('A2', "INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.");

    //merge heading
    $spreadsheet->getActiveSheet()->mergeCells("A2:F2");

    // set font style
    $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

    // set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    //setting column width
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(110);


    //header text
    $spreadsheet->getActiveSheet()
        ->setCellValue('A4', "ID")
        ->setCellValue('B4', "Nombres")
        ->setCellValue('C4', "Apellidos")
        ->setCellValue('D4', "Estado Civil")
        ->setCellValue('E4', "Sexo")
        ->setCellValue('F4', "Dirección");


    //set font style and background color
    $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A3:F3')->applyFromArray($encabezado);
    $spreadsheet->getActiveSheet()->getStyle('A4:F4')->applyFromArray($tableHead);


    /* OBTENER DATOS */
    $ext = $_GET["typeReport"];
    $filename = "Reporte-empleados-" . $fecha . "-" . $hora;
    /*  echo $filename; */



    try {

        $datos = empleado();

        if (count($datos) > 0) {
            # code...
            $row = 5;
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
            }

            //autofilter
            //define first row and last row
            $firstRow = 4;
            $lastRow = $row - 1;
            //set the autofilter
            $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":F" . $lastRow);


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
                header("location:../../../");
            }



            //set the header first, so the result will be treated as an xlsx file.
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            //make it an attachment so we can define filename
            header('Content-Disposition: attachment;filename="' . urlencode($final_filename) . '"');

            //save into php output
            $writer->save('php://output');
        } else {
            echo "<script>
            alert('close');
            </script>";
        }
    } catch (PDOException $e) {
        echo "Hubo un problema en la conexión: " . $e->getMessage();
    }
} else {
    header("location:../../../");
}
