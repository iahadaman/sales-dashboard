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
	$sql = "select * from webtrixpro_users where user_isAdmin = 1 and user_email = '$user' and user_password = '$pass'";
	$query = mysqli_query($con, $sql);
	if( mysqli_num_rows($query) )
	{
		while($admin = mysqli_fetch_array($query)) {
			$_SESSION['admin_name'] = $admin['user_name'];
		}
		
	    // Login time is stored in a session variable
		$_SESSION["login_time_stamp"] = time();
	    echo 1;
	}
	else
	{
	    echo 0;
	}
}

// ADDING CLIENTS

if($_POST['type']==2){

    $client_name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['clientName']));
    $company_name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['companyName']));
  	$client_email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['clientEmail']));
    $client_password = htmlspecialchars(mysqli_real_escape_string($con, $_POST['clientPassword']));
  	$client_des = htmlspecialchars(mysqli_real_escape_string($con, $_POST['clientDes']));

  	 //to set current date
 
	$datetime_variable = new DateTime();			 
	$datetime_variable = date_format($datetime_variable, 'Y-m-d H:i:s');
	$date = new DateTime();
	$date = date_format($date, 'ymd');


	//If image selected not empty
	if($_FILES['img_file']['name'] != ''){

		$filename = $_FILES['img_file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("jpg", "jpeg", "png");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() . $date .  "." . $extension;
			$path = "images/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['img_file']['tmp_name'], $path)) {
				$client_password = md5($client_password);  
				$insertquery="INSERT INTO webtrixpro_users (user_name, user_company, user_email, user_password, user_description, user_profile, user_isAdmin)values('$client_name', '$company_name', '$client_email', '$client_password', '$client_des', '$path', 0)";
				if(mysqli_query($con, $insertquery)) {
				 echo 1;
				}
				else{
					echo 0;					
				}
			}
		}
		else {
			echo "Invalid Format";
		}
	} else {
		$path = "images/profile.jpg";
		$client_password = md5($client_password);  
		$insertquery="INSERT INTO webtrixpro_users (user_name, user_company, user_email, user_password, user_description, user_profile, user_isAdmin)values('$client_name', '$company_name', '$client_email', '$client_password', '$client_des', '$path', 0)";
		if(mysqli_query($con, $insertquery)) {
		 echo 1;
		}
		else{
			echo 0;					
		}
	}		  
}

//Manage Clients

if($_POST['type']==3){
	if(isset($_POST['readAllclients'])) {
	 	$allClientData = ' <table class="table table-condensed">
	                        <thead>
	                          <tr>
	                            <th>Image</th>
	                            <th>Full Name</th>
	                            <th>Company Name</th>
	                            <th>Email Address</th>
	                            <th>Actions</th>                         
	                          </tr>
	                        </thead>	                       
	                        <tbody>';       
    	$getAllClients = mysqli_query($con, "SELECT * FROM webtrixpro_users WHERE user_isAdmin !=1 ORDER BY user_id desc");
   		 while($allclients = mysqli_fetch_array($getAllClients)){

	     $allClientData .= '<tr>
	                            <td><img src="'.$allclients['user_profile'].'"></td>
	                            <td>'.$allclients['user_name'].'</td>
	                            <td>'.$allclients['user_company'].'</td>
	                            <td>'.$allclients['user_email'].'</td>
	                            <td><a type="button" class="edit_client_data" id="'.$allclients['user_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" class="delete_client_data" id="'.$allclients['user_id'].'" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
		                    </tr>';           
        }

	    $allClientData .='</tbody></table>';
	    echo $allClientData;         
	}
}

//Display Record in Update CLIENT Modal

if($_POST['type']==4){
	 if(isset($_POST["employee_id"]))  
	 { 
	      $query = "SELECT * FROM webtrixpro_users WHERE user_id = '".$_POST["employee_id"]."'";  
	      $result = mysqli_query($con, $query);    
	      $row = mysqli_fetch_array($result); 
	      if($row)
	      {
	      	echo json_encode($row);  
	      }
	      else{
	      	echo 0;
	      }
	      
	 }
}  

// UPDATE CLIENT

if($_POST['type']==5){
	if(isset($_POST["id"]))  
	{ 
	   
	    $client_name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['name']));
	    $company_name = htmlspecialchars(mysqli_real_escape_string($con, $_POST['company']));
	  	$client_email = htmlspecialchars(mysqli_real_escape_string($con, $_POST['email']));
	    $client_password = htmlspecialchars(mysqli_real_escape_string($con, $_POST['password']));
	  	$client_des = htmlspecialchars(mysqli_real_escape_string($con, $_POST['description']));

	  	$client_password = md5($client_password);  //to encrypt password  
	  
        $updateRecord = "UPDATE webtrixpro_users SET user_name = '$client_name', user_company = '$company_name', user_email = '$client_email', user_password = '$client_password', user_description = '$client_des' WHERE user_id = '".$_POST["id"]."'";

        if(mysqli_query($con, $updateRecord))
  		{
        	echo 1;
        }
        else{
        	echo 0; 
        }
    }
}

// DELETE CLIENT

if($_POST['type']==6){
	if(isset($_POST['employee_id'])){
		$deleteQuery = "delete from webtrixpro_users where user_id= '".$_POST["employee_id"]."'";
		mysqli_query($con, $deleteQuery);
	}
}

// ADDING PROJECT

if($_POST['type']==7){

    $pName = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_name']));
    $pClient = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_client']));
  	$pPlatform = $_SESSION['platform_last_id'];
    $pDate = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_date']));
  	$pDescription = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_description']));
  	$pLabel = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_label']));

  	//to set current date
 
	$datetime_variable = new DateTime();			 
	$datetime_variable = date_format($datetime_variable, 'Y-m-d H:i:s');
	$date = new DateTime();
	$date = date_format($date, 'ymd');


	//If image selected not empty

	if($_FILES['img_file']['name'] != ''){

		$filename = $_FILES['img_file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("jpg", "jpeg", "png");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() . $date .  "." . $extension;
			$path = "images/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['img_file']['tmp_name'], $path)) {
				$insertquery="INSERT INTO `webtrixpro_projects`(`project_name`, `project_client`, `project_platformId`, `project_clientProfile`, `project_date`, `project_description`, `project_label`) VALUES ('$pName','$pClient','$pPlatform','$path','$pDate','$pDescription','$pLabel')";
				if(mysqli_query($con, $insertquery)) {
				 echo 1;
				}
				else{
					echo 0;					
				}
			}
		}
		else {
			echo "Invalid Format";
		}
	} else {
		$path = "images/profile.jpg";
		$insertquery="INSERT INTO `webtrixpro_projects`(`project_name`, `project_client`, `project_platformId`, `project_clientProfile`, `project_date`, `project_description`, `project_label`) VALUES ('$pName','$pClient','$pPlatform','$path','$pDate','$pDescription','$pLabel')";
		if(mysqli_query($con, $insertquery)) {
		    echo 1;
		}
		else{
			echo 0;					
		}
	}		  
}

//MANAGE PROJECTS

if($_POST['type']==8){
	if(isset($_POST['readAllprojects'])) {  
		$allProjectData = '<div class="row">';
    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_label = '".$_POST["readAllprojects"]."' ORDER BY project_id desc");
   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

	    $allProjectData .= '<div class="inprogress-card col-lg-4 col-md-6 col-sm-6 mt-4">

                  <div class="progress-box">
                  <a class="design" href="project-detail.php?'.$allProjects['project_id'].'">
                   <div class="progress-bg2"> </div>
                  </div>';
                  if($_POST['readAllprojects'] == "Completed")
					{
						$allProjectData .='<div class="align-self-start completed-progress-report">
	                   '.$allProjects['project_label'].'
	                  </div>';

					}
					else
					{
						$allProjectData .= '<div class="align-self-start progress-report">
	                 	'.$allProjects['project_label'].'
	                  	</div>';
					}
        
       $allProjectData .= '<div class="progress-content">
                          <p>Project Name<br><strong>'.$allProjects['project_name'].'</strong></p>
                          <p>Project Start Date<br><strong>'.$allProjects['project_date'].'</strong></p>
                           
                  </div>     

                  <div class="progress-next-content">
                  <span class = "forClickPurpose">
                  <p class="mainplatform">Project Platform<br>';



			$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");
   		 while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
   		 {
   		 	if($targetPlatforms['web_platform']!=0)
   		 	{
   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development</strong>';
   		 	}
   		 	if($targetPlatforms['andriod_platform']!=0)
   		 	{
   		 		$allProjectData .= '<strong title = "Andriod Development" class="platform">Andriod Development</strong>';
   		 	}
   		 	if($targetPlatforms['ios_platform']!=0)
   		 	{
   		 		$allProjectData .= '<strong title = "IOS Development" class="platform">IOS Development</strong>';
   		 	} 
   		 	if($targetPlatforms['web_platform']==0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
   		 	{
   		 		$nextPlatform = "IOS Development";
   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
   		 	}
   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']==0 && $targetPlatforms['ios_platform']!=0)
   		 	{
   		 		$nextPlatform = "IOS Development";
   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
   		 	}
   		 	elseif($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']==0){
   		 		$nextPlatform = "Andriod Development";
   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
   		 	}

   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
   		 	{
   		 	    $allProjectData .= '<strong title = "Andriod Development & IOS Development" class="combinePlatform">+ 2</strong>';
   		 	}
   		 }

  
                



 $allProjectData .='</p><p>Client<br><strong><img style="border-radius:50%;" src="'.$allProjects['project_clientProfile'].'" width="20" height="18"> '.$allProjects['project_client'].'</strong></p>
 					</span>
                    </a>
                    <span class="pt-3 pl-2"><a type="button" class="edit_project_data" id="'.$allProjects['project_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
                    <a type="button" class="delete_project_data" id="'.$allProjects['project_id'].'" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>                          
                  </div>               
          			</div>';           
        }
        $allProjectData .= '</div>';
	    echo $allProjectData;         
	}
}

//Display Record in EDIT PROJECT MODAL

if($_POST['type']==9){
	 if(isset($_POST["project_id"]))  
	 { 
	      $query = "SELECT * FROM webtrixpro_projects WHERE project_id = '".$_POST["project_id"]."'";  
	      $result = mysqli_query($con, $query);    
	      $row = mysqli_fetch_array($result); 
	      if($row)
	      {
	      	echo json_encode($row);  
	      }
	      else{
	      	echo 0;
	      }
	      
	 }
}  

// UPDATE PROJECT

if($_POST['type']==10){
	if(isset($_POST["id"]))  
	{ 	   
	    $u_pName = htmlspecialchars(mysqli_real_escape_string($con, $_POST['u_pName']));
	    $u_pClient = htmlspecialchars(mysqli_real_escape_string($con, $_POST['u_pClient']));
	  	$u_pPlatformID = htmlspecialchars(mysqli_real_escape_string($con, $_POST['u_pPlatformId']));
	    $u_pDate = htmlspecialchars(mysqli_real_escape_string($con, $_POST['u_pDate']));
	  	$u_pDescription = htmlspecialchars(mysqli_real_escape_string($con, $_POST['u_pDescription']));
	  	$u_pLabel = htmlspecialchars(mysqli_real_escape_string($con, $_POST['u_pLabel']));

	  	$u_webPlatform = htmlspecialchars(mysqli_real_escape_string($con, $_POST['firstplatform']));
	  	$u_andriodPlatform = htmlspecialchars(mysqli_real_escape_string($con, $_POST['secondplatform']));
	  	$u_iosPlatform = htmlspecialchars(mysqli_real_escape_string($con, $_POST['thirdplatform']));

	 	if($u_webPlatform == "Web Development")
	  	{
	  		$u_web = 1;
	  		$u_andriod = 0;
	  		$u_ios = 0;
	  	}
	  	else if($u_webPlatform == "Andriod Development")
	  	{
	  		$u_web = 0;
	  		$u_andriod = 1;
	  		$u_ios = 0;
	  	}
	  	else if($u_webPlatform == "IOS Development"){
	  		$u_web = 0;
	  		$u_andriod = 0;
	  		$u_ios = 1;
	  	}

	  	if($u_andriodPlatform == "Web Development")
	  	{
	  		$u_web = 1;
	  	}
	  	else if($u_andriodPlatform == "Andriod Development")
	  	{
	  		$u_andriod = 1;
	  	}
	  	else if($u_andriodPlatform == "IOS Development"){
	  		$u_ios = 1;
	  	}

	  	if($u_iosPlatform == "Web Development")
	  	{
	  		$u_web = 1;
	  	}
	  	else if($u_iosPlatform == "Andriod Development")
	  	{
	  		$u_andriod = 1;
	  	}
	  	else if($u_iosPlatform == "IOS Development"){
	  		$u_ios = 1;
	  	}
	  
        $updateRecord = "UPDATE webtrixpro_projects SET project_name = '$u_pName', project_client = '$u_pClient', project_date = '$u_pDate', project_description = '$u_pDescription', project_label = '$u_pLabel' WHERE project_id = '".$_POST["id"]."'";

        $updateRecord2 = "UPDATE `webtrixpro_platforms` SET `web_platform`='$u_web',`andriod_platform`='$u_andriod',`ios_platform`='$u_ios' WHERE platform_id = '$u_pPlatformID'";

        if(mysqli_query($con, $updateRecord) && mysqli_query($con, $updateRecord2))
  		{
        	echo 1;
        }
        else{
        	echo 0; 
        }

    }
}

// DELETE PROJECT

if($_POST['type']==11){
	if(isset($_POST['project_id'])){

		$query = "SELECT project_platformId FROM webtrixpro_projects WHERE project_id = '".$_POST["project_id"]."'";  
	    $result = mysqli_query($con, $query);    
	    $row = mysqli_fetch_array($result);

	    $deleteQuery2 = "delete from webtrixpro_platforms where platform_id= '".$row["project_platformId"]."'"; 
	    mysqli_query($con, $deleteQuery2);
		$deleteQuery = "delete from webtrixpro_projects where project_id= '".$_POST["project_id"]."'";
		mysqli_query($con, $deleteQuery);
	}
}

// ADD PROJECT PLATFORM

if($_POST['type']==12){
	if(!isset($_SESSION)) 
	{ 
	  session_start(); 
	} 
	$pPlatform = htmlspecialchars(mysqli_real_escape_string($con, $_POST['p_platform']));
    $psPlatform = htmlspecialchars(mysqli_real_escape_string($con, $_POST['ps_platform']));
  	$ptPlatform = htmlspecialchars(mysqli_real_escape_string($con, $_POST['pt_platform']));

  	if($pPlatform == "Web Development")
  	{
  		$web = 1;
  		$andriod = 0;
  		$ios = 0;
  	}
  	else if($pPlatform == "Andriod Development")
  	{
  		$web = 0;
  		$andriod = 1;
  		$ios = 0;
  	}
  	else if($pPlatform == "IOS Development"){
  		$web = 0;
  		$andriod = 0;
  		$ios = 1;
  	}

  	if($psPlatform == "Web Development")
  	{
  		$web = 1;
  	}
  	else if($psPlatform == "Andriod Development")
  	{
  		$andriod = 1;
  	}
  	else if($psPlatform == "IOS Development"){
  		$ios = 1;
  	}

  	if($ptPlatform == "Web Development")
  	{
  		$web = 1;
  	}
  	else if($ptPlatform == "Andriod Development")
  	{
  		$andriod = 1;
  	}
  	else if($ptPlatform == "IOS Development"){
  		$ios = 1;
  	}

	$sql = "INSERT INTO webtrixpro_platforms (web_platform, andriod_platform, ios_platform)
	VALUES ('$web', '$andriod', '$ios')";

	if (mysqli_query($con, $sql)) {
	  $last_id = mysqli_insert_id($con);
	 $_SESSION['platform_last_id'] = $last_id;
	 echo 1;

	} else {
	  echo 0;
	}
}


//Display Dropdown Record in EDIT PROJECT MODAL

if($_POST['type']==13){
	 if(isset($_POST["project_id"]))  
	 { 
	      $query = "SELECT project_platformId FROM webtrixpro_projects WHERE project_id = '".$_POST["project_id"]."'";  
	      $result = mysqli_query($con, $query);    
	      $row = mysqli_fetch_array($result); 
	      $platformid = $row['project_platformId'];

	      $query2 = "SELECT * FROM webtrixpro_platforms WHERE platform_id = '$platformid'";  
	      $result2 = mysqli_query($con, $query2); 
	      $row = mysqli_fetch_array($result2);   

	     if($row)
	      {
	      	echo json_encode($row);  
	      }
	      else{
	      	echo 0;
	      }
	      
	      
	 }
}  

	// Get total number of projects - dashboard
	if($_POST['type'] == 14) {
			$query = "SELECT * FROM webtrixpro_projects";
			$result = mysqli_query($con, $query);
			echo mysqli_num_rows($result);
	}

	// Get total number of in progress projects - dashboard
	if($_POST['type'] == 15) {
		$query = "SELECT * FROM webtrixpro_projects WHERE project_label = 'In Progress'";
		$result = mysqli_query($con, $query);
		echo mysqli_num_rows($result);
	}
	// Get total number of completed projects - dashboard.
	if($_POST['type'] == 16) {
		$query = "SELECT * FROM webtrixpro_projects WHERE project_label = 'Completed'";
		$result = mysqli_query($con, $query);
		echo mysqli_num_rows($result); 
	}
?>