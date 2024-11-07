<?php
// This is a core class for managing the connection to the database and performing CRUD operations
class Database {
    private $conn;

    // Constructor method to initialize the database connection
    public function __construct() {
        // Include the configuration file to access the database credentials
        require_once "config/pmkn_config.php";

        try {
            // Create a PDO instance with MySQL DSN (Data Source Name) using values from the pmkn_config.php file
            $this->conn = new PDO("mysql:host=" .DB_HOST .";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            // Set the PDO error mode to exception for better error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database Connected Successfully.";
        } catch (PDOException $e) {
            // Display the exact error during development, better to remove and log this in production
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->conn = null;
    }
}