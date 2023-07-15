<?php
    session_start();
    // Modification possible à terme
    // Mise à jour session en fonction des contrats client + infos clients + entretien véhicule ??? 
    
    require 'connexion.php';
   
    print_r($_SESSION);
    $sql = "SELECT * FROM CLIENT WHERE NumC=?";
    $stmt = $connexion->prepare($sql);
    
    if (isset($_SESSION['client']['NumC']) && !empty($_SESSION['client']['NumC'])) {
        $stmt->bind_param('s', $_SESSION['client']['NumC']);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
        $result = $stmt->get_result();
    
        if (!empty($result)) {
            
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $_SESSION['client'][$key] = $value;
                }
            }
        }
    } else {
        die("No SESSION set");
    }
    
    
 
    $stmt->close();

    mysqli_close($connexion);
