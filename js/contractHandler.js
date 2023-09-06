



/**
 * Declencheur de la mise à jour d'un contrat et gestion de l'affichage du statu de l'opération 
 * @param {*} newData Nouvelles données du contrat
 * @param {*} delete_all [true || false (par defaut)] Option de suppression des champs existants sur la page 
 */
function updateContract(newData, delete_all = false) {


    $.ajax({
        url: '../php/contractModel.php',
        type: 'POST',
        data: {
            action: 'update',
            data: JSON.stringify(newData),

        },

        success: function (response) {
            console.log('updateContract has been executed.');

            // En cas de faute de l'utilisateur
            if (response.indexOf('FAIL') > -1) {
                $('#span-stats').html('<span style="color:red;font-weight:bold;">' + response.split(':')[1] + '</span>');
            } else if (response.indexOf('Success!') > -1) {
                // En  cas de succès
                $('#span-stats').html('<img class="success-operation" src="../addons/img/check.png">');


                if (delete_all) {
                    // Suppression des éléments remplie
                    var textInputs = document.querySelectorAll('input[type="text"],input[type="date"],input[type="time"]');
                    textInputs.forEach(element => {
                        element.value = '';
                    });
                }

            } else {
                // Si une erreur du serveur ce produit
                $('#span-stats').html('<span style="color:red;font-weight:bold;">Une erreur s\'est produite </span>');
            }


            // Réinitialisation automatique du statu de l'opération 
            setInterval(function () { $('#span-stats').html('') }, 3000);
        },
        error: function (xhr, status, error) {
            console.error('Error page (updateContract) : ', status, error);
        }

    })

}


/**
 * Declencheur de suppression de contrat et gestion de l'affichage de l'état
 */
function delContract() {
    $.ajax({
        url: '../php/contractModel.php',
        type: 'POST',
        data: {
            action: 'delete',
        },
        success: function (response) {
            console.log('delContract has been executed.');
            if (response.indexOf('Success!') > -1) {
                $('#span-stats').html('<img class="success-operation" src="../addons/img/check.png">');

            } else {
                $('#span-stats').html('<span style="color:red;font-weight:bold;">Une erreur s\'est produite </span>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error page (addContract) : ', status, error);
        }

    })


}

/**
 * Declencheur de l'ajout d'un nouveau contrat et gestion du statu de l'opération 
 * @param {*} data Array contenant les données du contrat
 * @param {*} delete_all [true || false (par defaut)] Option de suppression des champs existants sur la page 
 */
function addContract(data, delete_all = false) {
    $.ajax({
        url: '../php/contractModel.php',
        type: 'POST',
        data: {
            action: 'add',
            data: JSON.stringify(data),

        },
        success: function (response) {
            console.log('addContract has been executed.');

            // Si l'ajout à échoué par une faute utilisateur
            if (response.indexOf('FAIL') > -1) {
                // Afficher l'erreur 
                $('#span-stats').html('<span style="color:red;font-weight:bold;">' + response.split(':')[1] + '</span>');
            } else if (response.indexOf('Success!') > -1) {
                $('#span-stats').html('<span style="color:green;font-weight:bold;">' + response.split(':')[1] + '</span>');


                if (delete_all) {
                    // Suppression des éléments remplie
                    var textInputs = document.querySelectorAll('input[type="text"],input[type="date"],input[type="time"]');
                    textInputs.forEach(element => {
                        element.value = '';
                    });
                }

            } else {

                // Si cette erreur est dû au serveur ou un defaut de requête, ne pas afficher l'erreur en détail
                $('#span-stats').html('<span style="color:red;font-weight:bold;">Une erreur interne s\'est produite </span>');
            }


            // Réinitialisation automatique du statu de l'opération 
            setInterval(function () { $('#span-stats').html('') }, 5000);
        },
        error: function (xhr, status, error) {
            console.error('Error page (addContract) : ', status, error);
        }

    })
}

