<?php
require_once __DIR__ . "/../../../include/model/admin.php";

// Vérifier si l'ID est fourni
if (!isset($_GET['id'])) {
    header('Location: showAnnonce.php');
    exit;
}

// Récupérer l'annonce
$annonce = getAnnonceById($_GET['id']);
if (!$annonce) {
    header('Location: showAnnonce.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Annonce - INSTI</title>
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
        }
        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
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
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
        .file-preview {
            max-width: 200px;
            max-height: 200px;
            display: none;
            margin-top: 1rem;
            border-radius: 10px;
            object-fit: cover;
        }
        .btn-submit {
            background: linear-gradient(45deg, #0B2F75, #1a4ba3);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 47, 117, 0.3);
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <?php include '../conponents/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Modifier l'Annonce</h1>
            <p class="text-white opacity-75">Mettez à jour les informations de l'annonce</p>
        </div>
    </section>

    <div class="container">
        <div class="form-container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="../../../controller/admin/updateAnnonce.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_ann" value="<?php echo $annonce['id_ann']; ?>">

                <!-- Informations générales -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        Informations Générales
                    </h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="titre" class="form-label required-field">Titre de l'annonce</label>
                            <input type="text" class="form-control" id="titre" name="titre" required 
                                   value="<?php echo htmlspecialchars($annonce['titre']); ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label required-field">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($annonce['description']); ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="auteur" class="form-label required-field">Auteur</label>
                            <input type="text" class="form-control" id="auteur" name="auteur" required 
                                   value="<?php echo htmlspecialchars($annonce['auteur']); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categorie" class="form-label required-field">Catégorie</label>
                            <select class="form-control" id="categorie" name="categorie" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <?php
                                $categories = ['evenement', 'actualite', 'opportunite', 'formation', 'autre'];
                                foreach ($categories as $cat) {
                                    $selected = ($annonce['categorie'] === $cat) ? 'selected' : '';
                                    echo "<option value=\"$cat\" $selected>" . ucfirst($cat) . "</option>";
                                }
                                ?>
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
                            <input type="datetime-local" class="form-control" id="date_publication" name="date_publication" required
                                   value="<?php echo date('Y-m-d\TH:i', strtotime($annonce['date_publication'])); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_expiration" class="form-label required-field">Date d'expiration</label>
                            <input type="date" class="form-control" id="date_expiration" name="date_expiration" required
                                   value="<?php echo $annonce['date_expiration']; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="etat" class="form-label required-field">État</label>
                            <select class="form-control" id="etat" name="etat" required>
                                <option value="actif" <?php echo $annonce['etat'] === 'actif' ? 'selected' : ''; ?>>Actif</option>
                                <option value="expiré" <?php echo $annonce['etat'] === 'expiré' ? 'selected' : ''; ?>>Expiré</option>
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
                            <?php if ($annonce['image_annonce']): ?>
                                <div class="mt-2">
                                    <img src="../../../<?php echo htmlspecialchars($annonce['image_annonce']); ?>" 
                                         alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fichiers_joint" class="form-label">Fichier joint</label>
                            <input type="file" class="form-control" id="fichiers_joint" name="fichiers_joint">
                            <small class="text-muted">Format accepté : PDF, DOC, DOCX. Taille maximale : 10MB</small>
                            <?php if ($annonce['fichiers_joint']): ?>
                                <div class="mt-2">
                                    <p>Fichier actuel : <?php echo basename($annonce['fichiers_joint']); ?></p>
                                </div>
                            <?php endif; ?>
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
                                   placeholder="https://exemple.com"
                                   value="<?php echo htmlspecialchars($annonce['lien_externe']); ?>">
                            <small class="text-muted">Lien vers plus d'informations (optionnel)</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags" 
                                   placeholder="Séparez les tags par des virgules"
                                   value="<?php echo htmlspecialchars($annonce['tags']); ?>">
                            <small class="text-muted">Ex: important, urgent, formation</small>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../conponents/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prévisualisation de l'image
        document.getElementById('image_annonce').onchange = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.style.display = 'block';
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        };
    </script>
</body>
</html>