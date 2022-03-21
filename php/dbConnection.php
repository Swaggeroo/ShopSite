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
            "CREATE TABLE IF NOT EXISTS Users(
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
            ) ENGINE = INNODB",
            "CREATE TABLE IF NOT EXISTS Categories(
                CategoryID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                Title varchar(255) NOT NULL,
                Content varchar(2500) NOT NULL
            ) ENGINE = INNODB",
            "CREATE TABLE IF NOT EXISTS Manufacturers(
                ManufacturerID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                FirmName varchar(255) NOT NULL,
                Content varchar(2500) NOT NULL, 
                Email varchar(255) NOT NULL,
                TelNumber varchar(255) NOT NULL,
                Strasse varchar(255) NOT NULL,
                Stadt varchar(100) NOT NULL,
                PLZ int(5) NOT NULL
            ) ENGINE = INNODB",
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
            ) ENGINE = INNODB",
            "CREATE TABLE IF NOT EXISTS Carts(
                ItemID int NOT NULL,
                UserID int NOT NULL,
                Count int NOT NULL,
                FOREIGN KEY (UserID) REFERENCES Users(UserID),
                FOREIGN KEY (ItemID) REFERENCES Items(ItemID)
            ) ENGINE = INNODB",
            "CREATE TABLE IF NOT EXISTS Orders(
                OrderID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                OrderDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                Arrived boolean NOT NULL,
                Total int NOT NULL,
                UserID int NOT NULL,
                FOREIGN KEY (UserID) REFERENCES Users(UserID)
            ) ENGINE = INNODB",
            "CREATE TABLE IF NOT EXISTS OrderItemConnections(
                OrderID int NOT NULL,
                ItemID int NOT NULL,
                Count int NOT NULL,
                FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
                FOREIGN KEY (ItemID) REFERENCES Items(ItemID)
            ) ENGINE = INNODB"
        );

        echo "<p>Creating Tables</p>";
        for($i = 0; $i < count($sqlStatements); $i++){
            if (!$this->dbKeyObject->query($sqlStatements[$i])){
                echo("Error description: " . $this->dbKeyObject -> error);
            }
            echo "<p>(".($i+1)."/".count($sqlStatements).")</p>";
        }
    }

    public function delEverything(){
        $sqlStatements = array(
            "DROP TABLE IF EXISTS OrderItemConnections",
            "DROP TABLE IF EXISTS Carts",
            "DROP TABLE IF EXISTS Orders",
            "DROP TABLE IF EXISTS USERS",
            "DROP TABLE IF EXISTS Items",
            "DROP TABLE IF EXISTS Categories",
            "DROP TABLE IF EXISTS Manufacturers"
        );

        echo "<p>Deleting existing Tables</p>";
        for($i = 0; $i < count($sqlStatements); $i++){
            if(!$this->dbKeyObject->query($sqlStatements[$i])){
                echo("Error description: " . $this->dbKeyObject -> error);
            }
            echo "<p>(".($i+1)."/".count($sqlStatements).")</p>";
        }
    }

    public function exampleData(){
        echo "<p>Filling Tables with Data</p>";
        echo "<p>Creating Users</p>";
        $this->addUser("TestTest",
            password_hash("Test1234", PASSWORD_DEFAULT),
            "test@test.com",
            "Jürgen",
            "Peter",
            "Frankfurterstraße 659",
            "Traumhausen",
            55789,
            "DE12345678900000000000",
            "GEOOOOOOOOO"
        );
        echo "<p>User (1/2)</p>";
        $this->addUser("SuperDude",
            password_hash("Cool1234", PASSWORD_DEFAULT),
            "test@test.com",
            "Jürgen",
            "Peter",
            "Frankfurterstraße 659",
            "Traumhausen",
            55789,
            "DE12345678900000000000",
            "GEOOOOOOOOO"
        );
        echo "<p>User (2/2)</p>";


        echo "<p>Creating Verkäufer</p>";
        $manufactures = file_get_contents("../tools/manufacturer.json", true);
        $manufacturesJSONObj = json_decode($manufactures,true);

        foreach ($manufacturesJSONObj as $element){
            echo "<p>Added Verkäufer</p>";
            $this->addManufacturer($element["name"],$element["tel"],$element["email"],$element["strasse"],$element["stadt"],intval($element["plz"]),$element["beschreibung"]);
        }

        echo "<p>Creating Kategorien</p>";
        $categories = file_get_contents("../tools/categories.json", true);
        $categoriesJSONObj = json_decode($categories,true);

        foreach ($categoriesJSONObj as $element){
            echo "<p>Added Kategorie</p>";
            $this->addCategory($element["title"],$element["beschreibung"]);
        }

        echo "<p>Creating Animals</p>";
        $animals = file_get_contents("../tools/animals.json", true);
        $animalsJSONObj = json_decode($animals,true);

        foreach ($animalsJSONObj as $element){
            echo "<p>Added Animal</p>";
            $this->addAnimal($element["name"],$element["beschreibung"],intval($element["price"]),$element["pictureLink"],intval($element["CatID"]),intval($element["ManID"]));
        }

        echo "<p>Creating Example Orders</p>";
        $orderID = $this->createOrder(1,52000);
        $this->createItemOrderRefference($orderID,3,2);
        $this->createItemOrderRefference($orderID,6,2);
        $this->createItemOrderRefference($orderID,8,2);
        echo "<p>Added Order</p>";

        $orderID = $this->createOrder(1,113000);
        $this->createItemOrderRefference($orderID,2,1);
        $this->createItemOrderRefference($orderID,7,3);
        $this->createItemOrderRefference($orderID,4,2);
        echo "<p>Added Order</p>";
        $sqlStatements = array(

        );

        for($i = 0; $i < count($sqlStatements); $i++){
            $this->dbKeyObject->query($sqlStatements[$i]);
        }
    }

    public function getUserNameCount($userName):int{
        $sqlQuery = "SELECT COUNT(UserName) AS userNameCount FROM Users WHERE LOWER(userName) = LOWER(?)";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("s", $userName);
        $statement->execute();

        $result = $statement->get_result();

        $userNameCount = $result->fetch_assoc()["userNameCount"];

        $statement->close();

        return $userNameCount;
    }

    public function userNameExists($userName):bool{
        $userNameCount = $this->getUserNameCount($userName);

        if($userNameCount >= 1){
            return true;
        }else{
            return false;
        }
    }

    public function getUserIdForUsername($username):int{
        $sqlQuery = "SELECT userID FROM Users WHERE LOWER(userName) = LOWER(?)";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("s", $username);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $userID = $result->fetch_assoc()["userID"];

        $sqlStatement->close();

        return $userID;
    }

    public function getUserName($userID) {
        $sqlQuery = "SELECT userName AS userName FROM Users WHERE userID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i", $userID);
        $statement->execute();

        $result = $statement->get_result();

        $userName = $result->fetch_assoc()["userName"];

        $statement->close();

        return $userName;
    }

    public function getPasswordForUserID($userID):String{
        $sqlQuery = "SELECT Passwort FROM Users WHERE userID = ?";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("i", $userID);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $password = $result->fetch_assoc()["Passwort"];

        $sqlStatement->close();

        return $password;
    }

    public function addUser($username, $password, $email, $vorname, $nachname, $strasse, $stadt, $plz, $iban, $bic){
        $sqlQuery = "INSERT INTO Users(username, passwort, email, vorname, nachname, strasse, stadt, plz, iban, bic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("sssssssiss", $username, $password, $email, $vorname, $nachname, $strasse, $stadt, $plz, $iban, $bic);
        if(!$sqlStatement->execute()){
            die("Error: ".$sqlStatement->error);
        }

        $sqlStatement->close();
    }

    public function addManufacturer($name, $telnum, $email, $strasse, $stadt, $plz, $beschreibung){
        $sqlQuery = "INSERT INTO Manufacturers (FirmName, Content, Email, TelNumber, Strasse, Stadt, PLZ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("ssssssi", $name, $beschreibung, $email, $telnum, $strasse, $stadt, $plz);
        if(!$sqlStatement->execute()){
            die("Error: ".$sqlStatement->error);
        }

        $sqlStatement->close();
    }

    public function addCategory($name, $beschreibung){
        $sqlQuery = "INSERT INTO Categories (Title, Content) VALUES (?, ?)";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("ss", $name, $beschreibung);
        if(!$sqlStatement->execute()){
            die("Error: ".$sqlStatement->error);
        }

        $sqlStatement->close();
    }

    public function addAnimal($title, $beschreibung, $price, $picture, $categoryid, $manufacturerid){
        $sqlQuery = "INSERT INTO Items (Title, Content, Price, Picture, CategoryID, ManufacturerID) VALUES (?, ?, ?, ?, ?, ?)";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("ssisii", $title, $beschreibung, $price, $picture, $categoryid, $manufacturerid);
        if(!$sqlStatement->execute()){
            die("Error: ".$sqlStatement->error);
        }

        $sqlStatement->close();
    }

    public function getAllKategorien():array{
        $sqlQuery = "SELECT * FROM Categories";

        $result = $this->dbKeyObject->query($sqlQuery);

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function getAllVerkaeufer():array{
        $sqlQuery = "SELECT * FROM Manufacturers";

        $result = $this->dbKeyObject->query($sqlQuery);

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function getAllAnimals():array{
        $sqlQuery = "SELECT * FROM Items";

        $result = $this->dbKeyObject->query($sqlQuery);

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function getAnimalBySearch($catID, $verID, $searchTerm):array{
        $sqlQuery = "SELECT * FROM Items WHERE CategoryID LIKE ? AND ManufacturerID LIKE ? AND Title LIKE ?";

        $searchTerm = "%".$searchTerm."%";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("sss", $catID,$verID, $searchTerm);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }

        if (count($rows)<=0){
            return $this->getByAdvancedSearch($catID,$verID,$searchTerm);
        }else {
            return $rows;
        }
    }

    public function getByAdvancedSearch($catID, $verID, $searchTerm):array{
        $sqlQuery = "SELECT * FROM Items WHERE CategoryID LIKE ? AND ManufacturerID LIKE ? AND Title LIKE ?";

        $searchTerm = "%".implode('%',str_split($searchTerm))."%";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("sss", $catID,$verID, $searchTerm);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function getAnimalById($itemID){
        $sqlQuery = "SELECT * FROM Items WHERE ItemID = ?";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("i", $itemID);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $animal = $result->fetch_assoc();

        $sqlStatement->close();

        return $animal;
    }

    public function getCategoryById($categoryID){
        $sqlQuery = "SELECT * FROM Categories WHERE CategoryID = ?";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("i", $categoryID);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $category = $result->fetch_assoc();

        $sqlStatement->close();

        return $category;
    }

    public function getManufacturerById($manufacturerID){
        $sqlQuery = "SELECT * FROM Manufacturers WHERE ManufacturerID = ?";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("i", $manufacturerID);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $manufacturer = $result->fetch_assoc();

        $sqlStatement->close();

        return $manufacturer;
    }

    public function getUserById($userID){
        $sqlQuery = "SELECT * FROM Users WHERE UserID = ?";

        $sqlStatement = $this->dbKeyObject->prepare($sqlQuery);
        $sqlStatement->bind_param("i", $userID);
        $sqlStatement->execute();

        $result = $sqlStatement->get_result();

        $user = $result->fetch_assoc();

        $sqlStatement->close();

        return $user;
    }

    public function existsInCart($itemID, $userID): bool{
        $sqlQuery = "SELECT COUNT(UserID) AS count FROM Carts WHERE UserID = ? AND ItemID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("ii", $userID, $itemID);
        $statement->execute();

        $result = $statement->get_result();

        $cartCount = $result->fetch_assoc()["count"];

        $statement->close();

        return $cartCount>=1;
    }

    public function getItemCountCart($itemID, $userID): int{
        $sqlQuery = "SELECT Count FROM Carts WHERE UserID = ? AND ItemID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("ii", $userID, $itemID);
        $statement->execute();

        $result = $statement->get_result();
        $count = 0;
        if ($result->lengths > 0){
            $count = $result->fetch_assoc()["Count"];
        }

        $statement->close();

        return $count;
    }

    public function insertItemIntoCart($itemID, $userID, $count){
        $sqlQuery = "INSERT INTO Carts (ItemID, UserID, Count) VALUES (?,?,?)";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("iii", $itemID,$userID, $count);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $statement->close();
    }

    public function updateItemInCart($itemID, $userID, $count){
        $sqlQuery = "UPDATE Carts SET Count = ? WHERE ItemID = ? AND UserID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("iii", $count, $itemID, $userID);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $statement->close();
    }

    public function getCartItemCount($userID):int{
        $sqlQuery = "SELECT SUM(Count) AS Count FROM Carts WHERE UserID = ? GROUP BY UserID";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i",$userID);
        $statement->execute();

        $result = $statement->get_result();

        $count = $result->fetch_assoc()["Count"];

        $statement->close();

        return $count;
    }

    public function getCartFromUser($userID):array{
        $sqlQuery = "SELECT * FROM Carts WHERE UserID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i",$userID);
        $statement->execute();

        $result = $statement->get_result();

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function removeItemInCart($itemID, $userID){
        $sqlQuery = "DELETE FROM Carts WHERE ItemID = ? AND UserID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("ii", $itemID, $userID);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $statement->close();
    }

    public function clearCart($userID){
        $sqlQuery = "DELETE FROM Carts WHERE UserID = ?";
        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i", $userID);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $statement->close();
    }

    public function createOrder($userID, $total):int{
        $sqlQuery = "INSERT INTO Orders (Arrived, UserID, Total) VALUES (false,?,?)";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("ii", $userID,$total);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $statement->close();

        return mysqli_insert_id($this->dbKeyObject);
    }

    public function createItemOrderRefference($orderID,$itemID,$count){
        $sqlQuery = "INSERT INTO OrderItemConnections (OrderID, ItemID, Count) VALUES (?,?,?)";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("iii", $orderID, $itemID, $count);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $statement->close();
    }

    public function getAllOrdersFromUser($userID):array{
        $sqlQuery = "SELECT * FROM Orders WHERE UserID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i", $userID);

        if(!$statement->execute()){
            die("Error: ".$statement->error);
        }

        $result = $statement->get_result();

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function getOrderInfos($orderID):array{
        $sqlQuery = "SELECT * FROM Orders WHERE OrderID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i",$orderID);
        $statement->execute();

        $result = $statement->get_result();

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function getItemsFromOrder($orderID):array{
        $sqlQuery = "SELECT * FROM OrderItemConnections WHERE OrderID = ?";

        $statement = $this->dbKeyObject->prepare($sqlQuery);
        $statement->bind_param("i",$orderID);
        $statement->execute();

        $result = $statement->get_result();

        $rows = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            array_push($rows, $row);
        }
        return $rows;
    }

}

?>
