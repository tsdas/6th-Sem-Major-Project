<?php
	session_start();
	include "include/connect.php";
	$reqno=$_POST["reqno"];
	if(!isset($_POST["mat"]))
	{
		header("location:viewRdetailsCir.php?selected=null&id=".$reqno);
		return;	
	}
	
	if(isset($_POST["submit1"]))
	{
		$idate=date("Y-m-d");
		$sdiv=$_POST["sdiv"];
		$divn=$_POST["division"];
		
		//insert into issue table
		/*$str1="Select rno from issue where rno='$reqno' and status='New'";
		$result=mysqli_query($link,$str1);
		$n=mysqli_num_rows($result);
		
		if($n==0)
		{
			$sql="insert into issue values(null,'$idate','$reqno','$divn','$sdiv',null,'New')";
			$result=mysqli_query($link,$sql);
			$str2="Select last_insert_id()";
			$rec2=mysqli_query($link,$str2);
			$row=mysqli_fetch_array($rec2);
			$issueid=$row[0];
		}
		else
		{
			$rows=mysqli_fetch_array($result);
			$issueid=$rows[0];	
		}*/
		
		$mats=$_POST["mat"];
		$n=count($mats);
		
		$iqty=$_POST["iqty"];
		
		$i=0;
		$x=0;
		foreach($iqty as $iq)
		{
			//echo $iq.' ';
			if($iq!=0)
			{
				$mid=$mats[$i];
				//submit data to issuedetails table
				$str3="insert into issuedetails values(null,'$idate','$reqno','$mid','$iq','Issued','$divn','$sdiv')";
				mysqli_query($link,$str3);
				
				//update status on reqdetails
				$str5="Update reqdetails set status='Issued' where rno='$reqno' and mid='$mid'";
				mysqli_query($link,$str5);
				
				//update division storge stock
				$str6="Select stock from storage where dept='Circle' and mid='$mid'";
				$rs=mysqli_query($link,$str6);
				$r=mysqli_fetch_array($rs);
				$q=$r[0];
				$q=$q-$iq;
				$str7="Update storage set stock='$q' where dept='Circle' and mid='$mid'";
				mysqli_query($link,$str7); 
				//$x=1;
				
				//echo "ok";
			}
			else
			{
				$x=1;	
			}
			
			$i++;
		}
		if($x==1)
		{
			header("location:viewRdetailsCir.php?qty=null&id=".$reqno);
			return;	
		}
		else
		{
			header("location:viewRdetailsCir.php?ok=1&id=".$reqno);
		}
		
	}

	if(isset($_POST["submit2"]))
	{
		$mats=$_POST["mat"];
		$divn=$_POST["division"];
		$rqty=$_POST["rqty"];
		$i=0;
		$c=0;
		foreach($mats as $mid)
		{
			$rq=$rqty[$i];
			$str="Select stock from storage where mid='$mid' and dept='Circle'";
			$rec=mysqli_query($link,$str);
			$nor=mysqli_num_rows($rec);
			$x=0;
			if($nor==0)
			{
				$x=0;	
			}
			else
			{
				$row=mysqli_fetch_array($rec);
				$x=$row[0];
			}
			if($x>$rq)
			{
				$c=1;	
			}
			else
			{
				$str5="Update reqdetails set status='C Store' where rno='$reqno' and mid='$mid'";
				mysqli_query($link,$str5);
				header("location:viewRdetailsCir.php?is_ok&id=".$reqno);
			}
		}
		if($c==1)
		{
			header("location:viewRdetailsCir.php?cstore=error&id=".$reqno);
		}
	}
?>