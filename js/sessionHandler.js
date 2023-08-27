

/**
 *
 * @param {Array} dataArray Données contenant les informatiosn à définir en session
 */
async function setSession(dataArray) {
  try {
    await $.ajax({
      url: "../php/sessionSetter.php",
      type: "POST",
      data: {
        data: JSON.stringify(dataArray),
      },
    });

    console.log("setSession has been executed.");
  } catch (error) {
    console.error("Session error (setSession):", error);
  }
}

/**
 * Met à jour la session en liant le numéro client à ses informations intra base de données
 */
async function updateSession(sessionName = "all") {
  await $.ajax({
    url: "../php/sessionUpdater.php",
    type: "POST",
    data: {
      session: sessionName,
    },
    success: function () {
      console.log("updateSession has been executed.");
    },
    error: function (xhr, status, error) {
      console.error("Session error (updateSession):", error, status);
    },
  });
}

/**
 * Réinitialise la session en cour
 */
async function resetSession(session = "all") {
  try {
    await $.ajax({
      url: "../php/sessionReset.php",
      type: "GET",
      data: {
        session: JSON.stringify(session),
      },
      success: function () {
        console.log("resetSession has been executed.");
      },
    });
  } catch (error) {
    console.error("Session error (resetSession):", error);
  }
}
