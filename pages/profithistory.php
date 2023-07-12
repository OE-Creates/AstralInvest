<?php
	require "../backend/core_logic.php";
	require "../backend/core_loggedin_logic.php";
	require "../backend/profithistory_logic.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AstralInvest | Profit History</title>
		
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
							<div class="card-body d-flex justify-content-between">
								<div>
									<h6 class="text-primary">Total Amount Invested</h6>
									<h4 class="mb-0">$<?php DisplayProfitHistoryTotalInvested(); ?></h4>
								</div>
								<div>
									<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
									</svg>
								</div>
								<div class="text-end">
									<h6 class="text-success">Total Amount Earned</h6>
									<h4 class="mb-0">$<?php DisplayProfitHistoryTotalEarned(); ?></h4>
								</div>
							</div>
						</div>

						<div class="card col-md-12 mb-3 box-shadow">
							<div class="card-body">
								
								<h5 class="card-title text-primary">ROI History</h5>
								<div class="card" style="overflow-y: auto; font-size: 0.75em; height: 400px;">
									<table class="table">
										<thead>
											<tr>
												<th scope="col">Plan</th>
												<th scope="col">Invested On (UTC)</th>
												<th scope="col">No. Of Farms</th>
												<th scope="col">Amount Invested ($)</th>
												<th scope="col">Months Invested</th>
												<th scope="col">Total ROI ($)</th>
											</tr>
										</thead>
										<tbody>
											<?php DisplayProfitHistoryList(); ?>
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