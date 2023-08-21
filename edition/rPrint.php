<?php
session_start();

require('../addons/fpdf186/fpdf.php'); // Assurez-vous que le chemin vers la bibliothèque FPDF est correct

// Données factices pour l'exemple
$data = isset($_SESSION['REF2PRINT']) ? $_SESSION['REF2PRINT'] : 'NONE';

if ($data == 'NONE') {
    die('Error : no data retrieve, please retry');
}


class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,iconv("UTF-8", "CP1252",'Rapport de Location de Véhicules'),0,1,'C');
        $this->Ln(5);
        
        // En-têtes de colonnes
        $this->SetFont('Arial','B',10);
        $this->SetX(25);
        $this->Cell(40,10,'Code Client',1);
        $this->Cell(40,10,iconv("UTF-8", "CP1252",'Matricule Véhicule'),1);
        $this->Cell(40,10,iconv("UTF-8", "CP1252",'Date Début'),1);
        $this->Cell(40,10,'Date Fin',1);
        $this->Ln();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','',10);

foreach($data as $arr) {

    $row = array($arr['numClient'], $arr['matVehicule'], $arr['dateDebut'], $arr['dateFin']);
    

    $pdf->SetX(25);
    $pdf->Cell(40,10,$row[0],1);
    $pdf->Cell(40,10,$row[1],1);
    $pdf->Cell(40,10,$row[2],1);
    $pdf->Cell(40,10,$row[3],1);
    $pdf->Ln();
}

$pdf->Output();

unset($_SESSION['REF2PRINT']); // Réinitialisation de la session
?>
