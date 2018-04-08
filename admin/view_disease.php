<?php
include('../functions.php');

if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-health - Dashboard</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/datepicker3.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#"><span>E-health</span>Admin</a>
            <ul class="nav navbar-top-links navbar-right">


            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="../images/admin_profile.png" class="img-responsive">
        </div>
        <div class="profile-usertitle">
            <div>
                <?php if (isset($_SESSION['user'])) : ?>
                    <strong><?php echo $_SESSION['user']['username']; ?></strong>

                    <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
                    <br>
                <?php endif ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
        <li><a href="view_disease.php"><em class="fa fa-calendar">&nbsp;</em> Diseases</a></li>
        <li><a href="view_symptom.php"><em class="fa fa-calendar">&nbsp;</em> Symptoms</a></li>
        <li><a href="view_doctors.php"><em class="fa fa-calendar">&nbsp;</em> Doctors</a></li>
        <li><a href="view_facility.php"><em class="fa fa-bar-chart">&nbsp;</em>Facilities</a></li>
        <li><a href="create_user.php"><em class="fa fa-bar-chart">&nbsp;</em> Create User</a></li>
        <li><a href="feedback.php"><em class="fa fa-calendar">&nbsp;</em> Feedback</a></li>


        <li><a href="home.php?logout='1'">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="page-header">
                    <font size="5">
                        <u>Disease</u>
                    </font>
                </div>
                <div>
                    <a href="create_disease.php">Add Disease</a>
                </div>


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Disease</th>

                        <th>Date Created</th>


                    </tr>
                    </thead>
                    <?php
                    include('../conn.php');
                    $select = "SELECT  `disease`, `notes`, `who_stage`, `date_created` FROM `disease`";
                    $run_select = mysqli_query($conn, $select);

                    while ($rows = mysqli_fetch_array($run_select)) {
                        $disease = $rows['disease'];
                        $notes = $rows['notes'];
                        $who_stage = $rows['who_stage'];
                        $date_created = $rows['date_created'];

                        ?>
                        <tr>
                            <td><?php echo $disease; ?></td>

                            <td><?php echo $date_created; ?></td>

                        </tr>
                        <?php
                    }

                    ?>

                </table>

            </div>
        </div>


        <div class="row">

            <div class="col-sm-12">
                <p class="back-link">Tansoft <a href="#">Medialoot</a></p>
            </div>
        </div><!--/.row-->
    </div>
</div>


<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/chart-data.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    window.onload = function () {
        +
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

</body>
</html>