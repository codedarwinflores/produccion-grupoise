<?php

use PhpOffice\PhpSpreadsheet\Style\Alignment;
# code...
$spreadsheet->getActiveSheet()
    ->setCellValue("B" . $filaDep, "Departamento: ")
    ->setCellValue("C" . $filaDep, $depa['codigo'] . " -" . $depa['nombre']);
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
