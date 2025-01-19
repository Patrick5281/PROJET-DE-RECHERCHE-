<?php
require_once __DIR__ . "/../../../controller/admin/createProjet.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Projet</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css"; ?>>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <style>
        /* Style pour le pop-up */
        .popup-success {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
        }
    </style>
</head>

<body>
<?php
// Inclure le header
include '../conponents/header.php';
?>
<section>
        <div class="container form-container">
        <h2 class="form-title text-center mb-4">Ajouter un Projet de Recherche</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du Projet</label>
                <input type="text" class="form-control" id="title" name="titre" placeholder="Entrez le titre du projet">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Date de D&eacute;but</label>
                    <input type="date" class="form-control" name="date_debut" id="start_date">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Date de Fin</label>
                    <input type="date" class="form-control" name="date_fin" id="end_date">
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"  rows="3" placeholder="D&eacute;crivez le projet"></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">&Eacute;tat du Projet</label>
                <select class="form-select" id="status" name="etat">
                    <option value="en cours">En cours</option>
                    <option value="finalisé">Finalisé</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="funding" class="form-label">Montant du Financement</label>
                <input type="number" class="form-control" id="funding" name="montant_financement" placeholder="Entrez le montant">
            </div>
            <div class="mb-3">
                <label for="partner" class="form-label">Partenaires</label>
                <input type="text" class="form-control" id="partner" name="partenaires" placeholder="Entrez les partenaires">
            </div>
            <div class="mb-3">
                <label for="objectives" class="form-label">Objectifs</label>
                <textarea class="form-control" id="objectives" name="objectifs" rows="3" placeholder="Entrez les objectifs du projet"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="domain" class="form-label">Domaine</label>
                    <input type="text" class="form-control" id="domain" name="domaines" placeholder="Entrez le domaine du projet">
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image du Projet</label>
                <input type="file" class="form-control" id="image" name="image_projet" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="photos" class="form-label">Photos du Projet</label>
                <input type="file" class="form-control" id="photos" name="photos_projet[]" multiple accept="image/*">
            </div>

            <div class="mb-3">
                <label for="video" class="form-label">Vidéo du Projet</label>
                <input type="file" class="form-control" id="video" name="video_projet" accept="video/*">
            </div>

            <button type="submit" class="btn btn-publish w-20">Publier le Projet</button>
        </form>
        
    </div>  
</section>
<div class="popup-success" id="popup-success">
    Projet ajouté avec succès ! Vous serez redirigé sous peu...
</div>

<?php
// Inclure le footer
include '../conponents/footer.php';
?>

<script>
    const popup = document.getElementById('popup-success');
    <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
        popup.style.display = 'block';
        setTimeout(() => {
            popup.style.display = 'none';
            window.location.href = '../../../index.php';
        }, 3000);
    <?php endif; ?>
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>