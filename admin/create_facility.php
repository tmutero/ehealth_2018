<?php 
	include('../functions.php');

	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-health - Dashboard</title>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/css/datepicker3.css" rel="stylesheet">
	<link href="../assets/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>E-health</span>Admin</a>
				<ul class="nav navbar-top-links navbar-right">
						
						
					
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="../images/admin_profile.png" class="img-responsive" >
			</div>
			<div class="profile-usertitle">
				<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
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
			<li class="active"><a href="home.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="view_disease.php"><em class="fa fa-calendar">&nbsp;</em> Diseases</a></li>
			<li><a href="view_symptom.php"><em class="fa fa-calendar">&nbsp;</em> Symptoms</a></li>
			<li><a href="view_doctors.php"><em class="fa fa-calendar">&nbsp;</em> Doctors</a></li>
			<li><a href="view_facility.php"><em class="fa fa-bar-chart">&nbsp;</em>Facilities</a></li>
			<li><a href="create_user.php"><em class="fa fa-bar-chart">&nbsp;</em> Create User</a></li>
			<li><a href="feedback.php"><em class="fa fa-calendar">&nbsp;</em> Feedback</a></li>
			
			
			<li><a href="home.php?logout='1'" >&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Facility </li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		
	
		<div class="panel panel-container">
			
		</div>
			
			
	<div class="container">
	
                             <div class="row">
								<div class="page-header">
									<font size="5">
										<u></u>
									</font>
								</div>
							</div><div class="panel panel-default">
								<div id="result" ></div>
					<div class="panel-heading">Add Facility</div>
					<div class="panel-body">
						<div class="col-md-6">
							<form role="form"  id="submit_data">
								<div class="form-group">
									<label>Facility Name</label>
									<input class="form-control" placeholder="" id="name" name="name">
								</div>
								<div class="form-group">
										<label>City</label>
										<select class="form-control" id="city_id" name="city_id" >
												<?php
												include('../conn.php');
												$select="SELECT  * FROM `city`";
												$run_select=mysqli_query($conn,$select);
								
												while ($rows=mysqli_fetch_array($run_select)) {
													$id=$rows['id'];
													$name=$rows['name'];
												//var_dump($id);die();

												
												?>

											<option value=<?php echo $id; ?>><?php echo $name; ?>
										
									
											</option>
									<?php
												}

									?>
											
										</select>
									</div>
							
								<div class="form-group">
									<label>Address</label>
									<textarea class="form-control" rows="2" id="address" name="address"></textarea>
								</div>
                               

                                
                                <div id="result" ></div>
                              

  
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFwpoic3cubV6NO58GKT7RWBIiWC1wPyU&callback=initMap">
    </script>

                            
                                <button type="button" class="btn btn-primary" onclick='saveData()'>Submit Button</button>
                                <script src="jquery-1.12.3.min.js"></script>
                                 <script type="text/javascript">
    	 function  saveData() {
             	                    alert();
                                    var name =$("#name").val();
                                    var address=$("#address").val();
                                    var city_id=$("#city_id").val();
                                     $.post("facilityProcessor.php", { 
                                      name:name,
                                      address:address,
                                      city_id:city_id,
                                      
                                      },

                                    function(data) {
                                                    $('#result').html(data);
                                                     $('#submit_data')[0].reset()
                                                    
                                                            });
                                }
    </script>

   
   

								
									
									
						</div>
								
								<div class="col-md-6">
								
	
                             <div class="row">
								<div class="page-header">
									<font size="3">
										<u>Previous Facilities</u>
									</font>
								</div>
							</div>
							 <div class="row">
							 <table class="table table-striped">
							 <thead>
      <tr>
      <tr>
        <th>Facility </th>
        <th>City</th>
        <th>Address</th>
	    <th>Preview</th>

      </tr>
    </thead>
								<?php
								include('../conn.php');
								//$select="SELECT  `f.name as name`, `c.name as city`, `f.address as address` FROM `facility f, city c` WHERE `f.city_id=c.id`";
								
								$select="SELECT f.name as name, c.name as city, f.address as address FROM facility f, city c WHERE f.`city_id`=c.id";

								$run_select=mysqli_query($conn,$select);
								
								while ($rows=mysqli_fetch_array($run_select)) {
									$name=$rows['name'];
									$city=$rows['city'];
									$address=$rows['address'];
									
									
									?>
									<tr>
										<td><?php echo $name; ?></td>
										<td><?php echo $city; ?></td>
										<td><?php echo $address; ?></td>
										
										<td></td>
										</tr>
										<?php
								}

								?>
										
							 </table>
							 </div>
	</div>
									
									
									
								</div>
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			<!-- /.col-->

		
		<div class="row">
			
			<div class="col-sm-12">
				<p class="back-link">Tansoft <a href="#">Medialoot</a></p>
			</div>
		</div><!--/.row-->
		</div><!--/.row-->
		<!--/.main-->
	
	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/chart.min.js"></script>
	<script src="../assets/js/chart-data.js"></script>
	<script src="../assets/js/easypiechart.js"></script>
	<script src="../assets/js/easypiechart-data.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/custom.js"></script>
	
		
</body>
</html>