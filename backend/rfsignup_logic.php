<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    if (isset($_POST['submit_signup']))
	{
		require 'dbconnect_invest.php';
		
        $urefcode = $_GET['code'];

		$uname = $conn->real_escape_string($_POST['user_name']);
		$uusername = $conn->real_escape_string($_POST['user_username']);
		$uemail = $conn->real_escape_string($_POST['user_email']);
		$upass = $conn->real_escape_string($_POST['user_password']);

		$upasshash = password_hash($upass, PASSWORD_DEFAULT);
		
		$ulevel = 0;
		$uverified = 0;
		
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$uverifycode = substr(str_shuffle($permitted_chars), 0, 5);
		
		$accountcreation = date("Y-m-d H:i:s");
		
		$insertnewuser = "INSERT INTO users (email, password, level, account_created_on, last_logged_on, name, username, verification_status, verification_code)
                                     VALUES ('$uemail', '$upasshash', '$ulevel', '$accountcreation', '$accountcreation', '$uname', '$uusername', '$uverified', '$uverifycode')";
		
		$checknewuser = "SELECT email FROM users WHERE email = '$uemail'";
		
		$run = $conn->query($checknewuser);
		if ($run->num_rows === 0)
		{
			$runadd = $conn->query($insertnewuser);

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
            //echo 'Message has been sent';

			$getusers = "SELECT * FROM users WHERE email = '$uemail'";
			$run = $conn->query($getusers);
			
			$row = $run->fetch_array();
			
			$_SESSION["user_id"] = $row['id'];
			$_SESSION["user_name"] = $row['name'];
			$_SESSION["user_username"] = $row['username'];
			$_SESSION["user_email"] = $row['email'];
			$_SESSION["user_level"] = $row['level'];
			$_SESSION["user_creationdate"] = $row['account_created_on'];
			$_SESSION["user_verifystatus"] = $row['verification_status'];

			$uid = $_SESSION["user_id"];

			$updloggedin = "UPDATE users SET loggedin_status = 1 WHERE id = '$uid'";
			$upddata = $conn->query($updloggedin);

            //=========== ADDING REFERRAL DETAILS ===================================
            $checkref = "SELECT id FROM users WHERE referral_code = '$urefcode'";
            $runcheckref = $conn->query($checkref);

            if ($runcheckref->num_rows !== 0)
            {
                $row_r = $runcheckref->fetch_array();
                $referrerid = $row_r['id'];
                $addref = "INSERT INTO referrals (referrer_id, referree_id)
                                          VALUES ('$referrerid', '$uid')";
                $runaddref = $conn->query($addref);
            }
            else
            {
                //echo "Referrer account no longer exists."
            }
            //=========== ADDING REFERRAL DETAILS ===================================
			
			header("Location: dashboard.php");
			exit;

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
			echo "
				<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
					The emailed used is already in our system. Please try resetting you password or contact support for help.
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>
			";
			/* header("refresh: 0");
			exit; */
		}
		
		$conn->close();
	}
?>