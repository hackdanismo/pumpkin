<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database class includes file to access the database
require_once __DIR__ . "/../includes/pmkn_database.php";

// This is the initial page that allows users to setup the database credentials and create the admin table

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted database name, or use the default value is no name is provided
    $dbName = !empty($_POST["db_name"]) ? $_POST["db_name"] : "pmkn_db";

    // Initialise the Database class
    $db = new Database();
    // Create the database with the specified name submitted in the form, or fallback to the default value
    $db->createDatabase($dbName);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pumpkin: Install</title>
</head>
<body>
    <h1>Pumpkin Install</h1>

    <form method="POST" action="">
        <label for="db_host">Hostname:</label>
        <input type="text" id="db_host" name="db_host" placeholder="localhost"><br>
        <label for="db_user">Username:</label>
        <input type="text" id="db_user" name="db_user" placeholder="username"><br>
        <label for="db_password">Password:</label>
        <input type="password" id="db_password" name="db_password" placeholder="password"><br>
        <label for="db_name">Database Name (leave empty for the default):</label>
        <input type="text" id="db_name" name="db_name" placeholder="pmkn_db"><br>
        <button type="submit">Install</button>
    </form>
</body>
</html>