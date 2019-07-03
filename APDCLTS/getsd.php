<?php 
	require_once 'include/connect.php';
	$div=$_GET["div"];
	$sql="Select name from department where cdivision='$div'";
	$result=mysqli_query($link,$sql);
	echo '<option selected>Select Sub Division</option>';
	while($row=mysqli_fetch_array($result))
	{
		echo '<option>'.$row[0].'</option>';	
	}
?>