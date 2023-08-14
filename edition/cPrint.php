<?php
session_start();
$addons_files = $_SERVER['DOCUMENT_ROOT'] . '/web-ATYSCAR/addons';
require("$addons_files/fpdf186/fpdf.php");



class ContractPDF extends FPDF
{
    // ... Header et Footer comme précédemment ...

    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'Contrat de Location de Voiture', 0, 1, 'C');
        $this->Ln(10); // Espace après le titre
        $this->SetFont('Arial', '', 12);
    }

    function Footer()
    {
        global $addons_files;

        $this->Ln(5);

        $this->SetX(20);
        $this->Cell(0, 0, iconv("UTF-8", "CP1252", "Signature locataire : "), 0, 1, 'L');
        $this->SetX(-70);
        $this->Cell(0, 0, iconv("UTF-8", "CP1252", "Signature entreprise :"), 0, 1, 'L');
        // Add an image
        $imagePath = "$addons_files/img/fake_signature.png"; // Update with the actual path to your image
        $this->Image($imagePath, 130, $this->GetY() + 5, 60); // Adjust the coordinates and dimensions as needed

        $this->Ln(30);




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
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 11, iconv("UTF-8", "CP1252", $title), 0, 1, 'L');
        $this->SetFillColor(230, 230, 230);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 7, iconv("UTF-8", "CP1252", $content), 2, 'L', true);
        $this->Ln(5); // Espace après la section
    }
}
// Créer une instance de PDF
$pdf = new ContractPDF();
$pdf->AddPage();


$entreprise = "ATYSCAR";
$contactEntreprise = "contrat@atyscar.com";
$contactSupport = "support@atyscar.com";
$nbContract = isset($_SESSION['contrat']['NumCont']) ? $_SESSION['contrat']['NumCont'] : "0000";
$dateDeb = isset($_SESSION['contrat']['DatDebCont']) ? $_SESSION['contrat']['DatDebCont'] : "0000";
$dateFin = isset($_SESSION['contrat']['DatRetCont']) ? $_SESSION['contrat']['DatRetCont'] : "0000";


$nomC = isset($_SESSION['client']['NomC']) ? $_SESSION['client']['NomC'] : "ERROR";
$prenomC = isset($_SESSION['client']['PrenomC']) ? $_SESSION['client']['PrenomC'] : "ERROR";
$client = $nomC . ' ' . $prenomC;


$ville = isset($_SESSION['client']['AdrVilC']) ? $_SESSION['client']['AdrVilC'] : 'ERROR';
$rue = isset($_SESSION['client']['AdrRueC']) ? $_SESSION['client']['AdrRueC'] : 'ERROR';
$pays = isset($_SESSION['client']['PaysDelPasC']) ? $_SESSION['client']['PaysDelPasC'] : 'ERROR';

$adresse = "$rue, $ville, $pays";
$nationalite = isset($_SESSION['client']['NationaliteC']) ? $_SESSION['client']['NationaliteC'] : "ERROR";
$telClient = isset($_SESSION['client']['TelC']) ? $_SESSION['client']['TelC'] : "+000 00 00 00";

$forfait = 'ERROR';
$codeTarification = isset($_SESSION['contrat']['CodTypTarif']) ? $_SESSION['contrat']['CodTypTarif'] : '';

switch ($codeTarification) {
    case 1:
        $forfait = "Forfait";
        break;
    case 2:
        $forfait = "Durée";
        break;
    case 3:
        $forfait = "Kilométrage";
        break;
}



$typeV = isset($_SESSION['vehicule']['TypeV']) ? $_SESSION['vehicule']['TypeV'] : 'ERROR';
$marqV = isset($_SESSION['vehicule']['MarV']) ? $_SESSION['vehicule']['MarV'] : 'ERROR';
$modV = isset($_SESSION['vehicule']['ModV']) ? $_SESSION['vehicule']['ModV'] : 'ERROR';


$vehicule = "$typeV $marqV $modV";
$immatriculation = isset($_SESSION['vehicule']['ImmatV']) ? $_SESSION['vehicule']['ImmatV'] :"000 000";
$heureDeb = isset($_SESSION['contrat']['HeurDepCont']) ? $_SESSION['contrat']['HeurDepCont'] : "00:00:00";
$heureFin  = isset($_SESSION['contrat']['HeurRetCont']) ? $_SESSION['contrat']['HeurRetCont'] :"00:00:00";
$villeDeb = isset($_SESSION['contrat']['VilDepCont']) ? $_SESSION['contrat']['VilDepCont'] :'ERROR';
$villeFin = isset($_SESSION['contrat']['VilRetCont']) ? $_SESSION['contrat']['VilRetCont'] :'ERROR';









// Ajouter les détails du locataire
$entrepriseDetails = "Entreprise : $entreprise
Contact : $contactEntreprise
Support : $contactSupport
N° de contrat : $nbContract
Validité du contrat : du $dateDeb au $dateFin";
$pdf->EntrepriseDetails($entrepriseDetails);

$locataireDetails =
    "Locataire : $client
Adresse : $adresse
Nationalité : $nationalite
Téléphone : $telClient
Type de facturation : $forfait";
$pdf->Section('Détails du Locataire', $locataireDetails);


// Ajouter les détails du véhicule
$vehicleDetails = "Véhicule loué : $vehicule
Numéro de plaque : $immatriculation
Récupérer le $dateDeb $heureDeb à $villeDeb
A déposé le $dateFin $heureFin à $villeFin";
$pdf->Section('Détails du Véhicule', $vehicleDetails);


// Ajouter les termes et conditions
$termsAndConditions =
    "1. Le locataire est responsable de toute infraction de la circulation pendant la période de location.
2. Le locataire doit restituer le véhicule avec un niveau carburant semblable à avant son utilisation.
3. Le locataire doit restituer le véhicule à la station convenu dans le contrat.
4. Le locataire peut restituer le véhicule avec un maximum de 30min de retard.
5. En cas de retard, chaque minute supplémentaire seront facturés en fonction du forfait du client.
6. Le locataire est responsable des dommages causés au véhicule pendant la période de location.";
$pdf->Section('Termes et Conditions', $termsAndConditions);

// Sortie du PDF





// Output PDF
$pdf->Output("contrat_$nbContract.pdf", 'D'); // Display in browser and force download
