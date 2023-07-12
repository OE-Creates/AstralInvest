<?php

    function DisplayCommunityServiceTotal()
    {
        require 'dbconnect_invest.php';

        if ($_SERVER['REQUEST_URI'] == "/php%20projects/AstralInvest/pages/communityservice01.php") //Change the URI to '/pages/verifyaccount.php' when moving to live site (DELETE THIS)
        {
            $paydescr = "Community Service - Build A Church";

            $total_amount = 0;

            $getlist = "SELECT charge_amount FROM transactions WHERE charge_result = 'Succeed' AND payment_descriptor = '$paydescr'";
            $get = $conn->query($getlist);

            /*if ($get->num_rows === 0)
            {
                $_SESSION["donated_amount"] = 0;
                $_SESSION["donated_percent"] = 0;
            }
            else
            {*/
                while ($row = $get->fetch_array())
                {
                    $total_amount += $row['charge_amount'];
                }

                $_SESSION["donated_amount"] = $total_amount + 6700;
                $_SESSION["donated_percent"] = floor((($total_amount + 6700) / 70000) * 100);
            //}
        }
        else if($_SERVER['REQUEST_URI'] == "/php%20projects/AstralInvest/pages/communityservice02.php")
        {
            $paydescr = "Community Service - Support Education";

            $total_amount = 0;

            $getlist = "SELECT charge_amount FROM transactions WHERE charge_result = 'Succeed' AND payment_descriptor = '$paydescr'";
            $get = $conn->query($getlist);

            /*if ($get->num_rows === 0)
            {
                $_SESSION["donated_amount"] = 0;
                $_SESSION["donated_percent"] = 0;
            }
            else
            {*/
                while ($row = $get->fetch_array())
                {
                    $total_amount += $row['charge_amount'];
                }

                $_SESSION["donated_amount"] = $total_amount + 19800;
                $_SESSION["donated_percent"] = floor((($total_amount + 19800) / 70000) * 100);
            //}
        }
        else if ($_SERVER['REQUEST_URI'] == "/php%20projects/AstralInvest/pages/communityservice03.php")
        {
            $paydescr = "Community Service - Support Health Facilities";

            $total_amount = 0;

            $getlist = "SELECT charge_amount FROM transactions WHERE charge_result = 'Succeed' AND payment_descriptor = '$paydescr'";
            $get = $conn->query($getlist);

            /*if ($get->num_rows === 0)
            {
                $_SESSION["donated_amount"] = 0;
                $_SESSION["donated_percent"] = 0;
            }
            else
            {*/
                while ($row = $get->fetch_array())
                {
                    $total_amount += $row['charge_amount'];
                }

                $_SESSION["donated_amount"] = $total_amount + 36400;
                $_SESSION["donated_percent"] = floor((($total_amount + 36400) / 70000) * 100);
            //}
        }
        else if ($_SERVER['REQUEST_URI'] == "/php%20projects/AstralInvest/pages/communityservice04.php")
        {
            $paydescr = "Community Service - Support the Community";

            $total_amount = 0;

            $getlist = "SELECT charge_amount FROM transactions WHERE charge_result = 'Succeed' AND payment_descriptor = '$paydescr'";
            $get = $conn->query($getlist);

            /*if ($get->num_rows === 0)
            {
                $_SESSION["donated_amount"] = 0;
                $_SESSION["donated_percent"] = 0;
            }
            else
            {*/
                while ($row = $get->fetch_array())
                {
                    $total_amount += $row['charge_amount'];
                }

                $_SESSION["donated_amount"] = $total_amount + 15700;
                $_SESSION["donated_percent"] = floor((($total_amount + 15700) / 70000) * 100);
            //}
        }

        $conn->close();
    }
    
?>