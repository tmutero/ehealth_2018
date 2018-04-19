<?php
include('conn.php');
//$conn = mysqli_connect('localhost', 'root', '', 'ehealth');
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
            <button type="button" onclick="searchOption3()" class="btn btn-primary">Continue</button>
            <button type="button" class="btn btn-success" onchange="stopSearch()" class="btn btn-primary">None of above
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


    $sql = "SELECT * FROM future WHERE user_id ='$user'  ORDER by id DESC limit 2 ";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    $result = mysqli_query($conn, $sql);
    $row = array();
    while ($row[] = mysqli_fetch_array($result)) {
        }
    $first_symptom=  $row[0]['symptom'];
    $second_symptom =$row[1]['symptom'];
    echo "-----\n",$symptoms3;
    echo "--------\n",$first_symptom;
    echo $second_symptom;

    $select = "SELECT DISTINCT name,disease FROM   disease JOIN symptoms ON disease.id = symptoms.disease_id 
    WHERE  name   IN  ('$first_symptom','$second_symptom') AND name='$symptoms3'
    GROUP  BY disease_id ";
    $run_select = mysqli_query($conn, $select);
    $num = mysqli_num_rows($run_select);

    if ($num == 0) {
      echo  "End Loop";

    }
    else if($num==1){
    echo  "Continue";
    }
    else if ($num==2){
        echo "Two records";
    }

/*
 *
 * SELECT * FROM disease JOIN symptoms ON disease.id = symptoms.disease_id  WHERE name='Muscle pain' or name   IN  ('fever','headache')   ORDER BY cutoff
DESC
 */
}

?>
<script src="assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript">
    $(function () {

        $("#search li").not('.emptyMessage').click(function () {
            alert('Symptoms. ' + this.id);
        });
    });

</script>
