




export async function getVehicule() {
    var dataArray = {};
    var inputElements = document.querySelectorAll('input:not(.menu-button)'); //Récupère tous les inputs
    // Récupère les radio
    inputElements.forEach(function (element) {
        dataArray[element.getAttribute('name')] = element.value;
    });


    /*
    dataArray :  {CarV: '2', NbPlV: '2500', PuisV: '4', MarV: 'Ferrari', ModV: 'S78', CoulV: "Rouge"}
*/

}