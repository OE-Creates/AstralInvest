<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/core_management_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | M-Refunds</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js-manage.php') ?>
		
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
								
								<h5 class="card-title text-primary">Refund Requests</h5>
								<div class="d-flex justify-content-begin">
									<a class="btn btn-sm btn-primary me-2" href="management_transact.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Back
									</a>

									<a class="btn btn-sm btn-warning" href="management.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Management
									</a>
								</div>
								<hr>

								<div class="card" style="overflow-y: auto; font-size: 0.75em; height: 400px;">
                                    <table class="table">
                                        <thead>
                                            <tr>
												<th scope="col">Account ID</th>
                                                <th scope="col">Payment ID</th>
                                                <th scope="col">Payer Reason</th>
                                                <th scope="col">Payment Time (UTC)</th>
                                                <th scope="col">Amount Paid ($)</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php ManagementDisplayRefundList(); ?>
                                        </tbody>
                                    </table>
                                </div>

							</div>
						</div>

						<div class="card col-md-12 mb-3 box-shadow">
							<div class="card-body">
								
								<h5 class="card-title text-primary">Refunds Paid</h5>
								<hr>

								<div class="card" style="overflow-y: auto; font-size: 0.75em; height: 400px;">
                                    <table class="table">
                                        <thead>
                                            <tr>
												<th scope="col">Account ID</th>
                                                <th scope="col">Payment ID</th>
                                                <th scope="col">Payer Reason</th>
                                                <th scope="col">Payment Time (UTC)</th>
                                                <th scope="col">Amount Paid ($)</th>
												<th scope="col">Refund Reason</th>
												<th scope="col">Refunded On (UTC)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php ManagementDisplayRefundPaidList(); ?>
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
		
		<?php view('bottom-js-manage.php'); ?>
		
	</body>
</html>