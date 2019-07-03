<?php 
	require_once 'include/connect.php';
	$utype=$_GET["utype"];
	$sql="Select name from department where type='$utype'";
	$result=mysqli_query($link,$sql);
	echo '<option>Select Department Name</option>';
	while($row=mysqli_fetch_array($result))
	{
		echo '<option>'.$row[0].'</option>';	

	}

?>

