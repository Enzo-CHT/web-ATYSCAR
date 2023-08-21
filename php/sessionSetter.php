<?php
session_start();

$data = json_decode($_POST['data'], true);



//Faire un check des valeurs d'entré pour éviter les injections
foreach ($data as $type => $array) {
    foreach ($array as $key => $value) {
        // Recupère les valeurs dans un $_SESSION
        
        $_SESSION[$type][$key] = $value;
    }
}




$nom = isset($_SESSION['client']['NomC']) ? strtoupper($_SESSION['client']['NomC']) : "";
$prenom = isset($_SESSION['client']['PrenomC']) ? strtoupper(substr($_SESSION['client']['PrenomC'], 0, 1)) . strtolower(substr($_SESSION['client']['PrenomC'], 1)) : '';
$datnais = isset($_SESSION['client']['DatNaisC']) ? $_SESSION['client']['DatNaisC'] : '';

$_SESSION['client']['NomC'] = $nom;
$_SESSION['client']['PrenomC'] = $prenom;

$identifier = (substr($nom, 0, 3)) . strtoupper(substr($prenom, 0, 3)) . "-" . str_replace("-", "", $datnais);
$_SESSION['client']['NumC'] = $identifier;


echo "Success!";