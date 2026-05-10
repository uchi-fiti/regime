-- Script de nettoyage des données de la base regime_db
-- Supprime toutes les données mais conserve la structure des tables

USE regime_db;

-- Désactiver les contraintes de clé étrangère temporairement
SET FOREIGN_KEY_CHECKS=0;

-- Vider toutes les tables
TRUNCATE TABLE mvt_portemonnaie;
TRUNCATE TABLE user_abonnement;
TRUNCATE TABLE user_health_info;
TRUNCATE TABLE prix_regime;
TRUNCATE TABLE code;
TRUNCATE TABLE abonnement;
TRUNCATE TABLE sport;
TRUNCATE TABLE regime;
TRUNCATE TABLE table_imc;
TRUNCATE TABLE user;
TRUNCATE TABLE objectif;

-- Réinitialiser les AUTO_INCREMENT à 1 pour toutes les tables
ALTER TABLE objectif AUTO_INCREMENT = 1;
ALTER TABLE user AUTO_INCREMENT = 1;
ALTER TABLE user_health_info AUTO_INCREMENT = 1;
ALTER TABLE regime AUTO_INCREMENT = 1;
ALTER TABLE sport AUTO_INCREMENT = 1;
ALTER TABLE table_imc AUTO_INCREMENT = 1;
ALTER TABLE code AUTO_INCREMENT = 1;
ALTER TABLE abonnement AUTO_INCREMENT = 1;
ALTER TABLE user_abonnement AUTO_INCREMENT = 1;
ALTER TABLE mvt_portemonnaie AUTO_INCREMENT = 1;
ALTER TABLE prix_regime AUTO_INCREMENT = 1;

-- Réactiver les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS=1;

-- Confirmation
SELECT 'Nettoyage complet de la base de données effectué!' AS message;
SELECT 'Tous les AUTO_INCREMENT sont réinitialisés à 1' AS status;
