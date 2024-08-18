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

// SQL query to select data
$sql = "SELECT firstname, birthday FROM registered_users";
$result = $conn->query($sql);

// Check if the query returned any results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "First Name: " . $row["firstname"] . " - Birthday: " . $row["birthday"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();

?>
