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
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
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
			font-size:medium;
	}
	.topbar{
		font-family: 'Concert One', cursive;
	}
	.menu-icon{
		width:40px;
	}
</style>
<script>
// $(document).ready(function(){
//     $("#dtype").change(function(){
//         var x=$(this).val();
//         var type=x.replace(" ","+");

//         //alert(dept);
//         $("#cdivision").load("getcdiv.php?type="+type);
//        // $("#lcdivi").load("getlcdivi.php?div="+dept);
//     });

// });
$(document).ready(function()
    {
    

          $("#form5").validate({
                    rules: {
                        vname: {
                            required: true
                        },
                        address: {
                            required: true
                        },
                        contact: {
                            required:true,
                            digits:true,
                            minlength:10,
                            maxlength:10
                        }
                        
                    },
                    messages: {
                        vname: {
                            required: "Enter Vendor Name"
                        },
                        address: {
                            required: "Please Enter Adrees"
                        },
                        contact: {
                            required: "Please provide a phone number",
                            digits: "Enter only digits",
                            minlength: "Your phone number must be 10 characters long"
                            
                        }
                     
                    }
          });
          
  });

</script>
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
            	<h3 align="center">New Vendors</h3>
            </div>
            <div class="w3-container w3-padding-16">
            	<form name="form5" id="form5" method="post" action="postvendor.php">
                	
                    <p>
                    	<input type="text" name="vname" class="w3-input w3-round w3-border" placeholder="Vendor Name">
                    </p>
                    <p>
                    	<textarea name="address" class="w3-input w3-round w3-border" placeholder="Adress"></textarea>
                    </p>
                     <p>
                    	<input type="text" name="contact" class="w3-input w3-round w3-border" placeholder="Contact Number">
                    </p>
                    <p>
                    	<input type="submit" name="submit" class="w3-btn w3-bar w3-round w3-red" value="Submit">
                    </p>
                </form>
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
