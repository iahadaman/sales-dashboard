
<?php 
if(!isset($_SESSION)) 
{ 
  ini_set('session.gc_maxlifetime', 3600);
  session_set_cookie_params(3600);
  session_start(); 
} 
if(!isset($_SESSION["admin_name"])) 
{
  header('location: login.php');
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
       <?php require_once '../partials/sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/navigation.php';?> 

            <div id="content-section">
 				<div class="row">  
	                <div class="web-bg col-md-12 col-sm-12 mt-3">
	                	<div class="row">  
		                	<div class="col-3"><h5 class="pull-left d-inline mb-0">Projects</h5></div>
		                	<div class="col-9">
			                	<div class="float-right">		
			                	 	<button class="btn btn-edit"><i class="fas fa-edit"></i>&nbspEdit</button> &nbsp  
			                	 	<button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-delete"><i class="fas fa-trash"></i>&nbspDelete</button> 
								</div>	                	 	               
	                		</div>
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
		                        <p>Client<br><strong class="profile-image-style"><img src="<?php echo getProjectData('project_clientProfile'); ?>" style="margin-right: 10px;height: 30px; width: 32px;"><?php echo $clientName ?></strong></p>
								<p>Final Version<br><strong class="link-style"><a href="https://finalversion.com">https://finalversion.com</a><i class="ml-2 fa fa-link" aria-hidden="true"></i></strong></p>
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
														<div class="card-end">
														<a type="button" data-toggle="modal" onclick="deleteUpdate('. $discovery['update_id'] .')" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a type="button" class="edit_discovery_data edit" id="'.$discovery['update_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
														</div>
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

		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#addUpdate" href="">Add Item</a>
									</div>
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
														<div class="card-end">
													<a type="button" data-toggle="modal" onclick="deleteUpdate('. $discovery['update_id'] .')" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a type="button" class="edit_design_data edit" id="'.$discovery['update_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
														</div>
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
		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#design_addUpdate" href="">Add Item</a>
									</div>
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
														<div class="card-end">
														<a type="button" data-toggle="modal" onclick="deleteUpdate('. $discovery['update_id'] .')" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a type="button" class="edit_coding_data edit" id="'.$discovery['update_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
														</div>
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
		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#coding_addUpdate" href="">Add Item</a>
									</div>
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
														<div class="card-end">
														<a type="button" data-toggle="modal" onclick="deleteUpdate('. $discovery['update_id'] .')" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a type="button" class="edit_maintenance_data edit" id="'.$discovery['update_id'].'" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
														</div>
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
		                 			
		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#main_addUpdate" href="">Add Item</a>
									</div>
	                 			</div>
	                 		</div>
	                 	</div>
	                </div>
                </div>
            </div>          
        </div>
    </div>
<!-- MODAL FOR DISCOVERY -->
<div class="modal fade" id="addUpdate" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
      	  <div id="update_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>
        	<form name="discovery">
			  <div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" id="title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>

			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="link">Link (Required for designing process)</label>
			    <input type="text" class="form-control" id="link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="add_item_btn" onclick="addNewItem(<?php echo $project_id ?>, 'discovery');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- UPDATE MODAL FOR DISCOVERY -->
<div class="modal fade" id="editUpdate" tabindex="-1" role="dialog" aria-labelledby="editItem" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
      	 <div id="edit_update_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>
        	<form name="update_discovery">
			  <div class="form-group">
			  	<input type="hidden" class="form-control" id="u_dis_id">
			    <label for="u_dis_title">Title</label>
			    <input type="text" class="form-control" id="u_dis_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="u_dis_description">Description</label>
			    <textarea class="form-control" id="u_dis_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="">Add File/Image</label>
			    <input type="hidden" id="u_dis_file_name">
			    <input type="file" class="form-control-file" id="u_dis_file" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="u_dis_link">Link (Required for designing process)</label>
			    <input type="text" class="form-control" id="u_dis_link" placeholder="www.example.com/">
			  </div>
			 <!--  <button type="button" class="btn-submit float-right btn" id="updateDiscoveryBtn">Done</button> -->
			  <button type="button" class="btn-submit float-right btn" id="editDiscoveryBtn" onclick="editNewItem(<?php echo $project_id ?>, 'update_discovery');">Done</button>

			</form>
      </div>
    </div>
  </div>
</div>

<!-- DESIGN MODAL -->
<div class="modal fade" id="design_addUpdate" tabindex="-1" role="dialog" aria-labelledby="design_addUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="design">
			  <div class="form-group">
			    <label for="design_title">Title</label>
			    <input type="text" class="form-control" id="design_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="design_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="exampleInputEmail1">Link (Required for designing process)</label>
			    <input type="text" class="form-control" id="design_link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="add_item_btn" onclick="addNewItem(<?php echo $project_id ?>, 'design');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT MODAL FOR DESIGN MODAL -->
<div class="modal fade" id="editDesign" tabindex="-1" role="dialog" aria-labelledby="design_editUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">EDIT Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="update_design">
			  <div class="form-group">
			  	<input type="hidden" class="form-control" id="u_design_id">
			    <label for="exampleInputEmail1">Title</label>
			    <input type="text" class="form-control" id="u_design_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="u_design_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			     <input type="hidden" id="u_design_file_name">
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="exampleInputEmail1">Link (Required for designing process)</label>
			    <input type="text" class="form-control" id="u_design_link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="edit_item_btn" onclick="editNewItem(<?php echo $project_id ?>, 'update_design');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- CODING -->
<div class="modal fade" id="coding_addUpdate" tabindex="-1" role="dialog" aria-labelledby="coding_addUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="coding">
			  <div class="form-group">
			    <label for="coding_title">Title</label>
			    <input type="text" class="form-control" id="coding_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="coding_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="coding_link">Link (Required for designing process)</label>
			    <input type="text" class="form-control" id="coding_link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="add_item_btn" onclick="addNewItem(<?php echo $project_id ?>, 'coding');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT CODING -->
<div class="modal fade" id="editCoding" tabindex="-1" role="dialog" aria-labelledby="coding_addUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="update_coding">
			  <div class="form-group">
			  	<input type="hidden" class="form-control" id="u_coding_id">
			    <label for="coding_title">Title</label>
			    <input type="text" class="form-control" id="u_coding_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="u_coding_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			     <input type="hidden" id="u_coding_file_name">
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="coding_link">Link (Required for designing process)</label>
			    <input type="text" class="form-control" id="u_coding_link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="edit_item_btn" onclick="editNewItem(<?php echo $project_id ?>, 'update_coding');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- MAINTENANCE -->
<div class="modal fade" id="main_addUpdate" tabindex="-1" role="dialog" aria-labelledby="main_addUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="maintenance">
			  <div class="form-group">
			    <label for="main_title">Title</label>
			    <input type="text" class="form-control" id="main_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlTextarea1">Description</label>
			    <textarea class="form-control" id="main_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="main_link">Link (Required for designing process)</label>
			    <input type="email" class="form-control" id="main_link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="add_item_btn" onclick="addNewItem(<?php echo $project_id ?>, 'maintenance');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT MAINTENANCE -->
<div class="modal fade" id="editMaintenance" tabindex="-1" role="dialog" aria-labelledby="main_editUpdate" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form name="update_maintenance">
			  <div class="form-group">
			  	 <input type="hidden" class="form-control" id="u_main_id">
			    <label for="u_main_title">Title</label>
			    <input type="text" class="form-control" id="u_main_title" placeholder="Enter your project name">
			  </div>
			    <div class="form-group">
			    <label for="u_main_description">Description</label>
			    <textarea class="form-control" id="u_main_description" rows="3"></textarea>
			  	</div>

			  	<div class="form-group">
			    <label for="exampleFormControlFile1">Add File/Image</label>
			     <input type="hidden" id="u_main_file_name">
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="process_file">
			   </div>
			 <div class="form-group">
			    <label for="u_main_link">Link (Required for designing process)</label>
			    <input type="email" class="form-control" id="u_main_link" placeholder="www.example.com/">
			  </div>
			   <button type="button" class="btn-submit float-right btn" id="edit_item_btn" onclick="editNewItem(<?php echo $project_id ?>, 'update_maintenance');">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>


<?php require_once '../partials/footer.php';?>   
