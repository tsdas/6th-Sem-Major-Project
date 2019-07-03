<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$dtype = $_POST['dtype'];
			$dname = trim($_POST['dname']);
			$cdivision = trim($_POST['cdivision']);
			$lcode = trim($_POST['lcode']);
			$contact = trim($_POST['contact']);

			 // Prepare an insert statement
			$sql = "INSERT into department (type,name,cdivision,lcode,contact) VALUES (?,?,?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"sssii",$dtype,$dname,$cdivision,$lcode,$contact);

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
	header("location:circleHome.php?is_ok=1");
	}
?>	