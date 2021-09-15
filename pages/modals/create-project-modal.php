 <div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content m-5 p-4">
      <div class="modal-header pl-0">
        <h5 class="modal-title">Create Projects</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        	<form id="CreateProjectForm" onsubmit="return false;" method="POST" enctype="multipart/form-data" name="project">
        		<div id="project_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>
			  <div class="form-group">
			    <label for="projectname">Project Name</label>
			    <input type="text" class="form-control" id="projectname" placeholder="Enter your project name">
			  </div>
			   <div class="form-group">
			    <label for="projectClientName">Account Executive Name</label>
			      <select id="projectClientName" class="form-control">
				  <option disabled selected>Select Account Executive</option>

				  <?php
				  include 'backend/connection.php';
				  $getAllClients = mysqli_query($con, "SELECT * FROM webtrixpro_users WHERE user_isAdmin !=1 ORDER BY user_id desc");
   		 			while($allclients = mysqli_fetch_array($getAllClients)){
				  ?>
				  <option value="<?php echo $allclients['user_id'] ?>"><?php echo $allclients['user_name'] ?></option>
				  <?php } ?>
				</select>
			  </div>
			  <div class="form-group">
			    <label for="projectPlatform">Project Platform</label>
			     <select id = "projectPlatform" class="form-control">
				  <option disabled selected>Select Project Platform</option>
				  <option value="Web Development">Web Development</option>
				  <option value="Android Development">Android Development</option>
				  <option value="IOS Development">IOS Development</option>
				</select>

				<div class="third-platform mt-4">
					<select id = "projectSecondPlatform" class="form-control">
						<option disabled selected>Select Project Platform</option>
						<option value="Web Development">Web Development</option>
						<option value="Android Development">Android Development</option>
						<option value="IOS Development">IOS Development</option>
					</select>
				</div>

				<div class="second-platform mt-4">
					<select id = "projectThirdPlatform" class="form-control">
						<option disabled selected>Select Project Platform</option>
						<option value="Web Development">Web Development</option>
						<option value="Android Development">Android Development</option>
						<option value="IOS Development">IOS Development</option>
					</select>
				</div>

				<a class="addMoreOptions float-right" href="#">Add more</a>
				<a class="mr-3 removeOptions float-right" href="#">Remove Dropdown</a>

			  </div>
			
			  	<div class="form-group">
			    <label for="projectClientProfile">Add File</label>
			    <input type="file" class="form-control-file" name="img_file" id="projectClientProfile">
			   </div>
			   <div class="form-group">
			    <label for="projectDate">Project Start Date</label>
			    <input type="text" class="form-control" id="projectDate" placeholder="mm/dd/yyyy">
			   </div>
			 	<div class="form-group">
			    <label for="projectDescription">Description (Optional)</label>
			    <textarea class="form-control" id="projectDescription" rows="3"></textarea>
			  	</div>
			  	<div class="form-group">
			    <label class="d-block" for="projectLabel">Label</label>
			     <div class="btn-group">
		          <button value="In Progress" class="btn ip-btn btnLabel">In Progress</button>
		          <button value="Completed" class="btn c-btn btnLabel">Completed</button>
			  	</div>
			   <button id="createProjectBtnn" type="submit" class="btn-submit d-block mt-5 float-right btn">Done</button>
			</form>
      </div>
    </div>
  </div>
</div>