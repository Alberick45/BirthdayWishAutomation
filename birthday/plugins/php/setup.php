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

$SQL_createsms_tb = "CREATE TABLE IF NOT EXISTS sms(
    sms_id INT PRIMARY KEY AUTO_INCREMENT,
    num_of_credits INT,
    price DECIMAL(7,2) DEFAULT '0.00'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$SQL_createru_tb = "CREATE TABLE IF NOT EXISTS registered_users(
    ru_id INT PRIMARY KEY AUTO_INCREMENT,
    ruf_name VARCHAR(20),
    rul_name VARCHAR(20),
    ru_name VARCHAR(20),
    ru_dob DATE,
    ru_cntcode VARCHAR(5) DEFAULT '+233',
    ru_pnum BIGINT,
    ru_pass VARCHAR(65),
    ru_pic VARCHAR(100) DEFAULT 'default-pp.png',
    ru_status ENUM('User', 'Admin') NOT NULL DEFAULT 'User',
    num_of_credits INT,
    CHECK(CHAR_LENGTH(ru_pass) >= 7)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$SQL_createm_tb = "CREATE TABLE IF NOT EXISTS messages(
    m_id INT PRIMARY KEY AUTO_INCREMENT,
    m_body LONGTEXT,
    m_ruid INT,
    m_type VARCHAR(30),
    CONSTRAINT creator_id FOREIGN KEY (m_ruid) REFERENCES registered_users(ru_id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$SQL_createc_tb = "CREATE TABLE IF NOT EXISTS contacts(
    c_id INT PRIMARY KEY AUTO_INCREMENT,
    cf_name VARCHAR(20),
    cl_name VARCHAR(20),
    c_dob DATE,
    c_cntcode VARCHAR(5) DEFAULT '+233',
    c_pnum BIGINT,
    c_mid INT DEFAULT NULL,
    c_ruid INT,
    m_stat TINYINT(1) DEFAULT 0,
    c_status ENUM('Student', 'Public') NOT NULL DEFAULT 'Public',
    CONSTRAINT messagecreator_id FOREIGN KEY (c_mid) REFERENCES messages(m_id) ON DELETE CASCADE,
    CONSTRAINT messagecreated_id FOREIGN KEY (c_ruid) REFERENCES registered_users(ru_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

// SQL queries to insert initial data
$password = 'password'; // The password to be hashed

// Hash the password using PASSWORD_DEFAULT
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$SQL_r_init_insert = "INSERT INTO registered_users (ruf_name, rul_name, ru_name, ru_dob, ru_pnum, ru_pass) VALUES 
('John', 'Doe', 'root', '1990-01-01', 1234567890, '$hashed_password')"; 

$SQL_m_init_insert = "INSERT INTO messages (m_body, m_ruid, m_type) VALUES 
('None', 1, 'sample'),
('Dear [Name], wishing you a day filled with happiness and a year filled with joy as you turn [Age] today. Happy Birthday! - [Your Name]', 1, 'special'),
('Happy [Age]th Birthday, [Name]! May your birthday be as special and wonderful as you are. Have a fantastic day! - [Your Name]', 1, 'special'),
('It\'s your [Age]th birthday, [Name]! Time to celebrate, make memories, and have an amazing time. Cheers to you! - [Your Name]', 1, 'love'),
('On your special day, [Name], as you celebrate turning [Age], I just want to let you know how much you mean to me. Happy Birthday! - [Your Name]', 1, 'love'),
('Dear [Name], as you turn [Age], may your birthday be the start of a year filled with good luck, good health, and much happiness. Happy Birthday! - [Your Name]', 1, 'important')";

$SQL_c_init_insert = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_pnum, c_mid, c_ruid) VALUES 
('John', 'Doe', '1990-01-01', 1234567890, 2, 1)"; 

// Execute the table creation queries
if ($conn->query($SQL_createru_tb) === TRUE) {
    echo "Table 'registered_users' created successfully<br>";
} else {
    echo "Error creating table 'registered_users': " . $conn->error . "<br>";
}

if ($conn->query($SQL_createm_tb) === TRUE) {
    echo "Table 'messages' created successfully<br>";
} else {
    echo "Error creating table 'messages': " . $conn->error . "<br>";
}

if ($conn->query($SQL_createc_tb) === TRUE) {
    echo "Table 'contacts' created successfully<br>";
} else {
    echo "Error creating table 'contacts': " . $conn->error . "<br>";
}

// Insert initial data into the tables
if ($conn->query($SQL_r_init_insert) === TRUE) {
    echo "Initial data for 'registered_users' inserted successfully<br>";
} else {
    echo "Error inserting initial data for 'registered_users': " . $conn->error . "<br>";
}

if ($conn->query($SQL_m_init_insert) === TRUE) {
    echo "Initial data for 'messages' inserted successfully<br>";
} else {
    echo "Error inserting initial data for 'messages': " . $conn->error . "<br>";
}

if ($conn->query($SQL_c_init_insert) === TRUE) {
    echo "Initial data for 'contacts' inserted successfully<br>";
} else {
    echo "Error inserting initial data for 'contacts': " . $conn->error . "<br>";
}

// Add SQL Events for resetting and clearing
$SQL_reset_mstatus_event = "
DELIMITER //

CREATE EVENT IF NOT EXISTS reset_mstatus
ON SCHEDULE EVERY 1 YEAR
DO
BEGIN
    UPDATE contacts SET m_stat = 0;
END //

DELIMITER ;
";

$SQL_clear_students_event = "
DELIMITER //

CREATE EVENT IF NOT EXISTS clear_final_year_students
ON SCHEDULE EVERY 4 YEAR
DO
BEGIN
    DELETE FROM contacts WHERE c_status = 'Student';
END //

DELIMITER ;
";

// Execute the events
if ($conn->multi_query($SQL_reset_mstatus_event) === TRUE) {
    echo "Event 'reset_mstatus' created successfully<br>";
} else {
    echo "Error creating event 'reset_mstatus': " . $conn->error . "<br>";
}

if ($conn->multi_query($SQL_clear_students_event) === TRUE) {
    echo "Event 'clear_final_year_students' created successfully<br>";
} else {
    echo "Error creating event 'clear_final_year_students': " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>
