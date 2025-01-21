<?php
session_start();
require_once __DIR__ . '/../../include/model/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupération des données du formulaire
        $id_act = $_POST['id_act'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date_debut = $_POST['date_debut'];
        $lieu = $_POST['lieu'];
        $type = $_POST['type'];
        $statut = $_POST['statut'];
        $lien_externe = $_POST['lien_externe'] ?? null;

        // Gestion de l'image
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $upload_dir = __DIR__ . '/../../assets/uploads/activites/images/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $image_name = time() . '_' . basename($_FILES['image']['name']);
            $image = 'assets/uploads/activites/images/' . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);
        }

        // Mise à jour de l'activité
        updateActivite(
            $id_act,
            $titre,
            $description,
            $date_debut,
            $lieu,
            $image,
            $lien_externe,
            $type,
            $statut
        );

        $_SESSION['success'] = "L'activité a été mise à jour avec succès.";
        header('Location: ../../include/view/admin/showActivity.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = "Erreur lors de la mise à jour de l'activité : " . $e->getMessage();
        header('Location: ../../include/view/admin/showActivity.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Méthode non autorisée.";
    header('Location: ../../include/view/admin/showActivity.php');
    exit();
}
