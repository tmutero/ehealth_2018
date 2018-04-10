<?php
include('functions.php');
include('conn.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-health - Dashboard</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/datepicker3.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">

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
            <a class="navbar-brand" href="#"><span>Ehealth</span>Patient</a>

        </div>
    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="images/admin_profile.png" class="img-responsive">
        </div>
        <div class="profile-usertitle">
            <div>
                <?php if (isset($_SESSION['user'])) : ?>
                    <strong><?php echo $_SESSION['user']['username']; ?></strong>

                    <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
                    <div class="profile-usertitle-status"><span class="indicator label-success"></span></div>
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
        <li><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>

        <li><a href="index.php?logout='1'"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Diagnosis</li>
        </ol>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="row">


                        <?php
                        include('conn.php');
                        if (isset($_POST['thirdSearch_btn'])) {
                            search();
                        }

                        function search()
                        {
                            include('conn.php');
                            $user = $_SESSION['user']['id'];
                            $aDoor = $_POST['result'];
                            $N = count($aDoor);
                            $sql = "SELECT * FROM future WHERE user_id ='$user' ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);
                            $row=mysqli_fetch_array($result);
                            $first_symptom=$row['symptom'];
                            echo $first_symptom;

                            $num = mysqli_num_rows($result);
                            if ($N == 1) {
                                $select = "SELECT DISTINCT s.name,  d.disease as disease FROM symptoms s, disease d WHERE name='$aDoor[0]' AND s.disease_id=d.id";
                                $run_select = mysqli_query($conn, $select);

                                $row = mysqli_fetch_array($run_select);
                                $disease = $row['disease'];


                                ?>
                                <div class="alert alert-info">
                                    <strong><?php echo $disease ?></strong> Found
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>

                                        <th>Facility Name</th>
                                        <th>Facility Contact</th>
                                        <th>Doctor Name</th>
                                        <th>Doctor Contact</th>
                                        <th>Distance</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <?php
                                    include('conn.php');

                                    $select_doc = "SELECT f.id , P.firstname as doc, f.name as facility_name,f.address as facility_address, p.contact_details
                                    as doc_contact,( 6371 * acos( cos( radians(30.916772) ) * 
                                cos( radians( f.latitude ) ) * cos( radians( f.longitude ) - radians(-17.8165877) ) 
                                + sin( radians(30.916772) ) *sin( radians( f.latitude ) ) ) ) 
                                AS distance FROM facility f, practitioner p WHERE P.facility_id=F.id ORDER BY distance LIMIT 0 , 20";
                                    $run_select2 = mysqli_query($conn, $select_doc);
                                    while ($rows = mysqli_fetch_array($run_select2)) {
                                        $doc_contact = $rows['doc_contact'];
                                        $facility_name = $rows['facility_name'];
                                        $doc = $rows['doc'];
                                        $facility_address = $rows['facility_address'];
                                        $distance = $rows['distance'];
                                        ?>
                                        <tr>
                                            <td><?php echo $facility_name; ?></td>
                                            <td><?php echo $facility_address; ?></td>
                                            <td><?php echo $doc; ?></td>
                                            <td><?php echo $doc_contact; ?></td>
                                            <td><?php echo $distance + "KM"; ?></td>
                                            <td></td>


                                        </tr>
                                        <?php
                                    }

                                    ?>

                                </table>


                                <?php
                            }

                            if ($N == 2) {
                                $select = "SELECT s.name, d.disease as disease FROM symptoms s, disease d WHERE name='$aDoor[0]' OR name='$aDoor[1]'AND s.disease_id=d.id";
                                $run_select = mysqli_query($conn, $select);

                                $row = mysqli_fetch_array($run_select);
                                $disease = $row['disease'];

                                ?>

                                <div class="alert alert-info">
                                    <strong><?php echo $disease ?></strong>
                                </div>
                                <?php
                            }
                            echo("<p>You selected $N Symptoms(s): ");
                            for ($i = 0; $i < $N; $i++) {
                                echo($aDoor[$i] . " ");
                                $symptom = $aDoor[$i];
//                                $query = "INSERT INTO future (symptom,found,user_id)
//						                       VALUES('$symptom','1', '$user')";
//
//                                mysqli_query($conn, $query);

                            }
                            echo("</p>");
                            if ($N == 3) {

                                $symptom1 = $aDoor[0];
                                $symptom2 = $aDoor[1];


                            }

                        }


                        ?>
                        <script src="assets/js/jquery-1.12.3.min.js"></script>
                        <script type="text/javascript">


                            function example() {
                                var result = $("#result").val();

                                alert(result);


                            }


                        </script>

                    </div>
                </div>
            </div><!-- /.panel-->
        </div><!-- /.col-->
        <div class="col-sm-12">
            <p class="back-link">TanSoft <a href="#">Medialoot</a></p>
        </div>
    </div><!-- /.row -->
</div><!--/.main-->
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
        console.log("+++++++++++++++++++++" + latitude);
        console.log("++++++++++++++++=+++++" + longitude);
        $.ajax({
            type: 'POST',
            url: 'secondSearch.php',
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


<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/chart-data.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/custom.js"></script>


<script>
    window.onload = function () {
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