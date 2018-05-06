<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 4/23/2018
 * Time: 6:08 PM
 */

include('functions.php');
include ('conn.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ehealth</title>
    <link rel="stylesheet" href="assets/patientassets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/patientassets/css/styles.css">
    <link rel="stylesheet" href="assets/patientassets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/patientassets/css/Pretty-Header.css">
    <link rel="stylesheet" href="assets/patientassets/css/Pretty-Footer.css">
</head>
<nav class="navbar navbar-static-top custom-header">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php">Smart Health Diagnosis System</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav links">
                <li role="presentation"><a href="#">Overview </a></li>
                <li role="presentation"><a href="appointmentlist.php">Doctor Reference List </a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"> <?php if (isset($_SESSION['user'])) : ?>

                    <?php endif ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-user"></i> <?php echo $_SESSION['user']['username']; ?><b class="caret"></b></a>

                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation" class="active"><a href="#">Profile </a></li>
                        <li role="presentation" class="active"><a href="index.php?logout='1">Logout </a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>

</nav>

<?php


echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='page-header'>";
echo "<h4>My reference list. </h4>";
echo "</div>";
echo "<div class='panel panel-primary'>";
echo "<div class='panel-heading'>List of Doctor Reference</div>";
echo "<div class='panel-body'>";
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>App Id</th>";
echo "<th>Schedule Date </th>";
echo "<th>Doctor Name </th>";
echo "<th>Facility </th>";
echo "<th>Comment</th>";
echo "<th>Status</th>";


echo "</tr>";
echo "</thead>";
$user=$_SESSION['user']['id'];
$res = mysqli_query($conn, "SELECT appointment.id as id , appointment.date_created,facility.name as facility_name, status, firstname as doctor_name, comment  FROM `appointment` JOIN practitioner JOIN facility WHERE
 appointment.doctor_id=practitioner.id AND  
 practitioner.facility_id=facility.id  and patient_id='$user'");

if (!$res) {
    die("Error running $sql: " . mysqli_error());
}


while ($userRow = mysqli_fetch_array($res)) {
    echo "<tbody>";
    echo "<tr>";
    echo "<td>" . $userRow['id'] . "</td>";
    echo "<td>" . $userRow['date_created'] . "</td>";
    echo "<td>" . $userRow['doctor_name'] . "</td>";
    echo "<td>" . $userRow['facility_name'] . "</td>";
    echo "<td>" . $userRow['comment'] . "</td>";
    echo "<td>" ."<span class='label label-info'>Open</span>" . "</td>";

   }

echo "</tr>";
echo "</tbody>";
echo "</table>";

?>
</html>
