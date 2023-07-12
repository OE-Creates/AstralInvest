<?php
	//echo "management_logic_script loaded successfully";

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
	
	if ($_SESSION["user_level"] != 1)
	{
		header("Location: dashboard.php");
		exit();
	}

	//ADD USER
	if (isset($_POST['submit_adduser']))
	{
		require 'dbconnect_invest.php';
		
		$uname = $conn->real_escape_string($_POST['adduser_name']);
		$uusername = $conn->real_escape_string($_POST['adduser_username']);
		$uemail = $conn->real_escape_string($_POST['adduser_email']);
		$ulevel = $conn->real_escape_string($_POST['adduser_level']);
		$upass = $conn->real_escape_string($_POST['adduser_password']);

		$upasshash = password_hash($upass, PASSWORD_DEFAULT);
		
		$uverified = 0;
		
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$uverifycode = substr(str_shuffle($permitted_chars), 0, 5);
		
		$accountcreation = date("Y-m-d H:i:s");
		
		$insertnewuser = "INSERT INTO users (email, password, level, account_created_on, last_logged_on, name, username, verification_status, verification_code) VALUES ('$uemail', '$upasshash', '$ulevel', '$accountcreation', '$accountcreation', '$uname', '$uusername', '$uverified', '$uverifycode')";
		
		$checknewuser = "SELECT email FROM users WHERE email = '$uemail'";
		
		$run = $conn->query($checknewuser);
		if ($run->num_rows === 0)
		{
			$runadd = $conn->query($insertnewuser);
		}
		
		$conn->close();
	}

	//ACCOUNT BAN/UNBAN USER
	if (isset($_POST['submit_banuser']))
	{	
		require 'dbconnect_invest.php';
		
		$ubanid = $conn->real_escape_string($_POST['submit_banuser']);
		$sessid = $_SESSION["user_id"];

		if ($ubanid != $sessid)
		{
			$findbanstatus = "SELECT account_accountban FROM users WHERE id=$ubanid";
			$runfindbanstatus=$conn->query($findbanstatus);
			$row_ban = $runfindbanstatus->fetch_array();

			if ($row_ban['account_accountban'] == 0)
			{
				$updatebanstatus = "UPDATE users SET account_accountban = 1 WHERE id = '$ubanid'";
				$runupdatebanstatus=$conn->query($updatebanstatus);
			}
			else
			{
				$updatebanstatus = "UPDATE users SET account_accountban = 0 WHERE id = '$ubanid'";
				$runupdatebanstatus=$conn->query($updatebanstatus);
			}
		}
		
		$conn->close();
	}

	//PAYMENT BAN/UNBAN USER
	if (isset($_POST['submit_paybanuser']))
	{	
		require 'dbconnect_invest.php';
		
		$upaybanid = $conn->real_escape_string($_POST['submit_paybanuser']);
		$sessid = $_SESSION["user_id"];

		if ($upaybanid != $sessid)
		{
			$findpaybanstatus = "SELECT account_paymentban FROM users WHERE id=$upaybanid";
			$runfindpaybanstatus=$conn->query($findpaybanstatus);
			$row_payban = $runfindpaybanstatus->fetch_array();

			if ($row_payban['account_paymentban'] == 0)
			{
				$updatepaybanstatus = "UPDATE users SET account_paymentban = 1 WHERE id = '$upaybanid'";
				$runupdatepaybanstatus=$conn->query($updatepaybanstatus);
			}
			else
			{
				$updatepaybanstatus = "UPDATE users SET account_paymentban = 0 WHERE id = '$upaybanid'";
				$runupdatepaybanstatus=$conn->query($updatepaybanstatus);
			}
		}
		
		$conn->close();
	}

	//DELETE USER
	if (isset($_POST['submit_deleteuser']))
	{
		require 'dbconnect_invest.php';
		
		$deleteid = $conn->real_escape_string($_POST['submit_deleteuser']);
		$sessid = $_SESSION["user_id"];

		if ($deleteid != $sessid)
		{
			$findselectedcomp = "SELECT id FROM users WHERE id=$deleteid";
			$findcomp=$conn->query($findselectedcomp);
			if ($findcomp->num_rows !== 0)
			{
				$deleteselectedcomp = "DELETE FROM users WHERE id=$deleteid";
				$deletecomp=$conn->query($deleteselectedcomp);
				
				$conn->close();

				header("Location: management_user.php");
			}
		}
		
		$conn->close();
	}

	//UPDATE USER >> NAME
	if (isset($_POST['submit_updateusername']))
	{
		require 'dbconnect_invest.php';
		
		$uid = $conn->real_escape_string($_POST['submit_updateusername']);

		$unewname = $conn->real_escape_string($_POST['updateuser_name']);
			
		$settinguserdata = "UPDATE users SET name = '$unewname' WHERE id = '$uid'";
		$updatedata = $conn->query($settinguserdata);
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}

	//UPDATE USER >> USERNAME
	if (isset($_POST['submit_updateuserusername']))
	{
		require 'dbconnect_invest.php';

		$uid = $conn->real_escape_string($_POST['submit_updateuserusername']);

		$unewusername = $conn->real_escape_string($_POST['updateuser_username']);
			
		$settinguserdata = "UPDATE users SET username = '$unewusername' WHERE id = '$uid'";
		$updatedata = $conn->query($settinguserdata);
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}

	//UPDATE USER >> EMAIL
	if (isset($_POST['submit_updateuseremail']))
	{
		require 'dbconnect_invest.php';

		$uid = $conn->real_escape_string($_POST['submit_updateuseremail']);

		$unewemail = $conn->real_escape_string($_POST['updateuser_email']);
			
		$settinguserdata = "UPDATE users SET email = '$unewemail' WHERE id = '$uid'";
		$updatedata = $conn->query($settinguserdata);
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}

	//UPDATE USER >> PRIVILEGE
	if (isset($_POST['submit_updateuserlevel']))
	{
		require 'dbconnect_invest.php';

		$uid = $conn->real_escape_string($_POST['submit_updateuserlevel']);
		$sessid = $_SESSION["user_id"];

		if ($uid != $sessid)
		{
			$unewlevel = $conn->real_escape_string($_POST['updateuser_level']);
				
			$settinguserdata = "UPDATE users SET level = '$unewlevel' WHERE id = '$uid'";
			$updatedata = $conn->query($settinguserdata);
		}
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}

	//UPDATE USER >> PASSWORD
	if (isset($_POST['submit_updateuserpassword']))
	{
		require 'dbconnect_invest.php';
		
		$uid = $conn->real_escape_string($_POST['submit_updateuserpassword']);

		$unewpass = $conn->real_escape_string($_POST['updateuser_password']);
		$upasshash = password_hash($unewpass, PASSWORD_DEFAULT);
			
		$settinguserdata = "UPDATE users SET password = '$upasshash' WHERE id = '$uid'";
		$updatedata = $conn->query($settinguserdata);
		
		$conn->close();
		
		header("refresh: 0");
		exit;
	}

	//VIEW USER PAGE
	if (isset($_GET['submit_viewuser']))
	{	
		$_SESSION["userpage_id"] = $_GET['submit_viewuser'];
		header("Location: management_user_full.php");
		exit();
	}

	function ManagementDisplayUserList()
	{
		require 'dbconnect_invest.php';
		
		$getlist = "SELECT * FROM users ORDER BY email ASC";
		$get = $conn->query($getlist);
		
		$getnumusers = $get->num_rows;
		
		$_SESSION["manage_noofusers"] = $getnumusers;

		while ($row = $get->fetch_array())
		{
			if ($row['verification_status'] == 0)
			{
				$accverify ="Not Verified";
			}
			else
			{
				$accverify ="Verified";
			}

			if ($row['level'] == 1)
			{
				$acclevel = "Administrator";
			}
			else
			{
				$acclevel = "User";
			}

			echo "
				<tr>
					<td>" . $row['id'] . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . $row['username'] . "</td>
					<td>" . $row['email'] . "</td>
					<td><a href='#' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left' data-bs-title='" . $accverify . "'>" . $acclevel . "</a></td>
					<td><form method='GET'><button type='submit' class='btn btn-sm btn-success py-0' name='submit_viewuser' value='" . $row['id'] . "'>
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-person-fill' viewBox='0 0 16 16'>
						<path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z'/>
					</svg>
					</button></form></td>
				</tr>
			";
		}
		
		$conn->close();
	}

	//VIEW TRANSACTION PAGE
	if (isset($_GET['submit_viewtransaction']))
	{	
		$_SESSION["transactpage_id"] = $_GET['submit_viewtransaction'];
		header("Location: management_transact_full.php");
		exit();
	}

	function ManagementDisplayTransactList()
	{
		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM transactions ORDER BY charge_time DESC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{	
			echo "
				<tr>
					<td>" . $row['customer_id'] . "</td>
					<td>" . $row['payment_id'] . "</td>
					<td>" . $row['payment_name'] . "</td>
					<td>" . $row['payment_descriptor'] . "</td>
					<td>" . substr($row['charge_time'], 0, 19) . "</td>
					<td>" . $row['charge_tokentype'] . "</td>
					<td><a href='#' class='text-decoration-none' data-bs-toggle='tooltip' data-bs-placement='left' data-bs-title='" . $row['charge_description'] . "'>" . $row['charge_result'] . "</a></td>
					<td>" . $row['charge_amount'] . "</td>
					<td><form method='GET'><button type='submit' class='btn btn-sm btn-success py-0' name='submit_viewtransaction' value='" . $row['id'] . "'>
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-receipt-cutoff' viewBox='0 0 16 16'>
						<path d='M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z'/>
						<path d='M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z'/>
					</svg>
					</button></form></td>
				</tr>
			";
		}
		
		$conn->close();
	}

	//VIEW PAYOUT REQUEST PAGE
	if (isset($_GET['submit_viewpayout']))
	{	
		$_SESSION["payoutpage_id"] = $_GET['submit_viewpayout'];
		header("Location: management_payout_full.php");
		exit();
	}

	function ManagementDisplayPayoutList()
	{
		require '../cron/values.php';
		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM transactions WHERE roi_payoutrequested = 1 OR roi_monthsinvested = 12 ORDER BY roi_payoutrequestdate DESC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{
			echo "
				<tr>
					<td>" . $row['payment_name'] . "</td>
					<td>" . $row['payment_descriptor'] . "</td>
					<td>" . $row['charge_amount'] . "</td>
					<td>" . $row['roi_totalreturn']. "</td>
					<td><form method='GET'><button type='submit' class='btn btn-sm btn-success py-0' name='submit_viewpayout' value='" . $row['id'] . "'>
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-right' viewBox='0 0 16 16'>
						<path fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z'/>
					</svg>
					</button></form></td>
				</tr>
			";
		}
		
		$conn->close();
	}

	function ManagementDisplayPayoutPaidList()
	{
		require '../cron/values.php';
		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM transactions WHERE roi_payoutpaid = 1 ORDER BY roi_payoutpaiddate DESC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{
			echo "
				<tr>
					<td>" . $row['customer_id'] . "</td>
					<td>" . $row['payment_name'] . "</td>
					<td>" . $row['payment_descriptor'] . "</td>
					<td>" . $row['charge_amount'] . "</td>
					<td>" . $row['roi_monthsinvested'] . "</td>
					<td>" . $row['roi_totalreturn']. "</td>
					<td>" . $row['roi_payoutpaiddate'] . "</td>
				</tr>
			";
		}
		
		$conn->close();
	}

	//VIEW PAYOUT REFERRAL PAGE
	if (isset($_GET['submit_viewreferral']))
	{	
		$_SESSION["referralpage_id"] = $_GET['submit_viewreferral'];
		header("Location: management_referral_full.php");
		exit();
	}

	function ManagementDisplayReferralList()
	{
		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM users WHERE referral_payoutrequest = 1 ORDER BY referral_payoutdate DESC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{
			$uid = $row['id'];

			$referrer_total = 0;
			$getreferrerprofit = "SELECT referrer_profit FROM referrals WHERE referrer_id = '$uid'";
			$rungetref_r = $conn->query($getreferrerprofit);

			if ($rungetref_r->num_rows !== 0)
			{
				while($row_n = $rungetref_r->fetch_array())
				{
					$referrer_total += $row_n['referrer_profit'];
				}
			}

			$referree_total = 0;
			$getreferreeprofit = "SELECT referree_profit FROM referrals WHERE referree_id = '$uid'";
			$rungetref_e = $conn->query($getreferreeprofit);

			if ($rungetref_e->num_rows !== 0)
			{
				while($row_n = $rungetref_e->fetch_array())
				{
					$referree_total += $row_n['referree_profit'];
				}
			}

			$payoutamount = $referrer_total + $referree_total;

			echo "
				<tr>
					<td>" . $uid . "</td>
					<td>" . $row['name'] . "</td>
					<td>" . substr($row['referral_payoutdate'], 0, 19) . "</td>
					<td>" . $payoutamount. "</td>
					<td><form method='GET'><button type='submit' class='btn btn-sm btn-success py-0' name='submit_viewreferral' value='" . $row['id'] . "'>
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-right' viewBox='0 0 16 16'>
						<path fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z'/>
					</svg>
					</button></form></td>
				</tr>
			";
		}
		
		$conn->close();
	}

	//VIEW PAYOUT REFUND PAGE
	if (isset($_GET['submit_viewrefund']))
	{	
		$_SESSION["refundpage_id"] = $_GET['submit_viewrefund'];
		header("Location: management_refund_full.php");
		exit();
	}

	function ManagementDisplayRefundList()
	{
		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM transactions WHERE charge_result = 'Succeed' AND refund_requested = 1 ORDER BY refund_requestdate ASC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{	
			echo "
				<tr>
					<td>" . $row['customer_id'] . "</td>
					<td>" . $row['payment_id'] . "</td>
					<td>" . $row['payment_descriptor'] . "</td>
					<td>" . substr($row['charge_time'], 0, 19) . "</td>
					<td>" . $row['charge_amount'] . "</td>
					<td><form method='GET'><button type='submit' class='btn btn-sm btn-success py-0' name='submit_viewrefund' value='" . $row['id'] . "'>
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-receipt-cutoff' viewBox='0 0 16 16'>
						<path d='M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z'/>
						<path d='M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z'/>
					</svg>
					</button></form></td>
				</tr>
			";
		}
		
		$conn->close();
	}

	function ManagementDisplayRefundPaidList()
	{
		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM transactions WHERE charge_result = 'Refunded' ORDER BY refund_requestdate DESC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{	
			echo "
				<tr>
					<td>" . $row['customer_id'] . "</td>
					<td>" . $row['payment_id'] . "</td>
					<td>" . $row['payment_descriptor'] . "</td>
					<td>" . substr($row['charge_time'], 0, 19) . "</td>
					<td>" . $row['charge_amount'] . "</td>
					<td>" . $row['refund_reason'] . "</td>
					<td>" . substr($row['refund_time'], 0, 19) . "</td>
				</tr>
			";
		}
		
		$conn->close();
	}

	function GetReferralEarnedAmount($uid)
    {
        require 'dbconnect_invest.php';

        $referrer_total = 0;
        $getreferrerprofit = "SELECT referrer_profit FROM referrals WHERE referrer_id = '$uid'";
        $rungetref_r = $conn->query($getreferrerprofit);

        if ($rungetref_r->num_rows !== 0)
        {
            while($row = $rungetref_r->fetch_array())
            {
                $referrer_total += $row['referrer_profit'];
            }
        }

        $referree_total = 0;
        $getreferreeprofit = "SELECT referree_profit FROM referrals WHERE referree_id = '$uid'";
        $rungetref_e = $conn->query($getreferreeprofit);

        if ($rungetref_e->num_rows !== 0)
        {
            while($row = $rungetref_e->fetch_array())
            {
                $referree_total += $row['referree_profit'];
            }
        }

        $conn->close();

        $total_amount = $referrer_total + $referree_total;
        return $total_amount;
    }

	if (isset($_POST['submit_referralacknowledge']))
	{	
		require 'dbconnect_invest.php';
		
		$pid = $conn->real_escape_string($_POST['submit_referralacknowledge']);

		$getdata = "SELECT name, email FROM users WHERE id = '$pid'";
        $rungetdata = $conn->query($getdata);
        $row_e = $rungetdata->fetch_array();

        $ureferemail = $row_e['email'];
        $urefername = $row_e['name'];
		$ureferamount = GetReferralEarnedAmount($pid);

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
			$mail->addAddress($ureferemail); // Add a recipient $mail->addAddress('to@example.com', 'Joe User');
			$mail->addReplyTo('info@astralinvest.com', 'Information');

			$mail->isHTML(true); // Set email format to HTML
			$mail->Subject = 'AstralInvest - Referral Payment Notification';
			$mail->Body = '<html>
								<head>
								</head>
								<body>
									Hello ' . $urefername . ' (' . $ureferemail . ').
                                    <br>
                                    As requested, the amount of <b>$' . $ureferamount . '</b>, made through <b>REFERRALS</b>, has been paid (by AstralInvest) to the account listed on your profile.<br>
                                    
                                    <br>
                                    Kind Regards,
                                    <b>AstralInvest</b>
								</body>
							</html>';
			$mail->AltBody = 'Hello ' . $urefername . ' (' . $ureferemail . ').	As requested, the amount of $' . $ureferamount . ', made through REFERRALS, has been paid (by AstralInvest) to the account listed on your profile.';

			$mail->send();
			//echo 'Message has been sent';

			$setprofit_r = "UPDATE referrals SET referrer_profit = 0 WHERE referrer_id = '$pid'";
			$runsetprofit_r = $conn->query($setprofit_r);

			$setprofit_e = "UPDATE referrals SET referree_profit = 0 WHERE referree_id = '$pid'";
			$runsetprofit_e = $conn->query($setprofit_e);

			$setreqcomplete = "UPDATE users SET referral_payoutrequest = 0 WHERE id = '$pid'";
			$runsetreqcomplete = $conn->query($setreqcomplete);

			$conn->close();
			
			header("Location: management_referral.php");
			exit;

            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				echo "
					<div class='alert alert-danger alert-dismissible col-md-5 fade show mx-auto fixed-top' style='margin-top: 90px;' role='alert'>
						Referral Acknowledgement email could not be sent
						<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>
				";

				$conn->close();
            }
	}
	
?>