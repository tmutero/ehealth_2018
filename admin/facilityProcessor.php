<?php
require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters.
$name = $_GET['name'];
$address = $_GET['address'];
$city_id = $_GET['city_id'];
$latitude=$_GET['latitude'];
$longitude=$_GET['longitude'];



// Opens a connection to a MySQL server.
$connection=mysql_connect ("localhost", $username, $password);

// Inserts new row with place data.

$query = sprintf("INSERT INTO facility " .
         " (name, city_id, address,latitude,longitude) " .
         " VALUES ('%s', '%s', '%s', '%s', '%s');",
         mysql_real_escape_string($name),
          mysql_real_escape_string($city_id),
         mysql_real_escape_string($address),
         mysql_real_escape_string($latitude),
         mysql_real_escape_string($longitude)
       );
         

$result = mysql_query($query);
if($result){
  echo "Location saved";
}

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>