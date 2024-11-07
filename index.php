<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "includes/pmkn_database.php";

// Instantiate the Database class to create a new database object and connect to the database
$db = new Database();

    