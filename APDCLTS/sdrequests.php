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
	$sdiv=$row[0];
	$rno=0;
	
	if(isset($_GET["new"]))
	{
		$sql="Select cdivision from department where name='$sdiv'";
		$result=mysqli_query($link,$sql);
		$row=mysqli_fetch_array($result);
		$divn=$row[0];	
		$rdate=date("Y-m-d");
		
		$str1="Select rno from requisition where sdiv='$sdiv' and status='New'";
		$result=mysqli_query($link,$str1);
		$n=mysqli_num_rows($result);
		
		if($n==0)
		{
			$str="insert into requisition values(null,'$rdate','$divn','$sdiv','New')";
			$rec=mysqli_query($link,$str);
			$str2="Select last_insert_id()";
			$rec2=mysqli_query($link,$str2);
			$row=mysqli_fetch_array($rec2);
			$rno=$row[0];
		}
		else
		{
			$rows=mysqli_fetch_array($result);
			$rno=$rows[0];	
		}
	}
	
	if(isset($_GET["rno"]))
	{
		$rno=$_GET["rno"];
	}
	if(isset($_GET["rno"]) and isset($_GET["matid"]))
	{
		$rno=$_GET["rno"];
		$mid=$_GET["matid"];

		$sql="delete from reqdetails where mid='$mid'";
		mysqli_query($link,$sql);
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
                        material: {
                            required: true
                        },
                        qty: {
                            required: true,
                            digits:true
                        }
                        
                        
                    },
                    messages: {
                        material: {
                            required: "Enter Vendor Name"
                        },
                        qty: {
                            required: "Please Enter Quantity",
                            digits: "Enter only digits"
                        }
                        
                    }
          });
          
  });

</script>
</head>

<body>
	<?php 
        if($_SESSION["utype"]=="Sub-Division")
        {
            include "subdivSbar.php"; 
        }
        else if($_SESSION["utype"]=="Division")
        {
            include "divSbar.php";   
        }
        else
        {
            include "circleSbar.php"; 
        }
        
    ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom"><?php echo $sdiv; ?> Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
        
        <div class="container card-2 white round" style="width:80%; margin:32px auto;">
        	<div class="w3-container">
            	<h4 align="center">REQUISITION ENTRY</h4>
            </div>
            <div class="w3-container w3-padding-16 small">
            	<form name="form1" id="form1" method="post" action="prorequest.php">
            		<p>
                    	<input type="hidden" name="rno" class="w3-input w3-round w3-border" value="<?php echo $rno; ?>">
                    </p>
                    <p>
                    	<select name="material" class="w3-select w3-round w3-border">
                        	<option selected="selected">Select Material</option>
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
                    	<input type="text" name="qty" class="w3-input w3-round w3-border" placeholder="Enter Quantity">
                    </p>
                    <p>
                    	<input type="submit" name="submit" class="w3-btn w3-bar w3-round w3-red" value="Add to List">
                    </p>
                </form>
            </div>
        </div>
        
        <div class="container card-2 white round" style="width:80%; margin:32px auto;">
        	<div class="container">
            	<h4 align="center">List of Requested Materials</h4>
            </div>
            <div class="container padding-16">
            	<table class="table-all">
                    <thead>
                        <th>Material ID</th>
                        <th>Material Name</th>
                        <th>Quantity</th>
                        <th width="10%">Action</th>
                    </thead>
                    <tbody>
						<?php
                            $sql="Select A.*,B.mname from reqdetails as A,materials as B where A.rno='$rno' and A.mid=B.mid";
                            $result=mysqli_query($link,$sql);
							$count=0;
                            while($row=mysqli_fetch_array($result))
                            {
                                echo '<tr>';
                                echo '<td>'.$row["mid"].'</td>';
                                echo '<td>'.$row["mname"].'</td>';
                                echo '<td>'.$row["quantity"].'</td>';
                                echo '<td><a href="sdrequests.php?rno='.$row[0].'&matid='.$row["mid"].'" class="btn red round small">Delete</a></td>';
                                echo '</tr>';
								$count++;	
                            }
                        ?>
                    </tbody>
               </table>
               <p>
               		<?php
                    	if($count>0 and $_SESSION["utype"]=="Sub-Division")
						{
							echo '<a href="sdHome.php?request=sent&rno='.$rno.'" class="btn block green">Confirm Now</a>';
						}
						else if($count>0 and $_SESSION["utype"]=="Division")
						{
							echo '<a href="divisionHome.php?request=sent&rno='.$rno.'" class="btn block green">Confirm Now</a>';
						}
						else
						{
							echo '<a href="circleHome.php?request=sent&rno='.$rno.'" class="btn block green">Confirm Now</a>';
						}
					?>
               </p>
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
</script>