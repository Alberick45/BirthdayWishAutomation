<?php
  session_start();
  if (!isset($_SESSION['user id'])) {
    header("Location: ../index.html");
    exit();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="For sendig Birth Wishes Automatically">
    <meta name="author" content="Thomas">
    <meta name="generator" content="Hugo 0.84.0">
    <title>WishMe</title>
    
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

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
      .carousel {
    margin-bottom: 4rem;
    }
    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
      bottom: 3rem;
      z-index: 10;
    }
    
    /* Declare heights because of positioning of img element */
    .carousel-item {
      height: 50vh;
    }
    .carousel-item > img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 50vh;
    }
    </style>

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

  </head>
  <body style=" background-color:#f7f7f7">
  
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="bootstrap" viewBox="0 0 118 94">
        <title>Bootstrap</title>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
      </symbol>
      <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
      </symbol>
      <symbol id="speedometer2" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
      </symbol>
      <symbol id="table" viewBox="0 0 16 16">
        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
      </symbol>
      <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </symbol>
      <symbol id="grid" viewBox="0 0 16 16">
        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
      </symbol>
    </svg>

    <!-- this is the header section of this page -->
    <header>
      <div class="px-3 py-2 text-white" style="background-color:#ff69b4;">

        <div class="container">

          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <a href="../index.html" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
              <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg> -->
              <h3>WishMe</h3>
            </a>

            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
              <li>
                <a href="#" class="nav-link text-white">
                  <img class="bi d-block mx-auto mb-1" width="40px" height="40px" src="../img/unsplash-photo-2.jpg" style="border-radius:50%"></img>
                  <?php
                  echo''. $_SESSION['username'] .'';
                  ?>
                </a>
              </li>
            </ul>

          </div>

        </div>

      </div>

      <div class="px-3 py-2 border-bottom mb-3">

        <div class="container d-flex flex-wrap justify-content-center">

          <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          </form>

          <div class="text-end">
            <!-- <button type="button" class="btn btn-light text-dark me-2">Logout</button> -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#logout-modal" style="background-color:#ff69b4; color:#fff;">Logout</button>
          </div>

        </div>

      </div>
    </header>

    <!-- this section hold all the default displayed contents of the page -->
    <div style="padding:10px 70px 10px 70px;">
      
      <!--this is where users are able to nevigate through the sections of the page  -->
      <div style="box-shadow: 0px 0px 20px rgba(140, 133, 133, 0.5); min-height: 100vh;" >

        <nav>

          <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"  style="background-color:#ff69b4 ; color:#fff;">Home</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style=" background-color:#ff69b4 ; color:#fff;">Messages</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" style=" background-color:#ff69b4 ; color:#fff;">Contact</button>
          </div>

        </nav>

        <!-- this is where the gets acces to all the contents of the page and make changes ff69b4-->
      
        <div class="tab-content" id="nav-tabContent">
          
          <!-- this is the landing Section -->
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" >
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="background-color:#ff69b4"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" style="background-color:#ff69b4"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" style="background-color:#ff69b4"></button>
                </div>

                <div class="carousel-inner">
                  
                  <div class="carousel-item active">
                    <img src="../img/WhatsApp Image 2024-07-26 at 3.58.21 PM.jpeg" alt="">
                    <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#ffc67b;">Enjoy your day my good friend 🎂🥳🥳🥳🥳</h5>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#views-model" style="background-color:#ff69b4; color:#fff;">view Message</button>
                    </div>
                  </div>
                

                <!-- <div class="carousel-item">
                <img src="WhatsApp Image 2024-07-26 at 3.59.10 PM.jpeg" alt="">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#ffc67b">Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                  </div>
                </div> -->

                <div class="carousel-item">
                  <img src="../img/WhatsApp Image 2024-07-26 at 3.58.21 PM.jpeg" alt="">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 style="color:#ffc67b">Celebrate to its fullness<br>💕💕❤️🎂🎂</h5>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#views-model" style="background-color:#ff69b4; color:#fff;">view Message</button>
                  </div>
                </div>

              </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev" >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next" >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <!-- this is the messages section -->
          <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="nav-profile-tab">
              <!-- this is the sample messages section -->

               <table class="table table-hover">

                <thead>
                <tr>
                  <th scope="col">Actions</th>
                  <th scope="col">Sample Messages </th>
                </tr>
                </thead>
                
                <tbody>
                
                <?php 
                  require("config.php");
                  
                  $sql_options = "SELECT m_body FROM messages WHERE  m_type = 'sample'";
                  $result = $conn->query($sql_options);

                  $smdata = "";

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $smdata = '<tr class="table-secondary"> <th scope="row"> <button type="button" class="btn btn-outline-primary"> Choose </button> </th> <td>' . 
                          $row["m_body"]. '</td></tr> ' ;
                          echo $smdata;
                      }
                  }
                  else{
                    $smdata = '';
                    echo $smdata;
                  }

                ?>
                
                </tbody>
              </table>
                
          

              <!-- this is the custom messages section  -->
               <table class="table table-hover">

                <thead>
                <tr>
                  <th scope="col">Actions</th>
                  <th scope="col">Custom Messages </th>
                </tr>
                </thead>
                <tbody>
                
                
                    <?php
                    require("config.php");
                    $userid = $_SESSION['user id'];
                    $sql_options = "SELECT m_id, m_body FROM messages WHERE m_type = 'custom' and m_ruid = $userid";
                    $result = $conn->query($sql_options);

                    $cmdata = "";
                            global $messageID,$messageBody;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $messageID = htmlspecialchars($row["m_id"]);
                            $messageBody = htmlspecialchars($row["m_body"]);
                            
                            $cmdata .= '<tr class="table-secondary"> 
                                          <th id="' . $messageID . '" scope="row"> 
                                            <a data-bs-toggle="modal" data-bs-target="#update-message-modal" 
                                              class="btn btn-outline-primary">Edit</a> |
                                               <a class="btn btn-outline-danger" href="messages.php?action=delete&mid=' .  $messageID. '" role="button">Delete</a>
                                          </th> 
                                          <td>' . $messageBody . '</td>
                                        </tr>';
                        }
                        echo $cmdata;
                    } else {
                        echo '<tr><td colspan="2">No messages found</td></tr>';
                    }
                    ?>

                </tbody>
                </table>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#message-modal">
                    Add messages
                </button>
            </div>
          
      
          
          <!-- this is the contacts section -->
          <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="bd-example">
              <table class="table table-hover">

                <thead>
                <tr>
                  <th scope="col">Actions</th>
                  <th scope="col">First Name </th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Birthdate </th>
                  <th scope="col">Message to be sent </th>
                </tr>
                </thead>
                <tbody>
                
                <?php 
                  require("config.php");

                  $sql_options = "SELECT c_id,cf_name,cl_name,c_cntcode, c_pnum,c_dob,c_mid FROM contacts WHERE c_ruid = $userid";
                  $result = $conn->query($sql_options);

                  $contactoptions = "";
                  global $contactid,$ufirstname,$ulastname,$udob,$uphonenumber,$ucountrycode,$ucmessageid;
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $contactid = htmlspecialchars($row["c_id"]);
                        $ufirstname = htmlspecialchars($row["cf_name"]);
                        $ulastname = htmlspecialchars($row["cl_name"]);
                        $udob = htmlspecialchars($row["c_dob"]);
                        $uphonenumber = htmlspecialchars($row["c_pnum"]);
                        $ucountrycode = htmlspecialchars($row["c_cntcode"]);
                        $ucmessageid = htmlspecialchars($row["c_mid"]);

                          $contactoptions = '<tr class="table-secondary"> <th scope="row" id = '.$contactid.'>
                <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#update-contact-modal" role="button">Edit</a> |
                <a class="btn btn-outline-danger" href="contacts.php?action=delete&cid=' . $contactid . '" role="button">Delete</a>
            </th> <td>' . 
                          $ufirstname. '</td> <td>' .$ulastname . '</td> <td>' . htmlspecialchars($ucountrycode." ".$uphonenumber) . '</td> <td>'.$udob . '</td> <td>' .$ucmessageid. '</td> </tr>';
                          echo $contactoptions;
                      }
                  }
                  else{
                    $contactoptions = '';
                    echo $contactoptions;
                  }

  ?>
                
                </tbody>
              </table>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contact-modal"  >
                Add contact
              </button>
            </div>
          </div>
          
        </div>
      </div>
    </div> 

    <!-- these divs are hidden by default and Displays when the targeted button is clicked  -->
    
     
     <!-- this is the Add messages modal -->
     <div class="modal fade" id="message-modal" tabindex="-1" aria-labelledby="message-modal-title" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="message-modal-title">Add Message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="custom_addition_message.php" method="post" id = "custom_message">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Type your custom message" id="floatingTextarea" name="new_message"></textarea>
                  <label for="floatingTextarea">Message</label>
                </div>
              </form>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            
            <button type="submit" class="btn btn-outline-danger" name="Add_message"  id="message" onclick="submitmessage()">Add</button>
            



            <!-- script for submitting form -->
             <script>
                function submitmessage(){
                  document.getElementById('custom_message').submit();
                }
             </script>
        </div>
      </div>
    </div> 
  </div>



     <!-- this is the Add Contacts modal -->
    <div class="modal fade" id="contact-modal" tabindex="-1" aria-labelledby="contact-modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="contact-modal-title">Add Contact</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="contacts.php" method = 'POST' id="contact" class="needs-validation" novalidate>
            <input type="hidden" name="contactlist" value="Add">
            <div class="row g-3">
              <div class="col-6">
                <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="cfname">
              </div>
              <div class="col-6">
                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="clname">
              </div>
              
              <div class="col-4">
                <select id="country_code"  required class="form-select" name="ccntcd">
                  <option selected>country code</option>
                  <option value="+233">Ghana (+233)</option>
                  <option value="93">Afghanistan (+93)</option>
                  <option value="355">Albania (+355)</option>
                  <option value="213">Algeria (+213)</option>
                  <option value="1684">American Samoa (+1684)</option>
                  <option value="376">Andorra (+376)</option>
                  <option value="244">Angola (+244)</option>
                  <option value="1264">Anguilla (+1264)</option>
                  <option value="672">Antarctica (+672)</option>
                  <option value="1268">Antigua and Barbuda (+1268)</option>
                  <option value="54">Argentina (+54)</option>
                  <option value="374">Armenia (+374)</option>
                  <option value="297">Aruba (+297)</option>
                  <option value="61">Australia (+61)</option>
                  <option value="43">Austria (+43)</option>
                  <option value="994">Azerbaijan (+994)</option>
                  <option value="1242">Bahamas (+1242)</option>
                  <option value="973">Bahrain (+973)</option>
                  <option value="880">Bangladesh (+880)</option>
                  <option value="1246">Barbados (+1246)</option>
                  <option value="375">Belarus (+375)</option>
                  <option value="32">Belgium (+32)</option>
                  <option value="501">Belize (+501)</option>
                  <option value="229">Benin (+229)</option>
                  <option value="1441">Bermuda (+1441)</option>
                  <option value="975">Bhutan (+975)</option>
                  <option value="591">Bolivia (+591)</option>
                  <option value="387">Bosnia and Herzegovina (+387)</option>
                  <option value="267">Botswana (+267)</option>
                  <option value="55">Brazil (+55)</option>
                  <option value="246">British Indian Ocean Territory (+246)</option>
                  <option value="1284">British Virgin Islands (+1284)</option>
                  <option value="673">Brunei (+673)</option>
                  <option value="359">Bulgaria (+359)</option>
                  <option value="226">Burkina Faso (+226)</option>
                  <option value="257">Burundi (+257)</option>
                  <option value="855">Cambodia (+855)</option>
                  <option value="237">Cameroon (+237)</option>
                  <option value="1">Canada (+1)</option>
                  <option value="238">Cape Verde (+238)</option>
                  <option value="1345">Cayman Islands (+1345)</option>
                  <option value="236">Central African Republic (+236)</option>
                  <option value="235">Chad (+235)</option>
                  <option value="56">Chile (+56)</option>
                  <option value="86">China (+86)</option>
                  <option value="61">Christmas Island (+61)</option>
                  <option value="61">Cocos Islands (+61)</option>
                  <option value="57">Colombia (+57)</option>
                  <option value="269">Comoros (+269)</option>
                  <option value="682">Cook Islands (+682)</option>
                  <option value="506">Costa Rica (+506)</option>
                  <option value="385">Croatia (+385)</option>
                  <option value="53">Cuba (+53)</option>
                  <option value="599">Curacao (+599)</option>
                  <option value="357">Cyprus (+357)</option>
                  <option value="420">Czech Republic (+420)</option>
                  <option value="45">Denmark (+45)</option>
                  <option value="253">Djibouti (+253)</option>
                  <option value="1767">Dominica (+1767)</option>
                  <option value="1849">Dominican Republic (+1849)</option>
                  <option value="593">Ecuador (+593)</option>
                  <option value="20">Egypt (+20)</option>
                  <option value="503">El Salvador (+503)</option>
                  <option value="240">Equatorial Guinea (+240)</option>
                  <option value="291">Eritrea (+291)</option>
                  <option value="372">Estonia (+372)</option>
                  <option value="251">Ethiopia (+251)</option>
                  <option value="500">Falkland Islands (+500)</option>
                  <option value="298">Faroe Islands (+298)</option>
                  <option value="679">Fiji (+679)</option>
                  <option value="358">Finland (+358)</option>
                  <option value="33">France (+33)</option>
                  <option value="594">French Guiana (+594)</option>
                  <option value="689">French Polynesia (+689)</option>
                  <option value="241">Gabon (+241)</option>
                  <option value="220">Gambia (+220)</option>
                  <option value="995">Georgia (+995)</option>
                  <option value="49">Germany (+49)</option>
                  <option value="350">Gibraltar (+350)</option>
                  <option value="30">Greece (+30)</option>
                  <option value="299">Greenland (+299)</option>
                  <option value="1473">Grenada (+1473)</option>
                  <option value="590">Guadeloupe (+590)</option>
                  <option value="1671">Guam (+1671)</option>
                  <option value="502">Guatemala (+502)</option>
                  <option value="224">Guinea (+224)</option>
                  <option value="245">Guinea-Bissau (+245)</option>
                  <option value="592">Guyana (+592)</option>
                  <option value="509">Haiti (+509)</option>
                  <option value="504">Honduras (+504)</option>
                  <option value="852">Hong Kong (+852)</option>
                  <option value="36">Hungary (+36)</option>
                  <option value="354">Iceland (+354)</option>
                  <option value="91">India (+91)</option>
                  <option value="62">Indonesia (+62)</option>
                  <option value="98">Iran (+98)</option>
                  <option value="964">Iraq (+964)</option>
                  <option value="353">Ireland (+353)</option>
                  <option value="972">Israel (+972)</option>
                  <option value="39">Italy (+39)</option>
                  <option value="225">Ivory Coast (+225)</option>
                  <option value="1876">Jamaica (+1876)</option>
                  <option value="81">Japan (+81)</option>
                  <option value="962">Jordan (+962)</option>
                  <option value="7">Kazakhstan (+7)</option>
                  <option value="254">Kenya (+254)</option>
                  <option value="686">Kiribati (+686)</option>
                  <option value="383">Kosovo (+383)</option>
                  <option value="965">Kuwait (+965)</option>
                  <option value="996">Kyrgyzstan (+996)</option>
                  <option value="856">Laos (+856)</option>
                  <option value="371">Latvia (+371)</option>
                  <option value="961">Lebanon (+961)</option>
                  <option value="266">Lesotho (+266)</option>
                  <option value="231">Liberia (+231)</option>
                  <option value="218">Libya (+218)</option>
                  <option value="423">Liechtenstein (+423)</option>
                  <option value="370">Lithuania (+370)</option>
                  <option value="352">Luxembourg (+352)</option>
                  <option value="853">Macau (+853)</option>
                  <option value="389">Macedonia (+389)</option>
                  <option value="261">Madagascar (+261)</option>
                  <option value="265">Malawi (+265)</option>
                  <option value="60">Malaysia (+60)</option>
                  <option value="960">Maldives (+960)</option>
                  <option value="223">Mali (+223)</option>
                  <option value="356">Malta (+356)</option>
                  <option value="692">Marshall Islands (+692)</option>
                  <option value="596">Martinique (+596)</option>
                  <option value="222">Mauritania (+222)</option>
                  <option value="230">Mauritius (+230)</option>
                  <option value="262">Mayotte (+262)</option>
                  <option value="52">Mexico (+52)</option>
                  <option value="691">Micronesia (+691)</option>
                  <option value="373">Moldova (+373)</option>
                  <option value="377">Monaco (+377)</option>
                  <option value="976">Mongolia (+976)</option>
                  <option value="382">Montenegro (+382)</option>
                  <option value="1664">Montserrat (+1664)</option>
                  <option value="212">Morocco (+212)</option>
                  <option value="258">Mozambique (+258)</option>
                  <option value="95">Myanmar (+95)</option>
                  <option value="264">Namibia (+264)</option>
                  <option value="674">Nauru (+674)</option>
                  <option value="977">Nepal (+977)</option>
                  <option value="31">Netherlands (+31)</option>
                  <option value="687">New Caledonia (+687)</option>
                  <option value="64">New Zealand (+64)</option>
                  <option value="505">Nicaragua (+505)</option>
                  <option value="227">Niger (+227)</option>
                  <option value="234">Nigeria (+234)</option>
                  <option value="683">Niue (+683)</option>
                  <option value="850">North Korea (+850)</option>
                  <option value="1670">Northern Mariana Islands (+1670)</option>
                  <option value="47">Norway (+47)</option>
                  <option value="968">Oman (+968)</option>
                  <option value="92">Pakistan (+92)</option>
                  <option value="680">Palau (+680)</option>
                  <option value="970">Palestine (+970)</option>
                  <option value="507">Panama (+507)</option>
                  <option value="675">Papua New Guinea (+675)</option>
                  <option value="595">Paraguay (+595)</option>
                  <option value="51">Peru (+51)</option>
                  <option value="63">Philippines (+63)</option>
                  <option value="+64">Pitcairn (+64)</option>
                  <option value="+48">Poland (+48)</option>
                  <option value="+351">Portugal (+351)</option>
                  <option value="+1-787">Puerto Rico (+1-787)</option>
                  <option value="+1-939">Puerto Rico (+1-939)</option>
                  <option value="+974">Qatar (+974)</option>
                  <option value="+242">Republic of the Congo (+242)</option>
                  <option value="+40">Romania (+40)</option>
                  <option value="+7">Russia (+7)</option>
                  <option value="+250">Rwanda (+250)</option>
                  <option value="+590">Saint Barthelemy (+590)</option>
                  <option value="+290">Saint Helena (+290)</option>
                  <option value="+1-869">Saint Kitts and Nevis (+1-869)</option>
                  <option value="+1-758">Saint Lucia (+1-758)</option>
                  <option value="+590">Saint Martin (+590)</option>
                  <option value="+508">Saint Pierre and Miquelon (+508)</option>
                  <option value="+1-784">Saint Vincent and the Grenadines (+1-784)</option>
                  <option value="+685">Samoa (+685)</option>
                  <option value="+378">San Marino (+378)</option>
                  <option value="+239">Sao Tome and Principe (+239)</option>
                  <option value="+966">Saudi Arabia (+966)</option>
                  <option value="+221">Senegal (+221)</option>
                  <option value="+381">Serbia (+381)</option>
                  <option value="+248">Seychelles (+248)</option>
                  <option value="+232">Sierra Leone (+232)</option>
                  <option value="+65">Singapore (+65)</option>
                  <option value="+1-721">Sint Maarten (+1-721)</option>
                  <option value="+421">Slovakia (+421)</option>
                  <option value="+386">Slovenia (+386)</option>
                  <option value="+677">Solomon Islands (+677)</option>
                  <option value="+252">Somalia (+252)</option>
                  <option value="+27">South Africa (+27)</option>
                  <option value="+82">South Korea (+82)</option>
                  <option value="+211">South Sudan (+211)</option>
                  <option value="+34">Spain (+34)</option>
                  <option value="+94">Sri Lanka (+94)</option>
                  <option value="+249">Sudan (+249)</option>
                  <option value="+597">Suriname (+597)</option>
                  <option value="+47">Svalbard and Jan Mayen (+47)</option>
                  <option value="+268">Swaziland (+268)</option>
                  <option value="+46">Sweden (+46)</option>
                  <option value="+41">Switzerland (+41)</option>
                  <option value="+963">Syria (+963)</option>
                  <option value="+886">Taiwan (+886)</option>
                  <option value="+992">Tajikistan (+992)</option>
                  <option value="+255">Tanzania (+255)</option>
                  <option value="+66">Thailand (+66)</option>
                  <option value="+228">Togo (+228)</option>
                  <option value="+690">Tokelau (+690)</option>
                  <option value="+676">Tonga (+676)</option>
                  <option value="+1-868">Trinidad and Tobago (+1-868)</option>
                  <option value="+216">Tunisia (+216)</option>
                  <option value="+90">Turkey (+90)</option>
                  <option value="+993">Turkmenistan (+993)</option>
                  <option value="+1-649">Turks and Caicos Islands (+1-649)</option>
                  <option value="+688">Tuvalu (+688)</option>
                  <option value="+1-340">U.S. Virgin Islands (+1-340)</option>
                  <option value="+256">Uganda (+256)</option>
                  <option value="+380">Ukraine (+380)</option>
                  <option value="+971">United Arab Emirates (+971)</option>
                  <option value="+44">United Kingdom (+44)</option>
                  <option value="+1">United States (+1)</option>
                  <option value="+598">Uruguay (+598)</option>
                  <option value="+998">Uzbekistan (+998)</option>
                  <option value="+678">Vanuatu (+678)</option>
                  <option value="+379">Vatican (+379)</option>
                  <option value="+58">Venezuela (+58)</option>
                  <option value="+84">Vietnam (+84)</option>
                  <option value="+681">Wallis and Futuna (+681)</option>
                  <option value="+212">Western Sahara (+212)</option>
                  <option value="+967">Yemen (+967)</option>
                  <option value="+260">Zambia (+260)</option>
                  <option value="+263">Zimbabwe (+263)</option>
                </select>
              </div>
              <div class="col-8">
                  <input type="text" class="form-control"placeholder="Phone" id="phone" name="cphone" required>
                  <div class="invalid-feedback">
                  Please enter person's phone number.
                  </div>
              </div>
              <div class="col-12">
                <input type="date" class="form-control" id="date_of_birth" name="cdob" required>
                <div class="invalid-feedback">
                input  date of birth.
                </div>
              </div>
              <div class="col-12">
              
            <label for="messages">
                Messages:
                <select  id="messages" name="cmsgid">
                    <!-- Options loaded dynamically -->
                    <?php
                    require("config.php");

                    $userid = $_SESSION['user id'];
                    $sql_options = "SELECT m_id, m_body FROM messages WHERE m_type='sample'OR m_ruid = '$userid'";
                    $result = $conn->query($sql_options);

                    $options2 = "";

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $options2 .= '<option value="' . $row["m_id"] . '">' . htmlspecialchars($row["m_body"]) . '</option>';
                        }
                    } else {
                        $options2 .= '<option value="">No options available</option>';
                    }

                    $conn->close();
                    echo $options2;
                    ?>
                    <option value="add_new">Add new message</option>
                </select>
            </label>
              </div>
            </div>    
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            
            
            <button type="submit" class="btn btn-outline-danger" name="Add_contact"  id="contact" onclick="submitcontact()">Add</button>
            


            <!-- script for submitting form -->
            <script>
                function submitcontact(){
                  document.getElementById('contact').submit();
                }
             </script>
        </div>
      </div>
    </div>
    </div>

     <!-- Updates -->
          
                 

                <!-- this is the Update messages modal -->
    <!-- Update messages modal -->
<div class="modal fade" id="update-message-modal" tabindex="-1" aria-labelledby="update-message-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-message-modal-title">Update Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="messages.php" method="post" id="custom_message_update">
                  <input type="hidden" name="updatemessage" value="Update">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Type your custom message" id="floatingTextarea" name="changed_message"><?php echo $messageBody; ?></textarea>
                        <label for="floatingTextarea">Update your message</label>
                    </div>
                    <input type="hidden" name="umsgid" value="<?php echo $messageID; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="custom_message_update" class="btn btn-outline-danger" name="Update_message" id="changed_message">Update</button>
            </div>
        </div>
    </div>
</div>



                
                <!-- this is for updating contacts -->
 <div class="modal fade" id="update-contact-modal" tabindex="-1" aria-labelledby="update-contact-modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="update-contact-modal-title">Update Contact</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="contacts.php" method = 'POST' id="update-contact" class="needs-validation" novalidate>
            <input type="hidden" name="contactlist" value="Update">
            <div class="row g-3">
              <div class="col-6">
                <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="u_cfname" value="<?php echo $ufirstname?>">
              </div>
              <div class="col-6">
                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="u_clname" value="<?php echo $ulastname?>">>
              </div>
              
              <div class="col-4">
              <select id="country_code" required class="form-select" name="u_ccntcd">
              <option selected>Country code</option>
              <?php
              $countryCodes = [
                "+233" => "Ghana (+233)",
                "93" => "Afghanistan (+93)",
                "355" => "Albania (+355)",
                "213" => "Algeria (+213)",
                "1684" => "American Samoa (+1684)",
                "376" => "Andorra (+376)",
                "244" => "Angola (+244)",
                "1264" => "Anguilla (+1264)",
                "672" => "Antarctica (+672)",
                "1268" => "Antigua and Barbuda (+1268)",
                "54" => "Argentina (+54)",
                "374" => "Armenia (+374)",
                "297" => "Aruba (+297)",
                "61" => "Australia (+61)",
                "43" => "Austria (+43)",
                "994" => "Azerbaijan (+994)",
                "1242" => "Bahamas (+1242)",
                "973" => "Bahrain (+973)",
                "880" => "Bangladesh (+880)",
                "1246" => "Barbados (+1246)",
                "375" => "Belarus (+375)",
                "32" => "Belgium (+32)",
                "501" => "Belize (+501)",
                "229" => "Benin (+229)",
                "1441" => "Bermuda (+1441)",
                "975" => "Bhutan (+975)",
                "591" => "Bolivia (+591)",
                "387" => "Bosnia and Herzegovina (+387)",
                "267" => "Botswana (+267)",
                "55" => "Brazil (+55)",
                "246" => "British Indian Ocean Territory (+246)",
                "1284" => "British Virgin Islands (+1284)",
                "673" => "Brunei (+673)",
                "359" => "Bulgaria (+359)",
                "226" => "Burkina Faso (+226)",
                "257" => "Burundi (+257)",
                "855" => "Cambodia (+855)",
                "237" => "Cameroon (+237)",
                "1" => "Canada (+1)",
                "238" => "Cape Verde (+238)",
                "1345" => "Cayman Islands (+1345)",
                "236" => "Central African Republic (+236)",
                "235" => "Chad (+235)",
                "56" => "Chile (+56)",
                "86" => "China (+86)",
                "+61" => "Christmas Island (+61)",
                /* "+61" => "Cocos Islands (+61)", */
                "57" => "Colombia (+57)",
                "269" => "Comoros (+269)",
                "682" => "Cook Islands (+682)",
                "506" => "Costa Rica (+506)",
                "385" => "Croatia (+385)",
                "53" => "Cuba (+53)",
                "599" => "Curacao (+599)",
                "357" => "Cyprus (+357)",
                "420" => "Czech Republic (+420)",
                "45" => "Denmark (+45)",
                "253" => "Djibouti (+253)",
                "1767" => "Dominica (+1767)",
                "1849" => "Dominican Republic (+1849)",
                "593" => "Ecuador (+593)",
                "20" => "Egypt (+20)",
                "503" => "El Salvador (+503)",
                "240" => "Equatorial Guinea (+240)",
                "291" => "Eritrea (+291)",
                "372" => "Estonia (+372)",
                "251" => "Ethiopia (+251)",
                "500" => "Falkland Islands (+500)",
                "298" => "Faroe Islands (+298)",
                "679" => "Fiji (+679)",
                "358" => "Finland (+358)",
                "33" => "France (+33)",
                "594" => "French Guiana (+594)",
                "689" => "French Polynesia (+689)",
                "241" => "Gabon (+241)",
                "220" => "Gambia (+220)",
                "995" => "Georgia (+995)",
                "49" => "Germany (+49)",
                "350" => "Gibraltar (+350)",
                "30" => "Greece (+30)",
                "299" => "Greenland (+299)",
                "1473" => "Grenada (+1473)",
                "590" => "Guadeloupe (+590)",
                "1671" => "Guam (+1671)",
                "502" => "Guatemala (+502)",
                "224" => "Guinea (+224)",
                "245" => "Guinea-Bissau (+245)",
                "592" => "Guyana (+592)",
                "509" => "Haiti (+509)",
                "504" => "Honduras (+504)",
                "852" => "Hong Kong (+852)",
                "36" => "Hungary (+36)",
                "354" => "Iceland (+354)",
                "91" => "India (+91)",
                "62" => "Indonesia (+62)",
                "98" => "Iran (+98)",
                "964" => "Iraq (+964)",
                "353" => "Ireland (+353)",
                "972" => "Israel (+972)",
                "39" => "Italy (+39)",
                "225" => "Ivory Coast (+225)",
                "1876" => "Jamaica (+1876)",
                "81" => "Japan (+81)",
                "962" => "Jordan (+962)",
                "7" => "Kazakhstan (+7)",
                "254" => "Kenya (+254)",
                "686" => "Kiribati (+686)",
                "383" => "Kosovo (+383)",
                "965" => "Kuwait (+965)",
                "996" => "Kyrgyzstan (+996)",
                "856" => "Laos (+856)",
                "371" => "Latvia (+371)",
                "961" => "Lebanon (+961)",
                "266" => "Lesotho (+266)",
                "231" => "Liberia (+231)",
                "218" => "Libya (+218)",
                "423" => "Liechtenstein (+423)",
                "370" => "Lithuania (+370)",
                "352" => "Luxembourg (+352)",
                "853" => "Macau (+853)",
                "389" => "Macedonia (+389)",
                "261" => "Madagascar (+261)",
                "265" => "Malawi (+265)",
                "60" => "Malaysia (+60)",
                "960" => "Maldives (+960)",
                "223" => "Mali (+223)",
                "356" => "Malta (+356)",
                "692" => "Marshall Islands (+692)",
                "596" => "Martinique (+596)",
                "222" => "Mauritania (+222)",
                "230" => "Mauritius (+230)",
                "262" => "Mayotte (+262)",
                "52" => "Mexico (+52)",
                "691" => "Micronesia (+691)",
                "373" => "Moldova (+373)",
                "377" => "Monaco (+377)",
                "976" => "Mongolia (+976)",
                "382" => "Montenegro (+382)",
                "1664" => "Montserrat (+1664)",
                "212" => "Morocco (+212)",
                "258" => "Mozambique (+258)",
                "95" => "Myanmar (+95)",
                "264" => "Namibia (+264)",
                "674" => "Nauru (+674)",
                "977" => "Nepal (+977)",
                "31" => "Netherlands (+31)",
                "687" => "New Caledonia (+687)",
                "64" => "New Zealand (+64)",
                "505" => "Nicaragua (+505)",
                "227" => "Niger (+227)",
                "234" => "Nigeria (+234)",
                "683" => "Niue (+683)",
                "850" => "North Korea (+850)",
                "1670" => "Northern Mariana Islands (+1670)",
                "47" => "Norway (+47)",
                "968" => "Oman (+968)",
                "92" => "Pakistan (+92)",
                "680" => "Palau (+680)",
                "970" => "Palestine (+970)",
                "507" => "Panama (+507)",
                "675" => "Papua New Guinea (+675)",
                "595" => "Paraguay (+595)",
                "51" => "Peru (+51)",
                "63" => "Philippines (+63)",
                "48" => "Poland (+48)",
                "351" => "Portugal (+351)",
                "1787" => "Puerto Rico (+1787)",
                "974" => "Qatar (+974)",
                "242" => "Republic of the Congo (+242)",
                "+262" => "Reunion (+262)",
                "40" => "Romania (+40)",
                "+7" => "Russia (+7)",
                "250" => "Rwanda (+250)",
                "290" => "Saint Helena (+290)",
                "1869" => "Saint Kitts and Nevis (+1869)",
                "1758" => "Saint Lucia (+1758)",
                "508" => "Saint Pierre and Miquelon (+508)",
                "1784" => "Saint Vincent and the Grenadines (+1784)",
                "685" => "Samoa (+685)",
                "378" => "San Marino (+378)",
                "239" => "Sao Tome and Principe (+239)",
                "966" => "Saudi Arabia (+966)",
                "221" => "Senegal (+221)",
                "381" => "Serbia (+381)",
                "248" => "Seychelles (+248)",
                "232" => "Sierra Leone (+232)",
                "65" => "Singapore (+65)",
                "1721" => "Sint Maarten (+1721)",
                "421" => "Slovakia (+421)",
                "386" => "Slovenia (+386)",
                "677" => "Solomon Islands (+677)",
                "252" => "Somalia (+252)",
                "27" => "South Africa (+27)",
                "82" => "South Korea (+82)",
                "211" => "South Sudan (+211)",
                "34" => "Spain (+34)",
                "94" => "Sri Lanka (+94)",
                "249" => "Sudan (+249)",
                "597" => "Suriname (+597)",
                "268" => "Swaziland (+268)",
                "46" => "Sweden (+46)",
                "41" => "Switzerland (+41)",
                "963" => "Syria (+963)",
                "886" => "Taiwan (+886)",
                "992" => "Tajikistan (+992)",
                "255" => "Tanzania (+255)",
                "66" => "Thailand (+66)",
                "228" => "Togo (+228)",
                "690" => "Tokelau (+690)",
                "676" => "Tonga (+676)",
                "1868" => "Trinidad and Tobago (+1868)",
                "216" => "Tunisia (+216)",
                "90" => "Turkey (+90)",
                "993" => "Turkmenistan (+993)",
                "1649" => "Turks and Caicos Islands (+1649)",
                "688" => "Tuvalu (+688)",
                "256" => "Uganda (+256)",
                "380" => "Ukraine (+380)",
                "971" => "United Arab Emirates (+971)",
                "44" => "United Kingdom (+44)",
                "+1" => "United States (+1)",
                "598" => "Uruguay (+598)",
                "998" => "Uzbekistan (+998)",
                "678" => "Vanuatu (+678)",
                "379" => "Vatican (+379)",
                "58" => "Venezuela (+58)",
                "84" => "Vietnam (+84)",
                "+1284" => "British Virgin Islands (+1284)",
                "1340" => "U.S. Virgin Islands (+1340)",
                "681" => "Wallis and Futuna (+681)",
                "+212" => "Western Sahara (+212)",
                "967" => "Yemen (+967)",
                "260" => "Zambia (+260)",
                "263" => "Zimbabwe (+263)"
              ];

              foreach ($countryCodes as $code => $name) {
                $selected = ($code == $ucountrycode) ? 'selected' : '';
                echo "<option value=\"$code\" $selected>$name</option>";
              }
              ?>
            </select>


                  
                 
              </div>
              <div class="col-8">
                  <input type="text" class="form-control"placeholder="Phone" id="phone" name="u_cphone" required value="<?php echo $uphonenumber?>">
                  <div class="invalid-feedback">
                  Please enter person's phone number.
                  </div>
              </div>
              <div class="col-12">
                <input type="date" class="form-control" id="date_of_birth" name="u_cdob" required required value="<?php echo $udob?>">
                <div class="invalid-feedback">
                input  date of birth.
                </div>
              </div>
              <div class="col-12">
              
              <label for="messages">
                Messages:
                <select id="messages" name="u_cmsgid" required>
                  <!-- Options loaded dynamically -->
                  <?php
                  require("config.php");

                  $sql_options = "SELECT m_id, m_body FROM messages WHERE m_type='sample' OR m_ruid = '$userid'";
                  $result = $conn->query($sql_options);

                  $options2 = "";

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $selected = ($row["m_id"] == $ucmessageid) ? 'selected' : '';
                      $options2 .= '<option value="' . $row["m_id"] . '" ' . $selected . '>' . htmlspecialchars($row["m_body"]) . '</option>';
                    }
                  } else {
                    $options2 .= '<option value="">No options available</option>';
                  }

                  $conn->close();
                  echo $options2;
                  ?>
                  <option value="add_new">Add new message</option>
                </select>
              </label>

              </div>
            </div>
            <input type="hidden" name="ucid" value="<?php echo $contactid; ?>">    
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            
            
            <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('update-contact').submit();">Update</button>
            


            <!-- script for submitting form -->
            <script>
                /* function updatecontact(){
                  document.getElementById('upcontact').submit();
                } */
             </script>
        </div>
      </div>
    </div>
    </div>



     <!-- this is the logout modal -->
    <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="logout-modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logout-modal-title">Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>This will log you out. Do you still want to proceed?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            
            <form action="logout.php" method="post">
            <button type="submit" class="btn btn-outline-danger" name="logout"  id="logout">Logout</button>
            </form>
        </div>
      </div>
    </div>
    </div>


    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- <script src="dashboard.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>

  </body>
</html>

