<?php
include('conn.php');
$conn = mysqli_connect('localhost', 'root', '', 'ehealth');
include('functions.php');
include('conn.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$user = $_SESSION['user']['id'];
$sql = "SELECT * FROM future WHERE user_id ='$user' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$first_symptom = $row['symptom'];


if (isset($_POST['symptom'])) {
    search();
}
if (isset($_POST['symptoms3'])) {

    search2();

}
if (isset($_POST['key'])) {
    ?>
    <table class="table  table-hover">
        <tbody>
        <?php
        $count = 0;
        $key = $_POST['key'];
        $key = addslashes($key);
        $sql = mysqli_query($conn, "select DISTINCT (name), symptoms.id as id from symptoms WHERE name LIKE '%$key%'") or die(mysqli_error());
        While ($row = mysqli_fetch_array($sql)) {
            $count++;
            $name = $row['name'];
            $id = $row['id'];
            if ($count <= 10) {
                ?>

                <tr>

                    <td>&nbsp;<?php echo $name; ?> </td>

                    <td>

                        <button type="button" class="add btn btn-info" id="<?php echo $name; ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>

                    </td>

                </tr>

            <?php }
        }
        if ($count == "") {
            echo "no match Found";
        } else {
            ?>
        <?php } ?>
        </tbody>
    </table>
    <?php
}

if (isset($_POST['lat'])) {
    $user = $_SESSION['user']['id'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    $query = "UPDATE `users` SET `longitude`=$lon,`latitude`=$lat WHERE id=$user ";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    mysqli_query($conn, $query);

}
function search()
{
    $user = $_SESSION['user']['id'];

    $symptom = $_POST['symptom'];
    $query = "INSERT INTO future (symptom,found,user_id)
						                       VALUES('$symptom','1', '$user')";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    mysqli_query($conn, $query);
    global $first_symptom;

    $select = "SELECT DISTINCT name
FROM   disease JOIN symptoms ON disease.id = symptoms.disease_id
WHERE  name  NOT IN  ('$symptom','$first_symptom') 
GROUP  BY disease_id ";
    //var_dump($select);die();
    $run_select = mysqli_query($conn, $select);
    $num = mysqli_num_rows($run_select);
    ?>
    <div>
        <h4> Are you feeling the following Too</h4>
    </div>
    <?php
    if ($num == 0) {
        echo "No symptom matching";
    } else {

        while ($rows = mysqli_fetch_array($run_select)) {
            //$id = $rows['disease_id'];
            $name = $rows['name'];
            ?>
            <ul class="connectedSortable ui-sortable" id="search">
                <li class="ui-state-default" id="<?php echo $name; ?>"
                    name="<?php echo $name; ?>"><?php echo $name; ?></li>
            </ul>
            <?php
        }
        ?>
        <div><h4> If Yes choose the symptom</h4></div>
        <form class="form-horizontal" id="submit_data">
            <select class="form-control" id="symptoms3" name="symptoms3">
                <option value="" selected="selected" disabled="disabled">Select Symptom</option>
                <?php
                $run_select1 = mysqli_query($conn, $select);
                while ($rows = mysqli_fetch_array($run_select1)) {
                    $name2 = $rows['name'];
                    ?>
                    <option value=<?php echo $name2; ?>><?php echo $name2; ?></option>
                    <?php
                }
                ?>
            </select>
            <button type="button" onclick="searchOption3()" class="btn btn-success">Continue</button>
            <button type="button" class="btn btn-danger" onchange="stopSearch()" class="btn btn-primary">None of above
            </button>
        </form>
        <?php
    }
}

function search2()
{
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    $user = $_SESSION['user']['id'];
    $symptoms3 = $_POST['symptoms3'];
    /*selects user cordinates*/
    $select_user = "SELECT longitude,latitude FROM users WHERE id ='$user' ";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    $result = mysqli_query($conn, $select_user);
    $row = mysqli_fetch_array($result);

    $latitudeFrom = $row['latitude'];
    $longitudeFrom = $row['longitude'];

    $select = "SELECT  `id`, `name`, `city_id`, `address`, `latitude`, `longitude` FROM `facility`";
    $run_select = mysqli_query($conn, $select);
    while ($row = mysqli_fetch_array($run_select)) {
        $id = $row['id'];
        $name = $row['name'];
        $address = $row['address'];
        $latitudeTo = $row['latitude'];
        $longitudeTo = $row['longitude'];
        $city_id = $row['city_id'];


        $theta = $longitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        $distance = ($miles * 1.609344);

        $dis = round($distance, 3) . "km from here";
        $insert = "INSERT INTO `tmp`(`name`, `city_id`, `address`, `distance`,`user_id`,`facility_id`) 
          VALUES ('$name','$city_id','$address','$distance','$user','$id')";
        $run_insert = mysqli_query($conn, $insert);

    }


    /*end*/

    $sql = "SELECT * FROM future WHERE user_id ='$user'  ORDER by id DESC limit 2 ";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    $result = mysqli_query($conn, $sql);

    while ($row[] = mysqli_fetch_array($result)) {
    }
    $first_symptom = $row[0]['symptom'];
    $second_symptom = $row[1]['symptom'];

    $select = "SELECT DISTINCT name,disease, AVG(cutoff) AS cutoffPoints FROM   disease JOIN symptoms ON disease.id = symptoms.disease_id 
    WHERE  name   IN  ('$first_symptom','$second_symptom','$symptoms3') 
    GROUP  BY disease_id  ORDER BY  cutoffPoints  DESC";
    $run_select = mysqli_query($conn, $select);
    $num = mysqli_num_rows($run_select);

    if ($num == 0) {

        echo "<div class='alert alert-danger' role='alert'>No matching disease. Please try again later.</div>";
    } else {
        $row = mysqli_fetch_array($run_select);
        $name = $row['disease'];

        echo "<div class='alert alert-success' role='alert'>Disease Found          -$name</div>";

        ?>
        <div class="panel panel-info filterable">


            <div class="panel-heading">
                <h3 class="panel-title">List of Doctors</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button>
                </div>
            </div>
            <!-- panel heading end -->

            <div class="panel-body">
                <!-- panel content start -->
                <!-- Table -->
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Firstname" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Lastname" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Doctor Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Facility" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Facility Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Distance" disabled></th>
                    </tr>
                    </thead>

                    <?php
                    $result = mysqli_query($conn, "SELECT DISTINCT tmp.name as Facility , tmp.distance as Distance,practitioner.id ,practitioner.contact_details as Doc_Contact,
                                                practitioner.firstname as Firstname,
                                                practitioner.lastname as Lastname, 
                                                 
                                                tmp.address as Facility_Contact FROM   practitioner JOIN tmp ON practitioner.facility_id = tmp.facility_id WHERE  
                                                          tmp.user_id='$user' ORDER BY Distance ASC ");


                    while ($doctors = mysqli_fetch_array($result)) {


                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $doctors['Firstname'] . "</td>";
                        echo "<td>" . $doctors['Lastname'] . "</td>";
                        echo "<td>" . $doctors['Doc_Contact'] . "</td>";
                        echo "<td>" . $doctors['Facility'] . "</td>";
                        echo "<td>" . $doctors['Facility_Contact'] . "</td>";
                        echo "<td>" . $doctors['Distance'] . ".km from here" . "</td>";
                        echo "<form method='POST'>";
                        echo "<td class='text-center'><a href='appointment.php?&id=" . $doctors['id'] . "' class='glyphicon glyphicon-user'>Book Now</a></td>";

                    }
                    echo "</tr>";
                    echo "</tbody>";
                    echo "</table>";
                    $sql = "DELETE FROM `tmp` ";
                    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
                    $result = mysqli_query($conn, $sql);


                    ?>

            </div>
        </div>


        <?php


    }


}

?>
<script src="assets/js/jquery-1.12.3.min.js"></script>

<script type="text/javascript">
    $(function () {

        $("#search li").not('.emptyMessage').click(function () {
            alert('Symptoms. ' + this.id);
        });
    });


    $(function () {
        $(".add").click(function () {
            var element = $(this);
            var info = element.attr("id");

            $.ajax({
                type: "POST",
                url: "addSymptom.php",
                data: ({info: info}),
                success: function(data){
                    $(".result2").html(data);
                                  }

            }

            );

            $(this).parent().parent().fadeOut(300, function () {
                $(this).remove();
            });


            return false;

        });
    });

</script>

<script type="text/javascript">
    /*
    Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
    */
    $(document).ready(function () {
        $('.filterable .btn-filter').click(function () {
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

        $('.filterable .filters input').keyup(function (e) {
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
            var $filteredRows = $rows.filter(function () {
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
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
            }
        });
    });
</script>
