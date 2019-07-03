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
<meta http-equiv="refresh" content="3;URL='cgmHome.php'">
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
	<?php include "cgmSbar1.php"; ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom"><?php echo $divn; ?> Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
        
        <div class="container" style="width:90%; margin:24px auto;">
            <div class="row-padding">
                <div class="quarter">
                    <div class="container padding-16 blue center">
                        <a href="viewscheme.php" style="text-decoration:none;"> <img src="images/dept.png" style="width:50%;"><br>
                        Scheme</a> &nbsp;

                        <?php
                            $sql="Select * from scheme";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_num_rows($result);
                            $n=$row;
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>
                    </div>
                </div>
                <div class="quarter">
                    <div class="container padding-16 lime center">
                        <a href="mCStore.php" style="text-decoration:none;"> <img src="images/transformer.png" style="width:50%;"><br>
                        Materials Stock</a> &nbsp;

                        <?php
                            $sql="Select * from storage where dept='CGM'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_num_rows($result);
                            $n=$row;
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>
                    </div>
                </div>
                <div class="quarter">
                    <div class="container padding-16 green center">
                        <img src="images/request.png" style="width:50%;"><br>
                         <a href="requestRcgm.php" style="text-decoration:none;">Requisitions Received</a>&nbsp;
                          <?php
                            $sql="Select distinct rno from reqdetails where status='CGM'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_num_rows($result);
                            $n=$row;
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>

                    </div>
                </div>
                <div class="quarter">
                     <div class="container padding-16 yellow center">
                         <a href="viewsupply.php" style="text-decoration:none;"> <img src="images/req-sent.png" style="width:50%;"><br>
                        Supply Record</a> &nbsp;
                         <?php
                            $sql="Select * from msupply where dept='CGM'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_num_rows($result);
                            $n=$row;
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
	function smenu()
	{
		if(document.getElementById('sstock').style.display=='none')
		{
			document.getElementById('sstock').style.display='block';	
		}
		else
		{
			document.getElementById('sstock').style.display='none';	
		}
	}
</script>