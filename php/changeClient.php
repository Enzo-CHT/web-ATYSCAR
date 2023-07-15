<?php
session_start();
require "connexion.php";




$way = isset($_POST['way']) ? $_POST['way']: 0;

if (!in_array($way, [1,-1,0])) {
    $way = 0;
}



$sql = "SELECT NumC FROM CLIENT";
$stmt = $connexion->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();
$NUMC = []; //COntient les resultats de la requete
$CLIENT = $_SESSION['client']; // Contient les infos du client dans la session
$count = 0;
while ($row = $result->fetch_assoc()) {
    foreach ($row as $key=>$value) {
        $NUMC[$count] = $value;
        $count++;
    }
}




$condition = (isset($CLIENT['NumC']) && !empty($CLIENT['NumC'])); 
if ($condition) {
    foreach ($NUMC as $i=>$value) {
        if ($value == $CLIENT['NumC']) {

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

$_SESSION['client']['NumC'] = $next;







?>



