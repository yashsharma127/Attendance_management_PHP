
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	
<!-- Login backend code -->
<div>
		<?php
		session_start();
		$errors = 0;
		// connecting to databse
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "attendance";

		//creating a connection
		$conn = mysqli_connect($servername,$username,$password,$database);

		//checking if connection is success or not
		if(!$conn)
		{
		die("Sorry we failed to connect: ".mysqli_connect_error());
		}
		$name = "";

		// LOGIN USER
		if (isset($_POST['login_user'])) {
		
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			if (empty($username)) {
				$errors = 1;
			}
			if (empty($password)) {
				$errors = 1;
			}

			if ($errors == 0) {
				//$password = md5($password);
				$query = "SELECT * FROM user_login WHERE UserName='$username' AND Password='$password'";
				$results = mysqli_query($conn, $query);
				$arrdata = mysqli_fetch_array($results);
				//print_r($arrdata);exit;
				if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['Name'] = $arrdata['Name'];
				//$name = $_SESSION[$arrdata['Name']];
				// print_r($name);exit;
				$_SESSION['success'] = "You are now logged in";
				
				header('location: ./pages/page1.php');
				
				}else {
				$errors = 1;
					header('location: index.php');
				}
			}
		}
		


		?>
</div>

<!-- login page -->
<div>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
		      	<form action="" method = "POST" class="signin-form">
		      		<div class="form-group">
		      			<input type="text" name="username" class="form-control" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="login_user" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<!-- <div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="recover.php" style="color: #fff">Forgot Password</a>
								</div> -->
	            </div>
	          </form>
	          <!-- <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p> -->
	          <!-- <div class="social d-flex text-center">
	          	<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
	          </div> -->
		      </div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- javascript code -->
<div>
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</div>
	</body>
</html>

