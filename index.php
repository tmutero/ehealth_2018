<?php
include('functions.php');
//
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
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php">Smart Health Diagnosis System</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav links">
                <li role="presentation"><a href="#">Overview </a></li>
                <li role="presentation"><a href="#">Report </a></li>
                <li role="presentation"><a href="#" class="custom-navbar"> Feedback<span class="badge">new</span></a></li>
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
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="text-justify panel-title">System Overview</h2></div>
                <div class="panel-body">
                    <span class="text-primary bg-success"> </span>
                    <img src="assets/patientassets/img/3.png">
                    <img src="assets/patientassets/img/2.png">
                    <p>Smart Diagnosis System allows patients to diagnoised them from the symptoms.
                        Disease output is based on the symptoms from the Patients.</p>
                    <p>System also allows Patients to book for Appointment from the
                        Doctors nearest to their point of system use.</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Diagnosis Form- </h3></div>
                <div class="panel-body">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form role="form" class="form-horizontal"   method="post" action="secondSearch.php">

                            <div class="form-group">
                                <label>Search Symptom</label>
                                <input class="form-control" placeholder="" name="search">
                            </div>



                            <button type="Submit" class="btn btn-info"
                                    name="searchSymptom_btn">Search Symptom
                            </button>

                            <div id="result"></div>






                        </form></div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
<footer></footer>
<script src="assets/patientassets/js/jquery.min.js"></script>
<script src="assets/patientassets/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/js/jquery-1.12.3.min.js"></script>
<script>
    $(document).ready(function () {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);

        } else {
            $('#location').html('Geolocation is not supported by this browser.');
        }
    });

    function showLocation(position) {

        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        $.ajax({
            type: 'POST',
            url: 'getLocation.php',
            data: 'latitude=' + latitude + '&longitude=' + longitude,

            success: function (msg) {
                if (msg) {
                    $("#location").html(msg);

                } else {
                    $("#location").html('Not Available');
                }
            }
        });

    }
</script>

</body>

</html>
