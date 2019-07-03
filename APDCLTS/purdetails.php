<?php 
	session_start();
	if(!isset($_SESSION["uname"]))
	{
		header("location:index.php");
		return;
	}
	$uid=$_SESSION["uname"];

	$invoice_no = $_GET["invno"];
	require_once "include/connect.php";
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
	.invno{
		background-image:url(images/invno.jpg);
		background-repeat:no-repeat;
		background-position:left;
		padding-left:120px;
	}
</style>
<script type="text/javascript">
    $(document).ready(function()
    {
          $("#form1").validate({
                    rules: {
                        material: {
                            required: true
                            
                        },
                        qty: {
                            required: true,
                            digits:true
                         
                        },
                         rate: {
                            required: true,
                            digits:true
                          
                        },
                         gst: {
                            required: true,
                            digits:true
                          
                        }
                        
                    },
                    messages: {
                        material: {
                            required: "Please Select Material Name"
                           
                        },
                        qty: {
                            required: "Enter Material Quantity",
                             digits: "Enter only digits"
                                 
                        },
                        rate: {
                            required: "Enter Per Quantity Price",
                             digits: "Enter only digits"
                            
                        },
                        gst: {
                            required: "Enter GST",
                            digits: "Enter only digits"
                            
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
            	<h3 class="topbar w3-border-bottom">Circle Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
    	<div class="w3-card-2 w3-white w3-opacity-min w3-round" style="width:60%; margin:70px auto">
        	<div class="w3-container">
            	<h3 align="center">Purchase Details</h3>
            </div>
            <div class="w3-container w3-padding-16">
            	<form name="form1" id="form1" method="post" action="propdetail.php">
            		<p>
                    	<input type="text" readonly name="invoice" class="w3-input w3-round w3-border invno" placeholder="Invoice No." value="<?php echo $invoice_no; ?>">
                    </p>
                	<p>
                    	<select name="material" class="w3-select w3-round w3-border">
                        	<option selected="selected">Select Materials</option>
                            <?php
                             $sql = "Select * from materials";
                             $result =mysqli_query($link,$sql);
                             while($row=mysqli_fetch_array($result))
                             {
                             	echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                             }
                            ?>
                        </select>
                    </p>
                    <p>
                    	<input type="text" name="qty" class="w3-input w3-round w3-border" placeholder="Quantity">
                    </p>
                    <p>
                        <input type="text" name="rate" class="w3-input w3-round w3-border" placeholder="Rate">
                    </p>
                    
                    <p>
                        <input type="text" name="gst" class="w3-input w3-round w3-border" placeholder="GST">
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
<script>
	function deptmenu()
	{
		if(document.getElementById('mdept').style.display=='none')
		{
			document.getElementById('mdept').style.display='block';	
		}
		else
		{
			document.getElementById('mdept').style.display='none';	
		}
	}
	function matmenu()
	{
		if(document.getElementById('mmat').style.display=='none')
		{
			document.getElementById('mmat').style.display='block';	
		}
		else
		{
			document.getElementById('mmat').style.display='none';	
		}
	}
	function vedmenu()
	{
		if(document.getElementById('mved').style.display=='none')
		{
			document.getElementById('mved').style.display='block';	
		}
		else
		{
			document.getElementById('mved').style.display='none';	
		}
	}
</script>
