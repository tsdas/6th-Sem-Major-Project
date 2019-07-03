
<?php
	require_once "include/connect.php";
	if(isset($_POST['submit']))
		{
			$date=mysqli_real_escape_string($link,$_POST["rdate"]);
		    $rdate=date("Y-m-d",strtotime($date));
		    $rid=$_POST['rid'];
		    $mid=$_POST['mid'];
		    $quan=$_POST['quantity'];
		    $rate=$_POST['rate'];
		    $amount=$quan*$rate;
		    // $amount=$_POST['amount'];
			$vendor = trim($_POST['vendid']);
			

			 // Prepare an insert statement
			$sql = "INSERT into repaired (rid,vendor,repdate,qua,rate,amount) VALUES (?,?,?,?,?,?)";

			if($stmt = mysqli_prepare($link,$sql)){

				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt,"iisiii",$rid,$vendor,$rdate,$quan,$rate,$amount);

				// Execute the query
				mysqli_stmt_execute($stmt);

				 // Everything is OK
                $is_ok = true;

                 $str="update repairing set status='Repaired' where rid='$rid'";
                 mysqli_query($link,$str);

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
	header("location:sdHome.php?is_ok=5");
	}
	if(!empty($ok))
	{
	header("location:viewrepairing.php?ok=".$rid);
	}
?>	