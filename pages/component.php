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
      	                	 	<button class="btn btn-bg btn-component"   data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp Add Component</button>   	          
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

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new component</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="email" class="form-control" id="title__newquestion" aria-describedby="emailHelp" placeholder="eg. Small">
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="email" class="form-control" id="description__newquestion" aria-describedby="emailHelp" placeholder="eg.  Your app probably has around 10-15 key feature pages" >
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Platform</label>
                                        <select class="form-control" id="addNewComponent__select">
                                          <option selected value="3">Web</option>
                                          <option value="1">Mobile</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-5" style="display: flex; justify-content: flex-start;">
                                    <div class="form-group">
                                   
                                    </div>
                                  </div>
                                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addNewQuestion();">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php require_once 'modals/delete-modal.php';?>   
<?php require_once '../partials/footer.php';?>   


