<?php

/* CONSULTA A TABLA */
$empleadoBuscar = new ModeloEmpleados();
$datos = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);

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
