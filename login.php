<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>SHDRS</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>


	<form method="post" action="login.php">

		<?php echo display_error(); ?>
        <center> <img src="images/logo.jpeg" class="img-responsive" alt="logo" height="150px" width="200px"></center>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>


</body>
</html>