<?php
session_start();


include 'connexion.php';

$options = isset($_GET['data']) ? json_decode($_GET['data']) : 0;



if ($options) {
    $place_holder = array();
    $params = array();
    $sql = "SELECT MatV FROM VEHICULE WHERE ";

    foreach ($options as $key => $value) {
        $place_holder[] = "$key = ?";
        $params[] = $value;
    }


    $sql .=  implode(' AND ', $place_holder);


    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Error in SQL query : " . $connexion->error);
    }


    // Build a string representing the types of parameters ('ssss...' based on the number of parameters)
    $param_types = str_repeat('s', count($params));

    $stmt->bind_param($param_types, ...$params);


    if ($stmt->execute()) {

        $result = $stmt->get_result(); //Récupère les données
        while ($el = $result->fetch_assoc()) {
            if (!empty($el)) {
                foreach ($el as $key => $value) {
                    $_SESSION['vehicule']['MatV'] = $value;
                }
            } else {
                die("No results found" . $stmt->error);
            }
        }
    } else {
        die("Error during query execution" . $stmt->error);
    }

    echo "Success!";

    $stmt->close();
    mysqli_close($connexion);
} else {
    echo $options;
    die('Error vehiculeGet.php : no options loaded ');
}
