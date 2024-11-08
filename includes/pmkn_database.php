<?php
// This is a core class for managing the connection to the database and performing CRUD operations
class Database {
    // Private property to hold the PDO connection instance
    private $conn;
    // Private property to hold the path to the config file
    private $configPath;

    // Constructor method to initialize the database connection
    public function __construct($useDbName = false) {
        // Initialise the path to the config file
        $this->configPath = __DIR__ . "/../config/pmkn_config.php";

         // Include the configuration file to access the database credentials
         require_once $this->configPath;

        try {
            // Connect without specifying a database initially
            $dsn = "mysql:host=" . DB_HOST;

            if ($useDbName) {
                // Add dbname to DSN if explicitly requested
                $dsn .= ";dbname=" . DB_NAME;
            }

            // Create a PDO instance with MySQL DSN (Data Source Name) using values from the pmkn_config.php file
            $this->conn = new PDO($dsn, DB_USER, DB_PASSWORD);
            // Set the PDO error mode to exception for robust error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Database Connected Successfully.";
        } catch (PDOException $e) {
            // Handle connection errors and display the exact error during development, better to remove and log this in production
            echo "Connection failed: " . $e->getMessage();
            // Stop further code execution if the connection fails
            exit;
        }
    }

    // Destructor to close the database connection
    public function __destruct() {
        // Set the connection instance to null, closing the connection
        $this->conn = null;
    }

    // Method to create a new database with a default name if none is provided
    public function createDatabase($dbName = "pmkn_db") {
        try {
            // Ensure $dbName has a value value
            $dbName = $dbName ?: "pmkn_db";
            // Construct the SQL statement for creating a database
            $sql = "CREATE DATABASE IF NOT EXISTS `$dbName` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
            // Execute the SQL statement to create the database
            $this->conn->exec($sql);
            // Message displayed on successful creation
            echo "Database '$dbName' created successfully.";

            // Update the configuration file with the new database name
            $configContent = file_get_contents($this->configPath);
            $newDbNameLine = "define(\"DB_NAME\", \"$dbName\");";

            // Replace the existing DB_NAME in the config file
            $configContent = preg_replace(
                '/define\("DB_NAME",\s*".*"\);/',
                $newDbNameLine,
                $configContent
            );

            // Write the updated content back to the config file
            file_put_contents($this->configPath, $configContent);
            echo "Configuration file updated with the new database name `$dbName`.";
        } catch (PDOException $e) {
            echo "Error creating the database: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error updating the configuration file: " . $e->getMessage();
        }
    }

    // Method to create a table in the database
    public function createTable($tableName, $columns) {
        try {
            // Construct the SQL statement for creating a table, avoids duplicate tables being created
            $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
            // Array to store column definitions
            $columnDefinitions = [];

            // Loop through each column definition provided in the $columns array
            foreach ($columns as $columnName => $definition) {
                // Append each column name and its definition to the $columnDefinitions array
                $columnDefinitions[] = "$columnName $definition";
            }

            // Join all column definitions with commas and complete the SQL statement
            $sql .= implode(", ", $columnDefinitions);
            // Specify the table engine and the character set
            $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            // Execute the SQL statement to create the table in the database
            $this->conn->exec($sql);
            // Message displayed on successful creation
            echo "Table '$tableName' created successfully.";
        } catch (PDOException $e) {
            // Handle any errors that occur during the table creation
            echo "Error creating table: " . $e->getMessage();
        }
    }
}