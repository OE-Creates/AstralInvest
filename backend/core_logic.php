<?php
	//echo "core_logic_script loaded successfully";
	
	session_cache_limiter('nocache');
	session_start();
	
	if (isset($_GET['submit_logout']))
	{
		if (isset($_SESSION["user_id"]))
		{
			$uid = $_SESSION["user_id"];

			require 'dbconnect_invest.php';

			$setsql = "UPDATE users SET loggedin_status = 0 WHERE id = $uid";
			$setstatus=$conn->query($setsql);

			$conn->close();
			
			session_unset();
			session_destroy();

			header("Location: login.php");
			exit();
		}
		else
		{
			session_unset();
			session_destroy();

			header("Location: login.php");
			exit();
		}
		
	}
	
	if (isset($_SESSION["user_id"]) && $_SERVER['REQUEST_URI'] == "/php%20projects/AstralInvest/pages/forgotpassword.php") //Change the URI to '/pages/verifyaccount.php' when moving to live site (DELETE THIS)
	{
		header("Location: dashboard.php");
		exit();
	}
	
	if (isset($_SESSION["user_id"]) && $_SERVER['REQUEST_URI'] == "/php%20projects/AstralInvest/pages/resetpassword.php")
	{
		header("Location: dashboard.php");
		exit();
	}
	
	function view($path)
	{
        include $path;
    }
?>