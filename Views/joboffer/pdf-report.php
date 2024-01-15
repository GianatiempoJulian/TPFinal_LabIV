<?php

require_once("Config/Autoload.php");
require_once ('C:\xampp\htdocs\UTN\TPFinal_LabIV\fpdf\fpdf.php');

use Config\Autoload as Autoload;

Autoload::Start();

$GLOBALS['offerName'] = $offerName;
$GLOBALS['companyName'] = $companyName;
$GLOBALS['offerId']  = $offerId;

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        //$this->image('../img/logo.png', 150, 1, 60); // X, Y, Tamaño
        $this->Ln(20);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
    
        // Movernos a la derecha
        $this->Cell(60);

        // Título
        $this->Cell(70,10,'Tabla de estudiantes de oferta [' . $GLOBALS['offerName']  . "] de la empresa [".$GLOBALS['companyName']."]",0,0,'C');
        // Salto de línea
    
        $this->Ln(30);
        $this->SetFont('Arial','B',10);
        $this->SetX(5);
        $this->Cell(10,10,'ID',1,0,'C',0);
        $this->Cell(25,10,'Nombre',1,0,'C',0,);
        $this->Cell(25,10,'Apellido',1,0,'C',0);
        $this->Cell(70,10,'Correo',1,0,'C',0);
        $this->Cell(20,10,'DNI',1,0,'C',0);
        $this->Cell(20,10,'Genero',1,0,'C',0);
        $this->Cell(30,10,'Telefono',1,1,'C',0);
       
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
    
        $this->Cell(0,10,mb_convert_encoding('Página','ISO-8859-1') .$this->PageNo().'/{nb}',0,0,'C');
        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
    }

    $conexion = mysqli_connect("localhost","root","root43456672","University");
    $consulta = 
    'SELECT students.recordId, students.firstName, students.lastName, students.email, students.dni,
    students.gender, students.birthDate, students.phoneNumber
    FROM students 
    INNER JOIN student_x_job_offer 
    ON student_x_job_offer.recordId = students.recordId
    INNER JOIN job_offer 
    ON student_x_job_offer.o_id = job_offer.o_id
    WHERE student_x_job_offer.o_id = ' . $GLOBALS['offerId'];
     ;
    $resultado = mysqli_query($conexion, $consulta);
    ob_start ();
    $pdf = new PDF();

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',9);
    //$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
    while ($row=$resultado->fetch_assoc()) {

        $pdf->SetX(5);
        $pdf->Cell(10,10,$row['recordId'],1,0,'C',0);
        $pdf->Cell(25,10,$row['firstName'],1,0,'C',0);
        $pdf->Cell(25,10,$row['lastName'],1,0,'C',0);
        $pdf->Cell(70,10,$row['email'],1,0,'C',0);
        $pdf->Cell(20,10,$row['dni'],1,0,'C',0);
        $pdf->Cell(20,10,$row['gender'],1,0,'C',0);
        $pdf->Cell(30,10,$row['phoneNumber'],1,1,'C',0);
    

} 


	$pdf->Output();
    ob_end_flush(); 
?>