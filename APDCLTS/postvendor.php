<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$vname = trim($_POST['vname']);
			$address = trim($_POST['address']);
			$contact = trim($_POST['contact']);

		

			 // Prepare an insert statement
			$sql = "INSERT into vendors (name,address,contact) VALUES (?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"ssi",$vname,$address,$contact);

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
		if($_SESSION["utype"]=="Circle")
		{
			header("location:circleHome.php?is_ok=4");
		}
		else
		{
			header("location:cstoreHome.php?is_ok=4");
		}
	}
?>	