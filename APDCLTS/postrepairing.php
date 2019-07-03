
<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$date=mysqli_real_escape_string($link,$_POST["rdate"]);
		    $rdate=date("Y-m-d",strtotime($date));
		    $dept=$_POST['deptid'];
		    $mid=$_POST['mid'];
		    $quan=$_POST['quantity'];
		    $status='New';
			//$vendor = trim($_POST['vendid']);
			

			 // Prepare an insert statement
			$sql = "INSERT into repairing (rdate,dept,mid,quan,status) VALUES (?,?,?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"siiis",$rdate,$dept,$mid,$quan,$status);

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
	header("location:sdHome.php?is_ok=3");
	}
?>	