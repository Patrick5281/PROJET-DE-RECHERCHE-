<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <title>Apite</title>
</head>
<body>
<?php
// Inclure le header
include 'include/view/conponents/header.php';
?>

<!-- Contenu principal de la page -->
<main>
    <div class="container py-5">
        <h1 class="text-center">Bienvenue sur la page principale</h1>

        <p class="text-center">Ceci est le contenu de la page principale.</p>
    </div>
    <!-- Lien vers la page de création de projet -->
        <div class="text-center">
            <a href="include/view/user/annonces.php" class="btn btn-primary">Créer un nouveau projet</a>
        </div>
</main>

<?php
// Inclure le footer
include 'include/view/conponents/footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
