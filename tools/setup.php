<?php
echo "<h1><a href='../'>back to start</a></h1>";
echo "<p>Setup started</p>";
require_once "../php/dbConnection.php";
$db = new db();
$db->delEverything();
$db->createBasicDatabaseStructure();
$db->exampleData();
echo "<p>Setup finished</p>";