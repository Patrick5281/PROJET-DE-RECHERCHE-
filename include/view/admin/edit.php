<?php
require_once __DIR__ . "/../../../controller/auteur/updateAuteur.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php
// Inclure le header
include '../conponents/header.php';
?>
<section>
    <div class="container form-container">
        <h2 class="form-title text-center mb-4">Modifier un Projet de Recherche</h2>
        <form action="../../../controller/auteur/updateAuteur.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du Projet</label>
                <input type="text" class="form-control" id="title" name="titre" value="<?php echo $projet['titre']; ?>" placeholder="Entrez le titre du projet">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Date de Début</label>
                    <input type="date" class="form-control" name="date_debut" id="start_date" value="<?php echo $projet['date_debut']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Date de Fin</label>
                    <input type="date" class="form-control" name="date_fin" id="end_date" value="<?php echo $projet['date_fin']; ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $projet['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="etat" class="form-label">État</label>
                <input type="text" class="form-control" id="etat" name="etat" value="<?php echo $projet['etat']; ?>" placeholder="Entrez l'état du projet">
            </div>
            <div class="mb-3">
                <label for="montant_financement" class="form-label">Montant de Financement</label>
                <input type="text" class="form-control" id="montant_financement" name="montant_financement" value="<?php echo $projet['montant_financement']; ?>" placeholder="Entrez le montant de financement">
            </div>
            <div class="mb-3">
                <label for="partenaires" class="form-label">Partenaires</label>
                <input type="text" class="form-control" id="partenaires" name="partenaires" value="<?php echo $projet['partenaires']; ?>" placeholder="Entrez les partenaires">
            </div>
            <div class="mb-3">
                <label for="objectifs" class="form-label">Objectifs</label>
                <input type="text" class="form-control" id="objectifs" name="objectifs" value="<?php echo $projet['objectifs']; ?>" placeholder="Entrez les objectifs">
            </div>
            <div class="mb-3">
                <label for="domaines" class="form-label">Domaines</label>
                <input type="text" class="form-control" id="domaines" name="domaines" value="<?php echo $projet['domaines']; ?>" placeholder="Entrez les domaines">
            </div>
            <div class="mb-3">
                <label for="images_projet" class="form-label">Images du Projet</label>
                <input type="file" class="form-control" id="images_projet" name="images_projet">
            </div>
            <div class="mb-3">
                <label for="video_projet" class="form-label">Vidéo du Projet</label>
                <input type="file" class="form-control" id="video_projet" name="video_projet">
            </div>
            <button type="submit" class="btn btn-primary" name="modifier">Mettre à jour</button>
        </form>
    </div>
</section>
<?php
// Inclure le footer
include '../conponents/footer.php';
?> 
</body>
</html>