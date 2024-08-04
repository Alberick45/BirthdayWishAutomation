<?php
/* connect to database custom messages */
require("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["username"],$_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $username = $conn -> real_escape_string($username);
        $password = $conn -> real_escape_string($password);

        $passretrieval = "SELECT ru_id,ru_pass FROM registered_users WHERE ru_name = '$username'";
        $result = $conn -> query($passretrieval);
        if($result && $result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            $user_id = $row["ru_id"];
            $HashedPassword = $row["ru_pass"];

            if(password_verify($password,$HashedPassword)){
                $_SESSION["user id"]= $user_id;
                $_SESSION["username"]= $username;
                $_SESSION['message'] =  "You are  logged in successfully ".$username;
                header("Location: user_account.php");
            }
            else{
                $_SESSION['message'] =  "Incorrect password";
            }
        }else{
            $_SESSION['message'] =  "user not found";
        }

        
    }
}