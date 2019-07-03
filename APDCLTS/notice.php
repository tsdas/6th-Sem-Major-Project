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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
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
		background-size:100%;
	}
	label.error{
			color:#F00;	
			font-size:medium;
	}
	h3{
		font-family: 'Concert One', cursive;
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
    

          $("#form1").validate({
                    rules: {
                        header: {
                            required: true
                        },
                        details: {
                            required: true
                            
                        }
                        
                        
                    },
                    messages: {
                        header: {
                            required: "Enter Header"
                        },
                        details: {
                            required: "Please Enter Details"
                            
                        }
                        
                    }
          });
          
  });

</script>
</head>

<body>
	<?php include "circleSbar.php"; ?>
    <div style="margin-left:300px">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom"><?php echo $divn; ?>  Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
    	<div class="w3-card-2 w3-white w3-opacity-min" style="width:60%; margin:100px auto">
        	<div class="w3-container">
            	<h3 align="center">New Notice</h3>
            </div>
            <div class="w3-container w3-padding-16">
            	<form name="form1" id="form1" method="post" action="postnotice.php">
                
                    <p>
                    	<input type="text" name="header" class="w3-input w3-round w3-border" placeholder="Notice Header">
                    </p>
                    <p>
                        <textarea name="details" class="w3-input w3-round w3-border" placeholder="Details"></textarea> 
                    </p>
                 
                    	<input type="submit" name="submit" class="w3-btn w3-bar w3-round w3-red" value="Submit">
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_GET["ok"]) and $_GET['ok'] == 1)
    {
        echo '<script> alert("Notice Added Successfully"); </script>';  
    }
    
?>
