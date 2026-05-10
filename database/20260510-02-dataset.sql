-- Dataset complet pour regime_db
-- À exécuter après clean-data.sql

USE regime_db;

-- ============================================
-- 1. OBJECTIFS (3 objectifs)
-- ============================================
INSERT INTO objectif (label) VALUES 
('Augmenter son poids'), 
('Réduire son poids'), 
('Atteindre son IMC idéal');

-- ============================================
-- 2. UTILISATEURS (5 users)
-- ============================================
INSERT INTO user (nom, mail, genre, mdp, role) VALUES 
('Jean Rakoto', 'jean@mail.com', 'Homme', SHA2('password123', 256), 'user'),
('Léa Randria', 'lea@mail.com', 'Femme', SHA2('password456', 256), 'user'),
('Marc Smith', 'marc@mail.com', 'Homme', SHA2('password789', 256), 'admin'),
('Sara Doe', 'sara@mail.com', 'Femme', SHA2('password101', 256), 'user'),
('Paul Cook', 'paul@mail.com', 'Homme', SHA2('password202', 256), 'user');

-- ============================================
-- 3. DONNÉES DE SANTÉ (5 enregistrements)
-- ============================================
INSERT INTO user_health_info (id_user, taille, poids, id_objectif, valeur_objectif, date_info) VALUES 
(1, 1.75, 65.0, 1, 10.0, '2026-05-01'),     -- Jean: 1.75m, 65kg, augmenter de 10kg
(2, 1.60, 60.0, 2, -5.0, '2026-05-02'),     -- Léa: 1.60m, 60kg, réduire de 5kg
(3, 1.80, 95.0, 3, 0.0, '2026-05-03'),      -- Marc: 1.80m, 95kg, atteindre IMC idéal
(4, 1.65, 50.0, 1, 8.0, '2026-05-04'),      -- Sara: 1.65m, 50kg, augmenter de 8kg
(5, 1.70, 85.0, 2, -10.0, '2026-05-05');    -- Paul: 1.70m, 85kg, réduire de 10kg

-- ============================================
-- 4. RÉGIMES (5 régimes)
-- Note: variation_poids_journalier en kg (positive = gain, négative = perte)
-- ============================================
INSERT INTO regime (label, photo, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, variation_poids_journalier) VALUES 
('Hyper-Protéiné', 'hyper-proteine.jpg', 60.0, 20.0, 20.0, 0.200),      -- Prise de poids
('Équilibre Marin', 'equilibre-marin.jpg', 10.0, 70.0, 20.0, -0.150),    -- Perte de poids
('Végétarien Équilibré', 'vegetarien.jpg', 0.0, 0.0, 0.0, -0.100),       -- Perte modérée
('Carnivore Bulk', 'carnivore.jpg', 80.0, 10.0, 10.0, 0.300),            -- Prise importante
('Fitness Léger', 'fitness-leger.jpg', 20.0, 40.0, 40.0, -0.050);        -- Perte légère

-- ============================================
-- 5. SPORTS (5 sports)
-- Note: variation_poids_journalier en kg (positive = gain, négative = perte)
-- ============================================
INSERT INTO sport (label, variation_poids_journalier) VALUES 
('Natation', -0.050),
('Musculation', 0.020),     -- Peut créer du muscle (gain)
('Running', -0.080),
('Yoga', -0.010),
('Crossfit', -0.100);

-- ============================================
-- 6. TABLE IMC DE RÉFÉRENCE
-- ============================================
INSERT INTO table_imc (valeur_debut, valeur_fin, label) VALUES 
(0, 18.5, 'Insuffisance pondérale'),
(18.5, 25.0, 'Corpulence normale'),
(25.0, 30.0, 'Surpoids'),
(30.0, 35.0, 'Obésité modérée'),
(35.0, 100.0, 'Obésité sévère');

-- ============================================
-- 7. CODES DE RECHARGE (15 codes)
-- Note: valeur en ariary
-- ============================================
INSERT INTO code (code, valeur, statut) VALUES 
-- Codes 5000 Ar (3 codes)
('RECH-001', 5000.00, 0), 
('RECH-002', 5000.00, 0), 
('RECH-003', 5000.00, 0),
-- Codes 10000 Ar (3 codes)
('RECH-010', 10000.00, 0), 
('RECH-011', 10000.00, 0), 
('RECH-012', 10000.00, 0),
-- Codes 20000 Ar (3 codes)
('RECH-020', 20000.00, 0), 
('RECH-021', 20000.00, 0), 
('RECH-022', 20000.00, 0),
-- Codes 50000 Ar (3 codes)
('RECH-050', 50000.00, 0), 
('RECH-051', 50000.00, 0), 
('RECH-052', 50000.00, 0),
-- Codes 100000 Ar (3 codes)
('RECH-100', 100000.00, 0), 
('RECH-101', 100000.00, 0), 
('RECH-102', 100000.00, 0);

-- ============================================
-- 8. ABONNEMENTS
-- ============================================
INSERT INTO abonnement (label, prix, remise) VALUES 
('Pass Gold', 50000.00, 15.0),      -- Remise de 15%
('Pass Platine', 100000.00, 25.0);  -- Remise de 25%

-- ============================================
-- 9. PRIX DES RÉGIMES
-- Note: Tarification progressive selon la durée
-- ============================================
INSERT INTO prix_regime (id_regime, jour_debut, jour_fin, prix_journalier) VALUES 
(1, 1, 7, 25000.00),       -- 1 semaine
(1, 8, 30, 22500.00),      -- jusqu'à 1 mois (10% réduction)
(1, 31, 90, 20000.00);     -- jusqu'à 3 mois (20% réduction)

INSERT INTO prix_regime (id_regime, jour_debut, jour_fin, prix_journalier) VALUES 
(2, 1, 7, 20000.00),
(2, 8, 30, 18000.00),
(2, 31, 90, 16000.00);

INSERT INTO prix_regime (id_regime, jour_debut, jour_fin, prix_journalier) VALUES 
(3, 1, 7, 18000.00),
(3, 8, 30, 16200.00),
(3, 31, 90, 14400.00);

INSERT INTO prix_regime (id_regime, jour_debut, jour_fin, prix_journalier) VALUES 
(4, 1, 7, 30000.00),
(4, 8, 30, 27000.00),
(4, 31, 90, 24000.00);

INSERT INTO prix_regime (id_regime, jour_debut, jour_fin, prix_journalier) VALUES 
(5, 1, 7, 15000.00),
(5, 8, 30, 13500.00),
(5, 31, 90, 12000.00);

-- INSERT INTO user_abonnement (id_user, id_abonnement, date_achat) VALUES 
-- (1, 1, '2026-05-01 10:30:00'),  -- Jean a le Pass Gold
-- (3, 2, '2026-05-02 14:15:00');  -- Marc a le Pass Platine


SELECT 'Dataset inséré avec succès!' AS message;
SELECT COUNT(*) as total_users FROM user;
SELECT COUNT(*) as total_regimes FROM regime;
SELECT COUNT(*) as total_sports FROM sport;
SELECT COUNT(*) as total_codes FROM code;

