<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$invoice_no = trim($_POST['invoice']);
			$date=mysqli_real_escape_string($link,$_POST["idate"]);
		    $idate=date("Y-m-d",strtotime($date));
			$vendor = trim($_POST['vendor']);
			

			 // Prepare an insert statement
			$sql = "INSERT into purchase (invoiceno,idate,vendor) VALUES (?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"iss",$invoice_no,$idate,$vendor);

				// Execute the query
				mysqli_stmt_execute($stmt);

				 // Everything is OK
                $is_ok = true;

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
	header("location:purdetails.php?invno=".$invoice_no);
	}
?>	