<?php
require("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["fname"], $_POST["lname"], $_POST["uname"], $_POST["dob"], $_POST["cntcd"], $_POST["phone"], $_POST["password"])) {
        $firstname = $conn->real_escape_string($_POST["fname"]);
        $lastname = $conn->real_escape_string($_POST["lname"]);
        $username = $conn->real_escape_string($_POST["uname"]);
        $dob = $conn->real_escape_string($_POST["dob"]);
        $country_code = $conn->real_escape_string($_POST["cntcd"]);
        $phone = $conn->real_escape_string($_POST["phone"]);
        $password = $conn->real_escape_string($_POST["password"]);

        // Check if the password length is at least 8 characters
        if (strlen($password) < 8) {
            echo "<script>
                    alert('Password must be at least 8 characters long');
                    window.location.href = '../index.html';
                  </script>";
            exit();
        }


        // Check if the user already exists
        $checkUserQuery = "SELECT ru_id FROM registered_users WHERE ru_name = ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User already exists
            echo "<script>
                    alert('Username already taken');
                    window.location.href = '../index.html';
                  </script>";
        } else {
            // User does not exist, proceed with registration
            $HashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sqlinsert = "INSERT INTO registered_users (ruf_name, rul_name, ru_name, ru_dob, ru_cntcode, ru_pnum, ru_pass)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->stmt_init();
            $stmt = $conn->prepare($sqlinsert);
            $stmt->bind_param('sssssis', $firstname, $lastname, $username, $dob, $country_code, $phone, $HashedPassword);
            $stmt->execute();
            $messageid=2;
            
            if ($stmt->affected_rows > 0) {
                // $_SESSION['message'] = "Registered successfully";
                // $_SESSION['']
                // header("Location: ../index.html");
                $passretrieval = "SELECT ru_id FROM registered_users WHERE ru_name = '$username'";
                $result = $conn -> query($passretrieval);
                if($result && $result -> num_rows > 0){
                    $row = $result -> fetch_assoc();
                    $user_id = $row["ru_id"];
                    $_SESSION["user id"]= $user_id;
                    $_SESSION["username"]= $username;
                    $_SESSION['message'] =  "You are  logged in successfully ".$username;
                    $sql = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum, c_mid, c_ruid) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $sql->bind_param('ssssiii', $firstname, $lastname, $dob, $countrycode, $phone, $messageid, $user_id);
                    $stmt->execute();

                    header("Location: user_account.php");
                exit();
            } else {
                echo "Problem with code: " . $conn->error;
            }
        }
    } 
}
}
?>
