-- Moonbuyers Queries file MoonBuyers-queries.sql
-- ******DO NOT IMPORT THIS FILE. FOR REFERENCE ONLY.********
-- Cut and paste queries to phpMyAdmin or CL as needed for testing.

-- Select accoount details and balance for all accounts.
SELECT A.id AS Account, A.Balance, Cu.id AS 'Cust_ID', Cu.Lname, Cu.Fname, Cu.Addr_1, Cu.Addr_2, Cu.City, Cu.State, Cu.Planet, Cu.Zip, Cu.Phone 
FROM Customers Cu
INNER JOIN Account A
ON Cu.id = A.C_ID;

-- Select account details and balance for account by account id.
SELECT A.id AS 'Account', A.Balance, Cu.id AS 'Cust_ID', Cu.Lname, Cu.Fname, Cu.Addr_1, Cu.Addr_2, Cu.City, Cu.State, Cu.Planet, Cu.Zip, Cu.Phone 
FROM Customers Cu
INNER JOIN Account A
ON Cu.id = A.C_ID
WHERE A.id = 396402;

-- Select account details and balance for account by customer id.
SELECT Cu.id, A.id AS Account, A.Balance, Cu.Lname, Cu.Fname, Cu.Addr_1, Cu.Addr_2, Cu.City, Cu.State, Cu.Planet, Cu.Zip, Cu.Phone 
FROM Customers Cu
INNER JOIN Account A
ON Cu.id = A.C_ID
WHERE Cu.id = 200004;

-- Select account details and balance for account by customer phone.
SELECT Cu.id AS Cust_ID, A.id AS 'Account #', A.Balance, Cu.Lname, Cu.Fname, Cu.Addr_1, Cu.Addr_2, Cu.City, Cu.State, Cu.Planet, Cu.Zip, Cu.Phone 
FROM Customers Cu
INNER JOIN Account A
ON Cu.id = A.C_ID
WHERE Cu.phone = 37275056243;

-- Record a Moonbuyers Transaction.
LOCK TABLES Ledger WRITE, Contract WRITE, Contract_Asset WRITE, Contract_Customers WRITE, Asset WRITE;
INSERT INTO Ledger(date_time) VALUES (NOW());
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500004,
	396402,
	396404,
	NOW(),
	17000.20,
	4500.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200002);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200004);
UPDATE Asset SET Owned_By = 396402 WHERE Asset.id = 500004;
UNLOCK TABLES;

SELECT * FROM Contract_Asset;

SELECT * FROM Contract_Customers
ORDER BY Contract_ID, Customer_ID;

SELECT * FROM Asset
ORDER BY Asset.id DESC;

-- Who owns an Asset?
SELECT AST.id, CA.Contract_ID, CO.Trans_at AS 'Value', CO.B_Acct_ID, CO.Eff_Date, CU.Lname, CU.Fname FROM Asset AST
INNER JOIN Contract_Asset CA ON CA.Asset_ID = AST.id
INNER JOIN Contract CO ON CO.id = CA.Contract_ID
INNER JOIN Contract_Customers CC ON CC.Contract_ID = CO.id
INNER JOIN Customers CU ON CU.id = CC.Customer_ID
WHERE AST.id = 500004
ORDER BY CO.Eff_Date DESC LIMIT 1

-- Asset details by Account?
SELECT * FROM Asset
WHERE Owned_By = 396402
ORDER BY Asset.id DESC;

-- Total Transactions and Commisions Paid by DateTime
SELECT SUM(Trans_at) AS 'Contracted', SUM(Com_pd) AS 'Total Commissions' FROM Contract
WHERE Eff_Date > '3010-01-01 00:00:00' AND Eff_Date < '3021-07-21 00:00:00';

-- Add New Customer and Account.
LOCK TABLES Customers WRITE, Account WRITE;
INSERT INTO Customers (Lname, Fname, Addr_1, Addr_2, City, State, Planet, Zip, Phone)
VALUES
('LLC', 'Gasperia', '3 Biodome L', 'Lower Level 13', 'Venus 12', 'VS', 'Venus', 12323019, 221242753481);
SET @last_id_in_Customers = LAST_INSERT_ID();
INSERT INTO Account (C_ID, Balance)
VALUES
(@last_id_in_Customers, 995245);
UNLOCK TABLES;

-- Add New Asset.
INSERT INTO Asset (Name, Description, Radius, Mass,	ApMag, Create_Date, Owned_By)
VALUES
('Himalia', 'AKA Jupitor VI', 85.01, 4.26, -15.584, '3021-07-20 13:39:39', 369400);

-- Update Customers Account Details.
-- Was ('Corp.', 'Paralaxix', 'B-Ring', 'Apogee Point 54', 'Orbital H', 'SA', 'Saturn', 505433, 549256547783)
UPDATE Customers
SET Lname = 'LLC',
Fname = 'Paralax',
Addr_1 = 'C-Ring',
Addr_2 = 'Apogee Point 54',
City = 'Orbital I',
State = 'SA',
Zip = 505434,
Phone = 549256547784
WHERE Customers.id = 200004;

-- Record a Moonbuyers Transaction with full balance adjustments.
LOCK TABLES Ledger WRITE, Contract WRITE, Contract_Asset WRITE, Contract_Customers WRITE, Asset WRITE, Account WRITE;
INSERT INTO Ledger(date_time) VALUES (NOW());
SET @last_id_in_Ledger = LAST_INSERT_ID();
INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
	VALUES(
	500008,
	396405,
	396407,
	'3021-07-20 14:09:20',
	51000.69,
	5100.00,
	@last_id_in_Ledger
);
SET @last_id_in_Contract = LAST_INSERT_ID();
INSERT INTO Contract_Asset VALUES(
	@last_id_in_Contract,
	(SELECT Asset_ID FROM Contract WHERE id = @last_id_in_Contract)); 
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200005);
INSERT INTO Contract_Customers VALUES(
	@last_id_in_Contract,
	200007);
UPDATE Asset SET Owned_By = 396405 WHERE Asset.id = 500008;
UPDATE Account SET Balance = Balance - (51000.69 + 5100.00/2) WHERE id = 396405;
UPDATE Account SET Balance = Balance + (51000.69 - 5100.00/2) WHERE id = 396407;
UNLOCK TABLES;

-- General Ledger query.
SELECT L.id, L.date_time, CO.id, CO.Asset_ID, CO.Trans_at, CO.Com_pd, AST.Description, AST.Owned_By FROM Ledger L
INNER JOIN Contract CO ON CO.L_ID = L.id
INNER JOIN Contract_Asset CA ON CA.Contract_ID = CO.id
INNER JOIN Asset AST ON AST.id = CA.Asset_ID
ORDER BY L.id ASC;

-- Show Asset ID Ownership history, aka Ownership chain.
SELECT L.id, L.date_time, CO.id as ID, CO.Asset_ID, CO.Trans_at, CO.Com_pd, AST.Description, AST.Owned_By
FROM Ledger L
INNER JOIN Contract CO ON CO.L_ID = L.id
INNER JOIN Contract_Asset CA ON CA.Contract_ID = CO.id
INNER JOIN Asset AST ON AST.id = CA.Asset_ID
WHERE CO.Asset_ID = 500004
ORDER BY L.id ASC
