<?php

class db{
    private $_db_host = "localhost";
    private $_db_user = "ShopSite";
    private $_db_pass = "dzOz(Q0uogT/H1zX";
    private $_db_name = "shopsite";

    private $dbKeyObject;


    public function __construct(){
        $this->dbKeyObject = new mysqli($this->{"_db_host"}, $this->{"_db_user"}, $this->{"_db_pass"}, $this->{"_db_name"});

        if($this->dbKeyObject->connect_error){
            die('Error: Keine Verbindung zur Datenbank!'. $this->dbKeyObject->connect_error);
        }

        $this->dbKeyObject->query("SET NAMES 'utf8'");
    }

    public function __destruct(){
        $this->dbKeyObject->close();
    }

    public function createBasicDatabaseStructure(){
        $sqlStatements = array(
            "CREATE TABLE IF NOT EXISTS USERS(
                UserID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                UserName varchar(100) NOT NULL,
                Passwort varchar(255) NOT NULL,
                Email varchar(255) NOT NULL,
                Vorname varchar(255) NOT NULL,
                Nachname varchar(255) NOT NULL,
                Strasse varchar(255) NOT NULL,
                Stadt varchar(100) NOT NULL,
                PLZ int(5) NOT NULL,
                IBAN varchar(24) NOT NULL,
                BIC varchar(13) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS Categories(
                CategoryID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                Title varchar(255) NOT NULL,
                Content varchar(2500) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS Manufacturers(
                ManufacturerID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                FirmName varchar(255) NOT NULL,
                Content varchar(2500) NOT NULL, 
                Email varchar(255) NOT NULL,
                TelNumber varchar(255) NOT NULL,
                Strasse varchar(255) NOT NULL,
                Stadt varchar(100) NOT NULL,
                PLZ int(5) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS Items(
                ItemID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                Title varchar(255) NOT NULL,
                Content varchar(2500) NOT NULL,
                Price int NOT NULL,
                Picture varchar(255) NOT NULL,
                CategoryID int NOT NULL,
                ManufacturerID int NOT NULL,
                FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID),
                FOREIGN KEY (ManufacturerID) REFERENCES Manufacturers(ManufacturerID)
            )",
            "CREATE TABLE IF NOT EXISTS Carts(
                ItemID int NOT NULL,
                UserID int NOT NULL,
                Count int NOT NULL,
                FOREIGN KEY (UserID) REFERENCES USERS(UserID),
                FOREIGN KEY (ItemID) REFERENCES ITEMS(ItemID)
            )",
            "CREATE TABLE IF NOT EXISTS Orders(
                OrderID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                OrderDate date NOT NULL,
                Arrived boolean NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS OrderUserConnections(
                OrderID int NOT NULL,
                UserID int NOT NULL,
                FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
                FOREIGN KEY (UserID) REFERENCES users(UserID)
            )",
            "CREATE TABLE IF NOT EXISTS OrderItemConnections(
                OrderID int NOT NULL,
                ItemID int NOT NULL,
                Count int NOT NULL,
                FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
                FOREIGN KEY (ItemID) REFERENCES Items(ItemID)
            )"
        );

        for($i = 0; $i < count($sqlStatements); $i++){
            $this->dbKeyObject->query($sqlStatements[$i]);
        }
    }

    public function delEverything(){
        $sqlStatements = array(
            "DROP TABLE IF EXISTS OrderItemConnections",
            "DROP TABLE IF EXISTS OrderUserConnections",
            "DROP TABLE IF EXISTS Carts",
            "DROP TABLE IF EXISTS USERS",
            "DROP TABLE IF EXISTS Orders",
            "DROP TABLE IF EXISTS Items",
            "DROP TABLE IF EXISTS Categories",
            "DROP TABLE IF EXISTS Manufacturers"
        );

        for($i = 0; $i < count($sqlStatements); $i++){
            $this->dbKeyObject->query($sqlStatements[$i]);
        }
    }

    public function exampleData(){
        $sqlStatements = array(

        );

        for($i = 0; $i < count($sqlStatements); $i++){
            $this->dbKeyObject->query($sqlStatements[$i]);
        }
    }

}

?>
