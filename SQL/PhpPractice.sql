CREATE DATABASE practice;
USE practice;

CREATE TABLE Person (
    PersonID int Not Null Primary Key auto_increment,
    FirstName varchar(255),
	MiddleName varchar(255),
	LastName varchar(255),
	Suffix varchar(255),
	Region varchar(255),
	City varchar(255),
	Barangay varchar(255),
	Subdivision varchar(255),
	StreetName varchar(255),
	HouseNo varchar(255) ,
	ContactNo varchar(255) ,
	Gender varchar(255),
	Birthday date ,
	SSS varchar(255) ,
	PagIbig varchar(255) ,
	BirthCertificate varchar(255) , 
	GSIS varchar(255) ,
	PhilHealth varchar(255)
);

CREATE TABLE AdminAccount (
    AdminAccountID int Not Null Primary Key auto_increment,
    PersonID int ,
    Foreign Key(PersonID) REFERENCES Person(PersonID) ,
    Username varchar(255),
    Password varchar(255)
);

CREATE TABLE AdminTransactionLogs (
    AdminAccountID int ,
    Foreign Key (AdminAccountID) REFERENCES AdminAccount(AdminAccountID),
    TransactionLog varchar(255),
    TransactionDate date
);

CREATE TABLE InventoryTransactionLogs (
    AdminAccountID int ,
    Foreign Key (AdminAccountID) REFERENCES AdminAccount(AdminAccountID),
    TransactionLog varchar(255),
    TransactionDate date
);

CREATE TABLE Inventory (
    InventoryID int Not Null Primary Key auto_increment,
    ItemName varchar(255),
    ItemQuantity int
);