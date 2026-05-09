drop database regime_db;

create database regime_db;
use regime_db;

create table objectif (
    id int AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100)
);

create table user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL UNIQUE,
    genre VARCHAR(10), 
    mdp VARCHAR(255) NOT NULL
);

create table user_health_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    taille DECIMAL(5,2) NOT NULL, 
    poids DECIMAL(5,2) NOT NULL,
    id_objectif INT NOT NULL,
    valeur_objectif DECIMAL(5,2), 
    date_info DATE NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_objectif) REFERENCES objectif(id)
);

create table regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    photo VARCHAR(100),
    pourcentage_viande DECIMAL(5,2) DEFAULT 0,
    pourcentage_poisson DECIMAL(5,2) DEFAULT 0,
    pourcentage_volaille DECIMAL(5,2) DEFAULT 0,
    variation_poids_journalier DECIMAL(5,3) NOT NULL
);

create table sport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(100) NOT NULL,
    variation_poids_journalier DECIMAL(5,3) NOT NULL
);

create table table_imc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valeur_debut DECIMAL(4,1) NOT NULL,
    valeur_fin DECIMAL(4,1) NOT NULL,
    label VARCHAR(50) NOT NULL
);

CREATE TABLE code (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    valeur DECIMAL(10,2) NOT NULL,
    statut INT DEFAULT 0
);

create table abonnement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    remise DECIMAL(5,2)
);

CREATE TABLE user_abonnement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_abonnement INT NOT NULL,
    date_achat DATETIME NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_abonnement) REFERENCES abonnement(id)
);

CREATE TABLE mvt_portemonnaie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    type_mvt VARCHAR(10) NOT NULL, 
    date_mvt DATETIME NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id)
);

create table prix_regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_regime int,
    jour_debut int,
    jour_fin int,
    prix_journalier DECIMAL(10,2)
);
