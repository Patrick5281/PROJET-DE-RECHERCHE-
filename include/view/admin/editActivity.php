<?php
require_once __DIR__ . "/../../../include/model/admin.php";

// Vérifier si l'ID est fourni
if (!isset($_GET['id'])) {
    header('Location: showActivity.php');
    exit;
}

// Récupérer l'activité
$activite = getActiviteById($_GET['id']);
if (!$activite) {
    header('Location: showActivity.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Activité - INSTI</title>
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
            <h1 class="hero-title">Modifier l'Activité</h1>
            <p class="text-white opacity-75">Mettez à jour les informations de l'activité</p>
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

            <form action="../../../controller/admin/updateActivite.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_act" value="<?php echo $activite['id_act']; ?>">

                <!-- Informations générales -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        Informations Générales
                    </h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="titre" class="form-label required-field">Titre de l'activité</label>
                            <input type="text" class="form-control" id="titre" name="titre" required 
                                   value="<?php echo htmlspecialchars($activite['titre']); ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label required-field">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($activite['description']); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Date et Lieu -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Date et Lieu
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_debut" class="form-label required-field">Date de début</label>
                            <input type="datetime-local" class="form-control" id="date_debut" name="date_debut" required
                                   value="<?php echo date('Y-m-d\TH:i', strtotime($activite['date_debut'])); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lieu" class="form-label required-field">Lieu</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" required
                                   value="<?php echo htmlspecialchars($activite['lieu']); ?>">
                        </div>
                    </div>
                </div>

                <!-- Type et Statut -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-tag"></i>
                        Type et Statut
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label required-field">Type d'activité</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Sélectionnez un type</option>
                                <?php
                                $types = ['conference', 'atelier', 'seminaire', 'formation', 'autre'];
                                foreach ($types as $type) {
                                    $selected = ($activite['type'] === $type) ? 'selected' : '';
                                    echo "<option value=\"$type\" $selected>" . ucfirst($type) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="statut" class="form-label required-field">Statut</label>
                            <select class="form-control" id="statut" name="statut" required>
                                <option value="planifié" <?php echo $activite['statut'] === 'planifié' ? 'selected' : ''; ?>>Planifié</option>
                                <option value="en_cours" <?php echo $activite['statut'] === 'en_cours' ? 'selected' : ''; ?>>En cours</option>
                                <option value="terminé" <?php echo $activite['statut'] === 'terminé' ? 'selected' : ''; ?>>Terminé</option>
                                <option value="annulé" <?php echo $activite['statut'] === 'annulé' ? 'selected' : ''; ?>>Annulé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Image et Lien -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-image"></i>
                        Image et Lien
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image de l'activité</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="text-muted">Format recommandé : JPG, PNG. Taille maximale : 5MB</small>
                            <?php if ($activite['image']): ?>
                                <div class="mt-2">
                                    <img src="../../../<?php echo htmlspecialchars($activite['image']); ?>" 
                                         alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lien_externe" class="form-label">Lien externe</label>
                            <input type="url" class="form-control" id="lien_externe" name="lien_externe" 
                                   placeholder="https://exemple.com"
                                   value="<?php echo htmlspecialchars($activite['lien_externe']); ?>">
                            <small class="text-muted">Lien vers plus d'informations (optionnel)</small>
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
        document.getElementById('image').onchange = function(e) {
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