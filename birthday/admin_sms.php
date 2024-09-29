<?php 
session_start();
require("plugins/php/config.php");
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
    $userdata = "SELECT * FROM registered_users WHERE ru_id= '$user_id'";
    $result = $conn -> query($userdata);
    $row = $result -> fetch_assoc();
    $user_id = $row["ru_id"];
    $status = $row["ru_status"];
    $Password = $row["ru_pass"];
    $user_name = $row['ru_name'];
    $profile_pic =$row["ru_pic"];



    // Checking Total credit available

// Your Hubtel API credentials
$client_id = 'zypjcmzu';      // Replace with your actual client ID
$client_secret = 'ukzxxojo';  // Replace with your actual client secret

// API endpoint for retrieving balance
$balance_url = "https://api.hubtel.com/v1/merchantaccount/balance";

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $balance_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, $client_id . ":" . $client_secret); // Basic authentication

// Bypass SSL verification (not recommended in production)
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Execute the request and get the response
$response = curl_exec($ch);

echo "<pre>";
print_r($response);
echo "</pre>";


// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL error: " . curl_error($ch);
} else {
    // Decode the JSON response
    $balance_data = json_decode($response, true);
    
    // Check if the balance was successfully retrieved
    if (isset($balance_data['ResponseCode']) && $balance_data['ResponseCode'] == "0000") {
        // Display the available balance
        echo "Your current balance is: " . $balance_data['Data']['AvailableBalance'] . " GH₵";
    } else {
        echo "Failed to retrieve balance. Error: " . $balance_data['ResponseText'];
        var_dump($balance_data);
    }
}

// Close cURL
curl_close($ch);



    // checking total credit needed
    // Query to get the total credit needed
$sitebalance_query = "SELECT SUM(num_of_credits) AS total_credit_needed FROM registered_users";

// Execute the query
$all_sitebalance_results = mysqli_query($conn, $sitebalance_query);

// Check if the query execution was successful
if ($all_sitebalance_results) {
    $all_sitebalance_rows = mysqli_fetch_assoc($all_sitebalance_results);
    
    // Check if the result is not null, meaning there are some rows
    if ($all_sitebalance_rows && isset($all_sitebalance_rows['total_credit_needed'])) {
        $all_sitebalance = $all_sitebalance_rows['total_credit_needed'];
    } else {
        $all_sitebalance = 0;
    }
} else {
    // If the query failed, you can log the error and also set the balance to 0
    echo "Error executing query: " . mysqli_error($conn);
    $all_sitebalance = 0;
}



    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inspired by Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>WishMe SMS page | <?php echo $user_name ?></title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/logo1.ico">
    <link href="plugins/css/style.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo1.ico" width="50" height="50" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text --><!-- 
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse bg-primary" id="navbarSupportedContent" >
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form id="myForm"class="app-search d-none d-md-block me-3">
                                <input type="text" id="postData1" name="query" placeholder="search..." class="form-control mt-0">
                                <input type="hidden" name="dashboard" id="postData2" value="dashboard">
                                <button type='submit' class=" active" style="border-radius:1rem;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </li> 
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/<?php echo $profile_pic?>" alt="user-img" width="45" height="45"
                                    class="img-circle"><span class="text-white font-medium"><?php echo $user_name ?></span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin_contacts.php"
                                aria-expanded="false">
                                <i class="far fa-address-book" aria-hidden="true"></i>
                                <span class="hide-menu">Contacts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin_messages.php"
                                aria-expanded="false">
                                <i class="far fa-envelope" aria-hidden="true"></i>
                                <span class="hide-menu">Messages</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin_users.php"
                                aria-expanded="false">
                                <i class="fas fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="automated_birthday_page.php"
                                aria-expanded="false">
                                <i class="fa fa-columns" aria-hidden="true"></i>
                                <span class="hide-menu">Automatic Birthday Page</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin_sms.php"
                                aria-expanded="false">
                                <i class="far fa-address-book" aria-hidden="true"></i>
                                <span class="hide-menu">SMS Packages</span>
                            </a>
                        </li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="plugins/php/user_account.php"
                                class="btn d-grid btn-danger text-white" target="_blank">Homepage</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">SMS Table</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="dashboard.php" class="fw-normal">Dashboard</a></li>
                                
                            </ol>
                                </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div id="response"></div>
            
        <div class=" scrollable-div px-3 py-4" style="padding-bottom:100px; max-height:80vh; min-height: 80vh; overflow-y:scroll">

        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-12">
                                <div class="white-box analytics-info" id='Apibalance'>
                                    <h3 class="box-title">Total Credit Available</h3>
                                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                                        <li>
                                            <hr>
                                        </li>
                                        <li class="ms-auto"><span class="counter text-success"><?php echo $all_apibalance?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="white-box analytics-info"id='sitebalance'>
                                    <h3 class="box-title">Total Credit Needed</h3>
                                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                                        <li>
                                            <hr>
                                        </li>
                                        <li clt="ms-auto"><span class="counter text-purple"><?php echo  $all_sitebalance;?></span></li>
                                    </ul>
                                </div>
                            </div>
                           
                        </div>


                        
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">SMS Table</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Credit offer</th>
                                            <th class="border-top-0">Credit Price</th>
                                            <th class="border-top-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                require("plugins/php/config.php");
                
                
                $sql = "SELECT sms_id, num_of_credits, price FROM sms ";
                $result = $conn->query($sql);
                
                $record = "";
                
                if ($result->num_rows > 0) {
                    $num_row = 1;
                    while ($row = $result->fetch_assoc()) {
                        $smsid = htmlspecialchars($row["sms_id"]);
                        $credit = htmlspecialchars($row["num_of_credits"]);
                        $price = htmlspecialchars($row["price"]);
                       $record .= "<tr>
                                <td>" .  $num_row. "</td>
                                <td>" .  $credit. "</td>
                                <td>" .  $price  . "</td>
                                <td>
                                <a class='btn btn-danger' href='plugins/php/credits.php?action=delete_sms&sms_id=" . urlencode($smsid) .  "' role='button'>Delete</a>
                                </td>
                            </tr>";
                
                        ;
                        
                    $num_row +=1;
                    }
                } else {
                    $record = "<tr><td colspan='4'>No offers available</td></tr>";
                }
                
                $conn->close();
                echo $record;
                ?>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sms-package-modal"  >
              Add Package
            </button> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->


            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start settings  Content -->
                <!-- ============================================================== -->
                 <!-- So here you can view the credt left the credit needed and you can change the times you recieve an update so two boxes one to time number and one to type type so 1 day etc  -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">SMS Settings</h3>
                            
                        <div class="card">
                        <?php
                require("plugins/php/config.php");
                
                
                $sql = "SELECT * FROM alert_system";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $interval_change_id= htmlspecialchars($row["alert_s_id"]);
                        $interval_value= htmlspecialchars($row["alert_time_num"]);
                        $interval_unit = htmlspecialchars($row["alert_time_str"]);
                        ?>
                        
                    
    
                        <form class="shadow w-450 p-3" 
                            action="plugins/php/alertsettings.php" 
                            method="post">

                            <h4 class="display-4  fs-1">Edit alert Interval Settings</h4><br>
                            <!-- error -->
                            <?php if(isset($_GET['error'])){ ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $_GET['error']; ?>
                            </div>
                            <?php } ?>
                            
                            <!-- success -->
                            <?php if(isset($_GET['success'])){ ?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_GET['success']; ?>
                            </div>
                            <?php } ?>
                        <div class="mb-3">



                        <input type="hidden" placeholder="<?php echo $interval_change_id;?>" name="alert-id">


                            <label class="form-label">Set Interval Value of sms alerts here</label>
                            <input type="number" 
                                class="form-control"
                                name="interval_value"
                                placeholder="<?php echo $interval_value?>"
                                value="<?php echo $interval_value?>"
                                 >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Set Interval Unit of sms alerts here</label>
                            <input type="text" 
                                class="form-control"
                                name="lname"
                                placeholder="<?php echo $interval_unit ?>"
                                aria-label="interval unit" name="interval_unit" 
                                value="<?php echo $interval_unit?>">
                        </div>
                        
                        
                    <button type="submit" class="btn btn-outline-primary" name="update_interval"  id="update_interval">Update interval</button>
                       

                        </form>
                        </div>



                        <?php
                    $conn->close();

                            }
                            }
                    ?>

                           

                                        </form>
                          
                      
                                
                                    </tbody>
                                </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Settings Content -->
                <!-- ============================================================== -->
                 </div>
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
           

            
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer fixed-bottom text-center"> 2021 © WishMe brought to you by Group5 
                    <p>Content on this page is reproduced from <a
                    href="https://www.wrappixel.com/">wrappixel.com</a> with permission from the author.</p>

            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>


        <!-- ============================================================== -->
          <!-- this is the Add sms packages modal -->
        <!-- ============================================================== -->     

  <div class="modal fade" id="sms-package-modal" tabindex="-1" aria-labelledby="sms-package-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="sms-package-modal-title">Add Sms Packages</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <form action="plugins/php/credits.php" method = 'POST' id="sms" class="needs-validation" novalidate>
                    <input type="hidden" name="smslist" value="Add">
                    <div class="row g-3">
                      <div class="col-6">
                        <input type="number" class="form-control" placeholder="number of credits" aria-label="number of credits" name="num_of_credits" required>
                      </div>
                      <div class="col-6">
                        <input type="number" class="form-control" placeholder="Price" aria-label="price" name="price" required>
                      </div>
                      
                    
                      
                    </div> 
                    <button type="submit" class="btn btn-outline-danger" name="Add_package"  id="package">Add</button>
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

          <!-- ============================================================== -->
         <!-- this is the end of the Add sms packages modal -->
        <!-- ============================================================== -->

  </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="plugins/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="plugins/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="plugins/js/custom.js"></script>
    <script>


       
        document.getElementById('myForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('query', document.getElementById('postData1').value);
            formData.append('dashboard', document.getElementById('postData2').value);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'plugins/php/search.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    document.getElementById('response').innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed: ' + xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            xhr.send(formData);
        });
    // </script>
</body>

</html>