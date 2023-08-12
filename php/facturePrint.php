<?php
$addons_files = $_SERVER['DOCUMENT_ROOT'] . '/web-ATYSCAR/addons';
require("$addons_files/fpdf186/fpdf.php");


class RentalInvoicePDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, iconv("UTF-8", "CP1252",'Facture de Location de Véhicule'), 0, 1, 'C');
        $this->Ln(10); // Add space after the title
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
    function EntrepriseDetails($content)
    {
        $this->SetFont('Arial', 'I', 12);
        $this->SetFillColor(255, 255, 255);
        $this->MultiCell(0, 7, iconv("UTF-8", "CP1252", $content), 0, 'L', true);
        $this->Ln(10); // Espace après le titre
    }

    function Section($title, $content)
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, iconv("UTF-8", "CP1252",$title), 0, 1, 'L');
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 8, iconv("UTF-8", "CP1252",$content), 0, 'L', true);
        $this->Ln(10); // Add space after the section
    }

    function Total($totalAmount)
    {
        $this->SetY(260);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, iconv("UTF-8", "CP1252",'Total à payer : ' . $totalAmount . ' €'), 1, 1, 'C');
    }
}

// Create an instance of PDF
$pdf = new RentalInvoicePDF();
$pdf->AddPage();


$entreprise = "ATYSCAR";
$contactEntreprise = "contrat@atyscar.com";
$contactSupport = "support@atyscar.com";
$nbContract = "0000";
$dateDeb = "0000";
$dateFin = "0000";


$nbFact = "AT0000-0000";
$locataire = "John Doe";
$vehicule = "Type Marque Modele";
$duree = "0 Jours";
$totalPrice = 0;
$facturationType = "NONE";
$remise = "0%";

// Ajouter les détails du locataire
$entrepriseDetails = "Entreprise : $entreprise
Contact : $contactEntreprise
Support : $contactSupport
N° de contrat : $nbContract
Validité du contrat : du $dateDeb au $dateFin";
$pdf->EntrepriseDetails($entrepriseDetails);



// Add invoice details
$factureDetails = "Numéro de facture : INV".date('Y')."-001
Date : " . date('d/m/Y') . "
Locataire : $locataire
Véhicule loué : $vehicule
Durée de location : $duree
Type de facturation : $facturationType
Remise : $remise";
$pdf->Section('Détails de la Facture', $factureDetails);




// Add total amount to the invoice
$pdf->Total($totalPrice);

// Output PDF
$pdf->Output(); // Display in browser and force download
