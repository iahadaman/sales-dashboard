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
			$_SESSION['admin_id'] = $admin['user_id'];
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
		$valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG");
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
	                        <tbody id="clientsTable">';       
    	$getAllClients = mysqli_query($con, "SELECT * FROM webtrixpro_users WHERE user_isAdmin !=1 ORDER BY user_id desc LIMIT 8");
   		 while($allclients = mysqli_fetch_array($getAllClients)){

	     $allClientData .= '<tr>
								<td><div style="background-image: url('.$allclients['user_profile'].'); height: 30px; width: 30px; background-position: center; background-size: cover; border-radius: 30px;"></div>
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


  	    $adminId =  $_SESSION['admin_id'];

  	    $oldDataUsers = mysqli_query($con, "SELECT * from webtrixpro_users WHERE user_id = '".$_POST["id"]."'");
  	    $oldData = mysqli_fetch_assoc($oldDataUsers);

  	    if($client_name == '')
		{
			$client_name = $oldData['user_name'];
		}
		if($client_email == '')
		{
			$client_email = $oldData['user_email'];
		}
		if($client_password == '')
		{
			$client_password = $oldData['user_password'];
		}
		else{
			$client_password = md5($client_password);  
		}
	  
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
	$client_profile = mysqli_query($con, "SELECT user_profile FROM webtrixpro_users WHERE user_id = '$pClient'");
	$clientProfile = mysqli_fetch_assoc($client_profile);
	$clientProfile__image = $clientProfile['user_profile'];
	//If image selected not empty

	if($_FILES['img_file']['name'] != ''){

		$filename = $_FILES['img_file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("jpg", "jpeg", "png", "PNG");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() . $date .  "." . $extension;
			$path = "images/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['img_file']['tmp_name'], $path)) {
				$insertquery="INSERT INTO `webtrixpro_projects`(`project_name`, `project_clientId`, `project_platformId`, `project_clientProfile`,`project_image`, `project_date`, `project_description`, `project_label`) VALUES ('$pName','$pClient','$pPlatform','$clientProfile__image','$path','$pDate','$pDescription','$pLabel')";
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
		$insertquery="INSERT INTO `webtrixpro_projects`(`project_name`, `project_clientId`, `project_platformId`, `project_clientProfile`,`project_image`, `project_date`, `project_description`, `project_label`) VALUES ('$pName','$pClient','$pPlatform','$clientProfile__image','$clientProfile__image','$pDate','$pDescription','$pLabel')";
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
		$selectedValue = htmlspecialchars(mysqli_real_escape_string($con, $_POST['selectedValue'])); 
		if($selectedValue == "webApp")
		{
			$allProjectData = '<div class="row">';
			$getTargetPlatform = mysqli_query($con, "SELECT platform_id FROM webtrixpro_platforms WHERE web_platform = 1");

			while($targetPlatform = mysqli_fetch_array($getTargetPlatform))
			{
			    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_platformId = '".$targetPlatform['platform_id']."' AND project_label = '".$_POST["readAllprojects"]."' ORDER BY project_id desc");
			   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

						    $allProjectData .= '<div class="inprogress-card col-lg-4 col-md-6 col-sm-6 mt-4">

					                  <div class="progress-box">
					                  <a class="design" href="project-detail.php?id='.$allProjects['project_id'].'">
					                   <div class="progress-bg2" style="background-image: url('.$allProjects['project_image'].'); background-size: cover; background-position: center;"> </div>
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
					                          <p>Project Name<br><strong>';

					                          if(strlen($allProjects['project_name']) > 12)
					                          {
												$allProjectData .= substr($allProjects['project_name'], 0, 12) . "...";
					                          }
					                          else
					                          {
					                          	$allProjectData .= $allProjects['project_name'];
					                          }


	                         $allProjectData .= '</strong></p>

					                          <p>Project Start Date<br><strong>'.$allProjects['project_date'].'</strong></p>
					                           
					                  </div>     

					                  <div class="progress-next-content">
					                  <span class = "forClickPurpose">
					                  <p class="mainplatform">Project Platform<br>';



								$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");

								$getClientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '".$allProjects['project_clientId']."'");
										$clientName = mysqli_fetch_array($getClientName);
							   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
							   		{
							   		 	if($targetPlatforms['web_platform']!=0)
							   		 	{
							   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development</strong>';
							   		 	}
							   		 	if($targetPlatforms['andriod_platform']!=0)
							   		 	{
							   		 		$allProjectData .= '<strong title = "Android Development" class="platform">Android Development</strong>';
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
							   		 		$nextPlatform = "Android Development";
							   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
							   		 	}

							   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
							   		 	{
							   		 	    $allProjectData .= '<strong title = "Android Development & IOS Development" class="combinePlatform">+ 2</strong>';
							   		 	}
							   		}
							             
								 		$allProjectData .='</p><p>Client<br><strong><img style="border-radius:50%;" src="'.$allProjects['project_clientProfile'].'" width="20" height="18"> '.$clientName['user_name'].'</strong></p>
								 					</span>
								                    </a>
								                    <span class="pt-3 pl-2"><a type="button" class="edit_project_data" id="'.$allProjects['project_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
								                    <a type="button" class="delete_project_data" id="'.$allProjects['project_id'].'" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>                          
								                  </div>               
								          			</div>';           
    					}
				      
			}
			$allProjectData .= '</div>';
		    echo $allProjectData;   
		}
		elseif($selectedValue == "all")
		{
			$allProjectData = '<div class="row">';
	    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_label = '".$_POST["readAllprojects"]."' ORDER BY project_id desc");
   		 	while($allProjects = mysqli_fetch_array($getAllProjects)){

			    $allProjectData .= '<div class="inprogress-card col-lg-4 col-md-6 col-sm-6 mt-4">
                  <div class="progress-box">
                  <a class="design" href="project-detail.php?id='.$allProjects['project_id'].'">
                   <div class="progress-bg2" style="background-image: url('.$allProjects['project_image'].'); background-size: cover; background-position: center;"> </div>
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
			                          <p>Project Name<br><strong>';

			                          if(strlen($allProjects['project_name']) > 12)
			                          {
										$allProjectData .= substr($allProjects['project_name'], 0, 12) . "...";
			                          }
			                          else
			                          {
			                          	$allProjectData .= $allProjects['project_name'];
			                          }


                    $allProjectData .= '</strong></p>

			                          <p>Project Start Date<br><strong>'.$allProjects['project_date'].'</strong></p>
			                           
			                  </div>     

			                  <div class="progress-next-content">
			                  <span class = "forClickPurpose">
			                  <p class="mainplatform">Project Platform<br>';


					$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");

					$getClientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '".$allProjects['project_clientId']."'");
					$clientName = mysqli_fetch_array($getClientName);
			   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
			   		{
			   		 	if($targetPlatforms['web_platform']!=0)
			   		 	{
			   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development</strong>';
			   		 	}
			   		 	if($targetPlatforms['andriod_platform']!=0)
			   		 	{
			   		 		$allProjectData .= '<strong title = "Android Development" class="platform">Android Development</strong>';
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
			   		 		$nextPlatform = "Android Development";
			   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
			   		 	}

			   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
			   		 	{
			   		 	    $allProjectData .= '<strong title = "Android Development & IOS Development" class="combinePlatform">+ 2</strong>';
			   		 	}
			   		}
						             
				 	$allProjectData .='</p><p>Client<br><strong><img style="border-radius:50%;" src="'.$allProjects['project_clientProfile'].'" width="20" height="18"> '.$clientName['user_name'].'</strong></p>
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
		else if($selectedValue == "androidApp")
		{
			$allProjectData = '<div class="row">';
			$getTargetPlatform = mysqli_query($con, "SELECT platform_id FROM webtrixpro_platforms WHERE andriod_platform = 1");

			while($targetPlatform = mysqli_fetch_array($getTargetPlatform))
			{
			    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_platformId = '".$targetPlatform['platform_id']."' AND project_label = '".$_POST["readAllprojects"]."' ORDER BY project_id desc");
			   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

						    $allProjectData .= '<div class="inprogress-card col-lg-4 col-md-6 col-sm-6 mt-4">

					                  <div class="progress-box">
					                  <a class="design" href="project-detail.php?id='.$allProjects['project_id'].'">
					                   <div class="progress-bg2" style="background-image: url('.$allProjects['project_image'].'); background-size: cover; background-position: center;"> </div>
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
			                          <p>Project Name<br><strong>';

			                          if(strlen($allProjects['project_name']) > 12)
			                          {
										$allProjectData .= substr($allProjects['project_name'], 0, 12) . "...";
			                          }
			                          else
			                          {
			                          	$allProjectData .= $allProjects['project_name'];
			                          }


	                    	 	$allProjectData .= '</strong></p>

				                          <p>Project Start Date<br><strong>'.$allProjects['project_date'].'</strong></p>
				                           
				                  </div>     

				                  <div class="progress-next-content">
				                  <span class = "forClickPurpose">
			                  	<p class="mainplatform">Project Platform<br>';



								$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");

								$getClientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '".$allProjects['project_clientId']."'");
										$clientName = mysqli_fetch_array($getClientName);
							   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
							   		{
							   		 	if($targetPlatforms['web_platform']!=0)
							   		 	{
							   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development</strong>';
							   		 	}
							   		 	if($targetPlatforms['andriod_platform']!=0)
							   		 	{
							   		 		$allProjectData .= '<strong title = "Android Development" class="platform">Android Development</strong>';
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
							   		 		$nextPlatform = "Android Development";
							   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
							   		 	}

							   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
							   		 	{
							   		 	    $allProjectData .= '<strong title = "Android Development & IOS Development" class="combinePlatform">+ 2</strong>';
							   		 	}
							   		}
							             
								 		$allProjectData .='</p><p>Client<br><strong><img style="border-radius:50%;" src="'.$allProjects['project_clientProfile'].'" width="20" height="18"> '.$clientName['user_name'].'</strong></p>
								 					</span>
								                    </a>
								                    <span class="pt-3 pl-2"><a type="button" class="edit_project_data" id="'.$allProjects['project_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
								                    <a type="button" class="delete_project_data" id="'.$allProjects['project_id'].'" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>                          
								                  </div>               
								          			</div>';           
    					}
				      
			}
			$allProjectData .= '</div>';
		    echo $allProjectData;   
		}
		else if($selectedValue == "iosApp")
		{
			$allProjectData = '<div class="row">';
			$getTargetPlatform = mysqli_query($con, "SELECT platform_id FROM webtrixpro_platforms WHERE ios_platform = 1");

			while($targetPlatform = mysqli_fetch_array($getTargetPlatform))
			{
			    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_platformId = '".$targetPlatform['platform_id']."' AND project_label = '".$_POST["readAllprojects"]."' ORDER BY project_id desc");
			   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

						    $allProjectData .= '<div class="inprogress-card col-lg-4 col-md-6 col-sm-6 mt-4">

					                  <div class="progress-box">
					                  <a class="design" href="project-detail.php?id='.$allProjects['project_id'].'">
					                   <div class="progress-bg2" style="background-image: url('.$allProjects['project_image'].'); background-size: cover; background-position: center;"> </div>
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
			                          <p>Project Name<br><strong>';

			                          if(strlen($allProjects['project_name']) > 12)
			                          {
										$allProjectData .= substr($allProjects['project_name'], 0, 12) . "...";
			                          }
			                          else
			                          {
			                          	$allProjectData .= $allProjects['project_name'];
			                          }


			                    $allProjectData .= '</strong></p>

						                          <p>Project Start Date<br><strong>'.$allProjects['project_date'].'</strong></p>
						                           
						                  </div>     

						                  <div class="progress-next-content">
						                  <span class = "forClickPurpose">
						                  <p class="mainplatform">Project Platform<br>';



								$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");

								$getClientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '".$allProjects['project_clientId']."'");
										$clientName = mysqli_fetch_array($getClientName);
							   		while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
							   		{
							   		 	if($targetPlatforms['web_platform']!=0)
							   		 	{
							   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development</strong>';
							   		 	}
							   		 	if($targetPlatforms['andriod_platform']!=0)
							   		 	{
							   		 		$allProjectData .= '<strong title = "Android Development" class="platform">Android Development</strong>';
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
							   		 		$nextPlatform = "Android Development";
							   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
							   		 	}

							   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
							   		 	{
							   		 	    $allProjectData .= '<strong title = "Android Development & IOS Development" class="combinePlatform">+ 2</strong>';
							   		 	}
							   		}
							             
								 		$allProjectData .='</p><p>Client<br><strong><img style="border-radius:50%;" src="'.$allProjects['project_clientProfile'].'" width="20" height="18"> '.$clientName['user_name'].'</strong></p>
								 					</span>
								                    </a>
								                    <span class="pt-3 pl-2"><a type="button" class="edit_project_data" id="'.$allProjects['project_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
								                    <a type="button" class="delete_project_data" id="'.$allProjects['project_id'].'" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>                          
								                  </div>               
								          			</div>';           
    					}				      
			}
			$allProjectData .= '</div>';
		    echo $allProjectData;   
		}				
	}
}

//Display Record in EDIT PROJECT MODAL

if($_POST['type']==9){
	 if(isset($_POST["project_id"]))  
	 { 
		$sql = "SELECT * FROM webtrixpro_users, webtrixpro_projects WHERE project_id = '".$_POST["project_id"]."' AND project_clientId = user_id;";
	      $result = mysqli_query($con, $sql);    
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
	  	else if($u_webPlatform == "Android Development")
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
	  	else if($u_andriodPlatform == "Android Development")
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
	  	else if($u_iosPlatform == "Android Development")
	  	{
	  		$u_andriod = 1;
	  	}
	  	else if($u_iosPlatform == "IOS Development"){
	  		$u_ios = 1;
	  	}
	  
        $updateRecord = "UPDATE webtrixpro_projects SET project_name = '$u_pName', project_clientId = '$u_pClient', project_date = '$u_pDate', project_description = '$u_pDescription', project_label = '$u_pLabel' WHERE project_id = '".$_POST["id"]."'";

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
  	else if($pPlatform == "Android Development")
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
  	else if($psPlatform == "Android Development")
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
  	else if($ptPlatform == "Android Development")
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

	// Get Limited Clients
	if($_POST['type']==17){
		if(isset($_POST['readAllclients'])) {
			 $allClientData = ' <table class="table table-condensed">
								<thead>
								  <tr>
									<th style="padding: 15px;" class="roboto_regular">Image</th>
									<th style="padding: 15px;" class="roboto_regular">Full Name</th>
									<th style="padding: 15px;" class="roboto_regular">Company Name</th>
									<th style="padding: 15px;" class="roboto_regular">Email Address</th>
									<th style="padding: 15px;" class="roboto_regular">Actions</th>                         
								  </tr>
								</thead>	                       
								<tbody id="clientsTable">';       
			$getAllClients = mysqli_query($con, "SELECT * FROM webtrixpro_users WHERE user_isAdmin !=1 ORDER BY user_id desc LIMIT 3");
				while($allclients = mysqli_fetch_array($getAllClients)){
	
			 $allClientData .= '<tr>
									<td style="padding: 10px;"><div style="background-image: url('.$allclients['user_profile'].'); height: 30px; width: 30px; background-position: center; background-size: cover; border-radius: 30px;"></div>
									<td style="padding: 10px;font-family: Roboto;" class="roboto">'.$allclients['user_name'].'</td>
									<td style="padding: 10px;" class="roboto">'.$allclients['user_company'].'</td>
									<td style="padding: 10px;" class="roboto">'.$allclients['user_email'].'</td>
									<td style="padding: 10px;"><a type="button" class="edit_client_data" id="'.$allclients['user_id'].'" href="" class="roboto_regular"><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" class="delete_client_data" id="'.$allclients['user_id'].'" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
								</tr>';           
			}
	
			$allClientData .='</tbody></table>';
			echo $allClientData;         
		}
	}

 // UPDATE ADMIN ACCOUNT

if($_POST['type']==100){
	  $adminName = htmlspecialchars(mysqli_real_escape_string($con, $_POST['admin_name']));
	  $adminEmail = htmlspecialchars(mysqli_real_escape_string($con, $_POST['admin_email']));
	  $adminPassword = htmlspecialchars(mysqli_real_escape_string($con, $_POST['admin_password']));
  	  $old_image = htmlspecialchars(mysqli_real_escape_string($con, $_POST['admin_OldProfile']));


  	    $adminId =  $_SESSION['admin_id'];

  	    $oldDataAdmin = mysqli_query($con, "SELECT * from webtrixpro_users WHERE user_id = '$adminId'");
  	    $oldData = mysqli_fetch_assoc($oldDataAdmin);
 
		$datetime_variable = new DateTime();			 
		$datetime_variable = date_format($datetime_variable, 'Y-m-d H:i:s');
		$date = new DateTime();
		$date = date_format($date, 'ymd');

		if($_FILES['admin_updateProfile']['name'] != '')
	    {
		    $filename = $_FILES['admin_updateProfile']['name'];
		    $extension = pathinfo($filename, PATHINFO_EXTENSION);
		    $valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG");
		   if(in_array($extension, $valid_extensions)) {
				$new_name = rand() . $date .  "." . $extension;
				$admin_update_filename = "images/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));
				move_uploaded_file($_FILES['admin_updateProfile']['tmp_name'], $admin_update_filename);
			}
			else {
				echo "Invalid Format";
			}
		}
		else{

			 $admin_update_filename = $old_image;
		}

		if($adminName == '')
		{
			$adminName = $oldData['user_name'];
		}
		if($adminEmail == '')
		{
			$adminEmail = $oldData['user_email'];
		}
		if($adminPassword == '')
		{
			$adminPassword = $oldData['user_password'];
		}
		else{
			$adminPassword = md5($adminPassword);  
		}

		$updateUser =  "UPDATE `webtrixpro_users` SET `user_name`='$adminName', `user_email`='$adminEmail',`user_password`='$adminPassword',`user_profile`='$admin_update_filename' WHERE user_id = '$adminId'";
        $query = mysqli_query($con, $updateUser);
		if($query) {
		  $_SESSION['admin_name'] = $adminName;
		  echo 1;
		}
		else{
			echo 0;
		}		
		
}	
if($_POST['type'] == '18') {
		
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$description = mysqli_real_escape_string($con, $_POST['description']);

	if($_POST['link'] != null) {
		$link = mysqli_real_escape_string($con, $_POST['link']);
	}
	else
	{
		$link = null;
	}
	$projectID = $_POST['projectID'];
	$process = $_POST['process'];
	if($_FILES['process_file']['name'] != ''){

		$filename = $_FILES['process_file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG", "docx");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() .  "." . $extension;
			$path = "files/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['process_file']['tmp_name'], $path)) {
				$insertquery="INSERT INTO webtrixpro_updates (project_id, process_name, process_description, process_file, process_title, process_link)values('$projectID', '$process','$description', '$path', '$title', '$link')";
				if(mysqli_query($con, $insertquery)) {
				 echo 1;
				}
				else{
					echo 0;					
				}
			}
		}
		else {
			echo 2;
		}
	} else { 
		$insertquery="INSERT INTO webtrixpro_updates (project_id, process_name, process_description, process_file, process_title, process_link)values('$projectID', '$process','$description', '', '$title', '$link')";
		if(mysqli_query($con, $insertquery)) {
		 echo 1;
		}
		else{
			echo 0;					
		}
	}	
}
if($_POST['type'] == 19) {
	$updateId = mysqli_real_escape_string($con,$_POST['updateId']);
	$selectFile = mysqli_query($con, "SELECT process_file FROM webtrixpro_updates WHERE update_id = '$updateId'");
	$file = mysqli_fetch_assoc($selectFile);
		$targetedFile = $file['process_file'];

	$deleteUpdate = mysqli_query($con, "DELETE FROM webtrixpro_updates WHERE update_id = '$updateId'");
	if( $deleteUpdate ) {
		if($targetedFile != '')
		{
			unlink($targetedFile);
		}
		echo 1;
	} else {
		echo "An Error Occured!";
	}

}

//Display Record in EDIT DISCOVERY MODAl

if($_POST['type']==101){
	 if(isset($_POST["discovery_id"]))  
	 { 
	      $query = "SELECT * FROM webtrixpro_updates WHERE update_id = '".$_POST["discovery_id"]."'";  
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

//EDIT UPDATE
if($_POST['type'] == 102) {
		
	$id = mysqli_real_escape_string($con, $_POST['u_id']);
	$title = mysqli_real_escape_string($con, $_POST['u_title']);
	$description = mysqli_real_escape_string($con, $_POST['u_description']);
	$link = mysqli_real_escape_string($con, $_POST['u_link']);
	$oldFileName = mysqli_real_escape_string($con, $_POST['old_fileName']);

	if($_POST['u_link'] != null) {
		$link = mysqli_real_escape_string($con, $_POST['u_link']);
	}
	else
	{
		$link = null;
	}

	if($_FILES['process_file']['name'] != ''){

		$filename = $_FILES['process_file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG", "docx");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() .  "." . $extension;
			$path = "files/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['process_file']['tmp_name'], $path)) {
				 $updatequery = "UPDATE `webtrixpro_updates` SET `process_description`= '$description',`process_file`='$path',`process_title`='$title',`process_link`='link' WHERE `update_id` = '$id'";

				if(mysqli_query($con, $updatequery)) {
					if($oldFileName != '')
					{
		      			unlink($oldFileName);
		      		}
	      		
				   echo 1;
				}
				else{
					echo 0;					
				}
			}
		}
		else {
			echo 2;
		}
	} else { 
		$updatequery = "UPDATE `webtrixpro_updates` SET `process_description`= '$description',`process_file`='$oldFileName',`process_title`='$title',`process_link`='link' WHERE `update_id` = '$id'";
		if(mysqli_query($con, $updatequery)) {

		 echo 1;
		}
		else{
			echo 0;					
		}
	}	
}

if($_POST['type'] == 20) {
	$title = htmlspecialchars(mysqli_real_escape_string($con, $_POST['title']));
	$description = htmlspecialchars(mysqli_real_escape_string($con, $_POST['description']));
	$minCost = htmlspecialchars(mysqli_real_escape_string($con, $_POST['minCost']));
	$maxCost = htmlspecialchars(mysqli_real_escape_string($con, $_POST['maxCost']));
	$minHours = htmlspecialchars(mysqli_real_escape_string($con, $_POST['minHours']));
	$maxHours = htmlspecialchars(mysqli_real_escape_string($con, $_POST['maxHours']));
	$option_id = $_POST['option_id'];

	if(isset($_FILES['file']['tmp_name'])) {
		$filename = $_FILES['file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG", "docx");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() .  "." . $extension;
			$path = htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['file']['tmp_name'], 'component_images/'.$path)) {
				 $updatequery = "UPDATE options SET name = '$title', description = '$description', image = '$path', c1 = '$minCost', c2 = '$maxCost', h1 = '$minHours', h2 = '$maxHours' WHERE option_id = '$option_id'";

				if(mysqli_query($con, $updatequery)) {
				   echo 1;
				}
				else{
					echo 0;					
				}
			}
		}
	} else {
	
		$updateOption = mysqli_query($con, "UPDATE options SET name = '$title', description = '$description', image = 'lol', c1 = '$minCost', c2 = '$maxCost', h1 = '$minHours', h2 = '$maxHours' WHERE option_id = '$option_id'");
		if($updateOption) {
			echo 1;
		}
	}

}


if($_POST['type'] == 21) {
	$title = htmlspecialchars(mysqli_real_escape_string($con, $_POST['title']));
	$description = htmlspecialchars(mysqli_real_escape_string($con, $_POST['description']));
	$minCost = htmlspecialchars(mysqli_real_escape_string($con, $_POST['minCost']));
	$maxCost = htmlspecialchars(mysqli_real_escape_string($con, $_POST['maxCost']));
	$minHours = htmlspecialchars(mysqli_real_escape_string($con, $_POST['minHours']));
	$maxHours = htmlspecialchars(mysqli_real_escape_string($con, $_POST['maxHours']));
	$q_id = $_POST['q_id'];
	$getMainId = mysqli_query($con, "SELECT * FROM questions WHERE question_id ='$q_id'");
	$getMainId__assoc = mysqli_fetch_assoc($getMainId);
	$mainId = $getMainId__assoc['main_id'];
	if(isset($_FILES['file']['tmp_name'])) {
		$filename = $_FILES['file']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$valid_extensions = array("svg");
		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() .  "." . $extension;
			$path = htmlspecialchars( mysqli_real_escape_string($con, $new_name));

			if(move_uploaded_file($_FILES['file']['tmp_name'], 'component_images/'.$path)) {
				 $updatequery = "INSERT INTO options(name, description, image, parent_qid, main_id, c1, c2, h1, h2, is_hidden) VALUES('$title', '$description','$path','$q_id', '$mainId', '$minCost', '$maxCost', '$minHours', '$maxHours', '0')";

				if(mysqli_query($con, $updatequery)) {
				   echo 1;
				}
				else{
					echo 0;					
				}
			}
		}
	} else {
	
		$updateOption = mysqli_query($con, "UPDATE options SET name = '$title', description = '$description', image = 'lol', c1 = '$minCost', c2 = '$maxCost', h1 = '$minHours', h2 = '$maxHours' WHERE option_id = '$option_id'");
		if($updateOption) {
			echo 1;
		}
	}

}


if($_POST['type'] == 22) {
	$option_id = $_POST['option_id'];

	$deleteOption = mysqli_query($con, "DELETE FROM options WHERE option_id = '$option_id'");
	if($deleteOption) {
		echo 1;
	}
}

if($_POST['type'] == 23) {
	$getAllIOSData = $con -> query("SELECT * FROM questions WHERE main_id='3' AND for_mobile='0' ORDER BY question_id ASC");
    while($r = mysqli_fetch_array($getAllIOSData)) {
        ?>
        <tr>
            <td>
                <?php echo $r['question'] ?>
            </td>
            <td>
                <?php 
			$q__id = $r['question_id'];
			$getOptions = $con -> query("SELECT * FROM options WHERE parent_qid='$q__id' AND main_id='3' ORDER BY option_id ASC");
			$optionsData = mysqli_fetch_assoc($getOptions);
			echo $getOptions -> num_rows;
		 ?>
            </td>
	    <td>
		<?php
		   	echo ($r['main_id'] == '3') ? "Web App" : "Error";
		?>
	    </td>
	    <td>
			<a href="edit_component.php?id=<?php echo $r['question_id'] ?>"><i class="fas fa-edit"></i>&nbsp Edit </a>
	    </td>
        </tr>
        <?php
    }
}


if($_POST['type'] == 24) {
	$getAllIOSData = $con -> query("SELECT * FROM questions WHERE main_id='1' ORDER BY question_id ASC");
    while($r = mysqli_fetch_array($getAllIOSData)) {
        ?>
        <tr>
            <td>
                <?php echo $r['question'] ?>
            </td>
            <td>
                <?php 
			$q__id = $r['question_id'];
			$getOptions = $con -> query("SELECT * FROM options WHERE parent_qid='$q__id' AND main_id='1' ORDER BY option_id ASC");
			$optionsData = mysqli_fetch_assoc($getOptions);
			echo $getOptions -> num_rows;
		 ?>
            </td>
	    <td>
		<?php
		   	echo ($r['main_id'] == '1') ? "Mobile" : "Error";
		?>
	    </td>
	    <td>
			<a href="edit_component.php?id=<?php echo $r['question_id'] ?>"><i class="fas fa-edit"></i>&nbsp Edit </a>
	    </td>
        </tr>
        <?php
    }
}

if($_POST['type'] == 25) {
	$title = htmlspecialchars(mysqli_real_escape_string($con, $_POST['title']));
	$description = htmlspecialchars(mysqli_real_escape_string($con ,$_POST['description']));
	$option = htmlspecialchars(mysqli_real_escape_string($con, $_POST['option']));
	$forMobile = ($option == 1) ? "1" : "0";
	$getLastId = mysqli_query($con, "SELECT * FROM questions ORDER BY question_id DESC LIMIT 1 ");
	$getLastId__assoc = mysqli_fetch_assoc($getLastId);
	$lastId = (int)$getLastId__assoc['question_id'] + 1;
		$insertQuestion = mysqli_query($con, "INSERT INTO questions(question_id, question, description, main_id, for_mobile, single_option) VALUES('$lastId', '$title', '$description', '$option', '$forMobile', '0')");
		if($insertQuestion) {
			echo $lastId;
		}
}

if($_POST['type']==26){
	if(isset($_POST['readAllprojects'])) {  
		$allProjectData = '<div class="row">';
    	$getAllProjects = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_label = '".$_POST["readAllprojects"]."' ORDER BY project_id desc LIMIT 2");
   		 while($allProjects = mysqli_fetch_array($getAllProjects)){

	    $allProjectData .= '<div class="inprogress-card col-lg-6 col-md-6 col-sm-6 mt-4">

                  <div class="progress-box">
                  <a class="design" href="project-detail.php?id='.$allProjects['project_id'].'">
                   <div class="progress-bg2" style="background-image: url('.$allProjects['project_image'].'); background-size: cover; background-position: center;"> </div>
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
			                          <p>Project Name<br><strong>';

			                          if(strlen($allProjects['project_name']) > 12)
			                          {
										$allProjectData .= substr($allProjects['project_name'], 0, 12) . "...";
			                          }
			                          else
			                          {
			                          	$allProjectData .= $allProjects['project_name'];
			                          }


			                    $allProjectData .= '</strong></p>

						                          <p>Project Start Date<br><strong>'.$allProjects['project_date'].'</strong></p>
						                           
						                  </div>     

						                  <div class="progress-next-content">
						                  <span class = "forClickPurpose">
						                  <p class="mainplatform">Project Platform<br>';



			$gettargetPlatforms = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '".$allProjects['project_platformId']."'");

			$getClientName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '".$allProjects['project_clientId']."'");
			$clientName = mysqli_fetch_array($getClientName);
   		 while($targetPlatforms = mysqli_fetch_array($gettargetPlatforms))
   		 {
   		 	if($targetPlatforms['web_platform']!=0)
   		 	{
   		 		$allProjectData .= '<strong title = "Web Development" class="platform">Web Development</strong>';
   		 	}
   		 	if($targetPlatforms['andriod_platform']!=0)
   		 	{
   		 		$allProjectData .= '<strong title = "Android Development" class="platform">Android Development</strong>';
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
   		 		$nextPlatform = "Android Development";
   		 		$allProjectData .= '<strong title = "'. $nextPlatform.'" class="combinePlatform">+ 1</strong>';
   		 	}

   		 	if($targetPlatforms['web_platform']!=0 && $targetPlatforms['andriod_platform']!=0 && $targetPlatforms['ios_platform']!=0)
   		 	{
   		 	    $allProjectData .= '<strong title = "Android Development & IOS Development" class="combinePlatform">+ 2</strong>';
   		 	}
   		 }

  
                



 $allProjectData .='</p><p>Client<br><strong><img style="border-radius:50%;" src="'.$allProjects['project_clientProfile'].'" width="20" height="18"> '.$clientName['user_name'].'</strong></p>
 					</span>
                    </a>                      
                  </div>               
          			</div>';           
        }
        $allProjectData .= '</div>';
	    echo $allProjectData;         
	}
}
?>