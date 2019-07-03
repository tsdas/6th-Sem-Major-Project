<?php 
	session_start();
	include "include/connect.php";
	if(!isset($_SESSION["uname"]))
	{
		header("location:index.php");
		return;
	}
	$uid=$_SESSION["uname"];
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
	<?php include "circleSbar.php"; ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom">Jorhat Electrical Circle Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>

        <div class="container" style="width:90%; margin:24px auto;">
				<div class="card white" style="width:70%; margin:0 auto;">
                	<div class="container center bottombar">
                    	<h3>Requisition Received</h3>
                    </div>
                    <div class="container padding-16">
                    	<table class="table-all">
                        	<thead>
                            	<th>Requisition Date</th>
                                <th>Division</th>
                                <th>Status</th>
                                <th>View Details</th>
                            </thead>
                            <tbody>
                            	<?php
									//$sql="Select * from requisition where status='Pending'";
									$sql="Select A.*,B.status from requisition as A,reqdetails as B where B.status='Circle' and A.rno=B.rno GROUP BY B.rno";

									$result=mysqli_query($link,$sql);
									while($row=mysqli_fetch_array($result))
									{
										if($row[2]=='Jorhat Electrical Circle')
										{
											echo '<tr>';
											echo '<td>'.$row[1].'</td>';
											echo '<td>'.$row[3].'</td>';
											echo '<td>'.$row[4].'</td>';
											echo '<td><a href="viewRdetailsCir.php?id='.$row[0].'" class="btn blue round small">Click Here</a></td>';
											echo '</tr>';
										}
										else
										{
											echo '<tr>';
											echo '<td>'.$row[1].'</td>';
											echo '<td>'.$row[2].'</td>';
											echo '<td>'.$row[4].'</td>';
											echo '<td><a href="viewRdetailsCir.php?id='.$row[0].'" class="btn blue round small">Click Here</a></td>';
											echo '</tr>';
										}	
									}
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        
   </div>
</body>
</html>
