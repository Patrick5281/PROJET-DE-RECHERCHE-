<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces - INSTI</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(11, 47, 117, 0.8), rgba(11, 47, 117, 0.9)), url('../../../assets/img/bg-hero.jpg');
            background-size: cover;
            background-position: center;
            padding: 40px 0;
            color: white;
        }
        .search-box {
            max-width: 600px;
            margin: 2rem auto;
        }
        .search-input {
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        .search-input:focus {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }
        .section-title {
            color: #0B2F75;
            font-weight: 700;
            margin: 3rem 0 2rem;
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #0B2F75;
            border-radius: 2px;
        }
        .annonce-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        .annonce-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .annonce-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .annonce-content {
            padding: 1.5rem;
        }
        .annonce-title {
            color: #0B2F75;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        .annonce-text {
            color: #6c757d;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .annonce-meta {
            color: #adb5bd;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-voir-plus {
            background: linear-gradient(45deg, #0B2F75, #1a4ba3);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.9rem;
        }
        .btn-voir-plus:hover {
            background: linear-gradient(45deg, #1a4ba3, #0B2F75);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 5px 15px rgba(11, 47, 117, 0.2);
        }
        .btn-plus-annonces {
            background: white;
            color: #0B2F75;
            border: 2px solid #0B2F75;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 2rem auto;
            display: block;
            max-width: 300px;
            text-align: center;
            text-decoration: none;
        }
        .btn-plus-annonces:hover {
            background: #0B2F75;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 47, 117, 0.2);
        }
        .categorie-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #0B2F75;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">
    <?php 
    require_once __DIR__ . "/../../../include/model/admin.php";

    // Récupérer toutes les annonces
    $annonces = getAnnonces();

    // Séparer les annonces en deux catégories
    $nouvelles_annonces = array_filter($annonces, function($annonce) {
        return strtotime($annonce['date_creation']) > strtotime('-7 days');
    });

    $annonces_recentes = array_filter($annonces, function($annonce) {
        return strtotime($annonce['date_creation']) <= strtotime('-7 days');
    });
    ?>
    <?php include '../conponents/header.php'; ?>

    <!-- Hero Section avec Recherche -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Quoi de nouveau aujourd'hui ?</h1>
            <p class="lead mb-4">Restez informé de nos actualités</p>
            <div class="search-box">
                <input type="text" class="form-control search-input" placeholder="Rechercher une annonce...">
            </div>
        </div>
    </section>

    <!-- Contenu Principal -->
    <div class="container py-5">
        <!-- Nouvelles annonces -->
        <h2 class="section-title">Nouvelles annonces</h2>
        <div class="row">
            <?php foreach ($nouvelles_annonces as $annonce): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="annonce-card">
                        <div class="position-relative">
                            <img src="../../../<?php echo htmlspecialchars($annonce['image_annonce'] ?? 'assets/img/default-annonce.jpg'); ?>" 
                                 alt="<?php echo htmlspecialchars($annonce['titre']); ?>" 
                                 class="annonce-image">
                            <span class="categorie-badge">
                                <?php echo htmlspecialchars(ucfirst($annonce['categorie'])); ?>
                            </span>
                        </div>
                        <div class="annonce-content">
                            <h3 class="annonce-title"><?php echo htmlspecialchars($annonce['titre']); ?></h3>
                            <p class="annonce-text"><?php echo htmlspecialchars($annonce['description']); ?></p>
                            <div class="annonce-meta mb-3">
                                <span>
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <?php echo date('d/m/Y', strtotime($annonce['date_publication'])); ?>
                                </span>
                                <span>
                                    <i class="far fa-eye me-2"></i>
                                    <?php echo $annonce['nombre_vue']; ?> vues
                                </span>
                            </div>
                            <a href="detailAnnonce.php?id=<?php echo $annonce['id_ann']; ?>" class="btn btn-voir-plus">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Annonces récentes -->
        <h2 class="section-title">Annonces récentes</h2>
        <div class="row">
            <?php foreach ($annonces_recentes as $annonce): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="annonce-card">
                        <div class="position-relative">
                            <img src="../../../<?php echo htmlspecialchars($annonce['image_annonce'] ?? 'assets/img/default-annonce.jpg'); ?>" 
                                 alt="<?php echo htmlspecialchars($annonce['titre']); ?>" 
                                 class="annonce-image">
                            <span class="categorie-badge">
                                <?php echo htmlspecialchars(ucfirst($annonce['categorie'])); ?>
                            </span>
                        </div>
                        <div class="annonce-content">
                            <h3 class="annonce-title"><?php echo htmlspecialchars($annonce['titre']); ?></h3>
                            <p class="annonce-text"><?php echo htmlspecialchars($annonce['description']); ?></p>
                            <div class="annonce-meta mb-3">
                                <span>
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <?php echo date('d/m/Y', strtotime($annonce['date_publication'])); ?>
                                </span>
                                <span>
                                    <i class="far fa-eye me-2"></i>
                                    <?php echo $annonce['nombre_vue']; ?> vues
                                </span>
                            </div>
                            <a href="detailAnnonce.php?id=<?php echo $annonce['id_ann']; ?>" class="btn btn-voir-plus">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Bouton Voir plus d'annonces -->
        <a href="#" class="btn-plus-annonces">
            <i class="fas fa-plus-circle me-2"></i>
            Voir plus d'annonces
        </a>
    </div>

    <?php include '../conponents/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction de recherche
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.annonce-card');
            
            cards.forEach(card => {
                const title = card.querySelector('.annonce-title').textContent.toLowerCase();
                const description = card.querySelector('.annonce-text').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>