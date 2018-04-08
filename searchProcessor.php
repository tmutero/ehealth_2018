<?php
include('conn.php');
//$conn=mysqli_connect('localhost', 'root', '', 'ehealth');

$symptom    =  $_POST['symptom'];
$longitude=$_POST['longitude'];
$latitude=$_POST['latitude'];
$sql="SELECT DISTINCT * FROM symptoms WHERE name !='$symptom'  ";

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

//algorithm to calculate nearest facility 
	/*



SELECT id, ((2* asin  (sqrt   ( pow (sin  (`latitude`-31.200092)/2, 2) + cos (31.200092)*cos(`latitude`)*pow( sin(`longitude`- 29.915739)/2,2 ))))*6371 ) as distance FROM facility ORDER BY distance

	*/

/*










SELECT  p.firstname as doc, f.name as facility_name,


((2* asin  (sqrt   ( pow (sin  (f.latitude-31.200092)/2, 2) + cos (31.200092)*cos(f.latitude)*pow( sin(f. longitude- 29.915739)/2,2 ))))*3959 ) as distance

FROM practitioner p, facility f WHERE  p.facility_id=f.id


SELECT id, ( 6371 * acos( cos( radians(30.916772) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians(-17.8165877) ) + sin( radians(30.916772) ) * sin( radians( `latitude` ) ) ) ) AS distance FROM facility  ORDER BY distance LIMIT 0 , 20;



*/
?>
    <form action="#">

        <div class="checkbox">
            <label><input type="checkbox" onclick="second()" value="<?php echo $row['name']?>" id="x"><?php echo $row['name']?></label>

        </div>

    </form>

    <?php

}

?>