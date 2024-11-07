<?php
    // Database connection variables
    $hostname = "localhost";
    $username = "username";
    $password = "password";
    $database = "pumpkin_test_db";

    try {
        // Create a PDO instance with MySQL DSN (Data Source Name)
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        // Set the PDO error mode to exception for better error handling
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Database Connected";
    } catch(PDOException $e) {
        // Display the exact error during development, better to remove and log this in production
        echo "Connection failed: " . $e->getMessage();
    }