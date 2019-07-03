<?php 
	session_start();
	if(!isset($_SESSION["uname"]))
	{
		header("location:index.php");
		return;
	}
	include "include/connect.php";
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
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<!-- <script>
$(document).ready(function(){
	$('#utype').change(function() 
    {
        var ut=$(this).val();
		$('#dname').load("getdept.php?utype="+ut);
    });
});
</script> -->

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
        $('#utype').change(function() 
        {
        var ut=$(this).val();
        $('#dname').load("getdept.php?utype="+ut);
        });

          $("#form5").validate({
                    rules: {
                        usertype: {
                            required: true
                        },
                        dname: {
                            required: true
                        },
                        userid: {
                            required: true
                        },
                        pwd: {
                            required:true,
                            minlength:5
                            
                        },
                        cpwd: {
                            required:true,
                            equalTo: "#pwd"
                        }
                        
                    },
                    messages: {
                        usertype: {
                            required: "Select Department Type"
                        },
                        dname: {
                            required: "Please Enter Department Name"
                        },
                         userid: {
                            required: "Enter User Id"
                        },
                        pwd: {
                            required: "Please provide a password",
                            minlength: "Password must be at least 5 characters long",
                          
                        },
                        cpwd: {
                            required: "Please provide a password",
                            equalTo: "Both passwords are not matching"
                        },
                     
                    }
          });
          
  });

</script>
</head>

<body>
	<?php include "circleSbar.php"; ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom"><?php echo $divn; ?>  Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
        <div class="w3-container" style="height:auto;">
    	<div class="w3-card-2 w3-white w3-opacity-min" style="width:70%; margin:120px auto">
        	<div class="w3-container">
            	<h3 align="center">Create User</h3>
            </div>
            <div class="w3-container w3-padding-16">
            	<form name="form5" id="form5" method="post" action="postusers.php">
                	<p>
                      <select id="utype" name="usertype"  class="w3-select w3-border w3-border-blue w3-round-medium">
                        <option selected>Select User Type</option>
                        <option>Division</option>
                        <option>Sub-Division</option>
                      </select>
                  </p>
                    <p>
                    	<select id="dname" name="dname"  class="w3-select w3-round w3-border">
                        	<option selected="selected">Select Department</option>
                           
                        </select>
                    </p>
                    <p>
                    	<input type="text" name="userid" class="w3-input w3-round w3-border" placeholder="User Id">
                    </p>
                    <p>
                    	<input type="password" name="pwd" id="pwd" class="w3-input w3-round w3-border" placeholder="Password">
                    </p>
                    <p>
                    	<input type="password" name="cpwd" class="w3-input w3-round w3-border" placeholder="Re-enter Password">
                    </p>
                    
                    	<input type="submit" name="submit" class="w3-btn w3-bar w3-round w3-red" value="Submit">
                    </p>
                </form>
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
