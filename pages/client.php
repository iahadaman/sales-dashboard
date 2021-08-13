
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
require_once '../partials/header.php'; ?>
    <div class="wrapper">      
       <?php require_once '../partials/sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/navigation.php';?> 

            <div id="content-section">
 				<div class="row">  
	                <div id="component-page" class="web-bg col-md-12 col-sm-12 mt-3">
	                	 <div class="row">  
                      <div class="col-3"><h5 class="pull-left d-inline">Clients</h5></div>
                      <div class="col-9">
	                	
	                	
	                	 <div class="float-right project-right-property">
	                	 	 
						    <label for="exampleInputSearch" id="">Search</label>
						    <input type="text" id="searchClientFilter" placeholder="Search">
						
	                	 	
	                	 	<button type="button" data-toggle="modal" data-target="#addClient" class="btn btn-bg btn-component"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp Add Client</button> 
	          
	                	 </div> </div> </div>
	                	
						<hr>

						  <!-- DATA TABLE START  -->  

						<div class="col-md-12 col-sm-12 mt-3">
	                     	<div class="component-table-style table-responsive">

	                     		 <!-- DATA COMINGN FROM AJAX BY ID-->

	                     		<div id="manageClientsData"></div>  		                    		                                       
	                      	</div>
                		</div>

					</div>
                </div>
            </div>
        </div>
	</div>
<?php require_once 'modals/add-client-modal.php';?> 
<?php require_once '../partials/footer.php';?>   
<?php require_once 'modals/edit-client-modal.php';?> 
<?php require_once 'modals/delete-modal.php';?>   
