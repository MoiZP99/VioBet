<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

$EstiloCabecera = [
	'font' => [
		'color' => [
			'rgb' => '	#000000'
		],
		'bold' => true,
		'size' => 11
	],
	'fill' => [
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '7B8E44'
		]
		
	],
	'borders' => [
		'bottom' => ['borderStyle' => Border::BORDER_THIN],
		'right' => ['borderStyle' => Border::BORDER_MEDIUM],
	],
	
];


$lineaCeleste = [
	'fill' => [
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '#000000'
		],
		'bold' => true,
		],
		'borders' => [
			'bottom' => ['borderStyle' => Border::BORDER_THIN],
			'right' => ['borderStyle' => Border::BORDER_MEDIUM],
			'left' => ['borderStyle' => Border::BORDER_DASHDOTDOT],
		],
];
$lineaBlanca = [
	'fill' => [
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => 'FFFFFF'
		],
		'bold' => true,
		],
		'borders' => [
			'bottom' => ['borderStyle' => Border::BORDER_THIN],
			'right' => ['borderStyle' => Border::BORDER_MEDIUM],
		],
];

$excel = new Spreadsheet();
$hojaEnFuncion = $excel->getActiveSheet();
$hojaEnFuncion->setTitle("Lugares Turísticos");

$hojaEnFuncion->getColumnDimension('A')->setWidth(30);
$hojaEnFuncion->getStyle('A1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('A1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('A1', 'Nombre');

$hojaEnFuncion->getColumnDimension('B')->setWidth(20);
$hojaEnFuncion->getStyle('B1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('B1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('B1', 'Tipo de Lugar');

$hojaEnFuncion->getColumnDimension('C')->setWidth(100);
$hojaEnFuncion->getStyle('C1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('C1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('C1', 'Descripción');

$hojaEnFuncion->getColumnDimension('D')->setWidth(15);
$hojaEnFuncion->getStyle('D1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('D1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('D1', 'Tipo de Espacio');

$hojaEnFuncion->getColumnDimension('E')->setWidth(15);
$hojaEnFuncion->getStyle('E1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('E1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('E1', 'Día de Apertura');

$hojaEnFuncion->getColumnDimension('F')->setWidth(15);
$hojaEnFuncion->getStyle('F1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('F1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('F1', 'Día de Cierre');

$hojaEnFuncion->getColumnDimension('G')->setWidth(15);
$hojaEnFuncion->getStyle('G1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('G1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('G1', 'Hora de Apertura');

$hojaEnFuncion->getColumnDimension('H')->setWidth(15);
$hojaEnFuncion->getStyle('H1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('H1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('H1', 'Hora de Cierre');

$hojaEnFuncion->getColumnDimension('I')->setWidth(50);
$hojaEnFuncion->getStyle('I1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('I1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('I1', 'Ubicación');

$hojaEnFuncion->getColumnDimension('J')->setWidth(20);
$hojaEnFuncion->getStyle('J1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('J1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('J1', 'Número de teléfono');

$hojaEnFuncion->getColumnDimension('K')->setWidth(30);
$hojaEnFuncion->getStyle('K1')->getFont()->setBold(true);
$hojaEnFuncion->getStyle('K1')->applyFromArray($EstiloCabecera);
$hojaEnFuncion->setCellValue('K1', 'Correo electrónico');
$hojaEnFuncion->getStyle('A' . $fila . ':K' . $fila)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$fila = 2;

foreach ($lugares as $lugar) {
	$hojaEnFuncion->setCellValue('A' . $fila, $lugar->Nombre_Lugar);
	$hojaEnFuncion->setCellValue('B' . $fila, $lugar->categoria_turismo);
	$hojaEnFuncion->setCellValue('C' . $fila, $lugar->Descripcion);
	$hojaEnFuncion->setCellValue('D' . $fila, $lugar->Espacio);
	$hojaEnFuncion->setCellValue('E' . $fila, $lugar->Nombre_Dial);
	$hojaEnFuncion->setCellValue('F' . $fila, $lugar->Nombre_Diall);
	$hojaEnFuncion->setCellValue('G' . $fila, $lugar->Hora_apertura);
	$hojaEnFuncion->setCellValue('H' . $fila, $lugar->Hora_clausura);
	$hojaEnFuncion->setCellValue('I' . $fila, $lugar->Ubicacion);
	$hojaEnFuncion->setCellValue('J' . $fila, $lugar->Numero_Contacto);
	$hojaEnFuncion->setCellValue('K' . $fila, $lugar->Correo);
	$hojaEnFuncion->getStyle('A' . $fila . ':K' . $fila)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


	if ($fila % 2 == 0) {
		$hojaEnFuncion->getStyle('A' . $fila . ':K' . $fila)->applyFromArray($lineaCeleste);
	} else {
		$hojaEnFuncion->getStyle('A' . $fila . ':K' . $fila)->applyFromArray($lineaBlanca);
	}

	$fila++;
}

// $lineaUno=1;
// $ultimaLinea=$fila-1;
// $hojaEnFuncion->setAutoFilter("A".$lineaUno.":K".$ultimaLinea);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Lugares Turísticos.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
