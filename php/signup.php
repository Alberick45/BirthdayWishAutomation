<?php
/* connect to database custom messages */
require("config.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['uname'])&&isset($_POST['cntcd'])&&isset($_POST['phone'])&&isset($_POST['dob'])&&isset($_POST['password'])){
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $username = $_POST['uname'];
        $country_code = $_POST['cntcd'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $password = $_POST['password'];


        /* hashed password */
        $HashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $firstname = $conn ->real_escape_string($firstname);
        $lastname = $conn ->real_escape_string($lastname);
        $username = $conn ->real_escape_string($username);
        $country_code = $conn ->real_escape_string($country_code);
        $phone = $conn ->real_escape_string($phone);
        $dob = $conn ->real_escape_string($dob);
        $HashedPassword = $conn ->real_escape_string($HashedPassword);
       
        

        
        $sqlinsert = "INSERT INTO registered_users (ruf_name,rul_name,ru_name,ru_dob,ru_cntcode,ru_pnum,ru_pass)
        VALUES(?,?,?,?,?,?,?)";
        $stmt = $conn -> stmt_init();
        $stmt = $conn -> prepare($sqlinsert);
        $stmt -> bind_param('sssssis',$firstname,$lastname,$username,$dob,$country_code,$phone,$HashedPassword);
        $stmt -> execute();
        
        if(($stmt -> affected_rows) > 0){
            $_SESSION['message'] =  "Registered successfully";
            header("Location: ../index.html");
        }
        else{
            echo "problem with code". $conn ->error;
        }
    
    }
    else{
        echo "enter a value";
    }
}