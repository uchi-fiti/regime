-- Objectifs 
INSERT INTO objectif (label) VALUES 
('Augmenter son poids'), 
('Réduire son poids'), 
('Atteindre son IMC idéal');

-- Utilisateurs (5 au total) 
INSERT INTO user (nom, mail, genre, mdp) VALUES 
('Jean Rakoto', 'jean@mail.com', 'Homme', '123456'),
('Léa Randria', 'lea@mail.com', 'Femme', 'password'),
('Marc Smith', 'marc@mail.com', 'Homme', 'security'),
('Sara Doe', 'sara@mail.com', 'Femme', 'azerty'),
('Paul Cook', 'paul@mail.com', 'Homme', 'paul2026');

-- Données de santé initiales 
INSERT INTO user_health_info (id_user, taille, poids, id_objectif, valeur_objectif, date_info) VALUES 
(1, 175.0, 65.0, 1, 75.0, '2026-05-01'), -- Jean veut monter à 75kg
(2, 160.0, 60.0, 2, 55.0, '2026-05-02'), -- Léa veut descendre à 55kg
(3, 180.0, 95.0, 3, 0, '2026-05-03'),    -- Marc vise l'IMC idéal
(4, 165.0, 50.0, 1, 55.0, '2026-05-04'), 
(5, 170.0, 85.0, 2, 75.0, '2026-05-05');

-- Régimes (5 au total) 
-- Note: les pourcentages doivent faire 100% 
INSERT INTO regime (label, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, variation_poids_journalier) VALUES 
('Hyper-Protéiné', 60.0, 20.0, 20.0, 0.200), 
('Équilibre Marin', 10.0, 70.0, 20.0, -0.150),
('Végétarien (Mix)', 0.0, 0.0, 0.0, -0.100),
('Carnivore Bulk', 80.0, 10.0, 10.0, 0.300),
('Léger Fitness', 20.0, 40.0, 40.0, -0.050);

-- Activités Sportives (5 au total) 
INSERT INTO sport (label, variation_poids_journalier) VALUES 
('Natation', -0.050),
('Musculation', 0.020),
('Running', -0.080),
('Yoga', -0.010),
('Crossfit', -0.100);

-- Codes de recharge (15 au total) 
INSERT INTO code (code, valeur, statut) VALUES 
('RECH-001', 5000, 0), ('RECH-002', 5000, 0), ('RECH-003', 5000, 0),
('RECH-010', 10000, 0), ('RECH-011', 10000, 0), ('RECH-012', 10000, 0),
('RECH-020', 20000, 0), ('RECH-021', 20000, 0), ('RECH-022', 20000, 0),
('RECH-050', 50000, 0), ('RECH-051', 50000, 0), ('RECH-052', 50000, 0),
('RECH-100', 100000, 0), ('RECH-101', 100000, 0), ('RECH-102', 100000, 0);

-- Option Gold 
INSERT INTO abonnement (label, prix, remise) VALUES 
('Pass Gold', 50000.0, 15.0);

-- Prix des régimes (tarification progressive selon durée) 
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

-- Table IMC de référence 
INSERT INTO table_imc (valeur_debut, valeur_fin, label) VALUES 
(0, 18.5, 'Insuffisance pondérale'),
(18.5, 25.0, 'Corpulence normale'),
(25.0, 30.0, 'Surpoids'),
(30.0, 35.0, 'Obésité modérée'),
(35.0, 100.0, 'Obésité sévère');