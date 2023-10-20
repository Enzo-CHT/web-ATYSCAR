<?php
session_start();
include "../php/connexion.php";

$addons_files = $_SERVER['DOCUMENT_ROOT'] . '/web-ATYSCAR/addons';
require("$addons_files/fpdf186/fpdf.php");


class RentalInvoicePDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, iconv("UTF-8", "CP1252", 'Facture de Location de Véhicule'), 0, 1, 'C');
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
        $this->Cell(0, 10, iconv("UTF-8", "CP1252", $title), 0, 1, 'L');
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 8, iconv("UTF-8", "CP1252", $content), 0, 'L', true);
        $this->Ln(10); // Add space after the section
    }

    function Total($totalAmount)
    {
        $this->SetY(260);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, iconv("UTF-8", "CP1252", 'Total à payer : ' . $totalAmount . ' €'), 1, 1, 'C');
    }
}

// Create an instance of PDF
$pdf = new RentalInvoicePDF();
$pdf->AddPage();


$entreprise = "ATYSCAR";
$contactEntreprise = "contrat@atyscar.com";
$contactSupport = "support@atyscar.com";
$nbContract = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : "Le contrat n'existe pas";
$dateDeb = isset($_SESSION['contrat']['DatDebCont']) ? $_SESSION['contrat']['DatDebCont'] : "0000";
$dateFin = isset($_SESSION['contrat']['DatRetCont']) ? $_SESSION['contrat']['DatRetCont'] : "0000";


$nbFact = "AT0000-0000";

$nomC = isset($_SESSION['client']['NomC']) ? $_SESSION['client']['NomC'] : "n/a";
$prenomC = isset($_SESSION['client']['PrenomC']) ? $_SESSION['client']['PrenomC'] : "n/a";
$locataire = $nomC . ' ' . $prenomC;

$typeV = isset($_SESSION['vehicule']['TypeV']) ? $_SESSION['vehicule']['TypeV'] : 'n/a';
$marqV = isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : 'n/a';
$modV = isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] : 'n/a';
$vehicule = "$typeV $marqV $modV";


$datediff = strtotime($dateFin) - strtotime($dateDeb);
$duree = round($datediff / (60 * 60 * 24));


$codeTypC = isset($_SESSION['client']['CodTypC']) ? $_SESSION['client']['CodTypC'] : -1;

$recuperationPrix = "SELECT T.tarif FROM Tarifs AS T
                    INNER JOIN Tarifer AS TR 
                    ON TR.periode = T.CodPerT 
                    AND TR.type_contrat = T.CodTypC 
                    AND TR.type_client = T.CodTypTarif 
                    WHERE TR.id_contrat = ?";
$tarif_stmt = $connexion->prepare($recuperationPrix);
$tarif_stmt->bind_param("s", $nbContract);
$tarif_stmt->execute();
$tarif_stmt->bind_result($tarif);
$tarif_stmt->fetch();

$tarif_stmt->close();



$totalPrice = 0;
$facturationType = 'n/a';
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

$recuperationRemise = "SELECT RemTypC FROM Type_client WHERE CodTypC = ?";
$remise_stmt = $connexion->prepare($recuperationRemise);
$remise_stmt->bind_param("i", $codeTypC);
$remise_stmt->execute();
$remise_stmt->bind_result($remise);
$remise_stmt->fetch();




// Ajouter les détails du locataire
$entrepriseDetails = "Entreprise : $entreprise
Contact : $contactEntreprise
Support : $contactSupport
N° de contrat : $nbContract
Validité du contrat : du $dateDeb au $dateFin";
$pdf->EntrepriseDetails($entrepriseDetails);



// Add invoice details
$factureDetails = "Numéro de facture : INV" . date('Y') . "-001
Date : " . date('d/m/Y') . "
Locataire : $locataire
Véhicule loué : $vehicule
Durée de location : $duree Jours
Type de facturation : $facturationType
Remise : $remise%";
$pdf->Section('Détails de la Facture', $factureDetails);



switch ($codeTarification) {

    case 1:
        $totalPrice = $tarif * (1 - ($remise / 100));
        break;
    case 2:
        $totalPrice = $tarif * $duree * (1 - ($remise / 100));
        break;
    case 3:
        // $totalPrice = $tarif * (KM_Fin_COntrat - KM_Avant_DEbut) * (1 - ($remise / 100));
        $totalPrice = $tarif * 10 * (1 - ($remise / 100));
}


// Add total amount to the invoice
$pdf->Total($totalPrice);

// Output PDF
$pdf->Output("$nbFact-$locataire.pdf", "D"); // Display in browser and force download

//Reinitialise la session
$_SESSION = array();