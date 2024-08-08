<?php
/* connect to database custom messages */
require("config.php");

echo "Under construction";?>

<!DOCTYPE html>
  <html>
  <head>
     <title>Simple search with PHP and MySQLi</title>
     <meta http-equiv="Content-Type" content="text/html; 
      charset=utf-8" />
      <link rel="stylesheet" type="text/css" 
      href="style.css"/>
  </head>
  <body>
     <h1>Simple search engine with PHP and MySQLi</h1>
    <form action="" method="post">
      <input type="text" name="search">
      <input type="submit" name="submit" 
        value="Search">
    </form>
  <strong>Go back tu search page     <a  href="search.html">SEARCH AGAIN</a></strong> 
  <?php
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $db_name = "my_data_base";
$con=new mysqli($server_name, $user_name, $password, $db_name,3307);
  if($con->connect_error)
      {
        echo 'Connection Faild: '.$con->connect_error;
      }
  else{
  $search_value=$_POST["search"]; 
         $sql="select * from search where title like '%$search_value%' OR 
         description LIKE '%$search_value%'";
         $res=$con->query($sql);
         while($row=$res->fetch_assoc())
    echo "<br><br><strong>ID </strong>".$row['id']."<br> <strong>Title:</strong> ".$row['title']."<br> <strong>Description</strong> ".$row['description']."<br />"; 
  }?>
</body>
  </html>
