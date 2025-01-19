<?php
//  LE model de l'entité admin 
//  Fnonctionnalités principales:
//     -Ajout : insert
//     -Affichage: select
//     -Suppression : delete
// 

// Pour la connexion à la base de données
require_once __DIR__ . '/../config/database.php';

function showProjet()
{
    $bdd = connexion();

    // Requête de sélection de tous les projets
    $sql = $bdd->prepare("SELECT * FROM Projet");
    $sql->execute();

    // récupérer les projets dans la variable $data
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}


