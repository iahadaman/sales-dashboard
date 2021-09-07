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
               
                <div class="row platformButtons mt-5">
                  <div class="col-lg-2 col-md-3 col-sm-3">
                    <button id="selectedPlatform" value = "all" class= "btn btn-platform btn-platform-main">All</button>
                  </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                      <button id="selectedPlatform" value="webApp" class= "btn btn-platform btn-platform-1">Web Apps</button>
                  </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                    <button id="selectedPlatform" value="androidApp" class= "btn btn-platform btn-platform-2">Android Apps</button>
                  </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                    <button id="selectedPlatform" value="iosApp" class= "btn btn-platform btn-platform-3">IOS Apps</button>
                  </div>

                <div class="col-lg-4 col-md-3 col-sm-3">
                     <div class="float-right project-sales-search">                      
                        
                        <input type="text" id="searchProjectFilter" placeholder="Search By Project Name">                     
                   </div>
                   
                </div>



              </div>




                  <!-- DATA COMINGN FROM AJAX BY ID-->
                  <div class="mt-4" id="salesCardsData"></div>

                    </div>
                  </div>
                </div>
            </div>
      </div>
  </div>

<?php require_once '../partials/footer.php';?>   
