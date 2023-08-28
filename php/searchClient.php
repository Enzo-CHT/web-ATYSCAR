


<?php 
session_start();
require "connexion.php";


   
   //Mettre en place bind_param
   if (isset($_GET['client']) && !empty($_GET['client'])) {
      $requete = "SELECT * FROM CLIENT WHERE NumC=?";
      $stmt = $connexion->prepare($requete);
      $stmt->bind_param('s',$_GET['client']);
     
      $stmt->execute();


      if (!$stmt->execute()) {
         $_SESSION['error'] = $connexion->error;
         echo "<script>window.location.href = '../error.php';</script>";
      } else {
         $resultat = $stmt->get_result();
         
         if ($resultat->num_rows > 0) {
           
            while ($row = $resultat->fetch_assoc()) {
               
                foreach ($row as $key => $value) {
                  echo "$key => $value \n";
                  $_SESSION['client'][$key] = $value;
                }
            }
            echo "SUCCESS!!!";
        } else {
            echo "FAIL : No result";
         }
         
      }
   }
   
   
   
 

 mysqli_close($connexion);


?>