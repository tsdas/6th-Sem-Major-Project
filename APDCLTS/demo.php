<?php 
	

     require_once 'include/connect.php';
			$sql = "SELECT name FROM department WHERE type ='Division'";
            if($result = mysqli_query($link,$sql))
            {
                $rows = mysqli_fetch_all($result);

                mysqli_free_result($result);

            }

           /*  $sql1 = "SELECT name FROM department WHERE type ='Sub-Division'";
            if($result1 = mysqli_query($link,$sql1))
            {
                $rows1 = mysqli_fetch_all($result1);

                mysqli_free_result($result1);
                mysqli_close($link);

                //foreach ($rows as $row){
                   // print_r($row);
                //}
                

            }
            */
        
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<style>
	body{
		font-family: 'Montserrat', sans-serif;
		background-image:url(images/bgrd.jpg);
		background-repeat:no-repeat;
		background-size:100%;
	}
	label.error{
			color:#F00;	
			font-size:x-small;
		}
</style>
<script>
$(document).ready(function(){
    $("#division").change(function(){
        var x=$(this).val();
		var dept=x.replace(" ","+");
		//alert(dept);
		$("#subdivi").load("getsd.php?div="+dept);
    });
});
</script>
</head>

<body>
	<div class="w3-sidebar w3-opacity-min w3-card w3-blue w3-padding w3-center" style="width:300px;">
    	<img src="images/log in.png" style="width:50%;"><br>
        Welcome User<br>
        <a href="logout.php?logout=true" class="w3-btn w3-round w3-red"><i class="fa fa-sign-out"></i> Logout</a>
       <hr>
         <div class="w3-dropdown-hover">
            <button class="w3-button">Requisition <i class="fa fa-chevron-down"></i></button>
              <div class="w3-dropdown-content w3-bar-block w3-border" style="width:250px;">
                <a href="newreqs.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add New Requisition</a>
                <a href="viewreqs.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Requisitions</a>
              </div>
        </div>
        <hr>
        <div class="w3-dropdown-hover">
            <button class="w3-button">Load Shading <i class="fa fa-chevron-down"></i></button>
              <div class="w3-dropdown-content w3-bar-block w3-border" style="width:250px;">
                <a href="newpcut.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add Power-Cut Details</a>
                <a href="viewpcut.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Power-Cut Details</a>
              </div>
        </div>
    </div>
    
    <div class="w3-container" style="margin-left:300px">
    	<div class="w3-card-2 w3-white w3-opacity-min" style="width:60%; margin:120px auto">
        	<div class="w3-container">
            	<h3 align="center">New Requisition</h3>
            </div>
            <div class="w3-container w3-padding-16">
            	<form name="form3" id="form3" method="post" action="postrequis.php">
                	
                    <p>
                        <select id="division" name="division" class="w3-select w3-border w3-round-medium">

                        <option selected>Select Concern Division Name</option>

                        <?php foreach ($rows as $row) : ?>
                            <option value ="<?php echo $row[0]; ?>" >
                              <?php echo $row[0]; ?> 
                            </option>
                        <?php endforeach; ?>    
                            
                        </select>
                   </p>
                    <p>
                        <select  id="subdivi" name="subdivi" class="w3-select w3-border w3-round-medium">
							<option selected>Select Sub Division</option> 
                        </select>
                   </p>
                    <p>
                        <input type="text" name="lcdivi" class="w3-input w3-round w3-border" placeholder="Location Code of The Division">
                    </p>
                    <p>
                        <input type="text" name="lcode" class="w3-input w3-round w3-border" placeholder="Location Code of the Sub-Division">
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
