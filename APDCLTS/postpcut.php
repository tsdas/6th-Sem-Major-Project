
<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$date=mysqli_real_escape_string($link,$_POST["pcdate"]);
		    $pcdate=date("Y-m-d",strtotime($date));
		    $dept=$_POST['deptid'];
		    $pno=$_POST['pno'];
		    $pctime=$_POST['pctime'];
		    $pcontime=$_POST['pcontime'];
		    $cause=$_POST['cause'];
		    $remarks=$_POST['remarks'];
			
			

			 // Prepare an insert statement
			$sql = "INSERT into powercut (panelno,pctime,pontime,cause,remarks,deptid,pcdate) VALUES (?,?,?,?,?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"sssssis",$pno,$pctime,$pcontime,$cause,$remarks,$dept,$pcdate);

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
	header("location:sdHome.php?is_ok=4");
	}
?>	