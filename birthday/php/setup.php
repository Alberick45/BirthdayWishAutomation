<?php 
$server = "localhost";
$username = "root";
$password = "";
$port = 3307; // Change this if your MySQL port is different

// Establish a connection to the MySQL server
$conn = new mysqli($server, $username, $password, "", $port);

if ($conn->connect_error) {
    die("Couldn't connect to server: " . $conn->connect_error);
}

// Create the database
$sql_createdb = "CREATE DATABASE IF NOT EXISTS birthday_sms";
if ($conn->query($sql_createdb) === TRUE) {
    echo "Database created successfully<br>";
} else {
    die("Error creating database: " . $conn->error . "<br>");
}

// Select the database
$conn->select_db("birthday_sms");

// SQL queries to create tables
$SQL_createru_tb = "CREATE TABLE IF NOT EXISTS registered_users(
    ru_id INT PRIMARY KEY AUTO_INCREMENT,
    ruf_name VARCHAR(20),
    rul_name VARCHAR(20),
    ru_name VARCHAR(20),
    ru_dob DATE,
    ru_cntcode VARCHAR(5),
    ru_pnum BIGINT,
    ru_pass VARCHAR(65)
    check(CHAR_LENGTH(ru_pass) >= 7)
)";

$SQL_createm_tb = "CREATE TABLE IF NOT EXISTS messages(
    m_id INT PRIMARY KEY AUTO_INCREMENT,
    m_body LONGTEXT,
    m_ruid INT,
    m_type ENUM('custom','love','important','special'),

    CONSTRAINT creator_id FOREIGN KEY (m_ruid) REFERENCES registered_users(ru_id)
)";


$SQL_createc_tb = "CREATE TABLE IF NOT EXISTS contacts(
    c_id INT PRIMARY KEY AUTO_INCREMENT,
    cf_name VARCHAR(20) ,
    cl_name VARCHAR(20),
    c_dob DATE,
    c_cntcode VARCHAR(5),
    c_pnum BIGINT,
    c_mid INT,
    c_ruid INT,
    m_stat TINYINT(1) set default = 0,
    CONSTRAINT messagecreator_id FOREIGN KEY (c_mid) REFERENCES messages(m_id),
    CONSTRAINT messagecreated_id FOREIGN KEY (c_ruid) REFERENCES registered_users(ru_id)
)";





// SQL queries to insert initial data
$password = 'password'; // The password to be hashed

// Hash the password using PASSWORD_DEFAULT
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$SQL_r_init_insert = "INSERT INTO registered_users (ruf_name, rul_name, ru_name, ru_dob, ru_cntcode, ru_pnum,ru_pass) VALUES 
('John', 'Doe', 'root','1990-01-01', '+233', 1234567890,'$hashed_password')"; 



$SQL_m_init_insert = "INSERT INTO messages (m_body,m_ruid,m_type) VALUES 
('None',1,'sample'),
('Dear [Name], wishing you a day filled with happiness and a year filled with joy as you turn [Age] today. Happy Birthday! - [Your Name]',1,'sample'),
('Happy [Age]th Birthday, [Name]! May your birthday be as special and wonderful as you are. Have a fantastic day! - [Your Name]',1,'sample'),
('It\'s your [Age]th birthday, [Name]! Time to celebrate, make memories, and have an amazing time. Cheers to you! - [Your Name]',1,'sample'),
('On your special day, [Name], as you celebrate turning [Age], I just want to let you know how much you mean to me. Happy Birthday! - [Your Name]',1,'sample'),
('Dear [Name], as you turn [Age], may your birthday be the start of a year filled with good luck, good health, and much happiness. Happy Birthday! - [Your Name]',1,'sample')";

$SQL_c_init_insert = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum,c_mid,c_ruid) VALUES 
('John', 'Doe', '1990-01-01', '+233', 1234567890,2,1)"; 


// Execute the table creation queries
if ($conn->query($SQL_createru_tb) === TRUE) {
    echo "Table 'registered_users' created successfully<br>";
} else {
    echo "Error creating table 'registered_users': " . $conn->error . "<br>";
}

if ($conn->query($SQL_createm_tb) === TRUE) {
    echo "Table 'custom_messages' created successfully<br>";
} else {
    echo "Error creating table 'custom_messages': " . $conn->error . "<br>";
}


if ($conn->query($SQL_createc_tb) === TRUE) {
    echo "Table 'contacts' created successfully<br>";
} else {
    echo "Error creating table 'contacts': " . $conn->error . "<br>";
}





// Insert initial data into the tables
if ($conn->query($SQL_r_init_insert) === TRUE) {
    echo "Initial data for 'custom_messages' inserted successfully<br>";
} else {
    echo "Error inserting initial data for 'custom_messages': " . $conn->error . "<br>";
}

if ($conn->query($SQL_m_init_insert) === TRUE) {
    echo "Initial data for 'custom_messages' inserted successfully<br>";
} else {
    echo "Error inserting initial data for 'custom_messages': " . $conn->error . "<br>";
}

if ($conn->query($SQL_c_init_insert) === TRUE) {
    echo "Initial data for 'contacts' inserted successfully<br>";
} else {
    echo "Error inserting initial data for 'contacts': " . $conn->error . "<br>";
}



// Close the connection
$conn->close();
?>
