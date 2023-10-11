
/**
 * Permet d'ajouter un nouveau client s'il n'en existe pas encore
 * Sinon met à jour la session avec le numéro client
 * @param {array} dataArray Données du formulaire
 * @param {*} page Page de redirection
 */
async function newClient(dataArray) {



    await resetSession('client');
    await setSession(dataArray);

    await $.ajax({
        url: "../php/clientModel.php",
        type: 'GET',
        async: false,
        data: {
            function: 'newClient',
        },
        success: async function (response) {

            displayResponse(response = response.split(':'), redirect = true);
            //console.log('newClient has been executed.');
            await updateSession('client');


            setInterval(function () {
                document.getElementById('span-stats').innerHTML = '';
            }, 5000)
        },
        error: function (xhr, error, status) {
            console.error('Page error (newClient) :', error);
        }
    })




}

/**
 * Permet de supprimer un client dans la base de données
 * @param {str} page chemin de redirection après la suppression
 */
async function delClient() {

    await $.ajax({
        url: "../php/clientModel.php",
        type: 'GET',
        async: false,
        data: {
            function: 'delClient',
        },
        success: async function (response) {
            //console.log("delClient has been executed.");

            // Suppression des champs
            var textInputs = document.querySelectorAll('input[type="text"],input[type="date"],input[type="time"]');
            textInputs.forEach(element => {
                element.value = '';
            });
            displayResponse(response.split(':'));
            await resetSession('client');
        },
        error: function (xhr, status, error) {
            console.error('Page error (delClient) : ', error, status)
        }
    })



}

/**
 * Met à jour les informations du client avec les données du formulaire
 * Les données du formulaire doivent être nommée de la même manière que les attributs de la base de données
 * @param {array} dataArray Contient les données du formulaire 
 */
async function updateClient(dataArray) {
    await setSession(dataArray) //Ne récupère que le numéro client

    await $.ajax({
        url: "../php/clientModel.php",
        type: 'GET',
        data: {
            function: 'updateClient',
        },
        success: function (response) {
            //console.log('updateClient has been executed.');
            displayResponse(response.split(':'));
           

        },
        error: function (xhr, error, status) {
            console.error("Erreur dans updateClient:", error);
        }
    })


}

/**
 * Permet de changer l'utilisateur afficher sur la page (met à jour la $_SESSION)
 * @param {int} way (1 : Suivant / -1 : Précédent)
 * @param {str} page chemin vers la page de redirection
 */
async function changeClient(way) {

    try {

        await $.ajax({
            url: "../php/clientModel.php",
            type: 'GET',
            async: false,
            data: {
                function: 'changeClient',
                data: way,
            },
            success: async function (response) {
                //console.log('changeClient has been executed.');
                await updateSession('client');
                $('body').load('../fichiers/fichier-clients.php');
            },
            error: function (xhr, status, error) {
                console.error('Page error (newClient)', error, status)
            }
        })


    } catch (error) {
        console.error('changeClient error : ', error)
    }


}





/**
 * Fonction d'affichage du résultat de la réquête a l'agent
 * @param {*} response Reponse du serveur
 * @param {*} redirect Redirige vers caller de la page
 */
function displayResponse(response, redirect = false) {
    response[0] = response[0].replace(/[^a-zA-Z ]/g, "");
    if (response[0] == 'FAIL') {
        document.getElementById('span-stats').innerHTML = "<span style=color:red>" + response[1] + "</span>";
    } else if (response[0] == 'SUCCESS') {
        if (redirect) {
            document.location.href = '';
        } else {
            document.getElementById('span-stats').innerHTML = "<span style=color:green>" + response[1] + "</span>";
        }
    } else {
        console.error('Une erreur cest produite');
    }

    setInterval(function () {
        document.getElementById('span-stats').innerHTML = '';
    }, 5000)
}