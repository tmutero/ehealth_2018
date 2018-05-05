<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 5/4/2018
 * Time: 7:39 PM
 */
include('conn.php');
$conn = mysqli_connect('localhost', 'root', '', 'ehealth');
include('functions.php');
include('conn.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
   $user = $_SESSION['user']['id'];
   if(isset($_POST['info']))
   {
       $info = $_POST['info'];
       echo $info;
       echo "Welcome";

       $query = "INSERT INTO future (symptom,found,user_id)
						                       VALUES('$info','1','$user')";
       $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
       mysqli_query($conn, $query);
   }
  else{
      $sql = "SELECT * FROM future WHERE user_id ='$user'  ORDER by id DESC  ";
      $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
      $result = mysqli_query($conn, $sql);
      $num_rows=mysqli_num_rows($result);
      while ($row[] = mysqli_fetch_array($result)) {
      }
      if ($num_rows ==3){
         echo "3 Selected";
          $first_symptom = $row[0]['symptom'];
          $second_symptom = $row[1]['symptom'];
          $third_symptom=$row[2]['symptom'];

          $select = "SELECT  name,disease FROM   disease JOIN symptoms ON disease.id = symptoms.disease_id 
    WHERE  name  IN  ('$first_symptom','$second_symptom','$third_symptom' IS NOT NULL) 
    GROUP  BY disease_id DESC";
          $run_select = mysqli_query($conn, $select);
          $num = mysqli_num_rows($run_select);
          if($num==3){

          }

          $row = mysqli_fetch_array($run_select);
          $name = $row['disease'];
          echo $name;
      }

      if ($num_rows==4){
         echo "4 selected";
      }
      if($num_rows ==5){
          echo "5 Selected from the database";

      }
      if($num_rows){

      }

  }
?>