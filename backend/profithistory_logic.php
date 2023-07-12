<?php

	function DisplayProfitHistoryTotalInvested()
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

	function DisplayProfitHistoryTotalEarned()
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

	function DisplayProfitHistoryList()
	{
		require '../cron/values.php';

		$uid = $_SESSION["user_id"];

		require 'dbconnect_invest.php';

		$getlist = "SELECT * FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND payment_descriptor LIKE '%Contribution Plan%' ORDER BY charge_time DESC";
		$get = $conn->query($getlist);

		while ($row = $get->fetch_array())
		{
			echo "
				<tr>
					<td>" . $row['payment_descriptor'] . "</td>
					<td>" . substr($row['charge_time'], 0, 19) . "</td>
					<td>" . $row['charge_nooffarms'] . "</td>
					<td>" . $row['charge_amount'] . "</td>
					<td>" . $row['roi_monthsinvested'] . "</td>
					<td>" . $row['roi_totalreturn'] . "</td>
				</tr>
			";
		}
		
		$conn->close();
	}
	
?>