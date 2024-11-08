<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database class includes file to access the database
require_once "includes/pmkn_database.php";

echo "Pumpkin";

/*
// Instantiate the Database class to create a new database object and connect to the database
$db = new Database();

// Create a database in MySQL if it not already exists
$dbName = "pumpkin_db_test_creation";
$db->createDatabase($dbName);

// Create a test table in the database using the createTable() method
$tableName = "test";
$columns = [
    "id" => "INT(11) AUTO_INCREMENT PRIMARY KEY",
    "username" => "VARCHAR(50) NOT NULL",
    "email" => "VARCHAR(100) NOT NULL",
    "password" => "VARCHAR(255) NOT NULL",
    "created_at" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];

$db->createTable($tableName, $columns);
*/
    