<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/verifyaccount_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Verify Account</title>
		
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
		
			<?php view('header.php') ?>
			
			<div style="height: 65px;"></div> <!-- Header Spacer -->
		
			<?php view('username.php') ?>
			
			<div class="row mt-3">
			
				<?php view('sidebar.php') ?>
				<div class="col-md-9">

						<div class="card col-md-12 mb-3 box-shadow">
							<div class="card-body">
								
								<h5 class="card-title text-primary mb-3">Verify Your Account</h5>

								<p>An email has been sent to <b><?php echo $_SESSION["user_email"]; ?></b>, with an account verification code. Please enter that case-sensitive code below.</p>
								
								<form method="POST">
									<div class="mb-3 w-75 mx-auto">
										<label for="VerifyAccountEmail" class="form-label">Verification Code</label>
										<input type="text" class="form-control mb-2" id="VerifyAccountEmail" name="verifyaccount_code" pattern="[A-Z0-9]+" required>
									</div>
									<div class="d-flex w-75 mx-auto">
										<button type="submit" class="btn btn-primary me-2" name="submit_verifyaccount">VERIFY</button>
								</form>
								<form method="POST">
									<button type="submit" class="btn btn-secondary" name="submit_resendverify">RESEND CODE</button>
								</form>
									</div>
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