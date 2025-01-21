-- Structure de la table `projets`
CREATE TABLE IF NOT EXISTS `projets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `description` text NOT NULL,
  `etat` enum('en_cours','termine','suspendu') DEFAULT 'en_cours',
  `montant_financement` decimal(15,2) DEFAULT NULL,
  `partenaires` text,
  `objectifs` text,
  `domaines` varchar(255) DEFAULT NULL,
  `image_projet` varchar(255) DEFAULT NULL,
  `video_projet` varchar(255) DEFAULT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
