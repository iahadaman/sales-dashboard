
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
                    <select id="selectedPlatform" class="form-select">
                        <option value = "all" selected>All</option>
                         <?php
                          $check = true;
                          $check2 = true;
                          $check3 = true;

                          $getTargetedPlatform = mysqli_query($con, "SELECT * FROM webtrixpro_platforms");
                          while($p_platforms = mysqli_fetch_array($getTargetedPlatform)){

                          if($p_platforms['web_platform'] == 1)
                          {
                            if($check == true)
                            {
                              ?>
                                 <option value="webApp">Web App</option>
                              <?php
                                 $check = false;
                            }

                          }
                          if($p_platforms['andriod_platform'] == 1)
                          {
                             if($check2 == true)
                            {
                              ?>
                               <option value="androidApp">Android App</option>
                             <?php
                                 $check2 = false;
                            }

                          }
                            if($p_platforms['ios_platform'] == 1)
                          {
                            if($check3 == true)
                            {
                              ?>

                               <option value="iosApp">IOS App</option>

                            <?php
                             $check3 = false;
                           }
                          }
                        
                        }
                        ?>
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



 


