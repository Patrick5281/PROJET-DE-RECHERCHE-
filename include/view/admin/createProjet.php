<?php
require_once __DIR__ . "/../../../controller/admin/createProjet.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Projet</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
        .form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1000px;
        }
        .form-title {
            color: #0B2F75;
            font-weight: 600;
            border-bottom: 2px solid #0B2F75;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }
        .form-section-title {
            color: #0B2F75;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .btn-publish {
            background-color: #0B2F75;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-publish:hover {
            background-color: #1a4ba3;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 47, 117, 0.2);
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dde1e3;
            padding: 0.7rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0B2F75;
            box-shadow: 0 0 0 0.2rem rgba(11, 47, 117, 0.25);
        }
        .file-upload {
            border: 2px dashed #0B2F75;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            background-color: rgba(11, 47, 117, 0.05);
        }
        .file-upload:hover {
            border-color: #1a4ba3;
            background-color: rgba(11, 47, 117, 0.1);
        }
        .form-label {
            color: #0B2F75;
            font-weight: 500;
        }
        .input-group-text {
            background-color: #0B2F75;
            color: white;
            border: none;
        }
        /* Ajout d'un style pour les icônes */
        .fas, .far {
            color: #0B2F75;
        }
    </style>
</head>

<body class="bg-light">
<?php
include '../conponents/header.php';
?>

<div class="container form-container">
    <h2 class="form-title text-center">
        <i class="fas fa-project-diagram me-2"></i>
        Ajouter un Projet de Recherche
    </h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Informations de base -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-info-circle me-2"></i>
                Informations Générales
            </h3>
            <div class="mb-3">
                <label for="title" class="form-label">Titre du Projet</label>
                <input type="text" class="form-control" id="title" name="titre" placeholder="Entrez le titre du projet">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">
                        <i class="far fa-calendar-alt me-1"></i>
                        Date de Début
                    </label>
                    <input type="date" class="form-control" name="date_debut" id="start_date">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">
                        <i class="far fa-calendar-alt me-1"></i>
                        Date de Fin
                    </label>
                    <input type="date" class="form-control" name="date_fin" id="end_date">
                </div>
            </div>
        </div>

        <!-- Description et Objectifs -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-tasks me-2"></i>
                Description et Objectifs
            </h3>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Décrivez le projet en détail"></textarea>
            </div>
            <div class="mb-3">
                <label for="objectives" class="form-label">Objectifs</label>
                <textarea class="form-control" id="objectives" name="objectifs" rows="3" placeholder="Listez les objectifs principaux du projet"></textarea>
            </div>
        </div>

        <!-- Informations Financières et Partenariats -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-handshake me-2"></i>
                Finances et Partenariats
            </h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="funding" class="form-label">
                        <i class="fas fa-money-bill-wave me-1"></i>
                        Montant du Financement
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="funding" name="montant_financement" placeholder="Montant">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="partner" class="form-label">
                        <i class="fas fa-users me-1"></i>
                        Partenaires
                    </label>
                    <input type="text" class="form-control" id="partner" name="partenaires" placeholder="Noms des partenaires">
                </div>
            </div>
        </div>

        <!-- État et Domaine -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-chart-line me-2"></i>
                État et Classification
            </h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">État du Projet</label>
                    <select class="form-select" id="status" name="etat">
                        <option value="en cours">En cours</option>
                        <option value="finalisé">Finalisé</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="domain" class="form-label">Domaine</label>
                    <input type="text" class="form-control" id="domain" name="domaines" placeholder="Domaine de recherche">
                </div>
            </div>
        </div>

        <!-- Médias -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-images me-2"></i>
                Médias du Projet
            </h3>
            <div class="mb-3">
                <label for="image" class="form-label">Image Principale</label>
                <div class="file-upload">
                    <i class="fas fa-cloud-upload-alt fs-3 mb-2"></i>
                    <input type="file" class="form-control" id="image" name="image_projet" accept="image/*">
                </div>
            </div>
            <div class="mb-3">
                <label for="photos" class="form-label">Galerie Photos</label>
                <div class="file-upload">
                    <i class="fas fa-images fs-3 mb-2"></i>
                    <input type="file" class="form-control" id="photos" name="photos_projet[]" multiple accept="image/*">
                </div>
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Vidéo du Projet</label>
                <div class="file-upload">
                    <i class="fas fa-video fs-3 mb-2"></i>
                    <input type="file" class="form-control" id="video" name="video_projet" accept="video/*">
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-publish">
                <i class="fas fa-paper-plane me-2"></i>
                Publier le Projet
            </button>
        </div>
    </form>
</div>

<div class="popup-success" id="popup-success">
    <i class="fas fa-check-circle me-2"></i>
    Projet ajouté avec succès ! Vous serez redirigé sous peu...
</div>

<?php include '../conponents/footer.php'; ?>

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