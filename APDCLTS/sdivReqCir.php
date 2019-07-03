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

	// if(isset($_GET["rno"]))
 //    {
 //        $rno=$_GET["rno"];
 //        $sql="Update requisition set status='Pending' where rno='$rno'";
 //        mysqli_query($link,$sql);   
 //    }
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
	<?php include "circleSbar.php"; ?>
    <div style="margin-left:300px;">
    	<div class="w3-container w3-indigo w3-right-align w3-opacity-min w3-bottombar">
        	<div class="w3-left">
            	<h3 class="topbar w3-border-bottom">Jorhat Electrical Circle Dashboard</h3>
            </div>
            <div class="w3-right">
            	<h3 class="topbar w3-border-bottom">Materials Management System</h3>
            </div>
        </div>
        <?php 
			$div=$_GET["div"];
			$sdiv=array();
			$str="Select name from department where cdivision='$div'";
			$result=mysqli_query($link,$str);
			$i=0;
			while($row=mysqli_fetch_array($result))
			{
				$sdiv[$i]=$row[0];	
				$i++;
			}
		?>
       
        <div class="row-padding padding-16">
        	<div class="third">
            	<?php
            			require_once("fusioncharts.php");
						$sd=$sdiv[0];
						$str="Select A.*,SUM(quantity) as quantity,C.mname from requisition as A,reqdetails as B,materials as C where A.sdiv='$sd' and B.mid=C.mid and A.rno=B.rno GROUP BY B.mid";
						$result = mysqli_query($link,$str);
                		if($result){
									$arrChartConfig = array(
										"chart" => array(
											"caption" => "Requisition Materials Report",
											"subCaption" => $sd,
											"xAxisName" => "Materials",
											"yAxisName" => "Quantity",
											"numberSuffix" => "",
											"theme" => "zune"
										)
									);
									
									$arrChartData = array();
									$n=0;
									while($row=mysqli_fetch_array($result))
									{
										$mat=$row["mname"];
										$stock=$row["quantity"];
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
								$Chart = new FusionCharts("column2d", "MyFirstChart" , "100%", "400", "chart-container", "json", $jsonEncodedData);
								// Render the chart
								$Chart->render();
				
								//$dbhandle->close();
							}
					?>
					
					<div id="chart-container">Chart will render here!</div>
                    
            </div>
            <div class="third">
            	<?php
						$sd=$sdiv[1];
						$str="Select A.*,SUM(quantity) as quantity,C.mname from requisition as A,reqdetails as B,materials as C where A.sdiv='$sd' and B.mid=C.mid and A.rno=B.rno GROUP BY B.mid";
						$result = mysqli_query($link,$str);
                		if($result){
									$arrChartConfig = array(
										"chart" => array(
											"caption" => "Requisition Materials Report",
											"subCaption" => $sd,
											"xAxisName" => "Materials",
											"yAxisName" => "Quantity",
											"numberSuffix" => "",
											"theme" => "fint"
										)
									);
									
									$arrChartData = array();
									$n=0;
									while($row=mysqli_fetch_array($result))
									{
										$mat=$row["mname"];
										$stock=$row["quantity"];
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
								$Chart = new FusionCharts("column2d", "MyFirstChart2" , "100%", "400", "chart-container2", "json", $jsonEncodedData);
								// Render the chart
								$Chart->render();
				
								//$dbhandle->close();
							}
					?>
					
					<div id="chart-container2">Chart will render here!</div>
                    
            </div>
            <div class="third">
            	<?php
						$sd=$sdiv[2];
						$str="Select A.*,SUM(quantity) as quantity,C.mname from requisition as A,reqdetails as B,materials as C where A.sdiv='$sd' and B.mid=C.mid and A.rno=B.rno GROUP BY B.mid";
						$result = mysqli_query($link,$str);
                		if($result){
									$arrChartConfig = array(
										"chart" => array(
											"caption" => "Requisition Materials Report",
											"subCaption" => $sd,
											"xAxisName" => "Materials",
											"yAxisName" => "Quantity",
											"numberSuffix" => "",
											"theme" => "zune"
										)
									);
									
									$arrChartData = array();
									$n=0;
									while($row=mysqli_fetch_array($result))
									{
										$mat=$row["mname"];
										$stock=$row["quantity"];
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
								$Chart = new FusionCharts("column2d", "MyFirstChart3" , "100%", "400", "chart-container3", "json", $jsonEncodedData);
								// Render the chart
								$Chart->render();
				
								//$dbhandle->close();
							}
					?>
					
					<div id="chart-container3">Chart will render here!</div>
                    
            </div>
        </div>
    </div>
</body>
</html>

<!-- <?php
	// if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 1)
	// {
	// 	echo '<script> alert("Divison or SubDivision Added Successfully"); </script>';	
	// }
	// if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 2)
	// {
	// 	echo '<script> alert("Material Added Successfully"); </script>';	
	// }
	// if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 3)
	// {
	// 	echo '<script> alert("User Added Successfully"); </script>';	
	// }
	// if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 4)
	// {
	// 	echo '<script> alert("Vendor Added Successfully"); </script>';	
	// }
	// if(isset($_GET["is_ok"]) and $_GET['is_ok'] == 5)
	// {
	// 	echo '<script> alert("Purchase Material Successfully"); </script>';	
	// }
?> -->
<!-- <script>
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
</script> -->