<?php
session_start();

require_once __DIR__ . '/../../include/model/admin.php';

try {
    // Récupérer la liste des annonces
    $annonces = getAnnonces();
    
    // Inclure la vue
    require_once __DIR__ . '/../../include/view/admin/showAnnonce.php';
} catch (Exception $e) {
    $_SESSION['error'] = "Une erreur est survenue lors de la récupération des annonces : " . $e->getMessage();
    header('Location: ../../include/view/admin/showAnnonce.php');
    exit();
}
?>
