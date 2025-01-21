<?php
session_start();
require_once __DIR__. '/../../include/model/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupération des données du formulaire
        $id_ann = $_POST['id_ann'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $auteur = $_POST['auteur'];
        $date_publication = $_POST['date_publication'];
        $date_expiration = $_POST['date_expiration'];
        $categorie = $_POST['categorie'];
        $etat = $_POST['etat'];
        $lien_externe = $_POST['lien_externe'];
        $tags = $_POST['tags'];

        // Gestion du fichier joint
        $fichiers_joint = null;
        if (isset($_FILES['fichiers_joint']) && $_FILES['fichiers_joint']['error'] === 0) {
            $upload_dir = __DIR__ . '/../../assets/uploads/annonces/fichiers/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $fichier_name = time() . '_' . basename($_FILES['fichiers_joint']['name']);
            $fichiers_joint = 'assets/uploads/annonces/fichiers/' . $fichier_name;
            move_uploaded_file($_FILES['fichiers_joint']['tmp_name'], $upload_dir . $fichier_name);
        }

        // Gestion de l'image
        $image_annonce = null;
        if (isset($_FILES['image_annonce']) && $_FILES['image_annonce']['error'] === 0) {
            $upload_dir = __DIR__ . '/../../assets/uploads/annonces/images/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $image_name = time() . '_' . basename($_FILES['image_annonce']['name']);
            $image_annonce = 'assets/uploads/annonces/images/' . $image_name;
            move_uploaded_file($_FILES['image_annonce']['tmp_name'], $upload_dir . $image_name);
        }

        // Mise à jour de l'annonce
        updateAnnonce(
            $id_ann,
            $titre,
            $description,
            $auteur,
            $date_publication,
            $date_expiration,
            $categorie,
            $etat,
            $fichiers_joint,
            $lien_externe,
            $image_annonce,
            $tags
        );

        $_SESSION['success'] = "L'annonce a été mise à jour avec succès.";
        header('Location: showAnnonce.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = "Erreur lors de la mise à jour de l'annonce : " . $e->getMessage();
        header('Location: showAnnonce.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Méthode non autorisée.";
    header('Location: showAnnonce.php');
    exit();
}
