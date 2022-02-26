<?php
require "../php/dbConnection.php";
$db = new db();
$db->delEverything();
$db->createBasicDatabaseStructure();
$db->exampleData();