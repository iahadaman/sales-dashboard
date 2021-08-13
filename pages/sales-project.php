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
	                	 	<select class="form-select">
    						  <option selected>All</option>
    						  <option value="1">One</option>
    						  <option value="2">Two</option>
    						  <option value="3">Three</option>
					        </select>        
	                	 	<div class="btn-group ml-2 mainBtn">
	    				          <button value="In Progress" class="btn ip-btn btnLabel">In Progress</button>
	    				          <button value="Completed" class="btn c-btn btnLabel">Completed</button>
				            </div> 
			                </span>
			              </div> 
			         	</div>
         				<hr>

	                	<div class="row">  
	                	  	<div class="inprogress-card col-md-4 col-sm-6 mt-4">

	                            <div class="progress-box">
	                     <a class="design" href="project-detail.php">
	                             <div class="progress-bg2"> </div>
	                            </div>

	                            <div class="align-self-start progress-report">
	                              In Progress
	                            </div>

	                  
	                             <div class="progress-content">
	                                    <p>Project Name<br><strong>Webtrixpro</strong></p>
	                                    <p>Project Start Date<br><strong>03/02/2021</strong></p>
	                                     
	                            </div>     

	                            <div class="progress-next-content">
	                                     <p>Project Platform<br><strong>Web Development</strong></p>            
	                                     <p>Client<br><strong><img style="border-radius:50%;" src="../images/profile.jpg" width="20" height="18"> Ahad Aman</strong></p>
	              	</a>
	                               <span class="pt-3 pl-2"><a href="#"><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
	                                <a type="button" data-toggle="modal" data-target="#deleteModal" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>    
	                                  
	                            </div>               
                        	</div>
					
                          	<div class="inprogress-card col-md-4 col-sm-6 mt-4">
	                            <div class="progress-box">
	                             	<div class="progress-bg2"> </div>
	                            </div>

	                            <div class="align-self-start completed-progress-report">
	                              Completed
	                            </div>
           
	                             <div class="progress-content">
                                    <p>Project Name<br><strong>Webtrixpro</strong></p>
                                    <p>Project Start Date<br><strong>03/02/2021</strong></p>                                  
	                            </div>     

	                            <div class="progress-next-content">
                                    <p>Project Platform<br><strong>Web Development</strong></p>
                                    <p>Client<br><strong> <img style="border-radius:50%;" src="../images/profile.jpg" width="20" height="18"> Ahad Aman</strong></p>
                                    <span class="pt-3 pl-2"><a href="#"><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
                                     <a type="button" data-toggle="modal" data-target="#deleteModal" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>      
	                            </div>                                         
	                        </div>

	                        <div class="inprogress-card col-md-4 col-sm-6 mt-4">
	                            <div class="progress-box">
	                             <div class="progress-bg2"> </div>
	                            </div>

	                            <div class="align-self-start progress-report">
	                              In Progress
	                            </div>

	                  
	                             <div class="progress-content">
	                                    <p>Project Name<br><strong>Webtrixpro</strong></p>
	                                    <p>Project Start Date<br><strong>03/02/2021</strong></p>                                  
	                            </div>     

	                            <div class="progress-next-content">
	                                    <p>Project Platform<br><strong>Web Development</strong></p>
	                                    <p>Client<br><strong> <img style="border-radius:50%;" src="../images/profile.jpg" width="20" height="18"> Ahad Aman</strong></p>
	                                    <span class="pt-3 pl-2"><a href="#"><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
	                                      <a type="button" data-toggle="modal" data-target="#deleteModal" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>      

	                            </div>                                         
	                        </div>

	                	</div>
                	</div>
                </div>
            </div>
     	</div>
	</div>

 <!-- DELETE MODAL -->

<?php require_once 'modals/delete-modal.php';?>   

<?php require_once '../partials/footer.php';?>   
