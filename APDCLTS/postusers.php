<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$utype = trim($_POST['usertype']);
			$dname = trim($_POST['dname']);
			$userid = trim($_POST['userid']);
			$pwd = trim($_POST['pwd']);
		

			 // Prepare an insert statement
			$sql = "INSERT into users (usertype,department,userid,password) VALUES (?,?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"ssss",$utype,$dname,$userid,$pwd);

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
	header("location:circleHome.php?is_ok=3");
	}
?>	