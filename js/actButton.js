

/**
 * Permet de rediriger l'utilisateur vers une autre page
 * @param {str} page URL de redirection
 */
export function redirectTo(page) {

    if (page != null) {
        window.location.href = page;
        console.log("Redirection de page .. ");
    }

}



