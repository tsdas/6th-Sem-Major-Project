<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>APDCL</title>
<link href="css/w3.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	body{
		font-family: 'Montserrat', sans-serif;
		background-image:url(images/newbg.jpg);
		background-repeat:no-repeat;
		background-size:100%;
	}
	label.error{
			color:#F00;	
			font-size:x-small;
	}
	.login{
		font-family: 'Concert One', cursive;
	}
</style>
</head>

<body>
<div class="w3-row-padding" style="margin-top:130px;">
	<div class="w3-half w3-center">
    	<img src="images/logo.png" class="w3-circle w3-card-2" style="width:25%;"><br>
        <span class="w3-jumbo w3-text-blue" style="text-shadow:2px 2px #FFCC00"><strong>APDCL</strong></span><br>
      <span class="w3-xlarge w3-text-brown" style="text-shadow:2px 2px #FFFF33"><strong>MATERIALS STOCK MANAGEMENT PORTAL</strong></span><br><br>
        <a onclick="document.getElementById('id01').style.display='block'"><input type="button" name="button" id="button" value="Enter Now" class="w3-button w3-round w3-red w3-hover-yellow w3-card"></a>
    </div>
    <div class="w3-half w3-center" style="text-shadow:2px 2px #FFFF33">
    	LATEST NEWS AND UPDATES
    	<div class="w3-container w3-border w3-white w3-opacity-min" style="width:60%; height:450px; margin:0 auto; overflow-y: scroll;">
        	<?php
        include "include/connect.php";
        $str="Select * from notice order by id desc";
        $result=mysqli_query($link,$str);
        while($row=mysqli_fetch_array($result))
        {
          echo '<p class="w3-border-bottom w3-border-indigo w3-tiny" align="left" style="padding-bottom:4px;">
              <span class="w3-text-red">Posted On: '.$row["ndate"].'</span><br>
              <strong class="w3-animate-fading-fast">'.$row["header"].'</strong><br>
              '.$row["details"].'
            </p>';  
        }
      ?>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div id="id01" class="w3-modal">
<div class="w3-modal-content w3-animate-top" style="width:350px;">
  <div class=" w3-card-4 w3-indigo w3-opacity-min">
    <span onclick="document.getElementById('id01').style.display='none'" 
    class="w3-button w3-display-topright">&times;</span>
    <div class="w3-container w3-center" style="padding-top:16px;">
          <img src="images/log in.png" class="w3-white w3-circle w3-card" style="width:25%;"/><br>
          <span class="w3-large login"><strong>User Login</strong></span>
          <hr>
    </div>
    <div class="w3-container w3-small">
        <form name="form1" id="form1" method="post" action="login.php">
          <p style="margin-top:0">
              <select name="usertype" class="w3-select w3-border w3-round-medium">
              	<option selected>Select User Type</option>
                <option>Circle</option>
                <option>Division</option>
                <option>Sub-Division</option>
                <option>Central Store</option>
                <option>CGM</option>

              </select>
          </p>
          <p>
              <input type="text" name="username" class="w3-input w3-border w3-round-medium" placeholder="User Name">
          </p>
          <p>
              <input type="password" name="password" class="w3-input w3-border w3-round-medium" placeholder="Password">
          </p>
          <p>
              <input type="submit" name="login" class="w3-btn w3-block w3-black w3-round" value="Login">
          </p>
         <!--  <p align="right">
              Forgot Password? Click Here
          </p> -->
        </form>
    </div>
  </div>
</div>
</div>
</body>
</html>
<?php
	if(isset($_GET["err"]))
	{
		echo '<script> alert("Incorrect Username or password"); </script>';	
	}
?>