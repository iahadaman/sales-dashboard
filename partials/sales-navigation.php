<nav class="navbar">
    <div class="container-fluid">
        <div class="row">
           <!--  <div class="col-md-2 col-sm-2 pl-0">
                <button type="button" id="sidebarCollapse" class="btn btn-color">
                <i class="fas fa-align-left"></i>
                </button>     
            </div> -->
            <div class="greeting col-md-12 col-sm-12 mt-2 pl-0">
               <p>Welcome to <strong>Sales Portal!</strong></p>
            </div>                
        </div>
    <div>                                       
    <div class="nav-item dropdown">
        <a class="nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><strong class="profile-name"><?php echo $_SESSION['client_name']; ?>&nbsp&nbsp<i class="fa fa-caret-down"></i></strong>
        </a>         

             <?php
                 include 'backend/connection.php';
                  $userid = $_SESSION['client_id'];
                  $getUserId = mysqli_query($con, "SELECT * FROM webtrixpro_users where user_id = '$userid'");
                  $salesUserId = mysqli_fetch_assoc($getUserId);
             ?>

        <img class="rounded-circle" src="<?php echo $salesUserId['user_profile']?>" width="35" height="30"/><br> <span class="role-style">Client</span>                       
        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
            
            <a class="dropdown-item" href="../pages/sales-account-setting.php?id=<?php echo $salesUserId['user_id']?>"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Account Setting</a>
            <div class="dropdown-divider">
            </div>
            <a id="SalesLogoutBtn" class="dropdown-item" href="backend/sales-logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
        </div>                 
    </div>
</nav>  