<?php 
	session_start();
    require_once 'include/connect.php';

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
	

            $sql = "SELECT * FROM materials";
            if($result = mysqli_query($link,$sql))
            {
                $rows = mysqli_fetch_all($result);

                mysqli_free_result($result);
                mysqli_close($link);

            }
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
	<?php 
        if($_SESSION["utype"]=="Circle")
        {
            include "circleSbar.php"; 
        }
        else if($_SESSION["utype"]=="Central Store")
        {
            include "cstoresbar.php";   
        }
        else
        {
            include "cgmSbar.php"; 
        }
        
    ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom"><?php echo $divn; ?> Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
        <div class="w3-card-2 w3-white w3-opacity-min" style="width:60%; margin:120px auto">
        	<div class="w3-container">
            	<div class="left"><h3 class="bottombar">View Materials</h3></div>
                <div class="right" style="padding-top:16px;"><a href="newmaterial.php" class="btn black round small text-white"><i class="fa fa-plus-square"></i> Add New</a></div>
            </div>
            <div class="w3-container w3-padding-16">
                <?php if(!empty($rows)): ?>

                    <table class="w3-table-all">
                            <thead>
                              <tr>
                                <th>Material Name</th>
                                <th>Material Details</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                   <tr>
                                     <td> <?php echo $row[1]; ?></td>
                                     <td> <?php echo $row[2]; ?></td>
                                     <td>&nbsp; </td>
                                   </tr>
                                <?php endforeach; ?>
                            </tbody>  
                            
                    </table>

                <?php endif; ?>   
            	
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
