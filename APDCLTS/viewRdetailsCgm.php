<?php 
	session_start();
	include "include/connect.php";
	if(!isset($_SESSION["uname"]))
	{
		header("location:index.php");
		return;
	}
	$uid=$_SESSION["uname"];
	$sql="Select department from users where userid='$uid'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_array($result);
	$divn=$row[0];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">
<!--<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">-->
<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	body{
		/*font-family: 'Montserrat', sans-serif;*/
		font-family: 'Concert One', cursive;
		background-image:url(images/bgrd.jpg);
		background-repeat:no-repeat;
		background-size:cover;
	}
	label.error{
			color:#F00;	
			font-size:x-small;
	}
	.topbar{
		font-family: 'Concert One', cursive;
	}
	.menu-icon{
		width:40px;
	}
</style>
</head>

<body>
	<?php include "cgmSbar.php"; ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom">Jorhat Electrical Circle Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>

       <?php
			$rid=$_GET["id"];
		?>
        <div class="container" style="width:90%; margin:24px auto;">
				<div class="card white" style="width:80%; margin:0 auto;">
                	<div class="container bottombar">
                    	<h3 align="center">Requisition Details</h3>
                    </div>
                    <div class="container padding-16">
                    	<div class="left">
                    	Requisition No: <?php echo $rid; ?><br>
                        <?php
							$sql="Select sdiv from requisition where rno='$rid'";
							$result=mysqli_query($link,$sql);
							$row=mysqli_fetch_array($result);
							$sdiv=$row[0];
						?>
                        From: <?php  echo $sdiv; ?>
                        </div>
                    </div>
                    <div class="container padding-16">
                    	<form id="form1" name="form1" method="post" action="proCgmRequest.php">
                        <input type="hidden" name="reqno" value="<?php echo $rid; ?>">
                        <input type="hidden" name="sdiv" value="<?php echo $sdiv; ?>">
                        <input type="hidden" name="division" value="<?php echo $divn; ?>">
                    	<table class="table-all">
                        	<thead>
                            	<th>Select</th>
                                <th>Material</th>
                                <!--th>Quantity</th-->
                                <th>Quantity</th>
                                <th>In-Stock</th>
                                <th>Issued Quantity</th>
                            </thead>
                            <tbody>
                            	<?php
									$sql="Select A.*,B.mname from reqdetails as A,materials as B where A.status='CGM' and A.rno='$rid' and A.mid=B.mid";
									$result=mysqli_query($link,$sql);
									while($row=mysqli_fetch_array($result))
									{
										echo '<tr>';
										echo '<td><input type="checkbox" name="mat[]" value="'.$row["mid"].'" id="mat"></td>';
										echo '<td>'.$row["mname"].'</td>';
										echo '<td>'.$row["quantity"].'<input type="hidden" name="rqty[]" value="'.$row["quantity"].'"></td>';
										//echo '<td>'.$row["status"].'</td>';
										$mid=$row["mid"];
										$str="Select stock from storage where mid='$mid' and dept='CGM'";
										$rec=mysqli_query($link,$str);
										$x=mysqli_num_rows($rec);
										$stock=0;
										if($x>0)
										{
											$r=mysqli_fetch_array($rec);
											$stock=$r[0];	
										}
										echo '<td>'.$stock.'</td>';
										
										//$tisq=$stock-$row["quantity"];
										
										if($stock>$row["quantity"])
										{
											echo '<td><input readonly type="text" name="iqty[]" value="'.$row["quantity"].'"></td>';
										}
										else
										{
											echo '<td><input readonly type="text" name="iqty[]" value="0"></td>';
										}
										echo '</tr>';	
									}
								?>
                            </tbody>
                        </table>
                        <br>
                       
                        	<input type="submit" name="submit1" class="btn block blue" value="Issue Materials">
                       
                        <!-- <div class="right" style="width:48%;">
                        	<input type="submit" name="submit2" class="btn block green" value="Forward to Central Storage">
                        </div> -->
                        </form>
                    </div>
                </div>
        </div>
        
   </div>
</body>
</html>

<?php
	if(isset($_GET["selected"]))
	{
		echo '<script> alert("Please select any record"); </script>';	
	}
	if(isset($_GET["qty"]))
	{
		echo '<script> alert("Some of the selected materials can not be issued due to shortage of stock"); </script>';	
	}
	if(isset($_GET["ok"]))
	{
		echo '<script> alert("Item Issued Successfully"); </script>';	
	}
	if(isset($_GET["cstore"]))
	{
		echo '<script> alert("One or more items can not be forwarded"); </script>';	
	}
	if(isset($_GET["is_ok"]) )
	{
		echo '<script> alert("Items Forwarded Successfully"); </script>';	
	}
?>

