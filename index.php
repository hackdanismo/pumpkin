<?php
    // Include the configuration file
    require_once "config/pmkn_config.php";

    try {
        // Create a PDO instance with MySQL DSN (Data Source Name) using values from the pmkn_config.php file
        $conn = new PDO("mysql:host=" .DB_HOST .";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        // Set the PDO error mode to exception for better error handling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Database Connected";
    } catch(PDOException $e) {
        // Display the exact error during development, better to remove and log this in production
        echo "Connection failed: " . $e->getMessage();
    }