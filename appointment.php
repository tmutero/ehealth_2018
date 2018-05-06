<?php
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
    <title>ehealth</title>
    <link rel="stylesheet" href="assets/patientassets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/patientassets/css/styles.css">
    <link rel="stylesheet" href="assets/patientassets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/patientassets/css/Pretty-Header.css">
    <link rel="stylesheet" href="assets/patientassets/css/Pretty-Footer.css">
</head>

<body>
<nav class="navbar navbar-static-top custom-header">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Smart Health Diagnosis System</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav links">
                <li role="presentation"><a href="#">Overview </a></li>
                <li role="presentation"><a href="#">Report </a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"> <?php if (isset($_SESSION['user'])) : ?>



                    <?php endif ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-user"></i> <?php echo $_SESSION['user']['username']; ?><b class="caret"></b></a>

                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation" class="active"><a href="index.php?logout='1">Profile </a></li>
                        <li role="presentation" class="active"><a href="index.php?logout='1">Logout </a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3">

            <div class="user-wrapper">
                <img src="images/user_profile.png" class="img-responsive" />
                <div class="description">
                    <h4> <?php echo $_SESSION['user']['username']; ?></h4>
                    <h5> <strong>Patient</strong></h5>
                    <p>

                    </p>
                    <hr />
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Update Profile</button>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9  user-wrapper">
            <div class="description">


                <div class="panel panel-default">
                    <div class="panel-body">


                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Patient Information</div>
                                <div class="panel-body">

                                    Patient Name: <?php echo $_SESSION['user']['username']; ?><br>
                                    Patient IC: <?php echo $_SESSION['user']['id'] ?><br>
                                    Contact Number: <?php echo $_SESSION['user']['email']; ?><br>
                                    Date Created: <?php echo $_SESSION['user']['date_create']; ?>
                                </div>
                            </div>
                            <?php
                            $doctor = $_GET['id'];
                            $conn=mysqli_connect('localhost', 'root', '', 'ehealth');

                            $sql = "SELECT * FROM practitioner JOIN facility ON practitioner.facility_id = facility.id  WHERE practitioner.id ='$doctor' ";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            $firstname = $row['firstname'];
                            $lastname=$row['lastname'];
                            $contact_details=$row['contact_details'];
                            $gender=$row['gender'];

                            $facility=$row['name'];



                            if (isset($_POST['appointment'])) {
                                $patient_id=$_SESSION['user']['id'];
                                $comment = mysqli_real_escape_string($conn, $_POST['comment']);


                                $query = "INSERT INTO appointment (patient_id ,doctor_id ,status ,comment  )
                              VALUES ( '$patient_id','1' ,'1', '$comment') ";

                                //update table appointment schedule



                                $result = mysqli_query($conn, $query);
                                // echo $result;
                                if ($result) {
                                    ?>
                                    <script type="text/javascript">
                                        alert('Appointment made successfully.');
                                    </script>
                                    <?php
                                    header("Location: appointmentlist.php");
                                }
                            }



                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">Appointment Information</div>
                                <div class="panel-body">
                                    Doctor Firstname: <?php echo $firstname; ?><br>
                                    Doctor Lastname: <?php echo $lastname; ?><br>
                                    Doctor Contact:<?php echo $contact_details;?><br>
                                    Facility Name: <?php echo $facility; ?><br>
                                    Time: <?php echo date("h:i:sa"); ?><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Comment:</label>
                                <textarea class="form-control" name="comment" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="appointment" id="submit" class="btn btn-success" value="Make Appointment">
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<footer></footer>
<script src="assets/patientassets/js/jquery.min.js"></script>
<script src="assets/patientassets/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/js/jquery-1.12.3.min.js"></script>


</body>

</html>
