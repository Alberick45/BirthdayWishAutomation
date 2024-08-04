

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
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
  </style>
</head>

<body>
    <div class="tab-pane fade" id="account"  role="tabpanel"  aria-labelledby="nav-account-tab">
        <div class="row mb-3">
            <div class="col-6 themed-grid-col" style="border-right: 1px solid;">
                <section class="signin" id="login" style="height: 78vh;">
                    <form action="php/login.php" method="post" id="signin">
                        <img class="mb-4" src="../img/unsplash-photo-2.jpg" alt="" width="72" height="57">
                        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    
                        <div class="form-floating">
                        <input type="text" class="form-control" id="phone" name="phone" required>
                        <label for="phone">Phone</label>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                        </div>
                        <div class="form-floating">
                        <input type="password" class="form-control" id="password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                        </div>
                    
                        <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me" id="checkbox"> Remember me
                        </label>
                        </div>
                        <button class="w-100 btn btn-primary btn-lg" type="submit" >Sign in</button>
                    </form>
                    <!-- Content for Section 1 -->
                </section>
            </div>
            <div class="col-6 themed-grid-col" style="border-left: 1px solid;">
                <section class="signup" id="register">
                    <form action="php/user_account.php" method="post" id="signup" class="needs-validation" novalidate>
                        <p>signup here</p>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                Valid first name is required.
                                </div>
                            </div>
                
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                Valid last name is required.
                                </div>
                            </div>
                
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                                </div>
                            </div>
                
                            <!-- <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control" id="email">
                                <div class="invalid-feedback">
                                Please enter a valid email address for updates.
                                </div>
                            </div> -->
                
                            <div class="col-12">
                                <label for="phone_number" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                <div class="invalid-feedback">
                                Please enter your phone number.
                                </div>
                            </div>
                
                            <div class="col-12">
                                <label for="address2" class="form-label">Address <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2">
                            </div>
                
                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" name="country" required>
                                <option value="">Choose...</option>
                                <option>United States</option>
                                </select>
                                <div class="invalid-feedback">
                                Please select a valid country.
                                </div>
                            </div>
                
                            <div class="col-md-4">
                                <label for="state" class="form-label">State/Region</label>
                                <select class="form-select" id="state" required>
                                <option value="">Choose...</option>
                                <option>California</option>
                                </select>
                                <div class="invalid-feedback">
                                Please provide a valid state or region.
                                </div>
                            </div>
                            
                            <button class="w-100 btn btn-primary btn-lg" type="submit">signup</button>
                        </div>    
                    </form>
                    <!-- Content for Section 2 -->
                </section>
            </div>
        </div>
    <!-- Add more sections as needed -->
    </div>

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>

</body>
</html>

<?php
// Connect to the database
// $conn = mysqli_connect("localhost", "root", "", "wishme_project");

// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

// // Get the phone and password from the request
// $phone = $_POST["phone"];
// $password = $_POST["password"];

// // Query the database to find the user
// $query = "SELECT * FROM users WHERE phone = '$phone'";
// $result = mysqli_query($conn, $query);

// // Check if the user exists
// if (mysqli_num_rows($result) > 0) {
//   $user = mysqli_fetch_assoc($result);
//   // Verify the password
//   if (password_verify($password, $user["password"])) {
//     // Login successful, return a success response
//     echo json_encode(array("success" => true, "message" => "Login successful"));
//   } else {
//     // Login failed, return an error response
//     echo json_encode(array("success" => false, "message" => "Invalid phone or password"));
//   }
// } else {
//   // User does not exist, return an error response
//   echo json_encode(array("success" => false, "message" => "Invalid phone or password"));
// }

// // Close the database connection
// mysqli_close($conn);
// ?>