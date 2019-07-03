<div class="w3-sidebar w3-animate-left w3-opacity-min w3-indigo w3-padding w3-rightbar" style="width:300px;">
    <div class="w3-center">
        <img src="images/login.jpg" class="circle" style="width:45%;"><br>
        Welcome <?php echo $uid; ?><br>
        <a href="logout.php?logout=true" class="w3-btn w3-round w3-red"><i class="fa fa-sign-out"></i> Logout</a>
        <hr>
    </div>
    <div class="w3-bar-block">
        <a href="cgmHome.php" class="w3-bar-item w3-button left"><i class="fa fa-home menu-icon"></i> CGM Home  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>

        <a onClick="mmenu();" class="w3-bar-item w3-button"><i class="fa fa-gears menu-icon"></i> Material Master <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
            <div id="mat" style="display:none;" class="w3-container w3-bar-block">
                <a href="newmaterial.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add New Material</a>
                <a href="viewmaterials.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Materials</a>
            </div>

        <a onClick="supenu();" class="w3-bar-item w3-button"><i class="fa fa-shopping-cart menu-icon"></i> Supply <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
            <div id="smenu" style="display:none;" class="w3-container w3-bar-block">
                <a href="mCStore.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add Supplied Material</a>
                <a href="#" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Supplied Materials</a>
            </div>  

        <a onClick="reqmenu();" class="w3-bar-item w3-button"><i class="fa fa-list menu-icon"></i> Requisition <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
            <div id="sreq" style="display:none;" class="w3-container w3-bar-block">
                <a href="#" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Add New Requisition<i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
                 <a href="#" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> View Requisition <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
            </div>

        <a onClick="schmenu();" class="w3-bar-item w3-button"><i class="fa fa-wrench menu-icon"></i> Scheme <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
            <div id="scheme" style="display:none;" class="w3-container w3-bar-block">
                <a href="newscheme.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Add New Scheme<i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
                 <a href="viewscheme.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> View Scheme <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
            </div> 

        <a onClick="vedmenu();" class="w3-bar-item w3-button"><i class="fa fa-industry menu-icon"></i> Vendors <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
            <div id="mved" style="display:none;" class="w3-container w3-bar-block">
            <a href="newvendors.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Add New Vendors <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
             <a href="viewvendors.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> View Vendors <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
            </div> 
         
         <a href="mviewIssue.php" class="w3-bar-item w3-button left"><i class="fa fa-file-text-o menu-icon"></i> Issued Material List<i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
      
    </div>
</div>

<script>

    function reqmenu()
    {
        if(document.getElementById('sreq').style.display=='none')
        {
            document.getElementById('sreq').style.display='block';  
        }
        else
        {
            document.getElementById('sreq').style.display='none';   
        }
    }
    function schmenu()
    {
        if(document.getElementById('scheme').style.display=='none')
        {
            document.getElementById('scheme').style.display='block';    
        }
        else
        {
            document.getElementById('scheme').style.display='none'; 
        }
    }
    function mmenu()
    {
        if(document.getElementById('mat').style.display=='none')
        {
            document.getElementById('mat').style.display='block';   
        }
        else
        {
            document.getElementById('mat').style.display='none';    
        }
    }
    function supenu()
    {
        if(document.getElementById('smenu').style.display=='none')
        {
            document.getElementById('smenu').style.display='block'; 
        }
        else
        {
            document.getElementById('smenu').style.display='none';  
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

</script>