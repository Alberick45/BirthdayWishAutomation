<?php
session_start();
require("config.php");
// include("automatic_message_sending.php");

global $conn;
if (!isset($_SESSION['user id'])) {
    header("Location: ../../index.php");
    echo "You are not logged in";
    session_destroy();
    exit();
} 
else {
    $user_id = $_SESSION['user id'];
    $userdata = "SELECT * FROM registered_users WHERE ru_id= '$user_id'";
    $result = $conn -> query($userdata);
    $row = $result -> fetch_assoc();
    $user_id = $row["ru_id"];
    $user_status = $_SESSION["status"];
    $Password = $row["ru_pass"];
    $user_name = $row['ru_name'];
    $last_name=$row["rul_name"];
    $first_name =$row["ruf_name"];
    $date_of_birth=$row["ru_dob"];
    $countryCodes = $_SESSION["countrycodes"];;
    $phone =$row["ru_pnum"];
    $count_code =$row["ru_cntcode"];
    $profile_pic =$row["ru_pic"];
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    

    // Fetch messages for the logged-in user
    $recipient_name = "";
    $recipient_dob = "";
    $recipient_phone = "";
    $recipient_age = 0;
    $message = "";
    $recipients = [];
    $carouselItems = '';
    $carouselIndicators = '';
    $isActive = true;
    $index = 0;
    $sender = $user_name;
    
    // Fetch contacts whose date of birth matches today's day and month
    $sql = "SELECT cf_name, c_ruid, cl_name, c_dob, c_mid, CONCAT(c_cntcode, c_pnum) AS phone 
            FROM contacts 
            WHERE MONTH(c_dob) >= MONTH(CURDATE()) AND c_ruid = $user_id AND m_stat = 0";
    
    $recipient_result = $conn->query($sql);
    
    if ($recipient_result && $recipient_result->num_rows > 0) {
      while ($recipient_row = $recipient_result->fetch_assoc()) {
        $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
        $recipient_dob = $recipient_row['c_dob'];
        $recipient_phone = $recipient_row['phone'];
        $registererid = $recipient_row['c_ruid'];
        $recipient_messageid = $recipient_row['c_mid'];

        // Fetch the message body using message_id
        $stmt = $conn->prepare("SELECT m_body FROM messages WHERE m_id = ?");
        $stmt->bind_param("i", $recipient_messageid);
        $stmt->execute();
        $msg_result = $stmt->get_result();
        $msg_body = "";
        if ($msg_result && $msg_result->num_rows > 0) {
            $msg_row = $msg_result->fetch_assoc();
            $msg_body = $msg_row['m_body'];
        }
        $stmt->close();

        // Calculate recipient's age using DateTime
        if ($recipient_dob) {
            $dob = new DateTime($recipient_dob);
            $now = new DateTime();
            $recipient_age1 = $now->diff($dob)->y;
            if ($recipient_age1>0){
              $year_to_celebrate ='this year';
              $recipient_age=$recipient_age1;
              $personalized_message = str_ireplace("[Name]", htmlspecialchars($recipient_name), $msg_body);
              $personalized_message = str_ireplace("[Age]", htmlspecialchars($recipient_age), $personalized_message);
              $personalized_message = str_ireplace("[today]", htmlspecialchars($year_to_celebrate), $personalized_message);
              $personalized_message = str_ireplace("[Your Name]", htmlspecialchars($sender), $personalized_message);
            }
            else{
              $recipient_age= '1';
              $year_to_celebrate ='next year';
              $personalized_message = str_ireplace("[Name]", htmlspecialchars($recipient_name), $msg_body);
              $personalized_message = str_ireplace("[today]", htmlspecialchars($year_to_celebrate), $personalized_message);
              $personalized_message = str_ireplace("[Age]", htmlspecialchars($recipient_age),$personalized_message);
              $personalized_message = str_ireplace("[Your Name]", htmlspecialchars($sender), $personalized_message);
            }

          $activeClass = $isActive ? 'active' : '';
          $carouselItems .= "
          <div class='carousel-item rounded $activeClass'>
            <div class='carousel-caption py-0'>
              <h6 style='color:#ffffff;'>".$personalized_message."</h2>
              <small style='color:#ffffff;'>Celebrant phone number:".$recipient_phone."<br>Celebrant date of birth: (".$recipient_dob.")</small>
              <div class='nav nav-btn  justify-content-center' id='nav-tab' role='tablist'>
                <button type='button' class=' btn btn-outline-light' id='nav-profile-tab' style='font-size:0.8vw;' data-bs-toggle='tab' data-bs-target='#contacts' type='button' role='tab' aria-controls='nav-profile' aria-selected='false' style=' '>Go to Contacts >></button>
              </div>
            </div>
          </div>";
          $indicatorActiveClass = $isActive ? 'active' : '';
          $carouselIndicators .= "<button type='button' data-bs-target='#carouselExampleCaptions' data-bs-slide-to='$index' class='$indicatorActiveClass' aria-label='Slide ".($index + 1)."' style='background-color:#ffffff'></button>";
        }
          
          $isActive = false; // Only the first item should be active
          $index++;}}

    else {
      $carouselItems .= "
      <div class='carousel-item rounded active' style='min-height:200px;background-color:;'>
        <div class='carousel-caption '>
          <h2 style='color:#ffffff;'>No wish or contact to display</h2>
          <div class='nav  justify-content-center' id='nav-tab' role='tablist'>
            <button type='button' class=' btn btn-sm btn-outline-light' id='nav-profile-tab' data-bs-toggle='tab' data-bs-target='#contacts' type='button' role='tab' aria-controls='nav-profile' aria-selected='false' style=' '>Create one >></button>
          </div>
        </div>
      </div>";
        }    
    $favicon='img-6.ico';
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
    <title>WishMe | <?php echo $user_name?> </title>
    <link rel="shortcut icon" href="<?php echo $favicon?> " type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../../plugins/css/bootstrap.min.css" rel="stylesheet">

    <style>
      #top_header{
          transition: top 0.2s ease-in-out;
        }

      #top_header.scrolled{
          top:-50px;
        }

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
    background:rgb(233, 179, 30);
     margin-bottom: 2rem;
    /*background-repeat:no-repeat;
    background-size:100% 150%; */
    


    ;
    }
    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
      bottom: 3rem;
      z-index: 10;
    }
    
    /* Declare heights because of positioning of img element */
    .carousel-item {
      height: 20rem;

    }
    .carousel-item > img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 50vh;
    }
    #wish{
    transition: all 0.3s ease;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    }

    #wish:hover {
      background-color: #f0f0f0;
      transform: scale(1.05);
    }


    
    </style>

    <!-- Custom styles for this template -->
    <link href="../../plugins/css/dashboard.css" rel="stylesheet">

  </head>
  <body class='bg-light' style=" ">
   
    <header class="fixed-top  " style='background:  rgb(248, 82, 138)'> 
      <div class="px-3 text-white" style="background-color: indigo" >
        <div class="container">
          <div class="d-flex px-4 align-items-center justify-content-center justify-content-lg-start">
            <a  class="align-items-center  my-lg-0 me-lg-auto text-white text-decoration-none">
              <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg> -->
              <h3>WishMe</h3>
            </a>
            <ul class="nav col-12 col-lg-auto  justify-content-center my-md-0 text-small">
              <li>
                <a href="#" class="nav-link text-white"><!-- img-2.jpg -->
                  <img class="bi d-block mx-auto mb-1" width="40px" height="40px" src="../../plugins/images/users/<?php echo $profile_pic?>" style="border-radius:50%"></img>
                  <?php
                  echo''. $user_name.'';
                  ?>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg  navbar-light d-flex flex-wrap " aria-label="First navbar example">
        <div class="container-fluid d-flex ">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse content-start justify-content-center" id="navbarsExample01">
            <div class="nav" id="nav-tab" role="tablist">
              <button class=" nav-item btn-success text-white  rounded my-2 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"  style="border:0px; margin-right:5vw;">Home</button>
              <!-- <button class="nav-item btn-danger  my-2 rounded text-white " id="nav-messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="border:0px; margin-right:5vw;">Messages</button> -->
              <button class="nav-item btn-warning my-2 rounded text-white" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"style="border:0px; margin-right:5vw;">Contact</button>
              <?php 
              if ($user_status == "Admin"){
                echo '<a href="../../dashboard.php" type="button" class="btn btn-outline-primary my-2"  style="border:0px; margin-right:5vw;">Admin page</a>';
              }
              ?>

              <button type="button" class="btn btn-outline-primary my-2" data-bs-toggle="modal" data-bs-target="#credits-modal" style="border:0px; margin-right:5vw;">SMS.Credits</button>
              
              <button type="button" class="btn btn-outline-primary my-2" data-bs-toggle="modal" data-bs-target="#logout-modal" style="border:0px; margin-right:5vw;">Logout</button>
              
              </div>
          </div>
        </div>
      </nav>
    </header>

    <!-- this section hold all the contents of the page -->
    <div  style="padding:155px 10% 10px 10%; position:relative">

      <!--this is where users are able to nevigate through the sections of the page  -->
      <div class=' bg-light p-2 ' style="box-shadow: 0px 10px 30px rgba(140, 133, 133, 0.8); " >

        <!-- this is where the user gets access to all the contents of the page and make changes-->
        <div class="tab-content" id="nav-tabContent">
          
          <!-- This is the landing page -->
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row bg-info mx-2 my-2 px-2" id='' style=''>
              <div class="col py-1" style=" align-items:center;">
              <h1 style=' text-align:center;font-style: oblique; font-family: fantasy; font-size:5vw'>upcoming birthdays</h1>
              <div class="col">
                <div id="carouselExampleCaptions" style='height:min-content;'class="carousel rounded slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                    <?php echo $carouselIndicators;?>
                  </div>
                  <div class="carousel-inner ronded" >
                    <?php echo $carouselItems; ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>

              </div>
            </div>
            <hr>
            <div class='container'>
              <div class="row">
              <div class="col-12">
              <div class=" scrollable-div px-5 py-4" style=" overflow-x:auto; white-space:nowrap;">
                <?php $sql = "SELECT * FROM messages WHERE m_ruid = ? OR m_type = 'special' OR m_type = 'love' or m_type = 'important'";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param('i', $user_id);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $pics = ["../images/im1.jpg","../images/im2.jpg","../images/img-4.jpg","../images/im5.jpg",
                    "../images/im6.jpg","../images/im7.jpg","../images/im8.jpg","../images/im4.jpg","../images/im3.jpg",
                    "../images/img-1.jpg","../images/img-2.jpg","../images/im4.jpg","..images/im5.jpg",
                    "../images/im6.jpg","../images/im7.jpg","../images/im8.jpg","../images/im7.jpg","../images/im3.jpg",
                    "../images/im1.jpg","../images/im2.jpg","../images/im4.jpg","../images/im5.jpg",
                    "../images/im6.jpg","../images/im7.jpg","../images/im8.jpg","../images/im6.jpg","../images/im3.jpg"
                    ];
                    $wish_item='';
                  for ($i=0; $i < 20; $i++) { 
                    if ($row = $result->fetch_assoc()) {
                      $message = $row['m_body'];
                      $messageType = $row['m_type'];
                      $message_id =$row['m_id'];
                      echo ' 
                        <div class="col-hover hover-effect col-md-6 rounded mx-2"  style="display:inline-block;font-size:80%;">
                          <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="wish" style="border-radius:2rem; ">
                            <div class="col p-4 d-flex flex-column style="width:50px">
                              <strong class="d-inline-block mb-2 text-primary">FREE</strong>
                              <h2 class="mb-0">'.$messageType.'</h2>
                              <div class="mb-1 text-muted">message '.$message_id.'</div>
                              <p class="card-text mb-auto">'.substr($message,0,30).'</p>
                              <p class="card-text mb-auto">'.substr($message,30,30).'</p>
                              <p class="card-text mb-auto">'.substr($message,60,30).'</p>
                              <p class="card-text mb-auto">'.substr($message,90,30).'</p>
                              <p class="card-text mb-auto">'.substr($message,120,30).'</p>
                              <a class="stretched-link" data-bs-toggle="modal" data-bs-target="#contact-modal-'.$message_id.'" role="button">Send</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                              <img src='.htmlspecialchars($pics[$i]).' width="200" height="250">
                            </div>
                          </div>
                        </div>
                        <div class="modal fade" id="contact-modal-'.$message_id.'" tabindex="-1" aria-labelledby="contact-modal-title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="contact-modal-title">Sending "'.$messageType.'" Birthday Wish to🤷‍♀️🤷‍♂️🎂</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                              <div class="container p-3" >
                                You have selected 
                              </div>
                              <div class="row-md-6 rounded mx-2"  style="display:inline-block;min-width:40%;font-size:80%;">
                                <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="wish"style="border-radius:2rem; ">
                                  <div class="col p-4 d-flex flex-column ">
                                    <strong class="d-inline-block mb-2 text-primary">FREE</strong>
                                    <h2 class="mb-0">'.$messageType.'</h2>
                                    <div class="mb-1 text-muted">message '.$message_id.'</div>
                                    <p class="card-text mb-auto">'.substr($message,0,30).'</p>
                                    <p class="card-text mb-auto">'.substr($message,30,30).'</p>
                                    <p class="card-text mb-auto">'.substr($message,60,30).'</p>
                                    <p class="card-text mb-auto">'.substr($message,90,30).'</p>
                                    <p class="card-text mb-auto">'.substr($message,120,30).'</p>
                                  </div>
                                  <div class="col-auto d-none d-lg-block">
                                    <img src='.htmlspecialchars($pics[$i]).' width="200" height="250">
                                  </div>
                                </div>
                              </div>
                              <h3 class="my-2"> Fill in this form 👇 </h3>
                              <div class="mb-1 text-muted">What ever info you add will be replaced in the message body</div>
                              <hr>
                              <form action="contacts.php" method = "POST" id="contact" class="needs-validation" novalidate>
                                <input type="hidden" name="contactlist" value="Add">
                                <div class="row g-3">
                                  <div class="col-6">
                                    <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="cfname">
                                  </div>
                                  <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="clname">
                                  </div>
                                  
                                  <div class="col-4">
                                    <select id="country_code"  style="max-height:50px;" required class="form-select" name="ccntcd">
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
                                      <input type="number" class="form-control"placeholder="Phone" id="phone" name="cphone" required>
                                      <div class="invalid-feedback">
                                      Please enter person phone number.
                                      </div>
                                  </div>
                                  <div class="col-12">
                                  <div class="input-group ">
                                    <span class="input-group-text">Enter Birthdate</span>
                                    <input type="date" class="form-control" id="date_of_birth" name="cdob" required>
                                   </div>
                                    <div class="invalid-feedback">
                                    input  date of birth.
                                    </div>
                                  </div>
            
                                  <div class="col-12 ">
                                    <label for="messages">
                                      <input type="hidden" class="form-control" id='.$message_id.' name="cmsgid" value='.$message_id.' required>
                                      <div class="invalid-feedback">
                                        input  date of birth.
                                      </div>
                                    </label>
                                  </div>
                                </div> 
                              
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-danger" name="Add_contact"  id="contact">Add</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            </form>
                          </div>
                        </div>
                        </div>
                        '
                      ;
                    }
                  }
                  $stmt->close();
                ?>
              </div>
              </div>
              </div>
            </div>
          </div>
          
          <!-- this is the contacts section -->
          <div class="tab-pane p-5 " id="contacts" role="tabpanel" aria-labelledby="nav-contact-tab">
            <h2>All Contacts</h2><hr>
            </thead>
            <div class=" scrollable-div px-5" style="max-height:40vh; min-height: 30vh; overflow-y:scroll">
              <table class="table table-borderless table-hover">
                <tbody>   
                  <?php 
                    require("config.php");

                    $sql_options = "SELECT * FROM contacts WHERE c_ruid = $user_id";
                    $result = $conn->query($sql_options);
                  
                    if ($result->num_rows > 0) {
                        $table_num = 1;
                        while ($row = $result->fetch_assoc()) {
                        $contactid = htmlspecialchars($row["c_id"]);
                        $ufirstname = htmlspecialchars($row["cf_name"]);
                        $ulastname = htmlspecialchars($row["cl_name"]);
                        $udob = htmlspecialchars($row["c_dob"]);
                        $uphonenumber = htmlspecialchars($row["c_pnum"]);
                        $ucountrycode = htmlspecialchars($row["c_cntcode"]);
                        $message_stat = htmlspecialchars($row["m_stat"]);
                        $ucmessageid = htmlspecialchars($row["c_mid"]);
                        $error="";
                        $success ="";
                       if(isset($_GET['error'])){ 
                         $error=' <div class="alert alert-danger" role="alert">
                           '.$_GET['error'].'
                        </div>';
                      }
                      if(isset($_GET['success'])){ 
                      $success='<div class="alert alert-success" role="alert">
                      '.$_GET['success'].'
                      </div>';
                      }
                        $delete_contact_modal ='
                          <div class="modal fade" id="delete-contact-modal-'.$contactid.'" tabindex="-1" aria-labelledby="logout-modal-title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="Message-title-'.$contactid.'">'.$ufirstname.'  '.$ulastname.'</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>This will delete "'.$ufirstname.'" from your contact list. Do you want to continue?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <form action="contacts.php" method="post">
                                    <input name="contact_id" type="hidden" value="'.$contactid.'">
                                    <button type="submit" name="delete_contact" class="btn btn-danger">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>'
                          ;
                        $update_contact_modal='
                          <div class="modal fade" id="update-contact-modal-'.$contactid.'" tabindex="-1" aria-labelledby="update-contact-modal-title-'.$contactid.'" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="update-contact-modal-title-'.$contactid.'">Update Contact</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                  <form action="contacts.php" method="POST" id="update-contact" class="needs-validation" novalidate>
                                    '.$error.'
                                  '.$success.'
                                  <input type="hidden" name="contactlist" value="Update">
                                    <div class="row g-3">
                                      <div class="col-6">
                                        <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="u_cfname" value="'.$ufirstname.'">
                                      </div>
                                      <div class="col-6">
                                          <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="u_clname" value="'.$ulastname.'">
                                      </div>
                                      <div class="col-4">
                                        <select id="country_code"  required class="form-select" style="height:50px;" name="u_ccntcd">
                                          <option value="'.$ucountrycode.'" selected>Previous country: ('.$ucountrycode.')</option>
                                          <hr>
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
                                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="u_cphone" required value="'.$uphonenumber.'">
                                        <div class="invalid-feedback">Please enter phone number.</div>
                                      </div>
                                      <div class="col-12">
                                      <div class="input-group ">
                                      <span class="input-group-text">Enter Birthdate</span>
                                        <input type="date" class="form-control" id="date_of_birth" name="u_cdob" required value="'.$udob.'">
                                      </div>
                                        <div class="invalid-feedback">Input date of birth.</div>
                                      </div>
                                      <input type="hidden" name="ucid" value="'.$contactid.'">    
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-outline-danger">Update</button>
                                </div>
                                </form>
                              </div>
                            </div>
                            <!-- script for checking if all entriws are being entered form -->
                            
                          </div>
                          </div>
                          </div>'
                          ;
                        if(!$message_stat<1){
                      ?>
                      <tr class="table-primary"> 
                        <td class="table-info" style="font-size:1.5vw; width:5%;"><?php echo $table_num; ?></td>
                        <td class="" style="font-size:1.5vw;"><?php echo $ufirstname; ?></td>
                        <td style="">
                          <div class="dropstart" style="font-size:1.5vw;">
                            <nav class="nav" type="button" id="dropdownMenuButtonSM" data-bs-toggle="dropdown" aria-expanded="false">⁝</nav>
                            <ul class="dropdown-menu" style="min-width:5%;font-size:1.5vw;" aria-labelledby="dropdownMenuButtonSM">
                              <li><h3 class="dropdown-header">Sent ✅</h3></li>
                              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-contact-modal-<?php echo $contactid?>" role="button">Delete</a></li>
                              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target='#update-contact-modal-<?php echo $contactid?>' role="button">Update</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <?php echo $delete_contact_modal;?>
                      <?php echo $update_contact_modal;?>
                     
                      <?php
                        }
                        else{
                          ?>

                        <tr class="table-primary"> 
                        <td class="table-info" style="font-size:1.5vw; width:5%;"><?php echo $table_num; ?></td>
                        <td class="" style="font-size:1.5vw;"><?php echo $ufirstname; ?></td>
                        <td style="">
                          <div class="dropstart" style="font-size:1.5vw;">
                            <nav class="nav" type="button" id="dropdownMenuButtonSM" data-bs-toggle="dropdown" aria-expanded="false">⁝</nav>
                            <ul class="dropdown-menu" style="min-width:5%;font-size:1.5vw;" aria-labelledby="dropdownMenuButtonSM">
                              <li><h3 class="dropdown-header">Pending.... 🔒</h3></li>
                              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-contact-modal-<?php echo $contactid?>" role="button">Delete</a></li>
                              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target='#update-contact-modal-<?php echo $contactid?>' role="button">Update</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <?php echo $delete_contact_modal;?>
                      <?php echo $update_contact_modal;?>
                          <?php
                        }
                      $table_num++;
                      
                      }
                    } 
                    else {
                      echo "<tr><td colspan='6'>No contacts found.</td></tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <br>
            
            <!-- Add contact button that toggles to the add contact modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contact-modal"  >
              Add contact
            </button> 
            Or
            <!-- Upload contact button that toggles to the Upload contact modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload-contact-modal"  >
            Upload contact
            </button>
            
          </div>
      
        </div>

        <!-- these divs are hidden by default and Displays when the targeted button is clicked  -->
        <div name="hidden modals">

          <!-- this is the Add messages modal -->
          <div class="modal fade" id="message-modal" tabindex="-1" aria-labelledby="message-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="message-modal-title">Add Message</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="custom_addition_message.php" method="post" id = "custom_message" class="needs-validation">
                <div class="modal-body">
                    <div class="form-floating">
                      <textarea class="form-control" id="floatingTextarea" name="new_message" required></textarea>
                      <div class="invalid-feedback">
                        Must type in something in this box
                      </div>
                      <label for="floatingTextarea">Message</label>
                      
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-outline-danger" name="Add_message"  id="message" onclick="">Add</button>
                  <!-- script for submitting form -->
                  
                </div>
                </form>
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
                        <?php
                          foreach ($countryCodes as $code => $name) {
                            $selected = ($code == $ucountrycode) ? 'selected' : '';
                            echo "<option value=\"$code\" $selected>$name</option>";
                          }
                        ?>
                        </select> 
                      </div>
                      <div class="col-8">
                          <input type="text" class="form-control"placeholder="Phone" id="phone" name="cphone" required>
                          <div class="invalid-feedback">
                          Please enter person's phone number.
                          </div>
                      </div>
                      <div class="col-12">
                        <div class="input-group ">
                          <span class="input-group-text">Enter Birthdate</span>
                          <input type="date" class="form-control" id="date_of_birth" name="cdob" required>
                        </div>
                        <div class="invalid-feedback">
                        input  date of birth.
                        </div>
                      </div>
                    </div> 
                    <button type="submit" class="btn btn-outline-danger" name="Add_contact"  id="contact">Add</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <!-- script for submitting form -->
                  <script>
                    (function () {
                      'use strict'
                    
                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      var forms = document.querySelectorAll('.needs-validation')
                    
                      // Loop over them and prevent submission
                      Array.prototype.slice.call(forms)
                        .forEach(function (form) {
                          form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                              event.preventDefault()
                              event.stopPropagation()
                            }
                    
                            form.classList.add('was-validated')
                          },
                            false)
                        })
                      })
                    ()
                  </script>
                </div>
              </div>
            </div>
          </div>

<!-- =================START OF CONTACT UPLOAD MODAL============== -->
  <!-- =============================================== -->
  <div class="modal fade" id="upload-contact-modal" tabindex="-1" aria-labelledby="upload-contact-ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="upload-contact-ModalLabel">Upload contacts</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="contact_upload.php"  id="signin" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          <div class="input-group mb-3">
            <select id="c_status"  required class="form-select" name="c_stat">
                            <?php
                            $c_statuses = ["Public","Student"];
                            foreach ($c_statuses as $c_stat) {
                                echo "<option value=\"$c_stat\" >$c_stat</option>";
                            }
                            ?>
                </select>
         </div>
         
          <div class="input-group mb-3">

                          
            <input type="file" class="form-control" id="inputGroupFile02" name="contact_file" accept=".csv" required>
            <label class="input-group-text" for="inputGroupFile02">Upload Contacts csv here</label>
          </div>

              <br>
              <button class="w-100 btn btn-primary btn-lg" name="sign_in" >Upload</button>
            </div>    
          </form>
          
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

       
                  <!-- this is the credits modal -->
<div class="modal fade" id="credits-modal" tabindex="-1" aria-labelledby="credits-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="credits-modal-title">SMS Packages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>This is where packages are populated so you can choose from them</p>
                <div class="row">
                    <?php 
                    include("config.php");
                    $creditsql = "SELECT * FROM sms;";
                    $creditresult = $conn->query($creditsql);
                    $credit_num = 1;

                    if ($creditresult && $creditresult->num_rows > 0) {
                        while ($row = $creditresult->fetch_assoc()) {
                            $smsid = $row['sms_id'];
                            $smscredit = $row['num_of_credits'];
                            $smsprice = $row['price'];

                            echo '
                            <div class="col-md-6 rounded mx-2" style="display:inline-block;font-size:80%;">
                                <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4 h-md-250 position-relative" style="border-radius:2rem;">
                                    <div class="col p-4 d-flex flex-column">
                                        <strong class="d-inline-block mb-2 text-primary">GH' . substr($smsprice, 0, 30) . '</strong>
                                        <h2 class="mb-0">' . $smscredit . ' credits</h2>
                                        <div class="mb-1 text-muted">SMS Package NO ' . $credit_num . '</div>
                                        <a class="stretched-link" data-bs-toggle="modal" data-bs-target="#credit-purchase-modal-' . $smsid . '" role="button">Buy</a>
                                    </div>
                                </div>
                            </div>';
                            $credit_num++;
                        }
                    } else {
                        echo '<p>No packages available.</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="credit_purchase.php" method="post">
                    <button type="submit" class="btn btn-outline-danger" name="credit_purchase" id="credits">Buy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- This is Purchase modal -->
<?php 
// Ensure you are in the correct scope of the while loop
if ($creditresult && $creditresult->num_rows > 0) {
    $creditresult->data_seek(0); // Reset the pointer to reuse the data
    while ($row = $creditresult->fetch_assoc()) {
        $smsid = $row['sms_id'];
        $smscredit = $row['num_of_credits'];
        $smsprice = $row['price'];

        echo '
        <div class="modal fade" id="credit-purchase-modal-' . $smsid . '" tabindex="-1" aria-labelledby="credit-purchase-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="credit-purchase-modal-title">Purchasing ' . $smscredit . ' credits</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container p-3" >
                                You have selected 
                              </div>
                              <div class="row-md-6 rounded mx-2"  style="display:inline-block;min-width:40%;font-size:80%;">
                                <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"id="wish" style="border-radius:2rem; ">
                                  <div class="col p-4 d-flex flex-column style="width:50px">
                                    <strong class="d-inline-block mb-2 text-primary">GH₵'.substr($smsprice,0,30).'</strong>
                                    <h2 class="mb-0">'.$smscredit.' credits</h2>
                                    <div class="mb-1 text-muted">SMS Package NO '.$credit_num.'</div>
                                  </div>
                                
                                </div>
                              </div>

                        <h3 class="my-2">Fill in this form 👇</h3>
                        <div class="mb-1 text-muted">If you would like to use your existing phone number for this transaction you can leave the form below blank</div>
                        <hr>
                        <form action="credit_purchase.php" method="POST" id="credits" class="needs-validation" novalidate>
                            <input type="hidden" name="creditlist" value="pay">
                            <input type="hidden" name="user_id" value="'.$user_id.'">
                            <input type="hidden" name="smsid" value="'.$smsid.'">
                            <input type="hidden" name="altphone" value="'.$phone.'">
                            
                            <div class="row g-3">
                                <div class="col-4">
                                    <select id="country_code" style="max-height:50px;" required class="form-select" name="ucntcd">
                                        <option value="'.$count_code.'" selected>Previous country: ('.$count_code.')</option>
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
                                    <input type="number" class="form-control" placeholder="'.$phone.'" id="payphone" name="payphone" >
                                    <div class="invalid-feedback">
                                        Please enter a phone number for the transaction.
                                    </div>
                                </div>
                            </div> 
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-outline-danger" name="confirm_purchase" id="purchase_credits">Confirm Purchase</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
    }
}
?>

                 

      </div>
   
    </div>
    
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="dashboard.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="../../plugins/js/dashboard.js"></script>
  </body>
</html>

