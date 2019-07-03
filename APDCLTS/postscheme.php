<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$sname = trim($_POST['sname']);

			 // Prepare an insert statement
			$sql = "INSERT into scheme (scname) VALUES (?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"s",$sname);

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
	header("location:cstoreHome.php?is_ok=1");
	}
?>	