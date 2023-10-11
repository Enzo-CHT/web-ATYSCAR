<?php
session_start();

$scope = isset($_GET['scope']) ? $_GET['scope'] : null;

switch ($scope) {
    case "client":
        unset($_SESSION['client']);
        echo "client reseted.";
        break;
    case "contrat":
        unset($_SESSION['contrat']);
        echo "contrat reseted.";
        break;
    case "vehicule":
        unset($_SESSION['vehicule']);
        echo "vehicule reseted.";
        break;
    case "entretien":
        unset($_SESSION['entretien']);
        echo "entretien reseted.";
        break;
    case "all":
        $_SESSION = array();
        echo "all reseted.";
        break;
    default:
        echo 'Error in session reset';
        break;
}
