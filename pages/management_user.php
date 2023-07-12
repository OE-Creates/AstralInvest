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
		<title>AstralInvest | M-Users</title>
		
		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Intergrated CSS -->
		<link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
		
		<?php view('head-js-manage.php') ?>
		
	</head>
	<body>
	
		<script type="text/javascript">
			window.addEventListener('load', function () {
				const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
				const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
			})
		</script>
	
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
								
								<h5 class="card-title text-primary">Manage Accounts</h5>
								<div>
									<a class="btn btn-sm btn-primary" href="management.php" role="button">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
										</svg>
										Back
									</a>
								</div>
								<hr>

								<div class="card mb-3" style="overflow-y: auto; font-size: 0.75em; height: 650px;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Privilege</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php ManagementDisplayUserList(); ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#adduser_modal'>ADD USER</button>
                                    </div>
                                    <div>
                                        <h6>User Count: <b>[<?php echo $_SESSION["manage_noofusers"]; ?>]</b></h6>
                                    </div>
                                </div>

                                <div class="modal" id="adduser_modal" tabindex="-1" aria-labelledby="addUserButtonLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="addusernamefield">Name</span>
                                                        <input type="text" class="form-control" placeholder="Joseph Hughs" name="adduser_name" pattern="[A-Za-z ]+" minlength="1" maxlength="50" title="Input your name using letters (UPPERCASE or lowercase) only." required>
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="adduserusernamefield">Username</span>
                                                        <input type="text" class="form-control" placeholder="BigJosephH123" name="adduser_username" pattern="[A-Za-z0-9@#&_-+ ]+" minlength="5" maxlength="50" title="Input a username using letters (UPPERCASE or lowercase) and numbers only." required>
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="adduseremailfield">E-mail</span>
                                                        <input type="email" class="form-control" placeholder="j.hughs@example.com" name="adduser_email" pattern="[A-Za-z0-9.-_@]+" minlength="5" maxlength="50" required>
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="adduserlevelfield">Privilege</span>
                                                        <select class="form-select" id="adduserlevelfield" name="adduser_level" required>
                                                            <option selected value="0">User</option>
                                                            <option value="1">Administrator</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="adduserpasswordfield">Password</span>
                                                        <input type="password" class="form-control" id="pass" name="adduser_password" minlength="7" maxlength="15" onkeyup="validate_password()" required>
                                                    </div>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <span class="input-group-text" id="addusercpasswordfield">Confirm Password</span>
                                                        <input type="password" class="form-control" id="confirm_pass" name="adduser_cpassword" minlength="7" maxlength="15"  onkeyup="validate_password()" required>
                                                    </div>
                                                    
                                                    <div>
                                                        <button type="submit" class="btn btn-primary col-12" id="confirm_button" name="submit_adduser">Add User</button>
                                                    </div>
                                                    <br>
                                                    <span id="wrong_pass_alert"></span>
                                                </form>
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
		
		<?php view('bottom-js-manage.php'); ?>
		
	</body>
</html>