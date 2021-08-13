
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
   

require_once '../partials/header.php';?>
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
				                	<p>Project Name<br><strong>webtricpro</strong></p>
			                        <p>Project Platform<br><strong>Web Development</strong></p>
			                        <p>Current Status<br><strong style="color:#2E5CAE">In progress</strong></p>
		                        </div>
							</div>
							<div class="col-md-6 col-sm-6">
			                	<p>Project Start Date<br><strong>03/02/2021</strong></p>
		                        <p>Client<br><strong class="profile-image-style"><img src="../images/profile.jpg"> Ali Aman</strong></p>
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
