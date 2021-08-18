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

                      <div class="btn-group ml-2 mainBtn">
                        <button value="In Progress" class="btn ip-btn btnLabel">In Progress</button>
                        <button value="Completed" class="btn c-btn btnLabel">Completed</button>
                    </div> 
                      </span>
                    </div> 
                </div>
                <hr>
                <div class="row platformButtons">
                  <div class="col-lg-2 col-md-3 col-sm-3">
                    <button id="selectedPlatform" value = "all" class= "btn btn-platform default btn-platform-main">All</button>
                  </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                      <button id="selectedPlatform" value="webApp" class= "btn btn-platform btn-platform-1">Web App</button>
                  </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                    <button id="selectedPlatform" value="androidApp" class= "btn btn-platform btn-platform-2">Android App</button>
                  </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                    <button id="selectedPlatform" value="iosApp" class= "btn btn-platform btn-platform-3">IOS App</button>
                  </div>
              </div>

                  <!-- DATA COMINGN FROM AJAX BY ID-->
                  <div id="salesCardsData"></div>
                    </div>
                  </div>
                </div>
            </div>
      </div>
  </div>

<?php require_once '../partials/footer.php';?>   
