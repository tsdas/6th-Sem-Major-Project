<?php

require_once 'include/connect.php';

if(isset($_POST["division"])){
  
    $division = $_POST["division"];
     
  
  $sql = "SELECT name FROM department WHERE cdivision = $division";
            if($result = mysqli_query($link,$sql))
            {
                $rows = mysqli_fetch_all($result);

                mysqli_free_result($result);
                

                //foreach ($rows as $row){
                   // print_r($row);
                //}

            }
     
    // Display city dropdown based on country name
    if($country !== 'Select'){
       
        foreach($rows as $row){
            echo "<option>". $row . "</option>";
        }
        echo "</select>";
    } 
}
?>