<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Erreur</title>
</head>
<body>
    <main id="erreur-page">
        <div>
            <h1>ERREUR!</h1>
                <p><b>Une erreur c'est produite lors du processus</b> : <?php echo !empty($_SESSION['error']) ? $_SESSION['error']:"Pas d'erreur associé" ;?></p>
            <a href="<?php echo $_SESSION['page_error']; ?>"><input type="button" class="menu-button" value="Retour au menu principale"></a>
        </div>
    </main>
</body>
</html>