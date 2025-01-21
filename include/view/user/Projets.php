<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets de Recherche - INSTI</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(11, 47, 117, 0.8), rgba(11, 47, 117, 0.9)), url('../../../assets/img/bg-hero.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            margin-bottom: 3rem;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }
        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .project-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            border: none;
        }
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(11, 47, 117, 0.2);
        }
        .project-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .project-content {
            padding: 1.5rem;
        }
        .project-title {
            color: #0B2F75;
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .project-info {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        .project-description {
            color: #495057;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .btn-view {
            background-color: #0B2F75;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        .btn-view:hover {
            background-color: #1a4ba3;
            color: white;
            transform: translateY(-2px);
        }
        .status-badge {
            position: absolute;
            top: auto;
            bottom: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .status-en-cours {
            background-color: rgba(11, 47, 117, 0.1);
            color: #0B2F75;
        }
        .status-finalise {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        .project-meta {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
        }
        .meta-item {
            display: flex;
            align-items: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .meta-item i {
            margin-right: 0.5rem;
            color: #0B2F75;
        }
        .filters {
            background-color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .filter-button {
            background-color: white;
            border: 1px solid #0B2F75;
            color: #0B2F75;
            margin: 0.25rem;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .filter-button:hover, .filter-button.active {
            background-color: #0B2F75;
            color: white;
        }
    </style>
</head>

<body class="bg-light">
    <?php include '../conponents/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Les Projets de l'INSTI</h1>
            <p class="hero-subtitle">Découvrez nos projets de recherche innovants</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Filters -->
        <div class="filters mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <button class="btn filter-button active">Tous</button>
                    <button class="btn filter-button">En cours</button>
                    <button class="btn filter-button">Finalisés</button>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="row">
            <?php foreach ($auteurs as $projet): ?>
            <div class="col-md-6 col-lg-4">
                <div class="project-card">
                    <div class="position-relative">
                        <?php if (!empty($projet['image_projet'])): ?>
                            <img src="../../../<?php echo htmlspecialchars($projet['image_projet']); ?>" class="project-image" alt="<?php echo htmlspecialchars($projet['titre']); ?>">
                        <?php else: ?>
                            <img src="../../../assets/img/default-project.jpg" class="project-image" alt="Image par défaut">
                        <?php endif; ?>
                        <span class="status-badge <?php echo $projet['etat'] === 'en cours' ? 'status-en-cours' : 'status-finalise'; ?>">
                            <?php echo htmlspecialchars(ucfirst($projet['etat'])); ?>
                        </span>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title"><?php echo htmlspecialchars($projet['titre']); ?></h3>
                        <p class="project-description"><?php echo htmlspecialchars($projet['description']); ?></p>
                        <div class="project-info">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Du <?php echo date('d/m/Y', strtotime($projet['date_debut'])); ?> 
                            au <?php echo date('d/m/Y', strtotime($projet['date_fin'])); ?>
                        </div>
                    </div>
                    <div class="project-meta">
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <?php echo htmlspecialchars($projet['partenaires']); ?>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-folder"></i>
                            <?php echo htmlspecialchars($projet['domaines']); ?>
                        </div>
                    </div>
                    <div class="p-3 text-center">
                        <a href="viewProjet.php?id=<?php echo $projet['id']; ?>" class="btn btn-view">
                            <i class="fas fa-eye me-2"></i>Voir le projet
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include '../conponents/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation des cartes au scroll
        function revealCards() {
            const cards = document.querySelectorAll('.project-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }

        // Filtres
        document.querySelectorAll('.filter-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            revealCards();
        });
    </script>
</body>
</html>