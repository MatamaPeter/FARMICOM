
<?php
session_start();
unset($_SESSION['user']);
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
					$Email = $_POST['email'];
					$password = $_POST['pass'];
				
					// Query the 'users' table for 'User' type
					$stmt = $con->prepare("SELECT * FROM users WHERE Email = ? AND Usertype = 'User'");
					$stmt->bind_param("s", $Email);
					$stmt->execute();
					$user_result = $stmt->get_result();
				
					// Query the 'users' table for 'Admin' type
					$stmt = $con->prepare("SELECT * FROM users WHERE Email = ? AND Usertype = 'Admin'");
					$stmt->bind_param("s", $Email);
					$stmt->execute();
					$admin_result = $stmt->get_result();
				
					// Query the 'farmers' table
					$stmt = $con->prepare("SELECT * FROM farmers WHERE Member_number = ?");
					$stmt->bind_param("s", $Email);
					$stmt->execute();
					$farmer_result = $stmt->get_result();
				
					// Check if the user is found in 'users' table with 'User' type
					if ($user_result->num_rows !== 0) {
						$row = $user_result->fetch_assoc();
						$Hashed_password = $row['Password'];
				
						if (password_verify($password, $Hashed_password)) {
							$_SESSION['user'] = $row['Username'];
							$_SESSION['mail'] = $row['Email'];
							header("location:index.php");
							exit();
						}
					}
				
					// Check if the user is found in 'users' table with 'Admin' type
					elseif ($admin_result->num_rows !== 0) {
						$row = $admin_result->fetch_assoc();
						$Hashed_password = $row['Password'];
				
						if (password_verify($password, $Hashed_password)) {
							$_SESSION['username'] = $row['Username'];
							$_SESSION['email'] = $row['Email'];
							header("location:Dashboard/Admin/index.php");
							exit();
						}
					}
				
					// Check if the user is found in 'farmers' table
					elseif ($farmer_result->num_rows !== 0) {
						$row = $farmer_result->fetch_assoc();
						$Hashed_password = $row['Password'];
				
						if (password_verify($password, $Hashed_password)) {
							$_SESSION['farmers'] = $row['Email'];
							$_SESSION['member'] = $row['Member_number'];
							$_SESSION['photo'] = $row['Photo'];
							header("location:Dashboard/Farmer/index.php");
							exit();
						}
					}
				
					// If the credentials are invalid or user not found, display an error message
					echo "<div class='message'><p class='wrap-input100 validate-input'>Invalid Credentials</p>
					<a href='javascript:self.history.back()'><button class='login100-form-btn'>Try Again</div>";
					exit();
				}
				?>
				<form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
						<div class="wrap-input100 " data-validate = "Username is required">
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