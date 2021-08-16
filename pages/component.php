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
	                <div id="component-page" class="web-bg col-md-12 col-sm-12 mt-3">

                    <div class="row">  
                      <div class="col-3"><h5 class="pull-left d-inline">Components</h5></div>
                      <div class="col-9">
    	                	  <div class="float-right project-right-property">                	 	 
            						    <label for="exampleInputSearch">Search</label>
            						    <input type="text" id="componentSearch" placeholder="e.g. IOS">						
      	                	 	<label>Platforms</label>
      	                	 	<select class="form-select" id="componentFilter">
            							  <option selected value="1">Web</option>
            							  <option value="2">Mobile Apps</option>
      						        	</select>                            
      	                	 	<button onClick="window.location.href='../pages/adding-component.php';" class="btn btn-bg btn-component"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp Add Component</button>   	          
    	                	  </div>
                      </div>       
                    </div>                	
						        <hr>


						  <!-- DATA TABLE START  -->  

						 <div class="col-md-12 col-sm-12 mt-3">
                    
                     <div class="component-table-style table-responsive">
                     <table class="table table-condensed">
                        <thead>
                          <tr>
                            <th>Question</th>
                            <th>Number Of Option(s)</th>
                            <th>Platform</th>
                            <th>Action</th>                         
                          </tr>
                        </thead>
                        <!-- WEB TABLE BODY -->
                        <tbody id="webPlatTable">
                          <!-- <tr>
                         
                            <td>How big is your App?</td>
                            <td>03</td>
                            <td>Web</td>
                            <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                           
                            <td>What level of UI/UX you would like?</td>
                            <td>03</td>
                            <td>Web</td>
                               <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                          
                            <td>Will your app need a login system?</td>
                            <td>10</td>
                            <td>Web</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                            
                            <td>User Generated Content</td>
                            <td>03</td>
                            <td>Web</td>
                              <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                         
                            <td>How big is your App?</td>
                           <td>03</td>
                            <td>Web</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr> -->
                           
                        </tbody>
                        <tbody id="androidPlatTable" style="display: none">
                          <!-- <tr>
                         
                            <td>How big is your App?</td>
                            <td>03</td>
                            <td>Web</td>
                            <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                           
                            <td>What level of UI/UX you would like?</td>
                            <td>03</td>
                            <td>Web</td>
                               <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                          
                            <td>Will your app need a login system?</td>
                            <td>10</td>
                            <td>Web</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                            
                            <td>User Generated Content</td>
                            <td>03</td>
                            <td>Web</td>
                              <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                         
                            <td>How big is your App?</td>
                           <td>03</td>
                            <td>Web</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr> -->
                           
                        </tbody>
                        <tbody id="iosPlatTable" style="display: none">
                          <!-- <tr>
                         
                            <td>How big is your App?</td>
                            <td>03</td>
                            <td>Web</td>
                            <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                           
                            <td>What level of UI/UX you would like?</td>
                            <td>03</td>
                            <td>Web</td>
                               <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                          
                            <td>Will your app need a login system?</td>
                            <td>10</td>
                            <td>Web</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                            
                            <td>User Generated Content</td>
                            <td>03</td>
                            <td>Web</td>
                              <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                         
                            <td>How big is your App?</td>
                           <td>03</td>
                            <td>Web</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr> -->
                           
                        </tbody>
                        <!-- WEB TABLE BODY END -->
                      </table>
                      </div>
                </div>

					</div>
        </div>
      </div>

    </div>
	</div>
<?php require_once 'modals/delete-modal.php';?>   
<?php require_once '../partials/footer.php';?>   


