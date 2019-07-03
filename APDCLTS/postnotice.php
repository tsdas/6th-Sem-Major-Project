<?php
include "include/connect.php";
if(isset($_POST["submit"]))
	{
		$date=date("Y-m-d");
		$header=$_POST['header'];
		$details=$_POST['details'];

		$str="Insert into notice values(null,'$date','$header','$details')";
		$result=mysqli_query($link,$str);
		if($result)
			{
				header("location:notice.php?ok=1");
			}
			else
			{
				echo mysqli_error($link);
			}
	}
?>
