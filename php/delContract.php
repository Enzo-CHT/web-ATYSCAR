

<?php
session_start();

require "connexion.php";



$NumCont = json_decode($_GET['data']);

echo $NumCont;
$sql = "DELETE FROM CONTRAT WHERE NumCont=?" ;
$stmt = $connexion->prepare($sql);
if (!$stmt){
    die ("Query Error " . $connexion->error);
}
$stmt->bind_param('s', $NumCont);
if (!$stmt->execute()) {
    die("Erreur lors de l'exécution de la requête : " . $stmt->error);
}

echo "success!";
$stmt->close();



mysqli_close($connexion);


?>
