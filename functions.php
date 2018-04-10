<?php 
	session_start();
	

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'ehealth');

	// variable declaration
	$username = "";
	$email    = "";
	$name     ="";
	$notes    ="";
	$errors   = array();
	// 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}
	if(isset($_POST['create_disease_btn']))
	{
		create_disease();
	}
	if(isset($_POST['create_symptom_btn']))
	{
		create_symptom();
	}
	if(isset($_POST['create_facility_btn']))
	{
		create_facility();
	}
	if(isset($_POST['create_doctors_btn']))
	{
		create_doctors();
	}


	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', 'user', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');				
			}

		}

	}
	
	function create_disease(){
		global $db, $errors;

		// receive all input values from the form
		$disease    =  e($_POST['disease']);
		$who_stage=e($_POST['who_stage']);
		$notes=e($_POST['notes']);
		
		
		// form validation: ensure that the form is correctly filled
		if (empty($disease)) { 
			array_push($errors, "Disease is required"); 
		}
		if (empty($who_stage)) { 
			array_push($errors, "Who Stage is required"); 
		}
		if (empty($notes)) { 
			array_push($errors, "Disease Description is required"); 
		}
		
		// save disease if there are no errors in the form
		if (count($errors) == 0) {
			 $date= date("Y-M-D");
			
				$query = "INSERT INTO disease (disease, notes,who_stage,date_created) 
						  VALUES('$disease', '$notes', '$who_stage', '$date')";
						  
				mysqli_query($db, $query);
			
				header('location: view_disease.php');
			

		}
	}
	
	//create doctors method
		function create_doctors(){
		global $db, $errors;

		// receive all input values from the form
		$firstname    =  e($_POST['firstname']);
		$lastname=e($_POST['lastname']);
		$contact_details=e($_POST['contact_details']);
		$gender    =  e($_POST['gender']);
		$facility_id=e($_POST['facility_id']);
		$speciality=e($_POST['speciality']);
		$disease_id=e($_POST['disease_id']);
		//var_dump($disease_id);die();
		
		
		// form validation: ensure that the form is correctly filled
		//if (empty($firstname)) { 
			//array_push($errors, "firstname name is required"); 
		//}
		//if (empty($lastname)) { 
		//	array_push($errors, "lastname is required"); 
		//}	
		//if (empty($contact_details)) { 
			//array_push($errors, "contact_details is required"); 
		//}
		
		// save disease if there are no errors in the form
		if (count($errors) == 0) {
			 $date= date('Y-M-D');
			
				$query = "INSERT INTO practitioner (firstname, lastname,contact_details,
				date_created,gender,facility_id,speciality,disease_id) 
						  VALUES('$firstname', '$lastname', '$contact_details','$date',
						  '$gender', '$facility_id','$speciality','$disease_id')";
				//var_dump($query);die();
				mysqli_query($db, $query);
			
				header('location: view_doctors.php');
			

		}
	
		}

	//create facility method
		function create_facility(){
		global $db, $errors;

		// receive all input values from the form
		$name    =  e($_POST['name']);
		$city_id=e($_POST['city_id']);
		$address=e($_POST['address']);
		
		
		// form validation: ensure that the form is correctly filled
		if (empty($name)) { 
			array_push($errors, "Facility name is required"); 
		}
		if (empty($city_id)) { 
			array_push($errors, "City is required"); 
		}
		if (empty($address)) { 
			array_push($errors, "Address is required"); 
		}
		
		// save disease if there are no errors in the form
		if (count($errors) == 0) {
			 $date= date('Y-M-D');
			
				$query = "INSERT INTO facility (name, city_id,address) 
						  VALUES('$name', '$city_id', '$address')";
						  
				mysqli_query($db, $query);
			
				header('location: view_facility.php');
			

		}
	}
	function create_symptom(){
		global $db, $errors;

		// receive all input values from the form
		$name=  e($_POST['name']);
		$disease_id=e($_POST['disease_id']);
		$notes=e($_POST['notes']);
		//var_dump($disease_id);die();
	
		// form validation: ensure that the form is correctly filled
		if (empty($name)) { 
			array_push($errors, "Symptom is required"); 
		}
		if (empty($disease_id)) { 
			array_push($errors, "Disease is required"); 
		}
		if (empty($notes)) { 
			array_push($errors, "Symptom Description is required"); 
		}
		
		// save symptom if there are no errors in the form
		if (count($errors) == 0) {
			  $date= date("Y-M-D");
			
			
				$query = "INSERT INTO symptoms (name, notes,date_created,disease_id)
						  VALUES('$name', '$notes','$date','$disease_id')";
						 
				mysqli_query($db, $query);
				
			
				header('location: view_symptom.php');
			

		}

	}


	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;

					$_SESSION['success']  = "You are now logged in";
					header('location: admin/home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;

					$_SESSION['success']  = "You are now logged in";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>