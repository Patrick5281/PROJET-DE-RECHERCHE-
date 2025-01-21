<?php
require_once __DIR__ . "/../../../controller/admin/editProjet.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Projet - INSTI</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
        }
        .form-title {
            color: #0B2F75;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0.75rem;
        }
        .form-control:focus {
            border-color: #0B2F75;
            box-shadow: 0 0 0 0.2rem rgba(11, 47, 117, 0.25);
        }
        .form-label {
            color: #495057;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .btn-submit {
            background-color: #0B2F75;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #1a4ba3;
            transform: translateY(-2px);
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 1rem;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="bg-light">
    <?php include '../conponents/header.php'; ?>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Modifier le Projet</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    Une erreur s'est produite lors de la mise à jour du projet.
                </div>
            <?php endif; ?>

            <form action="../../../controller/admin/updateProject.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($projet['id']); ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="titre" class="form-label">Titre du projet</label>
                        <input type="text" class="form-control" id="titre" name="titre" 
                               value="<?php echo htmlspecialchars($projet['titre']); ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="etat" class="form-label">État du projet</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="en cours" <?php echo $projet['etat'] === 'en cours' ? 'selected' : ''; ?>>En cours</option>
                            <option value="terminé" <?php echo $projet['etat'] === 'terminé' ? 'selected' : ''; ?>>Terminé</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" 
                               value="<?php echo htmlspecialchars($projet['date_debut']); ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" 
                               value="<?php echo htmlspecialchars($projet['date_fin']); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($projet['description']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="objectifs" class="form-label">Objectifs</label>
                    <textarea class="form-control" id="objectifs" name="objectifs" rows="3" required><?php echo htmlspecialchars($projet['objectifs']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="montant_financement" class="form-label">Montant du financement</label>
                        <input type="number" class="form-control" id="montant_financement" name="montant_financement" 
                               value="<?php echo htmlspecialchars($projet['montant_financement']); ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="partenaires" class="form-label">Partenaires</label>
                        <input type="text" class="form-control" id="partenaires" name="partenaires" 
                               value="<?php echo htmlspecialchars($projet['partenaires']); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="domaines" class="form-label">Domaines</label>
                    <input type="text" class="form-control" id="domaines" name="domaines" 
                           value="<?php echo htmlspecialchars($projet['domaines']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image_projet" class="form-label">Image du projet</label>
                        <input type="file" class="form-control" id="image_projet" name="image_projet" accept="image/*">
                        <?php if (!empty($projet['image_projet'])): ?>
                            <img src="../../../<?php echo htmlspecialchars($projet['image_projet']); ?>" 
                                 alt="Image actuelle" class="preview-image">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="video_projet" class="form-label">Vidéo du projet</label>
                        <input type="file" class="form-control" id="video_projet" name="video_projet" accept="video/*">
                        <?php if (!empty($projet['video_projet'])): ?>
                            <div class="mt-2">
                                <video width="200" controls>
                                    <source src="../../../<?php echo htmlspecialchars($projet['video_projet']); ?>" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="showProjetAd.php" class="btn btn-cancel">Annuler</a>
                    <button type="submit" class="btn btn-submit">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../conponents/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Prévisualisation de l'image
        document.getElementById('image_projet').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('.preview-image') || document.createElement('img');
                    preview.src = e.target.result;
                    preview.classList.add('preview-image');
                    if (!document.querySelector('.preview-image')) {
                        document.getElementById('image_projet').parentNode.appendChild(preview);
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</body>
</html>
