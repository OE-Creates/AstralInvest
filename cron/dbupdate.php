<?php
    //echo "dbupdate_cron_script loaded successfully";

    require 'values.php';
    require 'dbconnect_invest.php';

    $getdata = "SELECT id, charge_time, charge_amount, roi_totalreturn FROM transactions WHERE charge_result = 'Succeed' AND payment_descriptor LIKE '%Contribution Plan%'";
    $get = $conn->query($getdata);

    if ($get->num_rows !== 0)
    {
        while($row = $get->fetch_array())
        {
            $investid = $row['id'];

            $currdate = new DateTimeImmutable("now");
            $pastdate = new DateTimeImmutable($row['charge_time']);

            $interval = $currdate->diff($pastdate);
            $monthsinvested = floor($interval->days / 30);
            $quartersinvested = floor($monthsinvested / 3);

            $setmonths = "UPDATE transactions SET roi_monthsinvested = '$monthsinvested' WHERE id = '$investid'";
	        $setmth=$conn->query($setmonths);

            if ($quartersinvested <= 0)
            {
                $setroisql = "UPDATE transactions SET roi_totalreturn = 0 WHERE id = '$investid'";
	            $setroi=$conn->query($setroisql);
            }
            else if ($quartersinvested > 0 && $monthsinvested <= 12)
            {
                //$totalreturns = round((round(($row['charge_amount'] / (1 + $ke_vat)), 2) * $investrate) * $quartersinvested, 2);
				$totalreturns = round(round($row['charge_amount'] * $investrate, 2) * $quartersinvested, 2);

                $setroisql = "UPDATE transactions SET roi_totalreturn = '$totalreturns' WHERE id = '$investid'";
	            $setroi=$conn->query($setroisql);
            }
            else if ($quartersinvested > 0 && $monthsinvested > 12)
            {
                $totalreturns = $row['roi_totalreturn'];

                $setroisql = "UPDATE transactions SET roi_monthsinvested = 12, roi_totalreturn = '$totalreturns' WHERE id = '$investid'";
	            $setroi=$conn->query($setroisql);
            }
        }

        $upddate = Date("Y-m-d H:i:s");
        $file = "../logs/dbupdate_logs.txt";
        $entry = "Database updated successfully. DATE: (UTC)" . $upddate . ".\n";
        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
    }

    $conn->close();

    include 'dbupdate_email.php';
?>