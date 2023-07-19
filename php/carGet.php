<?php
session_start();
include "../php/connexion.php";


$options = isset($_SESSION['car']) ? $_SESSION['car'] : 0;




if ($options) {
    $params = array();
    $args = array();
    $sql = "SELECT DISTINCT MatV FROM VEHICULE WHERE ";
    foreach ($options as $key => $argv) {
        $params[] = "$key = ?";
        $args[] = $argv;
    }

    print_r($args);
    print_r($params);
    $sql .= implode(' AND ', $params);
    echo $sql;
    $stmt = $connexion->prepare($sql);


    $stmt->bind_param("iiisss", ...$args); // Pas de récupération des informations


    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $test = json_encode("test");
                echo $test;
            }
        }
    }
} else {
    echo $options;
    die('Error carGet.php : no options loaded ');
}
