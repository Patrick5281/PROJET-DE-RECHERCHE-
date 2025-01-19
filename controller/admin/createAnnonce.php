<?php

require_once __DIR__ . '../../include/model/admin.php';

// Relier le model Annonce à la vue createAnnonce.php 

if (isset($_POST['valider'])) {

    if (
        !empty($_POST['titre']) &&
        !empty($_POST['description']) &&
        !empty($_POST['auteur']) &&
        !empty($_POST['date_expiration']) &&
        !empty($_POST['categorie']) &&
        !empty($_POST['etat']) &&
        !empty($_POST['fichiers_joint']) &&
        !empty($_POST['lien_externe']) &&
        !empty($_POST['image_annonce']) &&
        !empty($_POST['tags'])
    ) {

        // Appel de la fonction d'insertion 
        $response = createAnnonce(
            $_POST['titre'],
            $_POST['description'],
            $_POST['auteur'],
            $_POST['date_expiration'],
            $_POST['categorie'],
            $_POST['etat'],
            $_POST['fichiers_joint'],
            $_POST['lien_externe'],
            $_POST['image_annonce'],
            $_POST['tags']
        );

        if ($response) {
            $success_msg = "Insertion réussie";
        } else {
            $error_msg = "Une erreur s'est produite";
        }
    }
}
