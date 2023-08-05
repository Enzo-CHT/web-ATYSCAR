import { setSession, resetSession, updateSession } from "./sessionHandler";


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
            url: "../php/processVehicule.php",
            type: "GET",
            data: {
                function: "saveVehicule",
                data: JSON.stringify(this.dataArray),
            },
            success: function () {
                console.log("saveCar has been executed.");

            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    updateVehicule() {

        $.ajax({
            url: "",
            type: "GET",
            data: {
                data: JSON.stringify(this.dataArray),
            },
            success: function () {
                console.log("updateCar has been executed.");
                updateSession();
                document.location.href = "./";
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }
    delVehicule() {
        $.ajax({
            url: "",
            type: "GET",
            data: {
                data: JSON.stringify(this.dataArray['MatV']),
            },
            success: function () {
                console.log(" has been executed.");
                resetSession('car');
                document.location.href = "./";
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        });
    }

    changeVehicule(identifier, way) {
        $.ajax({
            url: "",
            type: "GET",
            data: {
                data: JSON.stringify((identifier, way)),
            },
            success: function () {
                console.log(" has been executed.");
                updateSession();
            },
            error: function (xhr, status, error) {
                console.error("Error page () : ", error, status);
            },
        })
    }

  
    
}

