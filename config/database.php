<?php
//Connexion à la bd

function connexion() {
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=projet_bd;charset=utf8',
            'root',
            '',
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        return $bdd;
    } catch (PDOException $e) {
        error_log("Erreur de connexion à la base de données : " . $e->getMessage());
        throw new Exception("Impossible de se connecter à la base de données");
    }
}
