import { setSession, resetSession, updateSession } from "./sessionHandler";

let processFile = "../php/processVehicule.php";


export class Vehicule {

    constructor(formId) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        this.dataArray = { 'vehicule': {} };
        
        formData.forEach((value, key) => {
            this.dataArray['vehicule'][key] = value;
        });
       
        setSession(this.dataArray);

    }

    saveVehicule() {
        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                function: "saveVehicule",
                data: JSON.stringify(this.dataArray),
            },
            success: function () {
                console.log("saveVehicule has been executed.");
                
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    updateVehicule() {

        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                data: JSON.stringify(this.dataArray),
            },
            success: function () {
                console.log("updateVehicule has been executed.");
                updateSession('vehicule');
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');  

            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }
    delVehicule() {
        $.ajax({
            url: processFile,
            type: "GET",
            data : {
                function : "deleteVehicule",
            },
            success: function () {
                console.log("delVehicule has been executed.");
                resetSession('vehicule');
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');  

            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    switchVehicule(way) {
        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                function : "switchVehicule",
                data: JSON.stringify(way),
            },
            success: async function () {
                console.log("switchVehicule has been executed.");
                await updateSession('vehicule');
                $("#fichier-vehicule").load(document.URL + '#fichier-vehicule');  
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        })

        
    }

  
    
}

