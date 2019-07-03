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

   /* if(isset($_GET["rno"]))
    {
        $rno=$_GET["rno"];
        $sql="Update requisition set status='Pending' where rno='$rno'";
        mysqli_query($link,$sql);   
    }*/
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
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts/js/fusioncharts.charts.js"></script>
<script type="text/javascript" src="fusioncharts/js/fusioncharts.gantt.js"></script>
<script type="text/javascript" src="fusioncharts/js/fusioncharts.powercharts.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.zune.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.carbon.js"></script>

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
</head>

<body>
	<?php include "divSbar.php"; ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom"><?php echo $divn; ?> Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
        
        <div class="container" style="width:90%; margin:16px auto;">
            <h3 align="center" class="bottombar">Sub Division Wise Materials Stock Details</h3>
            <form id="form1" method="post" action="sdivStock.php">
            	<p>
            	<Select name="sdiv" class="select border">
                	<option disabled selected>Select Sub Division</option> 
					<?php
                        $str="Select name from department where cdivision='$divn'";
                        $result=mysqli_query($link,$str);
                        while($row=mysqli_fetch_array($result))
						{
							echo '<option>'.$row[0].'</option>';	
						}
                    ?>
                </Select>
                </p>
                <p align="right">
                	<input type="submit" name="submit" value="Search Record" class="btn red">
                </p>
            </form>
            <div class="container card-2 white padding-16">
            	<?php
                    require_once("fusioncharts.php");
					if(isset($_POST["submit"]))
					{
						$sdiv=$_POST["sdiv"];
						$str="Select A.*,B.mname from storage as A,materials as B where A.dept='$sdiv' and A.mid=B.mid";
						$result = mysqli_query($link,$str);
                	
                		if($result){
									$arrChartConfig = array(
										"chart" => array(
											"caption" => "Materials Stock Report",
											"subCaption" => $sdiv,
											"xAxisName" => "Materials",
											"yAxisName" => "Stock",
											"numberSuffix" => "",
											"theme" => "zune"
										)
									);
									
									$arrChartData = array();
									$n=0;
									while($row=mysqli_fetch_array($result))
									{
										$mat=$row["mname"];
										$stock=$row["stock"];
										$arrChartData[$n][0]=$mat;
										$arrChartData[$n][1]=$stock;
										$n++;	
									}
									
				
								$arrLabelValueData = array();

								// Pushing labels and values
								for($i = 0; $i < count($arrChartData); $i++) {
									array_push($arrLabelValueData, array(
										"label" => $arrChartData[$i][0], "value" => $arrChartData[$i][1]
									));
								}
							
								$arrChartConfig["data"] = $arrLabelValueData;
							
								// JSON Encode the data to retrieve the string containing the JSON representation of the data in the array.
								$jsonEncodedData = json_encode($arrChartConfig);
							
								// chart object
								//$Chart = new FusionCharts("line", "MyFirstChart" , "700", "400", "chart-container", "json", $jsonEncodedData);
								$Chart = new FusionCharts("pie2d", "MyFirstChart" , "100%", "400", "chart-container", "json", $jsonEncodedData);
								// Render the chart
								$Chart->render();
				
								//$dbhandle->close();
							}
					}
					?>
					
					<div id="chart-container">Chart will render here!</div>
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
