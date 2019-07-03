<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
	{
			$invoice_no = trim($_POST['invoice']);
			$material = trim($_POST['material']);
			$rate = trim($_POST['rate']);
			$qty = trim($_POST['qty']);
			$gst = trim($_POST['gst']);
			$amount=$rate*$qty;
			$gstamt=($amount*$gst/100);
			$total=$amount+$gstamt;
			

			 // Prepare an insert statement
			$sql = "INSERT into purchasedetails VALUES (?,?,?,?,?,?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"iiiddddd",$invoice_no,$material,$qty,$rate,$amount,$gst,$gstamt,$total);

				// Execute the query
				mysqli_stmt_execute($stmt);

				 // Everything is OK
                $is_ok = true;

				mysqli_stmt_close($stmt);
				
				$str="Select stock from storage where mid='$material' and dept='Circle'";
				$result=mysqli_query($link,$str);
				$n=mysqli_num_rows($result);
				if($n>0)
				{
					$row=mysqli_fetch_array($result);
					$st=$row[0];
					$st=$st+$qty;
					$str2="Update storage set stock='$st' where mid='$material' and dept='Circle'";
					mysqli_query($link,$str2);
				}
				else
				{
					$str3="insert into storage values('$material','Circle','$qty')";
					mysqli_query($link,$str3);	
				}
                mysqli_close($link);

            }
            else
			{
				echo mysqli_error();
            }	
	}
?>

<?php
	if(!empty($is_ok))
	{
	header("location:purdetails.php?invno=".$invoice_no);
	}
?>	