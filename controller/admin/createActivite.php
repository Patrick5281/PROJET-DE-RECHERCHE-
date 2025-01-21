<?php
require_once __DIR__ . '/../../include/model/admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_debut = $_POST['date_debut'];
    $lieu = $_POST['lieu'];
    $type = $_POST['type'];
    $statut = $_POST['statut'];
    $lien_externe = $_POST['lien_externe'];

    // Gestion de l'upload de l'image
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/activites/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_path = $upload_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image = 'uploads/activites/' . $new_filename;
        }
    }

    // Création de l'activité
    $result = createActivite(
        $titre,
        $description,
        $date_debut,
        $lieu,
        $image,
        $lien_externe,
        $type,
        $statut
    );

    if ($result) {
        header('Location: ../../include/view/admin/showActivity.php?success=create');
        exit();
    } else {
        header('Location: ../../include/view/admin/createActivity.php?error=create');
        exit();
    }
}
?>
