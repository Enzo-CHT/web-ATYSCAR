
<?php

$server="localhost";
$base="wb-atyscar";
$userdb="root";
$userpwd="";
$connexion=new mysqli($server,$userdb,$userpwd,$base);

if($connexion->connect_error){
	
	$_SESSION['error'] = $connexion->connect_error;
	header("Location: /web-ATYSCAR/error.php");
	die();
}


?>