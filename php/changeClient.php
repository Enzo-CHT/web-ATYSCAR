<?php
session_start();
require "connexion.php";



/**
 * Recupère tous les numC
 * Trouver celui actuel
 * Recupèrer les suivants
 * Recupère les précédents
 * Defini l'action
 * Definir une nouvelle session
 * Si pas de NumC définit
 *  Premier utilisateur de la liste
 */

$way = isset($_POST['way']) ? $_POST['way']: 0;

if (!in_array($way, [1,-1,0])) {
    $way = 0;
}



$sql = "SELECT NumC FROM CLIENT";
$stmt = $connexion->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();
$NUMC = []; //COntient les resultats de la requete
$count = 0;
while ($row = $result->fetch_assoc()) {
    foreach ($row as $key=>$value) {
        $NUMC[$count] = $value;
        $count++;
    }
}




$condition = (isset($_SESSION['NumC']) && !empty($_SESSION['NumC'])); 
if ($condition) {
    foreach ($NUMC as $i=>$value) {
        if ($value == $_SESSION['NumC']) {

            // Optimisation nécessaire
            $nextIndex = $i+$way;
            $nextIndex = ($nextIndex)<0 ? $count-1 : $nextIndex; // Nouvelle index du suivant ou précédent
            $nextIndex = ($nextIndex)>=$count ? 0 : $nextIndex; // Nouvelle index du suivant ou précédent
            
            echo $nextIndex;
            $next = $NUMC[$nextIndex];

        }
    }
} else  {
    $next=$NUMC[0]; 
}

$_SESSION['NumC'] = $next;







?>



