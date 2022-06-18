<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "country_currency";

 $conn = new mysqli($servername, $username, $password, $database);

 if($conn->connect_error)
 {
     die("Connection Failed: " . $conn->connect_error);
 }

  $limit = 10;
  $result = $conn->query("SELECT count(Id) AS Id FROM items");
  $pagecount = $result->fetch_all(MYSQLI_ASSOC);
  $total = $pagecount[0]["Id"];
  $pages = $total / $limit;
?>