<?php
require_once __DIR__ . "/../../../controller/auteur/showAuteur.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présentation des Projets</title>
    <link href="../../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .project-card {
            position: relative;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .project-card:hover {
            transform: translateY(-5px);
        }
        .project-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .project-card .card-body {
            padding: 15px;
        }
        .project-card h5 {
            font-weight: bold;
        }
        .btn-group {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        .btn-group button {
            background-color: #fff;
            border: none;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-group button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-group button i {
            font-size: 16px;
            color: #333;
        }
        .banner-carousel {
    position: relative;
    width: 100%;
    height: 600px; /* Hauteur fixe pour le carrousel */
    overflow: hidden;
  }
  
  .carousel {
    position: relative;
    width: 100%;
    height: 100%;
  }
  
  .carousel-slide {
    display: none; /* Cacher les slides par défaut */
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
  }
  
  .carousel-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .carousel-slide.active {
    display: block; /* Afficher uniquement la slide active */
  }
  
 
  /* Contenu du texte de la bannière */
.banner-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fond sombre semi-transparent */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  
  .banner-content h1 {
    color: white;
    font-size: 36px;
    font-weight: bold;
    line-height: 1.5;
    margin: 0;
    padding: 0 10%; /* Ajout d'un padding pour forcer le texte à prendre plus de lignes */
  max-width: 80%; /* Limite la largeur du texte pour qu'il s'étale davantage */
}
  
  
  /* Boutons de contrôle du carrousel */
  .carousel-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    font-size: 24px;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    z-index: 10;
  }
  
  .carousel-control.prev {
    left: 20px;
  }
  
  .carousel-control.next {
    right: 20px;
  }
  
  .carousel-control:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }

.project-image {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    width: 100%; /* S'assure que l'image prend la largeur du conteneur */
    height: auto; /* Garde les proportions de l'image */
}

.image-link {
    display: block; /* Rend l'image cliquable sur toute sa surface */
    text-decoration: none; /* Supprime les bordures ou soulignements */
}

.project-card {
    margin-bottom: 20px; /* Espace entre les cartes */
}

    </style>
</head>
<body>

<!-- Header -->
<header class="d-flex align-items-center text-white py-2">
    <!-- Logo de gauche -->
    <div class="logo-container1 d-flex align-items-center justify-content-center bg-white me-3"
        style="height: 73px; width: 73px;">
        <img src="/../../../assets/icons/0 2.png" alt="Logo gauche" class="img-fluid">
    </div>

    <!-- Texte principal -->
    <div class="text-container flex-grow-1">
        <h1 class="m-0 fw-bold">INSTI</h1>
        <p class="m-0">Institut Nationale Supérieur de Technologie Industrielle <br /> de Lokossa</p>
    </div>

    <!-- Liens à droite -->
    <div class="links d-flex align-items-center">
        <a href="#" class="text-white d-flex align-items-center me-3">
            <img src="/../../../assets/icons/info-circle-fill.svg" alt="Info" class="icon-white me-1" style="width: 20px; height: 20px;" class="me-1"> Accès rapide
        </a>
        <span class="text-white">|</span>
        <a href="#" class="text-white d-flex align-items-center mx-3">
            <img src="/../../../assets/icons/snow3.svg" alt="Observatoire" class="icon-white me-1" style="width: 20px; height: 20px;" class="me-1"> Observatoire
        </a>
        <span class="text-white">|</span>
        <a href="#" class="text-white d-flex align-items-center ms-3">
            <img src="/../../../assets/icons/person-fill.svg" alt="Person" class="icon-white me-1" style="width: 20px; height: 20px;" class="me-1"> Nous écrire
        </a>
    </div>

    <!-- Logo de droite -->
    <div class="logo-container1 d-flex align-items-center justify-content-center bg-white ms-3"
        style="height: 73px; width: 73px;">
        <img src="/../../../assets/icons/logoINSTI 1.png" alt="Logo droite" class="img-fluid">
    </div>
</header>

<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
        <!-- Bouton de menu (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu principal -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="../../../index.php">ACCEUIL</a></li>
                <li class="nav-item"><a class="nav-link" href="show.php">PROJETS</a></li>
                <li class="nav-item"><a class="nav-link" href="create.php">AJOUTER UN PROJET</a></li>
                <!-- Logo central -->
                <li class="nav-item logo-container">
                    <a href="#">
                        <img src="/../../../assets/icons/h pe.png" alt="Logo entreprise" class="img-fluid logo">
                    </a>
                </li>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">GALERIES</a></li>
                <li class="nav-item"><a class="nav-link" href="#">PARTENAIRES</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CONTACTS</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bannière Carrousel -->
<section class="banner-carousel">
  <div class="carousel">
    <!-- Slide 1 -->
    <div class="carousel-slide active">
      <img src="../../../assets/images/i01.jpg" alt="Banner 1">
      <div class="banner-content">
        <h1>Découvrez comment l'INSTI prépare la nouvelle génération d’entrepreneurs 
          grâce à une formation pratique, axée sur les compétences et l'innovation.</h1>
      </div>
    </div>
    <!-- Slide 2 -->
    <div class="carousel-slide">
      <img src="../../../assets/images/i1.jpg" alt="Banner 2">
      <div class="banner-content">
        <h1>Une éducation axée sur l'innovation.</h1>
      </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-slide">
      <img src="../../../assets/images/i2.jpg" alt="Banner 3">
      <div class="banner-content">
        <h1>Rejoignez-nous pour transformer des idées en réalité.</h1>
      </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-slide">
      <img src="../../../assets/images/i3.jpg" alt="Banner 3">
      <div class="banner-content">
        <h1>Rejoignez-nous pour transformer des idées en réalité.</h1>
      </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-slide">
      <img src="../../../assets/images/i4.jpg" alt="Banner 3">
      <div class="banner-content">
        <h1>Rejoignez-nous pour transformer des idées en réalité.</h1>
      </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-slide">
      <img src="../../../assets/images/i5.jpg" alt="Banner 3">
      <div class="banner-content">
        <h1>Rejoignez-nous pour transformer des idées en réalité.</h1>
      </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-slide">
      <img src="../../../assets/images/i6.jpg" alt="Banner 3">
      <div class="banner-content">
        <h1>Rejoignez-nous pour transformer des idées en réalité.</h1>
      </div>
    </div>
    <!-- Contrôles -->
    <button class="carousel-control prev">&#10094;</button>
    <button class="carousel-control next">&#10095;</button>
  </div>
</section>

<!-- Project Grid -->
<section>
      <!-- Modal de confirmation de suppression -->
<div class="container mt-4">
<div class="row">
    <?php
    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'projets_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, titre, description, date_soumission, images_projet FROM projets";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $description_courte = substr($row['description'], 0, 100) . '...';
            ?>
            <div class="col-md-4 mb-4">
                <div class="project-card">
                    <!-- Boutons d'édition et suppression -->
                    <div class="btn-group">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm" title="Modifier">
                            <i class="bi bi-pencil">modifier</i>
                        </a>
                        <button 
                            class="btn btn-sm btn-danger" 
                            title="Supprimer" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal" 
                            data-id="<?php echo $row['id']; ?>" 
                            data-title="<?php echo $row['titre']; ?>">
                            <i class="bi bi-trash">Supprimer</i>
                        </button>
                    </div>

                    <!-- Image cliquable -->
                    <a href="project_details.php?id=<?php echo $row['id']; ?>" class="image-link">
                        <img 
                            src="../../../uploads/<?php echo $row['images_projet']; ?>" 
                            alt="Project Image" 
                            class="project-image">
                    </a>

                    <!-- Corps de la carte -->
                    <div class="card-body">
                        <h5>
                            <a href="project_details.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                                <?php echo $row['titre']; ?>
                            </a>
                        </h5>
                        <p><?php echo $description_courte; ?></p>
                        <small class="text-muted">
                            Publié le: <?php echo $row['date_soumission']; ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p class='text-center'>Aucun projet disponible pour le moment.</p>";
    }

    $conn->close();
    ?>
</div>


</div>
</section>

<!-- Modal de confirmation de suppression -->
<section>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer le projet <strong id="projectTitle"></strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="#" id="confirmDelete" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Footer -->
<footer class="py-4">
    <div class="container">
      <div class="row">
        <!-- Logo et Informations -->
        <div class="col-md-4">
          <img src="/../../../assets/icons/logoINSTI 1.png" alt="Logo" class="mb-3" style="width: 80px;"> 
          <p class="mb-0">Lokossa, Agnivedji</p>
          <p><strong>(+229) 22 41 13 66</strong></p>
          <p>"Science et technologie au service de l'homme"</p>
          <a href="mailto:instilokossa@gmail.com" class="text-white"><strong>instilokossa@gmail.com</strong></a>
          <div class="mt-3">
            <!-- Icône Facebook -->
            <a href="https://facebook.com" target="_blank" class="text-white me-3">
              <img src="/../../../assets/icons/facebook.svg" alt="Facebook" class="icon-white me-1" style="width: 40px; height: 40px;">
            </a>
            <!-- Icône YouTube -->
            <a href="https://youtube.com" target="_blank" class="text-white me-3">
              <img src="/../../../assets/icons/youtube.svg" alt="YouTube" class="icon-white me-1" style="width: 40px; height: 40px;">
            </a>
          </div>
          <div class="underline mt-2"></div>
        </div>
  
        <!-- Nos Ressources -->
        <div class="col-md-4">
          <h5>NOS RESSOURCES</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none">Incubateur de startups</a></li>
            <li><a href="#" class="text-white text-decoration-none">Unité d'application de l'INSTI</a></li>
            <li><a href="#" class="text-white text-decoration-none">Plateforme E-learning</a></li>
            <li><a href="#" class="text-white text-decoration-none">Blog officiel de l'INSTI</a></li>
          </ul>
        </div>
  
        <!-- Liens Utiles -->
        <div class="col-md-4">
          <h5>LIENS UTILES</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none">Ministère de l'Enseignement Supérieur et de la Recherche Scientifique</a></li>
            <li><a href="#" class="text-white text-decoration-none">Université Nationale des Sciences, Technologies, Ingénierie et Mathématiques</a></li>
            <li><a href="#" class="text-white text-decoration-none">Institut National Supérieur de Technologie Industrielle</a></li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-4">
        <p class="mb-0">© INSTI, UNSTIM 2024 - Réalisé par le groupe (OLOUKPEDE, BOSSA, TANGNI, GBECHI, ADE)</p>
      </div>
    </div>
  </footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var projectId = button.getAttribute('data-id');
        var projectTitle = button.getAttribute('data-title');
        
        var modalTitle = deleteModal.querySelector('.modal-title');
        var modalBody = deleteModal.querySelector('.modal-body #projectTitle');
        var confirmDelete = deleteModal.querySelector('.modal-footer #confirmDelete');

        modalBody.textContent = projectTitle;
        confirmDelete.href = '../../../controller/auteur/deleteAuteur.php?id=' + projectId;
    });
});

// Sélection des éléments nécessaires
const slides = document.querySelectorAll('.carousel-slide'); // Toutes les slides
const prevButton = document.querySelector('.carousel-control.prev'); // Bouton précédent
const nextButton = document.querySelector('.carousel-control.next'); // Bouton suivant
let currentIndex = 0; // Index de la slide actuellement visible

// Fonction pour afficher une slide donnée
function showSlide(index) {
  // Assurez-vous que l'index reste dans les limites
  if (index < 0) {
    index = slides.length - 1; // Retourne à la dernière slide
  } else if (index >= slides.length) {
    index = 0; // Retourne à la première slide
  }

  // Retirer la classe 'active' de toutes les slides
  slides.forEach(slide => {
    slide.classList.remove('active');
  });

  // Ajouter la classe 'active' à la slide courante
  slides[index].classList.add('active');

  // Met à jour l'index courant
  currentIndex = index;
}

// Ajouter les événements pour les boutons de navigation
prevButton.addEventListener('click', () => {
  showSlide(currentIndex - 1); // Afficher la slide précédente
});

nextButton.addEventListener('click', () => {
  showSlide(currentIndex + 1); // Afficher la slide suivante
});

// Navigation automatique (optionnel)
let autoPlayInterval = setInterval(() => {
  showSlide(currentIndex + 1); // Passer à la slide suivante
}, 3000); // Toutes les 3 secondes

// Stopper la navigation automatique lors de l'interaction de l'utilisateur
[prevButton, nextButton].forEach(button => {
  button.addEventListener('click', () => {
    clearInterval(autoPlayInterval); // Arrêter le défilement automatique
  });
});

// Afficher la première slide par défaut
showSlide(currentIndex);

</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
