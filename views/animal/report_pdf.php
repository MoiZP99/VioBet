<?php
include('/build/plugins/TCPDF-library/tcpdf.php');
class MyPDF extends TCPDF {
public function Header() {
	$this->SetFont('helvetica', 'B', 12);
	$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	
}
public function Footer() {
	$this->SetY(-15);
	$this->SetFont('helvetica', 'I', 8);
	$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
}

}
$pdf = new MyPDF('P', 'mm', 'A4');
$pdf->SetTitle('Emprendedores');
$pdf->SetPrintHeader(true);
$pdf->SetPrintFooter(true);
//add page
$pdf->AddPage();

$pdf->SetTitle('Reporte de Lugares Turisticos');
date_default_timezone_set('America/Costa_Rica');
$pdf->Write(75, 'Fecha: ' . date('d-m-Y h:i:s A'));





$pdf->Image('/build/assets/images/logo.jpg', 15, 15, 30, 0, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Ln(7);
$pdf->SetFont('Helvetica', '', 19);
$pdf->Cell(190, 5, "Listado de Lugares Turísticos", 0, 1, 'C');
$pdf->SetFont('Helvetica', '', 13);


$pdf->Cell(190, 5, "Email: somoshojancha@gmail.com", 0, 1, 'C');
$pdf->Cell(190, 5, "Contacto: (+506) 2659-9454", 0, 1, 'C');


$pdf->Ln(10);


$html = "
	<table>
		<tr>
			<th>Nombre</th>
			<th>Espacio</th>
			<th>Categoría</th>
			<th>Ubicacion</th>
			<th>Número de teléfono</th>
			<th>Correo electrónico</th>
		</tr>
		";

foreach ($reportPDF as $lugar) {
	$html .= "
			<tr>
				<td>" . $lugar->Nombre_Lugar . "</td>
				<td>" . $lugar->Espacio . "</td>
				<td>" . $lugar->categoria_turismo . "</td>
				<td>" . $lugar->Ubicacion . "</td>
				<td>" . $lugar->Numero_Contacto . "</td>
				<td>" . $lugar->Correo . "</td>
			</tr>
			";
}

$html .= "
</table>
<style>
table {
	border-collapse:collapse;
	
}
th,td {
	solid #4B541D;
	
	
}

table tr th {
	background-color:#4B541D;
	color:#ffffff;
	font-weight:bold;
	
}
th, td {
	border-width: 2px; /* Ancho del borde de las celdas */
	text-align:center;
}

</style>
	
";

$pdf->WriteHTMLCell(192, 0, 9, '', $html, 0);


$pdf->Output('Lugares Turísticos.pdf', 'I');