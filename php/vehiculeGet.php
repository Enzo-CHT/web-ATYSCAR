<?php
session_start();
include "../php/connexion.php";


$options = isset($_SESSION['vehicule']) ? $_SESSION['vehicule'] : 0;




if ($options) {
    $place_holder = array();
    $params = array();
    $sql = "SELECT MatV FROM VEHICULE WHERE ";
    foreach ($options as $key => $value) {
        $place_holder[] = "$key = ?";
        $params[] = $value;
    }



    $sql .= implode(' AND ', $place_holder);


    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Error in SQL query : " . $connexion->error);
    }


    $stmt->bind_param("siisss", ...$params);

    if ($stmt->execute()) {

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $_SESSION['vehicule']['MatV'] = ($row['MatV']);
            }
        } else {
            die("No results found");
        }
    } else {
        die("Error during query execution");
    }
} else {
    echo $options;
    die('Error vehiculeGet.php : no options loaded ');
}
