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

  require_once '../partials/header.php';?>
    <div class="wrapper">      
       <?php require_once '../partials/sales-sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/sales-navigation.php';?> 

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
                          $client_id =  $_SESSION['client_id'];
                         $getPlatforms = mysqli_query($con, "SELECT project_platformId FROM webtrixpro_projects WHERE project_clientId = '$client_id'");
                         while($platforms = mysqli_fetch_array($getPlatforms))
                         {
                          $platformid = $platforms['project_platformId'];

                          $getTargetedPlatform = mysqli_query($con, "SELECT * FROM webtrixpro_platforms WHERE platform_id = '$platformid'");
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
                        
                      }   }
                        ?>
					            </select>        
	                	 	<div class="btn-group ml-2 mainBtn">
	    				          <button value="In Progress" class="btn ip-btn btnLabel">In Progress</button>
	    				          <button value="Completed" class="btn c-btn btnLabel">Completed</button>
				            </div> 
			                </span>
			              </div> 
			         	</div>
         				<hr>

				          <!-- DATA COMINGN FROM AJAX BY ID-->
				          <div id="salesCardsData"></div>
	                	</div>
                	</div>
                </div>
            </div>
     	</div>
	</div>

<?php require_once '../partials/footer.php';?>   
