<?php
	require "../backend/core_logic.php";
    require "../backend/rfsignup_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Sign Up</title>
		
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
		
			<div class="row mt-3 align-items-end">
				<div class="col-md-3">
					<a href="https://www.astralinvest.com" class="text-decoration-none"><img src="../img/core_logo.png" alt="site_logo" style="width: 100%;" /></a>
				</div>
				<div class="col-md-9">
				</div>
			</div>
			
			<div class="row mt-3">

				<div class="col-md-3">
					<div class="card grad-background-yellow box-shadow">
						<div class="card-body">
							<h5 class="card-title text-light">Need Help?</h5>
							<p class="card-text">Contact our 24/7 customer support center</p>
							<a class="btn btn-sm btn-light w-100 rounded-corners-25" href="supportnl.php" role="button">Contact Us</a>
						</div>
					</div>
				</div>
			
				<div class="col-md-9">

					<div class="card col-md-12 mb-3 box-shadow">
						<div class="card-body">
							
							<h5 class="card-title text-primary">Sign Up</h5>

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