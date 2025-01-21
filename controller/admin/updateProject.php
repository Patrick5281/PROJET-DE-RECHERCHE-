<?php
require_once __DIR__ . '/../../include/model/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $description = $_POST['description'];
    $etat = $_POST['etat'];
    $montant_financement = $_POST['montant_financement'];
    $partenaires = $_POST['partenaires'];
    $objectifs = $_POST['objectifs'];
    $domaines = $_POST['domaines'];

    // Gestion de l'upload de l'image
    $image_projet = null;
    if (isset($_FILES['image_projet']) && $_FILES['image_projet']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/images/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['image_projet']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_path = $upload_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['image_projet']['tmp_name'], $target_path)) {
            $image_projet = 'uploads/images/' . $new_filename;
        }
    }

    // Gestion de l'upload de la vidéo
    $video_projet = null;
    if (isset($_FILES['video_projet']) && $_FILES['video_projet']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/videos/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['video_projet']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_path = $upload_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['video_projet']['tmp_name'], $target_path)) {
            $video_projet = 'uploads/videos/' . $new_filename;
        }
    }

    // Mise à jour du projet
    $result = updateProjet(
        $id,
        $titre,
        $date_debut,
        $date_fin,
        $description,
        $etat,
        $montant_financement,
        $partenaires,
        $objectifs,
        $domaines,
        $image_projet,
        $video_projet
    );

    if ($result) {
        header('Location: ../../include/view/admin/showProjetAd.php?success=update');
        exit();
    } else {
        header('Location: ../../include/view/admin/editProjet.php?id=' . $id . '&error=update');
        exit();
    }
}
