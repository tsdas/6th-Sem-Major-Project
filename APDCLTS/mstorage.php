<?php 
	session_start();
	include "include/connect.php";
	if(!isset($_SESSION["uname"]))
	{
		header("location:index.php");
		return;
	}
	$uid=$_SESSION["uname"];
	$dept=$_GET["dept"];
	$type=$_GET["type"];

	$sql="Select department from users where userid='$uid'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_array($result);
	$divn=$row[0];

    //from
    if($_SESSION["utype"]=="Circle")
        {
            $sql = "SELECT * from storage where dept='Circle'";
        }
    else
        {
           $sql = "SELECT * from storage where dept='$divn'"; 
        }    
    
    $result = mysqli_query($link,$sql);
    $x=0;
    while($row = mysqli_fetch_array($result))
    {
     if($row["stock"]<5)
     {
         $x=1;   
     }
    }
    
    if($x==1)
    {

     echo '<script> alert("Some of the materials stocks are low"); </script>';   
    }
    //to
	
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
<script type="text/javascript">
    $(document).ready(function()
    {
          $("#form3").validate({
                    rules: {
                        matid: {
                            required: true
                        },
                        stock: {
                            required: true,
                            digits:true,
                            minlength:1,
                            maxlength:2
                        },
                        
                    },
                    messages: {
                        mname: {
                            required: "Please Select Material Name"
                        },
                        stock: {
                            required: "Enter material quantity",
                            digits: "Enter only digits",
                            minlength: "Quantity up to 2 digits are allowed"
                        },
                        
                    }
          });
        
  });
  
  
</script>
</head>

<body>
	<?php
		if($type=="Circle")
		{
			include "circleSbar.php";
		}
		else if($type=="div")
		{
			$uid=$_SESSION["uname"];
			include "divSbar.php";	
		}
		else
		{
			$uid=$_SESSION["uname"];
			include "subdivSbar.php";		
		}
	?>
    <div id="main" style="margin-left:300px;">
    	<?php include "storagehead.php"; ?>
        <div class="w3-row-padding" style="margin-top:32px;">
        	<div class="half">
            	<div class="container">
            		<div class="w3-card-2 w3-white w3-opacity-min padding-16">
                    <h4 align="center">Material Stock Entry</h4>
                    <div class="w3-container">
                        <form name="form3" id="form3" method="post" action="postmstorage.php">
                            <p>
                                <select name="matid" class="w3-select w3-round w3-border">
                                    <option selected>Select Materials</option>
                                    <?php
                                        $sql="Select * from materials";
                                        $result=mysqli_query($link,$sql);
                                        while($row=mysqli_fetch_array($result))
                                        {
                                            echo '<option value="'.$row[0].'">'.$row[1].'</option>';	
                                        }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <input type="hidden" name="dept" class="w3-input w3-round w3-border" value="<?php echo $dept; ?>">
                                <input type="hidden" name="dtype" class="w3-input w3-round w3-border" value="<?php echo $type; ?>">

                                <input type="text" name="stock" class="w3-input w3-round w3-border" placeholder="Quantity">
                            </p>
                            <p>
                                <input type="submit" name="submit" class="w3-btn w3-bar w3-round w3-red" value="Submit">
                            </p>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="half">
            	<div class="container">
            		<div class="w3-card-2 w3-white w3-opacity-min padding-16">
                    <h5 align="center">Materials Storage Records</h5>
                    <div class="container">
                    <?php
						$sql = "SELECT A.mname,B.stock FROM materials as A, storage as B where A.mid=B.mid and B.dept='$dept'";
						if($result = mysqli_query($link,$sql))
						{
							$rows = mysqli_fetch_all($result);
							mysqli_free_result($result);
							mysqli_close($link);
						}
					?>
                	<?php if(!empty($rows)){ ?>
                    <table class="w3-table-all">
                            <thead>
                              <tr>
                                <th>Material Name</th>
                                <th>Storage</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                   <tr>
                                     <td> <?php echo $row[0]; ?></td>
                                     <td> <?php echo $row[1]; ?></td>
                                   </tr>
                                <?php endforeach; ?>
                            </tbody>
                    <?php } else { ?> 
                    		       <tr>
                                     <td colspan="2" align="center">No Record</td>
                                   </tr>    
                    </table>
                	<?php } ?> 
                    </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
	if(isset($_GET["is_ok"]) )
	{
		echo '<script> alert("Material Stock Added"); </script>';	
	}
?>
