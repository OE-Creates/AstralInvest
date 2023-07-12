<?php
    //echo "dbupdate_email_cron_script loaded successfully";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'values.php';
    require 'dbconnect_invest.php';

    $getdata = "SELECT payment_descriptor, customer_id, charge_time, charge_nooffarms, charge_amount, roi_totalreturn FROM transactions WHERE charge_result = 'Succeed' AND roi_payoutrequested = 0 AND roi_payoutpaid = 0 AND payment_descriptor LIKE '%Contribution Plan%'";
    $get = $conn->query($getdata);

    if ($get->num_rows !== 0)
    {
        //Email user with generated code
        require '../apps/PHPMailer/src/Exception.php';
        require '../apps/PHPMailer/src/PHPMailer.php';
        require '../apps/PHPMailer/src/SMTP.php';
        
        while($row = $get->fetch_array())
        {
            $currdate = new DateTimeImmutable("now");
            $pastdate = new DateTimeImmutable($row['charge_time']);
            $interval = $currdate->diff($pastdate);
            $interval_days = $interval->days;

            if ($interval_days == 90)
            {
                $userid = $row['customer_id'];
                $investname = $row['payment_descriptor'];
                $investamount = $row['charge_amount'];
                $investamountex = round(($row['charge_amount'] / (1 + $ke_vat)), 2);
                $investroi = $row['roi_totalreturn'];
                $nooffarms = $row['charge_nooffarms'];

                $getdata_e = "SELECT name, email FROM users WHERE id = '$userid'";
                $get_e = $conn->query($getdata_e);
                $row_e = $get_e->fetch_array();

                $uname = $row_e['name'];
                $uemail = $row_e['email'];

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
                    $mail->Subject = 'AstralInvest - Q1 Contribution Plan Update';
                    $mail->Body = '<html>
                                        <head>
                                        </head>
                                        <body>
                                            Hello ' . $uname . '.
                                            <br>
                                            This is an auto-generated email from AstralInvest.
                                            <br>
                                            We are pleased to inform you that the first quarter (of 4) income on your investment <b>' . $investamount . ' (excl. VAT: $' . $investamountex . ')</b> of <b>$' . $investamount . '</b> for <b>' . $nooffarms . '</b> farm(s) has been realised.
                                            <br>
                                            The amount of <b>$' . $investroi . '</b> has been earned.
                                            <br>
                                            Please log into your account if you wish to request a payout now.
                                            <br>
                                            Kind Regards,
                                            <b>AstralInvest</b>
                                        </body>
                                    </html>';
                    $mail->AltBody = 'Hello ' . $uname . '. This is an auto-generated email from AstralInvest. We are pleased to inform you that the first quarter (of 4) income on your investment ' . $investname . ' of $' . $investamount . ' for ' . $nooffarms . ' farm(s) has been realised. The amount of $' . $investroi . ' has been earned. Please log into your account if you wish to request a payout now.';

                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            else if ($interval_days == 180)
            {
                $userid = $row['customer_id'];
                $investname = $row['payment_descriptor'];
                $investamount = $row['charge_amount'];
                $investamountex = round(($row['charge_amount'] / (1 + $ke_vat)), 2);
                $investroi = $row['roi_totalreturn'];
                $nooffarms = $row['charge_nooffarms'];

                $getdata_e = "SELECT name, email FROM users WHERE id = '$userid'";
                $get_e = $conn->query($getdata_e);
                $row_e = $get_e->fetch_array();

                $uname = $row_e['name'];
                $uemail = $row_e['email'];

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
                    $mail->Subject = 'AstralInvest - Q2 Contribution Plan Update';
                    $mail->Body = '<html>
                                        <head>
                                        </head>
                                        <body>
                                            Hello ' . $uname . '.
                                            <br>
                                            This is an auto-generated email from AstralInvest.
                                            <br>
                                            We are pleased to inform you that the second quarter (of 4) income on your investment <b>' . $investamount . ' (excl. VAT: $' . $investamountex . ')</b> of <b>$' . $investamount . '</b> for <b>' . $nooffarms . '</b> farm(s) has been realised.
                                            <br>
                                            The amount of <b>$' . $investroi . '</b> has been earned.
                                            <br>
                                            Please log into your account if you wish to request a payout now.
                                            <br>
                                            Kind Regards,
                                            <b>AstralInvest</b>
                                        </body>
                                    </html>';
                    $mail->AltBody = 'Hello ' . $uname . '. This is an auto-generated email from AstralInvest. We are pleased to inform you that the second quarter (of 4) income on your investment ' . $investname . ' of $' . $investamount . ' for ' . $nooffarms . ' farm(s) has been realised. The amount of $' . $investroi . ' has been earned. Please log into your account if you wish to request a payout now.';

                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            else if ($interval_days == 270)
            {
                $userid = $row['customer_id'];
                $investname = $row['payment_descriptor'];
                $investamount = $row['charge_amount'];
                $investamountex = round(($row['charge_amount'] / (1 + $ke_vat)), 2);
                $investroi = $row['roi_totalreturn'];
                $nooffarms = $row['charge_nooffarms'];

                $getdata_e = "SELECT name, email FROM users WHERE id = '$userid'";
                $get_e = $conn->query($getdata_e);
                $row_e = $get_e->fetch_array();

                $uname = $row_e['name'];
                $uemail = $row_e['email'];

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
                    $mail->Subject = 'AstralInvest - Q3 Contribution Plan Update';
                    $mail->Body = '<html>
                                        <head>
                                        </head>
                                        <body>
                                            Hello ' . $uname . '.
                                            <br>
                                            This is an auto-generated email from AstralInvest.
                                            <br>
                                            We are pleased to inform you that the third quarter (of 4) income on your investment <b>' . $investamount . ' (excl. VAT: $' . $investamountex . ')</b> of <b>$' . $investamount . '</b> for <b>' . $nooffarms . '</b> farm(s) has been realised.
                                            <br>
                                            The amount of <b>$' . $investroi . '</b> has been earned.
                                            <br>
                                            Please log into your account if you wish to request a payout now.
                                            <br>
                                            Kind Regards,
                                            <b>AstralInvest</b>
                                        </body>
                                    </html>';
                    $mail->AltBody = 'Hello ' . $uname . '. This is an auto-generated email from AstralInvest. We are pleased to inform you that the third quarter (of 4) income on your investment ' . $investname . ' of $' . $investamount . ' for ' . $nooffarms . ' farm(s) has been realised. The amount of $' . $investroi . ' has been earned. Please log into your account if you wish to request a payout now.';

                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            else if ($interval_days == 360)
            {
                $userid = $row['customer_id'];
                $investname = $row['payment_descriptor'];
                $investamount = $row['charge_amount'];
                $investamountex = round(($row['charge_amount'] / (1 + $ke_vat)), 2);
                $investroi = $row['roi_totalreturn'];
                $nooffarms = $row['charge_nooffarms'];

                $getdata_e = "SELECT name, email FROM users WHERE id = '$userid'";
                $get_e = $conn->query($getdata_e);
                $row_e = $get_e->fetch_array();

                $uname = $row_e['name'];
                $uemail = $row_e['email'];

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
                    $mail->Subject = 'AstralInvest - Q4 Contribution Plan Update';
                    $mail->Body = '<html>
                                        <head>
                                        </head>
                                        <body>
                                            Hello ' . $uname . '.
                                            <br>
                                            This is an auto-generated email from AstralInvest.
                                            <br>
                                            We are pleased to inform you that the fourth and <b>final</b> quarter (of 4) income on your investment <b>' . $investname . '</b> of <b>$' . $investamount . ' (excl. VAT: $' . $investamountex . ')</b> for <b>' . $nooffarms . '</b> farm(s) has been realised.
                                            <br>
                                            The amount of <b>$' . $investroi . '</b> has been earned.
                                            <br>
                                            Please log into your account if you wish to request a payout now.
                                            <br>
                                            Kind Regards,
                                            <b>AstralInvest</b>
                                        </body>
                                    </html>';
                    $mail->AltBody = 'Hello ' . $uname . '. This is an auto-generated email from AstralInvest. We are pleased to inform you that the fourth and final quarter (of 4) income on your investment ' . $investname . ' of $' . $investamount . ' for ' . $nooffarms . ' farm(s) has been realised. The amount of $' . $investroi . ' has been earned. Please log into your account if you wish to request a payout now.';

                    $mail->send();
                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }

        $upddate = Date("Y-m-d H:i:s");
        $file = "../logs/dbupdate_logs.txt";
        $entry = "Update emails sent successfully. DATE: (UTC)" . $upddate . ".\n";
        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
    }

    $conn->close();
?>