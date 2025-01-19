<?php
//Connexion à la bd

function connexion()
{

    try {
        $bdd = new  PDO('mysql:host=localhost; dbname=projet_bd; charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Impossible de se connecter à la BD: ' . $e->getMessage());
    }
    
    return $bdd;
}
