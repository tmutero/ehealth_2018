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

<body onload="getLocation()">
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




                         <?php
                        include('conn.php');
                        if (isset($_POST['searchSymptom_btn'])) {
                            search();
                        }
                         function search()
                         {
                             $symptom = $_POST['search'];


                         $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
                         $symptom = $_POST['search'];
                         $user = $_SESSION['user']['id'];

                         $sql = "SELECT disease_id,name FROM symptoms WHERE name = '$symptom'";

                         $result = mysqli_query($conn, $sql);
                         // $row = mysqli_fetch_array($result);
                         $num = mysqli_num_rows($result);

                         ?>


                            <form id="submit_data">
                                <div class="form-group">
                                    <?php
                                    if ($num == 0) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>Error!</strong> Could not find symptom.
                                        </div>
                                        <?php
                                    }

                                    else{
                                    ?>
                                    <div class="alert alert-info">

                                        <strong>Symptom found</strong> -Are you feeling the following


                                    </div>
                                    <?php
                                    $query = "INSERT INTO future (symptom,found,user_id)
						                       VALUES('$symptom','1', '$user')";

                                    mysqli_query($conn, $query);

                                    ?>
                                    <h4> Select Symptoms Below </h4>

                                    <select class="form-control" id="symptom" name="symptom"
                                            onchange='searchProcessor()' >
                                        <option value="" selected="selected" disabled="disabled">Select Symptom
                                        </option>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            $disease = $row['disease_id'];
                                            echo $disease;
                                            $N = count($disease);
                                            for ($i = 0; $i < $N; $i++) {

                                                $num = mysqli_num_rows($result);
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


                            </form>



                            <div class="">
                                <div id="result"></div>

                            </div>


                        <?php



                        }
                        ?>




</div>
    </div>
</div>
<footer>Munatsi 2018 System</footer>
<script src="assets/patientassets/js/jquery.min.js"></script>
<script src="assets/patientassets/bootstrap/js/bootstrap.min.js"></script>
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

        function searchOption3() {

            var symptoms3 = $("#symptoms3").val();
            alert(symptoms3);
            $.post("searchProcessor.php", {
                    symptoms3: symptoms3,

                },

                function (data) {
                    $('#result').html(data);
                    $('#submit_data')[0].reset()

                });

            function stopSearch() {
                alert("Do want to stop");

            }
        }


    </script>

    <script src="assets/js/jquery-1.12.3.min.js"></script>
    <script>
        function getLocation() {
            alert("Allow site to track location");
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";}
        }

        function showPosition(position) {

            var lat=position.coords.latitude;
            var lon=position.coords.longitude;


            $.post("searchProcessor.php", {
                    lat: lat,
                    lon:lon,

                });

        }
    </script>


    </script>


<script type="text/javascript">
    /*
    Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
    */
    $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });
    });
</script>


</body>

</html>
