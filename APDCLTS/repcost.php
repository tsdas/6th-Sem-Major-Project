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

    $sql1="Select dept_id from department where name='$divn'";
    $result1=mysqli_query($link,$sql1);
    $row1=mysqli_fetch_array($result1);
    $deptid=$row1[0];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">

<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
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
                        rdate: {
                            required: true
                        },
                        vendid: {
                            required: true
                        },
                        rate: {
                            required:true,
                            digits:true,
                            // minlength:1,
                            // maxlength:2
                        }
                        
                    },
                    messages: {
                        rdate: {
                            required: "Enter Repaired Date"
                        },
                        vendid: {
                            required: "Please Select Vendor"
                        },
                        rate: {
                            required: "Enter Per Quantity Price",
                            digits: "Enter only digits",
                            // minlength: "Quantity up to 2 digits are allowed"
                            
                        }
                     
                    }
          });
          
  });

</script>
</head>

<body>
    <?php include "subdivSbar.php"; ?>
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
                <h3 align="center">Add Repairing Cost</h3>
            </div>

            <?php

                $rid=$_GET["rid"];
                $str1="Select * from repairing where rid='$rid'";
                $result=mysqli_query($link,$str1);
                $row=mysqli_fetch_array($result);
                $mid=$row[3];
                $quantity=$row[4];

            ?>
            <div class="w3-container w3-padding-16">
                <form name="form1" id="form1" method="post" action="postrepcost.php">
                    <p>
                        <input type="text" id="rdate" name="rdate" class="w3-input w3-round w3-border" placeholder="Repaired Date">
                    </p>

                    <p>
                            <select name="vendid" class="w3-select w3-round w3-border">
                                <option selected>Select Vendors</option>
                                    <?php
                                        $sql="Select * from vendors";
                                        $result=mysqli_query($link,$sql);
                                        while($row=mysqli_fetch_array($result))
                                        {
                                            echo '<option value="'.$row[0].'">'.$row[1].'</option>';    
                                        }
                                    ?>
                            </select>
                    </p>

                    <p>
                            <input type="text read only" name="quantity" class="w3-input w3-round w3-border" value="<?php echo $quantity; ?>">
                   </p>

                    <p>
                            <input type="text" name="rate" class="w3-input w3-round w3-border" placeholder="Per Quantity Price">
                   </p>
                   
               <!--     <p>
                            <input type="text" name="amount" class="w3-input w3-round w3-border" placeholder=" Total Amount">
                   </p> -->
                    
                    
                    <input type="hidden" name="rid" class="w3-input w3-round w3-border" value="<?php echo $rid; ?>">
                    <input type="hidden" name="mid" class="w3-input w3-round w3-border" value="<?php echo $mid; ?>">
                    <input type="hidden" name="quantity" class="w3-input w3-round w3-border" value="<?php echo $quantity; ?>">
                    <p>
                        <input type="submit" name="submit" class="w3-btn w3-bar w3-round w3-red" value="Submit">
                    </p>
                
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script >  
    $(function() {
    $( "#rdate" ).datepicker(); 
    });
</script>
