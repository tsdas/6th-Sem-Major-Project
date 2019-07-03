<div class="w3-sidebar w3-animate-left w3-opacity-min w3-indigo w3-padding w3-rightbar" style="width:300px;">
    <div class="w3-center">
        <img src="images/userico.jpg" class="circle" style="width:50%;"><br>
        Welcome <?php echo $uid; ?><br>
        <a href="logout.php?logout=true" class="w3-btn w3-round w3-red"><i class="fa fa-sign-out"></i> Logout</a>
        <hr>
    </div>
    <div class="bar-block">
        <a href="sdHome.php" class="bar-item button"><i class="fa fa-home menu-icon"></i> Sub-Division Home  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>

        <a href="mstorage.php?dept=<?php echo $divn; ?>&type=subdiv" class="bar-item button"><i class="fa fa-gear menu-icon"></i> Materials Storage  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>

        <a href="sdrequests.php?new=1" class="bar-item button"><i class="fa fa-list menu-icon"></i> Requisitions  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>

        <a onClick="repmenu();" class="bar-item button"><i class="fa fa-university menu-icon"></i> Repairing <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="rep" style="display:none;" class="w3-container w3-bar-block">
          <a href="newrepairing.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add New Repairing</a>
          <a href="viewrepairing.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Repairing</a>
          <a href="viewrepcost.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Repairing Cost</a>
        </div>

         <a onClick="pcmenu();" class="bar-item button"><i class="fa fa-plug menu-icon"></i> Power Cut <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="powercut" style="display:none;" class="w3-container w3-bar-block">
          <a href="powercut.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add Power Cut Details</a>
          <a href="viewpcut.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> ViewPower Cut Details</a>
        </div>

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
    function repmenu()
    {
        if(document.getElementById('rep').style.display=='none')
        {
            document.getElementById('rep').style.display='block';  
        }
        else
        {
            document.getElementById('rep').style.display='none';   
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
    function pcmenu()
    {
        if(document.getElementById('powercut').style.display=='none')
        {
            document.getElementById('powercut').style.display='block';  
        }
        else
        {
            document.getElementById('powercut').style.display='none';   
        }
    }
</script>