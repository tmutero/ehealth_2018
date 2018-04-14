<?php

$conn = mysqli_connect('localhost', 'root', '', 'ehealth');
include('functions.php');
include('conn.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_POST['symptom'])) {
    search();
}
function search()
{
    $user = $_SESSION['user']['id'];
    $sql = "SELECT * FROM future WHERE user_id ='$user' ORDER BY id DESC";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $first_symptom = $row['symptom'];

    $symptom = $_POST['symptom'];


    //Method to calculate
//    $select = "SELECT * FROM `symptoms` WHERE name='$symptom'
//                                                  AND name !='$first_symptom'";
    $select = "SELECT disease_id, name
FROM   disease JOIN symptoms ON disease.id = symptoms.disease_id
WHERE  name NOT IN  ('$symptom','$first_symptom') 
GROUP  BY disease_id HAVING COUNT(DISTINCT name) >1";
    //var_dump($select);die();
    $run_select = mysqli_query($conn, $select);
    ?>
    <div>
        <h4> Are you feeling the following</h4>
    </div>
    <?php
    while ($rows = mysqli_fetch_array($run_select)) {
        $id = $rows['disease_id'];
        $name = $rows['name'];

        ?>
        <ul class="connectedSortable ui-sortable" id="search">
            <li class="ui-state-default" name="<?php $name; ?>"><?php echo $name; ?></li>

        </ul>


        <?php
    }
    ?>
    <div><h4> Please choose the symptom</h4></div>
<form class="form-horizontal" id="submit_data">
    <select class="form-control" id="symptoms" name="symptoms">
        <?php
        $run_select1= mysqli_query($conn, $select);
        while ($rows = mysqli_fetch_array($run_select1)) {
            $name = $rows['name'];
            ?>
            <!--            <option value=value=--><?php //echo $name;
            ?><!-- name=""> --><?php //echo  $name;
            ?><!-- </option>-->
            <option value=<?php echo $name; ?>><?php echo $name; ?></option>

            <?php
        }
        ?>

    </select>
    <button type="submit" name="" class="btn btn-primary">Continue</button>
    <button type="button" class="btn btn-success" onclick='stopSearch()'
            class="btn btn-primary">None of above
    </button>

</form>

    <?php
}

?>
<script src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript">
    $(function () {

        $("#sortable1 li").not('.emptyMessage').click(function () {
            alert('Clicked list. ' + this.id);
        });
    });
    function stopSearch() {

    }
</script>
