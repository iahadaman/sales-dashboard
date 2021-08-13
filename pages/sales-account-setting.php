  <?php require_once '../partials/header.php';?>
    <div class="wrapper">      
       <?php require_once '../partials/sales-sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/sales-navigation.php';?> 

            <div id="content-section">
 				<div class="row">  
	                <div class="web-bg col-md-12 col-sm-12 mt-3">
	                	<h5>Account Setting</h5>
	                	<hr class="mt-4">
	                	<div class="row">  
	                	    <div class="col-md-2 col-sm-12 setting-image">
		                	    <div class="project-detail-box"></div>
		                	     <button class="d-block pull-left btn btn-bg mb-3">Upload Image</button> 

							</div>

							<div class="account-style col-md-5 col-sm-6">	    
							
								<form>
								  <div class="form-group">
								    <label for="exampleInputEmail1">First Name</label>
								    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your first name">
								  </div>
								  <div class="form-group">
								    <label for="exampleInputPassword1">Email</label>
								    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your email address">
								  </div>
								  <div class="form-group">
								    <label for="exampleInputPassword1">Password</label>
								    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
								  </div>
				                <!-- 	<p>Project Name<br><strong>Webtrixpro</strong></p>
			                        <p>Project Platform<br><strong>Web Development</strong></p>
			                        <p>Current Status<br><strong style="color:#2E5CAE">In progress</strong></p> -->
							</div>
							<div class="account-style col-md-5 col-sm-6">
								<div class="form-group">
								    <label for="exampleInputEmail1">Last Name</label>
								    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your last name">
								  </div>
								  <div class="form-group">
								    <label for="exampleInputPassword1">Confirm Email</label>
								    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please confirm your email address">
								  </div>
								  <div class="form-group">
								    <label for="exampleInputPassword1">Confirm Password</label>
								    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please confirm your password">
								  </div>
								  <button type="submit" class="btn btn-bg float-right">Submit</button>
								</form>
			                	
							</div>
						</div>
	                </div>

                </div>
            </div>          
        </div>
    </div>

<?php require_once '../partials/footer.php';?>   
