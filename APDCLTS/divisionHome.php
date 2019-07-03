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
<meta http-equiv="refresh" content="3;URL='divisionHome.php'">
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
	<?php include "divSbar1.php"; ?>
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
                        <a href="sdivstock.php" style="text-decoration:none;"><img src="images/dept.png" style="width:50%;"><br>
                        Sub-Divisions</a> &nbsp;
                        <?php
                            $sql="Select count(name) from department where cdivision='$divn'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_fetch_array($result);
                            $n=$row[0];
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>
                    </div>
                </div>
                <div class="quarter">
                    <div class="container padding-16 lime center">
                       
                        <a href="mstorage.php?dept=<?php echo $divn; ?>&type=div" style="text-decoration:none;"> <img src="images/transformer.png" style="width:50%;"><br>Materials Stock</a> &nbsp;
                        <?php
                            $sql="Select count(*) from storage where dept='$divn'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_fetch_array($result);
                            $n=$row[0];
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>
                    </div>
                </div>
                <div class="quarter">
                    <div class="container padding-16 green center">
                     
                        <a href="requestRdiv.php" style="text-decoration:none;"><img src="images/request.png" style="width:50%;"><br> Requisitions Received</a>&nbsp;
                        <?php
                            //$sql="Select count(*) from requisition where cdivision='$divn' and status='Pending'";
                            $sql="Select A.*,B.status from requisition as A,reqdetails as B where B.status='Division' and cdivision='$divn' and  A.rno=B.rno GROUP BY B.rno";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_num_rows($result);
                            $n=$row;
                        ?>
                        <span class="badge red"><?php echo $n; ?></span>
                    </div>
                </div>
                 <div class="quarter">
                    <div class="container padding-16 yellow center">
                        <a href="sdreqSent.php" style="text-decoration:none;"><img src="images/req-recv.png" style="width:50%;"><br>
                        Requisition Materials List</a> &nbsp;
                       <?php
                            $sql="Select A.*,B.*,C.mname from requisition as A,reqdetails as B,materials as C where A.rno=B.rno and A.sdiv='$divn' and  B.mid=C.mid";
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

<?php
    if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 1)
    {
        echo '<script> alert("Divison or SubDivision Added Successfully"); </script>';  
    }
    if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 2)
    {
        echo '<script> alert("Material Added Successfully"); </script>';    
    }
?>
