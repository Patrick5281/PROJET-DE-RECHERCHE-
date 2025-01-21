<?php
session_start();
require_once '../../include/model/admin.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer le projet pour obtenir les fichiers à supprimer
    $projet = getProjetById($id);
    
    if ($projet) {
        // Supprimer le projet
        if (deleteProjet($id)) {
            $_SESSION['success'] = "Le projet a été supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression du projet.";
        }
    } else {
        $_SESSION['error'] = "Projet non trouvé.";
    }
} else {
    $_SESSION['error'] = "ID du projet non spécifié.";
}

header('Location: ../../include/view/admin/showProjetAd.php');
exit();