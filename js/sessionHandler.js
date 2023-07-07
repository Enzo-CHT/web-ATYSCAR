

let path = "../php/";


export async function setSession(formId) {
    const form = document.getElementById(formId);
    const formData = new FormData(form);

    try {
        const response = await fetch(path+"sessionSetter", {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            console.log("setSession a été executé..");
        } else {
            console.error("setSession n'a pas été executé :", response.status);
        }

    } catch(error) {
        console.error("Erreur dans setSession:", error);
    }

}


export async function updateSession() {


    try {
        const response = await fetch(path+"sessionUpdater", {
            method: 'GET',
         
        });

        if (response.ok) {
            console.log("updateSession a été executé..");
        } else {
            console.error("updateSession n'a pas été executé :", response.status);
        }

    } catch(error) {
        console.error("Erreur dans updateSession:", error);
    }
    
}



export async function resetSession() {
    try {
        const response = await fetch(path+"sessionReset", {
            method: 'GET',
        });

        if (response.ok) {
            console.log("session réinitiliser..");
        } else {
            console.error("sessionReset n'a pas été executé :", response.status);
        }

    } catch(error) {
        console.error("Erreur dans sessionReset:", error);
    }
}
