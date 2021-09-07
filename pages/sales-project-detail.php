
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

include('backend/connection.php');
$isTrue = false;

	if(isset($_GET['id'])) {
		$project_id = mysqli_real_escape_string($con, $_GET['id']);
		$getProjectData = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_id = '$project_id'");

		if(mysqli_num_rows($getProjectData) > 0) {
			$isTrue = true;

			$project= mysqli_fetch_assoc($getProjectData);
			$clientId = $project['project_clientId'];
			$platformId = $project['project_platformId'];

			$getName = mysqli_query($con, "SELECT user_name FROM webtrixpro_users WHERE user_id = '$clientId'");
			$name= mysqli_fetch_assoc($getName);
			$clientName = $name['user_name'];


		} else {
			header('Location: dashboard.php');
		}
	}

	if($isTrue) {	
		function getProjectData($d) {
			global $project_id, $con;
			$dataGet = mysqli_query($con, "SELECT ". $d ." FROM webtrixpro_projects WHERE project_id = '$project_id'");
			$returnData = mysqli_fetch_assoc($dataGet);
			echo $returnData[$d];
		}
		function projectPlatform() {
			global $platformId,$con;
			$getID = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '$platformId'");
			$platformData = mysqli_fetch_assoc($getID);
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '0' && $platformData['ios_platform'] == '0') {
				echo "Web App";
			}
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '0') {
				echo "Web App & Android";
			}
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '1') {
				echo "All";
			}
			if($platformData['web_platform'] == '0' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '0') {
				echo "Android";
			}
			if($platformData['web_platform'] == '0' && $platformData['andriod_platform'] == '0' && $platformData['ios_platform'] == '1') {
				echo "IOS";
			}
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '0' && $platformData['ios_platform'] == '1') {
				echo "IOS & Web";
			}
			if($platformData['web_platform'] == '0' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '1') {
				echo "Android & IOS";
			}
		}
	}


require_once '../partials/header.php'; ?>
    <div class="wrapper">      
       <?php require_once '../partials/sales-sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/sales-navigation.php';?> 

            <div id="content-section">
 				<div class="row">  
	                <div class="web-bg col-md-12 col-sm-12 mt-3">
	                	<div class="row">  
		                	<div class="col-12"><h5 class="pull-left d-inline mb-0">Projects</h5></div>
	               		  </div>
	                	
	                	<hr>
	                	<div class="project-detail-section row">  
	                	    <div class="col-md-6 col-sm-12">
		                	    <div class="project-detail-boxEmpty" style="background-image: url(<?php echo getProjectData('project_image') ?>); background-size: cover; background-position: center;"></div>
			                	<div class="project-detail-content">
				                	<p>Project Name<br><strong><?php echo getProjectData('project_name'); ?></strong></p>
			                        <p>Project Platform<br><strong><?php echo projectPlatform(); ?></strong></p>
			                        <p>Current Status<br><strong style="color:#2E5CAE"><?php echo getProjectData('project_label'); ?></strong></p>
		                        </div>
							</div>
							<div class="col-md-6 col-sm-6">
			                	<p>Project Start Date<br><strong><?php echo getProjectData('project_date'); ?></strong></p>
		                        <p>Account Executive<br><strong class="profile-image-style"><img src="<?php echo getProjectData('project_clientProfile'); ?>" style="margin-right: 10px;height: 30px; width: 32px;"><?php echo $clientName ?></strong></p>
								
							</div>
						</div>
	                </div>

	                <div class="web-bg col-md-12 col-sm-12 mt-3">
	                 	<h5>Updates</h5>
	                 	<hr class="mt-4">
	                 	<div class="row">
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">DISCOVERY </h6><span class="float-right">:</span>    

											 <?php 
											 	$getDiscovery = mysqli_query($con, "SELECT * FROM webtrixpro_updates WHERE project_id = '$project_id' AND process_name = 'discovery'");
												 if(mysqli_num_rows($getDiscovery) > 0) {

													while($discovery = mysqli_fetch_array($getDiscovery)) {

														
														
														echo '
														<div class="sub-small-card" style="box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
														<div class="row">
														<div class="col-8">		                 
														<h6>' . $discovery['process_title'] . '</h6>
														<p>'. $discovery['process_description'] .'</p>';

														if($discovery['process_link'] != "")
														{
															$links = "Click here to view the link";
															echo '<a target = "blank" class="float-right" href="' . $discovery['process_link'] . '"> '. $links .'</a>';
														}
														else
														{
															$links = "No links attached";
															echo '<a class="float-right"> '. $links .'</a>';
														}

														echo '<br>
					
													</div>
													<div class="col-4 mt-2">
														<div class="image-bg"><a href="' . $discovery['process_file'] . '"><img src="files/download.svg"></a></div>
													</div>
														</div>	
														</div>
														';
													}
												 } else {
													 echo '
													 <div class="sub-small-card" style="background: #bdc3c7; padding-top: 10px;padding-bottom: 10px;box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
													 Empty
												  </div>
													 ';
												 }
											 ?>

								</div>
	                 		</div>	                 		
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">DESIGN </h6><span class="float-right">:</span>    
									 <?php 
											 	$getDiscovery = mysqli_query($con, "SELECT * FROM webtrixpro_updates WHERE project_id = '$project_id' AND process_name = 'design'");
												 if(mysqli_num_rows($getDiscovery) > 0) {
													while($discovery = mysqli_fetch_array($getDiscovery)) {
														
														
														echo '
														<div class="sub-small-card" style="box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
														<div class="row">
														<div class="col-8">		                 
														<h6>' . $discovery['process_title'] . '</h6>
														<p>'. $discovery['process_description'] .'</p>';

														if($discovery['process_link'] != "")
														{
															$links = "Click here to view the link";
															echo '<a target = "blank" class="float-right" href="' . $discovery['process_link'] . '"> '. $links .'</a>';
														}
														else
														{
															$links = "No links attached";
															echo '<a class="float-right"> '. $links .'</a>';
														}

														echo '<br>
													</div>
													<div class="col-4 mt-2">
														<div class="image-bg"><a href="' . $discovery['process_file'] . '"><img src="files/download.svg"></a></div>
													</div>
														</div>	
														</div>
														';
													}
												 } else {
													 echo '
													 <div class="sub-small-card" style="background: #bdc3c7; padding-top: 10px;padding-bottom: 10px;box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
													 Empty
												  </div>
													 ';
												 }
											 ?>
		                 		</div>
							</div>
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">CODING </h6><span class="float-right">:</span>    
									 <?php 
											 	$getDiscovery = mysqli_query($con, "SELECT * FROM webtrixpro_updates WHERE project_id = '$project_id' AND process_name = 'coding'");
												 if(mysqli_num_rows($getDiscovery) > 0) {
													while($discovery = mysqli_fetch_array($getDiscovery)) {
														
														
														echo '
														<div class="sub-small-card" style="box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
														<div class="row">
														<div class="col-8">		                 
														<h6>' . $discovery['process_title'] . '</h6>
														<p>'. $discovery['process_description'] .'</p>';

														if($discovery['process_link'] != "")
														{
															$links = "Click here to view the link";
															echo '<a target = "blank" class="float-right" href="' . $discovery['process_link'] . '"> '. $links .'</a>';
														}
														else
														{
															$links = "No links attached";
															echo '<a class="float-right"> '. $links .'</a>';
														}

														echo '<br>
													</div>
													<div class="col-4 mt-2">
														<div class="image-bg"><a href="' . $discovery['process_file'] . '"><img src="files/download.svg"></a></div>
													</div>
														</div>	
														</div>
														';
													}
												 } else {
													 echo '<div class="sub-small-card" style="background: #bdc3c7; padding-top: 10px;padding-bottom: 10px;box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
													 Empty
												  </div>';
												 }
											 ?>
								</div>
	                 		</div>
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">MAINTENANCE </h6><span class="float-right">:</span>    
									 <?php 
											 	$getDiscovery = mysqli_query($con, "SELECT * FROM webtrixpro_updates WHERE project_id = '$project_id' AND process_name = 'maintenance'");
												 if(mysqli_num_rows($getDiscovery) > 0) {
													
															while($discovery = mysqli_fetch_array($getDiscovery)) {
														echo '
														<div class="sub-small-card" style="box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
														<div class="row">
														<div class="col-8">		                 
														<h6>' . $discovery['process_title'] . '</h6>
														<p>'. $discovery['process_description'] .'</p>';

														if($discovery['process_link'] != "")
														{
															$links = "Click here to view the link";
															echo '<a target = "blank" class="float-right" href="' . $discovery['process_link'] . '"> '. $links .'</a>';
														}
														else
														{
															$links = "No links attached";
															echo '<a class="float-right"> '. $links .'</a>';
														}

														echo '<br>
		
													</div>
													<div class="col-4 mt-2">
														<div class="image-bg"><a href="' . $discovery['process_file'] . '"><img src="files/download.svg"></a></div>
													</div>
														</div>	
														</div>
														';
													
												 }} else {
													 echo '
													 <div class="sub-small-card" style="background: #bdc3c7; padding-top: 10px;padding-bottom: 10px;box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.25)">           						
														Empty
													 </div>
													 ';
												 }
											 ?>
		                 			
	                 			</div>
	                 		</div>
	                 	</div>
	                </div>
                </div>
            </div>          
        </div>
    </div>



<?php require_once '../partials/footer.php';?>   
