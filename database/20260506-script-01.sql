create database regime_db;
use regime_db;

-- 1. Table des objectifs (Augmenter, Réduire, IMC idéal)
CREATE TABLE objectif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- 2. Table des utilisateurs (Infos générales)
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL UNIQUE,
    genre VARCHAR(10), -- 'Homme' ou 'Femme'
    mdp VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- 3. Informations de santé
-- Note: 'valeur_objectif' représente le poids cible ou la variation souhaitée
CREATE TABLE user_health_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    taille DECIMAL(5,2) NOT NULL, -- en cm ou m
    poids DECIMAL(5,2) NOT NULL, -- en kg
    id_objectif INT NOT NULL,
    valeur_objectif DECIMAL(5,2), 
    date_info DATE NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_objectif) REFERENCES objectif(id)
) ENGINE=InnoDB;

-- 4. Table des régimes
-- 'variation_poids_journalier' permet de calculer la durée nécessaire
CREATE TABLE regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    pourcentage_viande DECIMAL(5,2) DEFAULT 0,
    pourcentage_poisson DECIMAL(5,2) DEFAULT 0,
    pourcentage_volaille DECIMAL(5,2) DEFAULT 0,
    variation_poids_journalier DECIMAL(5,3) NOT NULL, -- ex: -0.100 pour perdre 100g/jour
    prix_journalier DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

-- 5. Activités sportives
CREATE TABLE sport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    variation_poids_journalier DECIMAL(5,3) NOT NULL
) ENGINE=InnoDB;

-- 6. Table de référence IMC (pour le calcul du système) 
CREATE TABLE table_imc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valeur_debut DECIMAL(4,1) NOT NULL,
    valeur_fin DECIMAL(4,1) NOT NULL,
    label VARCHAR(50) NOT NULL -- ex: 'Normal', 'Surpoids'
) ENGINE=InnoDB;

-- 7. Codes de recharge pour le porte-monnaie
CREATE TABLE code (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    valeur DECIMAL(10,2) NOT NULL,
    statut INT DEFAULT 0 -- 0: non utilisé, 1: utilisé
) ENGINE=InnoDB;

-- 8. Abonnements (Option Gold)
CREATE TABLE abonnement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    remise DECIMAL(5,2) DEFAULT 0.00 -- ex: 15.00 pour 15% 
) ENGINE=InnoDB;

-- 9. Historique des abonnements utilisateurs
CREATE TABLE user_abonnement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_abonnement INT NOT NULL,
    date_achat DATETIME NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_abonnement) REFERENCES abonnement(id)
) ENGINE=InnoDB;

-- 10. Mouvements du porte-monnaie
CREATE TABLE mvt_portemonnaie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    type_mvt VARCHAR(10) NOT NULL, -- 'ENTREE' (+) ou 'SORTIE' (-)
    date_mvt DATETIME NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id)
) ENGINE=InnoDB;