
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
require_once '../partials/header.php';?>

<div class="wrapper">      
	<?php require_once '../partials/sidebar.php';?>
  <!-- Page Content  -->
  <div id="content">
    <?php require_once '../partials/navigation.php';?> 
    <div id="content-section">
			<div class="row">  
        <div id="project-page" class="web-bg col-md-12 col-sm-12 mt-3">
    	    <div class="row">  
              <div class="col-3"><h5 class="pull-left d-inline">Projects</h5></div>
              <div class="col-9">               	
              	<span class="float-right project-right-property">
                	 	<label>Platforms</label>
                	 	<select class="form-select">
        						  <option selected>All</option>
        						  <option value="1">One</option>
        						  <option value="2">Two</option>
        						  <option value="3">Three</option>
						        </select>
                	 	<button data-toggle="modal" data-target="#createProject" class="btn btn-bg btn-create"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp Create Project</button>              
                	 	<div class="btn-group ml-2 mainBtn">
    				          <button value="In Progress" class="btn ip-btn btnLabel">In Progress</button>
    				          <button value="Completed" class="btn c-btn btnLabel">Completed</button>
				            </div> 
                </span>
              </div> 
          </div>
          <hr>

          <!-- DATA COMINGN FROM AJAX BY ID-->
          <div id="progressCardsData"></div>
          <?php require_once 'modals/edit-project-modal.php' ?>
      	 </div>
        </div>
    </div>
 	</div>
</div>
<?php require_once 'modals/delete-modal.php';?> 
<?php require_once 'modals/create-project-modal.php';?>  
<?php require_once '../partials/footer.php';?>   



 


