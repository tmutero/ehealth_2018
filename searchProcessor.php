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
//    echo $first_symptom;

    //Method to calculate
    $select = "SELECT * FROM `symptoms` WHERE name='$symptom'
                                                  AND name !='$first_symptom'";
    $run_select = mysqli_query($conn, $select);
    while ($rows = mysqli_fetch_array($run_select)) {
        $id = $rows['id'];
        $name = $rows['name'];

        echo $name;
    }


}

?>