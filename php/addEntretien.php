<?php

include "connexion.php";


$data = isset($_POST['data']) ? $_POST['data'] : null;
$data = json_decode($data);


if ($data != null) {

    // Vérifie les champs obligatoire
    foreach ($data as $el => $value) {
        if ($value == (null || "")) {
            die("FAIL:Champ(s) manquant(s)");
        }
    }

    // Vérfifie si un element existe déjà
    $sql_exist = "SELECT * FROM Entretenir WHERE
            CodeOpE=? AND MatV=? AND Date_Ent = ?";
    $stmt_exist = $connexion->prepare($sql_exist);
    $stmt_exist->bind_param(
        "sss",
        $data->code,
        $data->matricule,
        $data->date
    );
    $stmt_exist->execute();

    // Si l'element n'existe pas
    if ($stmt_exist->get_result()->num_rows < 1) {

        $sql = "INSERT INTO Entretenir VALUE (?,?,?,?)";
        $stmt = $connexion->prepare($sql);
        $stmt->bind_param(
            'ssss',
            $data->kilometrage,
            $data->code,
            $data->matricule,
            $data->date
        );

        if ($stmt->execute()) {
            echo "SUCCESS";
        } else {
            die("ERREUR");
        }
    } else {
        die("FAIL:Entretien déjà enregistrer");
    }
}
