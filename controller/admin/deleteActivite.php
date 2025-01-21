<?php
session_start();
require_once '../../include/model/admin.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer l'activité pour obtenir les fichiers à supprimer
    $activite = getActiviteById($id);
    
    if ($activite) {
        // Supprimer l'activité
        if (deleteActivite($id)) {
            $_SESSION['success'] = "L'activité a été supprimée avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de l'activité.";
        }
    } else {
        $_SESSION['error'] = "Activité non trouvée.";
    }
} else {
    $_SESSION['error'] = "ID de l'activité non spécifié.";
}

header('Location: ../../include/view/admin/showActivity.php');
exit();