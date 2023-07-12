<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
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
		
			<?php view('header.php') ?>
			
			<div style="height: 65px;"></div> <!-- Header Spacer -->
		
			<?php view('username.php') ?>
			
			<?php view('top-banner.php') ?>
			
			<div class="row mt-3">
			
				<?php view('sidebar.php') ?>
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
												<label for="InputSupportMsg" class="form-label">Message</label>
												<textarea  class="form-control" id="InputSupportMsg" rows="5" name="support_message" minlength="5" maxlength="255" required></textarea>
											</div>
											<div class="w-75 mx-auto">
												<button type="submit" class="btn btn-primary col-12" name="submit_supportmsg">Send</button>
											</div>
										</div>
									</form>
								</div>
								
								<hr class="mb-0">
								
								<h5 class="card-title text-primary" style="margin-top: 30px;">F.A.Q.s</h5>
								
								<div class="accordion">
									<div class="accordion-item">
										<h2 class="accordion-header" id="panelsStayOpen-headingOne">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
												When will my plants grow for the first time?
											</button>
										</h2>
										<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
											<div class="accordion-body">
												<strong>This is the accordion body.</strong> Your additional content goes here.
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="panelsStayOpen-headingTwo">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
												When will I receive the first harvest of my plants?
											</button>
										</h2>
										<div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
											<div class="accordion-body">
												<strong>This is the accordion body.</strong> Your additional content goes here.
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="panelsStayOpen-headingThree">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
												Why were my plants moved to a different grow room?
											</button>
										</h2>
										<div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
											<div class="accordion-body">
												<strong>This is the accordion body.</strong> Your additional content goes here.
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="panelsStayOpen-headingFour">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
												Where can I see details of the plants in cultivation?
											</button>
										</h2>
										<div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
											<div class="accordion-body">
												<strong>This is the accordion body.</strong> Your additional content goes here.
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="panelsStayOpen-headingFive">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
												Under what conditions will my plants be grown?
											</button>
										</h2>
										<div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
											<div class="accordion-body">
												<strong>This is the accordion body.</strong> Your additional content goes here.
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						
						<?php view('bottom-tos.php') ?>
						
				</div>
				
			</div>
			
			<div style="height: 45px;"></div> <!-- Footer Spacer -->
			
			<?php view('footer.php') ?>
		
		<!-- Body: END -->
		
		</div>
		
		<?php view('bottom-js.php'); ?>
		
	</body>
</html>