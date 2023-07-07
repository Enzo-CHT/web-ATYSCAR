import { resetSession, setSession, updateSession } from "./sessionHandler.js";
import {redirectTo} from "./actButton.js";


let path = "../php/";



export async function newClient(formId, page = null) {
    if (checkRequirement(formId)) {
        await setSession(formId);
        try {
            const response = await fetch(path+'newClient', {
                method: 'GET',
            });

            if (response.ok) {
                console.log('new Client a été executé..')
                await updateSession();

                if (page != null) {
                    redirectTo(page);
                }

            } else {
                console.error('newClient n\'a pas été executé correctement :',response.status)
            }
        } catch(error) {
            console.error('Erreur dans newClient :', error);
        }
    }
}


export async function delClient(page = null) {

    try {
        const response = await fetch(path+"delClient", {
            method: 'GET',
        });

        if (response.ok) {
            console.log("delClient a été executé..");
            await resetSession();
        } else {
            console.error("delClient n'a pas été executé :", response.status);
        }

    } catch(error) {
        console.error("Erreur dans delClient:", error);
    }

    window.location.href = page;

}

export async function updateClient(formId) {
    await setSession(formId); //Ne récupère que le numéro client
    try {
        const response = await fetch(path+"updateClient", {
            method: 'GET',
        });

        if (response.ok) {
            console.log("updateClient a été executé..");
        } else {
            console.error("updateClient n'a pas été executé :", response.status);
        }

    } catch(error) {
        console.error("Erreur dans updateClient:", error);
    }


}

/**
 * Permet de changer l'utilisateur afficher sur la page (met à jour la $_SESSION)
 * @param {int} way (1 : Suivant / -1 : Précédent)
 * @param {str} page chemin vers la page de redirection
 */
export async function changeClient(way,page=null){

    var dataForm = new FormData();
    dataForm.append('way', way);

   
   try {
       const response = await fetch(path+'changeClient', {
           method: 'POST',
           body: dataForm,
           
        });
        
        
        if (response.ok) {
            console.log('changeClient a été exécuté..');
            await updateSession();
            

        } else {
            console.error("changeClient n'a pas été executé : ",response.status);
        } 
    }catch(error) {
        console.error('Erreur dans changeClient:', error)
    }


    window.location.href = page;
}


export async function searchClient(page=null) {

    const data = document.getElementById('contract-id').value;
    var dataForm = new FormData();
    dataForm.append('contractId', data);


    try {
        const response = await fetch(path+"searchClient", {
            method:  'POST',
            body: dataForm,
        });

        if (response.ok) {
            console.log("searchClient a été executé..");
        } else {
            console.error("searchClient n'a pas été executé :", response.status);
        }

    } catch(error) {
        console.error("Erreur dans searchClient :", error);
    }

    if (page!=null){
        redirectTo(page);
    } else {
        console.error("Erreur de redirection dans searchClient")
    }


}



function checkRequirement(formId) {
    /// Vérifie que certaine condition ont été remplie avant de continuer 
    console.log("Vérification des prérequis ... ");
    if (formId == 'clientForm') {
     
        if (document.getElementById('fichier-client-nom').value == "" ||
            document.getElementById('fichier-client-prenom').value == "" ||
            document.getElementById('fichier-client-date-naissance').value == "") {

            document.getElementById('raise-error').innerHTML = "<p class='raise-error'>Veuillez remplir les champs obligatoires<p>";
            console.error("Erreur de prérequis");
            return false;


        } else {
            return true;
        }
    }

}


