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

   
            //$sql="Select A.*,B.mname,C.idate,C.vendor from purchasedetails as A,materials as B,purchase as C where A.mid=B.mid and A.invoiceno=C.invoiceno";
			
            /*if($result = mysqli_query($link,$sql))
            {
                $rows = mysqli_fetch_array($result);

                mysqli_free_result($result);
                mysqli_close($link);

            }*/
        
    
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
  h3{
    font-family: 'Concert One', cursive;
  }
</style>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
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
<div id="main" style="margin-left:300px">
    <div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
      <div class="w3-container w3-indigo w3-right-align w3-opacity-min">
          	<div class="w3-left">
              <h3 class="topbar w3-border-bottom"><?php echo $divn; ?> Dashboard</h3>
            </div>
            <div class="w3-right">
              <h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
      </div>
    </div>
    
  
    	<div class="w3-card-2 w3-white w3-opacity-min" style="width:90%; margin:32px auto">
        	<div class="w3-container">
              <div class="left"><h3 class="bottombar">View Supply Details Details</h3></div>
                <div class="right" style="padding-top:16px;"><a href="mCStore.php" class="btn black round small text-white"><i class="fa fa-plus-square"></i> Add New</a></div>
            </div>
            <div class="w3-container">
            	<form id="form1" method="post" action="viewsupply.php">
                	<div class="w3-left" style="width:180px;">
                    	<input type="text" id="Datepicker1" name="pdate" class="input border" placeholder="Select Date">
                    </div>
                  	<div class="w3-left">
                    	<input type="submit" name="search" class="btn red small round" value="Go" style="height:40px;">
                    </div>
                    <div class="w3-left" style="width:180px; margin-left:3px;">
                    	<Select name="mname" class="select border">
                        	<option disabled selected>Select Material</option>
                            <?php
                             $sql = "Select * from materials";
                             $result =mysqli_query($link,$sql);
                             while($row=mysqli_fetch_array($result))
                             {
                             	echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                             }
                            ?>
                        </Select>
                    </div>
                  	<div class="w3-left">
                    	<input type="submit" name="search1" class="btn red small round" value="Go" style="height:40px;">
                    </div>
                    <div class="w3-left" style="margin-left:3px;">
                    	<input type="submit" name="refresh" class="btn red small round" value="Refresh" style="height:40px;">
                    </div>
                </form>
            </div>
          <div class="w3-container w3-padding-16">
                <?php //if(!empty($rows)): ?>

                    <table class="w3-table-all">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Material Name</th>
                                <th>Scheme Name</th>
                                <th>Quantity</th>
                                <th>Vendor Name</th>
                              </tr>
                            </thead>
                            <tbody>
            <?php
									if(isset($_POST["search"]) and $_SESSION["utype"]=="Central Store")
									{
										$date=mysqli_real_escape_string($link,$_POST["pdate"]);
										$sdate=date("Y-m-d",strtotime($date));
										$sql="Select A.*,B.mname,C.scname,D.name from msupply as A,materials as B,scheme as C,vendors as D where A.sdate='$sdate' and A.mid=B.mid and A.scheme=C.scid and A.vendor=D.vid and A.dept='Central Store'";	
									}
                  elseif(isset($_POST["search"]) and $_SESSION["utype"]=="CGM")
                  {
                    $date=mysqli_real_escape_string($link,$_POST["pdate"]);
                    $sdate=date("Y-m-d",strtotime($date));
                    $sql="Select A.*,B.mname,C.scname,D.name from msupply as A,materials as B,scheme as C,vendors as D where A.sdate='$sdate' and A.mid=B.mid and A.scheme=C.scid and A.vendor=D.vid and A.dept='CGM'";
                  }
									else if(isset($_POST["search1"]) and $_SESSION["utype"]=="Central Store")
									{
										$matid=$_POST["mname"];
										$sql="Select A.*,B.mname,C.scname,D.name from msupply as A,materials as B,scheme as C,vendors as D where A.mid='$matid' and A.mid=B.mid and A.scheme=C.scid and A.vendor=D.vid and A.dept='Central Store'";	
									}
                  else if(isset($_POST["search1"]) and $_SESSION["utype"]=="CGM")
                  {
                    $matid=$_POST["mname"];
                    $sql="Select A.*,B.mname,C.scname,D.name from msupply as A,materials as B,scheme as C,vendors as D where A.mid='$matid' and A.mid=B.mid and A.scheme=C.scid and A.vendor=D.vid and A.dept='CGM'";  
                  }
									else if($_SESSION["utype"]=="Central Store")
									{
										$sql="Select A.*,B.mname,C.scname,D.name from msupply as A,materials as B,scheme as C,vendors as D where A.mid=B.mid and A.scheme=C.scid and A.vendor=D.vid and A.dept='Central Store'";	
									}
                  else
                  {
                   $sql="Select A.*,B.mname,C.scname,D.name from msupply as A,materials as B,scheme as C,vendors as D where A.mid=B.mid and A.scheme=C.scid and A.vendor=D.vid and A.dept='CGM'"; 
                  }
									
									$result=mysqli_query($link,$sql);
									while($row=mysqli_fetch_array($result))
									{
								?>
                                   <tr>
                                     <td> <?php echo $row[1]; ?></td>
                                     <td> <?php echo $row["mname"]; ?></td>
                                     <td> <?php echo $row["scname"]; ?></td>
                                     <td> <?php echo $row[4]; ?></td>
                                    <td> <?php echo $row["name"]; ?></td>
                                     

                                   </tr>
                                <?php } ?>
                            </tbody>  
                    </table>
            </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
	$( "#Datepicker1" ).datepicker(); 
});
</script>
</body>
</html>