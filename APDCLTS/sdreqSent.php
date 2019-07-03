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
	
	if(isset($_GET["rno"]))
	{
		$rno=$_GET["rno"];
		$sql="Update requisition set status='Pending' where rno='$rno'";
		mysqli_query($link,$sql);	
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="5;URL='sdreqsent.php'">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">
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
  h3{
    font-family: 'Concert One', cursive;
  }
</style>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
</head>

<body>
<?php 
        if($_SESSION["utype"]=="Sub-Division")
        {
            include "subdivSbar1.php"; 
        }
        else if($_SESSION["utype"]=="Division")
        {
            include "divSbar1.php";   
        }
        else
        {
            include "circleSbar1.php"; 
        }
        
    ?>
<div id="main" style="margin-left:300px">
    <div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
      <div class="w3-container w3-indigo w3-right-align w3-opacity-min">
          	<div class="w3-left">
              <h3 class="topbar w3-border-bottom"><?php echo $divn; ?> Dashboard</h3>
            </div>
            <div class="w3-right">
              <h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
      </div>
    </div>
    
  
    	<div class="w3-card-2 w3-white w3-opacity-min" style="width:70%; margin:50px auto">
        	<div class="w3-container">
              <div class="left"><h3 class="bottombar">Requisition Sent Details</h3></div>
           <!--      <div class="right" style="padding-top:16px;"><a href="newrepairing.php" class="btn black round small text-white"><i class="fa fa-plus-square"></i> Add New</a></div>
            </div> -->
            
          <div class="w3-container w3-padding-16">
                <?php //if(!empty($rows)): ?>

                    <table class="w3-table-all">
                            <thead>
                            	<th>Requisition No.</th>
                            	<th>Requisition Date</th>
                                <th>Material</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            	<?php
                            		$sql="Select A.*,B.*,C.mname from requisition as A,reqdetails as B,materials as C where A.rno=B.rno and A.sdiv='$divn' and  B.mid=C.mid";
									$result=mysqli_query($link,$sql);
								
									
									while($row=mysqli_fetch_array($result))
									{
										
										echo '<tr>';
										echo '<td>'.$row["rno"].'</td>';
										echo '<td>'.$row["date"].'</td>';
										echo '<td>'.$row["mname"].'</td>';
										echo '<td>'.$row["quantity"].'</td>';
										echo '<td>'.$row["status"].'</td>';
										$status=$row["status"];
										if($status=="Issued")
										{
											echo '<td><a href="reqAccept.php?rno='.$row["rno"].'&mid='.$row["mid"].'&qty='.$row["quantity"].'" class="btn small round blue">Accepted</a>	</td>';	
										}
										else
										{
											echo '<td>&nbsp;</td>';
										}
										
										echo '</tr>';	
									}
								
								?>
                            </tbody>

                    </table>
            </div>
    </div>
</div>



