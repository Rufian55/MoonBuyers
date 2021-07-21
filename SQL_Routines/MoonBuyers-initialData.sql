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

INSERT INTO Asset (Description, Carrot, Cut, Clarity, Color, Create_Date)
VALUES
('Diamond', 2.75, 'Princess', 'FL', 'D', '2016-07-05 23:59:59'),
('Diamond', 3.24, 'Oval', 'VV2', 'G', '2015-06-05 17:14:42'),
('Diamond', 2.05, 'Round', 'VV1', 'F', '2014-02-06 13:55:22'),
('Diamond', 1.75, 'Marquis', 'VV2', 'H', '2016-07-05 18:46:45'),
('Diamond', 2.125, 'Cushion', 'I', 'J', '2012-04-05 14:49:18'),
('Diamond', 4.575, 'Pear', 'VV1', 'E', '2013-11-15 09:33:44'),
('Diamond', 1.25, 'Radiant', 'VV1', 'G', '2014-07-05 10:22:17'),
('Diamond', 3.125, 'Asscher', 'VV2', 'H', '2012-12-05 11:14:52'),
('Diamond', 2.50, 'Heart', 'V1', 'F', '2011-06-05 17:22:40'),
('Diamond', 5.675, 'Emerald', 'FL', 'D', '2014-04-05 15:33:20'),
('Diamond', 1.268, 'Round', 'VV2', 'G', '2015-07-05 08:44:11');

-- Initial Creation of the 11 Diamond Assets where account owner = Diamond Buyers Inc.
LOCK TABLES Ledger WRITE, Contract WRITE, Contract_Asset WRITE, Contract_Customers WRITE, Asset WRITE;

INSERT INTO Ledger(date_time) VALUES ('2011-10-21 11:12:13');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500000,
	396400,
	396401,
	'2011-10-21 11:12:13',
	1750.00,
	25.00,
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

INSERT INTO Ledger(date_time) VALUES ('2011-09-01 12:13:14');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500001,
	396400,
	396401,
	'2011-09-01 12:13:14',
	13680.00,
	130.00,
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

INSERT INTO Ledger(date_time) VALUES ('2011-07-05 08:21:31');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500002,
	396400,
	396401,
	'2011-07-05 08:21:31',
	17525.00,
	175.99,
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

INSERT INTO Ledger(date_time) VALUES ('2011-08-15 12:10:09');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500003,
	396400,
	396401,
	'2011-08-15 12:10:09',
	75100.35,
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
UPDATE Asset SET Owned_By = 396400 WHERE Asset.id = 500003;

INSERT INTO Ledger(date_time) VALUES ('2011-08-09 11:09:07');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500004,
	396400,
	396401,
	'2011-08-09 11:09:07',
	55000.00,
	1000.00,
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

INSERT INTO Ledger(date_time) VALUES ('2011-12-12 12:09:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500005,
	396400,
	396401,
	'2011-12-12 12:09:06',
	8510.00,
	90.50,
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

INSERT INTO Ledger(date_time) VALUES ('2011-06-06 18:15:12');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500006,
	396400,
	396401,
	'2011-06-06 18:15:12',
	7501.05,
	100.10,
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

INSERT INTO Ledger(date_time) VALUES ('2011-09-02 11:01:02');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500007,
	396400,
	396401,
	'2011-09-02 11:01:02',
	8850.00,
	180.00,
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

INSERT INTO Ledger(date_time) VALUES ('2011-10-10 10:09:08');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500008,
	396400,
	396401,
	'2011-10-10 10:09:08',
	30000.00,
	1200.00,
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

INSERT INTO Ledger(date_time) VALUES ('2011-07-08 07:30:33');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500009,
	396400,
	396401,
	'2011-07-08 07:30:33',
	4500.00,
	225.00,
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

INSERT INTO Ledger(date_time) VALUES ('2011-03-03 11:03:06');
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500010,
	396400,
	396401,
	'2011-03-03 11:03:06',
	55000.00,
	2250.00,
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

UNLOCK TABLES;