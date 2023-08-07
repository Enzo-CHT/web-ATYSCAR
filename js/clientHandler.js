import { resetSession, setSession, updateSession } from "./sessionHandler.js";
import { redirectTo } from "./actButton.js";


let path = "../php/";


/**
 * Permet d'ajouter un nouveau client s'il n'en existe pas encore
 * Sinon met à jour la session avec le numéro client
 * @param {array} dataArray Données du formulaire
 * @param {*} page Page de redirection
 */
export async function newClient(dataArray, page = null) {


    if (checkRequirement(dataArray)) {
        await resetSession();
        await setSession(dataArray);
        try {
            await $.ajax({
                url: path + 'newClient',
                type: 'GET',
                success: async function () {
                    console.log('newClient has been executed.');
                    await updateSession();
                    redirectTo(page);
                }
            })

        } catch (error) {
            console.error('Page error (newClient) :', error);
        }
    }

}

/**
 * Permet de supprimer un client dans la base de données
 * @param {str} page chemin de redirection après la suppression
 */
export async function delClient(page = null) {

    try {

        await $.ajax({
            url: path + 'delClient',
            type: 'GET',
            success: async function () {
                console.log("delClient has been executed.");
                await resetSession();

            },
            error: function (xhr, status, error) {
                console.error('Page error (delClient) : ', error, status)
            }
        })

    } catch (error) {
        console.error("clientHandler error : ", error);
    }

    window.location.href = page;

}

/**
 * Met à jour les informations du client avec les données du formulaire
 * Les données du formulaire doivent être nommée de la même manière que les attributs de la base de données
 * @param {array} dataArray Contient les données du formulaire 
 */
export async function updateClient(dataArray) {
    await setSession(dataArray) //Ne récupère que le numéro client
    try {
        await $.ajax({
            url: path + 'updateClient',
            type: 'GET',
            success: async function () {
                console.log('updateClient has been executed.');
            }
        })

    } catch (error) {
        console.error("Erreur dans updateClient:", error);
    }


}

/**
 * Permet de changer l'utilisateur afficher sur la page (met à jour la $_SESSION)
 * @param {int} way (1 : Suivant / -1 : Précédent)
 * @param {str} page chemin vers la page de redirection
 */
export async function changeClient(way) {

    try {

        await $.ajax({
            url: path + 'changeClient',
            type: 'POST',
            data: {
                way: way
            },
            success: async function () {
                console.log('changeClient has been executed.');
                await updateSession();
                $("#fichier-client").load(document.URL + '#fichier-client'); 
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
 * Permet de vérifier si des champs de données répondent à des conditions définis
 * @param {array} data Contient les toutes les données contenu dans la page
 * @returns True | False
 */
function checkRequirement(data) {
    /// Vérifie que certaine condition ont été remplie avant de continuer 
    console.log("Vérification des prérequis ... ");

    if (data) {
        for (const element in data) {
            const currentElement = data[element];

            if (element === 'client') {

                if (currentElement['NomC'] && currentElement['PrenomC'] && currentElement['DatNaisC']) {
                    return true;
                }

            }
        }
    }



}


