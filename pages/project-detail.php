
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
//  if(isset($_GET['id']))
//  {
//     $DataExist = false;
//     $idOfProject = mysqli_real_escape_string($link, $_GET['id']);
//     $getIds = "SELECT project_id from `Webtrixpro_projects`";
//     $query = mysqli_query($link, $getIds);
//     while($ids = mysqli_fetch_array($query)){
//       if( $ids['id'] == $idOfProject )
//       {
//         $DataExist = true;
//       }
// }  

//  if( $DataExist == true )
//   {
//       $getProject = mysqli_query($link, "SELECT * FROM Webtrixpro_projects WHERE id = '$idOfProject'");
//       $project = mysqli_fetch_assoc($getProject);
//      // $nameofCat = $catname['category_name'];
//   }
// }
   
	if(isset($_GET['id'])) {
		$project_id = mysqli_real_escape_string($con, $_GET['id']);
		$getProjectData = mysqli_query($con, "SELECT * FROM webtrixpro_projects WHERE project_id = '$project_id'");
		if(mysqli_num_rows($getProjectData) > 0) {
			$isTrue = true;
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
			global $con;
			$getID = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '1'");
			$platformData = mysqli_fetch_assoc($getID);
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '0' && $platformData['ios_platform'] == '0') {
				echo "Web App";
			}
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '0') {
				echo "Web App, Android";
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
			if($platformData['web_platform'] == '0' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '1') {
				echo "IOS & Android";
			}
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '0' && $platformData['ios_platform'] == '1') {
				echo "IOS & Web";
			}
			if($platformData['web_platform'] == '1' && $platformData['andriod_platform'] == '1' && $platformData['ios_platform'] == '0') {
				echo "Android & Web";
			}
			if($platformData['web_platform'] == '0' && $platformData['andriod_platform'] == '0' && $platformData['ios_platform'] == '1') {
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
		                	    <div class="project-detail-box"></div>
			                	<div class="project-detail-content">
				                	<p>Project Name<br><strong><?php echo getProjectData('project_name'); ?></strong></p>
			                        <p>Project Platform<br><strong><?php echo projectPlatform(); ?></strong></p>
			                        <p>Current Status<br><strong style="color:#2E5CAE"><?php echo getProjectData('project_label'); ?></strong></p>
		                        </div>
							</div>
							<div class="col-md-6 col-sm-6">
			                	<p>Project Start Date<br><strong><?php echo getProjectData('project_date'); ?></strong></p>
		                        <p>Client<br><strong class="profile-image-style"><img src="../images/profile.jpg" style="margin-right: 10px;"><?php echo getProjectData('project_client'); ?></strong></p>
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
		                 			<div class="sub-small-card">           						
			                 			<div class="row">
			                 				<div class="col-8">		                 
				                 				<h6>Discovery details in PDF</h6>
				                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
				                 				<a class="float-right" href="">View More</a>
				                 				<br>
				                 				<div class="card-end">
				                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
				                 				</div>
				                 			</div>
			                 				<div class="col-4 mt-2">
			                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
			                 					<div class="new-p">
			                 						<p>New</p>
			                 					</div>
			                 					
			                 				</div>
				                 		</div>	
		                 			</div>

		                 			<div class="sub-small-card">           						
			                 			<div class="row">
										
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 					
				                 				</div>
				                 		</div>	
		                 			</div>

		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#addUpdate" href="">Add Item</a>
									</div>
								</div>
	                 		</div>	                 		
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">DESIGN </h6><span class="float-right">:</span>    
		                 			<div class="sub-small-card">           						
			                 			<div class="row">
										
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 					<div class="new-p">
				                 						<p>New</p>
				                 					</div>
				                 					
				                 				</div>
				                 		</div>	
		                 			</div>

		                 			<div class="sub-small-card">           						
			                 			<div class="row">
										
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 				</div>
				                 		</div>	
		                 			</div>

		                 		</div>
							</div>
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">CODING </h6><span class="float-right">:</span>    
		                 			<div class="sub-small-card">           						
			                 			<div class="row">
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 					<div class="new-p">
				                 						<p>New</p>
				                 					</div>
				                 					
				                 				</div>
			                 				</div>	
	                 				</div>
		                 			<div class="sub-small-card">           						
			                 			<div class="row">
										
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 					<div class="new-p">
				                 						<p>New</p>
				                 					</div>
				                 					
				                 				</div>
				                 		</div>	
		                 			</div>
		                 			<div class="sub-small-card">           						
			                 			<div class="row">
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 					
				                 				</div>
				                 		</div>	
		                 			</div>
		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#addUpdate" href="">Add Item</a>
									</div>
								</div>
	                 		</div>
	                 		<div class="col-md-3 col-sm-12">
	                 			<div class="small-card">
		                 			<h6 class="pull-left d-inline main-heading">MAINTENANCE </h6><span class="float-right">:</span>    
		                 			<div class="sub-small-card">           						
			                 			<div class="row">
				                 				<div class="col-8">		                 
					                 				<h6>Discovery details in PDF</h6>
					                 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo gravida  </p>
					                 				<a class="float-right" href="">View More</a>
					                 				<br>
					                 				<div class="card-end">
					                 				<a type="button" data-toggle="modal" data-target="#deleteModal" class="delete" href=""><i class="fas fa-trash"></i>&nbspDelete</a>&nbsp <a class="edit" href=""><i class="fas fa-edit"></i>&nbsp Edit </a>
					                 				</div>
					                 			</div>
				                 				<div class="col-4 mt-2">
				                 					<div class="image-bg"><img src="../images/profile.jpg"></div>
				                 					<div class="new-p">
				                 						<p>New</p>
				                 					</div>		                 					
				                 				</div>
				                 		</div>	
		                 			</div>
		                 			
		                 			<div class="small-card-link">
		                 			<a type="button" data-toggle="modal" data-target="#addUpdate" href="">Add Item</a>
									</div>
	                 			</div>
	                 		</div>
	                 	</div>
	                </div>
                </div>
            </div>          
        </div>
    </div>

<?php require_once 'modals/delete-modal.php';?>   
<?php require_once 'modals/add-update-modal.php';?>  
<?php require_once '../partials/footer.php';?>   
