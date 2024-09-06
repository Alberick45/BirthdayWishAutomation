<?php 
session_start();
require("php/config.php");
// include("automatic_message_sending.php");

global $conn;
if (!isset($_SESSION['user id'])) {
    header("Location: ../index.php?You are not logged in");
    echo "You are not logged in";
    exit();
}elseif($_SESSION["status"] != "Admin") {
    header("Location: ../index.php?You are not authorized");
    echo "You are not authorized";
    exit();
} else {
    $user_id = $_SESSION['user id'];
    $user_name = $_SESSION['username'];
    $user_status = $_SESSION["status"];
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WishMe</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      
    </style>

    <link rel="icon" href="img/logo2.ico" type="image/png">
</head>


<body style=" background-color:#e2e0e0">

  <header class="fixed-top">
    <nav class="navbar navbar-expand-md navbar-dark  bg" id="navbar" style=" position: relative; background-color: blue;">
      <div class="container-fluid">
        <h1 style="width: 80%; color: antiquewhite; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">WishMe - Admin <?php echo $user_name;?></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contacts-modal" style="margin-right: 10px;">Upload Contacts</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messages-modal" style="margin-right: 10px;">Upload Messages</button>
          <a href="index.php" type="button" class="btn btn-primary" style="border:0px; margin-right: 10px;">Home page</a>
          <a href="php/automatic_message_sending.php" type="button" class="btn btn-primary" style="border:0px; margin-right: 10px;">Automatic wish page</a>
        </div>
      </div>
    </nav>
  </header>


  
  <div class="modal fade" id="contacts-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload contacts</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="php/contact_upload.php"  id="signin" method="POST" class="needs-validation" novalidate>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="contact_file">
            <label class="input-group-text" for="inputGroupFile02">Upload Contacts csv here</label>
          </div>
<!-- 
          <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
          </div>
             -->
              <br>
              <button class="w-100 btn btn-primary btn-lg" name="sign_in" >Upload</button>
            </div>    
          </form>
          
          </div>
       
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="messages-modal" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Messages</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="php/message_upload.php" method = 'POST' id="sign_up" class="needs-validation" novalidate>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="message_file">
            <label class="input-group-text" for="inputGroupFile02">Upload Message csv here</label>
          </div>

  
              <button class="w-100 btn btn-primary btn-lg"  name="sign_up">Upload</button>
            </div>    
          </form>
          </div>
       
      </div>
    </div>
  </div>

  <footer class="footer fixed-bottom text-center"> 2021 © WishMe brought to you by Group5 
                    <p>Content on this page is reproduced from <a
                    href="https://www.wrappixel.com/">wrappixel.com</a> with permission from the author.</p>

            </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>

<!-- 
you see how index.php is we can have where home is be contacts and take all contact from database and load them there and the other tab could have a list of all messages
so we can have three one for registered users which loads only normal users one for contacts one fo rmessages and a delete button which when you click delete  
deletes user ,contact or message so admin can delete. pending bugs-on delete cascade.
-->