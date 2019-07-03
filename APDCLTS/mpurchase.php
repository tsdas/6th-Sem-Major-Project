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

	
            $sql = "SELECT name FROM vendors";
            if($result = mysqli_query($link,$sql))
            {
                $rows = mysqli_fetch_all($result);

                mysqli_free_result($result);

            }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
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




<script type="text/javascript">
    $(function() {
    $( "#idate" ).datepicker(); 
    });
    $(document).ready(function()
    {
          $("#form1").validate({
                    rules: {
                        invoice: {
                            required: true,
                            digits:true
                        },
                        idate: {
                            required: true
                         
                        },
                         vendor: {
                            required: true
                          
                        }
                        
                    },
                    messages: {
                        invoice: {
                            required: "Please Enter Invoice Number",
                            digits: "Enter only digits"
                        },
                        // idate: {
                        //     required: "Select Purchase Date"
                                 
                        // },
                        vendor: {
                            required: "Select Vendor Name"
                            
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
            	<h3 class="topbar w3-border-bottom">Jorhat Electrical Circle Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
    	<div class="w3-card-2 w3-white w3-opacity-min" style="width:60%; margin:100px auto">
        	<div class="w3-container">
            	<h3 align="center">New Material Purchase</h3>
            </div>
            <div class="w3-container w3-padding-16">
            	<form name="form1" id="form1" method="post" action="postpurchase.php">
                	<p>
                    	<input type="text" name="invoice" class="w3-input w3-round w3-border" placeholder="Invoice No.">
                    </p>
                    <p>
                        <input type="text" id="idate" name="idate" class="w3-input w3-round w3-border" placeholder="Purchase Date">
                    </p>

                    <p>
                        <select id="vendor" name="vendor" class="w3-select w3-border w3-round-medium">

                        <option selected>Select Vendor Name</option>

                        <?php foreach ($rows as $row) : ?>
                            <option value ="<?php echo $row[0]; ?>" >
                              <?php echo $row[0]; ?> 
                            </option>
                        <?php endforeach; ?>    
                            
                        </select>
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

