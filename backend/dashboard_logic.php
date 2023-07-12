<?php
	//echo "dashboard_logic_script loaded successfully";
	
	//---- PULL DATA
	require 'dbconnect_invest.php';
	
	$userid = $_SESSION["user_id"];
	
	$getprofiledata = "SELECT * FROM users WHERE id = '$userid'";
	$getdata = $conn->query($getprofiledata);
	
	$row = $getdata->fetch_array();
	
	$_SESSION["user_profileimg"] = $row['profile_img'];
	
	$_SESSION["user_bankname"] = $row['bankname'];
	$_SESSION["user_accountname"] = $row['accountname'];
	$_SESSION["user_accountno"] = $row['accountnumber'];
	$_SESSION["user_swfcode"] = $row['swiftcode'];
	$_SESSION["user_btcaddress"] = $row['bitcoin_address'];
	$_SESSION["user_ethaddress"] = $row['etherium_address'];
	$_SESSION["user_ltcaddress"] = $row['litecoin_address'];

	$_SESSION["user_paybanstatus"] = $row['account_paymentban'];

	if ($row['referral_code'] == "")
	{
		$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$refcode = substr(str_shuffle($permitted_chars), 0, 15);

		$checkexistsrefcode = "SELECT referral_code FROM users WHERE referral_code = '$refcode'";
		$checkexists = $conn->query($checkexistsrefcode);
		while ($checkexists->num_rows !== 0)
		{
			$refcode = substr(str_shuffle($permitted_chars), 0, 15);

			$checkexists = $conn->query($checkexistsrefcode);
		}

		$updaterefcode = "UPDATE users SET referral_code = '$refcode' WHERE id = '$userid'";
		$updatecode = $conn->query($updaterefcode);

		$_SESSION["user_refcode"] = $refcode;
	}
	else
	{
		$_SESSION["user_refcode"] = $row['referral_code'];
	}
	
	$conn->close();

	function DisplayTotalCharity()
	{
		$uid = $_SESSION["user_id"];

		require 'dbconnect_invest.php';

		$total_amount = 0;

		$getlist = "SELECT charge_amount FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND payment_descriptor LIKE '%Community Service%'";
		$get = $conn->query($getlist);

		if ($get->num_rows === 0)
		{
			echo 0.00;
		}
		else
		{
			while ($row = $get->fetch_array())
			{
				$total_amount = $total_amount + $row['charge_amount'];
			}

			echo $total_amount;
		}

		$conn->close();
	}
	
	function DisplayTotalInvested()
	{
		require '../cron/values.php';

		$uid = $_SESSION["user_id"];

		require 'dbconnect_invest.php';

		$total_amount = 0;

		$getlist = "SELECT charge_amount FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND payment_descriptor LIKE '%Contribution Plan%'";
		$get = $conn->query($getlist);

		if ($get->num_rows === 0)
		{
			echo 0.00;
		}
		else
		{
			while ($row = $get->fetch_array())
			{
				$total_amount += $row['charge_amount'];
			}

			echo $total_amount;
		}

		$conn->close();
	}

	function DisplayTotalEarned()
	{
		$uid = $_SESSION["user_id"];

		require 'dbconnect_invest.php';

		$total_amount = 0;

		$getlist = "SELECT roi_totalreturn FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND payment_descriptor LIKE '%Contribution Plan%'";
		$get = $conn->query($getlist);

		if ($get->num_rows === 0)
		{
			echo 0.00;
		}
		else
		{
			while ($row = $get->fetch_array())
			{
				$total_amount = $total_amount + $row['roi_totalreturn'];
			}

			echo $total_amount;
		}

		$conn->close();
	}

?>