<?php

require_once __DIR__ . '/../../model/admin.php';

// Relier le modèle Activité à la vue update.php

if (isset($_POST['modifier'])) {

    if (
        !empty($_POST['titre']) &&
        !empty($_POST['date_debut']) &&
        !empty($_POST['lieu']) &&
        !empty($_POST['description']) &&
        !empty($_POST['statut']) &&
        !empty($_POST['type']) &&
        !empty($_POST['image']) &&
        !empty($_POST['lien_externe'])
    ) {

        // Appel de la fonction de modification
        $response = updateActivite(
            $_GET['id_act'],
            $_POST['titre'],
            $_POST['description'],
            $_POST['date_debut'],
            $_POST['lieu'],
            $_POST['image'],
            $_POST['lien_externe'],
            $_POST['type'],
            $_POST['statut']
        );

        if ($response) {
            $success_msg = "Mise à jour réussie";
        } else {
            $error_msg = "Une erreur s'est produite";
        }
    } else {
        $error_msg = "Veuillez remplir tous les champs.";
    }
}
?>
