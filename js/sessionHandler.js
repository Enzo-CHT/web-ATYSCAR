

let path = "../php/";

/**
 * 
 * @param {Array} dataArray Données contenant les informatiosn à définir en session
 */
export async function setSession(dataArray) {
    try {
        await $.ajax({
            url: path + 'sessionSetter.php',
            type: 'POST',
            data: {
                data: JSON.stringify(dataArray),
            }
        });

        console.log('setSession has been executed.');
    } catch (error) {
        console.error('Session error (setSession):', error);
    }
}

/**
 * Met à jour la session en liant le numéro client à ses informations intra base de données
 */
export async function updateSession() {
    try {
        await $.ajax({
            url: path + 'sessionUpdater.php',
            type: 'GET',
        });

        console.log('updateSession has been executed.');
    } catch (error) {
        console.error('Session error (updateSession):', error);
    }
}


/**
 * Réinitialise la session en cour
 */
export async function resetSession(session = "all") {

    try {
        await $.ajax({
            url: path + 'sessionReset.php',
            type: 'GET',
            data: {
                session: JSON.stringify(session),
            },
            success: function () {
                console.log('resetSession has been executed.');

            }
        });

    } catch (error) {
        console.error('Session error (resetSession):', error);
    }
}
