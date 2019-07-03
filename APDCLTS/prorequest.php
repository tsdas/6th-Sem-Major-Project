<?php
	session_start();
	require_once("include/connect.php");
	if(isset($_POST["submit"]))
	{
		$rno=$_POST["rno"];
		$material=$_POST["material"];
		$qty=$_POST["qty"];	
		
		if($_SESSION["utype"]=="Sub-Division")
		{
			$sql="insert into reqdetails values('$rno','$material','$qty','Division')";
		}
		else if($_SESSION["utype"]=="Division")
		{
			$sql="insert into reqdetails values('$rno','$material','$qty','Circle')";
		}
		else
		{
			$sql="insert into reqdetails values('$rno','$material','$qty','C Store')";
		}
		
		$result=mysqli_query($link,$sql);
		if($result)
		{
			header("location:sdrequests.php?rno=".$rno);	
		}
		else
		{
			echo mysqli_error($link);	
		}
	}
?>