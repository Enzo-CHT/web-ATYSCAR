<?php
    session_start();
    $_SESSION = array();

    //Faire un check des valeurs d'entré pour éviter les injections

    foreach ($_POST as $key => $value) {
        // Recupère les valeurs dans un $_SESSION
        $_SESSION[$key] = $value;
    }

    $_SESSION['NomC'] = strtoupper($_SESSION['NomC']);
    $_SESSION['PrenomC'] = strtoupper(substr($_SESSION['PrenomC'],0,1)).strtolower(substr($_SESSION['PrenomC'],1));
    
    $identifier = (substr($_SESSION['NomC'], 0, 3)).strtoupper(substr($_SESSION['PrenomC'], 0, 3))."-".str_replace("-","",$_SESSION['DatNaisC']);
    $_SESSION['NumC'] = $identifier;


    
    

?>