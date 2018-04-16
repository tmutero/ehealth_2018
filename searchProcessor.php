<?php

$conn = mysqli_connect('localhost', 'root', '', 'ehealth');
include('functions.php');
include('conn.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$user = $_SESSION['user']['id'];
if (isset($_POST['symptom'])) {
    search();
}
if (isset($_POST['symptoms3'])) {
    echo "Yess";
    search2();

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

    $select = "SELECT DISTINCT name
FROM   disease JOIN symptoms ON disease.id = symptoms.disease_id
WHERE  name NOT IN  ('$symptom','$first_symptom') 
GROUP  BY disease_id HAVING COUNT(DISTINCT name) >1";
    //var_dump($select);die();
    $run_select = mysqli_query($conn, $select);
    $num = mysqli_num_rows($run_select);
    ?>
    <div>
        <h4> Are you feeling the following Too</h4>
    </div>
    <?php
    while ($rows = mysqli_fetch_array($run_select)) {
        //$id = $rows['disease_id'];
        $name = $rows['name'];
//
//      echo "<ul class='list-group'>";
//        echo "<li class='list-group-ite'>" . $name . "</li>";
//     echo "</ul>";
        ?>
        <ul class="connectedSortable ui-sortable" id="search">
            <li class="ui-state-default" name="<?php $name; ?>"><?php echo $name; ?></li>

        </ul>


        <?php
    }
    ?>
    <div><h4> If Yes choose the symptom</h4></div>
    <form class="form-horizontal" id="submit_data">
        <select class="form-control" id="symptoms3" name="symptoms3">
            <?php
            $run_select1 = mysqli_query($conn, $select);
            while ($rows = mysqli_fetch_array($run_select1)) {
                $name2 = $rows['name'];
                ?>
                <!--            <option value=value=--><?php //echo $name;
                ?><!-- name=""> --><?php //echo  $name;
                ?><!-- </option>-->
                <option value=<?php echo $name2; ?>><?php echo $name2; ?></option>

                <?php
            }
            ?>

        </select>

        <button type="button" onclick="searchOption3()" class="btn btn-primary">Continue</button>
        <button type="button" class="btn btn-success" onchange="stopSearch()" class="btn btn-primary">None of above
        </button>

    </form>

    <?php
}
function search2(){

}
?>

<script src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript">
    $(function () {

        $("#sortable1 li").not('.emptyMessage').click(function () {
            alert('Clicked list. ' + this.id);
        });
    });

</script>
