function getForm(formid) {
  const form = document.getElementById(formid);
  const formData = new FormData(form);

  var dataArray = {
    'vehicule' : {},
  }
  // Enregistrement des données dans le tableau
  formData.forEach((value, key) => {
    dataArray["vehicule"][key] = value;
  });

  return dataArray;
}

/**
 * Fonction de déclanchement de sauvegarde du vehicule
 */
function saveVehicule(formid) {
  dataArray = getForm(formid);
  setSession(dataArray); // Enregistrement du véhicule dans la session
  $.ajax({
    url: "../php/vehiculeModel.php",
    type: "GET",
    async: false,
    data: {
      function: "saveVehicule", // Action dans le model
      data: JSON.stringify(dataArray),
    },
    success: function () {
      console.log("saveVehicule has been executed.");

      // Refresh la page
      $("#fichier-vehicule").load(document.URL + "#fichier-vehicule");
    },
    error: function (xhr, status, error) {
      console.error("Error page () : ", error, status);
    },
  });
}

/**
 * Fonction de déclanchement de mis à jour du véhicule
 */
function updateVehicule(formid) {
  dataArray = getForm(formid);
  $.ajax({
    url: "../php/vehiculeModel.php",
    type: "GET",
    async: false,
    data: {
      data: JSON.stringify(dataArray), // Tableau comportant les nouvelles données
      function: "updateVehicule", // Action dans le model
    },
    success: async function () {
      console.log("updateVehicule has been executed.");
      await updateSession("vehicule"); // Mis à jour de la SESSION avec les nouvelles infos

      // Refresh la page
      $("#fichier-vehicule").load(document.URL + "#fichier-vehicule");
    },
    error: function (xhr, status, error) {
      console.error("Error page () : ", error, status);
    },
  });
}

/**
 * Fonction de déclanchement de  suppression de véhicule
 */
function delVehicule(formid) {
  dataArray = getForm(formid);
  setSession(dataArray); //Recupération de l'identifiant dans une nouvelle SESSION
  $.ajax({
    url: "../php/vehiculeModel.php",
    type: "GET",
    async: false,
    data: {
      function: "deleteVehicule", // Action dans le model
    },
    success: async function () {
      console.log("delVehicule has been executed.");
      await resetSession("vehicule"); // Suppression de la SESSION vehicule existante

      //Refresh la page
      $("#fichier-vehicule").load(document.URL + "#fichier-vehicule");
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
function switchVehicule(way) {
  $.ajax({
    url: "../php/vehiculeModel.php",
    type: "GET",
    async: false,
    data: {
      function: "switchVehicule", // Action dans le model
      data: JSON.stringify(way),
    },
    success: async function () {
      console.log("switchVehicule has been executed.");

      // Mis à jour de la session
      // Avec les nouvelles données
      await updateSession("vehicule");

      // Refresh de la page
      $("#fichier-vehicule").load(document.URL + "#fichier-vehicule");
    },
    error: function (xhr, status, error) {
      console.error("Error page (switchVehicule) : ", error, status);
    },
  });
}
