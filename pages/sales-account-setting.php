 <?php
if(!isset($_SESSION)) 
{ 
  ini_set('session.gc_maxlifetime', 3600);
  session_set_cookie_params(3600);
  session_start(); 
  include 'backend/connection.php';
} 
if(!isset($_SESSION["client_name"])) 
{
  header('location: sales-login.php');
}
if(isset($_GET['id']))
 {
    $DataExist = false;
    $idOfUser = mysqli_real_escape_string($con, $_GET['id']);
    $_SESSION['user_id'] = $idOfUser;
    $getIds = "SELECT user_id from `webtrixpro_users`";
    $query = mysqli_query($con, $getIds);
    while($ids = mysqli_fetch_array($query)){
      if( $ids['user_id'] == $idOfUser )
      {
        if($_SESSION['client_id'] == $idOfUser)
        {
          $DataExist = true;
        }
      }

    } 
     if( $DataExist == true )
      {
          if($getUserData= mysqli_query($con, "SELECT * FROM `webtrixpro_users` where user_id = '$idOfUser'"))
           {
              $userData = mysqli_fetch_assoc($getUserData);
           } 
      }
     else
      {
        echo "<script>
      	window.location.href='sales-dashboard.php';
     	 </script>";
      }
} 
 require_once '../partials/header.php';?>
    <div class="wrapper">      
       <?php require_once '../partials/sales-sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/sales-navigation.php';?> 

            <div id="content-section">
 				<div class="row">  
	                <div class="web-bg col-md-12 col-sm-12 mt-3">
	                	<h5>Account Setting</h5>
	                	<hr class="mt-4">
	                		<div id="profile_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>	
	                	<div class="row">  

	                	 <div class="col-md-2 col-sm-12 setting-image">
                	    	<form method="POST" enctype = "multipart/form-data" name="profile">

	
		                	    <div class="project-detail-box">


                	    		<div id="img_preview">
           						 </div>

		                	    	<img id="update_profile" src="<?php echo $userData['user_profile']; ?>"> 


		                	    </div>
		                	    
		                	  
									<input type="file" id="user_updateProfile" name = "user_updateProfile" hidden/>
									<label for="user_updateProfile" class="d-block pull-left btn btn-bg mb-3">Upload Image</label> 

                  					<input type="hidden" id="user_OldProfile" name="user_OldProfile" value="<?php echo $userData['user_profile'] ?>">  



								</div>

								<div class="account-style col-md-5 col-sm-6">	    
														
								  <div class="form-group">
								    <label for="clientName">Full Name</label>
								    <input type="text" class="form-control" id="clientName" value="<?php echo $userData['user_name'] ?>" placeholder="Enter your full name">
								  </div>
								  <div class="form-group">
								    <label for="clientEmail">Email</label>
								    <input type="email" class="form-control" id="clientEmail" value="<?php echo $userData['user_email'] ?>" aria-describedby="emailHelp" placeholder="Enter your email address">
								  </div>
								  <div class="form-group">
								    <label for="clientPassword">Password</label>
								    <input type="password" class="form-control" id="clientPassword" placeholder="Enter your password">
								  </div>
								</div>
								<div class="account-style col-md-5 col-sm-6">
									
								  <div class="form-group">
								    <label for="clientConEmail">Confirm Email</label>
								    <input type="email" class="form-control" id="clientConEmail" value="<?php echo $userData['user_email'] ?>" aria-describedby="emailHelp" placeholder="Please confirm your email address">
								  </div>
								  <div class="form-group">
								    <label for="clientConPass">Confirm Password</label>
								    <input type="password" class="form-control" id="clientConPass" placeholder="Please confirm your password">
								  </div>
								  <button style="margin-top:150px;" id="accountUpdateBtn" type="submit" class="btn btn-bg float-right">Submit</button>							
								</div>
							</form>
						</div>
					
	                </div>

                </div>
            </div>          
        </div>
    </div>

<?php require_once '../partials/footer.php';?>   
