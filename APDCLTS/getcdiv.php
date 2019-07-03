<?php 
	require_once 'include/connect.php';
	session_start();
	$type=$_GET["type"];
	$sql="Select cdivision from department where type='$type' GROUP BY cdivision";
	$result=mysqli_query($link,$sql);
	echo '<option selected>Select Concern Division/Circle</option>';
	while($row=mysqli_fetch_array($result))
	{
		echo '<option>'.$row[0].'</option>';	
	}
?>