<?php
session_start();
require_once '../../model/admin.php';
try {
    $projets = showProjet();
} catch (Exception $e) {
    $_SESSION['error'] = "Erreur lors de la récupération des projets : " . $e->getMessage();
    $projets = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets - INSTI</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
        .content-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: -100px auto 3rem;
            position: relative;
            z-index: 1;
        }
        .project-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .project-card:hover {
            transform: translateY(-5px);
        }
        .project-image {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .project-card .card-body {
            padding: 1.5rem;
        }
        .project-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .project-description {
            height: 4.5em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .badge-en_cours {
            background-color: #28a745;
            color: white;
        }
        .badge-termine {
            background-color: #6c757d;
            color: white;
        }
        .badge-planifie {
            background-color: #ffc107;
            color: #000;
        }
        .btn-add {
            background: linear-gradient(45deg, #0B2F75, #1a4ba3);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 47, 117, 0.3);
            color: white;
        }
        .action-buttons .btn {
            padding: 0.5rem;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 2px;
        }
        .project-info {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0,0,0,0.1);
        }
        .project-partners, .project-domains {
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <?php include 'headerAdmin.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Gestion des Projets de Recherche</h1>
            <p class="text-white opacity-75">Consultez et gérez tous les projets de recherche de l'INSTI</p>
        </div>
    </section>

    <div class="container">
        <div class="content-container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">Liste des projets</h2>
                <a href="createProjet.php" class="btn btn-add">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nouveau projet
                </a>
            </div>

            <div class="row g-4">
                <?php if (empty($projets)): ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Aucun projet n'a été trouvé.
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($projets as $projet): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card project-card">
                                <?php if (!empty($projet['image_projet'])): ?>
                                    <img src="<?php echo '../../../' . htmlspecialchars($projet['image_projet']); ?>" 
                                         class="project-image" 
                                         alt="<?php echo htmlspecialchars($projet['titre']); ?>">
                                <?php endif; ?>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0"><?php echo htmlspecialchars($projet['titre']); ?></h5>
                                        <span class="badge rounded-pill badge-<?php echo $projet['etat']; ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $projet['etat'])); ?>
                                        </span>
                                    </div>
                                    
                                    <p class="project-meta mb-2">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Du <?php echo date('d/m/Y', strtotime($projet['date_debut'])); ?>
                                        au <?php echo date('d/m/Y', strtotime($projet['date_fin'])); ?>
                                    </p>
                                    
                                    <p class="project-description mb-3">
                                        <?php echo htmlspecialchars($projet['description']); ?>
                                    </p>

                                    <div class="project-info">
                                        <?php if (!empty($projet['domaines'])): ?>
                                            <div class="project-domains">
                                                <i class="fas fa-tags me-1"></i>
                                                <?php echo htmlspecialchars($projet['domaines']); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($projet['partenaires'])): ?>
                                            <div class="project-partners">
                                                <i class="fas fa-handshake me-1"></i>
                                                <?php echo htmlspecialchars($projet['partenaires']); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($projet['montant_financement'])): ?>
                                            <div class="project-funding mt-2">
                                                <i class="fas fa-money-bill-wave me-1"></i>
                                                Financement: <?php echo number_format($projet['montant_financement'], 0, ',', ' '); ?> FCFA
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="action-buttons text-center mt-3">
                                        <a href="editProjet.php?id=<?php echo $projet['id']; ?>" 
                                           class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if (!empty($projet['video_projet'])): ?>
                                            <a href="<?php echo '../../../' . htmlspecialchars($projet['video_projet']); ?>" 
                                               class="btn btn-outline-info" 
                                               target="_blank" 
                                               title="Voir la vidéo">
                                                <i class="fas fa-video"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a href="javascript:void(0);" 
                                           onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) window.location.href='../../../controller/admin/deleteProjet.php?id=<?php echo $projet['id']; ?>';" 
                                           class="btn btn-outline-danger" 
                                           title="Supprimer">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footerAdmin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Animation des cartes au chargement
            $('.project-card').each(function(index) {
                $(this).delay(100 * index).animate({opacity: 1}, 500);
            });
        });
    </script>
</body>
</html>
