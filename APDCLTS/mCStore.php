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

    $sql="Select usertype from users where userid='$uid'";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_array($result);
    $utype=$row[0];

    //from
    
    $str = "SELECT * from storage where dept='$utype'"; 
    $result = mysqli_query($link,$str);
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
    

          $("#form3").validate({
                    rules: {
                        sdate: {
                            required: true
                        },
                        scid: {
                            required: true
                        },
                        mid: {
                            required: true
                        },
                         quantity: {
                            required: true,
                            digits:true,
                            minlength:1,
                            maxlength:2
                        },
                         details: {
                            required: true
                        },
                         vendid: {
                            required: true
                        },
                         warranty: {
                            required: true
                        }
                        
                    },
                    messages: {
                        sdate: {
                            required: "Please Select Supplied Date"
                        },
                        scid: {
                            required: "Please Select Scheme Name"
                        },
                         mid: {
                            required: "Please Select Material Name"
                        },
                         quantity: {
                            required: "Please Enter Quantity",
                            digits: "Enter only digits",
                            minlength: "Quantity up to 2 digits are allowed"

                        },
                         details: {
                            required: "Please Enter Details"
                        },
                         vendid: {
                            required: "Please Select Vendor Name"
                        },
                        warranty: {
                            required: "Please Enter Warranty"
                        }
                     
                    }
          });
          
  });

</script>
</head>

<body>
    <?php
        if($_SESSION["utype"]=="Central Store")
        {
            include "cstoresbar.php";   
        }
        else
        {
            include "cgmSbar.php"; 
        }
        
    ?>
  <div  style="margin-left:300px;">
		 <div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
		    <div class="w3-left">
		        <h3 class="topbar w3-border-bottom"><?php echo $divn; ?> Dashboard</h3>
		    </div>
		    <div class="w3-right">
		        <h3 class="topbar w3-border-bottom">Materials Management System</h3>
		  </div>
	   </div>
        <div class="w3-row-padding" style="margin-top:32px;">
        	<div class="half">
            	<div class="container">
            		<div class="w3-card-2 w3-white w3-opacity-min padding-16">
                    <h4 align="center">Materials Purchase Entry</h4>
                    <div class="w3-container">
                        <form name="form3" id="form3" method="post" action="postmCStore.php">

                            <p>
                                <input type="text" id="sdate" name="sdate" class="w3-input w3-round w3-border" placeholder="Purchase Date">
                           </p>
                            <p>
                                <select name="scid" class="w3-select w3-round w3-border">
                                    <option selected>Select Schemes</option>
                                    <?php
                                        $sql="Select * from scheme";
                                        $result=mysqli_query($link,$sql);
                                        while($row=mysqli_fetch_array($result))
                                        {
                                            echo '<option value="'.$row[0].'">'.$row[1].'</option>';    
                                        }
                                    ?>
                                </select>
                            </p>
                           <p>
                                <select name="mid" class="w3-select w3-round w3-border">
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
                                <input type="text" name="quantity" class="w3-input w3-round w3-border" placeholder="Quantity">
                            </p>
                             <p>
                                <input type="text" name="details" class="w3-input w3-round w3-border" placeholder="Details">
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
                                <input type="text" name="warranty" class="w3-input w3-round w3-border" placeholder="Warranty">
                            </p>
                            <!--p>
                                <select name="dept" class="w3-select w3-round w3-border">
                                    <option selected>Select Department</option>
                                       <option>Central Store</option>
                                       <option>CGM</option>
                                </select>
                            </p-->
                            <input type="hidden" name="dept" class="w3-input w3-round w3-border" value="<?php echo $utype; ?>">
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
                    <h5 align="center">Materials Storage Record</h5>
                    <div class="container">
                    <?php
						$sql = "SELECT A.mname,B.stock FROM materials as A, storage as B where A.mid=B.mid and B.dept='$utype'";
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

<script>
    
    $(function() {
    $( "#sdate" ).datepicker(); 
    });
    
</script>
<?php
    if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 2)
    {
        echo '<script> alert("Material Added"); </script>';   
    }
    ?>