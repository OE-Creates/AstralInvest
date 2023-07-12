<?php
	require "../backend/core_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Terms and Conditions</title>
		
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
							<div class="card-body pb-0">
							
								<h2 class="">Terms of Use</h2> 
								<hr>
								<div>
									<p>
										Welcome to the astralinvest.com website (the “astralinvest Website”) operated by AstralInvest Sugar Community Based Organisation (“astralinvest,” “we,”, or “us”).
										By using the astralinvest Website, you acknowledge that you have read and agree to be bound by the following Terms of Use (the “Terms”) and by our Privacy Policy available below, which is incorporated here by reference, and by all technical specifications, rules of operation, and security procedures, and any other terms and conditions set forth by astralinvest or AstralInvest Sugar Community Based Organisation from time to time by posting from a link on the astralinvest Website.
										You agree to be bound by such revised terms as they may be posted from to time and that you are 13 years of age or older. 
										Nothing in these Terms may be construed to create or confer any rights on third party beneficiaries. 
										If you do not agree to any of theterms and conditions set forth herein, you may not use the astralinvest Website.
										<br><br>
										<small>Terms and Conditions apply</small>
										<br>
										<a href=terms.pdf>Click to read our terms and condtions</a>
									</p>
								</div>
							</div>
						</div>
						
						<?php view('bottom-tos-nl.php') ?>

				</div>
				
			</div>
			
			<div style="height: 45px;"></div> <!-- Footer Spacer -->
			
			<?php view('footer.php') ?>
		
		<!-- Body: END -->
		
		</div>

		<?php view('bottom-js.php'); ?>

	</body>
</html>