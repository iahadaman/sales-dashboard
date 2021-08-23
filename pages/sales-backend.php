 <?php
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();
include 'backend/connection.php';
include 'backend/database-tables.php';

// ADMIN LOGIN

if($_POST['type']==1)
{
	$user = htmlspecialchars(mysqli_real_escape_string($con, $_POST['login_email']));
	$pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['login_password']));
	$pass = md5($pass);
	$sql = "select * from webtrixpro_users where user_isAdmin != 1 and user_email = '$user' and user_password = '$pass'";
	$query = mysqli_query($con, $sql);
	if( mysqli_num_rows($query) )
	{
		while($client = mysqli_fetch_array($query)) {
			$_SESSION['client_name'] = $client['user_name'];
			$_SESSION['client_id'] = $client['user_id'];
		}		
	    // Login time is stored in a session variable
		$_SESSION["sales_login_time_stamp"] = time();
	    echo 1;
	}
	else
	{
	    echo 0;
	}
}


 // UPDATE USERS ACCOUNT

if($_POST['type']==2){
	  $clientName = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_name']));
	  $clientEmail = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_email']));
	  $clientPassword = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_password']));
  	  $old_image = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_OldProfile']));

  	    $client_id =  $_SESSION['client_id'];


  	    $oldDataUsers = mysqli_query($con, "SELECT * from webtrixpro_users WHERE user_id = '$client_id'");
  	    $oldData = mysqli_fetch_assoc($oldDataUsers);
 
 
		$datetime_variable = new DateTime();			 
		$datetime_variable = date_format($datetime_variable, 'Y-m-d H:i:s');
		$date = new DateTime();
		$date = date_format($date, 'ymd');

		if($_FILES['user_updateProfile']['name'] != '')
	    {
		    $filename = $_FILES['user_updateProfile']['name'];
		    $extension = pathinfo($filename, PATHINFO_EXTENSION);
		    $valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG");
		   if(in_array($extension, $valid_extensions)) {
				$new_name = rand() . $date .  "." . $extension;
				$update_filename = "images/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));
				move_uploaded_file($_FILES['user_updateProfile']['tmp_name'], $update_filename);
			}
			else {
				echo "Invalid Format";
			}
		}
		else{

			 $update_filename = $old_image;
		}

		if($clientName == '')
		{
			$clientName = $oldData['user_name'];
		}
		if($clientEmail == '')
		{
			$clientEmail = $oldData['user_email'];
		}
		if($clientPassword == '')
		{
			$clientPassword = $oldData['user_password'];
		}
		else{

			$clientPassword = md5($clientPassword);  
		}

		$updateUser =  "UPDATE `webtrixpro_users` SET `user_name`='$clientName', `user_email`='$clientEmail',`user_password`='$clientPassword',`user_profile`='$update_filename' WHERE user_id = '$client_id'";
        $query = mysqli_query($con, $updateUser);
		if($query) {
		  $_SESSION['client_name'] = $clientName;
		  echo 1;
		}
		else{
			echo 0;
		}		
		
}	

$client_id = $_SESSION['client_id'];

//MANAGE PROJECTS

if($_POST['type']==3){
	if(isset($_POST['readAllprojects'])) {  
		$selectedValue = htmlspecialchars(mysqli_real_escape_string($con, $_POST['selectedValue'])); 
		if($selectedValue == "all")
		{
			$allProjectData = '<div class="row">';
	    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_clientId = '$client_id' ORDER BY project_id desc");

	    	$getclientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '$client_id'");
	    	$clientName = mysqli_fetch_assoc($getclientName);

	   		while($allProjects = mysqli_fetch_array($getAllProjects)){

				$allProjectData .= '<div class="inprogress-card-sales col-lg-3 col-md-6 col-sm-6 mt-4">  
	               <a class="design" href="sales-project-detail.php?id='.$allProjects['project_id'].'">
	                    <div class="inprogress-bg-card-sales col-lg-12 col-md-12 col-sm-12" style="background-image: url('. $allProjects['project_image'] .'); background-size: cover; background-position: center; border-radius:2px;">  
	                    </div>

	                      <div class="progress-content-sales">
	                        <p>Project Name<br><strong>'.$allProjects['project_name'].'</strong></p>
	                         <p class="mainplatform">Project Platform<br>';



					$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");
		   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
		   		{
		   		 	if($targetPlatforms['web_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['andriod_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Andriod Development" class="platform">Andriod Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "IOS Development" class="platform">IOS Development &nbsp</strong>';
		   		 	} 
		   		 	if($targetPlatforms['web_platform']==0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']==0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']==0){
		   		 		$nextPlatform = "Andriod Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}

		   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 	    $allProjectData .= '<strong title = "Andriod Development & IOS Development">+ 2</strong>';
		   		 	}
		   	    }

				 $allProjectData .='</p>
		 					 </div>    
	                 </a>         
	              </div>'; 
            } 

             $allProjectData .='</div>';         
		    echo $allProjectData;      
		}
		else if($selectedValue == "webApp")
		{
			$allProjectData = '<div class="row">';
			$getTargetPlatform = mysqli_query($con, "SELECT platform_id FROM webtrixpro_platforms WHERE web_platform = 1  ORDER BY platform_id desc");

			while($targetPlatform = mysqli_fetch_array($getTargetPlatform))
			{

				$targetedPlatform = $targetPlatform['platform_id'];

		    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_clientId = '$client_id' AND project_platformId = '$targetedPlatform' ORDER BY project_id desc");

		    	$getclientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '$client_id'");
		    	$clientName = mysqli_fetch_assoc($getclientName);

		   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

				$allProjectData .= '<div class="inprogress-card-sales col-lg-3 col-md-6 col-sm-6 mt-4">  
	               <a class="design" href="sales-project-detail.php?id='.$allProjects['project_id'].'">
	                    <div class="inprogress-bg-card-sales col-lg-12 col-md-12 col-sm-12" style="background-image: url('. $allProjects['project_image'] .'); background-size: cover; background-position: center; border-radius:2px;">  
	                    </div>

	                      <div class="progress-content-sales">
	                        <p>Project Name<br><strong>'.$allProjects['project_name'].'</strong></p>
	                         <p class="mainplatform">Project Platform<br>';



					$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");
		   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
		   		{
		   		 		if($targetPlatforms['web_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['andriod_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Andriod Development" class="platform">Andriod Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "IOS Development" class="platform">IOS Development &nbsp</strong>';
		   		 	} 
		   		 	if($targetPlatforms['web_platform']==0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']==0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']==0){
		   		 		$nextPlatform = "Andriod Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}

		   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 	    $allProjectData .= '<strong title = "Andriod Development & IOS Development">+ 2</strong>';
		   		 	}
		   		 }
				 $allProjectData .='</p>
		 					 </div>    
	                 </a>         
	              </div>';           
		        }
	    	}
	        $allProjectData .= '</div>';
		    echo $allProjectData;      
		}
		else if($selectedValue == "androidApp")
		{
			$allProjectData = '<div class="row">';
			$getTargetPlatform = mysqli_query($con, "SELECT platform_id FROM webtrixpro_platforms WHERE andriod_platform = 1 ORDER BY platform_id desc");

			while($targetPlatform = mysqli_fetch_array($getTargetPlatform))
			{

		    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_clientId = '$client_id' AND project_platformId = '".$targetPlatform['platform_id']."' ORDER BY project_id desc");

		    	$getclientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '$client_id'");
		    	$clientName = mysqli_fetch_assoc($getclientName);

		   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

				$allProjectData .= '<div class="inprogress-card-sales col-lg-3 col-md-6 col-sm-6 mt-4">  
	               <a class="design" href="sales-project-detail.php?id='.$allProjects['project_id'].'">
	                    <div class="inprogress-bg-card-sales col-lg-12 col-md-12 col-sm-12" style="background-image: url('. $allProjects['project_image'] .'); background-size: cover; background-position: center; border-radius:2px;">  
	                    </div>

	                      <div class="progress-content-sales">
	                        <p>Project Name<br><strong>'.$allProjects['project_name'].'</strong></p>
	                         <p class="mainplatform">Project Platform<br>';



					$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");
		   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
		   		{
		   		 	if($targetPlatforms['web_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['andriod_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Andriod Development" class="platform">Andriod Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "IOS Development" class="platform">IOS Development &nbsp</strong>';
		   		 	} 
		   		 	if($targetPlatforms['web_platform']==0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']==0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']==0){
		   		 		$nextPlatform = "Andriod Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}

		   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 	    $allProjectData .= '<strong title = "Andriod Development & IOS Development">+ 2</strong>';
		   		 	}
		   		 }
				 $allProjectData .='</p>
		 					 </div>    
	                 </a>         
	              </div>';           
		        }
	    	}
	        $allProjectData .= '</div>';
		    echo $allProjectData;      
		}
		else if($selectedValue == "iosApp")
		{
			$allProjectData = '<div class="row">';
			$getTargetPlatform = mysqli_query($con, "SELECT platform_id FROM webtrixpro_platforms WHERE ios_platform = 1 ORDER BY platform_id desc");

			while($targetPlatform = mysqli_fetch_array($getTargetPlatform))
			{

		    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_clientId = '$client_id' AND project_platformId = '".$targetPlatform['platform_id']."' ORDER BY project_id desc");

		    	$getclientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '$client_id'");
		    	$clientName = mysqli_fetch_assoc($getclientName);

		   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

				$allProjectData .= '<div class="inprogress-card-sales col-lg-3 col-md-6 col-sm-6 mt-4">  
	               <a class="design" href="sales-project-detail.php?id='.$allProjects['project_id'].'">
	                    <div class="inprogress-bg-card-sales col-lg-12 col-md-12 col-sm-12" style="background-image: url('. $allProjects['project_image'] .'); background-size: cover; background-position: center; border-radius:2px;">  
	                    </div>

	                      <div class="progress-content-sales">
	                        <p>Project Name<br><strong>'.$allProjects['project_name'].'</strong></p>
	                         <p class="mainplatform">Project Platform<br>';



					$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");
		   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
		   		{
		   		 	if($targetPlatforms['web_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['andriod_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "Andriod Development" class="platform">Andriod Development &nbsp</strong>';
		   		 	}
		   		 	if($targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$allProjectData .= '<strong title = "IOS Development" class="platform">IOS Development &nbsp</strong>';
		   		 	} 
		   		 	if($targetPlatforms['web_platform']==0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']==0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 		$nextPlatform = "IOS Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}
		   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']==0){
		   		 		$nextPlatform = "Andriod Development";
		   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'">+ 1</strong>';
		   		 	}

		   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
		   		 	{
		   		 	    $allProjectData .= '<strong title = "Andriod Development & IOS Development">+ 2</strong>';
		   		 	}
		   		 }
				 $allProjectData .='</p>
		 					 </div>    
	                 </a>         
	              </div>';           
		        }
	    	}
	        $allProjectData .= '</div>';
		    echo $allProjectData;      
		}
		
	}
}
?>