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
    $phone =$row["ru_pnum"];
    $profile_pic =$row["ru_pic"];
    $messages_query ="SELECT count(m_id) as total_messages from messages";
    $all_messages_results = mysqli_query($conn,$messages_query);
    $all_messages_rows = mysqli_fetch_assoc($all_messages_results);
    $all_messages = $all_messages_rows['total_messages'];
    
    $contacts_query ="SELECT count(c_id) as total_contacts from contacts";
    $all_contacts_results = mysqli_query($conn,$contacts_query);
    $all_contacts_rows = mysqli_fetch_assoc($all_contacts_results);
    $all_contacts = $all_contacts_rows['total_contacts'];
    
    $users_query ="SELECT count(ru_id) as total_users from registered_users ";
    $all_users_results = mysqli_query($conn,$users_query);
    $all_users_rows = mysqli_fetch_assoc($all_users_results);
    $all_users = $all_users_rows['total_users'];

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
    <title>WishMe Dashboard page | <?php echo $user_name ?> </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/logo1.ico">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="plugins/css/style.min.css" rel="stylesheet">
    <style>
    #contacts,#messages,#users{
    transition: all 0.3s ease;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    }

    #contacts:hover,#messages:hover,#users:hover {
      background-color: #f0f0f0;
      transform: scale(1.05);
    }</style>
</head>

<body >
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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin2" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar " data-navbarbg="skin2" > <!-- change color to blue -->
            <nav class="navbar top-navbar navbar-expand-md navbar-dark" >
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
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="map-google.php"
                                aria-expanded="false">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span class="hide-menu">Google Map</span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="automated_birthday_page.php"
                                aria-expanded="false">
                                <i class="fa fa-columns" aria-hidden="true"></i>
                                <span class="hide-menu">Automatic Birthday Page</span>
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">Dashboard</a></li>
                            </ol>
                            </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <div class=" row px-5 py-3" style=" height:82vh; overflow-y:scroll">
                <div id="response"></div>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-12">
                                <div class="white-box analytics-info" id='users'>
                                    <h3 class="box-title">Total Users</h3>
                                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                                        <li>
                                            <div id="sparklinedash"><canvas width="67" height="30"
                                                    style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                            </div>
                                        </li>
                                        <li class="ms-auto"><span class="counter text-success"><?php echo $all_users?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="white-box analytics-info"id='messages'>
                                    <h3 class="box-title"> sample messsages </h3>
                                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                                        <li>
                                            <div id="sparklinedash2"><canvas width="67" height="30"
                                                    style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                            </div>
                                        </li>
                                        <li class="ms-auto"><span class="counter text-purple"><?php echo  $all_messages;?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="white-box analytics-info"id='contacts'>
                                    <h3 class="box-title">All Contacts </h3>
                                    <ul class="list-inline two-part d-flex align-items-center mb-0">
                                        <li>
                                            <div id="sparklinedash3"><canvas width="67" height="30"
                                                    style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                            </div>
                                        </li>
                                        <li class="ms-auto"><span class="counter text-info"><?php echo $all_contacts;?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                
                    <!-- ============================================================== -->
                    <!-- Wishes  In three months-->
                    <!-- ============================================================== -->
                        <div class="col-md-12 col-lg-12 col-sm-1">
                            <div class="white-box">
                                <div class="d-md-flex mb-3">
                                    <h3 class="box-title mb-0">Wishes table</h3>
                                    <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                        <?php
                                        $prevous_month = date('Y-m',strtotime('last month'));
                                        $this_month = date('Y-m',strtotime('this month'));
                                        $next_month = date('Y-m',strtotime('next month'));
                                        ?>
                                        <div class="nav" id="nav-tab" role="tablist">
                                            <a class=" nav-item mx-2 p-1 rouneded btn-success text-white  " 
                                                id="nav-previousmonth-tab" data-bs-toggle="tab"
                                                data-bs-target="#previousmonth" type="button" 
                                                role="tab" aria-controls="nav-home" aria-selected="false"
                                                >
                                                <?php echo $prevous_month;?>
                                            </a>
                                        
                                            <a class=" nav-item mx-2 p-1 rouneded btn-success text-white " 
                                                id="nav-thismonth-tab" data-bs-toggle="tab"
                                                data-bs-target="#thismonth" type="button" 
                                                role="tab" aria-controls="nav-home" aria-selected="true"
                                                >
                                                <?php echo $this_month;?>
                                            </a>
                                            <a class=" nav-item mx-2 p-1 rounded btn-success text-white  " 
                                                id="nav-nextmonth-tab" data-bs-toggle="tab"
                                                data-bs-target="#nextmonth" type="button" 
                                                role="tab" aria-controls="nav-home" aria-selected="false"
                                                >
                                                <?php echo $next_month;?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <div class=" row my-3 px-5 py-3" style=" height:40vh; overflow-y:scroll">
                                <div class="tab-content" id="nav-tabContent">
                                
                                    <div class="tab-pane fade show " id="previousmonth" role="tabpanel" aria-labelledby="nav-previousmonth-tab">
                                        <div class="table-responsive">
                                            <h1>Last month wishes</h1>
                                            <table class="table no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0">#</th>
                                                        <th class="border-top-0 " style="width:40%">Name</th>
                                                        <th class="border-top-0">Phone</th>
                                                        <th class="border-top-0">Date of birth</th>
                                                        <th class="border-top-0"style="width:2%">message Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $previous_month = date('m',strtotime('last month'));
                                                    $current_month = date('m',strtotime('this month'));
                                                    $month_ahead = date('m',strtotime('next month'));
                                                    
                                                    $sql = "SELECT cf_name, c_ruid,m_stat, cl_name, c_dob, c_mid,c_pnum 
                                                    FROM contacts 
                                                    WHERE MONTH(c_dob) = $previous_month order by cf_name asc";

                                                    $recipient_result = $conn->query($sql);
                                                    if ($recipient_result && $recipient_result->num_rows > 0) {
                                                        $table_num = 1;
                                                        while ($recipient_row = $recipient_result->fetch_assoc()) {
                                                        $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
                                                        $recipient_dob = $recipient_row['c_dob'];
                                                        $recipient_phone = $recipient_row['c_pnum'];
                                                        $recipient_phone = $recipient_row['c_pnum'];
                                                        $message_status = $recipient_row['m_stat'];
                                                        // if ($recipient_dob <= $previousmonth ){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $table_num;?></td>
                                                        <td class="txt-oflo"><?php echo $recipient_name?></td>
                                                        <td><?php echo $recipient_phone?></td>
                                                        <td class="txt-oflo"><?php echo $recipient_dob?></td>
                                                        <td>
                                                            <?php 
                                                                if(!$message_status <1){
                                                                    ?>
                                                                        <span class='text-success'><a>🥳🥳🥳🥳Sent✅</a></span>";
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                        <span class='text-danger'>Pending...🔒</span>";
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $table_num +=1;
                                                        }
                                                    };
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="thismonth" role="tabpanel" aria-labelledby="nav-thismonth-tab">
                                            <h1>This month wishes</h1>
                                        <div class="table-responsive">
                                            <table class="table no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0">#</th>
                                                        <th class="border-top-0 " style="width:40%">Name</th>
                                                        <th class="border-top-0">Age</th>
                                                        <th class="border-top-0">Date of birth</th>
                                                        <th class="border-top-0">message Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $previous_month = date('m',strtotime('last month'));
                                                    $current_month = date('m',strtotime('this month'));
                                                    $month_ahead = date('m',strtotime('next month'));
                                                    
                                                    $sql = "SELECT cf_name, c_ruid, cl_name, m_stat, c_dob, c_mid, CONCAT(c_cntcode, c_pnum) AS phone 
                                                    FROM contacts 
                                                    WHERE MONTH(c_dob) = $current_month order by cf_name asc";

                                                    $recipient_result = $conn->query($sql);
                                                    if ($recipient_result && $recipient_result->num_rows > 0) {
                                                        $c_num = 1;
                                                        while ($recipient_row = $recipient_result->fetch_assoc()) {
                                                        $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
                                                        $recipient_dob = $recipient_row['c_dob'];
                                                        $recipient_phone = $recipient_row['phone'];
                                                        $message_status = $recipient_row['m_stat'];
                                                        // if ($recipient_dob <= $previousmonth ){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $c_num;?></td>
                                                        <td class="txt-oflo"><?php echo $recipient_name?></td>
                                                        <td><?php echo $recipient_phone?></td>
                                                        <td class="txt-oflo"><?php echo $recipient_dob?></td>
                                                        <td><?php 
                                                         if(!$message_status <1){
                                                            echo "<span class='text-success'>🥳🥳🥳🥳Sent✅</span>";
                                                        }
                                                        else{
                                                            echo "<span class='text-danger'>Pending...🔒</span>";
                                                        }
                                                        
                                                        
                                                        ?></td>
                                                    </tr>
                                                    <?php
                                                    $c_num +=1;
                                                        }};
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show " id="nextmonth" role="tabpanel" aria-labelledby="nav-nextmonth-tab">
                                        <div class="table-responsive">
                                            <table class="table no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0">#</th>
                                                        <th class="border-top-0">Name</th>
                                                        <th class="border-top-0">Age</th>
                                                        <th class="border-top-0">Date of birth</th>
                                                        <th class="border-top-0"style="width:2%">message status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                            $previous_month = date('m',strtotime('last month'));
                                                            $current_month = date('m',strtotime('this month'));
                                                            $month_ahead = date('m',strtotime('next month'));
                                                            
                                                            $sql = "SELECT cf_name,m_stat, c_ruid, cl_name, c_dob, c_mid , CONCAT(c_cntcode, c_pnum) AS phone 
                                                            FROM contacts 
                                                            WHERE MONTH(c_dob) = $month_ahead order by cf_name asc ";

                                                            $recipient_result = $conn->query($sql);
                                                            if ($recipient_result && $recipient_result->num_rows > 0) {
                                                                $m_num = 1;
                                                                while ($recipient_row = $recipient_result->fetch_assoc()) {
                                                                $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
                                                                $recipient_dob = $recipient_row['c_dob'];
                                                                $recipient_phone = $recipient_row['phone'];
                                                                $message_status = $recipient_row['m_stat'];
                                                                // if ($recipient_dob <= $previousmonth ){
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $m_num;?></td>
                                                                    <td class="txt-oflo"><?php echo $recipient_name?></td>
                                                                    <td><?php echo $recipient_phone?></td>
                                                                    <td class="txt-oflo"><?php echo $recipient_dob?></td>
                                                                    <td>
                                                                        <?php 
                                                                            if(!$message_status <1){
                                                                                echo "<span class='text-success'>🥳🥳🥳🥳Sent✅</span>";
                                                                            }
                                                                            else{
                                                                                echo "<span class='text-danger'>Pending...🔒</span>";
                                                                            }
                                                                    
                                                                    
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            $m_num +=1;
                                                                }};
                                                        ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Recent Comments -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="container-fluid">
                            <!-- ============================================================== -->
                            <!-- Start Page Content -->
                            <!-- ============================================================== -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        <h3 class="box-title">Contacts Table</h3>
                                        <div class="row scrollable-row px-3 py-4" style="padding-bottom:100px; max-height:50vh; overflow-y:scroll">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0">#</th>
                                                        <th class="border-top-0">First Name</th>
                                                        <th class="border-top-0">Last Name</th>
                                                        <th class="border-top-0">Phone number</th>
                                                        <th class="border-top-0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                            require("plugins/php/config.php");
                            
                            
                            $sql = "SELECT c_id, cf_name, cl_name, c_cntcode, c_pnum FROM contacts ";
                            $result = $conn->query($sql);
                            
                            $record = "";
                            
                            if ($result->num_rows > 0) {
                                $num_row = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $contactid = htmlspecialchars($row["c_id"]);
                                    $firstname = htmlspecialchars($row["cf_name"]);
                                    $lastname = htmlspecialchars($row["cl_name"]);
                                    $cntcode=  htmlspecialchars($row["c_cntcode"]);
                                    $pnum= htmlspecialchars($row["c_pnum"]);
                                $record .= "<tr>
                                            <td>" .  $num_row. "</td>
                                            <td>" .  $firstname. "</td>
                                            <td>" .  $lastname  . "</td>
                                            <td>(". $cntcode.')'.$pnum . "</td>
                                            <td>
                                            <a class='btn btn-danger' href='plugins/php/users.php?action=deletecontact&cid=" . urlencode($contactid) .  "' role='button'>Delete</a>
                                            </td>
                                        </tr>";
                            
                                    ;
                                    
                                $num_row +=1;
                                }
                            } else {
                                $record = "<tr><td colspan='4'>No users available</td></tr>";
                            }
                            
                            $conn->close();
                            echo $record;
                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

                        <!-- .col -->
                        <!-- <div class="col-md-12 col-lg-8 px-2 col-sm-12"style=" height:50vh; overflow-y:scroll">
                            <div class="card white-box p-0">
                                <div class="card-body">
                                    <h3 class="box-title mb-0">Recent Messages</h3>
                                </div>
                                <div class="comment-widgets">
                                    <div class="d-flex flex-row comment-row p-3 mt-0">
                                        <div class="p-2"><img src="plugins/images/users/varun.jpg" alt="user" width="50" class="rounded-circle"></div>
                                        <div class="comment-text ps-2 ps-md-3 w-100">
                                            <h5 class="font-medium">James Anderson</h5>
                                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                            <div class="comment-footer d-md-flex align-items-center">
                                                <span class="badge bg-primary rounded">Pending</span>
                                                
                                                <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row comment-row p-3">
                                        <div class="p-2"><img src="plugins/images/users/genu.jpg" alt="user" width="50" class="rounded-circle"></div>
                                        <div class="comment-text ps-2 ps-md-3 active w-100">
                                            <h5 class="font-medium">Michael Jorden</h5>
                                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                            <div class="comment-footer d-md-flex align-items-center">

                                                <span class="badge bg-success rounded">Approved</span>
                                                
                                                <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row comment-row p-3">
                                        <div class="p-2"><img src="plugins/images/users/ritesh.jpg" alt="user" width="50" class="rounded-circle"></div>
                                        <div class="comment-text ps-2 ps-md-3 w-100">
                                            <h5 class="font-medium">Johnathan Doeting</h5>
                                            <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                                            <div class="comment-footer d-md-flex align-items-center">

                                                <span class="badge rounded bg-danger">Rejected</span>
                                                
                                                <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card white-box p-0">
                                <div class="card-heading">
                                    <h3 class="box-title mb-0">Chat Listing</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="chatonline">
                                        <li>
                                            <div class="call-chat">
                                                <button class="btn btn-success text-white btn-circle btn" type="button">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button class="btn btn-info btn-circle btn" type="button">
                                                    <i class="far fa-comments text-white"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                    src="plugins/images/users/varun.jpg" alt="user-img" class="img-circle">
                                                <div class="ms-2">
                                                    <span class="text-dark">Varun Dhavan <small
                                                            class="d-block text-success d-block">online</small></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="call-chat">
                                                <button class="btn btn-success text-white btn-circle btn" type="button">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button class="btn btn-info btn-circle btn" type="button">
                                                    <i class="far fa-comments text-white"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                    src="plugins/images/users/genu.jpg" alt="user-img" class="img-circle">
                                                <div class="ms-2">
                                                    <span class="text-dark">Genelia
                                                        Deshmukh <small class="d-block text-warning">Away</small></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="call-chat">
                                                <button class="btn btn-success text-white btn-circle btn" type="button">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button class="btn btn-info btn-circle btn" type="button">
                                                    <i class="far fa-comments text-white"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                    src="plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle">
                                                <div class="ms-2">
                                                    <span class="text-dark">Ritesh
                                                        Deshmukh <small class="d-block text-danger">Busy</small></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="call-chat">
                                                <button class="btn btn-success text-white btn-circle btn" type="button">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button class="btn btn-info btn-circle btn" type="button">
                                                    <i class="far fa-comments text-white"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                    src="plugins/images/users/arijit.jpg" alt="user-img" class="img-circle">
                                                <div class="ms-2">
                                                    <span class="text-dark">Arijit
                                                        Sinh <small class="d-block text-muted">Offline</small></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="call-chat">
                                                <button class="btn btn-success text-white btn-circle btn" type="button">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button class="btn btn-info btn-circle btn" type="button">
                                                    <i class="far fa-comments text-white"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                    src="plugins/images/users/govinda.jpg" alt="user-img"
                                                    class="img-circle">
                                                <div class="ms-2">
                                                    <span class="text-dark">Govinda
                                                        Star <small class="d-block text-success">online</small></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="call-chat">
                                                <button class="btn btn-success text-white btn-circle btn" type="button">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button class="btn btn-info btn-circle btn" type="button">
                                                    <i class="far fa-comments text-white"></i>
                                                </button>
                                            </div>
                                            <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                    src="plugins/images/users/hritik.jpg" alt="user-img" class="img-circle">
                                                <div class="ms-2">
                                                    <span class="text-dark">John
                                                        Abraham<small class="d-block text-success">online</small></span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div> -->
                        <!-- /.col -->
                       
                    </div>
                </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            </div>
            <footer class="footer p-0 text-center" style="box-shadow: 1px 0px 20px rgba(0,0,0,0.08)"> 2021 © WishMe brought to you by Group5 
        <p class="my-0">Theme was reproduced from <a
        href="https://www.wrappixel.com/">wrappixel.com</a> with permission from the author.</p>

    </footer>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
     <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->

    
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="plugins/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="plugins/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="plugins/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="plugins/js/pages/dashboards/dashboard1.js"></script>
    <script src="plugins/js/dashboard.js"></script>
    <script src="plugins/js/bootstrap.bundle.min.js"></script>
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