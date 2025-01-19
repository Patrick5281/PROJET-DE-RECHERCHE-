<?php

require_once __DIR__. '../../include/model/admin.php';

// Relier le model Projet à la vue create.php 

if (isset($_POST['valider'])) {

    if (
        !empty($_POST['titre']) &&
        !empty($_POST['date_debut']) &&
        !empty($_POST['date_fin']) &&
        !empty($_POST['description']) &&
        !empty($_POST['etat']) &&
        !empty($_POST['montant_financement']) &&
        !empty($_POST['partenaires']) &&
        !empty($_POST['objectifs']) &&
        !empty($_POST['domaines']) &&
        !empty($_POST['image_projet']) &&
        !empty($_POST['video_projet'])
    ) {

        // Appel de la fonction d'insertion 
        $response = createProjet(
            $_POST['titre'],
            $_POST['date_debut'],
            $_POST['date_fin'],
            $_POST['description'],
            $_POST['etat'],
            $_POST['montant_financement'],
            $_POST['partenaires'],
            $_POST['objectifs'],
            $_POST['domaines'],
            $_POST['image_projet'],
            $_POST['video_projet']
        );

        if ($response) {
            $success_msg = "Insertion réussie";
        } else {
            $error_msg = "Une erreur s'est produite";
        }
    }
}
