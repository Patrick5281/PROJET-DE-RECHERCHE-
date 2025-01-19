<?php
//  LE model de l'entité admin 
//  Fnonctionnalités principales:
//     -Ajout : insert
//     -Affichage: select
//     -Suppression : delete

// Pour la connexion à la base de données
require_once __DIR__ . '/../config/database.php';

function createProjet($titre, $date_debut, $date_fin, $description, $etat, $montant_financement, $partenaires, $objectifs, $domaines, $image_projet, $video_projet)
{
    $bdd = connexion();
    //Insertion des données du projet
    $sql = $bdd->prepare("INSERT INTO Projet(titre, date_debut, date_fin, description, etat, montant_financement, partenaires, objectifs, domaines, image_projet, video_projet) 
    VALUES(:titre, :date_debut, :date_fin, :description, :etat, :montant_financement, :partenaires, :objectifs, :domaines, :image_projet, :video_projet)");

    $sql->bindParam(':titre', $titre);
    $sql->bindParam(':date_debut', $date_debut);
    $sql->bindParam(':date_fin', $date_fin);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':etat', $etat);
    $sql->bindParam(':montant_financement', $montant_financement);
    $sql->bindParam(':partenaires', $partenaires);
    $sql->bindParam(':objectifs', $objectifs);
    $sql->bindParam(':domaines', $domaines);
    $sql->bindParam(':image_projet', $image_projet);
    $sql->bindParam(':video_projet', $video_projet);

    return $sql->execute();
}

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

function editProjet($id)
{
    $bdd = connexion();

    $sql = $bdd->prepare("SELECT * FROM Projet WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();

    $data = $sql->fetch();

    return $data;
}

function updateProjet($id, $titre, $date_debut, $date_fin, $description, $etat, $montant_financement, $partenaires, $objectifs, $domaines, $image_projet, $video_projet)
{
    $bdd = connexion();

    $sql = $bdd->prepare("UPDATE Projet SET 
        titre = :titre,
        date_debut = :date_debut,
        date_fin = :date_fin,
        description = :description,
        etat = :etat,
        montant_financement = :montant_financement,
        partenaires = :partenaires,
        objectifs = :objectifs,
        domaines = :domaines,
        image_projet = :image_projet,
        video_projet = :video_projet
        WHERE id = :id");

    $sql->bindParam(':id', $id);
    $sql->bindParam(':titre', $titre);
    $sql->bindParam(':date_debut', $date_debut);
    $sql->bindParam(':date_fin', $date_fin);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':etat', $etat);
    $sql->bindParam(':montant_financement', $montant_financement);
    $sql->bindParam(':partenaires', $partenaires);
    $sql->bindParam(':objectifs', $objectifs);
    $sql->bindParam(':domaines', $domaines);
    $sql->bindParam(':image_projet', $image_projet);
    $sql->bindParam(':video_projet', $video_projet);

    return $sql->execute();
}

function deleteProjet($id)
{
    $bdd = connexion();

    $sql = $bdd->prepare("DELETE FROM Projet WHERE id = :id");
    $sql->bindParam(':id', $id);

    return $sql->execute();
}

// Gestion des annonces
function createAnnonce($titre, $description, $auteur, $date_expiration, $categorie, $etat, $fichiers_joint, $lien_externe, $image_annonce, $tags)
{
    $bdd = connexion();
    $sql = $bdd->prepare("INSERT INTO Annonce (titre, description, auteur, date_expiration, categorie, etat, fichiers_joint, lien_externe, image_annonce, tags) 
    VALUES (:titre, :description, :auteur, :date_publication, :date_expiration, :categorie, :etat, :fichiers_joint, :lien_externe, :image_annonce, :tags)");

    $sql->bindParam(':titre', $titre);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':auteur', $auteur);
    $sql->bindParam(':date_expiration', $date_expiration);
    $sql->bindParam(':categorie', $categorie);
    $sql->bindParam(':etat', $etat);
    $sql->bindParam(':fichiers_joint', $fichiers_joint);
    $sql->bindParam(':lien_externe', $lien_externe);
    $sql->bindParam(':image_annonce', $image_annonce);
    $sql->bindParam(':tags', $tags);

    return $sql->execute();
}

function showAnnonce()
{
    $bdd = connexion();
    $sql = $bdd->prepare("SELECT * FROM Annonce");
    $sql->execute();
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function editAnnonce($id)
{
    $bdd = connexion();
    $sql = $bdd->prepare("SELECT * FROM Annonce WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $data = $sql->fetch();
    return $data;
}

function updateAnnonce($id, $titre, $description, $auteur, $date_publication, $date_expiration, $categorie, $etat, $fichiers_joint, $lien_externe, $image_annonce, $tags)
{
    $bdd = connexion();
    $sql = $bdd->prepare("UPDATE Annonce SET 
        titre = :titre,
        description = :description,
        auteur = :auteur,
        date_expiration = :date_expiration,
        categorie = :categorie,
        etat = :etat,
        fichiers_joint = :fichiers_joint,
        lien_externe = :lien_externe,
        image_annonce = :image_annonce,
        tags = :tags
        WHERE id = :id");

    $sql->bindParam(':id', $id);
    $sql->bindParam(':titre', $titre);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':auteur', $auteur);
    $sql->bindParam(':date_expiration', $date_expiration);
    $sql->bindParam(':categorie', $categorie);
    $sql->bindParam(':etat', $etat);
    $sql->bindParam(':fichiers_joint', $fichiers_joint);
    $sql->bindParam(':lien_externe', $lien_externe);
    $sql->bindParam(':image_annonce', $image_annonce);
    $sql->bindParam(':tags', $tags);

    return $sql->execute();
}

function deleteAnnonce($id)
{
    $bdd = connexion();
    $sql = $bdd->prepare("DELETE FROM Annonce WHERE id = :id");
    $sql->bindParam(':id', $id);
    return $sql->execute();
}

// Gestion des Activités
function createActivite($titre, $description, $date_debut, $lieu, $image, $lien_externe, $type, $statut)
{
    $bdd = connexion();
    $sql = $bdd->prepare("INSERT INTO Activite (titre, description, date_debut, lieu, image, lien_externe, type, statut, date_creation) 
    VALUES (:titre, :description, :date_debut, :lieu, :image, :lien_externe, :type, :statut, CURRENT_TIMESTAMP)");

    $sql->bindParam(':titre', $titre);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':date_debut', $date_debut);
    $sql->bindParam(':lieu', $lieu);
    $sql->bindParam(':image', $image);
    $sql->bindParam(':lien_externe', $lien_externe);
    $sql->bindParam(':type', $type);
    $sql->bindParam(':statut', $statut);

    return $sql->execute();
}

function showActivite()
{
    $bdd = connexion();
    $sql = $bdd->prepare("SELECT * FROM Activite ORDER BY date_creation DESC");
    $sql->execute();
    $data = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function editActivite($id_act)
{
    $bdd = connexion();
    $sql = $bdd->prepare("SELECT * FROM Activite WHERE id_act = :id_act");
    $sql->bindParam(':id_act', $id_act);
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function updateActivite($id_act, $titre, $description, $date_debut, $lieu, $image, $lien_externe, $type, $statut)
{
    $bdd = connexion();
    $sql = $bdd->prepare("UPDATE Activite SET 
        titre = :titre,
        description = :description,
        date_debut = :date_debut,
        lieu = :lieu,
        image = :image,
        lien_externe = :lien_externe,
        type = :type,
        statut = :statut
        WHERE id_act = :id_act");

    $sql->bindParam(':id_act', $id_act);
    $sql->bindParam(':titre', $titre);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':date_debut', $date_debut);
    $sql->bindParam(':lieu', $lieu);
    $sql->bindParam(':image', $image);
    $sql->bindParam(':lien_externe', $lien_externe);
    $sql->bindParam(':type', $type);
    $sql->bindParam(':statut', $statut);

    return $sql->execute();
}

function deleteActivite($id_act)
{
    $bdd = connexion();
    $sql = $bdd->prepare("DELETE FROM Activite WHERE id_act = :id_act");
    $sql->bindParam(':id_act', $id_act);
    return $sql->execute();
}

