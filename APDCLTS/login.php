<?php
	session_start();
	require_once ("include/connect.php");
	if(isset($_POST["login"]))
	{
		$usertype=$_POST["usertype"];
		$username=$_POST["username"];
		$pass=$_POST["password"];
		$pwd="";
		$sql="Select * from users where userid='$username' and usertype='$usertype'";
		$result=mysqli_query($link,$sql);
		$n=mysqli_num_rows($result);
		if($n==0)
		{
			header("location:index.php?err=0");
			return;	
		}
		else
		{
			$row=mysqli_fetch_array($result);
			$pwd=$row[3];
			if($pass==$pwd)
			{
				$_SESSION["uname"]=$username;
				$_SESSION["utype"]=$usertype;
				$_SESSION["status"]=true;
				if($usertype=="Circle")
				{
					header("location:circleHome.php");
				}
				else if($usertype=="Division")
				{
					header("location:divisionHome.php");
				}
				else if($usertype=="Sub-Division")
				{
					header("location:sdHome.php");
				}
				else if($usertype=="Central Store")
				{
					header("location:cstoreHome.php");
				}
				else if($usertype=="CGM")
				{
					header("location:cgmHome.php");
				}
			}
			else
			{
				header("location:index.php?err=1");
				return;	
			}
		}
	}
?>