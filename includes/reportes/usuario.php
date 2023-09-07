<?php

require '../../includes/config/database.php';
$db = conectarDB();

require_once ('../../fpdf/fpdf.php');

date_default_timezone_set('America/Costa_Rica'); //Configuración del horario según la ubicación del servidor
class PDF extends FPDF
{
// Cabecera de página
    function Header()
    {
        $ancho = 190;
         
        //-------------------------------PARA LA FECHA -- INICIO
        // $this->cell(-200);
        $this->image('../../assets/images/Hojancha/Foto Perfil.png', 6, 4, 60); // X, Y, Tamaño

        $this->SetFont('Arial','',10);
        if($this->pagina == 1){ //Cuando el archivo está en Horizontal
            $horizontal = 85; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
            $this->SetY(15);
            $this->Cell($ancho + $horizontal, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
            $this->SetY(19);
            $this->Cell($ancho + $horizontal, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
        } else { 
            $this->SetY(15);
            $this->Cell($ancho, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
            $this->SetY(19);
            $this->Cell($ancho, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
        }
        //-------------------------------PARA LA FECHA -- FIN

        //-------------------------------PARA EL TÍTULO -- INICIO
        $this->Ln(30);
        // Arial bold 15
        $this->SetFont('Arial','B',20);
    
        // Movernos a la derecha
        $this->Cell(60);

        // Título
        $this->SetTextColor(75, 54, 33);
        $this->Cell(70,10,'Reporte de usuarios ',0,0,'C');
        // Salto de línea 
        //-------------------------------PARA EL TÍTULO -- FIN
    
        //-------------------------------PARA LAS CABECERAS -- INICIO
        $this->Ln(20);
        $this->SetFont('Arial','B',10);
        $this->SetX(8);
        // $this->SetFillColor(240,240,240);
        // $this->SetTextColor(40,40,40);
        // $this->SetDrawColor(88, 88, 88);
        $this->Cell(30,10,'Nombre',0,0,'C',0);
        $this->Cell(50,10,'Apellido',0,0,'C',0,);
        $this->Cell(50,10, utf8_decode('Correo Electrónico'),0,0,'C',0);
        $this->Cell(40,10,'Rol',0,0,'C',0);
        $this->SetDrawColor(75, 54, 33);
        $this->SetLineWidth(1);
        $this->Line(15, 77, 197, 77);
        // $this->Cell(40,10,'Fecha',1,0,'C',0);
        // $this->Cell(30,10,'Rol',1,1,'C',0);
        //-------------------------------PARA LAS CABECERAS -- FIN
        
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
    
        $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
    //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}

$consulta = ("SELECT usuarios.Nombre, usuarios.Apellido, usuarios.Email, rol.Nombre_Rol 
              FROM usuarios INNER JOIN rol ON usuarios.Rol_Id = rol.Id");
$resultado = mysqli_query($db, $consulta);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
// $pdf->SetLineWidth(0.2);
// $pdf->SetFillColor(149, 165, 166);
// $pdf->SetTextColor(40,40,40);
// $pdf->SetDrawColor(255, 255, 255);
$pdf->Ln(11);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $resultado->fetch_assoc()) {

    // $pdf->SetX(8);

    $pdf->Cell(30, 10, utf8_decode($row['Nombre']) , 0, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row['Apellido']), 0, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row['Email']), 0, 0,'C', 0);
    $pdf->Cell(40, 10, utf8_decode($row['Nombre_Rol']), 0, 0,'C', 0);
    $pdf->Ln();
    // $pdf->Cell(40,10,$row['fecha'],1,0,'C',0);
    // $pdf->Cell(30,10,$row['rol'],1,1,'C',0);
	
} 

	$pdf->Output();
