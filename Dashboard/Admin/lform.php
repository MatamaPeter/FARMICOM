
<?php
session_start();
unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Famricom Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/images/img-01.png" alt="IMG">
				</div>
				<?php
				include("config.php");

				if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
					$Email=$_POST['email'];
					$password=$_POST['pass'];
					$usertype ="Admin";
				
					$stmt = $con -> prepare("SELECT * FROM users WHERE Email =? AND Usertype =?");
					$stmt -> bind_param("ss", $Email, $usertype);
					$stmt -> execute();
					$Validate_user = $stmt -> get_result();

					if($Validate_user -> num_rows !==0){
					$row = $Validate_user->fetch_assoc();
					$Hashed_password =$row['Password'];
					
						if(password_verify($password, $Hashed_password)){
							$_SESSION['username'] = $row['Username'];
							$_SESSION['email'] = $row['Email'];
							header("location:index.php");
							exit();

						}else{
							echo"<div class='message'><p class='wrap-input100 validate-input'>Invalid Credentials</p>
							<a href='javascript:self.history.back()'><button class='login100-form-btn'>Try Again</div>";		
							exit();

						}
					}else{
						echo"<div class='message'><p class='wrap-input100 validate-input'>User not registered</p>
						<a href='javascript:self.history.back()'><button class='login100-form-btn'>Go back</div>";
						}
					}
				else{
				?>
				<form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="forgot_password.php">
							Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="rform.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
				<?php } ?>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>

</body>
</html>