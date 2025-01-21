<?php
session_start();
require_once '../../model/admin.php';
$annonces = showAnnonce();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Annonces - INSTI</title>
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
        .table th {
            background-color: #f8f9fa;
            color: #0B2F75;
            font-weight: 600;
        }
        .badge-publie {
            background-color: #28a745;
            color: white;
        }
        .badge-brouillon {
            background-color: #6c757d;
            color: white;
        }
        .action-buttons .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        .action-buttons .btn i {
            margin-right: 0.25rem;
        }
    </style>
</head>
<body class="bg-light">
        <!-- Inclure le Header -->
        <?php include 'headerAdmin.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title">Gestion des Annonces</h1>
            <p class="text-white opacity-75">Consultez et gérez toutes les annonces</p>
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
                <h2 class="h4 mb-0">Liste des annonces</h2>
                <a href="createAnnonce.php" class="btn btn-add">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nouvelle annonce
                </a>
            </div>

            <div class="table-responsive">
                <table id="annonceTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date de publication</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($annonces as $annonce): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($annonce['titre']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($annonce['date_pub'])); ?></td>
                                <td><?php echo htmlspecialchars($annonce['categorie']); ?></td>
                                <td>
                                    <span class="badge rounded-pill badge-<?php echo $annonce['statut']; ?>">
                                        <?php echo ucfirst($annonce['statut']); ?>
                                    </span>
                                </td>
                                <td class="action-buttons">
                                    <div class="btn-group" role="group">
                                        <a href="editAnnonce.php?id=<?php echo $annonce['id_an']; ?>" 
                                           class="btn btn-outline-primary btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" 
                                           onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')) window.location.href='../../../controller/admin/deleteAnnonce.php?id=<?php echo $annonce['id_an']; ?>';" 
                                           class="btn btn-outline-danger btn-sm" title="Supprimer">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footerAdmin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#annonceTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                },
                order: [[1, 'desc']], // Trier par date de publication par défaut
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]]
            });
        });
    </script>
</body>
</html>