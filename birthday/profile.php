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
    $last_name=$row["rul_name"];
    $first_name =$row["ruf_name"];
    $date_of_birth=$row["ru_dob"];
    $user_cntcode= $row['ru_cntcode'];
    $country_codes = $_SESSION['countrycodes'];
    $phone =$row["ru_pnum"];
    $profile_pic =$row["ru_pic"];
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        
    }
    $_SESSION['user id']=$user_id;
    $_SESSION['fame']=$first_name;
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
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/logo1.ico">
    <!-- Custom CSS -->
   <link href="plugins/css/style.min.css" rel="stylesheet">
   <style>
     #profile{
    transition: all 0.3s ease;
    background-color: #fff;
    border: 1px solid #ddd;
    }

    #profile:hover {
      background-color: #f0f0f0;
      transform: scale(1.05);
    }
   </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
                            <!-- dark Logo text -->
                            <!-- <img src="plugins/images/logo-text.png" alt="homepage" /> -->
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
                                class="btn d-grid btn-danger text-white" target="_blank">
                                Homepage</a>
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
                        <h4 class="page-title">Profile page</h4>
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div id="response"></div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-5 col-xlg- col-md-12">
                        <div class="white-box">
                            
                            <div class="user-bg"><img width="100" height="250"alt="user" src="plugins/images/users/<?php echo $profile_pic?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img style="height:240;width: 300;"
                                                class="thumb-lg img-circle"id="profile" src="plugins/images/users/<?php echo $profile_pic?>" alt="Profile picture"></a>
                                        <h4 class="text-white mt-2"><?php echo $first_name.'  '.$last_name ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $user_cntcode.' '.$phone ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                            
                                                                                     
                                <!-- <div class="form-group mb-4">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit">Update Profile picture</button>
                                    </div>
                                </div> -->
                    </div> 
                </div> 
            </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-7 col-xlg-7 col-md-12">
                        <div class="card">
<!-- <div class="d-flex justify-content-center align-items-center "> -->
    
                        <form class="shadow w-450 p-3" 
                            action="plugins/php/update_picture.php" 
                            method="post"
                            enctype="multipart/form-data">

                            <h4 class="display-4  fs-1">Edit Profile</h4><br>
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
                            <label class="form-label">first Name</label>
                            <input type="text" 
                                class="form-control"
                                name="fname"
                                placeholder="<?php echo $first_name?>"
                                value="<?php echo $first_name?>"
                                 >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">last name</label>
                            <input type="text" 
                                class="form-control"
                                name="lname"
                                placeholder="<?php echo $last_name ?>"
                                aria-label="last name" name="lname" 
                                value="<?php echo $last_name?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User name</label>
                            <input type="text" 
                                class="form-control"
                                name="uname"
                                placeholder="<?php echo $user_name ?>"
                                aria-label="user name" name="uname" 
                                value="<?php echo $user_name?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" 
                                class="form-control"
                                name="pp">
                            <input type="text"
                                hidden="hidden" 
                                name="old_pp"
                                value="<?=$profile_pic?>" >
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
                        <!-- <a href="home.php" class="link-secondary">Home</a> -->
                        </form>
                    <!-- </div> -->
                            <!-- <div class="card-body">
                            <form class="form-horizontal form-material" action="plugins/php/update_admin_profile.php" method="POST">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Full Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="full_name" placeholder="<?php echo $first_name .' '.$last_name ?>"
                                                class="form-control p-0 border-0"> 
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Phone No</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="phone_number" placeholder="<?php echo $phone?>"
                                                class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12 border-bottom">
                                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="country">
                                                <?php foreach ($country_codes as $code => $name) {
                                                                $selected = ($code == $user_cntcode) ? 'selected' : '';
                                                                echo "<option value=\"$code\" $selected>$name</option>";
                                                            }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Profile picture</label>
                                    <div class="col-md-12 border-bottom p-0">
                                        <input type="FILE" name="profile"
                                            class="form-control p-0 border-0" >
                                    </div>
                                </div> 
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">Update Profile</button>
                                        </div>
                                    </div>
                            </form>

                            </div> -->
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
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
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer  text-center"> 2021 © WishMe brought to you by Group5 
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