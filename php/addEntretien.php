<?php 

include "connexion.php";


$data = isset($_POST['data']) ?$_POST['data'] : null;
$data = json_decode($data);


if ($data != null) {

   
    $sql = "INSERT INTO Entretenir VALUE (?,?,?,?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param('ssss',
            $data->kilometrage,
            $data->code,
            $data->matricule,
            $data->date
        );

    if ($stmt->execute()) {
        echo "SUCCESS";
    }
    


    

}
