<?php
session_start();

if (isset($_SESSION['user id'])) {
   $userid = $_SESSION['user id'];
   include "config.php";
$sql = "SELECT ruf_name,rul_name,ru_name FROM registered_users where ru_id = $userid";
$results = $conn -> query($sql);

if($results -> num_rows >0){
   while($rows =$results -> fetch_assoc()){
      $firstname = $rows['ruf_name'];
      $lastname = $rows['rul_name'];
      $username = $rows['ru_name'];
   }
}


   $fname = isset($_POST['fname'])?$_POST['fname']:$firstname;
   $lname = isset($_POST['lname'])?$_POST['lname']:$lastname;
   $uname = isset($_POST['uname'])?$_POST['uname']:$username;
   $old_pp = $_POST['old_pp'];
/* if(isset($_POST['fname']) && 
   isset($_POST['lname']) && isset($_POST['uname'])){

    include "config.php";

    $fname = $_POST['fname'];
    $uname = $_POST['lname'];
    $old_pp = $_POST['old_pp'];
    $id = $_SESSION['user id'];

    if (empty($fname)) {
    	$em = "Full name is required";
    	header("Location: ../profile.php?error=$em");
	    exit;
    }else if(empty($uname)){
    	$em = "User name is required";
        header("Location: ../profile.php?error=$em");

	    exit;
    }else { */

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
               }else {
                  // error or already deleted
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }
               

               // update the Database
               $sql = "UPDATE registered_users 
                       SET ruf_name=?, rul_name=?, ru_name=?, ru_pic=?
                       WHERE ru_id=?";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$fname, $lname, $uname, $new_img_name, $userid]);
               
               header("Location: ../profile.php?success=Your account has been updated successfully");
                exit;
            }else {
               $em = "You can't upload files of this type";
               header("Location: ../profile.php?error=$em&$data");
               exit;
            }
         }else {
            $em = "unknown error occurred!";
            header("Location: ../profile.php?error=$em&$data");
            exit;
          }

        
      } 
      else {
       	$sql = "UPDATE registered_users  
       	        SET ruf_name=?, rul_name=? , ru_name=?
                  WHERE ru_id=?";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$fname,$lname, $uname, $userid]);

       	header("Location: ../profile.php?success=Your account has been updated successfully");
   	    exit;
      }
    }


/* }else {
	header("Location: ../profile.php?error=error");
	exit;
}


}else {
	header("Location: ../index.php");
	exit;
}  */


//     $user_id = $_SESSION['user id'];
//     if (isset($_FILES['pp'])) {
//         $profile_picture = $_FILES['pp'];
//         $file_name= $_FILES['pp']['name'];
//         $folder ='../uploads/'.$file_name;
//         $tempname=$profile_picture['tmp_name'];
//         if($tempname){
//             $check = getimagesize($profile_picture['tmp_name']);
//             if ( $check !== false) {
//                 $uploadOk = 1;
//             } else {
//                 echo "File size is not surpportted";
//                 $uploadOk = 0;
//             }
//             $sql = mysqli_query($conn,"UPDATE registered_users set ru_pic = '$file_name' WHERE ru_id = $user_id");
//             if(move_uploaded_file($tempname,$folder)){
//                 echo 'file submited';
                
//             }else{
//                 echo 'File upload error'.$conn->$error;
//             }
//         }else{
//             echo"Null input";
//         }
//     }
//     else{
//         echo 'no pic';
//     }
// }
//         $check = getimagesize($profile_picture['tmp_name']);
//         if ($check !== false) {
//             $uploadOk = 1;
//         } else {
//             echo "File is not an image.";
//             $uploadOk = 0;
//         }

//         if ($uploadOk == 1) {
//             // Store the file in the database as a BLOB
//             $blob_data = addslashes(file_get_contents($profile_picture['tmp_name']));
//             if (!empty($blob_data )) {
//                 $sql = "UPDATE registered_users SET ru_pic = $blob_data WHERE ru_id = '$user_id'";
//                 if ($conn->query($sql) === TRUE) {
//                     echo "Profile updated successfully";
//                 } else {
//                     echo "Error updating profile: " . $conn->error;
//                 }
//             } else {
//                 echo "No changes to update.";
//             }
//         }
//         else{
//             echo 'File upload error'.$conn->$error;
//         }
//     }else echo 'not profile_picture';
// }