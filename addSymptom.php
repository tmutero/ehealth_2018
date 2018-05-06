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
  else {
      $sql = "SELECT * FROM future WHERE user_id ='$user'  ORDER by id DESC  ";
      $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
      $result = mysqli_query($conn, $sql);
      $num_rows = mysqli_num_rows($result);
      while ($row[] = mysqli_fetch_array($result)) {
      }
      if ($num_rows == 3) {

          $first_symptom = $row[0]['symptom'];
          $second_symptom = $row[1]['symptom'];
          $third_symptom = $row[2]['symptom'];

          $select = "SELECT disease, MAX(mycount) 
FROM (SELECT disease ,COUNT(disease_id) mycount 
FROM  disease JOIN symptoms ON disease.id = symptoms.disease_id 
    WHERE  name  IN  ('$first_symptom','$second_symptom','$third_symptom'  )
GROUP BY disease_id) as c; ";
          $run_select = mysqli_query($conn, $select);
          $num = mysqli_num_rows($run_select);

          /*
           * SELECT disease, MAX(mycount)
          FROM (SELECT disease ,COUNT(disease_id) mycount
          FROM  disease JOIN symptoms ON disease.id = symptoms.disease_id
              WHERE  name  IN  ('chest pain','vomiting','fatigue' IS NOT NULL)
          GROUP BY disease_id) as c;
           */
          $row = mysqli_fetch_array($run_select);
          $name = $row['disease'];

          ?>


          <div class='alert alert-success' role='alert'> Likely Diagnoses -<?php echo $name; ?></div>


          <?php

      }

      if ($num_rows == 4) {

          $first_symptom = $row[0]['symptom'];
          $second_symptom = $row[1]['symptom'];
          $third_symptom = $row[2]['symptom'];
          $forth_sysmptom = $row[3]['symptom'];


          $select = "SELECT disease, MAX(mycount) 
FROM (SELECT disease ,COUNT(disease_id) mycount 
FROM  disease JOIN symptoms ON disease.id = symptoms.disease_id 
    WHERE  name  IN  ('$first_symptom','$second_symptom','$third_symptom','$forth_sysmptom'  )
GROUP BY disease_id) as c;";

          $run_select = mysqli_query($conn, $select);
          $row = mysqli_fetch_array($run_select);
          $name = $row['disease'];

          ?>


          <div class='alert alert-success' role='alert'> Likely Diagnoses -<?php echo $name; ?></div>


          <?php

      }
      if ($num_rows == 5) {
          $first_symptom = $row[0]['symptom'];
          $second_symptom = $row[1]['symptom'];
          $third_symptom = $row[2]['symptom'];
          $forth_sysmptom = $row[3]['symptom'];
          $fifth_sysmptom = $row[4]['symptom'];

          $select = "SELECT disease, MAX(mycount) 
FROM (SELECT disease ,COUNT(disease_id) mycount 
FROM  disease JOIN symptoms ON disease.id = symptoms.disease_id 
    WHERE  name  IN  ('$fifth_sysmptom','$first_symptom','$second_symptom','$third_symptom','$forth_sysmptom'  )
GROUP BY disease_id) as c;";

          $run_select = mysqli_query($conn, $select);
          $row = mysqli_fetch_array($run_select);
          $name = $row['disease'];

          ?>


          <div class='alert alert-success' role='alert'> Likely Diagnoses -<?php echo $name; ?></div>


          <?php
      }


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
      ?>
      <div class="panel panel-info filterable">


            <div class="panel-heading">
                <h3 class="panel-title">List of Nearest Doctors</h3>
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
                        <th><input type="text" class="form-control" placeholder="Firstname " disabled></th>
                        <th><input type="text" class="form-control" placeholder="Lastname " disabled></th>
                        <th><input type="text" class="form-control" placeholder="Doc Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Facility" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Fac Contact" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Distance" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Action" disabled></th>
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

                    $sql = "DELETE FROM `future` ";
                    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
                    $result = mysqli_query($conn, $sql);


                    ?>

            </div>
        </div>
<?php

  }
?>
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
