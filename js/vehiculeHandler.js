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
                updateSession();
                document.location.href = "";
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
            data: {
                data: JSON.stringify(this.dataArray['MatV']),
            },
            success: function () {
                console.log("delVehicule has been executed.");
                resetSession('vehicule');
                document.location.href = "";
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    async switchVehicule(way) {
        $.ajax({
            url: processFile,
            type: "GET",
            data: {
                function : "switchVehicule",
                data: JSON.stringify(way),
            },
            success: async function () {
                await updateSession();
                setTimeout(function() { document.location.href = "";}, 100);
                console.log("switchVehicule has been executed.");

                
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        })

        
        
    }

  
    
}

