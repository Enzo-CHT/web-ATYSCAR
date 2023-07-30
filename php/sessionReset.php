<?php
session_start();


switch (json_decode($_GET['session'])) {
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
        unset($_SESSION);
        echo "all reseted.";
        break;
}
