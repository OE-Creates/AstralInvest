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
		<title>AstralInvest | Management</title>
		
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

                        <div class="card col-md-12 box-shadow">
                            <div class="card-body pb-0">

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <a class="btn btn-sm btn-primary w-100" href="management_transact.php" role="button">
                                            Transactions
                                        </a>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a class="btn btn-sm btn-primary w-100" href="management_payout.php" role="button">
                                            Payout Requests
                                        </a>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a class="btn btn-sm btn-primary w-100" href="management_referral.php" role="button">
                                            Referral Payouts
                                        </a>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <a class="btn btn-sm btn-primary w-100" href="management_user.php" role="button">
                                            Manage Accounts
                                        </a>
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
		
		<?php view('bottom-js-manage.php'); ?>
		
	</body>
</html>