 <?php
// // Include database connection
// require('config.php'); // Ensure this file connects to your database

// // Start a session if not already started
// session_start();

// // Assuming the user ID is stored in a session variable
// $user_id = $_SESSION['user id'];

// // Initialize an empty array to hold update statements
// $update_fields = [];
// $target_dir = "../uploads";
// $uploadOk = 1;
// $target_file ='';
// // Check if the full name is set and not empty
// if (isset($_POST['full_name']) && !empty(trim($_POST['full_name']))) {
//     $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
//     $names = explode(' ', $full_name);
//     $first_name = $names[0];
//     $last_name = isset($names[1]) ? $names[1] : '';
//     $update_fields[] = "ruf_name = '$first_name', rul_name = '$last_name'";
//     $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// }

// // Check if the phone number is set and not empty
// if (isset($_POST['phone_number']) && !empty(trim($_POST['phone_number']))) {
//     $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
//     $update_fields[] = "ru_pnum = '$phone_number'";
// }

// // Check if the country is set and not empty
// if (isset($_POST['country']) && !empty(trim($_POST['country']))) {
//     $country = mysqli_real_escape_string($conn, $_POST['country']);
//     $update_fields[] = "ru_cntcode = '$country'";
// }

// if (isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
//     if ($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// if (isset($_FILES['profile_picture'])) {
//     $profile_picture = $_FILES['profile_picture'];
  
//     // Check if the file is uploaded successfully
//     if ($profile_picture['error'] == 0) {
//       // Store the file in the database as a BLOB
//       $blob_data = addslashes(file_get_contents($profile_picture['tmp_name']));
//       $update_fields[] = "profile_picture = '$blob_data'";
//     }
//   }
  
//   // ... (rest of the code remains the same)
  
//   // Update the user profile
//   $sql = "UPDATE registered_users SET " . implode(', ', $update_fields) . " WHERE ru_id = '$user_id'";
//   if ($conn->query($sql) === TRUE) {
//     echo "Profile updated successfully";
//   } else {
//     echo "Error updating profile: " . $conn->error;
//   }
// // Only execute the update if there are fields to update
// // if (!empty($update_fields)) {
// //     $sql = "UPDATE registered_users SET " . implode(', ', $update_fields) . " WHERE ru_id = $user_id";
    
// //     if ($conn->query($sql) === TRUE) {
// //         echo "Profile updated successfully";
// //     } else {
// //         echo "Error updating profile: " . $conn->error;
// //     }
// // } else {
// //     echo "No changes to update.";
// // }

// // header("refresh:2 ../profile.php");
// // // Close the database connection
// // $conn->close();

// // $sql = "INSERT INTO profiles (first_name, last_name, dob, country_code, phone_number)
// // VALUES ('{$profile['first_name']}', '{$profile['last_name']}', '{$profile['dob']}', '{$profile['country_code']}', '{$profile['phone_number']}')";

// // if (mysqli_query($conn, $sql)) {
//     // $profile_id = mysqli_insert_id($conn);
//     // Upload profile picture
//     // $target_dir = "uploads/ ";
//     // $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
//     // $uploadOk = 1;
//     // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     // Check if image file is a actual image or fake image
//     // if (isset($_POST["submit"])) {
//     //     $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
//     //     if ($check !== false) {
//     //         echo "File is an image - " . $check["mime"] . ".";
//     //         $uploadOk = 1;
//     //     } else {
//     //         echo "File is not an image.";
//     //         $uploadOk = 0;
//     //     }
//     // }
//     // Check if file already exists
//     // if (file_exists($target_file)) {
//     //     echo "Sorry, file already exists.";
//     //     $uploadOk = 0;
//     // }
//     // // Check file size
//     // if ($_FILES["profile_picture"]["size"] > 500000) {
//     //     echo "Sorry, your file is too large.";
//     //     $uploadOk = 0;
//     // }
//     // // Allow certain file formats
//     // if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//     //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     //     $uploadOk = 0;
//     // }
//     // // Check if $uploadOk is set to 0 by an error
//     // if ($uploadOk == 0) {
//     //     echo "Sorry, your file was not uploaded.";
//     // // if everything is ok, try to upload file
//     // } else {
//     //     if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
//     //         echo "The file ". basename($_FILES["profile_picture"]["name"]). " has been uploaded.";
//     //         // Update profile picture URL in database
//     //         $sql = "UPDATE profiles SET profile_picture = '$target_file' WHERE id = '$profile_id'";
//     //         mysqli_query($conn, $sql);
//     //     } else {
//     //         echo "Sorry, there was an error uploading your file.";
//     //     }
//     // }
// // } else {
// //     echo "Error creating profile: " . mysqli_error($conn);
// // }header("refresh:2 ../profile.php");
// // Close the database connection
// $conn->close();
?> 


<?php
if (isset($_SESSION['user id']) && isset($_SESSION['fname'])) {

    include "config.php";
    include 'php/User.php';
    $user_id = getUserById($_SESSION['user id'], $conn);
    if ($user_id) {
        $old_pp = $_POST['old_pp'];
        $id = $_SESSION['user id'];

        $update_fields = [];
        $target_dir = "../uploads/";
        $uploadOk = 1;
        $target_file = '';

        // Validate and sanitize user input
        if (isset($_POST['full_name'])) {
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $names = explode(' ', $full_name);
            $first_name = $names[0];
            $last_name = isset($names[1]) ? $names[1] : '';
            $update_fields[] .= "ruf_name = '$first_name', rul_name = '$last_name'";
        }
        else{
            echo '1';
        }

        if (isset($_POST['phone_number']) && !empty(trim($_POST['phone_number']))) {
            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
            // Validate phone number format
            if (!preg_match('/^[0-9]{10}$/', $phone_number)) {
                echo "Invalid phone number format.";
                exit;
            }
            $update_fields[] .= "ru_pnum = '$phone_number'";
        }
        else{
            echo '2';
        }

        if (isset($_POST['country']) && !empty(trim($_POST['country']))) {
            $country = mysqli_real_escape_string($conn, $_POST['country']);
            // Validate country format
            $update_fields[] .= "ru_cntcode = '$country'";
        }
        else{
            echo '3';
        }

        if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
        
            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error = $_FILES['pp']['error'];
            
            if($error === 0){
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
               $img_ex_to_lc = strtolower($img_ex);
   
               $allowed_exs = array('jpg', 'jpeg', 'png');
               if(in_array($img_ex_to_lc, $allowed_exs)){
                  $new_img_name = uniqid($uname, true).'.'.$img_ex_to_lc;
                  $img_upload_path = '../uploads/'.$new_img_name;
                  // Delete old profile pic
                  $old_pp_des = "../uploads/$old_pp";
                  if(unlink($old_pp_des)){
                        // just deleted
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $update_fields[] .= "ru_pic = '$new_img_name'";
                  }else {
                     // error or already deleted
                        move_uploaded_file($tmp_name, $img_upload_path);
                  }
                }else {
                    $em = "You can't upload files of this type";
                    header("Location: ../../profile.php?error=$em&$data");
                    exit;
                }
            }else {
                $em = "unknown error occurred!";
                header("Location: ../../profile.php?error=$em&$data");
                exit;
            }
     
             
        }else{
            echo "last";
        }
        // Handle file upload
        // if (isset($_FILES['profile_picture'])) {
        //     $profile_picture = $_FILES['profile_picture'];
        //     $check = getimagesize($profile_picture['tmp_name']);
        //     if ($check !== false) {
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }

        //     if ($uploadOk == 1) {
        //         // Store the file in the database as a BLOB
        //         $blob_data = addslashes(file_get_contents($profile_picture['tmp_name']));
        //         $update_fields[] = "profile_picture = '$blob_data'";
        //     }else{
        //         echo '2.5';
        //     }
        // }
        // else{
        //     echo '3';
        // }

        // Update the user profile
        if (!empty($update_fields)) {
            $sql = "UPDATE registered_users SET " . implode(', ', $update_fields) . " WHERE ru_id = '$user_id'";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../profile.php?success=Your account has been updated successfully");
                exit;

            } else {
                header("Location: ../profile.php?error=error");

            }
        }else {
            header("Location: ../profile.php?error=error");
            exit;
        }
    }
    }else {
        header("Location: index.php");
        exit;
    } 
?>