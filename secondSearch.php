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
            <img src="images/user_profile.png" class="img-responsive">
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
            <h4 class="page-header">Select Symptoms</h4>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="col-md-6">


                        <?php
                        include('conn.php');
                        if (isset($_POST['searchSymptom_btn'])) {
                            search();
                        }


                        function search()
                        {

                            $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
                            $symptom = $_POST['search'];
                            $user = $_SESSION['user']['id'];

                            $sql = "SELECT disease_id,name FROM symptoms WHERE name ='$symptom'";

                            $result = mysqli_query($conn, $sql);
                            // $row = mysqli_fetch_array($result);
                            $num = mysqli_num_rows($result);
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-body">Are you are feeling those symptoms</div>

                                <form class="form-horizontal" id="submit_data">
                                    <div class="form-group">
                                        <?php
                                        if ($num == 0) {
                                            ?>
                                            <div class="danger">
                                                <h4>Error could not find any symptom match</h4>

                                            </div>
                                            <?php
                                        }
                                        else{
                                        $query = "INSERT INTO future (symptom,found,user_id)
						                       VALUES('$symptom','1', '$user')";

                                        mysqli_query($conn, $query);

                                        ?>

                                        <select class="form-control" id="symptom" name="symptom">
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                                $disease = $row['disease_id'];
                                                // echo $disease;
                                                $N = count($disease);
                                                for ($i = 0; $i < $N; $i++) {

                                                    // echo $disease[$i] . "<br>";

                                                    $num = mysqli_num_rows($result);


                                                    ?>


                                                    <?php

                                                    $select = "SELECT DISTINCT name FROM `symptoms` WHERE disease_id='$disease'
                                                  AND name !='$symptom'";
                                                    $run_select = mysqli_query($conn, $select);

                                                    while ($rows = mysqli_fetch_array($run_select)) {
                                                        $id = $rows['id'];
                                                        $name = $rows['name'];
                                                        ?>
                                                        <option value=<?php echo $name; ?>><?php echo $name; ?>


                                                        </option>
                                                        <?php

                                                    }

                                                    ?>


                                                    <?php


                                                }
                                            }


                                            }

                                            ?>
                                        </select>


                                    </div>

                                    <button type="button" class="btn btn-primary" onclick='searchProcessor()'
                                            class="btn btn-primary">End Searching
                                    </button>
                                    <button type="submit" name="" class="btn btn-primary">Next</button>
                                </form>
                                <div id="result"></div>
                            </div>
                            <?php
                        }

                        ?>
                        <script src="assets/js/jquery-1.12.3.min.js"></script>
                        <script type="text/javascript">


                            function searchProcessor() {
                                var symptom = $("#symptom").val();

                                $.post("searchProcessor.php", {
                                        symptom: symptom,

                                    },

                                    function (data) {
                                        $('#result').html(data);
                                        $('#submit_data')[0].reset()

                                    });


                            }


                        </script>

                    </div>
                </div>
            </div><!-- /.panel-->
        </div><!-- /.col-->
        <div class="col-sm-12">
            <p class="back-link">TanSoft <a href="https://www.medialoot.com">Medialoot</a></p>
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


</body>
</html>