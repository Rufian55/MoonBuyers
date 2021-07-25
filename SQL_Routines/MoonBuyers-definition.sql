-- MoonBuyers SQL Definition file MoonBuyers-definition.sql
-- CAUTION - running or importing this file with queries in CAUTION block will cause all existing data to be lost.

-- ********** CAUTION!!! ******************
 SET foreign_key_checks = 0;
 DROP TABLE IF EXISTS Customers;
 DROP TABLE IF EXISTS Account;
 DROP TABLE IF EXISTS Asset;
 DROP TABLE IF EXISTS Contract;
 DROP TABLE IF EXISTS Ledger;
 DROP TABLE IF EXISTS Contract_Customers;
 DROP TABLE IF EXISTS Contract_Asset;
 SET foreign_key_checks = 1;
-- ****************************************


-- Table "Customers" has the following properties:
-- id		Auto incrementing integer which is the primary key and starts at 200000.
-- Lname	Customer's last name, not null, 30 characters max.
-- Fname	Customer's first name, not null, 30 characters max.
-- Addr_1	Customer's address line 1, not null, 30 characters max.
-- Addr_2	Customer's address line 2, 30 characters max.
-- City		Customer's City, not null, 25 characters max.
-- State	Customer's State, not null, 2 characters max.
-- Planet	Customer's Planet, not null, 25 charcaters max.
-- Zip		Customer's zip code, not null.
-- Phone	Customer's phone number, not null.

CREATE TABLE Customers (
	id INT AUTO_INCREMENT PRIMARY KEY,
	Lname VARCHAR(30) NOT NULL,
	Fname VARCHAR(30) NOT NULL,
	Addr_1 VARCHAR(30) NOT NULL,
	Addr_2 VARCHAR(30),
	City VARCHAR(25) NOT NULL,
	State VARCHAR(2) NOT NULL,
	Planet VARCHAR(25) NOT NULL,
	Zip INT UNSIGNED NOT NULL,
	Phone BIGINT UNSIGNED NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT = 200000;


-- Table "Account" has the following properties:
-- id		Auto incrementing integer which is the primary key and starts (arbitrarily) at 396400.
-- C_ID		Customer ID, int, not null, references Customer(id).
-- Balance	Customer's account balance, not null, a 2 decimal place 10 digit decimal.

CREATE TABLE Account (
	id INT AUTO_INCREMENT PRIMARY KEY,
	C_ID INT NOT NULL,
	Balance DECIMAL(10,2) NOT NULL,
	INDEX Customer_Account_index(C_ID),
	FOREIGN KEY(C_ID) REFERENCES Customers(id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB AUTO_INCREMENT = 396400;


-- Table "Asset" has the following properties:
-- id			Auto incrementing integer which is the primary key and starts (arbitrarily) at 500,000.
-- Name			Celestial body name.
-- Description	Description of the asset.
-- Radius		Kilometers.
-- Mass 		10^21 Kilos.
-- ApMag 		Apperent Magnitude from Earth Observer range [-30 to +30].
-- Create_Date	Date and time the asset was entered into the "Asset" table.
-- Owned_By 	Account number of owner.

CREATE TABLE Asset (
	id BIGINT AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(25) NOT NULL,
	Description VARCHAR(255) NOT NULL,
	Radius DECIMAL(10,2) NOT NULL,
	Mass DECIMAL(10,2) NOT NULL,
	ApMag DECIMAL(5,3) NOT NULL,
	Create_Date DATE NOT NULL,
	Owned_By INT
)ENGINE=InnoDB AUTO_INCREMENT = 500000;


-- Table "ledger" has the following properties:
-- id			Auto incrementing integer which is the primary key and starts (arbitrarily) at 1,000.
-- date_time	Date and time of the ledger entry, not null.

CREATE TABLE Ledger (
	id INT AUTO_INCREMENT PRIMARY KEY,
	date_time DATE NOT NULL
)ENGINE = InnoDB AUTO_INCREMENT = 1000;


-- Table "Contract" has the following properties:
-- id			Auto incrementing integer which is the primary key and starts (arbitrarily) at 12,000.
-- Asset_ID		Unsigned bigint, not null.
-- B_Acct_ID	Buyers account ID, an int, not null. (B_Acct_ID != S_Acct_ID) [Citation 1, 2]
-- S_Acct_ID	Sellers account ID, an int, not null. (S_Acct_ID != B_Acct_ID)
-- Eff_Date		Date and time the contract was consumated or modified.
-- Trans_at		Dollar amount of the transaction, not null, a 2 decimal place decimal. [Citation 3]
-- Com_pd		Total commision paid by buyer and seller, not null, a 2 decimal place decimal.
-- L_ID			Ledger ID, int, not null, references Ledger(id).

CREATE TABLE Contract(
	id INT AUTO_INCREMENT PRIMARY KEY,
	Asset_ID BIGINT UNSIGNED NOT NULL,
	B_Acct_ID INT UNSIGNED NOT NULL, 
	S_Acct_ID INT UNSIGNED NOT NULL,
	Eff_Date DATE NOT NULL,
	Trans_at DECIMAL(13,2) UNSIGNED NOT NULL,
	Com_pd DECIMAL(12,2) UNSIGNED NOT NULL,
	L_ID INT NOT NULL,
	FOREIGN KEY (L_ID) REFERENCES Ledger(id)
		ON DELETE CASCADE ON UPDATE CASCADE 
)ENGINE=InnoDB AUTO_INCREMENT = 12000;


-- Junction Table 'Contract_Customers' between Contract and Customers.
CREATE TABLE Contract_Customers (
	Contract_ID INT NOT NULL,
	Customer_ID INT NOT NULL,
	PRIMARY KEY(Contract_ID, Customer_ID),
	FOREIGN KEY (Contract_ID) REFERENCES Contract(id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (Customer_ID) REFERENCES Customers(id)
		ON DELETE CASCADE ON UPDATE CASCADE
);


-- Junction Table 'Contract_Asset' between Contract and Asset.
CREATE TABLE Contract_Asset (
	Contract_ID INT NOT NULL,
	Asset_ID BIGINT NOT NULL,
	PRIMARY KEY(Contract_ID, Asset_ID),
	FOREIGN KEY (Contract_ID) REFERENCES Contract(id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (Asset_ID) REFERENCES Asset(id)
		ON DELETE CASCADE ON UPDATE CASCADE
);

-- Useful References: (applies to this file, Moonbuyers-initialData.sql, and Moonbuyers-queries.sql.
-- [1] http://stackoverflow.com/questions/2300396/force-drop-mysql-bypassing-foreign-key-constraint
-- [2] http://stackoverflow.com/questions/3837990/last-insert-id-mysql
-- [3] http://stackoverflow.com/questions/14772762/mysql-multiple-table-locks
-- [4] http://stackoverflow.com/questions/38400361/mysql-unique-constraint-failing-in-create-table-with-subsequent-insert
-- [5] http://stackoverflow.com/questions/10259504/delimiters-in-mysql
-- [6] http://stackoverflow.com/questions/4834390/how-to-use-mysql-decimal
-- [7] http://stackoverflow.com/questions/2923809/many-to-many-relationships-examples
-- [8] http://stackoverflow.com/questions/12402422/how-to-store-a-one-to-many-relation-in-my-sql-database-mysql
-- [9] http://dba.stackexchange.com/questions/81604/how-to-insert-values-in-junction-table-for-many-to-many-relationships
-- [10] http://stackoverflow.com/questions/3837990/last-insert-id-mysql
-- [11] http://stackoverflow.com/questions/21659691/error-1452-cannot-add-or-update-a-child-row-a-foreign-key-constraint-fails
-- [12] http://stackoverflow.com/questions/5383108/update-a-column-by-subtracting-a-value