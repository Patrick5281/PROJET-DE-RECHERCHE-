<?php

require_once __DIR__. '/../../model/auteur.php';

// Relier le model auteur à la vue edit.php 
$id= $_GET['id'];

$auteur = editProjet($id);

// if (isset($_POST['valider'])) {

//     if (!empty($_POST['nomAuteur'])  && !empty($_POST['prenomAuteur']) && !empty($_POST['dateNaissance']) && !empty($_POST['adresseAuteur'])) {

//         // appel de la fonction d'insertion 
//            $response =  createAuteur($_POST['nomAuteur'], $_POST['prenomAuteur'], $_POST['dateNaissance'], $_POST['adresseAuteur']);

//             if($response){
//                 $success_msg = "Insertion réussie";
//             } else {
//                 // print_r($bdd->errorInfo());
//                 $error_msg = "Une erreur s'est produite";
//             }
//     }
// }
