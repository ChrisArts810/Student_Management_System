
<?php

// Define a Database class responsible for handling
// the connection between PHP and the MySQL database.
class Database {

    // Private properties store the database credentials.
    // These properties can only be accessed directly
    // within this Database class.
    private $host;
    private $username;
    private $password;
    private $dbname;

    // Protected property stores the database connection.
    // It can be accessed within this class and its child classes.
    protected $conn;

    // Constructor automatically executes when an object
    // of the Database class is created.
    public function __construct() {

        // Set the database server hostname.
        $this->host = 'localhost';

        // Set the MySQL username.
        $this->username = 'root';

        // Set the MySQL password.
        // An empty password is common in a default local
        // XAMPP development environment.
        $this->password = '';

        // Set the name of the database to connect to.
        // Replace 'lastname_lms_db' with your actual database name.
        $this->dbname = 'library_db';
    }

    // Public method used to establish the database connection.
    // Other classes or scripts can call this method.
    public function connect() {

        // Create a new MySQLi connection object using
        // the stored hostname, username, password, and database name.
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Check whether the database connection failed.
        if ($this->conn->connect_error) {

            // Stop program execution and display the error message.
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Return the established database connection.
        // Other classes can use this connection to execute queries.
        return $this->conn;
    }
}

// Create an object (instance) of the Database class.
// The constructor automatically initializes the credentials.
//$database = new Database();

// Call the connect() method to establish the connection.
//$database->connect();

?>
