

// Chemin vers le model
let processFile = "../php/vehiculeModel.php";

/**
 * Class de gestion des intéraction avec le model vehicule
 */
class Vehicule {

    constructor(formId) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        this.dataArray = { 'vehicule': {} }; // Tableau des données du véhicule
        
        // Enregistrement des données dans le tableau
        formData.forEach((value, key) => {
            this.dataArray['vehicule'][key] = value;
        });

    

    }

    /**
     * Fonction de déclanchement de sauvegarde du vehicule
     */
    saveVehicule() {
        setSession(this.dataArray); // Enregistrement du véhicule dans la session
        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                function: "saveVehicule", // Action dans le model
                data: JSON.stringify(this.dataArray),
            },
            success: function () {
                console.log("saveVehicule has been executed.");

                // Refresh la page
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');   
                
                
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    /**
     * Fonction de déclanchement de mis à jour du véhicule
     */
    updateVehicule() {
        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                data: JSON.stringify(this.dataArray), // Tableau comportant les nouvelles données
                function : "updateVehicule",// Action dans le model
            },
            success: async function () {
                console.log("updateVehicule has been executed.");
                await updateSession('vehicule'); // Mis à jour de la SESSION avec les nouvelles infos 

                // Refresh la page
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');  

            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }
    
    /**
     * Fonction de déclanchement de  suppression de véhicule
     */
    delVehicule() {
        setSession(this.dataArray); //Recupération de l'identifiant dans une nouvelle SESSION
        $.ajax({
            url: processFile,
            type: "GET",
            data : {
                function : "deleteVehicule", // Action dans le model
            },
            success: async function () {
                console.log("delVehicule has been executed.");
                await resetSession('vehicule'); // Suppression de la SESSION vehicule existante

                //Refresh la page
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');  

            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    /**
     * Fonction de déclanchement de changement de véhicule
     * @param {*} way Entier (1 ou -1)
     * 
     */
    async switchVehicule(way) {
        
        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                function : "switchVehicule", // Action dans le model
                data: JSON.stringify(way),
            },
            success: async function () {
                
                console.log("switchVehicule has been executed.");
                
                // Mis à jour de la session 
                // Avec les nouvelles données
                await updateSession('vehicule'); 

                // Refresh de la page
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');  
            },
            error: function (xhr, status, error) {
                console.error("Error page (switchVehicule) : ", error, status);
            },
        })

       
    }

  
    
}

