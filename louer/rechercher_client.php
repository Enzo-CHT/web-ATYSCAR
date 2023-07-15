<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module">
        import {
            redirectTo
        } from "../js/actButton.js";
        document.getElementById('btn-chercher').onclick = function() {
            const data = document.getElementById('contract-id').value;

            try {
                $.ajax({
                    url: '../php/searchClient.php',
                    type: 'GET',
                    data: {
                        client: data
                    },
                    success: function() {
                        console.log("searchClient has been executed.");
                        redirectTo('../fichiers/fichier-clients.php')
                    },
                    error: function(xhr, status, error) {
                        console.error("Page error (searchClient) : ", error, status);
                    }
                })


            } catch (error) {
                console.error("Error (searchClient)", error);
            }

        }
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