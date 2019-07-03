<div class="w3-sidebar w3-animate-left w3-opacity-min w3-indigo w3-padding w3-rightbar" style="width:300px;">
    <div class="w3-center">
        <img src="images/login.jpg" class="circle" style="width:45%;"><br>
        Welcome <?php echo $uid; ?><br>
        <a href="logout.php?logout=true" class="w3-btn w3-round w3-red"><i class="fa fa-sign-out"></i> Logout</a>
        <hr>
    </div>
    <div class="w3-bar-block">
        <a href="circleHome.php" class="w3-bar-item w3-button left"><i class="fa fa-home menu-icon"></i> Circle Home  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>

        <a onClick="deptmenu();" class="w3-bar-item w3-button"><i class="fa fa-university menu-icon"></i> Departments <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="mdept" style="display:none;" class="w3-container w3-bar-block">
          <a href="newdept.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Add New Department</a>
          <a href="viewdept.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Departments</a>
        </div>

        <a onClick="matmenu();" class="w3-bar-item w3-button"><i class="fa fa-gears menu-icon"></i> Materials <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="mmat" style="display:none;" class="w3-container w3-bar-block">
          <a href="newmaterial.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Material Master</a>
          <a href="viewmaterials.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> View Materials</a>
          <a href="mstorage.php?dept=Circle&type=Circle" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Material Storage</a>
          <a href="mviewIssue.php" class="w3-bar-item w3-button"><i class="fa fa-hand-o-right"></i> Issued Materials</a>
         
        </div>

        <a onClick="purmenu();" class="w3-bar-item w3-button"><i class="fa fa-shopping-cart menu-icon"></i> Purchase <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="mpur" style="display:none;" class="w3-container w3-bar-block">
        <a href="mpurchase.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Add Purchase Details<i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
         <a href="viewpurchase.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> View Purchase Details <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        </div>

        <a onClick="usermenu();" class="w3-bar-item w3-button"><i class="fa fa-user-circle menu-icon"></i> Users <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="user" style="display:none;" class="w3-container w3-bar-block">
        <a href="createuser.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Create Users<i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
         <a href="viewusers.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> View Users <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        </div>
<!-- 
        <a href="createuser.php" class="w3-bar-item w3-button left"><i class="fa fa-user-circle menu-icon"></i> Create User  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a> -->

        <a onClick="vedmenu();" class="w3-bar-item w3-button"><i class="fa fa-industry menu-icon"></i> Vendors <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="mved" style="display:none;" class="w3-container w3-bar-block">
        <a href="newvendors.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Add New Vendors <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
         <a href="viewvendors.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> View Vendors <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        </div>

        <a onClick="reqmenu();" class="w3-bar-item w3-button"><i class="fa fa-list menu-icon"></i> Requisition <i class="fa fa-caret-down w3-right" style="padding-top:5px;"></i></a>
        <div id="req" style="display:none;" class="w3-container w3-bar-block">
        <a href="requestRcircle.php" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i>View Requisition <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
         <a href="sdrequests.php?new=1" class="w3-bar-item w3-button left"><i class="fa fa-hand-o-right"></i> Sent Requisition <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
        </div>

        <!-- <a href="requestRcircle.php" class="w3-bar-item w3-button left"><i class="fa fa-list menu-icon"></i> View Requisition <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a> -->
         <a href="notice.php" class="w3-bar-item w3-button left"><i class="fa fa-newspaper-o menu-icon"></i> Add Notice  <i class="fa fa-caret-right w3-right" style="padding-top:5px;"></i></a>
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
   function purmenu()
  {
    if(document.getElementById('mpur').style.display=='none')
    {
      document.getElementById('mpur').style.display='block';  
    }
    else
    {
      document.getElementById('mpur').style.display='none'; 
    }
  }
  function usermenu()
  {
    if(document.getElementById('user').style.display=='none')
    {
      document.getElementById('user').style.display='block';  
    }
    else
    {
      document.getElementById('user').style.display='none'; 
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
  function reqmenu()
  {
    if(document.getElementById('req').style.display=='none')
    {
      document.getElementById('req').style.display='block';  
    }
    else
    {
      document.getElementById('req').style.display='none'; 
    }
  }
  
</script>