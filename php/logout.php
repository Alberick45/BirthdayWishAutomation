<?php
require("config.php");
session_start();
session_unset();
session_destroy();?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <script type="text/javascript">
        alert("Logged out successfully");
        window.location.href = "../index.html";
    </script>
</head>
<body>
</body>
</html>