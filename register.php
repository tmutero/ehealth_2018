<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/datepicker3.css" rel="stylesheet">
</head>
<body>
<!--<div class="panel-heading">Register</div>-->
<!--	-->
<!--	<form method="post" action="register.php">-->
<!---->
<!--		--><?php //echo display_error(); ?>
<!---->
<!--		<div class="input-group">-->
<!--			<label>Username</label>-->
<!--			<input type="text" name="username" value="--><?php //echo $username; ?><!--">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<label>Email</label>-->
<!--			<input type="email" name="email" value="--><?php //echo $email; ?><!--">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<label>Password</label>-->
<!--			<input type="password" name="password_1">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<label>Confirm password</label>-->
<!--			<input type="password" name="password_2">-->
<!--		</div>-->
<!--		<div class="input-group">-->
<!--			<button type="submit" class="btn" name="register_btn">Register</button>-->
<!--		</div>-->
<!--		<p>-->
<!--			Already a member? <a href="login.php">Sign in</a>-->
<!--		</p>-->
<!--	</form>-->

<body class="bg-dark">


<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="images/logo.png" alt="">
                </a>
            </div>
            <div class="login-form">
                <form method="post" action="register.php">
                    <?php echo display_error(); ?>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php echo $username; ?>">

                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password_1" >
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password_2" >
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Agree the terms and policy
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="register_btn">Register</button>
                    <div class="social-login-content">

                    </div>
                    <div class="register-link m-t-15 text-center">
                        <p>Already have account ? <a href="login.php"> Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>