<?php
require_once __DIR__ . "/../../../controller/admin/createAnnonce.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Annonce - INSTI</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(11, 47, 117, 0.8), rgba(11, 47, 117, 0.9)), url('../../../assets/img/bg-hero.jpg');
            background-size: cover;
            background-position: center;
            padding: 60px 0;
            color: white;
            margin-bottom: 3rem;
        }
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }
        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            margin: -100px auto 3rem;
            position: relative;
            z-index: 1;
            max-width: 1200px;
        }
        .form-section {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }
        .form-section-title {
            color: #0B2F75;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        .form-section-title i {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #0B2F75;
            box-shadow: 0 0 0 0.2rem rgba(11, 47, 117, 0.15);
        }
        .form-label {
            color: #495057;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .btn-submit {
            background: linear-gradient(45deg, #0B2F75, #1a4ba3);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 47, 117, 0.3);
            background: linear-gradient(45deg, #1a4ba3, #0B2F75);
        }
        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
            background: #5a6268;
        }
        .required-field::after {
            content: '*';
            color: #dc3545;
            margin-left: 4px;
        }
        .file-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 1rem;
            display: none;
        }
        .tags-input {
            min-height: 100px;
        }
    </style>
</head>
<body class="bg-light">
    <?php include '../conponents/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Créer une Nouvelle Annonce</h1>
            <p class="text-white opacity-75">Partagez les actualités et opportunités avec la communauté INSTI</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Une erreur s'est produite lors de la création de l'annonce. Veuillez réessayer.
                </div>
            <?php endif; ?>

            <form action="../../../controller/admin/createAnnonce.php" method="POST" enctype="multipart/form-data">
                <!-- Informations générales -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        Informations Générales
                    </h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="titre" class="form-label required-field">Titre de l'annonce</label>
                            <input type="text" class="form-control" id="titre" name="titre" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label required-field">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="auteur" class="form-label required-field">Auteur</label>
                            <input type="text" class="form-control" id="auteur" name="auteur" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categorie" class="form-label required-field">Catégorie</label>
                            <select class="form-control" id="categorie" name="categorie" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="evenement">Événement</option>
                                <option value="actualite">Actualité</option>
                                <option value="opportunite">Opportunité</option>
                                <option value="formation">Formation</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Dates et État -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Dates et État
                    </h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="date_publication" class="form-label required-field">Date de publication</label>
                            <input type="datetime-local" class="form-control" id="date_publication" name="date_publication" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_expiration" class="form-label required-field">Date d'expiration</label>
                            <input type="date" class="form-control" id="date_expiration" name="date_expiration" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="etat" class="form-label required-field">État</label>
                            <select class="form-control" id="etat" name="etat" required>
                                <option value="">Sélectionnez un état</option>
                                <option value="actif">Actif</option>
                                <option value="expiré">Expiré</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Fichiers et Médias -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-file-upload"></i>
                        Fichiers et Médias
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image_annonce" class="form-label">Image de l'annonce</label>
                            <input type="file" class="form-control" id="image_annonce" name="image_annonce" accept="image/*">
                            <small class="text-muted">Format recommandé : JPG, PNG. Taille maximale : 5MB</small>
                            <img id="imagePreview" class="file-preview">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fichiers_joint" class="form-label">Fichier joint</label>
                            <input type="file" class="form-control" id="fichiers_joint" name="fichiers_joint">
                            <small class="text-muted">Format accepté : PDF, DOC, DOCX. Taille maximale : 10MB</small>
                        </div>
                    </div>
                </div>

                <!-- Liens et Tags -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-tags"></i>
                        Liens et Tags
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lien_externe" class="form-label">Lien externe</label>
                            <input type="url" class="form-control" id="lien_externe" name="lien_externe" 
                                   placeholder="https://exemple.com">
                            <small class="text-muted">Lien vers plus d'informations (optionnel)</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <textarea class="form-control tags-input" id="tags" name="tags" 
                                      placeholder="Entrez les tags séparés par des virgules"></textarea>
                            <small class="text-muted">Ex: recherche, innovation, technologie</small>
                        </div>
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="showAnnonce.php" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-check me-2"></i>Créer l'annonce
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../conponents/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prévisualisation de l'image
        document.getElementById('image_annonce').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Validation des dates
        document.querySelector('form').addEventListener('submit', function(e) {
            const datePublication = new Date(document.getElementById('date_publication').value);
            const dateExpiration = new Date(document.getElementById('date_expiration').value);
            
            if (dateExpiration < datePublication) {
                e.preventDefault();
                alert('La date d\'expiration doit être postérieure à la date de publication.');
            }
        });
    </script>
</body>
</html>