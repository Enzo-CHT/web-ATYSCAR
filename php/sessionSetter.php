<?php
    session_start();
    $_SESSION = array();

    

    $data = json_decode($_POST['data'],true);


    //Faire un check des valeurs d'entré pour éviter les injections
    foreach ($data as $type => $array) {
        // Recupère les valeurs dans un $_SESSION
        $_SESSION[$type] = $array;
    }


    print_r($_SESSION);


    $_SESSION['client']['NomC'] = strtoupper($_SESSION['client']['NomC']);
    $_SESSION['client']['PrenomC'] = strtoupper(substr($_SESSION['client']['PrenomC'],0,1)).strtolower(substr($_SESSION['client']['PrenomC'],1));
    
    $identifier = (substr($_SESSION['client']['NomC'], 0, 3)).strtoupper(substr($_SESSION['client']['PrenomC'], 0, 3))."-".str_replace("-","",$_SESSION['client']['DatNaisC']);
    $_SESSION['client']['NumC'] = $identifier;

    

?>