<?php
    //echo "forgotpassword_logic_script loaded successfully";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    if (isset($_POST['submit_passwordresetrequest']))
	{
		require 'dbconnect_invest.php';
		
		$uemail = $conn->real_escape_string($_POST['forgotpass_email']);
		
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$uverifycode = substr(str_shuffle($permitted_chars), 0, 5);

		$checknewuser = "SELECT email FROM users WHERE email = '$uemail'";
		
		$run = $conn->query($checknewuser);
		if ($run->num_rows === 0)
		{
			echo "
				<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
					Email does not exist, please try again
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>
			";
		}
		else
		{
            //Set generated code to user db entry
            $setgeneratedcode = "UPDATE users SET verification_code = '$uverifycode' WHERE email = '$uemail'";
            $updatedata = $conn->query($setgeneratedcode);

            //Email user with generated code
            require '../apps/PHPMailer/src/Exception.php';
            require '../apps/PHPMailer/src/PHPMailer.php';
            require '../apps/PHPMailer/src/SMTP.php';

            // Instantiation and passing [ICODE]true[/ICODE] enables exceptions
            $mail = new PHPMailer(true);

            $_SESSION["external_passreset"] = 1;

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
            $mail->Subject = 'AstralInvest - Password Reset';
            $mail->Body = '<html>
                                <head>
                                </head>
                                <body>
                                If you have received this email, then a password reset request was made on behalf of your account, ' . $uemail . '.

                                Please enter the code below into the "Code" field on the AstralInvest portal reset password page.

                                <b><h1>'. $uverifycode . '</h1></b>
                                
                                If you did not request a password reset please disregard this message and subsequently inform our support staff at support@astralinvest.com of this incident.
                                </body>
                            </html>';
            $mail->AltBody = 'If you have received this email, then a password reset request was made on behalf of your account' . $uemail . '. Please enter the code below into the "Code" field on the AstralInvest portal reset password page. Verify Code: '. $uverifycode . '. If you did not request a password reset please disregard this message and subsequently inform our support staff at support@astralinvest.com of this incident.';

            $mail->send();
            //echo 'Message has been sent';

            header("Location: resetpassword.php");
			exit;

            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
		}
		
		$conn->close();
	}

    if (isset($_POST['submit_passwordreset']))
	{
        if (isset($_SESSION["external_passreset"]) && $_SESSION["external_passreset"] == 1)
        {
            require 'dbconnect_invest.php';
            
            $uemail = $conn->real_escape_string($_POST['resetpass_email']);
            $ucode = $conn->real_escape_string($_POST['resetpass_code']);

            $unewpass = $conn->real_escape_string($_POST['resetpass_password']);
            $upasshash = password_hash($unewpass, PASSWORD_DEFAULT);

            $checkuser = "SELECT email, verification_code FROM users WHERE email = '$uemail'";
            
            $run = $conn->query($checkuser);
            if ($run->num_rows === 0)
            {
                echo "
                    <div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                        Email does not exist, please try again
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";

                $conn->close();
            }
            else
            {
                $row = $run->fetch_array();

                if ($ucode != $row['verification_code'])
                {
                    echo "
                        <div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                            Wrong VERIFICATION CODE entered for that email address, please try again
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";

                    $conn->close();
                }
                else
                {
                    $updatepassword = "UPDATE users SET password = '$upasshash' WHERE email = '$uemail'";
                    $updatedata = $conn->query($updatepassword);

                    $conn->close();

                    header("Location: login.php");
		            exit();
                    
                    echo "
                        <div class='alert alert-success alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
                            Password successfully updated. Return to Login page to log in
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    ";
                }
            }
        }
        else
        {
            header("Location: login.php");
		    exit();
        }
	}
?>