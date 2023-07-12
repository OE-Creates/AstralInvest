<?php
	//echo "profile_logic_script loaded successfully";

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
	
	require 'dbconnect_invest.php';
	
	$userid = $_SESSION["user_id"];
	
	$getprofiledata = "SELECT * FROM users WHERE id = '$userid'";
	$getdata = $conn->query($getprofiledata);
	
	$row = $getdata->fetch_array();
	
	$_SESSION["user_pnumber"] = $row['phonenumber'];
	$_SESSION["user_dob"] = $row['date_of_birth'];
	$_SESSION["user_country"] = $row['country'];
	$_SESSION["user_address"] = $row['address'];
	
	$_SESSION["user_profileimg"] = $row['profile_img'];
	
	$_SESSION["user_bankname"] = $row['bankname'];
	$_SESSION["user_accountname"] = $row['accountname'];
	$_SESSION["user_accountno"] = $row['accountnumber'];
	$_SESSION["user_swfcode"] = $row['swiftcode'];
	$_SESSION["user_btcaddress"] = $row['bitcoin_address'];
	$_SESSION["user_ethaddress"] = $row['etherium_address'];
	$_SESSION["user_ltcaddress"] = $row['litecoin_address'];

	$_SESSION["user_paybanstatus"] = $row['account_paymentban'];
	
	$conn->close();

	//---- UPDATE USER DETAILS
	if (isset($_POST['submit_usersettings']))
	{	
		require 'dbconnect_invest.php';
		
		$uid = $_SESSION["user_id"];
		
		$getuserdata = "SELECT * FROM users WHERE id = '$uid'";
		$getdata = $conn->query($getuserdata);
		
		if (!($getdata->num_rows === 0))
		{
			$row = $getdata->fetch_array();
			
			$uname = $conn->real_escape_string($_POST['settinguser_name']);
			$_SESSION["user_name"] = $uname;
			
			$uusername = $conn->real_escape_string($_POST['settinguser_username']);
			$_SESSION["user_username"] = $uusername;
			
			$uemail = $conn->real_escape_string($_POST['settinguser_email']);
			if ($_SESSION["user_email"] != $uemail)
			{
				//User changing their email
				$getexistdata = "SELECT email FROM users WHERE email = '$uemail'";
				$getit = $conn->query($getexistdata);
				if ($getit->num_rows === 0)
				{
					$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$uverifycode = substr(str_shuffle($permitted_chars), 0, 5);

					$uverified = 0;

					$setgeneratedcode = "UPDATE users SET verification_code = '$uverifycode', verification_status = '$uverified' WHERE id = '$uid'";
					$updateit = $conn->query($setgeneratedcode);

					$_SESSION["user_email"] = $uemail;
					$_SESSION["user_verifystatus"] = 0;

					//Email user with generated code
					require '../apps/PHPMailer/src/Exception.php';
					require '../apps/PHPMailer/src/PHPMailer.php';
					require '../apps/PHPMailer/src/SMTP.php';
		
					// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
					$mail = new PHPMailer(true);
		
					try {
					//Server settings
					//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
					$mail->isSMTP(); // Set mailer to use SMTP
					$mail->Host = 'mail.astralinvest.com'; // Specify main and backup SMTP servers
					$mail->SMTPAuth = true; // Enable SMTP authentication
					$mail->Username = 'accounts@astralinvest.com'; // SMTP username
					$mail->Password = '**********'; // SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // //Enable implicit TLS encryption
					$mail->Port = 465; // TCP port to connect to
		
					$mail->setFrom('accounts@astralinvest.com', 'do-not-reply');
					$mail->addAddress($uemail); // Add a recipient $mail->addAddress('to@example.com', 'Joe User');
					$mail->addReplyTo('info@astralinvest.com', 'Information');
		
					$mail->isHTML(true); // Set email format to HTML
					$mail->Subject = 'AstralInvest - Verify Email Account';
					$mail->Body = '<html>
										<head>
										</head>
										<body>
										Please find below, the verification code for account, ' . $uemail . '.
		
										Enter the code below into the "Verification Code" field on the AstralInvest portal verification page to gain full control of your account.
		
										<b><h1>' . $uverifycode . '</h1></b>
										</body>
									</html>';
					$mail->AltBody = 'Please find below, the verification code for account, ' . $uemail . '. Enter the code below into the "Verification Code" field on the AstralInvest portal verification page to gain full control of your account. Verify Code: '. $uverifycode . '.';
		
					$mail->send();

					} catch (Exception $e) {
						//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						echo "
							<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
								Verification email could not be sent, email address could not be reached. You will not be able to access your account. Create a new account or contact support with a working email to have you account updated.
								<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
							</div>
						";
					}
				}
				else
				{
					/*echo "
						<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
							Your new email address is not unique, please try again
							<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
						</div>
					";*/

					$uemail = $_SESSION["user_email"];
				}
			}
			else
			{
				//User not changing their email
				$_SESSION["user_email"] = $uemail;
			}

			$upnumber = $row['phonenumber'];
			if (empty($_POST['settinguser_pnumber']))
			{
				$upnumber = NULL;
			}
			if (!(empty($_POST['settinguser_pnumber'])) && $upnumber != $_POST['settinguser_pnumber'])
			{
				$upnumber = $conn->real_escape_string($_POST['settinguser_pnumber']);
				$_SESSION["user_pnumber"] = $upnumber;
			}
			
			$udob = $row['date_of_birth'];
			if (empty($_POST['settinguser_dob']))
			{
				$udob = NULL;
			}
			if (!(empty($_POST['settinguser_dob'])) && $udob != $_POST['settinguser_dob'])
			{
				$udob = $conn->real_escape_string($_POST['settinguser_dob']);
				$_SESSION["user_dob"] = $udob;
			}
			
			$ucountry = $row['country'];
			/*if (empty($_POST['settinguser_country']))
			{
				$ucountry = NULL;
			}*/
			if (!(empty($_POST['settinguser_country'])) && $ucountry != $_POST['settinguser_country'])
			{
				$ucountry = $conn->real_escape_string($_POST['settinguser_country']);
				$_SESSION["user_country"] = $ucountry;
			}
			
			$uaddress = $row['address'];
			if (empty($_POST['settinguser_address']))
			{
				$uaddress = NULL;
			}
			if (!(empty($_POST['settinguser_address'])) && $uaddress != $_POST['settinguser_address'])
			{
				$uaddress = $conn->real_escape_string($_POST['settinguser_address']);
				$_SESSION["user_address"] = $uaddress;
			}

			$settinguserdata = "UPDATE users SET name = '$uname', username = '$uusername', email = '$uemail', phonenumber = '$upnumber', date_of_birth = '$udob', country = '$ucountry', address = '$uaddress' WHERE id = '$uid'";
			$updatedata = $conn->query($settinguserdata);
		}
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}
	
	//---- UPDATE PROFILE IMAGE
	if (isset($_POST['submit_imagesettings']))
	{	
		require 'dbconnect_invest.php';
		
		$uid = $_SESSION["user_id"];
		
		$imagename = $uid . "-profileimg.jpg";
		$filename = "../img/profileimg/" . $imagename;
		$tempname = $_FILES["settinguser_profileimg"]["tmp_name"];
		
		$insertnewimage = "UPDATE users SET profile_img = '$filename' WHERE id = '$uid'";
		$insertimage = $conn->query($insertnewimage);
		
		if (move_uploaded_file($tempname, $filename))
		{}
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}
	
	if (isset($_POST['submit_imageremoveimg']))
	{	
		require 'dbconnect_invest.php';
		
		$uid = $_SESSION["user_id"];
		
		$getimgpath = "SELECT profile_img FROM users WHERE id ='$uid'";
		$getimage = $conn->query($getimgpath);
		
		if (!($getimage->num_rows === 0))
		{
			$row = $getimage->fetch_array();
			$file_pointer = $row['profile_img'];
			
			if ($file_pointer != "")
			{
				if (unlink($file_pointer))
				{
					//echo ("$file_pointer has been deleted");
				}
			}
		
			$insertnewimage = "UPDATE users SET profile_img = '' WHERE id = '$uid'";
			$insertimage = $conn->query($insertnewimage);
		}
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}
	
	//---- UPDATE BANK DETAILS
	if (isset($_POST['submit_withdrawsettings']))
	{
		require 'dbconnect_invest.php';
		
		$uid = $_SESSION["user_id"];
		
		$getuserdata = "SELECT * FROM users WHERE id = '$uid'";
		$getdata = $conn->query($getuserdata);
		
		if (!($getdata->num_rows === 0))
		{
			$row = $getdata->fetch_array();
			
			$ubankname = $row['bankname'];
			if (empty($_POST['settinguser_bankname']))
			{
				$ubankname = NULL;
			}
			if (!(empty($_POST['settinguser_bankname'])) && $ubankname != $_POST['settinguser_bankname'])
			{
				$ubankname = $conn->real_escape_string($_POST['settinguser_bankname']);
				$_SESSION["user_bankname"] = $ubankname;
			}
			
			$uaccountname = $row['accountname'];
			if (empty($_POST['settinguser_accountname']))
			{
				$uaccountname = NULL;
			}
			if (!(empty($_POST['settinguser_accountname'])) && $uaccountname != $_POST['settinguser_accountname'])
			{
				$uaccountname = $conn->real_escape_string($_POST['settinguser_accountname']);
				$_SESSION["user_accountname"] = $uaccountname;
			}
			
			$uaccountno = $row['accountnumber'];
			if (empty($_POST['settinguser_accountnumber']))
			{
				$uaccountno = NULL;
			}
			if (!(empty($_POST['settinguser_accountnumber'])) && $uaccountno != $_POST['settinguser_accountnumber'])
			{
				$uaccountno = $conn->real_escape_string($_POST['settinguser_accountnumber']);
				$_SESSION["user_accountno"] = $uaccountno;
			}
			
			$uswfcode = $row['swiftcode'];
			if (empty($_POST['settinguser_swiftcode']))
			{
				$uswfcode = NULL;
			}
			if (!(empty($_POST['settinguser_swiftcode'])) && $uswfcode != $_POST['settinguser_swiftcode'])
			{
				$uswfcode = $conn->real_escape_string($_POST['settinguser_swiftcode']);
				$_SESSION["user_swfcode"] = $uswfcode;
			}
			
			$ubtcaddress = $row['bitcoin_address'];
			if (empty($_POST['settinguser_bitcoinadd']))
			{
				$ubtcaddress = NULL;
			}
			if (!(empty($_POST['settinguser_bitcoinadd'])) && $ubtcaddress != $_POST['settinguser_bitcoinadd'])
			{
				$ubtcaddress = $conn->real_escape_string($_POST['settinguser_bitcoinadd']);
				$_SESSION["user_btcaddress"] = $ubtcaddress;
			}
			
			$uethaddress = $row['etherium_address'];
			if (empty($_POST['settinguser_etheriumadd']))
			{
				$uethaddress = NULL;
			}
			if (!(empty($_POST['settinguser_etheriumadd'])) && $uethaddress != $_POST['settinguser_etheriumadd'])
			{
				$uethaddress = $conn->real_escape_string($_POST['settinguser_etheriumadd']);
				$_SESSION["user_ethaddress"] = $uethaddress;
			}
			
			$ultcaddress = $row['litecoin_address'];
			if (empty($_POST['settinguser_litecoinadd']))
			{
				$ultcaddress = NULL;
			}
			if (!(empty($_POST['settinguser_litecoinadd'])) && $ultcaddress != $_POST['settinguser_litecoinadd'])
			{
				$ultcaddress = $conn->real_escape_string($_POST['settinguser_litecoinadd']);
				$_SESSION["user_ltcaddress"] = $ultcaddress;
			}
			
			$settinguserdata = "UPDATE users SET bankname = '$ubankname', accountname = '$uaccountname', accountnumber = '$uaccountno', swiftcode = '$uswfcode', bitcoin_address = '$ubtcaddress', etherium_address = '$uethaddress', litecoin_address = '$ultcaddress' WHERE id = '$uid'";
			$updatedata = $conn->query($settinguserdata);
		}
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}
	
	//---- UPDATE PASSWORD
	if (isset($_POST['submit_passwordsettings']))
	{
		require 'dbconnect_invest.php';
		
		$uid = $_SESSION["user_id"];
		
		$getuserdata = "SELECT password FROM users WHERE id = '$uid'";
		$getdata = $conn->query($getuserdata);
		
		if (!($getdata->num_rows === 0))
		{
			$row = $getdata->fetch_array();
			
			$ucurrpass = $conn->real_escape_string($_POST['settinguser_currentpassword']);
			
			if (password_verify($ucurrpass, $row['password']))
			{
				$unewpass = $conn->real_escape_string($_POST['settinguser_newpassword']);
				$upasshash = password_hash($unewpass, PASSWORD_DEFAULT);
				
				$settinguserdata = "UPDATE users SET password = '$upasshash' WHERE id = '$uid'";
				$updatedata = $conn->query($settinguserdata);
			}
		}
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}
	
	//---- UPDATE MESSAGE DETAILS
	if (isset($_POST['submit_msgsettings']))
	{
	}
	
?>