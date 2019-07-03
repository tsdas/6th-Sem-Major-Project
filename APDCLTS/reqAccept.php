<?php
	session_start();
	include "include/connect.php";
	$uid=$_SESSION["uname"];
	$sql="Select department from users where userid='$uid'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_array($result);
	$divn=$row[0];
	$rno=$_GET["rno"];
	$mid=$_GET["mid"];
	$qty=$_GET["qty"];
	
	$str="update reqdetails set status='Accepted' where rno='$rno' and mid='$mid'";
	$result= mysqli_query($link,$str);
	if($result)
	{
		if($_SESSION["utype"]=="Circle")
		{
			$str1="select stock from storage where mid='$mid' and dept='Circle'";
		}
		else
		{
			$str1="select stock from storage where mid='$mid' and dept='$divn'";
		}
		
		$result= mysqli_query($link,$str1);
		$row=mysqli_fetch_array($result);
		$n=mysqli_num_rows($result);
		if($n>0)
		{
			$stock=$row[0];
			$stock=$stock+$qty;
			if($_SESSION["utype"]=="Circle")
			{
				mysqli_query($link,"update storage set stock='$stock' where mid='$mid' and dept='Circle'");
			}
			else
			{
				mysqli_query($link,"update storage set stock='$stock' where mid='$mid' and dept='$divn'");
			}
			
		}
		else
		{
			if($_SESSION["utype"]=="Circle")
			{
				mysqli_query($link,"insert into storage values('$mid','Circle','$qty')");
			}
			else
			{
				mysqli_query($link,"insert into storage values('$mid','$divn','$qty')");
			}
			
		}
		
		
		header("location:sdreqSent.php");	
	}
	
?>
