<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
	{
		$date=mysqli_real_escape_string($link,$_POST["sdate"]);
		$sdate=date("Y-m-d",strtotime($date));
		$scheme = $_POST['scid'];
		$mid = $_POST['mid'];
		$quantity = $_POST['quantity'];
		$details = $_POST['details'];
		$vendor = $_POST['vendid'];
		$warranty = $_POST['warranty'];
		$dept = $_POST['dept'];

		 // Prepare an insert statement
		$sql = "INSERT into msupply (sdate,scheme,mid,quantity,details,vendor,warranty,dept) VALUES (?,?,?,?,?,?,?,?)";
		
		$str="Select * from storage where mid='$mid' and dept='$dept'";
		$rec=mysqli_query($link,$str);
		$n=mysqli_num_rows($rec);
		if($n>0)
		{
			if($stmt2 = mysqli_prepare($link,$sql)){
	
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt2,"siiissss",$sdate,$scheme,$mid,$quantity,$details,$vendor,$warranty,$dept);
	
				// Execute the query
				mysqli_stmt_execute($stmt2);
	
				 // Everything is OK
				$is_ok = true;
	
				mysqli_stmt_close($stmt2);
				
	
			}
			$row=mysqli_fetch_array($rec);
			$st=$row["stock"];
			$st=$st+$quantity;
			mysqli_query($link,"Update storage set stock='$st' where mid='$mid'");
			$is_ok = true;
		}
		else
		{

			$sql1 = "INSERT into storage (mid,dept,stock) VALUES (?,?,?)";
	
			if($stmt = mysqli_prepare($link,$sql)){
	
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"siiissss",$sdate,$scheme,$mid,$quantity,$details,$vendor,$warranty,$dept);
	
				// Execute the query
				mysqli_stmt_execute($stmt);
	
				 // Everything is OK
				$is_ok = true;
	
				mysqli_stmt_close($stmt);
				
	
			}
			if($stmt1 = mysqli_prepare($link,$sql1)){
	
				mysqli_stmt_bind_param($stmt1,"isi",$mid,$dept,$quantity);
	
				// Execute the query
				mysqli_stmt_execute($stmt1);
	
				 // Everything is OK
				$is_ok = true;
	
				mysqli_stmt_close($stmt1);
				mysqli_close($link);
	
			}	
		}

}
?>

<?php
	if(!empty($is_ok))
	{
	header("location:mCStore.php?is_ok=2");
	}
?>	