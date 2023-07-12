<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/withdrawal_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Withdraw</title>
		
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
								
								<h5 class="card-title text-primary">Withdraw</h5>
								<p class="mb-1">Whenever one of your investment matures, you will be able to see its status and request a withdrawal of the funds attached to that investment. <a href="#" class="custom_colored_text_danger" disabled>Please note that once funds are withdrawn, the respective investment is closed.</a></p>

								<div class="my-2">
									<b>
										<a href="profile.php#nav-withdraw" class="text-danger text-decoration-none">
											<svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
												<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
											</svg>Make sure to fill in your Withdrawal Details
										</a>
									</b>
								</div>
								<div class="card" style="overflow-y: auto; font-size: 0.75em; height: 400px;">
                                    <table class="table">
                                        <thead>
                                            <tr>
											<th scope="col">Plan</th>
												<th scope="col">Invested On (UTC)</th>
												<th scope="col">No. Of Farms</th>
												<th scope="col">Amount (excl. VAT)($)</th>
												<th scope="col">Months Invested</th>
												<th scope="col">Total ROI ($)</th>
												<th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php DisplayWithdrawalList(); ?>
                                        </tbody>
                                    </table>
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