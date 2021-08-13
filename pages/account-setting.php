<?php 
if(!isset($_SESSION)) 
{ 
  ini_set('session.gc_maxlifetime', 3600);
  session_set_cookie_params(3600);
  session_start(); 
  include 'backend/connection.php';
} 
if(!isset($_SESSION["admin_name"])) 
{
  header('location: login.php');
}
if(isset($_GET['id']))
 {
    $DataExist = false;
    $idOfAdmin = mysqli_real_escape_string($con, $_GET['id']);
    $_SESSION['user_id'] = $idOfAdmin;
    $getIds = "SELECT user_id from `webtrixpro_users`";
    $query = mysqli_query($con, $getIds);
    while($ids = mysqli_fetch_array($query)){
      if( $ids['user_id'] == $idOfAdmin )
      {
        if($_SESSION['admin_id'] == $idOfAdmin)
        {
          $DataExist = true;
        }
      }

    } 
     if( $DataExist == true )
      {
          if($getUserData= mysqli_query($con, "SELECT * FROM `webtrixpro_users` where user_id = '$idOfAdmin'"))
           {
              $userData = mysqli_fetch_assoc($getUserData);
           } 
      }
     else
      {
        echo "<script>
      	window.location.href='dashboard.php';
     	 </script>";
      }
} 
require_once '../partials/header.php';?>
    <div class="wrapper">      
       <?php require_once '../partials/sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/navigation.php';?> 

            <div id="content-section">
 				<div class="row">  
	                <div class="web-bg col-md-12 col-sm-12 mt-3">
	                	<h5>Account Setting</h5>
	                	<hr class="mt-4">
	                	<div id="admin_profile_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>	
	                	<div class="row">  
	                	   <div class="col-md-2 col-sm-12 setting-image">
                	    	<form method="POST" enctype = "multipart/form-data" name="adminProfile">

	
		                	    <div class="project-detail-box">


                	    		<div id="admin_img_preview">
           						 </div>
		                	    	<img id="admin_update_profile" src="<?php echo $userData['user_profile']; ?>"> 

		                	    </div>
		                	    		                	  
									<input type="file" id="admin_updateProfile" name = "admin_updateProfile" hidden/>
									<label for="admin_updateProfile" class="d-block pull-left btn btn-bg mb-3">Upload Image</label> 

                  					<input type="hidden" id="admin_OldProfile" name="admin_OldProfile" value="<?php echo $userData['user_profile'] ?>">  

								</div>

								<div class="account-style col-md-5 col-sm-6">	    
														
								  <div class="form-group">
								    <label for="adminName">Full Name</label>
								    <input type="text" class="form-control" id="adminName" value="<?php echo $userData['user_name'] ?>" placeholder="Enter your full name">
								  </div>
								  <div class="form-group">
								    <label for="adminEmail">Email</label>
								    <input type="email" class="form-control" id="adminEmail" value="<?php echo $userData['user_email'] ?>" aria-describedby="emailHelp" placeholder="Enter your email address">
								  </div>
								  <div class="form-group">
								    <label for="adminPassword">Password</label>
								    <input type="password" class="form-control" id="adminPassword" placeholder="Enter your password">
								  </div>
								</div>
								<div class="account-style col-md-5 col-sm-6">
									
								  <div class="form-group">
								    <label for="adminConEmail">Confirm Email</label>
								    <input type="email" class="form-control" id="adminConEmail" value="<?php echo $userData['user_email'] ?>" aria-describedby="emailHelp" placeholder="Please confirm your email address">
								  </div>
								  <div class="form-group">
								    <label for="adminConPass">Confirm Password</label>
								    <input type="password" class="form-control" id="adminConPass" placeholder="Please confirm your password">
								  </div>
								  <button style="margin-top:150px;" id="aAccountUpdateBtn" type="submit" class="btn btn-bg float-right">Submit</button>							
								</div>
							</form>
						</div>
	                </div>

                </div>
            </div>          
        </div>
    </div>

<?php require_once '../partials/footer.php';?>   
