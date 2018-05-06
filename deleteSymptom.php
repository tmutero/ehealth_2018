<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 5/5/2018
 * Time: 10:22 PM
 */

include_once 'conn.php';
// Get the variables.

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    echo $id;
    $sql = "DELETE FROM future WHERE id = '$id' ";
    $conn = mysqli_connect('localhost', 'root', '', 'ehealth');
    $result = mysqli_query($conn, $sql);
}

?>