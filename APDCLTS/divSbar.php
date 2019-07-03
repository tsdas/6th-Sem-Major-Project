<div class="w3-sidebar w3-animate-left w3-opacity-min w3-indigo w3-padding w3-rightbar" style="width:300px;">
    <div class="w3-center">
        <img src="images/userico.jpg" class="circle" style="width:50%;"><br>
        Welcome <?php echo $uid; ?><br>
        <a href="logout.php?logout=true" class="w3-btn w3-round w3-red"><i class="fa fa-sign-out"></i> Logout</a>
        <hr>
    </div>
    <div class="bar-block">
        <a href="divisionHome.php" class="bar-item button"><i class="fa fa-home menu-icon"></i> Division Home  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        <a href="mstorage.php?dept=<?php echo $divn; ?>&type=div" class="bar-item button"><i class="fa fa-gear menu-icon"></i> Materials Storage  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>     
        
        <div class="dropdown-hover">
        	<a href="#" class="bar-item button"><i class="fa fa-list menu-icon"></i> Requisition  <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
            <div class="dropdown-content bar-block">
            	<a href="requestRdiv.php" class="bar-item button"><i class="fa fa-pencil-square-o menu-icon"></i> Requisition Received</a>
                <a href="sdrequests.php?new=1" class="bar-item button"><i class="fa fa-pencil-square menu-icon"></i> Requisition Sent</a>
            </div>
        </div>
        
        <a href="sdivReqGra.php" class="bar-item button"><i class="fa fa-line-chart menu-icon"></i> Requisition Report <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        
        <a href="mviewIssue.php" class="bar-item button"><i class="fa fa-file-text-o menu-icon"></i>Issued Material List <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        
    </div>
</div>

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