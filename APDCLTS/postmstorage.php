<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
	{
		$matid = $_POST['matid'];
		$stock = $_POST['stock'];
		$dept = $_POST['dept'];
		$dtype = $_POST['dtype'];
		
		$str="Select * from storage where mid='$matid' and dept='$dept'";
		$rec=mysqli_query($link,$str);
		$n=mysqli_num_rows($rec);
		if($n>0)
		{
			$row=mysqli_fetch_array($rec);
			$st=$row["stock"];
			$st=$st+$stock;
			mysqli_query($link,"Update storage set stock='$st' where mid='$matid' and dept='$dept'");
			header("location:mstorage.php?is_ok=2&dept=".$dept."&type=".$dtype);
			return;
		}
		
		
		$sql = "INSERT into storage VALUES (?,?,?)";

		if($stmt = mysqli_prepare($link,$sql)){

			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt,"isi",$matid,$dept,$stock);

			// Execute the query
			$result=mysqli_stmt_execute($stmt);

			 // Everything is OK
			if($result)
			{
				$is_ok = true;
			}
			else
			{
				echo mysqli_error($link);
			}

			mysqli_stmt_close($stmt);
			mysqli_close($link);

		}
		else{
			
		}	
			

}
?>

<?php
	if(!empty($is_ok))
	{
		header("location:mstorage.php?is_ok=2&dept=".$dept."&type=".$dtype);
	}
?>	