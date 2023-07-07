<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="module">
        import {searchClient} from "../js/clientHandler.js"
        document.getElementById('btn-chercher').onclick = function() {searchClient('../fichiers/fichier-clients.php')}
    </script>
    <title>RECHERCHER CLIENT</title>
</head>
<body>
    <main id="rechercher-client">
        <div>
            <span id="rechercher_client-raise-error"></span>
        <form action="../php/searchClient.php" method="post">
                <input id="contract-id" type="text">
                <input id="btn-chercher" class="menu-button" type="button" value="CHERCHER">
            </form>
        </div>
    </main>
    
</body>
</html>