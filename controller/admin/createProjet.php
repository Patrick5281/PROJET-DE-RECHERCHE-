<?php
require_once __DIR__ . "/../../include/model/admin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $titre = $_POST['titre'] ?? '';
    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';
    $description = $_POST['description'] ?? '';
    $etat = $_POST['etat'] ?? '';
    $montant_financement = $_POST['montant_financement'] ?? 0;
    $partenaires = $_POST['partenaires'] ?? '';
    $objectifs = $_POST['objectifs'] ?? '';
    $domaines = $_POST['domaines'] ?? '';
    
    // Appel de la fonction du modèle pour créer le projet
    $result = createProjet(
        $titre,
        $date_debut,
        $date_fin,
        $description,
        $etat,
        $montant_financement,
        $partenaires,
        $objectifs,
        $domaines,
        null, // image_projet sera géré dans la fonction createProjet
        null  // video_projet sera géré dans la fonction createProjet
    );

    if ($result) {
        // Redirection avec message de succès
        header("Location: /../../include/view/admin/createProjet.php?success=true");
        exit();
    } else {
        // Redirection avec message d'erreur
        header("Location: ../../include/view/admin/createProjet.php?error=true");
        exit();
    }
}
?>
