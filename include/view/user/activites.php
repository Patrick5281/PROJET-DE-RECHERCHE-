<?php
require_once __DIR__ . "/../../../controller/user/activites.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activités - INSTI</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .activities-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        .page-title {
            font-size: 3rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #0B2F75;
            text-align: center;
            margin-bottom: 3rem;
            letter-spacing: 2px;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0B2F75;
            margin-bottom: 2rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #0B2F75;
        }
        .activity-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            transition: transform 0.3s ease;
        }
        .activity-item:hover {
            transform: translateY(-5px);
        }
        .activity-letter {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }
        .letter-a { background: #1565C0; }
        .letter-vc { background: #43A047; }
        .letter-c { background: #6A1B9A; }
        .letter-h { background: #00695C; }
        .activity-content {
            padding: 1.5rem;
            flex-grow: 1;
        }
        .activity-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0B2F75;
            margin-bottom: 0.5rem;
        }
        .activity-meta {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        .activity-meta i {
            margin-right: 0.5rem;
            color: #0B2F75;
        }
        .activity-description {
            color: #495057;
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        .btn-more {
            color: #0B2F75;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        .btn-more i {
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }
        .btn-more:hover i {
            transform: translateX(5px);
        }
        .activity-image {
            width: 200px;
            height: 100%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .view-more-container {
            text-align: center;
            margin-top: 3rem;
        }
        .btn-view-more {
            background: #0B2F75;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        .btn-view-more:hover {
            background: #1a4ba3;
            color: white;
            transform: translateY(-2px);
        }
        .btn-view-more i {
            margin-left: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    <?php include '../conponents/header.php'; ?>

    <div class="activities-container">
        <h1 class="page-title">Activités</h1>

        <!-- Activités en cours -->
        <div class="current-activities">
            <h2 class="section-title">Activités en cours</h2>
            
            <?php foreach ($activites as $activite): 
                if (strtotime($activite['date_fin']) >= time()): 
                    $letter = strtoupper(substr($activite['type_activite'], 0, 1));
                    $letterClass = 'letter-' . strtolower($letter);
            ?>
            <div class="activity-item">
                <div class="activity-letter <?php echo $letterClass; ?>">
                    <?php echo $letter; ?>
                </div>
                <?php if (!empty($activite['image_activite'])): ?>
                <img src="../../../<?php echo htmlspecialchars($activite['image_activite']); ?>" 
                     alt="<?php echo htmlspecialchars($activite['titre']); ?>" 
                     class="activity-image">
                <?php endif; ?>
                <div class="activity-content">
                    <h3 class="activity-title"><?php echo htmlspecialchars($activite['titre']); ?></h3>
                    <div class="activity-meta">
                        <p><i class="fas fa-calendar-alt"></i> Du <?php echo date('d/m/Y H:i', strtotime($activite['date_debut'])); ?> 
                           au <?php echo date('d/m/Y H:i', strtotime($activite['date_fin'])); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($activite['lieu']); ?></p>
                        <p><i class="fas fa-users"></i> <?php echo htmlspecialchars($activite['organisateurs']); ?></p>
                    </div>
                    <p class="activity-description"><?php echo htmlspecialchars(substr($activite['description'], 0, 150)) . '...'; ?></p>
                    <a href="#" class="btn-more">Voir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endif; endforeach; ?>
        </div>

        <!-- Activités passées -->
        <div class="past-activities">
            <h2 class="section-title">Activités passées</h2>
            
            <?php foreach ($activites as $activite): 
                if (strtotime($activite['date_fin']) < time()): 
                    $letter = strtoupper(substr($activite['type_activite'], 0, 1));
                    $letterClass = 'letter-' . strtolower($letter);
            ?>
            <div class="activity-item">
                <div class="activity-letter <?php echo $letterClass; ?>">
                    <?php echo $letter; ?>
                </div>
                <?php if (!empty($activite['image_activite'])): ?>
                <img src="../../../<?php echo htmlspecialchars($activite['image_activite']); ?>" 
                     alt="<?php echo htmlspecialchars($activite['titre']); ?>" 
                     class="activity-image">
                <?php endif; ?>
                <div class="activity-content">
                    <h3 class="activity-title"><?php echo htmlspecialchars($activite['titre']); ?></h3>
                    <div class="activity-meta">
                        <p><i class="fas fa-calendar-alt"></i> Du <?php echo date('d/m/Y H:i', strtotime($activite['date_debut'])); ?> 
                           au <?php echo date('d/m/Y H:i', strtotime($activite['date_fin'])); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($activite['lieu']); ?></p>
                        <p><i class="fas fa-users"></i> <?php echo htmlspecialchars($activite['organisateurs']); ?></p>
                    </div>
                    <p class="activity-description"><?php echo htmlspecialchars(substr($activite['description'], 0, 150)) . '...'; ?></p>
                    <a href="#" class="btn-more">Voir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php endif; endforeach; ?>
        </div>

        <div class="view-more-container">
            <a href="#" class="btn-view-more">
                Voir plus d'activités <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    <?php include '../conponents/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>