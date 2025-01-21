<?php
session_start();
require_once '../../include/model/admin.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer l'annonce pour obtenir les fichiers à supprimer
    $annonce = getAnnonceById($id);
    
    if ($annonce) {
        // Supprimer l'annonce
        if (deleteAnnonce($id)) {
            $_SESSION['success'] = "L'annonce a été supprimée avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de l'annonce.";
        }
    } else {
        $_SESSION['error'] = "Annonce non trouvée.";
    }
} else {
    $_SESSION['error'] = "ID de l'annonce non spécifié.";
}

header('Location: ../../include/view/admin/showAnnonce.php');
exit();