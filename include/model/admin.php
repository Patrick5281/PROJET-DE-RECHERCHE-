<?php
//  LE model de l'entité admin 
//  Fnonctionnalités principales:
//     -Ajout : insert
//     -Affichage: select
//     -Suppression : delete

// Pour la connexion à la base de données
require_once __DIR__ . '/../../config/database.php';

function createProjet($titre, $date_debut, $date_fin, $description, $etat, $montant_financement, $partenaires, $objectifs, $domaines, $image_projet, $video_projet)
{
    try {
        $bdd = connexion();
        
        // Gestion de l'upload de l'image principale
        $image_path = null;
        if (isset($_FILES['image_projet']) && $_FILES['image_projet']['error'] === 0) {
            $upload_dir = __DIR__ . '/../../assets/uploads/projets/images/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $image_name = time() . '_' . basename($_FILES['image_projet']['name']);
            $image_path = 'assets/uploads/projets/images/' . $image_name;
            move_uploaded_file($_FILES['image_projet']['tmp_name'], $upload_dir . $image_name);
        }

        // Gestion de l'upload de la vidéo
        $video_path = null;
        if (isset($_FILES['video_projet']) && $_FILES['video_projet']['error'] === 0) {
            $upload_dir = __DIR__ . '/../../assets/uploads/projets/videos/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $video_name = time() . '_' . basename($_FILES['video_projet']['name']);
            $video_path = 'assets/uploads/projets/videos/' . $video_name;
            move_uploaded_file($_FILES['video_projet']['tmp_name'], $upload_dir . $video_name);
        }

        // Préparation et exécution de la requête SQL
        $sql = $bdd->prepare("INSERT INTO projets(titre, date_debut, date_fin, description, etat, montant_financement, partenaires, objectifs, domaines, image_projet, video_projet) 
        VALUES(:titre, :date_debut, :date_fin, :description, :etat, :montant_financement, :partenaires, :objectifs, :domaines, :image_projet, :video_projet)");

        $result = $sql->execute([
            ':titre' => $titre,
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
            ':description' => $description,
            ':etat' => $etat,
            ':montant_financement' => $montant_financement,
            ':partenaires' => $partenaires,
            ':objectifs' => $objectifs,
            ':domaines' => $domaines,
            ':image_projet' => $image_path,
            ':video_projet' => $video_path
        ]);

        return $result;
    } catch (PDOException $e) {
        // Log l'erreur et retourne false
        error_log("Erreur lors de la création du projet: " . $e->getMessage());
        return false;
    }
}

function showProjet() {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        $query = "SELECT * FROM projets ORDER BY date_debut DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des projets : " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération des projets");
    }
}

function editProjet($id) {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        $query = "SELECT * FROM projets WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération du projet : " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération du projet");
    }
}

function getProjetById($id) {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        $query = "SELECT * FROM projets WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération du projet : " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération du projet");
    }
}

function updateProjet($id, $titre, $date_debut, $date_fin, $description, $etat, $montant_financement, $partenaires, $objectifs, $domaines, $image_projet = null, $video_projet = null) {
    try {
        $conn = connexion();
        
        // Début de la requête SQL
        $sql = "UPDATE projets SET 
                titre = ?, 
                date_debut = ?, 
                date_fin = ?, 
                description = ?, 
                etat = ?, 
                montant_financement = ?, 
                partenaires = ?, 
                objectifs = ?, 
                domaines = ?";
        
        $params = [
            $titre, 
            $date_debut, 
            $date_fin, 
            $description, 
            $etat, 
            $montant_financement, 
            $partenaires, 
            $objectifs, 
            $domaines
        ];

        // Ajouter l'image si elle est fournie
        if ($image_projet !== null) {
            $sql .= ", image_projet = ?";
            $params[] = $image_projet;
        }

        // Ajouter la vidéo si elle est fournie
        if ($video_projet !== null) {
            $sql .= ", video_projet = ?";
            $params[] = $video_projet;
        }

        // Finaliser la requête
        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $conn->prepare($sql);
        return $stmt->execute($params);

    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du projet : " . $e->getMessage());
        return false;
    }
}

function deleteProjet($id) {
    try {
        $conn = connexion();
        $sql = "DELETE FROM projets WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du projet : " . $e->getMessage());
        return false;
    }
}

// Fonctions pour la gestion des annonces
function createAnnonce($titre, $description, $auteur, $date_publication, $date_expiration, $categorie, $etat, $fichiers_joint, $lien_externe, $image_annonce, $tags) {
    try {
        $conn = connexion();
        
        // Log de la connexion
        error_log("Connexion à la base de données établie");
        
        // Construction de la requête SQL
        $sql = "INSERT INTO annonce (titre, description, auteur, date_publication, date_expiration, categorie, etat, fichiers_joint, lien_externe, image_annonce, tags, nombre_vue) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        
        error_log("Requête SQL préparée : " . $sql);
        
        // Validation de l'état (doit être 'actif' ou 'expiré')
        if (!in_array($etat, ['actif', 'expiré'])) {
            $etat = 'actif';
        }
        
        // Si date_publication est null, utiliser CURRENT_TIMESTAMP
        if (empty($date_publication)) {
            $date_publication = date('Y-m-d H:i:s');
        }
        
        // Préparation des données
        $params = [
            $titre,
            $description,
            $auteur,
            $date_publication,
            $date_expiration,
            $categorie,
            $etat,
            $fichiers_joint,
            $lien_externe,
            $image_annonce,
            $tags
        ];
        
        error_log("Paramètres de la requête : " . print_r($params, true));
        
        // Préparation et exécution de la requête
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erreur lors de la préparation de la requête : " . print_r($conn->errorInfo(), true));
        }
        
        $result = $stmt->execute($params);
        if (!$result) {
            throw new Exception("Erreur lors de l'exécution de la requête : " . print_r($stmt->errorInfo(), true));
        }
        
        error_log("Annonce créée avec succès. ID : " . $conn->lastInsertId());
        return true;
        
    } catch (PDOException $e) {
        error_log("Erreur PDO lors de la création de l'annonce : " . $e->getMessage());
        error_log("Code d'erreur : " . $e->getCode());
        error_log("Trace : " . $e->getTraceAsString());
        return false;
    } catch (Exception $e) {
        error_log("Erreur lors de la création de l'annonce : " . $e->getMessage());
        return false;
    }
}

function getAnnonces() {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        $query = "SELECT * FROM annonce ORDER BY date_publication DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des annonces : " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération des annonces");
    }
}

function getAnnonceById($id_ann) {
    try {
        $conn = connexion();
        $sql = "SELECT * FROM annonce WHERE id_ann = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_ann]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de l'annonce : " . $e->getMessage());
        return false;
    }
}

function updateAnnonce($id_ann, $titre, $description, $auteur, $date_publication, $date_expiration, $categorie, $etat, $fichiers_joint, $lien_externe, $image_annonce, $tags) {
    try {
        $conn = connexion();
        
        $sql = "UPDATE annonce SET 
                titre = ?, 
                description = ?, 
                auteur = ?,
                date_publication = ?,
                date_expiration = ?,
                categorie = ?,
                etat = ?,
                fichiers_joint = ?,
                lien_externe = ?,
                image_annonce = ?,
                tags = ?
                WHERE id_ann = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $titre,
            $description,
            $auteur,
            $date_publication,
            $date_expiration,
            $categorie,
            $etat,
            $fichiers_joint,
            $lien_externe,
            $image_annonce,
            $tags,
            $id_ann
        ]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour de l'annonce : " . $e->getMessage());
        return false;
    }
}

function deleteAnnonce($id_ann) {
    try {
        $conn = connexion();
        $sql = "DELETE FROM annonce WHERE id_ann = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id_ann, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'annonce : " . $e->getMessage());
        return false;
    }
}

function incrementAnnonceViews($id_ann) {
    try {
        $conn = connexion();
        $sql = "UPDATE annonce SET nombre_vue = nombre_vue + 1 WHERE id_ann = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id_ann]);
    } catch (PDOException $e) {
        error_log("Erreur lors de l'incrémentation des vues : " . $e->getMessage());
        return false;
    }
}

// Gestion des annonces
function createAnnonceOld($titre, $description, $auteur, $date_expiration, $categorie, $etat, $fichiers_joint, $lien_externe, $image_annonce, $tags)
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

function updateAnnonceOld($id, $titre, $description, $auteur, $date_publication, $date_expiration, $categorie, $etat, $fichiers_joint, $lien_externe, $image_annonce, $tags)
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

function deleteAnnonceOld($id)
{
    $bdd = connexion();
    $sql = $bdd->prepare("DELETE FROM Annonce WHERE id = :id");
    $sql->bindParam(':id', $id);
    return $sql->execute();
}

// Gestion des Activités
function createActivite($titre, $description, $date_debut, $lieu, $image, $lien_externe, $type, $statut) {
    try {
        $conn = connexion();
        
        $sql = "INSERT INTO activite (titre, description, date_debut, lieu, image, lien_externe, type, statut, date_creation) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $titre,
            $description,
            $date_debut,
            $lieu,
            $image,
            $lien_externe,
            $type,
            $statut
        ]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la création de l'activité : " . $e->getMessage());
        return false;
    }
}

function getActivites() {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        $query = "SELECT * FROM activite ORDER BY date_debut DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des activités : " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération des activités");
    }
}

function getActiviteById($id_act) {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        $query = "SELECT * FROM activite WHERE id_act = :id_act";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_act', $id_act, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération de l'activité : " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération de l'activité");
    }
}

function updateActivite($id_act, $titre, $description, $date_debut, $lieu, $image, $lien_externe, $type, $statut) {
    try {
        $conn = connexion();
        if (!$conn) {
            throw new Exception("La connexion à la base de données a échoué");
        }

        // Si une nouvelle image est fournie, on met à jour l'image
        if ($image !== null) {
            $query = "UPDATE activite SET 
                    titre = :titre,
                    description = :description,
                    date_debut = :date_debut,
                    lieu = :lieu,
                    image = :image,
                    lien_externe = :lien_externe,
                    type = :type,
                    statut = :statut
                    WHERE id_act = :id_act";
        } else {
            // Si pas de nouvelle image, on ne modifie pas le champ image
            $query = "UPDATE activite SET 
                    titre = :titre,
                    description = :description,
                    date_debut = :date_debut,
                    lieu = :lieu,
                    lien_externe = :lien_externe,
                    type = :type,
                    statut = :statut
                    WHERE id_act = :id_act";
        }

        $stmt = $conn->prepare($query);
        
        $params = [
            ':id_act' => $id_act,
            ':titre' => $titre,
            ':description' => $description,
            ':date_debut' => $date_debut,
            ':lieu' => $lieu,
            ':lien_externe' => $lien_externe,
            ':type' => $type,
            ':statut' => $statut
        ];

        if ($image !== null) {
            $params[':image'] = $image;
        }

        $stmt->execute($params);

        if ($stmt->rowCount() === 0) {
            throw new Exception("Aucune activité n'a été mise à jour");
        }

        return true;
    } catch(PDOException $e) {
        error_log("Erreur lors de la mise à jour de l'activité : " . $e->getMessage());
        throw new Exception("Erreur lors de la mise à jour de l'activité");
    }
}

function deleteActivite($id_act) {
    try {
        $conn = connexion();
        $sql = "DELETE FROM activite WHERE id_act = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id_act, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'activité : " . $e->getMessage());
        return false;
    }
}
