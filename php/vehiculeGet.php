<?php
session_start();



$dbh = new PDO('mysql:host=localhost;dbname=wb-atyscar', 'root', '');
$options = isset($_SESSION['vehicule']) ? $_SESSION['vehicule'] : 0;




if ($options) {
    $place_holder = array();
    $params = array();
    $sql = "SELECT MatV FROM VEHICULE";
    $cpt = 0;
    foreach ($options as $key => $value) {
        $place_holder[] = "$key = :$cpt";
        $params[] = $value;
        $cpt++;
    }


    $sql .= ' WHERE ' . implode(' AND ', $place_holder);

    echo $sql;

    $stmt = $dbh->prepare($sql);
    if (!$stmt) {
        die("Error in SQL query : " . $dbh->errorInfo()[2]);
    }


    $cpt = 0;
    foreach ($params as $value) {
        $stmt->bindValue(":$cpt", $params[$cpt]);
        $cpt++;
    }



    if ($stmt->execute()) {

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Récupère les données
        print_r($result);
        if (!empty($result)) {
            $_SESSION['vehicule']['MatV'] = $result[0]['MatV'];
        } else {

            die("No results found" . $stmt->errorInfo()[2]);
        }
    } else {
        die("Error during query execution");
    }

    echo "Success!";

    $dbh->query('KILL CONNECTION_ID()');
    $dbh = null;

    
} else {
    echo $options;
    die('Error vehiculeGet.php : no options loaded ');
}
