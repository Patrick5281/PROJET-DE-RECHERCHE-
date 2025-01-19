<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Projet</title>
    <link href="../../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/style.css" rel="stylesheet">
 
</head>
<body>
<?php
// Inclure le header
include '../conponents/header.php';
?>
<!-- Début section image de présentation du projet -->
<section class="presentation-section">
    <!-- Image du projet -->
    <img src="../../../assets/images/i3.jpg" alt="Image de présentation">
    <!-- Titre centré -->
    <div class="presentation-title">
        Votre Titre Ici
    </div>
</section>
<!-- Fin section image de présentation du projet -->

<!-- Début section  -->
<section class="container my-5">
    <div class="row project-info justify-content-center">
        <!-- Date de début -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 info-item">
            <div class="icon-title">
                <div class="icon">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <h6>Date de début:</h6>
            </div>
            <p>01/01/2023</p>
        </div>

        <!-- Date de fin -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 info-item">
            <div class="icon-title">
                <div class="icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h6>Date de fin:</h6>
            </div>
            <p>31/12/2023</p>
        </div>

        <!-- Montant de financement -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 info-item">
            <div class="icon-title">
                <div class="icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h6>Montant:</h6>
            </div>
            <p>50 000 €</p>
        </div>

        <!-- Domaine -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 info-item">
            <div class="icon-title">
                <div class="icon">
                    <i class="bi bi-briefcase"></i>
                </div>
                <h6>Domaine:</h6>
            </div>
            <p>Informatique</p>
        </div>

        <!-- État du projet -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 info-item">
            <div class="icon-title">
                <div class="icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <h6>État:</h6>
            </div>
            <p>En cours</p>
        </div>
    </div>
</section>


<section>
<div class="container my-5">
        <div class="row">
             <!-- Description -->
             <div class="col-md-5 content-section">
                <div class="bar"></div>
                <h3 class="mb-3">Titre de la Section</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula velit ac tortor fermentum, nec cursus odio ullamcorper. Phasellus malesuada quam et nunc vehicula, nec facilisis felis dictum.</p>
            </div>

            <!-- First Div: Video Section -->
            <div class="col-md-6">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Vertical Divider -->
            <div class="col-md-1 vertical-divider"></div>

           
        </div>
    </div>
</section>

<section>
<div class="container my-5">
        <div class="row">
            <!-- Objectifs -->
            <div class="col-md-7 content-section">
                <div class="bar"></div>
                <h3 class="mb-3">Titre de la Section</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vehicula velit ac tortor fermentum, nec cursus odio ullamcorper. Phasellus malesuada quam et nunc vehicula, nec facilisis felis dictum.</p>
            </div>

            <!-- Vertical Divider -->
            <div class="col-md-1 vertical-divider"></div>

            <!-- photos-->
            <div class="col-md-4 image-container">
                <img src="https://via.placeholder.com/400x300" alt="Image Description">
            </div>
        </div>
    </div>
</section>



<?php
// Inclure le footer
include '../conponents/footer.php';
?>
<script src="../../../assets/bootstrap/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>