

<?php
session_start();

require "connexion.php";


$ASSOC = [];

foreach ($_SESSION['client'] as $key=>$value) {
    if (!empty($_SESSION['client'][$key]) or $value != "") {
        $ASSOC[$key] = $value;
    } else {
        $ASSOC[$key] = "N/A";
    }
}


$sql = " DELETE FROM CLIENT WHERE NumC=?" ;

$stmt = $connexion->prepare($sql);

$stmt->bind_param('s',$ASSOC['NumC']);
$stmt->execute();
if (!$stmt->execute()) {
    die("Erreur lors de l'exécution de la requête : " . $stmt->error);
}
$stmt->close();



mysqli_close($connexion);

?>
