<?php
// MySQL server settings
$servername = "localhost";
$database = "birthday_recipients"; // Replace with your database name
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$port = 3307; // MySQL port number

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to MySQL<br>";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required POST variables are set
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['country_code']) &&
        isset($_POST['contact']) && isset($_POST['birthday'])) {
        
        // Assign POST variables to PHP variables
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $country_code = $_POST['country_code'];
        $contact = $_POST['contact'];
        $birthday = $_POST['birthday'];
        
        // Perform SQL query to insert data into the database
        $sql = "INSERT INTO registered_users (firstname, lastname, country_code, contact, birthday) 
                VALUES ('$firstname', '$lastname', '$country_code', '$contact', '$birthday')";

        // Check if the query was successful
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display an error if form fields are not set or empty
        echo "Form fields are not set or empty.";
    }
}
?>
