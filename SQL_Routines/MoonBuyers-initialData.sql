-- MoonBuyers Inital Data Load SQL file MoonBuyers-initialData.sql
-- Data initially loaded into database for testing purposes.

INSERT INTO Customers (Lname, Fname, Addr_1, Addr_2, City, State, Planet, Zip, Phone)
VALUES
('LLC', 'RigidBody Tech', '55 Liberty St.', 'Top Floor', 'New York', 'NY', 'Earth', 100193422, 22125551000),
('LLC', 'RigidBody Tech', '55 Liberty St.', 'Top Floor', 'New York', 'NY', 'Earth', 100193422, 22125551000),
('Inc.', 'Metal Miners', '30 Mariner Trench', 'North 6', 'New Terra', 'MR', 'Mars', 337705433, 37275056243),
('Pvt. Ltd.', 'Hydrogen', '4 Hydrogen Way', 'Jovian Level', 'New Io City', 'IO', 'Io', 47403383, 4747553894),
('Corp.', 'Paralaxix', 'B-Ring', 'Apogee Point 54', 'Orbital H', 'SA', 'Saturn', 505433, 549256547783),
('Inc.', 'Deep Space', 'Ring 4', 'Floater 4R', 'Uranus Sys', 'UR', 'Uranus', 606893, 6584359765),
('Inc.', 'Belt Harvest', 'Ceres Station', 'Level 8', 'New Patagonia', 'CE', 'Ceres', 4540890, 5124548723197),
('Corp.', 'Outer Rim', 'Pluto Biodome C', 'Upper Level', 'Ice City', 'PL', 'Pluto', 97708205535, 993561724324),
('Ltd.', 'Belted', '1 Eros', 'Level 1', 'Spin Zone', 'ER', 'Eros', 587030178, 5294856),
('LLC', 'Excavat Ice', 'Zone 5', 'Submersible 7H', 'Ru', 'EC', 'Enceladus', 66052883, 672753558990),
('Inc.', 'Launcher', 'Biodome A', 'Main Level', 'Huygens', 'TI', 'Titan', 837705433, 8727548390112);

-- Inital Account Creation.
INSERT INTO Account (C_ID, Balance)
VALUES
((SELECT id FROM Customers WHERE id = 200000), 99234567.89),
((SELECT id FROM Customers WHERE id = 200001), 1000000.00),
((SELECT id FROM Customers WHERE id = 200002), 234567.90),
((SELECT id FROM Customers WHERE id = 200003), 3234557.40),
((SELECT id FROM Customers WHERE id = 200004), 4133457),
((SELECT id FROM Customers WHERE id = 200005), 54567.01),
((SELECT id FROM Customers WHERE id = 200006), 7234567.22),
((SELECT id FROM Customers WHERE id = 200007), 2534467.02),
((SELECT id FROM Customers WHERE id = 200008), 105245.00),
((SELECT id FROM Customers WHERE id = 200009), 4569204.50),
((SELECT id FROM Customers WHERE id = 200010), 905245.00);

-- Initial Asset Creation.
INSERT INTO Asset (Name, Description, Radius, Mass, ApMag, Create_Date)
VALUES
('Ganymede', 'AKA Jupiter III', 2634.13, 148.22, 0.326, '3010-01-01'),
('Titan', 'AKA Saturn VI', 2574.73, 134.50, 2.375, '3010-01-01'),
('Calisto', 'AKA Jupiter IV', 2410.30, 107.62, 1.032, '3010-01-01'),
('Io', 'AKA Jupiter I', 1821.61, 89.32, -1.022, '3010-01-01'),
('Luna', 'AKA Earth I', 1737.51, 73.46, 22.477, '3010-01-01'),
('Europa', 'AKA Jupitor II', 1560.85, 48.03, 2.239, '3010-01-01'),
('Triton', 'AKA Neptune I', 1353.89, 21.39, 0.425, '3010-01-01'),
('Eris', 'MPD 136199', 1163.66, 16.62, 3.370, '3010-01-01'),
('Haumea', 'MPD 136108', 798.63, 4.01, -2.599, '3010-01-01'),
('Titania', 'AKA Uranus III', 788.91, 3.46, 1.022, '3010-01-01'),
('Rhea', 'AKA Saturn V', 763.81, 2.31, 0.271, '3010-01-01'),
('Oberon', 'AKA Uranus IV', 761.42, 3.08, -1.476, '3010-01-01'),
('Iapetus', 'AKA Saturn VIII', 735.65, 1.81, -2.943, '3010-01-01'),
('MakeMake', 'MPD 136472', 715.19, 3.10, 2.306, '3010-01-01'),
('Gonggong', 'MPD 225088', 615.25, 1.75, 1.252, '3010-01-01'),
('Charon', 'AKA Pluto I', 606.05, 1.59, -3.757, '3010-01-01'),
('Umbriel', 'AKA Uranus II', 584.72, 1.28, -5.471, '3010-01-01'),
('Ariel', 'AKA Uranus I', 578.06, 1.25, -0.589, '3010-01-01'),
('Dione', 'AKA Saturn IV', 561.72, 1.09, 2.301, '3010-01-01'),
('Quaoar', 'MPD 50000', 560.5, 1.42, 1.054, '3010-01-01'),
('Tethys', 'AKA Saturn III', 533.71, 0.62, 2.030, '3010-01-01'),
('Sedna', 'MPD 90377', 498.40, 0.42, -15.035, '3010-01-01'),
('Ceres', 'MPD 1', 469.71, 0.94, -4.584, '3010-01-01'),
('Orcus', 'MPD 90482', 458.13, 0.61, 2.253, '3010-01-01'),
('Salacia', 'MPD 120347', 423.11, 0.49, -3.943, '3010-01-01'),
('Varda', 'MPD 174567', 373.80, 2.50, -2.934, '3010-01-01'),
('Dysnomia', 'AKA Eris I', 350.58, 0.54, -1.568, '3010-01-01'),
('Varuna', 'MPD 20000', 334.77, 1.60, 1.346, '3010-01-01'),
('G!kunll''homdima', 'MPD 229762', 321.14, 1.36, -4.647, '3010-01-01'),
('Ixion', 'MPD 28973', 308.50, 0.95, -3.825, '3010-01-01'),
('Chaos', 'MPD 19521', 300.65, 0.58, -20.303, '3010-01-01'),
('Vesta', 'MPD 4', 262.71, 2.59, -8.479, '3010-01-01'),
('Pallas', 'MPD 2, Pallas Station', 256.32, 2.04, 1.370, '3010-01-01'),
('Enceladus', 'AKA Saturn II', 252.21, 1.08, -2.230, '3010-01-01'),
('Miranda', 'AKA Uranus V', 235.87, 0.66, -2.025, '3010-01-01'),
('Dziewanna', 'MPD 471143, SDO', 235.18, 0.63, 1.455, '3010-01-01'),
('Vanth', 'AKA Orcus I', 221.35, 0.70, 2.310, '3010-01-01'),
('Hygiea', 'MPD 10, Belt Asteroid, type C', 217.70, 0.83, -2.462, '3010-01-01'),
('Proteus', 'AKA Neptune VIII', 210.71, 0.44, -5.405, '3010-01-01'),
('Huya', 'MPD 38628, Plutino, Binary, ', 203.80, 0.49, -16.575, '3010-01-01'),
('Mimas', 'AKA Saturn I', 198.25, 3.75, -2.435, '3010-01-01'),
('Nereid', 'AKA Neptune II', 170.25, 5.35, -22.304, '3010-01-01'),
('Interamnia', 'MPD 704, Belt Asteroid, type F', 166.32, 38.13, -3.340, '3010-01-01'),
('Ilmare', 'AKA Varda I', 163.31, 3.81, -3.443, '3010-01-01'),
('Hi''iaka', 'AKA Haumea I', 160.20, 1.79, -19.488, '3010-01-01'),
('Europa A', 'MPD 52, Belt Asteroid, type C', 152.18, 2.38, 0.000, '3010-01-01'),
('Davida', 'MPD 511, Belt Asteroid, type C', 145.21, 3.38, -10.639, '3010-01-01'),
('Sylvia', 'MPD 87, OBA, type X', 143.55, 1.48, 1.042, '3010-01-01'),
('Actaea', 'AKA Salacia I', 143.12, 0.58, -16.843, '3010-01-01'),
('Hyperion', 'AKA Saturn VII', 135.40, 0.56, -12.409, '3010-01-01');

-- Compound Queries for all tables population of the 50 MoonBuyers Assets to account owner RigidBody Tech LLC.
LOCK TABLES Ledger WRITE, Contract WRITE, Contract_Asset WRITE, Contract_Customers WRITE, Asset WRITE;

-- Ganymede.
INSERT INTO Ledger(date_time) VALUES ('3011-10-21 11:12:13');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500000,
	396400,
	396401,
	'3011-10-21 11:12:13',
	11750.00,
	1235.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500000;

-- Titan.
INSERT INTO Ledger(date_time) VALUES ('3011-09-01 12:13:14');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500001,
	396400,
	396401,
	'3011-09-01 12:13:14',
	13680.00,
	1370.50,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500001;

-- Calisto.
INSERT INTO Ledger(date_time) VALUES ('3011-07-05 08:21:31');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500002,
	396400,
	396401,
	'3011-07-05 08:21:31',
	17525.00,
	1753.99,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500002;

-- Io.
INSERT INTO Ledger(date_time) VALUES ('3011-08-15 12:10:09');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500003,
	396400,
	396401,
	'3011-08-15 12:10:09',
	75100.35,
	7500.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500003;

-- Luna.
INSERT INTO Ledger(date_time) VALUES ('3011-08-09 11:09:07');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500004,
	396400,
	396401,
	'3011-08-09 11:09:07',
	55000.00,
	5100.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500004;

-- Europa.
INSERT INTO Ledger(date_time) VALUES ('3011-12-12 12:09:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500005,
	396400,
	396401,
	'3011-12-12 12:09:06',
	8510.00,
	890.50,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500005;

-- Triton.
INSERT INTO Ledger(date_time) VALUES ('3011-06-06 18:15:12');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500006,
	396400,
	396401,
	'3011-06-06 18:15:12',
	7501.05,
	7100.10,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500006;

-- Eris
INSERT INTO Ledger(date_time) VALUES ('3011-09-02 11:01:02');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500007,
	396400,
	396401,
	'3011-09-02 11:01:02',
	8850.00,
	8180.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500007;

-- Haumea.
INSERT INTO Ledger(date_time) VALUES ('3011-10-10 10:09:08');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500008,
	396400,
	396401,
	'3011-10-10 10:09:08',
	30000.00,
	2200.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500008;

-- Titania.
INSERT INTO Ledger(date_time) VALUES ('3011-07-08 07:30:33');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500009,
	396400,
	396401,
	'3011-07-08 07:30:33',
	44500.00,
	4225.50,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500009;

-- Rhea.
INSERT INTO Ledger(date_time) VALUES ('3011-03-03 11:03:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500010,
	396400,
	396401,
	'3011-03-03 11:03:06',
	15000.00,
	1250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500010;

-- Oberon.
INSERT INTO Ledger(date_time) VALUES ('3011-05-09 10:32:36');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500011,
	396400,
	396401,
	'3011-05-09 10:32:36',
	2300.00,
	223.40,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500011;

-- Iapetus.
INSERT INTO Ledger(date_time) VALUES ('3011-08-01 09:13:46');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500012,
	396400,
	396401,
	'3011-08-01 09:13:46',
	7510.00,
	750.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500012;

-- MakeMake.
INSERT INTO Ledger(date_time) VALUES ('3011-02-02 10:33:56');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500013,
	396400,
	396401,
	'3011-02-02 10:33:56',
	3545.00,
	550.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500013;

-- Gonggong.
INSERT INTO Ledger(date_time) VALUES ('3011-01-02 21:23:26');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500014,
	396400,
	396401,
	'3011-01-02 21:23:26',
	3700.00,
	350.10,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500014;

-- Charon.
INSERT INTO Ledger(date_time) VALUES ('3011-05-08 01:43:44');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500015,
	396400,
	396401,
	'3011-05-08 01:43:44',
	12500.00,
	1250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500015;

-- Umbriel.
INSERT INTO Ledger(date_time) VALUES ('3011-04-18 10:45:56');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500016,
	396400,
	396401,
	'3011-04-18 10:45:56',
	8345.00,
	830.74,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500016;

-- Ariel.
INSERT INTO Ledger(date_time) VALUES ('3011-12-13 10:13:47');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500017,
	396400,
	396401,
	'3011-12-13 10:13:47',
	21450.00,
	2150.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500017;

-- Dione.
INSERT INTO Ledger(date_time) VALUES ('3011-06-06 11:06:46');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500018,
	396400,
	396401,
	'3011-06-06 11:06:46',
	6500.00,
	650.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500018;

-- Quaoar.
INSERT INTO Ledger(date_time) VALUES ('3011-05-05 15:53:56');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500019,
	396400,
	396401,
	'3011-05-05 15:53:56',
	2765.00,
	325.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500019;

-- Tethys.
INSERT INTO Ledger(date_time) VALUES ('3011-02-23 21:23:56');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500020,
	396400,
	396401,
	'3011-02-23 21:23:56',
	12000.00,
	1230.50,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500020;

-- Sedna.
INSERT INTO Ledger(date_time) VALUES ('3011-04-04 14:43:46');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500021,
	396400,
	396401,
	'3011-04-04 14:43:46',
	18550.00,
	1550.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500021;

-- Ceres.
INSERT INTO Ledger(date_time) VALUES ('3011-05-15 15:33:22');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500022,
	396400,
	396401,
	'3011-05-15 15:33:22',
	65000.00,
	6250.99,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500022;

-- Orcus.
INSERT INTO Ledger(date_time) VALUES ('3011-09-13 19:09:39');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500023,
	396400,
	396401,
	'3011-09-13 19:09:39',
	4900.00,
	420.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500023;

-- Salacia.
INSERT INTO Ledger(date_time) VALUES ('3011-05-08 18:38:08');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500024,
	396400,
	396401,
	'3011-05-08 18:38:08',
	2485.00,
	250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500024;

-- Varda.
INSERT INTO Ledger(date_time) VALUES ('3011-01-25 12:23:22');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500025,
	396400,
	396401,
	'3011-01-25 12:23:22',
	7800.00,
	720.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500025;

-- Dysnomia.
INSERT INTO Ledger(date_time) VALUES ('3011-11-13 14:13:16');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500026,
	396400,
	396401,
	'3011-11-13 14:13:16',
	4500.00,
	250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500026;

-- Varuna.
INSERT INTO Ledger(date_time) VALUES ('3011-03-03 11:03:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500027,
	396400,
	396401,
	'3011-03-03 11:03:06',
	8100.00,
	850.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500027;

-- 'G!kunll'homdima.
INSERT INTO Ledger(date_time) VALUES ('3011-10-10 15:10:12');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500028,
	396400,
	396401,
	'3011-10-10 15:10:12',
	5500.00,
	550.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500028;

-- Ixion.
INSERT INTO Ledger(date_time) VALUES ('3011-08-08 18:38:39');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500029,
	396400,
	396401,
	'3011-08-08 18:38:39',
	14500.00,
	1250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500029;

-- Chaos.
INSERT INTO Ledger(date_time) VALUES ('3011-05-05 15:53:56');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500030,
	396400,
	396401,
	'3011-05-05 15:53:56',
	2450.00,
	250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500030;

-- Vesta.
INSERT INTO Ledger(date_time) VALUES ('3011-05-05 15:23:16');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500031,
	396400,
	396401,
	'3011-05-05 15:23:16',
	3585.00,
	350.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500031;

-- Pallas.
INSERT INTO Ledger(date_time) VALUES ('3011-04-23 12:23:26');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500032,
	396400,
	396401,
	'3011-04-23 12:23:26',
	25000.00,
	2000.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500032;

-- Enceladus.
INSERT INTO Ledger(date_time) VALUES ('3011-05-30 14:43:46');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500033,
	396400,
	396401,
	'3011-05-30 14:43:46',
	95000.00,
	9150.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500033;

-- Miranda.
INSERT INTO Ledger(date_time) VALUES ('3011-12-13 14:53:46');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500034,
	396400,
	396401,
	'3011-12-13 14:53:46',
	35900.00,
	3250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500034;

-- Dziewanna.
INSERT INTO Ledger(date_time) VALUES ('3011-07-17 17:37:27');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500035,
	396400,
	396401,
	'3011-07-17 17:37:27',
	3650.00,
	350.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500035;

-- Vanth.
INSERT INTO Ledger(date_time) VALUES ('3011-02-03 14:43:36');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500036,
	396400,
	396401,
	'3011-02-03 14:43:36',
	5000.00,
	550.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500036;

-- Hygiea.
INSERT INTO Ledger(date_time) VALUES ('3011-05-08 13:33:45');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500037,
	396400,
	396401,
	'3011-05-08 13:33:45',
	2800.00,
	285.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500037;

-- Proteus.
INSERT INTO Ledger(date_time) VALUES ('3011-06-23 14:43:18');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500038,
	396400,
	396401,
	'3011-06-23 14:43:18',
	7000.00,
	750.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500038;

-- Huya.
INSERT INTO Ledger(date_time) VALUES ('3011-10-23 10:23:26');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500039,
	396400,
	396401,
	'3011-10-23 10:23:26',
	850.00,
	85.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500039;

-- Mimas.
INSERT INTO Ledger(date_time) VALUES ('3011-06-23 08:45:00');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500040,
	396400,
	396401,
	'3011-06-23 08:45:00',
	15000.00,
	1250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500040;

-- Nereid.
INSERT INTO Ledger(date_time) VALUES ('3011-05-17 15:34:08');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500041,
	396400,
	396401,
	'3011-05-17 15:34:08',
	900.00,
	950.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500041;

-- Interamnia.
INSERT INTO Ledger(date_time) VALUES ('3011-05-25 17:10:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500042,
	396400,
	396401,
	'3011-05-25 17:10:06',
	2600.00,
	265.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500042;

-- Ilmare.
INSERT INTO Ledger(date_time) VALUES ('3011-05-28 14:43:55');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500043,
	396400,
	396401,
	'3011-05-28 14:43:55',
	1685.00,
	250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500043;

-- Hi'iaka.
INSERT INTO Ledger(date_time) VALUES ('3011-11-20 14:43:16');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500044,
	396400,
	396401,
	'3011-11-20 14:43:16',
	5750.00,
	550.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500044;

-- Europa A.
INSERT INTO Ledger(date_time) VALUES ('3011-01-09 17:08:21');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500045,
	396400,
	396401,
	'3011-01-09 17:08:21',
	500.00,
	150.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500045;

-- Davida.
INSERT INTO Ledger(date_time) VALUES ('3011-12-01 11:13:47');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500046,
	396400,
	396401,
	'3011-12-01 11:13:47',
	11500.00,
	875.10,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500046;

-- Sylvia.
INSERT INTO Ledger(date_time) VALUES ('3011-12-03 13:33:36');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500047,
	396400,
	396401,
	'3011-12-03 13:33:36',
	9000.00,
	750.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500047;

-- Actaea.
INSERT INTO Ledger(date_time) VALUES ('3011-10-10 11:54:52');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500048,
	396400,
	396401,
	'3011-10-10 11:54:52',
	1250.00,
	250.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500048;

-- Hyperion.
INSERT INTO Ledger(date_time) VALUES ('3011-02-28 11:03:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500049,
	396400,
	396401,
	'3011-02-28 11:03:06',
	8900.00,
	750.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200000);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200001);
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500049;

UNLOCK TABLES;
