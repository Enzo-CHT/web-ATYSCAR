

let path = "../php/";


export async function setSession(data) { ///// CHANGER, SESSION NON MIS A JOUR CORRECTEMENT, DONNER MAL ENVOYER


    try {
        const response = await fetch(path + "sessionSetter", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' // Envoie JSON
            },
            body: JSON.stringify(data) ///// ICI
        });

        if (response.ok) {
            console.log("setSession a été executé..");
        } else {
            console.error("setSession n'a pas été executé :", response.status);
        }

    } catch (error) {
        console.error("Erreur dans setSession:", error);
    }

}


export async function updateSession() {


    try {
        const response = await fetch(path + "sessionUpdater", {
            method: 'GET',

        });

        if (response.ok) {
            console.log("updateSession a été executé..");
        } else {
            console.error("updateSession n'a pas été executé :", response.status);
        }

    } catch (error) {
        console.error("Erreur dans updateSession:", error);
    }

}



export async function resetSession() {
    try {
        const response = await fetch(path + "sessionReset", {
            method: 'GET',
        });

        if (response.ok) {
            console.log("session réinitiliser..");
        } else {
            console.error("sessionReset n'a pas été executé :", response.status);
        }

    } catch (error) {
        console.error("Erreur dans sessionReset:", error);
    }
}
