<?php
	require "../backend/core_logic.php";
	require "../backend/login_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Login</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js.php') ?>
		
	</head>
	<body>
	
		<div class="container-lg">
		
		<!-- Navbar: START -->
		
		<!-- Navbar: END -->
		
		<!-- Body: START -->
			
			<div style="height: 65px;"></div> <!-- Header Spacer -->
			
			<div class="card mt-3 col-md-4 box-shadow mx-auto">
				<div class="card-body">
				
					<div class="card mb-3 p-2">
						<a href="https://www.astralinvest.com" class="text-decoration-none"><img src="../img/core_logo.png" alt="site_logo" style="width: 100%;" /></a>
					</div>
					
					<form method="POST">
						
						<h5 class="card-title text-center mb-3">Login</h5>
									
						<div class="input-group input-group-sm mb-3">
							<span class="input-group-text" id="loginemailfield">Email</span>
							<input type="email" class="form-control" name="login_email" pattern="[A-Za-z0-9@-_.]+" minlength="5" maxlength="50" required>
						</div>
						<div class="input-group input-group-sm mb-3">
							<span class="input-group-text" id="loginpasswordfield">Password</span>
							<input type="password" class="form-control" name="login_password" minlength="7" maxlength="15" required>
						</div>
						
						<div>
							<button type="submit" class="btn btn-primary col-12 mb-2" name="submit_login">Login</button>
							<div class="col-12 mb-3 text-center">
								<a class="text-decoration-none my-0 mb-2" href="forgotpassword.php">Forgot my password</a>
							</div>
							<hr>
							<div class="d-flex justify-content-center">
								<button type='button' class='btn btn-success col-6'data-bs-toggle='modal' data-bs-target='#signup_modal'>Sign Up</button>
							</div>
						</div>
						
					</form>
				</div>
			</div>

			<div class="col-md-4 mx-auto">
				<?php view('bottom-tos-nl.php'); ?>
			</div>
			
			<div class="modal" id="signup_modal" tabindex="-1" aria-labelledby="signUpButtonLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Register</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<form method="POST">
							
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="signupnamefield">Name</span>
									<input type="text" class="form-control" placeholder="Joseph Hughs" name="user_name" pattern="[A-Za-z ]+" minlength="1" maxlength="50" title="Input your name using letters (UPPERCASE or lowercase) only." required>
								</div>
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="signupusernamefield">Username</span>
									<input type="text" class="form-control" placeholder="BigJosephH123" name="user_username" pattern="[A-Za-z0-9@#&_-+ ]+" minlength="5" maxlength="50" title="Input a username using letters (UPPERCASE or lowercase) and numbers only." required>
								</div>
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="signupemailfield">E-mail</span>
									<input type="email" class="form-control" placeholder="j.hughs@example.com" name="user_email" pattern="[A-Za-z0-9.-_@]+" minlength="5" maxlength="50" required>
								</div>
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="signuppasswordfield">Password</span>
									<input type="password" class="form-control" id="pass" name="user_password" minlength="7" maxlength="15" onkeyup="validate_password()" required>
								</div>
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="signupcpasswordfield">Confirm Password</span>
									<input type="password" class="form-control" id="confirm_pass" name="user_cpassword" minlength="7" maxlength="15"  onkeyup="validate_password()" required>
								</div>
								
								<div>
									<button type="submit" class="btn btn-primary col-12" id="confirm_button" name="submit_signup">Sign Up</button>
								</div>
								<br>
								<span id="wrong_pass_alert"></span>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div style="height: 45px;"></div> <!-- Footer Spacer -->
			
			<?php view('footer.php') ?>
		
		<!-- Body: END -->
		
		</div>
		
		<?php view('bottom-js.php'); ?>
		
	</body>
</html>