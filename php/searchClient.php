


<?php 
session_start();
require "connexion.php";


   
   //Mettre en place bind_param
   if (isset($_POST['contractId']) && !empty($_POST['contractId'])) {
      $requete = "SELECT * FROM CLIENT WHERE NumC=?";
      $stmt = $connexion->prepare($requete);
      $stmt->bind_param('s',$_POST['contractId']);
     
      $stmt->execute();


      if (!$stmt->execute()) {
         $_SESSION['error'] = $connexion->error;
         echo "<script>window.location.href = '../error.php';</script>";
      } else {
         $resultat = $stmt->get_result();
         
         if (!empty($resultat)) {
           
            while ($row = $resultat->fetch_assoc()) {
               
                foreach ($row as $key => $value) {
                  echo $key, $value;
                    $_SESSION[$key] = $value;
                }
            }
        } else {
            $_SESSION['page_error'] = "louer/contrat.php";
            $_SESSION['error'] = "L'utilisateur n'existe pas";
            echo "<script>window.location.href = '../error.php';</script>";
         }
         
      }
   }
   
   
   
 

 mysqli_close($connexion);


?>