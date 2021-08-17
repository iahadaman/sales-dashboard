 
<?php 
if(!isset($_SESSION)) 
{ 
  ini_set('session.gc_maxlifetime', 3600);
  session_set_cookie_params(3600);
  session_start(); 
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

                <!-- CARD START  -->

            <div id="card">
                <div class="row">  

                <div class="card-box col-md-4 col-sm-6">
                    <div class="card-image card-bg1">
                        <img class="" src="../images/cardicon.jpg">
                    </div>   
                    <div class="card-content my-auto ml-3">
                        <p>Total Projects<br><strong id="usersTotalProjectsNumber"></strong></p>
                    </div> 
                    <div class="card-icon my-auto">  

                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16
                      16">
                         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                      </svg>
                       
                    </div>          
                </div>

                <div class="card-box col-md-4 col-sm-6">   
                    <div class="card-image card-bg2">
                        <img class="" src="../images/cardicon.jpg">
                    </div>   
                    <div class="card-content my-auto ml-3">
                        <p>In Progress Projects<br><strong id="usersTotalProgressProjectsNumber"></strong></p>
                    </div> 
                    <div class="card-icon my-auto">  
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16
                      16">
                         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                      </svg>
                    </div>    
                </div>

                <div class="card-box col-md-4 col-sm-12">   
                    <div class="card-image card-bg3">
                     <img class="" src="../images/cardicon.jpg">
                    </div>   
                    <div class="card-content my-auto ml-3">
                        <p>Completed Projects<br><strong id="usersTotalCompletedProjectNumber"></strong></p>
                    </div> 
                    <div class="card-icon my-auto">  
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16
                      16">
                         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                      </svg>
                    </div>    
                </div>   

                <!-- CARD END  -->


                <!-- INPROGRESS CARDS START  -->        

                <div class="col-lg-8 col-md-12 col-sm-12 mt-3">
                    <h5>Recent Projects</h5>
                    <hr>
                       <div id="recentUsersProjectsDiv">

                    </div>
                </div>

                <!-- INPROGRESS CARDS END  -->  

                <div class="col-lg-4 col-md-12 col-sm-12 mt-3">   
                    <h5>Quick Access</h5>
                    <hr>
                    <button type="button" class="btn btn-big btn-bg btn-lg btn-block"><i class="fa fa-circle" aria-hidden="true"></i> &nbsp Estimator</button>
                    <button type="button" class="btn btn-big btn-bg btn-lg btn-block"> <i class="fa fa-phone" aria-hidden="true"></i>

                        &nbspContact Us</button>                   
                </div>

                </div>
            </div>
                  
        </div>
    </div>

<?php require_once 'modals/delete-modal.php';?>   

<?php require_once '../partials/footer.php';?>   
