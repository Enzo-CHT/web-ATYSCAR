<?php
session_start();


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
        global $addons_files;
        // Add an image
        $imagePath = "$addons_files/img/Atys Car.jpg"; // Update with the actual path to your image
        $this->Image($imagePath, 160, 5, 40); // Adjust the coordinates and dimensions as needed

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
$nbContract = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : "0000";
$dateDeb = isset($_SESSION['contrat']['DatDebCont']) ? $_SESSION['contrat']['DatDebCont'] : "0000";
$dateFin = isset($_SESSION['contrat']['DatRetCont']) ? $_SESSION['contrat']['DatRetCont'] : "0000";


$nbFact = "AT0000-0000";

$nomC = isset($_SESSION['client']['NomC']) ? $_SESSION['client']['NomC'] : "ERROR";
$prenomC = isset($_SESSION['client']['PrenomC']) ? $_SESSION['client']['PrenomC'] : "ERROR";
$locataire = $nomC . ' ' . $prenomC;

$typeV = isset($_SESSION['vehicule']['TypeV']) ? $_SESSION['vehicule']['TypeV'] : 'ERROR';
$marqV = isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : 'ERROR';
$modV = isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] : 'ERROR';
$vehicule = "$typeV $marqV $modV";


$datediff = strtotime($dateFin) - strtotime($dateDeb)  ;
$duree = round($datediff / (60 * 60 * 24));

$totalPrice = 0;
$facturationType = 'ERROR';
$codeTarification = isset($_SESSION['contrat']['CodTypTarif']) ? $_SESSION['contrat']['CodTypTarif'] : '';

switch ($codeTarification) {
    case 1:
        $facturationType = "Forfait";
        break;
    case 2:
        $facturationType = "Durée";
        break;
    case 3:
        $facturationType = "Kilométrage";
        break;
}

$remise = isset($_SESSION['contrat']['remise']) ? $_SESSION['contrat']['remise'] : "0%";

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
Durée de location : $duree Jours
Type de facturation : $facturationType
Remise : $remise";
$pdf->Section('Détails de la Facture', $factureDetails);




// Add total amount to the invoice
$pdf->Total($totalPrice);

// Output PDF
$pdf->Output("$nbFact-$locataire.pdf", "D"); // Display in browser and force download
