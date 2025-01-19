<?php
require_once __DIR__ . '/../../../config/database.php';
?>
<header class="d-flex align-items-center text-white py-2">

    <!-- Logo de gauche -->

    <div class="logo-container1 d-flex align-items-center justify-content-center bg-white me-3"

        style="height: 73px; width: 73px;">

        <img src="../../../assets/icons/0 2.png" alt="Logo gauche" class="img-fluid">

    </div>



    <!-- Texte principal -->

    <div class="text-container flex-grow-1">

        <h1 class="m-0 fw-bold">INSTI</h1>

        <p class="m-0">Instituttt Nationale Supérieur de Technologie Industrielle <br /> de Lokossa</p>

    </div>



    <!-- Liens à droite -->

    <div class="links d-flex align-items-center">

        <a href="#" class="text-white d-flex align-items-center me-3">

            <img src="../../../assets/icons/info-circle-fill.svg" alt="Info" class="icon-white me-1" style="width: 20px; height: 20px;"> Accès rapide

        </a>

        <span class="text-white">|</span>

        <a href="#" class="text-white d-flex align-items-center mx-3">

            <img src="../../../assets/icons/snow3.svg" alt="Observatoire" class="icon-white me-1" style="width: 20px; height: 20px;"> Observatoire

        </a>

        <span class="text-white">|</span>

        <a href="#" class="text-white d-flex align-items-center ms-3">

            <img src="../../../assets/icons/person-fill.svg" alt="Person" class="icon-white me-1" style="width: 20px; height: 20px;"> Nous écrire

        </a>

    </div>



    <!-- Logo de droite -->

    <div class="logo-container1 d-flex align-items-center justify-content-center bg-white ms-3"

        style="height: 73px; width: 73px;">

        <img src="../../../assets/icons/logoINSTI 1.png" alt="Logo droite" class="img-fluid">

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

                <li class="nav-item"><a class="nav-link" href="index.php">APITE</a></li>

                <li class="nav-item"><a class="nav-link" href="/../../include/view/admin/project_details.php">ANNONCES</a></li>

                <li class="nav-item"><a class="nav-link" href="../include/view/admin/createProjet.php">PROJETS DE RECHERCHE</a></li>

                <li class="nav-item logo-container">

                    <a href="#">

                        <img src="../../../assets/icons/h pe.png" alt="Logo entreprise" class="img-fluid logo">

                    </a>

                </li>

                <li class="nav-item"><a class="nav-link" href="#">ACTIVITES</a></li>

                <li class="nav-item"><a class="nav-link" href="#">GALERIE</a></li>

                <li class="nav-item"><a class="nav-link" href="#">CONTACTS</a></li>

            </ul>

        </div>

    </div>

</nav>
