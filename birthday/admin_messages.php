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
    $userdata = "SELECT * FROM registered_users WHERE ru_id= '$user_id'";
    $result = $conn -> query($userdata);
    $row = $result -> fetch_assoc();
    $user_id = $row["ru_id"];
    $status = $row["ru_status"];
    $Password = $row["ru_pass"];
    $user_name = $row['ru_name'];
    $last_name=$row["rul_name"];
    $first_name =$row["ruf_name"];
    $date_of_birth=$row["ru_dob"];
    $phone =$row["ru_pnum"];
    $profile_pic =$row["ru_pic"];
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
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>WishMe Admin page | <?php echo $user_name ?> </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <link href="css/style.min.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script> -->
        <!-- // $(document).ready(function(){
        //     $('#mysearch').submit(function(e){
        //         e.preventDefault();
        //         var formData = $(this).serialize();
                
        //         $.ajax({
        //             type: 'POST',
        //             url: 'php/search.php',
        //             data: formData,
        //             success: function(response){
        //                 var searchWord = $('#search').val(); // Assuming the input field ID is 'searchInput'
        //                 var highlightedResponse = highlightSearchWord(response, searchWord);
        //                 $('#searchResults').html(highlightedResponse);
        //             }
        //         });
        //     });
        // });
        // function highlightSearchWord(text, searchWord) {
        // // Case insensitive search and replace
        // var regex = new RegExp(searchWord, 'gi');
        // return text.replace(regex, '<span class="highlighted">' + searchWord + '</span>');
        // } -->
    <!-- </script> -->

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
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/logo-text.png" alt="homepage" />
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
                                <img src="uploads/<?php echo $profile_pic?>" alt="user-img" width="45" height="45"
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

                        <li class="text-center p-20 upgrade-btn">
                            <a href="php/user_account.php"
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
                            <h4 class="page-title">Messages Table</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <div class="d-md-flex">
                                <ol class="breadcrumb ms-auto">
                                    <li><a href="dashboard.php" class="fw-normal">Dashboard</a></li>
                                </ol>
                                <a type="button" class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white" data-bs-toggle="modal" data-bs-target="#messages-modal" >Upload Messages</a>
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
        <div class=" scrollable-div px-3 py-4" style="padding-bottom:100px; max-height:80vh; min-height: 80vh; overflow-y:scroll">
            <div id="response"></div>
            <div class="col my-4 px-3 py-4" id="searchResults"></div>     
                    <div class="container-fluid ">
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div id="searchResults"></div>
                            <div class="white-box ">
                                <h3 class="box-title">Messages Table</h3>
                                 
                             

                                <?php
                                    require("php/config.php");
                                    
                                    
                                    $sql = "SELECT m_id, m_body, m_type FROM messages order by m_type ASC";
                                    $result = $conn->query($sql);
                                    $love="";
                                    $sample="";
                                    $special="";
                                    $important="";
                                    $empty = "";
                                    $num_row = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $messageid = htmlspecialchars($row["m_id"]);
                                            $messagebody = htmlspecialchars($row["m_body"]);
                                            $messagestatus = htmlspecialchars($row["m_type"]);
                                            if ($messagestatus == 'love'){
                                                
                                                $love .= "<tr>
                                                    <td>" .  $num_row. "</td>
                                                    <td>" .  $messagebody. "</td>
                                                    <td>" .  $messagestatus  . "</td>
                                                    <td>
                                                    <a class='btn btn-danger' href='php/users.php?action=deletemsg&msgid=" . urlencode($messageid) .  "' role='button'>Delete</a>
                                                    </td>
                                                </tr>";
                                    
                                            }
                                            elseif($messagestatus=='special'){
                                                $special .= 
                                                "<tr>
                                                    <td>" .  $num_row. "</td>
                                                    <td>" .  $messagebody. "</td>
                                                    <td>" .  $messagestatus  . "</td>
                                                    <td>
                                                    <a class='btn btn-danger' href='php/users.php?action=deletemsg&msgid=" . urlencode($messageid) .  "' role='button'>Delete</a>
                                                    </td>
                                                </tr>";
                                            } elseif($messagestatus=='sample'){
                                            $sample .= "<tr>
                                                    <td>" .  $num_row. "</td>
                                                    <td>" .  $messagebody. "</td>
                                                    <td>" .  $messagestatus  . "</td>
                                                    <td>
                                                    <a class='btn btn-danger' href='php/users.php?action=deletemsg&msgid=" . urlencode($messageid) .  "' role='button'>Delete</a>
                                                    </td>
                                                </tr>";
                                            }else{
                                                $important .= "<tr>
                                                    <td>" .  $num_row. "</td>
                                                    <td>" .  $messagebody. "</td>
                                                    <td>" .  $messagestatus  . "</td>
                                                    <td>
                                                    <a class='btn btn-danger' href='php/users.php?action=deletemsg&msgid=" . urlencode($messageid) .  "' role='button'>Delete</a>
                                                    </td>
                                                </tr>";
                                            }
                                        $num_row +=1;
                                            }
                                    } 
                                    else {
                                        $empty = "<tr><td colspan='4'>No users available</td></tr>";
                                    }
                                    $conn->close();
                                ?>
                                <div class="row row-lg-2 my-1 " >
                                    <div class="col-md-12 col-lg-6 px-2  col-sm-12">
                                        <div class="card white-box p-3 shadow-lg rounded">
                                            <h4 class="mx-4">All important Messages</h4>
                                            <div class="table-responsive "style=" height:50vh; overflow-y:scroll">
                                                <table class="table">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Message Body</th>
                                                            <th class="border-top-0">Message Type</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                    <tbody>
                                                    <?php echo $important;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-lg-6 px-2  col-sm-12">
                                        <div class="card white-box p-3 shadow-lg rounded">
                                            <h4>All Love Messages</h4>
                                            <div class="table-responsive "style=" height:50vh; overflow-y:scroll">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Message Body</th>
                                                            <th class="border-top-0">Message Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $love;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-lg-2 my-1 ">
                                   
                                    <div class="col-md-12 col-lg-6 px-2  col-sm-12">
                                        <div class="card white-box p-3 shadow-lg rounded">
                                            <h4>All sample Messages</h4>
                                            <div class="table-responsive "style=" height:50vh; overflow-y:scroll">
                                                <table class="table">>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Message Body</th>
                                                            <th class="border-top-0">Message Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $sample;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6 px-2  col-sm-12">
                                        <div class="card white-box p-3 shadow-lg rounded ">
                                            <h4 >All special messages</h4>
                                            <div class="table-responsive "style=" height:50vh; overflow-y:scroll">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Message Body</th>
                                                            <th class="border-top-0">Message Type</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                    <tbody>
                                                    <?php echo $special;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-12 col-lg-8 px-2 col-sm-12"style=" height:50vh; overflow-y:scroll">
                                        <div class="card white-box p-0">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Message Body</th>
                                                            <th class="border-top-0">Message Type</th>
                                                        </tr>
                                                    </thead>
                                                        
                                                    <tbody>
                                                    <?php echo $special;?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-8 px-2 col-sm-12"style=" height:50vh; overflow-y:scroll">
                                        <div class="card white-box p-0">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Message Body</th>
                                                            <th class="border-top-0">Message Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php echo $special;?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
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
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
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

    <!-- =============================================== -->
  <!-- =================START OF CONTACT UPLOAD MODAL============== -->
  <!-- =============================================== -->
  <div class="modal fade" id="contacts-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Messages</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="php/message_upload.php"  id="signin" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="messages_file" accept=".csv" required>
            <label class="input-group-text" for="inputGroupFile02">Upload Messages csv here</label>
          </div>

              <br>
              <button class="w-100 btn btn-primary btn-lg" name="sign_in" >Upload</button>
            </div>    
          </form>
          
          </div>
       
      </div>
    </div>
  </div>
  <!-- =============================================== -->
  <!-- =================END OF CONTACT UPLOAD MODAL============== -->
  <!-- =============================================== -->

  <div class="modal fade" id="messages-modal" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Messages</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
        <form action="php/message_upload.php" method="POST" id="sign_up" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="message_file">
                <label class="input-group-text" for="inputGroupFile02">Upload Message CSV here</label>
            </div>

            <button class="w-100 btn btn-primary btn-lg" name="sign_up">Upload</button>
        </form>


          </div>
       
      </div>
    </div>
  </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
 
    <script>


       
        document.getElementById('myForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('query', document.getElementById('postData1').value);
            formData.append('dashboard', document.getElementById('postData2').value);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/search.php', true);
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