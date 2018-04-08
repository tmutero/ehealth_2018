<?php
$conn=mysqli_connect('localhost', 'root', '', 'ehealth');

//$lati = $_GET['lati'];
//$lng = $_GET['lng'];
// $name    =  $_GET['name'];
// $city_id=$_GET['city_id'];
// $address=$_GET['address'];
    

$query="INSERT INTO `facility`( `name`, `city_id`, `address`, `latitude`, `longitude`) 
VALUES ('asas','1','hahsh hmujas','1.22232323','2.8384343743')";

 $result=mysqli_query($conn,$query);
if($result){
  echo "Location saved";
}

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>