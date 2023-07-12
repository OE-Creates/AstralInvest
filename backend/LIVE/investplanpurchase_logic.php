<?php
    
    function DisplayInvestPlanUserInvestedTotal()
    {
        $uid = $_SESSION["user_id"];

        if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase025.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Starter Plan";
        }
        else if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase050.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Standard Plan";
        }
        else if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase075.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Premium Plan";
        }
        else if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase100.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Exclusive Plan";
        }

        require "dbconnect_invest.php";

        $getdata = "SELECT charge_amount FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND payment_descriptor = '$descriptor'";
        $rungetdata = $conn->query($getdata);

        $totalinvested = 0;
        while($row = $rungetdata->fetch_array())
        {
            $totalinvested += $row['charge_amount'];
        }

        echo $totalinvested;

        $conn->close();
    }

    function DisplayInvestPlanUserEarnedTotal()
    {
        $uid = $_SESSION["user_id"];

        if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase025.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Starter Plan";
        }
        else if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase050.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Standard Plan";
        }
        else if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase075.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Premium Plan";
        }
        else if ($_SERVER['REQUEST_URI'] == "/pages/investplanpurchase100.php")
        {
            $descriptor = "AstralInvest - Contribution Plan - Exclusive Plan";
        }

        require "dbconnect_invest.php";

        $getdata = "SELECT roi_totalreturn FROM transactions WHERE customer_id = '$uid' AND charge_result = 'Succeed' AND payment_descriptor = '$descriptor'";
        $rungetdata = $conn->query($getdata);

        $totalprofit = 0;
        while($row = $rungetdata->fetch_array())
        {
            $totalprofit += $row['roi_totalreturn'];
        }

        echo $totalprofit;

        $conn->close();
    }

?>