<?php
	require "../backend/core_logic.php";
    require "../backend/forgotpassword_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Reset Password</title>
		
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

				<div class="col-md-3 mb-3">
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
							
							<h5 class="card-title text-primary">Reset Password</h5>
							<hr class=mt-0>

							<div class="w-100 d-flex justify-content-begin">
								<div>
									<a class="btn btn-sm btn-primary mb-3 me-2" href="forgotpassword.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Request Code
									</a>
								</div>

								<div>
									<a class="btn btn-sm btn-primary mb-3" href="login.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Return to Login
									</a>
								</div>
							</div>

							<p>Please enter the email address, the case sensitive code you received and the new password for the account.</p>
							<form method="POST">
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="resetpasswordemail">Email</span>
									<input type="email" class="form-control" name="resetpass_email" pattern="[A-Za-z0-9@-_.]+" minlength="5" maxlength="50" required>
								</div>
								<div class="input-group input-group-sm mb-3">
									<span class="input-group-text" id="resetpasswordcode">Code</span>
									<input type="text" class="form-control" name="resetpass_code" pattern="[A-Z0-9]+" required>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group input-group-sm mb-3">
											<span class="input-group-text" id="resetpasswordpassword">Password</span>
											<input type="password" class="form-control" id="pass" name="resetpass_password" minlength="7" maxlength="15" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-group input-group-sm mb-3">
											<span class="input-group-text" id="resetpasswordconfirmpassword">Confirm Password</span>
											<input type="password" class="form-control" id="confirm_pass" name="resetpass_cpassword" minlength="7" maxlength="15" onkeyup="validate_password()" required>
										</div>
									</div>
								</div>
								<span id="wrong_pass_alert"></span>
								<div>
									<button type="submit" class="btn btn-primary mt-2" id="confirm_button" name="submit_passwordreset">RESET PASSWORD</button>
								</div>
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