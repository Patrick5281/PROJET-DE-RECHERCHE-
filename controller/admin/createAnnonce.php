<?php
session_start();
require_once __DIR__ . '/../../include/model/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
        // Récupération des données du formulaire
        $titre = isset($_POST['titre']) ? trim($_POST['titre']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;
        $auteur = isset($_POST['auteur']) ? trim($_POST['auteur']) : null;
        $categorie = isset($_POST['categorie']) ? trim($_POST['categorie']) : null;
        $etat = isset($_POST['etat']) ? trim($_POST['etat']) : 'actif';
        $lien_externe = isset($_POST['lien_externe']) ? trim($_POST['lien_externe']) : null;
        $tags = isset($_POST['tags']) ? trim($_POST['tags']) : null;

        // Traitement de la date de publication
        $date_publication = null;
        if (!empty($_POST['date_publication'])) {
            $date_publication = date('Y-m-d H:i:s', strtotime($_POST['date_publication']));
        }

        // Traitement de la date d'expiration
        $date_expiration = null;
        if (!empty($_POST['date_expiration'])) {
            $date_expiration = $_POST['date_expiration'];
        }

        // Validation des champs requis
        $required_fields = ['titre', 'description', 'auteur'];
        $errors = [];
        
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = "Le champ $field est requis.";
            }
        }

        if (!empty($errors)) {
            throw new Exception("Erreurs de validation : " . implode(", ", $errors));
        }

        // Gestion du fichier joint
        $fichiers_joint = null;
        if (isset($_FILES['fichiers_joint']) && $_FILES['fichiers_joint']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = __DIR__ . '/../../uploads/annonces/fichiers/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES['fichiers_joint']['name'], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '.' . $file_extension;
            $target_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['fichiers_joint']['tmp_name'], $target_path)) {
                $fichiers_joint = 'uploads/annonces/fichiers/' . $new_filename;
            } else {
                throw new Exception("Erreur lors de l'upload du fichier joint");
            }
        }

        // Gestion de l'image
        $image_annonce = null;
        if (isset($_FILES['image_annonce']) && $_FILES['image_annonce']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = __DIR__ . '/../../uploads/annonces/images/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES['image_annonce']['name'], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '.' . $file_extension;
            $target_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['image_annonce']['tmp_name'], $target_path)) {
                $image_annonce = 'uploads/annonces/images/' . $new_filename;
            } else {
                throw new Exception("Erreur lors de l'upload de l'image");
            }
        }

        // Log des données avant l'insertion
        error_log("Tentative d'insertion d'annonce avec les données suivantes:");
        error_log("Titre: " . $titre);
        error_log("Description: " . $description);
        error_log("Auteur: " . $auteur);
        error_log("Date publication: " . $date_publication);
        error_log("Date expiration: " . $date_expiration);
        error_log("Catégorie: " . $categorie);
        error_log("État: " . $etat);
        error_log("Fichiers joints: " . $fichiers_joint);
        error_log("Lien externe: " . $lien_externe);
        error_log("Image: " . $image_annonce);
        error_log("Tags: " . $tags);

        // Création de l'annonce
        $result = createAnnonce(
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

        if ($result) {
            $_SESSION['success'] = "L'annonce a été créée avec succès";
            header('Location: ../../include/view/admin/showAnnonce.php');
            exit();
        } else {
            throw new Exception("Erreur lors de la création de l'annonce");
        }
    } catch (Exception $e) {
        error_log("Erreur dans createAnnonce.php : " . $e->getMessage());
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
        header('Location: ../../include/view/admin/createAnnonce.php');
        exit();
    }
}
