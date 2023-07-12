<?php
	require "../backend/core_logic.php";
	require "../backend/support_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Support</title>
		
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
				<div class="col-md-9"></div>
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
							
							<h5 class="card-title text-primary">24/7 Customer Support</h5>
							<hr class="my-0">
							<div class="w-100 mt-3">
								<h2 class="text-center">Online Support</h2>
								<h6 class="text-center">For inquiries, suggestions or complaints. Mail us</h6>
								<h6 class="text-center mb-3"><a href="#" class="text-decoration-none">support@astralinvest.com</a></h6>
								<form method="POST">
									<div class="w-100">
										<div class="mb-3 w-75 mx-auto">
											<label for="InputSupportEmail" class="form-label">Email</label>
											<input type="email" class="form-control mb-2" id="InputSupportEmail" name="support_email" pattern="[A-Za-z0-9@-_.]+" minlength="5" maxlength="50" required>

											<label for="InputSupportMsg" class="form-label">Message</label>
											<textarea  class="form-control" id="InputSupportMsg" rows="5" name="support_message" minlength="5" maxlength="255" required></textarea>
										</div>
										<div class="w-75 mx-auto">
											<button type="submit" class="btn btn-primary col-12" name="submit_supportmsg">Send</button>
										</div>
									</div>
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